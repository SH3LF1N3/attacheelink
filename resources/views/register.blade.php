@extends('layouts.app')

@section('title', 'AttachKE – Create Account')

@section('content')

<section class="auth-page">
    <div class="auth-card auth-card-wide">

        <div class="auth-header">
            <div class="auth-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <h1 class="auth-title">Create your account</h1>
            <p class="auth-subtitle">Join thousands of Kenyan students and organizations</p>
        </div>

        {{-- Success flash --}}
        @if (session('success'))
            <div class="auth-alert auth-alert-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors — show all, not just first --}}
        @if ($errors->any())
            <div class="auth-alert auth-alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                </svg>
                <ul style="margin:0; padding-left:1.1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="auth-form" enctype="multipart/form-data">
            @csrf

            {{-- Role selector --}}
            <div class="auth-field">
                <label class="auth-label">I am a</label>
                <div class="auth-role-toggle">
                    <label class="auth-role-option">
                        <input type="radio" name="role" value="student" id="role_student"
                               {{ old('role', request('type')) === 'student' ? 'checked' : '' }} required />
                        <span>
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                            </svg>
                            Student
                        </span>
                    </label>
                    <label class="auth-role-option">
                        <input type="radio" name="role" value="company" id="role_company"
                               {{ old('role', request('type')) === 'company' ? 'checked' : '' }} />
                        <span>
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <path d="M8 21h8M12 17v4"/>
                            </svg>
                            Organization
                        </span>
                    </label>
                </div>
                @error('role')
                    <span class="auth-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-grid">

                <div class="auth-field">
                    <label class="auth-label" for="uname">Username</label>
                    <input id="uname" type="text" name="uname"
                           class="auth-input @error('uname') is-error @enderror"
                           value="{{ old('uname') }}" placeholder="Choose a username" required />
                    @error('uname')
                        <span class="auth-field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Student: full name --}}
                <div class="auth-field" id="field-fname">
                    <label class="auth-label" for="fname">Full Name</label>
                    <input id="fname" type="text" name="fname"
                           class="auth-input @error('fname') is-error @enderror"
                           value="{{ old('fname') }}" placeholder="Your full name" />
                    @error('fname')
                        <span class="auth-field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Company: org name (maps to same fname column) --}}
                <div class="auth-field" id="field-orgname" style="display:none;">
                    <label class="auth-label" for="orgname">Organization Name</label>
                    <input id="orgname" type="text" name="fname"
                           class="auth-input @error('fname') is-error @enderror"
                           value="{{ old('fname') }}" placeholder="Your organization name" />
                </div>

                <div class="auth-field">
                    <label class="auth-label" for="email">Email Address</label>
                    <input id="email" type="email" name="email"
                           class="auth-input @error('email') is-error @enderror"
                           value="{{ old('email') }}" placeholder="you@example.com" required />
                    @error('email')
                        <span class="auth-field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-field">
                    <label class="auth-label" for="phone">Phone Number</label>
                    <input id="phone" type="tel" name="phone"
                           class="auth-input @error('phone') is-error @enderror"
                           value="{{ old('phone') }}" placeholder="+254 7XX XXX XXX" required />
                    @error('phone')
                        <span class="auth-field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Student-only --}}
                <div class="auth-field" id="field-gender">
                    <label class="auth-label" for="gender">Gender</label>
                    <select id="gender" name="gender" class="auth-input auth-select">
                        <option value="">Select gender</option>
                        <option value="Male"   {{ old('gender') === 'Male'   ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="auth-field">
                    <label class="auth-label" for="password">Password</label>
                    <input id="password" type="password" name="password"
                           class="auth-input @error('password') is-error @enderror"
                           placeholder="Min. 8 characters" required />
                    @error('password')
                        <span class="auth-field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-field">
                    <label class="auth-label" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="auth-input" placeholder="Repeat your password" required />
                </div>

            </div>

            <div class="auth-row" style="margin-top:0.25rem;">
                <label class="auth-check">
                    <input type="checkbox" required />
                    <span>I agree to the <a href="#" class="auth-link">terms of service</a></span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary auth-submit">
                Create Account
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </form>

        <p class="auth-footer-text">
            Already have an account?
            <a href="{{ route('login') }}" class="auth-link">Sign in</a>
        </p>

    </div>
</section>

<script>
    const radios      = document.querySelectorAll('input[name="role"]');
    const fieldFname  = document.getElementById('field-fname');
    const fieldOrg    = document.getElementById('field-orgname');
    const fieldGender = document.getElementById('field-gender');

    function applyRole(role) {
        const isStudent = role === 'student';
        fieldFname.style.display  = isStudent ? '' : 'none';
        fieldOrg.style.display    = isStudent ? 'none' : '';
        fieldGender.style.display = isStudent ? '' : 'none';
    }

    radios.forEach(r => r.addEventListener('change', () => applyRole(r.value)));

    const checked = document.querySelector('input[name="role"]:checked');
    if (checked) applyRole(checked.value);
</script>

@endsection