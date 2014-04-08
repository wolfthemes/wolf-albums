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