{{-- Welcome strip — shared across all roles --}}
<div style="background:var(--navy-700);border-radius:var(--radius-md);padding:1.5rem 2rem;
            display:flex;align-items:center;justify-content:space-between;
            margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
    <div>
        <div style="color:var(--gold-400);font-size:0.8125rem;font-weight:600;margin-bottom:0.25rem;text-transform:uppercase;letter-spacing:0.06em;">
            Welcome back
        </div>
        <div style="color:#fff;font-size:1.25rem;font-weight:700;">
            {{ $user->fname ?? $user->uname }}
        </div>
        <div style="color:#9ca3af;font-size:0.8125rem;margin-top:0.2rem;text-transform:capitalize;">
            {{ $user->role }} account
            @if($user->role === 'student' && $user->foth2)
                &nbsp;·&nbsp; {{ $user->foth2 }}
            @elseif($user->role === 'company')
                &nbsp;·&nbsp; {{ $user->email }}
            @endif
        </div>
    </div>
    <div style="color:#6b7280;font-size:0.8125rem;">
        {{ now()->format('l, d F Y') }}
    </div>
</div>