<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Oppodb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Opportunity extends Controller
{
    /**
     * Admin / Company: manage all or their own opportunities.
     */
    public function oppo()
    {
        $user = Auth::user();

        // Admin sees all; company sees only their own
        $opportunities = $user->role === 'admin'
            ? Oppodb::latest()->paginate(20)
            : Oppodb::where('org', $user->uname)->latest()->paginate(20);

        return view('dash.oppo', compact('opportunities'));
    }

    /**
     * Student: browse open opportunities.
     */
    public function soppo()
    {
        $opportunities = Oppodb::where('status', 'active')->latest()->paginate(20);
        return view('dash.soppo', compact('opportunities'));
    }
}