<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author WpWolf
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$term_list = '';
$post_id   = get_the_ID();
if ( get_the_terms( $post_id, 'gallery_type' ) ) {
	foreach ( get_the_terms( $post_id, 'gallery_type' ) as $term ) {
		$term_list .= $term->slug .' ';
	}
}
$term_list = ( $term_list ) ? substr( $term_list, 0, -1 ) : '';
?>
<?php if ( wolf_albums_get_thumbnail() && ! post_password_required() ) : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'album-item-container', $term_list ) ); ?>>
	<span class="album-item">
		<a class="entry-link" href="<?php the_permalink(); ?>">
			<span class="album-thumb">
				<?php echo wolf_albums_get_thumbnail(); ?>
				<span class="album-title">
					<h5><?php the_title(); ?></h5>
					<p><?php _e( 'View Gallery', 'wolf' ); ?></p>
				</span>
			</span>
		</a>
	</span>
</div><!-- li.album-item-container -->
<?php endif; ?>