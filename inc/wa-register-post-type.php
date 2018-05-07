<?php
/**
 * %NAME% register post type
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Register Gallery post type */
$labels = array(
	'name' => esc_html__( 'Galleries', '%TEXTDOMAIN%' ),
	'singular_name' => esc_html__( 'Gallery', '%TEXTDOMAIN%' ),
	'add_new' => esc_html__( 'Add New', '%TEXTDOMAIN%' ),
	'add_new_item' => esc_html__( 'Add New Gallery', '%TEXTDOMAIN%' ),
	'all_items'  => esc_html__( 'All Galleries', '%TEXTDOMAIN%' ),
	'edit_item' => esc_html__( 'Edit Gallery', '%TEXTDOMAIN%' ),
	'new_item' => esc_html__( 'New Gallery', '%TEXTDOMAIN%' ),
	'view_item' => esc_html__( 'View Gallery', '%TEXTDOMAIN%' ),
	'search_items' => esc_html__( 'Search Galleries', '%TEXTDOMAIN%' ),
	'not_found' => esc_html__( 'No Galleries found', '%TEXTDOMAIN%' ),
	'not_found_in_trash' => esc_html__( 'No Galleries found in Trash', '%TEXTDOMAIN%' ),
	'parent_item_colon' => '',
	'menu_name' => esc_html__( 'Galleries', '%TEXTDOMAIN%' ),
);

$args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'query_var' => false,
	'rewrite' => array( 'slug' => 'gallery' ),
	'capability_type' => 'post',
	'has_archive' => false,
	'hierarchical' => false,
	'menu_position' => 5,
	'taxonomies' => array(),
	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments' ),
	'exclude_from_search' => false,
	'description' => esc_html__( 'Present your albums', '%TEXTDOMAIN%' ),
	'menu_icon' => 'dashicons-images-alt2',
);

register_post_type( 'gallery', $args );