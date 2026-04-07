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
                                        <td class="px-4 py-3 fw-semibold" style="color:var(--navy-800);">{{ $oppo->oname }}</td>
                                        <td class="py-3" style="color:var(--charcoal-500);">{{ $oppo->foth1 ?? 'Attachment' }}</td>
                                        <td class="py-3" style="color:var(--charcoal-500);">{{ $oppo->loc ?? '—' }}</td>
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
                                                          border:1px solid var(--navy-100);padding:4px 12px;
                                                          border-radius:6px;font-size:0.78rem;font-weight:600;
                                                          text-decoration:none;">Edit</a>
                                                <form method="POST" action="{{ route('oppo.destroy', $oppo) }}"
                                                      onsubmit="return confirm('Delete this opportunity?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            style="background:#fef2f2;color:#b91c1c;
                                                                   border:1px solid #fecaca;padding:4px 12px;
                                                                   border-radius:6px;font-size:0.78rem;
                                                                   font-weight:600;cursor:pointer;">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="bi bi-inbox" style="font-size:2.5rem;color:#d1d9e2;"></i>
                                            <p class="mt-2 mb-0" style="color:var(--charcoal-400);font-size:0.875rem;">No opportunities found.</p>
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

{{-- ═══ APPLICANTS LIST MODAL ═══ --}}
<div id="applicantsModal"
     style="display:none;position:fixed;inset:0;z-index:1050;
            background:rgba(15,23,42,0.5);align-items:center;justify-content:center;overflow-y:auto;padding:1rem;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:780px;
                margin:auto;display:flex;flex-direction:column;
                box-shadow:0 24px 64px rgba(0,0,0,0.2);">

        {{-- Header --}}
        <div style="padding:1.4rem 1.75rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:flex-start;justify-content:space-between;flex-shrink:0;">
            <div style="flex:1;min-width:0;">
                <h5 id="modalTitle" class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1.05rem;word-break:break-word;"></h5>
                <p id="modalSubtitle" class="mb-0 mt-1" style="color:var(--charcoal-400);font-size:0.82rem;"></p>
                {{-- Pipeline --}}
                <div style="display:flex;align-items:center;flex-wrap:wrap;gap:4px;margin-top:0.65rem;">
                    @php
                        $pipeline = [
                            ['key'=>'pending',              'label'=>'New',                'bg'=>'#1e293b','color'=>'#fff'],
                            ['key'=>'review',               'label'=>'Under Review',       'bg'=>'#fef3c7','color'=>'#92400e'],
                            ['key'=>'shortlisted',          'label'=>'Shortlisted',        'bg'=>'#e0f2fe','color'=>'#075985'],
                            ['key'=>'interview_scheduled',  'label'=>'Interview Scheduled','bg'=>'#fef3c7','color'=>'#78350f'],
                            ['key'=>'selected',             'label'=>'Selected',           'bg'=>'#dcfce7','color'=>'#14532d'],
                            ['key'=>'rejected',             'label'=>'Rejected',           'bg'=>'#fee2e2','color'=>'#991b1b'],
                        ];
                    @endphp
                    <span style="font-size:0.72rem;color:var(--charcoal-400);margin-right:2px;white-space:nowrap;">Pipeline:</span>
                    @foreach($pipeline as $i => $stage)
                        <span style="background:{{ $stage['bg'] }};color:{{ $stage['color'] }};
                                     font-size:0.68rem;font-weight:700;padding:2px 9px;
                                     border-radius:20px;">{{ $stage['label'] }}</span>
                        @if(!$loop->last && $stage['key'] !== 'rejected')
                            <span style="color:var(--charcoal-300);font-size:0.7rem;">→</span>
                        @endif
                    @endforeach
                </div>
            </div>
            <button onclick="closeApplicantsModal()"
                    style="background:none;border:none;font-size:1.5rem;
                           color:var(--charcoal-400);cursor:pointer;line-height:1;padding:4px;flex-shrink:0;">&times;</button>
        </div>

        <div style="overflow-y:auto;padding:1.25rem 1.75rem;flex:1;max-height:65vh;">
            <div id="modalLoading" class="text-center py-5">
                <div class="spinner-border spinner-border-sm" role="status" style="color:var(--navy-600);"></div>
                <p class="mt-2 mb-0" style="color:var(--charcoal-400);font-size:0.85rem;">Loading applicants…</p>
            </div>
            <div id="applicantsList"></div>
        </div>
    </div>
</div>

