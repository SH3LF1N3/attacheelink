@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">My Applications</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Applications</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card shadow-sm" style="border:1px solid #e8edf3;border-radius:12px;overflow:hidden;">

                    {{-- Card header --}}
                    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                         style="border-bottom:1px solid #f0f4f8;">
                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                            <i class="bi bi-file-earmark-text me-2" style="color:var(--navy-600);"></i>
                            My Applications
                            <span class="ms-2"
                                  style="background:var(--navy-50);color:var(--navy-700);
                                         font-size:0.75rem;font-weight:700;
                                         padding:2px 10px;border-radius:var(--radius-full);">
                                {{ $applications->total() }}
                            </span>
                        </h6>
                    </div>

                    {{-- Table --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="font-size:0.875rem;">
                                <thead style="background:#f9fafb;">
                                    <tr>
                                        <th class="px-4 py-3 text-muted fw-semibold">#</th>
                                        <th class="py-3 text-muted fw-semibold">Role / Position</th>
                                        <th class="py-3 text-muted fw-semibold">Organisation</th>
                                        <th class="py-3 text-muted fw-semibold">Date Applied</th>
                                        <th class="py-3 text-muted fw-semibold">Status</th>
                                        <th class="py-3 text-muted fw-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($applications as $app)
                                    @php
                                        $badges = [
                                            'pending'     => ['#b45309', '#fef9ec'],
                                            'review'      => ['#1d4ed8', '#eff6ff'],
                                            'shortlisted' => ['#15803d', '#f0fdf4'],
                                            'rejected'    => ['#b91c1c', '#fef2f2'],
                                        ];
                                        $b = $badges[$app->status] ?? ['#52525b', '#f5f5f6'];
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-3 text-muted">
                                            {{ $applications->firstItem() + $loop->index }}
                                        </td>
                                        <td class="py-3 fw-semibold" style="color:var(--navy-800);">
                                            {{ $app->opportunity->oname ?? '—' }}
                                        </td>
                                        <td class="py-3" style="color:var(--charcoal-500);">
                                            {{ $app->opportunity->org ?? '—' }}
                                        </td>
                                        <td class="py-3" style="color:var(--charcoal-400);">
                                            {{ $app->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="py-3">
                                            <span style="background:{{ $b[1] }};color:{{ $b[0] }};
                                                         font-size:0.72rem;font-weight:700;
                                                         padding:3px 10px;border-radius:var(--radius-full);
                                                         text-transform:capitalize;">
                                                {{ ucfirst($app->status) }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <span style="color:var(--charcoal-400);font-size:0.8rem;">
                                                View Details
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="bi bi-inbox"
                                               style="font-size:2.5rem;color:#d1d9e2;"></i>
                                            <p class="mt-2 mb-0"
                                               style="color:var(--charcoal-400);font-size:0.875rem;">
                                                You haven't applied to anything yet.
                                            </p>
                                            <a href="{{ route('my_opportunities') }}"
                                               style="display:inline-block;margin-top:0.75rem;
                                                      background:var(--navy-700);color:#fff;
                                                      padding:0.45rem 1.1rem;border-radius:var(--radius-sm);
                                                      font-size:0.875rem;font-weight:600;
                                                      text-decoration:none;">
                                                Browse Opportunities
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($applications->hasPages())
                    <div class="card-footer bg-white px-4 py-3" style="border-top:1px solid #f0f4f8;">
                        {{ $applications->links() }}
                    </div>
                    @endif

                </div>

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>