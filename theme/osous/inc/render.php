<?php
/**
 * Renders the content files: resolves their links, marks the current page, and filters
 * the markup through an allow-list before it is printed.
 *
 * @package Osous
 */

defined( 'ABSPATH' ) || exit;

/**
 * The tags and attributes the theme prints, as a wp_kses() allow-list: those the content
 * files use (generated from the content itself, content/allowed-html.json) and those the
 * theme's own templates add (responsive images, current-page and navigation labels).
 * Nothing the design needs is stripped and nothing else gets through.
 *
 * @return array<string, array<string, bool>>
 */
function osous_allowed_html(): array {
	static $allowed = null;
	if ( null === $allowed ) {
		$templates = array(
			'a'     => array( 'aria-current', 'aria-label', 'class', 'href', 'rel' ),
			'div'   => array( 'aria-hidden', 'aria-label', 'class', 'role' ),
			'img'   => array( 'alt', 'class', 'decoding', 'fetchpriority', 'height', 'loading', 'sizes', 'src', 'srcset', 'width' ),
			'input' => array( 'autocomplete', 'id', 'name', 'tabindex', 'type', 'value' ),
		);
		$allowed   = array();
		foreach ( array_merge_recursive( (array) osous_read_json( 'allowed-html.json' ), $templates ) as $tag => $attributes ) {
			$allowed[ $tag ] = array_fill_keys( (array) $attributes, true );
		}
	}
	return $allowed;
}

/**
 * CSS properties the content's inline styles use, on top of what WordPress allows.
 *
 * @param string[] $properties Properties WordPress allows in a style attribute.
 * @return string[]
 */
function osous_safe_style_css( array $properties ): array {
	return array_merge( $properties, array( 'opacity', 'transform', '-webkit-transform', '-moz-transform', '-ms-transform' ) );
}

/**
 * Filters markup through the content allow-list.
 *
 * @param string $markup HTML from a content file.
 * @return string Markup safe to print.
 */
function osous_kses( string $markup ): string {
	add_filter( 'safe_style_css', 'osous_safe_style_css' );
	$markup = wp_kses( $markup, osous_allowed_html() );
	remove_filter( 'safe_style_css', 'osous_safe_style_css' );
	return $markup;
}

/**
 * Replaces the content files' placeholders: {{theme}} with the theme's asset folder,
 * {{page:<key>}} with that page's current address, and " {{<name>}}" -- a class added
 * inside a class attribute -- with a variable, or with nothing when it is empty.
 *
 * @param string                $markup HTML from a content file.
 * @param array<string, string> $vars   Extra classes for " {{<name>}}" placeholders.
 */
function osous_resolve_placeholders( string $markup, array $vars = array() ): string {
	$markup = str_replace( '{{theme}}', esc_url( get_theme_file_uri( 'assets' ) ), $markup );
	$markup = (string) preg_replace_callback(
		'/\{\{page:([a-z0-9-]*)\}\}/',
		static fn( array $m ): string => esc_url( osous_page_url( $m[1] ) ),
		$markup
	);
	foreach ( $vars as $name => $value ) {
		$markup = str_replace( ' {{' . $name . '}}', '' === $value ? '' : ' ' . esc_attr( $value ), $markup );
	}
	return $markup;
}

/**
 * The address of what is being viewed, for marking links to it.
 */
function osous_current_url(): string {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_home() ) {
		return (string) get_permalink( (int) get_option( 'page_for_posts' ) );
	}
	if ( is_singular() ) {
		return (string) get_permalink( get_queried_object_id() );
	}
	return '';
}

/**
 * Marks every link to the current page the way the design styles it.
 *
 * @param string $markup HTML with resolved links.
 */
function osous_mark_current_links( string $markup ): string {
	$current = untrailingslashit( osous_current_url() );
	if ( '' === $current ) {
		return $markup;
	}
	$tags = new WP_HTML_Tag_Processor( $markup );
	while ( $tags->next_tag( 'a' ) ) {
		$href = $tags->get_attribute( 'href' );
		if ( is_string( $href ) && untrailingslashit( $href ) === $current ) {
			$tags->add_class( 'w--current' );
			$tags->set_attribute( 'aria-current', 'page' );
		}
	}
	return $tags->get_updated_html();
}

/**
 * A content file, ready to print.
 *
 * @param string                $relative Path below content/.
 * @param array<string, string> $vars     Extra classes for its " {{<name>}}" placeholders.
 * @param string[]              $slots    Slots it contains, each filled by its template part.
 * @return string Filtered markup.
 */
