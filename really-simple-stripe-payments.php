<?php

/**
Plugin Name: Really Simple Stripe Payments
Plugin URI: http://brainstormforce.com/
Description: Really Simple Stripe Payments is a WordPress plugin designed to make it easy for you to accept payments from your WordPress site.
Author: brainstormforce
Author URI: http://brainstormforce.com/
Contributors: Anil
Version: 1.0
*/

//Slug - bsf_

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

/*******************************************
* Plugin text domain for translations
*******************************************/

load_plugin_textdomain( 'bsf_stripe', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/*******************************************
* Declared global setting variables
*******************************************/

if ( !array_key_exists( 'test_mode', $stripe_options ) ) {
	$stripe_options['test_mode'] = false;
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
} else {
// load front-end includes
include(STRIPE_BASE_DIR . '/includes/scripts.php');
include(STRIPE_BASE_DIR . '/includes/shortcodes.php');
}