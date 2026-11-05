<?php
/**
 * A post's card in the blog list.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;
?>
<div role="listitem" class="w-dyn-item">
	<a href="<?php the_permalink(); ?>" class="blog-card w-inline-block">
		<div class="blog-image-thumb-container">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail(
					'large',
					array(
						'class' => 'blog-image-thumb',
						'sizes' => '(max-width: 767px) 100vw, (max-width: 991px) 728px, 940px',
						'alt'   => '',
					)
				);
			}
			?>
		</div>
		<div class="spacer"></div>
		<div class="t-r-sm c-on-neutral-subtle"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></div>
		<h2 class="h2"><?php the_title(); ?></h2>
	</a>
</div>
