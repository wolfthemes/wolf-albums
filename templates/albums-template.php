<?php
/**
 * The Template for displaying the main albums page
 *
 * Override this template by copying it to yourtheme/wolf-albums/albums-template.php
 *
 * @author WolfThemes
 * @package WolfAlbums/Templates
 * @since 1.0.3
 */

if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

get_header( 'albums' );

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$posts_per_page = apply_filters( 'wa_posts_per_page', -1 );

	$args = array(
		'post_type' => 'gallery',
		'posts_per_page' => $posts_per_page,
	);

	if ( -1 < $posts_per_page ) {
		$args['paged'] = $paged;
	}

	/* Albums Post Loop */
	$loop = new WP_Query( $args );
?>
	<div id="container" class="albums-container">
		<?php if ( $loop->have_posts() ) : ?>
			
			<?php
				/**
				 * Albums Category Filter
				 */
				wolf_albums_get_template( 'filter.php' );
			?>
			
			<?php wolf_albums_loop_start(); ?>
				
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				
					<?php wolf_albums_get_template_part( 'content', 'album' ); ?>
				
				<?php endwhile; ?>
			
			<?php wolf_albums_loop_end(); ?>
			
			<?php else : ?>

				<?php wolf_albums_get_template( 'loop/no-album-found.php' ); ?>
			
			<?php endif; // end have_posts() check ?>
	</div><!-- .album-container -->
<?php
get_sidebar( 'albums' );
get_footer( 'albums' );
?>