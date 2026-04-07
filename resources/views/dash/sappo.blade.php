@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">My Applications</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Applications</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card shadow-sm" style="border:1px solid #e8edf3;border-radius:12px;overflow:hidden;">

                    {{-- Card header --}}
                    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
                         style="border-bottom:1px solid #f0f4f8;">
                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                            <i class="bi bi-file-earmark-text me-2" style="color:var(--navy-600);"></i>
                            My Applications
                            <span class="ms-2"
                                  style="background:var(--navy-50);color:var(--navy-700);
                                         font-size:0.75rem;font-weight:700;
                                         padding:2px 10px;border-radius:var(--radius-full);">
                                {{ $applications->total() }}
                            </span>
                        </h6>
                    </div>

                    {{-- Table --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="font-size:0.875rem;">
                                <thead style="background:#f9fafb;">
                                    <tr>
                                        <th class="px-4 py-3 text-muted fw-semibold">#</th>
                                        <th class="py-3 text-muted fw-semibold">Role / Position</th>
                                        <th class="py-3 text-muted fw-semibold">Organisation</th>
                                        <th class="py-3 text-muted fw-semibold">Date Applied</th>
                                        <th class="py-3 text-muted fw-semibold">Status</th>
                                        <th class="py-3 text-muted fw-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($applications as $app)
                                    @php
                                        $badges = [
                                            'pending'     => ['#b45309', '#fef9ec'],
                                            'review'      => ['#1d4ed8', '#eff6ff'],
                                            'shortlisted' => ['#15803d', '#f0fdf4'],
                                            'rejected'    => ['#b91c1c', '#fef2f2'],
                                        ];
                                        $b = $badges[$app->status] ?? ['#52525b', '#f5f5f6'];
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-3 text-muted">
                                            {{ $applications->firstItem() + $loop->index }}
                                        </td>
                                        <td class="py-3 fw-semibold" style="color:var(--navy-800);">
                                            {{ $app->opportunity->oname ?? '—' }}
                                        </td>
                                        <td class="py-3" style="color:var(--charcoal-500);">
                                            {{ $app->opportunity->org ?? '—' }}
                                        </td>
                                        <td class="py-3" style="color:var(--charcoal-400);">
                                            {{ $app->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="py-3">
                                            <span style="background:{{ $b[1] }};color:{{ $b[0] }};
                                                         font-size:0.72rem;font-weight:700;
                                                         padding:3px 10px;border-radius:var(--radius-full);
                                                         text-transform:capitalize;">
                                                {{ str_replace('_', ' ', ucwords($app->status)) }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <button onclick="openStudentDetail({{ $app->id }})"
                                                    style="background:none;border:none;padding:0;
                                                           color:var(--navy-700);font-size:0.8rem;
                                                           font-weight:600;cursor:pointer;
                                                           text-decoration:underline;">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="bi bi-inbox"
                                               style="font-size:2.5rem;color:#d1d9e2;"></i>
                                            <p class="mt-2 mb-0"
                                               style="color:var(--charcoal-400);font-size:0.875rem;">
                                                You haven't applied to anything yet.
                                            </p>
                                            <a href="{{ route('my_opportunities') }}"
                                               style="display:inline-block;margin-top:0.75rem;
                                                      background:var(--navy-700);color:#fff;
                                                      padding:0.45rem 1.1rem;border-radius:var(--radius-sm);
                                                      font-size:0.875rem;font-weight:600;
                                                      text-decoration:none;">
                                                Browse Opportunities
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($applications->hasPages())
                    <div class="card-footer bg-white px-4 py-3" style="border-top:1px solid #f0f4f8;">
                        {{ $applications->links() }}
                    </div>
                    @endif

                </div>

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

{{-- ═══ APPLICATION DETAIL MODAL (Student view) ═══ --}}
<div id="studentDetailModal"
     style="display:none;position:fixed;inset:0;z-index:1050;
            background:rgba(15,23,42,0.5);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:580px;
                margin:1rem;max-height:90vh;display:flex;flex-direction:column;
                box-shadow:0 24px 64px rgba(0,0,0,0.2);">

        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
            <h5 class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1rem;">Application Details</h5>
            <button onclick="closeStudentDetail()"
                    style="background:none;border:none;font-size:1.5rem;
                           color:#94a3b8;cursor:pointer;line-height:1;">&times;</button>
        </div>

        <div style="overflow-y:auto;padding:1.5rem;flex:1;">
            <div id="sdLoading" class="text-center py-5">
                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
            </div>
            <div id="sdContent" style="display:none;">

                {{-- Status + Opportunity --}}
                <div style="border:1px solid #e8edf3;border-radius:12px;padding:1.1rem 1.25rem;margin-bottom:1.25rem;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.5rem;">
                        <span id="sdOppo" style="font-weight:700;font-size:1rem;color:var(--navy-800);"></span>
                        <span id="sdStatusBadge" style="font-size:0.72rem;font-weight:700;padding:3px 12px;border-radius:20px;"></span>
                    </div>
                    <div id="sdOrg" style="font-size:0.82rem;color:#64748b;"></div>
                    <div id="sdApplied" style="font-size:0.78rem;color:#94a3b8;margin-top:4px;"></div>
                </div>

                {{-- Interview details (shown when scheduled) --}}
                <div id="sdInterviewSection" style="display:none;margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);font-size:0.9rem;margin-bottom:0.6rem;">
                        <i class="bi bi-calendar-event me-1"></i>Your Interview
                    </h6>
                    <div style="background:#fefce8;border:1px solid #fef08a;border-radius:10px;padding:0.85rem 1rem;">
                        <div id="sdInterviewInfo" style="font-size:0.85rem;color:#713f12;line-height:1.8;"></div>
                    </div>
                </div>

                {{-- Cover Letter --}}
                <div id="sdCLSection" style="margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);font-size:0.9rem;margin-bottom:0.6rem;">Cover Letter</h6>
                    <div id="sdCL" style="background:#f9fafb;border:1px solid #e8edf3;border-radius:10px;
                                padding:0.85rem 1rem;font-size:0.85rem;color:#374151;line-height:1.65;"></div>
                </div>

                {{-- Additional Info --}}
                <div id="sdAISection" style="margin-bottom:0.5rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);font-size:0.9rem;margin-bottom:0.6rem;">Additional Information</h6>
                    <div id="sdAI" style="background:#f9fafb;border:1px solid #e8edf3;border-radius:10px;
                               padding:0.85rem 1rem;font-size:0.85rem;color:#374151;line-height:1.65;"></div>
                </div>
            </div>
        </div>

        <div style="padding:1rem 1.5rem;border-top:1px solid #f0f4f8;flex-shrink:0;">
            <button onclick="closeStudentDetail()"
                    style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;
                           padding:0.5rem 1.25rem;font-size:0.875rem;font-weight:600;cursor:pointer;">
                Close
            </button>
        </div>
    </div>
</div>

<script>
const sdStatusLabels = {
    pending:             { label: 'Pending',              bg: '#fef9ec', color: '#b45309' },
    review:              { label: 'Under Review',         bg: '#eff6ff', color: '#1d4ed8' },
    shortlisted:         { label: 'Shortlisted',          bg: '#f0fdf4', color: '#15803d' },
    interview_scheduled: { label: 'Interview Scheduled',  bg: '#fef3c7', color: '#78350f' },
    selected:            { label: 'Selected ✅',           bg: '#dcfce7', color: '#14532d' },
    rejected:            { label: 'Not Successful',       bg: '#fef2f2', color: '#b91c1c' },
};

function openStudentDetail(applicationId) {
    document.getElementById('studentDetailModal').style.display = 'flex';
    document.getElementById('sdLoading').style.display  = 'block';
    document.getElementById('sdContent').style.display  = 'none';

    fetch(`/applications/${applicationId}/detail`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(d => {
        const s = sdStatusLabels[d.status] || { label: d.status, bg: '#f5f5f6', color: '#52525b' };

        document.getElementById('sdOppo').textContent    = d.opportunity.oname;
        document.getElementById('sdOrg').innerHTML       = '<i class="bi bi-building me-1"></i>' + (d.opportunity.org || '');
        document.getElementById('sdApplied').innerHTML   = '<i class="bi bi-calendar me-1"></i>Applied: ' + d.applied_at;

        const badge = document.getElementById('sdStatusBadge');
        badge.textContent = s.label; badge.style.background = s.bg; badge.style.color = s.color;

        // Interview section
        const iSection = document.getElementById('sdInterviewSection');
        if (d.interview) {
            const typeIcon = d.interview.type === 'physical' ? '📍' : '💻';
            const typeLabel = d.interview.type === 'physical' ? 'Physical' : 'Online';
            document.getElementById('sdInterviewInfo').innerHTML =
                `<strong>📅 Date:</strong> ${d.interview.date}<br>
                 <strong>🕐 Time:</strong> ${d.interview.time}<br>
                 <strong>📌 Type:</strong> ${typeIcon} ${typeLabel}<br>
                 ${d.interview.location_or_link ? `<strong>${d.interview.type === 'physical' ? '📍 Location' : '🔗 Link'}:</strong> <a href="${d.interview.location_or_link.startsWith('http') ? d.interview.location_or_link : '#'}" target="_blank" style="color:var(--navy-700);">${d.interview.location_or_link}</a><br>` : ''}
                 ${d.interview.notes ? `<strong>📝 Notes:</strong> ${d.interview.notes}` : ''}`;
            iSection.style.display = 'block';
        } else {
            iSection.style.display = 'none';
        }

        const clSection = document.getElementById('sdCLSection');
        if (d.cover_letter) { document.getElementById('sdCL').textContent = d.cover_letter; clSection.style.display = 'block'; }
        else { clSection.style.display = 'none'; }

        const aiSection = document.getElementById('sdAISection');
        if (d.additional_info) { document.getElementById('sdAI').textContent = d.additional_info; aiSection.style.display = 'block'; }
        else { aiSection.style.display = 'none'; }

        document.getElementById('sdLoading').style.display = 'none';
        document.getElementById('sdContent').style.display = 'block';
    })
    .catch(() => {
        document.getElementById('sdLoading').innerHTML =
            '<p class="text-danger text-center mt-3">Failed to load details.</p>';
    });
}

function closeStudentDetail() {
    document.getElementById('studentDetailModal').style.display = 'none';
}
document.getElementById('studentDetailModal').addEventListener('click', function(e) {
    if (e.target === this) closeStudentDetail();
});
</script>

</body>
</html>