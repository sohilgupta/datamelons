<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other templates call it somewhere near the bottom of the file. It is used mostly as a closing wrapper, which is opened with the header.php file. It also executes key functions needed by the theme, child themes, and plugins. 
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
					<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

					<?php do_atomic( 'close_main' ); // cinnamon_close_main ?>

				</div><!-- .main-inner -->

			</div><!-- #main -->

			<?php do_atomic( 'after_main' ); // cinnamon_after_main ?>

			<footer id="footer">

				<?php do_atomic( 'open_footer' ); // cinnamon_open_footer ?>

				<div class="footer-inner">
				
					<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

					<div class="footer-content">
						<?php hybrid_footer_content(); ?>
					</div><!-- .footer-content -->

					<?php do_atomic( 'footer' ); // cinnamon_footer ?>

				</div><!-- .footer-inner -->

				<?php do_atomic( 'close_footer' ); // cinnamon_close_footer ?>

			</footer><!-- #footer -->

			<?php do_atomic( 'after_footer' ); // cinnamon_after_footer ?>
		
		</div><!-- .container-inner -->

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // cinnamon_close_body ?>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>