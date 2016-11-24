<?php
function bsf_stripe_payment_form() {
	$output= '';
	$output.='<div class="bsf-amount-feild">';
	$output.='<input type="number" placeholder="Please enter amount here..." id="bsf-amount" name="bsf-amount" value="" required/>';
	$output.='</div>';
	$output.='<div class="bsf-description-feild">';
	$output.='<textarea id="bsf-amount-description" placeholder="Please enter amount description..." name="bsf-amount-description" value="" required/>';
	$output.='</textarea></div>';
	$output.='<div class="bsf-payment-button">';
	$output.='<button id="bsfStripeButton">Pay Now</button>';
	$output.='</div>';
	return $output;
}
add_shortcode('simple_stripe_payments_form', 'bsf_stripe_payment_form');