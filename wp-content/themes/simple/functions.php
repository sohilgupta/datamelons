<?php
ob_start();

/* Includes */
require_once('vafpress/bootstrap.php');

/*-----------------------------------------------------------------------------------*/
/*	Load CSS Files
/*-----------------------------------------------------------------------------------*/
function theme_styles()  {  

		// Load CSS
		wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array());
		wp_enqueue_style( 'skin', get_template_directory_uri() . '/css/skins/'.vp_option('color_primary').'.css', array());
		wp_enqueue_style( 'color', get_template_directory_uri() . '/css/skins/colors/'.vp_option('color_secondary').'.css', array());
		wp_enqueue_style( 'layout', get_template_directory_uri() . '/css/layout/'.vp_option('theme_layout').'.css', array());
		
    }
add_action( 'wp_enqueue_scripts', 'theme_styles' );






/*-----------------------------------------------------------------------------------*/
/*	Load Jquery Files
/*-----------------------------------------------------------------------------------*/
function theme_scripts() {
	
	// Load Responsive Navigation
	wp_enqueue_script( 'jquery-file', get_template_directory_uri() . '/js/jquery-1.9.1.min.js', array(), true, true);
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.min.js', array(), true, true);
	wp_enqueue_script( 'ui-core', get_template_directory_uri() . '/js/jquery-ui/jquery.ui.core.js', array(), true, true);
	wp_enqueue_script( 'ui-widget', get_template_directory_uri() . '/js/jquery-ui/jquery.ui.widget.js', array(), true, true);
	wp_enqueue_script( 'ui-accordion', get_template_directory_uri() . '/js/jquery-ui/jquery.ui.accordion.js', array(), true, true);
	wp_enqueue_script( 'cookie', get_template_directory_uri() . '/js/jquery-cookie.js', array(), true, true);
	wp_enqueue_script( 'ddsmoothmenu', get_template_directory_uri() . '/js/ddsmoothmenu.js', array(), true, true);
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), true, true);
	wp_enqueue_script( 'colortip', get_template_directory_uri() . '/js/colortip.js', array(), true, true);
	wp_enqueue_script( 'tytabs', get_template_directory_uri() . '/js/tytabs.js', array(), true, true);
	wp_enqueue_script( 'totop', get_template_directory_uri() . '/js/jquery.ui.totop.js', array(), true, true);
	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/carousel.js', array(), true, true);
	wp_enqueue_script( 'isotop', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), true, true);
	wp_enqueue_script( 'tweets', get_template_directory_uri() . '/js/twitter/jquery.tweet.js', array(), true, true);
	wp_enqueue_script( 'flickrfeed', get_template_directory_uri() . '/js/jflickrfeed.min.js', array(), true, true);
	wp_enqueue_script( 'social-options', get_template_directory_uri() . '/js/social-options.js', array(), true, true);
	wp_enqueue_script( 'double-tap', get_template_directory_uri() . '/js/doubletaptogo.js', array(), true, true);
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.js', array(), true, true);
	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), true, true);
	wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom.js', array(), true, true);
	
	// Load Comment Script
	if( is_single() ){ 
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );




/*-----------------------------------------------------------------------------------*/
/*	Register Navigation Menu
/*-----------------------------------------------------------------------------------*/

/* Main Nav Menu */
register_nav_menu( 'header_menu','Navigation Menu for Header' );




/*-----------------------------------------------------------------------------------*/
/*	Featured Images and Image Sizes
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 960;
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

/* Blog Image Size */
add_image_size( 'blog', 640,259, true );

/* Slider Image Sizes */
add_image_size( 'slider', 434,393, true );

/* Portfolio Image Sizes */
add_image_size( 'portfolio-thumb', 420,336, true );
add_image_size( 'portfolio-single', 700,500, true );


/*-----------------------------------------------------------------------------------*/
/*	Custom Posts
/*-----------------------------------------------------------------------------------*/