function osous_fragment( string $relative, array $vars = array(), array $slots = array() ): string {
	$markup = osous_resolve_placeholders( osous_read_content( $relative ), $vars );
	$markup = osous_mark_current_links( osous_contact_placeholders( $markup ) );
	// Slots are filled after the design's links are marked: their templates mark their
	// own current item (the blog pager's page), which a link to the blog would confuse.
	foreach ( $slots as $slot ) {
		$markup = str_replace( '{{' . $slot . '}}', osous_slot_markup( (string) $slot ), $markup );
	}
	return osous_kses( $markup );
}

/**
 * The markup of a slot: the dynamic part of a designed section, drawn by its template
 * part in template-parts/slots/.
 *
 * @param string $slot Slot name, e.g. "posts".
 */
function osous_slot_markup( string $slot ): string {
	if ( ! preg_match( '/^[a-z0-9-]+$/', $slot ) ) {
		return '';
	}
	ob_start();
	get_template_part( 'template-parts/slots/' . $slot );
	return (string) ob_get_clean();
}

/**
 * Whether a view shows the navigation and footer: every view does, except designs made
 * without them (the 404 page).
 *
 * @param array<string, mixed>|null $manifest The view's manifest, if it has one.
 */
function osous_has_chrome( ?array $manifest ): bool {
	return null === $manifest || ! empty( $manifest['chrome'] );
}

/**
 * Prints the parts that sit above every page: they are fixed or hidden, so their place in
 * the document does not affect the layout.
 *
 * @param array<string, mixed>|null $manifest The page's manifest, if it has one.
 */
function osous_render_site_chrome( ?array $manifest ): void {
	if ( ! osous_has_chrome( $manifest ) ) {
		return;
	}
	if ( ! empty( $manifest['preloader'] ) ) {
		echo osous_fragment( 'site/preloader.html' );
	}
	echo osous_fragment( 'site/navbar.html' );
	echo osous_fragment( 'site/whatsapp.html' );
}

/**
 * Whether the footer has been printed on this request.
 *
 * @param bool $printed Pass true to record that it has.
 */
function osous_footer_printed( bool $printed = false ): bool {
	static $done = false;
	if ( $printed ) {
		$done = true;
	}
	return $done;
}

/**
 * Prints the site footer.
 *
 * @param string $surface Class of the surface the footer sits on.
 */
function osous_render_footer( string $surface = 'c-surface-white' ): void {
	osous_footer_printed( true );
	echo osous_fragment( 'site/footer.html', array( 'surface' => $surface ) );
}

/**
 * Prints a page's tree: its sections, its layout wrappers and the footer in its place.
 *
 * @param array<int, array<string, mixed>> $items Items from a manifest.
 */
function osous_render_items( array $items ): void {
	foreach ( $items as $item ) {
		if ( isset( $item['wrapper'] ) ) {
			$wrapper = (array) $item['wrapper'];
			printf( '<%1$s class="%2$s">', tag_escape( (string) $wrapper['tag'] ), esc_attr( (string) $wrapper['class'] ) );
			osous_render_items( (array) $item['items'] );
			printf( '</%s>', tag_escape( (string) $wrapper['tag'] ) );
		} elseif ( isset( $item['section'] ) ) {
			echo osous_fragment( (string) $item['section'], array(), (array) ( $item['slots'] ?? array() ) );
		} elseif ( 'footer' === ( $item['part'] ?? '' ) ) {
			osous_render_footer( (string) ( $item['surface'] ?? '' ) );
		}
	}
}

/**
 * Body classes: the page's own design class on top of WordPress's.
 *
 * @param string[] $classes Classes WordPress adds.
 * @return string[]
 */
function osous_body_class( array $classes ): array {
	$manifest = osous_current_manifest();
	if ( ! empty( $manifest['body_class'] ) ) {
		$classes = array_merge( $classes, explode( ' ', (string) $manifest['body_class'] ) );
	}
	return $classes;
}
add_filter( 'body_class', 'osous_body_class' );

/**
 * The page numbers a pager shows: the first, the last, and those next to the current one,
 * with null where numbers are skipped.
 *
 * @param int $current Current page.
 * @param int $total   Number of pages.
 * @return array<int, int|null>
 */
function osous_pagination_numbers( int $current, int $total ): array {
	$shown = array_filter(
		array_unique( array( 1, $current - 1, $current, $current + 1, $total ) ),
		static fn( int $page ): bool => $page >= 1 && $page <= $total
	);
	sort( $shown );
	$numbers = array();
	$last    = 0;
	foreach ( $shown as $page ) {
		if ( $page - $last > 1 ) {
			$numbers[] = null;
		}
		$numbers[] = $page;
		$last      = $page;
	}
	return $numbers;
}
