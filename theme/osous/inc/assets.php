<?php
/**
 * Stylesheets and scripts.
 *
 * One table lists every asset; a page gets the site-wide ones plus those its manifest's
 * features ask for. Stylesheets keep the source's cascade order through their
 * dependencies, never through the order of a loop.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Every stylesheet, in cascade order (each depends on the one before).
 *
 * @return array<string, string> Handle => path below assets/.
 */
function osous_styles(): array {
	return array(
		'osous-fonts'     => 'css/fonts.css',
		'osous-base'      => 'css/base.css',
		'osous-framework' => 'css/framework.css',
		'osous-tokens'    => 'css/tokens.css',
		'osous-site'      => 'css/site.css',
		'osous-interact'  => 'css/interactions.css',
	);
}

/**
 * Every script: its file, version, dependencies, and the manifest feature that needs it
 * ('*' for every page).
 *
 * @return array<string, array{src: string, ver: string, deps: string[], feature: string}>
 */
function osous_scripts(): array {
	return array(
		'gsap'                    => array(
			'src'     => 'js/vendor/gsap.min.js',
			'ver'     => '3.15.0',
			'deps'    => array(),
			'feature' => '',
		),
		'gsap-scrolltrigger'      => array(
			'src'     => 'js/vendor/ScrollTrigger.min.js',
			'ver'     => '3.15.0',
			'deps'    => array( 'gsap' ),
			'feature' => '',
		),
		'swiper'                  => array(
			'src'     => 'js/vendor/swiper-bundle.min.js',
			'ver'     => '11.2.10',
			'deps'    => array(),
			'feature' => '',
		),
		'osous-site'              => array(
			'src'     => 'js/site.js',
			'ver'     => OSOUS_VERSION,
			'deps'    => array(),
			'feature' => '*',
		),
		'osous-accordion'         => array(
			'src'     => 'js/accordion.js',
			'ver'     => OSOUS_VERSION,
			'deps'    => array(),
			'feature' => 'accordion',
		),
		'osous-carousel'          => array(
			'src'     => 'js/carousel.js',
			'ver'     => OSOUS_VERSION,
			'deps'    => array( 'swiper' ),
			'feature' => 'swiper',
		),
		'osous-list-scroll'       => array(
			'src'     => 'js/list-scroll.js',
			'ver'     => OSOUS_VERSION,
			'deps'    => array( 'gsap-scrolltrigger' ),
			'feature' => 'list-scroll',
		),
		'osous-contact-form'      => array(
			'src'     => 'js/contact-form.js',
			'ver'     => OSOUS_VERSION,
			'deps'    => array(),
			'feature' => 'contact-form',
		),
		'osous-feature-scroll'    => array(
			'src'     => 'js/feature-scroll.js',
			'ver'     => OSOUS_VERSION,
			'deps'    => array( 'gsap-scrolltrigger' ),
			'feature' => 'feature-scroll',
		),
		'osous-overlapping-cards' => array(
			'src'     => 'js/overlapping-cards.js',
			'ver'     => OSOUS_VERSION,
			'deps'    => array( 'gsap-scrolltrigger' ),
			'feature' => 'overlapping-cards',
		),
	);
}

/**
 * Enqueues the stylesheets and the scripts the current page needs.
 */
function osous_enqueue_assets(): void {
	$previous = array();
	foreach ( osous_styles() as $handle => $path ) {
		wp_enqueue_style( $handle, get_theme_file_uri( "assets/{$path}" ), $previous, OSOUS_VERSION );
		$previous = array( $handle );
	}

	$manifest = osous_current_manifest();
	$features = array_merge( array( '*' ), (array) ( $manifest['features'] ?? array() ) );
	foreach ( osous_scripts() as $handle => $script ) {
		wp_register_script(
			$handle,
			get_theme_file_uri( "assets/{$script['src']}" ),
			$script['deps'],
			$script['ver'],
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		if ( in_array( $script['feature'], $features, true ) ) {
			wp_enqueue_script( $handle );
			osous_script_settings( $handle, $script['feature'], (array) ( $manifest['settings'] ?? array() ) );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'osous_enqueue_assets' );

/**
 * Hands a script the page's settings for its feature, as window.osousSettings[feature].
 *
 * @param string               $handle   Script handle.
 * @param string               $feature  The script's feature.
 * @param array<string, mixed> $settings The page's settings, by feature.
 */
function osous_script_settings( string $handle, string $feature, array $settings ): void {
	if ( empty( $settings[ $feature ] ) ) {
		return;
	}
	wp_add_inline_script(
		$handle,
		sprintf( 'window.osousSettings = Object.assign( window.osousSettings || {}, %s );', wp_json_encode( array( $feature => $settings[ $feature ] ) ) ),
		'before'
	);
}

/**
 * Marks the document as scripted before anything paints, so styles for scripted states
 * (folded accordions) apply from the first frame and never flash.
 */
function osous_js_class(): void {
	wp_print_inline_script_tag( "document.documentElement.classList.add('js');" );
}
add_action( 'wp_head', 'osous_js_class', 0 );

/**
 * Preloads the two fonts every page paints first, so text does not reflow.
 */
function osous_preload_fonts(): void {
	foreach ( array( 'inter-latin', 'sora-latin' ) as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( "assets/fonts/{$font}.woff2" ) )
		);
	}
}
add_action( 'wp_head', 'osous_preload_fonts', 1 );

/**
 * The site icon from the design, unless one is set in Settings → General.
 */
function osous_favicon(): void {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" href="%s" type="image/png">' . "\n", esc_url( get_theme_file_uri( 'assets/images/favicon.png' ) ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( get_theme_file_uri( 'assets/images/webclip.jpg' ) ) );
}
add_action( 'wp_head', 'osous_favicon' );
