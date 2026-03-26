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
        <div class="dash-stat-icon" style="background:#eff6ff;color:#3b82f6;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
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
        <div class="dash-stat-value">{{ $stats['shortlisted'] }}</div>
        <div class="dash-stat-label">Shortlisted</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#fef2f2;color:#b91c1c;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['rejected'] }}</div>
        <div class="dash-stat-label">Rejected</div>
    </div>

</div>

{{-- Two-column grid --}}
<div class="dash-two-col">

    {{-- Recommended Opportunities --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>Recommended for You</span>
            <a href="{{ route('my_opportunities') }}" class="dash-view-all">View All →</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['recommended'] as $oppo)
            <div class="dash-list-item">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    {{-- Initial avatar --}}
                    <div style="width:36px;height:36px;border-radius:8px;
                                background:var(--navy-50);color:var(--navy-700);
                                display:flex;align-items:center;justify-content:center;
                                font-weight:700;font-size:0.85rem;flex-shrink:0;">
                        {{ strtoupper(substr($oppo->org, 0, 1)) }}
                    </div>
                    <div>
                        <div class="dash-list-title">{{ $oppo->oname }}</div>
                        <div class="dash-list-sub">{{ $oppo->org }} · {{ $oppo->loc }}</div>
                    </div>
                </div>
                <a href="{{ route('my_opportunities') }}"
                   style="font-size:0.78rem;font-weight:600;color:var(--navy-700);
                          border:1px solid var(--navy-200);padding:4px 12px;
                          border-radius:6px;text-decoration:none;white-space:nowrap;">
                    View
                </a>
            </div>
            @empty
            <div class="dash-empty">
                No new opportunities available.
                <a href="{{ route('my_opportunities') }}">Browse all →</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Upcoming Deadlines --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <span>Upcoming Deadlines</span>
            <a href="{{ route('my_opportunities') }}" class="dash-view-all">View All →</a>
        </div>
        <div class="dash-card-body">
            @forelse($stats['upcoming_deadlines'] as $oppo)
            @php
                $daysLeft = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($oppo->dead), false);
                $urgentColor = $daysLeft <= 2 ? '#b91c1c' : '#b45309';
                $urgentBg    = $daysLeft <= 2 ? '#fef2f2' : '#fef9ec';
            @endphp
            <div class="dash-list-item">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <div style="width:32px;height:32px;border-radius:50%;
                                background:{{ $urgentBg }};color:{{ $urgentColor }};
                                display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div>
                        <div class="dash-list-title">{{ $oppo->oname }}</div>
                        <div style="font-size:0.75rem;color:{{ $urgentColor }};font-weight:600;margin-top:2px;">
                            @if($daysLeft === 0)
                                Expires today
                            @elseif($daysLeft === 1)
                                Expires tomorrow
                            @else
                                Expires in {{ $daysLeft }} days
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="dash-empty">No deadlines in the next 7 days.</div>
            @endforelse
        </div>
    </div>

</div>