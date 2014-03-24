<?php
/**
 * Primary Sidebar Template
 *
 * Displays widgets for the Primary dynamic sidebar if any have been added to the sidebar through the widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Zenith
 * @subpackage Functions
 * @version 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( is_active_sidebar( 'primary' ) ) : ?>

	<?php do_atomic( 'before_sidebar_primary' ); // zenith_before_sidebar_primary ?>

	<div id="sidebar-primary" class="sidebar">
		<div class="sidebar-inner">

			<?php do_atomic( 'open_sidebar_primary' ); // zenith_open_sidebar_primary ?>

			<?php dynamic_sidebar( 'primary' ); ?>

			<?php do_atomic( 'close_sidebar_primary' ); // zenith_close_sidebar_primary ?>
		
		</div><!-- .sidebar-inner -->

	</div><!-- #sidebar-primary -->

	<?php do_atomic( 'after_sidebar_primary' ); // zenith_after_sidebar_primary ?>

<?php endif; ?>