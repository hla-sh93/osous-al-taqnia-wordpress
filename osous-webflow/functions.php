<?php
/**
 * Osous Al Taqnia theme, converted from the Webflow export.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The version lives in style.css only.
define( 'OSOUS_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );

require_once get_template_directory() . '/inc/turnstile.php';
require_once get_template_directory() . '/inc/install-pages.php';

/* ---------- Theme setup ---------- */

/**
 * Title tag, featured images for posts and the blog cards, HTML5 markup, translations.
 */
function osous_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'script', 'style', 'search-form', 'gallery', 'caption' ) );
	load_theme_textdomain( 'osous', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'osous_setup' );

/* ---------- Which page is showing ---------- */

/**
 * The original Webflow file name for the current page (e.g. "about.html").
 */
function osous_current_file() {
	if ( is_front_page() ) {
		return 'index.html';
	}
	if ( is_404() ) {
		return '404.html';
	}
	if ( is_singular( 'post' ) ) {
		return 'blog.html';
	}
	$post = get_queried_object();
	if ( $post instanceof WP_Post ) {
		return $post->post_name . '.html';
	}
	return '';
}

/**
 * URL for a Webflow file name, using the WordPress slug.
 */
function osous_url( $file ) {
	if ( 'index.html' === $file ) {
		return home_url( '/' );
	}
	return home_url( '/' . basename( $file, '.html' ) . '/' );
}

/**
 * The blog list: the posts page from Settings > Reading, else the "blog" page.
 */
function osous_blog_url() {
	$posts_page = (int) get_option( 'page_for_posts' );
	if ( $posts_page ) {
		return get_permalink( $posts_page );
	}
	$blog = get_page_by_path( 'blog' );
	return $blog ? get_permalink( $blog ) : home_url( '/' );
}

function osous_current_class( $file ) {
	return ( $file === osous_current_file() ) ? ' w--current' : '';
}

function osous_aria_current( $file ) {
	return ( $file === osous_current_file() ) ? 'aria-current="page"' : '';
}

/**
 * The footer sits on a white surface on every page except the home page.
 */
function osous_footer_class() {
	return ( 'index.html' === osous_current_file() ) ? '' : ' c-surface-white';
}

