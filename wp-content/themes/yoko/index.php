<?php
/**
 * @package WordPress
 * @subpackage Yoko
 */

get_header(); ?>

<div id="wrap">
<div id="main">
	<?php 
    echo do_shortcode("[metaslider id=47]"); 
?>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>