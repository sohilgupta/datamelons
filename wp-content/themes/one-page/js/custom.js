	
jQuery(document).ready( function() {
    jQuery('.subMenu').smint({
    	'scrollSpeed' : 700
    });
});

//Menu Init
jQuery.noConflict();
(function($){ //create closure so we can safely use $ as alias for jQuery

			$(document).ready(function(){
				// initialise plugin
				var example = $('#example-sf-menu').superfish({
					//add options here if required
				});
			});
		})(jQuery);

	