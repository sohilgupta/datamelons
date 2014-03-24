<?php
/**
 * Subsidiary Menu Template
 *
 * Displays the subsidiary Menu if it has active menu items.
 *
 * @package Zenith
 * @subpackage Functions
 * @version 0.1
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
if ( has_nav_menu( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_menu_subsidiary' ); // zenith_before_menu_subsidiary ?>

	<nav id="menu-subsidiary" class="navbar dropup">
	
		<div class="navbar-inner">
		
			<a class="btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<div class="nav-collapse">

				<?php do_atomic( 'open_menu_subsidiary' ); // zenith_open_menu_subsidiary ?>

				<?php wp_nav_menu( array( 'theme_location' => 'subsidiary', 'container_class' => 'menu', 'menu_class' => 'nav', 'menu_id' => 'menu-subsidiary-items', 'fallback_cb' => '' ) ); ?>

				<?php do_atomic( 'close_menu_subsidiary' ); // zenith_close_menu_subsidiary ?>
			
			</div><!-- .nav-collapse -->
			
		</div><!-- .navbar-inner -->

	</nav><!-- #menu-subsidiary .menu-container -->

	<?php do_atomic( 'after_menu_subsidiary' ); // zenith_after_menu_subsidiary ?>

<?php endif; ?>