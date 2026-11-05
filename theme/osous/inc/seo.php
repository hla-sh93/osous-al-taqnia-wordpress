<?php
/**
 * Search and sharing metadata.
 *
 * The theme prints the title, description and sharing tags from the page manifests.
 * When an SEO plugin is active it owns all of that, and the theme steps aside.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether an SEO plugin is handling the <head>.
 */
function osous_seo_plugin_active(): bool {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'THE_SEO_FRAMEWORK_VERSION' );
}

/**
 * The page's search title from its manifest.
 *
 * @param string $title Title WordPress would use; empty to let it build one.
 */
function osous_document_title( string $title ): string {
	$manifest = osous_current_manifest();
	return ( ! osous_seo_plugin_active() && ! empty( $manifest['title'] ) ) ? (string) $manifest['title'] : $title;
}
add_filter( 'pre_get_document_title', 'osous_document_title' );

/**
 * Title and description of what is being viewed, for the meta tags.
 *
 * @return array{title: string, description: string}
 */
function osous_meta_fields(): array {
	$manifest = osous_current_manifest();
	if ( $manifest ) {
		return array(
			'title'       => (string) ( $manifest['og_title'] ?? $manifest['title'] ?? '' ),
			'description' => (string) ( $manifest['description'] ?? '' ),
		);
	}
	if ( is_singular() ) {
		return array(
			'title'       => wp_get_document_title(),
			'description' => wp_strip_all_tags( get_the_excerpt( get_queried_object_id() ) ),
		);
	}
	return array(
		'title'       => wp_get_document_title(),
		'description' => (string) get_bloginfo( 'description' ),
	);
}

/**
 * Prints the description and the Open Graph and Twitter tags.
 */
function osous_meta_tags(): void {
	if ( osous_seo_plugin_active() ) {
		return;
	}
	$fields = osous_meta_fields();
	$tags   = array(
		array( 'name', 'description', $fields['description'] ),
		array( 'property', 'og:title', $fields['title'] ),
		array( 'property', 'og:description', $fields['description'] ),
		array( 'property', 'og:type', is_singular( 'post' ) ? 'article' : 'website' ),
		array( 'property', 'og:url', osous_current_url() ),
		array( 'property', 'og:site_name', get_bloginfo( 'name' ) ),
		array( 'name', 'twitter:card', 'summary_large_image' ),
		array( 'name', 'twitter:title', $fields['title'] ),
		array( 'name', 'twitter:description', $fields['description'] ),
	);
	foreach ( $tags as list( $attribute, $name, $content ) ) {
		if ( '' !== $content ) {
			printf( '<meta %1$s="%2$s" content="%3$s">' . "\n", esc_attr( $attribute ), esc_attr( $name ), esc_attr( $content ) );
		}
	}
}
add_action( 'wp_head', 'osous_meta_tags', 2 );
