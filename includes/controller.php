<?php 
/**
 * Plugin Controller
 * @fileoverview Functions for setup and control of shortcodes used in WP Posts.
 * @package WordPress
 */

/**
 * Load Ranker
 * @desc Load external Ranker widget controller scripts into footer.
 */
add_action( 'init', 'rnkrwp_place_scripts' );
function rnkrwp_place_scripts(){
	
	//Add default preferences to page
	add_action( 'wp_footer', 'rnkrwp_place_defaults' );
	function rnkrwp_place_defaults(){
		
		//Get preferences
		$rnkrwp_prefs	= get_option( 'rnkrwp' );
		$rows			= $rnkrwp_prefs['rows'];
		$show_user		= $rnkrwp_prefs['show_user'];
		$show_link		= $rnkrwp_prefs['show_link'];
		$bg				= $rnkrwp_prefs['bg'];
		$highlight		= $rnkrwp_prefs['highlight'];
		$title_color	= $rnkrwp_prefs['title_color'];
		$title_font		= $rnkrwp_prefs['title_font'];
		$item_font		= $rnkrwp_prefs['item_font'];
		
		//Adjust color values
		$bg				= preg_replace('(\#)', '', $bg);
		$title_color	= preg_replace('(\#)', '', $title_color);
		
		//Adjust booleans
		if( $show_user ){
			$show_user	= 'true';
		}
		else{
			$show_user	= 'false';
		}
		
		//Build HTML output
		$defaultHTML = '<script>var _RNKW_pref = {';
		$defaultHTML .= 'rows:"'.$rows.'",';
		$defaultHTML .= 'showUser:"'.$show_user.'",';
		$defaultHTML .= 'bg:"'.$bg.'",';
		$defaultHTML .= 'highlight:"'.$highlight.'",';
		$defaultHTML .= 'titleColor:"'.$title_color.'",';
		$defaultHTML .= 'titleFont:"'.$title_font.'",';
		$defaultHTML .= 'itemFont:"'.$item_font.'"';
		$defaultHTML .= "};</script>\n";
		
		//Output HTML
		echo $defaultHTML;
		
	}
	
	//Only load on non-admin pages
	if( !is_admin() ) wp_enqueue_script('rnkw', 'http://cdn.widget.ranker.com/static/rnkw.js', '', null, true);
	
}

/**
 * Define Shortcode
 * @desc Add shortcode to WP and process found codes.
 * @param {object} $atts Attributes of shortcode.
 * Shortcode: [rnkrwp id="" height="" (optional: url="" name="")]
 */
function rnkrwp_shortcode( $atts ){
	
	//Extract attributes
	extract( shortcode_atts(array(
		'id'		=> null,
		'height'	=> null,
		'url'		=> null,
		'name'		=> null
	), $atts) );

	return rnkrwp_process_shortcode( $id, $height, $url, $name );
}
add_shortcode( 'rnkrwp', 'rnkrwp_shortcode' );

/**
 * Process Shortcodes
 * @desc Handle shortcode attributes and output needed DOM elements.
 * @param {string} id ID of list to load (required).
 * @param {string} height Total height of widget to display (required).
 * @param {string} url URL of list to link to (optional - only used if show_link is true).
 * @param {string} name Title of the list widget (optional - only used if show_link is true).
 */
function rnkrwp_process_shortcode( $id, $height, $url, $name ){
	
	//Get widget options
	$rnkrwp_prefs	= get_option( 'rnkrwp' );
	$width			= $rnkrwp_prefs['width'];
	$show_link		= $rnkrwp_prefs['show_link'];
	//Normalize values
	$url			= urldecode( $url );
	$name			= urldecode( $name );
	
	//Build output HTML
	$pluginHTML = "<div class='rnkw-lists' data-rnkw-width='{$width}' data-rnkw-height='{$height}' data-rnkw-id='{$id}'></div>";
	
	//Check if link to show
	if( $show_link ) $pluginHTML .= "<a href='{$url}' style='display:block; width:{$width}px; padding-top:7px; font-size:12px; text-align:center;'>{$name}</a>";
	
	//Output HTML
	return $pluginHTML;
	
}

?>