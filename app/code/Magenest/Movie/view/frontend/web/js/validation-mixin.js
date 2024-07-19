define(['jquery'], function($) {
    'use strict';

    return function(targetWidget) {
        $.validator.addMethod(
            'validate-10-phone-number',
            function(value, element) {
                if(value.startsWith('+84')){
                    value = '0' + value.slice(3);
                    return (value.length == 10);
                }
                return (value.length == 10);
            },
            $.mage.__('Please enter exactly abcdef words')
        )
        return targetWidget;
    }
});
