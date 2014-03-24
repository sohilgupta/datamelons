<?php
/*
 * Theme Settings
 * 
 * @package Zenith
 * @subpackage Settings
 * @since 0.1.0
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
add_action( 'admin_menu', 'zenith_theme_admin_setup' );

function zenith_theme_admin_setup() {
    
	global $theme_settings_page;
	
	/* Get the theme settings page name */
	$theme_settings_page = 'appearance_page_theme-settings';

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'zenith_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'zenith_theme_validate_settings' );
	
	/* Enqueue styles */
	add_action( 'admin_enqueue_scripts', 'zenith_admin_scripts' );

}

/* Adds custom meta boxes to the theme settings page. */
function zenith_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'zenith-theme-meta-box', // Name/ID
		__( 'General', 'zenith' ), // Label
		'zenith_theme_meta_box', // Callback function
		'appearance_page_theme-settings', // Page to load on, leave as is
		'normal', // Which meta box holder?
		'high' // High/low within the meta box holder
	);
	
	/* Add a custom meta box. */
	add_meta_box(
		'zenith-theme-meta-box-2', // Name/ID
		__( 'Template: Showcase', 'zenith' ), // Label
		'zenith_theme_meta_box_2', // Callback function
		'appearance_page_theme-settings', // Page to load on, leave as is
		'side', // Which meta box holder?
		'high' // High/low within the meta box holder
	);

}

/* Function for displaying the first meta box. */
function zenith_theme_meta_box() { ?>

	<table class="form-table">
	
		<!-- Logo upload -->

		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'zenith_logo_url' ); ?>"><?php _e( 'Logo:', 'zenith' ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'zenith_logo_url' ); ?>" name="<?php echo hybrid_settings_field_name( 'zenith_logo_url' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'zenith_logo_url' ) ); ?>" />
				<input id="zenith_logo_upload_button" class="button" type="button" value="Upload" />
				<p class="description"><?php _e( 'Upload image for logo. Once uploaded, click the Insert Into Post button. If that does not work, copy the address of the image and paste it in the input field above. Next, click on Save Settings buton at the bottom of this page. The image will automatically display here after settings are saved.', 'zenith' ); ?></p>
				
				<?php /* Display uploaded image */
				if ( hybrid_get_setting( 'zenith_logo_url' ) ) { ?>
                    <p><img src="<?php echo hybrid_get_setting( 'zenith_logo_url' ); ?>" alt="" style="max-width: 90%;" /></p>
				<?php } ?>
			</td>
		</tr>
		
		<!-- Global Layout -->
		<tr>
			<th>
			    <label><?php _e( 'Global Layout:', 'zenith' ); ?></label>
			</th>
			<td>
				<ul>
					<li>
						<label><input type="radio" name="<?php echo esc_attr( hybrid_settings_field_name( 'zenith_global_layout' ) ); ?>" value="default" <?php echo esc_attr( hybrid_get_setting( 'zenith_global_layout', true ) ) == 'default' ? 'checked="checked"' : '' ?>> <?php echo __( 'Default', 'devpress'  ) ?></label>
					</li>
				
					<li>
						<label><input type="radio" name="<?php echo esc_attr( hybrid_settings_field_name( 'zenith_global_layout' ) ); ?>" value="1c" <?php echo esc_attr( hybrid_get_setting( 'zenith_global_layout', true ) ) == '1c' ? 'checked="checked"' : '' ?>> <?php echo __( 'One Column', 'devpress'  ) ?></label>
					</li>
				
					<li>
						<label><input type="radio" name="<?php echo esc_attr( hybrid_settings_field_name( 'zenith_global_layout' ) ); ?>" value="2c-r" <?php echo esc_attr( hybrid_get_setting( 'zenith_global_layout', true ) ) == '2c-r' ? 'checked="checked"' : '' ?>> <?php echo __( 'Two Columns, Right', 'devpress'  ) ?></label>
					</li>
					
				</ul>

			    <p class="description"><?php _e( 'Set the layout for the entire site. The default layout is Two Columns, Left. The exception is any page using the Showcase page template, which will always be one column.', 'zenith' ); ?></p>
			</td>
		</tr>
		

	</table><!-- .form-table -->

<?php }

/* Function for displaying the second meta box. */
function zenith_theme_meta_box_2() { ?>

	<p>
		<span class="description">
			<?php _e( 'The following settings are for the Showcase template.', 'zenith' ); ?>
		</span>
	</p>

	<table class="form-table">
	
		<!-- Number of Featured Posts -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'zenith_featured_posts' ); ?>"><?php _e( 'Number of Featured Posts:', 'zenith' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'zenith_featured_posts' ); ?>" name="<?php echo hybrid_settings_field_name( 'zenith_featured_posts' ); ?>" value="<?php echo absint( hybrid_get_setting( 'zenith_featured_posts' ) ); ?>" /></p>
				<p><?php _e( 'Enter the number of featured posts you want to display. Default is five.', 'zenith' ); ?></p>
			</td>
		</tr>
		
		<!-- Number of Recent Posts -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'zenith_recent_posts' ); ?>"><?php _e( 'Number of Recent Posts:', 'zenith' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'zenith_recent_posts' ); ?>" name="<?php echo hybrid_settings_field_name( 'zenith_recent_posts' ); ?>" value="<?php echo absint( hybrid_get_setting( 'zenith_recent_posts' ) ); ?>" /></p>
				<p><?php _e( 'Enter the number of recent posts you want to display. Default is four.', 'zenith' ); ?></p>
			</td>
		</tr>

	</table><!-- .form-table -->
	
<?php }

/* Validate theme settings. */
function zenith_theme_validate_settings( $settings ) {

	$settings['zenith_logo_url'] = esc_url_raw( $settings['zenith_logo_url'] );
	$settings['zenith_global_layout'] = strip_tags( $settings['zenith_global_layout'] );
	$settings['zenith_featured_posts'] = absint( $settings['zenith_featured_posts'] );
	$settings['zenith_recent_posts'] = absint( $settings['zenith_recent_posts'] );

    /* Return the array of theme settings. */
    return $settings;
}

/* Enqueue scripts (and related stylesheets) */
function zenith_admin_scripts( $hook_suffix ) {
    
    global $theme_settings_page;
	
    if ( $theme_settings_page == $hook_suffix ) {

	    wp_enqueue_script( 'zenith-admin', get_template_directory_uri() . '/js/zenith-admin.js', array( 'jquery', 'media-upload' ), '20121231', false );

    }
}

?>