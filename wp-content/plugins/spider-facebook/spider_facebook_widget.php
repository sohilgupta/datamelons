<?php
	class spider_facebook extends WP_Widget {
	// Constructor //
		function spider_facebook() {
			$widget_ops = array( 'classname' => 'spider_facebook', 'description' => 'Facebook Widget' ); // Widget Settings
			$control_ops = array( 'id_base' => 'spider_facebook' ); // Widget Control Settings
			$this->WP_Widget( 'spider_facebook', 'Spider Facebook', $widget_ops, $control_ops ); // Create the widget
		}
		
	// Extract Args //
		function widget($args, $instance) {
		extract( $args );
$title= apply_filters('widget_title', $instance['title']);
			
	// Before widget //
	
			echo $before_widget;
	// Title of widget //
			if ( $title ) { echo $before_title . $title . $after_title; }
			
			if($instance['spider_facebook'])
			echo spider_facebook_front_end($instance['spider_facebook']);
 
	// After widget //
			echo $after_widget;
		}
	// Update Settings //
		function update($new_instance, $old_instance) {
			$instance['title']			 = $new_instance['title'];
			$instance['spider_facebook'] = $new_instance['spider_facebook'];
			return $instance;
		}
	// Widget Control Panel //
		function form($instance) {
		$defaults = array( 'title' => '','spider_facebook'=>'0');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
            <select id="<?php echo $this->get_field_id('spider_facebook'); ?>" name="<?php echo $this->get_field_name('spider_facebook'); ?>'">
            <option value="0"> Select a Facebook </option>
            <?php global $wpdb;  
			$facbooks=$wpdb->get_results('SElECT * FROM '.$wpdb->prefix.'spiderfacebook_params');
			foreach($facbooks as $facbook)
			{
			?>
            <option <?php if( $instance['spider_facebook']==$facbook->id) echo 'selected="selected"'; ?>   value="<?php echo $facbook->id ?>" ><?php echo $facbook->title  ?></option>
            
            
            <?php } ?>
            
            </select>
		</script>
         <?php }
		
}
// End class zoom_widget
add_action('widgets_init', create_function('', 'return register_widget("spider_facebook");'));
?>