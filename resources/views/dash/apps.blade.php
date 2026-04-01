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

{{-- ═══════════════════════════════════════
     APPLICANTS LIST MODAL
═══════════════════════════════════════ --}}
<div id="applicantsModal"
     style="display:none;position:fixed;inset:0;z-index:1050;
            background:rgba(15,23,42,0.5);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:700px;
                margin:1rem;max-height:88vh;display:flex;flex-direction:column;
                box-shadow:0 24px 64px rgba(0,0,0,0.2);">

        {{-- Header --}}
        <div style="padding:1.4rem 1.75rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
            <div>
                <h5 id="modalTitle" class="mb-0 fw-bold" style="color:#1e293b;font-size:1.05rem;"></h5>
                <p id="modalSubtitle" class="mb-0 mt-1" style="color:#94a3b8;font-size:0.82rem;"></p>
            </div>
            <button onclick="closeApplicantsModal()"
                    style="background:none;border:none;font-size:1.5rem;
                           color:#94a3b8;cursor:pointer;line-height:1;padding:4px;">&times;</button>
        </div>

        {{-- Body --}}
        <div style="overflow-y:auto;padding:1.25rem 1.75rem;flex:1;">
            <div id="modalLoading" class="text-center py-5">
                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                <p class="mt-2 mb-0" style="color:#94a3b8;font-size:0.85rem;">Loading applicants…</p>
            </div>
            <div id="applicantsList"></div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     FULL APPLICATION DETAIL MODAL
═══════════════════════════════════════ --}}
<div id="detailModal"
     style="display:none;position:fixed;inset:0;z-index:1060;
            background:rgba(15,23,42,0.55);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:620px;
                margin:1rem;max-height:90vh;display:flex;flex-direction:column;
                box-shadow:0 24px 64px rgba(0,0,0,0.22);">

        {{-- Header --}}
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
            <h5 class="mb-0 fw-bold" style="color:#1e293b;font-size:1rem;">Application Details</h5>
            <button onclick="closeDetailModal()"
                    style="background:none;border:none;font-size:1.5rem;
                           color:#94a3b8;cursor:pointer;line-height:1;padding:4px;">&times;</button>
        </div>

        {{-- Body --}}
        <div style="overflow-y:auto;padding:1.5rem;flex:1;">
            <div id="detailLoading" class="text-center py-5">
                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
            </div>
            <div id="detailContent" style="display:none;">

                {{-- Student profile card --}}
                <div style="border:1px solid #e8edf3;border-radius:12px;padding:1.1rem 1.25rem;margin-bottom:1.25rem;">
                    <div style="display:flex;align-items:center;gap:0.9rem;">
                        <div id="detailAvatar"
                             style="width:48px;height:48px;border-radius:50%;
                                    background:var(--navy-700);color:#fff;
                                    display:flex;align-items:center;justify-content:center;
                                    font-weight:700;font-size:1rem;flex-shrink:0;"></div>
                        <div style="flex:1;">
                            <div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap;">
                                <span id="detailName" style="font-weight:700;font-size:1rem;color:#1e293b;"></span>
                                <span id="detailStatusBadge"
                                      style="font-size:0.7rem;font-weight:700;padding:2px 10px;
                                             border-radius:20px;text-transform:capitalize;"></span>
                            </div>
                            <div id="detailOppo" style="font-size:0.8rem;color:#94a3b8;margin-top:2px;"></div>
                        </div>
                    </div>
                    <div style="margin-top:0.85rem;display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;">
                        <div id="detailEmail" style="font-size:0.82rem;color:#64748b;"></div>
                        <div id="detailPhone" style="font-size:0.82rem;color:#64748b;"></div>
                        <div id="detailApplied" style="font-size:0.82rem;color:#94a3b8;"></div>
                    </div>
                </div>

                {{-- CV --}}
                <div style="margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:#1e293b;font-size:0.9rem;margin-bottom:0.6rem;">Resume / CV</h6>
                    <div style="border:1px solid #e8edf3;border-radius:10px;padding:0.85rem 1rem;
                                display:flex;align-items:center;justify-content:space-between;">
                        <div style="display:flex;align-items:center;gap:0.65rem;">
                            <div style="background:#eff6ff;color:#1d4ed8;border-radius:8px;
                                        padding:8px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-file-earmark-text" style="font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div id="detailCVName" style="font-size:0.85rem;font-weight:600;color:#1e293b;"></div>
                                <div id="detailCVDate" style="font-size:0.75rem;color:#94a3b8;"></div>
                            </div>
                        </div>
                        <a id="detailCVDownload" href="#" target="_blank"
                           style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;
                                  padding:5px 14px;font-size:0.78rem;font-weight:600;
                                  color:#1e293b;text-decoration:none;display:flex;align-items:center;gap:5px;">
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                </div>

                {{-- Cover Letter --}}
                <div id="detailCLSection" style="margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:#1e293b;font-size:0.9rem;margin-bottom:0.6rem;">Cover Letter</h6>
                    <div id="detailCL"
                         style="background:#f8fafc;border:1px solid #e8edf3;border-radius:10px;
                                padding:0.85rem 1rem;font-size:0.85rem;color:#374151;line-height:1.65;"></div>
                </div>

                {{-- Additional Info --}}
                <div id="detailAISection" style="margin-bottom:0.5rem;">
                    <h6 style="font-weight:700;color:#1e293b;font-size:0.9rem;margin-bottom:0.6rem;">Additional Information</h6>
                    <div id="detailAI"
                         style="background:#f8fafc;border:1px solid #e8edf3;border-radius:10px;
                                padding:0.85rem 1rem;font-size:0.85rem;color:#374151;line-height:1.65;"></div>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div style="padding:1rem 1.5rem;border-top:1px solid #f0f4f8;
                    display:flex;align-items:center;gap:0.75rem;flex-shrink:0;">
            <button onclick="detailUpdateStatus('shortlisted')"
                    style="background:#15803d;color:#fff;border:none;border-radius:8px;
                           padding:0.45rem 1.1rem;font-size:0.82rem;font-weight:600;
                           cursor:pointer;display:flex;align-items:center;gap:6px;">
                <i class="bi bi-person-check"></i> Shortlist Candidate
            </button>
            <button onclick="detailUpdateStatus('rejected')"
                    style="background:#fff;color:#b91c1c;border:1px solid #fecaca;border-radius:8px;
                           padding:0.45rem 1.1rem;font-size:0.82rem;font-weight:600;
                           cursor:pointer;display:flex;align-items:center;gap:6px;">
                <i class="bi bi-x-circle"></i> Reject
            </button>
            <button onclick="closeDetailModal()"
                    style="margin-left:auto;background:#fff;color:#374151;
                           border:1px solid #e2e8f0;border-radius:8px;
                           padding:0.45rem 1.1rem;font-size:0.82rem;font-weight:600;cursor:pointer;">
                Close
            </button>
        </div>
    </div>
