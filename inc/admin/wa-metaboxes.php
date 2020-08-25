<?php
/**
 * Wolf Albums register metaboxes
 *
 * @author WolfThemes
 * @category Core
 * @package WolfAlbums/Admin
 * @version 1.0.7
 */

defined( 'ABSPATH' ) || exit;

$metaboxes = array(
	'Album option' => array(
		'title' => esc_html__( 'Album option', 'wolf-albums' ),
		'page' => array( 'gallery' ),
		'metafields' => array(
			array(
				'label'	=> esc_html__( 'Cover Image Size', 'wolf-albums' ),
				'id'	=> '_wolf_album_image_size',
				'type'	=> 'select',
				'options' => array(
					'wpb-2x1' => esc_html__( 'Standard', 'wolf-albums' ),
					'wpb-1x1' => esc_html__( 'Small Square', 'wolf-albums' ),
					'wpb-1x2' => esc_html__( 'Portrait', 'wolf-albums' ),
					'wpb-2x1' => esc_html__( 'Landscape', 'wolf-albums' ),
					'wpb-2x2' => esc_html__( 'Big Square', 'wolf-albums' ),
				),
			),
		),
	),
);

//new WA_Admin_Metabox( $metaboxes );