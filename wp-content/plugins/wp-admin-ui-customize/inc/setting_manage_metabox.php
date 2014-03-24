<?php

global $wp_version;

$Data = $this->get_data( 'manage_metabox' );
$Metaboxes = $this->get_data( "regist_metabox" );
$CustomPosts = $this->get_custom_posts();

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
	<h2><?php _e( 'Manage meta box' , $this->ltd ); ?></h2>
	<p><?php _e( 'Please update or add a "post" and a "page" to load the available meta boxes.' , $this->ltd ); ?></p>
	<p><?php _e( 'Please enter if you want to change of Metabox label name.' , $this->ltd ); ?></p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<form id="wauc_setting_manage_metabox" class="wauc_form" method="post" action="<?php echo remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="manage_metabox" />

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">
					<div id="built_in">

						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Post' ); ?></span></h3>
							<div class="inside">
			
								<?php if( empty( $Metaboxes["metaboxes"]["post"] ) ) : ?>
			
									<p><?php _e( 'Could not read the meta box.' , $this->ltd ); ?></p>
									<p><?php echo sprintf( __( 'Meta boxes will be loaded automatically when you <strong>%s</strong>.' , $this->ltd ) , __( 'Edit Post' ) ); ?></p>
								
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
											<?php foreach( $Metaboxes["metaboxes"]["post"] as $context => $meta_box ) : ?>
												<?php foreach( $meta_box as $priority => $box ) : ?>
													<?php foreach( $box as $metabox_id => $metabox_title ) : ?>

														<tr>
															<th>
																<?php _e( $metabox_title ); ?>
															</th>
															<td>
																<?php if( $metabox_id != 'submitdiv' ) : ?>
																	<?php $Checked = ''; ?>
																	<?php if( !empty( $Data["post"][$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																	<label><input type="checkbox" name="data[post][<?php echo $metabox_id; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																<?php else : ?>
																	<?php _e( 'Show' ); ?>
																<?php endif; ?>
															</td>
															<td>
																<?php $Val = ''; ?>
																<?php if( !empty( $Data["post"][$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data["post"][$metabox_id]["name"] ) ); endif; ?>
																<input type="text" name="data[post][<?php echo $metabox_id; ?>][name]" class="regular-text" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
																<?php if( $metabox_id == 'commentstatusdiv' ) : ?>
																	<p class="description"><?php _e( 'Notice: If hide the Discussion on metabox, comments does not display of Add New Post on apply user role.' , $this->ltd ); ?></p>
																	<p><img src="<?php echo $this->Url; ?>images/discussion_allow_comments.png" /></p>
																	<p><a href="<?php echo admin_url( 'admin.php?page=' . $this->PageSlug . '_post_add_edit_screen' ); ?>"><?php _e( 'Please set from here if you want to view the comments on screen.' , $this->ltd ); ?></a></p>
																<?php endif; ?>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endforeach; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
			
			
								<?php endif; ?>
							</div>
						</div>

						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Page' ); ?></span></h3>
							<div class="inside">
			
								<?php if( empty( $Metaboxes["metaboxes"]["page"] ) ) : ?>
			
									<p><?php _e( 'Could not read the meta box.' , $this->ltd ); ?></p>
									<p><?php echo sprintf( __( 'Meta boxes will be loaded automatically when you <strong>%s</strong>.' , $this->ltd ) , __( 'Edit Page' ) ); ?></p>
								
								<?php else: ?>
			
									<table class="form-table">
										<thead>
											<tr>
												<th>&nbsp;</th>
												<td style="width: 15%;">
													<input type="checkbox" name="" class="check_all" />
													<strong><?php _e( 'Show on screen' ); ?></strong>
												</td>
												<td><strong><?php _e( 'Change metabox title to' ); ?></strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach( $Metaboxes["metaboxes"]["page"] as $context => $meta_box ) : ?>
												<?php foreach( $meta_box as $priority => $box ) : ?>
													<?php foreach( $box as $metabox_id => $metabox_title ) : ?>
														<tr>
															<th>
																<?php _e( $metabox_title ); ?>
															</th>
															<td>
																<?php if( $metabox_id != 'submitdiv' ) : ?>
																	<?php $Checked = ''; ?>
																	<?php if( !empty( $Data["page"][$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																	<label><input type="checkbox" name="data[page][<?php echo $metabox_id; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																<?php else : ?>
																	<?php _e( 'Show' ); ?>
																<?php endif; ?>
															</td>
															<td>
																<?php $Val = ''; ?>
																<?php if( !empty( $Data["page"][$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data["page"][$metabox_id]["name"] ) ); endif; ?>
																<input type="text" name="data[page][<?php echo $metabox_id; ?>][name]" class="regular-text" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
																<?php if( $metabox_id == 'commentstatusdiv' ) : ?>
																	<p class="description"><?php _e( 'Notice: If hide the Discussion on metabox, comments does not display of Add New Post on apply user role.' , $this->ltd ); ?></p>
																	<p><img src="<?php echo $this->Url; ?>images/discussion_allow_comments.png" /></p>
																	<p><a href="<?php echo admin_url( 'admin.php?page=' . $this->PageSlug . '_post_add_edit_screen' ); ?>"><?php _e( 'Please set from here if you want to view the comments on screen.' , $this->ltd ); ?></a></p>
																<?php endif; ?>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endforeach; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
			
								<?php endif; ?>
			
							</div>
						</div>

					</div>
				</div>
				
				<?php if ( !empty( $CustomPosts ) ) : ?>
				
				<div id="postbox-container-2" class="postbox-container">
					<div id="custom_post">
						
						<?php foreach( $CustomPosts as $post_name => $cpt ) : ?>
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php echo strip_tags( $cpt->labels->name ); ?></span></h3>
							<div class="inside">
			
								<?php if( empty( $Metaboxes["metaboxes"][$post_name] ) ) : ?>
			
									<p><?php _e( 'Could not read the meta box.' , $this->ltd ); ?></p>
									<p><?php echo sprintf( __( 'Meta boxes will be loaded automatically when you <strong>%s</strong>.' , $this->ltd ) , strip_tags( $cpt->labels->edit_item ) ); ?></p>
								
								<?php else: ?>
			
									<table class="form-table">
										<thead>
											<tr>
												<th>&nbsp;</th>
												<td style="width: 15%;">
													<input type="checkbox" name="" class="check_all" />
													<strong><?php _e( 'Show on screen' ); ?></strong>
												</td>
												<td><strong><?php _e( 'Change metabox title to' ); ?></strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach( $Metaboxes["metaboxes"][$post_name] as $context => $meta_box ) : ?>
												<?php foreach( $meta_box as $priority => $box ) : ?>
													<?php foreach( $box as $metabox_id => $metabox_title ) : ?>
														<?php if( !empty( $metabox_id ) ) : ?>
															<tr>
																<th><?php echo $metabox_title; ?></th>
																<td>
																	<?php if( $metabox_id != 'submitdiv' ) : ?>
																		<?php $Checked = ''; ?>
																		<?php if( !empty( $Data[$post_name][$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																		<label><input type="checkbox" name="data[<?php echo $post_name; ?>][<?php echo $metabox_id; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																	<?php else : ?>
																		<?php _e( 'Show' ); ?>
																	<?php endif; ?>
																</td>
															<td>
																<?php $Val = ''; ?>
																<?php if( !empty( $Data[$post_name][$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data[$post_name][$metabox_id]["name"] ) ); endif; ?>
																<input type="text" name="data[<?php echo $post_name; ?>][<?php echo $metabox_id; ?>][name]" class="regular-text" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
															</td>
															</tr>
														<?php endif; ?>
													<?php endforeach; ?>
												<?php endforeach; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
			
								<?php endif; ?>
			
							</div>
						</div>
						<?php endforeach; ?>

					</div>
				</div>
				
				<?php endif; ?>
				
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

	var $Form = $("#wauc_setting_manage_metabox");
	$("input.check_all", $Form).click(function() {
		var Checked = $(this).prop("checked");
		$Table = $(this).parent().parent().parent().parent();
		$Table.children("tbody").children("tr").each(function() {
			$(this).find("input[type=checkbox]").prop("checked" , Checked);
		});
	});

});
</script>