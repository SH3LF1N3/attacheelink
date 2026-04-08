{{-- Partial: dash.partials.notifications-list --}}

<div class="card shadow-sm mt-3" style="border:none;border-radius:0 0 12px 12px;overflow:hidden;">

    {{-- Subtab toolbar --}}
    <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between"
         style="border-bottom:2px solid #e8edf3;background:linear-gradient(135deg, #f8fafc 0%, #f0f4f8 100%);">

        <ul class="nav nav-pills gap-1" id="subNotifTabs">
            <li class="nav-item">
                <button class="nav-link active py-2 px-3" id="sub-unread"
                        data-bs-toggle="pill" data-bs-target="#pane-unread"
                        style="font-size:0.875rem;border-radius:6px;font-weight:600;">
                    <i class="bi bi-bell-fill me-1" style="color:var(--amber-500);"></i>Unread
                    @if($unread->count())
                    <span class="badge ms-2"
                          style="background:#dc2626;color:#fff;font-size:0.68rem;border-radius:999px;
                                 padding:2px 8px;">
                        {{ $unread->count() }}
                    </span>
                    @endif
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link py-2 px-3" id="sub-read"
                        data-bs-toggle="pill" data-bs-target="#pane-read"
                        style="font-size:0.875rem;border-radius:6px;font-weight:600;
                               color:var(--charcoal-500);">
                    <i class="bi bi-bell me-1" style="color:var(--navy-400);"></i>Read
                </button>
            </li>
        </ul>

        @if($unread->count())
        <form action="{{ route('notifications.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm"
                    style="background:linear-gradient(135deg, var(--teal-50) 0%, var(--emerald-50) 100%);
                           color:var(--teal-600);border:1px solid var(--teal-200);
                           border-radius:6px;font-size:0.8rem;font-weight:600;
                           transition:all 0.3s;cursor:pointer;"
                    onmouseover="this.style.background='linear-gradient(135deg, var(--teal-100) 0%, var(--emerald-100) 100%)';
                                this.style.transform='translateY(-1px)';
                                this.style.boxShadow='0 2px 8px rgba(13, 148, 136, 0.15)'"
                    onmouseout="this.style.background='linear-gradient(135deg, var(--teal-50) 0%, var(--emerald-50) 100%)';
                              this.style.transform='translateY(0)';
                              this.style.boxShadow='none';">
                <i class="bi bi-check2-all me-1"></i>Mark all read
            </button>
        </form>
        @endif
    </div>

    <div class="tab-content card-body p-2">

        {{-- Unread --}}
        <div class="tab-pane fade show active" id="pane-unread">
            @forelse($unread as $n)
                @php
                    $fullMessage = $n->mess ?? '';
                    $previewLength = 120;
                    $preview = strlen($fullMessage) > $previewLength 
                        ? substr($fullMessage, 0, $previewLength) . '...' 
                        : $fullMessage;
                    $hasMore = strlen($fullMessage) > $previewLength;
                @endphp
                <div class="notification-card unread d-flex align-items-start gap-3" 
                     style="cursor:pointer;"
                     onclick="showNotificationDetail({{ json_encode(['id' => $n->id, 'title' => $n->title, 'message' => $n->mess, 'time' => $n->created_at->toIso8601String()]) }})">
                    <div class="notification-icon">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                    
                    <div class="notification-content">
                        <div class="notification-title">
                            {{ $n->title ?? 'Notification' }}
                            @if($hasMore)
                            <span style="font-size:0.65rem;background:var(--amber-100);color:var(--amber-700);
                                        padding:2px 6px;border-radius:4px;font-weight:600;font-style:italic;">
                                More
                            </span>
                            @endif
                        </div>
                        <div class="notification-preview {{ $hasMore ? 'has-more' : '' }}">
                            {!! nl2br(preg_replace(
                                '/(https?:\/\/[^\s]+)/',
                                '<a href="$1" target="_blank" style="color:var(--navy-700);word-break:break-all;">Link</a>',
                                e($preview)
                            )) !!}
                        </div>
                        <div class="notification-meta">
                            <div class="notification-meta-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ $n->created_at?->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="notification-actions" onclick="event.stopPropagation();">
                        <button type="button" class="notification-action-btn expand" title="View full details">
                            <i class="bi bi-arrow-expand"></i>
                        </button>
                        <form action="{{ route('notifications.markRead', $n->id) }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="notification-action-btn mark-read" title="Mark as read">
                                <i class="bi bi-check2"></i>
                            </button>
                        </form>
                        <button type="button" class="notification-action-btn delete btn-confirm-delete"
                                data-name="{{ $n->title ?? 'this notification' }}"
                                data-action="{{ route('notifications.destroy', $n->id) }}"
                                data-method="DELETE"
                                title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            @empty
                <div class="notification-empty">
                    <i class="bi bi-bell-slash"></i>
                    <p class="mt-2 mb-0">No unread notifications.</p>
                </div>
            @endforelse
        </div>

        {{-- Read --}}
        <div class="tab-pane fade" id="pane-read">
            @forelse($read as $n)
                @php
                    $fullMessage = $n->mess ?? '';
                    $previewLength = 120;
                    $preview = strlen($fullMessage) > $previewLength 
                        ? substr($fullMessage, 0, $previewLength) . '...' 
                        : $fullMessage;
                    $hasMore = strlen($fullMessage) > $previewLength;
                @endphp
                <div class="notification-card read d-flex align-items-start gap-3"
                     style="cursor:pointer;"
                     onclick="showNotificationDetail({{ json_encode(['id' => $n->id, 'title' => $n->title, 'message' => $n->mess, 'time' => $n->created_at->toIso8601String()]) }})">
                    <div class="notification-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    
                    <div class="notification-content">
                        <div class="notification-title">
                            {{ $n->title ?? 'Notification' }}
                            @if($hasMore)
                            <span style="font-size:0.65rem;background:var(--navy-100);color:var(--navy-600);
                                        padding:2px 6px;border-radius:4px;font-weight:600;font-style:italic;">
                                More
                            </span>
                            @endif
                        </div>
                        <div class="notification-preview {{ $hasMore ? 'has-more' : '' }}">
                            {!! nl2br(preg_replace(
                                '/(https?:\/\/[^\s]+)/',
                                '<a href="$1" target="_blank" style="color:var(--navy-700);word-break:break-all;">Link</a>',
                                e($preview)
                            )) !!}
                        </div>
                        <div class="notification-meta">
                            <div class="notification-meta-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ $n->created_at?->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="notification-actions" onclick="event.stopPropagation();">
                        <button type="button" class="notification-action-btn expand" title="View full details">
                            <i class="bi bi-arrow-expand"></i>
                        </button>
                        <button type="button" class="notification-action-btn delete btn-confirm-delete"
                                data-name="{{ $n->title ?? 'this notification' }}"
                                data-action="{{ route('notifications.destroy', $n->id) }}"
                                data-method="DELETE"
                                title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            @empty
                <div class="notification-empty">
                    <i class="bi bi-inbox"></i>
                    <p class="mt-2 mb-0">No read notifications.</p>
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

