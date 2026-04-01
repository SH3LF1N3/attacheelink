{{-- Modal: Edit Organisation --}}

<div class="modal fade" id="editOrgModal" tabindex="-1"
     aria-labelledby="editOrgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border:none;border-radius:12px;overflow:hidden;">

            <div class="modal-header py-3 px-4"
                 style="background:var(--navy-700);border:none;">
                <h5 class="modal-title text-white fw-bold" id="editOrgModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Edit Organisation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="editOrgForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body px-4 py-4">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Organisation Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="foth1" id="edit_foth1" class="form-control"
                                   required style="border-radius:8px;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Contact Person <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="fname" id="edit_org_fname" class="form-control"
                                   required style="border-radius:8px;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="uname" id="edit_org_uname" class="form-control"
                                   required style="border-radius:8px;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" id="edit_org_email" class="form-control"
                                   required style="border-radius:8px;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Phone</label>
                            <input type="text" name="phone" id="edit_org_phone" class="form-control"
                                   style="border-radius:8px;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Industry / Sector
                            </label>
                            <input type="text" name="foth2" id="edit_foth2" class="form-control"
                                   placeholder="e.g. Telecommunications" style="border-radius:8px;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Location</label>
                            <input type="text" name="foth3" id="edit_foth3" class="form-control"
                                   placeholder="e.g. Nairobi, Kenya" style="border-radius:8px;">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                New Password
                                <span style="font-weight:400;color:#9ca3af;font-size:0.8rem;">
                                    (leave blank to keep current)
                                </span>
                            </label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Minimum 8 characters" minlength="8"
                                   style="border-radius:8px;">
                        </div>

                    </div>
                </div>

                <div class="modal-footer px-4 py-3"
                     style="border-top:1px solid #f3f4f6;background:#fafafa;">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <button type="submit" class="btn btn-sm"
                            style="background:var(--gold-400);color:var(--navy-800);border-radius:8px;font-weight:600;">
                        <i class="bi bi-save me-1"></i>Update Organisation
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-edit-org').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const d = this.dataset;
            document.getElementById('editOrgForm').action = '/organisations/' + d.id;
            document.getElementById('edit_foth1').value       = d.foth1 ?? '';
            document.getElementById('edit_org_fname').value   = d.fname ?? '';
            document.getElementById('edit_org_uname').value   = d.uname ?? '';
            document.getElementById('edit_org_email').value   = d.email ?? '';
            document.getElementById('edit_org_phone').value   = d.phone ?? '';
            document.getElementById('edit_foth2').value       = d.foth2 ?? '';
            document.getElementById('edit_foth3').value       = d.foth3 ?? '';
        });
    });
});
</script>