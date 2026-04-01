{{-- Partial: dash.partials.reports.apps-tab --}}

<div class="card shadow-sm mt-3" style="border:none;border-radius:0 0 12px 12px;overflow:hidden;">
    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
         style="border-bottom:1px solid #f3f4f6;">
        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
            <i class="bi bi-bar-chart me-2" style="color:var(--navy-700);"></i>
            Applications by Opportunity — ranked highest
        </h6>
        <a href="{{ route('reports.applications.pdf') }}" class="btn btn-sm"
           style="background:var(--navy-700);color:#fff;border-radius:6px;font-size:.8rem;">
            <i class="bi bi-download me-1"></i>Download PDF
        </a>
    </div>

    <div class="card-body p-0">
        @forelse($appsByOrg as $i => $row)
        @php $maxTotal = $appsByOrg->max('total') ?: 1; @endphp
        <div class="px-4 py-3" style="border-bottom:1px solid #f9fafb;">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <div>
                    <span class="fw-semibold" style="color:var(--navy-800);font-size:.9rem;">
                        {{ $row['oname'] }}
                    </span>
                    <span style="font-size:.75rem;color:#9ca3af;margin-left:8px;">{{ $row['org'] }}</span>
                </div>
                <span class="fw-bold" style="color:var(--navy-700);font-size:.9rem;">#{{ $i + 1 }}</span>
            </div>

            {{-- Bar --}}
            <div style="height:8px;background:#f3f4f6;border-radius:999px;margin-bottom:8px;">
                <div style="height:100%;width:{{ ($row['total'] / $maxTotal) * 100 }}%;
                            background:var(--navy-700);border-radius:999px;transition:.3s;"></div>
            </div>

            {{-- Status badges --}}
            <div class="d-flex flex-wrap gap-2">
                @foreach([
                    ['total',       $row['total'],        '#e8edf3', 'var(--navy-800)', 'Total'],
                    ['pending',     $row['pending'],       '#fef9ec', '#b45309',        'Pending'],
                    ['review',      $row['review'],        '#dbeafe', '#1d4ed8',        'Review'],
                    ['shortlisted', $row['shortlisted'],   '#d1fae5', '#065f46',        'Shortlisted'],
                    ['rejected',    $row['rejected'],      '#fee2e2', '#991b1b',        'Rejected'],
                ] as [$key, $val, $bg, $color, $label])
                <span style="background:{{ $bg }};color:{{ $color }};font-size:.72rem;
                             padding:2px 10px;border-radius:6px;font-weight:600;">
                    {{ $label }}: {{ $val }}
                </span>
                @endforeach
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="bi bi-inbox" style="font-size:2.5rem;opacity:.3;"></i>
            <p class="mt-2 mb-0 small">No applications yet.</p>
        </div>
        @endforelse
    </div>
</div>