<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">


</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.home') }}" class="nav-link">Home</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Add Logout Button -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('layouts.include.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        {{-- <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer> --}}
    </div>
    <!-- ./wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        <!-- REQUIRED SCRIPTS -->
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('backend/dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('backend/dist/js/pages/dashboard3.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI/jquery-ui.multidatespicker.js">
    </script>
    <script src=" //cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <!-- AdminLTE for demo purposes -->
    @stack('scripts')
    <script>
        // AdminLTE dashboard demo (This is only for demo purposes)
        let table = new DataTable('#myTable');
    </script>
    <script>
        $(function() {
            const today = new Date();
            const minDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

            $("#departure_date").datepicker({
                dateFormat: "dd-mm-yy",
                minDate: minDate, // Disable past dates
                onClose: function(selectedDate) {
                    // Set the minimum date for return date
                    $("#return_date").datepicker("option", "minDate", selectedDate);
                }
            });
            $("#return_date").datepicker({
                dateFormat: "dd-mm-yy",
                minDate: minDate // Disable past dates
            }).on("close", function(selectedDate) {
                // Set the minimum date for return date
                $("#return_date").datepicker("option", "minDate", selectedDate);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#departure_dates").multiDatesPicker({
                dateFormat: "dd-mm-yy",
                minDate: 0 // Disable past dates
            });
        });
    </script>
    {{-- <script>
        $(function() {
            $("#departure_date").datepicker();
            $("#return_date").datepicker();
        });
    </script> --}}
    <script type="text/javascript">
        CKEDITOR.replace('lichtrinh');
        CKEDITOR.replace('chinhsach');
        CKEDITOR.replace('baogom');
        CKEDITOR.replace('khongbaogom');

        function validateForm() {
            // Ensure CKEditor updates textarea values
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            // Get values
            var lichtrinhValue = document.getElementById("lichtrinh").value.trim();
            var chinhsachValue = document.getElementById("chinhsach").value.trim();
            var baogomValue = document.getElementById("baogom").value.trim();
            var khongbaogomValue = document.getElementById("khongbaogom").value.trim();

            // Check if empty
            if (lichtrinhValue === "") {
                alert("Yêu cầu điền lịch trình.");
                return false;
            }
            if (chinhsachValue === "") {
                alert("Yêu cầu điền chính sách.");
                return false;
            }
            if (baogomValue === "") {
                alert("Yêu cầu điền bao gồm.");
                return false;
            }
            if (khongbaogomValue === "") {
                alert("Yêu cầu điền không bao gồm.");
                return false;
            }
            return true; // Allow form submission
        }
    </script>
    @php
        $categories = App\Models\Category::where('category_parent', 0)->get();
    @endphp
    <li class="nav-item dropdown">
        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Danh mục tour
        </a> --}}
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($categories as $category)
                <li>
                    <a class="dropdown-item" href="{{ route('categories.subcategories', $category->id) }}">
                        {{ $category->title }}
                    </a>
                    @if ($category->childCategories->count() > 0)
                        <ul class="dropdown-menu dropdown-submenu">
                            @foreach ($category->childCategories as $child)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('categories.subcategories', $child->id) }}">
                                        {{ $child->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </li>
    <style>
        .dropdown-menu li {
            position: relative;
        }

        .dropdown-menu .dropdown-submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .dropdown-menu>li:hover>.dropdown-submenu {
            display: block;
        }

        .dropdown-menu .dropdown-submenu-left {
            right: 100%;
            left: auto;
        }

        .nav-item form {
            display: block;
            margin: 0;
            padding: 0;
        }

        .nav-item form button {
            color: #007bff;
            text-decoration: none;
            padding: 8px;
        }

        .nav-item form button:hover {
            color: #0056b3;
        }
    </style>
</body>

</html>
