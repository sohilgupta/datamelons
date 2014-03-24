<?php
/**
 * The archive template file.
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
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'visitpress' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'visitpress' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'visitpress' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'visitpress' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'visitpress' ) ) . '</span>' );
					else :
						_e( 'Archives', 'visitpress' );
					endif;
				?></h1>      
 
<?php $args = array(
	'post_type' => 'post',
	'post_status' => 'publish'
);
$query = new WP_Query( $args ); 
                
while (have_posts()) : the_post(); ?> 
<?php get_template_part( 'content' ); ?>
<?php endwhile; endif; ?>
<?php visitpress_content_nav( 'nav-below' ); ?>
  
  </div><!-- end of content-inside -->
  </div><!-- end of content -->
<?php get_sidebar(); ?>
  </div><!-- end of container -->
</div><!-- end of wrapper-main -->
<?php get_footer(); ?>