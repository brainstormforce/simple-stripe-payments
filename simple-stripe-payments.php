<?php
/**
 * Plugin Name: Simple Stripe Payments
 * Plugin URI: http://brainstormforce.com/
 * Description: Simple Stripe Payments is a WordPress plugin designed to make it easy for you  accept payments from your WordPress site.
 * Author: brainstormforce
 * Author URI: http://brainstormforce.com/
 * Contributors: Anil
 * Version: 1.0
 * Text Domain: simple-stripe-payments
*/

//Slug - ssp_

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**********************************
* Constants and globals
**********************************/

if(!defined('SSP_BASE_URL')) {
	define('SSP_BASE_URL', plugin_dir_url(__FILE__));
}
if(!defined('SSP_BASE_DIR')) {
	define('SSP_BASE_DIR', dirname(__FILE__));
}

$ssp_options = get_option('ssp_settings', array() );
$ssp_general_settings = get_option('ssp_general_settings', array() );

/*******************************************
* Plugin text domain for translations
*******************************************/

load_plugin_textdomain( 'simple-stripe-payments', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/*******************************************
* Declared global setting variables
*******************************************/

if ( !array_key_exists( 'test_mode', $ssp_options ) ) {
	$ssp_options['test_mode'] = false;
}

if ( !array_key_exists( 'live_secret_key', $ssp_options ) ) {
	$ssp_options['live_secret_key'] = '';
}

if ( !array_key_exists( 'live_publishable_key', $ssp_options ) ) {
	$ssp_options['live_publishable_key'] = '';
}

if ( !array_key_exists( 'test_secret_key', $ssp_options ) ) {
	$ssp_options['test_secret_key'] = '';
}

if ( !array_key_exists( 'test_publishable_key', $ssp_options ) ) {
	$ssp_options['test_publishable_key'] = '';
}
if ( !array_key_exists( 'form_button_color', $ssp_general_settings ) ) {
    $ssp_general_settings['form_button_color'] = '';
}

if ( !array_key_exists( 'form_button_hover_color', $ssp_general_settings ) ) {
    $ssp_general_settings['form_button_hover_color'] = '';
}

if ( !array_key_exists( 'form_button_title_color', $ssp_general_settings ) ) {
    $ssp_general_settings['form_button_title_color'] = '';
}

if ( !array_key_exists( 'form_button_title_hover_color', $ssp_general_settings ) ) {
    $ssp_general_settings['form_button_title_hover_color'] = '';
}

/**********************************
* includes
**********************************/

include(SSP_BASE_DIR . '/includes/charge.php');

add_action( 'wp_ajax_ssp_create_payment', 'ssp_create_payment_callback' ); 
add_action( 'wp_ajax_nopriv_ssp_create_payment', 'ssp_create_payment_callback' );

if(is_admin()) {
	// load admin includes
	include(SSP_BASE_DIR . '/includes/settings.php');
	include(SSP_BASE_DIR . '/includes/backend-scripts.php');
	
} else {
// load front-end includes
include(SSP_BASE_DIR . '/includes/scripts.php');
include(SSP_BASE_DIR . '/includes/shortcodes.php');
}

if(!get_option('ssp_general_settings')) {
	$blog_tagline = get_bloginfo ( 'description' );
	$blog_title = get_bloginfo( 'name' );
    //not present, so add
    $ssp_option = array(
        'form_button_title' => 'Pay',
        'form_button_color' => '#3691b0',
        'form_button_title_color' => '#fff',
        'form_button_hover_color' => '#ADD8E6',
        'form_button_title_hover_color' => '#000',
        'ssp_title' => esc_attr( $blog_title) ,
        'tag_line_for_stripe' => esc_attr ( $blog_tagline ),
        'ssp_pay_button' => 'Pay',
        'ssp_currency_type' => 'USD'
    );
    add_option('ssp_general_settings', $ssp_option);
}