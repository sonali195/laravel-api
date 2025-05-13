@extends('layouts.admin')

@php
$is_update = false;
if(isset($settings)){
    $is_update = true;
}
@endphp

@section('title') Settings @endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/css/intlTelInput.min.css"/>
<style> 
    .iti {
        width: 100%;
    }
    .lost-found-fields.assistance-type-section {
    height: 196px !important;
}
</style>
@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <h4 class="mb-1 mt-0 font-weight-medium">Application settings</h4>
    </div>
</div>
@endsection

@section('content')
<div class="content-body">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card border-info border-bottom-2">
                <div class="card-content collapse show">  
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.save.settings') }}" class="form-horizontal settings-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                            <input type="hidden" name="id" value="{{ $settings->id }}">
                            @endif

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="contact_number">Current Contact Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('whatsApp_no') is-invalid @enderror"
                                    name="whatsApp_no_display" id="whatsApp_no" placeholder="Current Contact Number"
                                    value="{{ old('whatsApp_no_display', $is_update ? $settings->whatsApp_no : '') }}">
                             
                                    <input type="hidden" name="whatsApp_no" id="full_whatsApp_no"
                                            value="{{ old('whatsApp_no', $is_update ? $settings->whatsApp_no : '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="android_version"> Android Version <span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control @error('android_version') is-invalid @enderror" placeholder="Android Version" name="android_version" id="android_version" value="{{ $is_update ? (old('android_version') != "" ? old('android_version') : $settings->android_version) : old('android_version') }}">
                                    @error('android_version')
                                        <label id="android_version-error" class="invalid-feedback" for="android_version" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ios_version"> iOS Version <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('ios_version') is-invalid @enderror" placeholder="iOS Version" name="ios_version" id="ios_version" value="{{ $is_update ? (old('ios_version') != "" ? old('ios_version') : $settings->ios_version) : old('ios_version') }}">
                                    @error('ios_version')
                                        <label id="ios_version-error" class="invalid-feedback" for="ios_version" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="form-group col-md-12">
                                    <label for="safety_rules"> Safety rules/regulations <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('safety_rules') is-invalid @enderror" placeholder="safety Rules" name="safety_rules" id="safety_rules" value="{{ $is_update ? (old('safety_rules') != "" ? old('safety_rules') : $settings->safety_rules) : old('safety_rules') }}" rows="10">{{ $is_update ? (old('safety_rules') != "" ? old('safety_rules') : $settings->safety_rules) : old('safety_rules') }}</textarea>
                                    @error('safety_rules')
                                        <label id="safety_rules-error" class="invalid-feedback" for="safety_rules" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="android_force_update">Android Force Update?</label>
                                    <div class="switchToggle profile-switch">
                                        <input type="checkbox" id="android_force_update" name="android_force_update" class="android_force_update" value="1" data-error="android_force_update-error" {{ ($is_update && $settings->android_force_update == 1) || old('android_force_update') ? 'checked' : '' }}>
                                        <label for="android_force_update">Toggle</label>
                                    </div>
                                    @error('android_force_update')
                                        <label id="android_force_update-error" class="invalid-feedback" for="android_force_update" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ios_force_update">iOS Force Update?</label>
                                    <div class="switchToggle profile-switch">
                                        <input type="checkbox" id="ios_force_update" name="ios_force_update" class="ios_force_update" value="1" data-error="ios_force_update-error" {{ ($is_update && $settings->ios_force_update == 1) || old('ios_force_update') ? 'checked' : '' }}>
                                        <label for="ios_force_update">Toggle</label>
                                    </div>
                                    @error('ios_force_update')
                                        <label id="ios_force_update-error" class="invalid-feedback" for="ios_force_update" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 mt-3">
                                    <label for="under_maintenance">Under maintenance (Android, iOS)</label>
                                    <div class="switchToggle profile-switch">
                                        <input type="checkbox" id="under_maintenance" name="under_maintenance" class="under_maintenance" value="1" data-error="under_maintenance-error" {{ ($is_update && $settings->under_maintenance == 1) || old('under_maintenance') ? 'checked' : '' }}>
                                        <label for="under_maintenance">Toggle</label>
                                    </div>
                                    @error('under_maintenance')
                                    <label id="under_maintenance-error" class="invalid-feedback" for="under_maintenance" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-actions center">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-md btn-danger btn-min-width mr-1"> {{ __('Cancel') }} </a>
                                <button type="submit" class="btn btn-primary btn-min-width">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js"></script>
<script>
        $('#whatsApp_no').on('input', function() {
             this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
    });
    document.addEventListener("DOMContentLoaded", function () {
            const input = document.querySelector("#whatsApp_no");
            const fullNumberInput = document.querySelector("#full_whatsApp_no");

            const iti = window.intlTelInput(input, {
                initialCountry: "in",
                separateDialCode: true,
                nationalMode: false,
                preferredCountries: ["in", "us", "gb"],
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js"
            });

            // Set full number on load (for edit case)
            if (input.value) {
                fullNumberInput.value = iti.getNumber();
            }

            // Set full number on change
            input.addEventListener("blur", function () {
                fullNumberInput.value = iti.getNumber();
            });

            input.addEventListener("keyup", function () {
            fullNumberInput.value = iti.getNumber();
        });
    });
</script>  
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/settings.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
