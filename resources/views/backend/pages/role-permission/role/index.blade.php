@extends('backend.layouts.master')
@section('content')
    <div class="row g-4">
        <div class="col-12">
            <!-- Header section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Role Management</h3>
                    <p class="text-muted small mb-0">Define user roles and access levels</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary px-4 rounded-pill shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#addRoleModal">
                        <i class="bx bx-plus me-2"></i>Add New Role
                    </button>
                </div>
            </div>

            <!-- Role Table Card -->
            <x-premium.card bodyClass="p-0">
                <x-premium.table :headers="[
                    ['label' => '#', 'style' => 'width: 60px;', 'class' => 'ps-4'],
                    ['label' => 'Role Name'],
                    ['label' => 'Actions', 'class' => 'text-center pe-4', 'style' => 'width: 250px;'],
                ]">
                    <tbody>
                        @forelse ($roles as $key => $data)
                            <tr class="border-bottom-light">
                                <td class="ps-4">
                                    <span class="text-muted small">{{ $key + 1 }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $data->name }}</div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('role.permissions', $data->id) }}"
                                            class="btn btn-sm btn-primary-subtle text-primary border border-primary-subtle shadow-none">
                                            <i class="bx bx-list me-1"></i>Permission
                                        </a>
                                        <button
                                            class="btn btn-sm btn-icon bg-info-subtle text-info border border-info-subtle shadow-none editButton"
                                            data-bs-toggle="modal" data-bs-target="#editRoleModal"
                                            data-id="{{ $data->id }}" data-name="{{ $data->name }}" title="Edit">
                                            <i class="bx bx-pencil"></i>
                                        </button>
                                        <form action="{{ route('roles.destroy', $data->id) }}" method="POST"
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
                                        <i class="bx bx-shield fa-4x text-light opacity-50"></i>
                                    </div>
                                    <h5 class="text-muted fw-bold">No Roles Found</h5>
                                    <p class="text-muted small">Start by adding your first role.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-premium.table>
            </x-premium.card>
        </div>
    </div>

    {{-- Add Modal --}}
    <x-premium.modal id="addRoleModal" title="Add New Role" size="modal-dialog">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="p-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Role Name</label>
                    <input type="text" name="name" class="form-control border-light bg-light rounded-3 shadow-none"
                        placeholder="Enter Role Name" required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer border-light bg-light p-3">
                <button type="button" class="btn btn-white fw-bold px-4 rounded-pill"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary fw-bold px-4 rounded-pill">Save Role</button>
            </div>
        </form>
    </x-premium.modal>

    {{-- Edit Modal --}}
    <x-premium.modal id="editRoleModal" title="Update Role" size="modal-dialog">
        <form id="editRoleForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Role Name</label>
                    <input id="edit_name" type="text" name="name"
                        class="form-control border-light bg-light rounded-3 shadow-none" placeholder="Enter Role Name" required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer border-light bg-light p-3">
                <button type="button" class="btn btn-white fw-bold px-4 rounded-pill"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary fw-bold px-4 rounded-pill">Update Role</button>
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
        $(document).ready(function() {
            // Handle Edit Button Click
            $('.editButton').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');

                console.log('Edit clicked - ID:', id, 'Name:', name);

                // Build URL properly
                var url = "{{ url('backend/roles') }}/" + id;
                console.log('Setting form action to:', url);

                // Set form action and input value
                $('#editRoleForm').attr('action', url);
                $('#edit_name').val(name);

                console.log('Form action is now:', $('#editRoleForm').attr('action'));
            });

            // Handle Form Submission
            $('#editRoleForm').on('submit', function(e) {
                var formAction = $(this).attr('action');
                console.log('Form submitting to:', formAction);

                if (!formAction || formAction === '' || formAction === window.location.href) {
                    e.preventDefault();
                    alert('Error: Form action not set properly. Please try again.');
                    return false;
                }
            });
        });
    </script>
@endpush
