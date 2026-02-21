<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Aitools extends Controller
{
    public function ass()
    {
        return view('dash.ai.tools');
    }

    public function check()
    {
        return view('dash.ai.check');
    }
}
