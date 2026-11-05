/**
 * Contact form: the submit button says the design's "Please wait..." while sending,
 * and cannot be pressed twice.
 */
( () => {
	'use strict';

	document.querySelectorAll( '.w-form form' ).forEach( ( form ) => {
		form.addEventListener( 'submit', () => {
			const button = form.querySelector( '[type="submit"]' );
			if ( button && button.dataset.wait ) {
				button.value = button.dataset.wait;
				button.disabled = true;
			}
		} );
	} );
} )();
