<?php
/**
 * The template used to display Tag Archive pages
 *
 * 
 */
?>
<?php get_header(); ?>
<!-- blog title -->
<div class="homepage_nav_title section" id="contact">
    <div class="container_24">
        <div class="index_titles blog single"><?php printf(TAG_ARCHIVES, '' . single_tag_title('', false) . ''); ?></div>
    </div>
</div>
<div class="clear"></div>
<!-- blog title ends -->
<div class="blog_pages_wrapper default_bg">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_16 alpha">
                <!--page start-->

                <?php get_template_part('loop', 'index'); ?>
                <div class="clear"></div>
                <nav id="nav-single"> <span class="nav-previous">
                        <?php next_posts_link(OLDER_POST); ?>
                    </span> <span class="nav-next">
                        <?php previous_posts_link(NEWER_POST); ?>
                    </span> </nav>
                <!--End Page-->
                <div class="clear"></div>
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