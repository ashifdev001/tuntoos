@extends('layouts.authmaster')
@section('title')
    Login - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>{{env('APP_NAME')}}</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>
                <form>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" id="name" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" id="email" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password" id="c_password" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <button type="submit" id="user_register" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
                {{-- <div class="social-auth-links text-center">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div> --}}
                <a href="{{url('login')}}" class="text-center">I already have a membership</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset('/assets/admin')}}/js/custom/register.js"></script>
@endsection
