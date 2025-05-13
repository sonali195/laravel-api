$(function () {
    "use strict";
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), utcOffset: new Date().getTimezoneOffset() }, beforeSend: function () { $("#status").fadeIn(); $("#preloader").delay(100).fadeIn().addClass("aloader"); }, complete: function () { $("#status").fadeOut(); $("#preloader").delay(100).fadeOut().removeClass("aloader"); } });

    if (typeof dataTable !== 'function' && $.fn.dataTable) {
        $.extend($.fn.dataTable.defaults, { autoWidth: false, responsive: true, displayLength: 25, ajax: { beforeSend: function () { }, complete: function () { } }, language: { search: '<span>Search:</span> _INPUT_', lengthMenu: '<span>Show </span> _MENU_ entries', paginate: { 'first': 'First', 'last': 'Last', 'next': 'Next', 'previous': 'Prev' } }, drawCallback: function () { $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup'); }, preDrawCallback: function () { $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup'); } });
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if ($(this).attr('data-url') !== "undefined") { history.pushState(null, '', $(this).attr('data-url')); }
    });

    if (typeof datetimepicker !== 'function' && $.fn.datetimepicker) {
        if ($(".date-selectors").length) {
            createSingleDatePicker($(".date-selectors"))
        }

        $(".date-select").each(function (k, v) {
            createDatePicker($(this))
        })

        $('.date-select.from').on("dp.show", function (e) {
            var to_date = $(this).parents('.date-group').find('.date-select.to').val();
            if (to_date != "") { var d = moment(to_date, 'DD/MM/YYYY').format('MM/DD/YYYY'); $(this).data("DateTimePicker").maxDate(new Date(d)); }
        });
        $('.date-select.to').on("dp.show", function (e) {
            var from_date = $(this).parents('.date-group').find('.date-select.from').val();
            if (from_date != "") { var d = moment(from_date, 'DD/MM/YYYY').format('MM/DD/YYYY'); $(this).data("DateTimePicker").minDate(new Date(d)); }
        });

        $(document).on('focus', ".time-select", function (k, v) {
            createDateTimePicker($(this))
        });
    }

    if (typeof select2 !== 'function' && $.fn.select2) {
        $(".select2").each(function (k, v) {
            createSelect2($(this));
        });

        $(".select2-custom").each(function (k, v) {
            createSelect2Custom($(this));
        });
    }

    if (typeof multiselect !== 'function' && $.fn.multiselect && $(".multiselect").length) {
        $(".multiselect").each(function () {
            createMultiselect($(this))
        });
    }

    // Form validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $.validator.addMethod("onlyletters", function (value, element) { return this.optional(element) || value == value.match(/^[a-zA-Z]*/); }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "The " + name + " may only contain letters"; });
        $.validator.addMethod("alpha", function (value, element) { return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/); }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "The " + name + " may only contain letters and spaces"; });
        $.validator.addMethod("digitsspace", function (value, element) { return this.optional(element) || value == value.match(/^[0-9][\s0-9]*/); }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "The " + name + " may only contain numbers and spaces"; });
        $.validator.addMethod("lettersdash", function (value, element) { return this.optional(element) || value == value.match(/^[a-zA-Z0-9][_\-\sa-zA-Z0-9]*/); }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "The " + name + " may only contain letters, numbers, spaces, underscore and dash(-)"; });
        $.validator.addMethod("alphacomma", function (value, element) { return this.optional(element) || value == value.match(/^[a-zA-Z][,\sa-zA-Z]*/); }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "The " + name + " may only contain letters, spaces and commas(,)"; });
        $.validator.addMethod("alphadigits", function (value, element) { return this.optional(element) || value == value.match(/^[a-zA-Z0-9][\sa-zA-Z0-9]*/); }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "The " + name + " may only contain letters, numbers and spaces"; });
        $.validator.addMethod("alphadash", function (value, element) { return this.optional(element) || value == value.match(/^[a-zA-Z0-9][\&\.\:\;\'\"\_,\-\s\/()\*0-9a-zA-Z]*/); }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "The " + name + "  may only contain letters, numbers, spaces, special characters(. , : ; / - & _ ' \") and parentheses"; });
        $.validator.addMethod('filesize', function (value, element, param) { return this.optional(element) || (element.files[0].size <= param) }, function (params, element) { var sizeKB = parseInt(params / 1000); var name = removeSpecialCharactersFromName($(element).attr('name')); return $.validator.format("File size must be less than or equal to " + sizeKB + "KB"); });
        $.validator.addMethod("exactlength", function (value, element, param) { return this.optional(element) || value.length == param; }, $.validator.format("Please enter exactly {0} characters."));
        $.validator.addMethod("noSpace", function (value, element) { return value.indexOf(" ") < 0 && value != ""; }, "Space are not allowed.");
        $.validator.addMethod("checkEmail", function (value, element) { return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i.test(value); }, 'Please enter a valid email address');
        $.validator.addMethod("checkCkeditorEmpty", function (value, element, params) { var idname = $(element).attr('id'); var editorcontent = $("#" + idname).val().replace(/<[^>]*>/gi, ''); var editor_value = $.trim(editorcontent.replace(/&nbsp;/g, '')); if (Number(editor_value) === 0) { return false; } return true; }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "Please enter " + name + " content"; });
        $.validator.addMethod("ckrequired", function (value, element) { var idname = $(element).attr('id'); var editor = CKEDITOR.instances[idname]; var ckValue = GetTextFromHtml(editor.getData()).replace(/<[^>]*>/gi, '').trim(); if (ckValue.length === 0) { $(element).val(ckValue); } else { $(element).val(editor.getData()); } return $(element).val().length > 0; }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "Please enter " + name + " content"; });
        $.validator.addMethod("unique", function (value, element) { var matches = new Array(); $('.unique').not(element).each(function (index, item) { if (value == $(item).val()) { matches.push(item); } }); return matches.length == 0; }, function (params, element) { var name = removeSpecialCharactersFromName($(element).attr('name')); return "Please enter different " + name; });
        $.validator.addMethod('minImageWidth', function (value, element, minWidth) { return !isNaN(value) || ($(element).data('imageWidth') || 0) > minWidth; }, function (minWidth, element) { var imageWidth = $(element).data('imageWidth'); return (imageWidth) ? ("Your image's width must be greater than " + minWidth + "px") : "Selected file is not an image."; });
        $.validator.addMethod('minImageHeight', function (value, element, minHeight) { return !isNaN(value) || ($(element).data('imageHeight') || 0) > minHeight; }, function (minHeight, element) { var imageHeight = $(element).data('imageHeight'); return (imageHeight) ? ("Your image's height must be greater than " + minWidth + "px") : "Selected file is not an image."; });
        $.validator.addMethod('fixImageWidth', function (value, element, minWidth) { return !isNaN(value) || ($(element).data('imageWidth') || 0) == minWidth; }, function (minWidth, element) { var imageWidth = $(element).data('imageWidth'); return (imageWidth) ? ("Your image width must be equal to " + minWidth + "px") : "Selected file is not an image."; });
        $.validator.addMethod('fixImageHeight', function (value, element, minHeight) { return !isNaN(value) || ($(element).data('imageHeight') || 0) == minHeight; }, function (minHeight, element) { var imageHeight = $(element).data('imageHeight'); return (imageHeight) ? ("Your image height must be equal to " + minHeight + "px") : "Selected file is not an image."; });
        $.validator.addMethod("maxFilesToSelect", function (value, element, params) { var fileCount = element.files.length; if ($(element).parents('.attachment').length) { fileCount = parseInt(fileCount + $(element).parents('.attachment').find('.init-file-name .init-file').length); } if (fileCount > params) { return false; } else { return true; } }, $.validator.format('You can upload maximum {0} files'));
        $.validator.addMethod("checkFullAddress", function (value, element, params) { var location = $(element).parents('.location-group').find('.location').val(); if (location == '') { return false; } return true; }, "Please enter valid google address");
        $.validator.addMethod("passwordCheck", function (value, element, param) { if (this.optional(element)) { return true; } else if (!/[A-Za-z]/.test(value) || !/[0-9]/.test(value)) { return false; } else { return true; } }, "Password must contain at least 1 character and 1 number");
        $.validator.setDefaults({
            ignore: 'input[type=hidden]:not(".required"), .select2-search__field', errorClass: 'invalid-feedback', successClass: 'validation-valid-label', validClass: "validation-valid-element", highlight: function (element, errorClass, validClass) { $(element).parents("div.input-group").addClass(errorClass).removeClass(validClass); $(element).addClass('is-invalid'); $(element).removeClass(errorClass); }, unhighlight: function (element, errorClass, validClass) { $(element).parents("div.input-group").removeClass(errorClass).addClass(validClass); $(element).removeClass('is-invalid'); $(element).removeClass(errorClass); }, onkeyup: false, onfocusout: false, onsubmit: true,
            errorPlacement: function (error, element) {
                if (typeof element.attr('data-error') !== "undefined") { var placement = $(element).attr('data-error'); if (element.parents('div').hasClass('r-group')) { $(element).parents('.r-group').find('.' + placement).append(error) } else { $('.' + placement).append(error) } }
                else if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parents('div').hasClass("skin") || element.parent().hasClass('bootstrap-switch-container')) { if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) { error.appendTo(element.parent().parent().parent().parent()); } else { error.appendTo(element.parent().parent().parent()); } }
                else if (element.parents('div').hasClass('custom-file-main')) { error.appendTo(element.parent().parent().parent()) }
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline') || element.parents('div').hasClass('custom-file') || element.parents('label').hasClass('ec-checkbox') || element.parents('div').hasClass('upload-photo')) { error.appendTo(element.parent().parent()) }
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible') || element.parents('div').hasClass('ckeditor') || element.hasClass('ec-select') || element.hasClass('chosen-select') || element.parents('div').hasClass('bootstrap-select') || element.parents('div').hasClass('multiselect-native-select')) { error.appendTo(element.parent()); }
                else { error.insertAfter(element); }
            },
            success: function (label) { label.remove(); }, submitHandler: function (form) { $(form).find('button[type="submit"]').attr('disabled', 'disabled'); form.submit(); }
        });

        jQuery.extend($.validator.messages, { required: $.validator.format("Please enter a value"), remote: $.validator.format("This value is already exists"), email: $.validator.format("Please enter a valid email address."), url: $.validator.format("Please enter a valid URL with http or https."), date: "Please enter a valid date.", number: "Please enter a valid number.", digits: "Please enter only digits.", equalTo: "Please enter the same value as above.", accept: $.validator.format("Please select a valid file."), extension: $.validator.format("Please select a valid file."), maxlength: $.validator.format("Maximum {0} characters allowed."), minlength: $.validator.format("Please enter at least {0} characters."), max: $.validator.format("Please enter a value less than or equal to {0}."), min: $.validator.format("Please enter a value greater than or equal to {0}.") });
    }

    $(document).on('change', ".custom-file-input", function (event) { readURL(this); });
    $(document).on('click', '.custom-file-remove', function () { let _parent = $(this).parents('.custom-file'); $(_parent).find('.custom-file-input').val(""); $(_parent).find('.custom-file-label').html('Choose file'); $(_parent).find('.custom-file-image, .custom-file-video, .custom-file-remove').hide(); $(_parent).find('.custom-temp-image').val(""); });

    showPassword();
});

