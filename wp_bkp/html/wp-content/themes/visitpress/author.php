<?php
/**
 * The author archive template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
get_header(); ?>
<div id="wrapper-main">
  <div id="container">  
  <div id="content">
  <div class="content-inside">
    <?php visitpress_get_breadcrumb(); ?>
      
      <?php if ( have_posts() ) : ?>
			<?php the_post(); ?>
      
				<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'visitpress' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
        
        <?php rewind_posts(); ?>
        
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
			  <div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'visitpress_author_bio_avatar_size', 60 ) ); ?>
				</div>
				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'visitpress' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div>
			  </div>
			  <?php endif; ?>      
 
<?php $args = array(
	'post_type' => 'post',
	'post_status' => 'publish'
);
$query = new WP_Query( $args ); 
                
while (have_posts()) : the_post(); ?> 
<?php get_template_part( 'content' ); ?>
<?php endwhile; endif; ?>
<?php visitpress_content_nav( 'nav-below' ); ?>
  
  </div><!-- end of content-inside -->
  </div><!-- end of content -->
<?php get_sidebar(); ?>
  </div><!-- end of container -->
</div><!-- end of wrapper-main -->
<?php get_footer(); ?>