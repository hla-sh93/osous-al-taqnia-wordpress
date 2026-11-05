/**
 * Card carousels (Swiper): endless, with the card in the active slide highlighted.
 */
( () => {
	'use strict';

	document.querySelectorAll( '.swiper-container' ).forEach( ( container ) => {
		// Swiper attaches itself to the container; nothing else needs the instance.
		// eslint-disable-next-line no-new
		new window.Swiper( container, {
			slidesPerView: 'auto',
			loop: true,
			navigation: {
				nextEl: container.querySelector( '.swiper-button-next' ),
				prevEl: container.querySelector( '.swiper-button-prev' ),
			},
			on: {
				slideChange( swiper ) {
					container
						.querySelectorAll( '.card-4' )
						.forEach( ( card ) =>
							card.classList.remove( 'active' )
						);
					swiper.slides[ swiper.activeIndex ]
						?.querySelector( '.card-4' )
						?.classList.add( 'active' );
				},
			},
		} );
	} );
} )();
