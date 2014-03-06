<?php 
/**
 * Admin Utilities
 * @fileoverview Utilities for handling admin specific data.
 * @package WordPress
 */

/**
 * Bind JS Vars
 * @desc Bind PHP data to JS vars for reuse.
 */
function rnkrwp_js_utils(){
	
	//Get preferences
	$rnkrwp_prefs = get_option( 'rnkrwp' );
	
	//Build util HTML
	$utilHTML = '<script>';
	//Setup RNKRWP JS
	$utilHTML .= 'var RNKRWP = {};';
	//Bind page to JS object
	$utilHTML .= "RNKRWP.page = '".$_GET['page']."';";
	//Bind show_link to JS object
	$utilHTML .= "RNKRWP.rows = '".$rnkrwp_prefs['size_rows']."';";
	$utilHTML .= "</script>\n";
	
	//Output HTML
	echo $utilHTML;
	
}
rnkrwp_js_utils();

/**
 * Is Boolean
 * @desc Converts PHP boolean values to expected JS boolean names.
 * @param {string} $value
 */
function rnkrwp_is_boolean( $value ){
	
	if( $value && strtolower( $value ) !== "false" ){
		return true;
	}
	else{
		return false;
	}
	
}
?>
