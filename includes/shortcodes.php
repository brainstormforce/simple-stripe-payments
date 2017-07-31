<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'SSP_Payment_Shortcode' ) ) :

class SSP_Payment_Shortcode {	
	public function __construct() {
		add_shortcode('ssp_payments_form', array( $this, 'ssp_ssp_payment_form') );		
	}
	function ssp_ssp_payment_form() {
		global $ssp_general_settings;
		$var = $ssp_general_settings['form_button_title'];
		$color = $ssp_general_settings['form_button_color'];

		$output= '';
		$output.='<div class="ssp-amount-feild">';
		$output.='<input type="number" placeholder="'. __('Please enter amount here...', 'simple-stripe-payments') .'" id="ssp-amount" name="ssp-amount" value="" required/>';
		$output.='</div>';
		$output.='<div class="ssp-description-feild">';
		$output.='<textarea id="ssp-amount-description" placeholder="'. __('Please enter amount description...', 'simple-stripe-payments') .'" name="ssp-amount-description" value="" required/>';
		$output.='</textarea></div>';
		$output.='<div class="ssp-payment-button" >';
		$output.='<button id="bsfStripeButton">' . __($var, 'simple-stripe-payments') . '</button>';
		$output.='</div>';
		
		wp_enqueue_script('stripe', 'https://checkout.stripe.com/checkout.js');
		wp_enqueue_script( 'ssp-processing' );

		return $output;
	}
}

endif;

new SSP_Payment_Shortcode();