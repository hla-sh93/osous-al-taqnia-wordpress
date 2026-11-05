<?php
/**
 * The bottom of every page. Designed pages place the footer themselves, inside their
 * layout; every other view with navigation gets it here.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

if ( ! osous_footer_printed() && osous_has_chrome( osous_current_manifest() ) ) {
	osous_render_footer();
}
wp_footer();
?>
</body>
</html>
