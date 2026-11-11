<?php
/**
 * Posts page: the blog design, used when Settings > Reading shows posts on a page.
 */
get_header();
?>
<div class="section header osous-blog-hero" data-wf--header--style="style-1"><img alt="" class="header-cut" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/header-cut.svg"/>
<div class="container h-100">
<div class="header-contents">
<div class="spacer" data-wf--spacer--variant="1x"></div>
<div>
<h1 class="h1 a-c" sym-bind='{"children":{"type":"Select","val":{"from":{"type":"Variable","val":"data"},"prop":"2ef5e533-cf57-a671-85c8-09df900bd27b"}}}' text-split="" words-rotate-in=""><?php esc_html_e( 'Blog', 'osous' ); ?></h1>
</div>
</div>
</div>
</div><?php get_template_part( 'template-parts/blog-list' ); ?>
<?php
get_footer();
