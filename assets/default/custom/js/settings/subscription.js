$(document).ready(function(){
	var CREATE_PAYMENT_URL  = 'http://dev.e-fab/settings/subscribe';
    var EXECUTE_PAYMENT_URL = 'http://dev.e-fab/settings/subscribe/payment/execute';

    paypal.Button.render({

        env: 'sandbox', // Or 'sandbox'

        commit: true, // Show a 'Pay Now' button

        payment: function() {
        	return paypal.request.post(CREATE_PAYMENT_URL).then(function(data) {
                return data.id;
            });
        },

        onAuthorize: function(data) {
            return paypal.request.post(EXECUTE_PAYMENT_URL, {
                paymentID: data.paymentID,
                payerID:   data.payerID
            }).then(function() {
            	
                // The payment is complete!
                // You can now show a confirmation message to the customer
            });

        }

    }, '#paypal-button');
});