<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.header')
</head>

<body class="hold-transition login-page">
    <div class="wrapper" style="width: 100%;">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('/assets/admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('partials.sidebar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark" style="display: block;">
            <!-- Control sidebar content goes here -->
            <div class="p-3 control-sidebar-content" style="">
                <h5>{{ env('APP_NAME') }}</h5>
                <hr class="mb-2">
                <div class="mb-4">
                    <a class="dropdown-item" href="{{ url('/admin/manage-profile') }}">Manage profile</a>
                </div>
                <div class="mb-4">
                    <a id="user-logout" class="dropdown-item text-uppercase">logout</a>
                </div>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('partials.footer')
    </div>
    @include('partials.scripts')
    <!-- /.login-box -->
</body>

</html>
