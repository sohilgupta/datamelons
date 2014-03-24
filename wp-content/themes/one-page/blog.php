<?php
/*
  Template Name: Blog Page
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

                <?php
                $limit = get_option('posts_per_page');
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $wp_query->query('showposts=' . $limit . '&paged=' . $paged);
                $wp_query->is_archive = true;
                $wp_query->is_home = false;
                ?>
                <!--Start Post-->
                <?php get_template_part('loop', 'blog'); ?>   
                <div class="clear"></div>
                <nav id="nav-single"> <span class="nav-previous">
                        <?php next_posts_link(OLDER_POST); ?>
                    </span> <span class="nav-next">
                        <?php previous_posts_link(NEWER_POST); ?>
                    </span> </nav>

            </div>
            <!-- sidebar -->
            <div class="grid_8 omega">
                <!--Start Sidebar-->
                <?php get_sidebar(); ?>
                <!--End Sidebar-->
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>