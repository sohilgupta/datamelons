<script>
jQuery.noConflict();
form = jQuery('#reg-form');
submit = jQuery('#reg-submit');
table = jQuery('#reg-form');

jQuery('#sortable').sortable();

form.hide();
// handles the click event of the submit button
submit.click(function(){	
	// defines the options and their default values
	// again, this is not the most elegant way to do this
	// but well, this gets the job done nonetheless
	var options = { 
		'role'    : 'subscriber',
		'message' : '',
		'notify' : '',
		'password' : 'no',
		'thanks'	: '',
		'fields': ''
		};
	var shortcode = '[register';
	
	for( var index in options) {
		if(index == 'fields') {
				
				//set cfields
				var vals = new Array();
				jQuery('input[name="cfield"]:checked').each(function(i,obj) {
						vals[i] = jQuery(obj).attr('rel');
				});	
				console.log(vals);
				shortcode += ' fields="'+vals.join()+'"';
		} else {
 			var value = table.find('#reg-' + index).val();
			if ( value !== options[index]) {
				shortcode += ' ' + index + '="' + value + '"';
			}
		}
	}
	
	shortcode += ']';
	
	// inserts the shortcode into the active editor
	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
	// closes Thickbox
	jQuery('#reg-form').hide();
	jQuery('.media-modal-backdrop').remove();
});
</script>
<?php
$wp_load = '../../../wp-load.php';
$wp_load = (!file_exists($wp_load)) ? rtrim( ABSPATH , '/' ) . 'wp-load.php' : $wp_load;
require_once($wp_load); 
$pages = get_pages();
?>
<style>
.column-wrap {
	background:#f7f7f7;
	padding: 0px 0 0 20px;
	border-bottom:1px solid #eee;
}

.column {
	width: 40%;
	float:left;
	padding:10px;
}

#reg-submit { 
	float:left;
	margin: 10px 0 0 20px;
}

.sreg-form-item {
	margin: 10px 0 10px 0px;
	color: #666;
	float:left;
	clear:both;
	width:100%;
}

#reg-form label {
	width:100%;
	font-size: 1.2em;
	clear:both;
	display:block;
	text-shadow: inset 1px 1px 2px #666;
}

#reg-form input[type=text], #reg-form select, #reg-form textarea {
	float:left;
	margin:10px 0;
	padding:5px;
	clear:both;
}

#reg-form input[type=text],textarea {
	width: 100%;
}

#sortable .item {
        background: #f7f7f7;
        border:1px solid #ccc;
        padding: 5px;
        margin: 5px;
}

#sortable .item:hover {
        cursor:move;
}

#sortable .item input {
	margin:0 5px 0 0;
}
small {
	float:left;
	clear:both;
	font-style:italic;
	color:#999;
}

</style>
<div id="reg-form">
<div class="media-modal wp-core-ui">
	<a class="media-modal-close" href="#" title="Close"><span class="media-modal-icon"></span></a>
	<div class="media-modal-content">
		<div class="media-frame wp-core-ui">
			<div class="media-frame-menu">
				<div class="media-menu">
					<a href="#" class='media-menu-item'>Registration Form</a>
				</div>
			</div><!--.media-frame-menu-->
			<div class="media-frame-title"><h1>Registration Form</h1></div>
			<div class="media-frame-router">
				<div class="media-router">
					<a href="#" class="media-menu-item active">Options</a>
				</div>
			</div>
			<div class="media-frame-content">
				<div class="column-wrap">
					<div class="column">
						<div class="sreg-form-item">
							<label for="reg-role">Role</label>	
							<small>Specify the registration user role.</small>
							<select name="role" id="reg-role">
								<option value="">Select role ... </option>
								<?php global $wp_roles; ?>
								<?php foreach($wp_roles->role_names as $k => $v): ?>
									<?php if($k != 'administrator'): ?>
									<option value="<?php echo $k; ?>" <?php if($k == 'subscriber') { echo 'selected'; } ?>><?php echo $v; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="sreg-form-item">
							<label for="reg-thanks">Thank You page</label>
							<small>Leave blank to display message on this page. </small>
					
							<select class="chzn" id="reg-thanks">
								<option value="">Select</option>
									<?php foreach($pages as $page): ?>
									<option value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="sreg-form-item">
							<label for="reg-role">Message</label>
							<small>Confirmation for registered users. </small>
							<textarea id="reg-message" name="message" rows=10></textarea><br/>			
						</div>
				</div><!--.column-->
				<div class="column">
						<div class="sreg-form-item">
							<label for="reg-role">Notifications</label>
							<small>Notify these emails.</small>
						
							<input type="text" id="reg-notify" name="notify" value=""></input>
						</div>
				
						<div class="sreg-form-item">
							<label for="reg-password">Password</label>
						
							<small>Select "yes" to allow users to set their password.</small>			
							<select id="reg-password" name="password">
								<option value="no">No</option>
							<option value="yes">Yes</option>
							</select>
						</div>

					<div class="sreg-form-item">
						<h4>Custom Fields</h4>
				
						<!--<input id="fields" name="fields" class="fields" type="text" value="" /><br/>
						Enter a comma-separated list of fields you would like to include in this form. Below are the available fields. <br/> <strong>Fields:</strong><br/>-->
						<?php $list = new SREG_Fields(); ?>
						<div id="sortable">
						<?php foreach($list->custom_fields as $field): 
							echo '<div class="item"><input type="checkbox" name="cfield" value="1" rel="'.$field['key'].'"> '. $field['label'] . ' ( <em>'.$field['key'].'</em> )<br/></div>';
						endforeach; ?>
						</div>
					</div>		
				</div><!--.column-->
			</div><!--.column-wrap-->
		</div><!--.media-frame-content-->
		<div class="media-frame-toolbar">
			<input type="submit" id="reg-submit" class="button-primary" value="Insert Registration Form" name="submit" />
		</div>
	</div><!--.media-frame-->
	</div><!--.media-modal-content-->
</div><!--.media-modal-->
</div><!--#reg-form-->
