   <footer>
   
   <?php get_sidebar('footer'); ?>
     
     <div class="footer-down">
      <div class="container clearfix">
        
        <div class="eight columns">
         <span class="copyright">
         <?php echo vp_option('copyright'); ?> by 
         <a href="http://themesmarts.com/" target="_blank">ThemeSmarts</a></span>
        </div><!-- End copyright -->
        
        <div class="eight columns">
        
        <?php if( vp_option('enable_footer_icons') == '1'){ ?>
          <div class="social">
          
           <?php if( vp_option('twitter') != '' ){ ?>
           <a href="<?php echo vp_option('twitter'); ?>"><i class="social_icon-twitter s-14"></i></a>
           <?php } ?>
           
           <?php if( vp_option('facebook') != '' ){ ?>
           <a href="<?php echo vp_option('facebook'); ?>"><i class="social_icon-facebook s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('dribbble') != '' ){ ?>
           <a href="<?php echo vp_option('dribbble'); ?>"><i class="social_icon-dribbble s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('google') != '' ){ ?>
           <a href="<?php echo vp_option('google'); ?>"><i class="social_icon-gplus s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('pinterest') != '' ){ ?>
           <a href="<?php echo vp_option('pinterest'); ?>"><i class="social_icon-pinterest s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('youtube') != '' ){ ?>
           <a href="<?php echo vp_option('youtube'); ?>"><i class="social_icon-youtube s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('enablerss') != '' ){ ?>
           <a href="<?php bloginfo('rss2_url'); ?>"><i class="social_icon-rss s-18"></i></a>
           <?php } ?>
           
          </div>
        <?php } ?>
          
        </div><!-- End social icons -->
        
      </div><!-- End container -->
     </div><!-- End footer-top -->
     
   </footer><!-- <<< End Footer >>> -->
  
  </div><!-- End wrap -->
  
  <!-- Start JavaScript -->
  <script src="js/jquery-1.9.1.min.js"></script> <!-- jQuery library -->
  <script src="js/jquery.easing.1.3.min.js"></script> <!-- jQuery Easing --> 
  <script src="js/jquery-ui/jquery.ui.core.js"></script> <!-- jQuery Ui Core-->
  <script src="js/jquery-ui/jquery.ui.widget.js"></script> <!-- jQuery Ui Widget -->
  <script src="js/jquery-ui/jquery.ui.accordion.js"></script> <!-- jQuery Ui accordion--> 
  <script src="js/jquery-cookie.js"></script> <!-- jQuery cookie -->  
  <script src="js/ddsmoothmenu.js"></script> <!-- Nav Menu ddsmoothmenu -->
  <script src="js/jquery.flexslider.js"></script> <!-- Flex Slider  -->
  <script src="js/colortip.js"></script> <!-- Colortip Tooltip Plugin  -->
  <script src="js/tytabs.js"></script> <!-- jQuery Plugin tytabs  -->
  <script src="js/jquery.ui.totop.js"></script> <!-- UItoTop plugin  -->
  <script src="js/carousel.js"></script> <!-- jQuery Carousel  -->
  <script src="js/jquery.isotope.min.js"></script> <!-- Isotope Filtering  -->
  <script src="js/twitter/jquery.tweet.js"></script> <!-- jQuery Tweets -->
  <script src="js/jflickrfeed.min.js"></script> <!-- jQuery Flickr -->
  <script src="js/social-options.js"></script> <!-- social options , twitter, flickr.. -->
  <script src="js/doubletaptogo.js"></script> <!-- Touch-friendly Script  -->
  <script src="js/fancybox/jquery.fancybox.js"></script> <!-- jQuery FancyBox -->
  <script src="js/jquery.sticky.js"></script> <!-- jQuery Sticky -->
  <script src="js/custom.js"></script> <!-- Custom Js file for javascript in html -->
  <!-- End JavaScript -->
   
  <?php wp_footer(); ?>
    
</body>
</html>