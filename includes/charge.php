<?php
function bsf_create_payment_callback() {

  require_once( STRIPE_BASE_DIR . "/includes/config.php" ); 

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $amount = $_POST['amount'];
  $description = $_POST['description'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'card'  => $token,
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount,
      'description' => $description,
      'currency' => 'usd'
  ));
  
}