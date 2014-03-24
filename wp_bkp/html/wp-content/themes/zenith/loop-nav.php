<?php
/**
 * Loop Nav Template
 *
 * This template is used to show your your next/previous post links on singular pages and
 * the next/previous posts links on the home/posts page and archive pages.
 *
 * @package Zenith
 * @subpackage Functions
 * @version 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>

	<?php if ( is_attachment() ) : ?>

		<div class="loop-nav">
			<div class="loop-nav-inner">
				<?php previous_post_link( '%link', '<span class="previous">' . __( '<span class="meta-nav">&larr;</span> Return to entry', 'zenith' ) . '</span>' ); ?>
			</div><!-- .loop-nav-inner -->
		</div><!-- .loop-nav -->

	<?php elseif ( is_singular( 'post' ) ) : ?>

		<div class="loop-nav">
			<div class="loop-nav-inner">
				<?php previous_post_link( '%link', '<span class="previous">' . __( '<span class="meta-nav">&larr;</span> Previous', 'zenith' ) . '</span>' ); ?>
				<?php next_post_link( '%link', '<span class="next">' . __( 'Next <span class="meta-nav">&rarr;</span>', 'zenith' ) . '</span>' ); ?>
			</div><!-- .loop-nav-inner -->
		</div><!-- .loop-nav -->

	<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) ) : loop_pagination( array( 'prev_text' => __( '<span class="meta-nav">&larr;</span> Previous', 'zenith' ), 'next_text' => __( 'Next <span class="meta-nav">&rarr;</span>', 'zenith' ) ) ); ?>

	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous">' . __( '<span class="meta-nav">&larr;</span> Previous', 'zenith' ) . '</span>', 'nxtlabel' => '<span class="next">' . __( 'Next <span class="meta-nav">&rarr;</span>', 'zenith' ) . '</span>' ) ) ) : ?>

		<div class="loop-nav">
			<div class="loop-nav-inner">
				<?php echo $nav; ?>
			</div><!-- .loop-nav-inner -->
		</div><!-- .loop-nav -->

	<?php endif; ?>