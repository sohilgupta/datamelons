	<?php	
	
	if(!current_user_can('manage_options')) {
	die('Access Denied');
}	
 //////////////////////////////////////////////////////                                             /////////////////////////////////////////////////////// 
 //////////////////////////////////////////////////////         functions for Spider Facbook        ///////////////////////////////////////////////////////
 //////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
 //////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
 
 
 
 function spider_facebook_show(){
 	global $wpdb;
	$sort["default_style"]="manage-column column-autor sortable desc";
	if(isset($_POST['page_number']))
	{
			
			if($_POST['asc_or_desc'])
			{
				$sort["sortid_by"]=$_POST['order_by'];
				if($_POST['asc_or_desc']==1)
				{
					$sort["custom_style"]="manage-column column-title sorted asc";
					$sort["1_or_2"]="2";
					$order="ORDER BY ".$sort["sortid_by"]." ASC";
				}
				else
				{
					$sort["custom_style"]="manage-column column-title sorted desc";
					$sort["1_or_2"]="1";
					$order="ORDER BY ".$sort["sortid_by"]." DESC";
				}
			}
			
	if($_POST['page_number'])
		{
			$limit=($_POST['page_number']-1)*20; 
		}
		else
		{
			$limit=0;
		}
	}
	else
		{
			$limit=0;
		}
	if(isset($_POST['search_events_by_title'])){
		$search_tag=$_POST['search_events_by_title'];
		}
		
		else
		{
		$search_tag="";
		}
	if ( $search_tag ) {
		$where= ' WHERE title LIKE "%'.$search_tag.'%"';
	}
	
	
	
	// get the total number of records
	$query = "SELECT COUNT(*) FROM ".$wpdb->prefix."spiderfacebook_params". $where;
	$total = $wpdb->get_var($query);
	$pageNav['total'] =$total;
	$pageNav['limit'] =	 $limit/20+1;
	
	$query = "SELECT * FROM ".$wpdb->prefix."spiderfacebook_params".$where." ". $order." "." LIMIT ".$limit.",20";
	$rows = $wpdb->get_results($query);	    	
	html_spider_facebook_show($rows, $pageNav, $sort);
 
 }
 
