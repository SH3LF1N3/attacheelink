<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Oppodb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Apps extends Controller
{
    /**
     * Admin / Company: manage all or their own received applications.
     */
    public function app()
    {
        $user  = Auth::user();
        $query = Application::with(['opportunity', 'student']);

        if ($user->role === 'company') {
            // Company sees only applications linked to their opportunities
            $query->whereHas('opportunity', function ($q) use ($user) {
                $q->where('org', $user->uname);
            });
        }
        // Admin falls through with no extra filter — sees everything

        $applications = $query->latest()->paginate(20);

        return view('dash.apps', compact('applications'));
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
     * Also flags whether the authenticated student has already applied.
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
        // Prevent duplicate applications
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
}