<?php
/**
 * Template Name: mobile app
 */
get_header();
?>
<div class="page-wrap">
<div class="navbar w-nav" data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" data-wf-component-id="b34223f0-89a2-d8be-2a87-6097027da21f" data-wf-variant-state="base" role="banner">
<div class="navbar-wrapper elevation">
<a class="navbar-brand w-nav-brand" href="<?php echo esc_url( osous_url( 'index.html' ) ); ?>"><img alt="<?php esc_attr_e( 'Osous Al Taqnia', 'osous' ); ?>" class="logo" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Logo-Full-mixed.svg" width="130"/></a>
<div class="navebar-menu">
<div class="menu-item hide-on-desktop">
<a class="nav-link" href="<?php echo esc_url( osous_url( 'index.html' ) ); ?>"><?php esc_html_e( 'Home', 'osous' ); ?></a>
</div>
<div class="menu-item">
<a class="nav-link" href="<?php echo esc_url( osous_url( 'about.html' ) ); ?>"><?php esc_html_e( 'About', 'osous' ); ?></a>
</div>
<div class="dd-menu-item w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
<a class="nav-link" href="#"><?php esc_html_e( 'Solutions', 'osous' ); ?></a>
<div class="menu-list-icon">
<div class="accordion-icon-line-v bg-white"></div>
<div class="accordion-icon-line-h bg-white"></div>
</div>
</div>
<nav class="menu w-dropdown-list">
<div class="dd-menu-list">
<div class="dd-menu-list-toggle">
<a class="menu-list-item menu-title hide-on-tablet w-inline-block" href="<?php echo esc_url( osous_url( 'cloud-services-iraq.html' ) ); ?>">
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
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'microsoft-dynamics-365-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft Dynamics 365', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'microsoft-office-365-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft 365', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'azure-cloud-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft Azure Cloud', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'cloud-optimization-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
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
<a class="menu-list-item menu-title hide-on-tablet w-inline-block" href="<?php echo esc_url( osous_url( 'cybersecurity-iraq.html' ) ); ?>">
<div><?php esc_html_e( 'Cyber Security', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'next-generation-firewall-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Next Generation Firewall', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'siem-soc-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'SIEM & SOC Solutions', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'privileged-access-management-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Privileged Access Management (PAM)', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'multi-factor-authentication-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Multi Factor Authentication (MFA)', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'identity-access-management-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Identity Access Management (IAM)', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'endpoint-secuirty-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Endpoint Security', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'email-security-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Email Security', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'device-management-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
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
<a class="menu-list-item menu-title hide-on-tablet w-inline-block" href="<?php echo esc_url( osous_url( 'data-protection-iraq.html' ) ); ?>">
<div><?php esc_html_e( 'Data Protection', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'dlp-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Data Loss Prevention', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'disaster-recovery-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Disaster Recovery', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'backup-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Backup Solutions', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'cloud-backup-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
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
<a class="menu-list-item menu-title hide-on-tablet w-inline-block" href="<?php echo esc_url( osous_url( 'it-infrastructure-iraq.html' ) ); ?>">
<div><?php esc_html_e( 'Infrastructure', 'osous' ); ?></div>
<div class="menu-list-icon">
<div class="accordion-icon-line-v"></div>
<div class="accordion-icon-line-h"></div>
</div>
</a>
</div>
<div class="menu-list">
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'virtualization-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Virtualization Solutions', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'structured-cabling-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Structured Cabling', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'server-storage-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Server & Storage', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'data-center-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Modular Datacenter', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'hci-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'HCI Solutions', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'cctv-company-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'CCTV & Network Solutions', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'network-wifi-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Network Wifi solutions', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div class="dd-menu-item hide-on-desktop w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
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
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'reconciliation-system.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Reconciliation System', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'customer-onboarding.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Customer Onboarding', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'aml-compliance-software.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'AML & Compliance', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div class="dd-menu-item w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
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
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'managed-it-services-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Managed IT Services', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'it-consulting-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'IT Consulting', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'it-amc-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'IT AMC', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'ict-solutions-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
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
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'website-design.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Website Design', 'osous' ); ?></div>
</a>
<a aria-current="page" class="menu-list-item w-inline-block w--current" href="<?php echo esc_url( osous_url( 'mobile-app.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Mobile Apps', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'e-commerce.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'E-commerce', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div class="dd-menu-item w-dropdown" data-delay="0" data-hover="true">
<div class="menu-item-toggle w-dropdown-toggle">
<div class="icon-257 hide-on-tablet w-icon-dropdown-toggle"></div>
<a class="nav-link hide-on-tablet" href="<?php echo esc_url( osous_url( 'partners.html' ) ); ?>"><?php esc_html_e( 'Partners', 'osous' ); ?></a>
<a class="nav-link hide-on-desktop" href="#"><?php esc_html_e( 'Partners', 'osous' ); ?></a>
<div class="menu-list-icon">
<div class="accordion-icon-line-v bg-white"></div>
<div class="accordion-icon-line-h bg-white"></div>
</div>
</div>
<nav class="menu w-dropdown-list">
<div class="dd-menu-list">
<div class="menu-list">
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'fortinet-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Fortinet', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'sophos-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Sophos', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'red-hat-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Red Hat', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'juniper-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Juniper', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'citrix-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Citrix', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'avigilon-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Avigilon', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="menu-list">
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'acronis-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Acronis', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'aruba-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Aruba', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'sentinelone-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'SentinelOne', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'kaspersky-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Kaspersky', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'vmware-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'VmWare', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'microsoft-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Microsoft', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="menu-list">
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'huawei-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Huawel', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'corning-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Corning', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'vertiv-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Vertiv', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'hikvision-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Hikvision', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'axis-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Axis', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'veeam-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Veeam', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="dd-menu-list">
<div class="menu-list">
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'motorola-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Motorola', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'hpe-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'HPE', 'osous' ); ?></div>
</a>
<a class="menu-list-item w-inline-block" href="<?php echo esc_url( osous_url( 'dell-iraq.html' ) ); ?>"><img alt="" class="icon-12" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/arrow-right.png"/>
<div><?php esc_html_e( 'Dell', 'osous' ); ?></div>
</a>
</div>
</div>
</nav>
</div>
<div class="navbar-mobile-buttons">
<a class="btn outline w-inline-block" href="<?php echo esc_url( osous_url( 'contact.html' ) ); ?>">
<div class="t-r-md c-on-secondary"><?php esc_html_e( 'Contact', 'osous' ); ?></div>
</a>
</div>
</div>
<div class="navbar-buttons">
<div class="nav-button-wrapper">
<a class="btn-cta w-inline-block" href="<?php echo esc_url( osous_url( 'contact.html' ) ); ?>">
<div class="t-r-md c-on-primary position-relative-10"><?php esc_html_e( 'Lets Talk', 'osous' ); ?></div><img alt="" class="btn-blur" data-wf-target='[[["b34223f0-89a2-d8be-2a87-6097027da21f","b623e9fe-3e85-727a-d993-d40fdd3ee65c"],["965f3bfb-dd26-2142-9ad4-5490af31fb95"]]]' loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/cta-bg.png"/>
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
</div>
<a class="whatsapp w-inline-block" href="https://wa.me/+9647870606069" target="_blank">
<div class="w-layout-blockcontainer container-lg w-container">
<div class="magnatic p-r-0">
<div class="icon-whatsapp w-embed"><svg fill="none" height="58" viewbox="0 0 57 58" width="57" xmlns="http://www.w3.org/2000/svg">
<path clip-rule="evenodd" d="M13.1601 52.8946L14.182 53.5165C18.497 56.1023 23.4446 57.4607 28.4896 57.4771H28.5058C43.9976 57.4771 56.6181 44.7608 56.6181 29.1151C56.6181 21.5377 53.6982 14.4186 48.3937 9.0506C43.0892 3.68262 36.0165 0.736771 28.5058 0.736771C13.0141 0.720405 0.393555 13.4366 0.393555 29.0824C0.393555 34.434 1.86973 39.6547 4.69232 44.1716L5.35741 45.2518L2.5186 55.7095L13.1601 52.8946ZM18.1574 13.3385C18.7576 13.3548 19.4227 13.3876 20.0553 14.8114C20.4607 15.7271 21.1341 17.3914 21.6986 18.7864C22.1732 19.9593 22.5707 20.9417 22.667 21.1286C22.8779 21.5541 23.0077 22.0451 22.7319 22.6179C22.6993 22.6856 22.6686 22.7503 22.639 22.8126C22.4178 23.2776 22.2603 23.6087 21.8884 24.0417C21.7362 24.2189 21.5776 24.4132 21.4195 24.6068C21.1397 24.9497 20.8615 25.2905 20.6231 25.531C20.2013 25.9565 19.7633 26.4148 20.25 27.2658C20.7367 28.1168 22.4399 30.9154 24.9543 33.1738C27.6574 35.6132 30.0079 36.6411 31.1963 37.1607C31.4271 37.2616 31.614 37.3434 31.7512 37.4126C32.5947 37.8381 33.0976 37.7726 33.5843 37.1998C34.0709 36.627 35.6931 34.7122 36.2609 33.8612C36.8124 33.0102 37.3802 33.1575 38.1588 33.4357C38.9374 33.7303 43.0902 35.7924 43.9337 36.2179C44.1 36.3017 44.2555 36.3773 44.3996 36.4474C44.9872 36.733 45.3866 36.9271 45.5559 37.2162C45.7668 37.5762 45.7668 39.2783 45.0693 41.2749C44.3555 43.2715 40.9003 45.1863 39.3592 45.3336C39.2118 45.3477 39.0651 45.3657 38.9141 45.3842C37.4869 45.5592 35.6754 45.7813 29.2206 43.2061C21.2682 40.0363 16.0185 32.1722 14.956 30.5807C14.872 30.4548 14.8142 30.3682 14.7833 30.3262C14.7777 30.3187 14.7718 30.3106 14.7653 30.3018C14.2824 29.6468 11.328 25.6397 11.328 21.505C11.328 17.5496 13.2504 15.4903 14.1271 14.5511C14.1826 14.4916 14.234 14.4366 14.2804 14.3859C15.059 13.5349 15.9675 13.3221 16.5352 13.3221C17.103 13.3221 17.6707 13.3221 18.1574 13.3385Z" fill="currentColor" fill-rule="evenodd"></path>
</svg></div>
<div class="icon-whatsapp-border w-embed"><svg fill="none" height="68" viewbox="0 0 67 68" width="67" xmlns="http://www.w3.org/2000/svg">
<path d="M0.714844 67.3068L5.34988 50.245C2.4843 45.237 0.981045 39.5655 0.996704 33.7677C0.996704 15.6 15.6534 0.828857 33.6455 0.828857C42.3832 0.828857 50.5885 4.25702 56.7424 10.4814C62.912 16.7058 66.31 24.984 66.2944 33.7835C66.2944 51.9512 51.6376 66.7223 33.6299 66.7223H33.6142C28.1493 66.7223 22.7783 65.3321 18.0023 62.7096L0.714844 67.3068Z" fill="#945FFE"></path>
</svg></div>
</div>
</div>
</a>
<div class="section header w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b bg_8"><img alt="" class="header-cut w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/header-cut.svg"/>
<div class="container h-100 w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b">
<div class="header-contents w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b">
<div class="t-r-md c-on-light w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b"><?php esc_html_e( 'Services', 'osous' ); ?></div>
<div class="spacer"></div>
<div class="_w-max-200">
<div class="divider gradient-1 m-y-0 w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b"></div>
</div>
<div>
<h1 class="h1 a-c w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b osous-title-light" text-split="" words-rotate-in=""><?php esc_html_e( 'Mobile App Development in Iraq', 'osous' ); ?></h1>
<p class="p-r-sm c-on-neutral a-c w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b"><?php esc_html_e( 'Custom iOS and Android apps built for Iraqi businesses — fast, secure, and designed to scale. From startup MVPs to enterprise platforms, we deliver apps that perform.', 'osous' ); ?></p>
</div>
</div>
</div><img alt="" class="header_img w-variant-c756be24-ae5b-3cce-8f4a-c141e624aa4b" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/header_img_mobile.webp"/>
</div>
<div class="page-main">
<section class="section c-surface-white">
<div class="slot w-variant-8a10b5c0-3e90-2749-4b5c-65bfe6c9c5d6">
<div class="w-layout-hflex grid-4">
<div class="card metric">
<div class="metric_number">80+</div>
<div class="t-b-md"><?php esc_html_e( 'Apps Launched in Iraq', 'osous' ); ?></div>
</div>
<div class="card metric">
<div class="metric_number">6–10</div>
<div class="t-b-md"><?php esc_html_e( 'Weeks Average Delivery', 'osous' ); ?></div>
</div>
<div class="card metric">
<div class="metric_number"><?php esc_html_e( 'iOS+', 'osous' ); ?></div>
<div class="t-b-md"><?php esc_html_e( 'Android & Cross-Platform', 'osous' ); ?></div>
</div>
<div class="card metric">
<div class="metric_number">24/7</div>
<div class="t-b-md"><?php esc_html_e( 'Post-Launch Support', 'osous' ); ?></div>
</div>
</div>
</div>
</section>
<section class="section c-surface-light overflow-hidden">
<div class="slot">
<div class="w-layout-grid grid-2">
<div class="w-layout-vflex f-v">
<div class="section_title">
<div class="eyebrow_badge">
<div class="t-b-sm"><?php esc_html_e( 'WHY IT MATTERS', 'osous' ); ?></div>
</div>
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-richtext">
<h2><?php esc_html_e( 'Mobile App Development in Iraq for Modern Businesses', 'osous' ); ?></h2>
</div>
<p class="t-r-sm"><?php esc_html_e( 'Iraq\'s smartphone adoption is accelerating rapidly. With millions of active mobile users in Baghdad, Erbil, and Basra, businesses that invest in custom mobile apps are capturing customers their competitors cannot reach. A professionally built app is not just a product — it is a direct, always-on channel between your business and your customers.', 'osous' ); ?></p>
</div>
</div>
</div>
<a class="btn w-inline-block" href="#">
<div class="t-r-md c-on-primary"><?php esc_html_e( 'Requst Consulation', 'osous' ); ?></div>
<div class="icon-24 w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
</a>
</div>
<div class="card">
<h3 class="h3 c-active-light"><?php esc_html_e( 'Iraqi Mobile Market Snapshot', 'osous' ); ?></h3>
<div class="w-layout-vflex list_stat">
<div class="w-layout-hflex stat_item">
<div class="t-b-md"><?php esc_html_e( 'Smartphone Users in Iraq', 'osous' ); ?></div>
<div class="n-lg c-active-light"><?php esc_html_e( '30M+', 'osous' ); ?></div>
</div>
<div class="w-layout-hflex stat_item">
<div class="t-b-md"><?php esc_html_e( 'Mobile Internet Penetration', 'osous' ); ?></div>
<div class="n-lg c-active-light">72%</div>
</div>
<div class="w-layout-hflex stat_item">
<div class="t-b-md"><?php esc_html_e( 'Daily App Usage (avg)', 'osous' ); ?></div>
<div class="n-lg c-active-light"><?php esc_html_e( '4.2 hrs', 'osous' ); ?></div>
</div>
<div class="w-layout-hflex stat_item">
<div class="t-b-md"><?php esc_html_e( 'E-Commerce App Growth (YoY)', 'osous' ); ?></div>
<div class="n-lg c-active-light">+38%</div>
</div>
<div class="w-layout-hflex stat_item">
<div class="t-b-md"><?php esc_html_e( 'Top Platform in Iraq', 'osous' ); ?></div>
<div class="n-lg c-active-light"><?php esc_html_e( 'Android', 'osous' ); ?></div>
</div>
</div>
</div>
</div>
<div class="spacer w-variant-973385ee-73e5-8054-c31c-1d063c55913b"></div>
<div class="w-layout-vflex f-v a-c-t">
<div class="w-layout-hflex grid-3">
<div class="w-layout-vflex f-v"><img alt="" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/img_mobile_features_01.webp"/>
<h3 class="h3"><?php esc_html_e( 'Digital Transformation in Iraq', 'osous' ); ?></h3>
<p class="p"><?php esc_html_e( 'From retail to healthcare to logistics, Iraqi businesses across every sector are embracing mobile to serve customers faster and more efficiently.', 'osous' ); ?></p>
</div>
<div class="w-layout-vflex f-v"><img alt="" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/img_mobile_features_02.webp"/>
<h3 class="h3"><?php esc_html_e( 'Built for Iraqi Users', 'osous' ); ?></h3>
<p class="p"><?php esc_html_e( 'Our apps are designed with the Iraqi user in mind — Arabic and Kurdish language support, RTL layouts, and local payment integrations built in from the start.', 'osous' ); ?></p>
</div>
<div class="w-layout-vflex f-v"><img alt="" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/img_mobile_features_03.webp"/>
<h3 class="h3"><?php esc_html_e( 'From Startup to Enterprise', 'osous' ); ?></h3>
<p class="p"><?php esc_html_e( 'Whether you need a lean MVP to validate an idea or a full-scale enterprise platform, our app development company in Iraq delivers solutions that grow with you.', 'osous' ); ?></p>
</div>
</div>
</div>
<div class="spacer w-variant-973385ee-73e5-8054-c31c-1d063c55913b"></div>
</div>
</section>
<section class="section w-variant-c26fbffc-1fbe-ef2f-6269-bc88f2b3d9c0 c-surface-white">
<div class="slot w-variant-c26fbffc-1fbe-ef2f-6269-bc88f2b3d9c0 c-surface-secondary">
<div class="content list-scroll">
<div class="w-layout-grid grid-2 list_scrolled">
<div class="cell list-scroll">
<div class="section_title">
<div class="w-layout-vflex section_title_them w-variant-5053a507-255c-7c47-49b7-669050399f5e">
<div>
<div class="h2 w-richtext">
<h2><?php esc_html_e( 'Our Mobile App DevelopmentServices', 'osous' ); ?></h2>
</div>
<p class="t-r-sm"><?php esc_html_e( 'End-to-end mobile app development services in Iraq — from native iOS and Android to cross-platform solutions built to perform.', 'osous' ); ?></p>
</div>
</div>
</div>
</div>
<div class="w-layout-vflex f-v" id="w-node-d476c7fd-4969-25cf-722a-5f8ce126aa31-1122b59c">
<div class="w-layout-vflex list_item_2 active">
<div class="w-layout-vflex f-v">
<h3 class="h2 c-on-secondary"><?php esc_html_e( 'iOS App Development', 'osous' ); ?></h3>
<p class="p c-on-secondary-subtle"><?php esc_html_e( 'High-performance iPhone and iPad apps built with Flutter — App Store-ready, beautifully designed, and optimized to meet Apple\'s strictest quality standards.', 'osous' ); ?></p>
</div><img alt="" class="list_item_img" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Mobile_service06.webp"/>
</div>
<div class="w-layout-vflex list_item_2">
<div class="w-layout-vflex f-v">
<h3 class="h2 c-on-secondary"><?php esc_html_e( 'Android App Development', 'osous' ); ?></h3>
<p class="p c-on-secondary-subtle"><?php esc_html_e( 'Android apps built with Flutter, handling device fragmentation across all screen sizes and fully optimized for Google Play publishing and performance.', 'osous' ); ?></p>
</div><img alt="" class="list_item_img" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Mobile_service05.webp"/>
</div>
<div class="w-layout-vflex list_item_2">
<div class="w-layout-vflex f-v">
<h3 class="h2 c-on-secondary"><?php esc_html_e( 'Cross-Platform Development', 'osous' ); ?></h3>
<p class="p c-on-secondary-subtle"><?php esc_html_e( 'One codebase. Two platforms. Flutter lets us build cost-efficient apps for iOS and Android simultaneously — cutting time to market in half while delivering native-level performance and design.', 'osous' ); ?></p>
</div><img alt="" class="list_item_img" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Mobile_service01.webp"/>
</div>
<div class="w-layout-vflex list_item_2">
<div class="w-layout-vflex f-v">
<h3 class="h2 c-on-secondary"><?php esc_html_e( 'App UI/UX Design', 'osous' ); ?></h3>
<p class="p c-on-secondary-subtle"><?php esc_html_e( 'Wireframes, interactive prototypes, and conversion-focused user journeys — designed for Iraqi users and validated before a single line of code is written.', 'osous' ); ?></p>
</div><img alt="" class="list_item_img" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Mobile_service02.webp"/>
</div>
<div class="w-layout-vflex list_item_2">
<div class="w-layout-vflex f-v">
<h3 class="h2 c-on-secondary"><?php esc_html_e( 'App Maintenance & Support', 'osous' ); ?></h3>
<p class="p c-on-secondary-subtle"><?php esc_html_e( 'Post-launch updates, OS compatibility fixes, feature upgrades, and real-time monitoring to keep your app running smoothly long after it goes live.', 'osous' ); ?></p>
</div><img alt="" class="list_item_img" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Mobile_service03.webp"/>
</div>
<div class="w-layout-vflex list_item_2">
<div class="w-layout-vflex f-v">
<h3 class="h2 c-on-secondary"><?php esc_html_e( 'Backend & API Integration', 'osous' ); ?></h3>
<p class="p c-on-secondary-subtle"><?php esc_html_e( 'Robust cloud backends, REST APIs, payment gateways, maps, CRMs, and third-party integrations that power your app\'s features at any scale.', 'osous' ); ?></p>
</div><img alt="" class="list_item_img" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Mobile_service04.webp"/>
</div>
</div>
</div>
</div>
<div class="w-embed w-script"><!--  List scroll  -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".list_item_2");
  const headingCell = document.querySelector(".list-scroll .grid-2 > .cell:first-child");
  const lastItem = items[items.length - 1];
  // Restrict all ScrollTrigger animations to screens 769px and wider
  ScrollTrigger.matchMedia({
    "(min-width: 825px)": function () {
      // 1. Loop through items for opacity and image animations
      items.forEach((item) => {
        const img = item.querySelector(".list_item_img");
        // Set the initial opacity of the entire item to 40%
        gsap.set(item, { opacity: 0.4 });
        // Manage parent opacity and active class
        ScrollTrigger.create({
          trigger: item,
          start: "top center",
          end: "bottom center",
          onToggle: (self) => {
            item.classList.toggle("active", self.isActive);
            if (self.isActive) {
              gsap.to(item, { opacity: 1, duration: 0.4, ease: "power2.out", overwrite: "auto" });
            } else {
              gsap.to(item, { opacity: 0.4, duration: 0.4, ease: "power2.out", overwrite: "auto" });
            }
          }
        });
        // Animate the image with pop-up and slight rotation
        if (img) {
          gsap.fromTo(img, 
            { 
              opacity: 0, 
              scale: 0.8,  
              y: 20,       
              rotation: -5 
            }, 
            { 
              opacity: 1,   
              scale: 1,     
              y: 0,         
              rotation: 0,  
              duration: 0.5,
              ease: "back.out(1.5)", 
              scrollTrigger: {
                trigger: item, 
                start: "top center",
                end: "bottom center",
                toggleActions: "play reverse play reverse" 
              }
            }
          );
        }
      });
      // 2. Pin the left .cell until the last item ends
      if (headingCell && lastItem) {
        ScrollTrigger.create({
          trigger: headingCell,
          start: "top center",
          endTrigger: lastItem,
          end: "bottom center",
          pin: true,
          pinSpacing: false,
          anticipatePin: 1,
        });
      }
    }
  });
  window.addEventListener("resize", () => {
    ScrollTrigger.refresh();
  });
});
</script>
</div>
</div>
</section>
<section class="section c-surface-light bg_7">
<div class="slot w-variant-8a10b5c0-3e90-2749-4b5c-65bfe6c9c5d6">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'Why Choose Our App Developers in Iraq', 'osous' ); ?></h2>
</div>
</div>
</div>
</div>
<div class="swiper-container">
<div class="swiper-wrapper why_us">
<div class="swiper-slide">
<div class="card w-variant-59ddda9c-5bdb-5093-3c9d-6ddcc61c026d basic f-v white second">
<div class="w-layout-vflex">
<h2 class="h3"><?php esc_html_e( 'End-to-End Delivery', 'osous' ); ?></h2>
<p class="p"><?php esc_html_e( 'Discovery, design, development, testing, App Store submission, and post-launch support — all under one roof. You never have to coordinate between multiple vendors or agencies.', 'osous' ); ?><br/></p>
</div>
<div class="card_slot"></div>
</div>
</div>
<div class="swiper-slide">
<div class="card w-variant-79d05571-e072-891f-a69f-3e50c863bc6e basic f-v white second">
<div class="w-layout-vflex">
<h2 class="h3"><?php esc_html_e( 'Local Market Understanding', 'osous' ); ?></h2>
<p class="p"><?php esc_html_e( 'We know the Iraqi user — their language, device preferences, payment habits, and cultural expectations. Every app we build reflects this deep local knowledge, from Arabic RTL layouts to locally relevant features.', 'osous' ); ?><br/></p>
</div>
<div class="card_slot"></div>
</div>
</div>
<div class="swiper-slide">
<div class="card w-variant-59ddda9c-5bdb-5093-3c9d-6ddcc61c026d basic f-v white second">
<div class="w-layout-vflex">
<h2 class="h3"><?php esc_html_e( 'Secure & Scalable Architecture', 'osous' ); ?></h2>
<p class="p"><?php esc_html_e( 'Every app is built on a secure, scalable backend that handles growth without breaking. Enterprise-grade security practices, data encryption, and performance standards are built in from day one.', 'osous' ); ?><br/></p>
</div>
<div class="card_slot"></div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="section w-variant-2e28a4ec-0a9a-9a38-9e9f-a87be7f1f021 overflow-hidden c-surface-white">
<div class="slot w-variant-2e28a4ec-0a9a-9a38-9e9f-a87be7f1f021">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'Our Work', 'osous' ); ?></h2>
</div>
</div>
</div>
</div>
<div class="swiper-container">
<div class="swiper-wrapper ourwork_website">
<div class="swiper-slide"><img alt="" class="ourwork_mobile_item" loading="lazy" sizes="100vw" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_02.webp" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_02-p-500.webp 500w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_02-p-800.webp 800w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_02.webp 980w"/></div>
<div class="swiper-slide"><img alt="" class="ourwork_mobile_item" loading="lazy" sizes="100vw" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_01.webp" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_01-p-500.webp 500w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_01-p-800.webp 800w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_01.webp 980w"/></div>
<div class="swiper-slide"><img alt="" class="ourwork_mobile_item" loading="lazy" sizes="100vw" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_03.webp" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_03-p-500.webp 500w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_03-p-800.webp 800w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_03.webp 980w"/></div>
<div class="swiper-slide"><img alt="" class="ourwork_mobile_item" loading="lazy" sizes="100vw" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_04.webp" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_04-p-500.webp 500w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_04-p-800.webp 800w, <?php echo esc_url( get_template_directory_uri() ); ?>/images/portoflio_mobile_app_04.webp 980w"/></div>
</div>
</div>
</div>
</section>
<section class="section c-surface-white p-y-0">
<div class="slot w-variant-8a10b5c0-3e90-2749-4b5c-65bfe6c9c5d6">
<div class="div-block-5">
<div class="img_tech_we_use"></div>
<div class="tech_we_use">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'Technologies We Use', 'osous' ); ?></h2>
</div>
<p class="t-r-sm w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2"><?php esc_html_e( 'Modern, proven technologies chosen for performance, maintainability, and scalability — not trends.', 'osous' ); ?></p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="section c-surface-light">
<div class="slot">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="eyebrow_badge">
<div class="t-b-sm"><?php esc_html_e( 'Budget & Pricing', 'osous' ); ?></div>
</div>
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'Mobile App Development Cost in Iraq', 'osous' ); ?></h2>
</div>
<p class="t-r-sm w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2"><?php esc_html_e( 'App development cost in Iraq depends on several variables. Here\'s what shapes your budget and how to estimate your project accurately.', 'osous' ); ?></p>
</div>
</div>
</div>
<div class="w-layout-grid grid-2">
<div class="cell">
<div class="card c-surface-primary corner-b-0">
<h3 class="h3 c-on-primary"><?php esc_html_e( 'Factors Affecting Cost', 'osous' ); ?></h3>
<p class="p c-on-primary"><?php esc_html_e( 'App development cost in Iraq depends on several variables. Here\'s what shapes your budget and how to estimate your project accurately.', 'osous' ); ?></p>
</div>
<div class="card corner_top_0">
<ul class="list" role="list">
<li class="list_item">
<div class="list_item_number w-variant-93070888-5417-3070-1d2c-429f395c784e c-surface-primary">
<div class="t-m-lg c-on-tertiary w-variant-93070888-5417-3070-1d2c-429f395c784e">01</div>
<div class="list_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Platform choice — iOS only, Android only, or both', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number w-variant-93070888-5417-3070-1d2c-429f395c784e c-surface-primary">
<div class="t-m-lg c-on-tertiary w-variant-93070888-5417-3070-1d2c-429f395c784e">01</div>
<div class="list_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Native vs. cross-platform development approach', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number w-variant-93070888-5417-3070-1d2c-429f395c784e c-surface-primary">
<div class="t-m-lg c-on-tertiary w-variant-93070888-5417-3070-1d2c-429f395c784e">01</div>
<div class="list_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Number and complexity of features required', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number w-variant-93070888-5417-3070-1d2c-429f395c784e c-surface-primary">
<div class="t-m-lg c-on-tertiary w-variant-93070888-5417-3070-1d2c-429f395c784e">01</div>
<div class="list_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Custom UI/UX design vs. template-based design', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number w-variant-93070888-5417-3070-1d2c-429f395c784e c-surface-primary">
<div class="t-m-lg c-on-tertiary w-variant-93070888-5417-3070-1d2c-429f395c784e">01</div>
<div class="list_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Backend complexity and third-party integrations', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number w-variant-93070888-5417-3070-1d2c-429f395c784e c-surface-primary">
<div class="t-m-lg c-on-tertiary w-variant-93070888-5417-3070-1d2c-429f395c784e">01</div>
<div class="list_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Arabic/Kurdish multilingual requirements', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number w-variant-93070888-5417-3070-1d2c-429f395c784e c-surface-primary">
<div class="t-m-lg c-on-tertiary w-variant-93070888-5417-3070-1d2c-429f395c784e">01</div>
<div class="list_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-variant-93070888-5417-3070-1d2c-429f395c784e w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Post-launch maintenance and support scope', 'osous' ); ?></div>
</div>
</li>
</ul>
</div>
</div>
<div class="cell">
<div class="card estimated-price">
<div>
<h3 class="h3 c-on-primary"><?php esc_html_e( 'How to Estimate Your Project', 'osous' ); ?></h3>
<p class="p c-on-primary"><?php esc_html_e( 'App development cost in Iraq depends on several variables. Here\'s what shapes your budget and how to estimate your project accurately.', 'osous' ); ?></p>
</div><img alt="" class="icon-128" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/estimated-price.png"/>
</div>
<div class="card corner_top_0">
<ul class="list" role="list">
<li class="list_item">
<div class="list_item_number">
<div class="t-m-lg c-on-tertiary">01</div>
<div class="list_icon w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Define your core features', 'osous' ); ?></div>
<div class="t-r-sm opacity-70"><?php esc_html_e( 'list everything the app must do on day one (your MVP).', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number">
<div class="t-m-lg c-on-tertiary">02</div>
<div class="list_icon w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Choose your platform', 'osous' ); ?></div>
<div class="t-r-sm opacity-70"><?php esc_html_e( 'iOS, Android, or both — based on your target audience in Iraq.', 'osous' ); ?></div>
</div>
</li>
<li class="list_item">
<div class="list_item_number">
<div class="t-m-lg c-on-tertiary">03</div>
<div class="list_icon w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
<div class="list_checked_icon w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M23.8135 4.7998L8.7998 19.8145L0.185547 11.2002L1.59961 9.78516L8.79883 16.9854L22.3994 3.38574L23.8135 4.7998Z" fill="currentColor"></path>
</svg>
</div>
</div>
<div class="list_item_content">
<div class="t-b-md"><?php esc_html_e( 'Identify integrations needed', 'osous' ); ?></div>
<div class="t-r-sm opacity-70"><?php esc_html_e( 'payments, maps, chat, ERP, or existing systems.', 'osous' ); ?></div>
</div>
</li>
</ul>
</div>
</div>
</div>
<div class="spacer w-variant-804ecf3d-e06d-d993-7192-9b5ce4a18ec9"></div>
<div class="w-layout-hflex f-h a-c-c">
<a class="btn w-inline-block" href="#">
<div class="t-r-md c-on-primary"><?php esc_html_e( 'Requst Consulation', 'osous' ); ?></div>
<div class="icon-24 w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
</a>
</div>
</div>
</section>
<section class="section pattern_1">
<div class="slot w-variant-8a10b5c0-3e90-2749-4b5c-65bfe6c9c5d6">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="eyebrow_badge">
<div class="t-b-sm"><?php esc_html_e( 'How We Work', 'osous' ); ?></div>
</div>
<div class="w-layout-vflex section_title_them w-variant-5053a507-255c-7c47-49b7-669050399f5e">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'Our Mobile App DevelopmentProcess', 'osous' ); ?></h2>
</div>
<p class="t-r-sm w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2"><?php esc_html_e( 'A structured, transparent process from idea to launch — so you always know where your project stands', 'osous' ); ?></p>
</div>
</div>
</div>
<div class="w-layout-vflex step_list">
<div class="w-layout-hflex step">
<div class="card step_number">
<div class="t-r-md"><?php esc_html_e( 'STEP', 'osous' ); ?></div>
<div class="step_n">01</div>
</div>
<div class="card step_content">
<div class="h3"><?php esc_html_e( 'Discovery & Planning', 'osous' ); ?></div>
<p class="p"><?php esc_html_e( 'We begin by understanding your goals, target users, core features, timeline, and budget. This phase defines a clear product roadmap so development starts with a solid foundation — no surprises, no scope creep.', 'osous' ); ?></p>
</div>
</div>
<div class="w-layout-hflex step">
<div class="card step_number">
<div class="t-r-md"><?php esc_html_e( 'STEP', 'osous' ); ?></div>
<div class="step_n">02</div>
</div>
<div class="card step_content">
<div class="h3"><?php esc_html_e( 'UI/UX Design & Prototyping', 'osous' ); ?></div>
<p class="p"><?php esc_html_e( 'Our designers create wireframes and interactive mockups for your approval. You see how the app looks, feels, and flows before development begins — including Arabic/Kurdish RTL screens and user journey validation.', 'osous' ); ?></p>
</div>
</div>
<div class="w-layout-hflex step">
<div class="card step_number">
<div class="t-r-md"><?php esc_html_e( 'STEP', 'osous' ); ?></div>
<div class="step_n">03</div>
</div>
<div class="card step_content">
<div class="h3"><?php esc_html_e( 'Development & Integration', 'osous' ); ?></div>
<p class="p"><?php esc_html_e( 'Frontend, backend, APIs, database architecture, payment systems, and third-party integrations are all built in parallel sprints with regular progress updates. You stay informed at every stage.', 'osous' ); ?></p>
</div>
</div>
<div class="w-layout-hflex step">
<div class="card step_number">
<div class="t-r-md"><?php esc_html_e( 'STEP', 'osous' ); ?></div>
<div class="step_n">04</div>
</div>
<div class="card step_content">
<div class="h3"><?php esc_html_e( 'Testing & Quality Assurance', 'osous' ); ?></div>
<p class="p"><?php esc_html_e( 'Rigorous functional testing, device testing across Android and iOS hardware, performance benchmarking, and bug fixing before anything leaves our hands. We don\'t launch until it\'s right.', 'osous' ); ?></p>
</div>
</div>
<div class="w-layout-hflex step">
<div class="card step_number">
<div class="t-r-md"><?php esc_html_e( 'STEP', 'osous' ); ?></div>
<div class="step_n">05</div>
</div>
<div class="card step_content">
<div class="h3"><?php esc_html_e( 'Deployment & Launch', 'osous' ); ?></div>
<p class="p"><?php esc_html_e( 'We begin by understanding your goals, target users, core features, timeline, and budget. This phase defines a clear product roadmap so development starts with a solid foundation — no surprises, no scope creep.', 'osous' ); ?></p>
</div>
</div>
</div>
</div>
</section>
<section class="section c-surface-white">
<div class="slot">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="eyebrow_badge">
<div class="t-b-sm"><?php esc_html_e( 'Industries We Serve', 'osous' ); ?></div>
</div>
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'Mobile App Solutions for Every', 'osous' ); ?> <em><?php esc_html_e( 'Iraqi Industry', 'osous' ); ?></em></h2>
<h2>‍</h2>
</div>
<p class="t-r-sm w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2"><?php esc_html_e( 'Sector-specific app development with deep understanding of each industry\'s unique requirements and Iraqi user behavior.', 'osous' ); ?></p>
</div>
</div>
</div>
<div class="w-layout-grid grid-4">
<div class="card industry"><img alt="" class="icon-64" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon-1.svg"/>
<div class="spacer-5x"></div>
<p class="h3"><?php esc_html_e( 'Retail & E-Commerce Apps', 'osous' ); ?></p>
<p class="p"><?php esc_html_e( 'Product catalogues, cart and checkout flows, local payment integration, delivery tracking, and Arabic/Kurdish product pages — everything your customers need to shop on mobile.', 'osous' ); ?></p>
</div>
<div class="card industry"><img alt="" class="icon-64" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Property-1Healthcare.svg"/>
<div class="spacer-5x"></div>
<p class="h3"><?php esc_html_e( 'Healthcare Apps', 'osous' ); ?></p>
<p class="p"><?php esc_html_e( 'Appointment booking, patient records, telehealth consultations, and secure messaging — built to the highest privacy and security standards for Iraqi clinics and hospitals.', 'osous' ); ?></p>
</div>
<div class="card industry"><img alt="" class="icon-64" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon-transportation.svg"/>
<div class="spacer-5x"></div>
<p class="h3"><?php esc_html_e( 'Logistics & Delivery Apps', 'osous' ); ?></p>
<p class="p"><?php esc_html_e( 'Real-time driver tracking, route optimization, order dispatch management, and fleet dashboards — purpose-built for Iraq\'s growing logistics and last-mile delivery sector.', 'osous' ); ?></p>
</div>
<div class="card industry"><img alt="" class="icon-64" loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/Property-1Education.svg"/>
<div class="spacer-5x"></div>
<p class="h3"><?php esc_html_e( 'Education & E-Learning Apps', 'osous' ); ?></p>
<p class="p"><?php esc_html_e( 'Student portals, interactive courses, quizzes, live classes, and learning management systems in Arabic and Kurdish — connecting Iraqi learners with quality education anywhere.', 'osous' ); ?></p>
</div>
</div>
</div>
</section>
<section class="section c-surface-white">
<div class="slot">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="eyebrow_badge">
<div class="t-b-sm"><?php esc_html_e( 'Client Reviews', 'osous' ); ?></div>
</div>
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'What Iraqi Businesses Say About Us', 'osous' ); ?></h2>
</div>
</div>
</div>
</div>
<div class="swiper-container">
<div class="swiper-wrapper tesimonial">
<div class="swiper-slide">
<div class="testimonial_card_1">
<div class="card testimonial">
<div class="_5_stars"></div>
<p class="p-b-lg"><?php esc_html_e( '"They built our delivery app in under 8 weeks—iOS and Android, full Arabic UI, real-time tracking. Drivers and customers love it."', 'osous' ); ?></p>
<div class="w-layout-hflex f-h t">
<div class="testimonial_avatar"></div>
<div class="w-layout-vflex flex-block">
<div class="t-b-md"><?php esc_html_e( 'Omar Al-Jabiri', 'osous' ); ?></div>
<div class="t-r-sm"><?php esc_html_e( 'Logistics Startup Founder, Baghdad', 'osous' ); ?></div>
</div>
</div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="testimonial_card_2">
<div class="card testimonial w-variant-375e6d65-118b-6894-2a5f-1d79cc00d736">
<div class="_5_stars w-variant-375e6d65-118b-6894-2a5f-1d79cc00d736"></div>
<p class="p-b-lg"><?php esc_html_e( '"Our clinic app manages hundreds of bookings daily without issues. The team grasped healthcare needs and delivered a product we\'re proud of."', 'osous' ); ?></p>
<div class="w-layout-hflex f-h t">
<div class="testimonial_avatar w-variant-375e6d65-118b-6894-2a5f-1d79cc00d736"></div>
<div class="w-layout-vflex flex-block">
<div class="t-b-md"><?php esc_html_e( 'Dr. Lana Khoshnaw', 'osous' ); ?></div>
<div class="t-r-sm"><?php esc_html_e( 'Private Clinic Owner, Erbil', 'osous' ); ?></div>
</div>
</div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="testimonial_card_3">
<div class="card testimonial">
<div class="_5_stars"></div>
<p class="p-b-lg"><?php esc_html_e( '"We needed a cross-platform e-learning app in Arabic and Kurdish. They delivered on time and budget, boosting student engagement."', 'osous' ); ?></p>
<div class="w-layout-hflex f-h t">
<div class="testimonial_avatar"></div>
<div class="w-layout-vflex flex-block">
<div class="t-b-md"><?php esc_html_e( 'Salam Mohammed', 'osous' ); ?></div>
<div class="t-r-sm"><?php esc_html_e( 'Education Platform Director, Basra', 'osous' ); ?></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="section c-surface-white">
<div class="slot w-variant-8a10b5c0-3e90-2749-4b5c-65bfe6c9c5d6">
<div class="section_title w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2">
<div class="w-layout-vflex section_title_them">
<div>
<div class="h2 w-variant-9d63a84e-4632-12fe-d16e-23dad33b70d2 w-richtext">
<h2><?php esc_html_e( 'FAQs', 'osous' ); ?></h2>
</div>
</div>
</div>
</div>
<div class="w-layout-vflex">
<div class="accordion">
<div class="accordion_qustion">
<div class="h3"><?php esc_html_e( 'What is the cost of mobile app development in Iraq?', 'osous' ); ?></div>
<div class="accordion_icon">
<div class="accordion-icon-line-h"></div>
<div class="accordion-icon-line-v"></div>
</div>
</div>
<div class="accordion_answer">
<p class="p"><?php esc_html_e( 'App development costs vary based on complexity, platform, and features. Simple apps start at a lower investment, while complex enterprise apps require a larger budget. Contact us and we\'ll provide a detailed quote within 48 hours.', 'osous' ); ?></p>
</div>
</div>
<div class="accordion">
<div class="accordion_qustion">
<div class="h3"><?php esc_html_e( 'How long does it take to build a mobile app?', 'osous' ); ?></div>
<div class="accordion_icon">
<div class="accordion-icon-line-h"></div>
<div class="accordion-icon-line-v"></div>
</div>
</div>
<div class="accordion_answer">
<p class="p"><?php esc_html_e( 'A basic app typically takes 6–10 weeks. Mid-complexity apps with custom backends take 3–5 months. Enterprise platforms may take longer. We provide a clear timeline after your discovery session.', 'osous' ); ?></p>
</div>
</div>
<div class="accordion">
<div class="accordion_qustion">
<div class="h3"><?php esc_html_e( 'Do you develop iOS and Android apps?', 'osous' ); ?></div>
<div class="accordion_icon">
<div class="accordion-icon-line-h"></div>
<div class="accordion-icon-line-v"></div>
</div>
</div>
<div class="accordion_answer">
<p class="p"><?php esc_html_e( 'Yes. We build iOS and Android apps using Flutter — delivering native-level performance on both platforms from a single codebase.', 'osous' ); ?></p>
</div>
</div>
<div class="accordion">
<div class="accordion_qustion">
<div class="h3"><?php esc_html_e( 'Can you build a cross-platform app with Flutter?', 'osous' ); ?></div>
<div class="accordion_icon">
<div class="accordion-icon-line-h"></div>
<div class="accordion-icon-line-v"></div>
</div>
</div>
<div class="accordion_answer">
<p class="p"><?php esc_html_e( 'Absolutely. Flutter is our cross-platform framework of choice. It allows us to build a single codebase that runs natively on both iOS and Android, reducing cost and time to market significantly without sacrificing quality or performance.', 'osous' ); ?></p>
</div>
</div>
<div class="accordion">
<div class="accordion_qustion">
<div class="h3"><?php esc_html_e( 'Do you provide post-launch maintenance and support?', 'osous' ); ?></div>
<div class="accordion_icon">
<div class="accordion-icon-line-h"></div>
<div class="accordion-icon-line-v"></div>
</div>
</div>
<div class="accordion_answer">
<p class="p"><?php esc_html_e( 'Yes. We offer ongoing maintenance packages that include bug fixes, OS version updates, feature enhancements, and performance monitoring to keep your app running smoothly after launch.', 'osous' ); ?></p>
</div>
</div>
<div class="accordion">
<div class="accordion_qustion">
<div class="h3"><?php esc_html_e( 'Can you integrate payments, chat, maps, or ERP systems?', 'osous' ); ?></div>
<div class="accordion_icon">
<div class="accordion-icon-line-h"></div>
<div class="accordion-icon-line-v"></div>
</div>
</div>
<div class="accordion_answer">
<p class="p"><?php esc_html_e( 'Yes. We integrate a wide range of systems — local and international payment gateways, real-time chat, Google Maps, CRMs, ERPs, and fully custom APIs and backends.', 'osous' ); ?></p>
</div>
</div>
</div>
</div>
</section>
</div>
<div id="inquiery">
<section class="section c-surface-white">
<div class="slot w-variant-8a10b5c0-3e90-2749-4b5c-65bfe6c9c5d6">
<div class="card cta-bg">
<div class="section_title center">
<h2 class="h2 a-c c-on-primary"><?php esc_html_e( 'Get a Mobile App Built for Your Business in Iraq', 'osous' ); ?></h2>
<p class="p a-c c-on-primary"><?php esc_html_e( 'Tell us about your idea and we\'ll get back with a free consultation and custom quote within 48 hours. No commitment required.', 'osous' ); ?></p>
<div class="spacer-3x"></div>
<a class="btn dark w-inline-block" href="<?php echo esc_url( osous_url( 'contact.html' ) ); ?>">
<div class="t-r-md"><?php esc_html_e( 'Requst Consulation', 'osous' ); ?></div>
<div class="icon-24 w-embed"><svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6822 18.7468L21.4651 12M21.4651 12L15.6822 5.25323M21.4651 12L3.7085 12" stroke="currentColor" stroke-width="1.5"></path>
</svg></div>
</a>
</div>
</div>
</div>
</section>
</div>

</div>
<?php
get_footer();
