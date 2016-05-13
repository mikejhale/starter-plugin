<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      {{plugin.version}}
 * @package    {{plugin.package}}
 * @subpackage {{plugin.package}}/classes
 */
class {{plugin.package}}_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    {{plugin.version}}
	 */
	public static function activate() {
		update_option( '{{plugin.function_slug}}_active', 1 );
	}

}
