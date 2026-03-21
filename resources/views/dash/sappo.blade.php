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

                <div class="card shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">
                    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                         style="border-bottom:1px solid #f3f4f6;">
                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                            <i class="bi bi-file-earmark-text me-2" style="color:#0f766e;"></i>
                            My Applications
                            <span class="badge ms-2" style="background:#f3f4f6;color:#374151;font-size:0.75rem;">
                                {{ $applications->total() }}
                            </span>
                        </h6>
                        
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="font-size:0.875rem;">
                                <thead style="background:#f9fafb;">
                                    <tr>
                                        <th class="px-4 py-3 text-muted fw-semibold">#</th>
                                        <th class="py-3 text-muted fw-semibold">Organisation</th>
                                        <th class="py-3 text-muted fw-semibold">Role / Position</th>
                                        <th class="py-3 text-muted fw-semibold">Status</th>
                                        <th class="py-3 text-muted fw-semibold">Date Applied</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($applications as $app)
                                    @php
                                        $sc = [
                                            'pending'  => ['#b45309', '#fef3c7'],
                                            'review'   => ['#1d4ed8', '#dbeafe'],
                                            'accepted' => ['#065f46', '#d1fae5'],
                                            'rejected' => ['#991b1b', '#fee2e2'],
                                        ];
                                        $s = $sc[$app->status] ?? ['#6b7280', '#f3f4f6'];
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-3 text-muted">
                                            {{ $applications->firstItem() + $loop->index }}
                                        </td>
                                        <td class="py-3 fw-semibold" style="color:var(--navy-800);">
                                            {{ $app->org ?? '—' }}
                                        </td>
                                        <td class="py-3 text-muted">{{ $app->role ?? '—' }}</td>
                                        <td class="py-3">
                                            <span class="badge text-capitalize"
                                                  style="background:{{ $s[1] }};color:{{ $s[0] }};
                                                         font-size:0.72rem;border-radius:6px;padding:4px 10px;">
                                                {{ $app->status ?? '—' }}
                                            </span>
                                        </td>
                                        <td class="py-3 text-muted">{{ $app->date ?? '—' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox" style="font-size:2.5rem;opacity:0.3;"></i>
                                            <p class="mt-2 mb-0">You haven't applied to anything yet.</p>
                                            <a href="{{ route('my_opportunities') }}" class="btn btn-sm mt-3"
                                               style="background:#0f766e;color:#fff;border-radius:6px;">
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
                    <div class="card-footer bg-white px-4 py-3" style="border-top:1px solid #f3f4f6;">
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