function osous_wf_page_id() {
	if ( is_singular( 'post' ) ) {
		return '68617f006307fef33bc371e3';
	}
	$ids  = array( '404.html' => '686eae091523c87e2842067c', 'about.html' => '682e144dc0cad42fae731b2b', 'acronis-iraq.html' => '686eb98215091a67ff929365', 'aml-compliance-software.html' => '6ae1a1a9818e3d7a997b5ef4', 'aruba-iraq.html' => '686ebaaa5dee29d2d26c09ae', 'avigilon-iraq.html' => '68ebab7df52b293ce2498800', 'axis-iraq.html' => '68ebaefce51d502c061acc74', 'azure-cloud-iraq.html' => '682e125227fcc73cdf7b9c4f', 'backup-solutions-iraq.html' => '682e138a5dbcc6b98e4ba130', 'blog.html' => '6861836719ac72229463bb29', 'cctv-company-iraq.html' => '682e13c809bb4e3e8ffc8886', 'citrix-iraq.html' => '686ebab8961e873d58776593', 'cloud-backup-iraq.html' => '682e139616bda425196b369d', 'cloud-optimization-iraq.html' => '682e123a5dbcc6b98e4ac3ae', 'cloud-services-iraq.html' => '6851e36362a00cb2c8e5b3bd', 'contact.html' => '682e1458def65f3326d66619', 'corning-iraq.html' => '686ebac70be76fcbb1f0e501', 'customer-onboarding.html' => '6ab4ca21b8a4162159de4589', 'cybersecurity-iraq.html' => '6851e410897cf2bfb1a83315', 'data-center-iraq.html' => '682e13e5c0f2fbfbbf1b6cd8', 'data-protection-iraq.html' => '6851e488e3358f4a7d17a55e', 'dell-iraq.html' => '686ebad41aaa6ac7f649a035', 'device-management-iraq.html' => '682e12b834a80ed21eff8a2a', 'disaster-recovery-iraq.html' => '6849a53c345a681d0dd8371b', 'dlp-solutions-iraq.html' => '6849ab3efc5598eb3a000179', 'e-commerce.html' => '6aad5568e60d7b04e3746350', 'email-security-iraq.html' => '682e129315689c163caceca2', 'endpoint-secuirty-iraq.html' => '682e129d3dd072cfeda762bd', 'fortinet-iraq.html' => '686ebaded304b3ec2863d41b', 'hci-solutions-iraq.html' => '682e13d5117d29af0c17d745', 'hikvision-iraq.html' => '686ebb1138990c87c7b4c26f', 'hpe-iraq.html' => '686ebb1a8dfcf488b77eba6e', 'huawei-iraq.html' => '686ebb28d304b3ec286418af', 'ict-solutions-iraq.html' => '682e141cc0cad42fae73027b', 'identity-access-management-iraq.html' => '682e12addf73cb423d9d0050', 'index.html' => '6820b85e2e5b8c350c893898', 'it-amc-iraq.html' => '682e14286cd38cc602a778fa', 'it-consulting-iraq.html' => '682e143209bb4e3e8ffcd390', 'it-infrastructure-iraq.html' => '6851e49cfd09cb6e9a54c6d5', 'it-services-iraq.html' => '6851e522704c389df71b4972', 'juniper-iraq.html' => '68c00e1a7358b67586453625', 'kaspersky-iraq.html' => '686ebb323571b5ce76476849', 'managed-it-services-iraq.html' => '6849e05f51a178eb169d9650', 'microsoft-dynamics-365-iraq.html' => '68f7904f11dbf5cd55010419', 'microsoft-iraq.html' => '686ebb3c8dfcf488b77ee165', 'microsoft-office-365-iraq.html' => '682e1267dfa7978377755773', 'mobile-app.html' => '6aad5557e7dcbe361122b59c', 'motorola-iraq.html' => '686ebb479e0244a0cf11cf56', 'multi-factor-authentication-iraq.html' => '682e12c6dfa797837775987b', 'network-wifi-solutions-iraq.html' => '682e13bc9977a4e63eaedbf0', 'next-generation-firewall-iraq.html' => '682e12d1e1d05e9ec7ad419c', 'partners.html' => '695e3ee92164f4c05e11e8ba', 'privacy-policy.html' => '68e0086cd8c442dbc2558428', 'privileged-access-management-iraq.html' => '682e12dc16bda425196abf72', 'reconciliation-system.html' => '6ab4c6ccac1824b5e14304be', 'red-hat-iraq.html' => '68c00e77115a0625292e8dfa', 'sentinelone-iraq.html' => '686ebb517c7fe1a1317ad2af', 'server-storage-iraq.html' => '682e13f11480cbdd681d0cc6', 'siem-soc-solutions-iraq.html' => '682e12e7fa37f31ad293b268', 'sophos-iraq.html' => '68c00e4ca83374c392a662a6', 'structured-cabling-iraq.html' => '682e13fd6cfc7b8f8fde6ec0', 'terms-conditions.html' => '693aca19133bdb312f6349e5', 'veeam-iraq.html' => '686ebb5baf2f55d55aaed2ea', 'vertiv-iraq.html' => '686ebb6da1442781ede4a150', 'virtualization-solutions-iraq.html' => '682e1408f851cc160128ed59', 'vmware-iraq.html' => '686ebb7ed020aec33a441ab0', 'website-design.html' => '6aad5482366cf3390161689b' );
	$file = osous_current_file();
	return isset( $ids[ $file ] ) ? $ids[ $file ] : '';
}

/* ---------- Titles and descriptions ---------- */

/**
 * The page's title or description from the table below; '' when the page has none
 * (WordPress then uses its own title and the meta tag is left out).
 */
