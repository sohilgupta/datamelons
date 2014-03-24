<?php

// Set Image Path
$imgpath = get_template_directory_uri().'/images/';
$vafpresspath = get_template_directory_uri().'/vafpress/public/img/';

// Start Options
return array(
	'title' => __('SmartPanel Options', 'textdomain_simple'),
	'page' => __('SmartPanel', 'textdomain_simple'),
	'logo' => '',
	'menus' => array(
	
	
	
			/* =============== Menu - General Settings ====================== */
			array(
			'title' => __('General Settings', 'textdomain_simple'),
			'name' => 'menu_1',
			'icon' => 'font-awesome:icon-gears',
			'controls' => array(
				
				// Start Logo Upload
					array(
						'type' => 'upload',
						'name' => 'logo',
						'label' => __('Upload Theme Logo', 'textdomain_simple'),
						'description' => __('Upload Your Theme Logo', 'textdomain_simple'),
						'default' => $imgpath.'logo-dark.png',
					),
				// End Logo Upload


				// Start Company Email
					array(
						'type' => 'textbox',
						'name' => 'companyemail',
						'label' => __('Company Email', 'textdomain_simple'),
						'description' => __('Set your company Email', 'textdomain_simple'),
						'default' => '',
						'validation' => 'email',
					),
				// Start Company Email
				
				
				// Start Company Number
					array(
						'type' => 'textbox',
						'name' => 'companynumber',
						'label' => __('Company Number', 'textdomain_simple'),
						'description' => __('Set your company number', 'textdomain_simple'),
						'default' => '',
					),
				// Start Company Number

				
				// Start Footer Copyright
					array(
						'type' => 'textarea',
						'name' => 'copyright',
						'label' => __('Copyright Text', 'textdomain_simple'),
						'description' => __('Set your copyright notice', 'textdomain_simple'),
						'default' => '&copy; Copyright 2013 Simple. All Rights Reserved.',
					),
				// End Footer Copyright
					
				// Enable Post Author
					array(
						'type' => 'toggle',
						'name' => 'post_author',
						'label' => __('Enable Post Author', 'textdomain_simple'),
						'description' => __('Do you want to enable who posted the article each post?', 'textdomain_simple'),
						'default' => '0',
					),
				// Enable Post Author
				
				// Enable Header Toolbar
					array(
						'type' => 'toggle',
						'name' => 'enable_top_toolbar',
						'label' => __('Enable header toolbar', 'textdomain_simple'),
						'description' => __('Do you want to enable the header top toolbar?', 'textdomain_simple'),
						'default' => '0',
					),
				// Enable Header Toolbar
				

						)),
			/* =============== Menu - General Settings ====================== */
			
			
			
			
			/* =============== Menu - Layout Manager ====================== */
			array(
			'title' => __('Styling Options', 'textdomain_simple'),
			'name' => 'menu_2',
			'icon' => 'font-awesome:icon-picture',
			'controls' => array(
				
				// Start Primary Color
				array(
					'type' => 'select',
					'name' => 'color_primary',
					'label' => __('Select Primary Color', 'textdomain_simple'),
					'items' => array(
						array(
							'value' => 'white',
							'label' => __('White', 'textdomain_simple'),
						),
						array(
							'value' => 'dark',
							'label' => __('Dark', 'textdomain_simple'),
						),
					),
					'default' => array(
						'dark',
					),
					'validation' => 'required',
				),
				// End Primary Color
				
				// Start Secondary Color
				array(
					'type' => 'select',
					'name' => 'color_secondary',
					'label' => __('Select Color Scheme', 'textdomain_simple'),
					'items' => array(
						array(
							'value' => 'red',
							'label' => __('Red', 'textdomain_simple'),
						),
						array(
							'value' => 'blue',
							'label' => __('Blue', 'textdomain_simple'),
						),
						array(
							'value' => 'green',
							'label' => __('Green', 'textdomain_simple'),
						),
						array(
							'value' => 'orange',
							'label' => __('Orange', 'textdomain_simple'),
						),
						array(
							'value' => 'turquoise',
							'label' => __('Turquoise', 'textdomain_simple'),
						),
					),
					'default' => array(
						'red',
					),
					'validation' => 'required',
				),
				// End Secondary Color
				
				// Start Secondary Color
				array(
					'type' => 'radiobutton',
					'name' => 'theme_layout',
					'label' => __('Theme Layout', 'textdomain_simple'),
					'items' => array(
						array(
							'value' => 'boxed',
							'label' => __('Boxed', 'textdomain_simple'),
						),
						array(
							'value' => 'wide',
							'label' => __('Wide', 'textdomain_simple'),
						),
					),
					'default' => array(
						'wide',
					),
					'validation' => 'required',
				),
				// End Secondary Color
			
					
					)),
			/* =============== Menu - Layout Manager ====================== */
			
			
			
			
			/* =============== Menu - Social Media Settings ====================== */
			array(
			'title' => __('Social Media Settings', 'textdomain_simple'),
			'name' => 'menu_3',
			'icon' => 'font-awesome:icon-group',
			'controls' => array(
					
				// Facebook
					array(
						'type' => 'textbox',
						'name' => 'facebook',
						'label' => __('Facebook page', 'textdomain_simple'),
						'description' => __('Enter your facebook URL', 'textdomain_simple'),
						'default' => '',
						'validation' => 'url',
					),
				// Facebook
				
				// Twitter
					array(
						'type' => 'textbox',
						'name' => 'twitter',
						'label' => __('Twitter Profile', 'textdomain_simple'),
						'description' => __('Enter your Twitter Profile URL', 'textdomain_simple'),
						'default' => '',
						'validation' => 'url',
					),
				// Twitter
				
				// Dribbble
					array(
						'type' => 'textbox',
						'name' => 'dribbble',
						'label' => __('Dribbble', 'textdomain_simple'),
						'description' => __('Enter your Dribbble URL', 'textdomain_simple'),
						'default' => '',
						'validation' => 'url',
					),
				// Dribbble
				
				// Google
					array(
						'type' => 'textbox',
						'name' => 'google',
						'label' => __('Google Plus', 'textdomain_simple'),
						'description' => __('Enter your google plus URL', 'textdomain_simple'),
						'default' => '',
						'validation' => 'url',
					),
				// Google
				
				// Pinterest
					array(
						'type' => 'textbox',
						'name' => 'pinterest',
						'label' => __('Pinterest', 'textdomain_simple'),
						'description' => __('Enter your pinterest profile', 'textdomain_simple'),
						'default' => '',
						'validation' => 'url',
					),
				// Pinterest
				
				// Youtube
					array(
						'type' => 'textbox',
						'name' => 'youtube',
						'label' => __('youtube', 'textdomain_simple'),
						'description' => __('Enter your YouTube Channel', 'textdomain_simple'),
						'default' => '',
						'validation' => 'url',
					),
				// Youtube
				
				// Enable Gmap
					array(
						'type' => 'toggle',
						'name' => 'enablerss',
						'label' => __('Enable RSS Feed', 'textdomain_simple'),
						'description' => __('Turn on RSS Feed?', 'textdomain_simple'),
						'default' => '0',
					),
				// Enable Gmap
				
				// Enable Header Icons
					array(
						'type' => 'toggle',
						'name' => 'enable_header_icons',
						'label' => __('Enable Header Social Icons', 'textdomain_simple'),
						'description' => __('Turn on RSS Feed?', 'textdomain_simple'),
						'default' => '0',
					),
				// Enable Header Icons
				
				// Enable Footer Icons
					array(
						'type' => 'toggle',
						'name' => 'enable_footer_icons',
						'label' => __('Enable Footer Social Icons', 'textdomain_simple'),
						'description' => __('Turn on RSS Feed?', 'textdomain_simple'),
						'default' => '0',
					),
				// Enable Footer Icons
				
					)),
			/* =============== Menu - Social Media Settings ====================== */		


	)
);

/**
 *EOF
 */