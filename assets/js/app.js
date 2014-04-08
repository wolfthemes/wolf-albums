var WolfAlbums = WolfAlbums || {},
	WolfAlbumsParams = WolfAlbumsParams || {};

/* jshint -W062 */
WolfAlbums = function ( $ ) {

	'use strict';

	return {

		/**
		 * Init albums isotope masonry
		 */
		init : function () {
			
			var $this = this,
				mainAlbumsContainer = $( '.albums' ),
				albumOptionFilter = $( '#albums-filter' ),
				albumOptionFilterLinks = albumOptionFilter.find( 'a' ),
				selector;
			
			mainAlbumsContainer.imagesLoaded( function() {
				$this.setColumnWidth( '.album-item-container', mainAlbumsContainer );
				mainAlbumsContainer.isotope( {
					itemSelector : '.album-item-container'
				} );
			} );

			albumOptionFilterLinks.click( function() {
				selector = $( this ).attr( 'data-filter' );
				albumOptionFilterLinks.attr( 'href', '#' );
				$this.setColumnWidth( '.album-item-container', mainAlbumsContainer );
				mainAlbumsContainer.isotope( {
					filter : '.' + selector,
					itemSelector : '.album-item-container',
					layoutMode : 'fitRows',
					animationEngine : 'best-available'
				} );

				albumOptionFilterLinks.removeClass( 'active' );
				$( this ).addClass( 'active' );
				return false;
			} );

			$( window ).smartresize( function() {
				$this.setColumnWidth( '.album-item-container', mainAlbumsContainer );
				mainAlbumsContainer.isotope( 'reLayout' );
			} );
		},

		/**
		 * Get column count depending on container width
		 */
		getNumColumns : function ( mainContainer ) {
			var winWidth = mainContainer.width(),
				column = WolfAlbumsParams.columns;
			if ( 481 > winWidth ) {
				column = 1;
			} else if ( 481 <= winWidth && 767 > winWidth ) {
				column = 2;
			} else if ( 767 <= winWidth ) {
				column = WolfAlbumsParams.columns;
			}
			return column;
		},
		
		/**
		 * Get column width depending on column number
		 */
		getColumnWidth : function ( mainContainer ) {
			var columns = this.getNumColumns( mainContainer ),
				wrapperWidth = mainContainer.width(),
				columnWidth = Math.floor( wrapperWidth / columns );
			return columnWidth;
		},

		/**
		 * Set column width
		 */
		setColumnWidth : function ( selector, mainContainer ) {
			var ColumnWidth = this.getColumnWidth( mainContainer );
			$( selector ).each( function() {
				$( this ).css( { 'width' : ColumnWidth + 'px' } );
			} );
		}

	};

}( jQuery );


;( function( $ ) {

	'use strict';

	$( document ).ready( function() {

		if ( $( '.albums' ).length ) {
			WolfAlbums.init();
		}

	} );

} )( jQuery );