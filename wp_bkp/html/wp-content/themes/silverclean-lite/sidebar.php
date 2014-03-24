<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Sidebar Template
 *
 */
?>

<ul id="sidebar">
   <?php if ( ! dynamic_sidebar( 'Sidebar' ) ) : ?>
		<li id="meta" class="widget-container">
			<h3 class="widget-title"><?php _e( 'Meta', 'silverclean' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
		</li>
	<?php endif; ?>
</ul>