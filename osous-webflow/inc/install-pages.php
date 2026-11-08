<?php
/**
 * On theme activation, create one page for every page-{slug}.php template, plus the home page.
 *
 * Safe to run again: a page whose slug already exists is left as it is, and site settings
 * are only filled in when they are still at WordPress's defaults.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Slug => title for every page the theme designs, read from the page-{slug}.php files.
 */
function osous_theme_pages() {
	$pages = array( 'home' => __( 'Home', 'osous' ) );
	foreach ( glob( get_template_directory() . '/page-*.php' ) as $file ) {
		$slug           = substr( basename( $file, '.php' ), strlen( 'page-' ) );
		$data           = get_file_data( $file, array( 'name' => 'Template Name' ) );
		$pages[ $slug ] = '' !== $data['name'] ? $data['name'] : ucwords( str_replace( '-', ' ', $slug ) );
	}
	return $pages;
}

/**
 * Creates the missing pages and points the front page at "home".
 */
function osous_install_pages() {
	$privacy_id = (int) get_option( 'wp_page_for_privacy_policy' );

	foreach ( osous_theme_pages() as $slug => $title ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_title'  => $title,
					'post_name'   => $slug,
				)
			);
			continue;
		}
		// WordPress's own "Privacy Policy" draft holds the slug: publish it so the designed page shows.
		if ( 'publish' !== $page->post_status && $page->ID === $privacy_id ) {
			wp_update_post(
				array(
					'ID'          => $page->ID,
					'post_status' => 'publish',
				)
			);
		}
	}

	$home = get_page_by_path( 'home' );
	if ( $home && 'page' !== get_option( 'show_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
	}

	if ( '' === get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'osous_install_pages' );
