{{--
    Partial: dash.set.partials.gen-form
    Variables: $settings (Setdb instance)
--}}

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm" style="border: none; border-radius: 12px; overflow: hidden;">

            <div class="card-header py-3 px-4"
                 style="background: var(--navy-700); border: none;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-sliders text-white"></i>
                    <h5 class="mb-0 text-white fw-bold">Site Configuration</h5>
                </div>
            </div>

            <div class="card-body px-4 py-4">
                <form action="{{ route('general_settings.update') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Site Name --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: #374151; font-size: 0.875rem;">
                            Site Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="sname"
                               value="{{ old('sname', $settings->sname) }}"
                               class="form-control @error('sname') is-invalid @enderror"
                               placeholder="e.g. AttachKE"
                               style="border-radius: 8px;">
                        @error('sname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Contact Email --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: #374151; font-size: 0.875rem;">
                            Contact Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email', $settings->email) }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="e.g. admin@attachke.co.ke"
                               style="border-radius: 8px;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Logo Upload --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: #374151; font-size: 0.875rem;">
                            Site Logo
                        </label>

                        {{-- Current logo preview --}}
                        @if($settings->logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings->logo) }}"
                                 alt="Current Logo"
                                 style="height: 56px; object-fit: contain; border-radius: 6px;
                                        border: 1px solid #e5e7eb; padding: 4px; background: #f9fafb;">
                            <span class="text-muted ms-2" style="font-size: 0.75rem;">Current logo</span>
                        </div>
                        @endif

                        <input type="file" name="logo" accept="image/*"
                               class="form-control @error('logo') is-invalid @enderror"
                               style="border-radius: 8px;"
                               onchange="previewLogo(this)">
                        <div class="form-text">Max 2MB. JPG, PNG, SVG, or WebP.</div>
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Upload preview --}}
                        <img id="logoPreview" src="#" alt="Preview"
                             style="display:none; margin-top: 10px; height: 56px; object-fit: contain;
                                    border-radius: 6px; border: 1px solid #e5e7eb; padding: 4px;">
                    </div>

                    <div class="d-flex justify-content-end pt-3"
                         style="border-top: 1px solid #f3f4f6;">
                        <button type="submit" class="btn px-4"
                                style="background: var(--navy-700); color: #fff; border-radius: 8px;">
                            <i class="bi bi-save me-1"></i> Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewLogo(input) {
    const preview = document.getElementById('logoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>