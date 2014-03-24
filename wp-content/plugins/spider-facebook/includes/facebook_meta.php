<?php
////////////////////// add meta boxs for page and posts
add_action( 'add_meta_boxes', 'spider_facebook_meta_boxs' );
/* Do something with the data entered */
add_action( 'save_post', 'myplugin_save_postdata' );
/* Adds a box to the main column on the Post and Page edit screens */
function spider_facebook_meta_boxs() {
    $screens = array( 'post', 'page' );
    foreach ($screens as $screen) {
        add_meta_box('spider_facebook_meta',__( 'Spider Facebook', 'spider_facebook' ),'spider_facebook_metadate', $screen  );
    }
}
/* Prints the box content */
function spider_facebook_metadate( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  
  $value_title 		= get_post_meta( $post->ID, '_spider_facebok_title_meta_value', true );
  $value_type 		= get_post_meta( $post->ID, '_spider_facebok_type_meta_value',true);
  $value_url 		= get_post_meta( $post->ID, '_spider_facebok_url_meta_value',true);
  $value_image 		= get_post_meta( $post->ID, '_spider_facebok_image_meta_value',true );
  $value_site_name 	= get_post_meta( $post->ID, '_spider_facebok_site_name_meta_value', true );
  $value_description= get_post_meta( $post->ID, '_spider_facebok_description_meta_value',true );
  $value_admin_id 	= get_post_meta( $post->ID, '_spider_facebok_admin_id_meta_value', 'aaaaaaaaa' );
  ?>
<table id="newmeta">
    <thead>
        <tr>
            <th ><label for="metakeyselect">TITLE</label></th>
            <th><label for="metavalue">TYPE</label></th>
            <th ><label for="metakeyselect">URL</label></th>
            <th><label for="metavalue">IMAGE</label></th>
            <th ><label for="metakeyselect">SITE NAME</label></th>
            <th><label for="metavalue">DESCRIPTION</label></th>
            <th><label for="metavalue">ADMIN ID</label></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
            	<input type="text" id="spider_facebook_title" name="spider_facebook_title"  style="width:100%" value="<?php echo $value_title; ?>">
            </td>
            <td>
                <select  style="width:110px" id="spider_facebook_type" name="spider_facebook_type">
                    <option  value="Chose a type">Chose a type</option>
                    <option <?php if($value_type=='activity') echo 'selected="selected"'; ?> value="activity">activity</option>
                    <option <?php if($value_type=='actor') echo 'selected="selected"'; ?> value="actor">actor</option>
                    <option <?php if($value_type=='album') echo 'selected="selected"'; ?> value="album">album</option>
                    <option <?php if($value_type=='article') echo 'selected="selected"'; ?> value="article">article</option>
                    <option <?php if($value_type=='athlete') echo 'selected="selected"'; ?> value="athlete">athlete</option>
                    <option <?php if($value_type=='author') echo 'selected="selected"'; ?> value="author">author</option>
                    <option <?php if($value_type=='band') echo 'selected="selected"'; ?> value="band">band</option>
                    <option <?php if($value_type=='bar') echo 'selected="selected"'; ?> value="bar">bar</option>
                    <option <?php if($value_type=='blog') echo 'selected="selected"'; ?> value="blog">blog</option>
                    <option <?php if($value_type=='book') echo 'selected="selected"'; ?> value="book">book</option>
                    <option <?php if($value_type=='cafe') echo 'selected="selected"'; ?> value="cafe">cafe</option>
                    <option <?php if($value_type=='cause') echo 'selected="selected"'; ?> value="cause">cause</option>
                    <option <?php if($value_type=='city') echo 'selected="selected"'; ?> value="city">city</option>
                    <option <?php if($value_type=='company') echo 'selected="selected"'; ?> value="company">company</option>
                    <option <?php if($value_type=='country') echo 'selected="selected"'; ?> value="country">country</option>
                    <option <?php if($value_type=='director') echo 'selected="selected"'; ?> value="director">director</option>
                    <option <?php if($value_type=='drink') echo 'selected="selected"'; ?> value="drink">drink</option>
                    <option <?php if($value_type=='food') echo 'selected="selected"'; ?> value="food">food</option>
                    <option <?php if($value_type=='game') echo 'selected="selected"'; ?> value="game">game</option>
                    <option <?php if($value_type=='government') echo 'selected="selected"'; ?> value="government">government</option>
                    <option <?php if($value_type=='hotel') echo 'selected="selected"'; ?> value="hotel">hotel</option>
                    <option <?php if($value_type=='landmark') echo 'selected="selected"'; ?> value="landmark">landmark</option>
                    <option <?php if($value_type=='movie') echo 'selected="selected"'; ?> value="movie">movie</option>
                    <option <?php if($value_type=='musician') echo 'selected="selected"'; ?> value="musician">musician</option>
                    <option <?php if($value_type=='non_profit') echo 'selected="selected"'; ?> value="non_profit">non_profit</option>
                    <option <?php if($value_type=='politician') echo 'selected="selected"'; ?> value="politician">politician</option>
                    <option <?php if($value_type=='product') echo 'selected="selected"'; ?> value="product">product</option>
                    <option <?php if($value_type=='public_figure') echo 'selected="selected"'; ?> value="public_figure">public_figure</option>
                    <option <?php if($value_type=='restaurant') echo 'selected="selected"'; ?> value="restaurant">restaurant</option>
                    <option <?php if($value_type=='school') echo 'selected="selected"'; ?> value="school">school</option>
                    <option <?php if($value_type=='song') echo 'selected="selected"'; ?> value="song">song</option>
                    <option <?php if($value_type=='sport') echo 'selected="selected"'; ?> value="sport">sport</option>
                    <option <?php if($value_type=='sports_league') echo 'selected="selected"'; ?> value="sports_league">sports_league</option>
                    <option <?php if($value_type=='sports_team') echo 'selected="selected"'; ?> value="sports_team">sports_team</option>
                    <option <?php if($value_type=='state_province') echo 'selected="selected"'; ?> value="state_province">state_province</option>
                    <option <?php if($value_type=='tv_show') echo 'selected="selected"'; ?> value="tv_show">tv_show</option>
                    <option <?php if($value_type=='university') echo 'selected="selected"'; ?> value="university">university</option>
                    <option <?php if($value_type=='website') echo 'selected="selected"'; ?> value="website">website</option>
                </select>            	
            </td>
            <td>
            	<input type="text" id="spider_facebook_url" name="spider_facebook_url" style="width:100%" value="<?php echo $value_url; ?>">
            </td>
            <td>
            	<input type="text" id="spider_facebook_image" name="spider_facebook_image"  style="width:100%" value="<?php echo $value_image; ?>">
            </td>
            <td>
            	<input type="text" id="spider_facebook_site_name" name="spider_facebook_site_name"  style="width:100%" value="<?php echo  $value_site_name; ?>">
            </td>
            <td>
            	<input type="text" id="spider_facebook_description" name="spider_facebook_description"  style="width:100%" value="<?php echo $value_description; ?>">
            </td>
             <td>
            	<input type="text" id="spider_facebook_admin_id" name="spider_facebook_admin_id"  style="width:100%" value="<?php echo $value_admin_id; ?>">
            </td>
            
        </tr>
        
        
    </tbody>
</table>
  
  
  <?php
}
/* When the post is saved, saves our custom data */
function myplugin_save_postdata( $post_id ) {
  // First we need to check if the current user is authorised to do this action. 
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }
  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['myplugin_noncename'] ) || ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;
  // Thirdly we can save the value to the database
 $value_title = '';
  $value_type = '';
  $value_url = '';
  $value_image ='';
  $value_site_name ='';
  $value_description ='';
  $value_admin_id = '';
	if(isset($_POST['spider_facebook_title']))
		$value_title=$_POST['spider_facebook_title'];
		
	if(isset($_POST['spider_facebook_type']))
		$value_type=$_POST['spider_facebook_type'];
		
	if(isset($_POST['spider_facebook_url']))
		$value_url=$_POST['spider_facebook_url'];
		
	if(isset($_POST['spider_facebook_image']))
		$value_image=$_POST['spider_facebook_image'];
		
	if(isset($_POST['spider_facebook_site_name']))
		$value_site_name=$_POST['spider_facebook_site_name'];
		
	if(isset($_POST['spider_facebook_description']))
		$value_description=$_POST['spider_facebook_description'];
		
	if(isset($_POST['spider_facebook_admin_id']))
		$value_admin_id=$_POST['spider_facebook_admin_id'];
	
  	add_post_meta($post_id, '_spider_facebok_title_meta_value', $value_title, true) or   update_post_meta($post_id, '_spider_facebok_title_meta_value', $value_title);
	add_post_meta($post_id, '_spider_facebok_type_meta_value', $value_type, true) or  update_post_meta($post_id, '_spider_facebok_type_meta_value', $value_type);
	add_post_meta($post_id, '_spider_facebok_url_meta_value', $value_url, true) or  update_post_meta($post_id, '_spider_facebok_url_meta_value', $value_url);
	add_post_meta($post_id, '_spider_facebok_image_meta_value', $value_image, true) or  update_post_meta($post_id, '_spider_facebok_image_meta_value',$value_image);
	add_post_meta($post_id, '_spider_facebok_site_name_meta_value', $value_site_name, true) or  update_post_meta($post_id, '_spider_facebok_site_name_meta_value', $value_site_name);
	add_post_meta($post_id, '_spider_facebok_description_meta_value', $value_description, true) or  update_post_meta($post_id, '_spider_facebok_description_meta_value', $value_description);
	add_post_meta($post_id, '_spider_facebok_admin_id_meta_value', $value_admin_id, true) or  update_post_meta($post_id, '_spider_facebok_admin_id_meta_value', $value_admin_id);
}
