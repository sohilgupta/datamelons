<?php

return array(
	'id'          => 'slider_option',
	'types'       => array('slider'),
	'title'       => __('Slider Options', 'textdomain_simple'),
	'priority'    => 'high',
	'template'    => array(
				
				// Text Title
					array(
						'type' => 'textbox',
						'name' => 'slider_title',
						'label' => __('Title', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => '',
					),
				// Text Title
				
				// Title Position
				array(
					'type' => 'slider',
					'name' => 'slider_title_position',
					'label' => __('Title Position', 'vp_textdomain'),
					'description' => __('', 'vp_textdomain'),
					'min' => '1',
					'max' => '100',
					'step' => '1',
					'default' => '15',
					),
				// Title Position
				
				// Text Description
					array(
						'type' => 'textarea',
						'name' => 'slider_description',
						'label' => __('Description', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => '',
					),
				// Text Description
				
				// Description Position
				array(
					'type' => 'slider',
					'name' => 'slider_desc_position',
					'label' => __('Description Position', 'vp_textdomain'),
					'description' => __('', 'vp_textdomain'),
					'min' => '1',
					'max' => '100',
					'step' => '1',
					'default' => '1',
					),
				// Description Position
				
				// Button Title
					array(
						'type' => 'textbox',
						'name' => 'slider_button',
						'label' => __('Button Text', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => 'Learn More',
					),
				// Button Title
				
				// Button URL
					array(
						'type' => 'textbox',
						'name' => 'slider_button_link',
						'label' => __('Button Link', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => 'http://',
					),
				// Button URL
				
				// Button Position
				array(
					'type' => 'slider',
					'name' => 'slider_button_position',
					'label' => __('Button Position', 'vp_textdomain'),
					'description' => __('', 'vp_textdomain'),
					'min' => '1',
					'max' => '100',
					'step' => '1',
					'default' => '1',
					),
				// Button Position
				
				// Image Position
				array(
					'type' => 'slider',
					'name' => 'slider_image_position',
					'label' => __('Image Position', 'vp_textdomain'),
					'description' => __('', 'vp_textdomain'),
					'min' => '1',
					'max' => '100',
					'step' => '1',
					'default' => '40',
					),
				// Image Position
				
	));

/**
 * EOF
 */