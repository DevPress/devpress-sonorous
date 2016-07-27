<?php
/**
 * Sonorous functions and definitions
 *
 * @package Sonorous
 */

/* Load the Hybrid Core framework. */
require_once( trailingslashit ( get_template_directory() ) . 'library/hybrid.php' );
$theme = new Hybrid(); // Part of the framework.

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'sonorous_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function sonorous_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix(); // Part of the framework, cannot be changed or prefixed.

	/* Add theme settings */
	if ( is_admin() )
	    locate_template( 'functions/admin.php', true );

	/* Add framework menus and sidebars */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary' ) );

	/* Add framework features */
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer' ) );

	/* Add framework extensions and other features */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'post-stylesheets' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/* Load resources into the theme. */
	add_action( 'wp_enqueue_scripts', 'sonorous_resources' );

	/* Load Sonorous Fonts */
	add_action( 'wp_enqueue_scripts', 'sonorous_fonts' );

	/* Modify excerpt more */
	add_filter('excerpt_more', 'sonorous_new_excerpt_more');

	/* Modify excerpt length */
	add_filter( 'excerpt_length', 'sonorous_excerpt_length' );

	/* Register new image sizes. */
	add_action( 'init', 'sonorous_register_image_sizes' );

	/* Set content width. */
	hybrid_set_content_width( 920 );

}

/**
 * Loads the theme scripts.
 *
 * @since 0.1
 */
function sonorous_resources() {

	wp_enqueue_script( 'sonorous-scripts', trailingslashit ( get_template_directory_uri() ) . 'js/sonorous.js', array( 'jquery' ), '20120819', true );

	wp_register_script( 'sonorous-isotope', trailingslashit ( get_template_directory_uri() ) . 'js/isotope.js', array( 'jquery' ), '20120822', true );

	wp_register_script( 'sonorous-isotope-infinitescroll', trailingslashit ( get_template_directory_uri() ) . 'js/isotope-infinitescroll.js', array( 'jquery' ), '20120822', true );

	wp_register_script( 'sonorous-backstretch', trailingslashit ( get_template_directory_uri() ) . 'js/backstretch.js', array( 'jquery' ), '1.2.8', true );
	wp_register_script( 'sonorous-backstretch-video', trailingslashit ( get_template_directory_uri() ) . 'js/backstretch.video.js', array( 'jquery' ), '1.1.2', true );

	if( is_page_template( 'page-template-home.php' ) ) {
		wp_enqueue_script( 'sonorous-isotope' );
	}

	if ( is_home() || is_archive() || is_search() ) {
		wp_enqueue_script( 'sonorous-isotope-infinitescroll' );
	}

	if ( is_page_template( 'page-template-home.php' ) || is_page_template( 'page-template-fullscreen-media.php' ) || is_page_template( 'page-template-background-fullscreen-media.php' ) || hybrid_has_post_template( 'post-template-fullscreen-media.php' ) || hybrid_has_post_template( 'post-template-background-fullscreen-media.php' ) ) {

		wp_enqueue_script( 'sonorous-backstretch' );

		if ( get_post_meta( get_the_ID() , 'video' ) || get_post_meta( get_the_ID() , 'Video' ) ) {
			wp_enqueue_script( 'sonorous-backstretch-video' );
		}

	}

}

/**
 * Loads theme fonts
 *
 * @since 0.2.0
 */
function sonorous_fonts() {
	$font_uri = '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic';
	wp_enqueue_style( 'sonorous-fonts', $font_uri, array(), null, 'screen' );
}

/**
 * Filters the excerpt more.
 *
 * @since 0.1
 */

function sonorous_new_excerpt_more( $more ) {
	return '&#133;';
}

/**
 * Filters the excerpt length.
 *
 * @since 0.1
 */

function sonorous_excerpt_length( $length ) {
	return 26;
}

/**
 * Registers additional image size 'sonorous-thumbnail'.
 *
 * @since 0.1
 */
function sonorous_register_image_sizes() {
	add_image_size( 'sonorous-thumbnail-tiny', 66, 50, true );
}

/**
 * Outputs URL of full size images.
 *
 * @since 0.1
 */

function sonorous_image_urls() {

	$children = array(
		'post_parent' => get_the_ID(),
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'include' => '',
		'exclude' => '',
		'numberposts' => -1,
		'offset' => ''
	);

	/* Get image attachments. If none, return. */
	$attachments = get_children( $children );

	if ( empty( $attachments ) )
		return '';

	$out = '';

	/* Loop through each attachment. */
	foreach ( $attachments as $id => $attachment ) {

		$out .= '"';
		$out .= wp_get_attachment_url( $id );
		$out .= '",';

	}

	echo $out;
}

/**
 * Theme updater.
 *
 * @since 0.1.1
 */
function devpress_theme_updater() {
	require( get_template_directory() . '/library/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'devpress_theme_updater' );