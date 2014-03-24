<?php
/**
 * Index Template
 *
 * This is the default template.  It is used when a more specific template can't be found to display
 * posts. It is unlikely that this template will ever be used, but there may be rare cases.
 *
 * @package Zenith
 * @subpackage Template
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

get_header(); // Loads the header.php template. ?>

<?php do_atomic( 'before_content' ); // zenith_before_content ?>

<div id="content">

	<div class="hfeed">
	
		<?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>
	
		<?php do_atomic( 'before_entry' ); // zenith_before_entry ?>

		<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

			<?php do_atomic( 'open_entry' ); // zenith_open_entry ?>
				
			<header class="entry-header">
				<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-edit-link] [entry-published] [entry-author] [entry-comments-link]', 'zenith' ) . '</div>' ); ?>
				<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'zenith' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'zenith' ), 'after' => '</p>' ) ); ?>

			</div><!-- .entry-content -->
			
			<footer class="entry-footer">
			
				<?php echo apply_atomic_shortcode( 'entry_terms', '<div class="entry-terms">' . __( '[entry-terms taxonomy="category" separator=""] [entry-terms taxonomy="post_tag" separator=""]', 'zenith' ) . '</div>' ); ?>
			
			</footer>

			<?php do_atomic( 'close_entry' ); // zenith_close_entry ?>

		</article><!-- .hentry -->
		
		<?php do_atomic( 'after_entry' ); // zenith_after_entry ?>
		
		<?php endwhile; else : ?>
		
			<?php get_template_part( 'loop', 'error' ); // Loads the loop-error.php template ?>
		
		<?php endif; ?>
	
	</div><!-- .hfeed -->
	
	<?php do_atomic( 'close_content' ); // zenith_close_content ?>
	
	<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>
	
</div><!-- #content -->

<?php do_atomic( 'after_content' ); // zenith_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>