function formatSelectOptions(state) { if (typeof $(state.element).attr('data-image') !== "undefined") { return $('<div class="option-image"><img src="' + $(state.element).attr('data-image') + '" alt="Image"/>' + state.text + '</<div>') } else { if (typeof $(state.element).attr('data-count') !== "undefined") { return '<div class="all-count"><span>' + $(state.element).attr('data-count') + '</span>' + state.text + '</div>' } else { return state.text } } }

function showPassword() {
    let getElm = document.querySelectorAll('.show-password');
    for (let index = 0; index < getElm.length; index++) {
        getElm[index].addEventListener('click', function (e) {
            if (e.target.classList.contains('show')) {
                e.target.classList.remove('show');
            } else {
                e.target.classList.add("show");
            }
            var target = e.target.getAttribute("data-show-pass");
            let x = document.getElementById(target);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        })
    }
}

function createSingleDatePicker(element) { $(element).datetimepicker({ ignoreReadonly: true, format: 'DD/MM/YYYY', useCurrent: false, minDate: new Date(moment().format("MM/DD/YYYY")).setHours(0, 0, 0, 0), locale: 'en' }).on('dp.hide', function () { $(this).trigger('blur'); }); }

function createDatePicker(element) {
    if (typeof datetimepicker !== 'function' && $.fn.datetimepicker) {
        if ($(element).attr('data-minDate') !== undefined) {
            $(element).datetimepicker({ ignoreReadonly: true, format: 'DD/MM/YYYY', useCurrent: false, locale: 'en', minDate: new Date(moment().format("MM/DD/YYYY")).setHours(0, 0, 0, 0) }).on('dp.hide', function () { $(element).trigger('blur'); });
        } else if ($(element).attr('data-maxDate') !== undefined) {
            $(element).datetimepicker({ ignoreReadonly: true, format: 'DD/MM/YYYY', useCurrent: false, locale: 'en', maxDate: new Date(moment().format("MM/DD/YYYY")).setHours(23, 59, 59, 0) }).on('dp.hide', function () { $(element).trigger('blur'); });
        } else {
            $(element).datetimepicker({ ignoreReadonly: true, format: 'DD/MM/YYYY', useCurrent: false, locale: 'en' }).on('dp.hide', function () { $(element).trigger('blur'); });
        }
    }
}

