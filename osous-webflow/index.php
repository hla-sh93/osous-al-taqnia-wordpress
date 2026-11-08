<?php
/**
 * Fallback: the blog design, used for any list of posts.
 */
get_header();
?>
<?php get_template_part( 'template-parts/blog-hero' ); ?>
<?php get_template_part( 'template-parts/blog-list' ); ?>
<?php
get_footer();