function osous_meta( $key ) {
	if ( is_singular( 'post' ) ) {
		return 'title' === $key ? '' : wp_strip_all_tags( get_the_excerpt() );
	}
	$table = array(
	    '404.html' => array( 'title' => __( 'Not Found', 'osous' ), 'description' => '' ),
    'about.html' => array( 'title' => __( 'ICT and Cybersecurity Company in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Leading ICT and cybersecurity company in Iraq offering digital transformation, cloud, and infrastructure services for the public and private sectors.', 'osous' ) ),
    'acronis-iraq.html' => array( 'title' => __( 'Acronis Partner in Iraq - Cybersecurity & Backup | Osous Al Taqnia', 'osous' ), 'description' => __( 'Certified Acronis partner in Iraq delivering expert-supported cybersecurity, backup, and disaster recovery solutions tailored to your business.', 'osous' ) ),
    'aml-compliance-software.html' => array( 'title' => __( 'AML & Compliance Software for Banks | Osous Al Taqnia', 'osous' ), 'description' => __( 'Run your entire compliance cycle on one platform. From KYC and sanctions screening to transaction monitoring and regulatory reporting, with nothing falling between the stages.', 'osous' ) ),
    'aruba-iraq.html' => array( 'title' => __( 'Aruba Partner in Iraq - Wireless & Network Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Official Aruba partner in Iraq offering wireless access points, SD-WAN, and secure network solutions with local support and certified deployment.', 'osous' ) ),
    'avigilon-iraq.html' => array( 'title' => __( 'Avigilon Partner in Iraq, Authorized Avigilon Reseller | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is an authorized Avigilon Partner in Iraq, offering certified video surveillance and access control solutions across Baghdad, Basra, and Erbil. Request a consultation today.', 'osous' ) ),
    'axis-iraq.html' => array( 'title' => __( 'Axis Partner in Iraq | Authorized Axis Reseller | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is an authorized Axis Partner in Iraq, delivering reliable network cameras, video management, and access control solutions across Baghdad, Basra, and Erbil. Contact us for customized Axis security systems.', 'osous' ) ),
    'azure-cloud-iraq.html' => array( 'title' => __( 'Microsoft Azure Cloud Provider in Iraq - Azure Cloud Computing Services | Osous Al Taqnia', 'osous' ), 'description' => __( 'Iraq\'s Azure cloud experts: Migrate, optimize, and secure your business with compliant solutions, 24/7 support, and AI-driven cost control. Contact us today!', 'osous' ) ),
    'backup-solutions-iraq.html' => array( 'title' => __( 'Backup Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your business with enterprise-grade backup and replication solutions from Osous Al Taqnia. Minimize downtime and ensure business continuity across Iraq.', 'osous' ) ),
    'blog.html' => array( 'title' => __( 'blog', 'osous' ), 'description' => '' ),
    'cctv-company-iraq.html' => array( 'title' => __( 'CCTV Company in Iraq - CCTV Supplier | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your property with cutting-edge CCTV surveillance systems in Iraq. Professional installation, monitoring & support from Osous Al Taqnia. Get your free assessment today!', 'osous' ) ),
    'citrix-iraq.html' => array( 'title' => __( 'Citrix Partner in Iraq – Virtual Desktop & Secure Access Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is a certified Citrix partner in Iraq. We deliver virtual desktops, secure remote access, workspace management, and SD-WAN solutions with local support.', 'osous' ) ),
    'cloud-backup-iraq.html' => array( 'title' => __( 'Cloud Backup Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia\'s cloud backup solutions help Iraqi businesses protect critical data, ensure compliance, and reduce costs. Get expert implementation guidance today.', 'osous' ) ),
    'cloud-optimization-iraq.html' => array( 'title' => __( 'Cloud Optimization Services - Cloud Experts in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Maximize cloud performance while reducing costs with Osous Al Taqnia\'s cloud optimization services in Iraq. Save 30-60% on cloud spending with our expert solutions.', 'osous' ) ),
    'cloud-services-iraq.html' => array( 'title' => __( 'Best Cloud Solutions Provider in Iraq - Microsoft Azure & 365 Experts | Osous Al Taqnia', 'osous' ), 'description' => __( 'Transform your Iraqi business with Osous Al Taqnia\'s secure, scalable cloud solutions. Microsoft-certified Azure & 365 services with 24/7 local Iraq support.', 'osous' ) ),
    'contact.html' => array( 'title' => __( 'Contact | Osous Al Taqnia', 'osous' ), 'description' => '' ),
    'corning-iraq.html' => array( 'title' => __( 'Corning partner in Iraq - Cables and Fiber Optic Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is an authorized Corning partner in Iraq. Get high-speed copper and fiber optic cabling for telecom, enterprise, FTTH, and industrial networks', 'osous' ) ),
    'customer-onboarding.html' => array( 'title' => __( 'Customer Onboarding', 'osous' ), 'description' => '' ),
    'cybersecurity-iraq.html' => array( 'title' => __( 'Cyber security Services in Iraq - Protect Your Business | Osous Al Taqnia', 'osous' ), 'description' => __( 'Safeguard your Iraqi business with Osous Al Taqnia\'s comprehensive cybersecurity solutions. From next-gen firewalls to SOC services, we protect your digital assets. Free consultation!', 'osous' ) ),
    'data-center-iraq.html' => array( 'title' => __( 'Data Center in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Deploy customized, scalable modular data centers across Iraq with Osous Al Taqnia. Our prefabricated solutions offer rapid deployment, local expertise, and end-to-end support.', 'osous' ) ),
    'data-protection-iraq.html' => array( 'title' => __( 'Data Protection Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Secure your business with enterprise-grade data protection solutions from Osous Al Taqnia. Comprehensive backup, disaster recovery, and DLP services across Iraq.', 'osous' ) ),
    'dell-iraq.html' => array( 'title' => __( 'Dell Partner Iraq - Authorized Dell Reseller | Osous Al Taqnia', 'osous' ), 'description' => __( 'Need a Dell reseller in Iraq? Get genuine Dell servers, Dell EMC storage and infrastructure services with local design, delivery and support across Iraq.', 'osous' ) ),
    'device-management-iraq.html' => array( 'title' => __( 'Device Management Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Discover how Osous Al Taqnia\'s device management solutions provide Iraqi businesses with enhanced security, efficiency, and control across all endpoints. Contact us today!', 'osous' ) ),
    'disaster-recovery-iraq.html' => array( 'title' => __( 'Disaster Recovery Solutions & Services in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Implement robust disaster recovery solutions with Osous Al Taqnia to protect your Iraqi business from data loss and minimize downtime. Expert planning, testing and support. Contact us today!', 'osous' ) ),
    'dlp-solutions-iraq.html' => array( 'title' => __( 'DLP Solution in Iraq - Data Loss Prevention & Security Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your organization from data breaches with Osous Al Taqnia\'s advanced DLP solutions in Iraq. AI-powered security, compliance management, and 24/7 support.', 'osous' ) ),
    'e-commerce.html' => array( 'title' => __( 'e-commerce', 'osous' ), 'description' => '' ),
    'email-security-iraq.html' => array( 'title' => __( 'Email Security Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your Iraqi business from sophisticated email threats with Osous Al-Taqnia\'s multi-layered security solutions. Get local expertise and 24/7 Arabic support.', 'osous' ) ),
    'endpoint-secuirty-iraq.html' => array( 'title' => __( 'Endpoint Security Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your Iraq business with Osous Al Taqnia\'s comprehensive endpoint security solutions. Expert threat prevention, detection & response for the digital age.', 'osous' ) ),
    'fortinet-iraq.html' => array( 'title' => __( 'Fortinet Partner in Iraq - Firewalls & Cybersecurity Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is a certified Fortinet partner in Iraq. We provide FortiGate firewalls, UTM, secure Wi-Fi, and network security services with expert local support.', 'osous' ) ),
    'hci-solutions-iraq.html' => array( 'title' => __( 'HCI Solutions in Iraq - Modern Infrastructure | Osous Al Taqnia', 'osous' ), 'description' => __( 'Modernize your Iraqi business with Osous Al Taqnia\'s HCI solutions. Reduce costs, improve scalability, and enhance security with hyper-converged infrastructure. Contact us today!', 'osous' ) ),
    'hikvision-iraq.html' => array( 'title' => __( 'Hikvision Partner in Iraq – Video Surveillance & Access Control | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is a certified Hikvision partner in Iraq. We offer CCTV systems, IP cameras, NVRs, access control, and integrated security services for public and private sectors.', 'osous' ) ),
    'hpe-iraq.html' => array( 'title' => __( 'HPE Partner in Iraq – Storage & Infrastructure Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Certified HPE partner in Iraq offering enterprise-grade servers, cloud, and data storage solutions. Full support from design to deployment.', 'osous' ) ),
    'huawei-iraq.html' => array( 'title' => __( 'Huawei Partner in Iraq – Enterprise Networking Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is an authorized Huawei partner in Iraq. We deliver certified switches, Wi-Fi 6 access points, SD-WAN, and security appliances with expert in-country support.', 'osous' ) ),
    'ict-solutions-iraq.html' => array( 'title' => __( 'ICT Solutions in Iraq - Leading ICT Services Company | Osous Al Taqnia', 'osous' ), 'description' => __( 'Empower your business with Osous Al Taqnia\'s complete ICT solutions in Iraq. Network infrastructure, cloud computing, cybersecurity & more. Transform your operations today.', 'osous' ) ),
    'identity-access-management-iraq.html' => array( 'title' => __( 'Identity and Access Management Solutions in Iraq - IAM Security | Osous Al Taqnia', 'osous' ), 'description' => __( 'Enhance your organization\'s security with Osous Al Taqnia\'s comprehensive IAM solutions tailored for Iraqi businesses. SSO, MFA, RBAC & more. Contact us today!', 'osous' ) ),
    'index.html' => array( 'title' => __( 'Osous Al Taqnia - Leading IT & Cybersecurity Solutions in Iraq', 'osous' ), 'description' => __( 'Transform your Iraqi business with Osous Al Taqnia\'s comprehensive IT solutions. Expert services in cybersecurity, cloud, infrastructure, and managed IT across Baghdad, Erbil, and Basra.', 'osous' ) ),
    'it-amc-iraq.html' => array( 'title' => __( 'IT AMC Iraq - IT AMC Services and Solutions - IT AMC Company | Osous Al Taqnia', 'osous' ), 'description' => __( 'Take the hassle out of IT issues with Iraq\'s leading IT AMC provider. Our team will make sure your IT infrastructure is running peacefully. Get your AMC now!', 'osous' ) ),
    'it-consulting-iraq.html' => array( 'title' => __( 'IT Consulting Services - IT Consulting Company in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Transform your Iraqi business with Osous Al Taqnia\'s professional IT consulting services. Expert cybersecurity, cloud migration, and infrastructure optimization. Contact us today!', 'osous' ) ),
    'it-infrastructure-iraq.html' => array( 'title' => __( 'IT Infrastructure Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Transform your Iraqi business with Osous Al Taqnia\'s enterprise-grade IT infrastructure solutions. From LAN & Wi-Fi to data centers, we deliver tailored expertise across Iraq.', 'osous' ) ),
    'it-services-iraq.html' => array( 'title' => __( 'IT Services in Iraq, IT Consulting Company & ICT Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Transform your Iraqi business with Osous Al Taqnia\'s professional IT services. Managed IT support, consulting, AMC contracts & complete ICT solutions. Contact us today!', 'osous' ) ),
    'juniper-iraq.html' => array( 'title' => __( 'Juniper Partner in Iraq - Authorized Reseller | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia, an authorized Juniper Partner in Iraq, delivers enterprise networking, security, and cloud solutions with certified expertise. Request a consultation today.', 'osous' ) ),
    'kaspersky-iraq.html' => array( 'title' => __( 'Kaspersky Partner in Iraq, Licensed Cybersecurity Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia, an authorized Kaspersky partner in Iraq, provides licensed cybersecurity solutions for enterprises, government, and SMBs. Contact us today.', 'osous' ) ),
    'managed-it-services-iraq.html' => array( 'title' => __( 'Managed IT Services in Iraq - IT Service Provider Company | Osous Al Taqnia', 'osous' ), 'description' => __( 'Transform your Iraq business with Osous Al Taqnia\'s professional managed IT services. 24/7 support, security solutions & IT consulting for sustainable growth. Contact us today!', 'osous' ) ),
    'microsoft-dynamics-365-iraq.html' => array( 'title' => __( 'Microsoft Dynamics 365 Partner in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia delivers Microsoft Dynamics 365 ERP & CRM solutions across Iraq. Implementation, support, and consulting for businesses in Baghdad, Erbil & Basra.', 'osous' ) ),
    'microsoft-iraq.html' => array( 'title' => __( 'Microsoft Partner in Iraq – Microsoft 365 & Azure Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is a Microsoft Partner in Iraq offering Microsoft 365, Azure, Dynamics 365, and cloud migration services with expert local support.', 'osous' ) ),
    'microsoft-office-365-iraq.html' => array( 'title' => __( 'Microsoft 365 provider in Iraq, Office 365 services | Osous Al Taqnia', 'osous' ), 'description' => __( 'Transform your Iraqi business with Microsoft 365\'s enterprise capabilities. Access files anywhere, secure your data, and boost productivity with Osous Al Taqnia\'s expert deployment services.', 'osous' ) ),
    'mobile-app.html' => array( 'title' => __( 'mobile app', 'osous' ), 'description' => '' ),
    'motorola-iraq.html' => array( 'title' => __( 'Motorola Solutions Partner in Iraq | Authorized Reseller', 'osous' ), 'description' => __( 'Motorola Solutions Iraq delivered by a certified local partner in Baghdad, Basra, and Erbil. Secure video, command center, and safety systems.', 'osous' ) ),
    'multi-factor-authentication-iraq.html' => array( 'title' => __( 'Multi-Factor Authentication Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Secure your Iraqi business with Osous Al Taqnia\'s Multi-Factor Authentication solutions. Advanced protection beyond passwords with biometrics, OTPs & push notifications. Contact us today!', 'osous' ) ),
    'network-wifi-solutions-iraq.html' => array( 'title' => __( 'Network & Wi-Fi Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Boost connectivity with Osous Al Taqnia\'s custom network & Wi-Fi solutions for Iraqi businesses. Expert implementation, security & support for digital transformation. Contact us today!', 'osous' ) ),
    'next-generation-firewall-iraq.html' => array( 'title' => __( 'Next Generation Firewall Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your Iraqi business with Osous Al Taqnia\'s advanced next generation firewall solutions. Enterprise-grade cybersecurity tailored for Baghdad and all of Iraq. Contact us today!', 'osous' ) ),
    'partners.html' => array( 'title' => __( 'partners', 'osous' ), 'description' => '' ),
    'privacy-policy.html' => array( 'title' => __( 'privacy policy', 'osous' ), 'description' => '' ),
    'privileged-access-management-iraq.html' => array( 'title' => __( 'Privileged Access Management Services - PAM Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Secure your critical systems with Osous Al Taqnia\'s comprehensive Privileged Access Management solutions, tailored for Iraqi businesses. Reduce risk & enhance compliance.', 'osous' ) ),
    'reconciliation-system.html' => array( 'title' => __( 'Reconciliation System', 'osous' ), 'description' => '' ),
    'red-hat-iraq.html' => array( 'title' => __( 'Red Hat Partner in Iraq, Authorized Reseller | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is an authorized Red Hat Partner in Iraq, offering RHEL, OpenShift, Ansible Automation, and Hybrid Cloud solutions with local expertise.', 'osous' ) ),
    'sentinelone-iraq.html' => array( 'title' => __( 'SentinelOne Partner in Iraq - AI-Powered Cybersecurity | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your business in Iraq with SentinelOne XDR and autonomous AI threat prevention. Delivered by certified partner Osous Al Taqnia with full local support.', 'osous' ) ),
    'server-storage-iraq.html' => array( 'title' => __( 'Server Storage Solutions in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Boost productivity with scalable enterprise storage solutions from Osous Al Taqnia. DAS, NAS & SAN options with expert support for businesses across Iraq. Contact us today!', 'osous' ) ),
    'siem-soc-solutions-iraq.html' => array( 'title' => __( 'SIEM & SOC Service Provider in Iraq | Osous Al Taqnia', 'osous' ), 'description' => __( 'Protect your Iraqi business with Osous Al Taqnia\'s comprehensive SIEM & SOC solutions. 24/7 monitoring, threat detection & response from local security experts. Free consultation!"', 'osous' ) ),
    'sophos-iraq.html' => array( 'title' => __( 'Sophos Partner in Iraq, Authorized Sophos Reseller | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is an authorized Sophos Partner in Iraq. We deliver firewalls, endpoint security, email protection, and cloud-managed cybersecurity solutions.', 'osous' ) ),
    'structured-cabling-iraq.html' => array( 'title' => __( 'Structured Cabling Solutions in Iraq - Enterprise Network Infrastructure | Osous Al Taqnia', 'osous' ), 'description' => __( 'Upgrade your business with premium structured cabling solutions in Iraq. Osous Al Taqnia delivers certified expertise in data, fiber, WiFi, CCTV and AV cabling. Contact us today!', 'osous' ) ),
    'terms-conditions.html' => array( 'title' => __( 'Terms & Conditions', 'osous' ), 'description' => '' ),
    'veeam-iraq.html' => array( 'title' => __( 'Veeam Partner in Iraq – Backup & Replication Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is an authorized Veeam partner in Iraq offering backup, replication, and recovery solutions tailored to local businesses and IT environments.', 'osous' ) ),
    'vertiv-iraq.html' => array( 'title' => __( 'Vertiv Partner in Iraq - Power & Cooling Infrastructure | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is a certified Vertiv partner in Iraq delivering robust power, cooling, and data center solutions tailored to local industry needs.', 'osous' ) ),
    'virtualization-solutions-iraq.html' => array( 'title' => __( 'Virtualization Solutions in Iraq - Maximize IT Efficiency | Osous Al Taqnia', 'osous' ), 'description' => __( 'Optimize your Iraqi business with virtualization solutions that reduce costs by 50%, enhance continuity, and improve IT efficiency. Expert implementation by Osous Al Taqnia.', 'osous' ) ),
    'vmware-iraq.html' => array( 'title' => __( 'VMware Partner in Iraq – Virtualization & Cloud Solutions | Osous Al Taqnia', 'osous' ), 'description' => __( 'Osous Al Taqnia is a certified VMware partner in Iraq, offering vSphere, NSX, Horizon, vSAN, and hybrid cloud solutions with full local support.', 'osous' ) ),
    'website-design.html' => array( 'title' => __( 'website-design', 'osous' ), 'description' => '' )
	);
	$file = osous_current_file();
	return isset( $table[ $file ] ) ? $table[ $file ][ $key ] : '';
}

