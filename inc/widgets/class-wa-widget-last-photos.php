<?php
/**
 * Wolf Albums Last Photos Widget
 *
 * Displays Wolf Albums widget
 *
 * @author WolfThemes
 * @category Widgets
 * @package WolfAlbums/Widgets
 * @version 1.0.7
 * @extends WP_Widget
 */

defined( 'ABSPATH' ) || exit;

class WA_Widget_Last_Photos extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Widget settings
		$ops = array( 'classname' => 'widget_last_photos', 'description' => esc_html__( 'Display your last photos', 'wolf-albums' ) );

		// Create the widget
		parent::__construct( 'widget_last_photos', esc_html__( 'Last Photos', 'wolf-albums' ), $ops );
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
		echo $this->get_photos_widget( $count );
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
			'title' => esc_html__( 'Last Photos', 'wolf-albums' ),
			'desc' => '',
			'count' => 12,
			);
		$instance = wp_parse_args( ( array ) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ));  ?>"><?php esc_html_e(  'Title' , 'wolf-albums' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ));  ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Optional Text', 'wolf-albums' ); ?>:</label>
			<textarea class="widefat"  id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" ><?php echo $instance['desc']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count', 'wolf-albums' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo absint( $instance['count'] ); ?>">
		</p>
		<?php
	}

	/**
	 * Widget function
	 *
	 * Displays the show list in the widget
	 *
	 * @param int $count, string $url, bool $link
	 * @return string
	 */
	function get_photos_widget( $count = 10 ) {
		ob_start();
		global $wpdb;
		$grid = array();
		$query = new WP_Query( array(
				'post_type' => 'gallery',
				'posts_per_page' => -1,
			)
		);

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$content = get_the_content();
				$string = preg_match( '/ids=\"(.*)\"/i', $content, $result );

				if ( isset( $result[1] ) ) {
					$string = str_replace(' ', '', $result[1] );
					$image_ids = explode( ',', $string );

					foreach( $image_ids as $image_id ) {

						if ( get_post_status( $image_id ) ) {
							$img_src_mini = wp_get_attachment_image_src( $image_id, 'thumbnail');
							$img_src_full = wp_get_attachment_image_src( $image_id, 'full-size');
							$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
							$grid[] = array(
								'thumb' => $img_src_mini[0],
								'full' => $img_src_full[0],
								'image_alt' => $image_alt,
							);
						}
					}
				}
			}

			if ( count($grid) < $count)
				$count = count($grid);

			for ( $i = 0; $i < $count; $i++ ) {
				echo '<a rel="last-photos" href="'. esc_url( $grid[ $i ]['full'] ).'" class="last-photos-thumbnails"><img src="'.esc_url( $grid[ $i ]['thumb'] ).'" alt="'. esc_attr( $grid[ $i ]['image_alt'] ).'"></a>';
			}
			echo '<div style="clear:both"></div>';


		} else {
			echo "<p>";
			esc_html_e( 'No photo uploaded yet.', 'wolf-albums' );
			echo "</p>";
		}

		wp_reset_postdata();
		return ob_get_clean();
	}
}