/* Sliders Custom Post */
	register_post_type( 'slider', /* this can be seen at the URL as a parameter and a unique id for the custom post */
		array(
			'labels' => array(
				'name' => __( 'Sliders','textdomain_simple' ), /* The Label of the custom post */
				'singular_name' => __( "Slider", 'textdomain_simple' ) /* The Label of the custom post */
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slider'), /* The slug of the custom post */
			'supports' => array( 'title', 'thumbnail' ), /* enable basic for text editing */
		)
	);
	
/* Portfolio Custom Posts */
	register_post_type( 'portfolio', /* this can be seen at the URL as a parameter and a unique id for the custom post */
		array(
			'labels' => array(
				'name' => __( 'Portfolio','textdomain_simple' ), /* The Label of the custom post */
				'singular_name' => __( "All Portfolio", 'textdomain_simple' ) /* The Label of the custom post */
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio'), /* The slug of the custom post */
			'supports' => array( 'title', 'thumbnail' ), /* enable basic for text editing */
		)
	);

/* Portfolio Taxonomies/Categories */
function portfolio_taxonomie() {

	register_taxonomy(
		'portfolio',
		array( 'portfolio' ),
		array(
			'public' => true,
			'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Portfolio Category', 'textdomain_topbest' ),
				'singular_name' => __( 'Porfolio Category', 'textdomain_topbest' )
			),
		)
	);
}
add_action( 'init', 'portfolio_taxonomie', 0 );

/*-----------------------------------------------------------------------------------*/
/*	Add Sidebars
/*-----------------------------------------------------------------------------------*/
/* Blog Single */
if ( function_exists('register_sidebar') )
	register_sidebars(1,array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div class="widget categories">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title bottom-1">',
		'after_title'   => '</h3>',
	));
	
/* Footer Widget */
if ( function_exists('register_sidebar') )
	register_sidebars(1,array(
		'name' => 'Footer Widget',
		'before_widget' => '<div class="one-third column widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>',
	));



/*------------------------------------------------------------------------------------------------------------------------------*/
/* ---------------------------------------------------- Custom Functions -------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Function for Views Count
/*-----------------------------------------------------------------------------------*/
function countviews( $postid ){
	
	$meta_key = 'popularity_count';
	$meta_value = get_post_meta( $postid, $meta_key, true );
	
	/* Update the value if on single page */
	if( is_single() ){
	update_post_meta( $postid, $meta_key, $meta_value+1 );
	}
	
	/* Show the post count */
	if( $meta_value <= '0' ){ 
		echo 'No Views';
	}else{
	echo $meta_value . ' Views';	
	}
}



/*-----------------------------------------------------------------------------------*/
/*	Function to Limit words and Filter Tags or elements
/*-----------------------------------------------------------------------------------*/
function content($num) {
$theContent = get_the_content();
$output = preg_replace('/<a[^>]+./','', $theContent);
$output = preg_replace('/<img[^>]+./','', $theContent);
$output = preg_replace( '/<div>.*<\/div>/', '', $output );
$output = preg_replace( '/<blockquote>.*<\/blockquote>/', '', $output );
$output = preg_replace( '/<h1>.*<\/h1>/', '', $output );
$output = preg_replace( '/<h2>.*<\/h2>/', '', $output );
$output = preg_replace( '/<h3>.*<\/h3>/', '', $output );
$output = preg_replace( '/<h4>.*<\/h4>/', '', $output );
$output = preg_replace( '/<h5>.*<\/h5>/', '', $output );
$output = preg_replace( '/<h6>.*<\/h6>/', '', $output );
$output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );
//$output = preg_replace('/<img[^>]+./','', $theContent);
$limit = $num+1;
$content = explode(' ', $output, $limit);
array_pop($content);
$content = implode(" ",$content).".";
echo $content;
	}


/*-----------------------------------------------------------------------------------*/
/*	Function for Pagination
/*  
/*  Credits goes to Kriesi ( http://www.kriesi.at )
/*-----------------------------------------------------------------------------------*/	
	function pagination($pages = '', $range = 2)
		{  
			$showitems = ($range * 2)+1;  
			
			global $paged;
			if(empty($paged)) $paged = 1;
			
			if($pages == '')
			{
				global $wp_query;
				$pages = $wp_query->max_num_pages;
				if(!$pages)
				{
					$pages = 1;
					}
				}   
			
			if(1 != $pages)
				{
			echo '<div class="pagination">';
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
					 
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
			
		for ($i=1; $i <= $pages; $i++)
			{
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
		echo ($paged == $i)? "<a href='#' class='current'>".$i."</a>":"<a href='".get_pagenum_link($i)."'>".$i."</a>";
			}
		}
			
		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</div>\n";
			}
		}
		
		
		
/*-----------------------------------------------------------------------------------*/
/*	Comments list Function
/*-----------------------------------------------------------------------------------*/

