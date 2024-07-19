define([
    'jquery',
    'Magento_Ui/js/modal/modal',
], function ($, modal) {

    return function (config) {
        const modalLoginOption = {
            type: 'popup',
            modalClass: 'modal-popup',
            responsive: true,
            innerScroll: true,
            clickableOverlay: true,
            title: $.mage.__('Login Modal'),
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }],
            trigger: '[data-trigger=openLoginModal]'
        };
        modal(modalLoginOption, $('#' + config.inputSelector));
    }
});
