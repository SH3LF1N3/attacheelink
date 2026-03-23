@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Post New Opportunity</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('opportunities') }}">Opportunities</a></li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="oppo-form-page">

                    @if($errors->any())
                        <div class="profile-alert-error" style="margin-bottom:1.5rem;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                            </svg>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="oppo-form-card">
                        <form action="{{ route('oppo.store') }}" method="POST">
                            @csrf

                            {{-- Opportunity Title --}}
                            <div class="oppo-field">
                                <label class="oppo-label">Opportunity Title</label>
                                <input type="text" name="oname"
                                       class="oppo-input @error('oname') is-error @enderror"
                                       value="{{ old('oname') }}"
                                       placeholder="e.g. Finance Attaché" required />
                                @error('oname')<span class="oppo-field-error">{{ $message }}</span>@enderror
                            </div>

                            {{-- Department + County --}}
                            <div class="oppo-form-row">
                                <div class="oppo-field">
                                    <label class="oppo-label">Department</label>
                                    <div class="oppo-select-wrap">
                                        <select name="foth1" class="oppo-select @error('foth1') is-error @enderror" required>
                                            <option value="" disabled {{ old('foth1') ? '' : 'selected' }}>Select an option</option>
                                            @foreach([
                                                'Software Engineering',
                                                'Information Technology (IT)',
                                                'Data Science & Analytics',
                                                'Cybersecurity',
                                                'Networking & Infrastructure',
                                                'Finance & Accounting',
                                                'Human Resources',
                                                'Marketing & Communications',
                                                'Legal & Compliance',
                                                'Operations & Supply Chain',
                                                'Research & Development',
                                                'Mechanical Engineering',
                                                'Electrical Engineering',
                                                'Civil & Structural Engineering',
                                                'Architecture & Design',
                                            ] as $dept)
                                                <option value="{{ $dept }}" {{ old('foth1') === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('foth1')<span class="oppo-field-error">{{ $message }}</span>@enderror
                                </div>

                                <div class="oppo-field">
                                    <label class="oppo-label">County</label>
                                    <div class="oppo-select-wrap">
                                        <select name="loc" class="oppo-select @error('loc') is-error @enderror" required>
                                            <option value="" disabled {{ old('loc') ? '' : 'selected' }}>Select an option</option>
                                            @foreach([
                                                'Nairobi','Mombasa','Kwale','Kilifi','Tana River',
                                                'Lamu','Taita Taveta','Garissa','Wajir','Mandera',
                                                'Marsabit','Isiolo','Meru','Tharaka-Nithi','Embu',
                                                'Kitui','Machakos','Makueni','Nyandarua','Nyeri',
                                                'Kirinyaga','Murang\'a','Kiambu','Turkana','West Pokot',
                                                'Samburu','Trans Nzoia','Uasin Gishu','Elgeyo-Marakwet','Nandi',
                                                'Baringo','Laikipia','Nakuru','Narok','Kajiado',
                                                'Kericho','Bomet','Kakamega','Vihiga','Bungoma',
                                                'Busia','Siaya','Kisumu','Homa Bay','Migori',
                                                'Kisii','Nyamira',
                                            ] as $county)
                                                <option value="{{ $county }}" {{ old('loc') === $county ? 'selected' : '' }}>{{ $county }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('loc')<span class="oppo-field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            {{-- Job Description --}}
                            <div class="oppo-field">
                                <label class="oppo-label">Job Description</label>
                                <textarea name="descr"
                                          class="oppo-textarea @error('descr') is-error @enderror"
                                          placeholder="Describe the role, responsibilities, and requirements..."
                                          required>{{ old('descr') }}</textarea>
                                @error('descr')<span class="oppo-field-error">{{ $message }}</span>@enderror
                            </div>

                            {{-- Deadline + Positions --}}
                            <div class="oppo-form-row">
                                <div class="oppo-field">
                                    <label class="oppo-label">Application Deadline</label>
                                    <input type="date" name="dead"
                                           class="oppo-input @error('dead') is-error @enderror"
                                           value="{{ old('dead') }}"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           required />
                                    @error('dead')<span class="oppo-field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="oppo-field">
                                    <label class="oppo-label">Positions Available</label>
                                    <input type="number" name="slot"
                                           class="oppo-input @error('slot') is-error @enderror"
                                           value="{{ old('slot', 1) }}"
                                           min="1" max="100" required />
                                    @error('slot')<span class="oppo-field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            {{-- Duration (optional) --}}
                            <div class="oppo-field">
                                <label class="oppo-label">
                                    Duration
                                    <span style="color:var(--charcoal-400);font-weight:400;">(Optional)</span>
                                </label>
                                <input type="text" name="duration"
                                       class="oppo-input"
                                       value="{{ old('duration') }}"
                                       placeholder="e.g. 3 months, 6 weeks" />
                            </div>

                            {{-- Actions --}}
                            <div class="oppo-form-actions">
                                <a href="{{ route('opportunities') }}" class="btn-cancel">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:0.3rem;">
                                        <path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/>
                                    </svg>
                                    Submit Opportunity
                                </button>
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