<?php
/**
 * The site's content files: page manifests and the HTML they are built from.
 *
 * Each WordPress page that shows a designed layout carries a content key in the post meta
 * `_osous_content_key`; the key names its manifest in content/pages/<key>.json. Pages are
 * found by that key, never by slug, so renaming a page's address changes nothing else.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

const OSOUS_CONTENT_META = '_osous_content_key';

/**
 * Absolute path of a file under the theme's content/ folder.
 *
 * @param string $relative Path below content/, e.g. "site/navbar.html".
 */
function osous_content_path( string $relative ): string {
	return OSOUS_DIR . '/content/' . ltrim( $relative, '/' );
}

/**
 * Reads a content file. A content key or path never comes from a visitor, but it is
 * still confined to the content folder so a wrong value cannot read anything else.
 *
 * @param string $relative Path below content/.
 * @return string The file's contents, or '' when it does not exist.
 */
function osous_read_content( string $relative ): string {
	$root = realpath( OSOUS_DIR . '/content' );
	$path = realpath( osous_content_path( $relative ) );
	if ( false === $root || false === $path || ! str_starts_with( $path, $root . DIRECTORY_SEPARATOR ) ) {
		return '';
	}
	$contents = file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local theme file, not a remote URL.
	return false === $contents ? '' : $contents;
}

/**
 * Decodes a JSON content file, once per request.
 *
 * @param string $relative Path below content/.
 * @return array<mixed>|null
 */
function osous_read_json( string $relative ): ?array {
	static $cache = array();
	if ( ! array_key_exists( $relative, $cache ) ) {
		$data               = json_decode( osous_read_content( $relative ), true );
		$cache[ $relative ] = is_array( $data ) ? $data : null;
	}
	return $cache[ $relative ];
}

/**
 * The manifest for a content key.
 *
 * @param string $key Content key, e.g. "home" or "fortinet-iraq".
 * @return array<string, mixed>|null
 */
function osous_manifest( string $key ): ?array {
	if ( ! preg_match( '/^[a-z0-9-]+$/', $key ) ) {
		return null;
	}
	return osous_read_json( "pages/{$key}.json" );
}

/**
 * Every content key the theme ships, from the manifests on disk.
 *
 * @return string[]
 */
function osous_content_keys(): array {
	$files = glob( osous_content_path( 'pages/*.json' ) );
	return array_map( static fn( string $file ): string => basename( $file, '.json' ), $files ? $files : array() );
}

/**
 * Content key => page ID for every page that has one. One query per request.
 *
 * @param bool $fresh Query again instead of using this request's answer.
 * @return array<string, int>
 */
function osous_page_ids( bool $fresh = false ): array {
	static $map = null;
	if ( null === $map || $fresh ) {
		$map   = array();
		$pages = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => array( 'publish', 'draft', 'private' ),
				'posts_per_page' => -1,
				'meta_key'       => OSOUS_CONTENT_META, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- one bounded query per request, cached.
				'fields'         => 'ids',
				'no_found_rows'  => true,
			)
		);
		foreach ( $pages as $page_id ) {
			$map[ (string) get_post_meta( $page_id, OSOUS_CONTENT_META, true ) ] = (int) $page_id;
		}
	}
	return $map;
}

/**
 * The URL of the page that shows a content key ('' is the front page).
 *
 * @param string $key Content key, or '' for the front page.
 */
function osous_page_url( string $key ): string {
	$key = '' === $key ? 'home' : $key;
	$ids = osous_page_ids();
	if ( isset( $ids[ $key ] ) ) {
		$url = get_permalink( $ids[ $key ] );
		if ( $url ) {
			return $url;
		}
	}
	return 'home' === $key ? home_url( '/' ) : home_url( "/{$key}/" );
}

/**
 * The manifest of the page being viewed, if it shows a designed layout.
 *
 * @return array<string, mixed>|null
 */
function osous_current_manifest(): ?array {
	if ( is_404() ) {
		return osous_template_manifest( 'not-found' );
	}
	if ( is_home() || is_archive() || is_search() ) {
		// Every list of posts wears the blog page's design.
		$page_id = (int) get_option( 'page_for_posts' );
	} elseif ( is_page() ) {
		$page_id = get_queried_object_id();
	} else {
		return null;
	}
	$key = (string) get_post_meta( $page_id, OSOUS_CONTENT_META, true );
	return '' === $key ? null : osous_manifest( $key );
}

/**
 * The manifest of a template page (a design that is not a page of its own).
 *
 * @param string $key Template key, e.g. "not-found".
 * @return array<string, mixed>|null
 */
function osous_template_manifest( string $key ): ?array {
	return preg_match( '/^[a-z0-9-]+$/', $key ) ? osous_read_json( "templates/{$key}.json" ) : null;
}
