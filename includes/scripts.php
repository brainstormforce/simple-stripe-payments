<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'SSP_Payment_Scripts' ) ) :

class SSP_Payment_Scripts {

	public function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'ssp_load_ssp_scripts') );
		add_action( 'wp_head', array( $this, 'custom_css') );

	}

	function ssp_load_ssp_scripts() {
		
		global $ssp_options;
		global $ssp_general_settings;	
		// check to see if we are in test mode
		if( isset($ssp_options['test_mode']) && $ssp_options['test_mode']) {
			$publishable = $ssp_options['test_publishable_key'];
		} else {
			$publishable = $ssp_options['live_publishable_key'];
		}

		wp_enqueue_style('ssp_form_style', SSP_BASE_URL . 'assets/css/style.css');
		wp_register_script( 'ssp_processing', SSP_BASE_URL . 'includes/js/stripe-processing.js', array('jquery'));

		wp_localize_script( 'ssp_processing', 'ssp_stripe',
	        array( 
	            'ajaxurl' => admin_url( 'admin-ajax.php' ),        
	            'publishable_key' => $publishable,
	            'ssp_title' => $ssp_general_settings['ssp_title'],
	         	'ssp_tagline' => $ssp_general_settings['tag_line_for_stripe'],
	      		'ssp_button_text' => $ssp_general_settings['ssp_pay_button'],
	      		'ssp_currency' => $ssp_general_settings['ssp_currency_type']	   
	        )
	    );
	}
	function custom_css() {
		global $ssp_general_settings;
		$color = $ssp_general_settings['form_button_color'];
		$hovercolor = $ssp_general_settings['form_button_hover_color'];
		$title_color = $ssp_general_settings['form_button_title_color'];
		$title_hovercolor = $ssp_general_settings['form_button_title_hover_color'];
		?>

		<style type="text/css">

			#bsfStripeButton {
				background:<?php _e( $color ); ?>;
				color:<?php _e( $title_color ); ?>;
			}
			#bsfStripeButton:hover {
				background:<?php _e( $hovercolor ); ?>;
				color:<?php _e( $title_hovercolor ); ?>;;
			}
		</style><?php
	}

}

endif;

new SSP_Payment_Scripts();