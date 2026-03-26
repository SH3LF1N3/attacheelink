@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">Applications</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Applications</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card shadow-sm" style="border:1px solid #e8edf3;border-radius:12px;overflow:hidden;">

                    {{-- Header --}}
                    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                         style="border-bottom:1px solid #f0f4f8;">
                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                            <i class="bi bi-briefcase me-2" style="color:var(--navy-600);"></i>
                            {{ Auth::user()->role === 'admin' ? 'All Opportunities' : 'Your Opportunities' }}
                            <span class="ms-2"
                                  style="background:var(--navy-50);color:var(--navy-700);
                                         font-size:0.75rem;font-weight:700;
                                         padding:2px 10px;border-radius:var(--radius-full);">
                                {{ $opportunities->total() }}
                            </span>
                        </h6>
                        @if(Auth::user()->role === 'company')
                        <a href="{{ route('oppo.create') }}"
                           style="background:var(--navy-700);color:#fff;padding:0.45rem 1.1rem;
                                  border-radius:var(--radius-sm);font-size:0.875rem;font-weight:600;
                                  text-decoration:none;">
                            + Post New
                        </a>
                        @endif
                    </div>

                    {{-- Table --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="font-size:0.875rem;">
                                <thead style="background:#f9fafb;">
                                    <tr>
                                        <th class="px-4 py-3 text-muted fw-semibold">Title</th>
                                        <th class="py-3 text-muted fw-semibold">Type</th>
                                        <th class="py-3 text-muted fw-semibold">County</th>
                                        <th class="py-3 text-muted fw-semibold">Deadline</th>
                                        <th class="py-3 text-muted fw-semibold">Applicants</th>
                                        <th class="py-3 text-muted fw-semibold">Status</th>
                                        <th class="py-3 text-muted fw-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($opportunities as $oppo)
                                    @php
                                        $statusColors = [
                                            'active' => ['#15803d', '#f0fdf4'],
                                            'closed' => ['#fff',    '#1e293b'],
                                            'draft'  => ['#92400e', '#fef9ec'],
                                        ];
                                        $sc = $statusColors[$oppo->status] ?? ['#52525b', '#f5f5f6'];
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-3 fw-semibold" style="color:var(--navy-800);">
                                            {{ $oppo->oname }}
                                        </td>
                                        <td class="py-3" style="color:var(--charcoal-500);">
                                            {{ $oppo->foth1 ?? 'Attachment' }}
                                        </td>
                                        <td class="py-3" style="color:var(--charcoal-500);">
                                            {{ $oppo->loc ?? '—' }}
                                        </td>
                                        <td class="py-3" style="color:var(--charcoal-400);">
                                            {{ $oppo->dead ? \Carbon\Carbon::parse($oppo->dead)->format('M d, Y') : '—' }}
                                        </td>
                                        <td class="py-3">
                                            @if($oppo->applications_count > 0)
                                                <button class="btn-applicants-link"
                                                        data-oppo-id="{{ $oppo->id }}"
                                                        data-oppo-name="{{ $oppo->oname }}"
                                                        style="background:none;border:none;padding:0;
                                                               color:var(--navy-700);font-weight:700;
                                                               font-size:0.875rem;cursor:pointer;
                                                               text-decoration:underline;">
                                                    {{ $oppo->applications_count }}
                                                </button>
                                            @else
                                                <span style="color:var(--charcoal-400);">0</span>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            <span style="background:{{ $sc[1] }};color:{{ $sc[0] }};
                                                         font-size:0.72rem;font-weight:700;
                                                         padding:3px 12px;border-radius:var(--radius-full);
                                                         text-transform:capitalize;">
                                                {{ ucfirst($oppo->status) }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('oppo.edit', $oppo) }}"
                                                   style="background:var(--navy-50);color:var(--navy-700);
                                                          border:1px solid var(--navy-200);
                                                          padding:4px 12px;border-radius:6px;
                                                          font-size:0.78rem;font-weight:600;
                                                          text-decoration:none;">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('oppo.destroy', $oppo) }}"
                                                      onsubmit="return confirm('Delete this opportunity?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            style="background:#fef2f2;color:#b91c1c;
                                                                   border:1px solid #fecaca;
                                                                   padding:4px 12px;border-radius:6px;
                                                                   font-size:0.78rem;font-weight:600;
                                                                   cursor:pointer;">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="bi bi-inbox" style="font-size:2.5rem;color:#d1d9e2;"></i>
                                            <p class="mt-2 mb-0" style="color:var(--charcoal-400);font-size:0.875rem;">
                                                No opportunities found.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($opportunities->hasPages())
                    <div class="card-footer bg-white px-4 py-3" style="border-top:1px solid #f0f4f8;">
                        {{ $opportunities->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

{{-- ═══════════════════════════════════════════════════
     Applicants Modal
═══════════════════════════════════════════════════ --}}
<div id="applicantsModal"
     style="display:none;position:fixed;inset:0;z-index:1050;
            background:rgba(15,23,42,0.45);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:14px;width:100%;max-width:680px;
                margin:1rem;max-height:90vh;display:flex;flex-direction:column;
                box-shadow:0 20px 60px rgba(0,0,0,0.18);">

        {{-- Modal header --}}
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;">
            <div>
                <h5 id="modalTitle" class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1rem;"></h5>
                <p id="modalSubtitle" class="mb-0 mt-1" style="color:var(--charcoal-400);font-size:0.8rem;"></p>
            </div>
            <button onclick="closeModal()"
                    style="background:none;border:none;font-size:1.4rem;
                           color:var(--charcoal-400);cursor:pointer;line-height:1;">&times;</button>
        </div>

        {{-- Modal body --}}
        <div id="modalBody" style="overflow-y:auto;padding:1.25rem 1.5rem;flex:1;">
            <div id="modalLoading" class="text-center py-4">
                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                <p class="mt-2 mb-0" style="color:var(--charcoal-400);font-size:0.85rem;">Loading applicants…</p>
            </div>
            <div id="applicantsList"></div>
        </div>
    </div>
</div>

<script>
const statusLabels = {
    pending:     { label: 'Pending',     bg: '#fef9ec', color: '#b45309' },
    review:      { label: 'Under Review',bg: '#eff6ff', color: '#1d4ed8' },
    shortlisted: { label: 'Shortlisted', bg: '#f0fdf4', color: '#15803d' },
    rejected:    { label: 'Rejected',    bg: '#fef2f2', color: '#b91c1c' },
};

document.querySelectorAll('.btn-applicants-link').forEach(btn => {
    btn.addEventListener('click', () => {
        const oppoId   = btn.dataset.oppoId;
        const oppoName = btn.dataset.oppoName;
        openApplicantsModal(oppoId, oppoName);
    });
});

function openApplicantsModal(oppoId, oppoName) {
    document.getElementById('applicantsModal').style.display = 'flex';
    document.getElementById('modalTitle').textContent    = 'Applicants for ' + oppoName;
    document.getElementById('modalSubtitle').textContent = '';
    document.getElementById('modalLoading').style.display = 'block';
    document.getElementById('applicantsList').innerHTML   = '';

    fetch(`/opportunities/${oppoId}/applicants`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('modalLoading').style.display = 'none';
        document.getElementById('modalSubtitle').textContent  = data.total + ' total application' + (data.total !== 1 ? 's' : '');
        renderApplicants(data.applicants);
    })
    .catch(() => {
        document.getElementById('modalLoading').style.display = 'none';
        document.getElementById('applicantsList').innerHTML =
            '<p class="text-center text-danger py-3">Failed to load applicants.</p>';
    });
}

function renderApplicants(applicants) {
    const list = document.getElementById('applicantsList');
    if (!applicants.length) {
        list.innerHTML = '<p class="text-center py-4" style="color:#94a3b8;">No applicants yet.</p>';
        return;
    }
    list.innerHTML = applicants.map(a => {
        const s = statusLabels[a.status] || statusLabels.pending;
        return `
        <div style="border:1px solid #e8edf3;border-radius:10px;padding:1rem 1.1rem;margin-bottom:0.85rem;">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <p class="mb-1 fw-bold" style="color:var(--navy-800);font-size:0.95rem;">${a.name}
                        <span style="background:${s.bg};color:${s.color};font-size:0.7rem;
                                     font-weight:700;padding:2px 10px;border-radius:20px;
                                     margin-left:8px;text-transform:capitalize;">${s.label}</span>
                    </p>
                    <p class="mb-1" style="color:var(--charcoal-400);font-size:0.8rem;">
                        <i class="bi bi-envelope me-1"></i>${a.email}
                        &nbsp;&nbsp;<i class="bi bi-telephone me-1"></i>${a.phone}
                    </p>
                    <p class="mb-0" style="color:var(--charcoal-400);font-size:0.8rem;">
                        <i class="bi bi-calendar me-1"></i>Applied: ${a.applied_at}
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button onclick="updateStatus(${a.id}, 'shortlisted', this)"
                        style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;
                               padding:4px 14px;border-radius:6px;font-size:0.78rem;font-weight:600;cursor:pointer;">
                    ✓ Shortlist
                </button>
                <button onclick="updateStatus(${a.id}, 'review', this)"
                        style="background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;
                               padding:4px 14px;border-radius:6px;font-size:0.78rem;font-weight:600;cursor:pointer;">
                    Under Review
                </button>
                <button onclick="updateStatus(${a.id}, 'rejected', this)"
                        style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;
                               padding:4px 14px;border-radius:6px;font-size:0.78rem;font-weight:600;cursor:pointer;">
                    ✕ Reject
                </button>
            </div>
        </div>`;
    }).join('');
}

function updateStatus(applicationId, status, btn) {
    btn.disabled = true;
    fetch(`/applications/${applicationId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ status })
    })
    .then(r => r.json())
    .then(data => {
        // Update the badge in the card
        const card   = btn.closest('div[style*="border:1px solid #e8edf3"]');
        const badge  = card.querySelector('span[style*="border-radius:20px"]');
        const s      = statusLabels[data.status] || statusLabels.pending;
        badge.textContent        = s.label;
        badge.style.background   = s.bg;
        badge.style.color        = s.color;
        btn.disabled = false;
    })
    .catch(() => { btn.disabled = false; });
}

function closeModal() {
    document.getElementById('applicantsModal').style.display = 'none';
}

// Close on backdrop click
document.getElementById('applicantsModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

</body>
</html>