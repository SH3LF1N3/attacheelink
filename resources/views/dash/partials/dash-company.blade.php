{{-- ── COMPANY DASHBOARD ── --}}

{{-- Stat cards --}}
<div class="dash-stats-grid" style="margin-bottom:1.5rem;">

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:rgba(30,58,95,0.1);color:var(--navy-700);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <path d="M8 21h8M12 17v4"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['total_listings'] }}</div>
        <div class="dash-stat-label">Total Listings</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#f0fdf4;color:#16a34a;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['active_listings'] }}</div>
        <div class="dash-stat-label">Active Listings</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#eff6ff;color:#3b82f6;">
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
        <div class="dash-stat-value">{{ $stats['pending_apps'] }}</div>
        <div class="dash-stat-label">Pending Review</div>
    </div>

</div>

{{-- Two-column grid --}}
<div class="dash-two-col">

    {{-- My Listings --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>My Opportunities</span>
            <a href="{{ route('oppo.create') }}" class="dash-view-all" style="color:var(--gold-500);">
                + Post New
            </a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['my_oppo'] as $oppo)
            <div class="dash-list-item">
                <div>
                    <div class="dash-list-title">{{ $oppo->oname }}</div>
                    <div class="dash-list-sub">{{ $oppo->foth1 }} · {{ $oppo->loc }} · Deadline: {{ $oppo->dead }}</div>
                </div>
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <span class="dash-badge dash-badge-{{ $oppo->status }}">{{ ucfirst($oppo->status) }}</span>
                    <a href="{{ route('oppo.edit', $oppo->id) }}" style="font-size:0.75rem;color:var(--navy-600);">Edit</a>
                </div>
            </div>
            @empty
            <div class="dash-empty">
                No opportunities posted yet.
                <a href="{{ route('oppo.create') }}">Post your first →</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Recent Applications received --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>Recent Applications</span>
            <a href="{{ route('applications') }}" class="dash-view-all">View All →</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['recent_apps'] as $app)
            <div class="dash-list-item">
                <div>
                    <div class="dash-list-title">{{ $app->stud ?? 'Applicant' }}</div>
                    <div class="dash-list-sub">Applied for: {{ $app->oname ?? '—' }}</div>
                </div>
                <span class="dash-badge dash-badge-{{ $app->status ?? 'pending' }}">
                    {{ ucfirst($app->status ?? 'pending') }}
                </span>
            </div>
            @empty
            <div class="dash-empty">No applications received yet.</div>
            @endforelse
        </div>
    </div>

</div>