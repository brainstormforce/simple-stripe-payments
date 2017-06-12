<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'ssp_Payment_Shortcode' ) ) :

class SSP_Payment_Shortcode {	
	public function __construct() {
		add_shortcode('ssp_payments_form', array( $this, 'ssp_ssp_payment_form') );		
	}
	function ssp_ssp_payment_form() {
		global $ssp_general_settings;
		$var = $ssp_general_settings['form_button_title'];
		$color = $ssp_general_settings['form_button_color'];

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

new SSP_Payment_Shortcode();