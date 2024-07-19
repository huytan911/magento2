/*jshint browser:true jquery:true*/
/*global alert*/
define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper, quote) {
    'use strict';

    return function (setShippingInformationAction) {

        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();
            console.log(shippingAddress['middlename']);
            if (shippingAddress['middlename'] === null) {
                shippingAddress['middlename'] = "middlename";
            }
            console.log(shippingAddress);
            // you can write here your code according to your requirement
            return originalAction(); // it is returning the flow to original action
        });
    };
});
