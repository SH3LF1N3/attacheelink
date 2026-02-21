<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Opportunity extends Controller
{
    public function oppo()
    {
        return view('dash.oppo');
    }
}
