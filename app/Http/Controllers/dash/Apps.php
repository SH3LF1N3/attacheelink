<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Oppodb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Apps extends Controller
{
    /**
     * Admin / Company: list opportunities with applicant counts.
     */
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

    /**
     * Student: view their own submitted applications.
     */
    public function sappo()
    {
        $applications = Application::with('opportunity')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('dash.sappo', compact('applications'));
    }

    /**
     * Return opportunity data for the apply modal (AJAX).
     */
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

    /**
     * Submit a new application for an opportunity.
     */
    public function store(Request $request, Oppodb $oppo)
    {
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

        $cvPath = $request->file('cv')->store('cvs', 'local');

        Application::create([
            'user_id'         => Auth::id(),
            'oppodb_id'       => $oppo->id,
            'cv_path'         => $cvPath,
            'cover_letter'    => $request->cover_letter,
            'additional_info' => $request->additional_info,
            'status'          => 'pending',
        ]);

        return response()->json(['message' => 'Application submitted successfully.']);
    }

    /**
     * AJAX: return applicants for a given opportunity (company/admin).
     */
    public function applicants(Oppodb $oppo)
    {
        $user = Auth::user();

        if ($user->role === 'company' && $oppo->org !== $user->uname) {
            abort(403);
        }

        $applicants = Application::with('student')
            ->where('oppodb_id', $oppo->id)
            ->latest()
            ->get()
            ->map(function ($app) {
                return [
                    'id'         => $app->id,
                    'name'       => $app->student->fname ?? '—',
                    'email'      => $app->student->email ?? '—',
                    'phone'      => $app->student->phone ?? '—',
                    'sid'        => $app->student->sid   ?? '—',
                    'status'     => $app->status,
                    'applied_at' => $app->created_at->format('M d, Y'),
                ];
            });

        return response()->json([
            'opportunity' => $oppo->oname,
            'total'       => $applicants->count(),
            'applicants'  => $applicants,
        ]);
    }

    /**
     * AJAX: update an application status (shortlisted / rejected / pending / review).
     */
    public function updateStatus(Request $request, Application $application)
    {
        $user = Auth::user();

        if ($user->role === 'company') {
            if ($application->opportunity->org !== $user->uname) {
                abort(403);
            }
        }

        $request->validate([
            'status' => ['required', 'in:pending,review,shortlisted,rejected'],
        ]);

        $application->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated.', 'status' => $application->status]);
    }
}