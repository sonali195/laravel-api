@extends('layouts.app')
@section('title') Sign In @endsection
@section('content')
<div class="account-pages mb-md-2 mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="mx-auto mb-5 text-center">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ Helper::assets('assets/images/logo.png') }}" class="site-logo" alt="Logo" />
                                    </a>
                                </div>
                                <h6 class="h5 mb-0 mt-4">Welcome back!</h6>
                                <p class="text-muted mt-1 mb-4">Enter your email address and password to access your account.</p>
                                <form action="{{ route('login') }}" method="post" class="login-form-validate authentication-form">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" placeholder="Email" name="email" value="{{ old('email')}}" required />

                                        @if($errors->has('email'))
                                            <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('email') }}</label>
                                        @endif
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Password</label>
                                        <a href="{{ route('password.request') }}" class="float-right text-grey ml-1">Forgot password?</a>

                                        <div class="input-group @if($errors->has('password')) invalid-feedback @endif">
                                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" placeholder="*********" name="password" required data-error="password-error" aria-required="true" aria-invalid="false">
                                            <div class="input-group-append">
                                                <span class="input-group-text show-password">
                                                    <i class="icon-eye" data-show-pass="password" role="button"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="password-error">
                                            @if($errors->has('password'))
                                            <label id="password-error" class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('password') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="form-group mb-4">
                                        <div class="checkbox big checkbox-primary pt-lg-1 mr-4 mb-3">
                                            <input type="checkbox" class="input-validate" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember" class="pt-2">
                                                Remember me
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Sign in </button>
                                    </div>
                                    <div class="form-group mb-0 text-center pt-3 d-none" id="support">
                                        <span class="text-danger">* Please use Chrome, Firefox or Safari for the best user experience</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div><!-- end card -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-grey">Don't have an account? <a href="{{ route('register') }}" class="text-primary font-weight-medium ml-1 text-underline">Sign up!</a></p>
                    </div> <!-- end col -->
                </div><!-- end row -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- end container -->
</div><!-- end page -->
@endsection
@section('script-bottom')
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/account/login.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
