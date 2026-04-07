<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class GeminiService
{
    private string $apiKey;
    private string $model;
    private string $endpoint;

    public function __construct()
    {
        $this->apiKey   = (string) config('services.gemini.key', '');
        $this->model    = (string) config('services.gemini.model', 'gemini-1.5-flash');
        $this->endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent";
    }

    /**
     * Send a prompt and get a text response.
     */
    public function ask(string $prompt): string
    {
        return $this->askWithConfig($prompt, []);
    }

    /**
     * Ask Gemini with custom generation config for structured responses.
     */
    public function askWithConfig(string $prompt, array $config = []): string
    {
        try {
            if ($this->apiKey === '') {
                Log::error('Gemini API key is missing');
                return 'AI service is not configured. Please set GEMINI_API_KEY and clear config cache.';
            }

            $safePrompt = $this->toValidUtf8($prompt);

            $defaultConfig = [
                'temperature'     => 0.5,
                'maxOutputTokens' => 2048,
            ];

            $generationConfig = array_merge($defaultConfig, $config);

            $response = Http::timeout(30)
                ->retry(2, 400)
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $safePrompt]]]
                ],
                'generationConfig' => $generationConfig,
            ]);

            if ($response->failed()) {
                $status = $response->status();
                $body = $response->json();
                $message = (string) data_get($body, 'error.message', 'Unknown Gemini API error.');

                Log::error('Gemini API error', [
                    'status' => $status,
                    'message' => $message,
                    'body' => $response->body(),
                    'model' => $this->model,
                ]);

                if ($status === 403 && str_contains(strtolower($message), 'reported as leaked')) {
                    return 'Your Gemini key is blocked as leaked. Generate a new API key, update GEMINI_API_KEY, then run php artisan config:clear.';
                }

                if ($status === 401 || $status === 403) {
                    return 'Gemini authentication failed. Check GEMINI_API_KEY permissions and API restrictions.';
                }

                if ($status === 429) {
                    return 'Gemini rate limit reached. Please retry in a moment.';
                }

                return 'I was unable to process your request at this time. Please try again.';
            }

            return $response->json('candidates.0.content.parts.0.text')
                ?? 'No response generated.';

        } catch (Throwable $e) {
            Log::error('Gemini exception', ['message' => $e->getMessage(), 'model' => $this->model]);
            return 'An error occurred while contacting the AI service.';
        }
    }

    /**
     * Specialized method for CV/Resume analysis with structured output.
     * Uses optimized settings for consistent structured format.
     */
    public function analyzeCV(string $cvPrompt): string
    {
        // Add a system message prefix to ensure strict compliance
        $systemMessage = "You are a professional CV reviewer who ALWAYS provides complete, detailed feedback. "
            . "You will ALWAYS output all four required sections: Overall Score, Strengths, Weaknesses, and Recommendations, plus ATS Keywords. "
            . "Never skip sections. Never say a section is not applicable. Always provide substantive content for all sections.\n\n";
        
        $fullPrompt = $systemMessage . $cvPrompt;

        return $this->askWithConfig($fullPrompt, [
            'temperature'     => 0.7,  // Balanced temperature for creativity + consistency
            'maxOutputTokens' => 3000,  // Extra tokens for detailed feedback
        ]);
    }

    /**
     * Send a structured prompt with a system context prefix.
     */
    public function askWithContext(string $systemContext, string $userPrompt): string
    {
        $fullPrompt = "{$systemContext}\n\n---\n\nUser: {$userPrompt}";
        return $this->ask($fullPrompt);
    }

    private function toValidUtf8(string $text): string
    {
        if (mb_check_encoding($text, 'UTF-8')) {
            return $text;
        }

        return mb_convert_encoding($text, 'UTF-8', 'UTF-8');
    }
}