<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Students extends Controller
{
    public function students(Request $request)
    {
        $query = User::where('role', 'student');

        if ($request->filled('search')) {
            $s = (string) $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('uname', 'like', "%$s%")
                  ->orWhere('fname', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', (string) $request->input('gender'));
        }

        $students = $query->latest()->paginate(15)->withQueryString();

        return view('dash.students', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uname'    => ['required', 'string', 'max:255', 'unique:users,uname'],
            'fname'    => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'gender'   => ['nullable', 'in:Male,Female,Rather Not Say'],
            'sid'      => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $plain = (string) $request->input('password');

        $student = User::create([
            'role'     => 'student',
            'uname'    => (string) $request->input('uname'),
            'fname'    => (string) $request->input('fname'),
            'email'    => (string) $request->input('email'),
            'phone'    => $request->input('phone'),
            'gender'   => $request->input('gender'),
            'sid'      => $request->input('sid'),
            'password' => Hash::make($plain),
        ]);

        // Send welcome notification + credentials email
        $mailSent = NotificationService::accountCreated($student, $plain);

        if (! $mailSent) {
            return back()->with('warning', 'Student added, but credential email was not delivered. Check Brevo SMTP settings.');
        }

        return back()->with('success', 'Student added successfully.');
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'uname'  => ['required', 'string', 'max:255', Rule::unique('users', 'uname')->ignore($student->getKey())],
            'fname'  => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', Rule::unique('users', 'email')->ignore($student->getKey())],
            'phone'  => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'in:Male,Female,Rather Not Say'],
            'sid'    => ['nullable', 'string', 'max:255'],
        ]);

        $data = $request->only('uname', 'fname', 'email', 'phone', 'gender', 'sid');

        if ($request->filled('password')) {
            $request->validate(['password' => ['string', 'min:8']]);
            $data['password'] = Hash::make((string) $request->input('password'));
        }

        $student->update($data);

        return back()->with('success', 'Student updated successfully.');
    }

    public function destroy(User $student)
    {
        abort_if((string) $student->getAttribute('role') !== 'student', 403);
        $student->delete();
        return back()->with('success', 'Student deleted successfully.');
    }
}