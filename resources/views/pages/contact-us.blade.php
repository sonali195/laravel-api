@extends('layouts.app')

@section('title') Contact @endsection

@section('breadcrumb')
    <div class="row page-title align-items-center">
        <div class="col-sm-6 col-xl-6">
            <h4 class="mb-1 mt-0 font-weight-medium">Contact us</h4>
        </div>
    </div>
@endsection

@section('content')
    <section class="mb-2" id="">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p>We are happy to provide info and assist you</p>
                        <form id="contactForm" class="contact mt-2" action="{{ route('contact.enquiry') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" style="" class="form-control" placeholder="Name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                            </div>
                            <div class="form-group">
                                <textarea rows="5" cols="5" class="form-control" placeholder="Message" name="message" required></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">Submit Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-0 pr-md-1">
                    <div class="card-body">
                        <h6 class="text-bold-700 mb-2">You are welcome to contact us</h6>
                        <div class="address">
                            <p class="text-bold-600"><i class="fa text-sea-green fa-envelope-o fa-lg"></i>&nbsp; Email</p>
                            <p><span class="pr-2"></span>&nbsp; Use the Enquiry form</p>
                            <p class="text-bold-600"><i class="fa text-sea-green fa-phone fa-lg"></i>&nbsp; Call us</p>
                            <p><span class="pr-2"></span>&nbsp;+12 234 56789</p>
                            <p class="text-bold-600"><i class="fa text-sea-green fa-map-o fa-lg"></i>&nbsp; Postal Address</p>
                            <p><span class="pr-2"></span>&nbsp; A-1, Abc, 365244.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script-bottom')
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ Helper::assets('assets/js/pages/contact.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
