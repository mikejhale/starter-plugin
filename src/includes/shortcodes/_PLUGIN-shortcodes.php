<?php
/**
 * Shortcodes for displaying front-end content
 *
 * @package {{plugin.package}}
 */

add_shortcode( '{{plugin.prefix}}_test', '{{plugin.prefix}}_test_shortcode' );

/**
 * Test Shortcode function
 */
function {{plugin.prefix}}_test_shortcode( $atts ) {

  /** Get shortcode $atts */
  $atts = shortcode_atts( array(
		'value' => 'Test',
	), $atts, '{{plugin.prefix}}_test' );

  return $atts['value'];
}
