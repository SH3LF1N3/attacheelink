<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Settings extends Controller
{
    public function settings()
    {
        return view('dash.settings');
    }
    public function permit()
    {
        return view('dash.permission_settings');
    }
}
