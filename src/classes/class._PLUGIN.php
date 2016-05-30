<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      {{plugin.version}}
 * @package    {{plugin.package}}
 * @subpackage {{plugin.package}}/includes
 */
class {{plugin.package}} {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    {{plugin.version}}
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    {{plugin.version}}
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    {{plugin.version}}
	 */
	public function __construct() {

		$this->plugin_name = '{{plugin.slug}}';
		$this->version = '{{plugin.version}}';
		spl_autoload_register( array( $this, '{{plugin.prefix}}_autoloader' ) );

		${{plugin.function_slug}}_admin = new {{plugin.package}}_Admin;

		add_action( 'wp_enqueue_scripts', array( $this, '{{plugin.function_slug}}_enqueue_scripts' ) );
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     {{plugin.version}}
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     {{plugin.version}}
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     {{plugin.version}}
	 * @return    string    The version number of the plugin.
	 */
	function {{plugin.function_slug}}_enqueue_scripts() {
		if ( is_admin() ) {
			wp_enqueue_script( '{{plugin.function_slug}}_admin_script', {{plugin.constant_prefix}}_ASSETS . '/admin/js/{{plugin.slug}}-admin-script.min.js', array( 'jquery' ), '{{plugin.version}}', true );
			wp_enqueue_script( '{{plugin.function_slug}}_admin_script', {{plugin.constant_prefix}}_ASSETS . '/admin/css/{{plugin.slug}}-admin.css' );
		}
		else {
			wp_enqueue_script( '{{plugin.function_slug}}_public_script', {{plugin.constant_prefix}}_ASSETS . '/public/js/{{plugin.slug}}-public-script.min.js', array( 'jquery' ), '{{plugin.version}}', true );
			wp_enqueue_script( '{{plugin.function_slug}}_public_script', {{plugin.constant_prefix}}_ASSETS . '/admin/css/{{plugin.slug}}-public.css' );
		}
	}

	// autoload classes
	function {{plugin.prefix}}_autoloader( $class ) {

		$classes = array(
	    '{{plugin.package}}_Activator',
	    '{{plugin.package}}_Deactivator',
			'{{plugin.package}}_Admin',
		);

		if ( in_array( $class, $classes ) ) {
			require_once( 'class.'. $class .'.php' );
		}

	}

}

${{plugin.function_slug}} = new {{plugin.package}};
