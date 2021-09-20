<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package cyt
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cyt_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cyt_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cyt_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'cyt_pingback_header' );

/**
 * Add priority inline css
 */
function cyt_inline_styles() {
	echo ( '<style>
		.custom-logo {
				width: auto;
				min-height: 50px;
		}
		</style>' );
}
add_action( 'wp_head', 'cyt_inline_styles', 10 );


/**
 * Remove prefix from archive titles.
 */
add_filter( 'get_the_archive_title_prefix', '__return_false' );
