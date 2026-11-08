<?php
/**
 * Cloudflare Turnstile for the contact form.
 * Keys are set in Appearance > Customize > Cloudflare Turnstile.
 * With no keys, the form works without the challenge.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function osous_turnstile_site_key() {
	return trim( (string) get_theme_mod( 'osous_turnstile_site_key', '' ) );
}

function osous_turnstile_secret_key() {
	return trim( (string) get_theme_mod( 'osous_turnstile_secret_key', '' ) );
}

function osous_customize_turnstile( $wp_customize ) {
	$wp_customize->add_section( 'osous_turnstile', array(
		'title'    => __( 'Cloudflare Turnstile', 'osous' ),
		'priority' => 160,
	) );
	$fields = array(
		'osous_turnstile_site_key'   => __( 'Site key', 'osous' ),
		'osous_turnstile_secret_key' => __( 'Secret key', 'osous' ),
	);
	foreach ( $fields as $id => $label ) {
		$wp_customize->add_setting( $id, array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $label,
			'section' => 'osous_turnstile',
			'type'    => 'text',
		) );
	}
}
add_action( 'customize_register', 'osous_customize_turnstile' );

/**
 * The widget, shown on the contact page when a site key is set.
 */
function osous_turnstile_widget() {
	$key = osous_turnstile_site_key();
	if ( '' === $key ) {
		return;
	}
	echo '<div class="cf-turnstile" data-sitekey="' . esc_attr( $key ) . '" data-theme="light"></div>';
}

function osous_turnstile_enqueue() {
	if ( '' === osous_turnstile_site_key() || ! is_page( 'contact' ) ) {
		return;
	}
	wp_enqueue_script( 'osous-turnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'osous_turnstile_enqueue' );

/**
 * True when verification is off (no secret key) or Cloudflare accepts the visitor's token.
 */
function osous_turnstile_passes() {
	$secret = osous_turnstile_secret_key();
	if ( '' === $secret ) {
		return true;
	}
	$token = isset( $_POST['cf-turnstile-response'] ) ? sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) ) : '';
	if ( '' === $token ) {
		return false;
	}
	$response = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', array(
		'timeout' => 10,
		'body'    => array(
			'secret'   => $secret,
			'response' => $token,
			'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '',
		),
	) );
	if ( is_wp_error( $response ) ) {
		return false;
	}
	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	return ! empty( $data['success'] );
}
