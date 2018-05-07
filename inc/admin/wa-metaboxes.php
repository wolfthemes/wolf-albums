<?php
/**
 * %NAME% register metaboxes
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$metaboxes = array(
	'Album option' => array(
		'title' => esc_html__( 'Album option', '%TEXTDOMAIN%' ),
		'page' => array( 'gallery' ),
		'metafields' => array(
			array(
				'label'	=> esc_html__( 'Cover Image Size', '%TEXTDOMAIN%' ),
				'id'	=> '_wolf_album_image_size',
				'type'	=> 'select',
				'options' => array(
					'wpb-2x1' => esc_html__( 'Standard', '%TEXTDOMAIN%' ),
					'wpb-1x1' => esc_html__( 'Small Square', '%TEXTDOMAIN%' ),
					'wpb-1x2' => esc_html__( 'Portrait', '%TEXTDOMAIN%' ),
					'wpb-2x1' => esc_html__( 'Landscape', '%TEXTDOMAIN%' ),
					'wpb-2x2' => esc_html__( 'Big Square', '%TEXTDOMAIN%' ),
				),
			),
		),
	),
);

//new WA_Admin_Metabox( $metaboxes );