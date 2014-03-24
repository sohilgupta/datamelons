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
<!DOCTYPE html>
<html <?php language_attributes(); ?>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php if (onepage_get_option('onepage_favicon') != '') { ?>
            <link rel="shortcut icon" href="<?php echo onepage_get_option('onepage_favicon'); ?>" />
        <?php } else {
            
        } ?>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
        <![endif]-->
<?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>
        <!-- ******************top Social icon wrapper********* -->
        <div class="social_wrapper">
            <div class="container_24">
                <div class="grid_24">

                    <div id="call_us">
                        <div><img src="<?php bloginfo('stylesheet_directory'); ?>/images/phone_icon.png"></div><div>
                            <?php if (onepage_get_option('onepage_contact_number') != '') { ?>
                                <p><?php _e('Call us on', 'onepage'); ?>&nbsp;&nbsp;<?php echo onepage_get_option('onepage_contact_number'); ?></p>
                            <?php } else { ?>
                                <p><?php _e('Call us on 2514578498', 'onepage'); ?></p>
<?php } ?>

                        </div>
                    </div>

                    <div class="social_icons home">
                        <ul class="social_logos">
                            <?php if (onepage_get_option('onepage_facebook') != '') { ?>
                                <li class="fb"><a href="<?php echo onepage_get_option('onepage_facebook'); ?>" alt="Facebook icon" title="Facebook" target="_blank"></a></li>   
                            <?php } ?>  
                            <?php if (onepage_get_option('onepage_twitter') != '') { ?>
                                <li class="tw"><a href="<?php echo onepage_get_option('onepage_twitter'); ?>" alt="Twitter icon" title="Twitter" target="_blank"></a></li>
                            <?php } ?>  
                            <?php if (onepage_get_option('onepage_google') != '') { ?>
                                <li class="gp"><a href="<?php echo onepage_get_option('onepage_google'); ?>" alt="Google Plus icon" title="Google Plus" target="_blank"></a></li>
                            <?php } ?>  
                            <?php if (onepage_get_option('onepage_rss') != '') { ?>
                                <li class="rss"><a href="<?php echo onepage_get_option('onepage_rss'); ?>" alt="Rss" title="Rss" target="_blank"></a></li>
                            <?php } ?>  
                            <?php if (onepage_get_option('onepage_pinterest') != '') { ?>
                                <li class="pn"><a href="<?php echo onepage_get_option('onepage_pinterest'); ?>" alt="Pinterest" title="Pinterest" target="_blank"></a></li>
                            <?php } ?> 
                            <?php if (onepage_get_option('onepage_youtube') != '') { ?>
                                <li class="yt"><a href="<?php echo onepage_get_option('onepage_youtube'); ?>" alt="YouTube icon" title="YouTube" target="_blank"></a></li> 
<?php } ?>  

                        </ul>
                    </div>

                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!-- *********************Header Logo and menu Wrapper************************************** -->


        <!-- Header condition1 starts here -->

        <div class="header_wrapper subMenu" style=" z-index: 1000; ">
            <div class="container_24">
                <div class="grid_24">
                    <div class="grid_6 alpha">
                        <div id="logo">
                            <a href="<?php echo home_url(); ?>"><img src="<?php if (onepage_get_option('onepage_logo') != '') { ?><?php echo onepage_get_option('onepage_logo'); ?><?php } else { ?><?php echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
                    </div>
                    <div class="grid_18 omega">
                        <div class="home_navigation">
                            <div id="MainNav">                                  
                                <?php if (onepage_get_option('onepage_nav') != '') { ?><a href="#" class="mobile_nav closed"><?php echo stripslashes(onepage_get_option('onepage_nav')); ?><span></span></a>
<?php } else { ?> <a href="#" class="mobile_nav closed"><?php _e('Mobile Menu', 'onepage'); ?><span></span></a>
<?php } ?>


                                <div id="menu">


                                    <ul class="sf-menu" id="example-sf-menu">
                                        <li class="page_item"><a class='scrollSmint' id='home' href="#top"><?php _e('Home', 'onepage'); ?></a></li>

                                                <?php if (onepage_get_option('onepage_our_services_heading') != '') { ?>
                                            <li class="page_item"><a class='scrollSmint' id="services" href="#"><?php echo onepage_get_option('onepage_our_services_heading'); ?>
                                        <?php } else { ?><li class="page_item"><a class='scrollSmint' id="services" href="#"><?php _e('Services', 'onepage'); ?></a></li><?php } ?></a></li>

                                                <?php if (onepage_get_option('onepage_recent_blog_heading') != '') { ?>
                                            <li class="page_item"><a class='scrollSmint' id="blogs" href="#"><?php echo onepage_get_option('onepage_recent_blog_heading'); ?>
                                        <?php } else { ?><li class="page_item"><a class='scrollSmint' id="blogs" href="#"><?php _e('Recent Blogs', 'onepage'); ?></a></li><?php } ?></a></li>


                                                <?php if (onepage_get_option('onepage_our_contact_heading') != '') { ?>
                                            <li class="page_item"><a class='scrollSmint' id="contact" href="#"><?php echo onepage_get_option('onepage_our_contact_heading'); ?>
                                        <?php } else { ?><li class="page_item"><a class='scrollSmint' id="contact" href="#"><?php _e('Contact', 'onepage'); ?></a></li><?php } ?></a></li>

                                        <?php if (onepage_get_option('onepage_opt_menu_heading') != '') { ?>
                                            <li class="page_item"><a href="<?php echo onepage_get_option('onepage_opt_menu_link'); ?>"><?php echo onepage_get_option('onepage_opt_menu_heading'); ?></a></li>
<?php } else { ?>
<?php } ?>
                                    </ul>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- Header condition2 starts here -->

    <!-- **********************header ends************************* -->
    <!-- **********************slider************************* -->
    <div class="homepage_top_feature">
        <div class="slider_img_container">

            <?php if (onepage_get_option('onepage_slideimage1') != '') { ?>
                <img  src="<?php echo onepage_get_option('onepage_slideimage1'); ?>" alt="Slide Image 1"/>
            <?php } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" alt="slides img1">
                        <?php } ?>

            <div class="slider_text_container"><div class="container_24"><div class="grid_24">
                        <?php if (onepage_get_option('onepage_sliderheading1') != '') { ?>
                            <h2><a href="<?php echo onepage_get_option('onepage_Sliderlink1'); ?>"><?php echo onepage_get_option('onepage_sliderheading1'); ?></a></h2>
                        <?php } else { ?>
                            <h2><a><?php _e('A bene placito.', 'onepage'); ?></a></h2>
                        <?php } ?>
                        <?php if (onepage_get_option('onepage_sliderdes1') != '') { ?>
                            <p><a><?php echo onepage_get_option('onepage_sliderdes1'); ?></a></p>
<?php } else { ?>

                            <p><a><?php _e('You have just dined, and however scrupulously the slaughterhouse is concealed in the graceful distance of miles, there is complicity.', 'onepage'); ?></a></p>

<?php } ?>
                    </div></div></div>
        </div>

        <!-- slider 8 ends --------------------------------------------------------------->


    </div>
    <div class="clear"></div>
    <!-- ***********************Featured Text Area Block************************* -->
    <div class="featured_text_area default_bg">

        <div class="container_24">
            <?php if (onepage_get_option('onepage_page_main_heading') != '') { ?>
                <h1 id="fta_top"><?php echo stripslashes(onepage_get_option('onepage_page_main_heading')); ?></h1>
            <?php } else { ?>
                <h2 id="fta_top"><?php _e('Premium WordPress Themes with Single Click Installation', 'onepage'); ?></h2>
            <?php } ?>
            <?php if (onepage_get_option('onepage_page_sub_heading') != '') { ?>
                <p id="fta_bottom"><?php echo stripslashes(onepage_get_option('onepage_page_sub_heading')); ?></p>
            <?php } else { ?>
                <p id="fta_bottom"><?php _e('Just a Click and your website is ready for use. Your Site is faster to built, easy to use & Search Engine Optimized.', 'onepage'); ?></p>
<?php } ?>
        </div>
    </div>
    <div class="clear"></div>
    <!-- ***********************Our Services block************************* -->
    <div class="homepage_nav_title services">
        <?php if (onepage_get_option('onepage_our_services_heading') != '') { ?>
            <h1 class="index_titles"><?php echo stripslashes(onepage_get_option('onepage_our_services_heading')); ?></h1>
        <?php } else { ?>
            <h1 class="index_titles"><?php _e('Our Services', 'onepage'); ?></h1>
<?php } ?>

    </div>
    <div class="clear"></div>
    <!-- **content starts here** -->
    <div class="services_block default_bg">
        <div class="container_24">
            <div class="grid_24">
                <!-- box -->

                <div class="services_box_container">
                    <ul class="ch-grid">
                        <!-- box1 -->
                        <li id="services_box_container1">

                                <?php if (onepage_get_option('onepage_our_services_image1') != '') { ?>
                                <div class="ch-item ch-img-1" style="background: url(<?php echo onepage_get_option('onepage_our_services_image1'); ?>);">
                                    <?php } else { ?>
                                    <div class="ch-item ch-img-1" style="background: url(<?php echo get_template_directory_uri(); ?>/images/circle_img1.jpg);">
<?php } ?>
                                    <div class="ch-info-wrap">
                                        <div class="ch-info">
                                            <div class="ch-info-front ch-img-1">
                                                <?php if (onepage_get_option('onepage_our_services_image1') != '') { ?>
                                                    <img src="<?php echo onepage_get_option('onepage_our_services_image1'); ?>" />
                                                <?php } else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/circle_img1.jpg" />
