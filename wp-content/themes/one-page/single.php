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
                <!-- Start the Loop. -->
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
                        <!--post start-->
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="post_heading_wrapper">
                                <div class="postimage_container">
                                    <div class="clear"></div>
                                </div>
                                <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                                <ul class="post_meta">
                                    <li class="day"><?php echo get_the_time('d') ?></li>
                                    <li class="month"><?php echo get_the_time('M') ?></li>
                                    <li class="year"><?php echo get_the_time('Y') ?></li>
                                    <li class="posted_by"><span>by&nbsp;</span><?php the_author_posts_link(); ?></li>
                                    <li><span>&nbsp;&#187;&nbsp;&nbsp;<?php the_category(', '); ?></span></li>
                                    <li class="post_comment"><?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?></li>
                                </ul>

                            </div>			   
                            <div class="post_content">
                                <?php the_content(); ?>
                                <?php wp_link_pages(array('before' => '<div class="clear"></div><div class="page-link"><span>' . __('Pages:', 'onepage') . '</span>', 'after' => '</div>')); ?>
                            </div>			    
                            <div class="clear"></div>
                        </div>
                        <!--End Post-->
                    <?php endwhile;
                else:
                    ?>
                    <div class="blogs_page_container">
                        <p>
    <?php echo SORRY_NO_POST_MATCHED_YOUR_CRITERIA; ?>
                        </p>
                    </div>
                        <?php endif; ?>
                <nav id="nav-single"> <span class="nav-previous">
                        <?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> Previous Post ', 'onepage')); ?>
                    </span> <span class="nav-next">
<?php next_post_link('%link', __('Next Post <span class="meta-nav">&rarr;</span>', 'onepage')); ?>
                    </span> </nav>
                <div class="clear"></div>
                <div class="comment_section">
                    <!--Start Comment list-->
<?php comments_template('', true); ?>
                    <!--End Comment Form-->
                </div>
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