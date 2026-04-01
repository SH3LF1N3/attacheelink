{{-- Partial: dash.partials.reports.users-tab --}}

<div class="card shadow-sm mt-3" style="border:none;border-radius:0 0 12px 12px;overflow:hidden;">
    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
         style="border-bottom:1px solid #f3f4f6;">

        <ul class="nav nav-pills gap-1">
            <li class="nav-item">
                <button class="nav-link active py-1 px-3" data-bs-toggle="pill"
                        data-bs-target="#sub-students" style="font-size:.875rem;border-radius:6px;">
                    <i class="bi bi-mortarboard me-1"></i>Students
                    <span class="badge ms-1" style="background:var(--navy-700);color:#fff;font-size:.68rem;">
                        {{ $students['total'] }}
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link py-1 px-3" data-bs-toggle="pill"
                        data-bs-target="#sub-orgs" style="font-size:.875rem;border-radius:6px;">
                    <i class="bi bi-building me-1"></i>Organisations
                    <span class="badge ms-1" style="background:#b45309;color:#fff;font-size:.68rem;">
                        {{ $orgs['total'] }}
                    </span>
                </button>
            </li>
        </ul>

        <div class="d-flex gap-2">
            <a href="{{ route('reports.students.pdf') }}"
               class="btn btn-sm" id="btn-dl-students"
               style="background:var(--navy-700);color:#fff;border-radius:6px;font-size:.8rem;">
                <i class="bi bi-download me-1"></i>Download PDF
            </a>
            <a href="{{ route('reports.orgs.pdf') }}"
               class="btn btn-sm d-none" id="btn-dl-orgs"
               style="background:#b45309;color:#fff;border-radius:6px;font-size:.8rem;">
                <i class="bi bi-download me-1"></i>Download PDF
            </a>
        </div>
    </div>

    <div class="tab-content card-body p-0">

        {{-- Students subtab --}}
        <div class="tab-pane fade show active" id="sub-students">
            {{-- Summary strip --}}
            <div class="d-flex gap-4 px-4 py-3" style="border-bottom:1px solid #f9fafb;background:#fafafa;">
                @foreach([['Total', $students['total'], 'var(--navy-700)'], ['Applied', $students['with_apps'], '#059669'], ['Not Applied', $students['no_apps'], '#dc2626']] as [$label, $val, $color])
                <div>
                    <div style="font-size:1.4rem;font-weight:700;color:{{ $color }};">{{ $val }}</div>
                    <div style="font-size:.75rem;color:#6b7280;">{{ $label }}</div>
                </div>
                @endforeach
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:.875rem;">
                    <thead style="background:#f9fafb;">
                        <tr>
                            <th class="px-4 py-3 text-muted fw-semibold">#</th>
                            <th class="py-3 text-muted fw-semibold">Student</th>
                            <th class="py-3 text-muted fw-semibold">Username</th>
                            <th class="py-3 text-muted fw-semibold">Student ID</th>
                            <th class="py-3 text-muted fw-semibold">Gender</th>
                            <th class="py-3 text-muted fw-semibold">Applications</th>
                            <th class="py-3 text-muted fw-semibold">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students['list'] as $i => $s)
                        <tr>
                            <td class="px-4 py-3 text-muted">{{ $i + 1 }}</td>
                            <td class="py-3">
                                <div class="fw-semibold" style="color:var(--navy-800);">{{ $s->fname ?? '—' }}</div>
                                <div style="font-size:.75rem;color:#9ca3af;">{{ $s->email }}</div>
                            </td>
                            <td class="py-3 text-muted">{{ $s->uname }}</td>
                            <td class="py-3 text-muted">{{ $s->sid ?? '—' }}</td>
                            <td class="py-3 text-muted">{{ $s->gender ?? '—' }}</td>
                            <td class="py-3">
                                <span class="badge" style="background:{{ $s->total_apps > 0 ? '#d1fae5' : '#f3f4f6' }};
                                      color:{{ $s->total_apps > 0 ? '#065f46' : '#6b7280' }};border-radius:6px;">
                                    {{ $s->total_apps }}
                                </span>
                            </td>
                            <td class="py-3 text-muted">{{ $s->created_at?->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-5 text-muted">No students found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Organisations subtab --}}
        <div class="tab-pane fade" id="sub-orgs">
            <div class="d-flex gap-4 px-4 py-3" style="border-bottom:1px solid #f9fafb;background:#fafafa;">
                <div>
                    <div style="font-size:1.4rem;font-weight:700;color:#b45309;">{{ $orgs['total'] }}</div>
                    <div style="font-size:.75rem;color:#6b7280;">Total Organisations</div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:.875rem;">
                    <thead style="background:#f9fafb;">
                        <tr>
                            <th class="px-4 py-3 text-muted fw-semibold">#</th>
                            <th class="py-3 text-muted fw-semibold">Organisation</th>
                            <th class="py-3 text-muted fw-semibold">Contact</th>
                            <th class="py-3 text-muted fw-semibold">Industry</th>
                            <th class="py-3 text-muted fw-semibold">Location</th>
                            <th class="py-3 text-muted fw-semibold">Opportunities</th>
                            <th class="py-3 text-muted fw-semibold">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orgs['list'] as $i => $o)
                        <tr>
                            <td class="px-4 py-3 text-muted">{{ $i + 1 }}</td>
                            <td class="py-3">
                                <div class="fw-semibold" style="color:var(--navy-800);">{{ $o->foth1 ?? $o->uname }}</div>
                                <div style="font-size:.75rem;color:#9ca3af;">{{ $o->email }}</div>
                            </td>
                            <td class="py-3 text-muted">{{ $o->fname ?? '—' }}</td>
                            <td class="py-3 text-muted">{{ $o->foth2 ?? '—' }}</td>
                            <td class="py-3 text-muted">{{ $o->foth3 ?? '—' }}</td>
                            <td class="py-3">
                                <span class="badge" style="background:#fef9ec;color:#b45309;border-radius:6px;">
                                    {{ $orgs['oppoCounts'][$o->uname] ?? 0 }}
                                </span>
                            </td>
                            <td class="py-3 text-muted">{{ $o->created_at?->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-5 text-muted">No organisations found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
document.querySelectorAll('[data-bs-target="#sub-students"], [data-bs-target="#sub-orgs"]').forEach(btn => {
    btn.addEventListener('shown.bs.tab', function () {
        const isOrg = this.dataset.bsTarget === '#sub-orgs';
        document.getElementById('btn-dl-students').classList.toggle('d-none', isOrg);
        document.getElementById('btn-dl-orgs').classList.toggle('d-none', !isOrg);
    });
});
</script>