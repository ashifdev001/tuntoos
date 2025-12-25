<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('admin/about*') ? 'active' : '' }}" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link  {{ request()->is('admin/about*') ? 'active' : '' }}" data-toggle="dropdown" href="#">
                <span class="logged-user-name"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('admin/about*') ? 'active' : '' }}" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('/assets/admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="" class="img-circle elevation-2 user-image" alt="User Image">
            </div>
            <div class="info">
                {{-- User info --}}
                <a href="{{ url('admin/manage-profile') }}" class="d-block"><span class="logged-user-name"></span></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link  {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('banners') }}" class="nav-link  {{ request()->is('admin/banners*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Banners</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('brands') }}" class="nav-link  {{ request()->is('admin/brands*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Clients</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.franchise') }}" class="nav-link  {{ request()->is('admin/franchise*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>Franchise</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.distributor') }}" class="nav-link  {{ request()->is('admin/distributor*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>distributor</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.flavors') }}" class="nav-link  {{ request()->is('admin/flavors*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>Flavors</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.manage.home') }}" class="nav-link  {{ request()->is('admin/manage-home*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>Manage Home Page</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.teams') }}" class="nav-link  {{ request()->is('admin/teams*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>Teams</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.teams') }}" class="nav-link  {{ request()->is('admin/teams*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>Teams</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.dropdown-items') }}" class="nav-link  {{ request()->is('admin/dropdown-items*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>Dropdown Items</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('testimonials') }}" class="nav-link  {{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p>Testimonials</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('admin.contact') }}" class="nav-link  {{ request()->is('admin/manage-contact*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>Manage Contact</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.about') }}" class="nav-link  {{ request()->is('admin/about*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info"></i>
                        <p>About Us</p>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="{{ route('admin.galleries') }}" class="nav-link {{ request()->is('admin/galleries*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Galleries</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.videos') }}" class="nav-link {{ request()->is('admin/videos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Videos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-enquiries') }}" class="nav-link  {{ request()->is('admin/enquiries*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-question-circle"></i>
                        <p>Enquiries</p>
                    </a>
                </li>
               
                
                <li class="nav-item">
                    <a href="{{ route('general-settings') }}" class="nav-link  {{ request()->is('admin/general-settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>