{{-- ═══ FULL DETAIL MODAL ═══ --}}
<div id="detailModal"
     style="display:none;position:fixed;inset:0;z-index:1060;
            background:rgba(15,23,42,0.55);align-items:center;justify-content:center;overflow-y:auto;padding:1rem;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:680px;
                min-height:auto;display:flex;flex-direction:column;
                box-shadow:0 24px 64px rgba(0,0,0,0.22);margin:auto;">

        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
            <h5 class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1rem;">Application Details</h5>
            <button onclick="closeDetailModal()"
                    style="background:none;border:none;font-size:1.5rem;
                           color:var(--charcoal-400);cursor:pointer;line-height:1;padding:4px;">&times;</button>
        </div>

        <div style="overflow-y:auto;padding:1.5rem;flex:1;">
            <div id="detailLoading" class="text-center py-5">
                <div class="spinner-border spinner-border-sm" role="status" style="color:var(--navy-600);"></div>
            </div>
            <div id="detailContent" style="display:none;">

                {{-- Profile card --}}
                <div style="border:1px solid #e8edf3;border-radius:12px;padding:1.25rem;margin-bottom:1.25rem;">
                    <div style="display:flex;align-items:flex-start;gap:1rem;">
                        <div id="detailAvatar"
                             style="width:52px;height:52px;border-radius:50%;flex-shrink:0;
                                    background:var(--navy-700);color:#fff;
                                    display:flex;align-items:center;justify-content:center;
                                    font-weight:700;font-size:1.1rem;"></div>
                        <div style="flex:1;min-width:0;">
                            <div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap;margin-bottom:0.2rem;">
                                <span id="detailName" style="font-weight:700;font-size:1.05rem;color:var(--navy-800);word-break:break-word;"></span>
                                <span id="detailStatusBadge"
                                      style="font-size:0.7rem;font-weight:700;padding:2px 10px;
                                             border-radius:var(--radius-full);text-transform:capitalize;flex-shrink:0;"></span>
                            </div>
                            <div id="detailCourse" style="font-size:0.8rem;color:var(--charcoal-400);margin-bottom:0.6rem;word-break:break-word;"></div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:0.6rem;">
                                <div id="detailEmail" style="font-size:0.8rem;color:var(--charcoal-500);display:flex;align-items:center;gap:0.3rem;word-break:break-all;"></div>
                                <div id="detailPhone" style="font-size:0.8rem;color:var(--charcoal-500);display:flex;align-items:center;gap:0.3rem;word-break:break-word;"></div>
                            </div>
                            <div style="margin-top:0.6rem;">
                                <span id="detailYear"
                                      style="background:var(--navy-50);color:var(--navy-700);
                                             font-size:0.72rem;font-weight:600;
                                             padding:3px 10px;border-radius:var(--radius-full);
                                             display:none;align-items:center;gap:4px;white-space:nowrap;"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Interview details (shown when scheduled) --}}
                <div id="detailInterviewSection" style="display:none;margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);font-size:0.9rem;margin-bottom:0.6rem;">
                        <i class="bi bi-calendar-event me-1"></i>Interview Details
                    </h6>
                    <div style="background:#fefce8;border:1px solid #fef08a;border-radius:10px;padding:0.85rem 1rem;">
                        <div id="detailInterviewInfo" style="font-size:0.85rem;color:#713f12;line-height:1.7;word-break:break-word;"></div>
                    </div>
                </div>

                {{-- CV --}}
                <div style="margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);font-size:0.9rem;margin-bottom:0.6rem;">Resume / CV</h6>
                    <div style="border:1px solid #e8edf3;border-radius:10px;padding:0.85rem 1rem;">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:0.75rem;flex-wrap:wrap;">
                            <div style="display:flex;align-items:center;gap:0.65rem;flex:1;min-width:200px;">
                                <div style="background:var(--navy-50);color:var(--navy-700);border-radius:8px;padding:8px;
                                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi bi-file-earmark-text" style="font-size:1.1rem;"></i>
                                </div>
                                <div style="min-width:0;">
                                    <div id="detailCVName" style="font-size:0.85rem;font-weight:600;color:var(--navy-800);word-break:break-word;"></div>
                                    <div id="detailCVDate" style="font-size:0.75rem;color:var(--charcoal-400);"></div>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;justify-content:flex-end;">
                                <button id="detailCVPreview" onclick="event.preventDefault(); const url = document.getElementById('detailCVDownload').href; if(url && url !== '#') openCVPreview(url, document.getElementById('detailCVName').textContent);"
                                   style="background:var(--navy-50);border:1px solid var(--navy-100);border-radius:8px;
                                          padding:7px 12px;font-size:0.8rem;font-weight:600;color:var(--navy-700);
                                          text-decoration:none;display:flex;align-items:center;gap:4px;cursor:pointer;white-space:nowrap;">
                                    <i class="bi bi-eye"></i> Preview
                                </button>
                                <a id="detailCVDownload" href="#" target="_blank" download
                                   style="background:var(--navy-50);border:1px solid var(--navy-100);border-radius:8px;
                                          padding:7px 14px;font-size:0.8rem;font-weight:600;color:var(--navy-700);
                                          text-decoration:none;display:flex;align-items:center;gap:5px;white-space:nowrap;">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cover Letter --}}
                <div id="detailCLSection" style="margin-bottom:1.25rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);font-size:0.9rem;margin-bottom:0.6rem;">Cover Letter</h6>
                    <div id="detailCL"
                         style="background:#f9fafb;border:1px solid #e8edf3;border-radius:10px;
                                padding:0.85rem 1rem;font-size:0.85rem;color:var(--charcoal-500);line-height:1.65;word-break:break-word;overflow-wrap:break-word;"></div>
                </div>

                {{-- Additional Info --}}
                <div id="detailAISection" style="margin-bottom:0.5rem;">
                    <h6 style="font-weight:700;color:var(--navy-800);font-size:0.9rem;margin-bottom:0.6rem;">Additional Information</h6>
                    <div id="detailAI"
                         style="background:#f9fafb;border:1px solid #e8edf3;border-radius:10px;
                                padding:0.85rem 1rem;font-size:0.85rem;color:var(--charcoal-500);line-height:1.65;word-break:break-word;overflow-wrap:break-word;"></div>
                </div>
            </div>
        </div>

        {{-- Dynamic footer buttons --}}
        <div id="detailFooter" style="padding:1rem 1.5rem;border-top:1px solid #f0f4f8;
                    display:flex;align-items:center;gap:0.75rem;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end;">
        </div>
    </div>
