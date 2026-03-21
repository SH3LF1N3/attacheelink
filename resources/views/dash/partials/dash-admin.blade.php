{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    @php
    $cards = [
        ['label' => 'Total Students',      'value' => $stats['total_students'],  'icon' => 'bi-people-fill',              'color' => 'var(--navy-700)'],
        ['label' => 'Organisations',        'value' => $stats['total_companies'],  'icon' => 'bi-building-fill',           'color' => '#0f766e'],
        ['label' => 'Opportunities',        'value' => $stats['total_oppo'],       'icon' => 'bi-list-task',               'color' => '#b45309'],
        ['label' => 'Total Applications',   'value' => $stats['total_apps'],       'icon' => 'bi-file-earmark-text-fill',  'color' => '#7c3aed'],
        ['label' => 'Pending Applications', 'value' => $stats['pending_apps'],     'icon' => 'bi-hourglass-split',         'color' => '#dc2626'],
        ['label' => 'Active Opportunities', 'value' => $stats['active_oppo'],      'icon' => 'bi-check-circle-fill',       'color' => '#059669'],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 shadow-sm" style="border:none; border-radius:12px; overflow:hidden;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div style="width:38px;height:38px;border-radius:10px;
                                background:{{ $card['color'] }}20;
                                display:flex;align-items:center;justify-content:center;">
                        <i class="bi {{ $card['icon'] }}" style="color:{{ $card['color'] }};font-size:1rem;"></i>
                    </div>
                </div>
                <div style="font-size:1.6rem;font-weight:700;color:var(--navy-800);line-height:1;">
                    {{ $card['value'] }}
                </div>
                <div style="font-size:0.75rem;color:#6b7280;margin-top:4px;">{{ $card['label'] }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Recent Users + Recent Applications --}}
<div class="row g-3">

    {{-- Recent Users --}}
    <div class="col-lg-5">
        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
            <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                 style="border-bottom:1px solid #f3f4f6;">
                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                    <i class="bi bi-people me-2" style="color:var(--navy-700);"></i>Recent Users
                </h6>
                <a href="{{ route('students') }}" class="btn btn-sm"
                   style="background:var(--navy-700);color:#fff;border-radius:6px;font-size:0.75rem;">
                    View All
                </a>
            </div>
            <div class="card-body p-0">
                @forelse($stats['recent_users'] as $u)
                <div class="d-flex align-items-center px-4 py-3"
                     style="border-bottom:1px solid #f9fafb;">
                    <div style="width:34px;height:34px;border-radius:50%;flex-shrink:0;
                                background:var(--navy-700);color:#fff;font-weight:700;
                                display:flex;align-items:center;justify-content:center;font-size:0.85rem;">
                        {{ strtoupper(substr($u->fname ?? $u->uname, 0, 1)) }}
                    </div>
                    <div class="ms-3 grow" style="min-width:0;">
                        <div class="fw-semibold text-truncate" style="font-size:0.875rem;color:var(--navy-800);">
                            {{ $u->fname ?? $u->uname }}
                        </div>
                        <div class="text-truncate" style="font-size:0.75rem;color:#9ca3af;">{{ $u->email }}</div>
                    </div>
                    @php $rc = ['admin'=>'var(--navy-700)','student'=>'#0f766e','company'=>'#b45309']; @endphp
                    <span class="badge ms-2 text-capitalize"
                          style="background:{{ $rc[$u->role] ?? '#6b7280' }}20;
                                 color:{{ $rc[$u->role] ?? '#6b7280' }};font-size:0.7rem;border-radius:6px;">
                        {{ $u->role }}
                    </span>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-people" style="font-size:2rem;opacity:0.3;"></i>
                    <p class="mt-2 mb-0 small">No users yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Applications --}}
    <div class="col-lg-7">
        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
            <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                 style="border-bottom:1px solid #f3f4f6;">
                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                    <i class="bi bi-file-earmark-text me-2" style="color:var(--navy-700);"></i>Recent Applications
                </h6>
                <a href="{{ route('applications') }}" class="btn btn-sm"
                   style="background:var(--navy-700);color:#fff;border-radius:6px;font-size:0.75rem;">
                    View All
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size:0.8rem;">
                        <thead style="background:#f9fafb;">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold">Student</th>
                                <th class="py-3 text-muted fw-semibold">Organisation</th>
                                <th class="py-3 text-muted fw-semibold">Role</th>
                                <th class="py-3 text-muted fw-semibold">Status</th>
                                <th class="py-3 text-muted fw-semibold">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['recent_apps'] as $app)
                            @php
                                $sc = ['pending'=>['#b45309','#fef3c7'],'review'=>['#1d4ed8','#dbeafe'],
                                       'accepted'=>['#065f46','#d1fae5'],'rejected'=>['#991b1b','#fee2e2']];
                                $s  = $sc[$app->status] ?? ['#6b7280','#f3f4f6'];
                            @endphp
                            <tr>
                                <td class="px-4 py-3 fw-semibold" style="color:var(--navy-800);">
                                    {{ $app->stud ?? '—' }}
                                </td>
                                <td class="py-3 text-muted">{{ $app->org ?? '—' }}</td>
                                <td class="py-3 text-muted">{{ $app->role ?? '—' }}</td>
                                <td class="py-3">
                                    <span class="badge text-capitalize"
                                          style="background:{{ $s[1] }};color:{{ $s[0] }};
                                                 font-size:0.72rem;border-radius:6px;">
                                        {{ $app->status ?? '—' }}
                                    </span>
                                </td>
                                <td class="py-3 text-muted">{{ $app->date ?? '—' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox" style="font-size:2rem;opacity:0.3;"></i>
                                    <p class="mt-2 mb-0 small">No applications yet.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>