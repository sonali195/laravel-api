@extends('layouts.app')

@section('head')
<!-- intl-tel-input CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
<style>
    input#phone_first, input#phone_lost {
        width: 100%;
    }

    label.error {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <ul class="nav nav-tabs mb-3" id="assistTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="first-tab" data-bs-toggle="tab" data-bs-target="#firstAid" type="button" role="tab">First Aid</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="emergency-tab" data-bs-toggle="tab" data-bs-target="#emergencyInfo" type="button" role="tab">Emergency Info</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="lost-tab" data-bs-toggle="tab" data-bs-target="#lostFound" type="button" role="tab">Lost and Found</button>
        </li>
    </ul>

    <div class="tab-content">
        <!-- First Aid -->
        <div class="tab-pane fade show active" id="firstAid" role="tabpanel">
            <form id="firstAidForm" method="POST" action="{{ route('assistance.first_aid') }}">
                @csrf
                <input type="hidden" name="assistance_type" value="1">

                <div class="mb-3">
                    <label for="full_name_1">Full Name</label>
                    <input type="text" class="form-control" id="full_name_1" name="full_name" required>
                </div>

                <div class="mb-3">
                    <label for="phone_first">Current Contact Number</label>
                    <input type="tel" class="form-control" id="phone_first" name="contact_number" required>
                </div>

                <div class="mb-3">
                    <label for="desc1">Description</label>
                    <textarea class="form-control" name="description" id="desc1" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <!-- Emergency Info -->
        <div class="tab-pane fade" id="emergencyInfo" role="tabpanel">
            <div class="p-3 bg-light">
                <h5>WhatsApp Helpline Number</h5>
                <p><?= $whatsApp_no; ?></p>
                <h6>Safety rules/regulations</h6>
                <?= $safety_rules ?>
            </div>
        </div>

        <!-- Lost and Found -->
        <div class="tab-pane fade" id="lostFound" role="tabpanel">
            <form id="lostForm" method="POST" action="{{ route('assistance.first_aid') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="assistance_type" value="3">

                <div class="mb-3">
                    <label for="full_name_2">Full Name</label>
                    <input type="text" class="form-control" id="full_name_2" name="full_name" required>
                </div>

                <div class="mb-3">
                    <label for="phone_lost">Current Contact Number</label>
                    <input type="tel" class="form-control" id="phone_lost" name="contact_number" required>
                </div>

                <div class="mb-3">
                    <label for="desc2">Description</label>
                    <textarea class="form-control" name="description" id="desc2" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image">Upload Lost Item Photo</label>
                    <input type="file" class="form-control" name="image" id="image" accept=".jpg,.jpeg,.png">
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery & Validation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<!-- intl-tel-input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize phone input
        ['#phone_first', '#phone_lost'].forEach(function (selector) {
            const input = document.querySelector(selector);
            if (input) {
                window.intlTelInput(input, {
                    preferredCountries: ["in", "us", "gb"],
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
                });
            }
        });

        // File size custom rule
        $.validator.addMethod("filesize", function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, "File size must be less than 2MB");

        // First Aid Form Validation
        $("#firstAidForm").validate({
            errorClass: "error",
            rules: {
                full_name: "required",
                contact_number: "required",
                description: "required"
            },
            messages: {
                full_name: "Please enter your full name",
                contact_number: "Please enter a valid contact number",
                description: "Please enter a description"
            }
        });

        // Lost & Found Form Validation
        $("#lostForm").validate({
            errorClass: "error",
            rules: {
                full_name: "required",
                contact_number: "required",
                description: "required",
                image: {
                    extension: "jpg|jpeg|png",
                    filesize: 2097152 // 2MB
                }
            },
            messages: {
                full_name: "Please enter your full name",
                contact_number: "Please enter a valid contact number",
                description: "Please enter a description",
                image: {
                    extension: "Only JPG, JPEG, or PNG files allowed",
                    filesize: "Image must be less than 2MB"
                }
            }
        });
    });
</script>
@endsection
