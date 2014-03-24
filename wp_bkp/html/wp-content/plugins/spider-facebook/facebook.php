<?php 
/*
Plugin Name: Wordpress Facebook
Plugin URI: http://web-dorado.com/products/wordpress-facebook.html
Description: Spider Facebook is a WordPress integration tool for Facebook. It includes all the available Facebook social plugins and widgets to be added to your website. As a result, Spider Facebook plugin can help you to fully integrate your website with Facebook. Eventually, your website will become more social and the users will be provided with a personalized user experience.
Version: 1.0.5
Author: http://web-dorado.com/
License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/
	 require_once("spider_facebook_widget.php");
/////      load language
add_action( 'init', 'spider_facebook_lang' );
function spider_facebook_lang() {
	 load_plugin_textdomain('sp_facebook', false, basename( dirname( __FILE__ ) ) . '/Languages' );
	
}
add_action('wp_head','spider_facebook_ifr_styles_problem');

function spider_facebook_ifr_styles_problem(){
		?>
		<style>span>iframe{
			max-width:none !important;
		}     
		</style>
		<?php
}
//////shortcode for facebook
add_action('init', 'spider_facebook_output_buffer');
function spider_facebook_output_buffer() {
        ob_start();
}
add_filter('the_content','spider_facebook_front_end_shortcode',5000);
function spider_facebook_front_end_shortcode($content) {
     
	 
	  $pattern ='[\[spider_facebook id="([0-9]*)"\]]';
	 
	 
			$count_forms_in_post=preg_match_all ( $pattern, $content, $matches_form);
			for($jj=0;$jj<$count_forms_in_post;$jj++)
			{
				$padron=$matches_form[0][$jj];
				
				$replacment=spider_facebook_front_end($matches_form[1][$jj]);		
					$content=str_replace($padron,$replacment,$content);
			}		
	
	return $content;
}
//////////////////// fornt end facebook
function spider_facebook_front_end($id){	
	global $wpdb;
	$facebook=$wpdb->get_row('SELECT * FROM '.$wpdb->prefix.'spiderfacebook_params WHERE `id`='.$id.' AND published=1');
	$url=get_permalink();
	$lang=get_bloginfo('language','en-US');
	if(strpos($url,'?'))
	$url_conect_with=$url.'&';
	else
	$url_conect_with=$url.'?';
	$reglog=str_replace('&','@@@',$url);
	$facebook->code=str_replace('autoLOGREDauto',$reglog,$facebook->code);
	$facebook->code=str_replace('autoREGREDauto',$reglog,$facebook->code);
	$facebook->code=str_replace('get_registration_for_faceebok_page_or_post',$url_conect_with,$facebook->code);
	if($facebook->render=='3'||$facebook->render=='4')
		$encode=urlencode($url);
	else
		$encode=$url;
		
	$facebook->code=str_replace('autoSITEURLauto',$encode,$facebook->code);
	$facebook->code=str_replace('get_registration_for_faceebok_page_or_post',$url_conect_with,$facebook->code);
	
	$facebook->code=str_replace('autoLANGauto',$lang,$facebook->code);
	$login_id=wp_generate_password(10);
	$facebook->code=str_replace('temp_id',$login_id,$facebook->code);
	if(is_user_logged_in() && $facebook->type=='register'){
	
					if(strpos(get_permalink(),'?'))
					$url_logen=get_permalink().'&';
					else
					$url_logen=get_permalink().'?';
					if($facebook->fb_only==1){	
						
						$login='
						<script>
						document.getElementById("'.$login_id.'").setAttribute("style","display:none");
						function logout(){
						window.location="'.$url_logen.'task=logout&logout_red='.$reglog.'";
						
						}
						</script>
						<input type="button" class="button" value="Log out" onclick="logout()"/>
						';
					}
					else{
						
						$login='
						<script>
						document.getElementById("'.$login_id.'").setAttribute("style","display:none");
						</script>
						';			
					}
				}
				else{
				$login="";
				}
	 
	return	$facebook->code.$login;			 
}
	 
	 
	 
	 
	 
	 
	 
//////////////////////////////////////////////////////// set facebook ajax hooks	 
	 
	 
	 require_once("facebook_ajax_function.php");	 
	 add_action('wp_ajax_selectpostsforfacebook', 'select_posts_for_facebook');		
	 add_action('wp_ajax_selectpagesforfacebook', 'select_pages_for_facebook');
	 
	 
/////////////////////////////////////////////////////////////////////////////////
	 
/////////////////////////////////////////////////////////////////////// meta parametrs
require_once('includes/facebook_meta.php'); 	//// add meta date in page and posts
require_once('includes/front_end_meta.php'); 	/// get modifide and insert meta in head
$xxx=1;
add_filter('the_content','spider_facebook_front_end_short');
function spider_facebook_front_end_short($content){
	global $wpdb;
	global $xxx;
	global $post;
	////////////////////regiister page
	//if(isset($_GET['task']) && isset($_GET['type']) && isset($_GET['appid']) && isset($_GET['g_red']) && ($_GET['task']=='registered' || $_GET['task']=='registration'))
	if(isset($_GET['task']) &&  (isset($_GET['fbid']) || isset($_GET['g_red']) ||  isset($_GET['res']) || isset($_GET['logout_red'])) && ($_GET['task']=='login' || $_GET['task']=='registered' || $_GET['task']=='registration' || $_GET['task']=='loginwith' || $_GET['task']=='logout'))
	{		
		$task=$_GET['task'];
		$type=$_GET['type'];
		$appid=$_GET['appid'];
		if(isset($_GET['fb_only']))
		$fb_only=$_GET['fb_only'];
		else
		$fb_only='';
		$reg_red = $_GET['g_red'];
		if(isset($_GET['log_red']))
		$log_red = $_GET['log_red'];
		else
		$log_red ='';
		
		if(isset($_GET['logout_red']))
		$logout_red=$_GET['logout_red'];
		else
		$logout_red='';
		
		 
		 $log_red =str_replace('@@@','&',$log_red );
		 $logout_red=str_replace('@@@','&',$logout_red);
		
		switch($task){
		
		case 'logout':
	
			wp_logout();
		 wp_redirect(get_permalink());
		return '';
		
		break;
		
		
		case 'registration':
		if(strpos(get_permalink(),'?')){
		$a= get_permalink().'&task=registered&type='.$type.'&g_red='.$reg_red ;
		}
		else
		$a= get_permalink().'?task=registered&type='.$type.'&g_red='.$reg_red ;
		$encodedurl = urlencode($a);
		
		switch($type){
		
		case 'auto':
		
		?>
		<iframe src="https://www.facebook.com/plugins/registration?
					 client_id=<?php echo $appid;?>&
					 redirect_uri=<?php echo $encodedurl ;?>&
					 fields=[
		 {'name':'name'},
         {'name':'first_name'},
         {'name':'last_name'},
		 {'name':'email'},
		 {'name':'gender'},
		 {'name':'birthday'},
		]
		"
				scrolling="auto"
				frameborder="no"
				style="border:none"
				allowTransparency="true"
				width="100%"
				height="800">
		</iframe>
		<?php
		break;
		case 'password':
		?>
		<iframe src="https://www.facebook.com/plugins/registration?
					 client_id=<?php echo $appid;?>&
					 redirect_uri=<?php echo $encodedurl ;?>&
					 fields=[
		 {'name':'name'},
         {'name':'first_name'},
         {'name':'last_name'},
		 {'name':'email'},
		 {'name':'gender'},
		 {'name':'birthday'},
		 {'name':'username','description':'Username','type':'text'},
		 {'name':'password','description':'Password'},
		]
		"
				scrolling="auto"
				frameborder="no"
				style="border:none"
				allowTransparency="true"
				width="100%"
				height="1000">
		</iframe>
		<?php 
		break;
		case 'captcha':
		?>
		<iframe src="https://www.facebook.com/plugins/registration?
					 client_id=<?php echo $appid;?>&
					 redirect_uri=<?php echo $encodedurl ;?>&
					 fields=[
		 {'name':'name'},
         {'name':'first_name'},
         {'name':'last_name'},
		 {'name':'email'},
		 {'name':'gender'},
		 {'name':'birthday'},
		 {'name':'username','description':'Username','type':'text'},
		 {'name':'password','description':'Password'},
		 {'name':'captcha'}
		]
		"
				scrolling="auto"
				frameborder="no"
				style="border:none"
				allowTransparency="true"
				width="100%"
				height="1000">
		</iframe>
		
		
		<?php
		
		break;
		}
		return '';
		break;
		
		
		
		
		
		
		
		case 'registered':
		$type=$_GET[ 'type'];
		$reg_red = $_GET['g_red'];
		$reg_red =str_replace('@@@','&',$reg_red );
		
		
		
		$signed_request = $_POST[ 'signed_request'];
		$data=explode('.', $signed_request);
		
		$params = json_decode(base64_url_decode($data[1]), true);	
			
		switch($type){
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		case 'auto':
		
		$user_id=$params['user_id'];
		$username=$params['registration']['name'];
		$password=wp_generate_password(10);
		$data = array(); // array for all user settings
		
		$data['first_name'] = $params['registration']['first_name']; // add first- and lastname
		$data['last_name'] = $params['registration']['last_name'];	
		$data['name'] = $params['registration']['name']; // add first- and lastname
		$data['username'] = $params['registration']['name']; // add username
		$data['email'] = $params['registration']['email'];  // add email
		 
		/* no need to add the usertype, it will be generated automaticaly from the gid */
		 
		$data['password'] = $password; // set the password
		$data['sendEmail'] = 1; // should the user receive system mails?
		 
		/* Now we can decide, if the user will need an activation */
		 
 		$userdata=array(
		 'user_login' => $data['username'],
		 'user_pass' => $data['password'],
		 'user_email' => $data['email'],
		 'nickname' => $data['first_name'].$data['last_name'],
		 'first_name' => $data['first_name'],
		 'last_name' => $data['last_name'],
		 'user_pass' => $data['password']		 
		 );
		
		
		
		$askofen=wp_insert_user( $userdata );
		
			
		
		global $wpdb;
		if($user_id!=""){
		$query0 = "DELETE FROM `".$wpdb->prefix."spiderfacebook_login` WHERE user_id=".$user_id;
		$wpdb->query($query0);
		
		$query1 = "INSERT INTO `".$wpdb->prefix."spiderfacebook_login` (user_id, username, password)
		VALUES ('".$user_id."', '".$username."','".$password."')";
		$wpdb->query($query1);		
		}
		
		
	
		$creds['user_login'] = $username;
		$creds['user_password'] =$password;
		$creds['remember'] = true;
		
		$userr =wp_signon( $creds, false );
		if ( is_wp_error($userr) )
  		 echo $userr->get_error_message();
		 wp_redirect(get_permalink());
		exit;
		
		break;
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		case 'password':
		case 'captcha':
		
		$user_id=$params['user_id'];
		$username=$params['registration']['username'];
		$password=$params['registration']['password'];
		
		
		
		$data = array(); // array for all user settings
		 
		$data['first_name'] = $params['registration']['first_name']; // add first- and lastname
		$data['last_name'] = $params['registration']['last_name']; // add first- and lastname
		$data['username'] =$username;  // add username
		$data['email'] = $params['registration']['email'];  // add email
		//$data['gid'] = $acl->get_group_id( '', $usertype, 'ARO' );  // generate the gid from the usertype
		 
		/* no need to add the usertype, it will be generated automaticaly from the gid */
		 
		$data['password'] = $password; // set the password
		$data['password2'] = $password; // confirm the password
		$data['sendEmail'] = 1; // should the user receive system mails?
		
		
		 $userdata=array(
		 'user_login' => $data['username'],
		 'user_pass' => $data['password'],
		 'user_email' => $data['email'],
		 'nickname' => $data['first_name'].$data['last_name'],
		 'first_name' => $data['first_name'],
		 'last_name' => $data['last_name'],
		 'user_pass' => $data['password2']		 
		 );
		
		
		
		$askofen=wp_insert_user( $userdata );
		
		 
		
		global $wpdb;
		if($user_id!=""){
		$query0 = "DELETE FROM `".$wpdb->prefix."spiderfacebook_login` WHERE user_id=".$user_id;
		$wpdb->query($query0);
		$query1 = "INSERT INTO `".$wpdb->prefix."spiderfacebook_login` (user_id, username, password)
		VALUES ('".$user_id."', '".$username."','".$password."')";
		$wpdb->query($query1);
		}
		
		
		$creds['user_login'] = $username;
		$creds['user_password'] =$password;
		$creds['remember'] = true;
		$userr =wp_signon( $creds, false );
		if ( is_wp_error($userr) )
  		 echo $userr->get_error_message();
		 wp_redirect(get_permalink());
		exit;
		
		break;
		}
		break;
		
		case 'login':
		 
		$res=$_GET['res'];
		$data=explode('.', $res);
		//print_r(json_decode(base64_url_decode($data[1]), true));
		
		$user=json_decode(base64_url_decode($data[1]), true);
		$login_user_id=$user['user_id'];
		
		//print_r($login_user_id);
		
		global $wpdb;
		$query = "SELECT * FROM ".$wpdb->prefix."spiderfacebook_login
		WHERE user_id=".$login_user_id;
		$result=$wpdb->get_row($query);
		
		$creds['user_login'] =$result->username;
		$creds['user_password'] =$result->password;
		
		$userr =wp_signon( $creds, false );
		if ( is_wp_error($userr) )
  		 echo $userr->get_error_message();
		 wp_redirect(get_permalink());
		exit;
		
		}
				
		
	}	
	///////////////////// normal post or page
	$url=get_permalink();
			
	if($post->post_type=='post')
		$query ="SELECT * FROM ".$wpdb->prefix."spiderfacebook_params WHERE (articles LIKE '%***".$post->ID."***%' OR articles='all') AND `published`=1 ";
	if(is_page())
		$query ="SELECT * FROM ".$wpdb->prefix."spiderfacebook_params WHERE (items LIKE '%***".$post->ID."***%' OR items='all') AND `published`=1 ";
	$params=$wpdb->get_results($query);
	$login_id=wp_generate_password(10);
	if(!count($params))
	return $content;
	foreach($params as $param){
	$reglog=get_permalink();
	if(is_user_logged_in() && $param->type=='register'){
					if(strpos(get_permalink(),'?'))
					$url_logen=get_permalink().'&';
					else
					$url_logen=get_permalink().'?';
					if($param->fb_only==1){			
						$login='
						<script>
						document.getElementById("'.$login_id.'").setAttribute("style","display:none");
						function logout(){
						window.location="'.$url_logen.'task=logout&logout_red='.$reglog.'";
						}
						</script>
						<input type="button" class="button" value="Log out" onclick="logout()"/>
						';
					}
					else{
						$login='
						<script>
							document.getElementById("'.$login_id.'").setAttribute("style","display:none");
						</script>
						';			
					}
				}
				else{
				$login="";
				}
	$url=get_permalink();
	$lang=get_bloginfo('language','en-US');
	if(strpos($url,'?'))
	$url_conect_with=$url.'&';
	else
	$url_conect_with=$url.'?';
	$reglog=str_replace('&','@@@',$url);
	$param->code=str_replace('autoLOGREDauto',$reglog,$param->code);
	$param->code=str_replace('autoREGREDauto',$reglog,$param->code);
	$param->code=str_replace('get_registration_for_faceebok_page_or_post',$url_conect_with,$param->code);
	if($param->render=='3'||$param->render=='4')
		$encode=urlencode($url);
	else
		$encode=$url;
		
	$param->code=str_replace('autoSITEURLauto',$encode,$param->code);
	$param->code=str_replace('get_registration_for_faceebok_page_or_post',$url_conect_with,$param->code);
	
	$param->code=str_replace('autoLANGauto',$lang,$param->code);
	
	$param->code=str_replace('temp_id',$login_id,$param->code);
	if(is_page())
		$swich_my=$param->item_place;
		else
		$swich_my=$param->place;
 	switch($swich_my){
		
		case "bottom":
		$content=$content.$param->code.$login;
		break;
		
		case "top":	
			if($xxx==1){		
				$content=$param->code.'</br>'.$content.$login;
				$xxx=0;
			}
			else{	
			$content=$param->code.$content.$login;			
			}
		break;
		
		case "both":
		if($xxx==1){
		$content=$param->code.'</br>'.$content.$param->code.$login;
		$xxx=0;
		}
		else{
		$content=$param->code.$content.$param->code.$login;
		}
		break;		
        }
	}
		
		
