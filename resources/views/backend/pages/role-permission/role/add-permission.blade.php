@extends('backend.layouts.master')

@section('content')
<div class="border-0 shadow-sm card">
    <div class="py-3 bg-white card-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 card-title">Manage Permissions for: <span class="text-primary fw-bold">{{ $role->name }}</span></h4>
            <small class="text-muted">Assign or revoke specific access rights for this role.</small>
        </div>
        <div class="gap-2 d-flex">
            <button type="button" class="btn btn-outline-success btn-sm" id="checkAll">
                <i class="bx bx-check-double"></i> Select All
            </button>
            <button type="button" class="btn btn-outline-danger btn-sm" id="uncheckAll">
                <i class="bx bx-x-circle"></i> Unselect All
            </button>
        </div>
    </div>

    <div class="px-4 pt-3">
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" id="permissionSearch" class="form-control" placeholder="Search permissions (e.g. 'stock', 'report')...">
        </div>
    </div>

    <form action="{{ route('role-permissions.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row g-4">
                @foreach ($groupedPermissions as $group => $permissions)
                <div class="col-md-4 col-lg-3 permission-group-card">
                    <div class="border shadow-none card h-100">
                        {{-- Dynamic Header Color: Dark for System/Reports, Primary for others --}}
                        <div class="py-2 card-header {{ $group === 'System & Reports' ? 'bg-dark' : 'bg-primary' }} d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-white text-capitalize">{{ str_replace('_', ' ', $group) }}</h6>
                            <div class="mb-0 form-check">
                                <input class="form-check-input select-group" type="checkbox" title="Select All in Group">
                            </div>
                        </div>
                        <div class="py-3 card-body">
                            @foreach ($permissions as $permission)
                            <div class="mb-2 form-check form-switch permission-item">
                                <input class="form-check-input" type="checkbox" name="permission[]"
                                    value="{{ $permission->name }}"
                                    id="perm_{{ $permission->id }}"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                    {{-- Cleaner labels: removes the group name from the label if it's redundant --}}
                                    {{ ucwords(str_replace(['-', '_'], ' ', $permission->name)) }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="py-3 text-center bg-white card-footer border-top">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="px-5 btn btn-primary">
                <i class="bx bx-save me-1"></i> Update Permissions
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ... (Keep your existing search and checkbox logic here, it works perfectly) ...

        // Global Select All
        document.getElementById('checkAll').addEventListener('click', function () {
            document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = true);
            updateGroupCheckboxes();
        });

        document.getElementById('uncheckAll').addEventListener('click', function () {
            document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = false);
            updateGroupCheckboxes();
        });

        document.querySelectorAll('.select-group').forEach(groupCb => {
            groupCb.addEventListener('change', function() {
                const groupCard = this.closest('.card');
                groupCard.querySelectorAll('input[name="permission[]"]').forEach(cb => {
                    cb.checked = this.checked;
                });
            });
        });

        document.getElementById('permissionSearch').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.permission-item').forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(term)) {
                    item.style.setProperty('display', 'block', 'important');
                } else {
                    item.style.setProperty('display', 'none', 'important');
                }
            });

            document.querySelectorAll('.permission-group-card').forEach(card => {
                const hasVisible = Array.from(card.querySelectorAll('.permission-item'))
                                       .some(i => i.style.display !== 'none');
                card.style.display = hasVisible ? 'block' : 'none';
            });
        });

        function updateGroupCheckboxes() {
            document.querySelectorAll('.permission-group-card').forEach(card => {
                const checkboxes = card.querySelectorAll('input[name="permission[]"]');
                const groupCb = card.querySelector('.select-group');
                const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
                if(groupCb) groupCb.checked = (checkedCount === checkboxes.length && checkboxes.length > 0);
            });
        }
        updateGroupCheckboxes();
    });
</script>
@endpush
@endsection
