<aside class="app-sidebar shadow" data-bs-theme="dark"
       style="background-color: var(--navy-800) !important;">

    {{-- Brand --}}
    <div class="sidebar-brand" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
        <a href="{{ route('dashboard') }}" class="brand-link" style="text-decoration:none;">
            <svg width="28" height="28" fill="none" stroke="var(--gold-400)" stroke-width="1.8"
                 viewBox="0 0 24 24" class="brand-image opacity-75 shadow">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <path d="M8 21h8M12 17v4"/>
                <path d="M7 8h10M7 11h6"/>
            </svg>
            <span class="brand-text fw-bold ms-2" style="color:#fff; font-size:1.1rem;">AttachKE</span>
        </a>
    </div>

    {{-- User summary strip --}}
    <div class="px-3 py-3" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
        <div class="d-flex align-items-center gap-2">
            <div style="width:36px;height:36px;border-radius:50%;background:var(--gold-400);
                        display:flex;align-items:center;justify-content:center;
                        font-weight:700;color:var(--navy-800);font-size:0.9rem;flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->fname ?? auth()->user()->uname, 0, 1)) }}
            </div>
            <div style="overflow:hidden;">
                <div style="color:#fff;font-size:0.8125rem;font-weight:600;
                            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ auth()->user()->fname ?? auth()->user()->uname }}
                </div>
                <div style="color:var(--gold-400);font-size:0.7rem;text-transform:capitalize;">
                    {{ auth()->user()->role }}
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false">

                {{-- Dashboard — visible to ALL roles, label adapts --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-house-fill"></i>
                        <p>
                            @if(auth()->user()->role === 'admin') Dashboard
                            @elseif(auth()->user()->role === 'student') My Dashboard
                            @else Company Dashboard
                            @endif
                        </p>
                    </a>
                </li>

                {{-- ADMIN / COMPANY: Manage Opportunities --}}
                @if($permit->oppo)
                <li class="nav-item">
                    <a href="{{ route('opportunities') }}" class="nav-link">
                        <i class="nav-icon bi bi-list-task"></i>
                        <p>Opportunities</p>
                    </a>
                </li>
                @endif

                {{-- STUDENT: Browse Opportunities --}}
                @if($permit->soppo && !$permit->oppo)
                <li class="nav-item">
                    <a href="{{ route('my_opportunities') }}" class="nav-link">
                        <i class="nav-icon bi bi-list-task"></i>
                        <p>Opportunities</p>
                    </a>
                </li>
                @endif

                {{-- ADMIN / COMPANY: Manage Applications --}}
                @if($permit->app)
                <li class="nav-item">
                    <a href="{{ route('applications') }}" class="nav-link">
                        <i class="nav-icon bi bi-file-earmark-text-fill"></i>
                        <p>Applications</p>
                    </a>
                </li>
                @endif

                {{-- STUDENT: My Applications --}}
                @if($permit->sappo && !$permit->app)
                <li class="nav-item">
                    <a href="{{ route('my_applications') }}" class="nav-link">
                        <i class="nav-icon bi bi-file-earmark-text-fill"></i>
                        <p>My Applications</p>
                    </a>
                </li>
                @endif

                {{-- Students — admin only --}}
                @if($permit->stud)
                <li class="nav-item">
                    <a href="{{ route('students') }}" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>All Students</p>
                    </a>
                </li>
                @endif

                {{-- Organisations --}}
                @if($permit->org)
                <li class="nav-item">
                    <a href="{{ route('organisations') }}" class="nav-link">
                        <i class="nav-icon bi bi-building-fill"></i>
                        <p>Organizations</p>
                    </a>
                </li>
                @endif

                {{-- Notifications --}}
                @if($permit->not)
                <li class="nav-item">
                    <a href="{{ route('notifications') }}" class="nav-link">
                        <i class="nav-icon bi bi-bell-fill"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                @endif

                {{-- Reports --}}
                @if($permit->rep)
                <li class="nav-item">
                    <a href="{{ route('reports') }}" class="nav-link">
                        <i class="nav-icon bi bi-graph-up"></i>
                        <p>Reports</p>
                    </a>
                </li>
                @endif

                {{-- AI Tools --}}
                @if($permit->ait || $permit->air)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-stars"></i>
                        <p>AI Tools <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($permit->air)
                        <li class="nav-item">
                            <a href="{{ route('ai_resume_checker') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>AI Resume Checker</p>
                            </a>
                        </li>
                        @endif
                        @if($permit->ait)
                        <li class="nav-item">
                            <a href="{{ route('ai_assistant') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>AI Assistant</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Profile — always visible --}}
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>Profile</p>
                    </a>
                </li>

                {{-- Settings — admin only --}}
                @if($permit->set)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Settings <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('permission_settings') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i><p>Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('system_logs') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i><p>System Logs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('general_settings') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i><p>General Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- Logout --}}
                <li class="nav-item mt-2" style="border-top: 1px solid rgba(255,255,255,0.08); padding-top:0.5rem;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent"
                                style="color: #fc8181; cursor:pointer;">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentUrl = window.location.href;
        document.querySelectorAll(".sidebar-menu .nav-link").forEach(function (link) {
            if (link.href === currentUrl) {
                link.classList.add("active");
                const parentTree = link.closest(".nav-treeview");
                if (parentTree) {
                    const parentItem = parentTree.closest(".nav-item");
                    parentItem.classList.add("menu-open");
                    parentItem.querySelector(":scope > .nav-link")?.classList.add("active");
                }
            }
        });
    });
</script>