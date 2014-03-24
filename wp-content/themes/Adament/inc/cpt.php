<?php 
// Register Custom Post Type
function portfolio_type() {

	$labels = array(
		'name'                => 'Portfolios',
		'singular_name'       => 'Portfolio',
		'menu_name'           => 'Portfolio',
		'parent_item_colon'   => 'Parent Portfolio:',
		'all_items'           => 'All Portfolios',
		'view_item'           => 'View Portfolio',
		'add_new_item'        => 'Add New Portfolio',
		'add_new'             => 'New Portfolio',
		'edit_item'           => 'Edit Portfolio',
		'update_item'         => 'Update Portfolio',
		'search_items'        => 'Search Portfolios',
		'not_found'           => 'No Portfolio found',
		'not_found_in_trash'  => 'No Portfolio found in Trash',
	);
	$args = array(
		'label'               => 'portfolio',
		'description'         => 'Portfolio items',
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'portfolio', $args );

}

// Hook into the 'init' action
add_action( 'init', 'portfolio_type', 0 );


// Register Custom Taxonomy
function genre_taxonomy()  {

	$labels = array(
		'name'                       => 'Genres',
		'singular_name'              => 'Genre',
		'menu_name'                  => 'Genre',
		'all_items'                  => 'All Genres',
		'parent_item'                => 'Parent Genre',
		'parent_item_colon'          => 'Parent Genre:',
		'new_item_name'              => 'New Genre Name',
		'add_new_item'               => 'Add New Genre',
		'edit_item'                  => 'Edit Genre',
		'update_item'                => 'Update Genre',
		'separate_items_with_commas' => 'Separate genres with commas',
		'search_items'               => 'Search genres',
		'add_or_remove_items'        => 'Add or remove genres',
		'choose_from_most_used'      => 'Choose from the most used genres',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'genre', 'portfolio', $args );

}

// Hook into the 'init' action
add_action( 'init', 'genre_taxonomy', 0 );







//-----------------//


function slide_type() {

	$labels = array(
		'name'                => 'Slides',
		'singular_name'       => 'Slide',
		'menu_name'           => 'Slide',
		'parent_item_colon'   => 'Parent Slide:',
		'all_items'           => 'All Slides',
		'view_item'           => 'View Slide',
		'add_new_item'        => 'Add New Slide',
		'add_new'             => 'New Slide',
		'edit_item'           => 'Edit Slide',
		'update_item'         => 'Update Slide',
		'search_items'        => 'Search Slides',
		'not_found'           => 'No Slide found',
		'not_found_in_trash'  => 'No Slide found in Trash',
	);
	$args = array(
		'label'               => 'slide',
		'description'         => 'Slideshow',
		'labels'              => $labels,
		'supports'            => array('title', 'thumbnail', ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'slide', $args );

}

// Hook into the 'init' action
add_action( 'init', 'slide_type', 0 );