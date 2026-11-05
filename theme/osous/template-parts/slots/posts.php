<?php
/**
 * The blog's list of posts: a card per post, the empty state, and the pages.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="w-dyn-list">
	<?php if ( have_posts() ) : ?>
		<div role="list" class="grid-2 w-dyn-items">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/blog/card' );
			endwhile;
			?>
		</div>
		<?php get_template_part( 'template-parts/blog/pagination' ); ?>
	<?php else : ?>
		<div class="w-dyn-empty">
			<div><?php esc_html_e( 'No items found.', 'osous' ); ?></div>
		</div>
	<?php endif; ?>
</div>
