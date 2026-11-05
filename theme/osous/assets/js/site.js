/**
 * Site-wide behaviour: the navigation menus, the reveal-on-scroll effects and the
 * magnetic WhatsApp badge. Hover effects that need no script live in interactions.css.
 */
( () => {
	'use strict';

	const desktop = window.matchMedia( '(min-width: 992px)' );
	const reducedMotion = window.matchMedia(
		'(prefers-reduced-motion: reduce)'
	);
	const easeOutQuart = 'cubic-bezier(0.165, 0.84, 0.44, 1)';

	/* Navigation ---------------------------------------------------------------- */

	/**
	 * Toggles a menu part and keeps its button's aria-expanded in step.
	 *
	 * @param {Element} target  Element that receives the open class.
	 * @param {Element} control Element announced as the control.
	 * @param {string}  name    Class that marks the open state.
	 * @param {boolean} [force] Open (true) or close (false) instead of toggling.
	 */
	function toggle( target, control, name, force ) {
		const open = target.classList.toggle( name, force );
		control.setAttribute( 'aria-expanded', String( open ) );
		return open;
	}

	function initNavigation() {
		const navbar = document.querySelector( '.navbar' );
		if ( ! navbar ) {
			return;
		}
		const menuButton = navbar.querySelector( '.btn-menu' );
		const menu = navbar.querySelector( '.navbar-menu' );

		if ( menuButton && menu ) {
			menu.id = menu.id || 'site-menu';
			menuButton.setAttribute( 'role', 'button' );
			menuButton.setAttribute( 'aria-controls', menu.id );
			menuButton.setAttribute( 'aria-expanded', 'false' );
			menuButton.setAttribute( 'aria-label', 'Menu' );
			menuButton.addEventListener( 'click', ( event ) => {
				event.preventDefault();
				toggle( navbar, menuButton, 'is-menu-open' );
			} );
		}

		// Mobile: a top-level item opens its panel.
		navbar
			.querySelectorAll( '.menu-item-toggle' )
			.forEach( ( itemToggle ) => {
				const list = itemToggle.nextElementSibling;
				itemToggle.setAttribute( 'aria-expanded', 'false' );
				itemToggle.addEventListener( 'click', ( event ) => {
					if ( desktop.matches || ! list ) {
						return;
					}
					event.preventDefault();
					const open = toggle( itemToggle, itemToggle, 'w--open' );
					list.classList.toggle( 'w--open', open );
				} );
			} );

		// Mobile: a group heading inside a panel opens its list of links.
		navbar
			.querySelectorAll( '.dd-menu-list-toggle' )
			.forEach( ( groupToggle ) => {
				const links = groupToggle.nextElementSibling;
				groupToggle.setAttribute( 'aria-expanded', 'false' );
				groupToggle.addEventListener( 'click', ( event ) => {
					if ( desktop.matches || ! links ) {
						return;
					}
					event.preventDefault();
					const open = toggle( groupToggle, groupToggle, 'is-open' );
					if ( open && ! reducedMotion.matches ) {
						links.animate(
							[
								{ height: '0px' },
								{ height: `${ links.scrollHeight }px` },
							],
							{ duration: 200, easing: 'ease-out' }
						);
					}
				} );
			} );

		// Escape closes the mobile menu.
		document.addEventListener( 'keydown', ( event ) => {
			if (
				'Escape' === event.key &&
				menuButton &&
				navbar.classList.contains( 'is-menu-open' )
			) {
				toggle( navbar, menuButton, 'is-menu-open', false );
				menuButton.focus();
			}
		} );
	}

	/* Reveal on scroll ------------------------------------------------------------ */

	const fromLeft = { opacity: 0, transform: 'translateX(-100px)' };
	const fromRight = { opacity: 0, transform: 'translateX(100px)' };
	const fromBelow = { opacity: 0, transform: 'translateY(100px)' };
	const fade = { opacity: 0 };
	const grow = { opacity: 0, transform: 'scale(0.75)' };
	const shown = { opacity: 1, transform: 'none' };

	/**
	 * What appears as it scrolls into view: [selector, starting state, delay in ms].
	 * Mirrors the original site's scroll interactions one for one.
	 */
	const reveals = [
		[ '.navbar-brand', fromRight, 200 ],
		[ '.h1', fromLeft, 100 ],
		[ '.h2', fromLeft, 200 ],
		[ '.h3', fromLeft, 300 ],
		[ '.p, .p-r-sm', fromLeft, 400 ],
		[ '.btn', fromLeft, 200 ],
		[ '.icon-24', fromLeft, 200 ],
		[ '.input', fromBelow, 300 ],
		[ '.paragraph-base', fromBelow, 300 ],
		[ '.line', grow, 0 ],
		[
			'.t-m-md, .t-m-lg, .t-b-sm, .t-b-md, .t-b-lg, .t-b-xlg, .t-r-sm, .t-r-md',
			fade,
			300,
		],
	];

	/**
	 * Builds the paused animation that plays an element in: held at its starting state
	 * until it is played.
	 *
	 * @param {Element}  element
	 * @param {Object[]} keyframes
	 * @param {Object}   timing
	 * @return {Animation} The paused animation.
	 */
	function pausedAnimation( element, keyframes, timing ) {
		const animation = element.animate( keyframes, {
			...timing,
			fill: 'backwards',
		} );
		animation.pause();
		return animation;
	}

	/**
	 * Every element waiting to be revealed, with its animation. An element is revealed
	 * once its box overlaps the window vertically -- whatever clips it or however far to
	 * the side it sits -- which is how the original site decided it.
	 */
	const waiting = new Map();

	function revealVisible() {
		const bottom = window.innerHeight;
		waiting.forEach( ( animation, element ) => {
			const box = element.getBoundingClientRect();
			if ( box.top < bottom && box.bottom > 0 ) {
				animation.play();
				waiting.delete( element );
			}
		} );
	}

	function initReveals() {
		if ( reducedMotion.matches || ! Element.prototype.animate ) {
			return;
		}
		// Dividers draw themselves from the left half a second after they appear.
		document.querySelectorAll( '.divider' ).forEach( ( divider ) => {
			waiting.set(
				divider,
				pausedAnimation(
					divider,
					[ { transform: 'scaleX(0)' }, { transform: 'scaleX(1)' } ],
					{ duration: 300, delay: 500, easing: 'ease-out' }
				)
			);
		} );
		reveals.forEach( ( [ selector, from, delay ] ) => {
			const to = 'transform' in from ? shown : { opacity: 1 };
			document.querySelectorAll( selector ).forEach( ( element ) => {
				// An element matched by two rules plays the first one, as before.
				if ( ! waiting.has( element ) ) {
					waiting.set(
						element,
						pausedAnimation( element, [ from, to ], {
							duration: 1000,
							delay,
							easing: easeOutQuart,
						} )
					);
				}
			} );
		} );

		let frame = 0;
		const schedule = () => {
			if ( ! frame && waiting.size ) {
				frame = requestAnimationFrame( () => {
					frame = 0;
					revealVisible();
				} );
			}
		};
		window.addEventListener( 'scroll', schedule, { passive: true } );
		window.addEventListener( 'resize', schedule, { passive: true } );
		revealVisible();
	}

	/* Magnetic WhatsApp badge --------------------------------------------------------- */

	/**
	 * The badge follows the pointer across itself, up to 20px each way, and settles back
	 * to the centre when the pointer leaves.
	 */
	function initMagnetic() {
		const badge = document.querySelector( '.whatsapp .magnetic' );
		if (
			! badge ||
			reducedMotion.matches ||
			! window.matchMedia( '(hover: hover)' ).matches
		) {
			return;
		}
		badge.style.transition = 'transform 0.5s ease-out';
		badge.addEventListener( 'mousemove', ( event ) => {
			const box = badge.getBoundingClientRect();
			const x = ( ( event.clientX - box.left ) / box.width ) * 40 - 20;
			const y = ( ( event.clientY - box.top ) / box.height ) * 40 - 20;
			badge.style.transform = `translate(${ x.toFixed(
				1
			) }px, ${ y.toFixed( 1 ) }px)`;
		} );
		badge.addEventListener( 'mouseleave', () => {
			badge.style.transform = '';
		} );
	}

	initNavigation();
	initReveals();
	initMagnetic();
} )();
