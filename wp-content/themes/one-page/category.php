<?php
/**
 * The template for displaying Category pages.
 *
 */
?>
<?php get_header(); ?>
<!-- blog title -->
<div class="homepage_nav_title section" id="contact">
    <div class="container_24">
        <div class="index_titles blog single"><?php printf(CATEGORY_ARCHIVES, '' . single_cat_title('', false) . ''); ?></div>
    </div>
</div>
<div class="clear"></div>
<!-- blog title ends -->
<div class="blog_pages_wrapper default_bg">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_16 alpha">
                <!--page start-->

                <?php if (have_posts()): ?>

                    <?php
                    /* Since we called the_post() above, we need to
                     * rewind the loop back to the beginning that way
                     * we can run the loop properly, in full.
                     */
                    rewind_posts();
                    /* Run the loop for the archives page to output the posts.
                     * If you want to overload this in a child theme then include a file
                     * called loop-archives.php and that will be used instead.
                     */
                    get_template_part('loop', 'archive');
                    ?>
                    <div class="clear"></div>
                    <nav id="nav-single"> <span class="nav-previous">
                            <?php next_posts_link(OLDER_POST); ?>
                        </span> <span class="nav-next">
                            <?php previous_posts_link(NEWER_POST); ?>
                        </span> </nav>
                <?php endif; ?>

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