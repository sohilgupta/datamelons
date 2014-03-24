<?php
/**
 * The main template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
get_header(); ?>
<div id="wrapper-main">
  <div id="container">  
  <div id="content">
  <div class="content-inside">
    <?php visitpress_get_index_headline(); ?>
      <?php if ( dynamic_sidebar( 'sidebar-6' ) ) : else : ?>
    <?php endif; ?>
 
<?php $args = array(
	'post_type' => 'post',
	'post_status' => 'publish'
);
$query = new WP_Query( $args ); 
                
if (FALSE) : while (have_posts()) : the_post(); ?> 
<?php get_template_part( 'content' ); ?>
<?php endwhile; endif; ?>

<?php visitpress_content_nav( 'nav-below' ); ?>
  
  </div><!-- end of content-inside -->
  </div><!-- end of content -->
<?php get_sidebar(); ?>
  </div><!-- end of container -->
</div><!-- end of wrapper-main -->
<?php get_footer(); ?>