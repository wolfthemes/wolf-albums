<?php
/**
 * %NAME% Last Photos Widget
 *
 * Displays %NAME% widget
 *
 * @author %AUTHOR%
 * @category Widgets
 * @package %PACKAGENAME%/Widgets
 * @version %VERSION%
 * @extends WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WA_Widget_Last_Photos extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Widget settings
		$ops = array( 'classname' => 'widget_last_photos', 'description' => esc_html__( 'Display your last photos', '%TEXTDOMAIN%' ) );

		// Create the widget
		parent::__construct( 'widget_last_photos', esc_html__( 'Last Photos', '%TEXTDOMAIN%' ), $ops );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		extract( $args );
		$title = ( isset( $instance['title'] ) ) ? sanitize_title( $instance['title'] ) : '';
		$title = apply_filters( 'widget_title', $title );

		$desc = ( isset( $instance['desc'] ) ) ? sanitize_title( $instance['desc'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 12;
		
		echo $before_widget;
		if (! empty( $title ) ) echo $before_title . $title . $after_title;
		if (! empty( $desc ) ) {
			echo '<p>';
			echo $desc;
			echo '</p>';
		}
		echo wolf_get_photos_widget( $count );
		echo $after_widget;

	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['desc'] = sanitize_text_field( $new_instance['desc'] );
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	function form( $instance ) {

		// Set up some default widget settings
		$defaults = array(
			'title' => esc_html__( 'Last Photos', '%TEXTDOMAIN%' ),
			'desc' => '',
			'count' => 12,
			);
		$instance = wp_parse_args( ( array ) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ));  ?>"><?php esc_html_e(  'Title' , '%TEXTDOMAIN%' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ));  ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Optional Text', '%TEXTDOMAIN%' ); ?>:</label>
			<textarea class="widefat"  id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" ><?php echo $instance['desc']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count', '%TEXTDOMAIN%' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo absint( $instance['count'] ); ?>">
		</p>
		<?php
	}

}