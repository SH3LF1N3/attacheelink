
{{--  Stat Cards --}}
<div class="row g-3 mb-4">
    @php
    $cards = [
        ['label' => 'Total Listings',    'value' => $stats['total_listings'],  'icon' => 'bi-list-task',               'color' => '#b45309'],
        ['label' => 'Active Listings',   'value' => $stats['active_listings'], 'icon' => 'bi-check-circle-fill',       'color' => '#059669'],
        ['label' => 'Total Applications','value' => $stats['total_apps'],      'icon' => 'bi-file-earmark-text-fill',  'color' => 'var(--navy-700)'],
        ['label' => 'Pending Review',    'value' => $stats['pending_apps'],    'icon' => 'bi-hourglass-split',         'color' => '#dc2626'],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="col-6 col-md-3">
        <div class="card shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">
            <div class="card-body p-3">
                <div style="width:40px;height:40px;border-radius:10px;margin-bottom:10px;
                            background:{{ $card['color'] }}20;
                            display:flex;align-items:center;justify-content:center;">
                    <i class="bi {{ $card['icon'] }}" style="color:{{ $card['color'] }};font-size:1.1rem;"></i>
                </div>
                <div style="font-size:1.8rem;font-weight:700;color:var(--navy-800);line-height:1;">
                    {{ $card['value'] }}
                </div>
                <div style="font-size:0.75rem;color:#6b7280;margin-top:4px;">{{ $card['label'] }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-3">

    {{-- My Opportunity Listings --}}
    <div class="col-lg-5">
        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
            <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                 style="border-bottom:1px solid #f3f4f6;">
                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                    <i class="bi bi-list-task me-2" style="color:#b45309;"></i>My Listings
                </h6>
                <a href="{{ route('opportunities') }}" class="btn btn-sm"
                   style="background:#b45309;color:#fff;border-radius:6px;font-size:0.75rem;">
                    Manage
                </a>
            </div>
            <div class="card-body p-0">
                @forelse($stats['my_oppo'] as $oppo)
                @php
                    $oc = ['active'=>['#059669','#d1fae5'],'closed'=>['#6b7280','#f3f4f6'],
                           'draft'=>['#1d4ed8','#dbeafe']];
                    $os = $oc[$oppo->status] ?? ['#6b7280','#f3f4f6'];
                @endphp
                <div class="px-4 py-3" style="border-bottom:1px solid #f9fafb;">
                    <div class="d-flex align-items-start justify-content-between gap-2">
                        <div style="min-width:0;">
                            <div class="fw-semibold text-truncate"
                                 style="font-size:0.875rem;color:var(--navy-800);">
                                {{ $oppo->oname ?? '—' }}
                            </div>
                            <div style="font-size:0.75rem;color:#6b7280;margin-top:2px;">
                                @if($oppo->loc)
                                    <i class="bi bi-geo-alt me-1"></i>{{ $oppo->loc }}
                                @endif
                                @if($oppo->duration)
                                    &nbsp;·&nbsp;<i class="bi bi-clock me-1"></i>{{ $oppo->duration }}
                                @endif
                            </div>
                        </div>
                        <span class="badge text-capitalize text-nowrap"
                              style="background:{{ $os[1] }};color:{{ $os[0] }};
                                     font-size:0.7rem;border-radius:6px;flex-shrink:0;">
                            {{ $oppo->status ?? '—' }}
                        </span>
                    </div>
                    @if($oppo->dead)
                    <div style="font-size:0.72rem;color:#dc2626;margin-top:4px;">
                        <i class="bi bi-calendar-x me-1"></i>Deadline: {{ $oppo->dead }}
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-list-task" style="font-size:2rem;opacity:0.3;"></i>
                    <p class="mt-2 mb-0 small">No listings posted yet.</p>
                    
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Applicants --}}
    <div class="col-lg-7">
        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
            <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                 style="border-bottom:1px solid #f3f4f6;">
                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                    <i class="bi bi-people me-2" style="color:#b45309;"></i>Recent Applicants
                </h6>
                <a href="{{ route('applications') }}" class="btn btn-sm"
                   style="background:#b45309;color:#fff;border-radius:6px;font-size:0.75rem;">
                    View All
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size:0.8rem;">
                        <thead style="background:#f9fafb;">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold">Student</th>
                                <th class="py-3 text-muted fw-semibold">Role / Position</th>
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
                                <td class="px-4 py-3">
                                    <div class="fw-semibold" style="color:var(--navy-800);font-size:0.875rem;">
                                        {{ $app->stud ?? '—' }}
                                    </div>
                                </td>
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
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox" style="font-size:2rem;opacity:0.3;"></i>
                                    <p class="mt-2 mb-0 small">No applications received yet.</p>
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