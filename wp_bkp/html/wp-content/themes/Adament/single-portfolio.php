<?php
/**
 * The Template for displaying all portfolio items.
 *
 * @package fabframe
 */

get_header(); ?>
   	<div class="container"> <div class="row">
		<div id="primary" class="content-area col-md-12">
			<main id="main" class="site-main" role="main">
	
				<?php while ( have_posts() ) : the_post(); ?>
				<div id="singleslider">
					<ul class="folio-container">
						<?php 
						$gallery = get_post_gallery( $post, false );
						$ids = explode( ",", $gallery['ids'] );
				
						foreach( $ids as $id ) {
							$link   = wp_get_attachment_url( $id );
							$img_url  = wp_get_attachment_url( $id, "large");
							$image = aq_resize( $img_url, 1140, 500, true ); ?>
							<li>
								<a rel="prettyPhoto[pp_gal]"  href='<?php echo $link?>'> <img src="<?php echo $image; ?>" /> </a>
							</li>
						<?php } ?>
					</ul>
				</div>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
				
					<div class="entry-content">	   
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fabframe' ) ); ?>
					</div>
				</article><!-- #post-## -->

				<?php endwhile; // end of the loop. ?>
				<div class="row">
					<div class="col-xs-5 navprev"> <i class="glyphicon glyphicon-chevron-left"></i> <?php previous_post_link('%link', 'Previous'); ?> </div>
					<?php $portpage = of_get_option('w2f_port_page',''); ?>
					<div class="col-xs-2 navport"> <a href="<?php echo get_page_link($portpage); ?>"> <i class="glyphicon glyphicon-th-large"></i> </a></div>
					<div class="col-xs-5 navnext"><?php next_post_link('%link','Next'); ?>  <i class="glyphicon glyphicon-chevron-right"></i></div>
				</div>
				
				
				
			</main><!-- #main -->
		</div><!-- #primary -->
	</div></div>

<?php get_footer(); ?>