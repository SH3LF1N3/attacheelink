<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Apps extends Controller
{
        public function app()
        {
            return view('dash.apps');
        }
}
