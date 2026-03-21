{{--
    Partial: dash.set.partials.logs-table
    Variables: $logs (paginator), $roles (collection)
--}}

<div class="card shadow-sm" style="border: none; border-radius: 12px; overflow: hidden;">

    {{-- Toolbar --}}
    <div class="card-header bg-white py-3 px-4 d-flex flex-wrap gap-3 align-items-center justify-content-between"
         style="border-bottom: 1px solid #f3f4f6;">

        {{-- Filters --}}
        <form method="GET" action="{{ route('system_logs') }}"
              class="d-flex flex-wrap gap-2 align-items-center">

            <select name="role" class="form-select form-select-sm" style="width: auto; min-width: 130px;">
                <option value="">All Roles</option>
                @foreach($roles as $r)
                    <option value="{{ $r }}" {{ request('role') == $r ? 'selected' : '' }}>
                        {{ ucfirst($r) }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="service" value="{{ request('service') }}"
                   placeholder="Search service…"
                   class="form-control form-control-sm" style="width: auto; min-width: 180px;">

            <button type="submit" class="btn btn-sm"
                    style="background: var(--navy-700); color: #fff; border-radius: 6px;">
                <i class="bi bi-search me-1"></i> Filter
            </button>

            @if(request()->hasAny(['role', 'service']))
            <a href="{{ route('system_logs') }}" class="btn btn-sm btn-outline-secondary"
               style="border-radius: 6px;">
                <i class="bi bi-x me-1"></i> Clear
            </a>
            @endif
        </form>

        {{-- Clear all logs --}}
        <form action="{{ route('system_logs.clear') }}" method="POST"
              onsubmit="return confirm('Clear ALL system logs? This cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;">
                <i class="bi bi-trash me-1"></i> Clear All Logs
            </button>
        </form>
    </div>

    {{-- Table --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size: 0.875rem;">
                <thead style="background: #f9fafb;">
                    <tr>
                        <th class="px-4 py-3 text-muted fw-semibold">#</th>
                        <th class="py-3 text-muted fw-semibold">User</th>
                        <th class="py-3 text-muted fw-semibold">Role</th>
                        <th class="py-3 text-muted fw-semibold">Service / Action</th>
                        <th class="py-3 text-muted fw-semibold">Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="px-4 py-3 text-muted">{{ $logs->firstItem() + $loop->index }}</td>
                        <td class="py-3">
                            <div class="fw-semibold" style="color: var(--navy-800);">{{ $log->uname ?? '—' }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">ID: {{ $log->uid ?? '—' }}</div>
                        </td>
                        <td class="py-3">
                            @php
                                $badgeColors = ['admin' => '#1e3a5f', 'student' => '#0f766e', 'company' => '#b45309'];
                                $bc = $badgeColors[$log->role] ?? '#6b7280';
                            @endphp
                            <span class="badge text-white text-capitalize"
                                  style="background: {{ $bc }}; font-size: 0.75rem; border-radius: 6px;">
                                {{ $log->role ?? '—' }}
                            </span>
                        </td>
                        <td class="py-3" style="color: #374151;">{{ $log->service ?? '—' }}</td>
                        <td class="py-3 text-muted">{{ $log->created_at?->format('d M Y, H:i') ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-journal-x" style="font-size: 2rem; opacity: 0.4;"></i>
                            <p class="mt-2 mb-0">No log entries found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($logs->hasPages())
    <div class="card-footer bg-white px-4 py-3" style="border-top: 1px solid #f3f4f6;">
        {{ $logs->links() }}
    </div>
    @endif
</div>