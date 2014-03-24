<?php
/**
 *
 * Silverclean WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Footer Template
 *
 */ 
?>

	<?php  if (is_active_sidebar( 'footer-sidebar' ) ): ?>
		<div id="footer"><div class="container">
			<ul>
			<?php dynamic_sidebar( 'footer-sidebar' ); ?>
			</ul>
		</div></div>
	<?php endif; ?>

	<div id="sub-footer"><div class="container">
			<?php 
			/* You are free to modify or replace this by anything you like as per the terms of the GPL license */ ?>
			 Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
		<!--	 <?php printf( __( 'Proudly powered by', 'silverclean' ) ); ?><a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'silverclean' ); ?>"> Nitin Goyal</a>. Silverclean design by <a href="<?php echo esc_url( 'http://www.iceablethemes.com' ); ?>" title="<?php esc_attr_e( 'Iceablethemes', 'silverclean' ); ?>">Iceable Themes</a>.
-->
                         <?php printf( __( 'Proudly powered by', 'silverclean' ) ); ?> Nitin Goyal</a>.
</div>
	</div></div>
	<!-- End Footer -->

</div>
<!-- End main wrap -->

<?php wp_footer(); ?> 
<!-- End Document
================================================== -->
</body>
</html>