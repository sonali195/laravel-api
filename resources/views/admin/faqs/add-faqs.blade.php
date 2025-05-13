@extends('layouts.admin')

@php
$is_update = false;
if(isset($faq)){
    $is_update = true;
}
@endphp
@section('title') {{ $is_update ? 'Edit' : 'Add' }} FAQ @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} FAQ</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.faqs.update', ['faq' => $faq->id]) : route('admin.faqs.store') }}" class="form-horizontal   faqs-form-validate" autocomplete="off">
                            @csrf
                            @if($is_update)
                                <input type="hidden" name="id" value="{{ $faq->id }}">
                                @method('PATCH')
                            @endif
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Question <span class="text-danger">*</span></label>
                                        <textarea name="question" class="form-control" id="question" rows="2" cols="80" placeholder="Question">{{ ($is_update ? $faq->question : old('question'))}}</textarea>
                                        @error('question')
                                            <label id="question-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Answer <span class="text-danger">*</span></label>
                                        <textarea name="answer" class="form-control" id="answer" rows="5" cols="80" placeholder="Answer">{{ ($is_update ? $faq->answer : old('answer'))}}</textarea>
                                        @error('answer')
                                            <label id="answer-error" class="invalid-feedback" for="answer" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions center">
                                <a href="{{ route('admin.faqs.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">{{ $is_update ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('script-bottom')
<script type="text/javascript">
    var exists_url = "{{ route('admin.faqs.exists') }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/faqs.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection

