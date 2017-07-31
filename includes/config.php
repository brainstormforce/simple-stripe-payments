<?php

require_once( SSP_BASE_DIR . '/lib/stripe/init.php');

global $ssp_options;

if( isset($ssp_options['test_mode'] ) && $ssp_options['test_mode'] ) {
	$secret_key = $ssp_options['test_secret_key'];
	$publishable_key = $ssp_options['test_publishable_key'];
}else {
	$secret_key = $ssp_options['live_secret_key'];
	$publishable_key = $ssp_options['live_publishable_key'];
}

$stripe = array(
  secret_key      => $secret_key,
  publishable_key => $publishable_key
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
