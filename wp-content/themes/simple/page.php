<?php get_header(); ?>
   
   <div class="page-title">
     <div class="container clearfix">
       
       <div class="sixteen columns"> 
         <h1><?php the_title(); ?></h1>
       </div>
       
     </div><!-- End Container -->
   </div><!-- End Page title -->
   
   <!-- Start main content -->
   <div class="container main-content clearfix">
    
    <div class="sixteen columns">
    <?php
	// Start Loop
    while (have_posts()) : the_post();
							
	the_content();
								
	endwhile;
	// End Loop
	?>
    <div class="clearfix"></div>
    </div>
    
   </div><!-- <<< End Container >>> -->
   
<?php get_footer(); ?>