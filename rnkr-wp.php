<?php
/*
Plugin Name: Ranker List Widget
Plugin URI: http://www.ranker.com/widget
Description: Add a Ranker list widget to your Posts.
Version: 2.0.1
Author: Ranker, Inc
Author URI: http://www.ranker.com
License: GPL2
*/

/*	
	Copyright 2012  Ranker Inc  (email : feedback@ranker.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Setup Plugin
 * @fileoverview Setups plugin defaults, constants, L10N and routes to controllers.
 * @package WordPress
 */

//Define Constants
define( 'RNKRWP_VERSION', '2.0.1' );
define( 'RNKRWP_REQUIRED_WP_VERSION', '3.4' );

if(!defined( 'RNKRWP_PLUGIN_BASENAME' )) define( 'RNKRWP_PLUGIN_BASENAME', plugin_basename(__FILE__) );
if(!defined( 'RNKRWP_PLUGIN_NAME' )) define( 'RNKRWP_PLUGIN_NAME', trim(dirname(RNKRWP_PLUGIN_BASENAME), '/') );
if(!defined( 'RNKRWP_PLUGIN_DIR' )) define( 'RNKRWP_PLUGIN_DIR', WP_PLUGIN_DIR.'/'.RNKRWP_PLUGIN_NAME );
if(!defined( 'RNKRWP_PLUGIN_URL' )) define( 'RNKRWP_PLUGIN_URL', WP_PLUGIN_URL.'/'.RNKRWP_PLUGIN_NAME );
if(!defined( 'RNKRWP_PLUGIN_ADMIN_DIR' )) define( 'RNKRWP_PLUGIN_ADMIN_DIR', RNKRWP_PLUGIN_DIR.'/admin' );
if(!defined( 'RNKRWP_PLUGIN_INC_DIR' )) define( 'RNKRWP_PLUGIN_INC_DIR', RNKRWP_PLUGIN_DIR.'/includes' );

/**
 * Init Plugin
 * @desc Initialize plugin and ensure DB options exist.
 */
add_action( 'init', 'rnkrwp_init' );
function rnkrwp_init(){

	//Create options array
	$options = array(
					'size_option'			=> 'medium',
					'size_width'			=> '450',
					'size_rows'				=> '20',
					'size_rows_all'			=> false,
					'header_show_image'		=> false,
					'header_show_username'	=> false,
					'header_show_criteria'	=> false,
					'header_bgcolor'		=> 'ffffff',
					'header_fontcolor'		=> '000000',
					'header_fontface'		=> 'arial',
					'list_fontcolor'		=> '000000',
					'list_fontface'			=> 'arial',
					'footer_bgcolor'		=> '1e3e66' );
	
	$rnkrwp_prefs	= get_option( 'rnkrwp' );
	//Pseudo preferences
	$size_option	= $rnkrwp_prefs['size_option'];
	
	//Store options if they don't exist or update
	if( $size_option == null || $size_option == 'undefined' ){
		add_option( 'rnkrwp', $options );
		update_option( 'rnkrwp', $options );
	}
	else{
		add_option( 'rnkrwp', $options );
	}

	//Remove old changelog if exists
	delete_option( 'rnkrwp_cl' );
	
}

/**
 * L10N
 * @desc Setup localization.
 */
add_action( 'init', 'rnkrwp_load_plugin_textdomain' );
function rnkrwp_load_plugin_textdomain(){
	load_plugin_textdomain( 'rnkrwp', false, RNKRWP_PLUGIN_DIR.'/languages' );
}

//Load Controllers
if( is_admin() ){
	require_once RNKRWP_PLUGIN_ADMIN_DIR.'/admin.php';
}
else{
	require_once RNKRWP_PLUGIN_INC_DIR.'/controller.php';
}

?>