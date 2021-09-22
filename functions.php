<?php
/**
 * Cyt functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cyt
 */

if ( ! defined( '_CYT_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_CYT_VERSION', '1.0.2' );
}

if ( ! function_exists( 'cyt_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cyt_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on cyt, use a find and replace
		 * to change 'cyt' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cyt', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-top'       => esc_html__( 'Top Menu', 'cyt' ),
				'menu-primary'   => esc_html__( 'Primary Menu', 'cyt' ),
				'menu-secondary' => esc_html__( 'Secondary Menu', 'cyt' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'               => 80,
				'width'                => 200,
				'flex-height'          => false,
				'flex-width'           => true,
				'unlink-homepage-logo' => true,
				'header-text'          => array( 'site-title', 'site-description' ),
			)
		);

		/**
		 * Add support for responsive embeds.
		 */
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'cyt_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cyt_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cyt_content_width', 640 );
}
add_action( 'after_setup_theme', 'cyt_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cyt_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cyt' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cyt' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cyt_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cyt_scripts() {
	wp_enqueue_style( 'cyt-style', get_stylesheet_uri(), array(), _CYT_VERSION );
	wp_style_add_data( 'cyt-style', 'rtl', 'replace' );

	wp_enqueue_script( 'cyt-script', get_template_directory_uri() . '/js/index.js', array(), _CYT_VERSION, true );

	// Author page scripts.
	if ( is_page_template( 'page-templates/authors.php' ) ) :
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'leaflet', get_template_directory_uri() . '/js/leaflet-src.min.js', array( 'jquery' ), _CYT_VERSION, true );
		wp_enqueue_script( 'leaflet-providers', get_template_directory_uri() . '/js/leaflet-providers.min.js', array( 'leaflet' ), _CYT_VERSION, true );
		wp_enqueue_script( 'countries-geojson', get_template_directory_uri() . '/js/countries.geo.js', array( 'leaflet' ), _CYT_VERSION, true );

		wp_enqueue_style( 'leaflet-style', get_template_directory_uri() . '/leaflet.css', array(), _CYT_VERSION );
	endif;

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cyt_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register Custom Navigation Walker
 */
require_once get_template_directory() . '/inc/class-cyt-wp-nav-menu-walker.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for this theme.
 */
function cyt_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     => 'Advanced Custom Fields',
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'cyt',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => false,
	);

	tgmpa( $plugins, $config );
}
