<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Notifications extends Controller
{
    public function notify()
    {
        return view('dash.notifications');
    }
}