/* Fetch Comments */
function theme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        
		<li class="comment-box" id="div-comment-<?php comment_ID() ?>">
        <div class="avatar"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 60 ); ?></div>
        <div class="comment">
        <h5><?php printf(__('%s','textdomain_techblog'), get_comment_author_link()) ?></h5>
        
        <div class="date-replay">
        <?php printf( __('%1$s at %2$s', 'textdomain_techblog'), get_comment_date(),  get_comment_time()) ?>
         / <span class="color"><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], reply_text => 'Comment Reply'))) ?></span></div>
         
         
        <?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','textdomain_techblog') ?></em>
        <br /><br />
        <?php endif; ?>
        
        <?php comment_text() ?>
        <?php edit_comment_link(__('(Edit)','textdomain_techblog'),'  ','' ); ?>
        
        </div>  
        </li><!-- End Parent -->   

<?php }



/*-----------------------------------------------------------------------------------*/
/*	Shortcodes
/*-----------------------------------------------------------------------------------*/


// ----------- Separator -----------
// [simple_separator]
function shortcode_simple_separator() {

	// Code
	return '<div class="sixteen columns"><hr class="line bottom-3"></div><!-- End line -->';

}
add_shortcode( 'simple_separator', 'shortcode_simple_separator' );




// ----------- Sliders -----------
// [simple_slider]
function shortcode_simple_slider() {

	// Code
	ob_start();
	get_template_part('includes/slider');
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode( 'simple_slider', 'shortcode_simple_slider' );




// ----------- Recent Portfolio -----------
//[simple_portfolio]
function shortcode_simple_portfolio( $atts ) {

	// Code
	ob_start();
	get_template_part('includes/recent-work');
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
	
}
add_shortcode( 'simple_portfolio', 'shortcode_simple_portfolio' );

// ----------- Recent Blog Posts -----------
//[simple_blog]
function shortcode_simple_blog( $atts ) {

	// Code
	ob_start();
	get_template_part('includes/recent-blog');
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
	
}
add_shortcode( 'simple_blog', 'shortcode_simple_blog' );


// ----------- Service Container -----------
// [simple_service_container] ... [/simple_service_container]
function shortcode_simple_service_container( $atts , $content = null ) {

	// Code
		return '
		<div class="services style-1 home bottom-3">
     	<div class="container clearfix">'
		.do_shortcode($content).
		'</div>
   		</div>';
	
}
add_shortcode( 'simple_service_container', 'shortcode_simple_service_container' );



// ----------- Service Item -----------
// [simple_service_item link="#" icon="icon-cogs" title='This is a title'] ... [/simple_service_item]
function shortcode_simple_service_item( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'link' => '#',
			'icon' => 'icon-cogs',
			'title' => 'This is a title',
		), $atts )
	);

	// Code
	return '<div class="one-third column">
				<div class="item">
					<div class="circle">
					<a href="'.$link.'">
						<i class="'.$icon.'"></i>
					</a>
					</div>
					
					<h3><a href="'.$link.'">'.$title.'</a></h3>
					<p>'.$content.'</p>
				</div>
       		</div>';
}
add_shortcode( 'simple_service_item', 'shortcode_simple_service_item' );


// ----------- Client Container -----------
// [simple_client_container title="Featured Clients"] ... [/simple_client_container]
function shortcode_simple_client_container( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'title' => 'Featured Clients',
		), $atts )
	);

	// Code
		return '
		<div class="container main-content clearfix">
		<div class="featured-clients clearfix bottom-2">
       	<div class="slidewrap4" >
    
        <div class="sixteen columns"> 
        <h3 class="title bottom-2">'.$title.'</h3> 
        </div>
        
        <ul class="slider" id="sliderName4">'
		.do_shortcode($content).
		'</ul>
		
      	</div>
     	</div>
     	</div>';
	
}
add_shortcode( 'simple_client_container', 'shortcode_simple_service_container' );




// ----------- Client Item -----------
// [simple_client_item link="" image=""]
function shortcode_simple_client_item( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'link' => 'http://themesmarts.com',
			'image' => '',
		), $atts )
	);

	// Code
	return '<li class="four columns item"><a href="'.$link.'"><img src="'.$image.'" /></a> </li>';
}
add_shortcode( 'simple_client_item', 'shortcode_simple_client_item' );

ob_end_clean();
?>