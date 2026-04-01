@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">AI Assistant</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">AI Tools</li>
                            <li class="breadcrumb-item active">AI Assistant</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="card shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">
                            <div class="card-header py-3 px-4"
                                 style="background:var(--navy-700);border:none;">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-stars text-white" style="font-size:1.1rem;"></i>
                                    <div>
                                        <h6 class="mb-0 text-white fw-bold">AttachKE AI Assistant</h6>
                                        <div style="color:var(--gold-400);font-size:.75rem;">
                                            Powered by Gemini · Personalised to your profile
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Chat window --}}
                            <div id="chat-window" style="height:420px;overflow-y:auto;
                                 padding:1.25rem;background:#f9fafb;">
                            </div>

                            {{-- Input --}}
                            <div class="card-footer bg-white px-4 py-3"
                                 style="border-top:1px solid #f3f4f6;">
                                <form id="chat-form" class="d-flex gap-2">
                                    @csrf
                                    <input type="text" id="chat-input" name="message"
                                           placeholder="Ask me anything about attachments…"
                                           class="form-control" style="border-radius:8px;"
                                           autocomplete="off" required>
                                    <button type="submit" class="btn"
                                            style="background:var(--navy-700);color:#fff;
                                                   border-radius:8px;white-space:nowrap;min-width:80px;">
                                        <span id="send-label"><i class="bi bi-send-fill"></i></span>
                                        <span id="send-spinner" class="spinner-border spinner-border-sm d-none"></span>
                                    </button>
                                </form>
                                <div style="font-size:.72rem;color:#9ca3af;margin-top:6px;">
                                    <i class="bi bi-info-circle me-1"></i>
                                    AI responses are suggestions only. Always verify opportunities on the platform.
                                </div>
                                <button type="button" id="chat-clear" class="btn btn-sm mt-2"
                                        style="border:1px solid #e5e7eb;background:#fff;color:#64748b;border-radius:8px;">
                                    <i class="bi bi-trash3 me-1"></i>Clear chat history
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

@php
$assistantDisplayName = (string) data_get(auth()->user(), 'fname', '');
if ($assistantDisplayName === '') {
    $assistantDisplayName = (string) data_get(auth()->user(), 'uname', 'there');
}
@endphp

<script>
const chatForm   = document.getElementById('chat-form');
const chatWindow = document.getElementById('chat-window');
const chatInput  = document.getElementById('chat-input');
const chatClear  = document.getElementById('chat-clear');

async function loadHistory() {
    const res = await fetch('{{ route("ai.assistant.history") }}', {
        headers: { 'Accept': 'application/json' },
    });

    if (!res.ok) {
        throw new Error('Failed to load chat history.');
    }

    const data = await res.json();
    return Array.isArray(data.messages) ? data.messages : [];
}

function welcomeMessage() {
    return "Hi {{ $assistantDisplayName }}! I am your AI career assistant. I can help you with attachment applications, CV advice, and career tips. What would you like to know?";
}

function appendMessage(text, isUser = false) {
    const wrap = document.createElement('div');
    wrap.className = 'd-flex gap-2 mb-3' + (isUser ? ' flex-row-reverse' : '');

    const avatar = document.createElement('div');
    avatar.style.cssText = 'width:32px;height:32px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.8rem;';
    avatar.style.background = isUser ? 'var(--gold-400)' : 'var(--navy-700)';
    avatar.style.color = isUser ? 'var(--navy-800)' : '#fff';
    avatar.innerHTML = isUser ? '<i class="bi bi-person-fill"></i>' : '<i class="bi bi-stars"></i>';

    const bubble = document.createElement('div');
    bubble.style.cssText = 'padding:.75rem 1rem;max-width:80%;font-size:.875rem;color:#374151;line-height:1.6;white-space:pre-wrap;';
    if (isUser) {
        bubble.style.cssText += 'background:var(--navy-700);color:#fff;border-radius:10px 0 10px 10px;';
    } else {
        bubble.style.cssText += 'background:#fff;border:1px solid #e8edf3;border-radius:0 10px 10px 10px;';
    }
    bubble.textContent = text;

    wrap.appendChild(avatar);
    wrap.appendChild(bubble);
    chatWindow.appendChild(wrap);
    chatWindow.scrollTop = chatWindow.scrollHeight;
}

async function renderHistory() {
    chatWindow.innerHTML = '';
    let history = [];

    try {
        history = await loadHistory();
    } catch {
        appendMessage('Unable to load chat history right now. You can still continue chatting.', false);
    }

    if (!history.length) {
        appendMessage(welcomeMessage(), false);
        return;
    }

    history.forEach((item) => {
        const role = String(item.role || 'assistant').toLowerCase();
        appendMessage(String(item.text || ''), role === 'user');
    });
}

chatClear.addEventListener('click', async function () {
    try {
        await fetch('{{ route("ai.assistant.history.clear") }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        });
    } catch {
        appendMessage('Could not clear history now. Please try again.', false);
        return;
    }

    await renderHistory();
});

void renderHistory();

chatForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    const msg = chatInput.value.trim();
    if (!msg) return;

    appendMessage(msg, true);
    chatInput.value = '';
    document.getElementById('send-label').classList.add('d-none');
    document.getElementById('send-spinner').classList.remove('d-none');

    try {
        const res = await fetch('{{ route("ai.assistant.chat") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message: msg }),
        });
        const data = await res.json();
        appendMessage(data.reply || 'No response received.');
    } catch {
        appendMessage('Connection error. Please try again.');
    } finally {
        document.getElementById('send-label').classList.remove('d-none');
        document.getElementById('send-spinner').classList.add('d-none');
        chatInput.focus();
    }
});
</script>