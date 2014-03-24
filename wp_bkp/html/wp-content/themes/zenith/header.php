<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package Zenith
 * @subpackage Template
 * @since 0.1
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?php hybrid_document_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); // wp_head ?>
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // zenith_open_body ?>

	<div id="container">

		<div class="container-inner">

			<?php do_atomic( 'before_header' ); // zenith_before_header ?>

			<header id="header">

				<?php do_atomic( 'open_header' ); // zenith_open_header ?>

				<div class="header-inner">

					<hgroup id="branding">
					
						<?php if ( hybrid_get_setting( 'zenith_logo_url' ) ) : ?>
							<a class="logo" href="<?php echo home_url(); ?>/" title="<?php echo bloginfo( 'name' ); ?>" rel="Home">
								<img src="<?php echo hybrid_get_setting( 'zenith_logo_url' ); ?>" alt="<?php echo bloginfo( 'name' ); ?>">
							</a>
						<?php endif; ?>

						<h1 id="site-title">
							<a href="<?php echo home_url(); ?>/" title="<?php echo bloginfo( 'name' ); ?>" rel="Home"><?php bloginfo( 'name' ); ?></a>
						</h1>

						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>

					</hgroup><!-- #branding -->
					
					<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

					<?php do_atomic( 'header' ); // zenith_header ?>

				</div><!-- .header-inner -->

				<?php do_atomic( 'close_header' ); // zenith_close_header ?>

			</header><!-- #header -->

			<?php do_atomic( 'before_main' ); // zenith_before_main ?>

			<div id="main">

				<div class="main-inner">

				<?php do_atomic( 'open_main' ); // zenith_open_main ?>