<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Appdb;
use App\Models\Application;
use App\Models\Oppodb;
use App\Models\Permitdb;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Dashboard extends Controller
{
    public function dash()
    {
        $user   = Auth::user();
        $permit = Permitdb::where('rname', $user->role)->first();

        if (! $permit) {
            abort(403, 'Your account has no permissions assigned. Please contact an administrator.');
        }

        $stats = match ($user->role) {
            'admin'   => $this->adminStats(),
            'student' => $this->studentStats($user),
            'company' => $this->companyStats($user),
            default   => [],
        };

        return view('dash.dashboard', compact('user', 'permit', 'stats'));
    }

    public function profile()
    {
        $user   = Auth::user();
        $permit = Permitdb::where('rname', $user->role)->first();
        return view('dash.profile', compact('user', 'permit'));
    }

    // ── Role stat builders ────────────────────────────────────────────────────

    private function adminStats(): array
    {
        return [
            'total_students'  => User::where('role', 'student')->count(),
            'total_companies' => User::where('role', 'company')->count(),
            'total_oppo'      => Oppodb::count(),
            'total_apps'      => Appdb::count(),
            'pending_apps'    => Appdb::where('status', 'pending')->count(),
            'active_oppo'     => Oppodb::where('status', 'active')->count(),
            'recent_users'    => User::latest()->take(8)->get(),
            'recent_apps'     => Appdb::latest()->take(8)->get(),
        ];
    }

    private function studentStats(object $user): array
    {
        $base = Application::where('user_id', $user->id);

        // Opportunities the student hasn't applied to yet, ordered by deadline
        $appliedIds    = Application::where('user_id', $user->id)->pluck('oppodb_id');
        $recommended   = Oppodb::where('status', 'active')
                            ->whereNotIn('id', $appliedIds)
                            ->orderBy('dead')
                            ->take(5)
                            ->get();

        // Active opportunities expiring within the next 7 days
        $upcomingDeadlines = Oppodb::where('status', 'active')
                                ->whereBetween('dead', [Carbon::today(), Carbon::today()->addDays(7)])
                                ->orderBy('dead')
                                ->take(5)
                                ->get();

        return [
            'total_apps'        => (clone $base)->count(),
            'under_review'      => (clone $base)->where('status', 'review')->count(),
            'shortlisted'       => (clone $base)->where('status', 'shortlisted')->count(),
            'rejected'          => (clone $base)->where('status', 'rejected')->count(),
            'recommended'       => $recommended,
            'upcoming_deadlines'=> $upcomingDeadlines,
        ];
    }

    private function companyStats(object $user): array
    {
        $oppoIds = Oppodb::where('org', $user->uname)->pluck('id');

        return [
            'total_listings'  => Oppodb::where('org', $user->uname)->count(),
            'active_listings' => Oppodb::where('org', $user->uname)->where('status', 'active')->count(),
            'total_apps'      => Application::whereIn('oppodb_id', $oppoIds)->count(),
            'pending_apps'    => Application::whereIn('oppodb_id', $oppoIds)->where('status', 'pending')->count(),
            'my_oppo'         => Oppodb::where('org', $user->uname)->latest()->take(6)->get(),
            'recent_apps'     => Application::with(['opportunity', 'student'])
                                    ->whereIn('oppodb_id', $oppoIds)
                                    ->latest()
                                    ->take(8)
                                    ->get(),
        ];
    }
}