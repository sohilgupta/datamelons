<?php
/**
 * The search results template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
get_header(); ?>
<div id="wrapper-main">
  <div id="container">  
  <div id="content">
  <div class="content-inside">
    <?php visitpress_get_breadcrumb(); ?>
      
      <?php if ( have_posts() ) : ?>
				<h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'visitpress' ), '<span>' . get_search_query() . '</span>' ); ?></h1> 
        <p class="search-results"><?php _e( 'Number of Results: ', 'visitpress' ); ?><?php echo $wp_query->found_posts; ?></p>     
 
<?php $args = array(
	'post_status' => 'publish'
);
$query = new WP_Query( $args ); 
                
while (have_posts()) : the_post(); ?> 
<?php get_template_part( 'content' ); ?>
<?php endwhile; ?>
      
      <?php else : ?>
      <h1 class="archive-title"><?php _e( 'Nothing Found', 'visitpress' ); ?></h1>
      <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'visitpress' ); ?></p>
<?php endif; ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="navigation" role="navigation">
			<h3 class="navigation-headline section-heading"><?php _e( 'Search results navigation', 'visitpress' ); ?></h3>
			<p class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Previous results', 'visitpress' ) ); ?></p>
      <p class="nav-previous"><?php next_posts_link( __( 'Next results <span class="meta-nav">&rarr;</span>', 'visitpress' ) ); ?></p>
		</div>
<?php endif; ?>
  
  </div><!-- end of content-inside -->
  </div><!-- end of content -->
<?php get_sidebar(); ?>
  </div><!-- end of container -->
</div><!-- end of wrapper-main -->
<?php get_footer(); ?>