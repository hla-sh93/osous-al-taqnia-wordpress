<?php
/**
 * Header: the document head, the preloader and the navigation bar.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> data-wf-page="<?php echo esc_attr( osous_wf_page_id() ); ?>" data-wf-site="6118020d3c76366cad8d0a43">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php echo esc_html( osous_meta( 'title' ) ); ?></title>
  <meta content="<?php echo esc_attr( osous_meta( 'description' ) ); ?>" name="description">
  <meta content="<?php echo esc_attr( osous_meta( 'title' ) ); ?>" property="og:title">
  <meta content="<?php echo esc_attr( osous_meta( 'description' ) ); ?>" property="og:description">
  <meta content="<?php echo esc_attr( osous_meta( 'title' ) ); ?>" name="twitter:title">
  <meta content="<?php echo esc_attr( osous_meta( 'description' ) ); ?>" name="twitter:description">
  <meta property="og:type" content="website">
  <meta content="summary_large_image" name="twitter:card">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <style>html.w-mod-js:not(.w-mod-ix3) :is(.navebar-menu, .accordion) {visibility: hidden !important;}@media not all and (max-width: 479px) and (min-width: 0px){@media not all and (max-width: 767px) and (min-width: 480px){@media not all and (max-width: 991px) and (min-width: 768px){html.w-mod-js:not(.w-mod-ix3) :is(:is(.dd-menu-item, .dd-menu-item) .nav-link, :is(.dd-menu-item, .dd-menu-item) .menu, .background-overlay) {visibility: hidden !important;}}}}@media not all and (min-width: 992px){html.w-mod-js:not(.w-mod-ix3) :is(.dd-menu-list-toggle + *) {visibility: hidden !important;}}</style>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="anonymous" href="https://fonts.gstatic.com" rel="preconnect"/>
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicon.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/webclip.jpg" rel="apple-touch-icon"/>
  <style>
.w-webflow-badge
{
     display: none !important;
    visibility: hidden !important;
}
</style>
  <style>
/* Webkit Browsers (Chrome, Edge, Safari) */
.navbar-scroll::-webkit-scrollbar {
  width: 8px;
}
.navbar-scroll::-webkit-scrollbar-track {
  background: transparent;
}
.navbar-scroll::-webkit-scrollbar-thumb {
  background-color: #888; /* Change this to match your brand */
  border-radius: 10px;
}
/* Firefox */
.navbar-scroll {
  scrollbar-width: thin;
  scrollbar-color: #888 transparent;
}
</style>
  <?php wp_head(); ?>
</head>
<body <?php body_class( '_404' ); ?>>
<?php wp_body_open(); ?>
<div class="page-wrap">
<div class="page-main"><img alt="" class="logo-404" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Logo-Full-mixed.svg"/><img alt="" class="image-404" sizes="(max-width: 510px) 100vw, 510px" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration.webp" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration-p-500.webp 500w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/404-illustration.webp 510w"/>
<h2 class="h2 c-on-primary"><?php esc_html_e( 'Oops! The page you\'re looking for cannot be found.', 'osous' ); ?></h2>
<a class="btn _w-max-200 m-t-auto w-inline-block" href="<?php echo esc_url( osous_url( 'index.html' ) ); ?>" sym-bind='{"visibility":{"type":"Record","val":{"conditions":{"type":"Select","val":{"from":{"type":"Variable","val":"data"},"prop":"2871aac6-5ff6-aec0-8366-ff895cbac22b"}}}},"link":{"type":"Select","val":{"from":{"type":"Variable","val":"data"},"prop":"0f978e29-4b3d-fef3-6b7a-9716c86901b6"}}}'>
<div class="t-r-md c-on-primary" sym-bind='{"children":{"type":"Select","val":{"from":{"type":"Variable","val":"data"},"prop":"a987317f-c8cf-7cfe-9c2f-3992f088230e"}}}'><?php esc_html_e( 'Go to Home page', 'osous' ); ?></div>
</a>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
