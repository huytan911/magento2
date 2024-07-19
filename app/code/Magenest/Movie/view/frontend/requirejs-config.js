var config = {
    map: {
        '*': {
            phone: 'Magenest_Movie/js/phone-number',
            customModal: 'Magenest_Movie/js/modal-custom',
            customAlert: 'Magenest_Movie/js/alert-custom',
        }
    },
    shim: {
        'Magenest_Movie/js/phone-number': ["jquery"],
        'Magenest_Movie/js/modal-custom': ["jquery"],
        'Magenest_Movie/js/alert-custom': ["jquery"],
    },
    mixins: {
        'mage/validation': {
            'Magenest_Movie/js/validation-mixin': true,
        },
        'Magento_Checkout/js/action/set-shipping-information': {
            'Company_Module/js/action/set-shipping-information-mixin': true
        }
    }
}
