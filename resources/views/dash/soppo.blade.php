@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">Browse Opportunities</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Opportunities</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                {{-- Stats strip --}}
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span style="font-size:0.875rem;color:#6b7280;">
                        <i class="bi bi-list-task me-1" style="color:#0f766e;"></i>
                        <strong style="color:var(--navy-800);">{{ $opportunities->total() }}</strong> open opportunities available
                    </span>
                </div>

                @if($opportunities->isEmpty())
                <div class="card shadow-sm text-center py-5" style="border:none;border-radius:12px;">
                    <i class="bi bi-list-task" style="font-size:3rem;color:#d1d5db;"></i>
                    <p class="mt-3 text-muted">No open opportunities right now. Check back soon!</p>
                </div>
                @else
                <div class="row g-3">
                    @foreach($opportunities as $oppo)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <h6 class="fw-bold mb-0" style="color:var(--navy-800);font-size:0.95rem;">
                                        {{ $oppo->oname ?? '—' }}
                                    </h6>
                                    <span class="badge ms-2 shrink-0"
                                          style="background:#d1fae5;color:#065f46;font-size:0.7rem;border-radius:6px;">
                                        Active
                                    </span>
                                </div>

                                <div style="font-size:0.8rem;color:#6b7280;" class="mb-3">
                                    <div><i class="bi bi-building me-1"></i>{{ $oppo->org ?? '—' }}</div>
                                    @if($oppo->loc)
                                    <div class="mt-1"><i class="bi bi-geo-alt me-1"></i>{{ $oppo->loc }}</div>
                                    @endif
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    @if($oppo->duration)
                                    <span style="background:#f3f4f6;color:#374151;font-size:0.72rem;
                                                 padding:3px 10px;border-radius:20px;">
                                        <i class="bi bi-clock me-1"></i>{{ $oppo->duration }}
                                    </span>
                                    @endif
                                    @if($oppo->slot)
                                    <span style="background:#f3f4f6;color:#374151;font-size:0.72rem;
                                                 padding:3px 10px;border-radius:20px;">
                                        <i class="bi bi-people me-1"></i>{{ $oppo->slot }} slot(s)
                                    </span>
                                    @endif
                                </div>

                                @if($oppo->descr)
                                <p style="font-size:0.8rem;color:#6b7280;line-height:1.5;"
                                   class="mb-3 text-truncate">{{ $oppo->descr }}</p>
                                @endif

                                <div class="d-flex align-items-center justify-content-between mt-auto pt-2"
                                     style="border-top:1px solid #f3f4f6;">
                                    @if($oppo->dead)
                                    <span style="font-size:0.72rem;color:#dc2626;">
                                        <i class="bi bi-calendar-x me-1"></i>Deadline: {{ $oppo->dead }}
                                    </span>
                                    @else
                                    <span></span>
                                    @endif
                                    <a href="{{ route('my_applications') }}" class="btn btn-sm"
                                       style="background:#0f766e;color:#fff;border-radius:6px;font-size:0.75rem;">
                                        Apply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4">{{ $opportunities->links() }}</div>
                @endif

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>