{{-- Notification Detail Modal --}}
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5>
                    <small style="color:rgba(255,255,255,0.7);">Full message</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="notificationDetailContent">
                    <div class="notification-full-text" id="notificationFullText"></div>
                    <div class="notification-details-grid">
                        <div class="notification-detail-item">
                            <div class="notification-detail-label">Received</div>
                            <div class="notification-detail-value" id="notificationTime"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showNotificationDetail(data) {
    try {
        // Set title
        const titleEl = document.getElementById('notificationModalLabel');
        titleEl.textContent = data.title || 'Notification';
        
        // Set full message with preserved formatting and links
        const fullTextEl = document.getElementById('notificationFullText');
        let messageHtml = '<strong style="display:block;margin-bottom:1rem;color:var(--navy-800);font-size:1.1rem;">' + 
                          escapeHtml(data.title || 'Notification') + '</strong>';
        
        // Format the message with line breaks and clickable links
        let formattedMessage = escapeHtml(data.message || '')
            .replace(/\n/g, '<br/>')
            .replace(/(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" style="color:var(--navy-700);word-break:break-all;text-decoration:underline;">$1</a>');
        
        messageHtml += formattedMessage;
        fullTextEl.innerHTML = messageHtml;
        
        // Set time with proper formatting
        const timeEl = document.getElementById('notificationTime');
        const dateObj = new Date(data.time);
        timeEl.textContent = dateObj.toLocaleString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        
        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
        modal.show();
    } catch (error) {
        console.error('Error showing notification detail:', error);
    }
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>