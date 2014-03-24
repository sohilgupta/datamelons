// closure to avoid namespace collision
(function(){
	// creates the plugin
	root = userSettings.simplr_plugin_dir;
	
	tinymce.create('tinymce.plugins.simplr_reg', {
		// creates control instances based on the control's id.
		// our button's id is &quot;reg_button&quot;
		createControl : function(id, controlManager) {
			if (id == 'simplr_reg_button') {
				// creates the button
				var button = controlManager.createButton('simpr_reg_button', {
					title : 'Registration Form', // title of the button
					image : root+'registration_24x24.png',  // path to the button's image
					onclick : function() {
						// do something when the button is clicked :)
						jQuery('#reg-form').show().after('<div class="media-modal-backdrop"></div>');
					}
				});
				return button;
			}
			return null;
		}
	});
	
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('simplr_reg', tinymce.plugins.simplr_reg);
	
	// executes this when the DOM is ready
	jQuery(document).ready(function(){
		// creates a form to be displayed everytime the button is clicked
		jQuery('#wpfooter').append(function() {
				jQuery(this).after('<div id="hook"></div>');
				jQuery('#hook').load(root + 'simplr_reg_options.php');
		});

		//for backward compatibilty
		jQuery('#footer').append(function() {
                        jQuery(this).after('<div id="hook"></div>');
                        jQuery('#hook').load(root + 'simplr_reg_options.php');
                 });
			
		jQuery('a.media-modal-close').live('click',function() {
			jQuery('#reg-form').hide();
			jQuery('.media-modal-backdrop').remove();
		});
	
	});

	
})()
