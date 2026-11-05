<?php
/**
 * WP-CLI commands: `wp osous install-pages`.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * The theme's WP-CLI commands.
 */
class Osous_CLI {

	/**
	 * Puts the site's pages into WordPress (see inc/install.php).
	 *
	 * ## EXAMPLES
	 *
	 *     wp osous install-pages
	 *
	 * @subcommand install-pages
	 */
	public function install_pages(): void {
		$result = osous_install_pages();
		foreach ( $result['failed'] as $key ) {
			WP_CLI::warning( "Could not install: {$key}" );
		}
		WP_CLI::success(
			sprintf(
				'%d pages: %d created, %d existing pages linked, %d already linked.',
				$result['created'] + $result['linked'] + $result['kept'],
				$result['created'],
				$result['linked'],
				$result['kept']
			)
		);
	}
}

WP_CLI::add_command( 'osous', 'Osous_CLI' );
