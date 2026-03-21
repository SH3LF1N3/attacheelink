
{{-- Status Cards --}}
<div class="row g-3 mb-4">
    @php
    $cards = [
        ['label' => 'Total Applied',  'value' => $stats['total_apps'],   'icon' => 'bi-file-earmark-text-fill', 'color' => 'var(--navy-700)'],
        ['label' => 'Pending',        'value' => $stats['pending'],      'icon' => 'bi-hourglass-split',        'color' => '#b45309'],
        ['label' => 'Under Review',   'value' => $stats['under_review'], 'icon' => 'bi-eye-fill',               'color' => '#1d4ed8'],
        ['label' => 'Accepted',       'value' => $stats['accepted'],     'icon' => 'bi-check-circle-fill',      'color' => '#059669'],
        ['label' => 'Rejected',       'value' => $stats['rejected'],     'icon' => 'bi-x-circle-fill',          'color' => '#dc2626'],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="col-6 col-md-4 col-lg">
        <div class="card shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">
            <div class="card-body p-3">
                <div style="width:38px;height:38px;border-radius:10px;margin-bottom:10px;
                            background:{{ $card['color'] }}20;
                            display:flex;align-items:center;justify-content:center;">
                    <i class="bi {{ $card['icon'] }}" style="color:{{ $card['color'] }};font-size:1rem;"></i>
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

    {{-- My Recent Applications --}}
    <div class="col-lg-7">
        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
            <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                 style="border-bottom:1px solid #f3f4f6;">
                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                    <i class="bi bi-file-earmark-text me-2" style="color:#0f766e;"></i>My Recent Applications
                </h6>
                <a href="{{ route('my_applications') }}" class="btn btn-sm"
                   style="background:#0f766e;color:#fff;border-radius:6px;font-size:0.75rem;">
                    View All
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size:0.8rem;">
                        <thead style="background:#f9fafb;">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold">Organisation</th>
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
                                <td class="px-4 py-3 fw-semibold" style="color:var(--navy-800);">
                                    {{ $app->org ?? '—' }}
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
                                    <p class="mt-2 mb-0 small">You haven't applied to anything yet.</p>
                                    
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Open Opportunities --}}
    <div class="col-lg-5">
        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
            <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                 style="border-bottom:1px solid #f3f4f6;">
                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                    <i class="bi bi-list-task me-2" style="color:#0f766e;"></i>Open Opportunities
                </h6>
                <a href="{{ route('my_opportunities') }}" class="btn btn-sm"
                   style="background:#0f766e;color:#fff;border-radius:6px;font-size:0.75rem;">
                    Browse All
                </a>
            </div>
            <div class="card-body p-0">
                @forelse($stats['open_oppo'] as $oppo)
                <div class="px-4 py-3" style="border-bottom:1px solid #f9fafb;">
                    <div class="d-flex align-items-start justify-content-between gap-2">
                        <div style="min-width:0;">
                            <div class="fw-semibold text-truncate"
                                 style="font-size:0.875rem;color:var(--navy-800);">
                                {{ $oppo->oname ?? '—' }}
                            </div>
                            <div style="font-size:0.75rem;color:#6b7280;margin-top:2px;">
                                <i class="bi bi-building me-1"></i>{{ $oppo->org ?? '—' }}
                                @if($oppo->loc)
                                    &nbsp;·&nbsp;<i class="bi bi-geo-alt me-1"></i>{{ $oppo->loc }}
                                @endif
                            </div>
                        </div>
                        @if($oppo->dead)
                        <div class="text-nowrap" style="font-size:0.7rem;color:#dc2626;
                                    background:#fee2e2;padding:2px 8px;border-radius:6px;flex-shrink:0;">
                            <i class="bi bi-clock me-1"></i>{{ $oppo->dead }}
                        </div>
                        @endif
                    </div>
                    @if($oppo->slot)
                    <div style="font-size:0.72rem;color:#059669;margin-top:4px;">
                        <i class="bi bi-people me-1"></i>{{ $oppo->slot }} slot(s) available
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-list-task" style="font-size:2rem;opacity:0.3;"></i>
                    <p class="mt-2 mb-0 small">No open opportunities right now.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>