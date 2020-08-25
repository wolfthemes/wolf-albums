<?php
/**
 * Wolf Albums register taxonomy
 *
 * @author WolfThemes
 * @category Core
 * @package WolfAlbums/Admin
 * @version 1.0.7
 */

defined( 'ABSPATH' ) || exit;

/* Gallery Taxonomy */
$labels = array(
	'name' => esc_html__( 'Galleries Categories', 'wolf-albums' ),
	'singular_name' => esc_html__( 'Galleries Category', 'wolf-albums' ),
	'search_items' => esc_html__( 'Search Galleries Categories', 'wolf-albums' ),
	'popular_items' => esc_html__( 'Popular Galleries Categories', 'wolf-albums' ),
	'all_items' => esc_html__( 'All Galleries Categories', 'wolf-albums' ),
	'parent_item' => esc_html__( 'Parent Galleries Category', 'wolf-albums' ),
	'parent_item_colon' => esc_html__( 'Parent Galleries Category:', 'wolf-albums' ),
	'edit_item' => esc_html__( 'Edit Galleries Category', 'wolf-albums' ),
	'update_item' => esc_html__( 'Update Galleries Category', 'wolf-albums' ),
	'add_new_item' => esc_html__( 'Add New Galleries Category', 'wolf-albums' ),
	'new_item_name' => esc_html__( 'New Galleries Category', 'wolf-albums' ),
	'separate_items_with_commas' => esc_html__( 'Separate gallery categories with commas', 'wolf-albums' ),
	'add_or_remove_items' => esc_html__( 'Add or remove gallery categories', 'wolf-albums' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used gallery categories', 'wolf-albums' ),
	'not_found' => esc_html__( 'No categories found', 'wolf-albums' ),
	'menu_name' => esc_html__( 'Categories', 'wolf-albums' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => true,
	'public' => true,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'gallery-type', 'with_front' => false ),
);

register_taxonomy( 'gallery_type', array( 'gallery' ), $args );