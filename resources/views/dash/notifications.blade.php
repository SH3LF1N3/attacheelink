@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Notifications</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Notifications</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                {{-- Main tabs --}}
                <ul class="nav nav-tabs mb-0" id="notifTabs"
                    style="border-bottom:2px color:var(--navy-700);">
                    <li class="nav-item">
                        <button class="nav-link active fw-semibold" id="tab-notif"
                                data-bs-toggle="tab" data-bs-target="#pane-notif"
                                style="color:var(--navy-700);border:none;border-bottom:2px solid transparent;
                                       background:none;padding:0.75rem 1.25rem;">
                            <i class="bi bi-bell me-1"></i> Notifications
                            @if($unread->count())
                            <span class="badge ms-1"
                                  style="background:#dc2626;color:#fff;font-size:0.7rem;
                                         border-radius:999px;padding:2px 7px;">
                                {{ $unread->count() }}
                            </span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-semibold" id="tab-pref"
                                data-bs-toggle="tab" data-bs-target="#pane-pref"
                                style="color:#6b7280;border:none;border-bottom:2px solid transparent;
                                       background:none;padding:0.75rem 1.25rem;">
                            <i class="bi bi-sliders me-1"></i> Preferences
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-0">

                    {{-- Notifications pane --}}
                    <div class="tab-pane fade show active" id="pane-notif">
                        @include('dash.partials.notifications-list')
                    </div>

                    {{-- Preferences pane --}}
                    <div class="tab-pane fade" id="pane-pref">
                        @include('dash.partials.notifications-preferences')
                    </div>

                </div>

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>