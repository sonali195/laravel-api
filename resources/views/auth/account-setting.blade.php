@extends('layouts.app')

@section('css')
{{-- <link href="{{ Helper::assets('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">Account settings</h4>
    </div>
</div>
@endsection
@php
    $is_update = false;
    if(isset($user) && !empty($user)){
        $is_update = true;
    }
@endphp
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <h5 class="font-size-18 pb-1">General details</h5>
                </div>
                <div class="mt-4">
                    <form method="POST" action="{{ route('user.account.setting.save') }}" class="account-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-xl-4 col-form-label">First Name</label>
                                    <div class="col-xl-7">
                                        <input type="text" class="form-control input-validate" name="firstName" value="{{ $is_update  ? $user->user->firstName : old('firstName') }}">
                                        @if($errors->has('firstName'))
                                        <label id="firstName-error" class="invalid-feedback" for="firstName" style="display: inline-block;">{{ $errors->first('firstName') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-4 col-form-label">Last Name</label>
                                    <div class="col-xl-7">
                                        <input type="text" class="form-control input-validate" name="lastName" value="{{ $is_update  ? $user->user->lastName : old('lastName') }}">
                                        @if($errors->has('lastName'))
                                        <label id="lastName-error" class="invalid-feedback" for="lastName" style="display: inline-block;">{{ $errors->first('lastName') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-4 col-form-label">Email</label>
                                    <div class="col-xl-7">
                                        <input type="text" class="form-control input-validate" name="email" value="{{ $is_update  ? $user->user->email : old('email') }}" readonly>
                                        @if($errors->has('email'))
                                        <label id="email-error" class="invalid-feedback" for="email" style="display: inline-block;">{{ $errors->first('email') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row align-items-center">
                                    <div class="col-md px-0 upload-image">
                                        <div class="d-inline-block school-logo-box mr-md-4 mr-2 mb-3 mb-md-2 p-0">
                                            <img src="{{ $is_update  ? $user->user->profileImage : '' }}" data-src="{{ Helper::assets('assets/images/default-big-logo.png') }}" class="img-fluid">
                                        </div>
                                        <button class="btn btn-pink mr-2 mb-2 btn-upload" type="button">Upload new image</button>
                                        <input type="file" class=" input-validate" name="profileImage" id="profileImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-min-width">Update details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <h5 class="font-size-18 pb-1">Change password</h5>
                </div>
                <div class="mt-4">
                    <form method="POST" action="{{ route('user.update.password') }}" class="account-update-password-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-xl-4 col-form-label">Current password</label>
                                    <div class="col-xl-8">
                                        <input type="password" class="form-control input-validate" name="oldPassword" value="{{ old('oldPassword') }}">
                                        @if($errors->has('oldPassword'))
                                        <label id="oldPassword-error" class="invalid-feedback" for="oldPassword" style="display: inline-block;">{{ $errors->first('oldPassword') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-4 col-form-label">New password</label>
                                    <div class="col-xl-8">
                                        <input type="password" class="form-control input-validate" id="newPassword" name="newPassword" value="{{ old('newPassword') }}">
                                        @if($errors->has('newPassword'))
                                        <label id="newPassword-error" class="invalid-feedback" for="newPassword" style="display: inline-block;">{{ $errors->first('newPassword') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-4 col-form-label">Confirm password</label>
                                    <div class="col-xl-8">
                                        <input type="password" class="form-control input-validate" name="confirmPassword" value="{{ old('confirmPassword') }}">
                                        @if($errors->has('confirmPassword'))
                                        <label id="confirmPassword-error" class="invalid-feedback" for="confirmPassword" style="display: inline-block;">{{ $errors->first('confirmPassword') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-min-width">Update password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/account/account.js') }}?v={{config('constant.asset_version')}}"></script>
<script>

</script>
@endsection
