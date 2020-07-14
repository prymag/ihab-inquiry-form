define([
    "jquery",
    "jquery/ui"
], function($){
    "use strict";
     
    function main(config, element) {
        var $element = $(element);
        /** @Todo: Pull the correct transaction id once the redirect has been setup. Use this for now */
        var id = Math.floor(Math.random() * 10);

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
        $.ajax({
            showLoader: true,
            url: config.ajaxUrl,
            type: "GET"
        }).done(function (data) {
            //
            ga('create', config.trackingCode, config.trackingName);
            ga('send', 'pageview');

            ga('require', 'ecommerce', 'ecommerce.js');

            ga('ecommerce:clear');
            ga('ecommerce:addTransaction', {
                'id': id,            			// Transaction ID. Required.
                'affiliation': config.seller,  // Affiliation or store name.
                'revenue': 	data.product_price,         // Grand Total.
                'shipping': data.product_shipping,// Shipping.
                'tax': data.product_tax
                });
            ga(	'ecommerce:addItem', {
                'id': id,                     			// Transaction ID. Required.
                'name': data.product_name,    			// Product name. Required.
                'sku':  data.product_sku,             	// SKU/code.
                'category': `CampCode: ${config.campaignCode} CampId: ${config.campaignId} EntryId: ${config.entryId} SellerId: ${config.seller}`,	// Category or variation.
                'price': data.product_price,                 	// Unit price.
                'quantity': '1'                		// Quantity.
                });
            
            ga('ecommerce:send');
        });
    };
    return main;
     
     
});