@extends('layouts.admin')

@section('title') Surah @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">All Ayahs</h4>
    </div>
    <div class="col-sm-auto ml-auto">
        <a href="{{ route('admin.ayat.create') }}"><button type="button" class="btn btn-primary text-white"> Add New Ayahs</button></a>
    </div>
</div>
@endsection

@section('css')
<link href="{{ Helper::assets('assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ Helper::assets('assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="font-size-16 pb-3 d-none table-title">Quran</div>
                <table class="table table-striped table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Surah</th>
                            <th>Title Ar</th>
                            <th>Title Translation</th>
                            <th>Title Transliteration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script type="text/javascript">
    var filter_url = "{{ route('admin.ayat.records') }}";   
    var delete_url = "{{ route('admin.ayat.destroy', ['ayat' => 'ayatid']) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/ayat.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
