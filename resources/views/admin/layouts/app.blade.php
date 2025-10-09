<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- ==========================
         STYLES
    =========================== -->

    <!-- SB Admin 2 core CSS -->
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Font Awesome (gunakan bawaan SB Admin 2 agar stabil) -->
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Optional: Bootstrap Icons (jika diperlukan ikon tambahan) -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"> --}}

    <!-- Custom CSS tambahan dari halaman lain -->
    @stack('styles')
</head>

<body id="page-top">

    <!-- ==========================
         WRAPPER
    =========================== -->
    <div id="wrapper">

        {{-- Sidebar --}}
        @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- Topbar --}}
                @include('admin.layouts.topbar')

                <!-- Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- ==========================
         SCRIPTS
    =========================== -->

    <!-- jQuery (SB Admin 2 dependency) -->
    <script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- SB Admin 2 custom scripts -->
    <script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>

    <!-- Custom JS tambahan dari halaman lain -->
    @stack('scripts')
</body>
</html>
