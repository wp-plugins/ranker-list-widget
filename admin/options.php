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
	$size			= $rnkrwp_prefs['size'];
	$rows			= $rnkrwp_prefs['rows'];
	$show_user		= $rnkrwp_prefs['show_user'];
	$show_link		= $rnkrwp_prefs['show_link'];
	$bg				= $rnkrwp_prefs['bg'];
	$highlight		= $rnkrwp_prefs['highlight'];
	$title_color	= $rnkrwp_prefs['title_color'];
	$title_font		= $rnkrwp_prefs['title_font'];
	$item_font		= $rnkrwp_prefs['item_font'];
	
	//Get changelog
	$log			= get_option( 'rnkrwp_cl' );
	$logMessage		= '';
	//Check for updates
	if( $log[ 'changes' ] == true ){
		//Build message
		$logMessage = '<div id="reCalcSC"><span class="arrow"></span> <strong>' . __( 'Warning!', 'rnkrwp' ) .' </strong>' . 
						__( 'By changing these settings you may need to recalculate your shortcodes', 'rnkrwp' ) . ' : ' . $log['updated'] . '</div>';
		//Clear log
		$log = array(
					'changes'		=> false,
					'updated'		=> date("Ymd-Hi") );
		//Update changelog
		update_option( 'rnkrwp_cl', $log );
	}
?>

