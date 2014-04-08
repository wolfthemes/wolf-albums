<?php
/**
 * WolfAlbums Hooks
 *
 * Action/filter hooks used for WolfAlbums functions/templates
 *
 * @author WpWolf
 * @category Core
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/** Template Hooks ********************************************************/

if ( ! is_admin() || defined('DOING_AJAX') ) {

	/**
	 * Content Wrappers
	 *
	 * @see wolf_albums_output_content_wrapper()
	 * @see wolf_albums_output_content_wrapper_end()
	 */
	add_action( 'wolf_albums_before_main_content', 'wolf_albums_output_content_wrapper', 10 );
	add_action( 'wolf_albums_after_main_content', 'wolf_albums_output_content_wrapper_end', 10 );

}

/** Event Hooks *****************************************************/

add_action( 'template_redirect', 'wolf_albums_template_redirect' );