
<div class="modal fade" id="deleteModal" tabindex="-1"
     aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content" style="border:none;border-radius:14px;overflow:hidden;">

            {{-- Header --}}
            <div class="modal-header px-4 py-3"
                 style="background:var(--navy-700);border-bottom:1px solid #fecaca;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:36px;height:36px;border-radius:50%;background:#fee2e2;
                                display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-exclamation-triangle-fill" style="color:#dc2626;font-size:1rem;"></i>
                    </div>
                    <h5 class="modal-title mb-0 fw-bold" id="deleteModalLabel"
                        style="color:#991b1b;font-size:1rem;">
                        Confirm Delete
                    </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter:invert(27%) sepia(90%) saturate(600%) hue-rotate(330deg);"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body px-4 py-4 text-center">
                <p style="color:#374151;font-size:0.9375rem;line-height:1.6;margin:0;">
                    Are you sure you want to delete
                    <strong id="deleteModalName" style="color:var(--navy-800);"></strong>?
                </p>
                <p class="mt-2 mb-0" style="font-size:0.8125rem;color:#9ca3af;">
                    This action is permanent and cannot be undone.
                </p>
            </div>

            {{-- Footer --}}
            <div class="modal-footer px-4 py-3 justify-content-center gap-3"
                 style="border-top:1px solid #f3f4f6;background:#fafafa;">
                <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal" style="border-radius:8px;min-width:100px;">
                    Cancel
                </button>
                <form id="deleteModalForm" method="POST" style="margin:0;">
                    @csrf
                    <input type="hidden" name="_method" id="deleteModalMethod" value="DELETE">
                    <button type="submit" class="btn btn-sm"
                            style="background:#dc2626;color:#fff;border-radius:8px;
                                   min-width:100px;font-weight:600;">
                        <i class="bi bi-trash-fill me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-confirm-delete');
        if (!btn) return;

        document.getElementById('deleteModalName').textContent  = btn.dataset.name   || 'this item';
        document.getElementById('deleteModalForm').action       = btn.dataset.action || '#';
        document.getElementById('deleteModalMethod').value      = btn.dataset.method || 'DELETE';

        // Compatible with Bootstrap 5.0 → 5.3
        const el = document.getElementById('deleteModal');
        (bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el)).show();
    });
});
</script>