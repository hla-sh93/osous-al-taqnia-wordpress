<?php
/**
 * The contact form: receives a submission, checks it, and mails it to the site.
 *
 * The form's markup is the design's (content/pages/contact/), with {{form-action}} and
 * {{form-fields}} placeholders the theme fills here. After a submission the visitor is
 * sent back to the page, which shows the design's own success or error message.
 *
 * Protection: POST only, a nonce, a honeypot field, a limit of submissions per address,
 * and every field validated and cleaned before it reaches the mail.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

const OSOUS_CONTACT_ACTION = 'osous_contact';
const OSOUS_CONTACT_LIMIT  = 5; // Submissions per address per window.
const OSOUS_CONTACT_WINDOW = 10 * MINUTE_IN_SECONDS;

/**
 * The form's fields: name => [maximum length, required, sanitizer].
 *
 * @return array<string, array{0: int, 1: bool, 2: callable}>
 */
function osous_contact_fields(): array {
	return array(
		'name'    => array( 256, true, 'sanitize_text_field' ),
		'company' => array( 256, true, 'sanitize_text_field' ),
		'email'   => array( 256, true, 'sanitize_email' ),
		'mobile'  => array( 256, false, 'sanitize_text_field' ),
		'message' => array( 5000, true, 'sanitize_textarea_field' ),
	);
}

/**
 * Fills the form's placeholders: where it posts to, and the hidden fields it carries.
 *
 * @param string $markup A content file's markup, after its other placeholders.
 */
function osous_contact_placeholders( string $markup ): string {
	if ( ! str_contains( $markup, '{{form-fields}}' ) ) {
		return $markup;
	}
	$fields = sprintf(
		'<input type="hidden" name="action" value="%1$s"><input type="hidden" name="page" value="%2$d">%3$s<div class="osous-hp" aria-hidden="true"><input type="text" name="website" value="" tabindex="-1" autocomplete="off"></div>',
		esc_attr( OSOUS_CONTACT_ACTION ),
		get_queried_object_id(),
		wp_nonce_field( OSOUS_CONTACT_ACTION, '_osous_nonce', false, false )
	);
	return str_replace(
		array( '{{form-action}}', '{{form-fields}}' ),
		array( esc_url( admin_url( 'admin-post.php' ) ), $fields ),
		$markup
	);
}

/**
 * The visitor's address, for the submission limit. Only REMOTE_ADDR is used: headers a
 * visitor can set (X-Forwarded-For) would let anyone escape the limit.
 */
function osous_contact_client(): string {
	$address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	return md5( $address );
}

/**
 * Handles a submission and sends the visitor back with the result.
 */
function osous_contact_submit(): void {
	$page_id = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Missing -- only used for the redirect, which is checked below.
	$back    = $page_id ? get_permalink( $page_id ) : home_url( '/' );
	$back    = $back ? $back : home_url( '/' );
	$result  = osous_contact_process();
	wp_safe_redirect( add_query_arg( 'contact', $result, $back ) . '#email-form', 303 );
	exit;
}
add_action( 'admin_post_nopriv_' . OSOUS_CONTACT_ACTION, 'osous_contact_submit' );
add_action( 'admin_post_' . OSOUS_CONTACT_ACTION, 'osous_contact_submit' );

/**
 * Checks and sends a submission.
 *
 * @return string 'sent' or 'failed'.
 */
function osous_contact_process(): string {
	if ( ! isset( $_POST['_osous_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['_osous_nonce'] ) ), OSOUS_CONTACT_ACTION ) ) {
		return 'failed';
	}
	// A bot that fills the hidden field is told it succeeded and nothing is sent.
	if ( ! empty( $_POST['website'] ) ) {
		return 'sent';
	}

	$key   = 'osous_contact_' . osous_contact_client();
	$count = (int) get_transient( $key );
	if ( $count >= OSOUS_CONTACT_LIMIT ) {
		return 'failed';
	}

	$values = array();
	foreach ( osous_contact_fields() as $name => list( $max, $required, $sanitize ) ) {
		$raw   = isset( $_POST[ $name ] ) ? (string) wp_unslash( $_POST[ $name ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized on the next line by the field's own sanitizer.
		$value = trim( (string) call_user_func( $sanitize, $raw ) );
		if ( ( $required && '' === $value ) || mb_strlen( $value ) > $max ) {
			return 'failed';
		}
		$values[ $name ] = $value;
	}
	if ( ! is_email( $values['email'] ) ) {
		return 'failed';
	}

	set_transient( $key, $count + 1, OSOUS_CONTACT_WINDOW );
	return osous_contact_mail( $values ) ? 'sent' : 'failed';
}

/**
 * Mails a checked submission to the site.
 *
 * @param array<string, string> $values Cleaned field values.
 */
function osous_contact_mail( array $values ): bool {
	/**
	 * Filters who receives the contact form's messages (default: the site's admin email).
	 *
	 * @param string $recipient Email address.
	 */
	$recipient = (string) apply_filters( 'osous_contact_recipient', get_option( 'admin_email' ) );
	$name      = str_replace( array( "\r", "\n", '"' ), '', $values['name'] );
	$subject   = sprintf(
		/* translators: 1: sender's name, 2: sender's company. */
		__( 'Website enquiry from %1$s (%2$s)', 'osous' ),
		$name,
		$values['company']
	);
	$body = implode(
		"\n",
		array(
			__( 'Name:', 'osous' ) . ' ' . $values['name'],
			__( 'Company:', 'osous' ) . ' ' . $values['company'],
			__( 'Email:', 'osous' ) . ' ' . $values['email'],
			__( 'Mobile:', 'osous' ) . ' ' . $values['mobile'],
			'',
			$values['message'],
		)
	);
	return wp_mail( $recipient, $subject, $body, array( sprintf( 'Reply-To: "%1$s" <%2$s>', $name, $values['email'] ) ) );
}

/**
 * Shows the design's success or error message after a submission (see interactions.css).
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function osous_contact_body_class( array $classes ): array {
	$result = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.
	if ( in_array( $result, array( 'sent', 'failed' ), true ) ) {
		$classes[] = 'contact-' . $result;
	}
	return $classes;
}
add_filter( 'body_class', 'osous_contact_body_class' );

/**
 * Keeps page caches from storing a page with the form: its nonce must stay fresh.
 */
function osous_contact_no_cache(): void {
	$manifest = osous_current_manifest();
	if ( $manifest && in_array( 'contact-form', (array) $manifest['features'], true ) ) {
		if ( ! defined( 'DONOTCACHEPAGE' ) ) {
			define( 'DONOTCACHEPAGE', true ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- the constant page-cache plugins read.
		}
		nocache_headers();
	}
}
add_action( 'template_redirect', 'osous_contact_no_cache' );
