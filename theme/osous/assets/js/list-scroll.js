/**
 * Pinned lists: the page's first list heading stays in place while the items scroll
 * past, and the item crossing the middle of the screen is highlighted.
 *
 * Two kinds of item share the heading, as on the original site: plain items
 * (.list-item) and items with a picture (.list_item_2), which also dim the inactive
 * items and pop their picture in.
 */
( () => {
	'use strict';

	const { gsap, ScrollTrigger } = window;
	gsap.registerPlugin( ScrollTrigger );

	const heading = document.querySelector(
		'.list-scroll .grid-2 > .cell:first-child'
	);

	/**
	 * Pins the heading from when it reaches the middle of the screen until the last item
	 * leaves it.
	 *
	 * @param {Element} lastItem
	 */
	function pinHeading( lastItem ) {
		ScrollTrigger.create( {
			trigger: heading,
			start: 'top center',
			endTrigger: lastItem,
			end: 'bottom center',
			pin: true,
			pinSpacing: false,
			anticipatePin: 1,
		} );
	}

	/**
	 * @param {Element[]} items
	 */
	function plainItems( items ) {
		items.forEach( ( item ) => {
			ScrollTrigger.create( {
				trigger: item,
				start: 'top center',
				end: 'bottom center',
				toggleClass: { targets: item, className: 'active' },
			} );
		} );
		ScrollTrigger.matchMedia( {
			'(min-width: 769px)': () => pinHeading( items[ items.length - 1 ] ),
		} );
	}

	/**
	 * @param {Element} item
	 */
	function popPicture( item ) {
		const picture = item.querySelector( '.list_item_img' );
		if ( ! picture ) {
			return;
		}
		gsap.fromTo(
			picture,
			{ opacity: 0, scale: 0.8, y: 20, rotation: -5 },
			{
				opacity: 1,
				scale: 1,
				y: 0,
				rotation: 0,
				duration: 0.5,
				ease: 'back.out(1.5)',
				scrollTrigger: {
					trigger: item,
					start: 'top center',
					end: 'bottom center',
					toggleActions: 'play reverse play reverse',
				},
			}
		);
	}

	/**
	 * @param {Element[]} items
	 */
	function pictureItems( items ) {
		ScrollTrigger.matchMedia( {
			'(min-width: 825px)': () => {
				items.forEach( ( item ) => {
					gsap.set( item, { opacity: 0.4 } );
					ScrollTrigger.create( {
						trigger: item,
						start: 'top center',
						end: 'bottom center',
						onToggle: ( self ) => {
							item.classList.toggle( 'active', self.isActive );
							gsap.to( item, {
								opacity: self.isActive ? 1 : 0.4,
								duration: 0.4,
								ease: 'power2.out',
								overwrite: 'auto',
							} );
						},
					} );
					popPicture( item );
				} );
				if ( heading ) {
					pinHeading( items[ items.length - 1 ] );
				}
			},
		} );
	}

	const plain = Array.from( document.querySelectorAll( '.list-item' ) );
	if ( heading && plain.length ) {
		plainItems( plain );
	}
	const pictures = Array.from( document.querySelectorAll( '.list_item_2' ) );
	if ( pictures.length ) {
		pictureItems( pictures );
	}

	// Pins freeze the size they measure. Measure again once the page has loaded and each
	// time a list picture arrives, so a lazy picture cannot leave a pin the wrong height
	// (the original site measured once, and its pins' height depended on timing).
	let frame = 0;
	const remeasure = () => {
		cancelAnimationFrame( frame );
		frame = requestAnimationFrame( () => ScrollTrigger.refresh() );
	};
	window.addEventListener( 'load', remeasure );
	document
		.querySelectorAll( '.list-scroll img, .list_item_2 img' )
		.forEach( ( picture ) => {
			if ( ! picture.complete ) {
				picture.addEventListener( 'load', remeasure, { once: true } );
			}
		} );
} )();
