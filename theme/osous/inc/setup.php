<?php
/**
 * Theme supports.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Declares what the theme supports.
 */
function osous_setup(): void {
	load_theme_textdomain( 'osous', OSOUS_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
}
add_action( 'after_setup_theme', 'osous_setup' );
