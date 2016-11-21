<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
<div class="bsf-payment-wrapper">
  <script src="https://checkout.stripe.com/checkout.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function(event) { 
    var handler = StripeCheckout.configure({
      key: "pk_test_1V0y2RCkZmzF1fdtvg9Vc3dv",
      //image: '/stripe/asset/images/bsf-logo.png',
      // locale: 'auto',

      token: function(token) {

       // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
         
         $.ajax({
           url: 'charge.php',
           data: {
              stripeToken: token.id,
              stripeEmail: token.email,
              amount: ( jQuery('#bsf-amount').val() * 100 )
           },
           error: function() {
              $('#info').html('<p>An error has occurred</p>');
           },
           dataType: 'json',
           success: function(data) {
              console.log(data);
           },
           type: 'POST'
        });
     }
    });

    document.getElementById('bsfStripeButton').addEventListener('click', function(e) {
        // Open Checkout with further options:

        if(document.getElementById("bsf-amount").value.length == 0) {
          alert("Please Enter Amount");
        }

        handler.open({
          name: 'Brainstorm Force',
          description: 'Partners for your digital journey',
          amount: ( jQuery('#bsf-amount').val() * 100 )
        });
        e.preventDefault();
    });
    });
</script>
<h2>Make A Payment</h2>
<p>Simply enter the amount in USD below and click pay now. You will be redirected to a page where you can pay using your Stripe account or debit / credit card.</p>
<div class="sub-heading"> Enter Amount Here : </div>
  <div class="bsf-amount-feild">
   <input type="number" id="bsf-amount" name="bsf-amount" value="" required/>
  </div>
   <div class="bsf-payment-button">
    <button id="bsfStripeButton">Pay Now</button>
  </div>
</div>



