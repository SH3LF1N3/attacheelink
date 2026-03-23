@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Opportunities</h3></div>
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

                {{-- Flash messages --}}
                @if(session('success'))
                    <div class="profile-alert-success" style="margin-bottom:1rem;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Search / Filter bar --}}
                <div class="oppo-filter-bar">
                    <form method="GET" action="{{ route('opportunities') }}" class="oppo-filter-form">
                        <input type="text" name="q" class="oppo-filter-input"
                               value="{{ request('q') }}"
                               placeholder="Search by title, organisation, or keyword..." />

                        <select name="loc" class="oppo-filter-select">
                            <option value="">All Counties</option>
                            @foreach(['Nairobi','Mombasa','Kisumu','Nakuru','Eldoret','Thika','Nyeri','Meru',
                                      'Kisii','Machakos','Kiambu','Uasin Gishu','Kwale','Kilifi','Garissa',
                                      'Wajir','Marsabit','Isiolo','Tharaka-Nithi','Embu','Kitui','Makueni',
                                      'Nyandarua','Kirinyaga',"Murang'a",'Turkana','West Pokot','Samburu',
                                      'Trans Nzoia','Elgeyo-Marakwet','Nandi','Baringo','Laikipia','Narok',
                                      'Kajiado','Kericho','Bomet','Kakamega','Vihiga','Bungoma','Busia',
                                      'Siaya','Homa Bay','Migori','Nyamira','Tana River','Lamu',
                                      'Taita Taveta','Mandera','Samburu'] as $county)
                                <option value="{{ $county }}" {{ request('loc') === $county ? 'selected' : '' }}>
                                    {{ $county }}
                                </option>
                            @endforeach
                        </select>

                        <select name="dept" class="oppo-filter-select">
                            <option value="">All Departments</option>
                            @foreach(['Software Engineering','Information Technology (IT)',
                                      'Data Science & Analytics','Cybersecurity',
                                      'Networking & Infrastructure','Finance & Accounting',
                                      'Human Resources','Marketing & Communications',
                                      'Legal & Compliance','Operations & Supply Chain',
                                      'Research & Development','Mechanical Engineering',
                                      'Electrical Engineering','Civil & Structural Engineering',
                                      'Architecture & Design'] as $dept)
                                <option value="{{ $dept }}" {{ request('dept') === $dept ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="oppo-filter-btn">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                            </svg>
                            Search
                        </button>

                        @if(request()->anyFilled(['q','loc','dept']))
                            <a href="{{ route('opportunities') }}" class="oppo-filter-clear">Clear</a>
                        @endif
                    </form>

                    {{-- Company: post new button --}}
                    @if(auth()->user()->role === 'company')
                        <a href="{{ route('oppo.create') }}" class="btn btn-primary" style="white-space:nowrap;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="margin-right:0.3rem;">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Post New
                        </a>
                    @endif
                </div>

                {{-- Results count --}}
                <div style="font-size:0.8125rem;color:var(--charcoal-400);margin-bottom:1rem;">
                    Showing {{ $opportunities->total() }} {{ Str::plural('opportunity', $opportunities->total()) }}
                    @if(request()->anyFilled(['q','loc','dept']))
                        matching your filters
                    @endif
                </div>

                {{-- Opportunity cards grid --}}
                @if($opportunities->count())
                    <div class="oppo-cards-grid">
                        @foreach($opportunities as $oppo)
                        <div class="oppo-card">
                            <div class="oppo-card-top">
                                <div class="oppo-card-icon">
                                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <rect x="2" y="3" width="20" height="14" rx="2"/>
                                        <path d="M8 21h8M12 17v4"/>
                                    </svg>
                                </div>
                                <span class="oppo-card-badge">Attachment</span>
                            </div>

                            <div class="oppo-card-title">{{ $oppo->oname }}</div>
                            <div class="oppo-card-org">{{ $oppo->org }}</div>

                            <div class="oppo-card-meta">
                                <span class="oppo-card-meta-item">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                        <circle cx="12" cy="9" r="2.5"/>
                                    </svg>
                                    {{ $oppo->loc }}
                                </span>
                                @if($oppo->foth1)
                                <span class="oppo-card-meta-item">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="2" y="3" width="20" height="14" rx="2"/>
                                        <path d="M8 21h8M12 17v4"/>
                                    </svg>
                                    {{ $oppo->foth1 }}
                                </span>
                                @endif
                                @if($oppo->duration)
                                <span class="oppo-card-meta-item">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    {{ $oppo->duration }}
                                </span>
                                @endif
                                <span class="oppo-card-meta-item">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <path d="M16 2v4M8 2v4M3 10h18"/>
                                    </svg>
                                    Deadline: {{ $oppo->dead }}
                                </span>
                                <span class="oppo-card-meta-item">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                    </svg>
                                    {{ $oppo->slot }} slot{{ $oppo->slot != 1 ? 's' : '' }}
                                </span>
                            </div>

                            <div class="oppo-card-footer">
                                {{-- Students: Apply button --}}
                                @if(auth()->user()->role === 'student')
                                    <a href="{{ url('/apply/' . $oppo->id) }}" class="btn btn-primary oppo-apply-btn">
                                        Apply Now
                                    </a>
                                @endif

                                {{-- Company: Edit / Delete --}}
                                @if(auth()->user()->role === 'company' && $oppo->org === auth()->user()->uname)
                                    <a href="{{ route('oppo.edit', $oppo->id) }}" class="oppo-edit-link">Edit</a>
                                    <form action="{{ route('oppo.destroy', $oppo->id) }}" method="POST" style="display:inline;"
                                          onsubmit="return confirm('Delete this opportunity?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="oppo-delete-link">Delete</button>
                                    </form>
                                @endif

                                {{-- Admin: Edit link --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('oppo.edit', $oppo->id) }}" class="oppo-edit-link">Edit</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div style="margin-top:1.5rem;">
                        {{ $opportunities->appends(request()->query())->links() }}
                    </div>

                @else
                    <div class="oppo-empty">
                        <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:#d1d9e2;margin-bottom:1rem;">
                            <rect x="2" y="3" width="20" height="14" rx="2"/>
                            <path d="M8 21h8M12 17v4"/>
                        </svg>
                        <div style="font-size:1rem;font-weight:600;color:var(--navy-800);margin-bottom:0.4rem;">
                            No opportunities found
                        </div>
                        <div style="font-size:0.875rem;color:var(--charcoal-400);">
                            @if(request()->anyFilled(['q','loc','dept']))
                                Try adjusting your search filters.
                            @else
                                No active opportunities at the moment. Check back soon.
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>
</body>
</html>