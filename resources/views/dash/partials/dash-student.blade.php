{{-- ── STUDENT DASHBOARD ── --}}

{{-- Profile Completion Alert --}}
@php
    // Students: 6 required fields
    $isComplete = $user->fname && $user->foth1 && $user->foth2 && $user->foth3 && $user->phone && $user->gender;
    if (!$isComplete) {
        $completedFields = 0;
        $totalFields = 6;
        if ($user->fname) $completedFields++;
        if ($user->foth1) $completedFields++;
        if ($user->foth2) $completedFields++;
        if ($user->foth3) $completedFields++;
        if ($user->phone) $completedFields++;
        if ($user->gender) $completedFields++;
        $completion = round(($completedFields / $totalFields) * 100);
    }
@endphp

@if (!$isComplete)
<div style="background:#fef9ec;border:1.5px solid #fbbf24;border-radius:12px;padding:1.5rem;
            margin-bottom:1.5rem;display:flex;align-items:flex-start;gap:1.25rem;">
    <div style="flex-shrink:0;">
        <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:#d97706;">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
    </div>
    <div style="flex:1;">
        <div style="font-weight:700;color:#92400e;margin-bottom:0.75rem;font-size:1.05rem;">
            Complete Your Profile to Continue
        </div>
        <p style="margin:0 0 1rem;color:#b45309;font-size:0.95rem;line-height:1.6;">
            Your profile is {{ $completion }}% complete. Organizations need your complete information to match you with internship opportunities. You cannot browse or apply for opportunities until your profile is complete.
        </p>
        <div style="background:#fff;border-radius:8px;overflow:hidden;height:10px;margin-bottom:0.75rem;">
            <div style="background:#d97706;height:100%;width:{{ $completion }}%;transition:width 0.3s;"></div>
        </div>
        <div style="font-size:0.85rem;color:#b45309;margin-bottom:1rem;">
            {{ $totalFields - $completedFields }} field{{ $totalFields - $completedFields != 1 ? 's' : '' }} remaining
        </div>
    </div>
    <a href="{{ route('profile') }}" 
       style="background:#d97706;color:#fff;border:none;padding:0.75rem 1.5rem;
              border-radius:6px;font-weight:600;cursor:pointer;white-space:nowrap;
              font-size:0.9rem;text-decoration:none;display:inline-block;flex-shrink:0;">
        Complete Profile
    </a>
</div>
@endif

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
        <div class="dash-stat-icon" style="background:var(--navy-50);color:var(--navy-700);">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <polyline points="23 11 17 17 14 14"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['shortlisted'] }}</div>
        <div class="dash-stat-label">Shortlisted</div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background:#f0fdf4;color:#16a34a;">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div class="dash-stat-value">{{ $stats['selected'] }}</div>
        <div class="dash-stat-label">Selected</div>
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
                $daysLeft    = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($oppo->dead), false);
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
                            @if($daysLeft === 0) Expires today
                            @elseif($daysLeft === 1) Expires tomorrow
                            @else Expires in {{ $daysLeft }} days
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