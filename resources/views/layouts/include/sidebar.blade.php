<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin1</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

                <!-- Thống kê doanh thu -->
                <li class="nav-item {{ Request::is('admin/statistics*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/statistics*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Thống kê doanh thu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.statistics') }}"
                                class="nav-link {{ Request::is('admin/statistics') && !Request::query() ? 'active' : '' }}">
                                <i class="far fa-chart-bar nav-icon"></i>
                                <p>Tổng quan</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.statistics.yearly') }}" class="nav-link {{ Request::is('admin/statistics/yearly') ? 'active' : '' }}">
                                <i class="far fa-calendar-alt nav-icon"></i>
                                <p>Doanh thu theo năm</p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.statistics.date-range') }}"
                                class="nav-link {{ Request::is('admin/statistics/date-range') ? 'active' : '' }}">
                                <i class="fas fa-calendar-week nav-icon"></i>
                                <p>Thống kê tùy chọn</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.statistics.top-tours') }}"
                                class="nav-link {{ Request::is('admin/statistics/top-tours') ? 'active' : '' }}">
                                <i class="fas fa-trophy nav-icon"></i>
                                <p>Tour bán chạy</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Tour đã đặt
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Request::segment(1) == 'booking' ? 'menu-is-opening menu-open' : '' }}">
                            <a href="{{ route('booking.index') }}" class="nav-link">
                                <i class="fas fa-calendar-week nav-icon"></i>
                                <p>Danh sách đặt tour</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả các tour</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li
                    class="nav-item {{ Request::segment(1) == 'categories' ? 'menu-is-opening menu-open' : '' }}menu-is-opening menu-open">
                    <a href="{{ route('categories.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Danh mục tour
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" class="nav-link ">
                                <i class="fa-solid fa-gears"></i>
                                <p>Tạo danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link ">
                                <i class="fa-solid fa-gears"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Request::segment(1) == 'tours' ? 'menu-is-opening menu-open' : '' }}menu-is-opening menu-open">
                    <a href="{{ route('categories.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Tours
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('tours.create') }}" class="nav-link ">
                                <i class="fa-solid fa-gears"></i>
                                <p>Thêm Tour</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tours.index') }}" class="nav-link ">
                                <i class="fa-solid fa-gears"></i>
                                <p>Danh sách Tour</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
