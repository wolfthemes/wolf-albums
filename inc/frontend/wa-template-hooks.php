<?php
/**
 * Wolf Albums Hooks
 *
 * Action/filter hooks used for WolfAlbums functions/templates
 *
 * @author WolfThemes
 * @category Core
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */

defined( 'ABSPATH' ) || exit;

/**
 * Body class
 *
 * @see  wa_body_class()
 */
add_filter( 'body_class', 'wa_body_class' );

/**
 * WP Header
 *
 * @see  wa_generator_tag()
 */
add_action( 'get_the_generator_html', 'wa_generator_tag', 10, 2 );
add_action( 'get_the_generator_xhtml', 'wa_generator_tag', 10, 2 );

/**
 * Content wrappers
 *
 * @see wolf_albums_output_content_wrapper()
 * @see wolf_albums_output_content_wrapper_end()
 */
add_action( 'wolf_albums_before_main_content', 'wolf_albums_output_content_wrapper', 10 );
add_action( 'wolf_albums_after_main_content', 'wolf_albums_output_content_wrapper_end', 10 );

add_action( 'template_redirect', 'wolf_albums_template_redirect', 40 );