<div id="rnkrWrap">
<form action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>?page=<?php echo $_GET['page']; ?>" method="post">
	<?php
		if( function_exists('wp_nonce_field') ) wp_nonce_field('rnkrwp-options_update'); 
	?>

	<h1><?php esc_html_e( 'Ranker Plugin Options', 'rnkrwp' ) ?></h1>
	
	<ul id="rnkrSubMenu">
		<li class="selected">
			<a href="<?php menu_page_url( 'rnkrwp-options', true ); ?>" target="_self" title="<?php _e( 'Setup defaults for Ranker widgets', 'rnkrwp' ) ?>">
				<?php esc_html_e( 'Options', 'rnkrwp' ) ?></a>
		</li>
		<li>
			<a href="<?php menu_page_url( 'rnkrwp-shortcodes', true ); ?>" target="_self" title="<?php _e( 'Use this tool to create shortcodes for your posts', 'rnkrwp' ) ?>">
				<?php esc_html_e( 'Shortcodes', 'rnkrwp' ) ?></a>
		</li>
	</ul>
	<?php echo $logMessage ?>
	
	<p class="clear">
		<?php esc_html_e( 'These are the default settings for all Ranker widgets used in posts.', 'rnkrwp' ); ?><br/>
		<span class="note"><?php esc_html_e( '(please note: if you change the default width, number of rows or username display, you will need to re-generate all currently used shortcodes)' ); ?></span>
	</p>
	
	<h2><?php esc_html_e( 'Dimensions', 'rnkrwp' ); ?></h2>
	<ul>
		<li>
			<input type="radio" name="size" value="small"<?php if( $size == 'small' ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Small', 'rnkrwp' ); ?> (300px)
		</li>
		<li>
			<input type="radio" name="size" value="medium"<?php if( $size == 'medium' ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Medium', 'rnkrwp' ); ?> (450px)
		</li>
		<li>
			<input type="radio" name="size" value="large"<?php if( $size == 'large' ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Large', 'rnkrwp' ); ?> (600px)
		</li>
		<li>
			<input type="radio" name="size" value="custom"<?php if( $size == 'custom' ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Custom', 'rnkrwp' ); ?> 
			<input type="text" name="custom_value" size="5" value="<?php echo $rnkrwp_prefs['width']; ?>"/> px
		</li>
	</ul>
	
	<h2><?php esc_html_e( 'Options', 'rnkrwp' ); ?></h2>
	<ul>
		<li>
			<?php esc_html_e( 'Number of Rows at a time', 'rnkrwp' ); ?> : <select name="rows">
				<option<?php if( $rows == '5' ) echo ' selected="selected"'; ?>>5</option>
				<option<?php if( $rows == '10' ) echo ' selected="selected"'; ?>>10</option>
				<option<?php if( $rows == '15' ) echo ' selected="selected"'; ?>>15</option>
				<option<?php if( $rows == '25' ) echo ' selected="selected"'; ?>>25</option>
				<option<?php if( $rows == 'All' ) echo ' selected="selected"'; ?>>All</option>
			</select>
		</li>
		<li>
			<?php esc_html_e( 'Display Username', 'rnkrwp' ); ?> : 
			<input type="radio" name="show_user" value="1"<?php if( $show_user ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'Yes', 'rnkrwp' ); ?> &nbsp;&nbsp;
			<input type="radio" name="show_user" value="0"<?php if( !$show_user ) echo ' checked="true"'; ?>/> <?php esc_html_e( 'No', 'rnkrwp' ); ?>
		</li>
		<li>
			<?php esc_html_e( 'Display link to list on Ranker', 'rnkrwp' ); ?> : <input type="checkbox" name="show_link"<?php if( $show_link ) echo ' checked="true"'; ?>/>
		</li>
	</ul>
	
	<h2><?php esc_html_e( 'Colors', 'rnkrwp' ); ?></h2>
	<ul>
		<li>
			<?php esc_html_e( 'Background Color', 'rnkrwp' ); ?> : <span class="picker" id="rnkrwp_bg_pick"></span> 
			<input type="text" id="rnkrwp_bg" name="bg" value="<?php echo $bg; ?>" size="10"/> 
		</li>
		<li>
			<?php esc_html_e( 'Title Color', 'rnkrwp' ); ?> : <span class="picker" id="rnkrwp_title-color_pick"></span> 
			<input type="text" id="rnkrwp_title-color" name="title_color" value="<?php echo $title_color; ?>" size="10"/> 
		</li>
		<li>
			<?php esc_html_e( 'Highlight Color', 'rnkrwp' ); ?> : 
			<input type="radio" name="highlight" value="blue"<?php if( $highlight == 'blue' ) echo ' checked="true"'; ?>/> <span class="chip blue"></span> 
			<input type="radio" name="highlight" value="black"<?php if( $highlight == 'black' ) echo ' checked="true"'; ?>/> <span class="chip black"></span> 
			<input type="radio" name="highlight" value="grey"<?php if( $highlight == 'grey' ) echo ' checked="true"'; ?>/> <span class="chip grey"></span> 
		</li>
	</ul>
	
	<h2><?php esc_html_e( 'Fonts', 'rnkrwp' ); ?></h2>
	<ul>
		<li>
			<?php esc_html_e( 'Title', 'rnkrwp' ); ?> : <select name="title_font">
				<option<?php if( $title_font == 'arial' ) echo ' selected="selected"'; ?>>arial</option>
				<option<?php if( $title_font == 'helevtica' ) echo ' selected="selected"'; ?>>helevtica</option>
				<option<?php if( $title_font == 'verdana' ) echo ' selected="selected"'; ?>>verdana</option>
				<option<?php if( $title_font == 'geneva' ) echo ' selected="selected"'; ?>>geneva</option>
				<option<?php if( $title_font == 'times' ) echo ' selected="selected"'; ?>>times</option>
				<option<?php if( $title_font == 'georgia' ) echo ' selected="selected"'; ?>>georgia</option>
			</select>
		</li>
		<li>
			<?php esc_html_e( 'Item Numbers and Name', 'rnkrwp' ); ?> : <select name="item_font">
				<option<?php if( $item_font == 'arial' ) echo ' selected="selected"'; ?>>arial</option>
				<option<?php if( $item_font == 'helevtica' ) echo ' selected="selected"'; ?>>helevtica</option>
				<option<?php if( $item_font == 'verdana' ) echo ' selected="selected"'; ?>>verdana</option>
				<option<?php if( $item_font == 'geneva' ) echo ' selected="selected"'; ?>>geneva</option>
				<option<?php if( $item_font == 'times' ) echo ' selected="selected"'; ?>>times</option>
				<option<?php if( $item_font == 'georgia' ) echo ' selected="selected"'; ?>>georgia</option>
			</select>
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
		$size		= $_POST['size'];
		$rows		= $_POST['rows'];
		$width		= $_POST['custom_value'];
		$show_link	= $_POST['show_link'];
		$show_user	= $_POST['show_user'];
		
		//Check size value and adjust width
		switch( $size ){
			
			case 'small' :
				$width = '300';
				break;
				
			case 'medium' :
				$width = '450';
				break;
			
			case 'large' :
				$width = '600';
				break;

		}
		
		//Check show link and adjust boolean
		if( $show_link === 'on' ){
			$show_link = 1;
		}
		else{
			$show_link = 0;
		}
		
		//Check for 'recalc' settings
		if( $current[ 'size' ] !== $size || $current[ 'rows' ] !== $rows || $current[ 'show_user' ] !== $show_user ){

			//Create changelog array
			$log = array(
				'changes'		=> true,
				'updated'		=> date("Ymd-Hi") );
			//Update changelog
			update_option( 'rnkrwp_cl', $log );

		}
	
		//Create options array
		$options = array(
						'size'			=> $size,
						'width'			=> $width,
						'rows'			=> $rows,
						'show_user'		=> $show_user,
						'show_link'		=> $show_link,
						'bg'			=> $_POST['bg'],
						'noBg'			=> false,
						'highlight'		=> $_POST['highlight'],
						'title_color'	=> $_POST['title_color'],
						'title_font'	=> $_POST['title_font'],
						'item_font'		=> $_POST['item_font']);
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