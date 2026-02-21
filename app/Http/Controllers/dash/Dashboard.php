<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function dash()
    {
        return view('dash.dashboard');
    }

    public function profile()
    {
        return view('dash.profile');
    }
    
}
