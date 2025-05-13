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
                {
                    data: 'description',
                    name: 'description',
                    render: function (data, type, row, meta) {
                        return data; // Render raw HTML
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        return data; // Render raw HTML
                    }
                },
            ]
        });
    }
    

    $(document).on('click', '.delete', function () {
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete Near Ny Facilities",
            text: "Are you sure you want to delete this Near Ny Facilities?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('nearbyfacilitysid', data_id), 
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
    if ($("#description").length) {
        const editor = CKEDITOR.replace("description", {
            height: "350px",
            toolbarGroups: [
                { name: "styles", groups: ["styles"] },
                { name: "paragraph", groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"] },
                { name: "insert", groups: ["insert"] },
                { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
                { name: "colors", groups: ["colors"] },
                { name: "clipboard", groups: ["clipboard", "undo"] },
                { name: "editing", groups: ["find", "selection", "spellchecker", "editing"] },
                { name: "forms", groups: ["forms"] },
                { name: "links", groups: ["links"] },
                { name: "document", groups: ["mode", "document", "doctools"] },
            ],
            removeButtons: "Save,Language,Templates,NewPage,Preview,Print,Replace,Find,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,Iframe,Font,About",
            image_previewText: " ",
            removeDialogTabs: "image:advanced;image:Link",
          //  filebrowserUploadUrl: image_upload_url,
            filebrowserUploadMethod: "form",
        });
        editor.on('change', function (evt) {
            // const data = editor.getData();
            const element = evt.editor.name;
            CKEDITOR.instances[element].updateElement();
            $("[name=" + element + "]").trigger('blur');
        });
    }
    // Setup validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $(".nearbyfacilities-form-validate").validate({
            rules: {
                description: {
                    required: function () {
                        CKEDITOR.instances.description.updateElement();
                        var editorcontent = $('#description').val().replace(/<[^>]*>/gi, ''); // strip tags
                        var editor_value = $.trim(editorcontent.replace(/&nbsp;/g, ''));
                        return Number(editor_value) === 0;
                    },
                    normalizer: function (value) { return $.trim(value); },
                    checkCkeditorEmpty: '#description',
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
                
            },
            messages: {
                description: {
                    required: "Please Enter a Description.",
                },
                title: {
                    required: "Please Enter a Title.",
                    remote: "This title already exists!",
                },
            }
        });
    }
});
