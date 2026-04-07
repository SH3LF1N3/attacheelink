@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">Browse Opportunities</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Opportunities</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                {{-- Search & Filter bar --}}
                <form method="GET" action="{{ route('my_opportunities') }}"
                      style="display:flex;flex-wrap:wrap;gap:0.75rem;align-items:center;margin-bottom:1.25rem;">

                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="Search by title, organisation, or keyword..."
                           style="flex:1;min-width:220px;border:1px solid #e2e8f0;border-radius:8px;
                                  padding:0.5rem 0.85rem;font-size:0.875rem;color:#1e293b;
                                  background:#fff;outline:none;">

                    <select name="loc"
                            style="border:1px solid #e2e8f0;border-radius:8px;
                                   padding:0.5rem 0.85rem;font-size:0.875rem;
                                   color:#1e293b;background:#fff;cursor:pointer;min-width:150px;">
                        <option value="">All Counties</option>
                        @foreach(['Nairobi','Mombasa','Kisumu','Nakuru','Eldoret','Meru','Embu','Tharaka-Nithi','Kisii','Nyeri'] as $county)
                            <option value="{{ $county }}" {{ request('loc') === $county ? 'selected' : '' }}>
                                {{ $county }}
                            </option>
                        @endforeach
                    </select>

                    <select name="dept"
                            style="border:1px solid #e2e8f0;border-radius:8px;
                                   padding:0.5rem 0.85rem;font-size:0.875rem;
                                   color:#1e293b;background:#fff;cursor:pointer;min-width:180px;">
                        <option value="">All Departments</option>
                        @foreach(['Data Science & Analytics','Software Engineering','Cybersecurity','IT & Systems','Product & Design','Front-End Development','Full Stack Development','AI & Machine Learning','Cloud Computing'] as $dept)
                            <option value="{{ $dept }}" {{ request('dept') === $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                            style="background:var(--navy-700);color:#fff;border:none;
                                   border-radius:8px;padding:0.5rem 1.25rem;
                                   font-size:0.875rem;font-weight:600;cursor:pointer;
                                   display:flex;align-items:center;gap:6px;">
                        <i class="bi bi-search"></i> Search
                    </button>

                    @if(request()->hasAny(['q','loc','dept']))
                    <a href="{{ route('my_opportunities') }}"
                       style="font-size:0.82rem;color:var(--charcoal-400);text-decoration:none;
                              padding:0.5rem 0.75rem;border:1px solid #e2e8f0;border-radius:8px;
                              background:#fff;">
                        &#x2715; Clear
                    </a>
                    @endif

                </form>

                {{-- Stats strip --}}
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span style="font-size:0.875rem;color:var(--charcoal-400);">
                        <i class="bi bi-list-task me-1" style="color:var(--navy-600);"></i>
                        <strong style="color:var(--navy-800);">{{ $opportunities->total() }}</strong>
                        open opportunities available
                    </span>
                </div>

                @if($opportunities->isEmpty())
                    <div class="card shadow-sm text-center py-5" style="border:none;border-radius:12px;">
                        <i class="bi bi-list-task" style="font-size:3rem;color:#d1d5db;"></i>
                        <p class="mt-3 text-muted">No open opportunities right now. Check back soon!</p>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach($opportunities as $oppo)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm"
                                 style="border:1px solid #e8edf3;border-radius:12px;overflow:hidden;
                                        transition:box-shadow 0.2s,transform 0.2s;">
                                <div class="card-body p-4">

                                    {{-- Title + badge --}}
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <h6 class="fw-bold mb-0"
                                            style="color:var(--navy-800);font-size:0.95rem;">
                                            {{ $oppo->oname ?? '—' }}
                                        </h6>
                                        <span class="ms-2"
                                              style="background:var(--navy-50);color:var(--navy-700);
                                                     font-size:0.7rem;font-weight:700;
                                                     padding:3px 10px;border-radius:var(--radius-full);
                                                     white-space:nowrap;">
                                            Active
                                        </span>
                                    </div>

                                    {{-- Org + location --}}
                                    <div style="font-size:0.8rem;color:var(--charcoal-400);" class="mb-3">
                                        <div><i class="bi bi-building me-1"></i>{{ $oppo->org ?? '—' }}</div>
                                        @if($oppo->loc)
                                        <div class="mt-1"><i class="bi bi-geo-alt me-1"></i>{{ $oppo->loc }}</div>
                                        @endif
                                    </div>

                                    {{-- Chips --}}
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @if($oppo->duration)
                                        <span style="background:var(--navy-50);color:var(--navy-700);
                                                     font-size:0.72rem;padding:3px 10px;
                                                     border-radius:var(--radius-full);">
                                            <i class="bi bi-clock me-1"></i>{{ $oppo->duration }}
                                        </span>
                                        @endif
                                        @if($oppo->slot)
                                        <span style="background:var(--navy-50);color:var(--navy-700);
                                                     font-size:0.72rem;padding:3px 10px;
                                                     border-radius:var(--radius-full);">
                                            <i class="bi bi-people me-1"></i>{{ $oppo->slot }} slot(s)
                                        </span>
                                        @endif
                                    </div>

                                    {{-- Description with Read More toggle --}}
                                    @if($oppo->descr)
                                    <div class="oppo-description-wrapper" style="position:relative;">
                                        <p class="oppo-description" 
                                           style="font-size:0.8rem;color:var(--charcoal-400);line-height:1.6;
                                                  margin:0;max-height:3.2rem;overflow:hidden;
                                                  transition:max-height 0.3s ease;"
                                           data-full-text="{{ $oppo->descr }}">
                                            {{ $oppo->descr }}
                                        </p>
                                        <button type="button" 
                                                class="oppo-read-more-btn"
                                                onclick="toggleDescription(this)"
                                                style="background:none;border:none;color:var(--navy-700);
                                                       font-size:0.765rem;font-weight:600;cursor:pointer;
                                                       padding:0.25rem 0;margin-top:0.3rem;
                                                       text-decoration:underline;transition:color 0.2s;">
                                            Read More
                                        </button>
                                    </div>
                                    @endif

                                    {{-- Footer: deadline + apply --}}
                                    <div class="d-flex align-items-center justify-content-between mt-auto pt-2"
                                         style="border-top:1px solid #f0f4f8;">
                                        @if($oppo->dead)
                                        <span style="font-size:0.72rem;color:#dc2626;">
                                            <i class="bi bi-calendar-x me-1"></i>Deadline: {{ $oppo->dead }}
                                        </span>
                                        @else
                                        <span></span>
                                        @endif

                                        {{-- CHANGED: button now triggers modal, no page redirect --}}
                                        <button type="button"
                                                class="btn-apply"
                                                data-id="{{ $oppo->id }}"
                                                data-url="{{ route('oppo.apply.data', $oppo->id) }}"
                                                data-store="{{ route('oppo.apply.store', $oppo->id) }}"
                                                style="background:var(--navy-700);color:#fff;
                                                       border:none;border-radius:var(--radius-sm);
                                                       font-size:0.8rem;font-weight:600;
                                                       padding:0.4rem 1rem;cursor:pointer;
                                                       transition:background 0.15s;"
                                                onmouseover="this.style.background='var(--navy-800)'"
                                                onmouseout="this.style.background='var(--navy-700)'">
                                            Apply
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4">{{ $opportunities->links() }}</div>
                @endif

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

{{-- ===================== APPLY MODAL ===================== --}}
<div id="applyOverlay"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);
            z-index:1055;align-items:center;justify-content:center;">

    <div style="background:#fff;border-radius:16px;width:100%;max-width:560px;
                margin:1rem;box-shadow:0 8px 32px rgba(0,0,0,0.18);overflow:hidden;">

        {{-- Modal header --}}
        <div style="display:flex;align-items:center;justify-content:space-between;
                    padding:1.25rem 1.5rem;border-bottom:1px solid #e8edf3;">
            <span style="font-weight:700;font-size:1rem;color:#1e293b;">Apply for Position</span>
            <button id="modalClose"
                    style="background:none;border:none;font-size:1.25rem;
                           cursor:pointer;color:#64748b;line-height:1;">&times;</button>
        </div>

        {{-- Opportunity summary card --}}
        <div id="modalOppoCard"
             style="margin:1.25rem 1.5rem 0;background:#f8fafc;border-radius:10px;
                    border:1px solid #e2e8f0;padding:0.9rem 1rem;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="background:#e8edf3;border-radius:8px;padding:8px;">
                    <i class="bi bi-briefcase" style="font-size:1.1rem;color:#1e3a5f;"></i>
                </div>
                <div>
                    <div id="modalOname" style="font-weight:700;font-size:0.9rem;color:#1e293b;"></div>
                    <div id="modalOrg"   style="font-size:0.8rem;color:#64748b;"></div>
                    <div id="modalMeta"  style="font-size:0.75rem;color:#94a3b8;margin-top:2px;"></div>
                </div>
            </div>
        </div>

        {{-- Already applied notice (hidden by default) --}}
        <div id="alreadyAppliedNotice"
             style="display:none;margin:1rem 1.5rem 0;background:#fef2f2;
                    border:1px solid #fecaca;border-radius:8px;padding:0.75rem 1rem;
                    font-size:0.82rem;color:#dc2626;">
            <i class="bi bi-exclamation-circle me-1"></i>
            You have already applied for this opportunity.
        </div>

        {{-- Form --}}
        <form id="applyForm" enctype="multipart/form-data" style="padding:1.25rem 1.5rem;">
            @csrf

            {{-- CV Upload --}}
            <div class="mb-3">
                <label style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:6px;">
                    Upload CV / Resume <span style="color:#dc2626;">*</span>
                </label>
                <div id="dropZone"
                     style="border:2px dashed #cbd5e1;border-radius:10px;padding:1.5rem;
                            text-align:center;cursor:pointer;transition:border-color 0.2s;">
                    <i class="bi bi-cloud-upload" style="font-size:1.5rem;color:#94a3b8;"></i>
                    <p style="font-size:0.78rem;color:#94a3b8;margin:6px 0 8px;">
                        Click to upload or drag and drop<br>
                        <span style="font-size:0.72rem;">PDF or DOCX (MAX. 2MB)</span>
                    </p>
                    <button type="button" id="selectFileBtn"
                            style="background:#fff;border:1px solid #cbd5e1;border-radius:6px;
                                   padding:5px 14px;font-size:0.78rem;cursor:pointer;">
                        Select File
                    </button>
                    <input type="file" id="cvFile" name="cv"
                           accept=".pdf,.docx" style="display:none;">
                    <div id="fileName" style="font-size:0.75rem;color:#1e3a5f;margin-top:6px;"></div>
                </div>
            </div>

            {{-- Cover Letter --}}
            <div class="mb-3">
                <label style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:6px;">
                    Cover Letter
                </label>
                <textarea name="cover_letter" rows="4"
                          style="width:100%;border:1px solid #cbd5e1;border-radius:8px;
                                 padding:0.6rem 0.75rem;font-size:0.82rem;resize:vertical;
                                 font-family:inherit;color:#374151;"
                          placeholder="Explain why you're interested in this position and what makes you a good fit..."></textarea>
            </div>

            {{-- Additional Info --}}
            <div class="mb-3">
                <label style="font-size:0.82rem;font-weight:600;color:#374151;display:block;margin-bottom:6px;">
                    Additional Information <span style="font-weight:400;color:#94a3b8;">(Optional)</span>
                </label>
                <textarea name="additional_info" rows="3"
                          style="width:100%;border:1px solid #cbd5e1;border-radius:8px;
                                 padding:0.6rem 0.75rem;font-size:0.82rem;resize:vertical;
                                 font-family:inherit;color:#374151;"
                          placeholder="Any other relevant information you'd like to share..."></textarea>
            </div>

            {{-- Form error --}}
            <div id="formError"
                 style="display:none;background:#fef2f2;border:1px solid #fecaca;
                        border-radius:8px;padding:0.6rem 0.9rem;font-size:0.8rem;
                        color:#dc2626;margin-bottom:12px;"></div>

            {{-- Buttons --}}
            <div style="display:flex;justify-content:flex-end;gap:10px;padding-top:4px;">
                <button type="button" id="cancelBtn"
                        style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;
                               padding:0.45rem 1.2rem;font-size:0.82rem;cursor:pointer;color:#374151;">
                    Cancel
                </button>
                <button type="submit" id="submitBtn"
                        style="background:var(--navy-700,#1e3a5f);color:#fff;border:none;
                               border-radius:8px;padding:0.45rem 1.4rem;font-size:0.82rem;
                               font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;">
                    <i class="bi bi-send"></i> Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== SUCCESS MODAL ===================== --}}
