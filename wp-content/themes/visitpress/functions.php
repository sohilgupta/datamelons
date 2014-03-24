<?php
/**
 * VisitPress functions and definitions.
 * @package VisitPress
 * @since VisitPress 1.0
*/

/**
 * VisitPress theme variables.
 *  
*/    
$visitpress_themename = "VisitPress";									//Theme Name
$visitpress_themever = "1.0.6";										//Theme version
$visitpress_shortname = "visitpress";											//Shortname 
$visitpress_manualurl = get_template_directory_uri() . '/docs/documentation.html';	//Manual Url
// Set path to VisitPress Framework and theme specific functions
$visitpress_be_path = get_template_directory() . '/functions/be/';	//BackEnd Path
$visitpress_fe_path = get_template_directory() . '/functions/fe/';	//FrontEnd Path 
$visitpress_be_pathimages = get_template_directory_uri() . '/functions/be/images';		//BackEnd Path
$visitpress_fe_pathimages = get_template_directory_uri() . '';		 //FrontEnd Path
//Include Framework [BE] 
require_once ($visitpress_be_path . 'fw-setup.php');					// Init 
require_once ($visitpress_be_path . 'fw-options.php');					// Framework Init  
// Include Theme specific functionality [FE] 
require_once ($visitpress_fe_path . 'headerdata.php');					// Include css and js
require_once ($visitpress_fe_path . 'library.php');					// Include library, functions

/**
 * VisitPress theme basic setup.
 *  
*/
function visitpress_setup() {
	// Makes VisitPress available for translation.
	load_theme_textdomain( 'visitpress', get_template_directory() . '/languages' );
	// This theme styles the visual editor to resemble the theme style.
  add_editor_style( 'editor-style.css' );
  // Adds RSS feed links to <head> for posts and comments.  
	add_theme_support( 'automatic-feed-links' );
	// This theme supports custom background color.
	$defaults = array(
	'default-color'          => '', 
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '' );  
  add_theme_support( 'custom-background', $defaults );
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 640, 9999 );
}
add_action( 'after_setup_theme', 'visitpress_setup' );

/**
 * Enqueues scripts and styles for front-end.
 *
*/
function visitpress_scripts_styles() {
	global $wp_styles;
	// Adds JavaScript
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script( 'placeholders', get_template_directory_uri() . '/js/placeholders.js', array(), '2.1.0', true );
    wp_enqueue_script( 'scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'selectnav', get_template_directory_uri() . '/js/selectnav.js', array(), '0.1', true );
    wp_enqueue_script( 'responzive', get_template_directory_uri() . '/js/responzive.js', array(), '1.0', true );
	// Loads the main stylesheet.
	  wp_enqueue_style( 'visitpress-style', get_stylesheet_uri() ); 
}
add_action( 'wp_enqueue_scripts', 'visitpress_scripts_styles' ); 

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 *  
*/
if ( ! isset( $content_width ) )
	$content_width = 640;
  
/**
 * Creates a nicely formatted and more specific title element text.
 *  
*/
function visitpress_wp_title( $title, $sep ) {
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	return $title;
}
add_filter( 'wp_title', 'visitpress_wp_title', 10, 2 );
  
/**
 * Register our menus.
 *
 */
function visitpress_register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu', 'visitpress' ),
      'sidebar-menu' => __( 'Sidebar Menu', 'visitpress' )
    )
  );
}
add_action( 'after_setup_theme', 'visitpress_register_my_menus' );

