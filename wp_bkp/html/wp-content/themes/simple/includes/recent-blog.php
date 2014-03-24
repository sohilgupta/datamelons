<div class="container main-content clearfix">

<div class="latest-blog clearfix bottom-1">
     
       <div class="slidewrap2" >
    
      <div class="sixteen columns"> 
       <h3 class="title bottom-2">Latest News</h3> 
      </div>
      
      <ul class="slider" id="sliderName2">
        
        <?php
		$args = array( 'numberposts' => 3, 'order'=> 'DESC');
		$postslist = get_posts( $args );
		foreach ($postslist as $post) :  setup_postdata($post);
		?>
          
          <!-- item -->
          <div class="one-third column item">
            <h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
            <div class="meta"><?php the_time('M d, Y') ?> / <?php comments_number() ?></div>
            <p><?php content(15); ?></p>
          </div>
          <!-- End -->
        
        <?php wp_reset_query(); endforeach; ?>
        
      </ul>
      
      </div><!-- End slidewrap -->
      </div><!-- End latest-blog -->
      
</div>