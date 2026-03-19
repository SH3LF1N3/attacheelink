<?php

namespace App\Http\Controllers;

use App\Models\Oppodb;

class Home extends Controller
{
    public function index()
    {
        $featuredOpportunities = Oppodb::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredOpportunities'));
    }
}