/* ---------- Titles and SEO tags ---------- */

/**
 * True when an SEO plugin prints the title and meta tags itself.
 */
function osous_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' );
}

/**
 * Browser tab title from the page table. SEO plugins filter this later and win.
 */
function osous_document_title( $title ) {
	$custom = osous_meta( 'title' );
	return '' !== $custom ? $custom : $title;
}
add_filter( 'pre_get_document_title', 'osous_document_title' );

/**
 * Description and social tags, left to the SEO plugin when one is active.
 */
function osous_meta_tags() {
	if ( osous_seo_plugin_active() ) {
		return;
	}
	$title       = wp_get_document_title();
	$description = osous_meta( 'description' );
	if ( '' !== $description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $description ) );
	}
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'osous_meta_tags', 1 );

/* ---------- Scripts and styles ---------- */

/**
 * Scripts that only some pages need, keyed by page file name.
 * Each entry: handle => array( file in js/, dependency, options as array( window variable, values ) or null ).
 */
function osous_page_scripts() {
	$split_slow = array( 'osousSplitSection', array( 'duration' => 0.6, 'ease' => 'power2.inOut' ) );
	$table      = array(
		'index.html'                         => array( 'osous-overlapping-cards' => array( 'overlapping-cards.js', 'osous-carousel', null ) ),
		'microsoft-office-365-iraq.html'     => array( 'osous-split-section' => array( 'split-section.js', 'osous-carousel', null ) ),
		'ict-solutions-iraq.html'            => array( 'osous-split-section' => array( 'split-section.js', 'osous-scrolltrigger', $split_slow ) ),
		'next-generation-firewall-iraq.html' => array( 'osous-split-section' => array( 'split-section.js', 'osous-scrolltrigger', $split_slow ) ),
		'e-commerce.html'                    => array( 'osous-list-scroll-images' => array( 'list-scroll-images.js', 'osous-scrolltrigger', null ) ),
		'mobile-app.html'                    => array( 'osous-list-scroll-images' => array( 'list-scroll-images.js', 'osous-scrolltrigger', null ) ),
		'website-design.html'                => array( 'osous-list-scroll-images' => array( 'list-scroll-images.js', 'osous-scrolltrigger', null ) ),
	);
	$file = osous_current_file();
	return isset( $table[ $file ] ) ? $table[ $file ] : array();
}

