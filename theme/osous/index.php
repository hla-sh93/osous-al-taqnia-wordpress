<?php
/**
 * Every view that has a design of its own -- pages, the blog and its archives, the 404
 * page -- is drawn from its manifest; anything else shows its content as an article.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

get_header();

$osous_manifest = osous_current_manifest();
if ( $osous_manifest ) {
	osous_render_items( (array) $osous_manifest['items'] );
} else {
	get_template_part( 'template-parts/content', 'page' );
}

get_footer();
