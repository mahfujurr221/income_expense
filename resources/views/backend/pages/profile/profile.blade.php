@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User Profile</h5>
    </div>
    <div class="card-body row g-3">
        <div class="col-xl-4">
            <div class="pt-4 text-center">
                <img id="profileImagePreview"
                    src="{{ auth()->user()->image ? asset('backend/images/users/' . auth()->user()->image) : asset('uploads/user.png') }}"
                    alt="Profile" class="border rounded-circle" height="150" width="150" style="object-fit: cover;">
                <h2 class="mt-3">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</h2>
                <span class="badge bg-primary">{{ auth()->user()->type ?? 'User' }}</span>
            </div>
        </div>

        <div class="col-xl-8">
            <ul class="nav nav-tabs nav-tabs-bordered" id="profileTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab"
                        data-bs-target="#profile-overview">Overview</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                        Password</button>
                </li>
            </ul>

            <div class="pt-3 tab-content">
                <div class="tab-pane fade show active" id="profile-overview">
                    <div class="mb-2 row">
                        <div class="col-lg-2 col-md-4 fw-bold">Full Name :</div>
                        <div class="col-lg-9 col-md-8">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-lg-2 col-md-4 fw-bold">Email :</div>
                        <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-lg-2 col-md-4 fw-bold">Phone :</div>
                        <div class="col-lg-9 col-md-8">{{ auth()->user()->phone }}</div>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile-edit">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-7">
                            <label class="form-label">Profile Image</label>
                            <div class="gap-2 d-flex align-items-center">
                                <input type="file" name="image" id="profileImageUpload" class="form-control"
                                    accept="image/*" onchange="previewProfileImage(event)">
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeProfileImage()"><i
                                        class="bi bi-trash"></i></button>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input name="fName" type="text" class="form-control" value="{{ auth()->user()->fname }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input name="lName" type="text" class="form-control" value="{{ auth()->user()->lname }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input name="phone" type="text" class="form-control" value="{{ auth()->user()->phone }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ auth()->user()->email }}"
                                required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="text-center bg-transparent border-0 card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="profile-change-password">
                    <form action="{{ route('profile.reset') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="text-center bg-transparent border-0 card-footer">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewProfileImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profileImagePreview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function removeProfileImage() {
        document.getElementById('profileImageUpload').value = '';
        document.getElementById('profileImagePreview').src = '{{ asset("uploads/user.png") }}';
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Check if there are validation errors for password fields
        @if($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
            var passwordTab = document.querySelector('button[data-bs-target="#profile-change-password"]');
            if (passwordTab) {
                bootstrap.Tab.getOrCreateInstance(passwordTab).show();
            }

        // 2. Check if there are validation errors for profile edit fields
        @elseif($errors->has('fName') || $errors->has('lName') || $errors->has('email') || $errors->has('phone') || $errors->has('image'))
            var editTab = document.querySelector('button[data-bs-target="#profile-edit"]');
            if (editTab) {
                bootstrap.Tab.getOrCreateInstance(editTab).show();
            }
        @endif

        // Optional: Keep tab active if user manually refreshed (using Hash in URL)
        let hash = window.location.hash;
        if (hash) {
            let activeTab = document.querySelector('button[data-bs-target="' + hash + '"]');
            if (activeTab) {
                bootstrap.Tab.getOrCreateInstance(activeTab).show();
            }
        }

        // Add hash to URL when tab is clicked so refresh stays on tab
        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(tabEl => {
            tabEl.addEventListener('shown.bs.tab', function (event) {
                window.location.hash = event.target.getAttribute('data-bs-target');
            });
        });
    });

    // Your existing image preview functions
    function previewProfileImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profileImagePreview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function removeProfileImage() {
        document.getElementById('profileImageUpload').value = '';
        document.getElementById('profileImagePreview').src = '{{ asset("uploads/user.png") }}';
    }
</script>
@endpush