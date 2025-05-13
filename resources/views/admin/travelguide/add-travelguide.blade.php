@extends('layouts.admin')

@php
$is_update = false;
if (isset($travelguide) && !empty($travelguide)) {
	$is_update = true;
}
@endphp

@section('title') {{ $is_update ? 'Edit' : 'Add' }} travelguide @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Travel Guide</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.travelguide.update', ['travelguide' => $travelguide->id ]) : route('admin.travelguide.store') }}" class="form-horizontal   travel-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id"  value="{{ $travelguide->id }}">
                                @method('PATCH')
                            @endif
                            <div class="row mb-2">
                            <div class="col-md-12 form-group">
                                <label for="type">Type <span class="text-danger">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" name="type" id="type" required>
                                    <option value="">Select Type</option>
                                    <option value="1" {{ old('type', $is_update ? $travelguide->type : '') == 1 ? 'selected' : '' }}>Ziyarat</option>
                                    <option value="2" {{ old('type', $is_update ? $travelguide->type : '') == 2 ? 'selected' : '' }}>Dua</option>
                                    <option value="3" {{ old('type', $is_update ? $travelguide->type : '') == 3 ? 'selected' : '' }}>A'maal</option>
                                </select>
                                @error('type')
                                    <label class="invalid-feedback" for="type">{{ $message }}</label>
                                @enderror
                            </div>
                                <div class="col-md-12 form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" value="{{ $is_update ? (old('title') != "" ? old('title') : $travelguide->title) : old('title') }}">
                                    @error('title')
                                        <label id="title-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group ckeditor">
                                    <label for="description_english"> Description  English<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description_english') is-invalid @enderror" placeholder="Description" name="description_english" id="description_english" value="{{ $is_update ? (old('description_english') != "" ? old('description_english') : $travelguide->description_english) : old('description_english') }}" rows="10">{{ $is_update ? (old('description_english') != "" ? old('description_english') : $travelguide->description_english) : old('description_english') }}</textarea>
                                    @error('description_english')
                                        <label id="description-error" class="invalid-feedback" for="description" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group ckeditor">
                                    <label for="description_urdu"> Description  Urdu<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description_urdu') is-invalid @enderror" placeholder="Description" name="description_urdu" id="description_urdu" value="{{ $is_update ? (old('description_urdu') != "" ? old('description_urdu') : $travelguide->description_urdu) : old('description_urdu') }}" rows="10">{{ $is_update ? (old('description_urdu') != "" ? old('description_urdu') : $travelguide->description_urdu) : old('description_urdu') }}</textarea>
                                    @error('description_urdu')
                                        <label id="description-error" class="invalid-feedback" for="description" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group ckeditor">
                                    <label for="description_gujarati"> Description Gujarati<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description_gujarati') is-invalid @enderror" placeholder="Description" name="description_gujarati" id="description_gujarati" value="{{ $is_update ? (old('description_gujarati') != "" ? old('description') : $travelguide->description_gujarati) : old('description_gujarati') }}" rows="10">{{ $is_update ? (old('description_gujarati') != "" ? old('description_gujarati') : $travelguide->description_gujarati) : old('description_gujarati') }}</textarea>
                                    @error('description')
                                        <label id="description-error" class="invalid-feedback" for="description_gujarati" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group ckeditor">
                                    <label for="description_arbian"> Description Arbian<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description_arbian') is-invalid @enderror" placeholder="Description" name="description_arbian" id="description_arbian" value="{{ $is_update ? (old('description_arbian') != "" ? old('description_arbian') : $travelguide->description_arbian) : old('description_arbian') }}" rows="10">{{ $is_update ? (old('description_arbian') != "" ? old('description_arbian') : $travelguide->description_arbian) : old('description_arbian') }}</textarea>
                                    @error('description_arbian')
                                        <label id="description-error" class="invalid-feedback" for="description_arbian" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <!-- <div class="col-md-6 form-group">
                                    <label for="image"> Image <span class="text-danger">*</span></label>
                                    <fieldset>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                            <label class="custom-file-label" for="image">{{ $is_update && $travelguide->image != null ? $travelguide->image : 'Choose file' }}</label>
                                            <img src="{{ $is_update && $travelguide->image != null ? $travelguide->image_url : '#' }}" class="custom-file-image" style="display: {{ $is_update && $travelguide->image != null ? 'inline-block' : 'none' }};" width="200" />
                                        </div>
                                        <small class="form-text text-muted">Recommended size: Max 2MB. Accepted file formats: png, webp, jpg and jpeg</small>
                                        @if($is_update)
                                        <input type="hidden" name="old_image" id="old_image" value="{{ $travelguide->image }}">
                                        @endif
                                        @error('image')
                                            <label id="image-error" class="invalid-feedback" for="image" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </fieldset>
                                </div> -->
                            </div>
                           
                            <div class="form-actions center">
                                <a href="{{ route('admin.travelguide.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
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
<script type="text/javascript">
    var exists_url = "{{ route('admin.travelguide.exists') }}";
    var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/travelguide.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection  
  