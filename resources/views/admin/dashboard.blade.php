@extends('layouts.admin', ['withLoader' => true])

@section('title') Dashboard @endsection

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <h4 class="mb-1 mt-0 font-weight-medium">Dashboard</h4>
    </div>
</div>
@endsection

@section('content')
<div class="row schedule-scheme-card">
    <div class="col-md-6 col-xl-4">
        <div class="card bg-card1">
            <a href="{{ route('admin.user.index') }}">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <h5 class="mb-1 text-black">{{ isset($userCount) ? $userCount : 0 }}</h5>
                            <span class="text-black font-weight-medium">Total Registered Users</span>
                        </div>
                        <div class="align-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#e682ae" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-users icon-dual">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card bg-card2">
            <a href="{{ route('admin.travelguide.index') }}">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <h5 class="mb-1 text-black">{{ isset($enquiryCount) ? $enquiryCount : 0 }}</h5>
                            <span class="text-black font-weight-medium">Total Travel Guide</span>
                        </div>
                        <div class="align-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#01c99a" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
@endsection
