{{-- Modal: Create Student --}}

<div class="modal fade" id="createStudentModal" tabindex="-1"
     aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border:none;border-radius:12px;overflow:hidden;">

            <div class="modal-header py-3 px-4" style="background:var(--navy-700);border:none;">
                <h5 class="modal-title text-white fw-bold" id="createStudentModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Add New Student
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-4">

                    {{-- Global error summary --}}
                    @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 mb-3" style="border-radius:8px;font-size:0.8125rem;">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Please fix the following: {{ $errors->first() }}
                    </div>
                    @endif

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="uname"
                                   value="{{ old('uname') }}"
                                   class="form-control @error('uname') is-invalid @enderror"
                                   placeholder="e.g. jdoe2024" required style="border-radius:8px;">
                            @error('uname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="fname"
                                   value="{{ old('fname') }}"
                                   class="form-control @error('fname') is-invalid @enderror"
                                   placeholder="e.g. John Doe" required style="border-radius:8px;">
                            @error('fname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="student@university.ac.ke" required style="border-radius:8px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Phone</label>
                            <input type="text" name="phone"
                                   value="{{ old('phone') }}"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="e.g. 0712345678" style="border-radius:8px;">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Gender</label>
                            <select name="gender"
                                    class="form-select @error('gender') is-invalid @enderror"
                                    style="border-radius:8px;">
                                <option value="">Select Gender</option>
                                <option {{ old('gender') === 'Male'           ? 'selected' : '' }}>Male</option>
                                <option {{ old('gender') === 'Female'         ? 'selected' : '' }}>Female</option>
                                <option {{ old('gender') === 'Rather Not Say' ? 'selected' : '' }}>Rather Not Say</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Student ID</label>
                            <input type="text" name="sid"
                                   value="{{ old('sid') }}"
                                   class="form-control @error('sid') is-invalid @enderror"
                                   placeholder="e.g. SCT/123/2024" style="border-radius:8px;">
                            @error('sid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimum 8 characters" required minlength="8"
                                   style="border-radius:8px;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="modal-footer px-4 py-3"
                     style="border-top:1px solid #f3f4f6;background:#fafafa;">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <button type="submit" class="btn btn-sm"
                            style="background:var(--navy-700);color:#fff;border-radius:8px;font-weight:600;">
                        <i class="bi bi-person-check-fill me-1"></i>Save Student
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Reopen modal if validation failed --}}
@if($errors->any() && old('uname') !== null)
<script>
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Modal(document.getElementById('createStudentModal')).show();
});
</script>
@endif