@extends('layouts.app')
@section('title') Register @endsection
@section('content')
<div class="account-pages mb-md-2 mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="mx-auto mb-5 text-center">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ Helper::assets('assets/images/logo.png') }}" class="site-logo" alt="Logo" />
                                    </a>
                                </div>
                                <h6 class="h5 mb-0 mt-4">Create your account</h6>
                                <p class="text-muted mt-1 mb-4">Create a your account and start using {{env('APP_NAME')}}</p>
                                <form method="POST" action="{{ route('register') }}" class="register-form-validate authentication-form">
                                    @csrf
                                    {{-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">First Name</label>
                                                <input type="text" name="first_name" value="{{ old('first_name')}}" class="form-control @if($errors->has('first_name')) is-invalid @endif" id="first_name" placeholder="First Name" />

                                                @if($errors->has('first_name'))
                                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('first_name') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Last Name</label>
                                                <input type="text" name="last_name" value="{{ old('last_name')}}" class="form-control @if($errors->has('last_name')) is-invalid @endif" id="last_name" placeholder="Last Name" />

                                                @if($errors->has('last_name'))
                                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('last_name') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Name</label>
                                                <input type="text" name="name" value="{{ old('name')}}" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" placeholder="Name" />

                                                @if($errors->has('name'))
                                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('name') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Email</label>
                                                <input type="email" name="email" value="{{ old ('email')}}" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" placeholder="Email" />

                                                @if($errors->has('email'))
                                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('email') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label class="form-control-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" placeholder="*********" required="" name="password" data-error="password-error" aria-required="true" aria-invalid="false">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text show-password">
                                                            <i class="icon-eye" data-show-pass="password" role="button"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="password-error"></div>

                                                @if($errors->has('password'))
                                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('password') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label class="form-control-label">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" id="password_confirmation" placeholder="*********" required="" name="password_confirmation" data-error="password_confirmation-error" aria-required="true" aria-invalid="false">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text show-password">
                                                            <i class="icon-eye" data-show-pass="password_confirmation" role="button"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="password_confirmation-error"></div>

                                                @if($errors->has('password_confirmation'))
                                                <label class="invalid-feedback" role="alert" style="display: inline-block;">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox big checkbox-pink pt-lg-1 mr-4 mb-3">
                                            <input type="checkbox" class="input-validate" name="terms" id="terms" value="1" {{ old('terms') ? 'checked' : '' }} data-error="terms-error">
                                            <label for="terms" class="">
                                                By signing up you agree to our <a href="{{route('terms-conditions')}}" target="_blank" class=" text-underline">Terms and Conditions</a> and <a href="{{ route('privacy-policy') }}" target="_blank" class=" text-underline">Privacy Policy</a>.
                                            </label>
                                        </div>
                                        <div class="terms-error"></div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-grey">Have an account? <a href="{{ route('login') }}" class="text-primary font-weight-medium ml-1 text-underline">Sign in!</a></p>
                    </div> <!-- end col -->
                </div>  <!-- end row -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</div> <!-- end page -->
@endsection
@section('script-bottom')
<script type="text/javascript">
    var exists_url = "{{ route('user.exists') }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/account/register.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
