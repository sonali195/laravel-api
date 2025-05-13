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
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'event_date', name: 'event_date' },
                /*   { data: 'image', name: 'image' },
                    { data: 'description', name: 'description' }, */
                { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function () {
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete Schedule",
            text: "Are you sure you want to delete this Schedule?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('scheduleid', data_id),
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
    const today = new Date().toISOString().split('T')[0];
    $('#event_date').attr('min', today);
    // Setup validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $(".schedule-form-validate").validate({
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
                   
                },  
                event_date: {
                    required: true,
                    date: true
                },
                start_time: {
                    required: true
                },
                end_time: {
                    required: true
                },
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
                    required: "Please enter a Event Date",
                },
                start_time: {
                    required: "Please enter a Event start time",
                },
                end_time: {
                    required: "Please enter a Event end time",
                }
            }
        });
    }
});
