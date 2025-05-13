@extends('layouts.admin')

@php
$is_update = false;
if (isset($liveprogram) && !empty($liveprogram)) {
	$is_update = true;
}
@endphp

@section('title') {{ $is_update ? 'Edit' : 'Add' }} liveprogram @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Live Program</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.liveprogram.update', ['liveprogram' => $liveprogram->id ]) : route('admin.liveprogram.store') }}" class="form-horizontal   liveprogram-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id"  value="{{ $liveprogram->id }}">
                                @method('PATCH')
                            @endif
                            <div class="row mb-2">
                                <div class="col-md-12 form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" value="{{ $is_update ? (old('title') != "" ? old('title') : $liveprogram->title) : old('title') }}">
                                        @error('title')
                                            <label id="title-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                                <!-- <div class="col-md-6 form-group">
                                    <label for="category">Category <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" name="category" id="category" required>
                                    <option value="">Select Category</option>
                                    <option value="1" {{ old('category', $is_update ? $liveprogram->category : '') == 1 ? 'selected' : '' }}>Nauha</option>
                                    <option value="2" {{ old('category', $is_update ? $liveprogram->category : '') == 2 ? 'selected' : '' }}>Majlis</option>
                                </select>
                                    @error('category')
                                        <label class="invalid-feedback" for="category">{{ $message }}</label>
                                    @enderror
                                </div> -->
                                <div class="col-md-12 form-group">
                                    <label for="event_date">Event Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('event_date') is-invalid @enderror" name="event_date" id="event_date" value="{{ old('event_date', $is_update ? $liveprogram->event_date : '') }}" required>
                                    @error('date')
                                        <label class="invalid-feedback" for="date">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>          
                            <div class="row mb-2">
                                <div class="col-md-6 form-group">
                                    <label for="start_time">Start Time <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" id="start_time" value="{{ old('start_time', $is_update ? $liveprogram->start_time : '') }}" required>
                                    @error('start_time')
                                        <label class="invalid-feedback" for="start_time">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="duration">Duration <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" placeholder="e.g. 01:30 for 1 hr 30 min" value="{{ old('duration', $is_update ? $liveprogram->duration : '') }}" required>
                                    @error('duration')
                                        <label class="invalid-feedback" for="duration">{{ $message }}</label>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <label for="video_url">YouTube URL</label>
                                    <input type="url" class="form-control @error('video_url') is-invalid @enderror"
                                        placeholder="https://www.youtube.com/watch?v=xxxx"
                                        name="video_url" id="youtube_url"
                                        value="{{ old('video_url', $is_update ? $liveprogram->video_url : '') }}">
                                    @error('video_url')
                                        <label class="invalid-feedback" for="video_url">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>  
                            <div class="form-actions center">
                                <a href="{{ route('admin.liveprogram.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
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
    var exists_url = "{{ route('admin.liveprogram.exists') }}";
    var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/liveprogram.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection  
  