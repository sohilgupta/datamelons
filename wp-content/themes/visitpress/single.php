<?php
/**
 * The post template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
get_header(); ?>
<div id="wrapper-main">
  <div id="container">  
  <div id="content" <?php post_class(); ?>>
  <div class="content-inside">
    <?php visitpress_get_breadcrumb(); ?>
      
    <div class="full-content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <p class="post-meta"><?php visitpress_display_date_post(); ?> <?php visitpress_get_author_post(); ?> <?php visitpress_display_category_post(); ?></p>
      <?php visitpress_get_display_image_post(); ?>
        
      <?php the_content( 'Continue reading' ); ?>
      
      <?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'visitpress' ) . '</span>', 'after' => '</p>' ) ); ?>
<?php endwhile; endif; ?>      
    </div><!-- end of full-content -->
    
    <?php if (($visitpress_next_preview_post == '') || ($visitpress_next_preview_post == 'Display')) :  visitpress_prev_next('visitpress-post-nav');  endif; ?>
    
    <?php comments_template( '', true ); ?>
  
  </div><!-- end of content-inside -->
  </div><!-- end of content -->
<?php get_sidebar(); ?>
  </div><!-- end of container -->
</div><!-- end of wrapper-main -->
<?php get_footer(); ?>