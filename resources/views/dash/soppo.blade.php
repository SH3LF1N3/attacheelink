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
                    <span style="font-size:0.875rem;color:var(--charcoal-400);">
                        <i class="bi bi-list-task me-1" style="color:var(--navy-600);"></i>
                        <strong style="color:var(--navy-800);">{{ $opportunities->total() }}</strong>
                        open opportunities available
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
                            <div class="card h-100 shadow-sm"
                                 style="border:1px solid #e8edf3;border-radius:12px;overflow:hidden;
                                        transition:box-shadow 0.2s,transform 0.2s;">
                                <div class="card-body p-4">

                                    {{-- Title + badge --}}
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <h6 class="fw-bold mb-0"
                                            style="color:var(--navy-800);font-size:0.95rem;">
                                            {{ $oppo->oname ?? '—' }}
                                        </h6>
                                        <span class="ms-2"
                                              style="background:var(--navy-50);color:var(--navy-700);
                                                     font-size:0.7rem;font-weight:700;
                                                     padding:3px 10px;border-radius:var(--radius-full);
                                                     white-space:nowrap;">
                                            Active
                                        </span>
                                    </div>

                                    {{-- Org + location --}}
                                    <div style="font-size:0.8rem;color:var(--charcoal-400);" class="mb-3">
                                        <div><i class="bi bi-building me-1"></i>{{ $oppo->org ?? '—' }}</div>
                                        @if($oppo->loc)
                                        <div class="mt-1"><i class="bi bi-geo-alt me-1"></i>{{ $oppo->loc }}</div>
                                        @endif
                                    </div>

                                    {{-- Chips --}}
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @if($oppo->duration)
                                        <span style="background:var(--navy-50);color:var(--navy-700);
                                                     font-size:0.72rem;padding:3px 10px;
                                                     border-radius:var(--radius-full);">
                                            <i class="bi bi-clock me-1"></i>{{ $oppo->duration }}
                                        </span>
                                        @endif
                                        @if($oppo->slot)
                                        <span style="background:var(--navy-50);color:var(--navy-700);
                                                     font-size:0.72rem;padding:3px 10px;
                                                     border-radius:var(--radius-full);">
                                            <i class="bi bi-people me-1"></i>{{ $oppo->slot }} slot(s)
                                        </span>
                                        @endif
                                    </div>

                                    {{-- Description --}}
                                    @if($oppo->descr)
                                    <p style="font-size:0.8rem;color:var(--charcoal-400);line-height:1.5;"
                                       class="mb-3 text-truncate">{{ $oppo->descr }}</p>
                                    @endif

                                    {{-- Footer: deadline + apply --}}
                                    <div class="d-flex align-items-center justify-content-between mt-auto pt-2"
                                         style="border-top:1px solid #f0f4f8;">
                                        @if($oppo->dead)
                                        <span style="font-size:0.72rem;color:#dc2626;">
                                            <i class="bi bi-calendar-x me-1"></i>Deadline: {{ $oppo->dead }}
                                        </span>
                                        @else
                                        <span></span>
                                        @endif

                                        <a href="{{ url('/apply/' . $oppo->id) }}"
                                           style="background:var(--navy-700);color:#fff;
                                                  border-radius:var(--radius-sm);font-size:0.8rem;
                                                  font-weight:600;padding:0.4rem 1rem;
                                                  text-decoration:none;transition:background 0.15s;"
                                           onmouseover="this.style.background='var(--navy-800)'"
                                           onmouseout="this.style.background='var(--navy-700)'">
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