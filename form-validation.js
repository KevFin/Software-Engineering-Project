$(document).ready(function() {
    $('#registerForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9]+$/,
                            message: 'The username can only consist of alphabetical and digits'
                        }
                    }
                }
            }
        })
        .on('err.validator.fv', function(e, data) {
            // $(e.target)    --> The field element
            // data.fv        --> The FormValidation instance
            // data.field     --> The field name
            // data.element   --> The field element
            // data.validator --> The current validator name

            data.element
                .data('fv.messages')
                // Hide all the messages
                .find('.help-block[data-fv-for="' + data.field + '"]').hide()
                // Show only message associated with current validator
                .filter('[data-fv-validator="' + data.validator + '"]').show();
        });
});
