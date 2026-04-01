@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">Reports</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                {{-- Main tabs --}}
                <ul class="nav nav-tabs mb-0" style="border-bottom:2px solid #e8edf3;">
                    <li class="nav-item">
                        <button class="nav-link active fw-semibold" data-bs-toggle="tab"
                                data-bs-target="#pane-users"
                                style="color:var(--navy-700);border:none;background:none;padding:.75rem 1.25rem;">
                            <i class="bi bi-people me-1"></i>Users
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-semibold" data-bs-toggle="tab"
                                data-bs-target="#pane-apps"
                                style="color:#6b7280;border:none;background:none;padding:.75rem 1.25rem;">
                            <i class="bi bi-file-earmark-text me-1"></i>Applications
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-semibold" data-bs-toggle="tab"
                                data-bs-target="#pane-ai"
                                style="color:#6b7280;border:none;background:none;padding:.75rem 1.25rem;">
                            <i class="bi bi-stars me-1"></i>AI Usage
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-0">

                    {{-- Users tab --}}
                    <div class="tab-pane fade show active" id="pane-users">
                        @include('dash.partials.reports.users-tab')
                    </div>

                    {{-- Applications tab --}}
                    <div class="tab-pane fade" id="pane-apps">
                        @include('dash.partials.reports.apps-tab')
                    </div>

                    {{-- AI Usage tab --}}
                    <div class="tab-pane fade" id="pane-ai">
                        @include('dash.partials.reports.ai-tab')
                    </div>

                </div>
            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>