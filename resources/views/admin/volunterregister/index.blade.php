@extends('layouts.admin')

@section('title') LiveProgram @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">Voluntter List</h4>
    </div>
    {{-- <div class="col-sm-auto ml-auto">
        <a href="{{ route('admin.liveprogram.create') }}"><button type="button" class="btn btn-primary text-white"> Add New Live Program</button></a>
    </div> --}}
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
                <div class="font-size-16 pb-3 d-none table-title">Live Program</div>
                <table class="table table-striped table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Profession</th>
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
    var filter_url = "{{ route('admin.volunteerlist.records') }}";
    var delete_url = "{{ route('admin.liveprogram.destroy', ['liveprogram' => 'liveprogramid']) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/volunteerlist.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
