<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS -->
    {{--
    <link rel="stylesheet" href="{{ asset('frontend/styles/style.css') }}"> --}}
</head>

<body>

    <div class="dvLayout d-flex flex-column">

        @include('frontend.layouts.includes.header')

        @yield('content')

        @include('frontend.layouts.includes.footer')

        <!-- Custom JS -->
        {{-- <script src="{{ asset('frontend/script/script.js') }}" defer></script> --}}

    </div>

</body>

</html>