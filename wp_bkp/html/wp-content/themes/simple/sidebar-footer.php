<?php if ( is_active_sidebar(2) ) { ?>

     <div class="footer-top">
      <div class="container clearfix">
        
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) :  endif; ?>
        
      </div><!-- End container -->
     </div><!-- End footer-top -->
     
<?php } ?>