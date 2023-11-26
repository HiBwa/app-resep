<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('template') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('template') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('template') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('template') }}/vendors/ti-icons/css/themify-icons.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('template') }}/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('template') }}/images/favicon.png" />


</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">

            @include('layouts.header')
            @include('layouts.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('layouts.notif')
                    @yield('konten')
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('template') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('template') }}/vendors/chart.js/Chart.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('template') }}/js/off-canvas.js"></script>
    <script src="{{ asset('template') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('template') }}/js/template.js"></script>
    <script src="{{ asset('template') }}/js/settings.js"></script>
    <script src="{{ asset('template') }}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('template') }}/js/dashboard.js"></script>
    <script src="{{ asset('template') }}/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
