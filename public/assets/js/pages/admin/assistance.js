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
                { data: 'contact_number', name: 'contact_number' },
                {
                    data: 'description',
                    name: 'description',
                    render: function (data, type, row) {
                        return $('<div>').html(data).text(); // Strips tags and shows clean text
                    }
                },
                
                { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function () {
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete blog",
            text: "Are you sure you want to delete this assistance?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('assistanceid', data_id),
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
            filebrowserUploadUrl: image_upload_url,
            filebrowserUploadMethod: "form",
        });
        editor.on('change', function (evt) {
            // const data = editor.getData();
            const element = evt.editor.name;
            CKEDITOR.instances[element].updateElement();
            $("[name=" + element + "]").trigger('blur');
        });
    }

    if ($("#safety_rules").length) {
        const editor = CKEDITOR.replace("safety_rules", {
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
            filebrowserUploadUrl: image_upload_url,
            filebrowserUploadMethod: "form",
        });
        editor.on('change', function (evt) {
            // const data = editor.getData();
            const element = evt.editor.name;
            CKEDITOR.instances[element].updateElement();
            $("[name=" + element + "]").trigger('blur');
        });
    }

    $(document).on("blur keyup", "#title", function () {
        var title = $(this).val();
        var meta_title = $("#meta_title").val();
        if ((title != "" && meta_title == title) || meta_title == "") {
            $("#meta_title").val(title);
            createSlug(title);
        }
    });

    $(document).on("blur keyup", "#meta_title", function () {
        var meta_title = $(this).val();
        if (meta_title != "") {
            createSlug(meta_title);
        }
    });

});
$(document).ready(function () {
    const form = $(".assistance-form-validate");

    const validator = form.validate({
        ignore: [], // Validate hidden fields like CKEditor
        rules: {
            assistance_type: { required: true },
            full_name: {
                required: function () {
                    const type = $('#assistance_type').val();
                    return type === '1' || type === '2';
                },
                maxlength: 255
            },
            contact_number_display: {
                required: function () {
                    const type = $('#assistance_type').val();
                    return type === '1' || type === '2';
                },
                maxlength: 13
            },
            image: {
                required: function () {
                    const type = $('#assistance_type').val();
                    const oldImageExists = $("#old_image").length && $("#old_image").val() !== "";
                    return type === '2' && !oldImageExists;
                },
                extension: "png|webp|jpg|jpeg",
                filesize: 2000000
            },
            description: {
                required: function () {
                    const type = $('#assistance_type').val();
                    return type === '1' || type === '2';
                }
            },
            // whatsapp_no: {
            //     required: function () {
            //         return $('#assistance_type').val() === '2';
            //     }
            // },
            // safety_rules: {
            //     required: function () {
            //         return $('#assistance_type').val() === '2';
            //     }
            // }
        },
        messages: {
            full_name: { required: "Please enter full name" },
            contact_number_display: { required: "Please enter contact number" },
            image: {
                required: "Please select an image",
                extension: "Only png, jpg, jpeg, webp allowed",
                filesize: "File must be 2MB or less"
            },
            description: { required: "Please enter a description" },
            // whatsapp_no: { required: "Please enter WhatsApp number" },
            // safety_rules: { required: "Please enter safety rules" },
            assistance_type: { required: "Please select type" }
        },
        submitHandler: function (form) {
            // Submit form normally
            form.submit();
        }
    });

    // Re-validate when assistance type changes
    $('#assistance_type').on('change', function () {
        validator.resetForm();
    });
});

// File size validator
$.validator.addMethod("filesize", function (value, element, param) {
    if (element.files.length === 0) return true;
    return element.files[0].size <= param;
}, "File must be less than 2MB");
