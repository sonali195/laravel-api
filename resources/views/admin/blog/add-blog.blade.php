@extends('layouts.admin')

@php
$is_update = false;
if (isset($blog) && !empty($blog)) {
	$is_update = true;
}
@endphp

@section('title') {{ $is_update ? 'Edit' : 'Add' }} Blog @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Blog</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.blogs.update', ['blog' => $blog->id ]) : route('admin.blogs.store') }}" class="form-horizontal   blog-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id"  value="{{ $blog->id }}">
                                @method('PATCH')
                            @endif
                            <div class="row mb-2">
                                <div class="col-md-12 form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" value="{{ $is_update ? (old('title') != "" ? old('title') : $blog->title) : old('title') }}">
                                    @error('title')
                                        <label id="title-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group ckeditor">
                                    <label for="description"> Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description" id="description" value="{{ $is_update ? (old('description') != "" ? old('description') : $blog->description) : old('description') }}" rows="10">{{ $is_update ? (old('description') != "" ? old('description') : $blog->description) : old('description') }}</textarea>
                                    @error('description')
                                        <label id="description-error" class="invalid-feedback" for="description" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="image"> Image <span class="text-danger">*</span></label>
                                    <fieldset>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                            <label class="custom-file-label" for="image">{{ $is_update && $blog->image != null ? $blog->image : 'Choose file' }}</label>
                                            <img src="{{ $is_update && $blog->image != null ? $blog->image_url : '#' }}" class="custom-file-image" style="display: {{ $is_update && $blog->image != null ? 'inline-block' : 'none' }};" width="200" />
                                        </div>
                                        <small class="form-text text-muted">Recommended size: Max 2MB. Accepted file formats: png, webp, jpg and jpeg</small>
                                        @if($is_update)
                                        <input type="hidden" name="old_image" id="old_image" value="{{ $blog->image }}">
                                        @endif
                                        @error('image')
                                            <label id="image-error" class="invalid-feedback" for="image" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 form-group">
                                    <label for="page">Page title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Title" name="meta_title" id="meta_title" value="{{ $is_update ? (old('meta_title') != "" ? old('meta_title') : $blog->meta_title) : old('meta_title') }}">
                                    @error('meta_title')
                                        <label id="meta_title-error" class="invalid-feedback" for="meta_title" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="meta_description"> Meta description <span class="text-danger">*</span></label>
                                    <textarea rows="3" class="form-control @error('meta_desc') is-invalid @enderror" placeholder="Meta Description" name="meta_desc" id="meta_desc" value="{{ $is_update ? (old('meta_description') != "" ? old('meta_desc') : $blog->meta_desc) : old('meta_desc') }}" rows="10">{{ $is_update ? (old('meta_desc') != "" ? old('meta_desc') : $blog->meta_desc) : old('meta_desc') }}</textarea>
                                    @error('meta_desc')
                                        <label id="meta_desc-error" class="invalid-feedback" for="meta_desc" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="url">URL handle <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">{{ route('blogs') }}/</span>
                                        </div>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="URL handle" name="slug" id="slug" value="{{ $is_update ? (old('slug') != "" ? old('slug') : $blog->slug) : old('slug') }}">
                                    </div>
                                    @error('slug')
                                        <label id="slug-error" class="invalid-feedback" for="slug" style="display: inline-block;">{{ $message }}</label>
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
