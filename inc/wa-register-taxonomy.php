<?php
/**
 * %NAME% register taxonomy
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Gallery Taxonomy */
$labels = array(
	'name' => esc_html__( 'Galleries Categories', '%TEXTDOMAIN%' ),
	'singular_name' => esc_html__( 'Galleries Category', '%TEXTDOMAIN%' ),
	'search_items' => esc_html__( 'Search Galleries Categories', '%TEXTDOMAIN%' ),
	'popular_items' => esc_html__( 'Popular Galleries Categories', '%TEXTDOMAIN%' ),
	'all_items' => esc_html__( 'All Galleries Categories', '%TEXTDOMAIN%' ),
	'parent_item' => esc_html__( 'Parent Galleries Category', '%TEXTDOMAIN%' ),
	'parent_item_colon' => esc_html__( 'Parent Galleries Category:', '%TEXTDOMAIN%' ),
	'edit_item' => esc_html__( 'Edit Galleries Category', '%TEXTDOMAIN%' ),
	'update_item' => esc_html__( 'Update Galleries Category', '%TEXTDOMAIN%' ),
	'add_new_item' => esc_html__( 'Add New Galleries Category', '%TEXTDOMAIN%' ),
	'new_item_name' => esc_html__( 'New Galleries Category', '%TEXTDOMAIN%' ),
	'separate_items_with_commas' => esc_html__( 'Separate gallery categories with commas', '%TEXTDOMAIN%' ),
	'add_or_remove_items' => esc_html__( 'Add or remove gallery categories', '%TEXTDOMAIN%' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used gallery categories', '%TEXTDOMAIN%' ),
	'not_found' => esc_html__( 'No categories found', '%TEXTDOMAIN%' ),
	'menu_name' => esc_html__( 'Categories', '%TEXTDOMAIN%' ),
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