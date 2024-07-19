define([
    'jquery',
    'mage/validation'
], function ($ ) {
    'use strict'
    return function() {
        $('#send2').click(function (event) {
            let currentPhoneNumber = $('#phone_number').val();
            if (currentPhoneNumber.startsWith('+84')) {
                let modifyPhoneNumber = '0' + currentPhoneNumber.slice(3);
                $('#phone_number').val(modifyPhoneNumber);
            }
        });
    }
})
