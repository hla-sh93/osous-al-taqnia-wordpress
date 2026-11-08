<?php
/**
 * Posts page: the blog design, used when Settings > Reading shows posts on a page.
 */
get_header();
?>
<?php get_template_part( 'template-parts/blog-hero' ); ?>
<?php get_template_part( 'template-parts/blog-list' ); ?>
<?php
get_footer();
