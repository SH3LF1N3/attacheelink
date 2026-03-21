<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Appdb;
use App\Models\Oppodb;
use App\Models\Permitdb;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'total_students'     => User::where('role', 'student')->count(),
            'total_companies'    => User::where('role', 'company')->count(),
            'total_oppo'         => Oppodb::count(),
            'total_apps'         => Appdb::count(),
            'pending_apps'       => Appdb::where('status', 'pending')->count(),
            'active_oppo'        => Oppodb::where('status', 'active')->count(),
            'recent_users'       => User::latest()->take(8)->get(),
            'recent_apps'        => Appdb::latest()->take(8)->get(),
        ];
    }

    private function studentStats(object $user): array
    {
        $base = Appdb::where('stud', $user->uname);

        return [
            'total_apps'    => (clone $base)->count(),
            'pending'       => (clone $base)->where('status', 'pending')->count(),
            'under_review'  => (clone $base)->where('status', 'review')->count(),
            'accepted'      => (clone $base)->where('status', 'accepted')->count(),
            'rejected'      => (clone $base)->where('status', 'rejected')->count(),
            'recent_apps'   => (clone $base)->latest()->take(6)->get(),
            'open_oppo'     => Oppodb::where('status', 'active')->latest()->take(5)->get(),
        ];
    }

    private function companyStats(object $user): array
    {
        $myOppo = Oppodb::where('org', $user->uname)->pluck('oname');

        return [
            'total_listings'   => Oppodb::where('org', $user->uname)->count(),
            'active_listings'  => Oppodb::where('org', $user->uname)->where('status', 'active')->count(),
            'total_apps'       => Appdb::where('org', $user->uname)->count(),
            'pending_apps'     => Appdb::where('org', $user->uname)->where('status', 'pending')->count(),
            'my_oppo'          => Oppodb::where('org', $user->uname)->latest()->take(6)->get(),
            'recent_apps'      => Appdb::where('org', $user->uname)->latest()->take(8)->get(),
        ];
    }
}