function   spider_facebook_edit($id){
	global $wpdb;
	
	
	$row =$wpdb->get_row('SELECT * FROM '.$wpdb->prefix."spiderfacebook_params WHERE `id`=".$id);
	
	
	$arts=array();
	$arts_id=explode('***',$row->articles);
	$arts_id= array_slice($arts_id,1, count($arts_id)-2);  
	foreach($arts_id as $art_id)
	{
		
		$art_titles[] =get_post($art_id);
		
	}
     $titles=array();
	 for($i=0;$i<count($arts_id);$i++)
	 {
	 array_push($titles,addslashes($art_titles[$i]->post_title));
	 }
	
	
	
	
	
	$items=array();
	$items_id=explode('***',$row->items);
	$items_id= array_slice($items_id,1, count($items_id)-2);  
	foreach($items_id as $item_id)
	{
		
		$items_titles[] = get_post($item_id);
		
	}
	
     $item_titles=array();
	 for($i=0;$i<count($items_id);$i++)
	 {
	 array_push($item_titles,addslashes($items_titles[$i]->post_title));
	 }
	
	
	
	html_spider_facebook_add($row,$arts_id,$titles,$items_id,$item_titles);
}
 
 
function  spider_facebook_add(){
	
$row= new stdClass();
	$row->id="";
	$row->title="";
	$row->type='likebutton';
	$row->published='1';
	$row->render="2";
	$row->url_type='auto';
	$row->domain='';
	$row->appid='';
	$row->url='';
	$row->width='';
	$row->height='';
	$row->target="_blank";
	$row->rows="";
	$row->size="medium";
	$row->post="";
	$row->head="1";
	$row->stream="1";
	$row->recom="true";
	$row->action="like";
	$row->send="1";
	$row->face="1";
	$row->layout="standard";
	$row->bord="1";
	$row->border="FFFFFF";
	$row->backg="FFFFFF";
	$row->colorsc="light";
	$row->font="arial";
	$row->lang="en_GB";
	$row->request_type="1";
	$row->place="top";
	$row->twit="";
    $row->fb_only="0";
	$row->reg_type="auto";
	$row->lang_type="normal";
	$row->meta_title="";
	$row->meta_type="";
	$row->meta_url="";
	$row->meta_image="";
	$row->meta_site_name="";
	$row->meta_description="";
	$row->meta_admins="";
	$row->item_meta_title="";
	$row->item_meta_type="";
	$row->item_meta_url="";
	$row->item_meta_image="";
	$row->item_meta_site_name="";
	$row->item_meta_description="";
	$row->item_meta_admins="";
	$row->reg_red="";
	$row->log_red="";
	$row->share_type="button";
	$row->url_value="";
	$row->articles="";
	$row->def_img_art="";
	$row->items="";
	$row->def_img_item="";
	$row->item_place="top";
	$row->css="padding-top:0px;
padding-right:0px;
padding-bottom:0px;
padding-left:0px;
margin-top:0px;
margin-right:0px;
margin-bottom:0px;
margin-left:0px;
";
	$row->req_m="";
	$row->count_mode="vertical";
	$row->hor_place="left";
	$arts_id=array();
	$titles=array();
	$items_id=array();
	$item_titles=array();
	$edit_or_add=0;
	html_spider_facebook_add($row,$arts_id,$titles,$items_id,$item_titles,$edit_or_add);
	
}
function sp_fb_save(){
	
	global $wpdb;	
	/*$row =& JTable::getInstance('spiderfacebook_params', 'Table');
	if(!$row->bind(JRequest::get('post')))
	{
		JError::raiseError(500, $row->getError() );
	}*/
if(!isset($_POST['id'])) $_POST['id'] = null;
if(!isset($_POST['title'])) $_POST['title'] = null;
if(!isset($_POST['type'])) $_POST['type'] = null;
if(!isset($_POST['code'])) $_POST['code'] = null;
if(!isset($_POST['articles'])) $_POST['articles'] = null;
if(!isset($_POST['published'])) $_POST['published'] = null;
if(!isset($_POST['place'])) $_POST['place'] = null;
if(!isset($_POST['twit'])) $_POST['twit'] = null;
if(!isset($_POST['items'])) $_POST['items'] = null;
if(!isset($_POST['url_value'])) $_POST['url_value'] = null;
if(!isset($_POST['lang_type'])) $_POST['lang_type'] = null;
if(!isset($_POST['url_type'])) $_POST['url_type'] = null;
if(!isset($_POST['url'])) $_POST['url'] = null;
if(!isset($_POST['render'])) $_POST['render'] = null;
if(!isset($_POST['width'])) $_POST['width'] = null;
if(!isset($_POST['backg'])) $_POST['backg'] = null;
if(!isset($_POST['action'])) $_POST['action'] = null;
if(!isset($_POST['send'])) $_POST['send'] = null;
if(!isset($_POST['face'])) $_POST['face'] = null;
if(!isset($_POST['layout'])) $_POST['layout'] = null;
if(!isset($_POST['colorsc'])) $_POST['colorsc'] = null;
if(!isset($_POST['font'])) $_POST['font'] = null;
if(!isset($_POST['lang'])) $_POST['lang'] = null;
if(!isset($_POST['meta_title'])) $_POST['meta_title'] = null;
if(!isset($_POST['meta_type'])) $_POST['meta_type'] = null;
if(!isset($_POST['meta_url'])) $_POST['meta_url'] = null;
if(!isset($_POST['meta_image'])) $_POST['meta_image'] = null;
if(!isset($_POST['meta_site_name'])) $_POST['meta_site_name'] = null;
if(!isset($_POST['meta_description'])) $_POST['meta_description'] = null;
if(!isset($_POST['meta_admins'])) $_POST['meta_admins'] = null;
if(!isset($_POST['item_meta_title'])) $_POST['item_meta_title'] = null;
if(!isset($_POST['item_meta_type'])) $_POST['item_meta_type'] = null;
if(!isset($_POST['item_meta_url'])) $_POST['item_meta_url'] = null;
if(!isset($_POST['item_meta_image'])) $_POST['item_meta_image'] = null;
if(!isset($_POST['item_meta_site_name'])) $_POST['item_meta_site_name'] = null;
if(!isset($_POST['item_meta_description'])) $_POST['item_meta_description'] = null;
if(!isset($_POST['item_meta_admins'])) $_POST['item_meta_admins'] = null;
if(!isset($_POST['item_place'])) $_POST['item_place'] = null;
if(!isset($_POST['css'])) $_POST['css'] = null;
if(!isset($_POST['def_img_art'])) $_POST['def_img_art'] = null;
if(!isset($_POST['def_img_item'])) $_POST['def_img_item'] = null;
if(!isset($_POST['fb_only'])) $_POST['fb_only'] = null;
if(!isset($_POST['reg_type'])) $_POST['reg_type'] = null;
if(!isset($_POST['reg_red'])) $_POST['reg_red'] = null;
if(!isset($_POST['log_red'])) $_POST['log_red'] = null;
if(!isset($_POST['height'])) $_POST['height'] = null;
if(!isset($_POST['post'])) $_POST['post'] = null;
if(!isset($_POST['rows'])) $_POST['rows'] = null;
if(!isset($_POST['size'])) $_POST['size'] = null;
if(!isset($_POST['border'])) $_POST['border'] = null;
if(!isset($_POST['bord'])) $_POST['bord'] = null;
if(!isset($_POST['domain'])) $_POST['domain'] = null;
if(!isset($_POST['appid'])) $_POST['appid'] = null;
if(!isset($_POST['head'])) $_POST['head'] = null;
if(!isset($_POST['recom'])) $_POST['recom'] = null;
if(!isset($_POST['target'])) $_POST['target'] = null;
if(!isset($_POST['stream'])) $_POST['stream'] = null;
if(!isset($_POST['share_type'])) $_POST['share_type'] = null;
if(!isset($_POST['request_type'])) $_POST['request_type'] = null;
if(!isset($_POST['req_m'])) $_POST['req_m'] = null;
if(!isset($_POST['count_mode'])) $_POST['count_mode'] = null;
if(!isset($_POST['hor_place'])) $_POST['hor_place'] = null;
	
	
	
	
	 
	
	if($_POST['domain']==''){
	$_POST['domain']=$_SERVER['HTTP_HOST'];
	}
	
	
	if($_POST['url_type']=='normal')
	{
	    $url=$_POST['url'];
	}
	else
	{
	    $url='autoSITEURLauto';
	}
	if($_POST['lang_type']=='normal')
	{
	    $lang=$_POST['lang'];
	}
	else
	{
	
	$lang='autoLANGauto';
	    
	   
	}
	
	
	
	if($_POST['articles']=='***')
	$_POST['articles']='';
	if($_POST['items']=='***')
	$_POST['items']='';
	
	
switch($_POST['type']){	
	
	case 'socials':
	
switch($_POST['count_mode']){
    case 'vertical':
	$linkedin='<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-counter="top" data-url="'.$url.'"></script>';
	$twitter='<a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$url.'" data-lang="'.$lang.'" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
	$googleplus="<!-- Place this tag where you want the +1 button to render. -->
<div class='g-plusone' data-size='tall' data-href='".$url."'></div>
<!-- Place this tag after the last +1 button tag. -->
<script type='text/javascript'>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>";
$facebook='<div id="fb-root"  style="display:inline-block;"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:like send="false" layout="box_count" width="450" show_faces="false" href="'.$url.'" ></fb:like>';
         break;
   
case 'horizontal':
	$linkedin='<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-counter="right" data-url="'.$url.'"></script>';
	$twitter='<div style="width:85px"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$url.'" data-lang="'.$lang.'" data-related="anywhereTheJavascriptAPI">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';
	$googleplus="<div style='width:65px'><!-- Place this tag where you want the +1 button to render. -->
<div class='g-plusone' data-size='medium' data-href='".$url."'></div>
<!-- Place this tag after the last +1 button tag. -->
<script type='text/javascript'>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script></div>";
$facebook='<div id="fb-root"  style="display:inline-block;"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:like send="false" layout="button_count" width="450" show_faces="false" href="'.$url.'" ></fb:like>';
break;
case 'none':
    $linkedin='<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-url="'.$url.'"></script>';
	$twitter='<a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$url.'" data-lang="'.$lang.'" data-related="anywhereTheJavascriptAPI" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
	$googleplus="<!-- Place this tag where you want the +1 button to render. -->
<div class='g-plusone'  data-annotation='none' data-href='".$url."'></div>
<!-- Place this tag after the last +1 button tag. -->
<script type='text/javascript'>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>";
    $facebook='<div id="fb-root"  style="display:inline-block;"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:like send="false" layout="standard" width="450" show_faces="false" href="'.$url.'" ></fb:like>';
break;
}	
	
	
	
	
	
	
if($_POST['hor_place']=="left"){
$_POST['code']='
<div style="'.$_POST['css'].'">
<div style="float:left">'.$linkedin.'
</div>
<div style="margin-left:5px;float:left">'.$twitter.'
</div>
<div style="margin-left:5px;float:left">'.$googleplus.'
</div>
<div style="margin-left:5px;float:left">'.$facebook.'
</div>
</div>
<div style="clear:left"></div>';
}
else{
$_POST['code']='
<div style="'.$_POST['css'].'">
<div style="float:right">'.$facebook.'
</div>
<div style="margin-right:5px;float:right">'.$googleplus.'
</div>
<div style="margin-right:5px;float:right">'.$twitter.'
</div>
<div style="margin-right:5px;float:right">'.$linkedin.'
</div>
</div>
<div style="clear:right"></div>';
}
	
	
	
	
	
	
		break;
case 'sendbutton':
	
	if($_POST['render']==1)
	{
	$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<div style="float:left;margin-right: 20px;" class="fb-send" data-href="'.$url.'" data-font="'.$_POST['font'].'" data-colorscheme="'.$_POST['colorsc'].'"></div>';
	}
	else{
	$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
	<fb:send href="'.$url.'" font="'.$_POST['font'].'"  colorscheme="'.$_POST['colorsc'].'"></fb:send>';
	}
	break;
	case 'likebutton':
	
	
switch($_POST['render']){
case 1:
	$_POST['code']='<div id="fb-root" ></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
	
<div  class="fb-like" data-font="'.$_POST['font'].'" data-href="'.$url.'"  data-action="'.$_POST['action'].'" data-layout="'.$_POST['layout'].'" data-send="'.$_POST['send'].'"  data-colorscheme="'.$_POST['colorsc'].'" data-width="'.$_POST['width'].'"  data-show-faces="'.$_POST['face'].'"  style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></div>';
break;	
	
	
	
	
case 2:
	$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:like href="'.$url.'" font="'.$_POST['font'].'" action="'.$_POST['action'].'" layout="'.$_POST['layout'].'" send="'.$_POST['send'].'" width="'.$_POST['width'].'"  colorscheme="'.$_POST['colorsc'].'" show_faces="'.$_POST['face'].'"  style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></fb:like>';
break;
case 3:
$encodedurl = urlencode($url);
$_POST['code']="<iframe src=\"//www.facebook.com/plugins/like.php?href=".$encodedurl."&amp;send=false&amp;layout=".$_POST['layout']."&amp;width=".$_POST['width']."&amp;height=21&amp;colorscheme=".$_POST['colorsc']."&amp;font=".$_POST['font']."&amp;show_faces=".$_POST['face']."&amp;action=".$_POST['action']."\" scrolling=\"no\" frameborder=".$_POST['bord']." style=\" background-color:#".$_POST['backg']."; border-color:#".$_POST['border']."; overflow:hidden; width:".$_POST['width']."px; height:".$_POST['height']."px;".$_POST['css']."\" allowTransparency=\"true\"></iframe>";
break;
case 4:
$encodedurl = urlencode($url);
$_POST['code']="<a href=\"//www.facebook.com/plugins/like.php?href=".$encodedurl."&width=".$_POST['width']."&send=false&colorscheme=".$_POST['colorsc']."&layout=".$_POST['layout']."&font=".$_POST['font']."&height=21&action=".$_POST['action']."\" target=\"".$_POST['target']."\">".$_POST['url_value']."</a>";
break;
	}
	
	
	
	break;
	case 'comment':
	if($_POST['render']==1){
	$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
	
<div class="fb-comments" data-href="'.$url.'" data-num-posts="'.$_POST['post'].'" data-colorscheme="'.$_POST['colorsc'].'" data-width="'.$_POST['width'].'" data-font="'.$_POST['font'].'" data-height="'.$_POST['height'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></div>';
}
else{
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
 <fb:comments href="'.$url.'" font="'.$_POST['font'].'" num_posts="'.$_POST['post'].'" width="'.$_POST['width'].'" height="'.$_POST['height'].'" colorscheme="'.$_POST['colorsc'].'"  style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></fb:comments>';
}
break;
	case 'loginbutton':	
	if($_POST['render']==1){
	
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1&appId='.$_POST['appid'].'";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<div class="fb-login-button" data-font="'.$_POST['font'].'"  data-width="'.$_POST['width'].'"  data-colorscheme="'.$_POST['colorsc'].'" data-show-faces="'.$_POST['face'].'"  data-max-rows="'.$_POST['rows'].'" style="background:#'.$_POST['backg'].'";'.$_POST['css'].'></div>';
}
else{
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1&appId='.$_POST['appid'].'";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
 	<fb:login-button font="'.$_POST['font'].'"  width="'.$_POST['width'].'" colorscheme="'.$_POST['colorsc'].'" max-rows="'.$_POST['rows'].'" show_faces="'.$_POST['face'].'"  style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></fb:login-button>';
}
break;	
	case 'actfeed':	
	if($_POST['render']==1){
	$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "acebook-jssdk"));</script>
<div class="fb-activity" data-site="'.$_POST['domain'].'" data-action="'.$_POST['action'].'" data-width="'.$_POST['width'].'" data-height="'.$_POST['height'].'" data-header="'.$_POST['head'].'" data-colorscheme="'.$_POST['colorsc'].'" data-linktarget="'.$_POST['target'].'" data-border-color="#'.$_POST['border'].'" data-font="'.$_POST['font'].'" data-recommendations="'.$_POST['recom'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></div>';
	
	}
