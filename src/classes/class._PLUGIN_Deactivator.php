<?php

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      {{plugin.version}}
 * @package    {{plugin.package}}
 * @subpackage {{plugin.package}}/classes
 */
class {{plugin.package}}_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    {{plugin.version}}
	 */
	public static function deactivate() {
		update_option( '{{plugin.function_slug}}_active', 0 );
	}

}
