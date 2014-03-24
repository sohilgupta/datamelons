<?php
/**
 * The footer template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
?>
<div id="wrapper-footer">
  <div id="footer">
    <div class="footer-widget-area">
      <?php if ( dynamic_sidebar( 'sidebar-2' ) ) : else : ?>
      <?php endif; ?>
      <?php if ( dynamic_sidebar( 'sidebar-3' ) ) : else : ?>
      <?php endif; ?>
      <?php if ( dynamic_sidebar( 'sidebar-4' ) ) : else : ?>
      <?php endif; ?>
    </div>
    <?php if ( dynamic_sidebar( 'sidebar-5' ) ) : else : ?>
    <?php endif; ?>    
  </div>
</div>
 
<?php wp_footer(); ?>      
</body>
</html>