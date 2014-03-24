<?php

function sc_social_connect_admin_menu(){
	add_options_page('Social Connect', 'Social Connect', 'manage_options', 'social-connect-id', 'sc_render_social_connect_settings' );
	add_action( 'admin_init', 'sc_register_social_connect_settings' );
}
add_action('admin_menu', 'sc_social_connect_admin_menu' );

function sc_register_social_connect_settings(){
	register_setting( 'social-connect-settings-group', 'social_connect_facebook_enabled' );  
	register_setting( 'social-connect-settings-group', 'social_connect_facebook_api_key' );
	register_setting( 'social-connect-settings-group', 'social_connect_facebook_secret_key' );

	register_setting( 'social-connect-settings-group', 'social_connect_twitter_enabled' );
	register_setting( 'social-connect-settings-group', 'social_connect_twitter_consumer_key' );
	register_setting( 'social-connect-settings-group', 'social_connect_twitter_consumer_secret' );

	register_setting( 'social-connect-settings-group', 'social_connect_google_enabled' );      
	register_setting( 'social-connect-settings-group', 'social_connect_yahoo_enabled' );      
	register_setting( 'social-connect-settings-group', 'social_connect_wordpress_enabled' );    
}

function sc_render_social_connect_settings(){
	?>
	<div class="wrap">
		<h2><?php _e('Social Connect Settings', 'social_connect'); ?></h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'social-connect-settings-group' ); ?>
			<h3><?php _e('Facebook Settings', 'social_connect'); ?></h3>
			<p><?php _e('To connect your site to Facebook, you need a Facebook Application. If you have already created one, please insert your API & Secret key below.', 'social_connect'); ?></p>
			<p><?php printf(__('Already registered? Find your keys in your <a target="_blank" href="%2$s">%1$s Application List</a>', 'social_connect'), 'Facebook', 'http://www.facebook.com/developers/apps.php'); ?></li>
				<p><?php _e('Need to register?', 'social_connect'); ?></p>
				<ol>
					<li><?php printf(__('Visit the <a target="_blank" href="%1$s">Facebook Application Setup</a> page', 'social_connect'), 'http://www.facebook.com/developers/createapp.php'); ?></li>
					<li><?php printf(__('Get the API information from the <a target="_blank" href="%1$s">Facebook Application List</a>', 'social_connect'), 'http://www.facebook.com/developers/apps.php'); ?></li>
					<li><?php _e('Select the application you created, then copy and paste the API key & Application Secret from there.', 'social_connect'); ?></li>
				</ol>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Enable?', 'social_connect'); ?></th>
						<td>
							<input type="checkbox" name="social_connect_facebook_enabled" value="1" <?php checked(get_option('social_connect_facebook_enabled', 1 ), 1 ); ?> /><br/>
							<?php _e('Check this box to enable register/login using Facebook.', 'social_connect'); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('API Key', 'social_connect'); ?></th>
						<td><input type="text" name="social_connect_facebook_api_key" value="<?php echo get_option('social_connect_facebook_api_key' ); ?>" /></td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('Secret Key', 'social_connect'); ?></th>
						<td><input type="text" name="social_connect_facebook_secret_key" value="<?php echo get_option('social_connect_facebook_secret_key' ); ?>" /></td>
					</tr>
				</table>

				<h3><?php _e('Twitter Settings', 'social_connect'); ?></h3>
				<p><?php _e('To offer login via Twitter, you need to register your site as a Twitter Application and get a <strong>Consumer Key</strong>, a <strong>Consumer Secret</strong>, an <strong>Access Token</strong> and an <strong>Access Token Secret</strong>.', 'social_connect'); ?></p>
				<p><?php printf(__('Already registered? Find your keys in your <a target="_blank" href="%2$s">%1$s Application List</a>', 'social_connect'), 'Twitter', 'https://dev.twitter.com/apps'); ?></p>
				<p><?php printf(__('Need to register? <a href="%1$s">Register an Application</a> and fill the form with the details below:', 'social_connect'), 'http://dev.twitter.com/apps/new'); ?>
					<ol>
						<li><?php _e('Application Type: <strong>Browser</strong>', 'social_connect'); ?></li>
						<li><?php printf(__('Callback URL: <strong>%1$s</strong>', 'social_connect'), SOCIAL_CONNECT_PLUGIN_URL . '/twitter/callback.php'); ?></li>
						<li><?php _e('Default Access: <strong>Read &amp; Write</strong>', 'social_connect'); ?></li>
					</ol>
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><?php _e('Enable?', 'social_connect'); ?></th>
							<td>
								<input type="checkbox" name="social_connect_twitter_enabled" value="1" <?php checked(get_option('social_connect_twitter_enabled' ), 1 ); ?> /><br/>
								<?php _e('Twitter integration requires the generation of dummy email addresses for authenticating users.<br/>Please check with your domain administrator as this may require changes to your mail server.', 'social_connect'); ?>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e('Consumer Key', 'social_connect'); ?></th>
							<td><input type="text" name="social_connect_twitter_consumer_key" value="<?php echo get_option('social_connect_twitter_consumer_key' ); ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e('Consumer Secret', 'social_connect'); ?></th>
							<td><input type="text" name="social_connect_twitter_consumer_secret" value="<?php echo get_option('social_connect_twitter_consumer_secret' ); ?>" /></td>
						</tr>
					</table>

					<h3><?php _e('OpenID Providers', 'social_connect'); ?></h3>
					<p><?php _e('Choose the OpenID providers your visitors can use to register, comment and login.', 'social_connect'); ?></p>
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Google</th>
							<td>
								<input type="checkbox" name="social_connect_google_enabled" value="1" <?php checked(get_option('social_connect_google_enabled', 1 ), 1 ); ?> />
							</td>
						</tr>        
						<tr valign="top">
							<th scope="row">Yahoo</th>
							<td>
								<input type="checkbox" name="social_connect_yahoo_enabled" value="1" <?php checked(get_option('social_connect_yahoo_enabled', 1 ), 1 ); ?> />
							</td>
						</tr>        
						<tr valign="top">
							<th scope="row">WordPress.com</th>
							<td>
								<input type="checkbox" name="social_connect_wordpress_enabled" value="1" <?php checked(get_option('social_connect_wordpress_enabled', 1 ), 1 ); ?> />
							</td>
						</tr>        
					</table>

					<p class="submit">
						<input type="submit" class="button-primary" value="<?php _e('Save Changes' ) ?>" />
					</p>
				</form>
			</div> <?php
	}
