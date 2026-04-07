<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Controller
{
    public function index()
    {
        return view('contactus');
    }

    public function send(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'full_name' => 'required|string|min:2|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'subject'   => 'required|in:general,student,organisation,technical,partnership,other',
            'message'   => 'required|string|min:10|max:5000',
        ]);

        try {
            // Store contact message in database
            $contact = Contact::create($validated);

            // Send email notification to admin
            $adminEmail = config('mail.from.address') ?? 'support@attachke.ac.ke';
            
            Mail::to($adminEmail)->send(new ContactMail(
                fullName: $validated['full_name'],
                userEmail: $validated['email'],
                phone: $validated['phone'] ?? 'N/A',
                subject: $validated['subject'],
                message: $validated['message'],
            ));

            return redirect()->route('contactus')
                ->with('success', 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.');
        } catch (\Exception $e) {
            return redirect()->route('contactus')
                ->withErrors(['message' => 'An error occurred while sending your message. Please try again later.']);
        }
    }
}
