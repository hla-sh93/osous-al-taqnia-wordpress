<?php
/**
 * Template Name: Contact
 */
get_header();
?>
<section class="section w-variant-28a6d7a7-f44c-3cfd-c8ea-d9dc543f8bfd">
<div class="slot w-variant-28a6d7a7-f44c-3cfd-c8ea-d9dc543f8bfd c-surface-light">
<div class="w-layout-grid grid-2">
<div class="w-layout-vflex card c-surface-none">
<div class="content">
<div class="section_title">
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-richtext">
<h2><?php esc_html_e( 'Transform Your Iraqi Business with Professional IT Services', 'osous' ); ?></h2>
</div>
</div>
</div>
</div>
<div class="divider"></div>
<div>
<h3 class="h3"><?php esc_html_e( 'Request a Free IT Consultation', 'osous' ); ?></h3>
<div class="w-layout-grid call-us">
<div class="t-m-lg"><?php esc_html_e( 'IRAQ', 'osous' ); ?></div>
<a href="tel:+9647510107143"><span class="t-b-lg link">+964 751 010 7143</span></a>
<div class="t-m-lg"><?php esc_html_e( 'UAE', 'osous' ); ?></div>
<a href="tel:+971585325606"><span class="t-b-lg link">+971 58 532 5606</span></a>
<div class="t-m-lg"><?php esc_html_e( 'SYRIA', 'osous' ); ?></div>
<a href="tel:+963955670155"><span class="t-b-lg link">+963 955 670 155</span></a>
<div id="w-node-_623f48f0-cc0c-1cce-924a-7e13ca8a198a-26d66619"></div>
<div class="t-m-lg"><?php esc_html_e( 'Email', 'osous' ); ?></div>
<a href="mailto:info@osoustaqnia.com"><span class="t-b-lg link" data-w-id="b95bcee6-7665-bf3c-7a56-0baac5c1943e" style="opacity:0"><?php esc_html_e( 'info@osoustaqnia.com', 'osous' ); ?></span></a>
</div>
<div class="spacer-3x"></div>
</div>
</div>
</div>
<div class="card c-surface-secondary">
<div class="content">
<div class="section_title">
<div class="w-layout-vflex section_title_them w-variant-5053a507-255c-7c47-49b7-669050399f5e">
<div>
<div class="h2 w-richtext">
<h2><?php esc_html_e( 'LEAVE YOUR REQUEST', 'osous' ); ?></h2>
</div>
<p class="t-r-sm"><?php esc_html_e( 'We will get back to you first thing in the morning!', 'osous' ); ?></p>
</div>
</div>
</div>
<div class="form-block w-form">
<?php osous_contact_notice(); ?>
<form data-name="Email Form" id="email-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" name="email-form"><input type="hidden" name="action" value="osous_contact"><?php wp_nonce_field( 'osous_contact', 'osous_contact_nonce' ); ?>
<div class="w-layout-vflex input-wrapper"><input class="input t-m-md w-input" data-name="name" id="name" maxlength="256" name="name" placeholder="<?php esc_attr_e( 'Enter your name', 'osous' ); ?>" required="" type="text"/><input class="input t-m-md w-input" data-name="company" id="company" maxlength="256" name="company" placeholder="<?php esc_attr_e( 'Company', 'osous' ); ?>" required="" type="text"/><input class="input t-m-md w-input" data-name="email" id="email" maxlength="256" name="email" placeholder="<?php esc_attr_e( 'Email', 'osous' ); ?>" required="" type="email"/><input class="input t-m-md w-input" data-name="mobile" id="mobile" maxlength="256" name="mobile" placeholder="<?php esc_attr_e( 'Mobile', 'osous' ); ?>" type="text"/></div>
<div class="w-layout-vflex input-wrapper"><textarea class="input text-area t-m-md w-input" data-name="message" id="message" maxlength="5000" name="message" placeholder="<?php esc_attr_e( 'Your Message', 'osous' ); ?>" required=""></textarea></div><?php osous_turnstile_widget(); ?>
<input class="btn form w-button" data-wait="Please wait..." type="submit" value="<?php esc_attr_e( 'Submit', 'osous' ); ?>"/>
</form>
<div class="success-message w-form-done">
<div class="paragraph-base"><?php esc_html_e( 'Thank you! Your submission has been received!', 'osous' ); ?></div>
</div>
<div class="error-message w-form-fail">
<div class="paragraph-base"><?php esc_html_e( 'Oops! Something went wrong while submitting the form.', 'osous' ); ?></div>
</div>
</div>
</div>
</div>
</div>
</div>
</section><section class="section contact" id="inquiery">
<div class="container-full c-surface-neutral"></div>
</section>
<?php
get_footer();
