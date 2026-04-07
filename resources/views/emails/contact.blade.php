@component('mail::message')
# New Contact Form Submission

Hello Admin,

A new contact form submission has been received. Here are the details:

**From:** {{ $fullName }}  
**Email:** {{ $userEmail }}  
@if($phone)
**Phone:** {{ $phone }}  
@endif
**Subject:** {{ $subject }}

---

## Message

{{ $message }}

---

@component('mail::button', ['url' => config('app.url')])
View in Dashboard
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
