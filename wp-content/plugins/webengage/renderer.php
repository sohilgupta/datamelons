<?php
	$old_value = get_option('webengage_license_code');
	$we_widget_status = get_option('webengage_widget_status');
	$siteUrl = get_option('siteurl');
	$folder = plugin_dir_url(__FILE__);
	$next_url = plugin_dir_url(__FILE__) . "callback.php?noheader=true";
	$page_url = $siteUrl . '/wp-admin/options-general.php?page=webengage&noheader=true';
	$email = get_option('admin_email');
	$urlArr = parse_url($siteUrl);
	$domainName = getSiteDomain();
	$webengage_host_name = "webengage.com";
	$webengage_host = 'http://'.$webengage_host_name;
	$secure_webengage_host = 'https://'.$webengage_host_name;
	$resend_email_url = $webengage_host . "/thirdparty/signup.html?action=resendVerificationEmail&licenseCode=" . urlencode($old_value) . "&next=". urlencode($next_url) . 
				"&activationUrl=" . urlencode($page_url."&weAction=activate") . "&weAction=activate&channel=wordpress";
        if (is_user_logged_in()){
               $current_user = wp_get_current_user();
               $userFullName = $current_user->user_firstname . " " . $current_user->user_lastname;
        } else {
               $userFullName = "";
        };
