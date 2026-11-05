<?php
/**
 * Theme bootstrap: defines the theme's constants and loads its modules.
 *
 * Each file under inc/ owns one concern; nothing here does any work itself.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

define( 'OSOUS_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );
define( 'OSOUS_DIR', get_template_directory() );

require OSOUS_DIR . '/inc/setup.php';
require OSOUS_DIR . '/inc/cleanup.php';
require OSOUS_DIR . '/inc/security.php';
require OSOUS_DIR . '/inc/content.php';
require OSOUS_DIR . '/inc/render.php';
require OSOUS_DIR . '/inc/assets.php';
require OSOUS_DIR . '/inc/seo.php';
require OSOUS_DIR . '/inc/contact-form.php';
require OSOUS_DIR . '/inc/redirects.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require OSOUS_DIR . '/inc/class-osous-cli.php';
}
