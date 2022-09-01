<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf_token" content="{{ csrf_token() }}">
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

      <!-- select2 style-->
      <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

      @yield('styles')

      <!-- DataTables -->
      <link rel="stylesheet" type="text/javascript"
            href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
      <link rel="stylesheet" type="text/javascript"
            href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
      <link rel="stylesheet" type="text/javascript"
            href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

      <!-- admin custome css -->
      <link rel="stylesheet" href="{{ asset('admin_dashboard/css/admin.css') }}">

      <!-- sweetalert2 -->
      <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">

            <x-alerts.alert />

            <x-preloader />

            <x-admin.navbar.navbar />

            <x-admin.navbar.slider />

            <div class="content-wrapper">
                  {{ $slot }}
            </div>

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
      <!-- overlayScrollbars -->

      <!-- AdminLTE App -->
      <script src="{{ asset('admin_dashboard/js/adminlte.min.js') }}"></script>

      <!-- select2 -->
      <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

      <!-- datatable -->
      <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
      <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
      <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
      <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
      <script>
            $.ajaxSetup({
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                  }
            });

            $(function() {
                  $('[data-toggle="tooltip"]').tooltip()
            });

            var loadFile = function(event) {
                  var output = document.getElementById('output');
                  output.src = URL.createObjectURL(event.target.files[0]);
                  output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                  }
            };
      </script>
      @yield('scripts')
</body>

</html>
