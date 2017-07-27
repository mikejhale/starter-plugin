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
class {{plugin.package}}_Admin {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    {{plugin.version}}
	 */
	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu'        ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	function admin_menu() {
	  add_options_page(
			'{{plugin.esc_name}} Admin',
			'{{plugin.menu_title}}',
			'manage_options',
			'{{plugin.slug}}-admin',
			array( $this, 'admin_page' )
		);
	}

	function admin_page() {
		$this->options = get_option( 'my_plugin_options' );

		?>
		<div class="wrap">
			<h1>{{plugin.name}} Settings</h1>
			<form method="post" action="options.php">
	        <?php
	            settings_fields( '{{plugin.function_slug}}_group' );
	            do_settings_sections( '{{plugin.slug}}-admin' );
	            submit_button();
	        ?>
	    </form>
		</div>
		<?php
	}

	/**
   * Register and add settings
   */
	function register_settings() {
		// Register the settings with Validation callback
		register_setting(
			'{{plugin.function_slug}}_group',
			'{{plugin.function_slug}}_options',
			array( $this, 'sanitize')
		);

		// Add settings section
		add_settings_section(
        '{{plugin.function_slug}}_section_id',
        'Custom Settings',
        array( $this, 'print_section_info' ),
        '{{plugin.slug}}-admin'
    );

		add_settings_field(
					'{{plugin.function_slug}}_value',
					'Value',
					array( $this, '{{plugin.function_slug}}_value_callback' ),
					'{{plugin.slug}}-admin',
					'{{plugin.function_slug}}_section_id'
			);
	}

	/**
	* Sanitize each setting field as needed
	*
	* @param array $input Contains all settings fields as array keys
	*/
	public function sanitize( $input )
	{
			$new_input = array();

			if ( isset( $input['{{plugin.function_slug}}_value'] ) ) {
					$new_input['{{plugin.function_slug}}_value'] = sanitize_text_field( $input['{{plugin.function_slug}}_value'] );
			}

			return $new_input;
	}

	/**
   * Print the Section text
   */
  public function print_section_info()
  {
      print 'Enter your settings below:';
  }

	/**
   * Get the settings option array and print one of its values
   */
  public function {{plugin.function_slug}}_value_callback()
  {
      printf(
          '<input type="text" id="{{plugin.function_slug}}_value" name="{{plugin.function_slug}}_options[{{plugin.function_slug}}_value]" value="%s" />',
          isset( $this->options['{{plugin.function_slug}}_value'] ) ? esc_attr( $this->options['{{plugin.function_slug}}_value']) : ''
      );
  }

}
