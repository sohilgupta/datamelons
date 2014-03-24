<?php get_header(); ?>
   
   <div class="page-title">
     <div class="container clearfix">
       
       <div class="sixteen columns"> 
         <h1>Blog</h1>
       </div>
       
     </div><!-- End Container -->
   </div><!-- End Page title -->
   
   <!-- Start main content -->
   <div class="container main-content clearfix">
   
     <!-- Start Posts -->
     <div class="eleven columns bottom-3">
     
      <!-- ==================== Single Post ==================== -->
      <?php while (have_posts()) : the_post(); ?>
      
      <div class="post single style-1">
      
      <h3 class="title bottom-1"><?php the_title(); ?></h3><!-- Title Post -->
       
      <?php if( has_post_thumbnail() ){ ?>
      <div class="image-post">
        <?php the_post_thumbnail('blog'); ?>
      </div>
      <?php } ?><!-- End slider image-post -->
      
      <div class="post-meta bottom-1">
        <div class="meta"><i class="icon-time"></i> <?php the_time('d M, Y') ?> </div><!-- Date -->
        <div class="meta"><i class="icon-user"></i> <?php echo the_author_meta('nickname', get_the_author_meta( 'ID' ) ); ?> </div>
        <div class="meta"><i class="icon-tags"></i> <?php the_category(', '); ?> </div><!-- Category -->
        <div class="meta"><i class="icon-comments"></i> <?php comments_number() ?> </div><!-- Comments -->
        <div class="meta"><i class="icon-eye-open"></i> <?php countviews( get_the_ID() ); ?> </div><!-- Comments -->
      </div><!-- End post-meta -->
      
     <div class="post-content">
     <?php the_content(); ?>
     </div><!-- End post-content -->
      
     </div>
     <!-- ==================== End Single Post  ==================== -->
     
     <?php if( has_tag() ){ ?>
     <div class="post-tags bottom-2">
       <i class="icon-tags"></i> : &nbsp; <?php the_tags( 'Tags: ',' ' ); ?> 
     </div><!-- End Tags -->
     <?php } ?>
     
     
     <?php if( vp_option('post_author') == '1' ){ ?>
     <div class="about-author bottom-3">
      <h3 class="title bottom-1">About The Author</h3><!-- Title Post -->
      <div class="content">
        <div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '80' ); ?></div>
        <div class="data">
          <h5><?php echo the_author_meta('nickname', get_the_author_meta( 'ID' ) ); ?></h5>
          <p><?php echo the_author_meta('description', get_the_author_meta( 'ID' ) ); ?></p>
        </div><!-- End data -->
      </div><!-- End content -->
     </div><!-- End about author -->
     <?php } ?>
     
     
     <!-- Start Comments box -->
     <?php comments_template(); ?>
     <!-- End Comments box -->
     
     <?php endwhile; ?>
     
   </div><!-- End Posts -->  
   
   
   <!-- Start Sidebar Widgets -->
   <?php get_sidebar(); ?>
   <div class="clearfix"></div>
   <!-- End Sidebar Widgets -->
    
   </div><!-- <<< End Container >>> -->
   
<?php get_footer(); ?>