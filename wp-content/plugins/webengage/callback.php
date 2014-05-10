<?php
        $wlc = isset($_REQUEST['webengage_license_code']) ? htmlspecialchars($_REQUEST['webengage_license_code'], ENT_COMPAT, 'UTF-8') : "";
	$vm = isset($_REQUEST['verification_message']) ? htmlspecialchars($_REQUEST['verification_message'], ENT_COMPAT, 'UTF-8') : "";
	$wwa = isset($_REQUEST['webengage_widget_status']) ? htmlspecialchars($_REQUEST['webengage_widget_status'], ENT_COMPAT, 'UTF-8') : "";
	if(isset($wlc)){
		?>
		<html>
			<body>
				<form id="postbackToWp" name="postbackToWp" method="post" target="_top">
					<input type="hidden" name="weAction" value="wp-save"/>
					<input type="hidden" name="verification_message" value="<?php echo $vm; ?>"/>
					<input type="hidden" name="webengage_license_code" value="<?php echo $wlc; ?>"/>
					<input type="hidden" name="webengage_widget_status" value="<?php echo $wwa; ?>"/>					
				</form>
				<script type="text/javascript">
					document.getElementById("postbackToWp").setAttribute("action", parent.parent.window.location.href + "&noheader=true");
					document.getElementById("postbackToWp").submit();
				</script>
			</body>
		</html>
	<?php
	}		
	exit;
?>