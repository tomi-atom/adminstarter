<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | {{ __('Admin area') }}</title>

        <x-shared.ico />
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet"
            href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- jQuery -->
        <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
        <link rel="stylesheet" href={{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"') }}>

        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
        <!-- BS Stepper -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/bs-stepper/css/bs-stepper.min.css') }}">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/min/dropzone.min.css') }}">
        @stack('css')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <x-backend.shareds.top-bar />
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">

                <x-backend.shareds.side-menu-logo />

                <!-- Sidebar -->
                <div class="sidebar">

                    <x-backend.shareds.side-menu-panel />

                    <!-- Sidebar Menu -->
                    <x-backend.shareds.side-menu />
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            @yield('breadcump')
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('main')
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <x-backend.shareds.bottom-bar />
        </div>
        <!-- ./wrapper -->

        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)

        </script>
        <script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
        </script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin') }}/dist/js/adminlte.js"></script>
        <script src="{{ asset('admin') }}plugins/inputmask/jquery.inputmask.min.js"></script>
        <!-- date-range-picker -->
        <script src="{{ asset('admin') }}plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="{{ asset('admin') }}plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>


        <!-- Summernote -->
        <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
        @stack('js')
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        @stack('scripts')
    </body>

</html>
