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
                        <h3 class="mb-0">
                            @if($user->role === 'admin') Platform Overview
                            @elseif($user->role === 'student') My Dashboard
                            @else Company Dashboard
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @include('dash.partials.dash-welcome')

                @if($user->role === 'admin')
                    @include('dash.partials.dash-admin')
                @elseif($user->role === 'student')
                    @include('dash.partials.dash-student')
                @else
                    @include('dash.partials.dash-company')
                @endif

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>