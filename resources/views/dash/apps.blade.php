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
                                  text-decoration:none;">+ Post New</a>
                        @endif
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="font-size:0.875rem;">
                                <thead style="background:#f9fafb;">
                                    <tr>
                                        <th class="px-4 py-3 text-muted fw-semibold">Title</th>
                                        <th class="py-3 text-muted fw-semibold">Department</th>
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
                                        $sc = [
                                            'active' => ['var(--navy-700)', 'var(--navy-50)'],
                                            'closed' => ['#b91c1c',         '#fef2f2'],
                                            'draft'  => ['var(--charcoal-500)', '#f5f7fa'],
                                        ][$oppo->status] ?? ['var(--charcoal-500)', '#f5f7fa'];
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
                                                          border:1px solid var(--navy-100);
                                                          padding:4px 12px;border-radius:6px;
                                                          font-size:0.78rem;font-weight:600;
                                                          text-decoration:none;">Edit</a>
                                                <form method="POST" action="{{ route('oppo.destroy', $oppo) }}"
                                                      onsubmit="return confirm('Delete this opportunity?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            style="background:#fef2f2;color:#b91c1c;
                                                                   border:1px solid #fecaca;
                                                                   padding:4px 12px;border-radius:6px;
                                                                   font-size:0.78rem;font-weight:600;
                                                                   cursor:pointer;">Delete</button>
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

        <div style="padding:1.4rem 1.75rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
            <div>
                <h5 id="modalTitle" class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1.05rem;"></h5>
                <p id="modalSubtitle" class="mb-0 mt-1" style="color:var(--charcoal-400);font-size:0.82rem;"></p>
            </div>
            <button onclick="closeApplicantsModal()"
                    style="background:none;border:none;font-size:1.5rem;
                           color:var(--charcoal-400);cursor:pointer;line-height:1;padding:4px;">&times;</button>
        </div>

        <div style="overflow-y:auto;padding:1.25rem 1.75rem;flex:1;">
            <div id="modalLoading" class="text-center py-5">
                <div class="spinner-border spinner-border-sm" role="status"
                     style="color:var(--navy-600);"></div>
                <p class="mt-2 mb-0" style="color:var(--charcoal-400);font-size:0.85rem;">Loading applicants…</p>
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
    <div style="background:#fff;border-radius:16px;width:100%;max-width:580px;
                margin:1rem;max-height:90vh;display:flex;flex-direction:column;
                box-shadow:0 24px 64px rgba(0,0,0,0.22);">

        {{-- Header --}}
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
            <h5 class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1rem;">
                Application Details
            </h5>
            <button onclick="closeDetailModal()"
                    style="background:none;border:none;font-size:1.5rem;
                           color:var(--charcoal-400);cursor:pointer;line-height:1;padding:4px;">&times;</button>
        </div>

        {{-- Body --}}
        <div style="overflow-y:auto;padding:1.5rem;flex:1;">
            <div id="detailLoading" class="text-center py-5">
                <div class="spinner-border spinner-border-sm" role="status"
                     style="color:var(--navy-600);"></div>
            </div>
            <div id="detailContent" style="display:none;">

                {{-- Student profile card — matches image 1 exactly --}}
                <div style="border:1px solid #e8edf3;border-radius:12px;
                            padding:1.25rem;margin-bottom:1.25rem;">
                    <div style="display:flex;align-items:flex-start;gap:1rem;">
                        {{-- Avatar --}}
                        <div id="detailAvatar"
                             style="width:52px;height:52px;border-radius:50%;flex-shrink:0;
                                    background:var(--navy-700);color:#fff;
                                    display:flex;align-items:center;justify-content:center;
                                    font-weight:700;font-size:1.1rem;"></div>
                        <div style="flex:1;min-width:0;">
                            {{-- Name + status badge --}}
                            <div style="display:flex;align-items:center;gap:0.6rem;
                                        flex-wrap:wrap;margin-bottom:0.2rem;">
                                <span id="detailName"
                                      style="font-weight:700;font-size:1.05rem;
                                             color:var(--navy-800);"></span>
                                <span id="detailStatusBadge"
                                      style="font-size:0.7rem;font-weight:700;
                                             padding:2px 10px;border-radius:var(--radius-full);
                                             text-transform:capitalize;"></span>
                            </div>
                            {{-- Course + University --}}
                            <div id="detailCourse"
                                 style="font-size:0.8rem;color:var(--charcoal-400);
                                        margin-bottom:0.6rem;"></div>
                            {{-- Contact row --}}
                            <div style="display:flex;flex-wrap:wrap;gap:1rem;">
                                <div id="detailEmail"
                                     style="font-size:0.8rem;color:var(--charcoal-500);
                                            display:flex;align-items:center;gap:0.3rem;"></div>
                                <div id="detailPhone"
                                     style="font-size:0.8rem;color:var(--charcoal-500);
                                            display:flex;align-items:center;gap:0.3rem;"></div>
                            </div>
                            {{-- Year of study chip --}}
                            <div style="margin-top:0.6rem;">
                                <span id="detailYear"
                                      style="background:var(--navy-50);color:var(--navy-700);
                                             font-size:0.72rem;font-weight:600;
                                             padding:3px 10px;border-radius:var(--radius-full);
                                             display:inline-flex;align-items:center;gap:4px;"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CV --}}
                <div style="margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);
                               font-size:0.9rem;margin-bottom:0.6rem;">Resume / CV</h6>
                    <div style="border:1px solid #e8edf3;border-radius:10px;
                                padding:0.85rem 1rem;
                                display:flex;align-items:center;justify-content:space-between;">
                        <div style="display:flex;align-items:center;gap:0.65rem;">
                            <div style="background:var(--navy-50);color:var(--navy-700);
                                        border-radius:8px;padding:8px;
                                        display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-file-earmark-text" style="font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div id="detailCVName"
                                     style="font-size:0.85rem;font-weight:600;
                                            color:var(--navy-800);"></div>
                                <div id="detailCVDate"
                                     style="font-size:0.75rem;color:var(--charcoal-400);"></div>
                            </div>
                        </div>
                        <a id="detailCVDownload" href="#" target="_blank"
                           style="background:var(--navy-50);border:1px solid var(--navy-100);
                                  border-radius:8px;padding:5px 14px;
                                  font-size:0.78rem;font-weight:600;
                                  color:var(--navy-700);text-decoration:none;
                                  display:flex;align-items:center;gap:5px;">
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                </div>

                {{-- Cover Letter --}}
                <div id="detailCLSection" style="margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);
                               font-size:0.9rem;margin-bottom:0.6rem;">Cover Letter</h6>
                    <div id="detailCL"
                         style="background:#f9fafb;border:1px solid #e8edf3;
                                border-radius:10px;padding:0.85rem 1rem;
                                font-size:0.85rem;color:var(--charcoal-500);
                                line-height:1.65;"></div>
                </div>

                {{-- Additional Info --}}
                <div id="detailAISection" style="margin-bottom:0.5rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);
                               font-size:0.9rem;margin-bottom:0.6rem;">Additional Information</h6>
                    <div id="detailAI"
                         style="background:#f9fafb;border:1px solid #e8edf3;
                                border-radius:10px;padding:0.85rem 1rem;
                                font-size:0.85rem;color:var(--charcoal-500);
                                line-height:1.65;"></div>
                </div>

            </div>
        </div>

        {{-- Footer actions — navy/gold, not green --}}
        <div style="padding:1rem 1.5rem;border-top:1px solid #f0f4f8;
                    display:flex;align-items:center;gap:0.75rem;flex-shrink:0;">
            <button onclick="detailUpdateStatus('shortlisted')"
                    style="background:var(--navy-700);color:#fff;border:none;
                           border-radius:8px;padding:0.5rem 1.25rem;
                           font-size:0.875rem;font-weight:600;cursor:pointer;
                           display:flex;align-items:center;gap:6px;">
                <i class="bi bi-person-check"></i> Shortlist Candidate
            </button>
            <button onclick="detailUpdateStatus('rejected')"
                    style="background:#fff;color:#b91c1c;border:1px solid #fecaca;
                           border-radius:8px;padding:0.5rem 1.25rem;
                           font-size:0.875rem;font-weight:600;cursor:pointer;
                           display:flex;align-items:center;gap:6px;">
                <i class="bi bi-x-circle"></i> Reject
            </button>
            <button onclick="closeDetailModal()"
                    style="margin-left:auto;background:#fff;color:var(--charcoal-500);
                           border:1px solid #e2e8f0;border-radius:8px;
                           padding:0.5rem 1.25rem;font-size:0.875rem;
                           font-weight:600;cursor:pointer;">Close</button>
        </div>
    </div>
