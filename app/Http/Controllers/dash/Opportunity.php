<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Oppodb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Opportunity extends Controller
{
    private function authoriseCompany()
    {
        if (Auth::user()->role !== 'company') {
            abort(403, 'Only organisations can manage opportunities.');
        }
    }

    private function authoriseOwner(Oppodb $oppo)
    {
        if ($oppo->org !== Auth::user()->uname) {
            abort(403, 'You do not own this opportunity.');
        }
    }

    // ── Admin / Company: listing with search & filter ─────────────────────────

    public function oppo(Request $request)
    {
        $user  = Auth::user();
        $query = Oppodb::query();

        // Company sees only their own; admin sees all
        if ($user->role !== 'admin') {
            $query->where('org', $user->uname);
        }

        // Search filters
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('oname', 'like', "%{$q}%")
                    ->orWhere('org',   'like', "%{$q}%")
                    ->orWhere('descr', 'like', "%{$q}%");
            });
        }
        if ($request->filled('loc'))  $query->where('loc',   $request->loc);
        if ($request->filled('dept')) $query->where('foth1', $request->dept);

        $opportunities = $query->latest()->paginate(12);

        return view('dash.oppo', compact('opportunities'));
    }

    // ── Student: browse active ────────────────────────────────────────────────

    public function soppo(Request $request)
    {
        // ── Check profile completion (students only) ──
        $user = auth()->user();
        if ($user->role === 'student') {
            $isProfileComplete = $user->fname && $user->foth1 && $user->foth2 && $user->foth3 && $user->phone && $user->gender;
            
            if (!$isProfileComplete) {
                return redirect()->route('profile')
                               ->with('redirected_incomplete', true)
                               ->with('message', 'Please complete your profile before browsing opportunities.');
            }
        }

        // Auto-close opportunities past their deadline
        Oppodb::where('status', 'active')
              ->whereDate('dead', '<', now()->toDateString())
              ->update(['status' => 'closed']);

        $query = Oppodb::where('status', 'active');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('oname', 'like', "%{$q}%")
                    ->orWhere('org',   'like', "%{$q}%")
                    ->orWhere('descr', 'like', "%{$q}%");
            });
        }
        if ($request->filled('loc'))  $query->where('loc',   $request->loc);
        if ($request->filled('dept')) $query->where('foth1', $request->dept);

        $opportunities = $query->latest()->paginate(12);

        return view('dash.soppo', compact('opportunities'));
    }

    // ── Create ────────────────────────────────────────────────────────────────

    public function create()
    {
        $this->authoriseCompany();
        return view('dash.oppo-create');
    }

    // ── Store ─────────────────────────────────────────────────────────────────

    public function store(Request $request)
    {
        $this->authoriseCompany();

        $validated = $request->validate([
            'oname'    => ['required', 'string', 'max:255'],
            'foth1'    => ['required', 'string'],
            'loc'      => ['required', 'string'],
            'descr'    => ['required', 'string', 'min:10'],
            'dead'     => ['required', 'date'],
            'slot'     => ['required', 'integer', 'min:1'],
            'duration' => ['nullable', 'string', 'max:100'],
        ]);

        Oppodb::create([
            'oname'    => $validated['oname'],
            'org'      => Auth::user()->uname,
            'loc'      => $validated['loc'],
            'duration' => $validated['duration'] ?? null,
            'dead'     => $validated['dead'],
            'slot'     => $validated['slot'],
            'descr'    => $validated['descr'],
            'status'   => 'active',
            'foth1'    => $validated['foth1'],
        ]);

        return redirect()->route('opportunities')
            ->with('success', 'Opportunity posted successfully.');
    }

    // ── Edit ──────────────────────────────────────────────────────────────────

    public function edit(Oppodb $oppo)
    {
        $this->authoriseCompany();
        $this->authoriseOwner($oppo);
        return view('dash.oppo-edit', compact('oppo'));
    }

    // ── Update ────────────────────────────────────────────────────────────────

    public function update(Request $request, Oppodb $oppo)
    {
        $this->authoriseCompany();
        $this->authoriseOwner($oppo);

        $validated = $request->validate([
            'oname'    => ['required', 'string', 'max:255'],
            'foth1'    => ['required', 'string'],
            'loc'      => ['required', 'string'],
            'descr'    => ['required', 'string', 'min:10'],
            'dead'     => ['required', 'date'],
            'slot'     => ['required', 'integer', 'min:1'],
            'duration' => ['nullable', 'string', 'max:100'],
            'status'   => ['required', 'in:active,closed,draft'],
        ]);

        $oppo->update([
            'oname'    => $validated['oname'],
            'foth1'    => $validated['foth1'],
            'loc'      => $validated['loc'],
            'descr'    => $validated['descr'],
            'dead'     => $validated['dead'],
            'slot'     => $validated['slot'],
            'duration' => $validated['duration'] ?? $oppo->duration,
            'status'   => $validated['status'],
        ]);

        return redirect()->route('opportunities')
            ->with('success', 'Opportunity updated successfully.');
    }

    // ── Delete ────────────────────────────────────────────────────────────────

    public function destroy(Oppodb $oppo)
    {
        $this->authoriseCompany();
        $this->authoriseOwner($oppo);
        $oppo->delete();

        return redirect()->route('opportunities')
            ->with('success', 'Opportunity deleted.');
    }
}