@extends('layouts.admin')

@section('title') Users @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">Users</h4>
    </div>
    <div class="col-sm-auto ml-auto">
        <a href="{{ route('admin.user.create') }}"><button type="button" class="btn btn-primary text-white"> Add New User</button></a>
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
                <div class="font-size-16 pb-3 d-none table-title">Users</div>
                <table id="datatable" class="table table-striped dt-responsive data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Status</th>
                            <th class="not-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">User's Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="content-body">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2">Full Name </label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span id="name"></span>
                                </div>
                            </div>
                            <label class="col-md-2">Email </label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span id="email"></span>
                                </div>
                            </div>
                            <label class="col-md-2">Contact No. </label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span id="phone_number"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script type="text/javascript">
    var filter_url = "{{ route('admin.user.index') }}";
    var delete_url = "{{ route('admin.user.destroy', ['user' => 'userid']) }}";
    var block_url = "{{ route('admin.user.block') }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/buttons.html5.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/user.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
