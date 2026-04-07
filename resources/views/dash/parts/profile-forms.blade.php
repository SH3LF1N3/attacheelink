{{-- Single form wrapping ALL sections — one POST saves everything --}}
<div class="profile-forms-section">
<form action="{{ route('profile.update') }}" method="POST" id="mainProfileForm">
@csrf

{{-- Flash messages --}}
@if(session('success'))
    <div class="profile-alert-success">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="profile-alert-error">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
        </svg>
        {{ $errors->first() }}
    </div>
@endif

{{-- ── STUDENT PROFILE ── --}}
@if($user->role === 'student')

{{-- Personal Information --}}
<div class="profile-card">
    <div class="profile-card-header">Personal Information</div>
    <div class="profile-card-body">
        <div class="profile-form-grid">
            <div class="profile-field">
                <label class="profile-label">First Name <span style="color:#dc2626;">*</span></label>
                <input type="text" name="fname" class="profile-input @error('fname') is-error @enderror"
                       value="{{ old('fname', explode(' ', $user->fname ?? '')[0]) }}"
                       placeholder="First name" required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Last Name</label>
                <input type="text" name="lname" class="profile-input"
                       value="{{ old('lname', explode(' ', $user->fname ?? '', 2)[1] ?? '') }}"
                       placeholder="Last name" />
            </div>
            <div class="profile-field">
                <label class="profile-label">Email Address <span style="color:#dc2626;">*</span></label>
                <input type="email" name="email" class="profile-input @error('email') is-error @enderror"
                       value="{{ old('email', $user->email) }}"
                       placeholder="Email" required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Phone Number <span style="color:#dc2626;">*</span></label>
                <input type="tel" name="phone" class="profile-input"
                       value="{{ old('phone', $user->phone) }}"
                       placeholder="+254 7XX XXX XXX" required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Gender <span style="color:#dc2626;">*</span></label>
                <div class="profile-select-wrap">
                    <select name="gender" class="profile-select" required>
                        <option value="">Select an option</option>
                        @foreach(['Male','Female','Other'] as $g)
                            <option value="{{ $g }}" {{ ($user->gender ?? '') === $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="profile-field">
                <label class="profile-label">Home Address</label>
                <input type="text" name="foth4" class="profile-input"
                       value="{{ old('foth4', $user->foth4) }}"
                       placeholder="P.O. Box, City" />
            </div>
        </div>
    </div>
</div>

{{-- Academic Information --}}
<div class="profile-card">
    <div class="profile-card-header">Academic Information</div>
    <div class="profile-card-body">
        <div class="profile-form-grid">
            <div class="profile-field">
                <label class="profile-label">University <span style="color:#dc2626;">*</span></label>
                <div class="profile-select-wrap">
                    <select name="foth2" class="profile-select" required>
                        <option value="">Select an option</option>
                        @foreach(['University of Nairobi','Kenyatta University','Strathmore University','JKUAT','Moi University','Egerton University','Maseno University','Other'] as $uni)
                            <option value="{{ $uni }}" {{ ($user->foth2 ?? '') === $uni ? 'selected' : '' }}>{{ $uni }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="profile-field">
                <label class="profile-label">Course / Programme <span style="color:#dc2626;">*</span></label>
                <input type="text" name="foth1" class="profile-input"
                       value="{{ old('foth1', $user->foth1) }}"
                       placeholder="e.g. BSc. Computer Science" required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Year of Study</label>
                <div class="profile-select-wrap">
                    <select name="foth5" class="profile-select">
                        <option value="">Select an option</option>
                        @foreach(['Year 1','Year 2','Year 3','Year 4','Year 5'] as $yr)
                            <option value="{{ $yr }}" {{ ($user->foth5 ?? '') === $yr ? 'selected' : '' }}>{{ $yr }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="profile-field">
                <label class="profile-label">Expected Graduation</label>
                <input type="month" name="foth6" class="profile-input"
                       value="{{ old('foth6', $user->foth6) }}" />
            </div>
            <div class="profile-field">
                <label class="profile-label">County of Residence <span style="color:#dc2626;">*</span></label>
                <div class="profile-select-wrap">
                    <select name="foth3" class="profile-select" required>
                        <option value="">Select an option</option>
                        @foreach(['Nairobi','Mombasa','Kisumu','Nakuru','Eldoret','Thika','Nyeri','Meru','Other'] as $county)
                            <option value="{{ $county }}" {{ ($user->foth3 ?? '') === $county ? 'selected' : '' }}>{{ $county }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- About Me --}}
<div class="profile-card">
    <div class="profile-card-header">About Me</div>
    <div class="profile-card-body">
        <div class="profile-field">
            <label class="profile-label">Bio</label>
            <textarea name="foth7" class="profile-textarea"
                      placeholder="Tell employers about yourself, your interests and goals...">{{ old('foth7', $user->foth7) }}</textarea>
        </div>
    </div>
</div>

{{-- ── ORGANIZATION/COMPANY PROFILE ── --}}
@else

{{-- Company Information --}}
<div class="profile-card">
    <div class="profile-card-header">Company Information</div>
    <div class="profile-card-body">
        <div class="profile-form-grid">
            <div class="profile-field">
                <label class="profile-label">Organization Name <span style="color:#dc2626;">*</span></label>
                <input type="text" name="fname" class="profile-input @error('fname') is-error @enderror"
                       value="{{ old('fname', $user->fname) }}"
                       placeholder="e.g. Tech Solutions Inc." required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Email Address <span style="color:#dc2626;">*</span></label>
                <input type="email" name="email" class="profile-input @error('email') is-error @enderror"
                       value="{{ old('email', $user->email) }}"
                       placeholder="contact@company.com" required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Phone Number <span style="color:#dc2626;">*</span></label>
                <input type="tel" name="phone" class="profile-input"
                       value="{{ old('phone', $user->phone) }}"
                       placeholder="+254 7XX XXX XXX" required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Contact Person Name <span style="color:#dc2626;">*</span></label>
                <input type="text" name="foth1" class="profile-input"
                       value="{{ old('foth1', $user->foth1) }}"
                       placeholder="Name of primary contact" required />
            </div>
            <div class="profile-field">
                <label class="profile-label">Industry <span style="color:#dc2626;">*</span></label>
                <div class="profile-select-wrap">
                    <select name="foth2" class="profile-select" required>
                        <option value="">Select an option</option>
                        @foreach(['Technology','Finance','Healthcare','Education','Retail','Manufacturing','Logistics','Telecommunications','Energy','Real Estate','Consulting','Media','Other'] as $ind)
                            <option value="{{ $ind }}" {{ ($user->foth2 ?? '') === $ind ? 'selected' : '' }}>{{ $ind }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="profile-field">
                <label class="profile-label">Location (County) <span style="color:#dc2626;">*</span></label>
                <div class="profile-select-wrap">
                    <select name="foth3" class="profile-select" required>
                        <option value="">Select an option</option>
                        @foreach(['Nairobi','Mombasa','Kisumu','Nakuru','Eldoret','Thika','Nyeri','Meru','Kiambu','Machakos','Other'] as $county)
                            <option value="{{ $county }}" {{ ($user->foth3 ?? '') === $county ? 'selected' : '' }}>{{ $county }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="profile-field">
                <label class="profile-label">Office Address</label>
                <input type="text" name="foth4" class="profile-input"
                       value="{{ old('foth4', $user->foth4) }}"
                       placeholder="Physical office location" />
            </div>
        </div>
    </div>
</div>

{{-- About Organization --}}
<div class="profile-card">
    <div class="profile-card-header">About Organization</div>
    <div class="profile-card-body">
        <div class="profile-field">
            <label class="profile-label">Company Overview</label>
            <textarea name="foth7" class="profile-textarea"
                      placeholder="Tell students about your organization, what you do, and your company culture...">{{ old('foth7', $user->foth7) }}</textarea>
        </div>
    </div>
</div>

@endif

{{-- Hidden skills field synced by JS --}}
<input type="hidden" name="foth8" id="skills-value" value="{{ $user->foth8 ?? '' }}" />

{{-- Save / Cancel --}}
<div class="profile-footer-actions">
    <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
    <button type="submit" class="btn btn-primary">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:0.3rem;">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
        </svg>
        Save Changes
    </button>
</div>

</form>

{{-- ── Change Password (separate form) ── --}}
<div class="profile-card" style="margin-top:1.5rem;">
    <div class="profile-card-header">Change Password</div>
    <div class="profile-card-body">
        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            <div class="profile-form-grid">
                <div class="profile-field profile-form-grid-full">
                    <label class="profile-label">Current Password</label>
                    <input type="password" name="current_password"
                           class="profile-input @error('current_password') is-error @enderror"
                           placeholder="Enter current password" required />
                    @error('current_password')
                        <span style="font-size:0.75rem;color:#dc2626;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="profile-field">
                    <label class="profile-label">New Password</label>
                    <input type="password" name="password"
                           class="profile-input @error('password') is-error @enderror"
                           placeholder="Min. 8 characters" required />
                    @error('password')
                        <span style="font-size:0.75rem;color:#dc2626;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="profile-field">
                    <label class="profile-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                           class="profile-input" placeholder="Repeat new password" required />
                </div>
            </div>
            <div class="profile-footer-actions" style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
</div>
</div> {{-- /.profile-forms-section --}}