<div id="successOverlay"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);
            z-index:1056;align-items:center;justify-content:center;">

    <div style="background:#fff;border-radius:16px;width:100%;max-width:480px;
                margin:1rem;padding:2.5rem 2rem;text-align:center;">

        <div style="width:56px;height:56px;background:#dcfce7;border-radius:50%;
                    display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
            <i class="bi bi-check-circle" style="font-size:1.6rem;color:#16a34a;"></i>
        </div>

        <h5 style="font-weight:700;color:#1e293b;margin-bottom:8px;">Application Submitted!</h5>
        <p id="successMsg" style="font-size:0.85rem;color:#64748b;margin-bottom:1.5rem;"></p>

        <button id="successClose"
                style="background:var(--navy-700,#1e3a5f);color:#fff;border:none;
                       border-radius:8px;padding:0.5rem 2rem;font-size:0.85rem;
                       font-weight:600;cursor:pointer;">
            Close
        </button>
    </div>
</div>

{{-- ===================== SCRIPTS ===================== --}}
<script>
(function () {
    const overlay      = document.getElementById('applyOverlay');
    const successOv    = document.getElementById('successOverlay');
    const form         = document.getElementById('applyForm');
    const closeBtn     = document.getElementById('modalClose');
    const cancelBtn    = document.getElementById('cancelBtn');
    const successClose = document.getElementById('successClose');
    const selectBtn    = document.getElementById('selectFileBtn');
    const cvInput      = document.getElementById('cvFile');
    const fileNameEl   = document.getElementById('fileName');
    const formError    = document.getElementById('formError');
    const submitBtn    = document.getElementById('submitBtn');
    const alreadyNote  = document.getElementById('alreadyAppliedNotice');

    let storeUrl = '';

    // Open modal
    document.querySelectorAll('.btn-apply').forEach(btn => {
        btn.addEventListener('click', function () {
            const dataUrl = this.dataset.url;
            storeUrl = this.dataset.store;

            // Reset form state
            form.reset();
            fileNameEl.textContent = '';
            formError.style.display = 'none';
            alreadyNote.style.display = 'none';
            submitBtn.disabled = false;

            // Fetch opportunity details
            fetch(dataUrl, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(d => {
                document.getElementById('modalOname').textContent = d.oname ?? '—';
                document.getElementById('modalOrg').textContent   = d.org   ?? '—';

                let meta = [];
                if (d.loc)      meta.push('📍 ' + d.loc);
                if (d.duration) meta.push('🕐 ' + d.duration);
                if (d.dead)     meta.push('📅 Deadline: ' + d.dead);
                document.getElementById('modalMeta').textContent = meta.join('   ');

                if (d.already_applied) {
                    alreadyNote.style.display = 'block';
                    submitBtn.disabled = true;
                }

                overlay.style.display = 'flex';
            });
        });
    });

    function closeModal() {
        overlay.style.display = 'none';
    }

    closeBtn.addEventListener('click',  closeModal);
    cancelBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });

    // File picker
    selectBtn.addEventListener('click', () => cvInput.click());
    cvInput.addEventListener('change', () => {
        fileNameEl.textContent = cvInput.files[0] ? cvInput.files[0].name : '';
    });

    // Drag-and-drop
    const dropZone = document.getElementById('dropZone');
    dropZone.addEventListener('dragover', e => {
        e.preventDefault();
        dropZone.style.borderColor = '#1e3a5f';
    });
    dropZone.addEventListener('dragleave', () => {
        dropZone.style.borderColor = '#cbd5e1';
    });
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.style.borderColor = '#cbd5e1';
        if (e.dataTransfer.files.length) {
            cvInput.files = e.dataTransfer.files;
            fileNameEl.textContent = e.dataTransfer.files[0].name;
        }
    });

    // Submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        formError.style.display = 'none';

        if (!cvInput.files.length) {
            formError.textContent = 'Please select your CV / Resume file.';
            formError.style.display = 'block';
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Submitting...';

        const fd = new FormData(form);

        fetch(storeUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                              ?? document.querySelector('input[name="_token"]')?.value,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: fd,
        })
        .then(async r => {
            const data = await r.json();
            if (!r.ok) throw new Error(data.message ?? 'Something went wrong.');
            return data;
        })
        .then(data => {
            closeModal();
            const oname = document.getElementById('modalOname').textContent;
            const org   = document.getElementById('modalOrg').textContent;
            document.getElementById('successMsg').innerHTML =
                `Your application for <strong>${oname}</strong> at <strong>${org}</strong> has been submitted successfully.`;
            successOv.style.display = 'flex';
        })
        .catch(err => {
            formError.textContent = err.message;
            formError.style.display = 'block';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-send"></i> Submit Application';
        });
    });

    successClose.addEventListener('click', () => {
        successOv.style.display = 'none';
    });

    // Read More / Read Less toggle for descriptions
    window.toggleDescription = function(btn) {
        const wrapper = btn.closest('.oppo-description-wrapper');
        const descEl = wrapper.querySelector('.oppo-description');
        const isExpanded = btn.classList.contains('expanded');

        if (isExpanded) {
            // Collapse
            descEl.style.maxHeight = '3.2rem';
            btn.textContent = 'Read More';
            btn.classList.remove('expanded');
        } else {
            // Expand
            descEl.style.maxHeight = 'none';
            btn.textContent = 'Show Less';
            btn.classList.add('expanded');
        }
    };
})();
</script>
</body>
</html>