function createDateTimePicker(element) { if (typeof datetimepicker !== 'function' && $.fn.datetimepicker) { $(element).datetimepicker({ ignoreReadonly: true, format: 'hh:mm A', stepping: 5, useCurrent: false, locale: 'en' }).on('dp.hide', function () { $(element).trigger('blur'); }); } }

function createSelect2Custom(element) { if (typeof select2 !== 'function' && $.fn.select2) { $(element).select2({ width: "100%", templateResult: formatSelectOptions, templateSelection: formatSelectOptions, escapeMarkup: function (m) { return m } }); } }

function createSelect2(element) { if (typeof select2 !== 'function' && $.fn.select2) { $(element).select2({ width: '100%', placeholder: function () { $(this).data('placeholder') }, adaptDropdownCssClass: function (c) { return c; } }).on("change", function (e) { $(this).trigger('blur'); }); } }

function createMultiselect(element) {
    if (typeof multiselect !== 'function' && $.fn.multiselect) {
        let maxSelect = typeof $(element).attr('data-max') !== "undefined" ? $(element).attr('data-max') : null;
        let includeSelectAllOption = typeof $(element).attr('data-max') !== "undefined" ? 0 : 1;
        $(element).multiselect({
            width: "100%", includeSelectAllOption: includeSelectAllOption, enableCaseInsensitiveFiltering: true, enableFiltering: true, allSelectedText: 'All', numberDisplayed: 3, nSelectedText: 'Selected', nonSelectedText: "Select", dropUp: false,
            onChange: function (option, checked, select) {
                let parentNode = option[0].parentNode, selectedOptions = $(parentNode).find('option:selected');

                if (maxSelect != null && selectedOptions.length >= maxSelect) {
                    let nonSelectedOptions = $(parentNode).find('option').filter(function () {
                        return !$(this).is(':selected');
                    });
                    nonSelectedOptions.each(function () {
                        $('input[value="' + $(this).val() + '"]').prop('disabled', true).parent('li').addClass('disabled');
                    });
                } else {
                    $(parentNode).find('option').each(function () {
                        $('input[value="' + $(this).val() + '"]').prop('disabled', false).parent('li').removeClass('disabled');
                    });
                    let allOptions = $(parentNode).find('option');
                    if (selectedOptions.length == allOptions.length) {
                        $(parentNode).multiselect('selectAll').multiselect('refresh');
                    } else if (selectedOptions.length < allOptions.length) {
                        $(parentNode).multiselect('deselectAll');
                        $(selectedOptions).prop('selected', true);
                        option.prop('selected', checked);
                        $(parentNode).multiselect('refresh');
                    }
                }
            }
        });
    }
}

