<?php
/**
 * A blog post, in the design of the original article page.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="section">
		<div class="w-layout-blockcontainer content w-container">
			<div class="section_title center">
				<div class="spacer-3x"></div>
				<nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'osous' ); ?>" class="breadcrumb">
					<div class="breadcrumb-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb-item-link"><?php esc_html_e( 'Home', 'osous' ); ?> </a>
					</div>
					<div class="t-r-sm">/</div>
					<div class="breadcrumb-item">
						<a href="<?php echo esc_url( osous_page_url( 'blog' ) ); ?>" class="breadcrumb-item-link"><?php esc_html_e( 'Blog', 'osous' ); ?></a>
					</div>
				</nav>
				<h1 class="h1"><?php the_title(); ?></h1>
				<div class="w-layout-vflex a-c-c">
					<div class="writer">
						<div class="t-r-sm"><?php esc_html_e( 'By', 'osous' ); ?></div>
						<div class="t-r-sm"><?php the_author(); ?></div>
						<div class="t-r-sm"> <?php esc_html_e( 'at', 'osous' ); ?></div>
						<div class="t-r-sm"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php if ( has_post_thumbnail() ) : ?>
		<section>
			<div class="blog-image-holder">
				<?php
				the_post_thumbnail(
					'full',
					array(
						'class' => 'image-blog',
						'sizes' => '100vw',
					)
				);
				?>
			</div>
		</section>
	<?php endif; ?>
	<section class="section">
		<div class="w-layout-blockcontainer container blog w-container">
			<div class="w-richtext"><?php the_content(); ?></div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
