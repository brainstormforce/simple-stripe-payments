<?php

function bsf_create_payment_callback() {

  require_once( STRIPE_BASE_DIR . "/includes/config.php" ); 

  $token  = esc_attr( $_POST['stripeToken'] );
  $email  = esc_attr( $_POST['stripeEmail'] );
  $amount = esc_attr( $_POST['amount'] );
  $description = esc_attr( $_POST['description'] );

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