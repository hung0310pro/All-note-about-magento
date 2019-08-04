define(['jquery'], function ($) {
    'use strict';

    return function (catalogAddToCart) {
        $.widget('mage.catalogAddToCart', catalogAddToCart, {
            submitForm: function (form) {
                var self = this;
                $('body').append('<div id="popup_ajaxcart_success" class="popup__main popup--result"><p>Do you want to add product to cart ?</p><select class="choosen-option"><option value="">Please choose options</option><option value="1">Yes</option><option value="0">No</option></select><button class="submit-ok">Ok</button></div>');
                var options =
                    {
                        type: 'popup',
                        modalClass: "success-ajax--popup viewBox",
                        responsive: true,
                        innerScroll: true,
                        title: false,
                        buttons: false
                    };

                $("#popup_ajaxcart_success").modal(options);
                $('#popup_ajaxcart_success').modal('openModal');

                var status = 0;
                var isClick = 0;

                $('.choosen-option').on('change', function () {
                    status = this.value;
                });

                $('.submit-ok').on('click', function () {
                    if (status == 0) {
                        $('.tocart > span').text('Add to cart');
                        $('.tocart').removeClass('disabled');
                        location.reload();
                    } else {
                        self.ajaxSubmit(form);
                        $('#popup_ajaxcart_success').modal('closeModal');
                    }
                });

            }
        });
        return $.mage.catalogAddToCart;
    };
});