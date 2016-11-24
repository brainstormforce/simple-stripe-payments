<?php

function bsf_stripe_payment_form() {
	$output= '';
	$output.='<div class="bsf-amount-feild">';
	$output.='<input type="number" placeholder="'. __('Please enter amount here...', 'simple-stripe-payments') .'" id="bsf-amount" name="bsf-amount" value="" required/>';
	$output.='</div>';
	$output.='<div class="bsf-description-feild">';
	$output.='<textarea id="bsf-amount-description" placeholder="'. __('Please enter amount description...', 'simple-stripe-payments') .'" name="bsf-amount-description" value="" required/>';
	$output.='</textarea></div>';
	$output.='<div class="bsf-payment-button">';
	$output.='<button id="bsfStripeButton">' . __('Pay Now ', 'simple-stripe-payments') . '</button>';
	$output.='</div>';
	return $output;
}
add_shortcode('simple_stripe_payments_form', 'bsf_stripe_payment_form');

