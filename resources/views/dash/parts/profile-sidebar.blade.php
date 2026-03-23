{{-- Skills & Interests --}}
<div class="profile-card">
    <div class="profile-card-header">Skills &amp; Interests</div>
    <div class="profile-card-body">
        <div class="profile-skills-wrap" id="skills-container">
            @php
                $skills = array_filter(explode(',', $user->foth8 ?? ''));
            @endphp
            @foreach($skills as $skill)
                <span class="profile-skill-tag">
                    {{ trim($skill) }}
                    <button type="button" onclick="removeSkill(this)" title="Remove">×</button>
                </span>
            @endforeach
        </div>
        <input type="text" class="profile-skill-input"
               id="skill-input"
               placeholder="Add a skill and press Enter..."
               onkeydown="addSkill(event)" />
        <input type="hidden" name="foth8" id="skills-value"
               value="{{ $user->foth8 ?? '' }}" form="mainProfileForm" />
    </div>
</div>

{{-- Profile Completion --}}
<div class="profile-card">
    <div class="profile-card-header">Profile Completion</div>
    <div class="profile-card-body">
        @php
            $checks = [
                'Personal info'    => !empty($user->fname) && !empty($user->email),
                'Academic details' => !empty($user->foth1) || $user->role !== 'student',
                'Resume uploaded'  => !empty($user->cv),
                'Bio added'        => !empty($user->foth7),
                'Profile photo'    => false, // placeholder
                'Skills (3+ added)'=> count(array_filter(explode(',', $user->foth8 ?? ''))) >= 3,
            ];
            $done = count(array_filter($checks));
            $total = count($checks);
            $pct = round(($done / $total) * 100);
        @endphp

        <div class="profile-completion-row">
            <span class="profile-completion-label">Overall</span>
            <span class="profile-completion-pct">{{ $pct }}%</span>
        </div>
        <div class="profile-progress-bar">
            <div class="profile-progress-fill" style="width: {{ $pct }}%;"></div>
        </div>

        <div class="profile-checklist">
            @foreach($checks as $label => $isDone)
                <div class="profile-check-item {{ $isDone ? 'done' : 'todo' }}">
                    @if($isDone)
                        <svg width="15" height="15" fill="none" stroke="#15803d" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    @else
                        <svg width="15" height="15" fill="none" stroke="#d1d9e2" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                        </svg>
                    @endif
                    {{ $label }}
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Quick Links --}}
<div class="profile-card">
    <div class="profile-card-header">Quick Links</div>
    <div class="profile-card-body">
        <div class="profile-quick-links">
            @if(!empty($user->cv))
                <a href="{{ asset('storage/' . $user->cv) }}" target="_blank" class="profile-quick-link profile-quick-link-navy">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    View My Resume
                </a>
            @endif
            <a href="{{ route('applications') }}" class="profile-quick-link profile-quick-link-navy">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="2"/>
                </svg>
                My Applications
            </a>
            <a href="#" class="profile-quick-link profile-quick-link-red"
               onclick="return confirm('Are you sure you want to deactivate your account?')">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
                Deactivate Account
            </a>
        </div>
    </div>
</div>

<script>
    function addSkill(e) {
        if (e.key !== 'Enter') return;
        e.preventDefault();
        const input = document.getElementById('skill-input');
        const val = input.value.trim();
        if (!val) return;
        const tag = document.createElement('span');
        tag.className = 'profile-skill-tag';
        tag.innerHTML = val + ' <button type="button" onclick="removeSkill(this)" title="Remove">×</button>';
        document.getElementById('skills-container').appendChild(tag);
        input.value = '';
        syncSkills();
    }

    function removeSkill(btn) {
        btn.parentElement.remove();
        syncSkills();
    }

    function syncSkills() {
        const tags = document.querySelectorAll('#skills-container .profile-skill-tag');
        const values = Array.from(tags).map(t => t.childNodes[0].textContent.trim());
        document.getElementById('skills-value').value = values.join(',');
    }
</script>