function readURL(element) {
    $(element).removeData('imageWidth');
    $(element).removeData('imageHeight');
    var custom_label = $(element).parents('.custom-file').find('.custom-file-label'), custom_image = $(element).parents('.custom-file').find('.custom-file-image'), custom_video = $(element).parents('.custom-file').find('.custom-file-video'), custom_audio = $(element).parents('.custom-file').find('.custom-file-audio'), custom_remove = $(element).parents('.custom-file').find('.custom-file-remove');

    var file = element.files[0];
    custom_label.html('Choose file');
    if (custom_image.length > 0) { custom_image.hide(); custom_remove.hide(); }
    if (custom_video.length > 0) { custom_video.hide(); custom_remove.hide(); }
    if (custom_audio.length > 0) { custom_audio.hide(); custom_remove.hide(); }
    if ($(element).val() != "") {
        custom_label.html(file.name);
        var ext = file['name'].substr(file['name'].lastIndexOf('.') + 1);
        if (custom_image.length > 0) {
            if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'svg+xml']) > -1) {
                var img = new Image;
                img.onload = function () { $(element).data('imageWidth', img.width); $(element).data('imageHeight', img.height); var reader = new FileReader(); reader.onload = function (e) { custom_image.attr('src', e.target.result); custom_image.show(); custom_remove.show(); }; reader.readAsDataURL(file); }
                img.src = window.URL.createObjectURL(file);
            }
            else if (custom_video.length > 0) {
                if ($.inArray(ext, ['mp4', 'mov', 'm4a']) > -1) {
                    var reader = new FileReader(); reader.onload = (function (theFile) { return function (e) { custom_video.attr('src', e.target.result); custom_video.show(); custom_remove.show(); }; })(file); reader.readAsDataURL(file);
                }
            } else if (custom_audio.length > 0) {
                if ($.inArray(ext, ['mp3']) > -1) {
                    var reader = new FileReader(); reader.onload = (function (theFile) { return function (e) { custom_audio.attr('src', e.target.result); custom_audio.show(); custom_remove.show(); }; })(file); reader.readAsDataURL(file);
                }
            }
        } else {
            custom_remove.show();
        }
    }
}

