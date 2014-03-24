<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package web2feel
 * @since web2feel 1.0
 */
?>

	</div><!-- #main .site-main -->
</div><!-- #page .hfeed .site -->

	<div id="bottom" >
	<div class="twit-feed">
		<?php get_template_part( 'twit-feed' ); ?>
	</div>
	
	<div class="clear"> </div>
	</div>



	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="fcred">
			Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
			<?php fflink(); ?> | <a href="http://topwpthemes.com/<?php echo wp_get_theme(); ?>/" ><?php echo wp_get_theme(); ?> Theme</a> 	
			</div>		
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
	
</div><!-- outer-->

<?php wp_footer(); ?>

</body>
</html>