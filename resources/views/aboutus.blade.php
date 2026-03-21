@extends('layouts.app')

@section('title', 'About Us – AttachKE')

@section('content')

{{-- ── BANNER ─────────────────────────────────────────────────────────────── --}}
<section class="about-banner">
    <div class="about-banner-inner">
        <span class="hero-badge">About AttachKE</span>
        <h1 class="about-banner-title">
            Bridging the Gap Between<br>
            <span class="accent">Education &amp; Industry</span>
        </h1>
        <p class="about-banner-desc">
            AttachKE is Kenya's centralized platform connecting university students with industrial
            attachment opportunities across all 47 counties.
        </p>
    </div>
</section>

{{-- ── MISSION ────────────────────────────────────────────────────────────── --}}
<section class="about-mission">
    <div class="about-mission-inner">

        {{-- Left: text --}}
        <div class="about-mission-text">
            <h2>Our Mission</h2>
            <p>
                Every year, thousands of Kenyan university students struggle to find quality industrial
                attachment placements. The process is fragmented — students rely on personal connections,
                walk-ins, and outdated notice boards.
            </p>
            <p>
                AttachKE was built to change that. We provide a single, trusted platform where verified
                organizations post attachment opportunities and students can discover, apply, and track
                their applications — all in one place.
            </p>
            <p>
                Our goal is to ensure every student, regardless of their university or county, has equal
                access to meaningful professional experiences that prepare them for the workforce.
            </p>
        </div>

        {{-- Right: feature cards --}}
        <div class="about-features-grid">

            <div class="about-feature-card">
                <div class="about-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v4l3 3"/>
                    </svg>
                </div>
                <div class="about-feature-title">Equal Access</div>
                <div class="about-feature-desc">Opportunities across all 47 counties, not just Nairobi.</div>
            </div>

            <div class="about-feature-card">
                <div class="about-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4"/>
                        <path d="M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z"/>
                    </svg>
                </div>
                <div class="about-feature-title">Verified Orgs</div>
                <div class="about-feature-desc">Every organization is vetted before posting opportunities.</div>
            </div>

            <div class="about-feature-card">
                <div class="about-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"/>
                    </svg>
                </div>
                <div class="about-feature-title">Nationwide Reach</div>
                <div class="about-feature-desc">Connecting students from over 50 partner universities.</div>
            </div>

            <div class="about-feature-card">
                <div class="about-feature-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <div class="about-feature-title">Free for Students</div>
                <div class="about-feature-desc">No fees, no hidden charges. Always free for students.</div>
            </div>

        </div>
    </div>
</section>

{{-- ── HOW IT WORKS ───────────────────────────────────────────────────────── --}}
<section class="about-how">
    <div class="about-how-inner">

        <div class="about-how-header">
            <span class="hero-badge">Simple Process</span>
            <h2>How It Works</h2>
            <p>
                Whether you're a student looking for attachment or an organization seeking talent,
                getting started takes just a few steps.
            </p>
        </div>

        {{-- For Students --}}
        <div class="about-how-group">
            <div class="about-how-group-label">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
                For Students
            </div>
            <div class="about-steps about-steps-4">

                <div>
                    <div class="about-step-num">01</div>
                    <div class="about-step-icon about-step-icon-navy">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="about-step-title">Create Your Account</div>
                    <div class="about-step-desc">Sign up with your university email and complete your student profile with your course details and interests.</div>
                </div>

                <div>
                    <div class="about-step-num">02</div>
                    <div class="about-step-icon about-step-icon-navy">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </div>
                    <div class="about-step-title">Browse Opportunities</div>
                    <div class="about-step-desc">Search and filter attachment opportunities by county, department, or organization across Kenya.</div>
                </div>

                <div>
                    <div class="about-step-num">03</div>
                    <div class="about-step-icon about-step-icon-navy">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/>
                        </svg>
                    </div>
                    <div class="about-step-title">Apply with One Click</div>
                    <div class="about-step-desc">Upload your resume, submit your application, and track its status in real-time from your dashboard.</div>
                </div>

                <div>
                    <div class="about-step-num">04</div>
                    <div class="about-step-icon about-step-icon-navy">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4"/>
                            <path d="M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z"/>
                        </svg>
                    </div>
                    <div class="about-step-title">Get Placed</div>
                    <div class="about-step-desc">Receive acceptance notifications and begin your industrial attachment with a verified organization.</div>
                </div>

            </div>
        </div>

        {{-- For Organizations --}}
        <div class="about-how-group">
            <div class="about-how-group-label">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                    <path d="M8 21h8M12 17v4"/>
                </svg>
                For Organizations
            </div>
            <div class="about-steps about-steps-3">

                <div>
                    <div class="about-step-num">01</div>
                    <div class="about-step-icon about-step-icon-gold">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="12" y1="18" x2="12" y2="12"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                    </div>
                    <div class="about-step-title">Register &amp; Post</div>
                    <div class="about-step-desc">Create your organization profile and post attachment opportunities with details like county, department, and deadline.</div>
                </div>

                <div>
                    <div class="about-step-num">02</div>
                    <div class="about-step-icon about-step-icon-gold">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="about-step-title">Review Applications</div>
                    <div class="about-step-desc">Browse student applications, view resumes, and shortlist candidates that match your requirements.</div>
                </div>

                <div>
                    <div class="about-step-num">03</div>
                    <div class="about-step-icon about-step-icon-gold">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4"/>
                            <path d="M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z"/>
                        </svg>
                    </div>
                    <div class="about-step-title">Select &amp; Onboard</div>
                    <div class="about-step-desc">Accept the best candidates and manage your attachment positions. Freeze listings once slots are filled.</div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- ── CTA ─────────────────────────────────────────────────────────────────── --}}
<section class="about-cta">
    <div class="about-cta-box">
        <h2>Ready to get started?</h2>
        <p>Join thousands of Kenyan students and organizations already using AttachKE.</p>
        <div class="about-cta-btns">
            <a href="{{ route('register') }}?type=student" class="btn btn-gold">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
                Join as Student
            </a>
            <a href="{{ route('register') }}?type=company" class="btn btn-outline-white">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                    <path d="M8 21h8M12 17v4"/>
                </svg>
                Join as Organization
            </a>
        </div>
    </div>
</section>

@endsection