return $content;
}
	if(!function_exists('base64_url_decode')){
	function base64_url_decode($input) {
		  return base64_decode(strtr($input, '-_', '+/'));
		}
	}
////////////////////////////////////////////////						/////////////////////////////////////////////////
////////////////////////////////////////////////						/////////////////////////////////////////////////
////////////////////////////////////////////////		ADMIN PANEL		/////////////////////////////////////////////////
////////////////////////////////////////////////						/////////////////////////////////////////////////
////////////////////////////////////////////////						/////////////////////////////////////////////////
add_filter('mce_external_plugins', "spider_facbook_registr_plugin_button");
add_filter('mce_buttons', 'spider_facebook_plugin_button', 0);
/// function for add new button
function spider_facebook_plugin_button($buttons)
{
    array_push($buttons, "Spider_Facebook_mce");
    return $buttons;
}
 /// function for registr new button
function spider_facbook_registr_plugin_button($plugin_array)
{
    $url = plugins_url( 'elements/editor_plugin.js' , __FILE__ ); 
    $plugin_array["Spider_Facebook_mce"] = $url;
    return $plugin_array;
}
///////////////////// add ajax window in editor
add_action('wp_ajax_spiderfacebookeditorwindow', 'spider_facebook_editor_window');		
function spider_facebook_editor_window(){
		if(isset($_GET['action']) && $_GET['action']=='spiderfacebookeditorwindow'){
			global $wpdb;
		?>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Spider Facebook</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/jquery/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<link rel="stylesheet" href="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css?ver=342-20110630100">
		<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
		<base target="_self">
	</head>
	<body id="link"  style="" dir="ltr" class="forceColors">
		<div class="tabs" role="tablist" tabindex="-1">
			<ul>
				<li id="form_maker_tab" class="current" role="tab" tabindex="0"><span><a href="javascript:mcTabs.displayTab('Single_product_tab','Single_product_panel');" onMouseDown="return false;" tabindex="-1">Spider Facebook</a></span></li>
			</ul>
		</div>
		<style>
		.panel_wrapper{
			height:170px !important;
		}
		</style>
			<div class="panel_wrapper">
				<div id="Single_product_panel" class="panel current">
					<table>
					  <tr>
						 <td style="height:100px; width:120px; vertical-align:top;">
							Select a Facebook Plugin 
						</td>
						<td style="vertical-align:top">
							<select name="spider_facebook" id="spider_facebook" style="width:250px; text-align:center">
								<option  style="text-align:center" value="- Select Form -" selected="selected">- Select a Facbook -</option>
								 <?php    $ids_spider_facebook=$wpdb->get_results("SELECT `id`,`title` FROM ".$wpdb->prefix."spiderfacebook_params WHERE `published`=1 order by `id` DESC");
								   foreach($ids_spider_facebook as $id_spider_facebook)
								   {
									   ?>
									   <option value="<?php echo $id_spider_facebook->id; ?>"><?php echo $id_spider_facebook->title; ?></option>
							 <?php }?>
							</select>
						 </td>
					</tr>
					</table>
					</div>
			</div>
			<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();" />
			</div>
	
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="Insert" onClick="insert_Form_Maker();" />
			</div>
		</div>
	<script type="text/javascript">
	function insert_Form_Maker() {
		if(document.getElementById('spider_facebook').value=='- Select Facbook -')
		{
			tinyMCEPopup.close();
		}
		else
		{
		   var tagtext;
		   tagtext='[spider_facebook id="'+document.getElementById('spider_facebook').value+'"]';
		   window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		   tinyMCEPopup.editor.execCommand('mceRepaint');
		   tinyMCEPopup.close();		
		}
		
	}
	
	</script>
	</body>
	</html>
	<?php	
	die('');
}
}
/// styles for hover
function add_button_style_Spider_Facebook()
{
echo '<style type="text/css">
.wp_themeSkin span.mce_Spider_Facebook_mce {background:url('.plugins_url( 'images/spider_facebooklogo.png' , __FILE__ ).') no-repeat !important;}
.wp_themeSkin .mceButtonEnabled:hover span.mce_Spider_Facebook_mce,.wp_themeSkin .mceButtonActive span.mce_Spider_Facebook_mce
{background:url('.plugins_url( 'images/spider_facebookhover.png' , __FILE__ ).') no-repeat !important;}
</style>';
}
add_action('admin_head', 'add_button_style_Spider_Facebook');
add_action('admin_menu', 'Spider_Facebook_options_panel');
function Spider_Facebook_options_panel(){
							add_menu_page(	'Theme page title', 'Spider Facebook', 'manage_options', 'Spider_Facebook_manage', 'Spider_Facebook_manage',plugins_url('images/fb_right_menu.png',__FILE__))  ;
	$facebook_manager_page=	add_submenu_page( 'Spider_Facebook_manage', 'Manage Facebook', 'Manage Facebook', 'manage_options', 'Spider_Facebook_manage', 'Spider_Facebook_manage');
	                        add_submenu_page( 'Spider_Facebook_manage', 'Licensing', 'Licensing', 'manage_options', 'Licensing_Spider_Facebook', 'Licensing_Spider_Facebook');
							add_submenu_page( 'Spider_Facebook_manage', 'Uninstall Spider_Facebook ', 'Uninstall  Spider Facebook', 'manage_options', 'Uninstall_Spider_Facebook', 'Uninstall_Spider_Facebook');
							add_action('admin_print_styles-' . $facebook_manager_page, 'spider_facebook_admin_scripts');
}
/////////////////  scripts 
function spider_facebook_admin_scripts(){	
	wp_enqueue_script('word-count');
	wp_enqueue_script('post');
	wp_enqueue_script('editor');
	wp_enqueue_script('media-upload');
	wp_admin_css('thickbox');
	wp_print_scripts('media-upload');		 
	do_action('admin_print_styles');
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_enqueue_script('utils');
	wp_enqueue_script('colorpicker_sp',plugins_url('elements/jscolor/jscolor.js',__FILE__));
}


