<?php
/**
 * Plugin Name:       Osous Site
 * Plugin URI:        https://www.osoustaqnia.com/
 * Description:       Site-wide security hardening and a quieter page head for the Osous Al Taqnia website. Works with any theme.
 * Version:           0.1.0
 * Requires at least: 6.5
 * Requires PHP:      8.1
 * Author:            Osous Al Taqnia
 * Author URI:        https://www.osoustaqnia.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       osous-site
 *
 * @package Osous_Site
 */

defined( 'ABSPATH' ) || exit;

require __DIR__ . '/inc/security.php';
require __DIR__ . '/inc/head.php';
