<section class="section">
  <div class="w-layout-blockcontainer container fit c-surface-white osous-blog-list w-container">
    <?php
    $osous_paged = isset( $_GET['paged'] ) ? max( 1, absint( wp_unslash( $_GET['paged'] ) ) ) : 1;
    $osous_query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'paged'          => $osous_paged,
    ) );
    ?>
    <div class="w-dyn-list">
      <?php if ( $osous_query->have_posts() ) : ?>
      <div class="grid-2 w-dyn-items" role="list">
        <?php while ( $osous_query->have_posts() ) : $osous_query->the_post(); ?>
        <div class="w-dyn-item" role="listitem">
          <a class="blog-card w-inline-block" href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="blog-image-thumb-container">
              <?php if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'large', array( 'class' => 'blog-image-thumb', 'loading' => 'lazy', 'alt' => '' ) );
              } ?>
            </div>
            <div class="spacer"></div>
            <div class="t-r-sm c-on-neutral-subtle"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></div>
            <h2 class="h2"><?php the_title(); ?></h2>
          </a>
        </div>
        <?php endwhile; ?>
      </div>
      <?php else : ?>
      <div class="w-dyn-empty"><div><?php esc_html_e( 'No posts found.', 'osous' ); ?></div></div>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
      <?php if ( $osous_query->max_num_pages > 1 ) : ?>
      <div aria-label="<?php esc_attr_e( 'Pagination', 'osous' ); ?>" class="w-pagination-wrapper pagination" role="navigation">
        <?php if ( $osous_paged > 1 ) : ?>
        <a aria-label="<?php esc_attr_e( 'Previous page', 'osous' ); ?>" class="w-pagination-previous btn" href="<?php echo esc_url( add_query_arg( 'paged', $osous_paged - 1 ) ); ?>"><div class="t-r-md c-on-primary"><?php esc_html_e( 'Previous', 'osous' ); ?></div></a>
        <?php endif; ?>
        <?php for ( $i = 1; $i <= $osous_query->max_num_pages; $i++ ) : ?>
        <a class="btn neutral w-inline-block" href="<?php echo esc_url( add_query_arg( 'paged', $i ) ); ?>"<?php echo $i === $osous_paged ? ' aria-current="page"' : ''; ?>><div class="t-r-md"><?php echo (int) $i; ?></div></a>
        <?php endfor; ?>
        <?php if ( $osous_paged < $osous_query->max_num_pages ) : ?>
        <a aria-label="<?php esc_attr_e( 'Next page', 'osous' ); ?>" class="w-pagination-next btn" href="<?php echo esc_url( add_query_arg( 'paged', $osous_paged + 1 ) ); ?>"><div class="t-r-md c-on-primary"><?php esc_html_e( 'Next', 'osous' ); ?></div></a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
