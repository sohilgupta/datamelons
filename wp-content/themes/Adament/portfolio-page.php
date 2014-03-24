<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 
 Template name:Portfolio
 *
 * @package fabframe
 */

get_header(); ?>

<div class="full-wrap">
<ul class="folio-grid stylefx">
		<?php
		if ( get_query_var('paged') )
		    $paged = get_query_var('paged');
		elseif ( get_query_var('page') )
		    $paged = get_query_var('page');
		else
		    $paged = 1;
		$wp_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' =>-1));
		?>
		
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
		<li>
		
		  <figure>
            	<?php
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
					$image = aq_resize( $img_url, 720, 480, true ); //resize & crop the image
				?>
							
				<?php if($image) : ?>
					<a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php echo $image ?>"/></a>
				<?php endif; ?>
				
            <figcaption>
                <h3><?php the_title(); ?></h3>
                <span><?php the_terms( $post->ID, 'genre', '', ', ' ); ?></span>
                
            </figcaption>
        </figure>
 
		 </li>
		<?php endwhile; ?>

</ul>
</div>

<?php get_footer(); ?>
