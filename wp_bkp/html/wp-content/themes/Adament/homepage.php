<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 Template name:Homepage
 
 * @package fabframe
 */
 
get_header(); ?>

<div id="hblock">

<div id="home-slider">


<ul class="slides-container">
<?php

$slidecount = of_get_option('w2f_slidecount','5');
$args = array( 'posts_per_page' => 5, 'post_type'=> 'slide' );

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li>
		    <?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			?>
		   <img src="<?php echo $img_url; ?>" />
		   <div class="stitle"><span> <?php the_title(); ?> </span></div>
		   <div class="scaption"><span> <?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?> </span></div>
	</li>
<?php endforeach; 
wp_reset_postdata();?>

</ul>


    <nav class="slides-navigation">
	    <a href="#" class="next glyphicon glyphicon-chevron-right"></a>
	    <a href="#" class="prev glyphicon glyphicon-chevron-left"></a>
	</nav>
</div>
</div>
<?php get_footer(); ?>