$(document).ready(function(){
	var CREATE_PAYMENT_URL  = 'https://dev.efab/settings/subscribe';
    var EXECUTE_PAYMENT_URL = 'https://dev.efab/settings/subscribe/payment/execute';

    paypal.Button.render({

        env: 'sandbox', // Or 'sandbox'

        commit: true, // Show a 'Pay Now' button

        payment: function() {
        	return paypal.request.post(CREATE_PAYMENT_URL,{
                id : $("#xhash").val()
            }).then(function(data) {
                return data.id;
            });
        },

        onAuthorize: function(data) {
            return paypal.request.post(EXECUTE_PAYMENT_URL, {
                paymentID: data.paymentID,
                payerID:   data.payerID,
                id : $("#xhash").val()
            }).then(function(data) {
            	if(data.success){
                    location.reload();
                }
                // The payment is complete!
                // You can now show a confirmation message to the customer
            });

        }

    }, '#paypal-button');

    $(document).on("click",".btn-signup",function(){
        var h = $(this).attr("data-id");
        $("#exampleModal").modal();
        $("#xhash").val(h);
    })
});