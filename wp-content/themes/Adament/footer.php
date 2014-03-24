<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fabframe
 */
?>

	</div><!-- #content -->
	<?php if (!is_front_page()){ ?>
		<div id="bottom">
			<div class="container"> <div class="row">
				<?php if ( !function_exists('dynamic_sidebar')
				        || !dynamic_sidebar("Footer") ) : ?>  
				<?php endif; ?>
			</div></div>
		</div>
	<?php } ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container"><div class="row"> 
			<div class="site-info clearfix">
				<div class="fcred  col-md-6">
						Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>
				</div>	
				<div class="fcredr col-md-6">
						<?php fflink(); ?> | <a href="http://topwpthemes.com/<?php echo wp_get_theme(); ?>/" ><?php echo wp_get_theme(); ?> Theme</a> 	
				</div>	
			</div><!-- .site-info -->
		</div></div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>