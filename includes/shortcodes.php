<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'Simple_Stripe_Payment_Shortcode' ) ) :

class Simple_Stripe_Payment_Shortcode {	
	public function __construct() {
		add_shortcode('simple_stripe_payments_form', array( $this, 'bsf_stripe_payment_form') );		
	}
	function bsf_stripe_payment_form() {
		global $stripe_general_settings;
		$var = $stripe_general_settings['form_button_title'];
		$color = $stripe_general_settings['form_button_color'];

		$output= '';
		$output.='<div class="bsf-amount-feild">';
		$output.='<input type="number" placeholder="'. __('Please enter amount here...', 'simple-stripe-payments') .'" id="bsf-amount" name="bsf-amount" value="" required/>';
		$output.='</div>';
		$output.='<div class="bsf-description-feild">';
		$output.='<textarea id="bsf-amount-description" placeholder="'. __('Please enter amount description...', 'simple-stripe-payments') .'" name="bsf-amount-description" value="" required/>';
		$output.='</textarea></div>';
		$output.='<div class="bsf-payment-button" >';
		$output.='<button id="bsfStripeButton">' . __($var, 'simple-stripe-payments') . '</button>';
		$output.='</div>';
		return $output;
	}
}

endif;

new Simple_Stripe_Payment_Shortcode();