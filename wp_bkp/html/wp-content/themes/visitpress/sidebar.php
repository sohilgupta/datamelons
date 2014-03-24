<?php
/**
 * The sidebar template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
?><div id="sidebar">
    <div class="widget-area">
    <?php if ( has_nav_menu( 'sidebar-menu' ) ) { ?>
      <div id="sidebar-navigation">
        <?php wp_nav_menu( array( 'theme_location'=>'sidebar-menu', 'items_wrap' => '<p class="sidebar-headline">'.__( 'Sidebar navigation', 'visitpress' ).'</p><ul id="%1$s" class="%2$s">%3$s</ul>' ) ); ?>
      </div><?php } ?>
      <?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
      <?php endif; ?>
    </div> 
  </div>