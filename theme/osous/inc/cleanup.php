<?php
/**
 * Removes what WordPress adds to every page that this design does not use.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Drops head output and scripts the site has no use for.
 */
function osous_cleanup_head(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
}
add_action( 'init', 'osous_cleanup_head' );

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

add_filter( 'emoji_svg_url', '__return_false' );
