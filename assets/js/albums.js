var WolfAlbums = WolfAlbums || {};

/* jshint -W062 */
WolfAlbums = function ( $ ) {

	'use strict';

	return {

		/**
		 * Init isotope masonry
		 */
		init : function () {

			if ( $( '.albums' ).length && $( '.album-item-container' ).length  ) {

				var mainContainer = $( '.albums' ),
					OptionFilter = $( '#albums-filter' ),
					OptionFilterLinks = OptionFilter.find( 'a' ),
					selector;

				mainContainer.imagesLoaded( function() {
					mainContainer.isotope( {
						itemSelector : '.album-item-container'
						//layoutMode: 'packery'
					} );
				} );

				OptionFilterLinks.click( function() {
					selector = $( this ).attr( 'data-filter' );
					OptionFilterLinks.attr( 'href', '#' );
					mainContainer.isotope( {
						filter : '.' + selector,
						itemSelector : '.album-item-container',
						animationEngine : 'best-available'
					} );

					OptionFilterLinks.removeClass( 'active' );
					$( this ).addClass( 'active' );
					return false;
				} );
			}
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfAlbums.init();
	} );

} )( jQuery );