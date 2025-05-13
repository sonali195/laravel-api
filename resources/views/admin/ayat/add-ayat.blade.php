@extends('layouts.admin')

@php
$is_update = false;
if (isset($ayat) && !empty($ayat)) {
	$is_update = true;
}
@endphp

@section('title') {{ $is_update ? 'Edit' : 'Add' }} Ayat @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Ayahs </h4>  
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
                        <form method="POST" action="{{ $is_update ? route('admin.ayat.update', ['ayat' => $ayat->id ]) : route('admin.ayat.store') }}" class="form-horizontal   ayat-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id"  value="{{ $ayat->id }}">
                                @method('PATCH')
                            @endif
                            <div class="row mb-2">
                                <div class="col-md-12 form-group">
                                    <label for="surah_id">Select Surah <span class="text-danger">*</span></label>
                                    <select name="surah_id" id="surah_id" class="form-control @error('surah_id') is-invalid @enderror">
                                        <option value="">-- Select Surah --</option>
                                        @foreach($surahs as $surah)
                                            <option value="{{ $surah->id }}" {{ old('surah_id', $is_update ? $ayat->surah_id : '') == $surah->id ? 'selected' : '' }}>
                                                {{ $surah->title_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('surah_id')
                                        <label class="invalid-feedback" for="surah_id">{{ $message }}</label>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 form-group">
                                    <label for="title_ar">Ayahs Title (Arabic) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title_ar') is-invalid @enderror" name="title_ar" id="title_ar" dir="rtl" value="{{ old('title_ar', $is_update ? $ayat->title_ar : '') }}">
                                    @error('title_ar')
                                        <label class="invalid-feedback" for="title_ar">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="title_translation">Ayahs Title (Translation) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title_translation') is-invalid @enderror" name="title_translation" id="title_translation" value="{{ old('title_translation', $is_update ? $ayat->title_translation : '') }}">
                                    @error('title_translation')
                                        <label class="invalid-feedback" for="title_translation">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="title_transliteration">Ayahs Title (Transliteration) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title_transliteration') is-invalid @enderror" name="title_transliteration" id="title_transliteration" value="{{ old('title_transliteration', $is_update ? $ayat->title_transliteration : '') }}">
                                    @error('title_transliteration')
                                        <label class="invalid-feedback" for="title_transliteration">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            
                           
                            <div class="form-actions center">
                                <a href="{{ route('admin.ayat.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
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
<script defer src="{{ Helper::assets('assets/js/pages/admin/ayat.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