else{
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:activity site="'.$_POST['domain'].'" action="'.$_POST['action'].'" width="'.$_POST['width'].'" height="'.$_POST['height'].'" header="'.$_POST['head'].'" colorscheme="'.$_POST['colorsc'].'" linktarget="'.$_POST['target'].'" border_color="#'.$_POST['border'].'" font="'.$_POST['font'].'" recommendations="'.$_POST['recom'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></fb:activity>';
}	
break;
case 'recommendation':
if($_POST['render']==1){
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
 <div class="fb-recommendations" data-site="'.$_POST['domain'].'" data-action="'.$_POST['action'].'" data-width="'.$_POST['width'].'" data-height="'.$_POST['height'].'" data-header="'.$_POST['head'].'" data-colorscheme="'.$_POST['colorsc'].'" data-linktarget="'.$_POST['target'].'" data-border-color="#'.$_POST['border'].'" data-font="'.$_POST['font'].'" data-recommendations="'.$_POST['recom'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></div>';
}
else{
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
 <fb:recommendations site="'.$_POST['domain'].'" action="'.$_POST['action'].'" width="'.$_POST['width'].'" height="'.$_POST['height'].'" header="'.$_POST['head'].'" colorscheme="'.$_POST['colorsc'].'" linktarget="'.$_POST['target'].'" border_color="#'.$_POST['border'].'" font="'.$_POST['font'].'" recommendations="'.$_POST['recom'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></fb:recommendations>';
}
break;
case 'facepile':
switch($_POST['render']){
case 1:
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<div class="fb-facepile" data-href="'.$_POST['url'].'" data-size="'.$_POST['size'].'" data-action="'.$_POST['action'].'"  data-font="'.$_POST['font'].'" data-width="'.$_POST['width'].'"  data-max-rows="'.$_POST['rows'].'" data-colorscheme="'.$_POST['colorsc'].'"  style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></div>';
break;
case 2:
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:facepile href="'.$_POST['url'].'" size="'.$_POST['size'].'" action="'.$_POST['action'].'" font="'.$_POST['font'].'" width="'.$_POST['width'].'"  max-rows="'.$_POST['rows'].'" colorscheme="'.$_POST['colorsc'].'"  style="background:#'.$_POST['backg'].';"></fb:facepile>';
break;
case 3:
$encodedurl = urlencode($_POST['url']);
$_POST['code']="<iframe src=\"//www.facebook.com/plugins/facepile.php?href=".$encodedurl."&amp;width=".$_POST['width']."&amp;colorscheme=".$_POST['colorsc']."&amp;max_rows=".$_POST['rows']."&amp;action=".$_POST['action']."&amp;size=".$_POST['size']."\" scrolling=\"no\" frameborder=".$_POST['bord']." style=\" background-color:#".$_POST['backg']."; border-color:#".$_POST['border']."; overflow:hidden; width:".$_POST['width']."px; height:".$_POST['height']."px;".$_POST['css']."\" allowTransparency=\"true\"></iframe>";
break;
case 4:
		$encodedurl = urlencode($_POST['url']);
$_POST['code']="<a href=\"//www.facebook.com/plugins/facepile.php?href=".$encodedurl."&width=".$_POST['width']."&colorscheme=".$_POST['colorsc']."&max_rows=".$_POST['rows']."&border_color=".$_POST['border']."&action=".$_POST['action']."&size=".$_POST['size']."\" target=\"".$_POST['target']."\">".$_POST['url_value']."</a>";
	break;
}
break;
case 'follow':
switch($_POST['render']){
case 1:
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
	
<div class="fb-follow" data-href="'.$url.'" data-layout="'.$_POST['layout'].'" data-colorscheme="'.$_POST['colorsc'].'" data-show-faces="'.$_POST['face'].'" data-font="'.$_POST['font'].'" data-width="'.$_POST['width'].'" data-border-color="#'.$_POST['border'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></div>';
break;
case 2:
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
 <fb:follow href="'.$url.'" layout="'.$_POST['layout'].'" colorscheme="'.$_POST['colorsc'].'" show_faces="'.$_POST['face'].'" font="'.$_POST['font'].'" width="'.$_POST['width'].'" border_color="#'.$_POST['border'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></fb:follow>';
 break;
 case 3:
 $encodedurl = urlencode($url);
  $_POST['code']="<iframe src=\"//www.facebook.com/plugins/follow.php?href=".$encodedurl."&amp;width=".$_POST['width']."&amp;colorscheme=".$_POST['colorsc']."&amp;show_faces=".$_POST['face']."&amp;\" scrolling=\"no\" frameborder=".$_POST['bord']." style=\" background-color:#".$_POST['backg']."; border-color:#".$_POST['border']."; overflow:hidden; width:".$_POST['width']."px;".$_POST['css']."\"  allowTransparency=\"true\"></iframe>";
	break;
	case 4:
	$encodedurl = urlencode($url);
$_POST['code']="<a href=\"//www.facebook.com/plugins/follow.php?href=".$encodedurl."&width=".$_POST['width']."&colorscheme=".$_POST['colorsc']."&show_faces=".$_POST['face']."&border_color=#".$_POST['border']."\" target=\"".$_POST['target']."\">".$_POST['url_value']."</a>";
break;
}
break;
case 'likebox':
switch($_POST['render']){
case 1:
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
 <div class="fb-like-box" data-href="'.$url.'" data-font="'.$_POST['font'].'"  data-width="'.$_POST['width'].'" data-height="'.$_POST['height'].'" data-colorscheme="'.$_POST['colorsc'].'" data-show-faces="'.$_POST['face'].'" data-border-color="#'.$_POST['border'].'" data-stream="'.$_POST['stream'].'" data-header="'.$_POST['head'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></div>';
break;
case 2:
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:like-box href="'.$url.'" font="'.$_POST['font'].'" width="'.$_POST['width'].'" height="'.$_POST['height'].'" colorscheme="'.$_POST['colorsc'].'" show_faces="'.$_POST['face'].'" border_color="#'.$_POST['border'].'" stream="'.$_POST['stream'].'" header="'.$_POST['head'].'" style="background:#'.$_POST['backg'].';'.$_POST['css'].'"></fb:like-box>';
break;
case 3:
 $encodedurl = urlencode($url);
 $_POST['code']="<iframe src=\"//www.facebook.com/plugins/likebox.php?href=".$encodedurl."&amp;width=".$_POST['width']."&amp;colorscheme=".$_POST['colorsc']."&amp;show_faces=".$_POST['face']."&amp;stream=".$_POST['stream']."&amp;header=".$_POST['head']."&amp;height=".$_POST['height']."\" scrolling=\"no\" frameborder=".$_POST['bord']." style=\" background-color:#".$_POST['backg']."; border-color:#".$_POST['border']."; overflow:hidden; width:".$_POST['width']."px; height:".$_POST['height']."px;".$_POST['css']."\" allowTransparency=\"true\"></iframe>";
break;
case 4:
 $encodedurl = urlencode($url);
 $_POST['code']="<a href=\"//www.facebook.com/plugins/likebox.php?href=".$encodedurl."&width=".$_POST['width']."&height=".$_POST['height']."&colorscheme=".$_POST['colorsc']."&show_faces=".$_POST['face']."&border_color=#".$_POST['border']."&stream=".$_POST['stream']."&header=".$_POST['head']."\" target=\"".$_POST['target']."\">".$_POST['url_value']."</a>";
 break;
 }	
 break;
