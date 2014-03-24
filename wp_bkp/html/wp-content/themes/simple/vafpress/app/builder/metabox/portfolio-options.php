<?php

return array(
	'id'          => 'portfolio_option',
	'types'       => array('portfolio'),
	'title'       => __('Portfolio Options', 'textdomain_simple'),
	'priority'    => 'high',
	'template'    => array(
				
				// Portfolio Description
				array(
					'type' => 'textarea',
					'name' => 'portfolio_desc',
					'label' => __('Portfolio Description', 'textdomain_simple'),
					'description' => __('', 'textdomain_simple'),
					'default' => '',
					),
				// Portfolio Description
				
				// Portfolio Link
					array(
						'type' => 'textbox',
						'name' => 'portfolio_link',
						'label' => __('Project Link', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => 'http://',
					),
				// Portfolio Link
				
				// Twitter Link
					array(
						'type' => 'textbox',
						'name' => 'portfolio_twitter',
						'label' => __('Twitter Link', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => 'http://',
					),
				// Twitter Link
				
				// Facebook Link
					array(
						'type' => 'textbox',
						'name' => 'portfolio_facebook',
						'label' => __('Facebook Link', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => 'http://',
					),
				// Facebook Link
				
				// GooglePlus Link
					array(
						'type' => 'textbox',
						'name' => 'portfolio_googleplus',
						'label' => __('GooglePlus Link', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => 'http://',
					),
				// GooglePlus Link
				
				// Pinterest Link
					array(
						'type' => 'textbox',
						'name' => 'portfolio_pinterest',
						'label' => __('Pinterest Link', 'textdomain_simple'),
						'description' => __('', 'textdomain_simple'),
						'default' => 'http://',
					),
				// Pinterest Link
	));

/**
 * EOF
 */