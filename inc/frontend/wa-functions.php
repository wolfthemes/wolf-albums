<?php
/**
 * Wolf Albums Functions
 *
 * Wolf Albums front-end functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfAlbums/Functions
 * @since 1.2.2
 */

/**
 * Enqueue scripts
 */
function wa_enqueue_scripts() {

	wp_enqueue_style( 'wolf-albums', WA_CSS . '/albums.min.css', array(), WA_VERSION, 'all' );

	wp_register_script( 'imagesloaded', WA_JS . '/lib/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.0', true );
	//wp_register_script( 'packery', WA_JS . '/lib/packery-mode.pkgd.min.js', array( 'jquery' ), '2.0.0', true );
	wp_register_script( 'isotope', WA_JS . '/lib/isotope.pkgd.min.js', array( 'jquery' ), '3.0.1', true );
	
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
	wp_register_script( 'wolf-albums', WA_JS . '/albums' . $suffix . '.js', array( 'jquery' ), WA_VERSION, true );

	if ( is_page( wolf_albums_get_page_id() ) ) {
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'wolf-albums' );
	}
}
add_action( 'wp_enqueue_scripts', 'wa_enqueue_scripts' );

/**
 * Handle redirects before content is output - hooked into template_redirect so is_page albums.
 *
 */
function wolf_albums_template_redirect() {

	if ( is_page( wolf_albums_get_page_id() ) && ! post_password_required() ) {
		wolf_albums_get_template( 'albums-template.php' );
		exit();
	}
}

if ( ! function_exists( 'wolf_albums_get_thumbnail' ) ) {
	/**
	 * Get the first gallery image if no featured image is set
	 *
	 * @param bool $echo
	 * @return string $thumbnail
	 */
	function wolf_albums_get_thumbnail( $size = 'album-cover' ) {

		$thumbnail = get_the_post_thumbnail( get_the_ID(), $size );

		if ( ! has_post_thumbnail() ) {

			$content = get_the_content();
			$string = preg_match( '/ids=\"(.*)\"/i', $content, $result );

			if ( isset( $result[1] ) ) {
				$string = str_replace(' ', '', $result[1] );
				if ( '' != $string ) {
					$image_ids = explode( ',', $string );
					$wp_get_attachment_image_src = wp_get_attachment_image_src( $image_ids[0], $size );
					$img_alt = esc_attr( get_post_meta( $image_ids[0], '_wp_attachment_image_alt', true ) );
					$image_url = $wp_get_attachment_image_src[0];
					$thumbnail = "<img src='$image_url' class='attachment-album-cover wp-post-image' alt='$img_alt'>";
				}
			}
		}

		return $thumbnail;
	}
}

if ( ! function_exists( 'wolf_get_photos_widget' ) ) {
	/**
	 * Widget function
	 *
	 * Displays the show list in the widget
	 *
	 * @param int $count, string $url, bool $link
	 * @return string
	 */
	function wolf_get_photos_widget( $count = 10 ) {
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

if ( ! function_exists( 'wolf_albums_nav' ) ) {
	/**
	 * Displays navigation to next/previous post when applicable.
	 *
	 *
	 * @return string/bool
	 */
	function wolf_albums_nav() {

		global $post;

		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
		?>
		<nav class="album-navigation" role="navigation">
			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'wolf-albums' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'wolf-albums' ) ); ?>
		</nav><!-- .navigation -->
		<?php
	}
}