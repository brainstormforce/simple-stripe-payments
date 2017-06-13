  document.addEventListener("DOMContentLoaded", function(event) { 
    var handler = StripeCheckout.configure({

      panelLabel: ssp_stripe.ssp_button_text,
      key: ssp_stripe.publishable_key,
      token: function(token) {
       // You can access the token ID with `token.id`.
  
         jQuery.ajax({  
           url: ssp_stripe.ajaxurl,
           data: {
              action: "ssp_create_payment",
              stripeToken: token.id,
              stripeEmail: token.email,
              amount: ( jQuery('#ssp-amount').val() * 100 ),
              description: ( jQuery('#ssp-amount-description').val() )
           },
           error: function(e) {
              jQuery('#info').html('<p>An error has occurred</p>');
           },
           success: function(data) {
           },
           type: 'POST'
        });
     }
    });
    var ssp_pay_amount = document.getElementById('bsfStripeButton');
    if (ssp_pay_amount) {
       ssp_pay_amount.addEventListener('click', function(e) {
          // Open Checkout with further options:
          handler.open({
            name: ssp_stripe.ssp_title,
            description: ssp_stripe.ssp_tagline,
            currency: ssp_stripe.ssp_currency,
            amount: ( jQuery('#ssp-amount').val() * 100 )
          });
          e.preventDefault();
      });
    }
});