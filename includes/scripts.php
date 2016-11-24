<?php

function bsf_load_stripe_scripts() {
	
	global $stripe_options;
	
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
        )
    );

    wp_enqueue_script( 'stripe_processing' );
}
add_action('wp_enqueue_scripts', 'bsf_load_stripe_scripts');