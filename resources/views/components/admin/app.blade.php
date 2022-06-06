<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name ="csrf_token" content = "{{ csrf_token() }}">
      <title>EducationForFree | {{ $title }}</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

      <!-- iCheck for checkboxes and radio inputs -->
      <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('admin_dashboard/css/adminlte.min.css') }}">

      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

      <!-- admin cusome css -->
      <link rel="stylesheet" href="{{ asset('admin_dashboard/css/admin.css') }}">

      <!-- sweetalert2 -->
      <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>



</head>

<body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">

            {{-- sweet alert2 --}}
            <x-alerts.alert />

            {{-- preloader --}}
            <x-preloader />

            <!-- Navbar -->
            <x-admin.navbar.navbar />

            <!-- Main Sidebar Container -->
            <x-admin.navbar.slider />

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                  {{ $slot }}
            </div>
            <!-- /.content-wrapper -->

            {{-- footer --}}
            <x-admin.footer />
      </div>
      <!-- ./wrapper -->

      <!-- jQuery -->
      <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
            $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

      <!-- overlayScrollbars -->
      <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

      <!-- AdminLTE App -->
      <script src="{{ asset('admin_dashboard/js/adminlte.min.js') }}"></script>

      @yield('scripts')
</body>

</html>
