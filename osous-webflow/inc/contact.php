<?php
/**
 * Contact form: the built-in form, or a Contact Form 7 form when a shortcode is set
 * in Appearance > Customize > Contact form.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function osous_cf7_shortcode() {
	return trim( (string) get_theme_mod( 'osous_cf7_shortcode', '' ) );
}

function osous_customize_contact_form( $wp_customize ) {
	$wp_customize->add_section( 'osous_contact_form', array(
		'title'    => __( 'Contact form', 'osous' ),
		'priority' => 170,
	) );
	$wp_customize->add_setting( 'osous_cf7_shortcode', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'osous_cf7_shortcode', array(
		'label'       => __( 'Contact Form 7 shortcode', 'osous' ),
		'description' => __( 'For example [contact-form-7 id="e5a2790" title="Contact"]. Leave empty to use the built-in form.', 'osous' ),
		'section'     => 'osous_contact_form',
		'type'        => 'text',
	) );
}
add_action( 'customize_register', 'osous_customize_contact_form' );
