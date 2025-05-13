@extends('layouts.admin')

@php
$is_update = false;
if(isset($user)){
    $is_update = true;
}
$Countries = Helper::getCountry();
@endphp
@section('title') {{ $is_update ? 'Edit' : 'Add' }} user @endsection

@section('css')
<link href="{{ Helper::assets('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} user</h4>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('content')
<div class="content-body">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card border-info border-bottom-2">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form method="POST" action="{{ $is_update ? route('admin.user.update', $user->id) : route('admin.user.store') }}" class="form-horizontal form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            @method('PUT')
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ ($is_update ? $user->name : old('name'))}}">
                                    @error('name')
                                        <label id="name-error" class="invalid-feedback" for="name" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ ($is_update ? $user->email : old('email'))}}" @if($is_update) disabled @endif>
                                    @error('email')
                                        <label id="email-error" class="invalid-feedback" for="email" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="form-control-label">Phone number<span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="form-group col-md-4 pr-md-0">
                                                <select class="select2-custom" id="country_code" name="country_code">
                                                    <option value="">Select</option>
                                                    @foreach ($Countries as $country)
                                                    <option value="{{$country->isd_code}}" {{ old('country_code', ($is_update ? $user->country_code : config('constant.default_country_code'))) == $country->isd_code ? "selected" : "" }}>{{$country->isd_code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_code')
                                                    <label id="country_code-error" class="invalid-feedback" for="country_code" style="display: inline-block;">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="col-md-8 form-group pl-md-0">
                                                <input type="phone_number" name="phone_number" value="{{ old('phone_number', ($is_update ? $user->phone_number : '')) }}" class="form-control @if($errors->has('phone_number')) is-invalid @endif" id="phone_number" placeholder="Phone number"/>

                                                @if($errors->has('phone_number'))
                                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('phone_number') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="photo"> Profile picture</label>
                                    <fieldset>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                                            <label class="custom-file-label" for="photo">{{ $is_update && $user->photo != "" ? $user->photo : 'Choose file' }}</label>
                                            <img src="{{ $is_update && $user->photo != "" ? $user->photo_url : '#' }}" class="custom-file-image" style="display: {{ $is_update && $user->photo != "" ? 'inline-block' : 'none' }};" />
                                        </div>
                                        <small class="form-text text-muted">Recommended size: Max 2MB. Accepted file formats: png, jpg and jpeg</small>
                                        @if($is_update)
                                        <input type="hidden" name="old_photo" id="old_photo" value="{{ $user->photo }}">
                                        @endif
                                        @error('photo')
                                            <label id="flag-error" class="invalid-feedback" for="photo" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-actions center">
                                <a href="{{ route('admin.user.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary btn-min-width">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script defer src="{{ Helper::assets('assets/libs/select2/select2.full.min.js')}}"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection

@section('script-bottom')
<script type="text/javascript">
    var exists_url = "{{ route('admin.user.exists') }}";
</script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/user.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