?>
<link href="<?php echo $folder ?>main.css" type="text/css" rel="stylesheet" />
<div class="wrap Configuration">
	<div id="icon-options-general" class="icon32"></div><h2>WebEngage Configuration</h2>
	<?php
		// rendering message/error-message as a wp-message if any
		if($_REQUEST['message']) {
	 ?>
		<div id="message" class="updated fade" style="font-size:16px;">
			<p><?php echo htmlspecialchars($_REQUEST['message'], ENT_COMPAT, 'UTF-8') ?></p>
		</div>
	<?php } else if ($_REQUEST['error-message']) { ?>
		<div id="message" class="error fade">
			<p><?php echo htmlspecialchars($_REQUEST['error-message'], ENT_COMPAT, 'UTF-8') ?></p>
		</div>
	<?php } else if ($we_widget_status != '' && $we_widget_status === 'PENDING') { ?>
		<?php 
			$discard_url = $page_url."&weAction=discardMessage"."&webengage_license_code=".$old_value;
		?>
		<div id="message" class="error fade">
			<p>Your WebEngage plugin is not active currently because the email associated with your account needs to be verified.
				We have sent you the activation email already, please follow the instructions therein. In case you haven't received the email, <a class="resend-email-link" href="#">click here to resend the activation email</a>.<span class="discard-msg">[ <a onclick="return confirm('Do you really wish to discard this message?');" href="<?php echo $discard_url ?>" title="Discard this message">discard</a> ]</span></p>
		</div>
	<?php
		}
	?>
	<div class="webengage-container">
		<div class="webengage-logo-container">
			<span/>
		</div>

		<?php if (!$old_value || $old_value === '') { ?>
			<div class="webengage-form-container">
				<div class="webengage-form inline-forms">
					<h3>New to WebEngage? Create your account</h3>
					<hr/>
					<?php 
						$src_url = $secure_webengage_host. "/thirdparty/signup.html?". "next=". urlencode($next_url) .
											 "&em=".urlencode($email)."&domain=".urlencode($siteUrl).
											 "&activationUrl=".urlencode($page_url."&weAction=activate").
											 "&channel=wordpress" . "&nm=" . urlencode($userFullName);
					?>
					<div id="webengage-loading-info">Loading, please wait ...</div>
					<iframe src="<?php echo $src_url; ?>" class="webengage-iframe signup-iframe" id="we-signup-iframe" marginheight="0" frameborder="0" style="height:0;background-color:transparent;" allowTransparency="true"></iframe>
				</div>

				<div class="webengage-form inline-forms">
					<h3>Already a Webengage user? Add license code for <?php echo $domainName ?></h3>
					<hr>
					<p>Copy the license code for <?php echo $domainName; ?> from your <a target="_blank" class="external_icon" href="<?php echo $webengage_host ?>/publisher/dashboard">WebEngage Dashboard</a> and paste it here.</p>
					<form method="get" action="<?php echo $page_url; ?>">
							<label for="webengage_license_code"><b>Your WebEngage License Code</b></label>
							<input id="webengage_license_code" type="text" name="webengage_license_code" placeholder="License Code" value="<?php echo $old_value ?>"/>
							<input type="hidden" value="wp-save" name="weAction" />
							<input type="hidden" value="webengage" name="page" />
							<input type="hidden" value="true" name="noheader" />
							<input type="hidden" value="submit" name="submit"/>
							<button type="submit">Save</button>
					</form>
				</div>

				<br class="clear"/>
			</div>
		<?php } else { ?>
			<div class="webengage-form-container">
				<form method="get" action="<?php echo $page_url ?>">
					<label for="webengage_license_code"><b>Your WebEngage License Code</b></label>
					<input readonly="true" id="webengage_license_code" type="text" name="webengage_license_code" placeholder="License Code" value="<?php echo $old_value ?>"/>
					<input type="hidden" value="wp-save" name="weAction"/>
					<input type="hidden" value="webengage" name="page" />
					<input type="hidden" value="true" name="noheader" />
					<input type="hidden" value="submit" name="submit"/>
					<span><a id="update-license-code-link" href="#">Change</a></span>
					<span>
						or, <a href="<?php echo $page_url ?>&weAction=reset" onclick="return confirm('Do you wish to change your email or domain name for this plugin?');">Reset</a>
					</span>
				</form>
				<script type="text/javascript">
					var changeLink = document.getElementById("update-license-code-link");
					changeLink.onclick = function(){
						document.getElementById("webengage_license_code").removeAttribute("readonly");
						this.parentNode.innerHTML = '<button type="submit">Save</button>';
						return false;
					}
				</script>
			</div>
			
			<div class="webengage-instructions">
				Your WebEngage widget is installed. What's next?
				<ol>
					<li>
						Manage this widget from your <a href="http://webengage.com/publisher/dashboard">WebEngage dashboard</a>. List of things you can do -
						<ul style="padding-left:30px;">
							<li style="margin-top:6px;"><b>Feedback</b>: Create your feedback tab with custom text and colors. Choose your language for the widget. Manage your categories and fields for feedback.</li>
							<li><b>Surveys</b>: Create surveys and add targeting rules for them. Modify CSS to customize the survey skin to match your site's look and feel. View realtime analytics & reports.</li>
							<li><b>Notifications</b>: Create short notification and add targeting rules to show it to a specific set of audience. Drive traffic. Increase conversion. Get real-time reports.</li>
						</ul>
					</li>
					<li>The widget is not appearing on your site even after saving the license code? This is most likely beacause you haven't verified your email yet. <a class="resend-email-link" href="#">Resend the activation email</a>.</li>
					<li>Can't access your dashboard? Try <a href="http://webengage.com/user/account.html?action=viewForgot">forgot password</a>. If nothing works, please <a href="http://webengage.com/contact">get in touch</a> with us.</li>
					<li>Choose from a range of <a href="http://webengage.com/pricing">pricing plans</a> that fits your requirement. Uprades or downgrades done in the dashboard reflect automatically on your site without changing anything in the plugin.</li>
				</ol>
			</div>
			<script>
				window.onload = function() {
					var resendLinks = document.getElementsByTagName('a');
					for(var i = 0; i < resendLinks.length; i++) {
				    		var resendLink = resendLinks[i];
				    		if(resendLink.className === 'resend-email-link') {
							resendLink.onclick = function() {
					    			var newFrame = document.createElement("iframe");
								newFrame.style.height = "0px";
								newFrame.setAttribute("marginheight", "0");
								newFrame.setAttribute("frameborder", "0");
								newFrame.setAttribute("src", "<?php echo $resend_email_url; ?>");
								document.body.appendChild(newFrame);
								return false;
							}
			    			}
					}
			    	}
			</script>
			<br class="clear"/>
		<?php } ?>
	</div>
	<script type="text/javascript">
	 if (document.getElementById('we-signup-iframe')) {
	   var resizeIframe = function (height) {
	     document.getElementById('we-signup-iframe').style.height = (parseInt(height) + 60) + "px";
	   };
	   if (typeof window['addEventListener'] !== 'undefined' && typeof window['postMessage'] !== 'undefined') {
	     window.addEventListener("message", function (e) {
	       if (e.origin.search('<?php echo $webengage_host_name; ?>') < 0) {
		 return;
	       }
	       resizeIframe(e.data);
	     }, false);
	   }
	   document.getElementById('we-signup-iframe').onload = function () {
	     if (typeof window['addEventListener'] === 'undefined' || typeof window['postMessage'] === 'undefined') {
	       document.getElementById('we-signup-iframe').style.height = "450px";
	     }
	     setTimeout(function () {
	       if (document.getElementById('webengage-loading-info')) {
		 document.getElementById('webengage-loading-info').style.display = 'none';
	       }
	     }, 500);
	   };
	 }
	</script>
</div>
