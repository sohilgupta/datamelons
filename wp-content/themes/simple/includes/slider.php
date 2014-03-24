<div class="slider-1 clearfix">
   
     <div class="flex-container">
       <div class="flexslider loading">
        <ul class="slides">

		<?php
		$args = array( 'numberposts' => -1, 'order'=> 'DESC', 'post_type' => 'slider');
		$postslist = get_posts( $args );
		foreach ($postslist as $post) :  setup_postdata($post);
		?>

          <li class="slide-bg-color">
           <div class="container">
           <div class="sixteen columns contain">
            
           <h2 data-toptitle="<?php echo vp_metabox('slider_option.slider_title_position'); ?>%">
		   <?php echo vp_metabox('slider_option.slider_title'); ?>
           </h2>
           
           <p data-bottomtext="<?php echo vp_metabox('slider_option.slider_desc_position'); ?>%">
		   <?php echo vp_metabox('slider_option.slider_description'); ?>
           </p>
           
           <div class="links" data-bottomlinks="<?php echo vp_metabox('slider_option.slider_button_position'); ?>%">
           <a href="<?php echo vp_metabox('slider_option.slider_button_link'); ?>" class="button medium normal">
		   <?php echo vp_metabox('slider_option.slider_button'); ?>
           </a>
           </div>
           
           <?php the_post_thumbnail('slider',array( 'data-topimage'=> vp_metabox('slider_option.slider_image_position').'%', 'class' => 'item' ) ); ?>
           
           </div>
           </div><!-- End Container -->
           </li><!-- End item -->
         
         <?php wp_reset_query(); endforeach; ?>
         
        </ul>
       </div>
      </div>
     
   </div><!-- End slider -->