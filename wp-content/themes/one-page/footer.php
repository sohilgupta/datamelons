<!-- ***********************Footer Page Starts************************* -->
<div class="footer">
    <div class="container_24">
        <div class="grid_24">
            <?php
            /* A sidebar in the footer? Yep. You can can customize
             * your footer with four columns of widgets.
             */
            get_sidebar('footer');
            ?>
        </div>
    </div>
</div>
<!-- ***********************Footer Page Ends************************* -->
<!-- ***********************Copyright starts************************* -->
<div class="copyright_wrapper">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_12 alpha">
                <div class="copyright_text">
                    <p><a href="http://www.inkthemes.com/" alt="OnePage">One page</a> Theme Powered By <a href="http://www.wordpress.org" alt="WordPress">WordPress</a></p>
                </div>
            </div>
            <div class="grid_12 omega">
                <div class="footer_social_icons">
                    <ul class="social_logos">			
                        <?php if (onepage_get_option('onepage_facebook') != '') { ?>
                            <li class="fb"><a href="<?php echo onepage_get_option('onepage_facebook'); ?>" alt="Facebook icon" target="_blank"></a></li>   
                        <?php } ?>  
                        <?php if (onepage_get_option('onepage_twitter') != '') { ?>
                            <li class="tw"><a href="<?php echo onepage_get_option('onepage_twitter'); ?>" alt="Twitter icon" target="_blank"></a></li>
                        <?php } ?>  
                        <?php if (onepage_get_option('onepage_google') != '') { ?>
                            <li class="gp"><a href="<?php echo onepage_get_option('onepage_google'); ?>" alt="Google Plus icon" target="_blank"></a></li>
                        <?php } ?>  
                        <?php if (onepage_get_option('onepage_rss') != '') { ?>
                            <li class="ln"><a href="<?php echo onepage_get_option('onepage_rss'); ?>" alt="RSS" target="_blank"></a></li>
                        <?php } ?>  
                        <?php if (onepage_get_option('onepage_pinterest') != '') { ?>
                            <li class="pn"><a href="<?php echo onepage_get_option('onepage_pinterest'); ?>" alt="Pinterest" target="_blank"></a></li>
                        <?php } ?> 
                        <?php if (onepage_get_option('onepage_youtube') != '') { ?>
                            <li class="yt"><a href="<?php echo onepage_get_option('onepage_youtube'); ?>" alt="YouTube icon" target="_blank"></a></li> 
                            <?php } ?>  

                    </ul> 
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ***********************Copyright Ends************************* -->
<?php wp_footer(); ?>
</body>
</html>