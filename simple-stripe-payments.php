<?php
/**
Plugin Name: Simple Stripe Payments
Plugin URI: http://brainstormforce.com/
Description: Simple Stripe Payments is a WordPress plugin designed to make it easy for you  accept payments from your WordPress site.
Author: brainstormforce
Author URI: http://brainstormforce.com/
Contributors: Anil
Version: 1.0
Text Domain: simple-stripe-payments
*/

//Slug - bsf_

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**********************************
* Constants and globals
**********************************/

if(!defined('STRIPE_BASE_URL')) {
	define('STRIPE_BASE_URL', plugin_dir_url(__FILE__));
}
if(!defined('STRIPE_BASE_DIR')) {
	define('STRIPE_BASE_DIR', dirname(__FILE__));
}

$stripe_options = get_option('stripe_settings');
$stripe_general_settings = get_option('stripe_general_settings');

/*******************************************
* Plugin text domain for translations
*******************************************/

load_plugin_textdomain( 'simple-stripe-payments', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/*******************************************
* Declared global setting variables
*******************************************/

if ( !array_key_exists( 'test_mode', $stripe_options ) ) {
	$stripe_options['test_mode'] = 'false';
}

if ( !array_key_exists( 'live_secret_key', $stripe_options ) ) {
	$stripe_options['live_secret_key'] = '';
}

if ( !array_key_exists( 'live_publishable_key', $stripe_options ) ) {
	$stripe_options['live_publishable_key'] = '';
}

if ( !array_key_exists( 'test_secret_key', $stripe_options ) ) {
	$stripe_options['test_secret_key'] = '';
}

if ( !array_key_exists( 'test_publishable_key', $stripe_options ) ) {
	$stripe_options['test_publishable_key'] = '';
}


/**********************************
* includes
**********************************/

include(STRIPE_BASE_DIR . '/includes/charge.php');

function add_ajax_actions() {
    add_action( 'wp_ajax_bsf_create_payment', 'bsf_create_payment_callback' ); 
	add_action( 'wp_ajax_nopriv_bsf_create_payment', 'bsf_create_payment_callback' );
}

add_action( 'init', 'add_ajax_actions' );


if(is_admin()) {
	// load admin includes
	include(STRIPE_BASE_DIR . '/includes/settings.php');
	include(STRIPE_BASE_DIR . '/includes/backend-scripts.php');
	
} else {
// load front-end includes
include(STRIPE_BASE_DIR . '/includes/scripts.php');
include(STRIPE_BASE_DIR . '/includes/shortcodes.php');
}


    if(!get_option('stripe_general_settings')) {
    	$blog_tagline = get_bloginfo ( 'description' );
    	$blog_title = get_bloginfo( 'name' );
        //not present, so add
        $op = array(
            'form_button_title' => 'Pay',
            'form_button_color' => '#3691b0',
            'form_button_title_color' => '#fff',
            'form_button_hover_color' => '#ADD8E6',
            'form_button_title_hover_color' => '#000',
            'stripe_title' => $blog_title,
            'tag_line_for_stripe' => $blog_tagline,
            'stripe_pay_button' => 'Pay',
            'stripe_currency_type' => 'USD'
        );
        add_option('stripe_general_settings', $op);
    }

?>