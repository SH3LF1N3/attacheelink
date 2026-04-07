{{-- Partial: dash.partials.org-table | Variable: $orgs (paginator) --}}

<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.875rem;">
            <thead style="background:#f9fafb;">
                <tr>
                    <th class="px-4 py-3 text-muted fw-semibold">#</th>
                    <th class="py-3 text-muted fw-semibold">Organisation</th>
                    <th class="py-3 text-muted fw-semibold">Contact Person</th>
                    <th class="py-3 text-muted fw-semibold">Industry</th>
                    <th class="py-3 text-muted fw-semibold">Location</th>
                    <th class="py-3 text-muted fw-semibold">Phone</th>
                    <th class="py-3 text-muted fw-semibold">Joined</th>
                    <th class="py-3 text-muted fw-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orgs as $org)
                <tr>
                    <td class="px-4 py-3 text-muted">
                        {{ $orgs->firstItem() + $loop->index }}
                    </td>

                    {{-- Org name + email --}}
                    <td class="py-3">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:36px;height:36px;border-radius:10px;flex-shrink:0;
                                        background:#b4530920;color:#b45309;font-weight:700;
                                        display:flex;align-items:center;justify-content:center;
                                        font-size:0.85rem;">
                                {{ strtoupper(substr($org->fname ?? $org->uname, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="color:var(--navy-800);">
                                    {{ $org->fname ?? '—' }}
                                </div>
                                <div style="font-size:0.75rem;color:#9ca3af;">{{ $org->email }}</div>
                            </div>
                        </div>
                    </td>

                    {{-- Contact person --}}
                    <td class="py-3">
                        <div style="color:#374151;">{{ $org->foth1 ?? '—' }}</div>
                    </td>

                    <td class="py-3">
                        @if($org->foth2)
                        <span class="badge"
                              style="background:#fef9ec;color:#b45309;font-size:0.72rem;border-radius:6px;">
                            {{ $org->foth2 }}
                        </span>
                        @else
                        <span class="text-muted">—</span>
                        @endif
                    </td>

                    <td class="py-3 text-muted">
                        @if($org->foth3)
                            <i class="bi bi-geo-alt me-1" style="color:#6b7280;"></i>{{ $org->foth3 }}
                        @else —
                        @endif
                    </td>

                    <td class="py-3 text-muted">{{ $org->phone ?? '—' }}</td>

                    <td class="py-3 text-muted">
                        {{ $org->created_at?->format('d M Y') }}
                    </td>

                    <td class="py-3">
                        <div class="d-flex align-items-center gap-2">

                            @if($permit->eorg)
                            <button type="button"
                                    class="btn btn-sm btn-edit-org"
                                    style="background:var(--navy-50);color:var(--navy-700);
                                           border-radius:6px;font-size:0.75rem;padding:4px 10px;"
                                    data-bs-toggle="modal" data-bs-target="#editOrgModal"
                                    data-id="{{ $org->id }}"
                                    data-uname="{{ $org->uname }}"
                                    data-fname="{{ $org->fname }}"
                                    data-foth1="{{ $org->foth1 }}"
                                    data-foth2="{{ $org->foth2 }}"
                                    data-foth3="{{ $org->foth3 }}"
                                    data-email="{{ $org->email }}"
                                    data-phone="{{ $org->phone }}">
                                <i class="bi bi-pencil-fill me-1"></i>Edit
                            </button>

                            <button type="button"
                                    class="btn btn-sm btn-confirm-delete"
                                    style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;
                                           border-radius:6px;font-size:0.75rem;padding:4px 10px;"
                                    data-name="{{ $org->foth1 ?? $org->uname }}"
                                    data-action="{{ route('organisations.destroy', $org->id) }}"
                                    data-method="DELETE">
                                <i class="bi bi-trash-fill me-1"></i>Delete
                            </button>
                            @endif

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-building" style="font-size:2.5rem;opacity:0.3;"></i>
                        <p class="mt-2 mb-0">No organisations found.</p>
                        @if($permit->aorg)
                        <button type="button" class="btn btn-sm mt-3"
                                style="background:var(--navy-700);color:#fff;border-radius:8px;"
                                data-bs-toggle="modal" data-bs-target="#createOrgModal">
                            <i class="bi bi-plus-lg me-1"></i>Add First Organisation
                        </button>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>