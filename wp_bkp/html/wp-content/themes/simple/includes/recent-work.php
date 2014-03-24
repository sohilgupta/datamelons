<div class="container main-content clearfix">

<div class="recent-work clearfix bottom-2">
     
     <div class="slidewrap1" >
    
      <div class="sixteen columns"> 
       <h3 class="title bottom-2">Recent Work</h3> 
      </div>
      
      <ul class="slider" id="sliderName1"> 
      	<?php
		$args = array( 'numberposts' => 12, 'order'=> 'DESC', 'post_type' => 'portfolio');
		$postslist = get_posts( $args );
		foreach ($postslist as $post) :  setup_postdata($post);
		
		$terms = get_the_terms( $post->ID, 'portfolio' );					
		if ( $terms && ! is_wp_error( $terms ) ) : 
			$term_links = array();
		foreach ( $terms as $term ) {
			$term_links[] = $term->name;
				}					
			$the_term = join( ", ", $term_links );
			$x++
		?>
      	
        <?php if( $x == '1' || $x == '7' ){ ?>
        <li class="slide">
        <?php } ?>
        
        <!-- item -->
        <div class="one-third column item">
          <a href="<?php echo get_permalink(); ?>">
          <?php the_post_thumbnail('portfolio-thumb', array( 'class'=>'pic' ) ); ?>
          <div class="img-caption">
          <div class="desc"><h3><?php the_title(); ?></h3><p><?php echo $the_term; ?></p><span>+</span></div>
          </div><!-- hover effect -->
          </a>
        </div>
        <!-- End -->
        
        <?php if( $x == '6' || $x == '12' ){ ?>
        </li>
        <?php } ?>
        
        <?php endif; ?>
        <?php wp_reset_query(); endforeach; ?>
        </ul>
      
      </div><!-- End slidewrap -->
     </div><!-- End recent-work -->
     
</div>