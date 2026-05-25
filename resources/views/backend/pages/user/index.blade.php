@extends('backend.layouts.master')
@section('content')

    <div class="row g-4">
        <div class="col-12">
            <!-- Header section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">User Management</h3>
                    <p class="text-muted small mb-0">Manage system users and their access</p>
                </div>
                <div class="d-flex gap-2">
                    <a class="btn btn-primary px-4 rounded-pill shadow-sm" href="{{ route('users.create') }}">
                        <i class="bx bx-plus-circle me-2"></i>Add New User
                    </a>
                </div>
            </div>

            <!-- Filter Bar -->
            <x-premium.filter-bar :action="route('users.index')">
                <div class="col-md-2">
                    <input type="number" class="form-control form-control-sm border-light bg-light rounded-3 shadow-none"
                        placeholder="Search by User ID" name="user_id" value="{{ request('user_id') }}" min="1">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm border-light bg-light rounded-3 shadow-none"
                        placeholder="Search by Name" name="name" value="{{ request('name') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm border-light bg-light rounded-3 shadow-none"
                        placeholder="Search by Phone" name="phone" value="{{ request('phone') }}">
                </div>
                <div class="col-md-2">
                    <select name="role" class="form-select form-select-sm border-light bg-light rounded-3 shadow-none">
                        <option value="">All Roles</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </x-premium.filter-bar>

            <!-- User Table Card -->
            <x-premium.card bodyClass="p-0">
                <x-premium.table :headers="[
                    ['label' => '#', 'style' => 'width: 60px;', 'class' => 'ps-4'],
                    ['label' => 'Name'],
                    ['label' => 'Email'],
                    ['label' => 'Phone', 'style' => 'width: 150px;'],
                    ['label' => 'Shop', 'style' => 'width: 150px;'],
                    ['label' => 'Role', 'style' => 'width: 150px;'],
                    ['label' => 'Actions', 'class' => 'text-center pe-4', 'style' => 'width: 120px;'],
                ]">
                    <tbody>
                        @forelse($users as $data)
                            <tr class="border-bottom-light">
                                <td class="ps-4">
                                    <span class="text-muted small">{{ $data->id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $data->full_name }}</div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $data->email }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $data->phone }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-info-subtle text-info border border-info-subtle fw-normal px-3 py-2">
                                        {{ $data->shop->name ?? 'Global/Admin' }}
                                    </span>
                                </td>
                                <td>
                                    @foreach ($data->roles as $role)
                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning-subtle fw-normal px-3 py-2">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm btn-icon bg-info-subtle text-info border border-info-subtle shadow-none"
                                            href="{{ route('users.edit', $data->id) }}" title="Edit">
                                            <i class="bx bx-pencil"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $data->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-icon bg-danger-subtle text-danger border border-danger-subtle shadow-none"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="bx bx-user fa-4x text-light opacity-50"></i>
                                    </div>
                                    <h5 class="text-muted fw-bold">No Users Found</h5>
                                    <p class="text-muted small">No users match your search criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-premium.table>

                <!-- Pagination bar -->
                <div
                    class="p-4 bg-light border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-muted small">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
                        users
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </x-premium.card>
        </div>
    </div>
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
