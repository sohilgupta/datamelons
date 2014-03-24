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
 */
?>
<?php get_header(); ?>

<!-- blog title -->
<div class="homepage_nav_title section" id="contact">
    <div class="container_24">
        <div class="index_titles blog single"><?php if (function_exists('onepage_breadcrumbs')) onepage_breadcrumbs(); ?></div>
    </div>
</div>
<div class="clear"></div>
<!-- blog title ends -->

<div class="blog_pages_wrapper default_bg">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_16 alpha">
                <!--page start-->
                <div class="content-bar">  	
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php if (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>	
                    <?php endif; ?>	
                    <?php wp_link_pages(array('before' => '<div class="clear"></div><div class="page-link"><span>' . PAGES_COLON . '</span>', 'after' => '</div>')); ?>
                </div>
                <!--End Page-->
                <div class="clear"></div>
                <!--Start Comment box-->
                <?php comments_template(); ?>
                <!--End Comment box-->
            </div>
            <!--Sidebar-->
            <div class="grid_8 omega">
                <!--Start Sidebar-->
                <?php get_sidebar(); ?>
                <!--End Sidebar-->
            </div>
            <div class="clear"></div>

        </div>
    </div>
</div>

<div class="clear"></div>
<?php get_footer(); ?>