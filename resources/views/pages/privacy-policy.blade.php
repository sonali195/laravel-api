@extends('layouts.app')

@section('title') Privacy Policy @endsection

@php
    $mobile = in_array(Route::currentRouteName(),['app.privacy-policy']) ? true : false;
@endphp

@if(!$mobile)
    @section('breadcrumb')
    <div class="row page-title align-items-center">
        <div class="col-sm-6 col-xl-6">
            <h4 class="mb-1 mt-0 font-weight-medium">Privacy Policy</h4>
        </div>
    </div>
    @endsection
@endif

@section('content')
    <div class="row mt-2 justify-content-center">
        <div class="col-md-12 mb-5">
            {!! $pagecontent !!}
        </div>
    </div>
@endsection