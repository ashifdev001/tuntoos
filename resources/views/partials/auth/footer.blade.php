@include('partials.config')
<!-- jQuery -->
<script src="{{asset('/assets/admin')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/assets/admin')}}/dist/js/adminlte.min.js"></script>
<script src="{{asset('/assets/admin')}}/js/common/custom.js"></script>
<script src="{{asset('/assets/admin')}}/js/common/guard.js"></script>
<script src="{{asset('/assets/admin')}}/js/common/auth.js"></script>
<script src="{{asset('/assets/admin')}}/plugins/ladda_loader/jquery.buttonLoader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    ifAuthanticate();
</script>

@yield('scripts')