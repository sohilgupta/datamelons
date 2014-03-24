<?php

global $wp_version;

$Data = $this->get_data( 'user_role' );
$UserRoles = $this->get_user_role();

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );

if ( version_compare( $wp_version , '3.8' , '<' ) ) {
	wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '-3.7.css', array() , $this->Ver );
} else {
	wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );
}

?>
<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php echo $this->Name; ?></h2>
	<p><?php _e( 'Customize the UI of the management screen for all users.' , $this->ltd ); ?></p>
	<p><?php _e ( 'Please select the user roles that all settings will apply to.' , $this->ltd ); ?></p>
	<p class="description"><?php _e( 'Please use the Multiple Add-on If you want settings on User role basis.' , $this->ltd ); ?></p>
	<p><strong><span style="color: orange;">new</span> <a href="<?php echo $this->Site; ?>multiple_about/?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank">WP Admin UI Customize Multiple Add-on</a></strong></p>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<div id="postbox-container-1" class="postbox-container">

				<div id="about_plugin">

					<div class="stuffbox" id="donationbox">
						<div class="inside">
							<p style="color: #FFFFFF; font-size: 20px;"><?php _e( 'Donate' , $this->ltd ); ?></p>
							<p style="color: #FFFFFF;"><?php _e( 'You are contented with this plugin?<br />By the laws of Japan, Japan\'s new paypal user can not make a donation button.<br />So i would like you to buy this plugin as the replacement for the donation.' , $this->ltd ); ?></p>
							<p>&nbsp;</p>
							<p style="text-align: center;">
								<a href="<?php echo $this->AuthorUrl; ?>line-break-first-and-end/?utm_source=use_plugin&utm_medium=donate&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" class="button-primary" target="_blank">Line Break First and End</a>
							</p>
							<p>&nbsp;</p>
							<div class="donation_memo">
								<p><strong><?php _e( 'Features' , $this->ltd ); ?></strong></p>
								<p><?php _e( 'Line Break First and End plugin is In the visual editor TinyMCE, It is a plugin that will help when you will not be able to enter a line break.' , $this->ltd ); ?></p>
							</div>
							<div class="donation_memo">
								<p><strong><?php _e( 'The primary use of donations' , $this->ltd ); ?></strong></p>
								<ul>
									<li>- <?php _e( 'Liquidation of time and value' , $this->ltd ); ?></li>
									<li>- <?php _e( 'Additional suggestions feature' , $this->ltd ); ?></li>
									<li>- <?php _e( 'Maintain motivation' , $this->ltd ); ?></li>
									<li>- <?php _e( 'Ensure time as the father of Sunday' , $this->ltd ); ?></li>
								</ul>
							</div>
						</div>
					</div>
		
					<div class="stuffbox" id="aboutbox">
						<h3><span class="hndle"><?php _e( 'About plugin' , $this->ltd ); ?></span></h3>
						<div class="inside">
							<p><?php _e( 'Version checked' , $this->ltd ); ?> : 3.6.1 - 3.8.1</p>
							<ul>
								<li><a href="<?php echo $this->Site; ?>?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank"><?php _e( 'Plugin\'s site' , $this->ltd ); ?></a></li>
								<li><a href="<?php echo $this->AuthorUrl; ?>?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank"><?php _e( 'Developer\'s site' , $this->ltd ); ?></a></li>
								<li><a href="http://wordpress.org/support/plugin/<?php echo $this->PluginSlug; ?>" target="_blank"><?php _e( 'Support Forums' ); ?></a></li>
								<li><a href="http://wordpress.org/support/view/plugin-reviews/<?php echo $this->PluginSlug; ?>" target="_blank"><?php _e( 'Reviews' , $this->ltd ); ?></a></li>
								<li><a href="https://twitter.com/gqevu6bsiz" target="_blank">twitter</a></li>
								<li><a href="http://www.facebook.com/pages/Gqevu6bsiz/499584376749601" target="_blank">facebook</a></li>
							</ul>
						</div>
					</div>
		
					<div class="stuffbox" id="usefulbox">
						<h3><span class="hndle"><?php _e( 'Useful plugins' , $this->ltd ); ?></span></h3>
						<div class="inside">
							<p><strong><span style="color: orange;">new</span> <a href="<?php echo $this->Site; ?>multiple_about/?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank">WP Admin UI Customize Multiple Add-on</a></strong></p>
							<p class="description"><?php _e( 'This add-on is simply settings of multi user roles.' , $this->ltd ); ?></p>
							<p><strong><a href="<?php echo $this->Site; ?>import_export_about/?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank">WP Admin UI Customize Import &amp; Export Add-on</a></strong></p>
							<p class="description"><?php _e( 'This add-on is Import/Export easily of the settings data.' , $this->ltd ); ?></p>
							<p><strong><a href="<?php echo $this->Site; ?>multisite_about/?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank">WP Admin UI Customize for Multisite</a></strong></p>
							<p class="description"><?php _e( 'This add-on is an add-on to unify the management screen of all sites.' , $this->ltd ); ?></p>
							<p><strong><a href="http://wordpress.org/extend/plugins/post-lists-view-custom/" target="_blank">Post Lists View Custom</a></strong></p>
							<p class="description"><?php _e( 'Customize the list of the post and page. custom post type page, too. You can customize the column display items freely.' , $this->ltd ); ?></p>
							<p><strong><a href="http://wordpress.org/extend/plugins/announce-from-the-dashboard/" target="_blank">Announce from the Dashboard</a></strong></p>
							<p class="description"><?php _e( 'Announce to display the dashboard. Change the display to a different user role.' , $this->ltd ); ?></p>
							<p><strong><a href="http://wordpress.org/extend/plugins/custom-options-plus-post-in/" target="_blank">Custom Options Plus Post in</a></strong></p>
							<p class="description"><?php _e( 'The plugin that allows you to add the value of the options. Option value that you have created, can be used in addition to the template tag, Short code can be used in the body of the article.' , $this->ltd ); ?></p>
							<p>&nbsp;</p>
						</div>
					</div>

				</div>

			</div>

			<div id="postbox-container-2" class="postbox-container">

				<div id="user_role">

					<form id="wauc_setting_default" class="wauc_form" method="post" action="<?php echo remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ); ?>">
						<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
						<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
						<input type="hidden" name="record_field" value="user_role" />
		
						<div class="postbox">
							<h3 class="hndle"><span><?php _e( 'User Roles' ); ?></span></h3>
							<div class="inside">
								<?php $field = 'user_role'; ?>
								<?php foreach($UserRoles as $role_name => $val) : ?>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$role_name] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<p>
										<label>
											<input type="checkbox" name="data[<?php echo $field; ?>][<?php echo $role_name; ?>]" value="1" <?php echo $Checked; ?> />
											<?php echo $val["label"]; ?>
										</label>
									</p>
								<?php endforeach; ?>
							</div>
						</div>
		
						<p class="submit">
							<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
						</p>
				
						<p class="submit reset">
							<span class="description"><?php _e( 'Reset all settings?' , $this->ltd ); ?></span>
							<input type="submit" class="button-secondary" name="reset" value="<?php _e( 'Reset settings' , $this->ltd ); ?>" />
						</p>
		
						<p>&nbsp;</p>
						
					</form>

					<form id="donation_form" class="wauc_form" method="post" action="<?php echo remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ); ?>">
						<h3><?php _e( 'If you have already donated to.' , $this->ltd ); ?></h3>
						<p><?php _e( 'Please enter the \'Donation delete key\' that have been described in the \'Line Break First and End download page\'.' , $this->ltd ); ?></p>
						<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
						<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
						<label for="donate_key"><?php _e( 'Donation delete key' , $this->ltd ); ?></label>
						<input type="text" name="donate_key" id="donate_key" value="" class="regular-text" />
						<input type="submit" class="button-primary" name="update" value="<?php _e( 'Submit' ); ?>" />
					</form>
					
					<p>&nbsp;</p>

					<div class="stuffbox" style="border-color: #FFC426; border-width: 3px;">
						<h3 style="background: #FFF2D0; border-color: #FFC426;"><span class="hndle"><?php _e( 'Have you want to customize?' , $this->ltd ); ?></span></h3>
						<div class="inside">
							<p style="float: right;">
								<img src="<?php echo $this->Schema; ?>www.gravatar.com/avatar/7e05137c5a859aa987a809190b979ed4?s=46" width="46" /><br />
								<a href="<?php echo $this->AuthorUrl; ?>contact-us/?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank">gqevu6bsiz</a>
							</p>
							<p><?php _e( 'I am good at Admin Screen Customize.' , $this->ltd ); ?></p>
							<p><?php _e( 'Please consider the request to me if it is good.' , $this->ltd ); ?></p>
							<p>
								<a href="<?php echo $this->Site; ?>blog/category/example/?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank"><?php _e ( 'Example Customize' , $this->ltd ); ?></a> :
								<a href="<?php echo $this->Site; ?>contact/?utm_source=use_plugin&utm_medium=side&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank"><?php _e( 'Contact me' , $this->ltd ); ?></a></p>
						</div>
					</div>

				</div>

			</div>

			<br class="clear">

		</div>

	</div>

</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
	var $RDonated = '<?php echo get_option( $this->Record["donate"] ); ?>';
	var $TDonated = '<?php echo $this->DonateKey; ?>';

	if( $RDonated == $TDonated ) {
		$("#donationbox").hide();
		if( $TDonated != "" ) {
			$("#donation_form").html( '<p>&nbsp;</p><p>&nbsp;</p><span class="description"><?php _e( 'Thank you for your donation.' , $this->ltd ); ?></span>' );
		} else {
			$("#donation_form").html( '' );
		}
	}
		
});
</script>
