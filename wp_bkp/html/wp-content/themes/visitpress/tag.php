<?php
/**
 * The tag archive template file.
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
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'visitpress' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
        <?php if ( tag_description() ) : ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
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