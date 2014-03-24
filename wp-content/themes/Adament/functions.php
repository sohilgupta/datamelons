<?php
/**
 * fabframe functions and definitions
 *
 * @package fabframe
 */

include ( 'getplugins.php' );
include ( 'aq_resizer.php' );
include ( 'guide.php' );


/* Theme updater */
require 'updater.php';
$example_update_checker = new ThemeUpdateChecker(
	'Adament',                                            //Theme folder name, AKA "slug". 
	'http://www.fabthemes.com/versions/adament.json' //URL of the metadata file.
); 
 


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'fabframe_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fabframe_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fabframe, use a find and replace
	 * to change 'fabframe' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fabframe', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fabframe' ),
	) );

	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
/*
	add_theme_support( 'custom-background', apply_filters( 'fabframe_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
*/
}
endif; // fabframe_setup
add_action( 'after_setup_theme', 'fabframe_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function fabframe_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fabframe' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div class="botwid col-sm-6 col-md-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bothead">',
		'after_title' => '</h3>',
	));	
}
add_action( 'widgets_init', 'fabframe_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fabframe_scripts() {
	wp_enqueue_style( 'fabframe-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/bootstrap.css');
	wp_enqueue_style( 'bootstrap-glyphicons', get_template_directory_uri() . '/css/bootstrap-glyphicons.css');
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css');
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.php');
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/bootstrap.min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'superslides', get_template_directory_uri() . '/js/jquery.superslides.js', array(), '20120206', true );
	wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/jquery.slides.min.js', array(), '20120206', true );
	wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), '20120206', true );
	wp_enqueue_script( 'fabframe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'fabframe-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '20120206', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' );	}
}
add_action( 'wp_enqueue_scripts', 'fabframe_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom post type
 */
require get_template_directory() . '/inc/cpt.php';


/* Portfolio single */

function remove_shortcode_from_index($content) {
  if ( is_singular('portfolio') ) {
    $content = strip_shortcodes( $content );
  }
  return $content;
}
add_filter('the_content', 'remove_shortcode_from_index');


/* FLush rewrite */

function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );