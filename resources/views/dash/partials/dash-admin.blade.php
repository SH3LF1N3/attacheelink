{{-- ── ADMIN DASHBOARD ── --}}

{{-- Stat cards --}}
<div class="dash-stats-grid" style="margin-bottom:1.5rem;">

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:rgba(30,58,95,0.1);color:var(--navy-700);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['total_students'] }}</div>
        <div class="dash-stat-label">Total Students</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#fef9ec;color:var(--gold-500);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <path d="M8 21h8M12 17v4"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['total_companies'] }}</div>
        <div class="dash-stat-label">Organisations</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#f0fdf4;color:#16a34a;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['active_oppo'] }}</div>
        <div class="dash-stat-label">Active Opportunities</div>
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

</div>

{{-- Two-column grid --}}
<div class="dash-two-col">

    {{-- Recent Users --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>Recent Users</span>
            <a href="{{ route('students') }}" class="dash-view-all">View All →</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['recent_users'] as $u)
            <div class="dash-list-item">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <div style="width:32px;height:32px;border-radius:50%;background:var(--navy-700);
                                color:var(--gold-400);display:flex;align-items:center;justify-content:center;
                                font-weight:700;font-size:0.8rem;flex-shrink:0;">
                        {{ strtoupper(substr($u->fname ?? $u->uname, 0, 1)) }}
                    </div>
                    <div>
                        <div class="dash-list-title">{{ $u->fname ?? $u->uname }}</div>
                        <div class="dash-list-sub">{{ $u->email }}</div>
                    </div>
                </div>
                <span class="dash-badge dash-badge-{{ $u->role }}">{{ ucfirst($u->role) }}</span>
            </div>
            @empty
            <div class="dash-empty">No users found.</div>
            @endforelse
        </div>
    </div>

    {{-- Recent Applications --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>Recent Applications</span>
            <a href="{{ route('applications') }}" class="dash-view-all">View All →</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['recent_apps'] as $app)
            <div class="dash-list-item">
                <div>
                    <div class="dash-list-title">{{ $app->stud ?? 'Student' }}</div>
                    <div class="dash-list-sub">{{ $app->oname ?? '—' }} · {{ $app->org ?? '' }}</div>
                </div>
                <span class="dash-badge dash-badge-{{ $app->status ?? 'pending' }}">
                    {{ ucfirst($app->status ?? 'pending') }}
                </span>
            </div>
            @empty
            <div class="dash-empty">No applications yet.</div>
            @endforelse
        </div>
    </div>

</div>