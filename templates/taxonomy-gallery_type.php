<?php
/**
 * The Template for displaying the main albums page
 *
 * Override this template by copying it to yourtheme/wolf-albums/albums-template.php
 *
 * @author WolfThemes
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */

get_header( 'albums' ); ?>
	<div class="albums-container">
		<?php if ( have_posts() ) : ?>
			
			<?php
				/**
				 * Albums Category Filter
				 */
				wolf_albums_get_template( 'filter.php' );
			?>
			
			<?php wolf_albums_loop_start(); ?>
				
				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php wolf_albums_get_template_part( 'content', 'album' ); ?>
				
				<?php endwhile; ?>
			
			<?php wolf_albums_loop_end(); ?>
			
			<?php else : ?>

				<?php wolf_albums_get_template( 'loop/no-album-found.php' ); ?>
			
			<?php endif; // end have_posts() check ?>
	</div><!-- .albums-container -->
<?php get_footer( 'albums' ); ?>