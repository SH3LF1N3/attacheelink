<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\AiChatMessage;
use App\Models\Logsdb;
use App\Models\Oppodb;
use App\Models\User;
use App\Services\GeminiService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use Symfony\Component\Process\Process;

class Aitools extends Controller
{
    // AI Assistant

    public function ass()
    {
        return view('dash.ai.tools');
    }

    public function assHistory()
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $messages = AiChatMessage::where('user_id', $user->getAuthIdentifier())
            ->latest('id')
            ->take(60)
            ->get()
            ->reverse()
            ->values()
            ->map(function (AiChatMessage $message) {
                $createdAt = $message->getAttribute('created_at');

                return [
                    'role' => (string) $message->getAttribute('role'),
                    'text' => (string) $message->getAttribute('message'),
                    'at' => $createdAt instanceof \DateTimeInterface ? $createdAt->format(DATE_ATOM) : null,
                ];
            });

        return response()->json(['messages' => $messages]);
    }

    public function assClearHistory()
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        AiChatMessage::where('user_id', $user->getAuthIdentifier())->delete();

        return response()->json(['cleared' => true]);
    }

    public function assChat(Request $request)
    {
        $request->validate(['message' => ['required', 'string', 'max:1000']]);

        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        /** @var User&Authenticatable $user */
        $message = (string) $request->input('message');
        $gemini = new GeminiService();

        $myApps = Application::with('opportunity')->where('user_id', $user->getAuthIdentifier())->latest()->take(5)->get();
        $openOppo = Oppodb::where('status', 'active')->latest()->take(10)->get();

        $appsCtx = $myApps->map(function ($a) {
            $oname = (string) data_get($a, 'opportunity.oname', 'Unknown opportunity');
            $org = (string) data_get($a, 'opportunity.org', 'Unknown organisation');
            $status = (string) data_get($a, 'status', 'pending');

            return "- {$oname} at {$org} (status: {$status})";
        })->implode("\n");
        $oppoCtx = $openOppo->map(function ($o) {
            $oname = (string) data_get($o, 'oname', 'Opportunity');
            $org = (string) data_get($o, 'org', 'Organisation');
            $loc = (string) data_get($o, 'loc', 'N/A');
            $deadline = (string) data_get($o, 'dead', 'N/A');

            return "- {$oname} at {$org}, {$loc}, deadline: {$deadline}";
        })->implode("\n");

        $studentName = (string) $user->getAttribute('fname');
        $studentUsername = (string) $user->getAttribute('uname');

        $systemCtx = "You are AttachKE's AI career assistant helping Kenyan university students find internships.\n\n"
            . "Student: {$studentName} ({$studentUsername})\n\n"
            . "Their recent applications:\n{$appsCtx}\n\n"
            . "Open opportunities:\n{$oppoCtx}\n\n"
            . "Give practical, concise advice under 300 words. Plain text only, no markdown.";

        $reply = $gemini->askWithContext($systemCtx, $message);

        AiChatMessage::create([
            'user_id' => $user->getAuthIdentifier(),
            'role' => 'user',
            'message' => $message,
        ]);

        AiChatMessage::create([
            'user_id' => $user->getAuthIdentifier(),
            'role' => 'assistant',
            'message' => $reply,
        ]);

        Logsdb::record('ai_assistant', $user);

        return response()->json(['reply' => $reply]);
    }

    // AI Resume Checker

    public function check()
    {
        $openOppo = Oppodb::where('status', 'active')->latest()->take(20)->get();
        return view('dash.ai.check', compact('openOppo'));
    }

    public function checkResume(Request $request)
    {
        $request->validate([
            'cv_text' => ['nullable', 'string', 'max:8000'],
            'cv_file' => ['nullable', 'file', 'mimes:txt,pdf', 'max:2048'],
            'oppo_id' => ['nullable', 'exists:oppodbs,id'],
        ]);

        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $gemini = new GeminiService();

        $cvText = (string) $request->input('cv_text', '');
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');

            if ($file instanceof UploadedFile) {
                $fileText = $this->extractCvTextFromFile($file);
                if (trim($cvText) === '' && trim($fileText) !== '') {
                    $cvText = $fileText;
                }
            }
        }

        $cvText = $this->normalizeUtf8($cvText);

        if (empty(trim($cvText))) {
            return response()->json([
                'error' => 'No readable CV text found. Paste your CV text, upload a .txt file, or upload a text-based PDF (not scanned image PDF).',
            ], 422);
        }

        $oppoCtx = '';
        $oppoId = $request->integer('oppo_id');
        if ($oppoId > 0) {
            $oppo = Oppodb::find($oppoId);
            if ($oppo) {
                $oname = (string) $oppo->getAttribute('oname');
                $org = (string) $oppo->getAttribute('org');
                $descr = (string) $oppo->getAttribute('descr');
                $oppoCtx = "Target: {$oname} at {$org}. Description: {$descr}";
            }
        }

        $prompt = "You are a professional CV reviewer. Your ONLY task is to provide structured feedback in the exact format below.\n\n"
            . "DO NOT ADD ANY TEXT BEFORE, BETWEEN, OR AFTER THESE FOUR SECTIONS.\n\n"
            . "{$oppoCtx}\n\n"
            . "===== CV TO REVIEW =====\n"
            . "{$cvText}\n"
            . "===== END CV =====\n\n"
            . "===== RESPOND WITH ONLY THESE FOUR SECTIONS BELOW - NO OTHER TEXT =====\n"
            . "Overall Score: [INSERT A NUMBER BETWEEN 0-100 HERE]\n\n"
            . "Strengths:\n"
            . "[INSERT 3-5 STRENGTHS HERE, EACH ON A NEW LINE STARTING WITH A DASH]\n"
            . "- Example strength 1\n"
            . "- Example strength 2\n\n"
            . "Weaknesses:\n"
            . "[INSERT 3-5 WEAKNESSES HERE, EACH ON A NEW LINE STARTING WITH A DASH. CVMUST HAVE WEAKNESSES, ALWAYS IDENTIFY THEM]\n"
            . "- Example weakness 1\n"
            . "- Example weakness 2\n\n"
            . "Recommendations:\n"
            . "[INSERT 4-6 ACTIONABLE RECOMMENDATIONS HERE, EACH ON A NEW LINE STARTING WITH A DASH]\n"
            . "- Example recommendation 1\n"
            . "- Example recommendation 2\n\n"
            . "ATS Keywords:\n"
            . "[INSERT 8-12 RELEVANT KEYWORDS HERE, EACH ON A NEW LINE STARTING WITH A DASH]\n"
            . "- Keyword 1\n"
            . "- Keyword 2\n\n"
            . "FORMATTING RULES (CRITICAL):\n"
            . "- Use ONLY plain text\n"
            . "- Each bullet point MUST start with a dash (-)\n"
            . "- NO markdown, NO bold, NO italics, NO special characters\n"
            . "- Each section heading must be EXACTLY as shown\n"
            . "- Include all four sections with NO exceptions\n"
            . "- Every CV has weaknesses - you must identify them\n"
            . "- After 'ATS Keywords:' section, stop - do not add any closing text";

        $feedback = $gemini->analyzeCV($prompt);
        
        // Log the response for debugging
        Log::info('CV Analysis Response', [
            'length' => strlen($feedback),
            'has_weaknesses' => stripos($feedback, 'Weaknesses:') !== false,
            'has_recommendations' => stripos($feedback, 'Recommendations:') !== false,
            'first_200_chars' => substr($feedback, 0, 200),
        ]);
        
        Logsdb::record('ai_resume_checker', $user);

        return response()->json(['feedback' => $feedback]);
    }

    // AI Analytics

    public function analytics()
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $data = $this->buildAnalyticsData($user);
        return view('dash.ai.analytics', compact('data'));
    }

    public function analyticsInsight(Request $request)
    {
        $request->validate(['question' => ['required', 'string', 'max:500']]);

        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $question = (string) $request->input('question');
        $gemini = new GeminiService();
        $data = $this->buildAnalyticsData($user);
        $s = $data['by_status'];
        $m = $data['metrics'];

        // Build organization performance context
        $orgPerf = [];
        foreach ($data['org_status_breakdown'] as $org => $breakdown) {
            $rate = $breakdown['total'] > 0 ? round(($breakdown['selected'] / $breakdown['total']) * 100, 1) : 0;
            $orgPerf[] = "{$org}: {$breakdown['total']} apps, {$breakdown['selected']} selected ({$rate}%)";
        }
        $orgPerfText = !empty($orgPerf) ? implode('; ', array_slice($orgPerf, 0, 5)) : 'No org data';

        // Build opportunity performance context
        $oppoPerf = [];
        foreach ($data['oppo_status_breakdown'] as $oppo => $breakdown) {
            $rate = $breakdown['total'] > 0 ? round(($breakdown['selected'] / $breakdown['total']) * 100, 1) : 0;
            $oppoPerf[] = substr((string)$oppo, 0, 30) . ": {$breakdown['total']} apps, {$breakdown['selected']} selected ({$rate}%)";
        }
        $oppoPerfText = !empty($oppoPerf) ? implode('; ', array_slice($oppoPerf, 0, 5)) : 'No oppo data';

        $systemCtx = "You are a data analyst for AttachKE, a Kenyan university attachment platform.\n\n"
            . "Overall Stats: students={$data['total_students']}, orgs={$data['total_orgs']}, "
            . "opportunities={$data['total_oppo']}, applications={$data['total_apps']}.\n"
            . "By status: pending={$s['pending']}, review={$s['review']}, shortlisted={$s['shortlisted']}, "
            . "interview_scheduled={$s['interview_scheduled']}, selected={$s['selected']}, rejected={$s['rejected']}.\n\n"
            . "Performance Metrics:\n"
            . "- Conversion Rate (applied→selected): {$m['avg_conversion_rate']}%\n"
            . "- Advancement Rate (any progress): {$m['avg_advancement_rate']}%\n"
            . "- Interview-to-Selection Rate: {$m['interview_to_selection']}%\n"
            . "- Rejection Rate: {$m['avg_rejection_rate']}%\n\n"
            . "Top Organizations: {$orgPerfText}\n"
            . "Top Opportunities: {$oppoPerfText}\n\n"
            . "CRITICAL INSTRUCTIONS:\n"
            . "Return ONLY plain text with these EXACT four sections. Each section is REQUIRED.\n"
            . "Do NOT skip any section. Do NOT use markdown. Do NOT use bold or italics.\n"
            . "Separate each bullet with a new line. Always use - for bullets.\n\n"
            . "Insight Score: <number>/100\n\n"
            . "Key Findings:\n"
            . "- Finding 1\n"
            . "- Finding 2\n"
            . "- Finding 3\n\n"
            . "Risks and Gaps:\n"
            . "- Risk 1\n"
            . "- Risk 2\n\n"
            . "Recommended Actions:\n"
            . "- Action 1\n"
            . "- Action 2\n"
            . "- Action 3\n\n"
            . "Follow this format EXACTLY. Include all sections ALWAYS.";

        $insight = $gemini->askWithContext($systemCtx, $question);
        Logsdb::record('ai_analytics', $user);

        return response()->json(['insight' => $insight]);
    }

    private function buildAnalyticsData(User $user): array
    {
        $appQuery = Application::query();
        $oppoQuery = Oppodb::query();

        $this->scopeQueriesForCompany($user, $appQuery, $oppoQuery);

        $apps = $appQuery->with('opportunity')->get();
        $topOrgs = $this->buildTopOrganizations($apps);
        $topOppo = $this->buildTopOpportunities($apps);

        return [
            'total_students' => User::where('role', 'student')->count(),
            'total_orgs' => User::where('role', 'company')->count(),
            'total_oppo' => $oppoQuery->count(),
            'total_apps' => $apps->count(),
            'by_status' => $this->buildStatusCounts($apps),
            'top_orgs' => $topOrgs,
            'top_oppo' => $topOppo,
            'top_orgs_text' => $topOrgs->map(fn($c, $o) => \sprintf('%s: %d', (string) $o, (int) $c))->implode(', '),
            'top_oppo_text' => $topOppo
                ->map(fn($o) => \sprintf('%s: %d', (string) data_get($o, 'name', '?'), (int) data_get($o, 'count', 0)))
                ->implode(', '),
            'daily_apps' => $this->buildDailyApplicationCounts($apps),
            'org_status_breakdown' => $this->buildOrgStatusBreakdown($apps),
            'oppo_status_breakdown' => $this->buildOppoStatusBreakdown($apps),
            'metrics' => $this->buildPerformanceMetrics($apps),
        ];
    }

    private function scopeQueriesForCompany(User $user, $appQuery, $oppoQuery): void
    {
        if ((string) $user->getAttribute('role') !== 'company') {
            return;
        }

        $orgName = (string) $user->getAttribute('uname');
        $ids = Oppodb::where('org', $orgName)->pluck('id');
        $appQuery->whereIn('oppodb_id', $ids);
        $oppoQuery->where('org', $orgName);
    }

    private function buildTopOrganizations(Collection $apps): Collection
    {
        return $apps
            ->groupBy(fn($a) => (string) data_get($a, 'opportunity.org', '?'))
            ->map(fn($g) => $g->count())
            ->sortDesc()
            ->take(5);
    }

    private function buildTopOpportunities(Collection $apps): Collection
    {
        return $apps
            ->groupBy('oppodb_id')
            ->map(fn($g) => [
                'name' => (string) data_get($g->first(), 'opportunity.oname', '?'),
                'count' => $g->count(),
            ])
            ->sortByDesc('count')
            ->take(5);
    }

    private function buildStatusCounts(Collection $apps): array
    {
        return [
            'pending' => $apps->where('status', 'pending')->count(),
            'review' => $apps->where('status', 'review')->count(),
            'shortlisted' => $apps->where('status', 'shortlisted')->count(),
            'interview_scheduled' => $apps->where('status', 'interview_scheduled')->count(),
            'selected' => $apps->where('status', 'selected')->count(),
            'rejected' => $apps->where('status', 'rejected')->count(),
        ];
    }

    private function buildDailyApplicationCounts(Collection $apps): Collection
    {
        return $apps
            ->groupBy(function ($a) {
                $createdAt = data_get($a, 'created_at');
                return $createdAt instanceof \DateTimeInterface ? $createdAt->format('Y-m-d') : 'unknown';
            })
            ->map(fn($a) => $a->count())
            ->sortKeys()
            ->take(-14);
    }

    private function normalizeUtf8(string $text): string
    {
        if (mb_check_encoding($text, 'UTF-8')) {
            return $text;
        }

        try {
            return mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        } catch (\Throwable $e) {
            Log::warning('Failed to normalize CV text to UTF-8', ['message' => $e->getMessage()]);
            return '';
        }
    }

    private function extractCvTextFromFile(UploadedFile $file): string
    {
        $path = $file->store('tmp_cv', 'local');
        $extension = strtolower((string) $file->getClientOriginalExtension());

        try {
            if ($extension === 'pdf') {
                $absolutePath = Storage::disk('local')->path($path);
                $parser = new Parser();
                $pdf = $parser->parseFile($absolutePath);
                $directText = $this->normalizeUtf8((string) $pdf->getText());

                if (trim($directText) !== '') {
                    return $directText;
                }

                return $this->extractPdfTextWithOcr($absolutePath);
            }

            return $this->normalizeUtf8((string) Storage::disk('local')->get($path));
        } catch (\Throwable $e) {
            Log::warning('CV file extraction failed', [
                'filename' => $file->getClientOriginalName(),
                'extension' => $extension,
                'message' => $e->getMessage(),
            ]);

            return '';
        } finally {
            Storage::disk('local')->delete($path);
        }
    }

    private function extractPdfTextWithOcr(string $pdfPath): string
    {
        if (! $this->commandExists('pdftoppm') || ! $this->commandExists('tesseract')) {
            Log::info('OCR fallback skipped: required binaries missing', [
                'has_pdftoppm' => $this->commandExists('pdftoppm'),
                'has_tesseract' => $this->commandExists('tesseract'),
            ]);

            return '';
        }

        $workDir = Storage::disk('local')->path('tmp_cv_ocr/' . Str::uuid()->toString());
        $dpi = max((int) config('services.ocr.dpi', 200), 72);
        $language = (string) config('services.ocr.language', 'eng');

        if (! is_dir($workDir)) {
            mkdir($workDir, 0755, true);
        }

        try {
            $render = new Process([
                'pdftoppm',
                '-r',
                (string) $dpi,
                '-png',
                $pdfPath,
                "{$workDir}/page",
            ]);
            $render->setTimeout(120);
            $render->run();

            if (! $render->isSuccessful()) {
                Log::warning('OCR fallback failed while rendering PDF pages', [
                    'error' => $render->getErrorOutput(),
                ]);

                return '';
            }

            $images = glob("{$workDir}/page-*.png") ?: [];
            sort($images);

            $chunks = [];

            foreach ($images as $image) {
                $ocr = new Process([
                    'tesseract',
                    $image,
                    'stdout',
                    '-l',
                    $language,
                    '--psm',
                    '6',
                ]);
                $ocr->setTimeout(90);
                $ocr->run();

                if ($ocr->isSuccessful()) {
                    $text = $this->normalizeUtf8((string) $ocr->getOutput());
                    if (trim($text) !== '') {
                        $chunks[] = trim($text);
                    }
                }
            }

            return implode("\n\n", $chunks);
        } catch (\Throwable $e) {
            Log::warning('OCR fallback exception', ['message' => $e->getMessage()]);
            return '';
        } finally {
            File::deleteDirectory($workDir);
        }
    }

    private function commandExists(string $command): bool
    {
        $process = new Process(['sh', '-lc', 'command -v ' . escapeshellarg($command) . ' >/dev/null 2>&1']);
        $process->setTimeout(5);
        $process->run();

        return $process->isSuccessful();
    }

    private function buildOrgStatusBreakdown(Collection $apps): array
    {
        $breakdown = [];
        foreach ($apps->groupBy(fn($a) => (string) data_get($a, 'opportunity.org', '?')) as $org => $orgApps) {
            $breakdown[$org] = [
                'pending' => $orgApps->where('status', 'pending')->count(),
                'review' => $orgApps->where('status', 'review')->count(),
                'shortlisted' => $orgApps->where('status', 'shortlisted')->count(),
                'interview_scheduled' => $orgApps->where('status', 'interview_scheduled')->count(),
                'selected' => $orgApps->where('status', 'selected')->count(),
                'rejected' => $orgApps->where('status', 'rejected')->count(),
                'total' => $orgApps->count(),
            ];
        }
        return $breakdown;
    }

    private function buildOppoStatusBreakdown(Collection $apps): array
    {
        $breakdown = [];
        foreach ($apps->groupBy('oppodb_id') as $oppoId => $oppoApps) {
            $oppoName = (string) data_get($oppoApps->first(), 'opportunity.oname', 'Unknown');
            $breakdown[$oppoName] = [
                'pending' => $oppoApps->where('status', 'pending')->count(),
                'review' => $oppoApps->where('status', 'review')->count(),
                'shortlisted' => $oppoApps->where('status', 'shortlisted')->count(),
                'interview_scheduled' => $oppoApps->where('status', 'interview_scheduled')->count(),
                'selected' => $oppoApps->where('status', 'selected')->count(),
                'rejected' => $oppoApps->where('status', 'rejected')->count(),
                'total' => $oppoApps->count(),
            ];
        }
        return $breakdown;
    }

    private function buildPerformanceMetrics(Collection $apps): array
    {
        $totalApps = max($apps->count(), 1);
        $totalAdvanced = $apps->whereIn('status', ['shortlisted', 'interview_scheduled', 'selected'])->count();
        $totalSelected = $apps->where('status', 'selected')->count();
        $totalRejected = $apps->where('status', 'rejected')->count();

        return [
            'avg_conversion_rate' => round(($totalSelected / $totalApps) * 100, 1),
            'avg_advancement_rate' => round(($totalAdvanced / $totalApps) * 100, 1),
            'avg_rejection_rate' => round(($totalRejected / $totalApps) * 100, 1),
            'interview_to_selection' => $apps->where('status', 'interview_scheduled')->count() > 0 
                ? round(($totalSelected / ($apps->where('status', 'interview_scheduled')->count() + $totalSelected)) * 100, 1)
                : 0,
        ];
    }
}