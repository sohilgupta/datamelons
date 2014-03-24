<?php

global $wp_version;

$Data = $this->get_data( 'dashboard' );
$Metaboxes = $this->get_data( "regist_dashboard_metabox" );

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
	<h2><?php _e( 'Dashboard' ); ?><?php _e( 'Settings' ); ?></h2>
	<p>&nbsp;</p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<form id="wauc_setting_dashboard" class="wauc_form" method="post" action="<?php echo remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="dashboard" />

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">
					<div id="dashboard">
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Meta boxes' , $this->ltd ); ?></span></h3>
							<div class="inside">
								
								<?php if ( version_compare( $wp_version , '3.8' , '<' ) ) : ?>

									<table class="form-table">
										<tbody>
											<?php $field = 'show_welcome_panel'; ?>
											<tr>
												<th>
													<label><?php _e( 'Welcome Panel' , $this->ltd ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_right_now'; ?>
											<tr>
												<th>
													<label><?php _e( 'Right Now' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_recent_comments'; ?>
											<tr>
												<th>
													<label><?php _e( 'Recent Comments' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_incoming_links'; ?>
											<tr>
												<th>
													<label><?php _e( 'Incoming Links' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_plugins'; ?>
											<tr>
												<th>
													<label><?php _e( 'Plugins' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_quick_press'; ?>
											<tr>
												<th>
													<label><?php _e( 'QuickPress' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_recent_drafts'; ?>
											<tr>
												<th>
													<label><?php _e( 'Recent Drafts' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_primary'; ?>
											<tr>
												<th>
													<label><?php _e( 'WordPress Blog' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
											<?php $field = 'dashboard_secondary'; ?>
											<tr>
												<th>
													<label><?php _e( 'Other WordPress News' ); ?></label>
												</th>
												<td>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												</td>
											</tr>
										</tbody>
									</table>

								<?php else: ?>
									
									<?php if( empty( $Metaboxes["metaboxes"]["dashboard"] ) ) : ?>
					
										<p><?php _e( 'Could not read the meta box.' , $this->ltd ); ?></p>
										<p><?php echo sprintf( __( 'Meta boxes will be loaded automatically when you <strong>%s</strong>.' , $this->ltd ) , __( 'Dashboard' ) ); ?></p>
									<?php else: ?>
											
										<table class="form-table">
											<thead>
												<tr>
													<th>&nbsp;</th>
													<td style="width: 15%;">
														<input type="checkbox" name="" class="check_all" />
														<strong><?php _e( 'Show on screen' ); ?></strong>
													</td>
													<td><strong><?php _e( 'Change metabox title to' , $this->ltd ); ?></strong></td>
												</tr>
											</thead>
											<tbody>
												<?php $field = 'show_welcome_panel'; ?>
												<tr>
													<th>
														<label><?php _e( 'Welcome Panel' , $this->ltd ); ?></label>
													</th>
													<td>
														<?php $Checked = ''; ?>
														<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
														<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
													</td>
													<td></td>
												</tr>
												<?php foreach( $Metaboxes["metaboxes"]["dashboard"] as $context => $meta_box ) : ?>
													<?php foreach( $meta_box as $priority => $box ) : ?>
														<?php foreach( $box as $metabox_id => $metabox_title ) : ?>
															<?php if( !empty( $metabox_id ) ) : ?>
																<tr>
																	<th>
																		<label><?php _e( $metabox_title ); ?></label>
																	</th>
																	<td>
																		<?php $Checked = ''; ?>
																		<?php if( !empty( $Data[$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																		<label><input type="checkbox" name="data[<?php echo $metabox_id; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																	</td>
																	<td>
																		<?php $Val = ''; ?>
																		<?php if( !empty( $Data[$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data[$metabox_id]["name"] ) ); endif; ?>
																		<input type="text" name="data[<?php echo $metabox_id; ?>][name]" class="regular-text" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
																	</td>
																</tr>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php endforeach; ?>
												<?php endforeach; ?>
											</tbody>
										</table>
											
									<?php endif; ?>

								<?php endif; ?>
							</div>
						</div>
			
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Other' , $this->ltd ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'metabox_move'; ?>
										<tr>
											<th>
												<label><?php _e( 'Meta box movement restriction' , $this->ltd ); ?></label>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e( "Lock meta box positions" , $this->ltd ); ?></label>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<br class="clear">

			</div>

		</div>

		<p class="submit">
			<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
		</p>

		<p class="submit reset">
			<span class="description"><?php _e( 'Reset all settings?' , $this->ltd ); ?></span>
			<input type="submit" class="button-secondary" name="reset" value="<?php _e( 'Reset settings' , $this->ltd ); ?>" />
		</p>

	</form>

</div>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$( document ).on("click", "#wauc_setting_dashboard input.check_all", function() {
		var Checked = $(this).prop("checked");
		$Table = $(this).parent().parent().parent().parent();
		$Table.children("tbody").children("tr").each(function( key, el ) {
			$(el).find("input[type=checkbox]").prop("checked" , Checked);
		});
	});

});
</script>