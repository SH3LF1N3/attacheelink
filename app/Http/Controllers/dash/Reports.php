<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Reports extends Controller
{
    public function reports()
    {
        return view('dash.reports');
    }
}
