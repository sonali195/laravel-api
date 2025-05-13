if (typeof filter_url === "undefined") { var filter_url = ""; }
if (typeof delete_url === "undefined") { var delete_url = ""; }
if (typeof exists_url === "undefined") { var exists_url = ""; }

$(function () {
    if ($('.data-table').length) {
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "POST",
                url: filter_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'full_name', name: 'full_name' },
                { data: 'email', name: 'email' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'profession', name: 'profession' },
                
                // { data: 'time_until_start', name: 'time_until_start' },

                /*   { data: 'image', name: 'image' },
                    { data: 'description', name: 'description' }, */
                // { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function () {
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete Schedule",
            text: "Are you sure you want to delete this Live Program?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('liveprogramid', data_id),
                    data: { id: data_id },
                    success: function (data) {
                        if (typeof data !== "undefined") {
                            if (typeof data.status !== "undefined" && data.status == true) {
                                table.ajax.reload();
                                successToast(data.message);
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast("Oops! Something went wrong. Please try again.");
                        }
                    },
                    error: function (data) {
                        errorToast("Oops! Something went wrong. Please try again.");
                    }
                });
            }
        });
    });


    $(document).on("blur keyup", "#meta_title", function () {
        var meta_title = $(this).val();
        if (meta_title != "") {
            createSlug(meta_title);
        }
    });

    function createSlug(title) {
        var page_url = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        $("#slug").val(page_url);
    }

    // Setup validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $(".liveprogram-form-validate").validate({
            rules: {
                category: {
                    required: true,
                    alphadash: true,
                    maxlength: 5,
                },
                title: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    alphadash: true,
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        async: false,
                        beforeSend: function () { $("#title").attr('disabled', true) }, complete: function () { $("#title").attr('disabled', false) },
                        data: {
                            id: $('input[name="id"]').val(),
                        }
                    },
                },  
                event_date: {
                    required: true,
                    date: true // ✅ Proper date validation
                },
                start_time: {
                    required: true,
                    // No need for alphadash; time is not alphanumeric-with-dashes
                },
                end_time: {
                    required: true,
                },
                video_url: {
                    required: true,
                    url: true, // ✅ Validates proper URL format
                    maxlength: 255
                }
                
            },
            messages: {
                category: {
                    required: "Please select a category",
                    remote: "This category already exists!",
                },
                title: {
                    required: "Please enter a title",
                    remote: "This title already exists!",
                },
                event_date: {
                    required: "Event date is required",
                    date: "Please enter a valid date"
                },
                start_time: {
                    required: "Start time is required"
                },
                end_time: {
                    required: "End time is required"
                },
                video_url: {
                    required: "YouTube URL is required",
                    url: "Please enter a valid URL"
                },
            }
        });
    }
});
