/**
 * Dell Partner Iraq page: "Why choose" active card, hero word reveal, section fade-up, FAQ open/close.
 * Everything is limited to #main; the shared navbar and footer keep their own scripts.
 */
( function () {
	var d = document;
	var main = d.getElementById( 'main' );
	if ( ! main ) {
		return;
	}
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var all = function ( sel ) {
		return [].slice.call( main.querySelectorAll( sel ) );
	};

	// "Why choose": the card in the middle of the screen turns active.
	var reasons = all( '.reason' );
	if ( reasons.length ) {
		reasons[ 0 ].classList.add( 'active' );
		if ( 'IntersectionObserver' in window ) {
			var listObserver = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						reasons.forEach( function ( r ) {
							r.classList.toggle( 'active', r === entry.target );
						} );
					}
				} );
			}, { rootMargin: '-45% 0px -54% 0px' } );
			reasons.forEach( function ( r ) {
				listObserver.observe( r );
			} );
		}
	}

	// FAQ: animated open and close.
	if ( ! reduce && Element.prototype.animate ) {
		all( '.faq details' ).forEach( function ( det ) {
			var sum = det.querySelector( 'summary' );
			var anim = null;
			sum.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				if ( anim ) {
					anim.cancel();
				}
				var from = det.offsetHeight;
				var closing = det.open;
				var to;
				if ( closing ) {
					to = sum.offsetHeight;
				} else {
					det.open = true;
					to = det.offsetHeight;
				}
				anim = det.animate( { height: [ from + 'px', to + 'px' ] }, { duration: 400, easing: 'cubic-bezier(.22,1,.36,1)' } );
				anim.onfinish = function () {
					anim = null;
					if ( closing ) {
						det.open = false;
					}
				};
				anim.oncancel = function () {
					anim = null;
				};
			} );
		} );
	}

	if ( reduce || ! ( 'IntersectionObserver' in window ) ) {
		return;
	}
	d.documentElement.classList.add( 'rv-on' );

	// Hero title: each word rises in turn.
	var h1 = main.querySelector( '.hero h1' );
	if ( h1 ) {
		var i = 0;
		[].slice.call( h1.childNodes ).forEach( function ( node ) {
			if ( 3 !== node.nodeType ) {
				return;
			}
			var frag = d.createDocumentFragment();
			node.textContent.split( /(\s+)/ ).forEach( function ( part ) {
				if ( ! part ) {
					return;
				}
				if ( /^\s+$/.test( part ) ) {
					frag.appendChild( d.createTextNode( part ) );
					return;
				}
				var span = d.createElement( 'span' );
				span.className = 'w';
				span.style.setProperty( '--i', i++ );
				span.textContent = part;
				frag.appendChild( span );
			} );
			h1.replaceChild( frag, node );
		} );
	}

	// Sections fade up as they enter the screen, siblings one after another.
	var els = all( '.intro,.jump,.split>div,.head,.cards>.card,#servers .actions,#storage .actions,.note,.steps>.step,.industries>.card,.faq,.contact' );
	els.forEach( function ( el ) {
		var siblings = [].slice.call( el.parentNode.children ).filter( function ( c ) {
			return els.indexOf( c ) > -1;
		} );
		el.style.setProperty( '--d', Math.min( siblings.indexOf( el ) * 0.08, 0.4 ) + 's' );
		el.classList.add( 'rv' );
	} );
	var revealObserver = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( ! entry.isIntersecting ) {
				return;
			}
			var el = entry.target;
			el.classList.add( 'in' );
			revealObserver.unobserve( el );
			setTimeout( function () {
				el.classList.remove( 'rv' );
				el.style.removeProperty( '--d' );
			}, 1000 + parseFloat( getComputedStyle( el ).getPropertyValue( '--d' ) || 0 ) * 1000 );
		} );
	}, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' } );
	els.forEach( function ( el ) {
		revealObserver.observe( el );
	} );
}() );
