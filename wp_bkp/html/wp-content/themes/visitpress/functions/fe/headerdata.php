<?php
/**
 * Headerdata of Theme options.
 * @package VisitPress
 * @since VisitPress 1.0
*/  
global $visitpress_options;
foreach ($visitpress_options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE && isset($value['std'])) {
		$$value['id'] = $value['std'];
	}
	elseif (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
}


// additional js and css
if(	!is_admin()){
function visitpress_fonts_include () {
// Google Fonts
$bodyfont = get_option('visitpress_body_google_fonts');
$headingfont = get_option('visitpress_headings_google_fonts');
$descriptionfont = get_option('visitpress_description_google_fonts');
$headlinefont = get_option('visitpress_headline_google_fonts');
$postentryfont = get_option('visitpress_postentry_google_fonts');
$sidebarfont = get_option('visitpress_sidebar_google_fonts');

$fonturl = "http://fonts.googleapis.com/css?family=";

$bodyfonturl = $fonturl.$bodyfont;
$headingfonturl = $fonturl.$headingfont;
$descriptionfonturl = $fonturl.$descriptionfont;
$headlinefonturl = $fonturl.$headlinefont;
$postentryfonturl = $fonturl.$postentryfont;
$sidebarfonturl = $fonturl.$sidebarfont;
	// Google Fonts
     if ($bodyfont != 'default' && $bodyfont != ''){
      wp_enqueue_style('google-font1', $bodyfonturl); 
		 }
     if ($headingfont != 'default' && $headingfont != ''){
      wp_enqueue_style('google-font2', $headingfonturl);
		 }
     if ($descriptionfont != 'default' && $descriptionfont != ''){
      wp_enqueue_style('google-font3', $descriptionfonturl);
		 }
     if ($headlinefont != 'default' && $headlinefont != ''){
      wp_enqueue_style('google-font4', $headlinefonturl); 
		 }
     if ($postentryfont != 'default' && $postentryfont != ''){
      wp_enqueue_style('google-font5', $postentryfonturl); 
		 }
     if ($sidebarfont != 'default' && $sidebarfont != ''){
      wp_enqueue_style('google-font6', $sidebarfonturl);
		 }
}
add_action( 'wp_enqueue_scripts', 'visitpress_fonts_include' );
}

// additional js and css
function visitpress_css_include () {
	if (get_option('visitpress_css') == 'Tuscany (default)' ){
			wp_enqueue_style('visitpress-style', get_stylesheet_uri());
		}

		if (get_option('visitpress_css') == 'Paris' ){
			wp_enqueue_style('style-paris', get_template_directory_uri().'/css/paris.css');
		}

		if (get_option('visitpress_css') == 'Amsterdam' ){
			wp_enqueue_style('style-amsterdam', get_template_directory_uri().'/css/amsterdam.css');
		}
}
add_action( 'wp_enqueue_scripts', 'visitpress_css_include' );

// Display sidebar
function visitpress_display_sidebar() {
    $display_sidebar = get_option('visitpress_display_sidebar'); 
		if ($display_sidebar == 'Hide') { ?>
		<?php _e('#wrapper-main #sidebar, #wrapper-header #header .search-box-outer { display: none; } #wrapper-main #content { width: 910px; }', 'visitpress'); ?>
<?php } 
}

// Body font and color
function visitpress_get_body_font() {
    $bodyfont = get_option('visitpress_body_google_fonts'); 
		if ($bodyfont != 'default' && $bodyfont != '') { ?>
		<?php _e('html body, #searchform #s { font-family: "', 'visitpress'); ?><?php echo $bodyfont ?><?php _e('", Arial, Helvetica, sans-serif;}', 'visitpress'); ?>
<?php } 
}

// Page title width
function visitpress_get_page_title_width() {
    $page_title_width = get_option('visitpress_page_title_width'); 
		if ($page_title_width != '') { ?>
		<?php _e('#header #header-title { max-width: ', 'visitpress'); ?><?php echo $page_title_width ?><?php _e(';}', 'visitpress'); ?>
<?php } 
}

// Header menu width
function visitpress_get_header_menu_width() {
    $header_menu_width = get_option('visitpress_header_menu_width'); 
		if ($header_menu_width != '') { ?>
		<?php _e('#header #menu-container { max-width: ', 'visitpress'); ?><?php echo $header_menu_width ?><?php _e(';}', 'visitpress'); ?>
<?php } 
}

