{{-- ── STUDENT DASHBOARD ── --}}

{{-- Stat cards --}}
<div class="dash-stats-grid" style="margin-bottom:1.5rem;">

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:rgba(30,58,95,0.1);color:var(--navy-700);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                <rect x="9" y="3" width="6" height="4" rx="2"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['total_apps'] }}</div>
        <div class="dash-stat-label">Total Applications</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#fef9ec;color:var(--gold-500);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['pending'] }}</div>
        <div class="dash-stat-label">Pending</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#eff6ff;color:#3b82f6;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['under_review'] }}</div>
        <div class="dash-stat-label">Under Review</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#f0fdf4;color:#16a34a;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['accepted'] }}</div>
        <div class="dash-stat-label">Accepted</div>
    </div>

</div>

{{-- Two-column grid --}}
<div class="dash-two-col">

    {{-- Recent Applications --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>My Recent Applications</span>
            <a href="{{ route('applications') }}" class="dash-view-all">View All →</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['recent_apps'] as $app)
            <div class="dash-list-item">
                <div>
                    <div class="dash-list-title">{{ $app->oname ?? 'Unnamed Role' }}</div>
                    <div class="dash-list-sub">{{ $app->org ?? '—' }} · {{ $app->loc ?? '' }}</div>
                </div>
                <span class="dash-badge dash-badge-{{ $app->status ?? 'pending' }}">
                    {{ ucfirst($app->status ?? 'pending') }}
                </span>
            </div>
            @empty
            <div class="dash-empty">No applications yet. <a href="{{ route('opportunities') }}">Browse opportunities →</a></div>
            @endforelse
        </div>
    </div>

    {{-- Open Opportunities --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>Open Opportunities</span>
            <a href="{{ route('opportunities') }}" class="dash-view-all">View All →</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['open_oppo'] as $oppo)
            <div class="dash-list-item">
                <div>
                    <div class="dash-list-title">{{ $oppo->oname }}</div>
                    <div class="dash-list-sub">{{ $oppo->org }} · {{ $oppo->loc }}</div>
                </div>
                <span style="font-size:0.75rem;color:var(--charcoal-400);">
                    Deadline: {{ $oppo->dead }}
                </span>
            </div>
            @empty
            <div class="dash-empty">No open opportunities at the moment.</div>
            @endforelse
        </div>
    </div>

</div>