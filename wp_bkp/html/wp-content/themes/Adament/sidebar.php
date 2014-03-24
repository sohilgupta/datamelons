<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package fabframe
 */
?>
	<div id="secondary" class="widget-area col-md-4" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
		<?php get_template_part( 'sponsors' ); ?>
	</div><!-- #secondary -->
