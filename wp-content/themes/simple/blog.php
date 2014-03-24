<?php /* Template Name: Blog */ ?>
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
   
     <!-- Start Posts -->
     <div class="eleven columns bottom-3">
     
     
     
    <?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
			'orderby'  => 'date',
			'order'    => 'DESC',
			'paged'	   => $paged
	);
								
	query_posts($args);
	while ( have_posts() ) : the_post(); 
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
        <p><?php content('40'); ?></p>
        <a href="<?php echo get_permalink(); ?>" class="button small color">Read More</a>
      </div><!-- End post-content -->
      
     </div> 
     <!-- ==================== End  ==================== -->
     
     <?php endwhile; ?>
     

     
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