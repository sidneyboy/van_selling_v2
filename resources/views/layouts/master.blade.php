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
                <!-- SEARCH FORM -->
                {{-- <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}
                <!-- Right navbar links -->
                {{-- <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ asset('/adminLte/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ asset('/adminLte/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ asset('/adminLte/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout_page') }}" style="font-weight: bold;color:white;">
                            LOGOUT
                        </a>
                    </li>
                </ul> --}}
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
                            <!-- Add icons to the links using the .nav-icon class
                          with font-awesome or any other icon font library -->
                            {{--  <li class="nav-item">
                <a href="{{ url('home') }}"  class="nav-link {{ $active == 'home' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Agent Profile
                    <span class="right badge badge-danger">New</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('sku_inventory') }}"  class="nav-link {{ $active == 'sku_inventory' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Sku_Inventory
                  </p>
                </a>
              </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('customer') }}"
                                    class="nav-link {{ $active == 'customer' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Upload new Customer
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('customer_data') }}"
                                    class="nav-link {{ $active == 'customer_data' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Customer List & Profile
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                <a href="{{ url('sales_register') }}"  class="nav-link {{ $active == 'sales_register' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Upload Sales Register
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('ar_ledger_upload') }}"  class="nav-link {{ $active == 'ar_ledger_upload' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Upload AR Control
                  </p>
                </a>
              </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('location') }}"
                                    class="nav-link {{ $active == 'location' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Upload new Location
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('principal') }}"
                                    class="nav-link {{ $active == 'principal' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Upload new Principal
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                <a href="{{ url('daily_routine') }}"  class="nav-link {{ $active == 'daily_routine' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Work-Flow
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('bad_order') }}"  class="nav-link {{ $active == 'bad_order' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Bad Order
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('collection_upload_image') }}"  class="nav-link {{ $active == 'collection_upload_image' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Collection Upload Image
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('summary_of_transaction_ledger') }}"  class="nav-link {{ $active == 'summary_of_transaction_ledger' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Summary of Transactions
                  </p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ url('remitances_locpd') }}"  class="nav-link {{ $active == 'remitances_locpd' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Remitances
                  </p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ url('locpd') }}"  class="nav-link {{ $active == 'locpd' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Locpd
                  </p>
                </a>
              </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('van_selling_upload') }}"
                                    class="nav-link {{ $active == 'van_selling_upload' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Van Selling Upload
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('van_selling_ledger') }}"
                                    class="nav-link {{ $active == 'van_selling_ledger' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Van Selling Ledger
                                    </p>
                                </a>
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
                            {{-- <li class="nav-item">
                <a href="{{ url('van_selling_remittance') }}"  class="nav-link {{ $active == 'van_selling_remittance' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    VS Remittance
                  </p>
                </a>
              </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('van_selling_transaction_report') }}"
                                    class="nav-link {{ $active == 'van_selling_transaction_report' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        VS Transaction Report
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('van_selling_cancellation_report') }}"
                                    class="nav-link {{ $active == 'van_selling_cancellation_report' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        VS Cancellation Report
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
                                <a href="{{ url('van_selling_dsrr') }}"
                                    class="nav-link {{ $active == 'van_selling_dsrr' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        VS DSRR
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('van_selling_price_update') }}"
                                    class="nav-link {{ $active == 'van_selling_price_update' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Van Selling U/P Update
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                <a href="{{ url('bo_outright') }}"  class="nav-link {{ $active == 'bo_outright' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    BO Outright
                  </p>
                </a>
              </li> --}}
                            {{-- <li class="nav-item">
                <a href="{{ url('bo_outright_reports') }}"  class="nav-link {{ $active == 'bo_outright_reports' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    BO Outright Reports
                  </p>
                </a>
              </li> --}}
                            {{-- <li class="nav-item">
                <a href="{{ url('van_selling_customer') }}"  class="nav-link {{ $active == 'van_selling_customer' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    VS Customer
                  </p>
                </a>
              </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('van_selling_transaction') }}"
                                    class="nav-link {{ $active == 'van_selling_transaction' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Van Selling Transaction
                                    </p>
                                </a>
                            </li>
                            {{--  <li class="nav-item">
                <a href="{{ url('van_selling_adjustments') }}"  class="nav-link {{ $active == 'van_selling_adjustments' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    VS Sku Adjustments
                  </p>
                </a>
              </li> --}}
                            {{-- <li class="nav-item">
                <a href="{{ url('van_selling_credit_memo') }}"  class="nav-link {{ $active == 'van_selling_credit_memo' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Van Selling CM
                  </p>
                </a>
              </li> --}}
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
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.0.2
                </div>
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>
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
