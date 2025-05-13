@extends('layouts.admin')

@php
$is_update = false;
if (isset($surah) && !empty($surah)) {
	$is_update = true;
}
@endphp

@section('title') {{ $is_update ? 'Edit' : 'Add' }} Surah @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Surah</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.surah.update', ['surah' => $surah->id ]) : route('admin.surah.store') }}" class="form-horizontal   surah-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id"  value="{{ $surah->id }}">
                                @method('PATCH')
                            @endif
                            <div class="row mb-2">
                                <div class="col-md-6 form-group">
                                    <label for="title_en">Surah Title (EN)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" name="title_en" id="title_en" value="{{ old('title_en', $is_update ? $surah->title_en : '') }}">
                                    @error('title_en')
                                        <label class="invalid-feedback" for="title_en">{{ $message }}</label>
                                    @enderror
                                </div>
                            
                                <div class="col-md-6 form-group">
                                    <label for="title_ar">Surah Title (AR)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title_ar') is-invalid @enderror" name="title_ar" id="title_ar" dir="rtl" value="{{ old('title_ar', $is_update ? $surah->title_ar : '') }}">
                                    @error('title_ar')
                                        <label class="invalid-feedback" for="title_ar">{{ $message }}</label>
                                    @enderror
                                </div>
                            
                                <div class="col-md-6 form-group">
                                    <label for="total_number">Surah Number <span class="text-danger">*</span></label>
                                    <input type="total_number" class="form-control @error('total_number') is-invalid @enderror" name="total_number" id="total_number" value="{{ old('total_number', $is_update ? $surah->total_number : '') }}">
                                    @error('total_number')
                                        <label class="invalid-feedback" for="total_number">{{ $message }}</label>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12 form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ old('description', $is_update ? $surah->description : '') }}</textarea>
                                    @error('description')
                                        <label class="invalid-feedback" for="description">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            
                           
                            <div class="form-actions center">
                                <a href="{{ route('admin.blogs.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
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
    var exists_url = "{{ route('admin.blogs.exists') }}";
    var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/blogs.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