</div>

<script>
const statusLabels = {
    pending:     { label: 'Pending',      bg: '#fef9ec', color: '#b45309' },
    review:      { label: 'Under Review', bg: '#eff6ff', color: '#1d4ed8' },
    shortlisted: { label: 'Shortlisted',  bg: 'var(--navy-50)', color: 'var(--navy-700)' },
    rejected:    { label: 'Rejected',     bg: '#fef2f2', color: '#b91c1c' },
};

let currentDetailId = null;

// ── Applicants list modal ────────────────────────────────────────
document.querySelectorAll('.btn-applicants-link').forEach(btn => {
    btn.addEventListener('click', () => {
        openApplicantsModal(btn.dataset.oppoId, btn.dataset.oppoName);
    });
});

function openApplicantsModal(oppoId, oppoName) {
    document.getElementById('applicantsModal').style.display = 'flex';
    document.getElementById('modalTitle').textContent        = oppoName;
    document.getElementById('modalSubtitle').textContent     = '';
    document.getElementById('modalLoading').style.display    = 'block';
    document.getElementById('applicantsList').innerHTML      = '';

    fetch(`/opportunities/${oppoId}/applicants`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('modalLoading').style.display = 'none';
        document.getElementById('modalSubtitle').textContent  =
            data.total + ' total application' + (data.total !== 1 ? 's' : '');
        renderApplicants(data.applicants);
    })
    .catch(() => {
        document.getElementById('modalLoading').style.display = 'none';
        document.getElementById('applicantsList').innerHTML   =
            '<p class="text-center text-danger py-3">Failed to load applicants.</p>';
    });
}

