<?php 
/**
 * Library of Theme options functions.
 * @package VisitPress
 * @since VisitPress 1.0
*/
?>
<?php global $visitpress_options;
foreach ($visitpress_options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE && isset($value['std'])) {
		$$value['id'] = $value['std'];
	}
	elseif (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
} ?>
<?php  

// Display Breadcrumb navigation
function visitpress_get_breadcrumb() { 
		if (get_option('visitpress_display_breadcrumb') == '' || get_option('visitpress_display_breadcrumb') == 'Display') { ?>
		<?php _e('<p class="breadcrumb-navigation">', 'visitpress'); ?><?php if(function_exists( 'bcn_display' )){bcn_display();} ?><?php _e('</p>', 'visitpress'); ?>
<?php } 
}

// Display featured images on single posts
function visitpress_get_display_image_post() { 
		if (get_option('visitpress_display_image_post') == '' || get_option('visitpress_display_image_post') == 'Display') { ?>
		<?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail(); ?>
    <?php endif; ?>
<?php } 
}

// Display featured images on pages
function visitpress_get_display_image_page() { 
		if (get_option('visitpress_display_image_page') == '' || get_option('visitpress_display_image_page') == 'Display') { ?>
		<?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail(); ?>
    <?php endif; ?>
<?php } 
}

// Display the date on posts
function visitpress_display_date_post () { 
	if (get_option('visitpress_display_date_post') == '' || get_option('visitpress_display_date_post') == 'Display'){ ?>
	<?php _e('<strong>Posted</strong>: ', 'visitpress'); ?><?php the_time( 'd. m. Y' ) ?>
	<?php }
  if (get_option('visitpress_display_author_post') == '' || get_option('visitpress_display_author_post') == 'Display' && get_option('visitpress_display_date_post') == 'Display') { ?>
		<?php _e(' | ', 'visitpress'); ?>
<?php }
}

// Display the date on pages
function visitpress_display_date_page () { 
	if (get_option('visitpress_display_date_page') == 'Display'){ ?>
	<?php _e('<strong>Posted</strong>: ', 'visitpress'); ?><?php the_time( 'd. m. Y' ) ?>
	<?php }
  if (get_option('visitpress_display_author_page') == 'Display' && get_option('visitpress_display_date_page') == 'Display') { ?>
		<?php _e(' | ', 'visitpress'); ?>
<?php }
}

// Display categories on posts
function visitpress_display_category_post() {
	if (is_single() && (get_option('visitpress_display_categories_post') == '' || get_option('visitpress_display_categories_post') == 'Display')) { ?>	
		<?php _e('<strong>Category</strong>: ', 'visitpress'); ?><?php the_category(', ') ?>
	<?php } // end 
}

 
// Display Author on page
function visitpress_get_author_page() { 
		if (get_option('visitpress_display_author_page') == 'Display') { ?>
		<?php _e('<strong>Author</strong>: ', 'visitpress'); ?><?php the_author_posts_link(); ?>
<?php } 
}
// Display Author on post
function visitpress_get_author_post() { 
		if (get_option('visitpress_display_author_post') == '' || get_option('visitpress_display_author_post') == 'Display') { ?>
		<?php _e('<strong>Author</strong>: ', 'visitpress'); ?><?php the_author_posts_link(); ?>
<?php }
    if (is_single() && (get_option('visitpress_display_categories_post') == '' || get_option('visitpress_display_categories_post') == 'Display' && get_option('visitpress_display_author_post') == 'Display')) { ?>	
		<?php _e(' | ', 'visitpress'); ?>
	<?php } 
  if (is_single() && (get_option('visitpress_display_categories_post') == 'Display' && get_option('visitpress_display_author_post') == 'Hide' && get_option('visitpress_display_date_post') == 'Display')) { ?>	
		<?php _e(' | ', 'visitpress'); ?>
	<?php } 
}

// Index page headline
function visitpress_get_index_headline() { 
		$index_headline = get_option('visitpress_index_headline');
    if ($index_headline != '') { ?>
    <?php _e('<h1>', 'visitpress'); ?><?php echo $index_headline; ?><?php _e('</h1>', 'visitpress'); ?> 
    <?php } 
} ?>