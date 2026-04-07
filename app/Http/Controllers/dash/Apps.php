<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Interview;
use App\Models\Oppodb;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Apps extends Controller
{
    public function app()
    {
        $user  = Auth::user();
        $query = Oppodb::withCount('applications');

        if ($user->role === 'company') {
            $query->where('org', $user->uname);
        }

        $opportunities = $query->latest()->paginate(20);
        return view('dash.apps', compact('opportunities'));
    }

    public function sappo()
    {
        // ── Check profile completion ──
        $user = auth()->user();
        $isProfileComplete = $user->fname && $user->foth1 && $user->foth2 && $user->foth3 && $user->phone && $user->gender;
        
        if (!$isProfileComplete) {
            return redirect()->route('profile')
                           ->with('redirected_incomplete', true)
                           ->with('message', 'Please complete your profile before managing applications.');
        }

        $applications = Application::with('opportunity')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('dash.sappo', compact('applications'));
    }

    public function show(Oppodb $oppo)
    {
        $alreadyApplied = Application::where('user_id', Auth::id())
            ->where('oppodb_id', $oppo->id)
            ->exists();

        return response()->json([
            'id'              => $oppo->id,
            'oname'           => $oppo->oname,
            'org'             => $oppo->org,
            'loc'             => $oppo->loc,
            'duration'        => $oppo->duration,
            'dead'            => $oppo->dead,
            'already_applied' => $alreadyApplied,
        ]);
    }

    public function store(Request $request, Oppodb $oppo)
    {
        // Block applications past deadline
        if ($oppo->dead && \Carbon\Carbon::parse($oppo->dead)->isPast()) {
            return response()->json(
                ['message' => 'The application deadline for this opportunity has passed.'],
                422
            );
        }

        $exists = Application::where('user_id', Auth::id())
            ->where('oppodb_id', $oppo->id)
            ->exists();

        if ($exists) {
            return response()->json(
                ['message' => 'You have already applied for this opportunity.'],
                409
            );
        }

        $request->validate([
            'cv'              => ['required', 'file', 'mimes:pdf,docx', 'max:2048'],
            'cover_letter'    => ['nullable', 'string', 'max:3000'],
            'additional_info' => ['nullable', 'string', 'max:2000'],
        ]);

        $cvFile = $request->file('cv');
        $cvPath = $cvFile->store('cvs', 'local');
        $cvOriginalName = $cvFile->getClientOriginalName();

        Application::create([
            'user_id'         => Auth::id(),
            'oppodb_id'       => $oppo->id,
            'cv_path'         => $cvPath,
            'cv_original_name' => $cvOriginalName,
            'cover_letter'    => $request->cover_letter,
            'additional_info' => $request->additional_info,
            'status'          => 'pending',
        ]);

        // Notify the company
        $student     = Auth::user();
        $companyUser = \App\Models\User::where('uname', $oppo->org)->first();
        if ($companyUser) {
            NotificationService::newApplication(
                $companyUser->uname,
                $student->fname ?? $student->email,
                $oppo->oname,
                $student->uname
            );
        }

        return response()->json(['message' => 'Application submitted successfully.']);
    }

    public function applicants(Oppodb $oppo)
    {
        $user = Auth::user();

        if ($user->role === 'company' && $oppo->org !== $user->uname) {
            abort(403);
        }

        $applicants = Application::with(['student', 'interview'])
            ->where('oppodb_id', $oppo->id)
            ->latest()
            ->get()
            ->map(function ($app) {
                return [
                    'id'         => $app->id,
                    'name'       => $app->student->fname ?? explode('@', $app->student->email)[0] ?? '—',
                    'email'      => $app->student->email ?? '—',
                    'phone'      => $app->student->phone ?? '—',
                    'course'     => $app->student->foth1 ?? null,
                    'university' => $app->student->foth2 ?? null,
                    'year'       => $app->student->foth5 ?? null,
                    'status'     => $app->status,
                    'applied_at' => $app->created_at->format('M d, Y'),
                    'interview'  => $app->interview ? [
                        'date'             => $app->interview->interview_date->format('M d, Y'),
                        'time'             => $app->interview->interview_time,
                        'type'             => $app->interview->type,
                        'location_or_link' => $app->interview->location_or_link,
                    ] : null,
                ];
            });

        return response()->json([
            'opportunity' => $oppo->oname,
            'total'       => $applicants->count(),
            'applicants'  => $applicants,
        ]);
    }

    public function detail(Application $application)
    {
        $user = Auth::user();

        // Authorization: Students can only view their own applications
        if ($user->role === 'student') {
            if ($application->user_id !== $user->id) abort(403);
        }
        // Companies can only view applications to their own opportunities
        elseif ($user->role === 'company') {
            if ($application->opportunity->org !== $user->uname) abort(403);
        }
        // Admins can view all

        $application->load(['student', 'opportunity', 'interview']);

        return response()->json([
            'id'              => $application->id,
            'status'          => $application->status,
            'applied_at'      => $application->created_at->format('M d, Y'),
            'cover_letter'    => $application->cover_letter,
            'additional_info' => $application->additional_info,
            'cv_filename'     => $application->cv_original_name ?? ($application->cv_path ? basename($application->cv_path) : null),
            'cv_url'          => $application->cv_path
                                ? route('cv.download', $application->id)
                                : null,
            'student' => [
                'name'       => $application->student->fname
                                ?? explode('@', $application->student->email)[0]
                                ?? '—',
                'email'      => $application->student->email  ?? '—',
                'phone'      => $application->student->phone  ?? '—',
                'course'     => $application->student->foth1  ?? null,
                'university' => $application->student->foth2  ?? null,
                'year'       => $application->student->foth5  ?? null,
            ],
            'opportunity' => [
                'oname' => $application->opportunity->oname ?? '—',
            ],
            'interview' => $application->interview ? [
                'date'             => $application->interview->interview_date->format('M d, Y'),
                'time'             => $application->interview->interview_time,
                'type'             => $application->interview->type,
                'location_or_link' => $application->interview->location_or_link,
                'notes'            => $application->interview->notes,
            ] : null,
        ]);
    }

    public function updateStatus(Request $request, Application $application)
    {
        $user = Auth::user();

        if ($user->role === 'company') {
            if ($application->opportunity->org !== $user->uname) abort(403);
        }

        $request->validate([
            'status' => ['required', 'in:pending,review,shortlisted,interview_scheduled,selected,rejected'],
        ]);

        $oldStatus = $application->status;
        $application->update(['status' => $request->status]);

        if ($oldStatus !== $request->status) {
            NotificationService::statusChangedByUname(
                $application->student->uname,
                $application->opportunity->oname,
                $application->opportunity->org,
                $request->status,
                Auth::user()->uname
            );
        }

        return response()->json([
            'message' => 'Status updated.',
            'status'  => $application->status,
        ]);
    }

    public function scheduleInterview(Request $request, Application $application)
    {
        $user = Auth::user();

        if ($user->role === 'company') {
            if ($application->opportunity->org !== $user->uname) abort(403);
        }

        $request->validate([
            'interview_date'   => ['required', 'date', 'after_or_equal:today'],
            'interview_time'   => ['required', 'date_format:H:i'],
            'type'             => ['required', 'in:physical,online'],
            'location_or_link' => ['nullable', 'string', 'max:500'],
            'notes'            => ['nullable', 'string', 'max:1000'],
        ]);

        // Check if interview already exists
        $existingInterview = Interview::where('application_id', $application->id)->first();
        $isNewInterview = !$existingInterview;

        $interview = Interview::updateOrCreate(
            ['application_id' => $application->id],
            [
                'interview_date'   => $request->interview_date,
                'interview_time'   => $request->interview_time,
                'type'             => $request->type,
                'location_or_link' => $request->location_or_link,
                'notes'            => $request->notes,
            ]
        );

        $application->update(['status' => 'interview_scheduled']);

        // Only send notifications if this is a NEW interview (not an update)
        if ($isNewInterview) {
            $typeLabel       = $request->type === 'physical' ? 'Physical' : 'Online';
            $locationLabel   = $request->type === 'physical' ? 'Location' : 'Meeting Link';
            $locationValue   = $request->location_or_link ?? 'TBD';
            $notifMessage    = "Your interview for \"{$application->opportunity->oname}\" at {$application->opportunity->org} has been scheduled."
                . "\n📅 Date: {$request->interview_date}"
                . "\n🕐 Time: {$request->interview_time}"
                . "\n📌 Type: {$typeLabel}"
                . ($request->location_or_link ? "\n{$locationLabel}: {$request->location_or_link}" : "")
                . ($request->notes ? "\n📝 Notes: {$request->notes}" : "");

            // Send in-app notification
            \App\Models\Notifydb::send(
                $application->student->uname,
                'Interview Scheduled 📅',
                $notifMessage,
                $user->uname
            );

            // Send email notification with interview details
            NotificationService::interviewScheduled(
                $application->student,
                $application->opportunity->oname,
                $application->opportunity->org,
                $request->interview_date,
                $request->interview_time,
                $request->type,
                $request->location_or_link,
                $request->notes,
            );
        }

        return response()->json(['message' => 'Interview scheduled.', 'status' => 'interview_scheduled']);
    }

    public function selectCandidate(Application $application)
    {
        $user = Auth::user();

        if ($user->role === 'company') {
            if ($application->opportunity->org !== $user->uname) abort(403);
        }

        $application->update(['status' => 'selected']);

        NotificationService::statusChangedByUname(
            $application->student->uname,
            $application->opportunity->oname,
            $application->opportunity->org,
            'selected',
            $user->uname
        );

        return response()->json(['message' => 'Candidate selected.', 'status' => 'selected']);
    }

    public function cvDownload(Application $application)
    {
        $user = Auth::user();

        // Only company who owns the opportunity or admin can download
        if ($user->role === 'company') {
            if ($application->opportunity->org !== $user->uname) abort(403);
        }

        if (! $application->cv_path || ! Storage::disk('local')->exists($application->cv_path)) {
            abort(404, 'CV file not found.');
        }

        $downloadName = $application->cv_original_name ?? basename($application->cv_path);
        $isPreview = request()->query('preview') === 'true';
        
        if ($isPreview) {
            // Return file as inline (for preview in iframe)
            return Storage::disk('local')->response(
                $application->cv_path,
                $downloadName,
                ['Content-Type' => $this->getContentType($application->cv_path)],
                'inline'  // Display inline instead of download
            );
        } else {
            // Return file as download
            return Storage::disk('local')->download(
                $application->cv_path,
                $downloadName
            );
        }
    }

    /**
     * Get MIME type for a file
     */
    private function getContentType(string $filePath): string
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        $mimeTypes = [
            'pdf'  => 'application/pdf',
            'txt'  => 'text/plain',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'doc'  => 'application/msword',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xls'  => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'ppt'  => 'application/vnd.ms-powerpoint',
        ];
        
        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }
}