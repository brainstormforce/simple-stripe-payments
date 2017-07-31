<?php

// If this file is called directly, abort. 
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

add_action( 'admin_enqueue_scripts', 'ssp_color_picker_assets' );

function ssp_color_picker_assets() {
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_style( 'dashboard-style' , plugins_url('../assets/css/backend-style.css', __FILE__  ) );
	    wp_enqueue_script( 'ssp-script-handle', plugins_url('../assets/js/jquery.custom.js', __FILE__  ), array( 'wp-color-picker' ), false, true );
}
