define([
    'jquery',
    'Magento_Ui/js/modal/alert'
], function ($, alert) {
     return function (config) {
         $('.' + config.inputSelector).click(function(e) {
             alert({
                 content: 'Hello World'
             })
         });
     }
})
