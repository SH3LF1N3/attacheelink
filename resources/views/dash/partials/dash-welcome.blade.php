
@php
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
    $name = $user->fname ?? $user->uname;

    $roleLabel = ['admin' => 'Administrator', 'student' => 'Student', 'company' => 'Organisation'];
    $roleColor = ['admin' => 'var(--navy-700)', 'student' => '#0f766e', 'company' => '#b45309'];
    $label = $roleLabel[$user->role] ?? ucfirst($user->role);
    $color = $roleColor[$user->role] ?? 'var(--navy-700)';
@endphp

<div class="rounded-3 mb-4 px-4 py-3 d-flex align-items-center justify-content-between flex-wrap gap-3"
     style="background: {{ $color }};">
    <div>
        <div style="color: rgba(255,255,255,0.75); font-size: 0.8rem; text-transform: uppercase;
                    letter-spacing: 0.06em;">{{ $greeting }}</div>
        <h4 class="mb-0 text-white fw-bold">{{ $name }}</h4>
        <span class="badge mt-1" style="background: rgba(255,255,255,0.15);
              color: #fff; font-size: 0.72rem; border-radius: 6px;">{{ $label }}</span>
    </div>
    <div style="color: rgba(255,255,255,0.6); font-size: 0.8rem; text-align: right;">
        <div><i class="bi bi-calendar3 me-1"></i>{{ now()->format('l, d M Y') }}</div>
        <div class="mt-1"><i class="bi bi-envelope me-1"></i>{{ $user->email }}</div>
    </div>
</div>