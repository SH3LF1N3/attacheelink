{{-- Usage: @include('partials.opportunity-card', ['opportunity' => $opportunity]) --}}

<div class="card">
    <div class="card-top">
        <div class="card-icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <path d="M8 21h8M12 17v4"/>
                <path d="M7 8h10M7 11h6"/>
            </svg>
        </div>
        <span class="card-badge">Attachment</span>
    </div>

    <div class="card-title">{{ $opportunity->oname }}</div>
    <div class="card-org">{{ $opportunity->org }}</div>

    <div class="card-meta">
        <div class="card-meta-item">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                <circle cx="12" cy="9" r="2.5"/>
            </svg>
            {{ $opportunity->loc }}
        </div>
        <div class="card-meta-item">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            Apply by: {{ $opportunity->dead }}
        </div>
    </div>

    <a href="{{ url('/opportunities/' . $opportunity->id) }}" class="card-link">
        Learn More
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
    </a>
</div>