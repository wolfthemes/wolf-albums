<?php
/**
 * Wolf Albums register post type
 *
 * @author WolfThemes
 * @category Core
 * @package WolfAlbums/Admin
 * @version 1.0.7
 */

defined( 'ABSPATH' ) || exit;

/* Register Gallery post type */
$labels = apply_filters( 'wolf_gallery_post_type_labels', array(
	'name' => esc_html__( 'Galleries', 'wolf-albums' ),
	'singular_name' => esc_html__( 'Gallery', 'wolf-albums' ),
	'add_new' => esc_html__( 'Add New', 'wolf-albums' ),
	'add_new_item' => esc_html__( 'Add New Gallery', 'wolf-albums' ),
	'all_items'  => esc_html__( 'All Galleries', 'wolf-albums' ),
	'edit_item' => esc_html__( 'Edit Gallery', 'wolf-albums' ),
	'new_item' => esc_html__( 'New Gallery', 'wolf-albums' ),
	'view_item' => esc_html__( 'View Gallery', 'wolf-albums' ),
	'search_items' => esc_html__( 'Search Galleries', 'wolf-albums' ),
	'not_found' => esc_html__( 'No Galleries found', 'wolf-albums' ),
	'not_found_in_trash' => esc_html__( 'No Galleries found in Trash', 'wolf-albums' ),
	'parent_item_colon' => '',
	'menu_name' => esc_html__( 'Galleries', 'wolf-albums' ),
) );

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
	'description' => esc_html__( 'Present your albums', 'wolf-albums' ),
	'menu_icon' => 'dashicons-images-alt2',
);

register_post_type( 'gallery', $args );