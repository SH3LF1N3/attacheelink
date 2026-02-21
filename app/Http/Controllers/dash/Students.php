<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Students extends Controller
{
    public function students()
    {
        return view('dash.students');
    }
}
