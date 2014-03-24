<?php
/**
 * Template Name: Showcase
 *
 * This custom page template displays the content using an alternate layour resembling a magazine layout.
 *
 * @package Zenith
 * @subpackage Template
 * @since 0.1
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

get_header(); // Loads the header.php template. ?>

<?php do_atomic( 'before_content' ); // zenith_before_content ?>

<div id="content">

	<div class="hfeed">
	
		<section id="featured">
	
			<div class="ui-tabs">
			
				<?php
					/* Get the sticky posts. */
					$sticky = get_option( 'sticky_posts' );
					
					$zenith_featured_posts = hybrid_get_setting( 'zenith_featured_posts' );

					/* If more than one sticky post, use them for the slider.  Else, just get the 3 latest posts. */
					$args = ( ( !empty( $sticky ) && 1 < count( $sticky ) ) ? array( 'post__in' => $sticky ) : array( 'posts_per_page' => absint( $zenith_featured_posts ) > 0 ? absint( $zenith_featured_posts ) : 4 ) );
				?>
				
				<?php $zenith_loop = new WP_Query( $args ); $i = 0; ?>

				<ul class="ui-tabs-nav">
				
					<?php while ( $zenith_loop->have_posts() ) : $zenith_loop->the_post(); ?>
					
					<li>
						<a href="#item-<?php echo ++$i; ?>"><?php the_title(); ?></a>
					</li>
					<?php endwhile; ?>

				</ul><!-- .ui-tabs-nav -->
				
				<?php $i = 0; while ( $zenith_loop->have_posts() ) : $zenith_loop->the_post(); ?>
				
				<?php $do_not_duplicate[] = get_the_ID(); ?>
	
				<div id="item-<?php echo ++$i; ?>">
					
					<?php if ( current_theme_supports( 'get-the-image' ) ) : ?>
						<?php $image = get_the_image( array( 'echo' => false ) );
							if ( $image ) : ?>
								<a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark" class="featured-image-link"><?php get_the_image( array( 'size' => 'zenith-large', 'link_to_post' => false ) ); ?></a>
						<?php endif; ?>
					<?php endif; ?>

					<article class="<?php hybrid_entry_class(); ?>">
						<header class="entry-header">
						
							<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-published]', 'zenith' ) . '</div>' ); ?>
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						</header><!-- .entry-header -->
						<div class="entry-summary">

							<?php the_excerpt(); ?>
							
							<a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read-more-link"><?php _e( 'Read more', 'cornrows' ); ?></a>
						
						</div><!-- .entry-summary -->
					</article><!-- .hentry -->
					
				</div><!-- .ui-tabs-panel -->
				
				<?php endwhile; ?>

			</div><!-- .ui-tabs -->
			
		</section><!-- #featured -->
		
		<?php
		
			$zenith_recent_posts = hybrid_get_setting( 'zenith_recent_posts' );

			$zenith_loop = new WP_Query(
				array(
					'posts_per_page' => absint( $zenith_recent_posts ) > 0 ? absint( $zenith_recent_posts ) : 4,
					'post__not_in' => $do_not_duplicate
				)
			);
		?>
		
		<?php if ( $zenith_loop->have_posts() ) : ?>
		
		<section id="recent">
		
			<ul class="loop-entries">
			
				<?php while ( $zenith_loop->have_posts() ) : $zenith_loop->the_post(); ?>
			
				<?php do_atomic( 'before_entry' ); // zenith_before_entry ?>

				<li id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
					
					<?php if ( current_theme_supports( 'get-the-image' ) ) : ?>
						<?php $image = get_the_image( array( 'echo' => false ) );
							if ( $image ) : ?>
								<a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark" class="featured-image-link"><?php get_the_image( array( 'size' => 'zenith-small', 'default_image' => trailingslashit ( get_template_directory_uri() ) . 'images/default.png' ) ); ?></a>
						<?php endif; ?>
					<?php endif; ?>
					
					<div class="entry-wrap">
					
						<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-published]', 'zenith' ) . '</div>' ); ?>
						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
								
						<a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read-more-link"><?php _e( 'Read more', 'cornrows' ); ?></a>
						
					</div><!-- .entry-wrap -->

				</li><!-- .hentry -->
				
				<?php do_atomic( 'after_entry' ); // zenith_after_entry ?>
				
				<?php endwhile; ?>
				
			</ul><!-- .loop-entries -->
			
		</section><!-- #recent -->
		
		<?php endif; ?>
	
	</div><!-- .hfeed -->
	
	<?php do_atomic( 'close_content' ); // zenith_close_content ?>
	
	<?php get_template_part( 'zenith_loop-nav' ); // Loads the zenith_loop-nav.php template. ?>
	
</div><!-- #content -->

<?php do_atomic( 'after_content' ); // zenith_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>