<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Settings extends Controller
{
    
    public function permit()
    {
        return view('dash.set.permit');
    }

    public function logs()
    {
        return view('dash.set.logs');
    }
    
    public function gen()
    {
        return view('dash.set.gen');
    }
    
}
