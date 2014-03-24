<?php
/*
Plugin Name:  WOW Slider
Description: This module easily adds image sliders created with WOWSlider app.
Author: WOWSlider.com
Version: 4.2
Author URI: http://wowslider.com/
*/
// template tag
function wowslider($id = 0, $write = true){
    if (is_array($id)){ // shortcodes
        $write = false;
        if (isset($id['id'])) $id = (int)$id['id'];
        else if (isset($id['title'])) $id = array('name' => $id['title']);
        else return '';
    } else if (substr($id, 0, 6) == 'title:') $id = array('name' => substr($id, 6));
    else $id = (int)$id;
    $out = wowslider_get($id);
    if (!$write) return $out;
    echo $out;
}

// initialization
define('WOWSLIDER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WOWSLIDER_PLUGIN_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');
add_shortcode('wowslider' , 'wowslider');
require_once WOWSLIDER_PLUGIN_PATH . 'admin-bar.php';
require_once WOWSLIDER_PLUGIN_PATH . 'api.php';
require_once WOWSLIDER_PLUGIN_PATH . 'helpers.php';
if (is_admin()) require_once WOWSLIDER_PLUGIN_PATH . 'admin.php';

wp_enqueue_script('jquery');
if (file_exists(WOWSLIDER_PLUGIN_PATH . 'data/wowslider.js')){
	wp_register_script('wowslider', WOWSLIDER_PLUGIN_URL . 'data/wowslider.js', array('jquery'));
	wp_enqueue_script('wowslider');
}

?>
