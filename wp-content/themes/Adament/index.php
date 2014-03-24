<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package fabframe
 */

get_header(); ?>
<div class="container"> <div class="row"> 
	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

		<?php 
    echo do_shortcode("[metaslider id=47]"); 
?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
