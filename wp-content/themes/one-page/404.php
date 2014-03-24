<?php
/**
 * The template for displaying 404 pages (Not Found).
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
                <!--page 404 start-->
                <div class="post post_content error sidebar">
                    <span class="bred-tip"></span>
                    <p class="fourzerofourerror">404 ERROR</p>
                    <p class="fourzerofourerror somewhat"><?php echo THIS_IS_SOMEWHAT; ?></p>
                    <p class="itseems">
                        <?php echo IT_SEEMS_WE; ?>
                    </p>
                    <?php get_search_form(); ?>

                </div>
            </div>
            <!-- 404 ends -->
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