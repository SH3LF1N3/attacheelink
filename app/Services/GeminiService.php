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
        try {
            if ($this->apiKey === '') {
                Log::error('Gemini API key is missing');
                return 'AI service is not configured. Please set GEMINI_API_KEY and clear config cache.';
            }

            $safePrompt = $this->toValidUtf8($prompt);

            $response = Http::timeout(30)
                ->retry(2, 400)
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $safePrompt]]]
                ],
                'generationConfig' => [
                    'temperature'     => 0.7,
                    'maxOutputTokens' => 2048,
                ],
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