<?php
/**
 * The template for displaying Search Results pages.
 *
 * 
 */
?>
<?php get_header(); ?>
<!-- blog title -->
<div class="homepage_nav_title section" id="contact">
    <div class="container_24">
        <div class="index_titles blog single"><?php printf(SEARCH_RESULTS_FOR, '' . get_search_query() . ''); ?></div>
    </div>
</div>
<div class="clear"></div>
<!-- blog title ends -->
<div class="blog_pages_wrapper default_bg">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_16 alpha">
                <!--page start-->

                <?php if (have_posts()) : ?>               
                    <!--Start Post-->
                    <?php get_template_part('loop', 'search'); ?>
                    <!--End Post-->
                <?php else : ?>
                    <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                            <h1 class="entry-title">
                                <?php echo NOTHING_FOUND; ?>
                            </h1>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <p>
                                <?php echo SORRY_NOTHING_FOUND_TRY_AGAIN_WITH_ANOTHER_KEYWORD; ?>
                            </p>
                            <?php get_search_form(); ?>
                        </div>
                        <!-- .entry-content -->
                    </article>
                <?php endif; ?>
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