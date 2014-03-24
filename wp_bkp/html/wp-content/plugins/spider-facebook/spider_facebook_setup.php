<?php 
function install_spider_facbook(){
	global $wpdb;
$params_table="CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."spiderfacebook_params` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `type` varchar(200) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `width` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `url_type` varchar(200) NOT NULL,
  `colorsc` varchar(200) NOT NULL,
  `render` varchar(200) NOT NULL,
  `code` text NOT NULL,
  `articles` varchar(200) NOT NULL,
  `backg` varchar(200) NOT NULL,
  `border` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `send` tinyint(1) NOT NULL,
  `face` tinyint(1) NOT NULL,
  `layout` varchar(200) NOT NULL,
  `font` varchar(200) NOT NULL,
  `lang` varchar(200) NOT NULL,
  `height` varchar(200) NOT NULL,
  `post` varchar(200) NOT NULL,
  `rows` varchar(200) NOT NULL,
  `domain` varchar(200) NOT NULL,
  `appid` varchar(200) NOT NULL,
  `head` tinyint(1) NOT NULL,
  `recom` varchar(200) NOT NULL,
  `target` varchar(200) NOT NULL,
  `stream` tinyint(1) NOT NULL,
  `size` varchar(200) NOT NULL,
  `bord` tinyint(1) NOT NULL,
  `share_type` varchar(200) NOT NULL,
  `request_type` varchar(1) NOT NULL,
  `place` varchar(200) NOT NULL,
  `twit` varchar(200) NOT NULL,
  `items` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_type` text NOT NULL,
  `meta_url` text NOT NULL,
  `meta_image` text NOT NULL,
  `meta_site_name` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_admins` text NOT NULL,
  `item_meta_title` text NOT NULL,
  `item_meta_type` text NOT NULL,
  `item_meta_url` text NOT NULL,
  `item_meta_image` text NOT NULL,
  `item_meta_site_name` text NOT NULL,
  `item_meta_description` text NOT NULL,
  `item_meta_admins` text NOT NULL,
  `item_place` varchar(200) NOT NULL,
  `css` text NOT NULL,
  `def_img_art` text NOT NULL,
  `def_img_item` text NOT NULL,
  `fb_only` tinyint(1) NOT NULL,
  `reg_type` varchar(200) NOT NULL,
  `reg_red` varchar(250) NOT NULL,
  `log_red` varchar(250) NOT NULL,
  `url_value` varchar(250) NOT NULL,
  `lang_type` varchar(250) NOT NULL,
  `req_m` varchar(250) NOT NULL,
  `count_mode` varchar(250) NOT NULL,
  `hor_place` varchar(250) NOT NULL,
  
  
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
";
$facbook_user_table="CREATE TABLE IF NOT EXISTS`".$wpdb->prefix."spiderfacebook_login` (
`id` int(11) NOT NULL auto_increment,
`user_id` varchar(200) NOT NULL,
`username` varchar(200) NOT NULL,
`password` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
$wpdb->query($params_table);
$wpdb->query($facbook_user_table);
}
?>