<?php
/**
 * Admin Controller
 * @fileoverview Functions for setup and control of plugin admin areas.
 * @package WordPress
 */

/**
 * Admin Menu
 * @desc Sets up admin menu items.
 */
add_action( 'admin_menu', 'rnkrwp_menu' );
function rnkrwp_menu(){

	//Setup menus
	$rnkrwp_options		= add_options_page( __( 'Ranker Plugin Options', 'rnkrwp' ), __( 'Ranker Options', 'rnkrwp' ), 'manage_options', 'rnkrwp-options', 'rnkrwp_plugin_options' );
	$rnkrwp_shortcodes	= add_submenu_page( 'rnkrwp-options', __( 'Ranker Widget Shortcodes', 'rnkrwp' ), __( 'Ranker Shortcodes', 'rnkrwp' ), 'manage_options', 'rnkrwp-shortcodes', 'rnkrwp_plugin_shortcodes' );
	//Add resources
	add_action( "admin_print_scripts-$rnkrwp_options", 'rnkrwp_admin_head' );
	add_action( "admin_print_scripts-$rnkrwp_shortcodes", 'rnkrwp_admin_head' );
	
}

/**
 * Setup Options Page
 * @desc Setup options page display.
 */
function rnkrwp_plugin_options(){

	//Check manage level
	if( !current_user_can( 'manage_options' ) ){
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	//Include file
	require_once RNKRWP_PLUGIN_ADMIN_DIR.'/options.php';
	
}

/**
 * Setup Shortcodes Page
 * @desc Setup widget shortcodes page.
 */
function rnkrwp_plugin_shortcodes(){

	//Check manage level
	if( !current_user_can( 'manage_options' ) ){
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	//Include file
	require_once RNKRWP_PLUGIN_ADMIN_DIR.'/shortcodes.php';
	
}

/**
 * Setup Admin Head
 * @desc Setup files to load in the admin <head> section.
 */
function rnkrwp_admin_head(){

	//Load CSS
	echo "<link rel='stylesheet' href='".RNKRWP_PLUGIN_URL."/css/jquery.minicolors.css' type='text/css' />\n";
	echo "<link rel='stylesheet' href='".RNKRWP_PLUGIN_URL."/css/admin.css' type='text/css' />\n";
	
	//Load JS Utils
	require_once RNKRWP_PLUGIN_ADMIN_DIR.'/utils.php';
	
	//Load Scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'color', RNKRWP_PLUGIN_URL.'/js/jquery.minicolors.min.js', '', null );
	wp_enqueue_script( 'admin', RNKRWP_PLUGIN_URL.'/js/admin.js', '', null );

}

?>