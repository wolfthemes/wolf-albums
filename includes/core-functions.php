<?php
/**
 * WolfAlbums Core Functions
 *
 * Functions available on both the front-end and admin.
 *
 * @author WpWolf
 * @category Core
 * @package WolfAlbums/Functions
 * @since 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_albums_get_page_id' ) ) {

	/**
	 * wolf_albums page ID
	 *
	 * retrieve page id - used for the main albums page
	 *
	 *
	 * @access public
	 * @return int
	 */
	function wolf_albums_get_page_id() {
		
		$page_id = -1;
		$theme_dir = get_template_directory();

		if ( -1 != get_option( '_wolf_albums_page_id' ) && get_option( '_wolf_albums_page_id' ) ) {
			
			$page_id = get_option( '_wolf_albums_page_id' );
		
		// back compatibility with the old template system
		} elseif ( is_file( $theme_dir . '/albums-template.php' ) ) {
			
			$templates = array( 
				'albums-template.php',
				'page-templates/albums.php',
			);

			foreach ( $templates as $template ) {

				$pages = get_pages( array(
					'meta_key' => '_wp_page_template',
					'meta_value' => $template
				) );


				if ( $pages && isset( $pages[0] ) ) {
					$page_id = $pages[0]->ID;
					break;
				}	
			}

		}

		return $page_id;
	}
}

if ( ! function_exists( 'wolf_get_albums_url' ) ) {
	/**
	 * Returns the URL of the albums page
	 */
	function wolf_get_albums_url() {
		
		$page_id = wolf_albums_get_page_id();

		if ( -1 != $page_id )
			return get_permalink( $page_id );

	}
}

if ( ! function_exists( 'wolf_albums_get_option' ) ) {
	/**
	 * Get albums option
	 *
	 * @access public
	 * @param string
	 * @return void
	 */
	function wolf_albums_get_option( $value, $default = null ) {

		global $wolf_albums;
		return $wolf_albums->get_option( $value, $default );

	}
}

if ( ! function_exists( 'wolf_albums_nav' ) ) {
	/**
	 * Displays navigation to next/previous post when applicable.
	 *
	 *
	 * @access public
	 * @return string/bool
	 */
	function wolf_albums_nav() {
		
		global $wolf_albums;
		return $wolf_albums->navigation();

	}
}

/**
 * Get template part (for templates like the release-loop).
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 * @return void
 */
function wolf_albums_get_template_part( $slug, $name = '' ) {
	global $wolf_albums;
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/wolf-albums/slug-name.php
	if ( $name )
		$template = locate_template( array( "{$slug}-{$name}.php", "{$wolf_albums->template_url}{$slug}-{$name}.php" ) );

	// Get default slug-name.php
	if ( ! $template && $name && file_exists( $wolf_albums->plugin_path() . "/templates/{$slug}-{$name}.php" ) )
		$template = $wolf_albums->plugin_path() . "/templates/{$slug}-{$name}.php";

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/wolf-albums/slug.php
	if ( ! $template )
		$template = locate_template( array( "{$slug}.php", "{$wolf_albums->template_url}{$slug}.php" ) );

	if ( $template )
		load_template( $template, false );
}

/**
 * Get other templates (e.g. ticket attributes) passing attributes and including the file.
 *
 * @access public
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function wolf_albums_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	global $wolf_albums;

	if ( $args && is_array($args) )
		extract( $args );

	$located = wolf_albums_locate_template( $template_name, $template_path, $default_path );

	do_action( 'wolf_albums_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'wolf_albums_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme/$template_path/$template_name
 * yourtheme/$template_name
 * $default_path/$template_name
 *
 * @access public
 * @param mixed $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function wolf_albums_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	global $wolf_albums;

	if ( ! $template_path ) $template_path = $wolf_albums->template_url;
	if ( ! $default_path ) $default_path = $wolf_albums->plugin_path() . '/templates/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template )
		$template = $default_path . $template_name;

	// Return what we found
	return apply_filters( 'wolf_albums_locate_template', $template, $template_name, $template_path );
}
