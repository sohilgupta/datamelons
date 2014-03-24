<?php
include_once get_template_directory() . '/functions/inkthemes-functions.php';
$functions_path = get_template_directory() . '/functions/';
/* These files build out the options interface.  Likely won't need to edit these. */
require_once ($functions_path . 'admin-functions.php');  // Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');  // Admin Interfaces 
require_once ($functions_path . 'theme-options.php');   // Options panel settings and custom settings
require_once ($functions_path . 'define_template.php');
?>
<?php

/* ----------------------------------------------------------------------------------- */
/* Styles Enqueue */
/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */

function onepage_wp_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('onepage-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'));
        wp_enqueue_script('onepage-hoverint', get_template_directory_uri() . '/js/hoverIntent.js', array('jquery'));
        wp_enqueue_script('onepage-modernizr', get_template_directory_uri() . '/js/modernizr.custom.08171.js', array('jquery'));
        wp_enqueue_script('onepage-smint', get_template_directory_uri() . '/js/jquery.smint.js', array('jquery'));
        wp_enqueue_script('onepage-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
    } elseif (is_admin()) {
        
    }
}

add_action('wp_enqueue_scripts', 'onepage_wp_enqueue_scripts');
/* ----------------------------------------------------------------------------------- */
/* Custom Jqueries Enqueue */
/* ----------------------------------------------------------------------------------- */

function onepage_custom_jquery() {
    wp_enqueue_script('mobile-menu', get_template_directory_uri() . "/js/mobile-menu.js", array('jquery'));
}

add_action('wp_footer', 'onepage_custom_jquery');
//Front Page Rename
$get_status = onepage_get_option('re_nm');
$get_file_ac = get_template_directory() . '/front-page.php';
$get_file_dl = get_template_directory() . '/front-page-hold.php';
//True Part
if ($get_status === 'off' && file_exists($get_file_ac)) {
    rename("$get_file_ac", "$get_file_dl");
}
//False Part
if ($get_status === 'on' && file_exists($get_file_dl)) {
    rename("$get_file_dl", "$get_file_ac");
}

function onepage_get_option($name) {
    $options = get_option('onepage_options');
    if (isset($options[$name]))
        return $options[$name];
}

//
function onepage_update_option($name, $value) {
    $options = get_option('onepage_options');
    $options[$name] = $value;
    return update_option('onepage_options', $options);
}

//
function onepage_delete_option($name) {
    $options = get_option('onepage_options');
    unset($options[$name]);
    return update_option('onepage_options', $options);
}

//Enqueue comment thread js
function onepage_enqueue_scripts() {
    if (is_singular() and get_site_option('thread_comments')) {
        wp_print_scripts('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'onepage_enqueue_scripts');