<?php } ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="rect_box">
                                    <?php if (onepage_get_option('onepage_our_services_title1') != '') { ?>
                                        <p class="services_box_rect_head"><a <?php if (onepage_get_option('onepage_services_title_link1') != '') { ?>href="<?php echo stripslashes(onepage_get_option('onepage_services_title_link1')); ?><?php } else { ?><?php } ?>" target="_blank"><?php echo stripslashes(onepage_get_option('onepage_our_services_title1')); ?></a></p>
                                    <?php } else { ?>
                                        <p class="services_box_rect_head"><a href="http://inkthemes.com">Single Click Installation</a></p>
                                    <?php } ?>
                                    <?php if (onepage_get_option('onepage_our_services_desc1') != '') { ?>
                                        <p class="services_box_rect_para"><?php echo stripslashes(onepage_get_option('onepage_our_services_desc1')); ?></p>
                                    <?php } else { ?>

                                        <p class="services_box_rect_para"><?php _e('Just a Click and your website is ready for use. Your Site is faster to built, easy to use & Search Engine Optimized.', 'onepage'); ?></p>
<?php } ?>
                                </div>
                        </li>
                        <!-- box2 -->
                        <li id="services_box_container2">

                                <?php if (onepage_get_option('onepage_our_services_image2') != '') { ?>
                                <div class="ch-item ch-img-2" style="background: url(<?php echo onepage_get_option('onepage_our_services_image2'); ?>);">
                                    <?php } else { ?>
                                    <div class="ch-item ch-img-2" style="background: url(<?php echo get_template_directory_uri(); ?>/images/circle_img2.jpg);">
<?php } ?>
                                    <div class="ch-info-wrap">
                                        <div class="ch-info">
                                            <div class="ch-info-front ch-img-2">
                                                <?php if (onepage_get_option('onepage_our_services_image2') != '') { ?>
                                                    <img src="<?php echo onepage_get_option('onepage_our_services_image2'); ?>" />
                                                <?php } else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/circle_img2.jpg" />
<?php } ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="rect_box">
                                    <?php if (onepage_get_option('onepage_our_services_title2') != '') { ?>
                                        <p class="services_box_rect_head"><a <?php if (onepage_get_option('onepage_services_title_link2') != '') { ?>href="<?php echo stripslashes(onepage_get_option('onepage_services_title_link2')); ?><?php } else { ?><?php } ?>" target="_blank"><?php echo stripslashes(onepage_get_option('onepage_our_services_title2')); ?></a></p>
                                    <?php } else { ?>
                                        <p class="services_box_rect_head"><a href="http://inkthemes.com"><?php _e('Single Click Installation', 'onepage'); ?></a></p>
                                    <?php } ?>
                                    <?php if (onepage_get_option('onepage_our_services_desc2') != '') { ?>
                                        <p class="services_box_rect_para"><?php echo stripslashes(onepage_get_option('onepage_our_services_desc2')); ?></p>
                                    <?php } else { ?>

                                        <p class="services_box_rect_para"><?php _e('Just a Click and your website is ready for use. Your Site is faster to built, easy to use & Search Engine Optimized.', 'onepage'); ?></p>
<?php } ?>
                                </div>
                        </li>
                        <!-- box3 -->
                        <li id="services_box_container3">

                                <?php if (onepage_get_option('onepage_our_services_image3') != '') { ?>
                                <div class="ch-item ch-img-2" style="background: url(<?php echo onepage_get_option('onepage_our_services_image3'); ?>);">
                                    <?php } else { ?>
                                    <div class="ch-item ch-img-3" style="background: url(<?php echo get_template_directory_uri(); ?>/images/circle_img3.jpg);">
<?php } ?>
                                    <div class="ch-info-wrap">
                                        <div class="ch-info">
                                            <div class="ch-info-front ch-img-3">
                                                <?php if (onepage_get_option('onepage_our_services_image3') != '') { ?>
                                                    <img src="<?php echo onepage_get_option('onepage_our_services_image3'); ?>" />
                                                <?php } else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/circle_img3.jpg" />
<?php } ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="rect_box">
                                    <?php if (onepage_get_option('onepage_our_services_title3') != '') { ?>
                                        <p class="services_box_rect_head"><a <?php if (onepage_get_option('onepage_services_title_link3') != '') { ?>href="<?php echo stripslashes(onepage_get_option('onepage_services_title_link3')); ?><?php } else { ?><?php } ?>" target="_blank"><?php echo stripslashes(onepage_get_option('onepage_our_services_title3')); ?></a></p>
                                    <?php } else { ?>
                                        <p class="services_box_rect_head"><a href="http://inkthemes.com">Single Click Installation</a></p>
                                    <?php } ?>
                                    <?php if (onepage_get_option('onepage_our_services_desc3') != '') { ?>
                                        <p class="services_box_rect_para"><?php echo stripslashes(onepage_get_option('onepage_our_services_desc3')); ?></p>
                                    <?php } else { ?>

                                        <p class="services_box_rect_para"><?php _e('Just a Click and your website is ready for use. Your Site is faster to built, easy to use & Search Engine Optimized.', 'onepage'); ?></p>
<?php } ?>
                                </div>
                        </li>
                        <!-- box4 -->
                        <li id="services_box_container4">


                                <?php if (onepage_get_option('onepage_our_services_image4') != '') { ?>
                                <div class="ch-item ch-img-4" style="background: url(<?php echo onepage_get_option('onepage_our_services_image4'); ?>);">
                                    <?php } else { ?>
                                    <div class="ch-item ch-img-4" style="background: url(<?php echo get_template_directory_uri(); ?>/images/circle_img4.jpg);">
<?php } ?>
                                    <div class="ch-info-wrap">
                                        <div class="ch-info">
                                            <div class="ch-info-front ch-img-4">
                                                <?php if (onepage_get_option('onepage_our_services_image4') != '') { ?>
                                                    <img src="<?php echo onepage_get_option('onepage_our_services_image4'); ?>" />
                                                <?php } else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/circle_img4.jpg" />
<?php } ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="rect_box">
                                    <?php if (onepage_get_option('onepage_our_services_title4') != '') { ?>
                                        <p class="services_box_rect_head"><a <?php if (onepage_get_option('onepage_services_title_link4') != '') { ?>href="<?php echo stripslashes(onepage_get_option('onepage_services_title_link4')); ?><?php } else { ?><?php } ?>" target="_blank"><?php echo stripslashes(onepage_get_option('onepage_our_services_title4')); ?></a></p>
                                    <?php } else { ?>
                                        <p class="services_box_rect_head"><a href="http://inkthemes.com"><?php _e('Single Click Installation', 'onepage'); ?></a></p>
                                    <?php } ?>
                                    <?php if (onepage_get_option('onepage_our_services_desc4') != '') { ?>
                                        <p class="services_box_rect_para"><?php echo stripslashes(onepage_get_option('onepage_our_services_desc4')); ?></p>
                                    <?php } else { ?>

                                        <p class="services_box_rect_para"><?php _e('Just a Click and your website is ready for use. Your Site is faster to built, easy to use & Search Engine Optimized.', 'onepage'); ?></p>
<?php } ?>
                                </div>
                        </li>
                    </ul>
                </div>
                <!-- box4 ends -->
            </div>

            <div class="clear"></div>
        </div>
    </div>
    <!-- ***********************Recent Blogs************************* -->
    <div class="homepage_nav_title blogs">
        <?php if (onepage_get_option('onepage_recent_blog_heading') != '') { ?>
            <h1 class="index_titles"><?php echo stripslashes(onepage_get_option('onepage_recent_blog_heading')); ?></h1>
        <?php } else { ?>
            <h1 class="index_titles"><?php _e('Recent Blogs', 'onepage'); ?></h1>
<?php } ?>
        <div class="clear"></div>
    </div>

    <!-- ***Recent blog container starts** -->
        <?php if (onepage_get_option('onepage_bodybg') != '') { ?>
        <div class="featured_blog_content default_bg" style="background: url(<?php echo stripslashes(onepage_get_option('onepage_bodybg')); ?>);">
            <?php } else { ?>
            <div class="featured_blog_content default_bg">
<?php } ?>

            <div class="container_24"><div class="grid_24">
                    <!-- Start the Loop. -->
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
                            <?php
                            static $count = 0;
                            if ($count == "6") {
                                break;
                            } else {
                                ?>

                                <!--post start-->

                                <?php
                                if (!has_post_thumbnail()) {
                                    continue;
                                } else {
                                    if (strpos($post->post_content, '[gallery') !== false) {
                                        continue;
                                    } else {
                                        ?>
                                        <div class="post">
                                            <div class="post_heading_wrapper">
                                                <div class="postimage_container">
                                                    <span class="thumb">
                                                            <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                                                            <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail(); ?>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <span>
                                                            <?php
                                                            // Get the Name of First Category
//Fetching all the categories for the post and displaying first pocket
                                                            the_category(', ');
                                                            ?>
                                                        </span>
                                                    </span>
                                                    <div class="clear"></div>
                                                </div>
                                                <ul class="post_meta">
                                                    <li class="day"><?php echo get_the_time('d') ?></li>
                                                    <li class="month"><?php echo get_the_time('M') ?></li>
                                                    <li class="year"><?php echo get_the_time('Y') ?></li>
                                                    <li class="posted_by"><span><?php _e('by&nbsp;', 'onepage'); ?></span><?php the_author_posts_link(); ?></li>
                                                    <li class="post_comment"><?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?></li>
                                                </ul>
                                                <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                                            </div>
                                            <div class="post_content">
                    <?php the_excerpt(); ?>

                                                <a class="read-more" href="<?php the_permalink() ?>"><?php echo READ_MORE; ?></a>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <!--End Post-->
                                    <?php
                                    }
                                }
                                ?>
                                <?php
                                $count++;
                            }
                            ?>
        <?php
    endwhile;
else:
    ?>

                        <div class="blogs_page_container">
                            <p>
    <?php echo SORRY_NO_POST_MATCHED_YOUR_CRITERIA; ?>
                            </p>
                        </div>
<?php endif; ?>
                    <!--End Loop-->
                </div></div>
        </div>
        <div class="clear"></div>
        <!-- ***Recent blog container* ends** -->
        <!-- ***********************Gallery Page************************* -->

        <!-- *******************************Gallery Ends here***************** -->

        <!-- ***********************Contact Page************************* -->
        <div class="homepage_nav_title contact">
            <?php if (onepage_get_option('onepage_our_contact_heading') != '') { ?>
                <h1 class="index_titles"><?php echo stripslashes(onepage_get_option('onepage_our_contact_heading')); ?></h1>
<?php } else { ?>
                <h1 class="index_titles"><?php _e('Contact', 'onepage'); ?></h1>
<?php } ?>
        </div>



        <div class="clear"></div>
        <!-- ***contact content*** -->
                <?php if (onepage_get_option('onepage_bodybg') != '') { ?>
            <div class="contact_wrapper default_bg" style="background: url(<?php echo stripslashes(onepage_get_option('onepage_bodybg')); ?>);">
<?php } else { ?>
                <div class="contact_wrapper default_bg">
<?php } ?>
                <div class="container_24">
                    <div class="grid_24">
                        <div class="contact_container">
                            <div class="add_n_map">
                                    <div class="anchor_bordera">
                                        <?php if (onepage_get_option('onepage_our_contact_sub_heading') != '') { ?>
                                            <h1><?php echo stripslashes(onepage_get_option('onepage_our_contact_sub_heading')); ?></h1>
                                        <?php } else { ?>
                                            <h1><?php _e('Address', 'onepage'); ?></h1>
                                        <?php } ?>
                                    </div>
                                    <div><div class="contact-image-bookmark-icon"></div>
                                        <?php if (onepage_get_option('onepage_contact_address') != '') { ?>
                                            <p><?php echo stripslashes(onepage_get_option('onepage_contact_address')); ?></p>
                                        <?php } else { ?>
                                            <p><?php _e('Address -  The Address', 'onepage'); ?></p>
                                        <?php } ?>
                                    </div>
                                    <div><div class="contact-image-tele-icon"></div>
                                        <?php if (onepage_get_option('onepage_contact_phone_no') != '') { ?>
                                            <p><?php echo stripslashes(onepage_get_option('onepage_contact_phone_no')); ?></p>
                                        <?php } else { ?>
                                            <p><?php _e('Phone - 1245 213 689', 'onepage'); ?></p>
                                        <?php } ?>
                                    </div>
                                    <div><div class="contact-image-mail-icon"></div>
                                        <?php if (onepage_get_option('onepage_ontact_email') != '') { ?>
                                            <p><?php echo stripslashes(onepage_get_option('onepage_ontact_email')); ?></p>
                                        <?php } else { ?>
                                            <p>Email - name@example.com</p>
                                        <?php } ?>
                                    </div>
                                    <div><div class="contact-image-globe-icon"></div>
                                        <?php if (onepage_get_option('onepage_contact_website') != '') { ?>
                                            <p><?php echo stripslashes(onepage_get_option('onepage_contact_website')); ?></p>
                                        <?php } else { ?>
                                            <p><?php _e('Website', 'onepage'); ?> - www.example.com</p>
                                        <?php } ?>
                                    </div>
                                </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>


            <!-- ***********************Contact Page Ends************************* -->
<?php get_footer(); ?> 