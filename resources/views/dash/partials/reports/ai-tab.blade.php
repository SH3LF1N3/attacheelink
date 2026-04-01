{{-- Partial: dash.partials.reports.ai-tab --}}

<div class="card shadow-sm mt-3" style="border:none;border-radius:0 0 12px 12px;overflow:hidden;">
    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
         style="border-bottom:1px solid #f3f4f6;">
        <ul class="nav nav-pills gap-1">
            @foreach([
                ['#sub-ai-ass',   'AI Assistant',     $aiAssistant['total']],
                ['#sub-ai-cv',    'Resume Checker',   $aiResume['total']],
                ['#sub-ai-anal',  'AI Analytics',     $aiAnalytics['total']],
            ] as [$target, $label, $count])
            <li class="nav-item">
                <button class="nav-link {{ $loop->first ? 'active' : '' }} py-1 px-3"
                        data-bs-toggle="pill" data-bs-target="{{ $target }}"
                        style="font-size:.875rem;border-radius:6px;">
                    {{ $label }}
                    <span class="badge ms-1" style="background:var(--navy-700);color:#fff;font-size:.68rem;">
                        {{ $count }}
                    </span>
                </button>
            </li>
            @endforeach
        </ul>
        <a href="{{ route('reports.ai.pdf') }}" class="btn btn-sm"
           style="background:var(--navy-700);color:#fff;border-radius:6px;font-size:.8rem;">
            <i class="bi bi-download me-1"></i>Download PDF
        </a>
    </div>

    <div class="tab-content card-body p-0">
        @foreach([
            ['sub-ai-ass',  $aiAssistant,  'AI Assistant'],
            ['sub-ai-cv',   $aiResume,     'AI Resume Checker'],
            ['sub-ai-anal', $aiAnalytics,  'AI Analytics'],
        ] as [$id, $usage, $title])
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $id }}">

            {{-- Stats strip --}}
            <div class="d-flex flex-wrap gap-4 px-4 py-3"
                 style="border-bottom:1px solid #f9fafb;background:#fafafa;">
                <div>
                    <div style="font-size:1.4rem;font-weight:700;color:var(--navy-700);">{{ $usage['total'] }}</div>
                    <div style="font-size:.75rem;color:#6b7280;">Total Uses</div>
                </div>
                @foreach($usage['by_role'] as $role => $count)
                <div>
                    <div style="font-size:1.4rem;font-weight:700;color:#0f766e;">{{ $count }}</div>
                    <div style="font-size:.75rem;color:#6b7280;text-transform:capitalize;">{{ $role }}</div>
                </div>
                @endforeach
            </div>

            {{-- Recent activity --}}
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:.875rem;">
                    <thead style="background:#f9fafb;">
                        <tr>
                            <th class="px-4 py-3 text-muted fw-semibold">#</th>
                            <th class="py-3 text-muted fw-semibold">User</th>
                            <th class="py-3 text-muted fw-semibold">Role</th>
                            <th class="py-3 text-muted fw-semibold">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usage['recent'] as $i => $log)
                        <tr>
                            <td class="px-4 py-3 text-muted">{{ $i + 1 }}</td>
                            <td class="py-3 fw-semibold" style="color:var(--navy-800);">{{ $log->uname ?? '—' }}</td>
                            <td class="py-3">
                                <span class="badge text-capitalize"
                                      style="background:#f3f4f6;color:#374151;font-size:.72rem;border-radius:6px;">
                                    {{ $log->role ?? '—' }}
                                </span>
                            </td>
                            <td class="py-3 text-muted">{{ $log->created_at?->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">No usage recorded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>