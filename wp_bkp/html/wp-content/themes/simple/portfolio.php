<?php /* Template Name: Portfolio */ ?>
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
    
    <div class="portfolio bottom-3">
    
    <div class="sixteen columns">  
      <div class="title clearfix" id="options">
        <ul id="filters" class="option-set clearfix" data-option-key="filter">
        <li><a href="#filter" data-option-value="*" class="selected">All</a></li>
        <?php
		$terms = get_terms("portfolio");
		$count = count($terms);
			if ( $count > 0 ){
			foreach ( $terms as $term ) {
			echo '<li><a href="#filter" data-option-value=".'.$term->name.'">'.$term->name.'</a></li>';
										
		}
			}
		?>
        </ul>
      </div>
    </div> <!-- End options -->
    
    <div class="clearfix"></div>
    
    <div id="contain"> 
    
    <!-- =================================================== -->
    
    <?php
	$args = array( 'numberposts' => -1, 'order'=> 'DESC', 'post_type' => 'portfolio');
	$postslist = get_posts( $args );
	foreach ($postslist as $post) :  setup_postdata($post);
							
	$terms = get_the_terms( $post->ID, 'portfolio' );					
		if ( $terms && ! is_wp_error( $terms ) ) : 
			$term_links = array();
		foreach ( $terms as $term ) {
			$term_links[] = $term->name;
				}					
			$the_term = join( " ", $term_links );
			$the_term_separated = join( ", ", $term_links );
	?>
    
    <?php if( has_post_thumbnail() ){ ?>
    <!-- Start Portfolio Item -->
      <div class="one-third column item element-3 <?php echo $the_term; ?>" data-categories="<?php echo $the_term; ?>">
        <a href="<?php echo get_permalink(); ?>">
          <?php the_post_thumbnail('portfolio-thumb', array( 'class'=>'pic' ) ); ?>
          <div class="img-caption">
          <div class="desc"><h3><?php the_title(); ?></h3><p><?php echo $the_term_separated; ?></p><span>+</span></div>
          </div><!-- hover effect -->
          </a>
      </div>
      <!-- End Portfolio Item -->
      <?php } ?>
      
     <?php endif; ?> 
     <?php wp_reset_query(); endforeach; ?>
      
      <!-- =================================================== -->
    
    </div><!-- End contain-->
    
    </div><!-- End portfolio -->
    
   </div><!-- <<< End Container >>> -->
   
<?php get_footer(); ?>