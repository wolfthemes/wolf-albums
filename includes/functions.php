<?php
/**
 * WolfAlbums Functions
 *
 * Hooked-in functions for WolfAlbums related events on the front-end.
 *
 * @author WpWolf
 * @category Core
 * @package WolfAlbums/Functions
 * @since 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Handle redirects before content is output - hooked into template_redirect so is_page albums.
 *
 * @access public
 * @return void
 */
function wolf_albums_template_redirect() {

	if ( is_page( wolf_albums_get_page_id() ) ) {

		wolf_albums_get_template( 'albums-template.php' );
		exit();
	}
	
}

if ( ! function_exists( 'wolf_albums_get_thumbnail' ) ) {
	/**
	 * Get the first image gallery of no featured image is set
	 *
	 * @param bool $echo
	 * @return string $thumbnail
	 */
	function wolf_albums_get_thumbnail() {

		$thumbnail = get_the_post_thumbnail( get_the_ID(), 'album-cover' );

		if ( ! has_post_thumbnail() ) {
			
			$content = get_the_content();
			$string = preg_match( '/ids=\"(.*)\"/i', $content, $result );
			
			if ( isset( $result[1] ) ) {
				$string = str_replace(' ', '', $result[1] );
				if ( '' != $string ) {
					$image_ids = explode( ',', $string );
					$wp_get_attachment_image_src = wp_get_attachment_image_src( $image_ids[0], 'album-cover' );
					$img_alt = esc_attr( get_post_meta( $image_ids[0], '_wp_attachment_image_alt', true ) );
					$image_url = $wp_get_attachment_image_src[0];
					$thumbnail = "<img src='$image_url' class='attachment-album-cover wp-post-image' alt='$img_alt'>";
				}
			}
		}

		return $thumbnail;
	}
}