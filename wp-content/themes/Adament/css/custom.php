<?php
	header("Content-type: text/css;");
	
	if( file_exists('../../../../wp-load.php') ) :
		include '../../../../wp-load.php';
	else:
		include '../../../../../wp-load.php';
	endif;
?>

<?php
	// Styles	
	$primary 	= of_get_option('w2f_primary_color','#769A38');
	$secondary	= of_get_option('w2f_secondary_color','');
	$link 		= of_get_option('w2f_link_color','');
	$hover 		= of_get_option('w2f_hover_color','');
	
?>

#masthead,.main-navigation ul ul,.site-footer,.home .site-footer,
ol.comment-list li .reply a,#respond input#submit {
	background: <?php echo $primary ?>;
}

/* draw any selected text yellow on red background */
::-moz-selection { color: #fff;  background: <?php echo $primary ?>; }
::selection      { color: #fff;  background: <?php echo $primary ?>; } 
/* Links */

a {
	color: <?php echo $link ?>;
}

a:visited {
	color: <?php echo $link ?>;
}

a:hover,
a:focus,
a:active {
	color:<?php echo $hover ?>;
	text-decoration: none;
}

.stylefx figure:hover figcaption,ul.folio-grid li figcaption {
	background: <?php echo $secondary ?>;
}

