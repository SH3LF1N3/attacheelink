<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Organisations extends Controller
{
    public function org(Request $request)
    {
        $query = User::where('role', 'company');

        if ($request->filled('search')) {
            $s = (string) $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('uname',  'like', "%$s%")
                  ->orWhere('fname', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%")
                  ->orWhere('foth1', 'like', "%$s%");
            });
        }

        $orgs = $query->latest()->paginate(15)->withQueryString();

        return view('dash.organisations', compact('orgs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uname'    => ['required', 'string', 'max:255', 'unique:users,uname'],
            'fname'    => ['required', 'string', 'max:255'],
            'foth1'    => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'foth2'    => ['nullable', 'string', 'max:255'],
            'foth3'    => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $plain = (string) $request->input('password');

        $org = User::create([
            'role'     => 'company',
            'uname'    => (string) $request->input('uname'),
            'fname'    => (string) $request->input('fname'),
            'foth1'    => (string) $request->input('foth1'),
            'email'    => (string) $request->input('email'),
            'phone'    => $request->input('phone'),
            'foth2'    => $request->input('foth2'),
            'foth3'    => $request->input('foth3'),
            'password' => Hash::make($plain),
        ]);

        // Send welcome notification + credentials email
        $mailSent = NotificationService::accountCreated($org, $plain);

        if (! $mailSent) {
            return back()->with('warning', 'Organisation added, but credential email was not delivered. Check Brevo SMTP settings.');
        }

        return back()->with('success', 'Organisation added successfully.');
    }

    public function update(Request $request, User $organisation)
    {
        abort_if((string) $organisation->getAttribute('role') !== 'company', 403);

        $request->validate([
            'uname' => ['required', 'string', 'max:255', Rule::unique('users', 'uname')->ignore($organisation->getKey())],
            'fname' => ['required', 'string', 'max:255'],
            'foth1' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($organisation->getKey())],
            'phone' => ['nullable', 'string', 'max:20'],
            'foth2' => ['nullable', 'string', 'max:255'],
            'foth3' => ['nullable', 'string', 'max:255'],
        ]);

        $data = $request->only('uname', 'fname', 'foth1', 'email', 'phone', 'foth2', 'foth3');

        if ($request->filled('password')) {
            $request->validate(['password' => ['string', 'min:8']]);
            $data['password'] = Hash::make((string) $request->input('password'));
        }

        $organisation->update($data);

        return back()->with('success', 'Organisation updated successfully.');
    }

    public function destroy(User $organisation)
    {
        abort_if((string) $organisation->getAttribute('role') !== 'company', 403);
        $organisation->delete();
        return back()->with('success', 'Organisation deleted successfully.');
    }
}