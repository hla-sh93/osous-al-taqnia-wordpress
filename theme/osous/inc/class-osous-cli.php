<?php
/**
 * WP-CLI commands: `wp osous install-pages`.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * Puts the theme's pages into WordPress.
 */
class Osous_CLI {

	/**
	 * Creates or updates one page per content manifest, and sets the front page.
	 *
	 * A page is matched by its content key first, then by its slug (so pages that already
	 * exist on a site are filled in place and keep their IDs); only a page that matches
	 * neither is created. Running it twice changes nothing the second time.
	 *
	 * ## EXAMPLES
	 *
	 *     wp osous install-pages
	 *
	 * @subcommand install-pages
	 */
	public function install_pages(): void {
		$ids    = osous_page_ids();
		$counts = array(
			'created' => 0,
			'linked'  => 0,
			'kept'    => 0,
		);

		foreach ( osous_content_keys() as $key ) {
			$manifest = osous_manifest( $key );
			if ( ! $manifest ) {
				WP_CLI::warning( "Unreadable manifest: {$key}" );
				continue;
			}
			$page_id = $ids[ $key ] ?? 0;
			$status  = 'kept';
			if ( ! $page_id ) {
				$page_id = $this->find_by_slug( (string) $manifest['slug'], $key );
				$status  = $page_id ? 'linked' : 'created';
			}
			if ( ! $page_id ) {
				$page_id = wp_insert_post(
					array(
						'post_type'   => 'page',
						'post_status' => 'publish',
						'post_title'  => $this->page_title( $manifest ),
						'post_name'   => 'home' === $key ? 'home' : (string) $manifest['slug'],
					),
					true
				);
				if ( is_wp_error( $page_id ) ) {
					WP_CLI::warning( "{$key}: " . $page_id->get_error_message() );
					continue;
				}
			}
			if ( 'publish' !== get_post_status( $page_id ) ) {
				wp_update_post(
					array(
						'ID'          => $page_id,
						'post_status' => 'publish',
					)
				);
			}
			update_post_meta( $page_id, OSOUS_CONTENT_META, $key );
			++$counts[ $status ];
		}

		$ids = osous_page_ids( true );
		if ( isset( $ids['home'] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $ids['home'] );
		}
		if ( isset( $ids['blog'] ) ) {
			update_option( 'page_for_posts', $ids['blog'] );
		}
		WP_CLI::success( sprintf( '%d pages: %d created, %d existing pages linked, %d already linked.', array_sum( $counts ), $counts['created'], $counts['linked'], $counts['kept'] ) );
	}

	/**
	 * An existing page with this slug that is not linked to another content key.
	 *
	 * @param string $slug Page slug ('' for the front page).
	 * @param string $key  Content key.
	 */
	private function find_by_slug( string $slug, string $key ): int {
		$page = get_page_by_path( '' === $slug ? 'home' : $slug, OBJECT, 'page' );
		if ( ! $page ) {
			return 0;
		}
		$linked = (string) get_post_meta( $page->ID, OSOUS_CONTENT_META, true );
		return ( '' === $linked || $linked === $key ) ? (int) $page->ID : 0;
	}

	/**
	 * A page title from the manifest's search title, without the site-name suffix.
	 *
	 * @param array<string, mixed> $manifest Page manifest.
	 */
	private function page_title( array $manifest ): string {
		$title = trim( (string) preg_replace( '/\s*[|\-–]\s*Osous Al Taqnia\s*$/i', '', (string) $manifest['title'] ) );
		return '' !== $title ? $title : ucwords( str_replace( '-', ' ', (string) $manifest['key'] ) );
	}
}

WP_CLI::add_command( 'osous', 'Osous_CLI' );
