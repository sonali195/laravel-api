@extends('layouts.admin')

@php
$is_update = false;
if (isset($assistance) && !empty($assistance)) {
    $is_update = true;
}
@endphp

@section('title') {{ $is_update ? 'Edit' : 'Add' }} Assistance @endsection
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
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Assistance</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.assistance.update', ['assistance' => $assistance->id ]) : route('admin.assistance.store') }}" class="form-horizontal assistance-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id" value="{{ $assistance->id }}">
                                @method('PATCH')
                            @endif

                            {{-- Type Dropdown --}}
                            <div class="row mb-2">
                                <div class="col-md-6 form-group">
                                    <label for="assistance_type">Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="assistance_type" id="assistance_type" required>
                                        <option value="">Select Type</option>
                                    <option value="1" {{ old('assistance_type', $is_update ? $assistance->assistance_type : '') == 1 ? 'selected' : '' }}>First Aid</option>
                                    <option value="3" {{ old('assistance_type', $is_update ? $assistance->assistance_type : '') == 3 ? 'selected' : '' }}>Lost and Found</option>
                                    </select>

                                   

                                </div>
                            </div>

                            {{-- Full Name, Contact Name and Description (Always visible) --}}
                            <div class="full-name-info-fields row mb-2">
                                <div class="col-md-12 form-group">
                                    <label for="full_name">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" placeholder="Full Name   " name="full_name" id="full_name" value="{{ $is_update ? (old('full_name') != "" ? old('full_name') : $assistance->full_name) : old('full_name') }}">
                                    @error('full_name')
                                        <label id="full_name-error" class="invalid-feedback" for="full_name" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('contact_number') is-invalid @enderror"
                                    name="contact_number_display" id="contact_number" placeholder="Contact Number"
                                    value="{{ old('contact_number_display', $is_update ? $assistance->contact_number : '') }}">
                             
                             <input type="hidden" name="contact_number" id="full_contact_number"
                                    value="{{ old('contact_number', $is_update ? $assistance->contact_number : '') }}">
                             
                                </div>

                                <div class="col-md-12 form-group ckeditor">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="10">{{ $is_update ? (old('description') != "" ? old('description') : $assistance->description) : old('description') }}</textarea>
                                    @error('description')<label class="invalid-feedback">{{ $message }}</label>@enderror
                                </div>
                            </div>

                            {{-- First Aid Fields --}}
                            <div class="first-aid-fields assistance-type-section" style="display: none;">
                                <!-- No extra fields for First Aid -->
                            </div>

                            {{-- Emergency Info Fields --}}
                            <div class="emergency-info-fields assistance-type-section" style="display: none;">
                                <div class="form-group">
                                    <label>WhatsApp Helpline Number</label>
                                    <input type="text" class="form-control @error('whatsapp_no') is-invalid @enderror" placeholder="WhatsApp Helpline Number" name="whatsapp_no" id="whatsapp_no" value="{{ $is_update ? (old('whatsapp_no') != "" ? old('whatsapp_no') : $assistance->whatsapp_no) : old('whatsapp_no') }}">
                                    @error('whatsapp_no')
                                        <label id="whatsapp_no-error" class="invalid-feedback" for="whatsapp_no" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Safety Rules / Regulations</label>
                                    <textarea class="form-control @error('safety_rules') is-invalid @enderror" name="safety_rules" id="safety_rules" rows="10">{{ $is_update ? (old('safety_rules') != "" ? old('safety_rules') : $assistance->safety_rules) : old('safety_rules') }}</textarea>
                                    @error('safety_rules')<label class="invalid-feedback">{{ $message }}</label>@enderror
                                   
                                </div>
                            </div>

                            {{-- Lost and Found Fields --}}
                            <div class="lost-found-fields assistance-type-section" style="display: none;">
                                <div class="col-md-6 form-group">
                                    <label for="image"> Image <span class="text-danger">*</span></label>
                                    <fieldset>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                            <label class="custom-file-label" for="image">{{ $is_update && $assistance->image != null ? $assistance->image : 'Choose file' }}</label>
                                            <img src="{{ $is_update && $assistance->image != null ? $assistance->image_url : '#' }}" class="custom-file-image" style="display: {{ $is_update && $assistance->image != null ? 'inline-block' : 'none' }};" width="200" />
                                        </div>
                                        <small class="form-text text-muted">Recommended size: Max 2MB. Accepted file formats: png, webp, jpg and jpeg</small>
                                        @if($is_update)
                                        <input type="hidden" name="old_image" id="old_image" value="{{ $assistance->image }}">
                                        @endif
                                        @error('image')
                                            <label id="image-error" class="invalid-feedback" for="image" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-actions center">
                                <a href="{{ route('admin.assistance.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary btn-min-width">{{ $is_update ? 'Update' : 'Save' }}</button>
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
<script>
    
    $(document).ready(function () {
        $('#assistance_type').on('change', function () {
    $('#image').valid(); // Force revalidation of image when type changes
});
function toggleFields() {
    var type = $('#assistance_type').val();
    $('.assistance-type-section').hide(); // Hide all fields initially

    if (type === '1') {
        $('.full-name-info-fields').show();
        // No additional fields for First Aid, so hide all others
        $('#image').prop('required', false); // Image not required for First Aid
            // $('#whatsapp_no').prop('required', false); // WhatsApp is not required for First Aid
            // $('#safety_rules').prop('required', false); // Safety rules not required for First Aid
    } 
    // else if (type === '3') {
    //     $('.full-name-info-fields').hide();
    //     $('.emergency-info-fields').show(); // Show emergency info fields
    //     $('#image').prop('required', false); // Image not required for Emergency Info
    //     $('#full_name').prop('required', false); // Full Name not required for Emergency Info
    //     $('#contact_number').prop('required', false); // Contact Number not required for Emergency Info
    //     $('#description').prop('required', false); // Description not required for Emergency Info
    //     $('#whatsapp_no').prop('required', true); // WhatsApp is required for Emergency Info
    //     $('#safety_rules').prop('required', true); // Safety rules are required for Emergency Info
    // } 
    else if (type === '3') {
        $('.full-name-info-fields').show();
        $('.lost-found-fields').show(); // Show lost and found fields
        $('#image').prop('required', true); // Image required for Lost and Found
        $('#whatsapp_no').prop('required', false); // WhatsApp is not required for Lost and Found
        $('#safety_rules').prop('required', false); // Safety rules are not required for Lost and Found
    }
}
        $('#assistance_type').on('change', toggleFields); // Listen for type change
        toggleFields(); // Run on page load
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js"></script>
<script>
        $('#contact_number').on('input', function() {
             this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
    });
    document.addEventListener("DOMContentLoaded", function () {
            const input = document.querySelector("#contact_number");
            const fullNumberInput = document.querySelector("#full_contact_number");

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
<script type="text/javascript">
    var exists_url = "{{ route('admin.assistance.exists') }}";
    var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/assistance.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
