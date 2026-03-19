<footer class="footer">
    <div class="footer-inner">

        <div>
            <a href="{{ url('/') }}" class="footer-brand">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                    <path d="M8 21h8M12 17v4"/>
                    <path d="M7 8h10M7 11h6"/>
                </svg>
                AttachKE
            </a>
            <p class="footer-desc">
                Empowering the next generation of Kenyan professionals through
                meaningful industrial attachment opportunities.
            </p>
        </div>

        <div>
            <div class="footer-col-title">Platform</div>
            <ul class="footer-links">
                <li><a href="{{ url('/opportunities') }}">Browse Jobs</a></li>
                <li><a href="{{ url('/student/dashboard') }}">Student Portal</a></li>
                <li><a href="{{ url('/employer/dashboard') }}">Employer Portal</a></li>
                <li><a href="{{ url('/admin') }}">Admin Portal</a></li>
            </ul>
        </div>

        <div>
            <div class="footer-col-title">Contact</div>
            <div class="footer-contact">
                <div class="footer-contact-item">support@attachke.ac.ke</div>
                <div class="footer-contact-item">+254 700 000 000</div>
                <div class="footer-contact-item">Nairobi, Kenya</div>
            </div>
        </div>

    </div>

    <hr class="footer-divider">

    <div class="footer-bottom">
        &copy; {{ date('Y') }} AttachKE. All rights reserved.
    </div>
</footer>