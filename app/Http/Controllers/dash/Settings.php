<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Logsdb;
use App\Models\Permitdb;
use App\Models\Setdb;
use Illuminate\Http\Request;

class Settings extends Controller
{
    // Permission Settings

    public function permit()
    {
        $roles = Permitdb::orderBy('rname')->get();
        return view('dash.set.permit', compact('roles'));
    }

    public function permitUpdate(Request $request, $id)
    {
        $permit = Permitdb::findOrFail($id);

        $flags = [
            'oppo',  'app',   'soppo', 'sappo',
            'ait',   'air',   'aia',
            'stud',  'org',   'not',   'rep',   'prof',  'set',
            'astud', 'estud', 'aorg',  'eorg',  'aoppo', 'eoppo',
        ];

        // Checkboxes not submitted = false; submitted = true
        $data = collect($flags)->mapWithKeys(fn($f) => [$f => $request->boolean($f)])->all();

        $permit->update($data);

        return back()->with('success', "Permissions for '{$permit->rname}' updated successfully.");
    }

    // System Logs 

    public function logs(Request $request)
    {
        $query = Logsdb::latest();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('service')) {
            $query->where('service', 'like', '%' . $request->service . '%');
        }

        $logs  = $query->paginate(20)->withQueryString();
        $roles = Logsdb::select('role')->distinct()->pluck('role')->filter()->sort()->values();

        return view('dash.set.logs', compact('logs', 'roles'));
    }

    public function logsClear()
    {
        Logsdb::truncate();
        return back()->with('success', 'All system logs have been cleared.');
    }

    // General Settings 

    public function gen()
    {
        // Always work with a single settings row
        $settings = Setdb::firstOrCreate([]);
        return view('dash.set.gen', compact('settings'));
    }

    public function genUpdate(Request $request)
    {
        $request->validate([
            'sname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'logo'  => ['nullable', 'image', 'max:2048'],
        ]);

        $settings = Setdb::firstOrCreate([]);

        $data = $request->only('sname', 'email');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $settings->update($data);

        return back()->with('success', 'General settings updated successfully.');
    }
}