function Licensing_Spider_Facebook(){
	
	?>
    
   <div style="width:95%"> <p>
This plugin is the non-commercial version of the Spider Facebook. Use of this plugin is free. The limitations of the free version are: FB Login Button and FB Register Button. If you want to remove the limitations, you are required to purchase a license.<br>
The commercial version of Spider Facebook is also include integration of your WordPress web site with Google Plus, LinkedIn, Twitter.
 </p>
<br /><br />
<a href=" http://web-dorado.com/products/wordpress-facebook.html" class="button-primary" target="_blank">Purchase a License</a>
<br /><br /><br />
<p>After the purchasing the commercial version follow this steps:</p>
<ol>
	<li>Deactivate Spider Facebook Plugin</li>
	<li>Delete Spider Facebook Plugin</li>
	<li>Install the downloaded commercial version of the plugin</li>
</ol>
</div>

    
     <?php
		
}



///////////////////////////////////          Manage Spider Facebook 
function Spider_Facebook_manage()
{
	require_once("facebook_manager.php");
	require_once("facbook_manager.html.php");
	if(!function_exists ('print_html_nav' ))
	require_once("nav_function/nav_html_func.php");
	global $wpdb;
	if(isset($_GET['id']))
	{
	$id=$_GET['id'];
	}
	else
	{
		$id=0;
	}
	
	
	if(isset($_GET['task']))
	{
		$task=$_GET['task'];
	}
	else
	{
		$task='';
	}
	
	switch($task){		
		case 'add':
			spider_facebook_add();		
		break;
				
		case 'Apply':	
		if(!isset($_POST['title']))
		{
			spider_facebook_show();
			break;
		}
		sp_fb_save();
		if($id){
		$xxx=0;	
		
			try{		
			$facebook =	new seve_or_update_sp('spiderfacebook_params',$_POST);
				$facebook->update_parametrs($id);
			}
			catch (Exception $e) {
				echo $e->getMessage();
				$xxx=1;
			}
		}
		else
		{
			try{		
			$facebook =	new seve_or_update_sp('spiderfacebook_params',$_POST);
				$facebook->save_parametrs();
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}
			$id=$wpdb->get_var('SELECT MAX(id) FROM '.$wpdb->prefix.'spiderfacebook_params');
			$_GET['id']=$id;
		}
		
			if($xxx)
			spider_facebook_show();
			else
			Spider_Facebook_edit($id);
		break;
		case 'Save':
		if(!isset($_POST['title']))
		{
			spider_facebook_show();
			break;
		}
		sp_fb_save();
		if(!$id){
			try{		
			$facebook =	new seve_or_update_sp('spiderfacebook_params',$_POST);
				$facebook->save_parametrs();
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}
			spider_facebook_show();
		}
		else
		{
			try{		
			$facebook =	new seve_or_update_sp('spiderfacebook_params',$_POST);
				$facebook->update_parametrs($id);
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}
			spider_facebook_show();
		}
		
		break;
		
		case 'edit':
			edit();
		break;	
			
		case 'remove_Spider_Facebook':
			remove_Spider_Facebook($id);
			spider_facebook_show();
		break;
		
			case 'publish':
			publish(1 );
		break;	 
		
		
		case 'show_art':
			show_art();
		break;
		
		case 'show_item':
			show_item();
		break;		
				
		 case 'Spider_Facebook_edit':
			Spider_Facebook_edit($id);
		break;
		case "publiah_spider_facebook" :
		cange_facebook_published($id);
		spider_facebook_show();
		break;
				
		default:
			spider_facebook_show();
 		break;
	}
	
		
}
////////////////////////////////////
/////////////////////////////////// uninstall Spider Facebook
function Uninstall_Spider_Facebook(){
	
global $wpdb;
$base_name = plugin_basename('Spider_Facebook');
$base_page = 'admin.php?page='.$base_name;
$mode = trim($_GET['mode']);
if(!empty($_POST['do'])) {
	if($_POST['do']=="UNINSTALL Spider_Facebook") {
			check_admin_referer('Spider_Facebook uninstall');
			if(trim($_POST['Spider_Facebook_yes']) == 'yes') {
				
				echo '<div id="message" class="updated fade">';
				echo '<p>';
				echo "Table 'spiderfacebook_params' has been deleted.";
				$wpdb->query("DROP TABLE ".$wpdb->prefix."spiderfacebook_params");
				echo '<font style="color:#000;">';
				echo '</font><br />';
				echo '</p>';
				echo '<p>';
				echo "Table 'spiderfacebook_login' has been deleted.";
				$wpdb->query("DROP TABLE ".$wpdb->prefix."spiderfacebook_login");
				echo '<font style="color:#000;">';
				echo '</font><br />';
				echo '</p>';
				echo '</div>'; 
				
				$mode = 'end-UNINSTALL';
			}
		}
}
switch($mode) {
		case 'end-UNINSTALL':
			$deactivate_url = wp_nonce_url('plugins.php?action=deactivate&amp;plugin='.plugin_basename(__FILE__), 'deactivate-plugin_'.plugin_basename(__FILE__));
			echo '<div class="wrap">';
			echo '<h2>Uninstall Spider Facebook</h2>';
			echo '<p><strong>'.sprintf('<a href="%s">Click Here</a> To Finish The Uninstallation And Spider Facebook Will Be Deactivated Automatically.', $deactivate_url).'</strong></p>';
			echo '</div>';
			break;
	// Main Page
	default:
?>
<form method="post" action="<?php echo admin_url('admin.php?page=Uninstall_Spider_Facebook'); ?>">
<?php wp_nonce_field('Spider_Facebook uninstall'); ?>
<div class="wrap">
	<div id="icon-Spider_Facebook" class="icon32"><br /></div>
	<h2><?php echo 'Uninstall Spider Facebook'; ?></h2>
	<p>
		<?php echo 'Deactivating Spider Facebook plugin does not remove any data that may have been created. To completely remove this plugin, you can uninstall it here.'; ?>
	</p>
	<p style="color: red">
		<strong><?php echo'WARNING:'; ?></strong><br />
		<?php echo 'Once uninstalled, this cannot be undone. You should use a Database Backup plugin of WordPress to back up all the data first.'; ?>
	</p>
	<p style="color: red">
		<strong><?php echo 'The following WordPress Options/Tables will be DELETED:'; ?></strong><br />
	</p>
	<table class="widefat">
		<thead>
			<tr>
				<th><?php echo 'WordPress Tables'; ?></th>
			</tr>
		</thead>
		<tr>
			<td valign="top">
				<ol>
				<?php
						echo '<li>spiderfacebook_params</li>'."\n";
						echo '<li>spiderfacebook_login</li>'."\n";
				?>
				</ol>
			</td>
		</tr>
	</table>
	<p style="text-align: center;">
		<?php echo 'Do you really want to uninstall Spider Facebook?'; ?><br /><br />
		<input type="checkbox" name="Spider_Facebook_yes" value="yes" />&nbsp;<?php echo 'Yes'; ?><br /><br />
		<input type="submit" name="do" value="<?php echo 'UNINSTALL Spider_Facebook'; ?>" class="button-primary" onClick="return confirm('<?php echo 'You Are About To Uninstall Spider Facebook From WordPress.\nThis Action Is Not Reversible.\n\n Choose [Cancel] To Stop, [OK] To Uninstall.'; ?>')" />
	</p>
</div>
</form>
<?php
} // End switch($mode)	
}
///////////////////////////////// when plugin activated
register_activation_hook( __FILE__, 'Spider_facebook_activate' );
function Spider_facebook_activate(){
// include function  install_spider_facbook
require_once('spider_facebook_setup.php');
/// cal function for create databees
install_spider_facbook();
}
