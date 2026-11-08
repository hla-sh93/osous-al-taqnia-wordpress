<?php
/**
 */
get_header();
?>
<div class="page-wrap">
<div class="page-main"><img alt="" class="logo-404" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Logo-Full-mixed.svg"/><img alt="" class="image-404" sizes="(max-width: 510px) 100vw, 510px" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration.webp" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration-p-500.webp 500w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration.webp 510w"/>
<h2 class="h2 c-on-primary"><?php esc_html_e( 'Oops! The page you\'re looking for cannot be found.', 'osous' ); ?></h2>
<a class="btn _w-max-200 m-t-auto w-inline-block" href="<?php echo esc_url( osous_url( 'index.html' ) ); ?>" sym-bind='{"visibility":{"type":"Record","val":{"conditions":{"type":"Select","val":{"from":{"type":"Variable","val":"data"},"prop":"2871aac6-5ff6-aec0-8366-ff895cbac22b"}}}},"link":{"type":"Select","val":{"from":{"type":"Variable","val":"data"},"prop":"0f978e29-4b3d-fef3-6b7a-9716c86901b6"}}}'>
<div class="t-r-md c-on-primary" sym-bind='{"children":{"type":"Select","val":{"from":{"type":"Variable","val":"data"},"prop":"a987317f-c8cf-7cfe-9c2f-3992f088230e"}}}'><?php esc_html_e( 'Go to Home page', 'osous' ); ?></div>
</a>
</div>
</div>
<?php
get_footer();
