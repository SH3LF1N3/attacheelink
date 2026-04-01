{{-- Modal: Create Organisation --}}

<div class="modal fade" id="createOrgModal" tabindex="-1"
     aria-labelledby="createOrgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border:none;border-radius:12px;overflow:hidden;">

            <div class="modal-header py-3 px-4"
                 style="background:var(--navy-700);border:none;">
                <h5 class="modal-title text-white fw-bold" id="createOrgModalLabel">
                    <i class="bi bi-building-fill-add me-2"></i>Add New Organisation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('organisations.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-4">

                    @if($errors->any() && old('_form') === 'org-create')
                    <div class="alert alert-danger py-2 px-3 mb-3" style="border-radius:8px;font-size:0.8125rem;">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
                    </div>
                    @endif

                    {{-- Hidden field to identify which form was submitted --}}
                    <input type="hidden" name="_form" value="org-create">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Organisation Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="foth1"
                                   value="{{ old('foth1') }}"
                                   class="form-control @error('foth1') is-invalid @enderror"
                                   placeholder="e.g. Safaricom PLC" required style="border-radius:8px;">
                            @error('foth1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Contact Person <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="fname"
                                   value="{{ old('fname') }}"
                                   class="form-control @error('fname') is-invalid @enderror"
                                   placeholder="e.g. Jane Wanjiku" required style="border-radius:8px;">
                            @error('fname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="uname"
                                   value="{{ old('uname') }}"
                                   class="form-control @error('uname') is-invalid @enderror"
                                   placeholder="e.g. safaricom_ke" required style="border-radius:8px;">
                            @error('uname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="hr@organisation.co.ke" required style="border-radius:8px;">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Phone</label>
                            <input type="text" name="phone"
                                   value="{{ old('phone') }}"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="e.g. 0722000000" style="border-radius:8px;">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Industry / Sector
                            </label>
                            <input type="text" name="foth2"
                                   value="{{ old('foth2') }}"
                                   class="form-control @error('foth2') is-invalid @enderror"
                                   placeholder="e.g. Telecommunications" style="border-radius:8px;">
                            @error('foth2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Location</label>
                            <input type="text" name="foth3"
                                   value="{{ old('foth3') }}"
                                   class="form-control @error('foth3') is-invalid @enderror"
                                   placeholder="e.g. Nairobi, Kenya" style="border-radius:8px;">
                            @error('foth3')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimum 8 characters" required minlength="8"
                                   style="border-radius:8px;">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>
                </div>

                <div class="modal-footer px-4 py-3"
                     style="border-top:1px solid #f3f4f6;background:#fafafa;">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <button type="submit" class="btn btn-sm"
                            style="background:var(--gold-400);color:var(--navy-800);border-radius:8px;font-weight:600;">
                        <i class="bi bi-building-check me-1"></i>Save Organisation
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@if($errors->any() && old('_form') === 'org-create')
<script>
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Modal(document.getElementById('createOrgModal')).show();
});
</script>
@endif