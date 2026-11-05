<?php
/**
 * A quieter page head: removes what WordPress prints on every page that the site does
 * not use, including the WordPress version.
 *
 * @package Osous_Site
 */

defined( 'ABSPATH' ) || exit;

/**
 * Drops head links and the emoji script the site has no use for.
 */
function osous_site_quiet_head(): void {
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
add_action( 'init', 'osous_site_quiet_head' );

add_filter( 'emoji_svg_url', '__return_false' );

// The version also travels in feeds.
add_filter( 'the_generator', '__return_empty_string' );
