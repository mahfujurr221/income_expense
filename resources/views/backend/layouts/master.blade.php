<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Admin Dashboard" name="description" />
    <meta content="Your Company" name="author" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('uploads/' . setting()->favicon) }}">

    <!-- Plugin CSS -->

    <link href="{{ asset('backend/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Preloader CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons CSS -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('backend/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2/bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/summernote/summernote-bs5.min.css') }}">
    <!-- App CSS -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    @stack('css')
</head>

<body>

    <div id="layout-wrapper">

        @include('backend.layouts.includes.header')
        @include('backend.layouts.includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @include('backend.layouts.includes.page-title')

                    @yield('content')

                </div>
            </div>

            @include('backend.layouts.includes.footer')

        </div>
    </div>

    @include('backend.layouts.includes.right-sidebar')

    @if(session('message'))
    <div class="top-0 p-3 position-fixed end-0" style="z-index: 1080">
        <div class="toast align-items-center text-bg-{{ session('message.type') }} border-0 show" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('message.text') }}
                </div>
                <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.querySelector('.toast');
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    });
    </script>
    @endif


    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/libs/feather-icons/feather.min.js') }}"></script>

    <!-- Pace -->
    <script src="{{ asset('backend/libs/pace-js/pace.min.js') }}"></script>
    <!-- ApexCharts -->
    <script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Dashboard Init -->
    <script src="{{ asset('backend/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('backend/js/summernote/summernote-bs5.min.js') }}"></script>
    <script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>
    <!-- App JS -->
    <script src="{{ asset('backend/js/app.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var loader = document.getElementById('loader-wrapper');
            window.addEventListener('load', function() {
                loader.style.display = 'none';
            });
        });
        $(".select2").select2();
    </script>
    <script>
        $('.summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    @stack('scripts')
</body>

</html>