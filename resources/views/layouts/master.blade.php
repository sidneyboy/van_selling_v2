<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <!-- Font Awesome -->

    <link rel="icon" href="{{ asset('/adminLte/julmar.png') }}" type="image/icon type">
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('/adminLte/ionicon.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('/adminLte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/adminLte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
        href="{{ asset('/adminLte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- Theme style -->
    {{--   <link rel="stylesheet" href="{{ asset('/adminLte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminLte/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('open_layers_libs/v6.5.0/css/ol.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('open_layers_libs/v6.5.0/examples/resources/layout.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('open_layers_libs/ol-layerswitcher/dist/ol-layerswitcher.css') }}" />

    <script src="{{ asset('open_layers_libs/v6.5.0/build/ol.js') }}"></script>
    <script src="{{ asset('open_layers_libs/ol-layerswitcher/dist/ol-layerswitcher.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>


    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('/adminLte/fonts_google.css') }}" rel="stylesheet">


    <style type="text/css">
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 1500ms infinite linear;
            -moz-animation: spinner 1500ms infinite linear;
            -ms-animation: spinner 1500ms infinite linear;
            -o-animation: spinner 1500ms infinite linear;
            animation: spinner 1500ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */
        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        #map {

            width: 100%;
            height: 300px;

        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @section('navbar')
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
        @show
        <!-- Main Sidebar Container -->
        @section('sidebar')
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="../../index3.html" class="brand-link">
                    <img src="{{ asset('/adminLte/julmar.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Julmar Commercials</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('/adminLte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"
                                style="text-transform: uppercase;">{{ $agent_user->full_name }}</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-upload"></i>
                                    <p>
                                        Upload
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('location') }}"
                                            class="nav-link {{ $active == 'location' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                            <p>
                                                Location
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('principal') }}"
                                            class="nav-link {{ $active == 'principal' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                            <p>
                                                Principal
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('van_selling_upload') }}"
                                            class="nav-link {{ $active == 'van_selling_upload' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                            <p>
                                                Inventory
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-list"></i>
                                    <p>
                                        Report
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('van_selling_ledger') }}"
                                            class="nav-link {{ $active == 'van_selling_ledger' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                            <p>
                                                Inventory Ledger
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('van_selling_dsrr') }}"
                                            class="nav-link {{ $active == 'van_selling_dsrr' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                            <p>
                                                DSRR
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('van_selling_transaction_report') }}"
                                            class="nav-link {{ $active == 'van_selling_transaction_report' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                            <p>
                                                Transaction Report
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('van_selling_cancellation_report') }}"
                                            class="nav-link {{ $active == 'van_selling_cancellation_report' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                            <p>
                                                Cancellation Report
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item">
                                <a href="{{ url('van_selling_pre_inventory') }}"
                                    class="nav-link {{ $active == 'van_selling_pre_inventory' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        VS Pre Inventory
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('van_selling_ar_ledger') }}"
                                    class="nav-link {{ $active == 'van_selling_ar_ledger' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        SDA
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ url('van_selling_export_sales') }}"
                                    class="nav-link {{ $active == 'van_selling_export_sales' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        VS Export Sales
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('van_selling_audit_export_sales') }}"
                                    class="nav-link {{ $active == 'van_selling_audit_export_sales' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        VS Audit Export Sales
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('van_selling_customer_list') }}"
                                    class="nav-link {{ $active == 'van_selling_customer_list' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        VS Customer
                                    </p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ url('van_selling_transaction') }}"
                                    class="nav-link {{ $active == 'van_selling_transaction' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Van Selling Transaction
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
        @show
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @section('footer')
            {{-- <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.0.2
                </div>
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer> --}}
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <div class="loading" style="display: none;"></div>

        <script src="{{ asset('adminLte/plugins/jquery/jquery.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('adminLte/jquery_ui.css') }}">

        <script src="{{ asset('adminLte/jquery_ui.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('adminLte/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{ asset('adminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
        <!-- InputMask -->
        <script src="{{ asset('adminLte/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('adminLte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
        <!-- date-range-picker -->
        <script src="{{ asset('adminLte/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- bootstrap color picker -->
        <script src="{{ asset('adminLte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('adminLte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Bootstrap Switch -->
        <script src="{{ asset('adminLte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
        <script src="{{ asset('adminLte/plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('/adminLte/jquery.masknumber.js') }}"></script>
        <script src="{{ asset('/adminLte/plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('/adminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminLte/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminLte/dist/js/demo.js') }}"></script>
        <script src="{{ asset('adminLte/sweet_alert.js') }}"></script>
        <script type="text/javascript" src="{{ asset('adminLte/html2canvas.js') }}"></script>

        <script>
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()
            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })





            $('[class=currency-default]').maskNumber();
            $('[class=currency-data-attributes]').maskNumber();
            $('[class=currency-configuration]').maskNumber({
                decimal: '_',
                thousands: '*'
            });
            $('[class=integer-default]').maskNumber({
                integer: true
            });
            $('[class=integer-data-attribute]').maskNumber({
                integer: true
            });
            $('[class=integer-configuration]').maskNumber({
                integer: true,
                thousands: '_'
            });

            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
            });
        </script>
    @show
