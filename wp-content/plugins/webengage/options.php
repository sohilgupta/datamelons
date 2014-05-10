<?php
  // adding hook for the webengage admin menu page
  add_action('admin_menu', 'admin_menu_webengage');
  // adding admin menu page for the webengage plugin
  function admin_menu_webengage () {
      add_options_page('WebEngage', 'WebEngage', 'manage_options', 'webengage', 'webengage_options');
  }
  // options page handler function
  function webengage_options () {
      if ($_REQUEST['weAction'] === 'wp-save') {
          $message = update_webengage_options();
          wp_redirect(get_option('siteurl'). '/wp-admin/options-general.php?page=webengage&' . $message[0] . "=" . urlencode($message[1])); exit;
      } else if ($_REQUEST['weAction'] === 'reset') {
          $message = reset_webengage_options();
          wp_redirect(get_option('siteurl'). '/wp-admin/options-general.php?page=webengage&'. $message[0] . "=" . urlencode($message[1])); exit;
      } else if ($_REQUEST['weAction'] === 'activate') {
          $message = activate_we_widget();
          wp_redirect(get_option('siteurl'). '/wp-admin/options-general.php?page=webengage&'. $message[0] . "=" . urlencode($message[1])); exit;
      } else if ($_REQUEST['weAction'] === 'discardMessage') {
          discard_status_message();
          wp_redirect(get_option('siteurl'). '/wp-admin/options-general.php?page=webengage'); exit;
      } else {
          print_webengage_form();
      }
  }
  // discarding the widget status message, in case user activated account on WebEngage Dashboard
  function discard_status_message () {
	delete_option('webengage_widget_status');
  }
  // resetting webengage option
  function reset_webengage_options() {
		delete_option('webengage_license_code');
		delete_option('webengage_widget_status');
		return array("message", "Your WebEngage options are deleted. You can signup for a new account.");
  }
  // updating webengage option
  function update_webengage_options() {
	$wlc = isset($_REQUEST['webengage_license_code']) ? htmlspecialchars($_REQUEST['webengage_license_code'], ENT_COMPAT, 'UTF-8') : "";
	$vm = isset($_REQUEST['verification_message']) ? htmlspecialchars($_REQUEST['verification_message'], ENT_COMPAT, 'UTF-8') : "";
	$wws = isset($_REQUEST['webengage_widget_status']) ? htmlspecialchars($_REQUEST['webengage_widget_status'], ENT_COMPAT, 'UTF-8') : "ACTIVE";
	if(!empty($wlc)) {
		update_option('webengage_license_code', trim($wlc));
		update_option('webengage_widget_status', $wws);
		$msg = !empty($vm) ? $vm : "Your WebEngage widget license code has been updated.";
		return array("message", $msg);
	} else {
		return array("error-message", "Please add a license code.");
	}
  }
  // activating webengage widget
  function activate_we_widget(){
	$wlc = isset($_REQUEST['webengage_license_code']) ? htmlspecialchars($_REQUEST['webengage_license_code'], ENT_COMPAT, 'UTF-8') : "";
	$old_value = get_option('webengage_license_code');
	$wws = isset($_REQUEST['webengage_widget_status']) ? htmlspecialchars($_REQUEST['webengage_widget_status'], ENT_COMPAT, 'UTF-8') : "ACTIVE";
	if ($wlc === $old_value) {
		update_option('webengage_widget_status', $wws);
		$msg = "Your plugin installation is complete. You can do further customizations from your WebEngage dashboard.";
		return array("message", $msg);
	} else {
		$msg = "Unauthorized plugin activation request";
		return array("error-message", $msg);
	}
  }
  //returns blog.com:9999 if a port is present in the site url
  function getSiteDomain(){
  	return str_replace("http://", "", get_option('siteurl'));
  }
  // printing the webengage options form
  function print_webengage_form () {
		require_once(WP_PLUGIN_DIR . '/webengage/renderer.php');
	}
?>
