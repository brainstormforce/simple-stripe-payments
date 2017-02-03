<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
  exit();
}

function bsf_create_payment_callback() {

  require_once( STRIPE_BASE_DIR . "/includes/config.php" ); 
    $stripe_general_settings = get_option('stripe_general_settings');
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
      'currency' => $stripe_general_settings['stripe_currency_type']
  ));
}