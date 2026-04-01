{{-- Partial: dash.partials.notifications-list --}}

<div class="card shadow-sm mt-3" style="border:none;border-radius:0 0 12px 12px;overflow:hidden;">

    {{-- Subtab toolbar --}}
    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
         style="border-bottom:1px solid #f3f4f6;">

        <ul class="nav nav-pills gap-1" id="subNotifTabs">
            <li class="nav-item">
                <button class="nav-link active py-1 px-3" id="sub-unread"
                        data-bs-toggle="pill" data-bs-target="#pane-unread"
                        style="font-size:0.875rem;border-radius:6px;">
                    Unread
                    @if($unread->count())
                    <span class="badge ms-1"
                          style="background:#dc2626;color:#fff;font-size:0.68rem;border-radius:999px;">
                        {{ $unread->count() }}
                    </span>
                    @endif
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link py-1 px-3" id="sub-read"
                        data-bs-toggle="pill" data-bs-target="#pane-read"
                        style="font-size:0.875rem;border-radius:6px;">
                    Read
                </button>
            </li>
        </ul>

        @if($unread->count())
        <form action="{{ route('notifications.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm"
                    style="background:var(--navy-50);color:var(--navy-700);
                           border-radius:6px;font-size:0.8rem;">
                <i class="bi bi-check2-all me-1"></i>Mark all read
            </button>
        </form>
        @endif
    </div>

    <div class="tab-content card-body p-0">

        {{-- Unread --}}
        <div class="tab-pane fade show active" id="pane-unread">
            @forelse($unread as $n)
            <div class="d-flex align-items-start px-4 py-3 gap-3"
                 style="border-bottom:1px solid #f9fafb;background:#fefce8;">
                <div style="width:36px;height:36px;border-radius:50%;flex-shrink:0;
                            background:var(--navy-700);color:#fff;
                            display:flex;align-items:center;justify-content:center;font-size:0.9rem;">
                    <i class="bi bi-bell-fill"></i>
                </div>
                <div class="grow" style="min-width:0;">
                    <div class="fw-semibold" style="color:var(--navy-800);font-size:0.875rem;">
                        {{ $n->title ?? 'Notification' }}
                    </div>
                    <div style="font-size:0.8125rem;color:#374151;margin-top:2px;">
                        {{ $n->mess }}
                    </div>
                    <div style="font-size:0.72rem;color:#9ca3af;margin-top:4px;">
                        <i class="bi bi-clock me-1"></i>{{ $n->created_at?->diffForHumans() }}
                    </div>
                </div>
                <div class="d-flex gap-2 shrink-0">
                    <form action="{{ route('notifications.markRead', $n->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm"
                                style="background:var(--navy-50);color:var(--navy-700);
                                       border-radius:6px;font-size:0.72rem;padding:3px 10px;">
                            <i class="bi bi-check2"></i>
                        </button>
                    </form>
                    <button type="button" class="btn btn-sm btn-confirm-delete"
                            style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;
                                   border-radius:6px;font-size:0.72rem;padding:3px 10px;"
                            data-name="{{ $n->title ?? 'this notification' }}"
                            data-action="{{ route('notifications.destroy', $n->id) }}"
                            data-method="DELETE">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            @empty
            <div class="text-center py-5 text-muted">
                <i class="bi bi-bell-slash" style="font-size:2.5rem;opacity:0.3;"></i>
                <p class="mt-2 mb-0 small">No unread notifications.</p>
            </div>
            @endforelse
        </div>

        {{-- Read --}}
        <div class="tab-pane fade" id="pane-read">
            @forelse($read as $n)
            <div class="d-flex align-items-start px-4 py-3 gap-3"
                 style="border-bottom:1px solid var(--navy-200);">
                <div style="width:36px;height:36px;border-radius:50%;flex-shrink:0;
                            background:var(--navy-200);color:gray;
                            display:flex;align-items:center;justify-content:center;font-size:0.9rem;">
                    <i class="bi bi-bell"></i>
                </div>
                <div class="grow" style="min-width:0;">
                    <div class="fw-semibold" style="color:var(--navy-800);font-size:0.875rem;">
                        {{ $n->title ?? 'Notification' }}
                    </div>
                    <div style="font-size:0.8125rem;color:var(--navy-600);margin-top:2px;">
                        {{ $n->mess }}
                    </div>
                    <div style="font-size:0.72rem;color:var(--navy-400);margin-top:4px;">
                        <i class="bi bi-clock me-1"></i>{{ $n->created_at?->diffForHumans() }}
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-confirm-delete shrink-0"
                        style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;
                               border-radius:6px;font-size:0.72rem;padding:3px 10px;"
                        data-name="{{ $n->title ?? 'this notification' }}"
                        data-action="{{ route('notifications.destroy', $n->id) }}"
                        data-method="DELETE">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            @empty
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox" style="font-size:2.5rem;opacity:0.3;"></i>
                <p class="mt-2 mb-0 small">No read notifications.</p>
            </div>
            @endforelse

            @if($read->hasPages())
            <div class="px-4 py-3" style="border-top:1px solid #f3f4f6;">
                {{ $read->links() }}
            </div>
            @endif
        </div>

    </div>
</div>