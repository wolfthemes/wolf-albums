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
<div class="albums <?php echo sanitize_html_class( 'gallery-grid-col-' . $columns ); ?>">