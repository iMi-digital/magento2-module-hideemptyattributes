define([
        "jquery",
        "underscore"
    ],
    function ($, _) {
        'use strict';

        return function (config, node) {
            var attributeData = $(node).find('td.data');

            var showFilledAttributes = function (attribute) {
                if ($(attribute).text() === config.no || $(attribute).text() === config.na || $(attribute).text() === ''){
                    $(attribute).parent('tr').hide();
                } else {
                    $(attribute).parent('tr').show();
                }
            };

            $.each(attributeData, function(){
                showFilledAttributes(this);
                $(this).on('DOMSubtreeModified',function(){
                    showFilledAttributes(this);
                });
            });


        }
    }
);