function validateFloatKeyPress(el, evt) { var charCode = (evt.which) ? evt.which : evt.keyCode; var number = el.value.split('.'); if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) { return false; } if (number.length > 1 && charCode == 46) { return false; } var caratPos = getSelectionStart(el); var dotPos = el.value.indexOf("."); if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) { return false; } return true; }

function getSelectionStart(o) { if (o.createTextRange) { var r = document.selection.createRange().duplicate(); r.moveEnd('character', o.value.length); if (r.text == '') return o.value.length; return o.value.lastIndexOf(r.text) } else return o.selectionStart }

function removeSpecialCharactersFromName(name) { name = name.replace(/[^a-zA-Z\[\]]/g, ''); name = name.replace(/\[|\]/g, ' ').trim(); name = name.replace(/\s+/g, ' '); return name; }

function calculateHeight() { var count_height = $(window).height() - ($("header").outerHeight() + $("footer").outerHeight()); $(".app-content").css('min-height', count_height + "px"); }

function GetTextFromHtml(html) { var dv = document.createElement("DIV"); dv.innerHTML = html; return dv.textContent || dv.innerText || ""; }

function numberWithCommas(x) { return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); }

function loadJS(file) { var jsElm = document.createElement("script"); jsElm.type = "application/javascript"; jsElm.defer = true; jsElm.src = assetUrl + file; document.body.appendChild(jsElm) }