</div>

<script>
const statusLabels = {
    pending:     { label: 'Pending',      bg: '#fef9ec', color: '#b45309' },
    review:      { label: 'Under Review', bg: '#fef3c7', color: '#92400e' },
    shortlisted: { label: 'Shortlisted',  bg: '#f0fdf4', color: '#15803d' },
    rejected:    { label: 'Rejected',     bg: '#fef2f2', color: '#b91c1c' },
};

let currentDetailId = null;

// ── Applicants list modal ──────────────────────────────────────
document.querySelectorAll('.btn-applicants-link').forEach(btn => {
    btn.addEventListener('click', () => {
        openApplicantsModal(btn.dataset.oppoId, btn.dataset.oppoName);
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
        document.getElementById('modalSubtitle').textContent =
            data.total + ' total application' + (data.total !== 1 ? 's' : '');
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
        const s        = statusLabels[a.status] || statusLabels.pending;
        const initials = a.name !== '—'
            ? a.name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase() : '?';
        return `
        <div style="border:1px solid #e8edf3;border-radius:12px;padding:1.25rem 1.4rem;
                    margin-bottom:1rem;background:#fff;">
            <div style="display:flex;align-items:flex-start;gap:0.85rem;margin-bottom:0.75rem;">
                <div style="width:44px;height:44px;border-radius:50%;background:var(--navy-700);
                            color:#fff;flex-shrink:0;display:flex;align-items:center;
                            justify-content:center;font-weight:700;font-size:0.85rem;">${initials}</div>
                <div style="flex:1;">
                    <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                        <span style="font-weight:700;font-size:1rem;color:#1e293b;">${a.name}</span>
                        <span id="badge-${a.id}"
                              style="background:${s.bg};color:${s.color};font-size:0.7rem;
                                     font-weight:700;padding:2px 10px;border-radius:20px;
                                     text-transform:capitalize;">${s.label}</span>
                    </div>
                    <div style="font-size:0.8rem;color:#94a3b8;margin-top:2px;">Student</div>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.35rem;margin-bottom:0.9rem;">
                <div style="font-size:0.82rem;color:#64748b;">
                    <i class="bi bi-envelope me-1"></i>${a.email}
                </div>
                <div style="font-size:0.82rem;color:#64748b;">
                    <i class="bi bi-telephone me-1"></i>${a.phone}
                </div>
                <div style="font-size:0.82rem;color:#94a3b8;">
                    <i class="bi bi-calendar me-1"></i>Applied: ${a.applied_at}
                </div>
            </div>
            <div style="display:flex;gap:0.6rem;flex-wrap:wrap;">
                <button onclick="openDetailModal(${a.id})"
                        style="background:#fff;color:#1e293b;border:1.5px solid #cbd5e1;
                               border-radius:8px;padding:5px 14px;font-size:0.8rem;
                               font-weight:600;cursor:pointer;display:flex;align-items:center;gap:5px;">
                    <i class="bi bi-eye"></i> View Full Application
                </button>
                <button onclick="listUpdateStatus(${a.id}, 'shortlisted')"
                        style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;
                               border-radius:8px;padding:5px 14px;font-size:0.8rem;
                               font-weight:600;cursor:pointer;display:flex;align-items:center;gap:5px;">
                    <i class="bi bi-person-check"></i> Shortlist
                </button>
                <button onclick="listUpdateStatus(${a.id}, 'rejected')"
                        style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;
                               border-radius:8px;padding:5px 14px;font-size:0.8rem;
                               font-weight:600;cursor:pointer;display:flex;align-items:center;gap:5px;">
                    <i class="bi bi-x-circle"></i> Reject
                </button>
            </div>
        </div>`;
    }).join('');
}

function closeApplicantsModal() {
    document.getElementById('applicantsModal').style.display = 'none';
}
document.getElementById('applicantsModal').addEventListener('click', function(e) {
    if (e.target === this) closeApplicantsModal();
});

// ── Full detail modal ──────────────────────────────────────────
function openDetailModal(applicationId) {
    currentDetailId = applicationId;
    document.getElementById('detailModal').style.display   = 'flex';
    document.getElementById('detailLoading').style.display = 'block';
    document.getElementById('detailContent').style.display = 'none';

    fetch(`/applications/${applicationId}/detail`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(d => {
        const s        = statusLabels[d.status] || statusLabels.pending;
        const initials = d.student.name !== '—'
            ? d.student.name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase() : '?';

        document.getElementById('detailAvatar').textContent   = initials;
        document.getElementById('detailName').textContent     = d.student.name;
        document.getElementById('detailOppo').textContent     = d.opportunity.oname;
        document.getElementById('detailEmail').innerHTML      = '<i class="bi bi-envelope me-1"></i>' + d.student.email;
        document.getElementById('detailPhone').innerHTML      = '<i class="bi bi-telephone me-1"></i>' + d.student.phone;
        document.getElementById('detailApplied').innerHTML    = '<i class="bi bi-calendar me-1"></i>Applied: ' + d.applied_at;

        const badge = document.getElementById('detailStatusBadge');
        badge.textContent      = s.label;
        badge.style.background = s.bg;
        badge.style.color      = s.color;

        document.getElementById('detailCVName').textContent = d.cv_filename || 'CV File';
        document.getElementById('detailCVDate').textContent = 'Uploaded ' + d.applied_at;

        const clSection = document.getElementById('detailCLSection');
        if (d.cover_letter) {
            document.getElementById('detailCL').textContent = d.cover_letter;
            clSection.style.display = 'block';
        } else { clSection.style.display = 'none'; }

        const aiSection = document.getElementById('detailAISection');
        if (d.additional_info) {
            document.getElementById('detailAI').textContent = d.additional_info;
            aiSection.style.display = 'block';
        } else { aiSection.style.display = 'none'; }

        document.getElementById('detailLoading').style.display = 'none';
        document.getElementById('detailContent').style.display = 'block';
    })
    .catch(() => {
        document.getElementById('detailLoading').innerHTML =
            '<p class="text-danger text-center mt-3">Failed to load application details.</p>';
    });
}

function closeDetailModal() {
    document.getElementById('detailModal').style.display = 'none';
    currentDetailId = null;
}
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetailModal();
});

// ── Status updates ─────────────────────────────────────────────
function listUpdateStatus(applicationId, status) {
    callUpdateStatus(applicationId, status, () => {
        const badge = document.getElementById('badge-' + applicationId);
        if (badge) {
            const s = statusLabels[status];
            badge.textContent      = s.label;
            badge.style.background = s.bg;
            badge.style.color      = s.color;
        }
    });
}

function detailUpdateStatus(status) {
    if (!currentDetailId) return;
    callUpdateStatus(currentDetailId, status, () => {
        const s     = statusLabels[status];
        const badge = document.getElementById('detailStatusBadge');
        badge.textContent      = s.label;
        badge.style.background = s.bg;
        badge.style.color      = s.color;
        const listBadge = document.getElementById('badge-' + currentDetailId);
        if (listBadge) {
            listBadge.textContent      = s.label;
            listBadge.style.background = s.bg;
            listBadge.style.color      = s.color;
        }
    });
}

function callUpdateStatus(applicationId, status, onSuccess) {
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
    .then(data => onSuccess(data))
    .catch(err => console.error('Status update failed', err));
}
</script>

</body>
</html>