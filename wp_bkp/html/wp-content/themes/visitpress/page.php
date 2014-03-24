<?php
/**
 * The page template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
get_header(); ?>
<div id="wrapper-main">
  <div id="container">  
  <div id="content">
  <div class="content-inside">
    <?php visitpress_get_breadcrumb(); ?>
      
    <div class="full-content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <p class="post-meta"><?php visitpress_display_date_page(); ?> <?php visitpress_get_author_page(); ?></p>
      
      <?php visitpress_get_display_image_page(); ?>
      
      <?php the_content( 'Continue reading' ); ?> 
<?php endwhile; endif; ?>      
    </div><!-- end of full-content -->
    
    <?php comments_template( '', true ); ?>
  
  </div><!-- end of content-inside -->
  </div><!-- end of content -->
<?php get_sidebar(); ?>
  </div><!-- end of container -->
</div><!-- end of wrapper-main -->
<?php get_footer(); ?>