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
                        <h3 class="mb-0">Students</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Students</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                {{-- Alerts --}}
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

                            {{-- Search & filter --}}
                            <form method="GET" action="{{ route('students') }}"
                                  class="d-flex flex-wrap gap-2 align-items-center grow">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Search name, email, phone…"
                                       class="form-control form-control-sm"
                                       style="min-width:200px;max-width:280px;border-radius:8px;">

                                <select name="gender" class="form-select form-select-sm"
                                        style="width:auto;min-width:130px;border-radius:8px;">
                                    <option value="">All Genders</option>
                                    <option value="Male"           {{ request('gender') === 'Male'           ? 'selected' : '' }}>Male</option>
                                    <option value="Female"         {{ request('gender') === 'Female'         ? 'selected' : '' }}>Female</option>
                                    <option value="Rather Not Say" {{ request('gender') === 'Rather Not Say' ? 'selected' : '' }}>Rather Not Say</option>
                                </select>

                                <button type="submit" class="btn btn-sm"
                                        style="background:var(--navy-700);color:#fff;border-radius:8px;">
                                    <i class="bi bi-search me-1"></i>Search
                                </button>

                                @if(request()->hasAny(['search','gender']))
                                <a href="{{ route('students') }}"
                                   class="btn btn-sm btn-outline-secondary" style="border-radius:8px;">
                                    <i class="bi bi-x me-1"></i>Clear
                                </a>
                                @endif
                            </form>

                            {{-- Add button --}}
                            @if($permit->astud)
                            <button type="button" class="btn btn-sm"
                                    style="background:var(--gold-400);color:var(--navy-800);
                                           font-weight:600;border-radius:8px;white-space:nowrap;"
                                    data-bs-toggle="modal" data-bs-target="#createStudentModal">
                                <i class="bi bi-plus-lg me-1"></i>Add Student
                            </button>
                            @endif
                        </div>

                        {{-- Count strip --}}
                        <div class="mt-2" style="font-size:0.8rem;color:#6b7280;">
                            <i class="bi bi-people me-1"></i>
                            <strong style="color:var(--navy-800);">{{ $students->total() }}</strong> student(s) found
                            @if(request('search') || request('gender'))
                                — filtered results
                            @endif
                        </div>
                    </div>

                    {{-- Table partial --}}
                    @include('dash.partials.student-table')

                    {{-- Pagination --}}
                    @if($students->hasPages())
                    <div class="card-footer bg-white px-4 py-3" style="border-top:1px solid #f3f4f6;">
                        {{ $students->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

{{-- Modals --}}
@if($permit->astud)
    @include('dash.modals.student-create')
@endif
@if($permit->estud)
    @include('dash.modals.student-edit')
@endif

</body>
</html>