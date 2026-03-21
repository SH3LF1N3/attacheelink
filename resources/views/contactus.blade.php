@extends('layouts.app')

@section('title', 'Contact Us – AttachKE')

@section('content')

{{-- ── BANNER ─────────────────────────────────────────────────────────────── --}}
<section class="contact-banner">
    <div class="contact-banner-inner">
        <span class="hero-badge">Get In Touch</span>
        <h1 class="contact-banner-title">Contact Us</h1>
        <p class="contact-banner-desc">
            Have a question, suggestion, or need support? We'd love to hear from you.<br>
            Reach out and our team will get back to you promptly.
        </p>
    </div>
</section>

{{-- ── BODY ───────────────────────────────────────────────────────────────── --}}
<section class="contact-body">
    <div class="contact-body-inner">

        {{-- ── LEFT: Details + Map ─────────────────────────────────────── --}}
        <div>
            <h2 class="contact-details-title">Contact Details</h2>

            <div class="contact-detail-list">

                <div class="contact-detail-item">
                    <div class="contact-detail-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                            <circle cx="12" cy="9" r="2.5"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-detail-label">Office Address</div>
                        <div class="contact-detail-value">
                            University Way, 3rd Floor<br>
                            Varsity Plaza, Nairobi, Kenya
                        </div>
                    </div>
                </div>

                <div class="contact-detail-item">
                    <div class="contact-detail-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.77a16 16 0 0 0 6.29 6.29l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.01z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-detail-label">Phone</div>
                        <div class="contact-detail-value">
                            +254 700 000 000<br>
                            +254 711 000 000
                        </div>
                    </div>
                </div>

                <div class="contact-detail-item">
                    <div class="contact-detail-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <path d="m2 7 10 7 10-7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-detail-label">Email</div>
                        <div class="contact-detail-value">
                            support@attachke.ac.ke<br>
                            info@attachke.ac.ke
                        </div>
                    </div>
                </div>

                <div class="contact-detail-item">
                    <div class="contact-detail-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-detail-label">Office Hours</div>
                        <div class="contact-detail-value">
                            Mon – Fri: 8:00 AM – 5:00 PM<br>
                            Sat: 9:00 AM – 1:00 PM
                        </div>
                    </div>
                </div>

            </div>

            {{-- Map --}}
            <h2 class="contact-find-title">Find Us</h2>
            <div class="contact-map">
                <iframe
                    src="https://www.openstreetmap.org/export/embed.html?bbox=36.8100%2C-1.2950%2C36.8350%2C-1.2750&layer=mapnik&marker=-1.2833%2C36.8219"
                    allowfullscreen
                    loading="lazy"
                    title="AttachKE Office Location">
                </iframe>
            </div>
        </div>

        {{-- ── RIGHT: Contact Form ──────────────────────────────────────── --}}
        <div class="contact-form-card">
            <h2 class="contact-form-card-title">Send Us a Message</h2>
            <p class="contact-form-card-sub">Fill out the form below and we'll respond within 24 hours.</p>

            {{-- Flash alerts --}}
            @if (session('success'))
                <div class="contact-alert contact-alert-success">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="contact-alert contact-alert-error">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('contactus.send') }}" method="POST" class="contact-form">
                @csrf

                <div class="contact-form-row">
                    <div class="contact-field">
                        <label class="contact-label" for="full_name">Full Name</label>
                        <input id="full_name" type="text" name="full_name"
                               class="contact-input @error('full_name') is-error @enderror"
                               value="{{ old('full_name') }}"
                               placeholder="e.g. John Kamau" required />
                    </div>
                    <div class="contact-field">
                        <label class="contact-label" for="email">Email Address</label>
                        <input id="email" type="email" name="email"
                               class="contact-input @error('email') is-error @enderror"
                               value="{{ old('email') }}"
                               placeholder="john@university.ac.ke" required />
                    </div>
                </div>

                <div class="contact-field">
                    <label class="contact-label" for="subject">Subject</label>
                    <div class="contact-select-wrap">
                        <select id="subject" name="subject"
                                class="contact-select @error('subject') is-error @enderror" required>
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select an option</option>
                            <option value="general"       {{ old('subject') === 'general'       ? 'selected' : '' }}>General Enquiry</option>
                            <option value="student"       {{ old('subject') === 'student'       ? 'selected' : '' }}>Student Support</option>
                            <option value="organisation"  {{ old('subject') === 'organisation'  ? 'selected' : '' }}>Organisation Support</option>
                            <option value="technical"     {{ old('subject') === 'technical'     ? 'selected' : '' }}>Technical Issue</option>
                            <option value="partnership"   {{ old('subject') === 'partnership'   ? 'selected' : '' }}>Partnership</option>
                            <option value="other"         {{ old('subject') === 'other'         ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="contact-field">
                    <label class="contact-label" for="phone">Phone Number <span style="color:var(--charcoal-400);font-weight:400;">(Optional)</span></label>
                    <input id="phone" type="tel" name="phone"
                           class="contact-input"
                           value="{{ old('phone') }}"
                           placeholder="+254 7XX XXX XXX" />
                </div>

                <div class="contact-field">
                    <label class="contact-label" for="message">Your Message</label>
                    <textarea id="message" name="message"
                              class="contact-textarea @error('message') is-error @enderror"
                              placeholder="Tell us how we can help you..."
                              required>{{ old('message') }}</textarea>
                </div>

                <div>
                    <button type="submit" class="contact-submit">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/>
                        </svg>
                        Send Message
                    </button>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection