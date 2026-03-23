@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Edit Opportunity</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('opportunities') }}">Opportunities</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="oppo-form-page">

                    @if(session('success'))
                        <div class="profile-alert-success" style="margin-bottom:1.5rem;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="profile-alert-error" style="margin-bottom:1.5rem;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                            </svg>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="oppo-form-card">
                        <form action="{{ route('oppo.update', $oppo->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @php
                                $departments = [
                                    'Software Engineering','Information Technology (IT)',
                                    'Data Science & Analytics','Cybersecurity',
                                    'Networking & Infrastructure','Finance & Accounting',
                                    'Human Resources','Marketing & Communications',
                                    'Legal & Compliance','Operations & Supply Chain',
                                    'Research & Development','Mechanical Engineering',
                                    'Electrical Engineering','Civil & Structural Engineering',
                                    'Architecture & Design',
                                ];
                                $counties = [
                                    'Nairobi','Mombasa','Kwale','Kilifi','Tana River',
                                    'Lamu','Taita Taveta','Garissa','Wajir','Mandera',
                                    'Marsabit','Isiolo','Meru','Tharaka-Nithi','Embu',
                                    'Kitui','Machakos','Makueni','Nyandarua','Nyeri',
                                    'Kirinyaga',"Murang'a",'Kiambu','Turkana','West Pokot',
                                    'Samburu','Trans Nzoia','Uasin Gishu','Elgeyo-Marakwet','Nandi',
                                    'Baringo','Laikipia','Nakuru','Narok','Kajiado',
                                    'Kericho','Bomet','Kakamega','Vihiga','Bungoma',
                                    'Busia','Siaya','Kisumu','Homa Bay','Migori',
                                    'Kisii','Nyamira',
                                ];
                            @endphp

                            <div class="oppo-field">
                                <label class="oppo-label">Opportunity Title</label>
                                <input type="text" name="oname" class="oppo-input @error('oname') is-error @enderror"
                                       value="{{ old('oname', $oppo->oname) }}" required />
                            </div>

                            <div class="oppo-form-row">
                                <div class="oppo-field">
                                    <label class="oppo-label">Department</label>
                                    <div class="oppo-select-wrap">
                                        <select name="foth1" class="oppo-select" required>
                                            <option value="" disabled>Select an option</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept }}" {{ old('foth1', $oppo->foth1) === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="oppo-field">
                                    <label class="oppo-label">County</label>
                                    <div class="oppo-select-wrap">
                                        <select name="loc" class="oppo-select" required>
                                            <option value="" disabled>Select an option</option>
                                            @foreach($counties as $county)
                                                <option value="{{ $county }}" {{ old('loc', $oppo->loc) === $county ? 'selected' : '' }}>{{ $county }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="oppo-field">
                                <label class="oppo-label">Status</label>
                                <div class="oppo-select-wrap">
                                    <select name="status" class="oppo-select" required>
                                        @foreach(['active' => 'Active', 'closed' => 'Closed', 'draft' => 'Draft'] as $val => $label)
                                            <option value="{{ $val }}" {{ old('status', $oppo->status) === $val ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="oppo-field">
                                <label class="oppo-label">Job Description</label>
                                <textarea name="descr" class="oppo-textarea" required>{{ old('descr', $oppo->descr) }}</textarea>
                            </div>

                            <div class="oppo-form-row">
                                <div class="oppo-field">
                                    <label class="oppo-label">Application Deadline</label>
                                    <input type="date" name="dead" class="oppo-input"
                                           value="{{ old('dead', $oppo->dead) }}" required />
                                </div>
                                <div class="oppo-field">
                                    <label class="oppo-label">Positions Available</label>
                                    <input type="number" name="slot" class="oppo-input"
                                           value="{{ old('slot', $oppo->slot) }}" min="1" required />
                                </div>
                            </div>

                            <div class="oppo-field">
                                <label class="oppo-label">Duration <span style="color:var(--charcoal-400);font-weight:400;">(Optional)</span></label>
                                <input type="text" name="duration" class="oppo-input"
                                       value="{{ old('duration', $oppo->duration) }}"
                                       placeholder="e.g. 3 months" />
                            </div>

                            <div class="oppo-form-actions">
                                <form action="{{ route('oppo.destroy', $oppo->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this opportunity? This cannot be undone.');"
                                      style="margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M10 11v6M14 11v6M9 6V4h6v2"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                                <div style="display:flex;gap:0.75rem;">
                                    <a href="{{ route('opportunities') }}" class="btn-cancel">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>