// Header menu format
function visitpress_get_header_menu_format() {
    $header_menu_format = get_option('visitpress_header_menu_format'); 
		if ($header_menu_format == 'Drop-down') { ?>
		<?php _e('.js .selectnav {display: block; width: 100%; background-color: #f0f0f0;} .js #nav {display: none;}', 'visitpress'); ?>
<?php } 
}

// Site title font
function visitpress_get_headings_google_fonts() {
    $headingfont = get_option('visitpress_headings_google_fonts'); 
		if ($headingfont != 'default' && $headingfont != '') { ?>
		<?php _e('#header .site-title { font-family: "', 'visitpress'); ?><?php echo $headingfont ?><?php _e('", "Palatino Linotype", "Book Antiqua", Palatino, serif;}', 'visitpress'); ?>
<?php } 
}

// Site description font and color
function visitpress_get_description_font() {
    $descriptionfont = get_option('visitpress_description_google_fonts'); 
    if ($descriptionfont != 'default' && $descriptionfont != '') { ?>
    <?php _e('#wrapper-header #header .site-description {font-family: "', 'visitpress'); ?><?php echo $descriptionfont ?><?php _e('", "Palatino Linotype", "Book Antiqua", Palatino, serif; }', 'visitpress'); ?>
<?php } 
}

// Page/post headlines font and color
function visitpress_get_headlines_font() {
    $headlinefont = get_option('visitpress_headline_google_fonts');
    if ($headlinefont != 'default' && $headlinefont != '') { ?>
		<?php _e('#content h1, #content h2, #content h3, #content h4, #content h5, #content h6 { font-family: "', 'visitpress'); ?><?php echo $headlinefont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'visitpress'); ?>
<?php } 
}

// Post entry font
function visitpress_get_postentry_font() {
    $postentryfont = get_option('visitpress_postentry_google_fonts'); 
		if ($postentryfont != 'default' && $postentryfont != '') { ?>
		<?php _e('#content .post-entry h2 { font-family: "', 'visitpress'); ?><?php echo $postentryfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'visitpress'); ?>
<?php } 
}

// Sidebar widget headlines font and color
function visitpress_get_sidebar_widget_font() {
    $sidebarfont = get_option('visitpress_sidebar_google_fonts');
    if ($sidebarfont != 'default' && $sidebarfont != '') { ?>
		<?php _e('#wrapper-main .widget-area #sidebar-navigation .sidebar-headline, #wrapper-main .widget-area .sidebar-widget .sidebar-headline { font-family: "', 'visitpress'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'visitpress'); ?>
<?php } 
}

// Footer widget headlines font and color
function visitpress_get_footer_widget_font() {
    $sidebarfont = get_option('visitpress_sidebar_google_fonts');
    if ($sidebarfont != 'default' && $sidebarfont != '') { ?>
		<?php _e('body #wrapper-footer #footer .footer-widget-headline { font-family: "', 'visitpress'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'visitpress'); ?>
<?php } 
}


// User defined CSS.
function visitpress_get_own_css() {
    $own_css = get_option('visitpress_own_css'); 
		if ($own_css != '') { ?>
		<?php echo $own_css ?>
<?php } 
}

// Display custom CSS.
function visitpress_custom_styles() { ?>
<?php echo ("<style type='text/css'>"); ?>
<?php visitpress_get_own_css(); ?>
<?php visitpress_get_page_title_width(); ?>
<?php visitpress_get_header_menu_width(); ?>
<?php visitpress_get_header_menu_format(); ?>
<?php visitpress_display_sidebar(); ?>
<?php visitpress_get_body_font(); ?>
<?php visitpress_get_headings_google_fonts(); ?>
<?php visitpress_get_description_font(); ?>
<?php visitpress_get_headlines_font(); ?>
<?php visitpress_get_postentry_font(); ?>
<?php visitpress_get_sidebar_widget_font(); ?> 
<?php visitpress_get_footer_widget_font(); ?>
<?php echo ("</style>"); ?>
<?php
} 
add_action('wp_enqueue_scripts', 'visitpress_custom_styles');	?>