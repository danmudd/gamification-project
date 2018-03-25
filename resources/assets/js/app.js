
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$('.confirm-form').submit(function(e) {
    var currentForm = this;
    e.preventDefault();
    bootbox.confirm("Are you sure?", function(result) {
        if (result) {
            currentForm.submit();
        }
    });
});

/*!
 * Laravel-Bootstrap-Modal-Form (https://github.com/JerseyMilker/Laravel-Bootstrap-Modal-Form)
 * Copyright 2015 Jesse Leite - MIT License
 *
 * Bromance:
 * Adam Wathan has nice boots. Thank you for BootForms magic.
 * Matt Higgins has nice beard. Thank you for JS wizardry.
 */

$('document').ready(function() {

    // Prepare reset.
    function resetModalFormErrors() {
        $('.form-group').removeClass('has-error');
        $('.form-group').find('.help-block').remove();
    }

    $('form.bootstrap-modal-form').on('submit', function(submission)
    {
        $this = $(this);
        $.submitModalForm(submission)
    });

    // Intercept submit.
    $.submitModalForm = function(submission) {
        submission.preventDefault();

        // Set vars.
        var form   = $this,
            url    = form.attr('action'),
            submit = form.closest('.modal-content').find('[data-bb-handler=submit]');

        // Check for file inputs.
        if (form.find('[type=file]').length) {

            // If found, prepare submission via FormData object.
            var input       = form.serializeArray(),
                data        = new FormData(),
                contentType = false;

            // Append input to FormData object.
            $.each(input, function(index, input) {
                data.append(input.name, input.value);
            });

            // Append files to FormData object.
            $.each(form.find('[type=file]'), function(index, input) {
                console.log(input.files);
                if (input.files.length == 1) {
                    data.append(input.name, input.files[0]);
                } else if (input.files.length > 1) {
                    $.each(input.files, function(index2, input2)
                    {
                        data.append(input2.name, input2);
                    })
                }
            });
        }

        // If no file input found, do not use FormData object (better browser compatibility).
        else {
            var data        = form.serialize(),
                contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
        }

        // Please wait.
        if (submit.is('button')) {
            var submitOriginal = submit.html();
            submit.html('Please wait...').attr("disabled", "disabled");
        } else if (submit.is('input')) {
            var submitOriginal = submit.val();
            submit.val('Please wait...').attr("disabled", "disabled");
        }

        var type = "POST";
        if(form.find('[name=_method]').length)
        {
            type = form.find('[name=_method]').val();
        }
        // Request.
        $.ajax({
            type: type,
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            contentType: contentType,
            processData: false

            // Response.
        }).always(function(response, status) {

            // Reset errors.
            resetModalFormErrors();

            // Check for errors.
            if (response.status == 422) {
                var errors = $.parseJSON(response.responseText);

                // Iterate through errors object.
                $.each(errors, function(field, message) {
                    console.error(field+': '+message);
                    //handle arrays
                    if(field.indexOf('.') != -1) {
                        field = field.replace('.', '[');
                        //handle multi dimensional array
                        for (i = 1; i <= (field.match(/./g) || []).length; i++) {
                            field = field.replace('.', '][');
                        }
                        field = field + "]";
                    }
                    var formGroup = $('[name='+field+']', form).closest('.form-group');
                    formGroup.addClass('has-error').append('<p class="help-block">'+message+'</p>');
                });

                // Reset submit.
                if (submit.is('button')) {
                    submit.html(submitOriginal).removeAttr("disabled");
                } else if (submit.is('input')) {
                    submit.val(submitOriginal).removeAttr("disabled");
                }

                // If successful, reload.
            } else {
                location.reload();
            }
        });
    };

    // Reset errors when opening modal.
    $('.bootstrap-modal-form-open').click(function() {
        resetModalFormErrors();
    });

});
