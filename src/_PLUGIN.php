<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              {{plugin.uri}}
 * @since             {{plugin.version}}
 * @package           {{plugin.package}}
 *
 * @wordpress-plugin
 * Plugin Name:       {{plugin.name}}
 * Plugin URI:        {{plugin.uri}}
 * Description:       {{plugin.desc}}
 * Version:           {{plugin.version}}
 * Author:            {{plugin.author}}
 * Author URI:        {{plugin.author_uri}}
 * Requires at least: {{plugin.requires_version}}
 * Tested up to:      {{plugin.tested_version}}
 * Text Domain:       {{plugin.slug}}
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( '{{plugin.constant_prefix}}_INCLUDES', dirname( __FILE__ ) . '/includes' );
define( '{{plugin.constant_prefix}}_ASSETS'  , plugin_dir_url( __FILE__ ) . '/assets' );

add_action( 'plugins_loaded', '{{plugin.prefix}}_load_textdomain' );
function {{plugin.prefix}}_load_textdomain() {
  load_plugin_textdomain( '{{plugin.slug}}', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-{{plugin.slug}}-activator.php
 */
register_activation_hook( __FILE__, '{{plugin.prefix}}_activate_plugin' );
function {{plugin.prefix}}_activate_plugin() {
	{{plugin.package}}_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-{{plugin.slug}}-deactivator.php
 */
register_deactivation_hook( __FILE__, '{{plugin.prefix}}_deactivate_plugin' );
function {{plugin.prefix}}_deactivate_plugin() {
	{{plugin.package}}_Deactivator::deactivate();
}

require_once( {{plugin.constant_prefix}}_INCLUDES . '/widgets/{{plugin.slug}}-widget.php' );
require_once( {{plugin.constant_prefix}}_INCLUDES . '/shortcodes/{{plugin.slug}}-shortcodes.php' );
require_once( dirname( __FILE__ ) . '/classes/class.{{plugin.package}}.php' );
