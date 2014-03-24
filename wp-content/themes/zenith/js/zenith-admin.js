$j = jQuery.noConflict();

$j(document).ready(

	function() {

		// Upload image         
		$j('#zenith_logo_upload_button').click(function() {
			formfield = $j(this).prev().attr('id');
			tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
			return false;
		});

		// Insert the image url into the input field
		window.send_to_editor = function(html) {       
			fileurl = $j('img', html).attr('src');  
			$j('#' + formfield).val(fileurl);     
			tb_remove();
		}
	
	}

);