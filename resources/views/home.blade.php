@extends('layouts.app')

@section('title', 'AttachKE – Connecting Kenyan Students to Meaningful Attachments')

@section('content')

    {{-- ── HERO ── --}}
    <section class="hero">
        <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?w=1600&q=80');"></div>
        <div class="hero-content">
            <span class="hero-badge">Official University Portal</span>
            <h1 class="hero-title">
                Connecting Kenyan<br>
                Students to <span class="accent">Meaningful<br>Attachments</span>
            </h1>
            <p class="hero-subtitle">
                The centralized platform for university students to find industrial
                attachment opportunities across Kenya's leading organizations.
            </p>
            <div class="hero-cta">
                <a href="{{ route('register') }}?type=student" class="btn btn-gold">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    Student Sign Up
                </a>
                <a href="{{ route('register') }}?type=organization" class="btn btn-outline-white">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="2" y="3" width="20" height="14" rx="2"/>
                        <path d="M8 21h8M12 17v4"/>
                    </svg>
                    Organization Sign Up
                </a>
            </div>
        </div>
    </section>

    {{-- ── STATS ── --}}
    <section class="stats">
        <div class="stat">
            <div class="stat-number">50+</div>
            <div class="stat-label">Partner Universities</div>
        </div>
        <div class="stat">
            <div class="stat-number">2,000+</div>
            <div class="stat-label">Active Opportunities</div>
        </div>
        <div class="stat">
            <div class="stat-number">47</div>
            <div class="stat-label">Counties Covered</div>
        </div>
    </section>

    {{-- ── FEATURED OPPORTUNITIES ── --}}
    <section class="opportunities">
        <div class="opportunities-inner">

            <div class="section-header">
                <div>
                    <h2 class="section-title">Featured Opportunities</h2>
                    <p class="section-subtitle">Latest attachments posted by verified organizations</p>
                </div>
                <a href="{{ url('/opportunities') }}" class="view-all">
                    View All
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="opportunities-grid">
                @foreach ($featuredOpportunities as $opportunity)
                    @include('partials.opportunity-card', ['opportunity' => $opportunity])
                @endforeach
            </div>

        </div>
    </section>

@endsection