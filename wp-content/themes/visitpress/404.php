<?php
/**
 * The 404 page (Not Found) template file.
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
      <h1><?php _e( 'Nothing Found', 'visitpress' ); ?></h1>
      <p><?php _e( 'Apologies, but no results were found for your request. Perhaps searching will help you to find a related content.', 'visitpress' ); ?></p>
      <?php get_search_form(); ?>     
    </div><!-- end of full-content -->
  
  </div><!-- end of content-inside -->
  </div><!-- end of content -->
<?php get_sidebar(); ?>
  </div><!-- end of container -->
</div><!-- end of wrapper-main -->
<?php get_footer(); ?>