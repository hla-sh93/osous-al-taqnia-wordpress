<?php
/**
 * Single blog post, laid out like the Webflow blog detail page.
 */
get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="section c-surface-white">
  <div class="w-layout-blockcontainer content w-container">
    <div class="section_title center">
      <div class="spacer-3x"></div>
      <nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'osous' ); ?>" class="breadcrumb">
        <div class="breadcrumb-item">
          <a class="breadcrumb-item-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'osous' ); ?></a>
        </div>
        <div class="t-r-sm">/</div>
        <div class="breadcrumb-item">
          <a class="breadcrumb-item-link" href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'osous' ); ?></a>
        </div>
      </nav>
      <h1 class="h1"><?php the_title(); ?></h1>
      <div class="w-layout-vflex a-c-c">
        <div class="writer">
          <div class="t-r-sm"><?php esc_html_e( 'By', 'osous' ); ?></div>
          <div class="t-r-sm"><?php the_author(); ?></div>
          <div class="t-r-sm"> <?php esc_html_e( 'at', 'osous' ); ?></div>
          <div class="t-r-sm"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time></div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php if ( has_post_thumbnail() ) : ?>
<section class="c-surface-white">
  <div class="blog-image-holder">
    <?php the_post_thumbnail( 'full', array( 'class' => 'image-blog', 'loading' => 'lazy', 'alt' => '' ) ); ?>
  </div>
</section>
<?php endif; ?>
<section class="section">
  <div class="w-layout-blockcontainer container blog w-container">
    <div class="w-richtext">
      <?php the_content(); ?>
    </div>
  </div>
</section>
<?php endwhile; ?>
<?php
get_footer();
