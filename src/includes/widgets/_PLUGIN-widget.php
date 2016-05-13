<?php

add_action( 'widgets_init', '{{plugin.prefix}}_load_widgets' );

/**
 * Register widgets.
 *
 * @since {{plugin.version}}
 */
function {{plugin.prefix}}_load_widgets() {
	register_widget( '{{plugin.package}}_Widget' );
}

class {{plugin.package}}_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
  public function __construct() {

   $widget_ops = array(
		 'classname'   => '{{plugin.function_slug}}_widget',
		 'description' => '{{plugin.esc_name}} Widget'
   );

   parent::__construct( '{{plugin.function_slug}}_widget', '{{plugin.esc_name}} Widget', $widget_ops );

  }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
   // outputs the content of the widget
	 echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo __( '{{plugin.plugin_name}}', '{{plugin.slug}}' );
		echo $args['after_widget'];
  }

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
   $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '{{plugin.esc_name}}', '{{plugin.slug}}' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
  }

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
 		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

 		return $instance;
  }
}
