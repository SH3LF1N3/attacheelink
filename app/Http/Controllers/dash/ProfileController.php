<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Permitdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fname'    => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone'    => ['nullable', 'string', 'max:20'],
            'gender'   => ['nullable', 'in:Male,Female,Other'],
            'foth1'    => ['nullable', 'string', 'max:255'], // course
            'foth2'    => ['nullable', 'string', 'max:255'], // university
            'foth3'    => ['nullable', 'string', 'max:255'], // county
            'foth4'    => ['nullable', 'string', 'max:255'], // address
            'foth5'    => ['nullable', 'string', 'max:50'],  // year of study
            'foth6'    => ['nullable', 'string', 'max:20'],  // graduation
            'foth7'    => ['nullable', 'string'],            // bio
            'foth8'    => ['nullable', 'string'],            // skills
        ]);

        // Merge first + last name into fname column
        $fname = trim($request->fname . ' ' . $request->lname);

        $user->update([
            'fname'  => $fname,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'gender' => $request->gender,
            'foth1'  => $request->foth1,
            'foth2'  => $request->foth2,
            'foth3'  => $request->foth3,
            'foth4'  => $request->foth4,
            'foth5'  => $request->foth5,
            'foth6'  => $request->foth6,
            'foth7'  => $request->foth7,
            'foth8'  => $request->foth8,
        ]);

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile')
            ->with('success', 'Password changed successfully.');
    }
}