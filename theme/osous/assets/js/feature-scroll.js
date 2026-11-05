/**
 * Feature slides (desktop): the section is pinned while each card scrolls into the frame
 * in turn, and the indicator for the current card is highlighted. A page may set the
 * slide's timing (window.osousSettings['feature-scroll'] = { duration, ease }).
 */
( () => {
	'use strict';

	const { gsap, ScrollTrigger } = window;
	gsap.registerPlugin( ScrollTrigger );
	const timing = {
		duration: 0.6,
		ease: 'power2.inOut',
		...( window.osousSettings || {} )[ 'feature-scroll' ],
	};

	ScrollTrigger.matchMedia( {
		'(min-width: 992px)': () => {
			const cards = gsap.utils.toArray( '.feature-card' );
			if ( ! cards.length ) {
				return;
			}
			const indicators = gsap.utils.toArray( '.indicator' );

			const showSlide = ( index ) => {
				gsap.to( '.feature-card-wrapper', {
					yPercent: -100 * index,
					...timing,
				} );
				indicators.forEach( ( indicator, i ) =>
					indicator.classList.toggle( 'active', i === index )
				);
			};

			ScrollTrigger.create( {
				trigger: '.split-section',
				start: 'center center',
				end: () => `+=${ cards.length * 500 }`,
				pin: true,
				scrub: true,
			} );
			cards.forEach( ( card, i ) => {
				ScrollTrigger.create( {
					trigger: card,
					start: 'top center',
					end: 'bottom center',
					onEnter: () => showSlide( i ),
					onEnterBack: () => showSlide( i ),
				} );
			} );
			showSlide( 0 );
		},
		'(max-width: 991px)': () => {
			gsap.set( '.feature-card-wrapper', { clearProps: 'all' } );
			document
				.querySelectorAll( '.indicator, .feature-card' )
				.forEach( ( element ) => element.classList.remove( 'active' ) );
		},
	} );
} )();
