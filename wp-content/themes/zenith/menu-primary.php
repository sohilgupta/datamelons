<?php
/**
 * Primary Menu Template
 *
 * Displays the Primary Menu if it has active menu items.
 *
 * @package Zenith
 * @subpackage Functions
 * @version 0.1
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); // zenith_before_menu_primary ?>

	<nav id="menu-primary" class="navbar">
	
		<div class="navbar-inner">
		
			<a class="btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<div class="nav-collapse">

				<?php do_atomic( 'open_menu_primary' ); // zenith_open_menu_primary ?>

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => 'nav', 'menu_id' => 'menu-primary-items', 'fallback_cb' => '', 'walker' => new Zenith_Walker_Nav_Menu() ) ); ?>

				<?php do_atomic( 'close_menu_primary' ); // zenith_close_menu_primary ?>
			
			</div><!-- .nav-collapse -->
			
		</div><!-- .navbar-inner -->

	</nav><!-- #menu-primary .menu-container -->

	<?php do_atomic( 'after_menu_primary' ); // zenith_after_menu_primary ?>

<?php endif; ?>