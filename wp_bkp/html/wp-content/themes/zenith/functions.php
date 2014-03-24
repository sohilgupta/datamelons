<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and sets up the supported features, default actions, and default filters.  If making customizations, users should create a child theme and make changes to its functions.php file (not this one).  Friends don't let friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package Zenith
 * @subpackage Functions
 * @version 0.1
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the Hybrid Core framework. */
require_once( trailingslashit ( get_template_directory() ) . 'library/hybrid.php' );
$theme = new Hybrid(); // Part of the framework.

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'zenith_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function zenith_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix(); // Part of the framework, cannot be changed or prefixed.
	
	/* Add theme settings */
	if ( is_admin() )
	    locate_template( 'includes/admin.php', true );
		
	require_once( trailingslashit( THEME_DIR ) . 'includes/menu-walker.php' );

	/* Add framework menus and sidebars */
	add_theme_support( 'hybrid-core-menus', array(
		'primary',
		'subsidiary'
		) );
	add_theme_support( 'hybrid-core-sidebars', array(
		'primary'
		) );

	/* Add framework features */
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer' ) );

	/* Add framework extensions and other features */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'post-stylesheets' );
	add_theme_support( 'theme-layouts', array(
		'1c',
		'2c-r'
		) );
	
	/* Load resources into the theme. */
	add_action( 'wp_enqueue_scripts', 'zenith_resources' );
	
	if( class_exists( 'RGForms' ) && class_exists( 'RGFormsModel' ) ) {
		/* Load resources for pages using Gravity Forms */
		add_action( 'gform_enqueue_scripts', 'zenith_resources_gform');
	}
	
	/* Modify excerpt more */
	add_filter( 'excerpt_more', 'zenith_new_excerpt_more' );
	
	/* Modify excerpt length */
	add_filter( 'excerpt_length', 'zenith_excerpt_length' );
	
	/* Register new image sizes. */
	add_action( 'init', 'zenith_register_image_sizes' );

	/* Set content width. */
	hybrid_set_content_width( 640 );
	
	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'zenith_embed_defaults' ); // Set default widths to use when inserting media files
	
	/* Zenith theme layouts */
	add_filter( 'template_redirect', 'zenith_theme_layout' );
	
	/* Conditions to disable sidebars */
	add_filter( 'sidebars_widgets', 'zenith_disable_sidebars' );
	
	/* Add support for a custom background. */
	add_theme_support( 
		'custom-background',
		array(
			'default-color' => '322219',
			'wp-head-callback' => 'zenith_custom_background_callback'
		)
	);
	
	/* Add default theme settings */
	add_filter( "{$prefix}_default_theme_settings", 'zenith_default_theme_settings');
	
	/* Print scripts on selected templates */
	add_action( 'wp_footer', 'zenith_footer_scripts' );

}

/**
 * Loads the theme scripts.
 *
 * @since 0.1
 */
function zenith_resources() {

	wp_enqueue_script( 'zenith-scripts', trailingslashit ( get_template_directory_uri() ) . 'js/zenith.js', array( 'jquery' ), '20120831', true );
	
	if ( is_page_template( 'page-template-showcase.php' ) ) {
		wp_enqueue_script( 'jquery-ui-tabs' );
		}

}

/**
 * Load Gravity Form styles.
 *
 * @since 0.1.0
 */

function zenith_resources_gform() {

	wp_enqueue_style( 'zenith_gforms', trailingslashit ( get_template_directory_uri() ) . 'css/gravity-forms.css', false, '20121231', 'all' );

}

/**
 * Filters the excerpt more.
 *
 * @since 0.1
 */

function zenith_new_excerpt_more( $more ) {
	return '&#133;';
}

/**
 * Filters the excerpt length.
 *
 * @since 0.1
 */

function zenith_excerpt_length( $length ) {
	return 40;
}

/**
 * Registers additional image sizes.
 *
 * @since 0.1.0
 */
function zenith_register_image_sizes() {

	add_image_size( 'zenith-small', 200, 200, true );
	add_image_size( 'zenith-large', 618, 380, true );

}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly expand the full width on video pages.  This function overwrites what the $content_width variable handles with context-based widths.
 *
 * @since 0.1
 */
function zenith_embed_defaults( $args ) {

	$args['width'] = 640;

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();

		if ( 'layout-1c' == $layout ) {
			$args['width'] = 840;
		}

	}

	return $args;
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 * @access public
 * @return void
 */
function zenith_theme_layout() {

	if ( !is_active_sidebar( 'primary' ) || is_page_template( 'page-template-showcase.php' ) )
		add_filter( 'get_theme_layout', 'zenith_theme_layout_one_column' );
	elseif ( 'layout-default' == theme_layouts_get_layout() )
		add_filter( 'get_theme_layout', 'zenith_theme_layout_global' );

}

/**
 * Returns the global layout selected by the user.
 *
 * @since 0.1
 * @access public
 * @param string $layout
 * @return string
 */
function zenith_theme_layout_global( $layout ) {
	return 'layout-' . hybrid_get_setting( 'zenith_global_layout' );
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.1
 * @access public
 * @param string $layout The layout of the current page.
 * @return string
 */
function zenith_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Disables sidebars based on templates.
 *
 * @since 0.1.0
 */
function zenith_disable_sidebars( $sidebars_widgets ) {

	global $wp_query;

	if( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;	
		}

	}

	return $sidebars_widgets;
}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What 
 * happens is the theme's background image hides the user-selected background color.  If a user selects a 
 * background image, we'll just use the WordPress custom background callback.
 *
 * @since 0.1.0
 * @access public
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @link http://core.trac.wordpress.org/ticket/16919
 * @return void
 */
function zenith_custom_background_callback() {

	// $background is the saved custom image or the default image.
	$background = get_background_image();

	// $color is the saved custom color or the default image.
	$color = get_background_color();

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}

?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php

}

/**
 * Adds custom default theme settings.
 *
 * @since 0.1
 * @access public
 * @param array $settings The default theme settings.
 * @return array $settings
 */

function zenith_default_theme_settings( $settings ) {

	$settings['zenith_logo_url'] = esc_url( trailingslashit( get_template_directory_uri() ) . 'images/logo-zenith.png' );
	$settings['zenith_global_layout'] = 'default';
	$settings['zenith_featured_posts'] = '5';
	$settings['zenith_recent_posts'] = '4';

	return $settings;

}

/**
 * Load scripts on selected templates
 *
 * @since 0.1
 */

function zenith_footer_scripts() { 

	if( is_page_template( 'page-template-showcase.php' ) ) : ?>

		<script type='text/javascript'>
			var $j = jQuery.noConflict();

			$j(document).ready( function() {
				$j('.ui-tabs').tabs();
			});
		</script>
	
	<?php endif;

}

?>