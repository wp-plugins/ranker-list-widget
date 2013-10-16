<?php
/**
 * Uninstall Plugin
 * @fileoverview Checks for uninstall command and removes options.
 * @package WordPress
 */

//Check for uninstall interface
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();

//Uninstall plugin options
delete_option( 'rnkrwp' );

?>