function renderApplicants(applicants) {
    const list = document.getElementById('applicantsList');
    if (!applicants.length) {
        list.innerHTML = '<p class="text-center py-4" style="color:var(--charcoal-400);">No applicants yet.</p>';
        return;
    }
    list.innerHTML = applicants.map(a => {
        const s        = statusLabels[a.status] || statusLabels.pending;
        const initials = a.name !== '—'
            ? a.name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase() : '?';
        return `
        <div style="border:1px solid #e8edf3;border-radius:12px;padding:1.1rem 1.25rem;
                    margin-bottom:0.85rem;background:#fff;">
            <div style="display:flex;align-items:flex-start;gap:0.85rem;margin-bottom:0.75rem;">
                <div style="width:42px;height:42px;border-radius:50%;
                            background:var(--navy-700);color:#fff;flex-shrink:0;
                            display:flex;align-items:center;justify-content:center;
                            font-weight:700;font-size:0.85rem;">${initials}</div>
                <div style="flex:1;">
                    <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                        <span style="font-weight:700;font-size:0.9375rem;color:var(--navy-800);">${a.name}</span>
                        <span id="badge-${a.id}"
                              style="background:${s.bg};color:${s.color};font-size:0.7rem;
                                     font-weight:700;padding:2px 10px;border-radius:20px;
                                     text-transform:capitalize;">${s.label}</span>
                    </div>
                    <div style="font-size:0.78rem;color:var(--charcoal-400);margin-top:2px;">Student</div>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.35rem;margin-bottom:0.85rem;">
                <div style="font-size:0.8rem;color:var(--charcoal-500);">
                    <i class="bi bi-envelope me-1"></i>${a.email}
                </div>
                <div style="font-size:0.8rem;color:var(--charcoal-500);">
                    <i class="bi bi-telephone me-1"></i>${a.phone}
                </div>
                <div style="font-size:0.8rem;color:var(--charcoal-400);">
                    <i class="bi bi-calendar me-1"></i>Applied: ${a.applied_at}
                </div>
            </div>
            <div style="display:flex;gap:0.6rem;flex-wrap:wrap;">
                <button onclick="openDetailModal(${a.id})"
                        style="background:var(--navy-50);color:var(--navy-700);
                               border:1.5px solid var(--navy-100);
                               border-radius:8px;padding:5px 14px;font-size:0.8rem;
                               font-weight:600;cursor:pointer;display:flex;align-items:center;gap:5px;">
                    <i class="bi bi-eye"></i> View Full Application
                </button>
                <button onclick="listUpdateStatus(${a.id}, 'shortlisted')"
                        style="background:var(--navy-700);color:#fff;border:none;
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

// ── Full detail modal ────────────────────────────────────────────
function openDetailModal(applicationId) {
    currentDetailId = applicationId;
    document.getElementById('detailModal').style.display    = 'flex';
    document.getElementById('detailLoading').style.display  = 'block';
    document.getElementById('detailContent').style.display  = 'none';

    fetch(`/applications/${applicationId}/detail`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(d => {
        const s        = statusLabels[d.status] || statusLabels.pending;
        const name     = d.student.name && d.student.name !== '—' ? d.student.name : '';
        const initials = name
            ? name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase() : '?';

        // Avatar
        document.getElementById('detailAvatar').textContent = initials;

        // Name
        document.getElementById('detailName').textContent = name || '—';

        // Status badge (next to name)
        const badge = document.getElementById('detailStatusBadge');
        badge.textContent      = s.label;
        badge.style.background = s.bg;
        badge.style.color      = s.color;

        // Course — University of Nairobi (below name)
        const courseParts = [d.student.course, d.student.university].filter(Boolean);
        document.getElementById('detailCourse').textContent =
            courseParts.length ? courseParts.join(' — ') : '';

        // Contact row
        document.getElementById('detailEmail').innerHTML =
            '<i class="bi bi-envelope me-1" style="font-size:0.75rem;"></i>' + (d.student.email || '—');
        document.getElementById('detailPhone').innerHTML =
            '<i class="bi bi-telephone me-1" style="font-size:0.75rem;"></i>' + (d.student.phone || '—');

        // Year of study chip
        const yearEl = document.getElementById('detailYear');
        if (d.student.year) {
            yearEl.innerHTML = '<i class="bi bi-mortarboard me-1" style="font-size:0.72rem;"></i>' + d.student.year;
            yearEl.style.display = 'inline-flex';
        } else {
            yearEl.style.display = 'none';
        }

        // CV
        document.getElementById('detailCVName').textContent = d.cv_filename || 'CV File';
        document.getElementById('detailCVDate').textContent = 'Uploaded ' + d.applied_at;

        // Cover letter
        const clSection = document.getElementById('detailCLSection');
        if (d.cover_letter) {
            document.getElementById('detailCL').textContent = d.cover_letter;
            clSection.style.display = 'block';
        } else { clSection.style.display = 'none'; }

        // Additional info
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
            '<p style="color:#b91c1c;text-align:center;margin-top:1rem;">Failed to load details.</p>';
    });
}

function closeDetailModal() {
    document.getElementById('detailModal').style.display = 'none';
    currentDetailId = null;
}
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetailModal();
});

// ── Status updates ───────────────────────────────────────────────
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