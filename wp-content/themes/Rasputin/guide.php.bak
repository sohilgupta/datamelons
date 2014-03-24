<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'w2f_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function w2f_theme_guide(){
		echo '
		
<div id="welcome-panel" class="welcome-panel">

	<div class="wpbadge" style="float:left; margin-right:30px; "><img src="'. get_template_directory_uri() . '/screenshot.png" width="200" height="150" /></div>

	<div class="welcome-panel-content">
	
	<h3>Welcome to '.wp_get_theme().' WordPress theme!</h3>
	
	<p class="about-description">Rasputin is a portfolio/agency type wordpress theme. This is a WordPress 3+ ready theme with features like custom menu, featured images,
	widgetized sidebar, and customizable call to action section , jQuery image slider on the custom homepage template. Theme also comes with an option panel. </p>
	
	<div class="welcome-panel-column-container">

		<div class="guide-panel-column" style="width:80%">
		<h4><span class="icon16 icon-settings"></span> Required plugins </h4>
		<p>The theme often requires few plugins to work the way it is originally intended to. You will find a notification on the admin panel prompting you to install the required plugins. Please install and activate the plugins.  </p>
		<ol>
			<li><a href="http://wordpress.org/extend/plugins/options-framework/">Options framework</a></li>
		</ol>
		</div>
	
	
		<div class="guide-panel-column" style="width:80%">
		<h4><span class="icon16 icon-settings"></span> Custom homepage template </h4>
		<p>The theme comes with a custom homepage template. You have to use the static front page feature under the reading settings. The following screencast shows the process   </p>
		<p><iframe src="http://www.screenr.com/embed/stI8" width="650" height="396" frameborder="0"></iframe></p>
		
		</div>
	
		<div class="guide-panel-column" style="width:80%">
		
		<h4><span class="icon16 icon-settings"></span> Theme options explained</h4>
		<p>The theme contains an options page using which you adjust various settings available on the theme. </p>
		<p><b>Site intro title: </b> You can enter a site intro message title on the homepage via the options page. </p>
		<p><b>Site intro text: </b>
		You can enter a site intro message on the homepage via the options page. </p>
		<p><b>Twitter name: </b>
		You can enter a twitter name to show the latest twitter status above the footer. </p>
		<p><b>Blog posts on homepage:</b>
		You can set the number of posts to show on the homepage. </p>
		<p><b>Header banner image:</b>
		Link for the header banner image </p>
		<p><b>Header banner link:</b>
		Link for the header banner </p>
		<p><b>Slider category:</b>
		Select a category for the jQuery image slider </p>
		<p><b>Number of slides:</b>
		Set a number for the slides </p>
		<p><b>Banner setting:</b>
		Configure the banner ads on the sidebar </p>

		</div>
	

				
		<div class="guide-panel-column" style="width:80%">
		<h4><span class="icon16 icon-settings"></span> Theme License </h4>
		<p>	The PHP code of the theme is licensed under the GPL license as is WordPress itself. You can read it here: http://codex.wordpress.org/GPL.All other parts of the theme including, but not limited to the CSS code, images, and design are licensed for free personal usage. </p>
		<ul>
		<li> You are requested to retain the credit banners on the template.</li>
		<li> You are allowed to use the theme on multiple installations, and to edit the template for your personal/client use.</li>
		<li> You are NOT allowed to edit the theme or change its form with the intention to resell or redistribute it. </li>
		<li> You are NOT allowed to use the theme as a part of a template repository for any paid CMS service.</li>
		</ul>
	</div>
	
				
	</div>
	<p class="welcome-panel-dismiss">WordPress theme designed by <a href="http://www.web2feel.com">web2feel.com</a>.</p>

	</div>
	</div>
		
		';
}

 ?>