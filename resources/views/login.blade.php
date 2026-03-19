@extends('layouts.app')

@section('title', 'AttachKE – Sign In')

@section('content')
<section class="auth-page">
    <div class="auth-card">

        <div class="auth-header">
            <div class="auth-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                    <path d="M8 21h8M12 17v4"/>
                </svg>
            </div>
            <h1 class="auth-title">Welcome back</h1>
            <p class="auth-subtitle">Sign in to your AttachKE account</p>
        </div>

        {{-- Success flash (from register or logout) --}}
        @if (session('success'))
            <div class="auth-alert auth-alert-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation / auth errors --}}
        @if ($errors->any())
            <div class="auth-alert auth-alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="auth-form">
            @csrf

            <div class="auth-field">
                <label class="auth-label" for="email">Email Address</label>
                <div class="auth-input-wrap">
                    <svg class="auth-input-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/>
                    </svg>
                    <input id="email" type="email" name="email"
                           class="auth-input @error('email') is-error @enderror"
                           value="{{ old('email') }}" placeholder="you@example.com"
                           required autofocus />
                </div>
            </div>

            <div class="auth-field">
                <label class="auth-label" for="password">Password</label>
                <div class="auth-input-wrap">
                    <svg class="auth-input-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input id="password" type="password" name="password"
                           class="auth-input" placeholder="••••••••" required />
                </div>
            </div>

            <div class="auth-row">
                <label class="auth-check">
                    <input type="checkbox" name="remember" />
                    <span>Remember me</span>
                </label>
                <a href="#" class="auth-link">Forgot password?</a>
            </div>

            <button type="submit" class="btn btn-primary auth-submit">
                Sign In
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </form>

        <p class="auth-footer-text">
            Don't have an account?
            <a href="{{ route('register') }}" class="auth-link">Create one free</a>
        </p>

    </div>
</section>
@endsection