<footer class="app-footer"
        style="background-color: var(--navy-800) !important; color:#9ca3af; font-size:0.8125rem;">
        
    <div class="float-end d-none d-sm-inline" style="color:#6b7280;">
        Designed by Sherry Obare
    </div>
    <strong style="color:#9ca3af;">
        Copyright &copy; {{ date('Y') }}
        <a href="{{ route('home') }}" class="text-decoration-none" style="color:var(--gold-400);">
            AttachKE
        </a>.
    </strong>
    All rights reserved.
</footer>
@include('dash.partials.delete-modal')
</div>{{-- end app-wrapper --}}



{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
<script src="/src/js/adminlte.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        crossorigin="anonymous"></script>

<script>
    // OverlayScrollbars
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector('.sidebar-wrapper');
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars && window.innerWidth > 992) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true },
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>