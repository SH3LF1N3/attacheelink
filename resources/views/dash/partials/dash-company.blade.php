{{-- ── COMPANY DASHBOARD ── --}}

{{-- Stat cards --}}
<div class="dash-stats-grid" style="margin-bottom:1.5rem;">

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:var(--navy-50);color:var(--navy-700);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <path d="M8 21h8M12 17v4"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['total_listings'] }}</div>
        <div class="dash-stat-label">Total Listings</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:var(--navy-50);color:var(--navy-600);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['active_listings'] }}</div>
        <div class="dash-stat-label">Active Listings</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:var(--navy-50);color:var(--navy-700);">
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

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#f0fdf4;color:#16a34a;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['selected_apps'] ?? 0 }}</div>
        <div class="dash-stat-label">Selected</div>
    </div>

</div>

{{-- Two-column grid --}}
<div class="dash-two-col">

    {{-- My Listings --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>My Opportunities</span>
            <a href="{{ route('oppo.create') }}" class="dash-view-all"
               style="color:var(--gold-500);">+ Post New</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['my_oppo'] as $oppo)
            <div class="dash-list-item">
                <div>
                    <div class="dash-list-title">{{ $oppo->oname }}</div>
                    <div class="dash-list-sub">
                        {{ $oppo->foth1 }} · {{ $oppo->loc }} · Deadline: {{ $oppo->dead }}
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    @php
                        $bgMap = [
                            'active' => ['var(--navy-50)', 'var(--navy-700)'],
                            'closed' => ['#fef2f2',        '#b91c1c'],
                            'draft'  => ['#f5f7fa',        'var(--charcoal-500)'],
                        ];
                        $bc = $bgMap[$oppo->status] ?? ['var(--navy-50)', 'var(--navy-700)'];
                    @endphp
                    <span style="background:{{ $bc[0] }};color:{{ $bc[1] }};
                                 font-size:0.7rem;font-weight:700;
                                 padding:2px 10px;border-radius:var(--radius-full);">
                        {{ ucfirst($oppo->status) }}
                    </span>
                    <a href="{{ route('oppo.edit', $oppo->id) }}"
                       style="font-size:0.75rem;color:var(--navy-600);text-decoration:none;">
                        Edit
                    </a>
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
                    <div class="dash-list-title">
                        {{ $app->student->fname ?? 'Applicant' }}
                    </div>
                    <div class="dash-list-sub">
                        Applied for: {{ $app->opportunity->oname ?? '—' }}
                    </div>
                </div>
                @php
                    $badges = [
                        'pending'              => ['#b45309', '#fef9ec'],
                        'review'               => ['#1d4ed8', '#eff6ff'],
                        'shortlisted'          => ['#15803d', '#f0fdf4'],
                        'interview_scheduled'  => ['#78350f', '#fef3c7'],
                        'selected'             => ['#14532d', '#dcfce7'],
                        'rejected'             => ['#b91c1c', '#fef2f2'],
                    ];
                    $b = $badges[$app->status] ?? ['#52525b', '#f5f5f6'];
                @endphp
                <span style="background:{{ $b[1] }};color:{{ $b[0] }};
                             font-size:0.7rem;font-weight:700;
                             padding:2px 10px;border-radius:var(--radius-full);
                             text-transform:capitalize;">
                    {{ str_replace('_', ' ', ucwords($app->status)) }}
                </span>
            </div>
            @empty
            <div class="dash-empty">No applications received yet.</div>
            @endforelse
        </div>
    </div>

</div>