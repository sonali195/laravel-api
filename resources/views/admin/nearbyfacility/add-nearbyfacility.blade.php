@extends('layouts.admin')

@php
$is_update = false;
if (isset($nearbyfacility) && !empty($nearbyfacility)) {
	$is_update = true;
}
@endphp

@section('title') {{ $is_update ? 'Edit' : 'Add' }} nearbyfacility @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Nearby Facility</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.nearbyfacility.update', ['nearbyfacility' => $nearbyfacility->id ]) : route('admin.nearbyfacility.store') }}" class="form-horizontal   nearbyfacility-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id"  value="{{ $nearbyfacility->id }}">
                                @method('PATCH')
                            @endif
                            <div class="row mb-2">
                                <div class="col-md-12 form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" value="{{ $is_update ? (old('title') != "" ? old('title') : $nearbyfacility->title) : old('title') }}">
                                        @error('title')
                                            <label id="title-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                            </div>          
                            <div class="row mb-2">
                            <div class="col-md-12 form-group ckeditor">
                                    <label for="description"> Description<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description" id="description" value="{{ $is_update ? (old('description') != "" ? old('description_english') : $nearbyfacility->description) : old('description') }}" rows="10">{{ $is_update ? (old('description') != "" ? old('description') : $nearbyfacility->description) : old('description') }}</textarea>
                                    @error('description')
                                        <label id="description-error" class="invalid-feedback" for="description" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>

                             

                            </div>  
                            <div class="form-actions center">
                                <a href="{{ route('admin.nearbyfacility.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
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
    var exists_url = "{{ route('admin.nearbyfacility.exists') }}";
    var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/nearbyfacility.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection  
  