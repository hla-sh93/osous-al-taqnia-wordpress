<?php
/**
 * Puts the site's pages into WordPress.
 *
 * Runs by itself when the theme is activated, and again from Appearance → Site pages or
 * `wp osous install-pages`. A page is matched by its content key first, then by its slug,
 * so pages that already exist on a site are filled in place and keep their IDs and
 * addresses; only a page that matches neither is created. Running it twice changes
 * nothing the second time.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

const OSOUS_INSTALL_ACTION = 'osous_install_pages';

/**
 * Creates or links one page per content manifest, then sets the front page and the blog.
 *
 * @return array{created: int, linked: int, kept: int, failed: string[]}
 */
function osous_install_pages(): array {
	$ids    = osous_page_ids( true );
	$result = array(
		'created' => 0,
		'linked'  => 0,
		'kept'    => 0,
		'failed'  => array(),
	);

	foreach ( osous_content_keys() as $key ) {
		$manifest = osous_manifest( $key );
		if ( ! $manifest ) {
			$result['failed'][] = $key;
			continue;
		}
		$page_id = $ids[ $key ] ?? 0;
		$status  = 'kept';
		if ( ! $page_id ) {
			$page_id = osous_find_page_by_slug( (string) $manifest['slug'], $key );
			$status  = $page_id ? 'linked' : 'created';
		}
		if ( ! $page_id ) {
			$page_id = wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_title'  => osous_page_title( $manifest ),
					'post_name'   => 'home' === $key ? 'home' : (string) $manifest['slug'],
				),
				true
			);
			if ( is_wp_error( $page_id ) ) {
				$result['failed'][] = $key;
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
		++$result[ $status ];
	}

	$ids = osous_page_ids( true );
	if ( isset( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	if ( isset( $ids['blog'] ) ) {
		update_option( 'page_for_posts', $ids['blog'] );
	}
	return $result;
}

/**
 * An existing page with this slug that is not linked to another content key.
 *
 * @param string $slug Page slug ('' for the front page).
 * @param string $key  Content key.
 */
function osous_find_page_by_slug( string $slug, string $key ): int {
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
function osous_page_title( array $manifest ): string {
	$title = trim( (string) preg_replace( '/\s*[|\-–]\s*Osous Al Taqnia\s*$/i', '', (string) $manifest['title'] ) );
	return '' !== $title ? $title : ucwords( str_replace( '-', ' ', (string) $manifest['key'] ) );
}

/**
 * Content keys that have no page yet.
 *
 * @return string[]
 */
function osous_missing_pages(): array {
	return array_values( array_diff( osous_content_keys(), array_keys( osous_page_ids() ) ) );
}

// Installing the theme installs its pages.
add_action( 'after_switch_theme', 'osous_install_pages' );

/**
 * Adds Appearance → Site pages.
 */
function osous_install_menu(): void {
	add_theme_page(
		__( 'Site pages', 'osous' ),
		__( 'Site pages', 'osous' ),
		'manage_options',
		'osous-site-pages',
		'osous_install_screen'
	);
}
add_action( 'admin_menu', 'osous_install_menu' );

/**
 * The Site pages screen: how many of the site's pages are in place, and a button that
 * installs the missing ones.
 */
function osous_install_screen(): void {
	$total   = count( osous_content_keys() );
	$missing = osous_missing_pages();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Site pages', 'osous' ); ?></h1>
		<?php if ( isset( $_GET['installed'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only. ?>
			<div class="notice notice-success"><p><?php esc_html_e( 'The site pages are installed.', 'osous' ); ?></p></div>
		<?php endif; ?>
		<p>
			<?php
			printf(
				/* translators: 1: pages in place, 2: pages the theme provides. */
				esc_html__( '%1$d of the site\'s %2$d pages are in place.', 'osous' ),
				(int) ( $total - count( $missing ) ),
				(int) $total
			);
			?>
		</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="<?php echo esc_attr( OSOUS_INSTALL_ACTION ); ?>">
			<?php wp_nonce_field( OSOUS_INSTALL_ACTION ); ?>
			<?php submit_button( __( 'Install the pages', 'osous' ), 'primary', 'submit', false ); ?>
		</form>
		<p class="description"><?php esc_html_e( 'Existing pages with the same address are filled in place; nothing is deleted.', 'osous' ); ?></p>
	</div>
	<?php
}

/**
 * Handles the Install the pages button.
 */
function osous_install_submit(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You are not allowed to do this.', 'osous' ), 403 );
	}
	check_admin_referer( OSOUS_INSTALL_ACTION );
	osous_install_pages();
	wp_safe_redirect( add_query_arg( 'installed', '1', admin_url( 'themes.php?page=osous-site-pages' ) ) );
	exit;
}
add_action( 'admin_post_' . OSOUS_INSTALL_ACTION, 'osous_install_submit' );

/**
 * Tells an administrator when some of the site's pages are missing.
 */
function osous_install_notice(): void {
	if ( ! current_user_can( 'manage_options' ) || ! osous_missing_pages() ) {
		return;
	}
	printf(
		'<div class="notice notice-warning"><p>%1$s <a href="%2$s">%3$s</a></p></div>',
		esc_html__( 'Some of the site\'s pages are not installed yet.', 'osous' ),
		esc_url( admin_url( 'themes.php?page=osous-site-pages' ) ),
		esc_html__( 'Install them', 'osous' )
	);
}
add_action( 'admin_notices', 'osous_install_notice' );
