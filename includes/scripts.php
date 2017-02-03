<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class BSF_Scripts {

	public function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'bsf_load_stripe_scripts') );
		add_action( 'wp_head', array( $this, 'custom_css') );

	}

	function bsf_load_stripe_scripts() {
		
		global $stripe_options;
		global $stripe_general_settings;	
		// check to see if we are in test mode
		if( isset($stripe_options['test_mode']) && $stripe_options['test_mode']) {
			$publishable = $stripe_options['test_publishable_key'];
		} else {
			$publishable = $stripe_options['live_publishable_key'];
		}

		wp_enqueue_style('style', STRIPE_BASE_URL . 'assets/css/style.css');
		wp_enqueue_script('jquery');
		wp_enqueue_script('stripe', 'https://checkout.stripe.com/checkout.js');
		wp_register_script( 'stripe_processing', STRIPE_BASE_URL . 'includes/js/stripe-processing.js');

		wp_localize_script( 'stripe_processing', 'bsf_stripe',
	        array( 
	            'ajaxurl' => admin_url( 'admin-ajax.php' ),        
	            'publishable_key' => $publishable,
	            'stripe_title' => $stripe_general_settings['stripe_title'],
	         	'stripe_tagline' => $stripe_general_settings['tag_line_for_stripe'],
	      		'stripe_button_text' => $stripe_general_settings['stripe_pay_button'],
	      		'stripe_currency' => $stripe_general_settings['stripe_currency_type']	   
	        )
	    );

	    wp_enqueue_script( 'stripe_processing' );
	}
	function custom_css() {
		global $stripe_general_settings;
		$color = $stripe_general_settings['form_button_color'];
		$hovercolor = $stripe_general_settings['form_button_hover_color'];
		$title_color = $stripe_general_settings['form_button_title_color'];
		$title_hovercolor = $stripe_general_settings['form_button_title_hover_color'];
		?>

		<style type="text/css">

			#bsfStripeButton {
				background:<?php echo $color ?>;
				color:<?php echo $title_color ?>;;
			}
			#bsfStripeButton:hover {
				background:<?php echo $hovercolor ?>;
				color:<?php echo $title_hovercolor ?>;;
			}
		</style><?php
	}

}
new BSF_Scripts();