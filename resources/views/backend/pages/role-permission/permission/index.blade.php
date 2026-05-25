@extends('backend.layouts.master')
@section('content')
    <div class="row g-4">
        <div class="col-12">
            <!-- Header section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Permission Management</h3>
                    <p class="text-muted small mb-0">Define system permissions and access controls</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary px-4 rounded-pill shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#addPermissionModal">
                        <i class="bx bx-plus me-2"></i>Add New Permission
                    </button>
                </div>
            </div>

            <!-- Filter Bar -->
            <x-premium.filter-bar :action="route('permissions.index')">
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-sm border-light bg-light rounded-3 shadow-none"
                        placeholder="Search by Name" name="name" value="{{ request()->name }}">
                </div>
            </x-premium.filter-bar>

            <!-- Permission Table Card -->
            <x-premium.card bodyClass="p-0">
                <x-premium.table :headers="[
                    ['label' => '#', 'style' => 'width: 60px;', 'class' => 'ps-4'],
                    ['label' => 'Permission Name'],
                    ['label' => 'Actions', 'class' => 'text-center pe-4', 'style' => 'width: 120px;'],
                ]">
                    <tbody>
                        @forelse ($permissions as $key => $data)
                            <tr class="border-bottom-light">
                                <td class="ps-4">
                                    <span
                                        class="text-muted small">{{ $key + 1 + ($permissions->currentPage() - 1) * $permissions->perPage() }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $data->name }}</div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        <button
                                            class="btn btn-sm btn-icon bg-info-subtle text-info border border-info-subtle shadow-none editButton"
                                            data-bs-toggle="modal" data-bs-target="#editPermissionModal"
                                            data-id="{{ $data->id }}" data-name="{{ $data->name }}" title="Edit">
                                            <i class="bx bx-pencil"></i>
                                        </button>
                                        <form action="{{ route('permissions.destroy', $data->id) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-icon bg-danger-subtle text-danger border border-danger-subtle shadow-none"
                                                onclick="return confirm('Are you sure to delete?')" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="bx bx-lock fa-4x text-light opacity-50"></i>
                                    </div>
                                    <h5 class="text-muted fw-bold">No Permissions Found</h5>
                                    <p class="text-muted small">Start by adding your first permission.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-premium.table>

                <!-- Pagination bar -->
                <div
                    class="p-4 bg-light border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-muted small">
                        Showing {{ $permissions->firstItem() ?? 0 }} to {{ $permissions->lastItem() ?? 0 }} of
                        {{ $permissions->total() }} permissions
                    </div>
                    <div>
                        {{ $permissions->links() }}
                    </div>
                </div>
            </x-premium.card>
        </div>
    </div>

    {{-- Add Permission Modal --}}
    <x-premium.modal id="addPermissionModal" title="Add New Permission" size="modal-dialog">
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <div class="p-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Permission Name</label>
                    <input type="text" name="name" class="form-control border-light bg-light rounded-3 shadow-none"
                        placeholder="Enter Permission Name" required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer border-light bg-light p-3">
                <button type="button" class="btn btn-white fw-bold px-4 rounded-pill"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary fw-bold px-4 rounded-pill">Save Permission</button>
            </div>
        </form>
    </x-premium.modal>

    {{-- Edit Permission Modal --}}
    <x-premium.modal id="editPermissionModal" title="Update Permission" size="modal-dialog">
        <form id="editPermissionForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Permission Name</label>
                    <input id="edit_name" type="text" name="name"
                        class="form-control border-light bg-light rounded-3 shadow-none" placeholder="Enter Permission Name"
                        required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer border-light bg-light p-3">
                <button type="button" class="btn btn-white fw-bold px-4 rounded-pill"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary fw-bold px-4 rounded-pill">Update Permission</button>
            </div>
        </form>
    </x-premium.modal>
@endsection

@push('css')
    <style>
        :root {
            --primary-accent: #4f46e5;
            --success-accent: #10b981;
            --danger-accent: #ef4444;
            --bg-body: #f8fafc;
        }

        body {
            background-color: var(--bg-body);
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .table thead th {
            letter-spacing: 0.05em;
            font-size: 11px;
            font-weight: 700;
            background: #f1f5f9;
        }

        .border-bottom-light {
            border-bottom: 1px solid #f1f5f9;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: all 0.2s ease;
            padding: 0;
        }

        .btn-icon:hover:not([disabled]) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.editButton');
            const editModal = document.getElementById('editPermissionModal');
            const editNameInput = document.getElementById('edit_name');
            const form = document.getElementById('editPermissionForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const permissionId = button.getAttribute('data-id');
                    const permissionName = button.getAttribute('data-name');

                    console.log('Edit clicked - ID:', permissionId, 'Name:', permissionName);

                    // Build URL properly
                    const url = "{{ url('backend/permissions') }}/" + permissionId;
                    console.log('Setting form action to:', url);

                    form.action = url;
                    editNameInput.value = permissionName;

                    console.log('Form action is now:', form.action);
                });
            });

            // Handle Form Submission with validation
            form.addEventListener('submit', function(e) {
                console.log('Form submitting to:', form.action);

                if (!form.action || form.action === '' || form.action === window.location.href) {
                    e.preventDefault();
                    alert('Error: Form action not set properly. Please try again.');
                    return false;
                }
            });

            // Show edit modal if validation fails
            @if ($errors->any() && old('edit_permission_id'))
                new bootstrap.Modal(editModal).show();
            @endif
        });
    </script>
@endpush
