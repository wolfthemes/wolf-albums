<?php
/**
 * Wolf Albums admin functions
 *
 * Functions available on admin
 *
 * @author WolfThemes
 * @category Core
 * @package WolfAlbums/Core
 * @version 1.0.7
 */

defined( 'ABSPATH' ) || exit;

/**
 * Display archive page state
 *
 * @param array $states
 * @param object $post
 * @return array $states
 */
function wa_custom_post_states( $states, $post ) { 

	if ( 'page' == get_post_type( $post->ID ) && absint( $post->ID ) === wolf_albums_get_page_id() ) {

		$states[] = esc_html__( 'Albums Page' );
	} 

	return $states;
}
add_filter( 'display_post_states', 'wa_custom_post_states', 10, 2 );