/**
 * Register our sidebars and widgetized areas.
 *
*/
function visitpress_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'visitpress' ),
		'id' => 'sidebar-1',
		'description' => __( 'Right sidebar which appears on posts and pages.', 'visitpress' ),
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<p class="sidebar-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer left widget', 'visitpress' ),
		'id' => 'sidebar-2',
		'description' => __( 'Left widget from the footer widget area. Please insert only one widget to this area.', 'visitpress' ),
		'before_widget' => '<div class="footer-widget" id="footer-widget-1">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-widget-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer middle widget', 'visitpress' ),
		'id' => 'sidebar-3',
		'description' => __( 'Middle widget from the footer widget area. Please insert only one widget to this area.', 'visitpress' ),
		'before_widget' => '<div class="footer-widget" id="footer-widget-2">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-widget-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer right widget', 'visitpress' ),
		'id' => 'sidebar-4',
		'description' => __( 'Right widget from the footer widget area. Please insert only one widget to this area.', 'visitpress' ),
		'before_widget' => '<div class="footer-widget" id="footer-widget-3">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-widget-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer notices', 'visitpress' ),
		'id' => 'sidebar-5',
		'description' => __( 'The line for copyright and other notices below the footer widget area.', 'visitpress' ),
		'before_widget' => '<div class="footer-signature">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
  register_sidebar( array(
		'name' => __( 'Home page slideshow', 'visitpress' ),
		'id' => 'sidebar-6',
		'description' => __( 'The area for Cyclone Slider Widget which displays a slideshow on your home page.', 'visitpress' ),
		'before_widget' => '<div class="slideshow-home">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'visitpress_widgets_init' );

if ( ! function_exists( 'visitpress_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
*/
function visitpress_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="navigation-headline section-heading"><?php _e( 'Post navigation', 'visitpress' ); ?></h3>
			<p class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'visitpress' ) ); ?></p>
			<p class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'visitpress' ) ); ?></p>
		</div>
	<?php endif;
}
endif;

/**
 * Displays navigation to next/previous posts on single posts pages.
 *
*/
function visitpress_prev_next($nav_id) { ?>
<div id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
  <h3 class="navigation-headline section-heading"><?php _e( 'Post navigation', 'visitpress' ); ?></h3>
	<p class="nav-previous"><?php previous_post_link('%link', __( '&larr; Previous post' , 'visitpress' )); ?></p>
	<p class="nav-next"><?php next_post_link('%link', __( 'Next post &rarr;' , 'visitpress' )); ?></p>
</div>
<?php } 

if ( ! function_exists( 'visitpress_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
*/
function visitpress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'visitpress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'visitpress' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<span><b class="fn">%1$s</b> %2$s</span>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( '(Post author)', 'visitpress' ) . '</span>' : ''
					);
					printf( '<time datetime="%2$s">%3$s</time>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						// translators: 1: date, 2: time
						sprintf( __( '%1$s at %2$s', 'visitpress' ), get_comment_date(''), get_comment_time() )
					);
				?>
			</div><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'visitpress' ); ?></p>
			<?php endif; ?>

			<div class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'visitpress' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'visitpress' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch;
}
endif;

/**
 * Function for rendering CSS3 features in IE.
 *
*/
add_filter( 'wp_head' , 'visitpress_pie' );
function visitpress_pie() { ?>
<!--[if IE]>
<style type="text/css" media="screen">
#wrapper-header, .search-box-outer, .search-box-inner, .scroll-top-outer, .scroll-top-inner, #content, .widget-area, .post-entry .publish-date, .sticky {
        behavior: url("<?php echo get_template_directory_uri() . '/css/pie/PIE.php'; ?>");
        zoom: 1;
}
</style>
<![endif]-->
<?php }

/**
 * Include the TGM_Plugin_Activation class.
 *  
*/
require_once get_template_directory() . '/class-tgm-plugin-activation.php'; 
add_action( 'tgmpa_register', 'visitpress_my_theme_register_required_plugins' );

function visitpress_my_theme_register_required_plugins() {

$plugins = array(
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'source'   => get_template_directory_uri() . '/plugins/breadcrumb-navxt.zip',
			'required' => false,
		),
		array(
			'name'     => 'Cyclone Slider 2',
			'slug'     => 'cyclone-slider-2',
			'source'   => get_template_directory_uri() . '/plugins/cyclone-slider-2.zip',
			'required' => false,
		),
	);
 
 
$config = array(
		'domain'       => 'visitpress',
    'menu'         => 'install-my-theme-plugins',
		'strings'      	 => array(
		'page_title'             => __( 'Install Required Plugins', 'visitpress' ),
		'menu_title'             => __( 'Install Plugins', 'visitpress' ),
		'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', 'visitpress' ),
		'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', 'visitpress' ),
		'button'                 => __( 'Install %s Now', 'visitpress' ),
		'installing'             => __( 'Installing Plugin: %s', 'visitpress' ),
		'oops'                   => __( 'Something went wrong with the plugin API.', 'visitpress' ), // */
		'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', 'visitpress' ),
		'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'visitpress' ),
		'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', 'visitpress' ),
		'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'visitpress' ),
		'return'                 => __( 'Return to Required Plugins Installer', 'visitpress' ),
),
); 
tgmpa( $plugins, $config ); 
}   
?>