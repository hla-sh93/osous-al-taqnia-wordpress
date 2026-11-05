<?php
/**
 * Styles WordPress loads on every page that this design does not use.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Removes the block library's front-end styles: the pages are not made of core blocks.
 * Posts keep them, since their bodies are written in the block editor.
 */
function osous_dequeue_block_styles(): void {
	if ( is_singular( 'post' ) ) {
		return;
	}
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'osous_dequeue_block_styles', 100 );
