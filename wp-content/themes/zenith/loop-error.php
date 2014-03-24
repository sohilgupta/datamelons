<?php
/**
 * Loop Error Template
 *
 * Displays an error message when no posts are found.
 *
 * @package Zenith
 * @subpackage Template
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

?>

	<article id="post-0" class="<?php hybrid_entry_class(); ?>">
	
		<header class="entry-header">
			<h2 class="entry-title"><?php _e( 'Not Found', 'zenith' ); ?></h2>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no entries were found.', 'zenith' ); ?></p>
		</div><!-- .entry-content -->

	</article><!-- .hentry .error -->