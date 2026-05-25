@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 text-center no-print">
                <h3>Employee ID Cards</h3>
                <button onclick="window.print()" class="btn btn-primary">Print Cards</button>
            </div>
        </div>

        <!-- Print Area -->
        <div class="row">
            @foreach ($employees as $emp)
                <div class="col-md-4 mb-4">
                    <div class="card id-card border-2" style="max-width: 350px; margin: 0 auto; border: 1px solid #ddd;">
                        <div class="card-body text-center p-4">
                            <!-- Header -->
                            <div class="mb-3">
                                <h5 class="fw-bold text-uppercase mb-0">income-expense</h5>
                                <small class="text-muted">Employee ID Card</small>
                            </div>

                            <!-- Photo Placeholder -->
                            <div class="mb-3">
                                <div
                                    style="width: 100px; height: 100px; background-color: #f0f0f0; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; color: #aaa;">
                                    {{ substr($emp['name'], 0, 1) }}
                                </div>
                            </div>

                            <!-- Details -->
                            <h5 class="fw-bold mb-1">{{ $emp['name'] }}</h5>
                            <p class="text-primary fw-bold mb-1">{{ $emp['role'] }}</p>
                            <p class="small text-muted mb-3">{{ $emp['dept'] }}</p>

                            <!-- ID and QR -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <div class="text-start">
                                    <small class="d-block text-muted">ID Number</small>
                                    <span class="fw-bold font-monospace">{{ $emp['id'] }}</span>
                                </div>
                                <div class="qr-area text-center">
                                    <!-- Generate QR Code pointing to public profile -->
                                    <!-- Ensure simplesoftwareio/simple-qrcode is installed -->
                                    {!! QrCode::size(70)->generate(route('frontend.member.show', $emp['id'])) !!}
                                    <div class="mt-1 no-print">
                                        <a href="{{ route('download.qrcode', $emp['id']) }}"
                                            class="text-dark small text-decoration-none" title="Download SVG">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                <path
                                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                            </svg> SVG
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            .id-card {
                break-inside: avoid;
                border: 1px solid #000 !important;
            }

            body {
                background: white;
            }
        }
    </style>
@endsection
