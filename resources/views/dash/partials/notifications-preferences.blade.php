{{-- Partial: dash.partials.notifications-preferences --}}

<div class="row justify-content-center mt-3">
    <div class="col-lg-6">
        <div class="card shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">

            <div class="card-header py-3 px-4"
                 style="background:var(--navy-700);border:none;">
                <h6 class="mb-0 text-white fw-bold">
                    <i class="bi bi-sliders me-2"></i>Notification Preferences
                </h6>
            </div>

            <div class="card-body px-4 py-4">
                <p style="font-size:0.875rem;color:#6b7280;margin-bottom:1.5rem;">
                    Choose how you'd like to receive notifications from AttachKE.
                </p>

                <form action="{{ route('notifications.preferences') }}" method="POST">
                    @csrf

                    <div class="d-flex align-items-center justify-content-between py-3"
                         style="border-bottom:1px solid #f3f4f6;">
                        <div>
                            <div class="fw-semibold" style="color:var(--navy-800);font-size:0.9rem;">
                                <i class="bi bi-app-indicator me-2" style="color:var(--navy-700);"></i>
                                In-App Notifications
                            </div>
                            <div style="font-size:0.8rem;color:var(--navy-600);margin-top:3px;">
                                Show notifications inside the dashboard
                            </div>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   name="in_app" id="pref_in_app" value="1"
                                   {{ $pref->in_app ? 'checked' : '' }}
                                   style="width:2.5rem;height:1.25rem;cursor:pointer;">
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between py-3">
                        <div>
                            <div class="fw-semibold" style="color:var(--navy-800);font-size:0.9rem;">
                                <i class="bi bi-envelope-fill me-2" style="color:var(--navy-700);"></i>
                                Email Notifications
                            </div>
                            <div style="font-size:0.8rem;color:var(--navy-600);margin-top:3px;">
                                Receive updates via email
                            </div>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   name="email" id="pref_email" value="1"
                                   {{ $pref->email ? 'checked' : '' }}
                                   style="width:2.5rem;height:1.25rem;cursor:pointer;">
                        </div>
                    </div>

                    <div class="pt-3" style="border-top:1px solid #f3f4f6;">
                        <button type="submit" class="btn btn-sm"
                                style="background:var(--navy-700);color:#fff;
                                       border-radius:8px;font-weight:600;">
                            <i class="bi bi-save me-1"></i>Save Preferences
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>