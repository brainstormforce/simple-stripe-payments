<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
  exit();
}

function ssp_create_payment_callback() {

  require_once( SSP_BASE_DIR . "/includes/config.php" ); 
    $ssp_general_settings = get_option('ssp_general_settings');
    $token  = esc_attr( $_POST['stripeToken'] );
    $email  = esc_attr( $_POST['stripeEmail'] );
    $amount = esc_attr( $_POST['amount'] );
    $description = esc_attr( $_POST['description'] );

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'card'  => $token,
  ));
  $currency = isset( $ssp_general_settings['ssp_currency_type'] ) ? $ssp_general_settings['ssp_currency_type'] : 'USD';
  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount,
      'description' => $description,
      'currency' => $ssp_general_settings['ssp_currency_type']
  ));
}