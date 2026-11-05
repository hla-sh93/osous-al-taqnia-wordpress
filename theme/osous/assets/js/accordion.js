/**
 * Accordions: a click opens or folds the answer. Folded, an accordion shows its first
 * 80px (the question), as set in interactions.css.
 */
( () => {
	'use strict';

	const reducedMotion = window.matchMedia(
		'(prefers-reduced-motion: reduce)'
	);

	/**
	 * Opens or folds an accordion, animating between the two heights.
	 *
	 * @param {HTMLElement} accordion
	 * @param {boolean}     open
	 */
	function setOpen( accordion, open ) {
		const from = accordion.offsetHeight;
		accordion.classList.toggle( 'is-open', open );
		accordion.setAttribute( 'aria-expanded', String( open ) );
		accordion.style.height = open ? 'auto' : '';
		const to = accordion.offsetHeight;
		if ( ! reducedMotion.matches ) {
			accordion.animate(
				[ { height: `${ from }px` }, { height: `${ to }px` } ],
				{ duration: 300, easing: 'ease-out' }
			);
		}
	}

	document.querySelectorAll( '.accordion' ).forEach( ( accordion ) => {
		const flip = () =>
			setOpen( accordion, ! accordion.classList.contains( 'is-open' ) );
		accordion.setAttribute( 'role', 'button' );
		accordion.setAttribute( 'tabindex', '0' );
		accordion.setAttribute( 'aria-expanded', 'false' );
		accordion.addEventListener( 'click', flip );
		accordion.addEventListener( 'keydown', ( event ) => {
			if ( 'Enter' === event.key || ' ' === event.key ) {
				event.preventDefault();
				flip();
			}
		} );
	} );
} )();
