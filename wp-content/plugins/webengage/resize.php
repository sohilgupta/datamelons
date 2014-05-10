<?php $height = isset($_REQUEST['height']) ? (int) htmlspecialchars($_REQUEST['height'], ENT_COMPAT) : 0; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<script type="text/javascript">
			try{
				window.parent.parent.resizeIframe(<?php echo $height; ?>);
				var loadingDiv = parent.parent.window.document.getElementById("webengage-loading-info");
				if(loadingDiv){
					loadingDiv.parentNode.removeChild(loadingDiv);
				}
			}catch(e){}
		</script>
	</head>
</html>