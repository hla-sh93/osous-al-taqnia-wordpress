<?php
/**
 */
get_header();
?>
<div class="page-wrap">
<div class="page-main"><img alt="" class="logo-404" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Logo-Full-mixed.svg"/><img alt="" class="image-404" sizes="(max-width: 510px) 100vw, 510px" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration.webp" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration-p-500.webp 500w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration.webp 510w"/>
<h2 class="h2 c-on-primary"><?php esc_html_e( 'Oops! The page you\'re looking for cannot be found.', 'osous' ); ?></h2>
<a class="btn _w-max-200 m-t-auto w-inline-block" href="<?php echo esc_url( osous_url( 'index.html' ) ); ?>">
<div class="t-r-md c-on-primary"><?php esc_html_e( 'Go to Home page', 'osous' ); ?></div>
</a>
</div>
</div>
<?php
get_footer();