case 'pagetab': 
$_POST['code']="</script>
    <div id='fb-root'></div>
    <script src='http://connect.facebook.net/en_US/all.js'></script>
    <p><button onclick='addToPage(); return false;'>Add to Page</button></p>
    <p id='msg'></p>
    <script> 
      FB.init({appId: '".$_POST['appid']."', status: true, cookie: true});
      function addToPage() {
        // calling the API ...
        var obj = {
          method: 'pagetab',
          redirect_uri: '".$url."',
        };
        FB.ui(obj);
      }
    
    </script>";
	break;
	case 'share': 
$_POST['code']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<fb:share-button href="'.$url.'" type="'.$_POST['share_type'].'"
style="'.$_POST['css'].'">
</fb:share-button>';
	
	
	break;
	case 'request': 
	if($_POST['request_type']=='1'){
	$_POST['code']='<div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
     <p>
    <input type="button"
      onclick="sendRequestViaMultiFriendSelector(); return false;"
      value="Request"
	  style="'.$_POST['css'].'"
    />
    </p>
     <script>
      FB.init({
        appId  : "'.$_POST['appid'].'",
        frictionlessRequests: true
      });
      function sendRequestViaMultiFriendSelector() {
        FB.ui({method: "apprequests",
          message: "'.$_POST['req_m'].'"
        }, requestCallback);
      }
      
      function requestCallback(response) {
        // Handle callback here
      }
    </script>';
	
	}
	else{
	$_POST['code']='<div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
   <p>
      <input type="button"
        onclick="sendRequestToRecipients(); return false;"
        value="Request"
		style="'.$_POST['css'].'"
      />
      <input type="text" value="" name="user_ids" />
      </p>
    
    
    <script>
      FB.init({
        appId  : "'.$_POST['appid'].'",
        frictionlessRequests: true
      });
      function sendRequestToRecipients() {
        var user_ids = document.getElementsByName("user_ids")[0].value;
        FB.ui({method: "apprequests",
          message: "'.$_POST['req_m'].'",
          to: user_ids
        }, requestCallback);
      }
     
      
      function requestCallback(response) {
        // Handle callback here
      }
    </script>';
	
	
	}
	break;
	case 'register':
	if(isset($_POST['reg_type']))
	$reg_type=$_POST['reg_type'];
	else
	$reg_type='';
	if($_POST['log_red'])
        {
	       $log_red=$_POST['log_red'];
         $log_red=str_replace('&','@@@',$log_red);
	}
	else
        {
	       $log_red='autoLOGREDauto';
	}
	if($_POST['reg_red']){
	$reg_red=$_POST['reg_red'];
        $reg_red=str_replace('&','@@@',$reg_red);
	}
	else{
	$reg_red='autoREGREDauto';
	}
