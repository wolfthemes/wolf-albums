<?php
/**
 * The template for displaying gallery content within loops.
 *
 * Override this template by copying it to yourtheme/wolf-albums/content-albums.php
 *
 * @author WolfThemes
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */

defined( 'ABSPATH' ) || exit;

$term_list = '';
$post_id   = get_the_ID();
if ( get_the_terms( $post_id, 'gallery_type' ) ) {
	foreach ( get_the_terms( $post_id, 'gallery_type' ) as $term ) {
		$term_list .= $term->slug .' ';
	}
}
$term_list = ( $term_list ) ? substr( $term_list, 0, -1 ) : '';
// $image_size = get_post_meta( $post_id, '_wolf_album_image_size', true );
$image_size = apply_filters( 'wa_thumbnail_size', 'album-cover' );
?>
<?php if ( function_exists('wolf_albums_get_thumbnail') && wolf_albums_get_thumbnail() && ! post_password_required() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'album-item-container', $term_list ) ); ?>>
	<span class="album-item">
		<a class="entry-link" href="<?php the_permalink(); ?>">
			<span class="album-thumb">
				<?php echo wolf_albums_get_thumbnail( $image_size ); ?>
				<span class="album-title">
					<h5><?php the_title(); ?></h5>
					<p><?php esc_html_e( 'View Gallery', 'wolf-albums' ); ?></p>
				</span>
			</span>
		</a>
	</span>
</article><!-- .album-item-container -->
<?php endif; ?>