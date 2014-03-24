<?php
function spider_facebook_front_meta() {
	global $wpdb;
	global $post;
	
	
	if(is_home())
	{
		$query ="SELECT * FROM ".$wpdb->prefix."spiderfacebook_params";
		$param=$wpdb->get_results($query);
		if(!count($param))
		{
			return;
		}
		else
		{
			$typee=$param[0]->appid;
			foreach($param as $par)
			{
				if($par->type=='likebutton' || $par->type=='socials' || $par->type=='sendbutton')
				$typee=$par->appid;
			}
		}
		
		?>
        <meta property="og:type" content="website">
		<meta property="og:locale" content="<?php echo str_replace('-','_',get_bloginfo('language')); ?>">
		<meta property="fb:app_id" content="<?php echo $typee; ?>">
		<meta property="og:title" content="<?php echo get_bloginfo( 'name' ); ?>">
        <meta property="og:description" content="<?php echo get_bloginfo( 'description' ); ?>">
        <meta property="og:url" content="<?php echo get_home_url(); ?>">
        <?php
	}
	if($post->post_type=='post'){
		$query ="SELECT * FROM ".$wpdb->prefix."spiderfacebook_params WHERE (articles LIKE '%***".$post->ID."***%' OR articles='all') AND `published`=1 ";
		$param=$wpdb->get_results($query);
		$get_post_for_facebook_id=get_post($post->ID);
		
		$facebook_featured_image=(preg_match('~\bsrc="([^"]++)"~', get_the_post_thumbnail($post->ID,'thumbnail'), $matches)) ? $matches[1] : '';
		
		$pattern ='[\[spider_facebook id="([0-9]*)"\]]';
		$count_facebook_in_post=preg_match_all ( $pattern, $post->post_content, $matches_spider_face);
		if(!$count_facebook_in_post)
		{
			if(!count($param))
			return;
		}
		else
		{
			if(!count($param)){
			$matches_spider_face[1][0];
			$query ="SELECT * FROM ".$wpdb->prefix."spiderfacebook_params WHERE id=".$matches_spider_face[1][0]."";
			$par=$wpdb->get_row($query);
			if(!($par->type=='likebutton' || $par->type=='sendbutton' || $par->type=='comment'))
			{
				return;
			}
			}
		}
		
		$value_title 		= get_post_meta( $post->ID, '_spider_facebok_title_meta_value', true );
		$value_type 		= get_post_meta( $post->ID, '_spider_facebok_type_meta_value',true);
		$value_url 			= get_post_meta( $post->ID, '_spider_facebok_url_meta_value',true);
		$value_image 		= get_post_meta( $post->ID, '_spider_facebok_image_meta_value',true );
		$value_site_name 	= get_post_meta( $post->ID, '_spider_facebok_site_name_meta_value', true );
		$value_description	= get_post_meta( $post->ID, '_spider_facebok_description_meta_value',true );
		$value_admin_id 	= get_post_meta( $post->ID, '_spider_facebok_admin_id_meta_value', true );		
			
		$url=get_permalink();
		$lang=get_bloginfo('language','en-US');
		if(!count($param))
		{			
				 
				 if($value_title)
				 echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';
				 if($value_type!='Chose a type')	
				 echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
				 if($value_url)
				 echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"/>';
				 
				 if($value_image)
					echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
				 else
				 if($facebook_featured_image)
					echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
					
				if($value_site_name)
				 echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_site_name).'"/>';
				 if($value_description)
				 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
					
				 if($value_admin_id)
					echo $tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($value_admin_id).'"/>' );
				 else
					echo $tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
							
									
							 
			
	
			
			
		}
		else
		for($i=0, $n=count($param); $i < $n ; $i++){
			$par = $param[$i];			
			if($par->published!=0){			
				if(($par->type=='likebutton' || $par->type=='sendbutton' || $par->type=='comment') && $par->articles!='all'){
					if(($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description && $value_admin_id) || ($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description)){
					 	 echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';
						 if($value_type!='Chose a type')	
						 echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
						 echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"/>';
						 
						 if($value_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
						 else
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
							
						 echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_title).'"/>';
						 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
						 	
						 if($value_admin_id)
							echo 	$tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($value_admin_id).'"/>' );
						 else
							echo $tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
											
					}
					else{										
						
						$arts_id=array();
						$arts_id=explode('***',$par->articles);
						$arts_id= array_slice($arts_id,1, count($arts_id)-2); 
						foreach($arts_id as $key => $art_id){
							if($post->ID==$art_id){
								$k=$key;
							}
						}
											
						$meta_title=array();
						$meta_title=explode('***',$par->meta_title);
						$meta_title= array_slice($meta_title,0, count($meta_title)-1);
						
						$meta_type=array();
						$meta_type=explode('***',$par->meta_type);
						$meta_type= array_slice($meta_type,0, count($meta_type)-1);
						
						$meta_url=array();
						$meta_url=explode('***',$par->meta_url);
						$meta_url= array_slice($meta_url,0, count($meta_url)-1);
						
						$meta_image=array();
						$meta_image=explode('***',$par->meta_image);
						$meta_image= array_slice($meta_image,0, count($meta_image)-1);
						
						$meta_site_name=array();
						$meta_site_name=explode('***',$par->meta_site_name);
						$meta_site_name= array_slice($meta_site_name,0, count($meta_site_name)-1);
						
						$meta_description=array();
						$meta_description=explode('***',$par->meta_description);
						$meta_description= array_slice($meta_description,0, count($meta_description)-1);
						
						$meta_admins=array();
						$meta_admins=explode('***',$par->meta_admins);
						$meta_admins= array_slice($meta_admins,0, count($meta_admins)-1);
						
						//$meta_app_id=array();
						//$meta_app_id=explode('***',$par->meta_app_id);
						//$meta_app_id= array_slice($meta_app_id,0, count($meta_app_id)-1);
						
						 
						
						 if($meta_type[$k]=="Chose a type")
							$meta_type[$k]="";
							
						 $tag_title     	= trim('<meta property="og:title"     	content="'.(htmlspecialchars($meta_title[$k])? htmlspecialchars($meta_title[$k]) : $row->title).'" />' ); 
						 $tag_type      	= trim('<meta property="og:type"      	content="'.(htmlspecialchars($meta_type[$k]) ? htmlspecialchars($meta_type[$k]) : 'website').'" />' ); 
						 $tag_url      	 	= trim('<meta property="og:url"       	content="'.(htmlspecialchars($meta_url[$k]) ? htmlspecialchars($meta_url[$k]) : $url).'" />' ); 
						 $tag_image     	= trim('<meta property="og:image"     	content="'.(htmlspecialchars($meta_image[$k]) ? htmlspecialchars($meta_image[$k]) : $par->def_img_art).'" />' ); 
						 $tag_site_name 	= trim('<meta property="og:site_name" 	content="'.htmlspecialchars($meta_site_name[$k]).'" />' );
						 $tag_description 	= trim('<meta property="og:description" content="'.htmlspecialchars($meta_description[$k]).'" />' );
						 
						 if($meta_admins[$k])
							$tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($meta_admins[$k]).'"/>' );
						 else
							$tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
							  
						 if($value_title)  
						 	echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';
						 else
						 	echo $tag_title;
							
						 if($value_type!='Chose a type') 	
						 	echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
						 else
						  	echo $tag_type;
							
						 if($value_url)
						 	echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"/>';
						 else
						 	 echo $tag_url;
						 if($value_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
						 else
						 {
							 if($facebook_featured_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
							else
							{
								echo $tag_image;
							}
						 }
						 if($value_site_name)
						 	echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_site_name).'"/>';
						 else
						 	echo $tag_site_name;
						if($value_description)
						 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
						 else
						 echo $tag_description;	
						 
						 if($value_admin_id)
							echo 	$tag_app_id    = trim('<meta property="fb:admins"    content="hhh'.htmlspecialchars($value_admin_id).'"/>' );
						 else
							echo $tag_app_id;	  
							  
							  
							  
						
						
						
					}
					
				}	
				else
				{
					if(($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description && $value_admin_id) || ($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description)){
					 	if($value_title)
						 echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';
						if($value_type != 'Chose a type')
						 echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
						 if($value_url)
						 echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"';
						 
						 if($value_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
						 else
						 if($facebook_featured_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
							if($value_site_name)
						 echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_title).'"/>';
						 if($value_description)
						 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
						 	
						 if($value_admin_id)
							echo $tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($value_admin_id).'"/>' );
						 else
							echo $tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
											
					}
				}						 
			}
		}
	}
		if($post->post_type=='page'){
		$query ="SELECT * FROM ".$wpdb->prefix."spiderfacebook_params WHERE (items LIKE '%***".$post->ID."***%' OR items='all') AND `published`=1 ";
		$param=$wpdb->get_results($query);
		$get_post_for_facebook_id=get_post($post->ID);
		
		$facebook_featured_image=(preg_match('~\bsrc="([^"]++)"~', get_the_post_thumbnail($post->ID,'thumbnail'), $matches)) ? $matches[1] : '';
		
		$pattern ='[\[spider_facebook id="([0-9]*)"\]]';
		$count_facebook_in_post=preg_match_all ( $pattern, $post->post_content, $matches_spider_face);
		if(!$count_facebook_in_post)
		{
			if(!count($param))
			return;
		}
		else
		{
			if(!count($param)){
			$matches_spider_face[1][0];
			$query ="SELECT * FROM ".$wpdb->prefix."spiderfacebook_params WHERE id=".$matches_spider_face[1][0]."";
			$par=$wpdb->get_row($query);
			}
		}
		
		$value_title 		= get_post_meta( $post->ID, '_spider_facebok_title_meta_value', true );
		$value_type 		= get_post_meta( $post->ID, '_spider_facebok_type_meta_value',true);
		$value_url 			= get_post_meta( $post->ID, '_spider_facebok_url_meta_value',true);
		$value_image 		= get_post_meta( $post->ID, '_spider_facebok_image_meta_value',true );
		$value_site_name 	= get_post_meta( $post->ID, '_spider_facebok_site_name_meta_value', true );
		$value_description	= get_post_meta( $post->ID, '_spider_facebok_description_meta_value',true );
		$value_admin_id 	= get_post_meta( $post->ID, '_spider_facebok_admin_id_meta_value', true );		
			
		$url=get_permalink();
		$lang=get_bloginfo('language','en-US');
		if(!count($param))
		{			
				 
				 if($value_title)
				 echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';
				 if($value_type!='Chose a type')	
				 echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
				 if($value_url)
				 echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"/>';
				 
				 if($value_image)
					echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
				 else
				 if($facebook_featured_image)
					echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
					
				if($value_site_name)
				 echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_site_name).'"/>';
				 if($value_description)
				 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
					
				 if($value_admin_id)
					echo $tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($value_admin_id).'"/>' );
				 else
					echo $tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
							
									
							 
			
	
			
			
		}
		else
		for($i=0, $n=count($param); $i < $n ; $i++){
			$par = $param[$i];			
			if($par->published!=0){			
				if(($par->type=='likebutton' || $par->type=='sendbutton' || $par->type=='comment') && $par->items!='all'){
					if(($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description && $value_admin_id) || ($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description)){
					 	 echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';	
						 if($value_type!='Chose a type')
						 echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
						 echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"/>';
						 
						 if($value_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
						 else
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
							
						 echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_title).'"/>';
						 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
						 	
						 if($value_admin_id)
							echo 	$tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($value_admin_id).'"/>' );
						 else
							echo $tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
											
					}
					else{										
						
						$arts_id=array();
						$arts_id=explode('***',$par->items);
						$arts_id= array_slice($arts_id,1, count($arts_id)-2); 
						foreach($arts_id as $key => $art_id){
							if($post->ID==$art_id){
								$k=$key;
							}
						}
											
						$meta_title=array();
						$meta_title=explode('***',$par->item_meta_title);
						$meta_title= array_slice($meta_title,0, count($meta_title)-1);
						
						$meta_type=array();
						$meta_type=explode('***',$par->item_meta_type);
						$meta_type= array_slice($meta_type,0, count($meta_type)-1);
						
						$meta_url=array();
						$meta_url=explode('***',$par->item_meta_url);
						$meta_url= array_slice($meta_url,0, count($meta_url)-1);
						
						$meta_image=array();
						$meta_image=explode('***',$par->item_meta_image);
						$meta_image= array_slice($meta_image,0, count($meta_image)-1);
						
						$meta_site_name=array();
						$meta_site_name=explode('***',$par->item_meta_site_name);
						$meta_site_name= array_slice($meta_site_name,0, count($meta_site_name)-1);
						
						$meta_description=array();
						$meta_description=explode('***',$par->item_meta_description);
						$meta_description= array_slice($meta_description,0, count($meta_description)-1);
						
						$meta_admins=array();
						$meta_admins=explode('***',$par->item_meta_admins);
						$meta_admins= array_slice($meta_admins,0, count($meta_admins)-1);
						
						//$meta_app_id=array();
						//$meta_app_id=explode('***',$par->meta_app_id);
						//$meta_app_id= array_slice($meta_app_id,0, count($meta_app_id)-1);
						
						 
						
						 if($meta_type[$k]=="Chose a type")
							$meta_type[$k]="";
							
						 $tag_title     	= trim('<meta property="og:title"     	content="'.(htmlspecialchars($meta_title[$k])? htmlspecialchars($meta_title[$k]) : $row->title).'" />' ); 
						 $tag_type      	= trim('<meta property="og:type"      	content="'.(htmlspecialchars($meta_type[$k]) ? htmlspecialchars($meta_type[$k]) : 'website').'" />' ); 
						 $tag_url      	 	= trim('<meta property="og:url"       	content="'.(htmlspecialchars($meta_url[$k]) ? htmlspecialchars($meta_url[$k]) : $url).'" />' ); 
						 $tag_image     	= trim('<meta property="og:image"     	content="'.(htmlspecialchars($meta_image[$k]) ? htmlspecialchars($meta_image[$k]) : $par->def_img_item).'" />' ); 
						 $tag_site_name 	= trim('<meta property="og:site_name" 	content="'.htmlspecialchars($meta_site_name[$k]).'" />' );
						 $tag_description 	= trim('<meta property="og:description" content="'.htmlspecialchars($meta_description[$k]).'" />' );
						 
						 if($meta_admins[$k])
							$tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($meta_admins[$k]).'"/>' );
						 else
							$tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
							  
						 if($value_title)  
						 	echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';
						 else
						 	echo $tag_title;
							
						 if($value_type!='Chose a type') 	
						 	echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
						 else
						  	echo $tag_type;
							
						 if($value_url)
						 	echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"/>';
						 else
						 	 echo $tag_url;
						 if($value_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
						 else
						 {
							 if($facebook_featured_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
							else
							{
								echo $tag_image;
							}
						 }
						 if($value_site_name)
						 	echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_site_name).'"/>';
						 else
						 	echo $tag_site_name;
						if($value_description)
						 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
						 else
						 echo $tag_description;	
						 
						 if($value_admin_id)
							echo 	$tag_app_id    = trim('<meta property="fb:admins"    content="hhh'.htmlspecialchars($value_admin_id).'"/>' );
						 else
							echo $tag_app_id;	  
							  
							  
							  
						
						
						
					}
					
				}	
				else
				{
					if(($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description && $value_admin_id) || ($value_title && $value_type && $value_url && ($value_image || $facebook_featured_image) && $value_site_name && $value_description)){
					 	if($value_title)
						 echo '<meta property="og:title"     	content="'.htmlspecialchars($value_title).'"/>';
						if($value_type != 'Chose a type')
						 echo '<meta property="og:type"     	content="'.htmlspecialchars($value_type).'"/>';
						 if($value_url)
						 echo '<meta property="og:url"     	content="'.htmlspecialchars($value_url).'"';
						 
						 if($value_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($value_image).'"/>';
						 else
						 if($facebook_featured_image)
						 	echo '<meta property="og:image"     	content="'.htmlspecialchars($facebook_featured_image).'"/>';
						 if($value_site_name)
						 echo '<meta property="og:site_name"     	content="'.htmlspecialchars($value_title).'"/>';
						 if($value_description)
						 echo '<meta property="og:description"     	content="'.htmlspecialchars($value_description).'"/>';
						 	
						 if($value_admin_id)
							echo $tag_app_id    = trim('<meta property="fb:admins"    content="'.htmlspecialchars($value_admin_id).'"/>' );
						 else
							echo $tag_app_id    = trim('<meta property="fb:app_id"    content="'.$par->appid.'" />' ); 
											
					}
				}
						 
			}
		}
	}		
}
add_filter('wp_head', 'spider_facebook_front_meta',2);
?>