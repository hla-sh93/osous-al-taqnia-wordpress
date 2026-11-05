/**
 * Overlapping cards (desktop): the section is pinned while scrolling steps through a
 * stack of cards, fading out the ones already passed.
 */
( () => {
	'use strict';

	const { gsap, ScrollTrigger } = window;
	gsap.registerPlugin( ScrollTrigger );

	ScrollTrigger.matchMedia( {
		'(min-width: 992px)': () => {
			const cards = gsap.utils.toArray( '.card-overlapping-item' );
			if ( ! cards.length ) {
				return;
			}
			cards.forEach( ( card, i ) => {
				gsap.set( card, {
					x: i * 40,
					y: i * 15,
					opacity: 1 - i * 0.1,
					zIndex: cards.length - i,
				} );
			} );

			const showCard = ( activeIndex ) => {
				cards.forEach( ( card, i ) => {
					card.querySelector( '.card-4' )?.classList.toggle(
						'active2',
						i === activeIndex
					);
					const content = card.querySelector( '.content' );
					if ( content ) {
						gsap.to( content, {
							opacity: i === activeIndex ? 1 : 0,
						} );
					}
					gsap.to( card, {
						opacity: i < activeIndex ? 0 : 1,
						duration: 0.4,
						ease: 'power2.out',
					} );
				} );
			};

			ScrollTrigger.create( {
				trigger: '.section.overlapping-cards',
				start: 'top top',
				end: () => `+=${ ( cards.length - 1 ) * 300 }`,
				pin: true,
				scrub: true,
				onUpdate: ( self ) =>
					showCard(
						Math.floor( self.progress * ( cards.length - 1 ) )
					),
			} );
			showCard( 0 );
		},
	} );
} )();
