@extends('layouts.app')

@section('title')Set Password @endsection

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
                                <h6 class="h5 mb-0 mt-4">Set Password</h6>
                                <p class="text-muted mt-1 mb-4">Please setup password to access your account</p>
                                <form action="{{ route('verified') }}" method="post" class="verify-form-validate authentication-form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user }}">
                                    <div class="form-group mt-4">
                                        <label class="form-control-label">New Password</label>
                                        <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" placeholder="New Password" name="password" />

                                        @if($errors->has('password'))
                                        <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('password') }}</label>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Confirm New Password</label>
                                        <input type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" id="password_confirmation" placeholder="Confirm New Password" name="password_confirmation" />

                                        @if($errors->has('password_confirmation'))
                                        <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('password_confirmation') }}</label>
                                        @endif
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-grey">Back to <a href="{{ route('login') }}" class="text-primary font-weight-medium ml-1">Sign in!</a></p>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</div> <!-- end page -->
@endsection
@section('script-bottom')
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/account/verify.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
