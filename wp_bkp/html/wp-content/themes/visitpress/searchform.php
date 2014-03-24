<?php
/**
 * The searchform template file.
 * @package VisitPress
 * @since VisitPress 1.0
*/
?>
<form id="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
  <div><input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search...', 'visitpress' ); ?>" /></div>
  <div><input type="image" src="<?php echo get_template_directory_uri(); ?>/images/empty.gif" class="send" name="searchsubmit" alt="send" /></div>
</form>