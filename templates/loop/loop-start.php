<?php
/**
 * Albums Loop Start
 *
 * @author WpWolf
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */
$columns = wolf_albums_get_option( 'col', 4 );
?>
<ul class="albums <?php echo sanitize_html_class( 'album-grid-col-' . $columns ); ?>">