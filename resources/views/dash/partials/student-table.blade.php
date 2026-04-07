{{-- Partial: dash.partials.student-table | Variable: $students (paginator) --}}

<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.875rem;">
            <thead style="background:#f9fafb;">
                <tr>
                    <th class="px-4 py-3 text-muted fw-semibold">#</th>
                    <th class="py-3 text-muted fw-semibold">Student</th>
                    <th class="py-3 text-muted fw-semibold">Username</th>
                    <th class="py-3 text-muted fw-semibold">Student ID</th>
                    <th class="py-3 text-muted fw-semibold">Phone</th>
                    <th class="py-3 text-muted fw-semibold">Gender</th>
                    <th class="py-3 text-muted fw-semibold">Joined</th>
                    <th class="py-3 text-muted fw-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td class="px-4 py-3 text-muted">
                        {{ $students->firstItem() + $loop->index }}
                    </td>

                    <td class="py-3">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;border-radius:50%;flex-shrink:0;
                                        background:var(--navy-700);color:#fff;font-weight:700;
                                        display:flex;align-items:center;justify-content:center;
                                        font-size:0.8rem;">
                                {{ strtoupper(substr($student->fname ?? $student->email, 0, 1)) }}
                            </div>
                            <div style="flex:1;">
                                <div class="fw-semibold" style="color:var(--navy-800);">
                                    @if($student->fname)
                                        {{ $student->fname }}
                                    @else
                                        <span style="color:#9ca3af;font-weight:500;">{{ $student->email }}</span>
                                    @endif
                                </div>
                                @if($student->fname)
                                <div style="font-size:0.75rem;color:#9ca3af;">{{ $student->email }}</div>
                                @else
                                <div style="font-size:0.75rem;color:#ea580c;font-weight:500;">
                                    <i class="bi bi-exclamation-circle me-1"></i>Incomplete Profile
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <td class="py-3" style="color:#374151;">{{ $student->uname }}</td>
                    <td class="py-3 text-muted">{{ $student->sid ?? '—' }}</td>
                    <td class="py-3 text-muted">{{ $student->phone ?? '—' }}</td>

                    <td class="py-3">
                        @if($student->gender)
                        <span class="badge"
                              style="background:#f3f4f6;color:#374151;font-size:0.72rem;border-radius:6px;">
                            {{ $student->gender }}
                        </span>
                        @else
                        <span class="text-muted">—</span>
                        @endif
                    </td>

                    <td class="py-3 text-muted">
                        {{ $student->created_at?->format('d M Y') }}
                    </td>

                    <td class="py-3">
                        <div class="d-flex align-items-center gap-2">

                            @if($permit->estud)
                            <button type="button"
                                    class="btn btn-sm btn-edit-student"
                                    style="background:var(--navy-50);color:var(--navy-700);
                                           border-radius:6px;font-size:0.75rem;padding:4px 10px;"
                                    data-bs-toggle="modal" data-bs-target="#editStudentModal"
                                    data-id="{{ $student->id }}"
                                    data-uname="{{ $student->uname }}"
                                    data-fname="{{ $student->fname }}"
                                    data-email="{{ $student->email }}"
                                    data-phone="{{ $student->phone }}"
                                    data-gender="{{ $student->gender }}"
                                    data-sid="{{ $student->sid }}">
                                <i class="bi bi-pencil-fill me-1"></i>Edit
                            </button>

                            <button type="button"
                                    class="btn btn-sm btn-confirm-delete"
                                    style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;
                                           border-radius:6px;font-size:0.75rem;padding:4px 10px;"
                                    data-name="{{ $student->fname ?? $student->uname }}"
                                    data-action="{{ route('students.destroy', $student->id) }}"
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
                        <i class="bi bi-people" style="font-size:2.5rem;opacity:0.3;"></i>
                        <p class="mt-2 mb-0">No students found.</p>
                        @if($permit->astud)
                        <button type="button" class="btn btn-sm mt-3"
                                style="background:var(--navy-700);color:#fff;border-radius:8px;"
                                data-bs-toggle="modal" data-bs-target="#createStudentModal">
                            <i class="bi bi-plus-lg me-1"></i>Add First Student
                        </button>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>