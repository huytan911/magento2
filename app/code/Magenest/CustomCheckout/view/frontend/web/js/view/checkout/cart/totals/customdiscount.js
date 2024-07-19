define(
    [
        'Magenest_CustomCheckout/js/view/checkout/summary/customdiscount'
    ],
    function (Component) {
        'use strict';

        return Component.extend({

            /**
             * @override
             */
            isDisplayed: function () {
                return true;
            }
        });
    }
);
