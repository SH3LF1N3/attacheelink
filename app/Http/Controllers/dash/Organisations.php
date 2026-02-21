<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Organisations extends Controller
{
    public function org()
    {
        return view('dash.organisations');
    }
}
