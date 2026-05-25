@extends('backend.layouts.master')

@section('title', 'System Settings')

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Area -->
                <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                    <div>
                        <h2 class="fw-bold mb-1 text-dark">Settings</h2>
                        <p class="text-muted mb-0">Manage your business configuration and appearance</p>
                    </div>
                    <button type="submit" class="btn btn-primary px-5 py-3 shadow-lg rounded-pill fw-bold border-0"
                        style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                        <i class="feather icon-save me-2"></i> Save All Settings
                    </button>
                </div>

                <div class="row">
                    <!-- Navigation Sidebar -->
                    <div class="col-xl-3 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                            <div class="card-body p-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <button
                                        class="nav-link active text-start py-3 px-4 rounded-3 mb-2 fw-semibold d-flex align-items-center"
                                        id="nav-general-tab" data-bs-toggle="pill" data-bs-target="#nav-general"
                                        type="button" role="tab">
                                        <i class="feather icon-info me-3 h5 mb-0"></i> General Info
                                    </button>
                                    <button
                                        class="nav-link text-start py-3 px-4 rounded-3 mb-2 fw-semibold d-flex align-items-center"
                                        id="nav-branding-tab" data-bs-toggle="pill" data-bs-target="#nav-branding"
                                        type="button" role="tab">
                                        <i class="feather icon-image me-3 h5 mb-0"></i> Branding & Content
                                    </button>
                                    <button
                                        class="nav-link text-start py-3 px-4 rounded-3 mb-2 fw-semibold d-flex align-items-center"
                                        id="nav-social-tab" data-bs-toggle="pill" data-bs-target="#nav-social"
                                        type="button" role="tab">
                                        <i class="feather icon-share-2 me-3 h5 mb-0"></i> Social Links
                                    </button>
                                    <button
                                        class="nav-link text-start py-3 px-4 rounded-3 mb-2 fw-semibold d-flex align-items-center"
                                        id="nav-seo-tab" data-bs-toggle="pill" data-bs-target="#nav-seo"
                                        type="button" role="tab">
                                        <i class="feather icon-search me-3 h5 mb-0"></i> SEO Settings
                                    </button>
                                    <button
                                        class="nav-link text-start py-3 px-4 rounded-3 mb-0 fw-semibold d-flex align-items-center"
                                        id="nav-policies-tab" data-bs-toggle="pill" data-bs-target="#nav-policies"
                                        type="button" role="tab">
                                        <i class="feather icon-shield me-3 h5 mb-0"></i> Policies
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="col-xl-9 col-lg-8">
                        <div class="tab-content border-0" id="v-pills-tabContent">

                            <!-- General Info Section -->
                            <div class="tab-pane fade show active" id="nav-general" role="tabpanel">
                                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                    <h4 class="fw-bold mb-4">Business Information</h4>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Site Name</label>
                                                <input type="text" class="form-control" name="site_name"
                                                    value="{{ $setting->site_name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Site Title</label>
                                                <input type="text" class="form-control" name="site_title"
                                                    value="{{ $setting->site_title }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Contact Phone</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ $setting->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Email Address</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $setting->email }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Address 1</label>
                                                <textarea class="form-control" name="address" rows="2">{{ $setting->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Address 2</label>
                                                <textarea class="form-control" name="address2" rows="2">{{ $setting->address2 }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Google Map iframe</label>
                                                <textarea class="form-control" name="google_map" rows="3">{{ $setting->google_map }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Branding Section -->
                            <div class="tab-pane fade" id="nav-branding" role="tabpanel">
                                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-center">
                                    <h4 class="fw-bold mb-4 text-start">Branding Assets</h4>
                                    <div class="row g-5 mb-4">
                                        <div class="col-md-7">
                                            <div class="p-4 rounded-4 border-2 border-dashed bg-light">
                                                <h6 class="fw-bold mb-3">Main Business Logo</h6>
                                                <div class="preview-box mb-3 p-3 bg-white rounded border d-inline-block">
                                                    <img id="logo-preview"
                                                        src="{{ $setting->logo ? asset('uploads/' . $setting->logo) : asset('backend/assets/images/logo.png') }}"
                                                        class="img-fluid" style="max-height: 100px;">
                                                </div>
                                                <input type="file" class="form-control form-control-sm" name="logo"
                                                    id="logo-input" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="p-4 rounded-4 border-2 border-dashed bg-light">
                                                <h6 class="fw-bold mb-3">Site Favicon</h6>
                                                <div class="preview-box mb-3 p-3 bg-white rounded border d-inline-block">
                                                    <img id="favicon-preview"
                                                        src="{{ $setting->favicon ? asset('uploads/' . $setting->favicon) : asset('backend/assets/images/favicon.ico') }}"
                                                        class="img-fluid" style="width: 48px; height: 48px;">
                                                </div>
                                                <input type="file" class="form-control form-control-sm" name="favicon"
                                                    id="favicon-input" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold mb-4 text-start border-top pt-4">Global Content</h4>
                                    <div class="row g-4 text-start">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Headline</label>
                                                <textarea class="form-control" name="headline" rows="2">{{ $setting->headline }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Footer Text</label>
                                                <textarea class="form-control" name="footer_text" rows="2">{{ $setting->footer_text }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Newsletter Text</label>
                                                <textarea class="form-control" name="newslatter_text" rows="2">{{ $setting->newslatter_text }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Links Section -->
                            <div class="tab-pane fade" id="nav-social" role="tabpanel">
                                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                    <h4 class="fw-bold mb-4">Social Links</h4>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Facebook URL</label>
                                                <input type="url" class="form-control" name="facebook"
                                                    value="{{ $setting->facebook }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Twitter URL</label>
                                                <input type="url" class="form-control" name="twitter"
                                                    value="{{ $setting->twitter }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Instagram URL</label>
                                                <input type="url" class="form-control" name="instagram"
                                                    value="{{ $setting->instagram }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">YouTube URL</label>
                                                <input type="url" class="form-control" name="youtube"
                                                    value="{{ $setting->youtube }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">LinkedIn URL</label>
                                                <input type="url" class="form-control" name="linkedin"
                                                    value="{{ $setting->linkedin }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Pinterest URL</label>
                                                <input type="url" class="form-control" name="pinterest"
                                                    value="{{ $setting->pinterest }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Settings Section -->
                            <div class="tab-pane fade" id="nav-seo" role="tabpanel">
                                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                    <h4 class="fw-bold mb-4">SEO & Meta</h4>
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title"
                                                    value="{{ $setting->meta_title }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Meta Keywords</label>
                                                <input type="text" class="form-control" name="meta_keywords"
                                                    value="{{ $setting->meta_keywords ? (is_array($setting->meta_keywords) ? implode(',', $setting->meta_keywords) : $setting->meta_keywords) : '' }}"
                                                    placeholder="keyword1, keyword2, keyword3">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" rows="4">{{ $setting->meta_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Policies Section -->
                            <div class="tab-pane fade" id="nav-policies" role="tabpanel">
                                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                    <h4 class="fw-bold mb-4">Policies</h4>
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Terms & Conditions</label>
                                                <textarea class="form-control" name="terms_and_conditions" rows="6">{{ $setting->terms_and_conditions }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark small">Privacy Policy</label>
                                                <textarea class="form-control" name="privacy_policy" rows="6">{{ $setting->privacy_policy }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .nav-pills .nav-link {
            color: #6c757d;
            background: transparent;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link:hover {
            background: #f8f9fa;
            color: #4e73df;
        }

        .nav-pills .nav-link.active {
            background: #4e73df;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.25);
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e3e6f0;
            background-color: #fcfcfd;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.05);
        }

        .rounded-4 {
            border-radius: 1.25rem !important;
        }

        .border-dashed {
            border-style: dashed !important;
        }

        body {
            background-color: #f4f7fc;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Logo Preview
        document.getElementById('logo-input').onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById('logo-preview').src = URL.createObjectURL(file);
            }
        }
        // Favicon Preview
        document.getElementById('favicon-input').onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById('favicon-preview').src = URL.createObjectURL(file);
            }
        }
    </script>
@endpush
