@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">My Profile</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="profile-page">

                    {{-- ── REDIRECT MESSAGE ── --}}
                    @if(session('redirected_incomplete'))
                    <div style="background:#fef3ec;border:1.5px solid #ea580c;border-radius:12px;padding:1.5rem;
                                margin-bottom:1.5rem;display:flex;align-items:center;gap:1rem;">
                        <div style="flex-shrink:0;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:#ea580c;">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2zm0-4h-2V7h2z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight:700;color:#92400e;">
                                Profile Required
                            </div>
                            <p style="margin:0;color:#b45309;font-size:0.9rem;">
                                You must complete your profile to browse opportunities and manage applications. Fill in all required fields below to unlock full access.
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- ── PROFILE COMPLETION ALERT ── --}}
                    @php
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
                    <div style="background:#fef9ec;border:1.5px solid #fbbf24;border-radius:12px;padding:1.25rem;
                                margin-bottom:1.5rem;display:flex;align-items:flex-start;gap:1rem;">
                        <div style="flex-shrink:0;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:#d97706;">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                        </div>
                        <div style="flex:1;">
                            <div style="font-weight:700;color:#92400e;margin-bottom:0.5rem;">
                                Complete Your Profile
                            </div>
                            <p style="margin:0 0 0.75rem;color:#b45309;font-size:0.95rem;line-height:1.5;">
                                Your profile is {{ $completion }}% complete. Completing your profile helps organizations find you and increases your chances of getting attachments!
                            </p>
                            <div style="background:#fff;border-radius:8px;overflow:hidden;height:8px;margin-bottom:0.75rem;">
                                <div style="background:#d97706;height:100%;width:{{ $completion }}%;transition:width 0.3s;"></div>
                            </div>
                            <div style="font-size:0.85rem;color:#b45309;">
                                {{ $totalFields - $completedFields }} field{{ $totalFields - $completedFields != 1 ? 's' : '' }} remaining
                            </div>
                        </div>
                        <button onclick="document.querySelector('.profile-forms-section').scrollIntoView({behavior:'smooth'})"
                                style="background:#d97706;color:#fff;border:none;padding:0.5rem 1rem;
                                       border-radius:6px;font-weight:600;cursor:pointer;white-space:nowrap;
                                       font-size:0.85rem;">
                            Complete Now
                        </button>
                    </div>
                    @else
                    <div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:12px;padding:1.25rem;
                                margin-bottom:1.5rem;display:flex;align-items:center;gap:1rem;">
                        <div style="flex-shrink:0;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:#22c55e;">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight:700;color:#166534;">
                                Profile Complete! ✓
                            </div>
                            <p style="margin:0;color:#4ade80;font-size:0.9rem;">
                                Your profile is 100% complete. You're all set to apply for attachments!
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- ── HEADER CARD ── --}}
                    <div class="profile-header-card">
                        <div class="profile-header-left">
                            <div class="profile-avatar-lg">
                                {{ strtoupper(substr($user->fname ?? $user->uname, 0, 2)) }}
                                <div class="avatar-badge"></div>
                            </div>
                            <div>
                                <div class="profile-header-name">{{ $user->fname ?? $user->uname }}</div>
                                <div class="profile-header-sub">
                                    {{ $user->foth1 ?? 'No course set' }} —
                                    {{ $user->foth2 ?? 'No university set' }}
                                </div>
                                <div class="profile-header-meta">
                                    <span class="profile-header-meta-item">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/>
                                        </svg>
                                        {{ $user->email }}
                                    </span>
                                    <span class="profile-header-meta-item">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                        {{ $user->phone ?? 'No phone set' }}
                                    </span>
                                    <span class="profile-header-meta-item">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                            <circle cx="12" cy="9" r="2.5"/>
                                        </svg>
                                        {{ $user->foth3 ?? 'Nairobi County' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span class="profile-status-badge">Active</span>
                    </div>

                    {{-- ── FULL WIDTH FORM CONTENT ── --}}
                    @include('dash.parts.profile-forms')

                </div>
            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>