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
                        <h3 class="mb-0">Organisations</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Organisations</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">

                    {{-- Toolbar --}}
                    <div class="card-header bg-white px-4 py-3" style="border-bottom:1px solid #f3f4f6;">
                        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">

                            <form method="GET" action="{{ route('organisations') }}"
                                  class="d-flex flex-wrap gap-2 align-items-center grow">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Search name, email, phone…"
                                       class="form-control form-control-sm"
                                       style="min-width:200px;max-width:300px;border-radius:8px;">
                                <button type="submit" class="btn btn-sm"
                                        style="background:var(--navy-700);color:#fff;border-radius:8px;">
                                    <i class="bi bi-search me-1"></i>Search
                                </button>
                                @if(request('search'))
                                <a href="{{ route('organisations') }}"
                                   class="btn btn-sm btn-outline-secondary" style="border-radius:8px;">
                                    <i class="bi bi-x me-1"></i>Clear
                                </a>
                                @endif
                            </form>

                            @if($permit->aorg)
                            <button type="button" class="btn btn-sm"
                                    style="background:var(--gold-400);color:var(--navy-800);
                                           font-weight:600;border-radius:8px;white-space:nowrap;"
                                    data-bs-toggle="modal" data-bs-target="#createOrgModal">
                                <i class="bi bi-plus-lg me-1"></i>Add Organisation
                            </button>
                            @endif
                        </div>

                        <div class="mt-2" style="font-size:0.8rem;color:#6b7280;">
                            <i class="bi bi-building me-1"></i>
                            <strong style="color:var(--navy-800);">{{ $orgs->total() }}</strong> organisation(s) found
                            @if(request('search')) — filtered results @endif
                        </div>
                    </div>

                    @include('dash.partials.org-table')

                    @if($orgs->hasPages())
                    <div class="card-footer bg-white px-4 py-3" style="border-top:1px solid #f3f4f6;">
                        {{ $orgs->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

@if($permit->aorg)
    @include('dash.modals.org-create')
@endif
@if($permit->eorg)
    @include('dash.modals.org-edit')
@endif

</body>
</html>