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
		$rnkrwp_prefs			= get_option( 'rnkrwp' );
		$header_show_image		= $rnkrwp_prefs['header_show_image'];
		$header_show_username	= $rnkrwp_prefs['header_show_username'];
		$header_show_criteria	= $rnkrwp_prefs['header_show_criteria'];
		$header_bgcolor			= $rnkrwp_prefs['header_bgcolor'];
		$header_fontcolor		= $rnkrwp_prefs['header_fontcolor'];
		$header_fontface		= $rnkrwp_prefs['header_fontface'];
		$list_fontcolor			= $rnkrwp_prefs['list_fontcolor'];
		$list_fontface			= $rnkrwp_prefs['list_fontface'];
		$footer_bgcolor			= $rnkrwp_prefs['footer_bgcolor'];
		
		//Adjust color values
		$header_bgcolor			= preg_replace('(\#)', '', $header_bgcolor);
		$header_fontcolor		= preg_replace('(\#)', '', $header_fontcolor);
		$list_fontcolor			= preg_replace('(\#)', '', $list_fontcolor);
		$footer_bgcolor			= preg_replace('(\#)', '', $footer_bgcolor);
		
		//Adjust booleans
		if( $header_show_image ){
			$header_show_image		= 'true';
		}
		else{
			$header_show_image		= 'false';
		}
		if( $header_show_username ){
			$header_show_username	= 'true';
		}
		else{
			$header_show_username	= 'false';
		}
		if( $header_show_criteria ){
			$header_show_criteria	= 'true';
		}
		else{
			$header_show_criteria	= 'false';
		}
		
		//Build HTML output
		$defaultHTML = '<script>var RNKRW = RNKRW || {};';
		$defaultHTML .= 'RNKRW.pref = {';
			$defaultHTML .= 'header	: {';
				$defaultHTML .= 'image		: '.$header_show_image.',';
				$defaultHTML .= 'username	: '.$header_show_username.',';
				$defaultHTML .= 'criteria	: '.$header_show_criteria.',';
				$defaultHTML .= 'bgcolor	: "'.$header_bgcolor.'",';
				$defaultHTML .= 'fontface	: "'.$header_fontface.'",';
				$defaultHTML .= 'fontcolor	: "'.$header_fontcolor.'"';
			$defaultHTML .= '},';
			$defaultHTML .= 'list	: {';
				$defaultHTML .= 'fontface	: "'.$list_fontface.'",';
				$defaultHTML .= 'fontcolor	: "'.$list_fontcolor.'"';
			$defaultHTML .= '},';
			$defaultHTML .= 'footer	: {';
				$defaultHTML .= 'bgcolor	: "'.$footer_bgcolor.'"';
			$defaultHTML .= '}';
		$defaultHTML .= "};</script>\n";
		
		//Output HTML
		echo $defaultHTML;
		
	}
	
	//Only load on non-admin pages
	if( !is_admin() ) wp_enqueue_script( 'rnkw', '//cdn.widget.ranker.com/static/rnkrw2.js', '', null, true );
	
}

/**
 * Define Shortcode
 * @desc Add shortcode to WP and process found codes.
 * @param {object} $atts Attributes of shortcode.
 * Shortcode: [rnkrwp id="" rows="" url="" name=""]
 */
function rnkrwp_shortcode( $atts ){
	
	//Extract attributes
	extract( shortcode_atts(array(
		'id'		=> null,
		'rows'		=> null,
		'url'		=> null,
		'name'		=> null
	), $atts) );

	return rnkrwp_process_shortcode( $id, $rows, $url, $name );
}
add_shortcode( 'rnkrwp', 'rnkrwp_shortcode' );

/**
 * Process Shortcodes
 * @desc Handle shortcode attributes and output needed DOM elements.
 * @param {string} id ID of list to load (required).
 * @param {string} rows Amount of rows to display before scrolling (Optional - if no rows default option will be taken).
 * @param {string} url URL of list to link to (required).
 * @param {string} name Title of the list widget (required).
 */
function rnkrwp_process_shortcode( $id, $rows, $url, $name ){
	
	//Get widget options
	$rnkrwp_prefs	= get_option( 'rnkrwp' );
	$width			= $rnkrwp_prefs['size_width'];
	//Check for values
	if( $rows == null || $rows == '' ) $rows = $rnkrwp_prefs['size_rows'];
	if( $url == null || $url == '' ) $url = 'http://www.ranker.com/widget/info.htm';
	if( $name == null || $name == '' ) $name = 'Widget by Ranker';
	//Normalize values
	$url			= urldecode( $url );
	$name			= urldecode( $name );
	
	//Build output HTML
	$pluginHTML = "<a role='link' class='rnkrw-widget' data-rnkrw-id='{$id}' data-rnkrw-width='{$width}' data-rnkrw-rows='{$rows}' href='{$url}'>{$name}</a>";
	
	//Output HTML
	return $pluginHTML;
	
}

?>