/**
 * Enqueues the page scripts whose dependency is (or is not) the carousel.
 * Scripts that follow the carousel load after it, the others before the shared list script,
 * which keeps the order the Webflow pages had.
 */
function osous_enqueue_page_scripts( $after_carousel ) {
	$js = get_template_directory_uri() . '/js/';
	foreach ( osous_page_scripts() as $handle => $script ) {
		list( $file, $dependency, $options ) = $script;
		if ( ( 'osous-carousel' === $dependency ) !== $after_carousel ) {
			continue;
		}
		wp_enqueue_script( $handle, $js . $file, array( $dependency ), OSOUS_VERSION, true );
		if ( $options ) {
			list( $var, $values ) = $options;
			wp_add_inline_script( $handle, 'window.' . $var . ' = ' . wp_json_encode( $values ) . ';', 'before' );
		}
	}
}

function osous_enqueue_assets() {
	$uri = get_template_directory_uri();
	$js  = $uri . '/js/';

	wp_enqueue_style( 'osous-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Sora:wght@200;600&display=swap', array(), null );
	wp_enqueue_style( 'osous-normalize', $uri . '/css/normalize.css', array(), OSOUS_VERSION );
	wp_enqueue_style( 'osous-webflow', $uri . '/css/webflow.css', array( 'osous-normalize' ), OSOUS_VERSION );
	wp_enqueue_style( 'osous-site', $uri . '/css/osous-al-taqnia.webflow.css', array( 'osous-webflow' ), OSOUS_VERSION );
	wp_enqueue_style( 'osous-theme', $uri . '/css/osous-theme.css', array( 'osous-site' ), OSOUS_VERSION );

	wp_enqueue_script( 'osous-jquery', $js . 'vendor/jquery-3.5.1.min.js', array(), '3.5.1', true );
	wp_enqueue_script( 'osous-webflow', $js . 'webflow.js', array( 'osous-jquery' ), OSOUS_VERSION, true );
	wp_enqueue_script( 'osous-gsap', $js . 'vendor/gsap.min.js', array(), '3.15.0', true );
	wp_enqueue_script( 'osous-scrolltrigger', $js . 'vendor/ScrollTrigger.min.js', array( 'osous-gsap' ), '3.15.0', true );
	wp_add_inline_script( 'osous-scrolltrigger', 'gsap.registerPlugin(ScrollTrigger);' );

	osous_enqueue_page_scripts( false );
	wp_enqueue_script( 'osous-list-scroll', $js . 'list-scroll.js', array( 'osous-scrolltrigger' ), OSOUS_VERSION, true );
	wp_enqueue_script( 'osous-swiper', $js . 'vendor/swiper-bundle.min.js', array(), '11.2.10', true );
	wp_enqueue_script( 'osous-carousel', $js . 'carousel.js', array( 'osous-swiper' ), OSOUS_VERSION, true );
	osous_enqueue_page_scripts( true );
}
add_action( 'wp_enqueue_scripts', 'osous_enqueue_assets' );


