<?php
/**
 * The blog list's pages: previous, the page numbers around the current one, next.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

$osous_total = (int) $GLOBALS['wp_query']->max_num_pages;
if ( $osous_total < 2 ) {
	return;
}
$osous_current = max( 1, (int) get_query_var( 'paged' ) );
?>
<div role="navigation" aria-label="<?php esc_attr_e( 'Blog pages', 'osous' ); ?>" class="w-pagination-wrapper pagination">
	<?php if ( $osous_current > 1 ) : ?>
		<a href="<?php echo esc_url( get_pagenum_link( $osous_current - 1 ) ); ?>" aria-label="<?php esc_attr_e( 'Previous Page', 'osous' ); ?>" class="w-pagination-previous btn">
			<svg class="w-pagination-previous-icon c-on-primary" height="12px" width="12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" transform="translate(0, 1)" aria-hidden="true"><path fill="none" stroke="currentColor" fill-rule="evenodd" d="M8 10L4 6l4-4"></path></svg>
			<div class="t-r-md c-on-primary"><?php esc_html_e( 'Previous', 'osous' ); ?></div>
		</a>
	<?php endif; ?>
	<?php foreach ( osous_pagination_numbers( $osous_current, $osous_total ) as $osous_page ) : ?>
		<?php if ( null === $osous_page ) : ?>
			<div class="btn neutral w-inline-block"><div class="t-r-md">...</div></div>
		<?php elseif ( $osous_page === $osous_current ) : ?>
			<a href="<?php echo esc_url( get_pagenum_link( $osous_page ) ); ?>" aria-current="page" class="btn neutral w-inline-block w--current"><div class="t-r-md"><?php echo esc_html( (string) $osous_page ); ?></div></a>
		<?php else : ?>
			<a href="<?php echo esc_url( get_pagenum_link( $osous_page ) ); ?>" class="btn neutral w-inline-block"><div class="t-r-md"><?php echo esc_html( (string) $osous_page ); ?></div></a>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php if ( $osous_current < $osous_total ) : ?>
		<a href="<?php echo esc_url( get_pagenum_link( $osous_current + 1 ) ); ?>" aria-label="<?php esc_attr_e( 'Next Page', 'osous' ); ?>" class="w-pagination-next btn">
			<div class="t-r-md c-on-primary"><?php esc_html_e( 'Next', 'osous' ); ?></div>
			<svg class="w-pagination-next-icon c-on-primary" height="12px" width="12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" transform="translate(0, 1)" aria-hidden="true"><path fill="none" stroke="currentColor" fill-rule="evenodd" d="M4 2l4 4-4 4"></path></svg>
		</a>
	<?php endif; ?>
</div>
