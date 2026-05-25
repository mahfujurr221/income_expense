@extends('backend.layouts.master')
@section('content')

<div class="card mb-3">
    <div class="card-body">
        <form>
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Name" name="name"
                        value="{{ request()->name }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Phone" name="phone"
                        value="{{ request()->phone }}">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ request()->role == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">User List</h4>
        <a class="btn btn-primary" href="{{ route('users.create') }}">
            <i class="bi bi-plus"></i> Add New User
        </a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover text-center align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key => $data)
                <tr>
                    <td>{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>{{ $data->fname }} {{ $data->lname }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>
                        @foreach ($data->roles as $role)
                        <span class="badge bg-warning">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('users.edit', $data->id) }}" title="Edit">
                            <i class="bx bx-pencil"></i>
                        </a>
                        <form action="{{ route('users.destroy', $data->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                onclick="return confirm('Are you sure to delete?')">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No data found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection