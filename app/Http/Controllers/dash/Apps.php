<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Appdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Apps extends Controller
{
    /**
     * Admin / Company: manage all or their own received applications.
     */
    public function app()
    {
        $user = Auth::user();

        // Admin sees all; company sees only applications to their org
        $applications = $user->role === 'admin'
            ? Appdb::latest()->paginate(20)
            : Appdb::where('org', $user->uname)->latest()->paginate(20);

        return view('dash.apps', compact('applications'));
    }

    /**
     * Student: view their own submitted applications.
     */
    public function sappo()
    {
        $user         = Auth::user();
        $applications = Appdb::where('stud', $user->uname)->latest()->paginate(20);
        return view('dash.sappo', compact('applications'));
    }
}