<?php
/**
 * Header: the document head, the preloader and the navigation bar.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <style>html.w-mod-js:not(.w-mod-ix3) :is(.navebar-menu, .accordion) {visibility: hidden !important;}@media not all and (max-width: 479px) and (min-width: 0px){@media not all and (max-width: 767px) and (min-width: 480px){@media not all and (max-width: 991px) and (min-width: 768px){html.w-mod-js:not(.w-mod-ix3) :is(:is(.dd-menu-item, .dd-menu-item) .nav-link, :is(.dd-menu-item, .dd-menu-item) .menu, .background-overlay) {visibility: hidden !important;}}}}@media not all and (min-width: 992px){html.w-mod-js:not(.w-mod-ix3) :is(.dd-menu-list-toggle + *) {visibility: hidden !important;}}</style>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="anonymous" href="https://fonts.gstatic.com" rel="preconnect"/>
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicon.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/webclip.jpg" rel="apple-touch-icon"/>

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
<body <?php body_class( 'c-surface-secondary' ); ?>>
<?php wp_body_open(); ?>
<section bind="c43bbb05-49b1-bdf4-9641-4ca0d0f4100e" class="preloader"></section><div bind="78a9e0e1-a66d-7caa-f48d-55a97e4bac67" class="navbar w-nav" data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" data-wf--navbar--style="default" data-wf-component-id="b34223f0-89a2-d8be-2a87-6097027da21f" data-wf-variant-state="base" role="banner">
<div class="navbar-wrapper elevation">
<a <?php echo osous_aria_current( 'index.html' ); ?> class="navbar-brand w-nav-brand <?php echo osous_current_class( 'index.html' ); ?>" href="<?php echo esc_url( osous_url( 'index.html' ) ); ?>"><img alt="<?php esc_attr_e( 'Osous Al Taqnia', 'osous' ); ?>" class="logo" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Logo-Full-mixed.svg" width="130"/></a>
<div class="navebar-menu">
<div class="menu-item hide-on-desktop">
<a <?php echo osous_aria_current( 'index.html' ); ?> class="nav-link <?php echo osous_current_class( 'index.html' ); ?>" href="<?php echo esc_url( osous_url( 'index.html' ) ); ?>"><?php esc_html_e( 'Home', 'osous' ); ?></a>
</div>
<div class="menu-item">
<a <?php echo osous_aria_current( 'about.html' ); ?> class="nav-link <?php echo osous_current_class( 'about.html' ); ?>" href="<?php echo esc_url( osous_url( 'about.html' ) ); ?>"><?php esc_html_e( 'About', 'osous' ); ?></a>
</div>
<div bind="8c66bee8-866a-6609-aa3e-3dcd59c8a297" class="dd-menu-item w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div bind="8c66bee8-866a-6609-aa3e-3dcd59c8a299" class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
<a class="nav-link" href="#"><?php esc_html_e( 'Solutions', 'osous' ); ?></a>
<div class="menu-list-icon">
<div class="accordion-icon-line-v bg-white"></div>
<div class="accordion-icon-line-h bg-white"></div>
</div>
</div>
<nav class="menu w-dropdown-list">
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a <?php echo osous_aria_current( 'cloud-services-iraq.html' ); ?> class="menu-list-item menu-title hide-on-tablet w-inline-block <?php echo osous_current_class( 'cloud-services-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'cloud-services-iraq.html' ) ); ?>">
<div><?php esc_html_e( 'Cloud Services', 'osous' ); ?></div>
</a>
<a class="menu-list-item menu-title show-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Cloud Services', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a <?php echo osous_aria_current( 'microsoft-dynamics-365-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'microsoft-dynamics-365-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'microsoft-dynamics-365-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft Dynamics 365', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'microsoft-office-365-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'microsoft-office-365-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'microsoft-office-365-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft 365', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'azure-cloud-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'azure-cloud-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'azure-cloud-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft Azure Cloud', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'cloud-optimization-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'cloud-optimization-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'cloud-optimization-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Cloud Optimization', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a class="menu-list-item menu-title show-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Cyber Security', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
<a <?php echo osous_aria_current( 'cybersecurity-iraq.html' ); ?> class="menu-list-item menu-title hide-on-tablet w-inline-block <?php echo osous_current_class( 'cybersecurity-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'cybersecurity-iraq.html' ) ); ?>">
<div><?php esc_html_e( 'Cyber Security', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a <?php echo osous_aria_current( 'next-generation-firewall-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'next-generation-firewall-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'next-generation-firewall-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Next Generation Firewall', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'siem-soc-solutions-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'siem-soc-solutions-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'siem-soc-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'SIEM & SOC Solutions', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'privileged-access-management-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'privileged-access-management-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'privileged-access-management-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Privileged Access Management (PAM)', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'multi-factor-authentication-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'multi-factor-authentication-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'multi-factor-authentication-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Multi Factor Authentication (MFA)', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'identity-access-management-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'identity-access-management-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'identity-access-management-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Identity Access Management (IAM)', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'endpoint-secuirty-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'endpoint-secuirty-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'endpoint-secuirty-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Endpoint Security', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'email-security-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'email-security-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'email-security-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Email Security', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'device-management-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'device-management-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'device-management-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Device Management', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a class="menu-list-item menu-title show-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Data Protection', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
<a <?php echo osous_aria_current( 'data-protection-iraq.html' ); ?> class="menu-list-item menu-title hide-on-tablet w-inline-block <?php echo osous_current_class( 'data-protection-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'data-protection-iraq.html' ) ); ?>">
<div><?php esc_html_e( 'Data Protection', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a <?php echo osous_aria_current( 'dlp-solutions-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'dlp-solutions-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'dlp-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Data Loss Prevention', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'disaster-recovery-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'disaster-recovery-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'disaster-recovery-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Disaster Recovery', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'backup-solutions-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'backup-solutions-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'backup-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Backup Solutions', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'cloud-backup-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'cloud-backup-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'cloud-backup-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Cloud Backup', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a class="menu-list-item menu-title show-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Infrastructure', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
<a <?php echo osous_aria_current( 'it-infrastructure-iraq.html' ); ?> class="menu-list-item menu-title hide-on-tablet w-inline-block <?php echo osous_current_class( 'it-infrastructure-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'it-infrastructure-iraq.html' ) ); ?>">
<div><?php esc_html_e( 'Infrastructure', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a <?php echo osous_aria_current( 'virtualization-solutions-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'virtualization-solutions-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'virtualization-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Virtualization Solutions', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'structured-cabling-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'structured-cabling-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'structured-cabling-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Structured Cabling', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'server-storage-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'server-storage-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'server-storage-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Server & Storage', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'data-center-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'data-center-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'data-center-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Modular Datacenter', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'hci-solutions-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'hci-solutions-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'hci-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'HCI Solutions', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'cctv-company-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'cctv-company-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'cctv-company-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'CCTV & Network Solutions', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'network-wifi-solutions-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'network-wifi-solutions-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'network-wifi-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Network Wifi solutions', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div bind="9b4a1091-3f82-fdb3-a60e-69bf9f7061a2" class="dd-menu-item hide-on-desktop w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div bind="9b4a1091-3f82-fdb3-a60e-69bf9f7061a4" class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
<a class="nav-link" href="#"><?php esc_html_e( 'Products', 'osous' ); ?></a>
<div class="menu-list-icon">
<div class="accordion-icon-line-v bg-white"></div>
<div class="accordion-icon-line-h bg-white"></div>
</div>
</div>
<nav class="menu w-dropdown-list">
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a class="menu-list-item menu-title hide-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Banking software', 'osous' ); ?></div>
</a>
<a class="menu-list-item menu-title show-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Banking software', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a <?php echo osous_aria_current( 'reconciliation-system.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'reconciliation-system.html' ); ?>" href="<?php echo esc_url( osous_url( 'reconciliation-system.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Reconciliation System', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'customer-onboarding.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'customer-onboarding.html' ); ?>" href="<?php echo esc_url( osous_url( 'customer-onboarding.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Customer Onboarding', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'aml-compliance-software.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'aml-compliance-software.html' ); ?>" href="<?php echo esc_url( osous_url( 'aml-compliance-software.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'AML & Compliance', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div bind="b3e72f1c-6d42-476e-cbee-c3907fd09a8a" class="dd-menu-item w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div bind="b3e72f1c-6d42-476e-cbee-c3907fd09a8c" class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
<a class="nav-link" href="#"><?php esc_html_e( 'Services', 'osous' ); ?></a>
<div class="menu-list-icon">
<div class="accordion-icon-line-v bg-white"></div>
<div class="accordion-icon-line-h bg-white"></div>
</div>
</div>
<nav class="menu w-dropdown-list">
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a class="menu-list-item menu-title hide-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'For Businesses', 'osous' ); ?></div>
</a>
<a class="menu-list-item menu-title show-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'For Businesses', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a <?php echo osous_aria_current( 'managed-it-services-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'managed-it-services-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'managed-it-services-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Managed IT Services', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'it-consulting-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'it-consulting-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'it-consulting-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'IT Consulting', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'it-amc-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'it-amc-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'it-amc-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'IT AMC', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'ict-solutions-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'ict-solutions-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'ict-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'ICT Solutions', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a class="menu-list-item menu-title hide-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Website & Mobile', 'osous' ); ?></div>
</a>
<a class="menu-list-item menu-title show-on-tablet w-inline-block" href="#">
<div><?php esc_html_e( 'Website & Mobile', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a <?php echo osous_aria_current( 'website-design.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'website-design.html' ); ?>" href="<?php echo esc_url( osous_url( 'web-design-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Website Design', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'mobile-app.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'mobile-app-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'mobile-app-development-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Mobile Apps', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'e-commerce.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'e-commerce.html' ); ?>" href="<?php echo esc_url( osous_url( 'ecommerce-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'E-commerce', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div bind="7e5b02eb-eb8c-3c72-cdb8-9eb997de1e0e" class="dd-menu-item w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div bind="7e5b02eb-eb8c-3c72-cdb8-9eb997de1e10" class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
<a <?php echo osous_aria_current( 'partners.html' ); ?> class="nav-link hide-on-tablet <?php echo osous_current_class( 'partners.html' ); ?>" href="#"><?php esc_html_e( 'Partners', 'osous' ); ?></a>
<a class="nav-link hide-on-desktop" href="#"><?php esc_html_e( 'Partners', 'osous' ); ?></a>
<div class="menu-list-icon">
<div class="accordion-icon-line-v bg-white"></div>
<div class="accordion-icon-line-h bg-white"></div>
</div>
</div>
<nav class="menu w-dropdown-list">
<div class="dd-menu-list">
<div class="menu-list">
<a <?php echo osous_aria_current( 'fortinet-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'fortinet-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'fortinet-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Fortinet', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'sophos-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'sophos-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'sophos-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Sophos', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'red-hat-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'red-hat-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'red-hat-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Red Hat', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'juniper-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'juniper-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'juniper-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Juniper', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'citrix-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'citrix-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'citrix-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Citrix', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'avigilon-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'avigilon-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'avigilon-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Avigilon', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="menu-list">
<a <?php echo osous_aria_current( 'acronis-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'acronis-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'acronis-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Acronis', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'aruba-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'aruba-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'aruba-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Aruba', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'sentinelone-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'sentinelone-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'sentinelone-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'SentinelOne', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'kaspersky-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'kaspersky-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'kaspersky-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Kaspersky', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'vmware-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'vmware-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'vmware-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'VmWare', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'microsoft-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'microsoft-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'microsoft-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="menu-list">
<a <?php echo osous_aria_current( 'huawei-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'huawei-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'huawei-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Huawel', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'corning-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'corning-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'corning-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Corning', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'vertiv-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'vertiv-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'vertiv-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Vertiv', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'hikvision-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'hikvision-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'hikvision-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Hikvision', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'axis-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'axis-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'axis-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Axis', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'veeam-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'veeam-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'veeam-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Veeam', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="menu-list">
<a <?php echo osous_aria_current( 'motorola-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'motorola-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'motorola-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Motorola', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'hpe-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'hpe-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'hpe-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'HPE', 'osous' ); ?></div>
</a>
<a <?php echo osous_aria_current( 'dell-iraq.html' ); ?> class="menu-list-item w-inline-block <?php echo osous_current_class( 'dell-iraq.html' ); ?>" href="<?php echo esc_url( osous_url( 'dell-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Dell', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div class="navbar-mobile-buttons">
<a <?php echo osous_aria_current( 'contact.html' ); ?> class="btn outline w-inline-block <?php echo osous_current_class( 'contact.html' ); ?>" href="<?php echo esc_url( osous_url( 'contact.html' ) ); ?>">
<div class="t-r-md c-on-secondary"><?php esc_html_e( 'Contact', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="navbar-buttons">
<div class="nav-button-wrapper">
<a <?php echo osous_aria_current( 'contact.html' ); ?> class="btn-cta w-inline-block <?php echo osous_current_class( 'contact.html' ); ?>" href="<?php echo esc_url( osous_url( 'contact.html' ) ); ?>">
<div class="t-r-md c-on-primary position-relative-10"><?php esc_html_e( 'Lets Talk', 'osous' ); ?></div><img alt="" class="btn-blur" data-wf-target='[[["b34223f0-89a2-d8be-2a87-6097027da21f","b623e9fe-3e85-727a-d993-d40fdd3ee65c"],["30b93381-abe9-17d2-608a-97649da188fa"]]]' loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/cta-bg.png"/>
<div class="btn-icon-dot"></div>
</a>
</div>
</div>
<a class="btn btn-menu w-inline-block" href="#">
<div class="menu-icon-top"></div>
<div class="menu-icon-middle"></div>
<div class="menu-icon-bottom"></div>
</a>
</div>
</div><a bind="70e540a2-83c2-c3d2-8b52-fff1dbaafb9e" class="whatsapp w-inline-block" href="https://wa.me/+9647870606069" target="_blank">
<div class="w-layout-blockcontainer container-lg w-container">
<div class="magnatic p-r-0">
<div bind="70e540a2-83c2-c3d2-8b52-fff1dbaafba1" class="icon-whatsapp w-embed"><svg fill="none" height="58" viewbox="0 0 57 58" width="57" xmlns="http://www.w3.org/2000/svg">
<path clip-rule="evenodd" d="M13.1601 52.8946L14.182 53.5165C18.497 56.1023 23.4446 57.4607 28.4896 57.4771H28.5058C43.9976 57.4771 56.6181 44.7608 56.6181 29.1151C56.6181 21.5377 53.6982 14.4186 48.3937 9.0506C43.0892 3.68262 36.0165 0.736771 28.5058 0.736771C13.0141 0.720405 0.393555 13.4366 0.393555 29.0824C0.393555 34.434 1.86973 39.6547 4.69232 44.1716L5.35741 45.2518L2.5186 55.7095L13.1601 52.8946ZM18.1574 13.3385C18.7576 13.3548 19.4227 13.3876 20.0553 14.8114C20.4607 15.7271 21.1341 17.3914 21.6986 18.7864C22.1732 19.9593 22.5707 20.9417 22.667 21.1286C22.8779 21.5541 23.0077 22.0451 22.7319 22.6179C22.6993 22.6856 22.6686 22.7503 22.639 22.8126C22.4178 23.2776 22.2603 23.6087 21.8884 24.0417C21.7362 24.2189 21.5776 24.4132 21.4195 24.6068C21.1397 24.9497 20.8615 25.2905 20.6231 25.531C20.2013 25.9565 19.7633 26.4148 20.25 27.2658C20.7367 28.1168 22.4399 30.9154 24.9543 33.1738C27.6574 35.6132 30.0079 36.6411 31.1963 37.1607C31.4271 37.2616 31.614 37.3434 31.7512 37.4126C32.5947 37.8381 33.0976 37.7726 33.5843 37.1998C34.0709 36.627 35.6931 34.7122 36.2609 33.8612C36.8124 33.0102 37.3802 33.1575 38.1588 33.4357C38.9374 33.7303 43.0902 35.7924 43.9337 36.2179C44.1 36.3017 44.2555 36.3773 44.3996 36.4474C44.9872 36.733 45.3866 36.9271 45.5559 37.2162C45.7668 37.5762 45.7668 39.2783 45.0693 41.2749C44.3555 43.2715 40.9003 45.1863 39.3592 45.3336C39.2118 45.3477 39.0651 45.3657 38.9141 45.3842C37.4869 45.5592 35.6754 45.7813 29.2206 43.2061C21.2682 40.0363 16.0185 32.1722 14.956 30.5807C14.872 30.4548 14.8142 30.3682 14.7833 30.3262C14.7777 30.3187 14.7718 30.3106 14.7653 30.3018C14.2824 29.6468 11.328 25.6397 11.328 21.505C11.328 17.5496 13.2504 15.4903 14.1271 14.5511C14.1826 14.4916 14.234 14.4366 14.2804 14.3859C15.059 13.5349 15.9675 13.3221 16.5352 13.3221C17.103 13.3221 17.6707 13.3221 18.1574 13.3385Z" fill="currentColor" fill-rule="evenodd"></path>
</svg></div>
<div bind="70e540a2-83c2-c3d2-8b52-fff1dbaafba2" class="icon-whatsapp-border w-embed"><svg fill="none" height="68" viewbox="0 0 67 68" width="67" xmlns="http://www.w3.org/2000/svg">
<path d="M0.714844 67.3068L5.34988 50.245C2.4843 45.237 0.981045 39.5655 0.996704 33.7677C0.996704 15.6 15.6534 0.828857 33.6455 0.828857C42.3832 0.828857 50.5885 4.25702 56.7424 10.4814C62.912 16.7058 66.31 24.984 66.2944 33.7835C66.2944 51.9512 51.6376 66.7223 33.6299 66.7223H33.6142C28.1493 66.7223 22.7783 65.3321 18.0023 62.7096L0.714844 67.3068Z" fill="#945FFE"></path>
</svg></div>
</div>
</div>
</a>
