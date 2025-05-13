$(function () {
    // Setup validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $(".settings-form-validate").validate({
            rules: {
                android_version: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    number: true,
                },
                whatsApp_no_display: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    number: true,
                },
                safety_rules: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                },
                ios_version: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    number: true,
                },
            },
            messages: {
                android_version: {
                    required: "Please enter android version",
                },
                ios_version: {
                    required: "Please enter IOS version",
                },
                whatsApp_no_display: {
                    required: "Please enter whatsApp Number",
                },
                safety_rules: {
                    required: "Please enter safety Rules",
                },
            }
        });
    }
});

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
        //filebrowserUploadUrl: image_upload_url,
        filebrowserUploadMethod: "form",
    });
    editor.on('change', function (evt) {
        // const data = editor.getData();
        const element = evt.editor.name;
        CKEDITOR.instances[element].updateElement();
        $("[name=" + element + "]").trigger('blur');
    });
}