</div>

{{-- ═══ INTERVIEW SCHEDULE MODAL ═══ --}}
<div id="interviewModal"
     style="display:none;position:fixed;inset:0;z-index:1070;
            background:rgba(15,23,42,0.6);align-items:center;justify-content:center;overflow-y:auto;padding:1rem;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:520px;
                margin:auto;box-shadow:0 24px 64px rgba(0,0,0,0.24);">

        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;">
            <h5 class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1rem;">
                <i class="bi bi-calendar-event me-2"></i>Schedule Interview
            </h5>
            <button onclick="closeInterviewModal()"
                    style="background:none;border:none;font-size:1.5rem;color:var(--charcoal-400);cursor:pointer;line-height:1;">&times;</button>
        </div>

        <div style="padding:1.5rem;max-height:calc(90vh - 120px);overflow-y:auto;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:5px;">
                        Date <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="date" id="iDate"
                           style="width:100%;border:1px solid #e2e8f0;border-radius:8px;
                                  padding:0.5rem 0.75rem;font-size:0.85rem;color:#1e293b;box-sizing:border-box;">
                </div>
                <div>
                    <label style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:5px;">
                        Time <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="time" id="iTime"
                           style="width:100%;border:1px solid #e2e8f0;border-radius:8px;
                                  padding:0.5rem 0.75rem;font-size:0.85rem;color:#1e293b;box-sizing:border-box;">
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:5px;">
                    Interview Type <span style="color:#dc2626;">*</span>
                </label>
                <div style="display:flex;gap:0.75rem;">
                    <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;
                                  border:1.5px solid #e2e8f0;border-radius:8px;padding:0.5rem 1rem;
                                  flex:1;font-size:0.85rem;" id="typePhysicalLabel">
                        <input type="radio" name="iType" value="physical" id="iTypePhysical"
                               onchange="updateTypeStyle()">
                        <i class="bi bi-building"></i> Physical
                    </label>
                    <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;
                                  border:1.5px solid #e2e8f0;border-radius:8px;padding:0.5rem 1rem;
                                  flex:1;font-size:0.85rem;" id="typeOnlineLabel">
                        <input type="radio" name="iType" value="online" id="iTypeOnline"
                               onchange="updateTypeStyle()">
                        <i class="bi bi-camera-video"></i> Online
                    </label>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label id="iLocationLabel" style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:5px;">
                    Location / Meeting Link
                </label>
                <input type="text" id="iLocation" placeholder="e.g. Office address or Google Meet link"
                       style="width:100%;border:1px solid #e2e8f0;border-radius:8px;
                              padding:0.5rem 0.75rem;font-size:0.85rem;color:#1e293b;box-sizing:border-box;">
            </div>

            <div style="margin-bottom:1.25rem;">
                <label style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:5px;">
                    Notes <span style="font-weight:400;color:#94a3b8;">(Optional)</span>
                </label>
                <textarea id="iNotes" rows="2" placeholder="Any preparation instructions for the candidate..."
                          style="width:100%;border:1px solid #e2e8f0;border-radius:8px;
                                 padding:0.5rem 0.75rem;font-size:0.85rem;color:#1e293b;
                                 resize:vertical;font-family:inherit;box-sizing:border-box;"></textarea>
            </div>

            <div id="iError" style="display:none;background:#fef2f2;border:1px solid #fecaca;
                                     border-radius:8px;padding:0.6rem 0.9rem;font-size:0.8rem;
                                     color:#dc2626;margin-bottom:0.75rem;"></div>

            <div style="display:flex;gap:0.75rem;justify-content:flex-end;flex-wrap:wrap;">
                <button onclick="closeInterviewModal()"
                        style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;
                               padding:0.6rem 1.5rem;font-size:0.85rem;font-weight:600;
                               color:#374151;cursor:pointer;white-space:nowrap;">Cancel</button>
                <button onclick="submitInterview()"
                        style="background:var(--navy-700);color:#fff;border:none;border-radius:8px;
                               padding:0.6rem 1.5rem;font-size:0.85rem;font-weight:600;cursor:pointer;
                               display:flex;align-items:center;gap:6px;white-space:nowrap;">
                    <i class="bi bi-calendar-check"></i> Confirm Interview
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const statusLabels = {
    pending:              { label: 'New',                bg: '#1e293b',  color: '#fff'    },
    review:               { label: 'Under Review',       bg: '#fef3c7',  color: '#92400e' },
    shortlisted:          { label: 'Shortlisted',        bg: '#e0f2fe',  color: '#075985' },
    interview_scheduled:  { label: 'Interview Scheduled',bg: '#fef3c7',  color: '#78350f' },
    selected:             { label: 'Selected',           bg: '#dcfce7',  color: '#14532d' },
    rejected:             { label: 'Rejected',           bg: '#fee2e2',  color: '#991b1b' },
};

let currentDetailId   = null;
let scheduleTargetId  = null;
let applicantInterviews = {}; // Store interview info for each applicant

