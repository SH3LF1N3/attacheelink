{{--
    Partial: dash.set.partials.permit-role-card
    Variables: $role (Permitdb instance)
--}}

@php
$groups = [
    'Opportunities' => [
        'oppo'  => 'Manage Opportunities (Admin/Company)',
        'soppo' => 'Browse Opportunities (Student)',
        'aoppo' => 'Add Opportunity',
        'eoppo' => 'Edit Opportunity',
    ],
    'Applications' => [
        'app'   => 'Manage Applications (Admin/Company)',
        'sappo' => 'My Applications (Student)',
    ],
    'Sections' => [
        'stud' => 'Students Section',
        'org'  => 'Organisations Section',
        'not'  => 'Notifications',
        'rep'  => 'Reports',
        'prof' => 'Profile',
        'set'  => 'Settings',
    ],
    'Student CRUD' => [
        'astud' => 'Add Student',
        'estud' => 'Edit Student',
    ],
    'Organisation CRUD' => [
        'aorg' => 'Add Organisation',
        'eorg' => 'Edit Organisation',
    ],
    'AI Tools' => [
        'ait' => 'AI Assistant',
        'air' => 'AI Resume Checker',
        'aia' => 'AI Analytics',
    ],
];

$roleColors = [
    'admin'   => 'var(--navy-700)',
    'student' => '#0f766e',
    'company' => '#b45309',
];
$color = $roleColors[$role->rname] ?? 'var(--navy-700)';
@endphp

<div class="card mb-4 shadow-sm" style="border: none; border-radius: 12px; overflow: hidden;">

    {{-- Card header --}}
    <div class="card-header d-flex align-items-center justify-content-between py-3 px-4"
         style="background: {{ $color }}; border: none;">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-shield-fill" style="color: #fff; font-size: 1.1rem;"></i>
            <h5 class="mb-0 text-white text-capitalize fw-bold">{{ $role->rname }} Role</h5>
        </div>
        <span class="badge bg-white text-dark" style="font-size: 0.75rem;">
            {{ collect($groups)->flatten()->keys()->filter($role->can(...))->count() }} permissions active
        </span>
    </div>

    {{-- Permission form --}}
    <div class="card-body px-4 pt-4 pb-3" style="background: #fff;">
        <form action="{{ route('permission_settings.update', $role->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="row g-4">
                @foreach($groups as $groupName => $flags)
                <div class="col-md-4">
                    <p class="fw-semibold mb-2" style="font-size: 0.8rem; text-transform: uppercase;
                       letter-spacing: 0.05em; color: #6b7280;">{{ $groupName }}</p>
                    @foreach($flags as $flag => $label)
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox"
                               role="switch" name="{{ $flag }}" id="{{ $role->rname }}_{{ $flag }}"
                               {{ $role->can($flag) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $role->rname }}_{{ $flag }}"
                               style="font-size: 0.875rem; color: #374151;">
                            {{ $label }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end mt-4 pt-3"
                 style="border-top: 1px solid #f3f4f6;">
                <button type="submit" class="btn px-4"
                        style="background: {{ $color }}; color: #fff;
                               border-radius: 8px; font-size: 0.875rem;">
                    <i class="bi bi-save me-1"></i> Save {{ ucfirst($role->rname) }} Permissions
                </button>
            </div>
        </form>
    </div>
</div>