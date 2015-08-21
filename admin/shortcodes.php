<?php
/**
 * Build Shortcodes
 * @desc Build shortcodes creation page.
 * @package WordPress
 */
function rnkrwp_build_shortcodes(){
?>
<div id="rnkrWrap">

	<h1><?php esc_html_e( 'Ranker Plugin - Create Shortcodes', 'rnkrwp' ) ?></h1>
	
	<div class="eolWarning">
		!!!This Plugin has reached End of Life!!! - Please upgrade to <strong><em>Polling Widget: Ranker Lists</em></strong> to continue receiving updates.
	</div>
	
	<ul id="rnkrSubMenu">
		<li>
			<a href="<?php menu_page_url( 'rnkrwp-options', true ); ?>" target="_self" title="<?php _e( 'Setup defaults for Ranker widgets', 'rnkrwp' ) ?>">
				<?php esc_html_e( 'Display Options', 'rnkrwp' ) ?></a>
		</li>
		<li class="selected">
			<a href="<?php menu_page_url( 'rnkrwp-shortcodes', true ); ?>" target="_self" title="<?php _e( 'Use this tool to create shortcodes for your posts', 'rnkrwp' ) ?>">
				<?php esc_html_e( 'Create Shortcodes', 'rnkrwp' ) ?></a>
		</li>
	</ul>
	
	<p class="clear">
		<?php esc_html_e( 'Use this form to convert Ranker list URLs into shortcodes usable in your posts.', 'rnkrwp' ) ?><br/>
		<span class="note"><?php esc_html_e( '(Please note: this form connects to Ranker\'s server ONLY to get data needed to display widgets via shortcode from your URL)', 'rnkrwp' ) ?></span>
	</p>
	
	<h2><?php esc_html_e( 'Create Shortcodes', 'rnkrwp' ) ?></h2>
	<ul>
		<li>
			<?php esc_html_e( 'Paste Ranker List URL', 'rnkrwp' ) ?> : <input type="text" name="ranker_url" id="rnkrwp_rankerURL" size="50"/> 
			<input type="submit" id="rnkrwp_getShortCode" value="<?php _e( 'CREATE', 'rnkrwp' ) ?>"/>
		</li>
		<li>
			<span id="rnkrwp_shortCodeMessage"><?php esc_html_e( 'Use Shortcode In Post', 'rnkrwp' ) ?> :</span> <div id="rnkrwp_shortCodeOutput">[rnkrwp ]</div>
		</li>
	</ul>
	
	<br/><br/><br/>

</div>

<?php
}
rnkrwp_build_shortcodes();
?>