<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Permitdb;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    /**
     * Single dashboard for all roles.
     * The view receives $permit and uses its flags to show/hide sections.
     */
    public function dash()
    {
        $user   = Auth::user();
        $permit = Permitdb::where('rname', $user->role)->first();

        // If no permit row exists yet, deny access gracefully
        if (! $permit) {
            abort(403, 'Your account has no permissions assigned. Please contact an administrator.');
        }

        return view('dash.dashboard', compact('user', 'permit'));
    }

    public function profile()
    {
        $user   = Auth::user();
        $permit = Permitdb::where('rname', $user->role)->first();

        return view('dash.profile', compact('user', 'permit'));
    }
}