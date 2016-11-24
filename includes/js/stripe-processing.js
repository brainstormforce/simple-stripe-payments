  document.addEventListener("DOMContentLoaded", function(event) { 
    var handler = StripeCheckout.configure({
      key: bsf_stripe.publishable_key,
      //image: '/stripe/asset/images/bsf-logo.png',
      // locale: 'auto',
      token: function(token) {
       // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log(bsf_stripe.ajaxurl);

         jQuery.ajax({  
           url: bsf_stripe.ajaxurl,
           data: {
              action: "bsf_create_payment",
              stripeToken: token.id,
              stripeEmail: token.email,
              amount: ( jQuery('#bsf-amount').val() * 100 ),
              description: ( jQuery('#bsf-amount-description').val() )
           },
           error: function(e) {
              jQuery('#info').html('<p>An error has occurred</p>');
           },
           // dataType: 'json',
           success: function(data) {
           },
           type: 'POST'
        });
     }
    });
    document.getElementById('bsfStripeButton').addEventListener('click', function(e) {
        // Open Checkout with further options:
        handler.open({
          name: 'Brainstorm Force',
          description: 'Partners for your digital journey',
          amount: ( jQuery('#bsf-amount').val() * 100 )
        });
        e.preventDefault();
    });
});

