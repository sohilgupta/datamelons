<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'w2f_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function w2f_theme_guide(){
		echo '
		
<div id="welcome-panel" class="about-wrap">

	<div class="wpbadge" style="float:left; margin-right:30px; "><img src="'. get_template_directory_uri() . '/screenshot.png" width="250" height="200" /></div>

	<div class="welcome-panel-content">
	
	<h1>Welcome to '.wp_get_theme().' WordPress theme!</h1>
	
		<p class="about-text"> '.wp_get_theme().' is a free premium responsive WordPress theme from fabthemes.com. This theme is built on <b>Bootstrap 3</b> framework. <br> This is a photography WordPress template. This is ideal to setup a photography related website. The theme comes with so many options to customize and the color scheme of the theme is also customizable. </p>
		

		<div class="changelog ">
			<h3>Required plugins </h3>
			<p>The theme often requires few plugins to work the way it is originally intended to. You will find a notification on the admin panel prompting you to install the required plugins. Please install and activate the plugins.  </p>
			<ol>
				<li><a href="http://wordpress.org/extend/plugins/options-framework/">Options framework</a></li>
			</ol>
		</div>

		<div class="changelog ">
			<h3>Theme setup</h3>
			
			<p> Upload the theme to your themes directory and activate it via your theme admin panel.  </p>
			<p> '.wp_get_theme().' theme uses custom homepage template. Create a new page named "<b>Home</b>" and use the "Homepage" template for it. You can also create a new page for blog named <b>Blog</b>. Go to the 
			<b>Settings > Reading > Static Page option </b> and select "<b>Home</b>" for front page and "<b>Blog</b>" for posts page.</p>
			
			<p> <b>Slide</b>: The homepage displays a slideshow. Use the Slide post type to create slide items. </p>
						
			<p> <b>Portfolio</b>: Use the portfolio post type to create the portfolio items. You can create a portfolio page that showcases all your portfolio items in a grid fashion. Please use the "portfolio" template on a page for this. You can use the gallery feature to insert multiple project images to each portfolio post.</p>
			
		</div>

	
	
		<div class="changelog ">
		
		<h3>Theme options explained</h3>
		<p>The theme contains an options page using which you adjust various settings available on the theme. </p>
		
		<h3> Homepage</h3>
		<p><b>Logo image</b> - Upload a logo image </p>
		<p><b>Homepage slides</b> - Select the number of slides for homepage </p>
		<p><b>Portfolio page</b> - Select the custom page set for portfolio. </p>
						
		
		<h3> Style customization </h3>
		<p> Use the color selector to customize the main color scheme, accent color, link color, and link hover color. </p>
		
		<h3> Banner settings </h3>
		<p> Customize your sidebar banners </p>
		
		</div>
	
				
		<div class="changelog ">
		<h3>Theme Legals </h3>
		<p> Please read the Terms of use and the usage license for Fabthemes WordPress themes </p>
		<ul>
			<li> <a href="http://www.fabthemes.com/free-license/">Free Theme Usage License Agreement</a></li>
			<li> <a href="http://www.fabthemes.com/commercial-license/">Commercial Theme Usage License Agreement</a></li>
			<li> <a href="http://www.fabthemes.com/terms-of-use/">Terms of Use</a></li>
		</ul>

	</div>
	
				


	</div>
	</div>
		
		';
		

}