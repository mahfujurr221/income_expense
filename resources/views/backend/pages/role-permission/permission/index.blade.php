@extends('backend.layouts.master')
@section('content')

<div class="card">
    <div class="card-body">
        <form>
            <div class="mt-3 row">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Name" name="name"
                        value="{{ request()->name }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Permission List</h4>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                    <i class="bx bx-plus"></i> Add New Permission
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>Permission Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $key => $data)
                <tr class="text-center">
                    <td>{{ $key + 1 + ($permissions->currentPage() - 1) * $permissions->perPage() }}</td>
                    <td>{{ $data->name }}</td>
                    <td>
                        <button class="btn btn-info btn-sm editButton" data-bs-toggle="modal"
                            data-bs-target="#editPermissionModal" data-id="{{ $data->id }}"
                            data-name="{{ $data->name }}" title="Edit">
                            <i class="bx bx-pencil"></i>
                        </button>
                        <form action="{{ route('permissions.destroy', $data->id) }}" method="POST"
                            style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure to delete?')" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No data found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $permissions->links() }}
        </div>
    </div>
</div>

{{-- Add Permission Modal --}}
<div class="modal fade" id="addPermissionModal" tabxndex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Enter Permission Name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Permission Modal --}}
<div class="modal fade" id="editPermissionModal" tabxndex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input id="edit_name" type="text" name="name" class="form-control"
                        placeholder="Enter Permission Name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.editButton');
        const editModal = document.getElementById('editPermissionModal');
        const editNameInput = document.getElementById('edit_name');
        const form = editModal.querySelector('form');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const permissionId = button.getAttribute('data-id');
                const permissionName = button.getAttribute('data-name');

                form.action = `/permissions/${permissionId}`;
                editNameInput.value = permissionName;
            });
        });

        // Show edit modal if validation fails
        @if ($errors->any() && old('edit_permission_id'))
            new bootstrap.Modal(editModal).show();
        @endif
    });
</script>
@endpush