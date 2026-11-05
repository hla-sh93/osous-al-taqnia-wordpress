<?php
/**
 * Local development only: imports posts fetched from the live site's public REST API
 * (_local/posts.json) so the blog can be tested with real content. Posts that already
 * exist (same slug) are left alone, so running it twice changes nothing.
 *
 * Run: tools/wp.sh eval-file /tools/import-posts.php /data/posts.json
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$osous_file  = $args[0] ?? '';
$osous_posts = json_decode( (string) file_get_contents( $osous_file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local file.
if ( ! is_array( $osous_posts ) ) {
	WP_CLI::error( "Cannot read {$osous_file}" );
}

$osous_created = 0;
foreach ( $osous_posts as $osous_post ) {
	if ( get_page_by_path( $osous_post['slug'], OBJECT, 'post' ) ) {
		continue;
	}
	$osous_id = wp_insert_post(
		array(
			'post_type'    => 'post',
			'post_author'  => 1,
			'post_status'  => 'publish',
			'post_name'    => $osous_post['slug'],
			'post_title'   => html_entity_decode( $osous_post['title']['rendered'], ENT_QUOTES ),
			'post_content' => $osous_post['content']['rendered'],
			'post_excerpt' => wp_strip_all_tags( $osous_post['excerpt']['rendered'] ),
			'post_date'    => $osous_post['date'],
		),
		true
	);
	if ( is_wp_error( $osous_id ) ) {
		WP_CLI::warning( $osous_post['slug'] . ': ' . $osous_id->get_error_message() );
		continue;
	}
	$osous_image = $osous_post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? '';
	if ( $osous_image ) {
		$osous_media = media_sideload_image( $osous_image, $osous_id, null, 'id' );
		if ( ! is_wp_error( $osous_media ) ) {
			set_post_thumbnail( $osous_id, $osous_media );
		}
	}
	++$osous_created;
}
WP_CLI::success( "{$osous_created} posts imported." );
