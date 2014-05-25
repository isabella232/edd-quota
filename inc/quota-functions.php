<?php
/**
 * Quota functions and definitions
 */
 

/** ===============
 * Constants
 */
define( 'QUOTA_NAME', 'Quota' );
define( 'QUOTA_AUTHOR', 'Sean Davis' );
define( 'QUOTA_VERSION', '1.2' );
define( 'QUOTA_HOME', 'https://easydigitaldownloads.com' );
define( 'QUOTA_DIR', get_template_directory() );
define( 'QUOTA_DIR_URI', get_template_directory_uri() );
define( 'QUOTA_STYLESHEET', get_stylesheet_uri() );
define( 'QUOTA_PATH_INC', QUOTA_DIR . '/inc' );
define( 'QUOTA_PATH_LANGUAGES', QUOTA_DIR . '/languages' );
define( 'QUOTA_PATH_UPDATER', QUOTA_PATH_INC . '/updater' );



/** ===============
 * we need this stuff to survive... and "function" :)
 */
require QUOTA_PATH_INC . '/quota-options.php';
require QUOTA_PATH_INC . '/edd-functions.php';
require QUOTA_PATH_INC . '/content-functions.php';
require QUOTA_PATH_INC . '/customizer-functions.php';
require QUOTA_PATH_UPDATER . '/updater-functions.php';



/** ===============
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */
	
	
	
/** ===============
 * Sets up theme defaults and registers support for various WordPress features.
 */
if ( ! function_exists( 'quota_setup' ) ) :

	function quota_setup() {
	
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Quota, use a find and replace
		 * to change 'quota' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'quota', QUOTA_PATH_LANGUAGES );
	
		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );
	
		/**
		 * Enable support for Post Thumbnails on posts and pages
		 */
		add_theme_support( 'post-thumbnails' );
		
		// hard crop store front and taxonomy product images for downloads
		add_image_size( 'product-image', 307, 191, true );
	
		/**
		 * Quota uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'header' => __( 'Header Menu', 'quota' ),
		) );
	}
endif; 
add_action( 'after_setup_theme', 'quota_setup' );



/** ===============
 * Enqueue scripts and styles
 */
function quota_scripts() {
	wp_register_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,700italic,800italic,800,300,700' );
	wp_enqueue_style( 'quota-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'quota-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130601', true );
	
	if ( ! is_admin() ) {
		wp_enqueue_style( 'google-fonts' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quota_scripts' );