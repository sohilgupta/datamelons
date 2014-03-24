<?php get_header(); ?>

	<div class="sixteen columns"><hr class="line bottom-3"></div><!-- End line -->

   
   <!-- Start main content -->
   <div class="container main-content clearfix">
   
     <!-- Start Posts -->
     <div class="eleven columns bottom-3">
     
     
     
    <?php 
	/* ================================================================== */
	/* End of Loop */
	/* ================================================================== */
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	?>
     
      <!-- ==================== Post ==================== -->
      <div class="post style-1 bottom-2">
      
      <h3 class="title bottom-1"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3><!-- Title Post -->
       
      <?php if( has_post_thumbnail() ){ ?>
      <div class="image-post">
        <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('blog'); ?></a>
      </div>
      <?php } ?><!-- End slider image-post -->
      
      <div class="post-meta bottom-1">
        <div class="meta"><i class="icon-time"></i> <?php the_time('d M, Y') ?> </div><!-- Date -->
        <div class="meta"><i class="icon-user"></i> <?php echo the_author_meta('nickname', get_the_author_meta( 'ID' ) ); ?> </div><!-- Author -->
        <div class="meta"><i class="icon-tags"></i> <?php the_category(', '); ?> </div><!-- Category -->
        <div class="meta"><i class="icon-comments"></i> <?php comments_number() ?> </div><!-- Comments -->
        <div class="meta"><i class="icon-eye-open"></i> <?php countviews( get_the_ID() ); ?> </div><!-- Comments -->
      </div><!-- End post-meta -->
      
      <div class="post-content">
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text 
          ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
          It has survived not only...
        </p>
        <a href="<?php echo get_permalink(); ?>" class="button small color">Read More</a>
      </div><!-- End post-content -->
      
     </div> 
     <!-- ==================== End  ==================== -->
     
     <?php
	/* ================================================================== */
	/* End of Loop */
	/* ================================================================== */
	endwhile;
	?>
    
    <?php
	/* ================================================================== */
	/* Else if Nothing Found */
	/* ================================================================== */
	else :
	?>


	<h1>Sorry Nothing Found!</h1>
    
    <?php
	/* ================================================================== */
	/* End If */
	/* ================================================================== */
	endif;
	?>

     
     <!-- Start Pagination -->
     <?php pagination(); ?>
     <!-- End pagination -->
     
   </div><!-- End Posts -->  
   
   
   <!-- Start Sidebar Widgets -->
   <?php get_sidebar(); ?>
   <div class="clearfix"></div>
   <!-- End Sidebar Widgets -->
    
   </div><!-- <<< End Container >>> -->
   
<?php get_footer(); ?>