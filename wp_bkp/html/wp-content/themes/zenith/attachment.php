<?php
/**
 * Attachment Template
 *
 * This is the default attachment template.  It is used when visiting the singular view of a post attachment page (images, videos, audio, etc.).
 *
 * @package Zenith
 * @subpackage Functions
 * @version 0.1
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

get_header(); // Loads the header.php template. ?>

<?php do_atomic( 'before_content' ); // zenith_before_content ?>

<div id="content">

	<?php do_atomic( 'open_content' ); // zenith_open_content ?>

	<div class="hfeed">

		<?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>

		<?php do_atomic( 'before_entry' ); // zenith_before_entry ?>

		<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

			<?php do_atomic( 'open_entry' ); // zenith_open_entry ?>
			
			<header class="entry-header">
				<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php if ( wp_attachment_is_image( get_the_ID() ) ) : ?>

					<p class="attachment-image">
						<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) ); ?>
					</p><!-- .attachment-image -->

				<?php else : ?>

					<p>
						<?php hybrid_attachment(); // Function for handling non-image attachments. ?>
					</p>

					<p class="download">
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="enclosure" type="<?php echo get_post_mime_type(); ?>"><?php printf( __( 'Download "%s";', 'zenith' ), the_title( '<span class="fn">', '</span>', false) ); ?></a>
					</p><!-- .download -->

				<?php endif; ?>

				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'zenith' ) ); ?>

				<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'zenith' ), 'after' => '</p>' ) ); ?>

				<?php
					if ( wp_attachment_is_image( get_the_ID() ) ) {
						$gallery = do_shortcode( sprintf( '[gallery id="%1$s" exclude="%2$s" columns="5" numberposts="16" orderby="rand"]', $post->post_parent, get_the_ID() ) );
					if ( !empty( $gallery ) )
						echo '<h3>' . __( 'Related Images', 'zenith' ) . '</h3>' . $gallery;
					}
				?>

			</div><!-- .entry-content -->

			<?php do_atomic( 'close_entry' ); // zenith_close_entry ?>

		</article><!-- .hentry -->

		<?php do_atomic( 'after_entry' ); // zenith_after_entry ?>

		<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

		<?php endwhile; ?>

		<?php endif; ?>

	</div><!-- .hfeed -->

	<?php do_atomic( 'close_content' ); // zenith_close_content ?>

	<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

</div><!-- #content -->

<?php do_atomic( 'after_content' ); // zenith_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>