// ── Applicants list modal ─────────────────────────────────────────
document.querySelectorAll('.btn-applicants-link').forEach(btn => {
    btn.addEventListener('click', () => openApplicantsModal(btn.dataset.oppoId, btn.dataset.oppoName));
});

function openApplicantsModal(oppoId, oppoName) {
    document.getElementById('applicantsModal').style.display = 'flex';
    document.getElementById('modalTitle').textContent        = 'Applicants for ' + oppoName;
    document.getElementById('modalSubtitle').textContent     = '';
    document.getElementById('modalLoading').style.display    = 'block';
    document.getElementById('applicantsList').innerHTML      = '';

    fetch(`/opportunities/${oppoId}/applicants`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
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
    // Store interview data for all applicants
    applicants.forEach(a => {
        applicantInterviews[a.id] = a.interview || null;
    });
    if (!applicants.length) {
        list.innerHTML = '<p class="text-center py-4" style="color:var(--charcoal-400);">No applicants yet.</p>';
        return;
    }
    list.innerHTML = applicants.map(a => {
        const s        = statusLabels[a.status] || statusLabels.pending;
        const initials = a.name !== '—'
            ? a.name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase() : '?';
        const courseStr = [a.course, a.university].filter(Boolean).join(' — ');

        const interviewInfo = a.interview
            ? `<div style="background:#fefce8;border:1px solid #fef08a;border-radius:8px;
                           padding:6px 10px;font-size:0.78rem;color:#713f12;margin-bottom:0.6rem;">
                <i class="bi bi-calendar-event me-1"></i>
                ${a.interview.date} at ${a.interview.time} — ${a.interview.type === 'physical' ? '📍' : '💻'} ${a.interview.location_or_link || ''}
               </div>` : '';

        return `
        <div id="card-${a.id}" style="border:1px solid #e8edf3;border-radius:12px;padding:1.1rem 1.25rem;
                    margin-bottom:0.85rem;background:#fff;">
            <div style="display:flex;align-items:flex-start;gap:0.85rem;margin-bottom:0.6rem;">
                <div style="width:42px;height:42px;border-radius:50%;background:var(--navy-700);
                            color:#fff;flex-shrink:0;display:flex;align-items:center;
                            justify-content:center;font-weight:700;font-size:0.85rem;">${initials}</div>
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                        <span style="font-weight:700;font-size:0.9375rem;color:var(--navy-800);word-break:break-word;overflow-wrap:break-word;">${a.name}</span>
                        <span id="badge-${a.id}" style="background:${s.bg};color:${s.color};font-size:0.7rem;
                                     font-weight:700;padding:2px 10px;border-radius:20px;white-space:nowrap;">${s.label}</span>
                    </div>
                    ${courseStr ? `<div style="font-size:0.78rem;color:var(--charcoal-400);margin-top:2px;word-break:break-word;overflow-wrap:break-word;">${courseStr}</div>` : ''}
                    <div style="font-size:0.78rem;color:var(--charcoal-400);margin-top:2px;">Student</div>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.35rem;margin-bottom:0.75rem;">
                <div style="font-size:0.8rem;color:var(--charcoal-500);word-break:break-all;"><i class="bi bi-envelope me-1"></i>${a.email}</div>
                <div style="font-size:0.8rem;color:var(--charcoal-500);word-break:break-word;"><i class="bi bi-telephone me-1"></i>${a.phone}</div>
                ${a.year ? `<div style="font-size:0.8rem;color:var(--charcoal-400);""><i class="bi bi-mortarboard me-1"></i>${a.year}</div>` : ''}
                <div style="font-size:0.8rem;color:var(--charcoal-400);"><i class="bi bi-calendar me-1"></i>Applied: ${a.applied_at}</div>
            </div>
            ${interviewInfo}
            <div id="actions-${a.id}" style="display:flex;gap:0.6rem;flex-wrap:wrap;">
                ${renderActionButtons(a.id, a.status, a.interview)}
            </div>
        </div>`;
    }).join('');
}

function renderActionButtons(id, status, interview = null) {
    const viewBtn = `<button onclick="openDetailModal(${id})"
        style="background:var(--navy-50);color:var(--navy-700);border:1.5px solid var(--navy-100);
               border-radius:8px;padding:6px 16px;font-size:0.8rem;font-weight:600;cursor:pointer;
               display:flex;align-items:center;gap:5px;white-space:nowrap;">
        <i class="bi bi-eye"></i> View Application
    </button>`;

    const rejectBtn = `<button onclick="listUpdateStatus(${id}, 'rejected')"
        style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:8px;
               padding:6px 16px;font-size:0.8rem;font-weight:600;cursor:pointer;
               display:flex;align-items:center;gap:5px;white-space:nowrap;">
        <i class="bi bi-x-circle"></i> Reject
    </button>`;

    if (status === 'selected' || status === 'rejected') {
        return viewBtn;
    }
    if (status === 'interview_scheduled') {
        return viewBtn + `
        <button onclick="selectCandidate(${id})"
            style="background:#15803d;color:#fff;border:none;border-radius:8px;
                   padding:6px 16px;font-size:0.8rem;font-weight:600;cursor:pointer;
                   display:flex;align-items:center;gap:5px;white-space:nowrap;">
            <i class="bi bi-person-check-fill"></i> Select Candidate
        </button>` + rejectBtn;
    }
    if (status === 'shortlisted') {
        const hasInterview = interview || applicantInterviews[id];
        const interviewBtn = `
        <button onclick="openInterviewModal(${id})"
            style="background:${hasInterview ? '#0891b2' : '#d97706'};color:#fff;border:none;border-radius:8px;
                   padding:6px 16px;font-size:0.8rem;font-weight:600;cursor:pointer;
                   display:flex;align-items:center;gap:5px;white-space:nowrap;">
            <i class="bi bi-${hasInterview ? 'pencil-square' : 'calendar-plus'}"></i> ${hasInterview ? 'Edit Interview' : 'Schedule Interview'}
        </button>`;
        return viewBtn + interviewBtn + rejectBtn;
    }
    // pending / review
    return viewBtn + `
    <button onclick="listUpdateStatus(${id}, 'shortlisted')"
        style="background:var(--navy-700);color:#fff;border:none;border-radius:8px;
               padding:6px 16px;font-size:0.8rem;font-weight:600;cursor:pointer;
               display:flex;align-items:center;gap:5px;white-space:nowrap;">
        <i class="bi bi-person-check"></i> Shortlist
    </button>` + rejectBtn;
}

function closeApplicantsModal() { document.getElementById('applicantsModal').style.display = 'none'; }
document.getElementById('applicantsModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeApplicantsModal(); });

// ── Detail modal ─────────────────────────────────────────────────
function openDetailModal(applicationId) {
    currentDetailId = applicationId;
    document.getElementById('detailModal').style.display    = 'flex';
    document.getElementById('detailLoading').style.display  = 'block';
    document.getElementById('detailContent').style.display  = 'none';
    document.getElementById('detailFooter').innerHTML       = '';

    fetch(`/applications/${applicationId}/detail`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(d => {
            const s        = statusLabels[d.status] || statusLabels.pending;
            const name     = d.student.name || '—';
            const initials = name !== '—' ? name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase() : '?';

            document.getElementById('detailAvatar').textContent = initials;
            document.getElementById('detailName').textContent   = name;

            const badge = document.getElementById('detailStatusBadge');
            badge.textContent = s.label; badge.style.background = s.bg; badge.style.color = s.color;

            const courseStr = [d.student.course, d.student.university].filter(Boolean).join(' — ');
            document.getElementById('detailCourse').textContent = courseStr;

            document.getElementById('detailEmail').innerHTML = '<i class="bi bi-envelope me-1" style="font-size:0.75rem;"></i>' + (d.student.email || '—');
            document.getElementById('detailPhone').innerHTML = '<i class="bi bi-telephone me-1" style="font-size:0.75rem;"></i>' + (d.student.phone || '—');

            const yearEl = document.getElementById('detailYear');
            if (d.student.year) {
                yearEl.innerHTML = '<i class="bi bi-mortarboard me-1" style="font-size:0.72rem;"></i>' + d.student.year;
                yearEl.style.display = 'inline-flex';
            } else { yearEl.style.display = 'none'; }

            // Interview section
            const iSection = document.getElementById('detailInterviewSection');
            if (d.interview) {
                const typeIcon = d.interview.type === 'physical' ? '📍' : '💻';
                document.getElementById('detailInterviewInfo').innerHTML =
                    `<strong>Date:</strong> ${d.interview.date} at ${d.interview.time}<br>
                     <strong>Type:</strong> ${typeIcon} ${d.interview.type === 'physical' ? 'Physical' : 'Online'}<br>
                     ${d.interview.location_or_link ? `<strong>${d.interview.type === 'physical' ? 'Location' : 'Link'}:</strong> ${d.interview.location_or_link}<br>` : ''}
                     ${d.interview.notes ? `<strong>Notes:</strong> ${d.interview.notes}` : ''}`;
                iSection.style.display = 'block';
            } else { iSection.style.display = 'none'; }

            document.getElementById('detailCVName').textContent = d.cv_filename || 'CV File';
            document.getElementById('detailCVDate').textContent = 'Uploaded ' + d.applied_at;
            
            // Set CV download button
            const cvBtn = document.getElementById('detailCVDownload');
            if (d.cv_url) {
                cvBtn.href = d.cv_url;
                cvBtn.download = d.cv_filename || 'cv.pdf';
                cvBtn.style.display = 'flex';
            } else {
                cvBtn.style.display = 'none';
            }

            const clSection = document.getElementById('detailCLSection');
            if (d.cover_letter) { document.getElementById('detailCL').textContent = d.cover_letter; clSection.style.display = 'block'; }
            else { clSection.style.display = 'none'; }

            const aiSection = document.getElementById('detailAISection');
            if (d.additional_info) { document.getElementById('detailAI').textContent = d.additional_info; aiSection.style.display = 'block'; }
            else { aiSection.style.display = 'none'; }

            // Dynamic footer
            document.getElementById('detailFooter').innerHTML = renderDetailFooter(d.id, d.status);

            document.getElementById('detailLoading').style.display = 'none';
            document.getElementById('detailContent').style.display = 'block';
        })
        .catch(() => {
            document.getElementById('detailLoading').innerHTML =
                '<p style="color:#b91c1c;text-align:center;margin-top:1rem;">Failed to load details.</p>';
        });
}

function renderDetailFooter(id, status) {
    const closeBtn = `<button onclick="closeDetailModal()"
        style="margin-left:auto;background:#fff;color:var(--charcoal-500);border:1px solid #e2e8f0;
               border-radius:8px;padding:0.6rem 1.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;white-space:nowrap;">Close</button>`;

    if (status === 'selected' || status === 'rejected') return closeBtn;

    if (status === 'interview_scheduled') {
        return `<button onclick="detailSelectCandidate()"
            style="background:#15803d;color:#fff;border:none;border-radius:8px;padding:0.6rem 1.5rem;
                   font-size:0.875rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;white-space:nowrap;">
            <i class="bi bi-person-check-fill"></i> Select Candidate
        </button>
        <button onclick="detailUpdateStatus('rejected')"
            style="background:#fff;color:#b91c1c;border:1px solid #fecaca;border-radius:8px;
                   padding:0.6rem 1.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;
                   display:flex;align-items:center;gap:6px;white-space:nowrap;">
            <i class="bi bi-x-circle"></i> Reject
        </button>` + closeBtn;
    }

    if (status === 'shortlisted') {
        return `<button onclick="openInterviewModal(${id});"
            style="background:#d97706;color:#fff;border:none;border-radius:8px;padding:0.6rem 1.5rem;
                   font-size:0.875rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;white-space:nowrap;">
            <i class="bi bi-calendar-plus"></i> Schedule Interview
        </button>
        <button onclick="detailUpdateStatus('rejected')"
            style="background:#fff;color:#b91c1c;border:1px solid #fecaca;border-radius:8px;
                   padding:0.6rem 1.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;
                   display:flex;align-items:center;gap:6px;white-space:nowrap;">
            <i class="bi bi-x-circle"></i> Reject
        </button>` + closeBtn;
    }

    return `<button onclick="detailUpdateStatus('shortlisted')"
        style="background:var(--navy-700);color:#fff;border:none;border-radius:8px;padding:0.6rem 1.5rem;
               font-size:0.875rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;white-space:nowrap;">
        <i class="bi bi-person-check"></i> Shortlist Candidate
    </button>
    <button onclick="detailUpdateStatus('rejected')"
        style="background:#fff;color:#b91c1c;border:1px solid #fecaca;border-radius:8px;
               padding:0.6rem 1.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;
               display:flex;align-items:center;gap:6px;white-space:nowrap;">
        <i class="bi bi-x-circle"></i> Reject
    </button>` + closeBtn;
}

function closeDetailModal() { document.getElementById('detailModal').style.display = 'none'; currentDetailId = null; }
document.getElementById('detailModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeDetailModal(); });

// ── Interview modal ───────────────────────────────────────────────
function openInterviewModal(applicationId) {
    scheduleTargetId = applicationId;
    document.getElementById('interviewModal').style.display = 'flex';
    document.getElementById('iDate').value     = '';
    document.getElementById('iTime').value     = '';
    document.getElementById('iLocation').value = '';
    document.getElementById('iNotes').value    = '';
    document.getElementById('iError').style.display = 'none';
    document.querySelectorAll('input[name="iType"]').forEach(r => r.checked = false);
    updateTypeStyle();
}

function closeInterviewModal() { document.getElementById('interviewModal').style.display = 'none'; scheduleTargetId = null; }
document.getElementById('interviewModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeInterviewModal(); });

function updateTypeStyle() {
    const physical = document.getElementById('iTypePhysical').checked;
    const online   = document.getElementById('iTypeOnline').checked;
    document.getElementById('typePhysicalLabel').style.borderColor = physical ? 'var(--navy-700)' : '#e2e8f0';
    document.getElementById('typeOnlineLabel').style.borderColor   = online   ? 'var(--navy-700)' : '#e2e8f0';
    document.getElementById('iLocationLabel').textContent = online ? 'Meeting Link' : 'Location';
    document.getElementById('iLocation').placeholder = online
        ? 'e.g. https://meet.google.com/...'
        : 'e.g. Head Office, Nairobi CBD';
}

function submitInterview() {
    const date     = document.getElementById('iDate').value;
    const time     = document.getElementById('iTime').value;
    const typeEl   = document.querySelector('input[name="iType"]:checked');
    const location = document.getElementById('iLocation').value;
    const notes    = document.getElementById('iNotes').value;
    const errEl    = document.getElementById('iError');
    const confirmBtn = event.target; // Get the button being clicked
    
    // Prevent duplicate submissions
    if (confirmBtn.disabled) return;
    confirmBtn.disabled = true;

    if (!date || !time || !typeEl) {
        errEl.textContent    = 'Please fill in date, time and interview type.';
        errEl.style.display  = 'block';
        confirmBtn.disabled = false;
        return;
    }
    errEl.style.display = 'none';
    confirmBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Confirming...';

    const id = scheduleTargetId; // Save ID before closing modal
    
    fetch(`/applications/${id}/schedule`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ interview_date: date, interview_time: time, type: typeEl.value, location_or_link: location, notes })
    })
    .then(r => r.json())
    .then(data => {
        // Store the interview data so button updates immediately
        applicantInterviews[id] = {
            date: date,
            time: time,
            type: typeEl.value,
            location_or_link: location,
            notes: notes
        };
        updateCardStatus(id, 'interview_scheduled');
        closeInterviewModal();
    })
    .catch(() => { 
        errEl.textContent = 'Failed to schedule interview.'; 
        errEl.style.display = 'block';
        confirmBtn.disabled = false;
        confirmBtn.innerHTML = '<i class="bi bi-calendar-check"></i> Confirm Interview';
    });
}

// ── Select candidate ──────────────────────────────────────────────
function selectCandidate(id) {
    fetch(`/applications/${id}/select`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(r => r.json())
    .then(() => updateCardStatus(id, 'selected'))
    .catch(err => console.error(err));
}

function detailSelectCandidate() {
    if (!currentDetailId) return;
    fetch(`/applications/${currentDetailId}/select`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(r => r.json())
    .then(() => {
        updateBadgeAndButtons(currentDetailId, 'selected');
        document.getElementById('detailFooter').innerHTML = renderDetailFooter(currentDetailId, 'selected');
        const badge = document.getElementById('detailStatusBadge');
        const s = statusLabels['selected'];
        badge.textContent = s.label; badge.style.background = s.bg; badge.style.color = s.color;
    });
}

// ── Status updates ────────────────────────────────────────────────
function listUpdateStatus(id, status) {
    callUpdateStatus(id, status, () => updateCardStatus(id, status));
}

function detailUpdateStatus(status) {
    if (!currentDetailId) return;
    callUpdateStatus(currentDetailId, status, () => {
        updateBadgeAndButtons(currentDetailId, status);
        document.getElementById('detailFooter').innerHTML = renderDetailFooter(currentDetailId, status);
        const badge = document.getElementById('detailStatusBadge');
        const s = statusLabels[status] || statusLabels.pending;
        badge.textContent = s.label; badge.style.background = s.bg; badge.style.color = s.color;
    });
}

function callUpdateStatus(id, status, onSuccess) {
    fetch(`/applications/${id}/status`, {
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

function renderInterviewInfoBox(interview) {
    if (!interview) return '';
    return `<div style="background:#fefce8;border:1px solid #fef08a;border-radius:8px;
                       padding:6px 10px;font-size:0.78rem;color:#713f12;margin-bottom:0.6rem;">
            <i class="bi bi-calendar-event me-1"></i>
            ${interview.date || ''} at ${interview.time || ''} — ${interview.type === 'physical' ? '📍' : '💻'} ${interview.location_or_link || ''}
           </div>`;
}

function updateCardStatus(id, status) {
    updateBadgeAndButtons(id, status);
    // Update interview info box if interview exists
    updateInterviewInfoOnCard(id);
    if (currentDetailId === id) {
        const badge = document.getElementById('detailStatusBadge');
        if (badge) {
            const s = statusLabels[status] || statusLabels.pending;
            badge.textContent = s.label; badge.style.background = s.bg; badge.style.color = s.color;
        }
        // Update interview section in detail modal
        if (status === 'interview_scheduled') {
            const interview = applicantInterviews[id];
            if (interview) {
                const iSection = document.getElementById('detailInterviewSection');
                const typeIcon = interview.type === 'physical' ? '📍' : '💻';
                document.getElementById('detailInterviewInfo').innerHTML =
                    `<strong>Date:</strong> ${interview.date} at ${interview.time}<br>
                     <strong>Type:</strong> ${typeIcon} ${interview.type === 'physical' ? 'Physical' : 'Online'}<br>
                     ${interview.location_or_link ? `<strong>${interview.type === 'physical' ? 'Location' : 'Link'}:</strong> ${interview.location_or_link}<br>` : ''}
                     ${interview.notes ? `<strong>Notes:</strong> ${interview.notes}` : ''}`;
                iSection.style.display = 'block';
            }
        }
        document.getElementById('detailFooter').innerHTML = renderDetailFooter(id, status);
    }
}

function updateBadgeAndButtons(id, status) {
    const badge = document.getElementById('badge-' + id);
    if (badge) {
        const s = statusLabels[status] || statusLabels.pending;
        badge.textContent = s.label; badge.style.background = s.bg; badge.style.color = s.color;
    }
    const actions = document.getElementById('actions-' + id);
    if (actions) actions.innerHTML = renderActionButtons(id, status, applicantInterviews[id]);
}

function updateInterviewInfoOnCard(id) {
    const card = document.getElementById('card-' + id);
    if (!card) return;
    
    const interview = applicantInterviews[id];
    const interviewBox = card.querySelector('div[style*="background:#fefce8"]');
    
    if (interview) {
        const newHTML = renderInterviewInfoBox(interview);
        if (interviewBox) {
            interviewBox.outerHTML = newHTML;
        } else {
            // Insert interview box after contact info, before action buttons
            const actionsDiv = card.querySelector('[id^="actions-"]');
            if (actionsDiv) {
                actionsDiv.insertAdjacentHTML('beforebegin', newHTML);
            }
        }
    } else if (interviewBox) {
        interviewBox.remove();
    }
}

// ── CV Preview Modal ──────────────────────────────────────────────
function openCVPreview(cvUrl, fileName) {
    document.getElementById('cvPreviewModal').style.display = 'flex';
    document.getElementById('cvPreviewTitle').textContent = fileName || 'CV Preview';
    document.getElementById('cvPreviewDownload').href = cvUrl;
    document.getElementById('cvPreviewDownload').download = fileName || 'cv.pdf';
    
    // Detect file type from extension
    const ext = (fileName || '').toLowerCase().split('.').pop() || 'pdf';
    const docxExtensions = ['docx', 'doc', 'xlsx', 'xls', 'pptx', 'ppt'];
    const isOfficeDoc = docxExtensions.includes(ext);
    
    document.getElementById('cvPreviewLoading').style.display = 'block';
    document.getElementById('cvPreviewFrame').style.display = 'none';
    document.getElementById('cvPreviewMessage').style.display = 'none';
    
    if (isOfficeDoc) {
        // Use PDF.js or fallback to download for Office documents
        // First try to load directly (modern browsers may support)
        const previewUrl = cvUrl + (cvUrl.includes('?') ? '&' : '?') + 'preview=true';
        document.getElementById('cvPreviewFrame').src = previewUrl;
        document.getElementById('cvPreviewFrame').style.display = '';
    } else if (ext === 'pdf' || ext === 'txt') {
        // Use browser's native PDF/text preview with inline parameter
        const previewUrl = cvUrl + (cvUrl.includes('?') ? '&' : '?') + 'preview=true';
        document.getElementById('cvPreviewFrame').src = previewUrl;
        document.getElementById('cvPreviewFrame').style.display = '';
    } else {
        // Unsupported file type
        document.getElementById('cvPreviewMessage').innerHTML = 
            `<div style="padding:2rem;text-align:center;">
                <div style="font-size:3rem;margin-bottom:1rem;">📄</div>
                <p style="font-size:1rem;font-weight:600;color:#374151;margin-bottom:0.5rem;">
                    Preview not available for this file type
                </p>
                <p style="font-size:0.9rem;color:#6b7280;margin-bottom:1.5rem;">
                    Files with extension .${ext} cannot be previewed online.
                </p>
                <a href="${cvUrl}"
                   style="background:var(--navy-700);color:#fff;padding:0.7rem 1.5rem;
                          border-radius:8px;text-decoration:none;display:inline-block;
                          font-weight:600;cursor:pointer;">
                    Download File
                </a>
            </div>`;
        document.getElementById('cvPreviewMessage').style.display = 'block';
    }
    
    // Set longer timeout for loading
    let loadTimeout = setTimeout(() => {
        if (document.getElementById('cvPreviewLoading').style.display !== 'none') {
            document.getElementById('cvPreviewLoading').style.display = 'none';
        }
    }, 8000);
    
    document.getElementById('cvPreviewFrame').onload = () => {
        clearTimeout(loadTimeout);
        document.getElementById('cvPreviewLoading').style.display = 'none';
    };
    document.getElementById('cvPreviewFrame').onerror = () => {
        clearTimeout(loadTimeout);
        document.getElementById('cvPreviewLoading').style.display = 'none';
        document.getElementById('cvPreviewFrame').style.display = 'none';
        document.getElementById('cvPreviewMessage').innerHTML = 
            `<div style="padding:2rem;text-align:center;">
                <div style="font-size:3rem;margin-bottom:1rem;">⚠️</div>
                <p style="font-size:1rem;font-weight:600;color:#991b1b;margin-bottom:0.5rem;">
                    Unable to Preview File
                </p>
                <p style="font-size:0.9rem;color:#6b7280;margin-bottom:1.5rem;">
                    The preview could not be loaded. Please download the file instead.
                </p>
                <a href="${cvUrl}"
                   style="background:var(--navy-700);color:#fff;padding:0.7rem 1.5rem;
                          border-radius:8px;text-decoration:none;display:inline-block;
                          font-weight:600;cursor:pointer;">
                    Download File
                </a>
            </div>`;
        document.getElementById('cvPreviewMessage').style.display = 'block';
    };
}

function closeCVPreview() {
    document.getElementById('cvPreviewModal').style.display = 'none';
    document.getElementById('cvPreviewFrame').src = '';
}

document.getElementById('cvPreviewModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeCVPreview();
});
</script>

{{-- ═══ CV PREVIEW MODAL ═══ --}}
<div id="cvPreviewModal"
     style="display:none;position:fixed;inset:0;z-index:1080;
            background:rgba(15,23,42,0.6);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:900px;height:90vh;
                margin:1rem;display:flex;flex-direction:column;
                box-shadow:0 24px 64px rgba(0,0,0,0.3);">
        
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #f0f4f8;
                    display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
            <h5 id="cvPreviewTitle" class="mb-0 fw-bold" style="color:var(--navy-800);font-size:1rem;"></h5>
            <div style="display:flex;align-items:center;gap:0.75rem;">
                <a id="cvPreviewDownload" href="#" download
                   style="background:var(--navy-700);color:#fff;border:none;border-radius:8px;
                          padding:0.5rem 1rem;font-size:0.875rem;font-weight:600;
                          text-decoration:none;display:flex;align-items:center;gap:5px;cursor:pointer;">
                    <i class="bi bi-download"></i> Download
                </a>
                <button onclick="closeCVPreview()"
                        style="background:none;border:none;font-size:1.5rem;
                               color:var(--charcoal-400);cursor:pointer;line-height:1;padding:4px;">&times;</button>
            </div>
        </div>

        <div style="flex:1;overflow:hidden;position:relative;">
            <div id="cvPreviewLoading" style="display:none;position:absolute;inset:0;
                    background:#fff;display:flex;align-items:center;justify-content:center;z-index:10;">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>
            <div id="cvPreviewMessage" style="display:none;position:absolute;inset:0;
                    background:#fff;overflow-y:auto;z-index:9;"></div>
            <iframe id="cvPreviewFrame" 
                    style="width:100%;height:100%;border:none;display:none;"></iframe>
        </div>
    </div>
</div>

</body>
</html>