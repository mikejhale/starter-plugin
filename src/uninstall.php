<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @since      {{plugin.version}}
 * @package    {{plugin.package}}
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
