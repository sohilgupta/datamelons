<?php
/**

Template Name: Homepage

 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package web2feel
 * @since web2feel 1.0
 */



get_header(); ?>
			
		<?php get_template_part( 'slide', 'index' ); ?>
		<div class="clear"></div>
		
		<div class="intro grid_8">
				<h2><?php echo of_get_option('w2f_intro_title','The intro title goes here');?></h2>
				<p><?php echo of_get_option('w2f_intro_text','The intro text goes here');?></p>
		</div>
		
		<div class="clear"></div>

		<div id="primary" class="content-area container_6">
			
		<div id="article-area" class="cf ">
		
	
	<div class="article-list">
			<?php
			$count = of_get_option('w2f_blog_number','8');
			$args = array( 'numberposts' =>$count );
			$lastposts = get_posts( $args );
			foreach($lastposts as $post) : setup_postdata($post); ?>
			
			<div class="article-box grid_2">
			
				<?php
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
					$image = aq_resize( $img_url, 220, 170, true ); //resize & crop the image
				?>
				
				<?php if($image) : ?> <a class="sqimg" href="<?php the_permalink(); ?>"><img class="grey-img" src="<?php echo $image ?>"/></a> <?php endif; ?>
				
				<div class="post-hover">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php print_excerpt(100); ?>
					
				</div>
					
					</div>
			
			<?php endforeach; ?>
			</div>
	
</div>
		</div><!-- #primary .content-area -->


<?php get_footer(); ?>