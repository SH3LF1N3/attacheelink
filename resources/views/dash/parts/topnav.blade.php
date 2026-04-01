<nav class="app-header navbar navbar-expand bg-body"
     style="background-color: #fff !important; border-bottom: 1px solid #e8edf3;">
    <div class="container-fluid">

        {{-- Sidebar toggle --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"
                   style="color: var(--navy-700);">
                    <i class="bi bi-list" style="font-size:1.3rem;"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto align-items-center">

            {{-- Fullscreen --}}
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen"
                   style="color: var(--navy-700);">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display:none;"></i>
                </a>
            </li>

            {{-- Bell with unread badge --}}
            @if($permit->not)
            @php
                $unreadCount = \App\Models\Notifydb::forUser(auth()->user()->uname)->unread()->count();
            @endphp
            <li class="nav-item">
                <a class="nav-link position-relative" href="{{ route('notifications') }}"
                   style="color: var(--navy-700);">
                    <i class="bi bi-bell-fill" style="font-size:1.1rem;"></i>
                    @if($unreadCount > 0)
                    <span class="position-absolute"
                          style="top:4px;right:2px;min-width:18px;height:18px;
                                 background:#dc2626;color:#fff;border-radius:999px;
                                 font-size:0.6rem;font-weight:700;line-height:1;
                                 display:flex;align-items:center;justify-content:center;
                                 border:2px solid #fff;padding:0 3px;">
                        {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                    </span>
                    @endif
                </a>
            </li>
            @endif

            {{-- User dropdown --}}
            <li class="nav-item dropdown user-menu ms-2">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                   data-bs-toggle="dropdown" style="color: var(--navy-800);">
                    <div style="width:32px;height:32px;border-radius:50%;
                                background:var(--navy-700);color:#fff;
                                display:flex;align-items:center;justify-content:center;
                                font-weight:700;font-size:0.8rem;flex-shrink:0;">
                        {{ strtoupper(substr(auth()->user()->fname ?? auth()->user()->uname, 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline fw-600" style="font-size:0.9rem;">
                        {{ auth()->user()->fname ?? auth()->user()->uname }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-sm"
                    style="border:1px solid #e8edf3; min-width:220px;">

                    <li style="background:var(--navy-700); padding:1rem; border-radius:6px 6px 0 0;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:42px;height:42px;border-radius:50%;
                                        background:var(--gold-400);color:var(--navy-800);
                                        display:flex;align-items:center;justify-content:center;
                                        font-weight:700;font-size:1rem;flex-shrink:0;">
                                {{ strtoupper(substr(auth()->user()->fname ?? auth()->user()->uname, 0, 1)) }}
                            </div>
                            <div>
                                <div style="color:#fff;font-weight:700;font-size:0.875rem;">
                                    {{ auth()->user()->fname ?? auth()->user()->uname }}
                                </div>
                                <div style="color:var(--gold-400);font-size:0.75rem;text-transform:capitalize;">
                                    {{ auth()->user()->role }}
                                </div>
                                <div style="color:#9ca3af;font-size:0.7rem;">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                        </div>
                    </li>

                    <li><hr class="dropdown-divider my-0"></li>

                    <li>
                        <a class="dropdown-item py-2" href="{{ route('profile') }}"
                           style="color:var(--navy-800);">
                            <i class="bi bi-person-circle me-2" style="color:var(--navy-600);"></i>
                            My Profile
                        </a>
                    </li>

                    @if($permit->set)
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('general_settings') }}"
                           style="color:var(--navy-800);">
                            <i class="bi bi-gear-fill me-2" style="color:var(--navy-600);"></i>
                            Settings
                        </a>
                    </li>
                    @endif

                    <li><hr class="dropdown-divider my-0"></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="dropdown-item py-2 border-0 bg-transparent w-100 text-start"
                                    style="color:#dc2626;">
                                <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>