@extends('backend.layouts.master')

@section('title', 'Create User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Header section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Create User</h3>
                    <p class="text-muted small mb-0">Add a new user to the system</p>
                </div>
                <div>
                    <a href="{{ route('users.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">
                        <i class="bx bx-arrow-back me-2"></i>Back to List
                    </a>
                </div>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <x-premium.card bodyClass="p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <h6 class="text-primary text-uppercase fw-bold mb-3 small border-bottom pb-2">Personal
                                Information</h6>
                        </div>

                        {{-- Name Fields --}}
                        <div class="col-md-6">
                            <x-premium.input label="First Name" name="fname" placeholder="Ex: John" :value="old('fname')"
                                required="true" />
                            @error('fname')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-premium.input label="Last Name" name="lname" placeholder="Ex: Doe" :value="old('lname')"
                                required="true" />
                            @error('lname')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Contact Info --}}
                        <div class="col-md-6">
                            <x-premium.input type="email" label="Email Address" name="email"
                                placeholder="email@example.com" :value="old('email')" required="true" />
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-premium.input label="Phone Number" name="phone" placeholder="Ex: 01700000000"
                                :value="old('phone')" required="true" />
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="text-primary text-uppercase fw-bold mb-3 small border-bottom pb-2">Access & Security
                            </h6>
                        </div>

                        {{-- Role --}}
                        <div class="col-md-12">
                            <x-premium.select label="User Role" name="role" required="true" isSelect2="true">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </x-premium.select>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <x-premium.input type="password" label="Password" name="password" placeholder="••••••••"
                                required="true" />
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-premium.input type="password" label="Confirm Password" name="password_confirmation"
                                placeholder="••••••••" required="true" />
                        </div>
                    </div>

                    <div class="mt-4 pt-3 text-end border-top">
                        <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold shadow-sm">
                            <i class="bx bx-save me-2"></i>Create User
                        </button>
                    </div>
                </x-premium.card>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <style>
        :root {
            --primary-accent: #4f46e5;
            --bg-body: #f8fafc;
        }

        body {
            background-color: var(--bg-body);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('body')
            });
        });
    </script>
@endpush
