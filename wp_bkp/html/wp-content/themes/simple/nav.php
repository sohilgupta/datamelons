<?php if( has_nav_menu('header_menu') ){ ?>

	<?php wp_nav_menu( array(
		  	'theme_location' => 'header_menu',
			'container' => 'false',
			'items_wrap' => '<ul id="nav">%3$s</ul>',
	)); ?>
	
<?php }else{ ?>

Please Setup your nav menu <a href="wp-admin/nav-menus.php" style="text-transform:uppercase;">Click here</a>

<?php } ?>