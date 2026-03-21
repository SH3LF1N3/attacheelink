<header class="navbar">
    <a href="{{ url('/') }}" class="navbar-brand">
        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <rect x="2" y="3" width="20" height="14" rx="2"/>
            <path d="M8 21h8M12 17v4"/>
            <path d="M7 8h10M7 11h6"/>
        </svg>
        AttachKE
    </a>

    <nav>
        <ul class="navbar-links">
            <li>
                <a href="{{ url('/aboutus') }}"
                   class="{{ request()->is('aboutus') ? 'active' : '' }}">
                    About Us
                </a>
            </li>
            <li>
                <a href="{{ url('/contactus') }}"
                   class="{{ request()->is('contactus') ? 'active' : '' }}">
                    Contact Us
                </a>
            </li>
        </ul>
    </nav>

    <div class="navbar-actions">
        <a href="{{ route('login') }}" class="btn btn-ghost">Log In</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
    </div>
</header>