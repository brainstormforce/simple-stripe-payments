<?php

require_once( STRIPE_BASE_DIR . '/lib/stripe/init.php');

global $stripe_options;

if( isset($stripe_options['test_mode'] ) && $stripe_options['test_mode'] ) {
	$secret_key = $stripe_options['test_secret_key'];
	$publishable_key = $stripe_options['test_publishable_key'];
}else {
	$secret_key = $stripe_options['live_secret_key'];
	$publishable_key = $stripe_options['live_publishable_key'];
}

$stripe = array(
  secret_key      => $secret_key,
  publishable_key => $publishable_key
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
