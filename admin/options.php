<?php
/**
 * Build Options
 * @desc Build plugin options page and fill with data from DB.
 * @package WordPress
 */
function rnkrwp_build_options(){

	//Get preferences
	$rnkrwp_prefs	= get_option( 'rnkrwp' );
	//Pseudo preferences
	$size_rows					= $rnkrwp_prefs['size_rows'];
	$size_rows_all				= $rnkrwp_prefs['size_rows_all'];
	$header_show_name			= $rnkrwp_prefs['header_show_name'];
	$header_show_image			= $rnkrwp_prefs['header_show_image'];
	$header_show_username		= $rnkrwp_prefs['header_show_username'];
	$header_show_criteria		= $rnkrwp_prefs['header_show_criteria'];
	$header_bgcolor				= $rnkrwp_prefs['header_bgcolor'];
	$header_fontcolor			= $rnkrwp_prefs['header_fontcolor'];
	$header_fontface			= $rnkrwp_prefs['header_fontface'];
	$list_displaythumbnails		= $rnkrwp_prefs['list_displaythumbnails'];
	$list_displaydescriptions	= $rnkrwp_prefs['list_displaydescriptions'];
	$list_slidebgcolor			= $rnkrwp_prefs['list_slidebgcolor'];
	$list_fontcolor				= $rnkrwp_prefs['list_fontcolor'];
	$list_fontface				= $rnkrwp_prefs['list_fontface'];
	$footer_bgcolor				= $rnkrwp_prefs['footer_bgcolor'];
	
?>

<div id="rnkrWrap">
<form action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>?page=<?php echo $_GET['page']; ?>" method="post">
	<?php
		if( function_exists('wp_nonce_field') ) wp_nonce_field('rnkrwp-options_update'); 
	?>

	<h1><?php esc_html_e( 'Ranker Plugin - Display Options', 'rnkrwp' ) ?></h1>
	
	<div class="eolWarning">
		!!!This Plugin has reached End of Life!!! - Please upgrade to <strong><em>Polling Widget: Ranker Lists</em></strong> to continue receiving updates.
	</div>
	
	<ul id="rnkrSubMenu">
		<li class="selected">
			<a href="<?php menu_page_url( 'rnkrwp-options', true ); ?>" target="_self" title="<?php _e( 'Setup defaults for Ranker widgets', 'rnkrwp' ) ?>">
				<?php esc_html_e( 'Display Options', 'rnkrwp' ) ?></a>
		</li>
		<li>
			<a href="<?php menu_page_url( 'rnkrwp-shortcodes', true ); ?>" target="_self" title="<?php _e( 'Use this tool to create shortcodes for your posts', 'rnkrwp' ) ?>">
				<?php esc_html_e( 'Create Shortcodes', 'rnkrwp' ) ?></a>
		</li>
	</ul>
	<?php echo $logMessage ?>
	
	<p class="clear">
		<?php esc_html_e( 'These are the default display settings for all Ranker widgets used in posts.', 'rnkrwp' ); ?><br/>
	</p>
	
	<h2><?php esc_html_e( 'Height', 'rnkrwp' ); ?></h2>
	<ul>
		<li>
			<input type="text" id="rnkrwp_size-rows" name="size_rows" value="<?php if( $size_rows != 999 ) echo $size_rows ?>"<?php if( $size_rows_all ) echo ' disabled="true"'; ?> size="3"/> 
			<?php esc_html_e( 'rows', 'rnkrwp' ); ?>&nbsp;&nbsp;
			<input type="checkbox" id="rnkrwp_size-rowsall" name="size_rows_all" <?php if( $size_rows_all ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'display all rows', 'rnkrwp' ); ?>
		</li>
	</ul>
	
	<h2><?php esc_html_e( 'Header', 'rnkrwp' ); ?></h2>
	<ul>
		<li><strong><?php esc_html_e( 'List Details', 'rnkrwp' ); ?>:</strong></li>
		<li>
			<input type="checkbox" name="header_show_name" value="1"<?php if( $header_show_name ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Show list name', 'rnkrwp' ); ?>
		</li>
		<li>
			<input type="checkbox" name="header_show_image" value="1"<?php if( $header_show_image ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Show list image', 'rnkrwp' ); ?>
		</li>
		<li>
			<input type="checkbox" name="header_show_username" value="1"<?php if( $header_show_username ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Show username', 'rnkrwp' ); ?>
		</li>
		<li>
			<input type="checkbox" name="header_show_criteria" value="1"<?php if( $header_show_criteria ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Show list criteria', 'rnkrwp' ); ?>
		</li>
		<li>
			<strong><?php esc_html_e( 'Background', 'rnkrwp' ); ?>:</strong> <?php esc_html_e( 'select a color', 'rnkrwp' ); ?> <span class="picker" id="rnkrwp_header-bgcolor_pick"></span> 
			<input type="text" id="rnkrwp_header-bgcolor" name="header_bgcolor" value="<?php echo $header_bgcolor; ?>" size="10"/> 
		</li>
		<li>
			<strong><?php esc_html_e( 'Title', 'rnkrwp' ); ?>:</strong> <?php esc_html_e( 'select a color &amp; font style', 'rnkrwp' ); ?><br/>
			<span class="picker" id="rnkrwp_header-fontcolor_pick"></span> 
			<input type="text" id="rnkrwp_header-fontcolor" name="header_fontcolor" value="<?php echo $header_fontcolor; ?>" size="10"/>&nbsp;&nbsp;<select name="header_fontface">
				<option<?php if( $header_fontface == 'arial' ) echo ' selected="selected"'; ?>>arial</option>
				<option<?php if( $header_fontface == 'helevtica' ) echo ' selected="selected"'; ?>>helevtica</option>
				<option<?php if( $header_fontface == 'verdana' ) echo ' selected="selected"'; ?>>verdana</option>
				<option<?php if( $header_fontface == 'geneva' ) echo ' selected="selected"'; ?>>geneva</option>
				<option<?php if( $header_fontface == 'times' ) echo ' selected="selected"'; ?>>times</option>
				<option<?php if( $header_fontface == 'georgia' ) echo ' selected="selected"'; ?>>georgia</option>
			</select> 
		</li>
	</ul>
	
	<h2><?php esc_html_e( 'List', 'rnkrwp' ); ?></h2>
	<ul>
		<li>
			<input type="checkbox" name="list_displaythumbnails" value="1"<?php if( $list_displaythumbnails ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Display Thumbnail Gallery', 'rnkrwp' ); ?>
		</li>
		<li>
			<input type="checkbox" name="list_displaydescriptions" value="1"<?php if( $list_displaydescriptions ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Display Item Descriptions', 'rnkrwp' ); ?>
		</li>
		<li>
			<strong><?php esc_html_e( 'Slide Background', 'rnkrwp' ); ?>:</strong> <?php esc_html_e( 'select a color', 'rnkrwp' ); ?><br/>
			<span id="rnkrwp_list-slidebgcolor_000000" class="inlineBlock slideBgColor colorSelect pointer<?php if( $list_slidebgcolor == '000000' ) echo ' selected'; ?>" title="Black"></span>
			<span id="rnkrwp_list-slidebgcolor_f1f1f1" class="inlineBlock slideBgColor colorSelect pointer<?php if( $list_slidebgcolor == 'f1f1f1' ) echo ' selected'; ?>" title="Light Grey"></span>
			<span id="rnkrwp_list-slidebgcolor_ffffff" class="inlineBlock slideBgColor colorSelect pointer<?php if( $list_slidebgcolor == 'ffffff' ) echo ' selected'; ?>" title="white"></span>
			<input type="hidden" id="rnkrwp_list-slidebgcolor" name="list_slidebgcolor" value="<?php echo $list_slidebgcolor; ?>"/>
		</li>
		<li>
			<strong><?php esc_html_e( 'Items', 'rnkrwp' ); ?>:</strong> <?php esc_html_e( 'select a color &amp; font style', 'rnkrwp' ); ?><br/>
			<span class="picker" id="rnkrwp_list-fontcolor_pick"></span> 
			<input type="text" id="rnkrwp_list-fontcolor" name="list_fontcolor" value="<?php echo $list_fontcolor; ?>" size="10"/>&nbsp;&nbsp;<select name="list_fontface">
				<option<?php if( $list_fontface == 'arial' ) echo ' selected="selected"'; ?>>arial</option>
				<option<?php if( $list_fontface == 'helevtica' ) echo ' selected="selected"'; ?>>helevtica</option>
				<option<?php if( $list_fontface == 'verdana' ) echo ' selected="selected"'; ?>>verdana</option>
				<option<?php if( $list_fontface == 'geneva' ) echo ' selected="selected"'; ?>>geneva</option>
				<option<?php if( $list_fontface == 'times' ) echo ' selected="selected"'; ?>>times</option>
				<option<?php if( $list_fontface == 'georgia' ) echo ' selected="selected"'; ?>>georgia</option>
			</select>
		</li>
	</ul>
	
	<h2><?php esc_html_e( 'Footer', 'rnkrwp' ); ?></h2>
	<ul>
		<li>
			<strong><?php esc_html_e( 'Background', 'rnkrwp' ); ?>:</strong> <?php esc_html_e( 'select a color', 'rnkrwp' ); ?><br/>
			<span id="rnkrwp_footColor_b81507" class="footBgColor colorSelect<?php if( $footer_bgcolor == 'b81507' ) echo ' selected'; ?>"></span>
			<span id="rnkrwp_footColor_fc6d04" class="footBgColor colorSelect<?php if( $footer_bgcolor == 'fc6d04' ) echo ' selected'; ?>"></span>
			<span id="rnkrwp_footColor_186017" class="footBgColor colorSelect<?php if( $footer_bgcolor == '186017' ) echo ' selected'; ?>"></span>
			<span id="rnkrwp_footColor_1e3e66" class="footBgColor colorSelect<?php if( $footer_bgcolor == '1e3e66' ) echo ' selected'; ?>"></span>
			<span id="rnkrwp_footColor_553083" class="footBgColor colorSelect<?php if( $footer_bgcolor == '553083' ) echo ' selected'; ?>"></span>
			<span id="rnkrwp_footColor_5c5b5b" class="footBgColor colorSelect<?php if( $footer_bgcolor == '5c5b5b' ) echo ' selected'; ?>"></span>
			<span id="rnkrwp_footColor_000000" class="footBgColor colorSelect<?php if( $footer_bgcolor == '000000' ) echo ' selected'; ?>"></span>
			<input type="hidden" id="rnkrwp_footer-bgcolor" name="footer_bgcolor" value="<?php echo $footer_bgcolor; ?>"/>
		</li>
	</ul>
	
	<br/><input type="submit" id="rnkrwp_updateOptions" name="submit" value="<?php _e( 'SAVE CHANGES', 'rnkrwp' ); ?>"/>
	
</form>
</div>
<?php
}

/**
 * Update Options
 * @desc Handle post request and update options data.
 */
function rnkrwp_update_options(){

	//Authority check
	if( is_admin() && current_user_can('manage_options') ){
	
		check_admin_referer( 'rnkrwp-options_update' );
		
		//Get current data
		$current	= get_option( 'rnkrwp' );
		
		//Get updates
		$size_rows					= $_POST['size_rows'];
		$size_rows_all				= $_POST['size_rows_all'];
		$header_show_name			= $_POST['header_show_name'];
		$header_show_image			= $_POST['header_show_image'];
		$header_show_username		= $_POST['header_show_username'];
		$header_show_criteria		= $_POST['header_show_criteria'];
		$header_bgcolor				= $_POST['header_bgcolor'];
		$header_fontcolor			= $_POST['header_fontcolor'];
		$header_fontface			= $_POST['header_fontface'];
		$list_displaythumbnails		= $_POST['list_displaythumbnails'];
		$list_displaydescriptions	= $_POST['list_displaydescriptions'];
		$list_slidebgcolor			= $_POST['list_slidebgcolor'];
		$list_fontcolor				= $_POST['list_fontcolor'];
		$list_fontface				= $_POST['list_fontface'];
		$footer_bgcolor				= $_POST['footer_bgcolor'];
		
		//Check rows
		if( $size_rows_all ) $size_rows = 999;
	
		//Create options array
		$options = array(
					'size_rows'					=> $size_rows,
					'size_rows_all'				=> $size_rows_all,
					'header_show_name'			=> $header_show_name,
					'header_show_image'			=> $header_show_image,
					'header_show_username'		=> $header_show_username,
					'header_show_criteria'		=> $header_show_criteria,
					'header_bgcolor'			=> $header_bgcolor,
					'header_fontcolor'			=> $header_fontcolor,
					'header_fontface'			=> $header_fontface,
					'list_displaythumbnails'	=> $list_displaythumbnails,
					'list_displaydescriptions'	=> $list_displaydescriptions,
					'list_slidebgcolor'			=> $list_slidebgcolor,
					'list_fontcolor'			=> $list_fontcolor,
					'list_fontface'				=> $list_fontface,
					'footer_bgcolor'			=> $footer_bgcolor );
		//Store options
		update_option( 'rnkrwp', $options );
		
	}
	
	//Load options screen
	rnkrwp_build_options();

}

if( isset($_POST['submit']) ){
	rnkrwp_update_options();
}
else{
	rnkrwp_build_options();
}

?>