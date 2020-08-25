<?php
/**
 * Wolf Albums Shortcode.
 *
 * @class WA_Shortcode
 * @author WolfThemes
 * @category Core
 * @package WolfAlbums/Shortcode
 * @version 1.0.7
 * @since 1.2.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * WA_Shortcode class.
 */
class WA_Shortcode {
	/**
	 * Constructor
	 */
	public function __construct() {

		add_shortcode( 'wolf_last_albums', array( $this, 'shortcode' ) );
		add_shortcode( 'wolf_last_photos_widget', array( $this, 'shortcode_widget' ) );
	}

	/**
	 * Add filter to exlude password protected posts
	 *
	 * Create a new filtering function that will add our where clause to the query
	 */
	public function filter_where( $where = '' ) {
		$where .= " AND post_password = ''";
		return $where;
	}

	/**
	 * Shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	public function shortcode( $atts ) {

		extract(
			shortcode_atts(
				array(
					'count' => 3,
					'category' => null,
					'col' => wolf_albums_get_option( 'col', 3 ),
					'padding' => 'yes',
					'display' => '', // for custom appareance in theme
					'animation' => '',
					'animation_delay' => '',
				), $atts
			)
		);

		ob_start();

		$args = array(
			'post_type' => array( 'gallery' ),
			'posts_per_page' => absint( $count ),

		);

		if ( $category ) {
			$args['gallery_type'] = $category;
		}

		$class = 'shortcode-gallery-grid';
		
		if ( $display ) {
			$class .= ' albums-display-' . esc_attr( $display );
		}
		
		$class .= ' gallery-grid-col-' . absint( $col );
		$class .= ' shortcode-gallery-padding-' . esc_attr( $padding );

		add_filter( 'posts_where', array( $this, 'filter_where' ) );
		$loop = new WP_Query( $args );
		remove_filter( 'posts_where', array( $this, 'filter_where' ) );
		
		if ( $loop->have_posts() ) : ?>
			<div class="<?php echo $class; ?>" data-animation-parent="<?php echo esc_attr( $animation ); ?>">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php wolf_albums_get_template_part( 'content', 'album' ); ?>

				<?php endwhile; ?>
			</div><!-- .shortcode-albums-grid -->
			<div class="clear"></div>
		<?php else : // no album ?>
			<?php wolf_albums_get_template( 'loop/no-album-found.php' ); ?>
		<?php endif;
		wp_reset_postdata();

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	/**
	 * Shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	public function shortcode_widget( $atts ) {

		extract(
			shortcode_atts(
				array(
					'count' => 12,
				), $atts
			)
		);

		return wolf_get_photos_widget( $count );
	}

	/**
	 * Helper method to determine if a shortcode attribute is true or false.
	 *
	 * @since 1.2.2
	 *
	 * @param string|int|bool $var Attribute value.
	 * @return bool
	 */
	protected function shortcode_bool( $var ) {
		$falsey = array( 'false', '0', 'no', 'n' );
		return ( ! $var || in_array( strtolower( $var ), $falsey, true ) ) ? false : true;
	}

} // end class

return new WA_Shortcode();