/* ---------- Contact form ---------- */

function osous_contact_notice() {
	if ( ! isset( $_GET['osous_sent'] ) ) {
		return;
	}
	if ( '1' === sanitize_text_field( wp_unslash( $_GET['osous_sent'] ) ) ) {
		echo '<p class="contact-notice contact-notice--ok">' . esc_html__( 'Thank you. Your message has been sent.', 'osous' ) . '</p>';
	} else {
		echo '<p class="contact-notice contact-notice--error">' . esc_html__( 'Sorry, your message could not be sent. Please try again.', 'osous' ) . '</p>';
	}
}

function osous_handle_contact() {
	$back  = home_url( '/contact/' );
	$nonce = isset( $_POST['osous_contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['osous_contact_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'osous_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'osous_sent', '0', $back ) );
		exit;
	}

	if ( ! osous_turnstile_passes() ) {
		wp_safe_redirect( add_query_arg( 'osous_sent', '0', $back ) );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$mobile  = isset( $_POST['mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['mobile'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || '' === $message || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'osous_sent', '0', $back ) );
		exit;
	}

	$to      = apply_filters( 'osous_contact_recipient', get_option( 'admin_email' ) );
	$subject = sprintf( 'Website enquiry from %s', $name );
	$body    = implode( "\n", array(
		'Name: ' . $name,
		'Company: ' . $company,
		'Email: ' . $email,
		'Mobile: ' . $mobile,
		'',
		$message,
	) );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	$sent    = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'osous_sent', $sent ? '1' : '0', $back ) );
	exit;
}
add_action( 'admin_post_nopriv_osous_contact', 'osous_handle_contact' );
add_action( 'admin_post_osous_contact', 'osous_handle_contact' );
