<?php
/**
 * Hardening that belongs to the site as a whole.
 *
 * Server-level protections (TLS, HSTS, file permissions, a web application firewall)
 * stay with the host; this file covers what WordPress itself exposes.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Security headers on every front-end response.
 *
 * @param array<string, string> $headers Headers WordPress is about to send.
 * @return array<string, string>
 */
function osous_security_headers( array $headers ): array {
	$headers['X-Content-Type-Options'] = 'nosniff';
	$headers['X-Frame-Options']        = 'SAMEORIGIN';
	$headers['Referrer-Policy']        = 'strict-origin-when-cross-origin';
	$headers['Permissions-Policy']     = 'camera=(), microphone=(), geolocation=(), payment=()';
	return $headers;
}
add_filter( 'wp_headers', 'osous_security_headers' );

// XML-RPC is an old remote-publishing door the site does not use. Turning it "off" only
// stops the logged-in methods; pingbacks (used to aim floods at other sites) stay open
// unless every method is removed. The host can also block xmlrpc.php outright.
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'xmlrpc_methods', '__return_empty_array' );

/**
 * Removes the X-Pingback header that advertises XML-RPC.
 *
 * @param array<string, string> $headers Headers WordPress is about to send.
 * @return array<string, string>
 */
function osous_remove_pingback_header( array $headers ): array {
	unset( $headers['X-Pingback'] );
	return $headers;
}
add_filter( 'wp_headers', 'osous_remove_pingback_header' );

/**
 * Stops listing user accounts to visitors through the REST API.
 *
 * @param array<string, mixed> $endpoints Registered REST routes.
 * @return array<string, mixed>
 */
function osous_hide_user_endpoints( array $endpoints ): array {
	if ( current_user_can( 'list_users' ) ) {
		return $endpoints;
	}
	unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	return $endpoints;
}
add_filter( 'rest_endpoints', 'osous_hide_user_endpoints' );

/**
 * Stops ?author=N from revealing user names through the author-archive redirect.
 */
function osous_block_author_enumeration(): void {
	if ( is_admin() || ! isset( $_GET['author'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only check, nothing is processed.
		return;
	}
	wp_safe_redirect( home_url( '/' ), 301 );
	exit;
}
add_action( 'template_redirect', 'osous_block_author_enumeration', 1 );

/**
 * Author archives are not part of this site: send them to the home page.
 */
function osous_redirect_author_archives(): void {
	if ( is_author() ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'osous_redirect_author_archives' );

/**
 * A failed log-in says the same thing whichever field was wrong.
 */
function osous_generic_login_error(): string {
	return esc_html__( 'The user name or password is incorrect.', 'osous' );
}
add_filter( 'login_errors', 'osous_generic_login_error' );
