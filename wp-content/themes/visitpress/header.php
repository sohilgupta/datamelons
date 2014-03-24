<?php
/**
 * The header template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
 <head> 
<?php global $visitpress_options;
foreach ($visitpress_options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE && isset($value['std'])) {
		$$value['id'] = $value['std'];
	}
	elseif (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
} ?>  
  <meta charset="<?php bloginfo( 'charset' ); ?>" /> 
  <meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0" />  
  <title><?php wp_title( '|', true, 'right' ); ?></title>
<?php if ($visitpress_favicon_url != ''){ ?>
	<link rel="shortcut icon" href="<?php echo $visitpress_favicon_url; ?>" />
<?php } ?>  
<?php wp_head(); ?>   
</head>
 
<body <?php body_class(); ?> id="top"> 
<div id="wrapper-header">
  <div id="header">
  <div id="header-title">
    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
  </div>
    <?php if ( has_nav_menu( 'header-menu' ) ) { ?>
    <div id="menu-container">
    <div id="menu">
      <?php wp_nav_menu( array( 'menu_id'=>'nav', 'theme_location'=>'header-menu' ) );?>
    </div>
    </div><?php } ?>
    <div class="search-box-outer">
      <div class="search-box-inner">
      <div class="search-box-shadow">
<?php get_search_form(); ?>
      </div>
      </div>
    </div>  
  </div>
</div>