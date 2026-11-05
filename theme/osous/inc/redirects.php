<?php
/**
 * Old addresses: a page whose address was corrected (content/redirects.json) is reached
 * from its old address by a permanent redirect, so existing links and search results
 * keep working.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Sends a request for an old address to the page's current one.
 */
function osous_redirect_old_addresses(): void {
	if ( ! is_404() ) {
		return;
	}
	$request = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
	$path    = trim( (string) wp_parse_url( $request, PHP_URL_PATH ), '/' );
	$moved   = (array) osous_read_json( 'redirects.json' );
	if ( isset( $moved[ $path ] ) ) {
		wp_safe_redirect( osous_page_url( (string) $moved[ $path ] ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'osous_redirect_old_addresses' );
