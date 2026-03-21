@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('dash.parts.topnav')
        @include('dash.parts.sidenav')

        <main class="app-main">
            <div class="app-content d-flex align-items-center justify-content-center"
                 style="min-height: 70vh;">
                <div class="text-center">
                    <div style="font-size: 5rem; line-height:1; color: var(--navy-700);">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h2 class="mt-3 fw-bold" style="color: var(--navy-800);">Access Restricted</h2>
                    <p class="text-muted mt-2" style="max-width: 400px; margin: 0 auto;">
                        You don't have permission to view this page.
                        Please contact your administrator if you believe this is a mistake.
                    </p>
                    <a href="{{ url()->previous() === url()->current() ? route('profile') : url()->previous() }}"
                       class="btn mt-4"
                       style="background: var(--navy-700); color: #fff; padding: 0.6rem 1.8rem; border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Go Back
                    </a>
                </div>
            </div>
        </main>

        @include('dash.parts.footer')
    </div>
</body>
</html>