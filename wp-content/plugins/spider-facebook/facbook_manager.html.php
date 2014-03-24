	<?php	
	
	if(!current_user_can('manage_options')) {
	die('Access Denied');
}	
 //////////////////////////////////////////////////////                                             /////////////////////////////////////////////////////// 
 //////////////////////////////////////////////////////      Html functions for products            ///////////////////////////////////////////////////////
 //////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
 //////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
 
 
 
 
 
 
 
 
 
 
function html_spider_facebook_show($rows, $pageNav, $sort)
{
	
		
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
	</script>
    <form method="post" action="admin.php?page=Spider_Facebook_manage" onkeypress="doNothing()" id="admin_form" name="admin_form" >
	<table cellspacing="10" width="100%">
    <tr><td><a href="http://web-dorado.com/wordpress-facebook-guide-step-1.html" target="_blank" style="color:blue; text-decoration:none;font-size:16px; font-weight:bold">User Manual</a></td></tr>
    <tr>
    <td style="width:210px">
    <?php echo "<h2 style=\"float:left\">".'Spider Facebook'. "</h2>"; ?>
    <input type="button" style="float:left; position:relative; top:10px; margin-left:20px" class="button-secondary action" value="Add a Facebook" name="custom_parametrs" onclick="window.location.href='admin.php?page=Spider_Facebook_manage&task=add'" />
    </td>
     <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href=" http://web-dorado.com/products/wordpress-facebook.html " target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a>
	</td>
    </tr>
    </table>
    <?php
	if(isset($_POST['serch_or_not'])) {if($_POST['serch_or_not']=="search"){ $serch_value=$_POST['search_events_by_title']; }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:180px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=Spider_Facebook_manage\'" class="button-secondary action">
    </div>';
	 print_html_nav($pageNav['total'],$pageNav['limit'],$serch_fields);	
	
	?>
  <table class="wp-list-table widefat fixed pages" style="width:95%">
 <thead>
 <tr>
 <th scope="col" id="id" class="<?php if($sort["sortid_by"]=="id") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style="width:110px" ><a href="javascript:ordering('id',<?php if($sort["sortid_by"]=="id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>ID</span><span class="sorting-indicator"></span></a></th>
 <th scope="col" id="title" class="<?php if($sort["sortid_by"]=="title") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style="" ><a href="javascript:ordering('title',<?php if($sort["sortid_by"]=="title") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
 <th scope="col" id="title" class="<?php if($sort["sortid_by"]=="type") echo $sort["custom_style"]; else echo $sort["default_style"]; ?>" style="" ><a href="javascript:ordering('type',<?php if($sort["sortid_by"]=="title") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Type</span><span class="sorting-indicator"></span></a></th>
 <th scope="col" ><span>Published</span></th>
 <th style="width:80px">Edit</th>
 <th style="width:80px">Delete</th>
 </tr>
 </thead>
 <tbody>
 <?php for($i=0; $i<count($rows);$i++){ ?>
 <tr>
         <td><?php echo $rows[$i]->id; ?></td>
         <td><a  href="admin.php?page=Spider_Facebook_manage&task=Spider_Facebook_edit&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->title; ?></a></td>
         <td><?php echo $rows[$i]->type;?></td>
         <td><a  href="admin.php?page=Spider_Facebook_manage&task=publiah_spider_facebook&id=<?php echo $rows[$i]->id?>"<?php if(!$rows[$i]->published){ ?> style="color:#C00;" <?php }?> ><?php if($rows[$i]->published)echo "Yes"; else echo "No"; ?></a></td>
         <td><a  href="admin.php?page=Spider_Facebook_manage&task=Spider_Facebook_edit&id=<?php echo $rows[$i]->id?>">Edit</a></td>
         <td><a  href="admin.php?page=Spider_Facebook_manage&task=remove_Spider_Facebook&id=<?php echo $rows[$i]->id?>">Delete</a></td>
  </tr> 
 <?php } ?>
 </tbody>
 </table>
 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo $_POST['asc_or_desc'];?>"  />
 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo $_POST['order_by'];?>"  />
 <?php
?>
    
    
   
 </form>
    <?php
	
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
function html_spider_facebook_add( $row,$arts_id,$titles,$items_id,$item_titles)
{
		$spider_video_player_url=plugins_url('',__FILE__);
		$meta_title=explode('***',$row->meta_title);
		$meta_title= array_slice($meta_title,0, count($meta_title)-1);
		
		$meta_type=explode('***',$row->meta_type);
		$meta_type= array_slice($meta_type,0, count($meta_type)-1);
		
	    $meta_url=explode('***',$row->meta_url);
		$meta_url= array_slice($meta_url,0, count($meta_url)-1);
		
		$meta_image=explode('***',$row->meta_image);
		$meta_image= array_slice($meta_image,0, count($meta_image)-1); 
		
		$meta_site_name=explode('***',$row->meta_site_name);
		$meta_site_name= array_slice($meta_site_name,0, count($meta_site_name)-1); 
		
		$meta_description=explode('***',$row->meta_description);
		$meta_description= array_slice($meta_description,0, count($meta_description)-1);
		
		$meta_admins=explode('***',$row->meta_admins);
		$meta_admins= array_slice($meta_admins,0, count($meta_admins)-1);
		//$meta_app_id=explode('***',$row->meta_app_id);
		//$meta_app_id= array_slice($meta_app_id,0, count($meta_app_id)-1); 
		
		
		
		$item_meta_title=explode('***',$row->item_meta_title);
		$item_meta_title= array_slice($item_meta_title,0, count($item_meta_title)-1);
		
		$item_meta_type=explode('***',$row->item_meta_type);
		$item_meta_type= array_slice($item_meta_type,0, count($item_meta_type)-1);
		
	    $item_meta_url=explode('***',$row->item_meta_url);
		$item_meta_url= array_slice($item_meta_url,0, count($item_meta_url)-1);
		
		$item_meta_image=explode('***',$row->item_meta_image);
		$item_meta_image= array_slice($item_meta_image,0, count($item_meta_image)-1); 
		
		$item_meta_site_name=explode('***',$row->item_meta_site_name);
		$item_meta_site_name= array_slice($item_meta_site_name,0, count($item_meta_site_name)-1);
		
		$item_meta_description=explode('***',$row->item_meta_description);
		$item_meta_description= array_slice($item_meta_description,0, count($item_meta_description)-1);
		
		$item_meta_admins=explode('***',$row->item_meta_admins);
		$item_meta_admins= array_slice($item_meta_admins,0, count($item_meta_admins)-1);
		?>
		
		
<style>
.preview
{
float:right;
width:16%;
vertical-align:top;
align:center;
background-color:#F6F6F6;
height:100%;
}
.type_span{
cursor: pointer;
padding:3px;
display: inline-block;
text-align: center;
}
</style>
		
		
<script language="javascript" type="text/javascript">
function submitform( pressbutton )
{
	document.getElementById('adminForm').action="admin.php?page=Spider_Facebook_manage<?php if(isset($_GET['id'])) echo "&id=".$row->id ?>&task="+pressbutton;
	document.getElementById('adminForm').submit();
}
function submitbutton(pressbutton) 
{
    var req_app='request***recommendation***actfeed***loginbutton***register';
	var form = document.getElementById('adminForm');
	if (pressbutton == 'cancel') 
	{
		submitform( pressbutton );
		return;
	}
	
	if(form.title.value=="")
	{
		alert('Set title');
		return;
	}
	
	
	if((req_app.indexOf(document.getElementById('type').value))!==-1 && document.getElementById('appid_req').value==""){
        alert('Set App Id');
        return;
         }
	if(document.getElementById('req_m_input').value=='' && document.getElementById('type').value=='request')
	{
		alert('Set Request message');
		return;
	}
	meta_maker();
	
	submitform( pressbutton );
}
function meta_maker(){
var arts_arr=document.getElementById('articles').value.split('***');
var arts = arts_arr.slice(1,arts_arr.length-1);
     var meta_title='';
	 var meta_type='';
	 var meta_url='';
	 var meta_image='';
	 var meta_site_name='';
	 var meta_description='';
	 var meta_admins=''; 
	 
	 for(var i=0; i<arts.length; i++)
	 {
	    meta_title       = meta_title+document.getElementById(arts[i]+'_title').value+'***';
	    meta_type        = meta_type+document.getElementById(arts[i]+'_type').value+'***';
	    meta_url         = meta_url+document.getElementById(arts[i]+'_url').value+'***';
	    meta_image       = meta_image+document.getElementById(arts[i]+'_image').value+'***';
	    meta_site_name   = meta_site_name+document.getElementById(arts[i]+'_site_name').value+'***';
	    meta_description = meta_description+document.getElementById(arts[i]+'_description').value+'***';
	    meta_admins      = meta_admins+document.getElementById(arts[i]+'_admins').value+'***';
		
		
	
	}
	 document.getElementById('meta_title').value        =  meta_title;
	 document.getElementById('meta_type').value         =  meta_type;
	 document.getElementById('meta_url').value          =  meta_url;
     document.getElementById('meta_image').value        =  meta_image ;
     document.getElementById('meta_site_name').value    =  meta_site_name;
	 document.getElementById('meta_description').value  =  meta_description;
	 document.getElementById('meta_admins').value       =  meta_admins;
	
	
var items_arr=document.getElementById('items').value.split('***');
var items = items_arr.slice(1,items_arr.length-1);
     var item_meta_title='';
	 var item_meta_type='';
	 var item_meta_url='';
	 var item_meta_image='';
	 var item_meta_site_name='';
	 var item_meta_description='';
	 var item_meta_admins=''; 
	 
	 for(var i=0; i<items.length; i++)
	 {
	    item_meta_title       = item_meta_title+document.getElementById(items[i]+'_item_title').value+'***';
	    item_meta_type        = item_meta_type+document.getElementById(items[i]+'_item_type').value+'***';
	    item_meta_url         = item_meta_url+document.getElementById(items[i]+'_item_url').value+'***';
	    item_meta_image       = item_meta_image+document.getElementById(items[i]+'_item_image').value+'***';
	    item_meta_site_name   = item_meta_site_name+document.getElementById(items[i]+'_item_site_name').value+'***';
	    item_meta_description = item_meta_description+document.getElementById(items[i]+'_item_description').value+'***';
	    item_meta_admins      = item_meta_admins+document.getElementById(items[i]+'_item_admins').value+'***';
		
		
	 
	}
	
     document.getElementById('item_meta_title').value       =  item_meta_title;
	 document.getElementById('item_meta_type').value        =  item_meta_type;
	 document.getElementById('item_meta_url').value         =  item_meta_url;
     document.getElementById('item_meta_image').value       =  item_meta_image ;
     document.getElementById('item_meta_site_name').value   =  item_meta_site_name;
	 document.getElementById('item_meta_description').value =  item_meta_description;
	 document.getElementById('item_meta_admins').value      =  item_meta_admins;
	
}
function all_art(x)
{
if(x){
document.getElementById('articles').value='all';
document.getElementById('add_article').style.display='none';
if(document.getElementById('type').value=='likebutton' || document.getElementById('type').value=='sendbutton' || document.getElementById('type').value=='socials')
document.getElementById('def_img_art_tr').style.display='none';
}
else{
document.getElementById('articles').value='';
document.getElementById('add_article').style.display='';
if(document.getElementById('type').value=='likebutton' || document.getElementById('type').value=='sendbutton' || document.getElementById('type').value=='socials')
document.getElementById('def_img_art_tr').style.display='';
}
}
function all_item(x)
{
if(x)
{
document.getElementById('items').value='all';
document.getElementById('add_item').style.display='none';
if(document.getElementById('type').value=='likebutton' || document.getElementById('type').value=='sendbutton' || document.getElementById('type').value=='socials')
document.getElementById('def_img_item_tr').style.display='none';
}
else{
document.getElementById('items').value='';
document.getElementById('add_item').style.display='';
if(document.getElementById('type').value=='likebutton' || document.getElementById('type').value=='sendbutton' || document.getElementById('type').value=='socials')
document.getElementById('def_img_item_tr').style.display='';
}
}
function edit_art()
{
   <?php if($arts_id) {?>
	var ARTS =[<?php echo implode(',',$arts_id);  ?>];
	var title =[<?php echo '"'.implode('","',$titles).'"';  ?>];
	
	
	jSelectArticles(ARTS, title,'0');
	<?php }
	else{
	?>	
	document.getElementById('th_art').style.display='none';
	document.getElementById('th_art_meta').style.display='none';
	<?php }
	
	?>	
	
}
function edit_item()
{
   <?php if($items_id) {?>
	var ITEMS =[<?php echo implode(',',$items_id);  ?>];
	var title =[<?php echo '"'.implode('","',$item_titles).'"';  ?>];
	
	
	jSelectItems(ITEMS, title,'0');
	<?php }
	else{
	?>
	
    document.getElementById('th_item').style.display='none';
	document.getElementById('th_item_meta').style.display='none';
    <?php }
	
	?>	
}
var next=0;
 function jSelectArticles(ARTS, title,nnn,auto_meta_title,auto_meta_type,auto_meta_url,auto_meta_image,auto_meta_site_name,auto_meta_description,auto_meta_admins) {
 if(nnn==null){
 nnn=1;
 }
	
		ARTS_ids =document.getElementById('articles').value;
		
		tbody = document.getElementById('meta');
		tbody1 = document.getElementById('only_titles');
		
		var meta_title=[<?php for($j=0;$j<count($meta_title);$j++) echo "'".$meta_title[$j].'\','?>];
		var meta_type =[<?php for($j=0;$j<count($meta_type);$j++) echo "'".$meta_type[$j].'\','?>];
		var meta_url=[<?php for($j=0;$j<count($meta_url);$j++) echo "'".$meta_url[$j].'\','?>];
		var meta_image =[<?php for($j=0;$j<count($meta_image);$j++) echo "'".$meta_image[$j].'\','?>];
		var meta_site_name=[<?php for($j=0;$j<count($meta_site_name);$j++) echo "'".$meta_site_name[$j].'\','?>];
		var meta_description=[<?php for($j=0;$j<count($meta_description);$j++) echo "'".$meta_description[$j].'\','?>];
		var meta_admins=[<?php for($j=0;$j<count($meta_admins);$j++) echo "'".$meta_admins[$j].'\','?>];
		
		if(nnn==1){
		
				meta_type='';
				}
		var  str;
		str=document.getElementById('articles').value;
		
		for(i=0; i<ARTS.length; i++)
		{
       var  var_serch="***"+ARTS[i]+'***';
	   
	   if(typeof auto_meta_title == 'undefined')
	   		auto_meta_title =[];
	   if(typeof auto_meta_type == 'undefined')
	   		auto_meta_type =[];
	   if(typeof auto_meta_url == 'undefined')
	   		auto_meta_url =[];
	   if(typeof auto_meta_image == 'undefined')
	   		auto_meta_image =[];
	   if(typeof auto_meta_site_name == 'undefined')
	   		auto_meta_site_name =[];
	   if(typeof auto_meta_description == 'undefined')
	   		auto_meta_description =[];
	   if(typeof auto_meta_admins == 'undefined')
	  	 	auto_meta_admins =[];
	   
	   
		if((typeof auto_meta_title[i]) == 'undefined')
		auto_meta_title[i]='';
		if((typeof auto_meta_type[i]) == 'undefined')
		auto_meta_type[i]='';
		if((typeof auto_meta_url[i]) == 'undefined')
		auto_meta_url[i]='';
		if((typeof auto_meta_image[i]) == 'undefined')
		auto_meta_image[i]='';
		if((typeof auto_meta_site_name[i]) == 'undefined')
		auto_meta_site_name[i]='';
		if((typeof auto_meta_description[i]) == 'undefined')
		auto_meta_description[i]='';
		if((typeof auto_meta_admins[i]) == 'undefined')
		auto_meta_admins[i]='';
		
		if((!str)||str.indexOf(var_serch)==(-1)){
		     
			 
			 tr1 = document.createElement('tr');
				tr1.setAttribute('plug_id', ARTS[i]);
				tr1.setAttribute('id', 't'+next);
				
			
			var td_info1 = document.createElement('td');
				td_info1.setAttribute('id','info1_'+next);
			
			
			b1 = document.createElement('b');
			b1.innerHTML = title[i];
		    td_info1.appendChild(b1);
		    
			var img1_X = document.createElement("img");
					img1_X.setAttribute("src", "<?php echo $spider_video_player_url; ?>/images/delete_el.png");
					img1_X.style.cssText = "cursor:pointer; margin-left:30px";
					img1_X.setAttribute("onclick", 'remove_row("'+next+'")');
					
			var td1_X = document.createElement("td");
					td1_X.setAttribute("id", "X1_"+next);
					td1_X.setAttribute("valign", "middle");
					td1_X.style.width='50px';
					td1_X.appendChild(img1_X);
		
		    tr1.appendChild(td_info1);
			tr1.appendChild(td1_X);
			
			
			tbody1.appendChild(tr1);
			
			
			
			
			tr = document.createElement('tr');
				tr.setAttribute('plug_id', ARTS[i]);
				tr.setAttribute('id','m'+next);
				
			
			var td_info = document.createElement('td');
				td_info.setAttribute('id','info_'+next);
				td_info.style.width='12.5%';
			
			b = document.createElement('b');
			b.innerHTML = title[i];
		    td_info.appendChild(b);
			
			
			
			
			var inp_title=document.createElement("input");
			    inp_title.setAttribute("type","text");
				inp_title.style.width='100%';
				inp_title.setAttribute("id",ARTS[i]+'_title');
				if(nnn==1)
				meta_title[i]=auto_meta_title[i];
				if(meta_title[i])
				inp_title.setAttribute("value",meta_title[i]);
				else
				inp_title.setAttribute("value",'');
				
			var inp_type=document.createElement("select");
			    inp_type.setAttribute("id",ARTS[i]+'_type');
				inp_type.style.width='100%';
				
				op0=document.createElement("option");
				op0.setAttribute("value","Chose a type");
				op0.innerHTML='Chose a type';
				op1=document.createElement("option");
				op1.setAttribute("value","activity");
				op1.innerHTML='activity';
				op2=document.createElement("option");
				op2.setAttribute("value","actor");
				op2.innerHTML='actor';
				
				op3=document.createElement("option");
				op3.setAttribute("value","album");
				op3.innerHTML='album';
				op4=document.createElement("option");
				op4.setAttribute("value","article");
				op4.innerHTML='article';
				op5=document.createElement("option");
				op5.setAttribute("value","athlete");
				op5.innerHTML='athlete';
				
				op6=document.createElement("option");
				op6.setAttribute("value","author");
				op6.innerHTML='author';
				op7=document.createElement("option");
				op7.setAttribute("value","band");
				op7.innerHTML='band';
				op8=document.createElement("option");
				op8.setAttribute("value","bar");
				op8.innerHTML='bar';
				
				op9=document.createElement("option");
				op9.setAttribute("value","blog");
				op9.innerHTML='blog';
				op10=document.createElement("option");
				op10.setAttribute("value","book");
				op10.innerHTML='book';
				op11=document.createElement("option");
				op11.setAttribute("value","cafe");
				op11.innerHTML='cafe';
				
				op12=document.createElement("option");
				op12.setAttribute("value","cause");
				op12.innerHTML='cause';
				op13=document.createElement("option");
				op13.setAttribute("value","city");
				op13.innerHTML='city';
				op14=document.createElement("option");
				op14.setAttribute("value","company");
				op14.innerHTML='company';
				
				op15=document.createElement("option");
				op15.setAttribute("value","country");
				op15.innerHTML='country';
				op16=document.createElement("option");
				op16.setAttribute("value","director");
				op16.innerHTML='director';
				op17=document.createElement("option");
				op17.setAttribute("value","drink");
				op17.innerHTML='drink';
				
				op18=document.createElement("option");
				op18.setAttribute("value","food");
				op18.innerHTML='food';
				op19=document.createElement("option");
				op19.setAttribute("value","game");
				op19.innerHTML='game';
				op20=document.createElement("option");
				op20.setAttribute("value","government");
				op20.innerHTML='government';
				
				op21=document.createElement("option");
				op21.setAttribute("value","hotel");
				op21.innerHTML='hotel';
				op22=document.createElement("option");
				op22.setAttribute("value","landmark");
				op22.innerHTML='landmark';
				op23=document.createElement("option");
				op23.setAttribute("value","movie");
				op23.innerHTML='movie';
				
				op24=document.createElement("option");
				op24.setAttribute("value","musician");
				op24.innerHTML='musician';
				op25=document.createElement("option");
				op25.setAttribute("value","non_profit");
				op25.innerHTML='non_profit';
				op26=document.createElement("option");
				op26.setAttribute("value","politician");
				op26.innerHTML='politician';
				
				op27=document.createElement("option");
				op27.setAttribute("value","product");
				op27.innerHTML='product';
				op28=document.createElement("option");
				op28.setAttribute("value","public_figure");
				op28.innerHTML='public_figure';
				op29=document.createElement("option");
				op29.setAttribute("value","restaurant");
				op29.innerHTML='restaurant';
				
				op30=document.createElement("option");
				op30.setAttribute("value","school");
				op30.innerHTML='school';
				op31=document.createElement("option");
				op31.setAttribute("value","song");
				op31.innerHTML='song';
				op32=document.createElement("option");
				op32.setAttribute("value","sport");
				op32.innerHTML='sport';
				
				op33=document.createElement("option");
				op33.setAttribute("value","sports_league");
				op33.innerHTML='sports_league';
				op34=document.createElement("option");
				op34.setAttribute("value","sports_team");
				op34.innerHTML='sports_team';
				op35=document.createElement("option");
				op35.setAttribute("value","state_province");
				op35.innerHTML='state_province';
				
				op36=document.createElement("option");
				op36.setAttribute("value","tv_show");
				op36.innerHTML='tv_show';
				op37=document.createElement("option");
				op37.setAttribute("value","university");
				op37.innerHTML='university';
				op38=document.createElement("option");
				op38.setAttribute("value","website");
				op38.innerHTML='website';
				meta_type[i]='';
				if(nnn==1){
				 var meta_type         =[<?php for($j=0;$j<count($meta_type);$j++) echo "'".$meta_type[$j].'\','?>];
				 meta_type[i]=auto_meta_type[i];
				}
				else
				var meta_type         =[<?php for($j=0;$j<count($meta_type);$j++) echo "'".$meta_type[$j].'\','?>];						
				var op=[op0,op1,op2,op3,op4,op5,op6,op7,op8,op9,op10,op11,op12,op13,op14,op15,op16,op17,op18,op19,op20,op21,op22,op23,op24,op25,op26,op27,op28,op29,op30,op31,op32,op33,op34,op35,op36,op37,op38]
				for(var j=0;j<39;j++){
				inp_type.appendChild(op[j]);
		
				if(meta_type[i]==op[j].innerHTML)
				{
				
				op[j].setAttribute("selected","selected");
				}
				}
				
				
				
			var inp_url=document.createElement("input");
				inp_url.style.width='100%';
			    inp_url.setAttribute("type","text");
				inp_url.setAttribute("id",ARTS[i]+'_url');
				if(nnn==1)
				meta_url[i]=auto_meta_url[i];
				if(meta_url[i])
				inp_url.setAttribute("value",meta_url[i]);
				else
				inp_url.setAttribute("value",'');
				
			var inp_image=document.createElement("input");
				inp_image.style.width='100%';
			    inp_image.setAttribute("type","text");
				inp_image.setAttribute("id",ARTS[i]+'_image');
				if(nnn==1)
				meta_image[i]=auto_meta_image[i];
				if(meta_image[i])
				inp_image.setAttribute("value",meta_image[i]);
				else
				inp_image.setAttribute("value",'');
				
			var inp_site_name=document.createElement("input");
				inp_site_name.style.width='100%';
			    inp_site_name.setAttribute("type","text");
				inp_site_name.setAttribute("id",ARTS[i]+'_site_name');
				if(nnn==1)
				meta_site_name[i]=auto_meta_site_name[i];
				if(meta_site_name[i])
				inp_site_name.setAttribute("value",meta_site_name[i]);
				else
				inp_site_name.setAttribute("value",'');
				
			var inp_description=document.createElement("input");
				inp_description.style.width='100%';
			    inp_description.setAttribute("type","text");
				inp_description.setAttribute("id",ARTS[i]+'_description');
				if(nnn==1)
				meta_description[i]=auto_meta_description[i];
				if(meta_description[i])
				inp_description.setAttribute("value",meta_description[i]);
				else
				inp_description.setAttribute("value",'');
				
			var inp_admins=document.createElement("input");
				inp_admins.style.width='100%';
			    inp_admins.setAttribute("type","text");
				inp_admins.setAttribute("id",ARTS[i]+'_admins');
				if(nnn==1)
				meta_admins[i]=auto_meta_admins[i];
				if(meta_admins[i])
				inp_admins.setAttribute("value",meta_admins[i]);
				else
				inp_admins.setAttribute("value",'');	
				
				
				
			var td_title     = document.createElement('td');
				
				
			    td_title.setAttribute('style','text-align:center');
				td_title.style.width='12.5%';
			var td_type      = document.createElement('td');
				
			    td_type.setAttribute('style','text-align:center');
			   td_type.style.width='12.5%';
            var td_url       = document.createElement('td');
				
			    td_url.setAttribute('style','text-align:center');
			   td_url.style.width='12.5%';
            var td_image     = document.createElement('td');
				
			    td_image.setAttribute('style','text-align:center');
				td_image.style.width='12.5%';
            var td_site_name = document.createElement('td');
				
			    td_site_name.setAttribute('style','text-align:center');
			   td_site_name.style.width='12.5%';
			var td_description    = document.createElement('td');
				
			    td_description.setAttribute('style','text-align:center');
			   td_description.style.width='12.5%';
            var td_admins    = document.createElement('td');
				
			    td_admins.setAttribute('style','text-align:center');
				td_admins.style.width='12.5%';				
           // var td_app_id    = document.createElement('td');
			    //td_app_id.setAttribute('style','text-align:center');
			
			
			td_title.appendChild(inp_title); 
			td_type.appendChild(inp_type); 
			td_url.appendChild(inp_url); 
			td_image.appendChild(inp_image); 
			td_site_name.appendChild(inp_site_name);
            td_description.appendChild(inp_description);
            td_admins.appendChild(inp_admins); 			
			//td_app_id.appendChild(inp_app_id); 
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "<?php echo $spider_video_player_url; ?>/images/delete_el.png");
					img_X.style.cssText = "cursor:pointer; margin-left:30px";
					img_X.setAttribute("onclick", 'remove_row("'+next+'")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+next);
					td_X.setAttribute("valign", "middle");
					td_X.style.width='50px';
					td_X.appendChild(img_X);
					
		
				
			tr.appendChild(td_info);
			tr.appendChild(td_title);
			tr.appendChild(td_type);
			tr.appendChild(td_url);
			tr.appendChild(td_image);
			tr.appendChild(td_site_name);
			tr.appendChild(td_description);
			tr.appendChild(td_admins);
			//tr.appendChild(td_app_id);
		
			tr.appendChild(td_X);
			
			
			tbody.appendChild(tr);
			next++;
			}
			
			
		}
		
		
		tb_remove();
		refresh_();
	}
	
function remove_row(id)
{
	tr=document.getElementById('m'+id);
	tr.parentNode.removeChild(tr);
	tr1=document.getElementById('t'+id);
	tr1.parentNode.removeChild(tr1);
	
	refresh_();
}
function confirmation(title) {
		var answer = confirm("Are you sure you want to delete "+title+"?")
		if (answer){
			if(title=='articles')
			remove_all_art()
			if(title=='items')
			remove_all_item()
		}
	}
function remove_all_art(){
for(var i=0;i<1000;i++){
    tr=document.getElementById('m'+i);
	if(tr)
	tr.parentNode.removeChild(tr);
	tr1=document.getElementById('t'+i);
	if(tr1)
	tr1.parentNode.removeChild(tr1);
}
refresh_();
}
function refresh_()
{
	plugin_list=document.getElementById('meta');
	GLOBAL_tbody=plugin_list;
	tox='***';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
	if(tr.getAttribute('plug_id'))
		tox=tox+tr.getAttribute('plug_id')+'***';
	}
	document.getElementById('articles').value=tox;
	if(document.getElementById('articles').value=='***'){
	
	document.getElementById('th_art').style.display='none';
	document.getElementById('th_art_meta').style.display='none';
	}
	else{
	document.getElementById('th_art').style.display='';
	document.getElementById('th_art_meta').style.display='';
	}
	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////// I T E M S //////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var inext=0;
 function jSelectItems(ITEMS, title,nnn,auto_meta_title,auto_meta_type,auto_meta_url,auto_meta_image,auto_meta_site_name,auto_meta_description,auto_meta_admins) {
 
 if(nnn==null){
 nnn=1;
 }
	
		ITEMS_ids =document.getElementById('items').value;
		
		tbody = document.getElementById('item_meta');
		tbody1 = document.getElementById('item_only_titles');
		
		var meta_title        =[<?php for($j=0;$j<count($item_meta_title);$j++) echo "'".$item_meta_title[$j].'\','?>];
		var meta_type         =[<?php for($j=0;$j<count($item_meta_type);$j++) echo "'".$item_meta_type[$j].'\','?>];
		var meta_url          =[<?php for($j=0;$j<count($item_meta_url);$j++) echo "'".$item_meta_url[$j].'\','?>];
		var meta_image        =[<?php for($j=0;$j<count($item_meta_image);$j++) echo "'".$item_meta_image[$j].'\','?>];
		var meta_site_name    =[<?php for($j=0;$j<count($item_meta_site_name);$j++) echo "'".$item_meta_site_name[$j].'\','?>];
		var meta_description  =[<?php for($j=0;$j<count($item_meta_description);$j++) echo "'".$item_meta_description[$j].'\','?>];
		var meta_admins       =[<?php for($j=0;$j<count($item_meta_admins);$j++) echo "'".$item_meta_admins[$j].'\','; ?>];
		
		if(nnn==1){
		
				meta_type='';
				}
		var  str;
		str=document.getElementById('items').value;
		
		for(i=0; i<ITEMS.length; i++)
		{
       var  var_serch="***"+ITEMS[i];
		
		
		
		  if(typeof auto_meta_title == 'undefined')
	   		auto_meta_title =[];
	   if(typeof auto_meta_type == 'undefined')
	   		auto_meta_type =[];
	   if(typeof auto_meta_url == 'undefined')
	   		auto_meta_url =[];
	   if(typeof auto_meta_image == 'undefined')
	   		auto_meta_image =[];
	   if(typeof auto_meta_site_name == 'undefined')
	   		auto_meta_site_name =[];
	   if(typeof auto_meta_description == 'undefined')
	   		auto_meta_description =[];
	   if(typeof auto_meta_admins == 'undefined')
	  	 	auto_meta_admins =[];
	   
	   
		if((typeof auto_meta_title[i]) == 'undefined')
		auto_meta_title[i]='';
		if((typeof auto_meta_type[i]) == 'undefined')
		auto_meta_type[i]='';
		if((typeof auto_meta_url[i]) == 'undefined')
		auto_meta_url[i]='';
		if((typeof auto_meta_image[i]) == 'undefined')
		auto_meta_image[i]='';
		if((typeof auto_meta_site_name[i]) == 'undefined')
		auto_meta_site_name[i]='';
		if((typeof auto_meta_description[i]) == 'undefined')
		auto_meta_description[i]='';
		if((typeof auto_meta_admins[i]) == 'undefined')
		auto_meta_admins[i]='';
		
		
		
		
		if((!str)||str.indexOf(var_serch)==(-1)){
		     
			 
			    tr1 = document.createElement('tr');
				tr1.setAttribute('item_id', ITEMS[i]);
				tr1.setAttribute('id', 'it'+inext);
				
			
			var td_info1 = document.createElement('td');
				td_info1.style.width='12.5%';
			
			
			b1 = document.createElement('b');
			b1.innerHTML = title[i];
		    td_info1.appendChild(b1);
		    
			var img1_X = document.createElement("img");
					img1_X.setAttribute("src", "<?php echo $spider_video_player_url; ?>/images/delete_el.png");
					img1_X.style.cssText = "cursor:pointer; margin-left:30px";
					img1_X.setAttribute("onclick", 'item_remove_row("'+inext+'")');
					
			var td1_X = document.createElement("td");
					
					td1_X.setAttribute("valign", "middle");
					td1_X.style.width='50px';
					td1_X.appendChild(img1_X);
		
		    tr1.appendChild(td_info1);
			tr1.appendChild(td1_X);
			
			
			tbody1.appendChild(tr1);
			
			
			
			
			tr = document.createElement('tr');
				tr.setAttribute('item_id', ITEMS[i]);
				tr.setAttribute('id','im'+inext);
				
			
			var td_info = document.createElement('td');
				
			
			
			b = document.createElement('b');
			b.innerHTML = title[i];
		    td_info.appendChild(b);
			
			
			
			
			var inp_title=document.createElement("input");
			    inp_title.setAttribute("type","text");
				inp_title.style.width='100%';
				inp_title.setAttribute("id",ITEMS[i]+'_item_title');
				if(nnn==1)
				meta_title[i]=auto_meta_title[i];
				if(meta_title[i])
				inp_title.setAttribute("value",meta_title[i]);
				else
				inp_title.setAttribute("value",'');
				
			var inp_type=document.createElement("select");
			    
				inp_type.setAttribute("id",ITEMS[i]+'_item_type');
				inp_type.style.width='100%';
			   
				op0=document.createElement("option");
				op0.setAttribute("value","Chose a type");
				op0.innerHTML='Chose a type';
				op1=document.createElement("option");
				op1.setAttribute("value","activity");
				op1.innerHTML='activity';
				op2=document.createElement("option");
				op2.setAttribute("value","actor");
				op2.innerHTML='actor';
				
				op3=document.createElement("option");
				op3.setAttribute("value","album");
				op3.innerHTML='album';
				op4=document.createElement("option");
				op4.setAttribute("value","article");
				op4.innerHTML='article';
				op5=document.createElement("option");
				op5.setAttribute("value","athlete");
				op5.innerHTML='athlete';
				
				op6=document.createElement("option");
				op6.setAttribute("value","author");
				op6.innerHTML='author';
				op7=document.createElement("option");
				op7.setAttribute("value","band");
				op7.innerHTML='band';
				op8=document.createElement("option");
				op8.setAttribute("value","bar");
				op8.innerHTML='bar';
				
				op9=document.createElement("option");
				op9.setAttribute("value","blog");
				op9.innerHTML='blog';
				op10=document.createElement("option");
				op10.setAttribute("value","book");
				op10.innerHTML='book';
				op11=document.createElement("option");
				op11.setAttribute("value","cafe");
				op11.innerHTML='cafe';
				
				op12=document.createElement("option");
				op12.setAttribute("value","cause");
				op12.innerHTML='cause';
				op13=document.createElement("option");
				op13.setAttribute("value","city");
				op13.innerHTML='city';
				op14=document.createElement("option");
				op14.setAttribute("value","company");
				op14.innerHTML='company';
				
				op15=document.createElement("option");
				op15.setAttribute("value","country");
				op15.innerHTML='country';
				op16=document.createElement("option");
				op16.setAttribute("value","director");
				op16.innerHTML='director';
				op17=document.createElement("option");
				op17.setAttribute("value","drink");
				op17.innerHTML='drink';
				
				op18=document.createElement("option");
				op18.setAttribute("value","food");
				op18.innerHTML='food';
				op19=document.createElement("option");
				op19.setAttribute("value","game");
				op19.innerHTML='game';
				op20=document.createElement("option");
				op20.setAttribute("value","government");
				op20.innerHTML='government';
				
				op21=document.createElement("option");
				op21.setAttribute("value","hotel");
				op21.innerHTML='hotel';
				op22=document.createElement("option");
				op22.setAttribute("value","landmark");
				op22.innerHTML='landmark';
				op23=document.createElement("option");
				op23.setAttribute("value","movie");
				op23.innerHTML='movie';
				
				op24=document.createElement("option");
				op24.setAttribute("value","musician");
				op24.innerHTML='musician';
				op25=document.createElement("option");
				op25.setAttribute("value","non_profit");
				op25.innerHTML='non_profit';
				op26=document.createElement("option");
				op26.setAttribute("value","politician");
				op26.innerHTML='politician';
				
				op27=document.createElement("option");
				op27.setAttribute("value","product");
				op27.innerHTML='product';
				op28=document.createElement("option");
				op28.setAttribute("value","public_figure");
				op28.innerHTML='public_figure';
				op29=document.createElement("option");
				op29.setAttribute("value","restaurant");
				op29.innerHTML='restaurant';
				
				op30=document.createElement("option");
				op30.setAttribute("value","school");
				op30.innerHTML='school';
				op31=document.createElement("option");
				op31.setAttribute("value","song");
				op31.innerHTML='song';
				op32=document.createElement("option");
				op32.setAttribute("value","sport");
				op32.innerHTML='sport';
				
				op33=document.createElement("option");
				op33.setAttribute("value","sports_league");
				op33.innerHTML='sports_league';
				op34=document.createElement("option");
				op34.setAttribute("value","sports_team");
				op34.innerHTML='sports_team';
				op35=document.createElement("option");
				op35.setAttribute("value","state_province");
				op35.innerHTML='state_province';
				
				op36=document.createElement("option");
				op36.setAttribute("value","tv_show");
				op36.innerHTML='tv_show';
				op37=document.createElement("option");
				op37.setAttribute("value","university");
				op37.innerHTML='university';
				op38=document.createElement("option");
				op38.setAttribute("value","website");
				op38.innerHTML='website';
				if(nnn==1){
				 var meta_type         =[<?php for($j=0;$j<count($item_meta_type);$j++) echo "'".$item_meta_type[$j].'\','?>];
				 meta_type[i]=auto_meta_type[i];
				}
							
				var op=[op0,op1,op2,op3,op4,op5,op6,op7,op8,op9,op10,op11,op12,op13,op14,op15,op16,op17,op18,op19,op20,op21,op22,op23,op24,op25,op26,op27,op28,op29,op30,op31,op32,op33,op34,op35,op36,op37,op38]
				for(var j=0;j<39;j++){
				inp_type.appendChild(op[j]);
				if(meta_type[i]==op[j].innerHTML)
				{
				
				op[j].setAttribute("selected","selected");
				}
				}
				
				
			var inp_url=document.createElement("input");
			    inp_url.setAttribute("type","text");
				inp_url.setAttribute("id",ITEMS[i]+'_item_url');
				inp_url.style.width='100%';
				if(nnn==1)
				meta_url[i]=auto_meta_url[i];
				if(meta_url[i])
				inp_url.setAttribute("value",meta_url[i]);
				else
				inp_url.setAttribute("value",'');
				
			var inp_image=document.createElement("input");
			    inp_image.setAttribute("type","text");
				inp_image.setAttribute("id",ITEMS[i]+'_item_image');
				inp_image.style.width='100%';
				if(nnn==1)
				meta_image[i]=auto_meta_image[i];
				if(meta_image[i])
				inp_image.setAttribute("value",meta_image[i]);
				else
				inp_image.setAttribute("value",'');
				
			var inp_site_name=document.createElement("input");
			    inp_site_name.setAttribute("type","text");
				inp_site_name.setAttribute("id",ITEMS[i]+'_item_site_name');
				inp_site_name.style.width='100%';
				if(nnn==1)
				meta_site_name[i]=auto_meta_site_name[i];
				if(meta_site_name[i])
				inp_site_name.setAttribute("value",meta_site_name[i]);
				else
				inp_site_name.setAttribute("value",'');
				
			var inp_description=document.createElement("input");
			    inp_description.setAttribute("type","text");
				inp_description.setAttribute("id",ITEMS[i]+'_item_description');
				inp_description.style.width='100%';
				if(nnn==1)
				meta_description[i]=auto_meta_description[i];
				if(meta_description[i])
				inp_description.setAttribute("value",meta_description[i]);
				else
				inp_description.setAttribute("value",'');	
				
			var inp_admins=document.createElement("input");
			    inp_admins.setAttribute("type","text");
				inp_admins.style.width='100%';
				inp_admins.setAttribute("id",ITEMS[i]+'_item_admins');
				if(nnn==1)
				meta_admins[i]=auto_meta_admins[i];
				if(meta_admins[i])
				inp_admins.setAttribute("value",meta_admins[i]);
				else
				inp_admins.setAttribute("value",'');		
			
				
			var td_title     = document.createElement('td');
			    td_title.setAttribute('style','text-align:center');
				td_title.style.width='12.5%';
			var td_type      = document.createElement('td');
			    td_type.setAttribute('style','text-align:center');
				td_type.style.width='12.5%';
            var td_url       = document.createElement('td');
			    td_url.setAttribute('style','text-align:center');
				td_url.style.width='12.5%';
            var td_image     = document.createElement('td');
			    td_image.setAttribute('style','text-align:center');
				td_image.style.width='12.5%';
            var td_site_name = document.createElement('td');
			    td_site_name.setAttribute('style','text-align:center');
				td_site_name.style.width='12.5%';
			var td_description = document.createElement('td');
			    td_description.setAttribute('style','text-align:center');
				td_description.style.width='12.5%';
			var td_admins = document.createElement('td');
			    td_admins.setAttribute('style','text-align:center');
				td_admins.style.width='12.5%';	
            //var td_app_id    = document.createElement('td');
			    //td_app_id.setAttribute('style','text-align:center');
			
			
			td_title.appendChild(inp_title); 
			td_type.appendChild(inp_type); 
			td_url.appendChild(inp_url); 
			td_image.appendChild(inp_image); 
			td_site_name.appendChild(inp_site_name); 
			td_description.appendChild(inp_description); 
			td_admins.appendChild(inp_admins); 
			//td_app_id.appendChild(inp_app_id); 
			
			var img_X = document.createElement("img");
			img_X.setAttribute("src", "<?php echo $spider_video_player_url; ?>/images/delete_el.png");
			img_X.style.cssText = "cursor:pointer; margin-left:30px";
			img_X.setAttribute("onclick", 'item_remove_row("'+inext+'")');
					
			var td_X = document.createElement("td");					
			td_X.setAttribute("valign", "middle");
			td_X.style.width='50px';
			td_X.appendChild(img_X);
					
		
				
			tr.appendChild(td_info);
			tr.appendChild(td_title);
			tr.appendChild(td_type);
			tr.appendChild(td_url);
			tr.appendChild(td_image);
			tr.appendChild(td_site_name);
			tr.appendChild(td_description);
			tr.appendChild(td_admins);
			//tr.appendChild(td_app_id);
		
			tr.appendChild(td_X);
			
			
			tbody.appendChild(tr);
			inext++;
			}
     
			
			
		}
		
		document.getElementById('items').value=ITEMS_ids;
		tb_remove();
		item_refresh_();
	}
	
	
	
	
	
function item_remove_row(id)
{
	tr=document.getElementById('im'+id);
	tr.parentNode.removeChild(tr);
	tr1=document.getElementById('it'+id);
	tr1.parentNode.removeChild(tr1);
	
	item_refresh_();
}
function remove_all_item(){
for(var i=0;i<1000;i++){
    tr=document.getElementById('im'+i);
	if(tr)
	tr.parentNode.removeChild(tr);
	tr1=document.getElementById('it'+i);
	if(tr1)
	tr1.parentNode.removeChild(tr1);
}
item_refresh_();
}
function item_refresh_()
{
	item_list=document.getElementById('item_meta');
	GLOBAL_tbody=item_list;
	tox='***';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
	if(tr.getAttribute('item_id'))
		tox=tox+tr.getAttribute('item_id')+'***';
	}
	document.getElementById('items').value=tox;
	if(document.getElementById('items').value=='***'){
	document.getElementById('th_item').style.display='none';
	document.getElementById('th_item_meta').style.display='none';
	}
	else{
	document.getElementById('th_item').style.display='';
	document.getElementById('th_item_meta').style.display='';
	}
	
}
function change()
{
	switch(document.getElementById('type').value)
	{
case 'likebutton':
document.getElementById('likebutton').style.display='none';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
switch(document.getElementById('render').value)
		{
		case '1':
		case '2':
		
			
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='';
			document.getElementById('is_requerid_text_sp_facebook').style.display='none';
			document.getElementById('url_type').style.display='';
			if(document.getElementById('url_change').value=='normal'){
			document.getElementById('url_tr').style.display='';
			}
			else
			{document.getElementById('url_tr').style.display='none';
			}
			
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='';
			document.getElementById('send').style.display='';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='none';	
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
				
			document.getElementById('share_type').style.display='none';
		    document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='';
			document.getElementById('art_table').style.display='none';
			document.getElementById('item_table_meta').style.display='';
			document.getElementById('item_table').style.display='none';
			if(!document.getElementById('all_arts').checked)
			document.getElementById('def_img_art_tr').style.display='';
			if(!document.getElementById('all_items').checked)
			document.getElementById('def_img_item_tr').style.display='';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
		break;
			case '3':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='';
			document.getElementById('is_requerid_text_sp_facebook').style.display='none';
			document.getElementById('url_type').style.display='';
			if(document.getElementById('url_change').value=='normal'){
			document.getElementById('url_tr').style.display='';
			}
			else
			{document.getElementById('url_tr').style.display='none';
			}
			
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';	
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='';
				
			document.getElementById('share_type').style.display='none';
		    document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='';
			document.getElementById('art_table').style.display='none';
			document.getElementById('item_table_meta').style.display='';
			document.getElementById('item_table').style.display='none';
			if(!document.getElementById('all_arts').checked)
			document.getElementById('def_img_art_tr').style.display='';
			if(!document.getElementById('all_items').checked)
			document.getElementById('def_img_item_tr').style.display='';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
		break;
			
			
			
			
			case '4':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='';
			if(document.getElementById('url_change').value=='normal'){
			document.getElementById('url_tr').style.display='';
			}
			else
			{document.getElementById('url_tr').style.display='none';
			}
			
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='none';	
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='none';
				
			document.getElementById('share_type').style.display='none';
		    document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='';
			document.getElementById('art_table').style.display='none';
			document.getElementById('item_table_meta').style.display='';
			document.getElementById('item_table').style.display='none';
			if(!document.getElementById('all_arts').checked)
			document.getElementById('def_img_art_tr').style.display='';
			if(!document.getElementById('all_items').checked)
			document.getElementById('def_img_item_tr').style.display='';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='';
			document.getElementById('req_m').style.display='none';
		break;
			}	
			document.getElementById('l_url').innerHTML='Url:';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			
			document.getElementById('notification').innerHTML='The Like button is a social plugin that lets users share pages from your site back to their Facebook profile with one click.';
		 break;
		 
		 
case 'sendbutton':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='none';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
			
switch(document.getElementById('render').value)
		{
		case '1':
		case '2':
		
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='';
			if(document.getElementById('url_change').value=='normal'){
			document.getElementById('url_tr').style.display='';
			}
			else
			{document.getElementById('url_tr').style.display='none';
			}
			
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='none';
			document.getElementById('r4').style.display='none';
			document.getElementById('width').style.display='none';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='none';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
			
					document.getElementById('bord').style.display='none';
			
			document.getElementById('share_type').style.display='none';
		    document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='';
			document.getElementById('art_table').style.display='none';
			document.getElementById('item_table_meta').style.display='';
			document.getElementById('item_table').style.display='none';
			if(!document.getElementById('all_arts').checked)
			document.getElementById('def_img_art_tr').style.display='';
			if(!document.getElementById('all_items').checked)
			document.getElementById('def_img_item_tr').style.display='';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
		  break;
		
			case '3':
			case '4':
			
			
			change_render('2');
			break;
			}
         document.getElementById('l_url').innerHTML='Url:';
		 document.getElementById('count_tr').style.display='none';
		document.getElementById('hor_place').style.display='none';
        document.getElementById('notification').innerHTML='The Send button is a social plugin that allows your users to easily send your content to their friends.';	 
		 break;
		  
case 'follow':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='none';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
	
		switch(document.getElementById('render').value)
		{
		case '1':
	
		case '2':
		
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_change').value='normal';
			document.getElementById('url_tr').style.display='';
			document.getElementById('n_url').checked=true;
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';	
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			
			document.getElementById('bord').style.display='none';
			
			document.getElementById('bord').style.display='none';
			
            document.getElementById('share_type').style.display='none';	
		    document.getElementById('request_type').style.display='none';	
            document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			break;
			
			case '3':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_change').value='normal';
			document.getElementById('url_tr').style.display='';
		    document.getElementById('n_url').checked=true;
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='';
			
            document.getElementById('share_type').style.display='none';	
		    document.getElementById('request_type').style.display='none';	
            document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			break;
			
			case '4':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_change').value='normal';
			document.getElementById('url_tr').style.display='';
			document.getElementById('n_url').checked=true;
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='none';
			
            document.getElementById('share_type').style.display='none';	
		    document.getElementById('request_type').style.display='none';	
            document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='';
			document.getElementById('req_m').style.display='none';
			break;
			} 
			document.getElementById('l_url').innerHTML='Facebook Profile Url:';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			
			document.getElementById('notification').innerHTML='The Follow button social plugin allows people to follow to other Facebook users directly from your site. ';
		  break;
case 'comment':
<?php if($row->id==""){
?>
document.getElementById('comment_pos_art').selected=true;
document.getElementById('comment_pos_item').selected=true;
<?php
}
?>
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='none';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
switch(document.getElementById('render').value)
		{
		case '1':
		case '2':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='';
			if(document.getElementById('url_change').value=='normal'){
			document.getElementById('url_tr').style.display='';
			}
			else
			{document.getElementById('url_tr').style.display='none';
			}
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='none';
			document.getElementById('r4').style.display='none';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='none';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
			
					document.getElementById('bord').style.display='none';
			
            document.getElementById('share_type').style.display='none';
		    document.getElementById('request_type').style.display='none'; 
            document.getElementById('twit').style.display='none'; 	
            document.getElementById('art_table').style.display='none';
			document.getElementById('art_table_meta').style.display='';
            document.getElementById('item_table').style.display='none';
			document.getElementById('item_table_meta').style.display='';	
            document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
            document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
		 break;
		    case '3':
			case '4':
			change_render('2');
			break;
			}	
			document.getElementById('l_url').innerHTML='Url:';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			document.getElementById('notification').innerHTML='The Comments social plugin lets users comment on any piece of content on your site.';
		 break;
		 
		 
case 'actfeed':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='none';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
switch(document.getElementById('render').value)
		{
		case '1':
		case '2':
		
			document.getElementById('domain').style.display='';
			document.getElementById('appid').style.display='';
			document.getElementById('is_requerid_text_sp_facebook').style.display='';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_tr').style.display='none';
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='none';
			document.getElementById('r4').style.display='none';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='';
			document.getElementById('target').style.display='';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='';
			document.getElementById('action').style.display='';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
            document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
			
			document.getElementById('bord').style.display='none';
			
            document.getElementById('share_type').style.display='none'; 
		    document.getElementById('request_type').style.display='none'; 
            document.getElementById('twit').style.display='none';  
            document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
            document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';	
            document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
          break;
            case '3':
			case '4':
			change_render('2');
			break;
			}	
			document.getElementById('l_url').innerHTML='Facebook Page Url:';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			
			document.getElementById('notification').innerHTML='The Activity Feed social plugin shows users what their friends are doing on your site through likes and comments.';
		 break;		  
		  
case 'recommendation':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='none';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
switch(document.getElementById('render').value)
		{
		case '1':
		case '2':
		
		
			document.getElementById('domain').style.display='';
			document.getElementById('appid').style.display='';
			document.getElementById('is_requerid_text_sp_facebook').style.display='';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_tr').style.display='none';
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='none';
			document.getElementById('r4').style.display='none';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='';
			document.getElementById('target').style.display='';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
			
			document.getElementById('bord').style.display='none';
			
            document.getElementById('share_type').style.display='none';
		    document.getElementById('request_type').style.display='none';
            document.getElementById('twit').style.display='none';
            document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
            document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
            document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
		  break;
		    case '3':
			case '4':
			change_render('2');
			break;
			}	
			document.getElementById('l_url').innerHTML='Facebook Page Url:';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			
			
			document.getElementById('notification').innerHTML='The Recommendations social plugin gives users personalized suggestions for pages on your site they might like.';
		 break;		  
		  
case 'likebox':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='none';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
          switch(document.getElementById('render').value)
		  {
            case '1':
            case '2':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_change').value='normal';
			document.getElementById('url_tr').style.display='';
			document.getElementById('n_url').checked=true;
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='';
			document.getElementById('stream').style.display='';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
			
			document.getElementById('bord').style.display='none';
			
            document.getElementById('share_type').style.display='none';		
            document.getElementById('request_type').style.display='none';			
		    document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			break;
			case '3':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_change').value='normal';
			document.getElementById('url_tr').style.display='';
			document.getElementById('n_url').checked=true;
			document.getElementById('render').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='';
			document.getElementById('stream').style.display='';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='';
			
            document.getElementById('share_type').style.display='none';		
            document.getElementById('request_type').style.display='none';			
		    document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			break;
			
			
			case '4':
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_change').value='normal';
			document.getElementById('url_tr').style.display='';
			document.getElementById('n_url').checked=true;
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='';
			document.getElementById('target').style.display='';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='';
			document.getElementById('stream').style.display='';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='none';
			
            document.getElementById('share_type').style.display='none';		
            document.getElementById('request_type').style.display='none';			
		    document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='';
			document.getElementById('req_m').style.display='none';
			break;
			
			
			}
			document.getElementById('l_url').innerHTML='Facebook Page Url:';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
		
			document.getElementById('notification').innerHTML='The Like Box social plugin enables users to like your Facebook Page and view its stream directly from your website.';
		 break;
case 'loginbutton':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='none';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
switch(document.getElementById('render').value)
		{
		case '1':
		case '2':
		
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='';
			document.getElementById('is_requerid_text_sp_facebook').style.display='';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_tr').style.display='none';
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='none';
			document.getElementById('r4').style.display='none';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='none';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='none';
					
			
			document.getElementById('share_type').style.display='none';
			document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			
		  break;
		    case '3':
			case '4':
			change_render('2');
			break;
			}
           document.getElementById('l_url').innerHTML='Facebook Page Url:';	
           document.getElementById('count_tr').style.display='none';
		   document.getElementById('hor_place').style.display='none';		   
		   
		   document.getElementById('notification').innerHTML="The Login Button social plugin shows profile pictures of the user's friends who have already signed up for your site in addition to a login button.";
		 break;		 
		  
case 'facepile':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='none';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
switch(document.getElementById('render').value)
		  {
            case '1':
            case '2':
		    document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_tr').style.display='';
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='';
			document.getElementById('size').style.display='';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='';
			document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
			
			document.getElementById('bord').style.display='none';
			
			document.getElementById('share_type').style.display='none';
			document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			break;
			case '3':
            
		    document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
		    document.getElementById('url_tr').style.display='';
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='';
			document.getElementById('size').style.display='';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='';
			
			document.getElementById('share_type').style.display='none';
			document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			break;
			case '4':
            
		    document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_tr').style.display='';
			document.getElementById('render_tr').style.display='';
			document.getElementById('r3').style.display='';
			document.getElementById('r4').style.display='';
			document.getElementById('width').style.display='';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='';
			document.getElementById('rows').style.display='';
			document.getElementById('size').style.display='';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='';
			document.getElementById('colorsc').style.display='';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			document.getElementById('bord').style.display='none';
			
			document.getElementById('share_type').style.display='none';
			document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='';
			document.getElementById('req_m').style.display='none';
			break;
			
			
			}
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			document.getElementById('l_url').innerHTML='Facebook Page Url:';
			
			document.getElementById('notification').innerHTML="The Facepile social plugin displays the Facebook profile pictures of users who have liked your page or have signed up for your site.";
			
		  break;
case 'share':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='none';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='none';
			document.getElementById('url_type').style.display='';
			if(document.getElementById('url_change').value=='normal'){
			document.getElementById('url_tr').style.display='';
			}
			else
			{document.getElementById('url_tr').style.display='none';
			}
			document.getElementById('render_tr').style.display='none';
			document.getElementById('width').style.display='none';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='none';
			document.getElementById('colorsc').style.display='none';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			
			   document.getElementById('bord').style.display='none';
			
			document.getElementById('share_type').style.display='';
			document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			document.getElementById('l_url').innerHTML='Url:';
			document.getElementById('note').style.display='';
			document.getElementById('notification').innerHTML="Facebook has replaced the Share Button with the Like Button. However, here the Share button provides additional functionality and, therefore, might be useful.";
			
			document.getElementById('css').style.display='';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
		
		    break;
case 'request':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='none';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='none';
			
			
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='';
			document.getElementById('is_requerid_text_sp_facebook').style.display='';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_tr').style.display='none';
			document.getElementById('render_tr').style.display='none';
			document.getElementById('width').style.display='none';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='none';
			document.getElementById('colorsc').style.display='none';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			   document.getElementById('bord').style.display='none';
			
			document.getElementById('share_type').style.display='none';
			document.getElementById('request_type').style.display='';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='';
			document.getElementById('l_url').innerHTML='Facebook Page Url:';
			document.getElementById('css').style.display='';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			
				
			document.getElementById('notification').innerHTML="The Request Dialog sends a Request from one user (the sender) to one or more users (the recipients).</br>The Request Dialog can be used to send a Request directly from one user to another or display a Multi Friend Selector Dialog, allowing the sending user to select multiple recipient users.";
			
				    break;
case 'register':
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='none';
document.getElementById('socials').style.display='';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='';
			document.getElementById('social_prev').style.display='none';
			
			
			document.getElementById('domain').style.display='';
			document.getElementById('appid').style.display='';
			document.getElementById('is_requerid_text_sp_facebook').style.display='';
			document.getElementById('url_type').style.display='none';
			document.getElementById('url_tr').style.display='none';
			document.getElementById('render_tr').style.display='none';
			document.getElementById('width').style.display='none';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='none';
			document.getElementById('colorsc').style.display='none';
			document.getElementById('font').style.display='none';
			document.getElementById('lang').style.display='none';
			document.getElementById('lang_type').style.display='none';
			   document.getElementById('bord').style.display='none';
			
			document.getElementById('share_type').style.display='none';
			document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='none';
			document.getElementById('art_table').style.display='';
			document.getElementById('item_table_meta').style.display='none';
			document.getElementById('item_table').style.display='';
			document.getElementById('def_img_art_tr').style.display='none';
			document.getElementById('def_img_item_tr').style.display='none';
			document.getElementById('reg_red').style.display='';
			document.getElementById('log_red').style.display='';
			document.getElementById('reg_type').style.display='';
			document.getElementById('fb_only').style.display='';
			document.getElementById('fb_only').style.display='';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			document.getElementById('l_url').innerHTML='URL:';
			
			document.getElementById('css').style.display='';
			document.getElementById('count_tr').style.display='none';
			document.getElementById('hor_place').style.display='none';
			
			document.getElementById('notification').innerHTML="The registration social plugin allows users to easily sign up for your website with their Facebook account.";
			
				    break;
					
					
case 'socials':	
document.getElementById('likebutton').style.display='';
document.getElementById('sendbutton').style.display='';
document.getElementById('follow').style.display='';
document.getElementById('comment').style.display='';
document.getElementById('actfeed').style.display='';
document.getElementById('recommendation').style.display='';
document.getElementById('likebox').style.display='';
document.getElementById('loginbutton').style.display='';
document.getElementById('facepile').style.display='';
document.getElementById('share').style.display='';
document.getElementById('request').style.display='';
document.getElementById('register').style.display='';
document.getElementById('socials').style.display='none';
document.getElementById('likebutton_hover').style.display='none';
document.getElementById('sendbutton_hover').style.display='none';
document.getElementById('follow_hover').style.display='none';
document.getElementById('comment_hover').style.display='none';
document.getElementById('actfeed_hover').style.display='none';
document.getElementById('recommendation_hover').style.display='none';
document.getElementById('likebox_hover').style.display='none';
document.getElementById('facepile_hover').style.display='none';
document.getElementById('share_hover').style.display='none';
document.getElementById('request_hover').style.display='none';
            document.getElementById('likebutton_prev').style.display='none';
			document.getElementById('sendbutton_prev').style.display='none';
			document.getElementById('comment_prev').style.display='none';
			document.getElementById('like_box_prev').style.display='none';
			document.getElementById('follow_prev').style.display='none';
			document.getElementById('request_prev').style.display='none';
			document.getElementById('recommendation_prev').style.display='none';
			document.getElementById('activity_feed_prev').style.display='none';
			document.getElementById('facepile_prev').style.display='none';
			document.getElementById('share_prev').style.display='none';
			document.getElementById('login_prev').style.display='none';
			document.getElementById('register_prev').style.display='none';
			document.getElementById('social_prev').style.display='';
			
			
			document.getElementById('domain').style.display='none';
			document.getElementById('appid').style.display='';
			document.getElementById('url_type').style.display='';
			if(document.getElementById('url_change').value=='normal'){
			document.getElementById('url_tr').style.display='';
			}
			else
			{document.getElementById('url_tr').style.display='none';
			}
			
			document.getElementById('render_tr').style.display='none';
			document.getElementById('r3').style.display='none';
			document.getElementById('r4').style.display='none';
			document.getElementById('width').style.display='none';
			document.getElementById('height').style.display='none';
			document.getElementById('target').style.display='none';
			document.getElementById('rows').style.display='none';
			document.getElementById('size').style.display='none';
			document.getElementById('post').style.display='none';
			document.getElementById('head').style.display='none';
			document.getElementById('stream').style.display='none';
			document.getElementById('recom').style.display='none';
			document.getElementById('action').style.display='none';
			document.getElementById('send').style.display='none';
			document.getElementById('face').style.display='none';
			document.getElementById('layout').style.display='none';
			document.getElementById('backg').style.display='none';
			document.getElementById('border').style.display='none';	
			document.getElementById('colorsc').style.display='none';
			document.getElementById('font').style.display='none';
			document.getElementById('lang_type').style.display='';
			if(document.getElementById('lang_change').value=='normal'){
			document.getElementById('lang').style.display='';
			}
			else
			{document.getElementById('lang').style.display='none';
			}
			
			document.getElementById('bord').style.display='none';
				
			document.getElementById('share_type').style.display='none';
		    document.getElementById('request_type').style.display='none';
			document.getElementById('twit').style.display='none';
			document.getElementById('art_table_meta').style.display='';
			document.getElementById('art_table').style.display='none';
			document.getElementById('item_table_meta').style.display='';
			document.getElementById('item_table').style.display='none';
			if(!document.getElementById('all_arts').checked)
			document.getElementById('def_img_art_tr').style.display='';
			if(!document.getElementById('all_items').checked)
			document.getElementById('def_img_item_tr').style.display='';
			document.getElementById('reg_red').style.display='none';
			document.getElementById('log_red').style.display='none';
			document.getElementById('reg_type').style.display='none';
			document.getElementById('fb_only').style.display='none';
			document.getElementById('url_value').style.display='none';
			document.getElementById('req_m').style.display='none';
			document.getElementById('css').style.display='';
			
			document.getElementById('count_tr').style.display='';
			document.getElementById('hor_place').style.display='';
			
			
			
			document.getElementById('notification').innerHTML='A set of social widgets for LinkedIn, Twitter, Google, and Facebook.';
		break;
			
						
					
			}
			}
			
function change_type(type)
{
document.getElementById('type').value=type;
change();
}			
function change_render(render)
{
document.getElementById('render').value=render;
switch(render){
  case '2':
      document.getElementById('xfbml').style.display='none';
      document.getElementById('html5').style.display='';
      document.getElementById('iframe').style.display='';
      document.getElementById('url').style.display='';
	  
	  document.getElementById('xfbml_hover').style.display='';
      document.getElementById('html5_hover').style.display='none';
      document.getElementById('iframe_hover').style.display='none';
      document.getElementById('url_hover').style.display='none';
      break;
case '1':
      document.getElementById('xfbml').style.display='';
      document.getElementById('html5').style.display='none';
      document.getElementById('iframe').style.display='';
      document.getElementById('url').style.display='';
	  
	  document.getElementById('xfbml_hover').style.display='none';
      document.getElementById('html5_hover').style.display='';
      document.getElementById('iframe_hover').style.display='none';
      document.getElementById('url_hover').style.display='none';
      break;
case '3':
      document.getElementById('xfbml').style.display='';
      document.getElementById('html5').style.display='';
      document.getElementById('iframe').style.display='none';
      document.getElementById('url').style.display='';
	  
	  document.getElementById('xfbml_hover').style.display='none';
      document.getElementById('html5_hover').style.display='none';
      document.getElementById('iframe_hover').style.display='';
      document.getElementById('url_hover').style.display='none';
      break;
case '4':
      document.getElementById('xfbml').style.display='';
      document.getElementById('html5').style.display='';
      document.getElementById('iframe').style.display='';
      document.getElementById('url').style.display='none';
	  
	  document.getElementById('xfbml_hover').style.display='none';
      document.getElementById('html5_hover').style.display='none';
      document.getElementById('iframe_hover').style.display='none';
      document.getElementById('url_hover').style.display='';
      break;
}
change();
}
			
			
			
function change_url(url){
		
			
				document.getElementById('url_change').value=url;
				
				change();
	
		 
		
		 
		  
	}	
			
function change_lang(lang){
		
			
				document.getElementById('lang_change').value=lang;
				
				change();
	
		 
		
		 
		  
	}	
		
var thickDims, tbWidth, tbHeight;
jQuery(document).ready(function($) {
        thickDims = function() {
                var tbWindow = $('#TB_window'), H = $(window).height(), W = $(window).width(), w, h;
                w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 200;
                h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 200;
                if ( tbWindow.size() ) {
                        tbWindow.width(w).height(h);
                        $('#TB_iframeContent').width(w).height(h - 27);
                        tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
                        if ( typeof document.body.style.maxWidth != 'undefined' )
                                tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
                }
        };
        thickDims();
        $(window).resize( function() { thickDims() } );
        $('a.thickbox-preview1').click( function() {
                tb_click.call(this);
                var alink = $(this).parents('.available-theme').find('.activatelink'), link = '', href = $(this).attr('href'), url, text;
                if ( tbWidth = href.match(/&tbWidth=[0-9]+/) )
                        tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbWidth = $(window).width() - 90;
                if ( tbHeight = href.match(/&tbHeight=[0-9]+/) )
                        tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbHeight = $(window).height() - 60;
                if ( alink.length ) {
                        url = alink.attr('href') || '';
                        text = alink.attr('title') || '';
                        link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
                } else {
                        text = $(this).attr('title') || '';
                        link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
                }
                $('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
                $('#TB_closeAjaxWindow').css({'float':'left'});
                $('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);
                $('#TB_iframeContent').width('100%');
                thickDims();
                return false;
        } );
        // Theme details
        $('.theme-detail').click(function () {
                $(this).siblings('.themedetaildiv').toggle();
                return false;
        });
});
jQuery(function() {
	var formfieldimage=null;
	var formfield=null;
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (formfield) {
			
			var fileurl = jQuery('img',html).attr('src');	
			if(!fileurl){
			var if_url_not_set;
			if_url_not_set="<a>"+html+"</a>"
			fileurl=jQuery('img',if_url_not_set).attr('src');
			}	
			formfield.val(fileurl);
			formfieldimage.attr('src',fileurl)
			formfieldimage.css('display','block');
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
		formfield=null;
	};
 
	jQuery('.lu_upload_button1').click(function() {
 		formfield = jQuery(this).parent().parent().find(".text_input");
		formfieldimage=jQuery(this).parent().parent().find(".image_for_media");
 		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		jQuery('#TB_overlay,#TB_closeWindowButton').bind("click",function(){formfield=null; formfieldimage=null;});
		return false;
	});
	jQuery(document).keyup(function(e) {
  		if (e.keyCode == 27) formfield=null;
	});
});
</script>
<table width="90%">
    <tbody>
	<tr>  
    <td colspan="11"><div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
		<a href=" http://web-dorado.com/products/wordpress-facebook.html" target="_blank" style="color:red; text-decoration:none;">
		<img src="<?php echo plugins_url( 'images/header.png' , __FILE__ ); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
		Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
		</a>
	</td></tr>
	<tr>
  <td width="100%"><h2><?php if($edit_or_add) echo "Edit Facebook - ".htmlspecialchars($row->title); else echo "Adding New Facebook" ?></h2></td>
  <td align="right"><input type="button" onclick="submitbutton('Save')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submitbutton('Apply')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Spider_Facebook_manage'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
<div style="text-align:center">
     <span class="type_span" onclick="change_type('likebutton')" >
	       <img id="likebutton" src="<?php echo $spider_video_player_url; ?>/images/like.png" />
		   <img id="likebutton_hover" src="<?php echo $spider_video_player_url; ?>/images/like_hover.png" />
           </span>
     
	 <span class="type_span" onclick="change_type('sendbutton')">
	       <img id="sendbutton" src="<?php echo $spider_video_player_url; ?>/images/send.png" />
		   <img id="sendbutton_hover" src="<?php echo $spider_video_player_url; ?>/images/send_hover.png" />
           </span>
      
	 <span class="type_span" onclick="change_type('comment')" >
	      <img id="comment" src="<?php echo $spider_video_player_url; ?>/images/comment.png" />
		  <img id="comment_hover" src="<?php echo $spider_video_player_url; ?>/images/comment_hover.png" />
          </span>
		  
     <span class="type_span" onclick="change_type('likebox')" >
	      <img id="likebox" src="<?php echo $spider_video_player_url; ?>/images/like_box.png" />
		  <img id="likebox_hover" src="<?php echo $spider_video_player_url; ?>/images/like_box_hover.png" />
          </span>
  
     <span class="type_span" onclick="change_type('follow')" >
	       <img id="follow" src="<?php echo $spider_video_player_url; ?>/images/follow.png" />
		   <img id="follow_hover" src="<?php echo $spider_video_player_url; ?>/images/follow_hover.png" />
            </span>
			
     <span class="type_span" onclick="change_type('request')" >
	      <img id="request" src="<?php echo $spider_video_player_url; ?>/images/request.png" />
		  <img id="request_hover" src="<?php echo $spider_video_player_url; ?>/images/request_hover.png" />
          </span>
  
     <span class="type_span" onclick="change_type('recommendation')" >
	       <img id="recommendation" src="<?php echo $spider_video_player_url; ?>/images/recommendation.png" />
		   <img id="recommendation_hover" src="<?php echo $spider_video_player_url; ?>/images/recommendation_hover.png" />
            </span>
			
     <span class="type_span" onclick="change_type('actfeed')" >
	      <img id="actfeed" src="<?php echo $spider_video_player_url; ?>/images/activity_feed.png" />
		  <img id="actfeed_hover" src="<?php echo $spider_video_player_url; ?>/images/activity_feed_hover.png" />
          </span>
  
     <span class="type_span" onclick="change_type('facepile')" >
	      <img id="facepile" src="<?php echo $spider_video_player_url; ?>/images/facepile.png" />
		  <img id="facepile_hover" src="<?php echo $spider_video_player_url; ?>/images/facepile_hover.png" />
          </span>
		  
     <span class="type_span" onclick="change_type('share')" >
	      <img id="share" src="<?php echo $spider_video_player_url; ?>/images/share.png" />
		  <img id="share_hover" src="<?php echo $spider_video_player_url; ?>/images/share_hover.png" />
          </span>
  
     <span class="type_span" onclick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')"  >
	      <img id="loginbutton" src="<?php echo $spider_video_player_url; ?>/images/login_button.png" />
          </span>
		  
     <span class="type_span" onclick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" >
	      <img id="register" src="<?php echo $spider_video_player_url; ?>/images/register.png" />
          </span>
		  
	<span class="type_span" onclick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')"  >
	       <img id="socials" src="<?php echo $spider_video_player_url; ?>/images/socials.png" />
            </span>  
 
</div>
<form action="admin.php?page=Spider_Facebook_manage" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
<table class="admintable" style="width:84%;float:left">
                <tr>
					<td class="key">
						<label for="title">
							Title:
						</label>
					</td>
					<td style="width:100%">
                                    <input  type="text" name="title" id="title" size="80" value="<?php echo htmlspecialchars($row->title) ?>" />
					</td>
				</tr>
				
	<tr id="note">
					<td class="key">
						<label>
							Description:
						</label>
					</td>
					<td style="width:100%">
                                    <p id="notification" style="font-size:16px"></p>
					</td>
				</tr>
<tr id="published">
					<td class="key">
						<label for="published">
							Publish: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Choose whether to publish the plugin or not">[?]</span>
						</label>
					</td>
			     <td style="width:100%">
					               <input type="radio" value="1" name="published" <?php if($row->published=="1") echo 'checked="checked"';?> />Yes
                                   <input type="radio" value="0" name="published" <?php if($row->published=="0") echo 'checked="checked"';?>/>No
				</td>
				</tr>
<tr id="render_tr">
					<td class="key">
						<label for="render" >
							Rendering: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="It is recommended to leave the choice at the default XFBML(eXtended Facebook Markup Language) option to avoid problems with unsupported browsers and other issues">[?]</span>
						</label>
					</td>
					<td style="width:100%">
					              <span style="cursor:pointer" onclick="change_render('2')"><img src="<?php echo $spider_video_player_url; ?>/images/xfbml.png"  id="xfbml"/><img src="<?php echo $spider_video_player_url; ?>/images/xfbml_hover.png"  id="xfbml_hover"/></span>
								  <span style="cursor:pointer" onclick="change_render('1')"><img src="<?php echo $spider_video_player_url; ?>/images/html5.png"  id="html5"/><img src="<?php echo $spider_video_player_url; ?>/images/html5_hover.png"  id="html5_hover"/></span>
								  <span style="cursor:pointer" id="r3" onclick="change_render('3')"><img src="<?php echo $spider_video_player_url; ?>/images/iframe.png" id="iframe"/><img src="<?php echo $spider_video_player_url; ?>/images/iframe_hover.png" id="iframe_hover" /></span>
								  <span style="cursor:pointer" id="r4" onclick="change_render('4')"><img src="<?php echo $spider_video_player_url; ?>/images/url.png" id="url"/><img src="<?php echo $spider_video_player_url; ?>/images/url_hover.png" id="url_hover"/></span>
                                 
					</td>
				</tr>
<tr id="url_type">
					<td class="key">
						<label for="url_type"  id="l_url_type">
							Type of URL: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="By default, the plugin refers to the current page, but it is possible to link it to a different page by choosing the 'URL' option and filling out the 'Facebook page link' field">[?]</span>
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="normal" id="n_url"  name="url_type" <?php if($row->url_type=="normal") echo 'checked="checked"';?>  onchange="change_url('normal')" />URL
                                   <input type="radio" value="auto"   id="a_url" name="url_type" <?php if($row->url_type=="auto") echo 'checked="checked"';?> onchange="change_url('auto')" />Current
                                   
									
					</td>
				</tr>
				
<tr  id="url_tr">
	                  <td class="key"> 
						<label for="url_tr" id="l_url" >
							 Facebook Page Link Text:
						</label>
					</td>
					<td style="width:100%">
                                    <input type="text" name="url"  size="80" value="<?php echo htmlspecialchars($row->url); ?>"/>
					</td>
               </tr> 
<tr id="count_tr">
     <td class="key">
                  <label for="reg_type">
						Count Box Position:
						</label>
     </td>
     <td style="width:100%">
	    <select name="count_mode">
		    <option value="vertical"   <?php if($row->count_mode=="vertical") echo 'selected="selected"';?>>Top</option>
            <option value="horizontal" <?php if($row->count_mode=="horizontal") echo 'selected="selected"';?>>Right</option>
            <option value="none"       <?php if($row->count_mode=="none") echo 'selected="selected"';?>>None</option>
			
		</select>
     </td>
     </tr>
	 
<tr id="hor_place">
					<td class="key">
						<label for="hor_place" >
						Horizontal position: <span style="cursor:pointer;color:#3B5998" class="hasTip" title=" Choose whether to place the plugin on the left or on the right hand of the page.">[?]</span>
						</label>
					</td>
					<td style="width:100%">
					       <select name="hor_place">
                              <option value="left"     <?php if($row->hor_place=="left")    echo 'selected="selected"';?>>Left</option>
                              <option value="right"   <?php if($row->hor_place=="right") echo 'selected="selected"';?>>Right</option>
				          </select>
                                   
									
					</td>
				</tr>			 
	 
	 
			   
<tr  id="domain">
	                  <td class="key"> 
						<label for="domain">
							 Domain: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Specify the domain for which you want the information to be shown. By default, this is the domain on which the plugin is added">[?]</span>
						</label>
					</td>
					<td style="width:100%">
                                    <input type="text" name="domain"  size="80" value="<?php echo htmlspecialchars($row->domain); ?>"/>
					</td>
               </tr>
<tr  id="appid">
	                  <td class="key"> 
						<label for="appid">
							 App id: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Your Facebook application ID">[?]</span>
						</label>
					</td>
					<td style="width:100%">
                                    <input type="text" name="appid" id="appid_req"  size="20" value="<?php echo $row->appid; ?>"/><span id="is_requerid_text_sp_facebook" style="color:#F00">*Is required.</span>  <a style="padding:4px" target="_blank" href="http://web-dorado.com/wordpress-facebook-guide-step-3.html"><b>How to create facebook application?</b></a>
					</td>
               </tr>
	<tr  id="req_m">
	                  <td class="key"> 
						<label for="req_m">
							 Request message: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="The message that accompanies the request">[?]</span>
						</label>
					</td>
					<td style="width:100%">
                                    <input type="text" name="req_m"  size="40" value="<?php echo $row->req_m; ?>"/>
					</td>
               </tr>		   
			   
			   
			   
	<tr  id="reg_red">
	                  <td class="key"> 
						<label for="reg_red">
							 Redirect URL after registration: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Specify the URL to which the user is redirected after registration">[?]</span>
						</label>
					</td>
							<td style="width:100%">
                                    <input type="text" name="req_m" id="req_m_input"   size="40" value="<?php echo $row->req_m; ?>"/><span id="request_massage_spange_bob" style="color:#F00">*Is required.</span>
					</td>
               </tr>	
     <tr  id="log_red">
	                  <td class="key"> 
						<label for="log_red" >
							 Redirect URL after login: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Specify the URL to which the user is redirected after login">[?]</span>
						</label>
					</td>
					<td style="width:100%">
                                    <input type="text" name="log_red"  size="40" value="<?php echo $row->log_red; ?>"/>
					</td>
               </tr>		   			   
			   
<tr id="fb_only">
					<td class="key">
						<label for="fb_only">
							Allow login only via Facebook:
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="1"  name="fb_only" <?php if($row->fb_only=="1") echo 'checked="checked"';?>/>Yes
                                   <input type="radio" value="0"  name="fb_only" <?php if($row->fb_only=="0") echo 'checked="checked"';?>/>No
                                   
									
					</td>
				</tr>
				
<tr id="reg_type">
     <td class="key">
                  <label for="reg_type">
						Registration fields type:
						</label>
     </td>
     <td>
	    <select name="reg_type">
		    <option value="auto"       <?php if($row->reg_type=="auto") echo 'selected="selected"';?>>Automatically generates a username and imports user profile information</option>
            <option value="password"   <?php if($row->reg_type=="password") echo 'selected="selected"';?>>The user sets the username and password</option>
            <option value="captcha"    <?php if($row->reg_type=="captcha") echo 'selected="selected"';?>>Requires setting username and password and verifies with captcha</option>
			
		</select>
     </td>
     </tr>
			   
			   
			   
				
     
<tr id="share_type">
     <td class="key">
                  <label for="share_type">
						Share type:
						</label>
     </td>
     <td style="width:100%">
	    <select name="share_type">
		    <option value="button"       <?php if($row->share_type=="button") echo 'selected="selected"';?>>Standard</option>
            <option value="link"         <?php if($row->share_type=="link") echo 'selected="selected"';?>>Text</option>
            <option value="icon_link"    <?php if($row->share_type=="icon_link") echo 'selected="selected"';?>>Text and icon</option>
			<option value="button_count" <?php if($row->share_type=="button_count") echo 'selected="selected"';?>>Button count</option>
			<option value="box_count"    <?php if($row->share_type=="box_count") echo 'selected="selected"';?>>Box count</option>
			
		  </select>
     </td>
     </tr>
			   
							   
<tr id="width">
     <td class="key">
                  <label for="width">
							Width: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Define the width of the social plugin in pixels">[?]</span>
						</label>
     </td>
     <td style="width:100%">
          <input type="text" name="width" size="40" value="<?php echo $row->width; ?>" />
     </td>
     </tr>
<tr id="height">
     <td class="key">
                  <label for="height" >
							Height: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Define the height of the social plugin in pixels">[?]</span>
						</label>
     </td>
     <td style="width:100%">
          <input type="text" name="height" size="40"  value="<?php echo $row->height; ?>"/>
     </td>
     </tr>
	 <tr  id="url_value">
	                  <td class="key"> 
						<label for="url">
							 Link text:
						</label>
					</td>
					<td >
                                    <input type="text" name="url_value"  size="80" value="<?php echo htmlspecialchars($row->url_value); ?>"/>
					</td>
               </tr>
	 
	 
<tr id="target">
     <td class="key">
                  <label for="target">
						Target: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Select the context in which content links are opened">[?]</span>
						</label>
     </td>
     <td style="width:100%">
	    <select name="target">
            <option value="_blank" <?php if($row->target=="_blank") echo 'selected="selected"';?>>_blank</option>
            <option value="_top" <?php if($row->target=="_top") echo 'selected="selected"';?>>_top</option>
			<option value="_parent" <?php if($row->target=="_parent") echo 'selected="selected"';?>>_parent</option>
		  </select>
     </td>
     </tr>
<tr id="rows">
     <td class="key">
                  <label for="rows" >
							Max Rows: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="The maximum number of rows of profile pictures">[?]</span>
						</label>
     </td>
     <td style="width:100%">
          <input type="text" name="rows" size="40" value="<?php echo $row->rows; ?>"/>
     </td>
     </tr>
<tr id="size">
     <td class="key">
                  <label for="size">
						Image size: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Define the size of the images">[?]</span>
						</label>
     </td>
     <td style="width:100%">
          <select name="size">
            <option value="small" <?php if($row->size=="small") echo 'selected="selected"';?>>Small</option>
            <option value="medium" <?php if($row->size=="medium") echo 'selected="selected"';?>>Medium</option>
			<option value="large" <?php if($row->size=="large") echo 'selected="selected"';?>>Large</option>
		  </select>
     </td>
     </tr>
<tr id="post">
     <td class="key">
                  <label for="post" >
							Number of posts: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Specify how many posts are displayed by default">[?]</span>
						</label>
     </td>
     <td>
          <input type="text" name="post" size="40" value="<?php echo $row->post; ?>"/>
     </td>
     </tr>
	 
<tr id="head">
					<td class="key">
						<label for="head">
							Show Header: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Choose whether to show the Facebook header on the top of the plugin container or not">[?]</span>
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="1"  name="head" <?php if($row->head=="1") echo 'checked="checked"';?> />Yes
                                   <input type="radio" value="0" name="head" <?php if($row->head=="0") echo 'checked="checked"';?>/>No
                                   
									
					</td>
				</tr>
<tr id="stream">
					<td class="key">
						<label for="stream" >
							Show stream: <span style="cursor:pointer;color:#3B5998"class="hasTip" title="Show the profile stream for the public profile" >[?]</span>
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="1"  name="stream" <?php if($row->stream=="1") echo 'checked="checked"';?>/>Yes
                                   <input type="radio" value="0" name="stream" <?php if($row->stream=="0") echo 'checked="checked"';?>/>No
                                   
									
					</td>
				</tr>			
<tr id="recom">
					<td class="key">
						<label for="recom">
							Show Recommendations: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Show user recommendations" >[?]</span>
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="true"  name="recom" <?php if($row->recom=="true") echo 'checked="checked"';?>/>Yes
                                   <input type="radio" value="false" name="recom" <?php if($row->recom=="false") echo 'checked="checked"';?>/>No
                                   
									
					</td>
				</tr>
	 
<tr id="action">
					<td class="key">
						<label for="action">
							Button label:
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="like"  name="action" <?php if($row->action=="like") echo 'checked="checked"';?>/>Like
                                   <input type="radio" value="recommend" name="action" <?php if($row->action=="recommend") echo 'checked="checked"';?>/>Recommend
                                   
									
					</td>
				</tr>
<tr id="send">
					<td class="key">
						<label for="send">
							Show send button: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Places a Send button next to the Like button">[?]</span>
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="1"  name="send" <?php if($row->send=="1") echo 'checked="checked"';?>/>Yes
                                   <input type="radio" value="0" name="send" <?php if($row->send=="0") echo 'checked="checked"';?>/>No
                                   
									
					</td>
				</tr>
<tr id="face">
					<td class="key">
						<label for="face">
							Show Page Fans:
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="1"  name="face"  <?php if($row->face=="1") echo 'checked="checked"';?>/>Yes
                                   <input type="radio" value="0" name="face"  <?php if($row->face=="0") echo 'checked="checked"';?>/>No
                                   
									
					</td>
				</tr>
			   
<tr id="layout">
					<td class="key">
						<label for="colorsc">
							Layout style: <span style="cursor:pointer;color:#3B5998"  title="&lt;img src='<?php echo $spider_video_player_url; ?>/images/like_standard.png'&gt;&lt;img src='<?php echo $spider_video_player_url; ?>/images/like_button_count.png'&gt;&lt;img src='<?php echo $spider_video_player_url; ?>/images/like_box_count.png'&gt;" class="hasTip">[?]</span>
						</label>
					</td>
					<td style="width:100%">
					          <select name="layout">
                              <option value="standard" <?php if($row->layout=="standard") echo 'selected="selected"';?>>Standard</option>
                              <option value="button_count" <?php if($row->layout=="button_count") echo 'selected="selected"';?>>Button_count</option>
							  <option value="box_count" <?php if($row->layout=="box_count") echo 'selected="selected"';?>>Box_count</option>
                              </select>
                                   
									
					</td>
				</tr>
<tr id="bord">
					<td class="key">
						<label for="bord">
							Border:
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="1"  name="bord" <?php if($row->bord=="1") echo 'checked="checked"';?>/>Yes
                                   <input type="radio" value="0" name="bord" <?php if($row->bord=="0") echo 'checked="checked"';?>/>No
                                   
									
					</td>
				</tr>				
				
				
				
				
	<tr id="border">
      <td class="key">
                  <label for="border" >
							Border Color: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="The border color of the plugin container">[?]</span>
				  </label>
     </td>
     <td style="width:100%">
          <input class="color" type="text" name="border" size="40" value="<?php echo $row->border; ?>"/>
     </td>
     </tr>			
				
<tr id="backg">
     <td class="key">
                  <label for="backg">
							Background Color: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="The background color of the plugin container">[?]</span>
						</label>
     </td>
     <td style="width:100%">
          <input class="color" type="text" name="backg" size="40" value="<?php echo $row->backg; ?>"/>
     </td>
     </tr>
			   
<tr id="colorsc">
					<td class="key">
						<label for="colorsc">
							Color Scheme: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="The color scheme of the plugin">[?]</span>
						</label>
					</td>
					<td >
					          <select name="colorsc">
                              <option value="light" <?php if($row->colorsc=="light") echo 'selected="selected"';?>>Light</option>
                              <option value="dark"  <?php if($row->colorsc=="dark") echo 'selected="selected"';?>>Dark</option>
                              </select>
                                   
									
					</td>
				</tr>
				
	<tr id="request_type">
					<td class="key">
						<label for="request_type">
							Request type: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Choose whether to enable request for one or multiple users">[?]</span>
						</label>
					</td>
					<td >
					               <input type="radio" value="1"  name="request_type" <?php if($row->request_type=="1") echo 'checked="checked"';?>/>Multi users
                                   <input type="radio" value="0"  name="request_type" <?php if($row->request_type=="0") echo 'checked="checked"';?>/>One user
                                   
									
					</td>
				</tr>	
<tr id="twit">
					<td class="key">
						<label for="twit">
							Your screen name:
						</label>
					</td>
					<td style="width:100%">
					          
                         <input  type="text" name="twit" size="80" value="<?php echo $row->twit; ?>"/>           
									
					</td>
				</tr>								
	<tr id="font">
					<td class="key">
						<label for="font">
							Font: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="The text font of the plugin">[?]</span>
						</label>
					</td>
					<td style="width:100%">
		<select name="font">
            <option value="arial" <?php if($row->font=="arial") echo 'selected="selected"';?>>Arial</option>
            <option value="lucida grande" <?php if($row->font=="lucida grande") echo 'selected="selected"';?>>Lucida grande</option>
			<option value="segoe ui" <?php if($row->font=="segoe ui") echo 'selected="selected"';?>>Segoe ui</option>
			<option value="tahoma" <?php if($row->font=="tahoma") echo 'selected="selected"';?>>Tahoma</option>
			<option value="trebuchet ms" <?php if($row->font=="trebuchet ms") echo 'selected="selected"';?>>Trebuchet ms</option>
			<option value="verdana" <?php if($row->font=="verdana") echo 'selected="selected"';?>>Verdana</option>
          </select>
                                   
									
					</td>
				</tr>		   
<tr id="lang_type">
					<td class="key">
						<label for="lang_type">
							Language Preference:
						</label>
					</td>
					<td style="width:100%">
					               <input type="radio" value="normal" title="Plugin language" name="lang_type" <?php if($row->lang_type=="normal") echo 'checked="checked"';?>  onchange="change_lang('normal')" />Custom
                                   <input type="radio" value="auto" name="lang_type" title="Adjusts to the language of the website" <?php if($row->lang_type=="auto") echo 'checked="checked"';?> onchange="change_lang('auto')" />Current
                                   
									
					</td>
				</tr>			   
<tr id="lang">
					<td class="key">
						<label for="lang">
							Language:
						</label>
					</td>
					<td style="width:100%">
		<select name="lang">
<option value="sq_AL" <?php if($row->lang=="sq_AL") echo 'selected="selected"';?>>Albanian</option>
<option value="ar_AR" <?php if($row->lang=="ar_AR") echo 'selected="selected"';?> >Arabic</option>
<option value="hy_AM" <?php if($row->lang=="hy_AM") echo 'selected="selected"';?> >Armenian</option>
<option value="az_AZ" <?php if($row->lang=="az_AZ") echo 'selected="selected"';?> >Azeri</option>
<option value="eu_ES" <?php if($row->lang=="eu_ES") echo 'selected="selected"';?> >Basque</option>
<option value="be_BY" <?php if($row->lang=="be_BY") echo 'selected="selected"';?> >Belarusian </option>
<option value="bn_IN" <?php if($row->lang=="bn_IN") echo 'selected="selected"';?> >Bengali</option>
<option value="bs_BA" <?php if($row->lang=="bs_BA") echo 'selected="selected"';?> >Bosnian</option>
<option value="bg_BG" <?php if($row->lang=="bg_BG") echo 'selected="selected"';?> >Bulgarian</option>
<option value="ck_US" <?php if($row->lang=="ck_US") echo 'selected="selected"';?> >Cherokee </option>
<option value="hr_HR" <?php if($row->lang=="hr_HR") echo 'selected="selected"';?> >Croatian</option>
<option value="cs_CZ" <?php if($row->lang=="cs_CZ") echo 'selected="selected"';?> >Czech</option>
<option value="da_DK" <?php if($row->lang=="da_DK") echo 'selected="selected"';?> >Danish</option>
<option value="nl_NL" <?php if($row->lang=="nl_NL") echo 'selected="selected"';?> >Dutch</option>
<option value="nl_BE" <?php if($row->lang=="nl_BE") echo 'selected="selected"';?> >Dutch (Belgie)</option>
<option value="af_ZA" <?php if($row->lang=="af_ZA") echo 'selected="selected"';?> >Afrikaans </option>
<option value="en_PI" <?php if($row->lang=="en_PI") echo 'selected="selected"';?> >English (Pirate) </option>
<option value="en_GB" <?php if($row->lang=="en_GB") echo 'selected="selected"';?> >English (UK)</option>
<option value="en_US" <?php if($row->lang=="en_US") echo 'selected="selected"';?> >English (US)</option>
<option value="en_UD" <?php if($row->lang=="en_UD") echo 'selected="selected"';?> >English (Upside Down)</option>
<option value="eo_EO" <?php if($row->lang=="eo_EO") echo 'selected="selected"';?> >Esperanto</option>
<option value="et_EE" <?php if($row->lang=="et_EE") echo 'selected="selected"';?> >Estonian</option>
<option value="fo_FO" <?php if($row->lang=="fo_FO") echo 'selected="selected"';?> >Faroese</option>
<option value="tl_PH" <?php if($row->lang=="tl_PH") echo 'selected="selected"';?> >Filipino</option>
<option value="fi_FI" <?php if($row->lang=="fi_FI") echo 'selected="selected"';?> >Finnish</option>
<option value="fr_CA" <?php if($row->lang=="fr_CA") echo 'selected="selected"';?> >French (Canada) </option>
<option value="fr_FR" <?php if($row->lang=="fr_FR") echo 'selected="selected"';?> >French (France)</option>
<option value="gl_ES" <?php if($row->lang=="gl_ES") echo 'selected="selected"';?> >Galician</option>
<option value="ka_GE" <?php if($row->lang=="ka_GE") echo 'selected="selected"';?> >Georgian </option>
<option value="de_DE" <?php if($row->lang=="de_DE") echo 'selected="selected"';?> >German</option>
<option value="el_GR" <?php if($row->lang=="el_GR") echo 'selected="selected"';?> >Greek</option>
<option value="gu_IN" <?php if($row->lang=="gu_IN") echo 'selected="selected"';?> >Gujarati</option>
<option value="he_IL" <?php if($row->lang=="he_IL") echo 'selected="selected"';?> >Hebrew</option>
<option value="hi_IN" <?php if($row->lang=="hi_IN") echo 'selected="selected"';?> >Hindi</option>
<option value="hu_HU" <?php if($row->lang=="hu_HU") echo 'selected="selected"';?> >Hungarian</option>
<option value="is_IS" <?php if($row->lang=="is_IS") echo 'selected="selected"';?> >Icelandic</option>
<option value="id_ID" <?php if($row->lang=="id_ID") echo 'selected="selected"';?> >Indonesian</option>
<option value="ga_IE" <?php if($row->lang=="ga_IE") echo 'selected="selected"';?> >Irish</option>
<option value="it_IT" <?php if($row->lang=="it_IT") echo 'selected="selected"';?> >Italian</option>
<option value="ja_JP" <?php if($row->lang=="ja_JP") echo 'selected="selected"';?> >Japanese</option>
<option value="jv_ID" <?php if($row->lang=="jv_ID") echo 'selected="selected"';?> >Javanese</option>
<option value="kn_IN" <?php if($row->lang=="kn_IN") echo 'selected="selected"';?> >Kannada</option>
<option value="km_KH" <?php if($row->lang=="km_KH") echo 'selected="selected"';?> >Khmer</option>
<option value="ko_KR" <?php if($row->lang=="ko_KR") echo 'selected="selected"';?> >Korean</option>
<option value="ku_TR" <?php if($row->lang=="ku_TR") echo 'selected="selected"';?> >Kurdish</option>
<option value="la_VA" <?php if($row->lang=="la_VA") echo 'selected="selected"';?> >Latin</option>
<option value="lv_LV" <?php if($row->lang=="lv_LV") echo 'selected="selected"';?> >Latvian</option>
<option value="fb_LT" <?php if($row->lang=="fb_LT") echo 'selected="selected"';?> >Leet Speak</option>
<option value="lt_LT" <?php if($row->lang=="lt_LT") echo 'selected="selected"';?> >Lithuanian</option>
<option value="mk_MK" <?php if($row->lang=="mk_MK") echo 'selected="selected"';?> >Macedonian</option>
<option value="mg_MG" <?php if($row->lang=="mg_MG") echo 'selected="selected"';?> >Malagasy</option>
<option value="ms_MY" <?php if($row->lang=="ms_MY") echo 'selected="selected"';?> >Malay</option>
<option value="ml_IN" <?php if($row->lang=="ml_IN") echo 'selected="selected"';?> >Malayalam</option>
<option value="mn_MN" <?php if($row->lang=="mn_MN") echo 'selected="selected"';?> >Mongolian</option>
<option value="ne_NP" <?php if($row->lang=="ne_NP") echo 'selected="selected"';?> >Nepali </option>
<option value="se_NO" <?php if($row->lang=="se_NO") echo 'selected="selected"';?> >Northern Sami</option>
<option value="nb_NO" <?php if($row->lang=="nb_NO") echo 'selected="selected"';?> >Norwegian (bokmal) </option>
<option value="nn_NO" <?php if($row->lang=="nn_NO") echo 'selected="selected"';?> >Norwegian (nynorsk) </option>
<option value="ps_AF" <?php if($row->lang=="ps_AF") echo 'selected="selected"';?> >Pashto</option>
<option value="fa_IR" <?php if($row->lang=="fa_IR") echo 'selected="selected"';?> >Persian</option>
<option value="pl_PL" <?php if($row->lang=="pl_PL") echo 'selected="selected"';?> >Polish</option>
<option value="pt_BR" <?php if($row->lang=="pt_BR") echo 'selected="selected"';?> >Portuguese (Brazil) </option>
<option value="pt_PT" <?php if($row->lang=="pt_PT") echo 'selected="selected"';?> >Portuguese (Portugal)</option>
<option value="pa_IN" <?php if($row->lang=="pa_IN") echo 'selected="selected"';?> >Punjabi</option>
<option value="ro_RO" <?php if($row->lang=="ro_RO") echo 'selected="selected"';?> >Romanian</option>
<option value="rm_CH" <?php if($row->lang=="rm_CH") echo 'selected="selected"';?> >Romansh</option>
<option value="ru_RU" <?php if($row->lang=="ru_RU") echo 'selected="selected"';?> >Russian</option>
<option value="sr_RS" <?php if($row->lang=="sr_RS") echo 'selected="selected"';?> >Serbian</option>
<option value="zh_CN" <?php if($row->lang=="zh_CN") echo 'selected="selected"';?> >Simplified Chinese (China) </option>
<option value="sk_SK" <?php if($row->lang=="sk_SK") echo 'selected="selected"';?> >Slovak </option>
<option value="sl_SI" <?php if($row->lang=="sl_SI") echo 'selected="selected"';?> >Slovenian </option>
<option value="es_CL" <?php if($row->lang=="es_CL") echo 'selected="selected"';?> >Spanish (Chile)</option>
<option value="es_CO" <?php if($row->lang=="es_CO") echo 'selected="selected"';?> >Spanish (Colombia)</option>
<option value="es_MX" <?php if($row->lang=="es_MX") echo 'selected="selected"';?> >Spanish (Mexico)</option>
<option value="es_ES" <?php if($row->lang=="es_ES") echo 'selected="selected"';?> >Spanish (Spain)</option>
<option value="es_VE" <?php if($row->lang=="es_VE") echo 'selected="selected"';?> >Spanish (Venezuela)</option>
<option value="sw_KE" <?php if($row->lang=="sw_KE") echo 'selected="selected"';?> >Swahili</option>
<option value="sv_SE" <?php if($row->lang=="sv_SE") echo 'selected="selected"';?> >Swedish</option>
<option value="sy_SY" <?php if($row->lang=="sy_SY") echo 'selected="selected"';?> >Syriac</option>
<option value="ta_IN" <?php if($row->lang=="ta_IN") echo 'selected="selected"';?> >Tamil</option>
<option value="te_IN" <?php if($row->lang=="te_IN") echo 'selected="selected"';?> >Telugu</option>
<option value="th_TH" <?php if($row->lang=="th_TH") echo 'selected="selected"';?> >Thai</option>
<option value="zh_HK" <?php if($row->lang=="zh_HK") echo 'selected="selected"';?> >Traditional Chinese (Hong Kong) </option>
<option value="zh_TW" <?php if($row->lang=="zh_TW") echo 'selected="selected"';?> >Traditional Chinese (Taiwan) </option>
<option value="tr_TR" <?php if($row->lang=="tr_TR") echo 'selected="selected"';?> >Turkish</option>
<option value="uk_UA" <?php if($row->lang=="uk_UA") echo 'selected="selected"';?> >Ukrainian</option>
<option value="vi_VN" <?php if($row->lang=="vi_VN") echo 'selected="selected"';?> >Vietnamese</option>
<option value="cy_GB" <?php if($row->lang=="cy_GB") echo 'selected="selected"';?> >Welsh </option>
<option value="xh_ZA" <?php if($row->lang=="xh_ZA") echo 'selected="selected"';?> >Xhosa</option>
<option value="yi_DE" <?php if($row->lang=="yi_DE") echo 'selected="selected"';?> >Yiddish</option>
			
				
          </select>
                                   
									
		       </td>
				</tr>	
	
	<tr id="all">
					<td class="key">
						<label for="all" >
							All Posts: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Adds the plugin to all the posts in the website">[?]</span>
						</label>
					</td>
					<td style="width:100%">
					   <input type="checkbox" id="all_arts" <?php if($row->articles=='all') echo 'checked="checked"';?> onclick="all_art(this.checked)" />             
                                   
									
					</td>
				</tr>	
				
				
<tr id="def_img_art_tr">
					<td class="key">
						<label>
							Default image for Posts:
							</label>
					</td>
                	<td style="width:100%">
					<input class="text_input" type="hidden" value="<?php echo $row->def_img_art; ?>" name="def_img_art" id="def_img_art" />
<a class="lu_upload_button1" title="Image" href="#">Select Image</a><br />
<a href="javascript:removeImage1();">Remove Image</a><br />
               <div style="height:30;">
                       <img class="image_for_media" style="display:<?php if($row->def_img_art=='') echo 'none'; else echo 'block' ?>;" height="30" id="imagebox1" src="<?php echo htmlspecialchars($row->def_img_art) ; ?>" />     
                                       </div>          
									   </td>
				</tr>
<script type="text/javascript">    
function removeImage1()
{
				document.getElementById("imagebox1").style.display="none";
				document.getElementById("def_img_art").value='';
}
</script>              
<tr id="add_article">
					<td class="key">
						<label for="articles">
							Posts: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="The following META tags allow specifying how the chosen post will look when published on the user's wall">[?]</span>
						</label>
					</td>
					<td  style="width:1000px" >
              
<a class="thickbox-preview1" href="<?php echo admin_url('admin-ajax.php?action=selectpostsforfacebook'); ?>&TB_iframe=true&tbWidth=1024&tbHeight=768" rel="{handler: 'iframe', size: {x: 850, y: 475}}"><img src="<?php echo $spider_video_player_url; ?>/images/add_but.png" class="hasTip" title="Choose the items to which you want to add the plugin" /> </a>
<table id="art_table_meta" width="100%">
 <thead id="th_art_meta">
  <tr>
<td colspan="4">
<p><b>If you have changed META, please debug your URL in  </b> <a href="https://developers.facebook.com/tools/debug/" target="_blank"> Facebook Debugger : </a> </p>
<p>The following META tags allow you to customize the appearance of the chosen item on the user's wall</p>
</td>
   </tr>
    <tr >
	  <th style="border-style:solid;border-width:2px;">ITEMS</th>
      <th style="border-style:solid;border-width:2px;" class="hasTip" title="The title of the item">TITLE</th>
      <th style="border-style:solid;border-width:2px;" class="hasTip" title="The source websitewill be categorized by the chosen type">TYPE</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="For providing a canonical address for the page">URL</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="The image accompanying the published item">IMAGE</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="For specifying a name for your website">SITE NAME</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="For providing a description for the item">DESCRIPTION</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="You can fill out the Admin ID of your Facebook page to connect the post to the page">ADMIN ID</th>
	  <th><img style="margin-left:22px;cursor:pointer" src="<?php echo $spider_video_player_url; ?>/images/close.png" onclick="confirmation('articles')"/></th>
	  
    </tr>
  </thead>
<tbody id="meta"></tbody>
</table>
<table id="art_table" width="30%">
<thead id="th_art">
    <tr>
	  <th style="border-style:solid;border-width:2px;">Posts</th>
     
	  <th><img style="margin-left:22px;cursor:pointer" src="<?php echo $spider_video_player_url; ?>/images/close.png" onclick="confirmation('articles')"/></th>
	  
	 
    </tr>
  </thead>
<tbody id="only_titles"></tbody>
</table>
<input type="hidden" name="articles" id="articles"  />
<input type="hidden" name="meta_title" id="meta_title"  />
<input type="hidden" name="meta_type" id="meta_type"  />
<input type="hidden" name="meta_url" id="meta_url"  />
<input type="hidden" name="meta_image" id="meta_image"  />
<input type="hidden" name="meta_site_name" id="meta_site_name"  />
<input type="hidden" name="meta_description" id="meta_description"  />
<input type="hidden" name="meta_admins" id="meta_admins"  />
					</td>
				</tr>
				
<tr id="place">
					<td class="key">
						<label for="place" >
						Vertical position: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Choose whether to place the plugin at the top or at the bottom of the item">[?]</span>
						</label>
					</td>
					<td>
					          <select name="place">
                              <option value="top"     <?php if($row->place=="top")    echo 'selected="selected"';?>>Top</option>
                              <option value="bottom" id="comment_pos_art"  <?php if($row->place=="bottom") echo 'selected="selected"';?>>Bottom</option>
							  <option value="both"  <?php if($row->place=="both") echo 'selected="selected"';?>>Both</option>
                              </select>
                                   
									
					</td>
				</tr>				
	
	
	
	
	
	
	
	
	<tr id="item_all">
					<td class="key">
						<label for="item_all" >
							On all pages: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Adds the plugin to all pages in the website except the posts">[?]</span>
						</label>
					</td>
					<td >
					   <input type="checkbox" id="all_items" <?php if($row->items=='all') echo 'checked="checked"';?> onclick="all_item(this.checked)" />             
                                   
									
					</td>
				</tr>
<tr id="def_img_item_tr">
					<td class="key">
						<label>
							Defualt image for pages:
							</label>
					</td>
                	<td>
					<input class="text_input" type="hidden" value="<?php echo $row->def_img_item; ?>" name="def_img_item" id="def_img_item" />
<a class="lu_upload_button1" title="Image" href="#" >Select Image</a><br />
<a href="javascript:removeImage2();">Remove Image</a><br />
               <div style="height:30;">
                       <img class="image_for_media" style="display:<?php if($row->def_img_item=='') echo 'none'; else echo 'block' ?>;" height="30" id="imagebox2" src="<?php echo htmlspecialchars($row->def_img_item) ; ?>" />     
                                       </div>          
									   </td>
				</tr>
<script type="text/javascript">    
function removeImage2(x)
{
				document.getElementById("imagebox2").style.display="none";
				document.getElementById("def_img_item").value='';
}
</script>  
<tr id="add_item">
					<td class="key">
						<label for="items">
							Pages: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="The following META tags allow specifying how the chosen page will look when published on the user's wall">[?]</span>
						</label>
					</td>
					<td  style="width:1000px" >
              
<a class="thickbox-preview1" href="<?php echo admin_url('admin-ajax.php?action=selectpagesforfacebook'); ?>&TB_iframe=true&tbWidth=1024&tbHeight=768" rel="{handler: 'iframe', size: {x: 850, y: 475}}"><img src="<?php echo $spider_video_player_url; ?>/images/add_but.png" class="hasTip" title="Choose the items to which you want to add the plugin" /> </a>
<table id="item_table_meta" width="100%">
 <thead id="th_item_meta">
  <tr>
<td colspan="4">
<p><b>If you have changed META, please debug your URL in  </b> <a href="https://developers.facebook.com/tools/debug/" target="_blank"> Facebook Debugger : </a> </p>
<p>The following META tags allow you to customize the appearance of the chosen item on the user's wall.</p>
</td>
   </tr>
    <tr>
	  <th style="border-style:solid;border-width:2px;">ITEMS</th>
      <th style="border-style:solid;border-width:2px;" class="hasTip" title="The title of the item">TITLE</th>
      <th style="border-style:solid;border-width:2px;" class="hasTip" title="The source websitewill be categorized by the chosen type">TYPE</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="For providing a canonical address for the page">URL</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="The image accompanying the published item">IMAGE</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="For specifying a name for your website">SITE NAME</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="For providing a description for the item">DESCRIPTION</th>
	  <th style="border-style:solid;border-width:2px;" class="hasTip" title="You can fill out the Admin ID of your Facebook page to connect the post to the page">ADMIN ID</th>
	  <th><img style="margin-left:22px;cursor:pointer" src="<?php echo $spider_video_player_url; ?>/images/close.png" onclick="confirmation('items')"/></th>
	  
	 
    </tr>
  </thead>
<tbody id="item_meta"></tbody>
</table>
<table id="item_table" width="30%">
<thead id="th_item">
    <tr>
	  <th style="border-style:solid;border-width:2px;">ITEMS</th>
     
	  <th><img style="margin-left:22px;cursor:pointer" src="<?php echo $spider_video_player_url; ?>/images/close.png" onclick="confirmation('items')"/></th>
	  
	 
    </tr>
  </thead>
<tbody id="item_only_titles"></tbody>
</table>
<input type="hidden" name="items" id="items" size="80" />
<input type="hidden" name="item_meta_title"       id="item_meta_title" />
<input type="hidden" name="item_meta_type"        id="item_meta_type" />
<input type="hidden" name="item_meta_url"         id="item_meta_url" />
<input type="hidden" name="item_meta_image"       id="item_meta_image" />
<input type="hidden" name="item_meta_site_name"   id="item_meta_site_name" />
<input type="hidden" name="item_meta_description" id="item_meta_description" />
<input type="hidden" name="item_meta_admins"      id="item_meta_admins" />
					</td>
				</tr>
				<tr id="con_place">
					<td class="key">
						<label for="place">
						Vertical position: <span style="cursor:pointer;color:#3B5998" class="hasTip" title="Choose whether to place the plugin at the top or at the bottom of the pages">[?]</span>
						</label>
					</td>
					<td >
					          <select name="item_place">
                              <option value="top"     <?php if($row->item_place=="top")    echo 'selected="selected"';?>>Top</option>
                              <option value="bottom" id="comment_pos_item"  <?php if($row->item_place=="bottom") echo 'selected="selected"';?>>Bottom</option>
							  <option value="both"  <?php if($row->item_place=="both") echo 'selected="selected"';?>>Both</option>
                              </select>
                                   
									
					</td>
				</tr>
		<tr id="css">
					<td class="key">
						<label for="style">
							STYLE: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="You can provide a custom Style for the plugin container">[?]</span>
						</label>
					</td>
					           
					<td >
					          
                                   
					<textarea name="css"  style="width:200px;height:200px"><?php echo $row->css ?></textarea>   				
					</td>
				</tr>	
				
	   <tr>
					<td class="key">
						<label >
							Add to &lt;html&gt; tag: <span style="cursor:pointer;color:#3B5998"  class="hasTip" title="Add by yourself code from this field into &lt;html&gt; tag of your template(file:templates/your_template/index.php).">[?]</span>
						</label>
					</td>
					           
					<td >
					          
                                   
					<textarea readonly="readonly" id="html_tag" style="width:310px;height:45px">xmlns:og="http://ogp.me/ns#"  xmlns:fb="http://www.facebook.com/2008/fbml" </textarea>   				
					</td>
				</tr>				
					
				
				
				
	</table>	
	
<div align="center" id="likebutton_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/like_standard.png" />
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/like_button_count.png" />
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/like_box_count.png" />
     </div>
<div align="center" id="sendbutton_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/send_prev_1.png" />
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/send_prev_2.png" />
      </div>
<div align="center" id="comment_prev" class="preview">
      <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/comment_prev_1.png" />
      <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/comment_prev_2.png" />
      </div>
<div align="center" id="like_box_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/likebox_prev_1.png" />
     </div>
<div align="center" id="follow_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/follow_prev_1.png" />
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/follow_prev_2.png" />
     </div>
<div align="center" id="request_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/request_prev_1.png" />
     </div>
<div align="center" id="recommendation_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/recommendation_prev_1.png" />
     </div>
<div align="center" id="activity_feed_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/activity_feed_prev_1.png" />
     </div>
<div align="center" id="facepile_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/facepile_prev_1.png" />
     </div>
<div align="center" id="share_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/share_prev_1.png" /><br>
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/share_prev_2.png" /><br>
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/share_prev_3.png" /><br>
	 <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/share_prev_4.png" />
     </div>
<div align="center" id="login_prev" class="preview">
      <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/login_prev_1.png" /><br>
     </div>
<div align="center" id="register_prev" class="preview">
         <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/register_prev_1.png" /><br>
		 </div>
<div align="center" id="social_prev" class="preview">
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/social_prev_2.png" />
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/social_prev_3.png" />
     <img style="padding-top:50px" src="<?php echo $spider_video_player_url; ?>/images/social_prev_1.png" />
     </div>		 
		 
  
    
    <input type="hidden" name="option" value="com_spiderfacebook" />
	<input type="hidden" name="id" value="<?php echo $row->id?>" /> 
    <input type="hidden" name="task" value="" />
	<input type="hidden" id="type" name="type" value="<?php echo $row->type?>"/>
	<input type="hidden" id="render" name="render" value="<?php echo $row->render?>"/>
	<input type="hidden" id="url_change" value="<?php echo $row->url_type?>"/>
	<input type="hidden" id="lang_change" value="<?php echo $row->lang_type?>"/>
</form>
<script>
change_url('<?php echo $row->url_type;?>') ;
change_lang('<?php echo $row->lang_type;?>') ;
change_render('<?php echo $row->render;?>') ; 
change_type('<?php echo $row->type;?>') ; 
<?php 
if($row->articles=='all')
{
?>
all_art(true)
<?php
}
else
{
?>
edit_art() ; 
<?php
}
?>
<?php 
if($row->items=='all')
{
?>
all_item(true)
<?php
}
else
{
?>
edit_item() ; 
<?php
}
?>
</script>
<?php 
	 
}
?>