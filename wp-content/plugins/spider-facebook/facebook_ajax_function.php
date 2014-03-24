<?php
////////////////////// function for add ajax
/////////////////////////////////////// admin
$filterrr='';
function select_posts_for_facebook(){
	
	global $wpdb;
	if(!function_exists('print_html_nav'))
		require_once("nav_function/nav_html_func.php");
	if(isset($_POST['cat_id']))
	{
		$cat_id=$_POST['cat_id'];
	}
	else
	{
		$cat_id='';
	}
	$sort["sortid_by"]="post_date";
	
	
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
	
	$args_for_choosen_fb_posts = array(
		'posts_per_page'  => 20000,
		'numberposts'     => 20,
		'offset'          => ($limit),
		'category'        => $cat_id,
		'orderby'         => $sort["sortid_by"],
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'post',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'post_status'     => 'publish',
		'suppress_filters' => false );
		global $filterrr;
		if(isset($_POST['search_events_by_title']))
		$filterrr=$_POST['search_events_by_title'];
		
		add_filter( 'posts_where', 'filter_for_post' );
	$myposts=get_posts( $args_for_choosen_fb_posts );
	$categories = get_categories();
	
	$pageNav['total'] =count($myposts);
		$pageNav['limit'] =	 $limit/20+1;
	remove_filter( 'posts_where', 'filter_for_post' );
	html_select_posts_for_facebook($myposts,$pageNav, $sort,$categories);
	
}
function filter_for_post( $where = '' ) {
    global $wpdb;
	global $filterrr;
    $where .= $wpdb->prepare( " AND post_title LIKE %s", '%'.$filterrr.'%' );
 
    return $where;
}
function html_select_posts_for_facebook($rows,$pageNav, $sort,$categories){
if(get_bloginfo( 'version' )>3.3){
	?>
<link rel="stylesheet" href="<?php echo bloginfo("url") ?>/wp-admin/load-styles.php?c=0&amp;dir=ltr&amp;load=admin-bar,wp-admin&amp;ver=7f0753feec257518ac1fec83d5bced6a" type="text/css" media="all">
<?php
}
else
{
	?>
 <link rel="stylesheet" href="<?php echo bloginfo("url") ?>/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load=global,wp-admin&amp;ver=aba7495e395713976b6073d5d07d3b17" type="text/css" media="all">
 <?php
}
?>
<link rel="stylesheet" id="thickbox-css" href="<?php echo bloginfo('url')?>/wp-includes/js/thickbox/thickbox.css?ver=20111117" type="text/css" media="all">
<link rel="stylesheet" id="colors-css" href="<?php echo bloginfo('url')?>/wp-admin/css/colors-classic.css?ver=20111206" type="text/css" media="all">
<?php	
	
		
	global $wpdb;
	?>
    <script language="javascript">
	function ordering(name,as_or_desc)
	{
		document.getElementById('asc_or_desc').value=as_or_desc;		
		document.getElementById('order_by').value=name;
		document.getElementById('admin_form').submit();
	}
function doNothing() {  
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if( keyCode == 13 ) {
        if(!e) var e = window.event;
        e.cancelBubble = true;
        e.returnValue = false;
        if (e.stopPropagation) {
                e.stopPropagation();
                e.preventDefault();
        }
}
}
function isChecked(isitchecked){
	if (isitchecked == true){
		document.adminForm.boxchecked.value++;
	}
	else {
		document.adminForm.boxchecked.value--;
	}
}
function art()
{
	var ARTS =[];
	var title =[];
	
	var auto_meta_title =[];
	var auto_meta_type =[];
	var auto_meta_url =[];
	var auto_meta_image =[];
	var auto_meta_site_name =[];
	var auto_meta_description =[];
	var auto_meta_admins =[];
	
	for(i=0; i<<?php echo count($rows) ?>; i++)
		if(document.getElementById("p"+i))
			if(document.getElementById("p"+i).checked)
			{
			   
				ARTS.push(document.getElementById("p"+i).value);
				title.push(document.getElementById("title_"+i).value);
				
								
				auto_meta_title.push(document.getElementById("title_"+i).value);
				auto_meta_type.push(document.getElementById("type_"+i).value);
				auto_meta_url.push(document.getElementById("url_"+i).value);
				auto_meta_image.push(document.getElementById("image_"+i).value);
				auto_meta_site_name.push(document.getElementById("site_name_"+i).value);
				auto_meta_description.push(document.getElementById("description_"+i).value);
				auto_meta_admins.push(document.getElementById("admins_"+i).value);
				 
			}
			
	window.parent.jSelectArticles(ARTS, title,1,auto_meta_title,auto_meta_type,auto_meta_url,auto_meta_image,auto_meta_site_name,auto_meta_description,auto_meta_admins);
}
function checkAll( n, fldName ) {
  if (!fldName) {
     fldName = 'cb';
  }
	var f = document.admin_form;
	var c = f.toggle.checked;
	var n2 = 0;
	for (i=0; i < n; i++) {
		cb = eval( 'f.' + fldName + '' + i );
		if (cb) {
			cb.checked = c;
			n2++;
		}
	}
	if (c) {
		document.admin_form.boxchecked.value = n2;
	} else {
		document.admin_form.boxchecked.value = 0;
	}
}
	</script>
    <form method="post" onkeypress="doNothing()"  action="<?php echo admin_url('admin-ajax.php') ?>?action=selectpostsforfacebook" id="admin_form" name="admin_form">
<table style="width:95%">
		<tbody><tr>
		   <td align="right">
	   
			        <select name="cat_id" onchange="document.admin_form.submit();">
					<option value="0">Select categories</option>
<?php
foreach($categories as $categorie){?>	
					 
					   <option value="<?php echo $categorie->cat_ID; ?>" <?php if($_POST['cat_id']==$categorie->cat_ID){echo 'selected="selected"';} ?>><?php echo $categorie->name; ?></option>
<?php }
?>						   					  
					</select>
									   
			</td></td>
			<td align="right" width="100%">
                <button onclick="art();" style="width:98px; height:34px; background:url(<?php echo plugins_url('',__FILE__) ?>/images/add_but.png) no-repeat;border:none;cursor:pointer;">&nbsp;</button>           
           </td>
		   </tr>
		
		
		</tbody>
        </table>
    <?php
	$serch_value='';
	if(isset($_POST['serch_or_not'])) {if($_POST['serch_or_not']=="search"){ $serch_value=$_POST['search_events_by_title']; }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:180px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=Form_maker_Themes\'" class="button-secondary action">
    </div>';
	 print_html_nav($pageNav['total'],$pageNav['limit'],$serch_fields);	
	
	?>
  <table class="wp-list-table widefat fixed pages" style="width:95%">
 <thead>
 <TR>
 <th width="30" style="text-align: center;"><?php echo '#'; ?></th>
            <th width="20" class="manage-column column-cb check-column">
            <input  type="checkbox" name="toggle" id="toggle" value="" onclick="checkAll(<?php echo count($rows)?>, 'p')">
            </th>
 <th scope="col" id="id" class="<?php if($sort["sortid_by"]=="id") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style=" width:120px;text-align: center; " ><a href="javascript:ordering('id',<?php if($sort["sortid_by"]=="id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>ID</span><span class="sorting-indicator"></span></a></th>
 <th scope="col" id="title" class="<?php if($sort["sortid_by"]=="title") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style="" ><a href="javascript:ordering('title',<?php if($sort["sortid_by"]=="title") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
 </TR>
 </thead>
 <tbody>
 <?php 
 $k = 0;
 for($i=0; $i<count($rows);$i++){
	
 $row = $rows[$i];
 if(get_option('page_on_front') &&  $row->ID==get_option('page_on_front')){
	 $meta_post_title= get_bloginfo( 'name' );
	 $meta_post_type='website';
	 $meta_post_url=home_url();	
	 $meta_post_description = get_bloginfo( 'description' );	 
	 $meta_post_sitename=get_bloginfo( 'name' );
	 
 }
 else
 {
	 $meta_post_title= $row->post_title;
	 $meta_post_type='article';
	 $meta_post_url=get_permalink($row->ID);	 
	 $meta_post_sitename=get_bloginfo( 'name' );
	 $meta_post_description ='';
 }
 
 
?>
 <tr class="<?php echo "row$k"; ?>"> 
         <td align="center"><?php echo $i+1?></td>
        	<td>
			<input type="checkbox" id="p<?php echo $i?>" value="<?php echo $row->ID;?>" />
			<input type="hidden" id="title_<?php echo $i?>" value="<?php echo  htmlspecialchars($row->post_title);?>" />
            
                        
            <input type="hidden" id="type_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_type);?>" />
            <input type="hidden" id="url_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_url);?>" />
            <input type="hidden" id="image_<?php echo $i?>" value="<?php echo  htmlspecialchars('');?>" />
            <input type="hidden" id="site_name_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_sitename);?>" />
            <input type="hidden" id="description_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_description);?>" />
            <input type="hidden" id="admins_<?php echo $i?>" value="<?php echo  htmlspecialchars('');?>" />
			             </td>
         <td style="text-align: center;"><?php echo $row->ID; ?></td>
         <td><a style="cursor: pointer;" onclick="window.parent.jSelectArticles(['<?php echo $row->ID?>'],['<?php echo htmlspecialchars(addslashes($row->post_title));?>'],1,['<?php echo htmlspecialchars(addslashes($meta_post_title));?>'],['<?php echo htmlspecialchars(addslashes($meta_post_type));?>'],['<?php echo htmlspecialchars(addslashes($meta_post_url));?>'],[''],['<?php echo htmlspecialchars(addslashes($meta_post_sitename));?>'],['<?php echo htmlspecialchars(addslashes($meta_post_description));?>'],[''])"><?php echo $row->post_title; ?></a></td>
         
         
         
  </tr> 
 <?php  
 $k = 1 - $k;
 }
 ?>
 </tbody>
 </table>
 <input type="hidden" name="boxchecked" value="0">
 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo $_POST['asc_or_desc'];?>"  />
 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo $_POST['order_by'];?>"  />
 <?php
?>
    
    
   
 </form>
    <?php
	
	die('');
	}
function select_pages_for_facebook(){
	
	
	$asc_desc_="ASC";
	global $wpdb;
	if(!function_exists('print_html_nav'))
		require_once("nav_function/nav_html_func.php");
	if(isset($_GET['cat_id']))
	{
		$cat_id=$_GET['cat_id'];
	}
	else
	{
		$cat_id='';
	}
	
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
						$asc_desc_="ASC";
					}
					else
					{
						$sort["custom_style"]="manage-column column-title sorted desc";
						$sort["1_or_2"]="1";
						$order="ORDER BY ".$sort["sortid_by"]." DESC";
						$asc_desc_="DESC";
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
	
	$args_for_choosen_fb_posts = array(
		'posts_per_page'  => 20000,
		'numberposts'     => 20,
		'offset'          => ($limit),
		'category'        => $cat_id,
		'orderby'         => $sort["sortid_by"],
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'page',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'post_status'     => 'publish',
		'suppress_filters' => false );
		global $filterrr;
		if(isset($_POST['search_events_by_title']))
		$filterrr=$_POST['search_events_by_title'];
		
		add_filter( 'posts_where', 'filter_for_post' );
	$myposts=get_posts( $args_for_choosen_fb_posts );
	$pageNav['total'] =count($myposts);
		$pageNav['limit'] =	 $limit/20+1;
	remove_filter( 'posts_where', 'filter_for_post' );
	html_select_pages_for_facebook($myposts,$pageNav, $sort);
	
	
	
	}
function html_select_pages_for_facebook($rows,$pageNav, $sort){
	
if(get_bloginfo( 'version' )>3.3){
	?>
<link rel="stylesheet" href="<?php echo bloginfo("url") ?>/wp-admin/load-styles.php?c=0&amp;dir=ltr&amp;load=admin-bar,wp-admin&amp;ver=7f0753feec257518ac1fec83d5bced6a" type="text/css" media="all">
<?php
}
else
{
	?>
 <link rel="stylesheet" href="<?php echo bloginfo("url") ?>/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load=global,wp-admin&amp;ver=aba7495e395713976b6073d5d07d3b17" type="text/css" media="all">
 <?php
}
?>
<link rel="stylesheet" id="thickbox-css" href="<?php echo bloginfo('url')?>/wp-includes/js/thickbox/thickbox.css?ver=20111117" type="text/css" media="all">
<link rel="stylesheet" id="colors-css" href="<?php echo bloginfo('url')?>/wp-admin/css/colors-classic.css?ver=20111206" type="text/css" media="all">
<?php	
	
		
	global $wpdb;
	?>
  <script type="text/javascript">
  function checkAll( n, fldName ) {
  if (!fldName) {
     fldName = 'cb';
  }
	var f = document.admin_form;
	var c = f.toggle.checked;
	var n2 = 0;
	for (i=0; i < n; i++) {
		cb = eval( 'f.' + fldName + '' + i );
		if (cb) {
			cb.checked = c;
			n2++;
		}
	}
	if (c) {
		document.admin_form.boxchecked.value = n2;
	} else {
		document.admin_form.boxchecked.value = 0;
	}
}
function ordering(name,as_or_desc)
	{
		document.getElementById('asc_or_desc').value=as_or_desc;		
		document.getElementById('order_by').value=name;
		document.getElementById('admin_form').submit();
	}
function doNothing() {  
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if( keyCode == 13 ) {
        if(!e) var e = window.event;
        e.cancelBubble = true;
        e.returnValue = false;
        if (e.stopPropagation) {
                e.stopPropagation();
                e.preventDefault();
        }
}
}
function isChecked(isitchecked){
	if (isitchecked == true){
		document.adminForm.boxchecked.value++;
	}
	else {
		document.adminForm.boxchecked.value--;
	}
}
function submitbutton(pressbutton) {
	var form = document.adminForm;
	submitform( pressbutton );
}
function tableOrdering( order, dir, task ) {
    var form = document.adminForm;
    form.filter_order_item.value     = order;
    form.filter_order_Dir_item.value = dir;
    submitform( task );
}
function isChecked(isitchecked){
	if (isitchecked == true){
		document.adminForm.boxchecked.value++;
	}
	else {
		document.adminForm.boxchecked.value--;
	}
}
function item()
{
	var ITEMS =[];
	var title =[];
	
	var auto_meta_title =[];
	var auto_meta_type =[];
	var auto_meta_url =[];
	var auto_meta_image =[];
	var auto_meta_site_name =[];
	var auto_meta_description =[];
	var auto_meta_admins =[];
	
	for(i=0; i<<?php echo count($rows) ?>; i++)
		if(document.getElementById("p"+i))
			if(document.getElementById("p"+i).checked)
			{
			   
				ITEMS.push(document.getElementById("p"+i).value);
				title.push(document.getElementById("title_"+i).value);
				
				auto_meta_title.push(document.getElementById("title_"+i).value);
				auto_meta_type.push(document.getElementById("type_"+i).value);
				auto_meta_url.push(document.getElementById("url_"+i).value);
				auto_meta_image.push(document.getElementById("image_"+i).value);
				auto_meta_site_name.push(document.getElementById("site_name_"+i).value);
				auto_meta_description.push(document.getElementById("description_"+i).value);
				auto_meta_admins.push(document.getElementById("admins_"+i).value);
				
				 
			}
			
	window.parent.jSelectItems(ITEMS, title,1,auto_meta_title,auto_meta_type,auto_meta_url,auto_meta_image,auto_meta_site_name,auto_meta_description,auto_meta_admins);
}
</script>
    <form method="post" onkeypress="doNothing()"  action="<?php echo admin_url('admin-ajax.php') ?>?action=selectpagesforfacebook" id="admin_form" name="admin_form">
<table style="width:95%">
		<tbody><tr>
		   <td align="right"
									   
			</td></td>
			<td align="right" width="100%">
                <button onclick="item();" style="width:98px; height:34px; background:url(<?php echo plugins_url('',__FILE__) ?>/images/add_but.png) no-repeat;border:none;cursor:pointer;">&nbsp;</button>           
           </td>
		   </tr>
		
		
		</tbody>
        </table>
    <?php
	$serch_value='';
	if(isset($_POST['serch_or_not'])) {if($_POST['serch_or_not']=="search"){ $serch_value=$_POST['search_events_by_title']; }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:180px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=Form_maker_Themes\'" class="button-secondary action">
    </div>';
	 print_html_nav($pageNav['total'],$pageNav['limit'],$serch_fields);	
	
	?>
  <table class="wp-list-table widefat fixed pages" style="width:95%">
 <thead>
 <TR>
 <th width="30" style="text-align: center;"><?php echo '#'; ?></th>
            <th width="20" class="manage-column column-cb check-column">
            <input  type="checkbox" name="toggle" id="toggle" value="" onclick="checkAll(<?php echo count($rows)?>, 'p')">
            </th>
 <th scope="col" id="id" class="<?php if($sort["sortid_by"]=="id") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style=" width:120px;text-align: center; " ><a href="javascript:ordering('id',<?php if($sort["sortid_by"]=="id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>ID</span><span class="sorting-indicator"></span></a></th>
 <th scope="col" id="title" class="<?php if($sort["sortid_by"]=="title") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style="" ><a href="javascript:ordering('title',<?php if($sort["sortid_by"]=="title") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
 </TR>
 </thead>
 <tbody>
 <?php 
 $k = 0;
 for($i=0; $i<count($rows);$i++){
 $row = $rows[$i];
  if(get_option('page_on_front') &&  $row->ID==get_option('page_on_front')){
	 $meta_post_title= get_bloginfo( 'name' );
	 $meta_post_type='website';
	 $meta_post_url=home_url();	
	 $meta_post_description = get_bloginfo( 'description' );	 
	 $meta_post_sitename=get_bloginfo( 'name' );
	 
 }
 else
 {
	 $meta_post_title= $row->post_title;
	 $meta_post_type='article';
	 $meta_post_url=get_permalink($row->ID);	 
	 $meta_post_sitename=get_bloginfo( 'name' );
	 $meta_post_description ='';
 }
?>
 <tr class="<?php echo "row$k"; ?>"> 
         <td align="center"><?php echo $i+1?></td>
        	<td>
			<input type="checkbox" id="p<?php echo $i?>" value="<?php echo $row->ID;?>" />
			<input type="hidden" id="title_<?php echo $i?>" value="<?php echo  htmlspecialchars($row->post_title);?>" />
            
                       
            <input type="hidden" id="type_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_type);?>" />
            <input type="hidden" id="url_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_url);?>" />
            <input type="hidden" id="image_<?php echo $i?>" value="<?php echo  htmlspecialchars('');?>" />
            <input type="hidden" id="site_name_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_sitename);?>" />
            <input type="hidden" id="description_<?php echo $i?>" value="<?php echo  htmlspecialchars($meta_post_description);?>" />
            <input type="hidden" id="admins_<?php echo $i?>" value="<?php echo  htmlspecialchars('');?>" />
			             </td>
         <td style="text-align: center;"><?php echo $row->ID; ?></td>
         <td><a style="cursor: pointer;" onclick="window.parent.jSelectItems(['<?php echo $row->ID?>'],['<?php echo htmlspecialchars(addslashes($row->post_title));?>'],1,['<?php echo htmlspecialchars(addslashes($meta_post_title));?>'],['<?php echo htmlspecialchars(addslashes($meta_post_type));?>'],['<?php echo htmlspecialchars(addslashes($meta_post_url));?>'],[''],['<?php echo htmlspecialchars(addslashes($meta_post_sitename));?>'],['<?php echo htmlspecialchars(addslashes($meta_post_description));?>'],[''])"><?php echo $row->post_title; ?></a></td>
  </tr> 
 <?php  
 $k = 1 - $k;
 }
 ?>
 </tbody>
 </table>
 <input type="hidden" name="boxchecked" value="0">
 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo $_POST['asc_or_desc'];?>"  />
 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo $_POST['order_by'];?>"  />
 <?php
?>
    
    
   
 </form>
    <?php
	
	die('');
	
	
	}
////////////////////////////////////////////////////////////////////////////////////////////
 ?>