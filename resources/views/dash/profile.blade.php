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