$_POST['code']='<div id="fb-root"></div>
<script>
var web = {
    login: {
       
        login_custom: function()
        {
            FB.login(function (response)
            {
                if (response.status === "connected")
                {
                    web.login.login_button_click();
                }
            }, {
                scope: jfbcRequiredPermissions
            });
        },
        // Action to perform after authentication on FB has occurred
        login_button_click: function()
        {
            FB.getLoginStatus(function(response)
            {
                
                if (response.status === "connected")
                {
				
                    self.location = "get_registration_for_faceebok_page_or_posttask=login&res="+response.authResponse.signedRequest+"&log_red='.$log_red.'";
                }
            });
        },
       
            
      
        
    },
    
}
  window.fbAsyncInit = function() {
    FB.init({
      appId      : "'.$_POST['appid'].'", // App ID
      channelUrl : "'.$_POST['domain'].'", // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
});
    
 };
 
  // Load the SDK Asynchronously
  (function(d){
     var js, id = "facebook-jssdk", ref = d.getElementsByTagName("script")[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement("script"); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>
<fb:login-button
  id="temp_id"
  registration-url="get_registration_for_faceebok_page_or_posttask=registration&type='.$reg_type.'&appid='.$_POST['appid'].'&g_red='.$reg_red.'" 
  
  onlogin="javascript:web.login.login_button_click();"
>
  
</fb:login-button>';	
	
	break;
	
}
}
class seve_or_update_sp{
	public $table_name;
	public $conect_array;
	private $genereted_conect_array;
	//// construct class
	public function __construct($my_table_name='',$my_conect_information=array()){
		global $wpdb;
		$get_filds=$wpdb->get_results("SHOW FIELDS FROM ".$wpdb->prefix.$my_table_name);
		$get_only_fild_name=array();
		$count_fields=count($get_filds);
		if(!$count_fields){
			throw new Exception('<div id="message" class="error"><p>Cannot Faind '.$my_table_name.' Table Fields</p></div>');
		}
		for($i=0;$i<$count_fields;$i++)
		{
			$get_only_fild_name[$i]=$get_filds[$i]->Field;
		}
		$this->conect_array=$get_only_fild_name;
		$this->table_name=$my_table_name;
		$this->genereted_conect_array=$this->conect_post_with_table($my_conect_information,$this->conect_array);
	}
	/// conect post array with database
	private function conect_post_with_table($array_post=array(),$array_fields=array()){
		$binded_array=array();
		
		if(!$array_post){
			throw new Exception('<div id="message" class="error"><p>Not Get Information From Previus Page</p></div>');
		}
		if(!$array_fields){
			throw new Exception('<div id="message" class="error"><p>Binding Failed</p></div>');
		}
		foreach($array_post as $key=>$post)
		{
			if(in_array($key, $array_fields))
			{
				$binded_array[$key]=$post;
			}
		}
		return $binded_array;
	}
	
	/// if need modifide information for save or update
	public function modified_variable($key_for_post,$new_value_post){
	$this->genereted_conect_array[$key_for_post]=$new_value_post;	
	}	
	/// save parametrs
	public function save_parametrs(){
	global $wpdb;
	if(isset($this->genereted_conect_array['id']))
	$this->genereted_conect_array['id']=NULL;
	$save_or_no=$wpdb->insert($wpdb->prefix.$this->table_name,$this->genereted_conect_array);
	if($save_or_no)
	{
		echo '<div id="message" class="updated fade"><p>Successfully Saved</p></div>';
	}
	else
	{
		echo '<div id="message" class="error"><p>Save Failed</p></div>';
	}
	}
	/// update parametrs
	public function update_parametrs($id){
		global $wpdb;
		if(isset($this->genereted_conect_array['id']))
		unset($this->genereted_conect_array['id']);
		$save_or_no=$wpdb->update($wpdb->prefix.$this->table_name,$this->genereted_conect_array,array( 'id' => $id ));
				
	}
}
function  update_prad_cat($id){}
function save_prad_cat()
{}
function remove_Spider_Facebook($id){
	global $wpdb;
  // If any item selected
  
    // Prepare sql statement, if cid array more than one, 
    // will be "cid1, cid2, ..."
    // Create sql statement
	 $sql_remov_vid="DELETE FROM ".$wpdb->prefix."spiderfacebook_params WHERE id='".$id."'";
 if(!$wpdb->query($sql_remov_vid))
 {
	  ?>
	  <div id="message" class="error"><p>Spider Facebook Not Deleted</p></div>
      <?php
	 
 }
 else{
 ?>
 <div class="updated"><p><strong><?php _e('Item Deleted.' ); ?></strong></p></div>
 <?php
 }
}
////////////////////////////////////////////////////
function cange_facebook_published( $id ){
  global $wpdb;
  $published=$wpdb->get_var("SELECT published FROM ".$wpdb->prefix."spiderfacebook_params WHERE `id`=".$id );
  if($published)
   $published=0;
  else
   $published=1;
  $savedd=$wpdb->update($wpdb->prefix.'spiderfacebook_params', array(
			'published'    =>$published,
              ), 
              array('id'=>$id),
			  array(  '%d' )
			  );
	if($save_or_no)
	{
		?>
	<div class="error"><p><strong><?php _e('Error. Please install plugin again'); ?></strong></p></div>
	<?php
		return false;
	}
	?>
	<div class="updated"><p><strong><?php _e('Published Changed'); ?></strong></p></div>
	<?php
	
    return true;
}
