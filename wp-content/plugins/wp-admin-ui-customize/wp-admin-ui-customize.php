<?php
/*
Plugin Name: WP Admin UI Customize
Description: An excellent plugin to customize the management screens.
Plugin URI: http://wpadminuicustomize.com/?utm_source=use_plugin&utm_medium=list&utm_content=wauc&utm_campaign=1_4_4_2
Version: 1.4.4.2
Author: gqevu6bsiz
Author URI: http://gqevu6bsiz.chicappa.jp/?utm_source=use_plugin&utm_medium=list&utm_content=wauc&utm_campaign=1_4_4_2
Text Domain: wauc
Domain Path: /languages
*/

/*  Copyright 2012 gqevu6bsiz (email : gqevu6bsiz@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



class WP_Admin_UI_Customize
{

	var $Ver,
		$Name,
		$Dir,
		$Url,
		$Site,
		$AuthorUrl,
		$ltd,
		$Record,
		$PageSlug,
		$PluginSlug,
		$Nonces,
		$Schema,
		$UPFN,
		$DonateKey,
		$Menu,
		$SubMenu,
		$Admin_bar,
		$ActivatedPlugin,
		$OtherPluginMenu,
		$MsgQ,
		$Msg;


	function __construct() {
		$this->Ver = '1.4.4.2';
		$this->Name = 'WP Admin UI Customize';
		$this->Dir = plugin_dir_path( __FILE__ );
		$this->Url = plugin_dir_url( __FILE__ );
		$this->Site = 'http://wpadminuicustomize.com/';
		$this->AuthorUrl = 'http://gqevu6bsiz.chicappa.jp/';
		$this->ltd = 'wauc';
		$this->Record = array(
			"user_role" => $this->ltd . '_user_role_setting',
			"site" => $this->ltd . '_site_setting',
			"admin_general" => $this->ltd . '_admin_general_setting',
			"dashboard" => $this->ltd . '_dashboard_setting',
			"regist_dashboard_metabox" => $this->ltd . '_regist_dashboard_metabox',
			"admin_bar_menu" => $this->ltd . '_admin_bar_menu_setting',
			"sidemenu" => $this->ltd . '_sidemenu_setting',
			"manage_metabox" => $this->ltd . '_manage_metabox_setting',
			"regist_metabox" => $this->ltd . '_regist_metabox',
			"post_add_edit" => $this->ltd . '_post_add_edit_setting',
			"appearance_menus" => $this->ltd . '_appearance_menus_setting',
			"loginscreen" => $this->ltd . '_loginscreen_setting',
			"plugin_cap" => $this->ltd . '_plugin_cap',
			"donate" => $this->ltd . '_donated',
		);
		$this->PageSlug = 'wp_admin_ui_customize';
		$this->PluginSlug = dirname( plugin_basename( __FILE__ ) );
		$this->Nonces = array( "field" => $this->ltd . '_field' , "value" => $this->ltd . '_value' );
		$this->Schema = is_ssl() ? 'https://' : 'http://';
		$this->ActivatedPlugin = array();
		$this->OtherPluginMenu = array();
		$this->UPFN = 'Y';
		$this->DonateKey = 'd77aec9bc89d445fd54b4c988d090f03';
		$this->MsgQ = $this->ltd . '_msg';
		
		$this->PluginSetup();
		$this->FilterStart();
	}





	// PluginSetup
	function PluginSetup() {
		// load text domain
		load_plugin_textdomain( $this->ltd , false , $this->PluginSlug . '/languages' );

		// plugin links
		add_filter( 'plugin_action_links' , array( $this , 'plugin_action_links' ) , 10 , 2 );

		// plugin links
		add_filter( 'network_admin_plugin_action_links' , array( $this , 'network_admin_plugin_action_links' ) , 10 , 2 );

		// add menu
		add_action( 'admin_menu' , array( $this , 'admin_menu' ) , 2 );

		// setting check user role
		add_action( 'admin_notices' , array( $this , 'settingCheck' ) );

		// compatible other plugin check
		add_action( 'wp_loaded' , array( $this , 'activated_plugin' ) );

		// data update
		add_action( 'admin_init' , array( $this , 'dataUpdate') );
		
		// data convert
		add_action( 'admin_init' , array( $this , 'dataConvert' ) );

		// default admin bar menu load.
		add_action( 'wp_before_admin_bar_render' , array( $this , 'admin_bar_default_load' ) , 1 );

		// default side menu load.
		add_action( 'admin_menu' , array( $this , 'sidemenu_default_load' ) , 10000 );

		// default post metabox load.
		add_action( 'admin_head' , array( $this , 'post_meta_boxes_load' ) , 10000 );

		// default post metabox dashbaord load.
		add_action( 'admin_head' , array( $this , 'post_meta_boxes_dashboard_load' ) , 10 );

	}

	// PluginSetup
	function plugin_action_links( $links , $file ) {
		if( plugin_basename(__FILE__) == $file ) {
			$link = '<a href="' . self_admin_url( 'admin.php?page=' . $this->PageSlug ) . '">' . __( 'Settings' ) . '</a>';
			$support_link = '<a href="http://wordpress.org/support/plugin/' . $this->PluginSlug . '" target="_blank">' . __( 'Support Forums' ) . '</a>';
			$delete_userrole_link = '<a href="' . self_admin_url( 'admin.php?page=' . $this->PageSlug . '_reset_userrole' ) . '">' . __( 'Reset User Roles' , $this->ltd ) . '</a>';
			array_unshift( $links, $link , $delete_userrole_link , $support_link  );
		}
		return $links;
	}

	// PluginSetup
	function network_admin_plugin_action_links( $links , $file ) {
		if( plugin_basename(__FILE__) == $file ) {
			$support_link = '<a href="' . $this->Site . 'multisite_about/?utm_source=use_plugin&utm_medium=list&utm_content=' . $this->ltd . '&utm_campaign=' . str_replace( '.' , '_' , $this->Ver ) . '" target="_blank">Multisite Add-on</a>';
			array_unshift( $links, $support_link );
		}

		return $links;
	}

	// PluginSetup
	function admin_menu() {

		if( !empty( $_GET["page"] ) ) {
			$page = strip_tags( $_GET["page"] );
			if( $page == $this->PageSlug . '_admin_bar' ) {
				@header("X-XSS-Protection: 0");
			}
		}
		
		$capability = $this->get_plugin_cap();

		add_menu_page( $this->Name , $this->Name , $capability, $this->PageSlug , array( $this , 'setting_default') );
		add_submenu_page( $this->PageSlug , __( 'Site Settings' , $this->ltd ) , __( 'Site Settings' , $this->ltd ) , $capability , $this->PageSlug . '_setting_site' , array( $this , 'setting_site' ) );
		add_submenu_page( $this->PageSlug , __( 'General Screen Settings' , $this->ltd ) , __( 'General Screen Settings' , $this->ltd ) , $capability , $this->PageSlug . '_admin_general_setting' , array( $this , 'setting_admin_general' ) );
		add_submenu_page( $this->PageSlug , __( 'Dashboard' ) , __( 'Dashboard' ) , $capability , $this->PageSlug . '_dashboard' , array( $this , 'setting_dashboard' ) );
		add_submenu_page( $this->PageSlug , __( 'Admin Bar Menu' , $this->ltd ) , __( 'Admin Bar Menu' , $this->ltd ) , $capability , $this->PageSlug . '_admin_bar' , array( $this , 'setting_admin_bar_menu' ) );
		add_submenu_page( $this->PageSlug , __( 'Side Menu' , $this->ltd ) , __( 'Side Menu' , $this->ltd ) , $capability , $this->PageSlug . '_sidemenu' , array( $this , 'setting_sidemenu' ) );
		add_submenu_page( $this->PageSlug , __( 'Manage meta box' , $this->ltd ) , __( 'Manage meta box' , $this->ltd ) , $capability , $this->PageSlug . '_manage_metabox' , array( $this , 'setting_manage_metabox' ) );
		add_submenu_page( $this->PageSlug , __( 'Add New Post and Edit Post Screen Setting' , $this->ltd ) , __( 'Add New Post and Edit Post Screen Setting' , $this->ltd ) , $capability , $this->PageSlug . '_post_add_edit_screen' , array( $this , 'setting_post_add_edit' ) );
		add_submenu_page( $this->PageSlug , __( 'Appearance Menus Screen Setting' , $this->ltd ) , __( 'Appearance Menus Screen Setting' , $this->ltd ) , $capability , $this->PageSlug . '_appearance_menus' , array( $this , 'setting_appearance_menus' ) );
		add_submenu_page( $this->PageSlug , __( 'Login Screen' , $this->ltd ) , __( 'Login Screen' , $this->ltd ) , $capability , $this->PageSlug . '_loginscreen' , array( $this , 'setting_loginscreen' ) );
		add_submenu_page( $this->PageSlug , sprintf( __( '%1$s of %2$s %3$s' , $this->ltd ) , __( 'Change' ) , __( 'Plugin' ) , __( 'Capabilities' ) ) , sprintf( __( '%1$s of %2$s %3$s' , $this->ltd ) , __( 'Change' ) , __( 'Plugin' ) , __( 'Capabilities' ) ) , $capability , $this->PageSlug . '_plugin_cap' , array( $this , 'setting_plugin_cap' ) );
		add_submenu_page( $this->PageSlug , __( 'Reset User Roles' , $this->ltd ) , __( 'Reset User Roles' , $this->ltd ) , $capability , $this->PageSlug . '_reset_userrole' , array( $this , 'reset_userrole' ) );
	}

	// PluginSetup
	function dataConvert() {
		$ManageMetabox = get_option( $this->Record['manage_metabox'] );
		$RemoveMetabox = get_option( $this->ltd . '_removemetabox_setting' );
		
		if( empty( $ManageMetabox ) && !empty( $RemoveMetabox ) ) {

			// Old Data Convert
			$ManageMetabox["UPFN"] = $this->UPFN;
			unset( $RemoveMetabox["UPFN"] );
			
			if( !empty( $RemoveMetabox ) ) {
				foreach( $RemoveMetabox as $post_type => $box ) {
					foreach( $box as $id => $v ) {
						if( !empty( $v ) ) {
							$ManageMetabox[$post_type][$id] = array( "remove" => 1 , "name" => "" );
						}
					}
				}
				
				update_option( $this->Record['manage_metabox'] , $ManageMetabox );
				delete_option( $this->ltd . '_removemetabox_setting' );
			}
			
		}
		
		$Dashboard = get_option( $this->Record['dashboard'] );
		if( !empty( $Dashboard ) ) {
			unset( $Dashboard["UPFN"] );

			if( !empty( $Dashboard["metabox_move"] ) ) {
				$metabox_move = 1;
				unset( $Dashboard["metabox_move"] );
			}

			$is_array = true;
			foreach( $Dashboard as $box_id => $val ) {
				if( !is_array( $val ) ) {
					$Dashboard[$box_id] = array( "remove" => 1 );
					$is_array = false;
				}
			}
			if( $is_array ==  false ) {

				$Dashboard["UPFN"] = $this->UPFN;
				if( !empty( $metabox_move ) ) {
					$Dashboard["metabox_move"] = 1;
				}

				update_option( $this->Record['dashboard'] , $Dashboard );
			}
		}
	}

	// PluginSetup
	function activated_plugin() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
			$this->ActivatedPlugin["buddypress"] = true;
		}
	}




	// SettingPage
	function setting_default() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		include_once 'inc/setting_default.php';
	}

	// SettingPage
	function setting_site() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_site.php';
	}

	// SettingPage
	function setting_admin_general() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_admin_general.php';
	}

	// SettingPage
	function setting_dashboard() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_dashboard.php';
	}

	// SettingPage
	function setting_admin_bar_menu() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_admin_bar_menu.php';
	}

	// SettingPage
	function setting_sidemenu() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_sidemenu.php';
	}

	// SettingPage
	function setting_manage_metabox() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_manage_metabox.php';
	}

	// SettingPage
	function setting_post_add_edit() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_post_add_edit.php';
	}

	// SettingPage
	function setting_appearance_menus() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_appearance_menus.php';
	}

	// SettingPage
	function setting_loginscreen() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_loginscreen.php';
	}

	// SettingPage
	function reset_userrole() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		include_once 'inc/reset_userrole.php';
	}

	// SettingPage
	function setting_plugin_cap() {
		$this->display_msg();
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		include_once 'inc/setting_plugin_cap.php';
	}





	// GetData
	function get_data( $record ) {
		$GetData = get_option( $this->Record[$record] );
		$GetData = apply_filters( 'wauc_pre_get_data' , $GetData , $record );

		$Data = array();
		if( !empty( $GetData ) && !empty( $GetData["UPFN"] ) && $GetData["UPFN"] == $this->UPFN ) {
			$Data = $GetData;
		}

		return $Data;
	}

	// GetData
	function get_flit_data( $record ) {
		$GetData = get_option( $this->Record[$record] );
		$GetData = apply_filters( 'wauc_pre_get_filt_data' , $GetData , $record );

		$Data = array();
		if( !empty( $GetData ) && !empty( $GetData["UPFN"] ) && $GetData["UPFN"] == $this->UPFN ) {
			$Data = $GetData;
		}

		return $Data;
	}



	// Settingcheck
	function settingCheck() {
		global $current_screen;

		$Data = $this->get_data( 'user_role' );
		if( !empty( $Data["UPFN"] ) ) {
			unset( $Data["UPFN"] );
		}
		if( empty( $Data ) ) {
			if( $current_screen->parent_base == $this->PageSlug && $current_screen->id != 'toplevel_page_' . $this->PageSlug ) {
				echo '<div class="error"><p><strong>' . sprintf( __( 'Authority to apply the setting is not selected. <a href="%s">From here</a>, please select the permissions you want to set.' , $this->ltd ) , admin_url( 'admin.php?page=' . $this->PageSlug ) ) . '</strong></p></div>';
			}
		}
	}





	// SetList
	function get_user_role() {
		$editable_roles = get_editable_roles();
		foreach ( $editable_roles as $role => $details ) {
			$editable_roles[$role]["label"] = translate_user_role( $details['name'] );
		}

		return $editable_roles;
	}

	// SetList
	function get_apply_roles() {

		$apply_user_roles = $this->get_data( 'user_role' );
		unset( $apply_user_roles["UPFN"] );
		
		$Contents =  __( 'Apply user roles' , $this->ltd ) . ' : ';
		
		if( !empty( $apply_user_roles ) ) {
			$UserRoles = $this->get_user_role();
			foreach( $apply_user_roles as $role => $v ) {
				$Contents .= '[ ' . $UserRoles[$role]["label"] . ' ]';
			}
		} else {
			$Contents .= __( 'None' );
		}

		$Contents = apply_filters( 'wauc_get_apply_roles' , $Contents );

		return $Contents;

	}

	// SetList
	function sidemenu_default_load() {
		global $menu , $submenu;

		$this->Menu = $menu;
		$this->SubMenu = $submenu;
		
		if ( !get_option( 'link_manager_enabled' ) ) {
			foreach( $this->Menu as $key => $val ) {
				if( !empty( $val[1] ) && $val[1] == 'manage_links' ) {
					unset( $this->Menu[$key] );
				}
			}
		}
	}

	// SetList
	function admin_bar_default_load() {
		global $wp_admin_bar;

		$this->Admin_bar = $wp_admin_bar->get_nodes();
		
		// Other plugin
		if( !empty( $this->ActivatedPlugin ) ) {

			if( !empty( $this->ActivatedPlugin["buddypress"] ) ) {
				$plugin_slug = 'buddypress';
				foreach( $this->Admin_bar as $node_id => $node ) {
					if( strstr( $node_id , $plugin_slug ) or strstr( $node_id , 'bp-' ) ) {
						$this->OtherPluginMenu["admin_bar"][$plugin_slug][$node_id] = 1;
					}
				}
			}
			
			if( !empty( $this->OtherPluginMenu["admin_bar"] ) ) {
				for($i = 0; $i < 4; $i++) {
					foreach( $this->OtherPluginMenu["admin_bar"] as $plugin_slug => $plugin_menu ) {
						foreach( $this->Admin_bar as $node_id => $node ) {
							if( !empty( $node->parent ) && array_key_exists( $node->parent , $plugin_menu ) ) {
								$this->OtherPluginMenu["admin_bar"][$plugin_slug][$node_id] = 1;
							}
						}
					}
				}
			}
			
		}
	}

	// SetList
	function admin_bar_filter_load() {
		$Default_bar = $this->Admin_bar;
		
		$Delete_bar = array( "top-secondary" , "my-sites-super-admin" );
		foreach( $Delete_bar as $del_name ) {
			if( !empty( $Default_bar[$del_name] ) ) {
				unset( $Default_bar[$del_name] );
			}
		}

		// front
		$Default_bar["dashboard"] = (object) array( "id" => "dashboard" , "title" => __( 'Dashboard' ) , "parent" => "site-name" , "href" => admin_url() , "group" => false );
		
		foreach( $Default_bar as $node_id => $node ) {
			if( $node->id == 'my-account' ) {
				$Default_bar[$node_id]->title = sprintf( __( 'Howdy, %1$s' ) , '[user_name]' ) . '[user_avatar]';
			} elseif( $node->id == 'user-info' ) {
				$Default_bar[$node_id]->title = '[user_avatar_64]<span class="display-name">[user_name]</span><span class="username">[user_login_name]</span>';
			} elseif( $node->id == 'logout' ) {
				$Default_bar[$node_id]->href = preg_replace( '/&amp(.*)/' , '' , $node->href );
			} elseif( $node->id == 'site-name' ) {
				$Default_bar[$node_id]->title = '[blog_name]';
			} elseif( $node->id == 'updates' ) {
				$Default_bar[$node_id]->title = '[update_total]';
			} elseif( $node->id == 'comments' ) {
				$Default_bar[$node_id]->title = '[comment_count]';
			}
		}

		$Filter_bar = array();
		$MainMenuIDs = array();

		foreach( $Default_bar as $node_id => $node ) {
			if( empty( $node->parent ) ) {
				$Filter_bar["left"]["main"][$node_id] = $node;
				$MainMenuIDs[$node_id] = "left";
				unset( $Default_bar[$node_id] );
			} elseif( $node->parent == 'top-secondary' ) {
				$Filter_bar["right"]["main"][$node_id] = $node;
				$MainMenuIDs[$node_id] = "right";
				unset( $Default_bar[$node_id] );
			}
		}
		
		// meta field add
		foreach( $Default_bar as $node_id => $node ) {
			if( !isset( $node->meta ) ) {
				$Default_bar[$node_id]->meta = array();
			}
		}

		// sub node
		foreach( $MainMenuIDs as $parent_id => $menu_type ) {
			foreach( $Default_bar as $node_id => $node ) {
				if( $node->parent == $parent_id ) {
					$Filter_bar[$menu_type]["sub"][$node_id] = $node;
					unset( $Default_bar[$node_id] );
				}
			}
		}
		
		$Place_types = $this->admin_bar_places();

		// sub2 node
		if( !empty( $Default_bar ) ) {
			foreach( $Place_types as $place => $place_label ) {
				if( !empty( $Filter_bar[$place]["sub"] ) && $place != 'front' ) {
					foreach( $Filter_bar[$place]["sub"] as $parent_id => $parent_node ) {
						foreach( $Default_bar as $node_id => $node ) {
							if( $node->parent == $parent_id ) {
								$Filter_bar[$place]["sub2"][$node_id] = $node;
								unset( $Default_bar[$node_id] );
							}
						}
					}
				}
			}
		}

		// sub3 node
		if( !empty( $Default_bar ) ) {
			foreach( $Place_types as $place => $place_label ) {
				if( !empty( $Filter_bar[$place]["sub2"] ) && $place != 'front' ) {
					foreach( $Filter_bar[$place]["sub2"] as $parent_id => $parent_node ) {
						foreach( $Default_bar as $node_id => $node ) {
							if( $node->parent == $parent_id ) {
								$Filter_bar[$place]["sub3"][$node_id] = $node;
								unset( $Default_bar[$node_id] );
							}
						}
					}
				}
			}
		}

		// sub4 node
		if( !empty( $Default_bar ) ) {
			foreach( $Place_types as $place => $place_label ) {
				if( !empty( $Filter_bar[$place]["sub3"] ) && $place != 'front' ) {
					foreach( $Filter_bar[$place]["sub3"] as $parent_id => $parent_node ) {
						foreach( $Default_bar as $node_id => $node ) {
							if( $node->parent == $parent_id ) {
								$Filter_bar[$place]["sub4"][$node_id] = $node;
								unset( $Default_bar[$node_id] );
							}
						}
					}
				}
			}
		}

		// front field
		$Filter_bar["front"] = array( "main" => array() , "sub" => array() );
		$Filter_bar["front"]["main"]["edit-post_type"] = new stdClass;
		$Filter_bar["front"]["main"]["edit-post_type"] = (object) array( 'id' => 'edit-post_type' , 'title' => '' , 'href' => '' , 'group' => '' , 'meta' => array() );
		$Filter_bar["front"]["main"]["edit-post_type"]->title = sprintf( '%1$s (%2$s/%3$s/%4$s/%5$s/%6$s)' , __( 'Edit' ) , __( 'Posts' ) , __( 'Pages' ) , __( 'Categories' ) , __( 'Tags' ) , __( 'Custom' ) );
		
		return $Filter_bar;
	}

	// SetList
	function post_meta_boxes_dashboard_load() {
		global $current_screen;

		$UserRole = $this->current_user_role_group();

		if( !empty( $current_screen ) && $current_screen->id == 'dashboard' && $UserRole == 'administrator' ) {
			global $wp_meta_boxes;

			$GetData = $this->get_data( "regist_dashboard_metabox" );
			$post_type = 'dashboard';
			$Metaboxes = $wp_meta_boxes[$post_type];
				
			$Update = array();
			if( empty( $GetData ) ) {

				$Update["UPFN"] = $this->UPFN;
				foreach( $Metaboxes as $context => $meta_box ) {
					foreach( $meta_box as $priority => $box ) {
						foreach( $box as $metabox_id => $b ) {
							$Update["metaboxes"][$post_type][$context][$priority][$b["id"]] = strip_tags( $b["title"] );
						}
					}
				}
					
			} else {
					
				$Update = $GetData;
				if( !empty( $Metaboxes ) ) {
					foreach( $Metaboxes as $context => $meta_box ) {
						foreach( $meta_box as $priority => $box ) {
							if( is_array( $box ) ) {
								foreach( $box as $metabox_id => $b ) {
									if( !empty( $GetData["metaboxes"][$post_type][$context][$priority][$b["id"]] ) ) {
										$Update["metaboxes"][$post_type][$context][$priority][$b["id"]] = strip_tags( $b["title"] );
									} else {
										$Update["metaboxes"][$post_type][$context][$priority][$b["id"]] = strip_tags( $b["title"] );
									}
								}
							}
						}
					}
				}
				
			}

			if( !empty( $Update ) ) {
				update_option( $this->Record["regist_dashboard_metabox"] , $Update );
			}
		}

	}

	// SetList
	function post_meta_boxes_load() {
		global $current_screen;

		$UserRole = $this->current_user_role_group();

		if( !empty( $current_screen ) && $current_screen->base == 'post' && $current_screen->action != 'add' && $UserRole == 'administrator' ) {
			global $wp_meta_boxes;

			$GetData = $this->get_data( "regist_metabox" );
			$post_type = $current_screen->post_type;
			$Metaboxes = $wp_meta_boxes[$post_type];
				
			$Update = array();
			if( empty( $GetData ) ) {

				$Update["UPFN"] = $this->UPFN;
				foreach( $Metaboxes as $context => $meta_box ) {
					foreach( $meta_box as $priority => $box ) {
						foreach( $box as $metabox_id => $b ) {
							$Update["metaboxes"][$post_type][$context][$priority][$b["id"]] = strip_tags( $b["title"] );
						}
					}
				}
					
			} else {
					
				$Update = $GetData;
				if( !empty( $Metaboxes ) ) {
					foreach( $Metaboxes as $context => $meta_box ) {
						foreach( $meta_box as $priority => $box ) {
							if( is_array( $box ) ) {
								foreach( $box as $metabox_id => $b ) {
									if( !empty( $GetData["metaboxes"][$post_type][$context][$priority][$b["id"]] ) ) {
										$Update["metaboxes"][$post_type][$context][$priority][$b["id"]] = strip_tags( $b["title"] );
									} else {
										$Update["metaboxes"][$post_type][$context][$priority][$b["id"]] = strip_tags( $b["title"] );
									}
								}
							}
						}
					}
				}
				
			}

			if( !empty( $Update ) ) {
				update_option( $this->Record["regist_metabox"] , $Update );
			}
		}

	}

	// SetList
	function sidebar_menu_widget( $menu_widget ) {
		$UserRoles = $this->get_user_role();
		$new_widget = '';
		if( !empty( $menu_widget["new"] ) ) {
			$new_widget = 'new';
		}
?>
		<div class="widget <?php echo $menu_widget["slug"]; ?> <?php echo $new_widget; ?>">

			<div class="widget-top">
				<div class="widget-title-action">
					<a class="widget-action" href="#available"></a>
				</div>
				<div class="widget-title">
					<h4>
						<?php echo $menu_widget["title"]; ?>
						: <span class="in-widget-title"><?php echo $menu_widget["slug"]; ?></span>
					</h4>
				</div>
			</div>

			<div class="widget-inside">
				<div class="settings">
					<p class="description">
						<?php if( $menu_widget["slug"] == 'custom_menu' ) : ?>
							<?php _e( 'Url' ); ?>:
							<input type="text" class="slugtext" value="" name="data[][slug]">
						<?php else : ?>
							<?php _e( 'Slug' ); ?>: <?php echo $menu_widget["slug"]; ?>
							<input type="hidden" class="slugtext" value="<?php echo $menu_widget["slug"]; ?>" name="data[][slug]">
						<?php endif; ?>
					</p>
					<?php _e( 'User Roles' ); ?> : 
					<ul class="display_roles">
						<?php foreach( $UserRoles as $role_name => $val ) : ?>
							<?php $has_cap = false; ?>
							<?php if( !empty( $val["capabilities"][$menu_widget["cap"]] ) or $role_name == $menu_widget["cap"] ) : ?>
								<?php $has_cap = 'has_cap'; ?>
							<?php endif; ?>
							<li class="<?php echo $role_name; ?> <?php echo $has_cap; ?>"><?php echo $val["label"]; ?></li>
						<?php endforeach ;?>
					</ul>
					<label>
						<?php _e( 'Title' ); ?> : <input type="text" class="regular-text titletext" value="<?php echo esc_attr( $menu_widget["title"] ); ?>" name="data[][title]">
					</label>
					<input type="hidden" class="parent_slugtext" value="<?php echo $menu_widget["parent_slug"]; ?>" name="data[][parent_slug]">
				</div>

				<?php if( $menu_widget["slug"] != 'separator' ) : ?>
					<div class="submenu">
						<p class="description"><?php _e( 'Sub Menus' , $this->ltd ); ?></p>
						<?php if( empty( $menu_widget["new"] ) && !empty( $menu_widget["submenu"] ) ) : ?>
							<?php foreach( $menu_widget["submenu"] as $sm ) : ?>
								<?php $sepalator_widget = ''; ?>
								<?php if( $sm["slug"] == 'separator' ) : $sepalator_widget = $sm["slug"]; endif; ?>

								<div class="widget <?php echo $sepalator_widget; ?>">

									<div class="widget-top">
										<div class="widget-title-action">
											<a class="widget-action" href="#available"></a>
										</div>
										<div class="widget-title">
											<h4>
												<?php echo $sm["title"]; ?>
												: <span class="in-widget-title"><?php echo $sm["slug"]; ?></span>
											</h4>
										</div>
									</div>

									<div class="widget-inside">
										<div class="settings">
											<p class="description">
												<?php _e( 'Slug' ); ?>: <?php echo $sm["slug"]; ?>
												<input type="hidden" class="slugtext" value="<?php echo $sm["slug"]; ?>" name="data[][slug]">
											</p>
											<?php _e( 'User Roles' ); ?> : 
											<ul class="display_roles">
												<?php foreach( $UserRoles as $role_name => $val ) : ?>
													<?php $has_cap = false; ?>
													<?php if( !empty( $val["capabilities"][$sm["cap"]] ) or $role_name == $sm["cap"] ) : ?>
														<?php $has_cap = 'has_cap'; ?>
													<?php endif; ?>
													<li class="<?php echo $role_name; ?> <?php echo $has_cap; ?>"><?php echo $val["label"]; ?></li>
												<?php endforeach ;?>
											</ul>
											<label>
												<?php _e( 'Title' ); ?> : <input type="text" class="regular-text titletext" value="<?php echo esc_attr( $sm["title"] ); ?>" name="data[][title]">
											</label>
											<input type="hidden" class="parent_slugtext" value="<?php echo $sm["parent_slug"]; ?>" name="data[][parent_slug]">
										</div>
										<div class="widget-control-actions">
											<div class="alignleft">
												<a href="#remove"><?php _e( 'Remove' ); ?></a>
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>

							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="widget-control-actions">
						<div class="alignleft">
							<a href="#remove"><?php _e( 'Remove' ); ?></a>
						</div>
						<div class="clear"></div>
					</div>

				<?php endif; ?>
			</div>

		</div>
<?php
	}

	// SetList
	function admin_bar_menu_widget( $Nodes , $menu_widget , $node_type ) {
		if ( is_object( $menu_widget ) ) $menu_widget = (array) $menu_widget;
		if( !isset( $menu_widget["group"] ) ) $menu_widget["group"] = 0;
		if( !isset( $menu_widget["meta"]["class"] ) ) $menu_widget["meta"]["class"] = "";
		$no_submenu = array( 'search' , 'bp-notifications' , 'menu-toggle' );
		$activated_plugin = $this->ActivatedPlugin;
		$other_plugin = $this->OtherPluginMenu;

		$widget_class = $menu_widget["id"];
		$new_widget = '';
		if( !empty( $menu_widget["new"] ) ) {
			$new_widget = 'new';
			$widget_class .= ' new';
		}
		if( !empty( $menu_widget["group"] ) ) {
			$widget_class .= ' widget-group';
		}
?>
		<div class="widget <?php echo $widget_class; ?>">

			<div class="widget-top">
				<div class="widget-title-action">
					<a class="widget-action" href="#available"></a>
				</div>
				<div class="widget-title">
					<h4>
						<?php if( !empty( $menu_widget["group"] ) ) : ?>
							<?php _e( 'Menu Group' , $this->ltd ); ?>
							: <span class="in-widget-title"><?php echo $menu_widget["id"]; ?></span>
						<?php elseif( preg_match( '/\<form/' , $menu_widget["title"] ) ) : ?>
							<?php echo $menu_widget["id"]; ?>
						<?php else: ?>
							<?php echo $menu_widget["title"]; ?>
							: <span class="in-widget-title"><?php echo $menu_widget["id"]; ?></span>
						<?php endif; ?>
					</h4>
				</div>
			</div>

			<div class="widget-inside">
				<div class="settings">
					<p class="field-url description">
						<input type="hidden" class="idtext" value="<?php echo $menu_widget["id"]; ?>" name="data[][id]" />
						<?php if( strstr( $menu_widget["id"] , 'custom_node' ) && empty( $menu_widget["group"] ) ) : ?>
							URL: <input type="text" class="regular-text linktext" value="<?php echo $menu_widget["href"]; ?>" name="data[][href]" placeholder="http://" />
						<?php else:  ?>
							<?php if( $menu_widget["id"] == 'edit-post_type' ) : ?>
								<strong><?php _e( 'Show only on front end.' , $this->ltd ); ?></strong>
							<?php elseif( !empty( $menu_widget["group"] ) ) : ?>
								<strong><?php _e( 'Menu Group' , $this->ltd ); ?></strong>
							<?php elseif( $menu_widget["id"] == 'menu-toggle' ) : ?>
								<strong><?php echo $menu_widget["id"]; ?></strong>
							<?php else: ?>
								<a href="<?php echo $menu_widget["href"]; ?>" target="_blank"><?php echo $menu_widget["id"]; ?></a>
							<?php endif; ?>
							<input type="hidden" class="linktext" value="<?php echo $menu_widget["href"]; ?>" name="data[][href]" />
						<?php endif; ?>
					</p>
					<p class="field-title description">
						<label>
							<?php if( !empty( $menu_widget["group"] ) ) : ?>
								<input type="hidden" class="regular-text titletext" value="" name="data[][title]" />
							<?php else : ?>
								<?php _e( 'Title' ); ?> : 
								<?php if( $menu_widget["id"] == 'edit-post_type' or in_array( $menu_widget["id"] , $no_submenu ) ) : ?>
									<input type="text" class="regular-text titletext" value="<?php echo esc_html( $menu_widget["title"] ); ?>" name="data[][title]" readonly="readonly" /><br />
									<?php if( $menu_widget["id"] == 'edit-post_type' ) : ?>
										<span class="description"><?php _e( 'If you want edit to name, please edit of translation file(PO).' , $this->ltd ); ?></span><br />
									<?php endif; ?>
								<?php elseif( !empty( $activated_plugin ) ) : ?>
									<?php foreach( $activated_plugin as $plugin_slug => $v ) : ?>
										<?php if( !empty( $other_plugin["admin_bar"][$plugin_slug] ) && array_key_exists( $menu_widget["id"] , $other_plugin["admin_bar"][$plugin_slug] ) ) : ?>
											<input type="text" class="regular-text titletext" value="<?php echo esc_html( $menu_widget["title"] ); ?>" name="data[][title]" readonly="readonly" /><br />
										<?php else : ?>
											<input type="text" class="regular-text titletext" value="<?php echo esc_html( $menu_widget["title"] ); ?>" name="data[][title]" />
										<?php endif; ?>
									<?php endforeach; ?>
								<?php else : ?>
									<input type="text" class="regular-text titletext" value="<?php echo esc_html( $menu_widget["title"] ); ?>" name="data[][title]" />
								<?php endif; ?>
							<?php endif; ?>
						</label>
					</p>
					<p class="field-meta description">
						<label class="description">
							<?php if( !empty( $menu_widget["group"] ) or $menu_widget["id"] == 'menu-toggle' ) : ?>
								<input type="hidden" class="meta_target" value="_blank" name="data[][meta][target]" />
							<?php else: ?>
								<?php $checked = ""; ?>
								<?php if( !empty( $menu_widget["meta"]["target"] ) ) : ?>
									<?php $checked = checked( $menu_widget["meta"]["target"] , '_blank' , 0 ); ?>
								<?php endif; ?>
								<input type="checkbox" class="meta_target" value="_blank" name="data[][meta][target]" <?php echo $checked; ?> />
								<?php _e( 'Open link in a new window/tab' ); ?>
							<?php endif; ?>
						</label>
						<input type="hidden" class="meta_class" value="<?php echo $menu_widget["meta"]["class"]; ?>" name="data[][meta][class]" />
					</p>
					<input type="hidden" class="parent" value="<?php echo $menu_widget["parent"]; ?>" name="data[][parent]" />
					<input type="hidden" class="group" value="<?php echo $menu_widget["group"]; ?>" name="data[][group]" />
					<input type="hidden" class="node_type" value="" name="data[][node_type]" />
				</div>

				<?php if( !in_array( $menu_widget["id"] , $no_submenu ) ) : ?>
					<div class="submenu">
						<p class="description"><?php _e( 'Sub Menus' , $this->ltd ); ?></p>
						
						<?php if( empty( $new_widget ) && !empty( $node_type ) ) : ?>

							<?php $subnode_type = ''; ?>
							<?php if( $node_type == 'main' ) : ?>
								<?php $subnode_type = 'sub'; ?>
							<?php elseif( $node_type == 'sub' ) : ?>
								<?php $subnode_type = 'sub2'; ?>
							<?php elseif( $node_type == 'sub2' ) : ?>
								<?php $subnode_type = 'sub3'; ?>
							<?php elseif( $node_type == 'sub3' ) : ?>
								<?php $subnode_type = 'sub4'; ?>
							<?php endif; ?>

							<?php if( !empty( $subnode_type ) && !empty( $Nodes[$subnode_type] ) ) : ?>
								<?php foreach( $Nodes[$subnode_type] as $subnode_id => $subnode ) : ?>
									<?php if( is_object( $subnode ) ) $subnode = get_object_vars( $subnode ); ?>
									<?php if( $menu_widget["id"] == $subnode["parent"] ) : ?>
										<?php array_map( array( $this , 'admin_bar_menu_widget' ) , array( $Nodes ) , array( $subnode ) , array( $subnode_type ) ); ?>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>

						<?php endif; ?>

					</div>
				<?php endif; ?>

				<div class="widget-control-actions">
					<div class="alignleft">
						<a href="#remove"><?php _e( 'Remove' ); ?></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>

		</div>
<?php
	}

	// SetList
	function get_custom_posts() {
		$args = array( );
		$all_custom_posts = get_post_types( $args , 'objects' );
		
		$exclusion = array( "post" , "page" , "attachment" , "revision" , "nav_menu_item");
		$custom_posts = array();
		foreach($all_custom_posts as $post_type => $cpt) {
			if( !in_array( $post_type , $exclusion ) ) {
				if( !empty( $cpt->show_ui ) ) {
					$custom_posts[$post_type] = $cpt;
				}
			}
		}
		
		return $custom_posts;
	}

	// SetList
	function val_replace( $str ) {
		
		if( !empty( $str ) ) {

			$update_data = wp_get_update_data();
			$awaiting_mod = wp_count_comments();
			$awaiting_mod = $awaiting_mod->moderated;
			$current_user = wp_get_current_user();
			if( is_multisite() ) {
				$current_site = get_current_site();
			}

			if( strstr( $str , '[blog_url]') ) {
				$str = str_replace( '[blog_url]' , get_bloginfo( 'url' ) , $str );
			}
			if( strstr( $str , '[template_directory_uri]') ) {
				$str = str_replace( '[template_directory_uri]' , get_bloginfo( 'template_directory' ) , $str );
			}
			if( strstr( $str , '[stylesheet_directory_uri]') ) {
				$str = str_replace( '[stylesheet_directory_uri]' , get_stylesheet_directory_uri() , $str );
			}
			if( strstr( $str , '[blog_name]') ) {
				$str = str_replace( '[blog_name]' , get_bloginfo( 'name' ) , $str );
			}
			if( strstr( $str , '[update_total]') ) {
				$str = str_replace( '[update_total]' , $update_data["counts"]["total"] , $str );
			}
			if( strstr( $str , '[update_total_format]') ) {
				$str = str_replace( '[update_total_format]' , number_format_i18n( $update_data["counts"]["total"] ) , $str );
			}
			if( strstr( $str , '[update_plugins]') ) {
				$str = str_replace( '[update_plugins]' , $update_data["counts"]["plugins"] , $str );
			}
			if( strstr( $str , '[update_plugins_format]') ) {
				$str = str_replace( '[update_plugins_format]' , number_format_i18n( $update_data["counts"]["plugins"] ) , $str );
			}
			if( strstr( $str , '[update_themes]') ) {
				$str = str_replace( '[update_themes]' , $update_data["counts"]["themes"] , $str );
			}
			if( strstr( $str , '[update_themes_format]') ) {
				$str = str_replace( '[update_themes_format]' , number_format_i18n( $update_data["counts"]["themes"] ) , $str );
			}
			if( strstr( $str , '[comment_count]') ) {
				$str = str_replace( '[comment_count]' , $awaiting_mod , $str );
			}
			if( strstr( $str , '[comment_count_format]') ) {
				$str = str_replace( '[comment_count_format]' , number_format_i18n( $awaiting_mod ) , $str );
			}
			if( strstr( $str , '[user_name]') ) {
				$str = str_replace( '[user_name]' , $current_user->display_name , $str );
			}
			if( strstr( $str , '[user_login_name]') ) {
				$str = str_replace( '[user_login_name]' , $current_user->user_login , $str );
			}
			if( strstr( $str , '[user_avatar]') ) {
				$str = str_replace( '[user_avatar]' , get_avatar( $current_user->ID , 16 ) , $str );
			}
			if( strstr( $str , '[user_avatar_64]') ) {
				$str = str_replace( '[user_avatar_64]' , get_avatar( $current_user->ID , 64 ) , $str );
			}

			if( is_multisite() ) {
				if( strstr( $str , '[site_name]') ) {
					$str = str_replace( '[site_name]' , esc_attr( $current_site->site_name ) , $str );
				}
				if( strstr( $str , '[site_url]') ) {
					$str = str_replace( '[site_url]' , $this->Schema . esc_attr( $current_site->domain ) , $str );
				}
			}

		}

		return $str;
	}

	// SetList
	function current_user_role_group() {
		$UserRole = '';
		$User = wp_get_current_user();
		if( !empty( $User->roles ) ) {
			foreach( $User->roles as $role ) {
				$UserRole = $role;
				break;
			}
		}
		if( empty( $UserRole ) && is_multisite() ) {
			$current_site = get_current_site();
			switch_to_blog( $current_site->blog_id );
			$User = wp_get_current_user();
			if( !empty( $User->roles ) ) {
				foreach( $User->roles as $role ) {
					$UserRole = $role;
					break;
				}
			}
			restore_current_blog();
		}
		return $UserRole;
	}

	// SetList
	function admin_bar_places() {
		return $Place_types = array( "left" => __( 'Left' ) , "right" => __( 'Right' ) , "front" => __( 'Front' , $this->ltd ) );
	}
	
	// SetList
	function get_plugin_cap() {
		$capability = 'administrator';
		
		$Data = $this->get_data( 'plugin_cap' );
		if( !empty( $Data["edit_cap"] ) ) {
			$capability = $Data["edit_cap"];
		}
		
		return $capability;
	}
	
	// SetList
	function get_document_link( $document_type ) {
		
		$link = $this->Site;
		$locale = get_locale();

		if( !empty( $document_type ) ) {

			if( $locale == 'ja' ) {
				$link .= 'ja/';
			} else {
				$link .= 'blog/';
			}
			
			if( $document_type == 'admin_bar' ) {
				$link .= 'admin-bar-toolbar-settings/';
			}
			
		}
		
		echo $link;

	}




	// DataUpdate
	function dataUpdate() {

		$RecordField = false;
		
		if( !empty( $_POST[$this->Nonces["field"]] ) ) {

			if( !empty( $_POST["record_field"] ) ) {
				$RecordField = strip_tags( $_POST["record_field"] );
			}

			if( !empty( $RecordField ) && !empty( $_POST["update"] ) ) {

				if( $RecordField == 'user_role' ) {
					$this->update_userrole();
				} elseif( $RecordField == 'site' ) {
					$this->update_site();
				} elseif( $RecordField == 'admin_general' ) {
					$this->update_admin_general();
				} elseif( $RecordField == 'dashboard' ) {
					$this->update_dashboard();
				} elseif( $RecordField == 'admin_bar_menu' ) {
					$this->update_admin_bar_menu();
				} elseif( $RecordField == 'sidemenu' ) {
					$this->update_sidemenu();
				} elseif( $RecordField == 'manage_metabox' ) {
					$this->update_manage_metabox();
				} elseif( $RecordField == 'post_add_edit' ) {
					$this->update_post_add_edit();
				} elseif( $RecordField == 'appearance_menus' ) {
					$this->update_appearance_menus();
				} elseif( $RecordField == 'loginscreen' ) {
					$this->update_loginscreen();
				} elseif( $RecordField == 'plugin_cap' ) {
					$this->update_plugincap();
				}
				
			}

	
			if( !empty( $RecordField ) && !empty( $_POST["reset"] ) ) {

				if( $RecordField == 'manage_metabox' ) {
					delete_option( $this->Record["regist_metabox"] );
				} elseif( $RecordField == 'dashboard' ) {
					delete_option( $this->Record["regist_dashboard_metabox"] );
				}
				
				if( $RecordField == 'all_settings' ) {
					$this->update_reset_all();
				} else {
					$this->update_reset( $RecordField );
				}
			}
	
			if( !empty( $_POST["donate_key"] ) && !empty( $_POST["update"] ) ) {
				$this->DonatingCheck();
			}
		}

	}

	// DataUpdate
	function update_validate() {
		$Update = array();

		if( !empty( $_POST[$this->UPFN] ) ) {
			$UPFN = strip_tags( $_POST[$this->UPFN] );
			if( $UPFN == $this->UPFN ) {
				$Update["UPFN"] = strip_tags( $_POST[$this->UPFN] );
			}
		}

		return $Update;
	}

	// DataUpdate
	function update_reset( $record ) {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {
			$record = apply_filters( 'wauc_pre_delete' , $this->Record[$record] );
			delete_option( $record );
			wp_redirect( add_query_arg( $this->MsgQ , 'delete' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_reset_all() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {
			
			foreach( $this->Record as $key => $record ) {
				if( $key != 'donate' ) {
					delete_option( $record );
				}
			}
			wp_redirect( add_query_arg( $this->MsgQ , 'delete' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function DonatingCheck() {
		$Update = $this->update_validate();

		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {
			if( !empty( $_POST["donate_key"] ) ) {
				$SubmitKey = md5( strip_tags( $_POST["donate_key"] ) );
				if( $this->DonateKey == $SubmitKey ) {
					update_option( $this->Record["donate"] , $SubmitKey );
					wp_redirect( add_query_arg( $this->MsgQ , 'donated' ) );
					exit;
				}
			}
		}

	}

	// DataUpdate
	function update_userrole() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"]["user_role"] ) ) {
				foreach($_POST["data"]["user_role"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["user_role"] , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_site() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["site"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_admin_general() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = $val;
					$Update[$tmpK] = $tmpV;
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["admin_general"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_dashboard() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = $val;
					$Update[$tmpK] = $tmpV;
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["dashboard"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_admin_bar_menu() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $boxtype => $nodes) {
					if( $boxtype === 'left' or $boxtype === 'right' ) {
						foreach($nodes as $key => $node) {
							$id = "";
							if( !empty( $node["id"] ) ) {
								$id = strip_tags( $node["id"] );
							}
							$title = "";
							if( !empty( $node["title"] ) ) {
								$title = stripslashes( $node["title"] );
							}
							$href = "";
							if( !empty( $node["href"] ) ) {
								$href = strip_tags( $node["href"] );
							}
							$group = "";
							if( !empty( $node["group"] ) ) {
								$group = intval( $node["group"] );
							}
							$parent = "";
							if( !empty( $node["parent"] ) ) {
								$parent = strip_tags( $node["parent"] );
							}
							$node_type = "";
							if( !empty( $node["node_type"] ) ) {
								$node_type = strip_tags( $node["node_type"] );
							}
							$meta = array();
							if( !empty( $node["meta"] ) ) {
								foreach( $node["meta"] as $mk => $mv ) {
									if( !empty( $mv ) ) {
										$meta[strip_tags($mk)] = strip_tags($mv);
									}
								}
							}

							$Update[$boxtype][$node_type][] = array( "id" => $id , "title" => $title , "href" => $href , "parent" => $parent , "group" => $group ,  "meta" => $meta );
						}
					}
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["admin_bar_menu"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_sidemenu() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $menu) {
					if( !empty( $menu["title"] ) && !empty( $menu["slug"] ) ) {
						$slug = htmlspecialchars( $menu["slug"] );
						$title = stripslashes( $menu["title"] );
						$parent_slug = '';
						$depth = 'main';

						if( !empty( $menu["parent_slug"] ) ) {
							$parent_slug = strip_tags( $menu["parent_slug"] );
							$depth = 'sub';
						}

						$Update[$depth][] = array( "slug" => $slug , "title" => $title , "parent_slug" => $parent_slug );
					}
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["sidemenu"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_manage_metabox() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $post_type => $val) {
					$post_type = strip_tags( $post_type );
					if( is_array( $val ) ) {
						foreach($val as $id => $v) {
							$tmpK = strip_tags( $id );
							$tmpV = $v;
							$Update[$post_type][$tmpK] = $tmpV;
						}
					}
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["manage_metabox"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_post_add_edit() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $edited => $val) {
					$tmpK = strip_tags( $edited );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["post_add_edit"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_appearance_menus() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $edited => $val) {
					$tmpK = strip_tags( $edited );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["appearance_menus"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;
		}
	}

	// DataUpdate
	function update_loginscreen() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = $val;
					$Update[$tmpK] = $tmpV;
				}
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["loginscreen"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;

		}
	}

	// DataUpdate
	function update_plugincap() {
		$Update = $this->update_validate();
		if( !empty( $Update ) && check_admin_referer( $this->Nonces["value"] , $this->Nonces["field"] ) ) {

			if( !empty( $_POST["data"]["edit_cap"] ) ) {
				$Update["edit_cap"] = strip_tags( $_POST["data"]["edit_cap"] );
			}

			$Record = apply_filters( 'wauc_pre_update' , $this->Record["plugin_cap"] );
			update_option( $Record , $Update );
			wp_redirect( add_query_arg( $this->MsgQ , 'update' , stripslashes( $_POST["_wp_http_referer"] ) ) );
			exit;

		}
	}





	// FilterStart
	function FilterStart() {

		// site
		if( !is_admin() ) {
			add_action( 'wp_loaded' , array( $this , 'remove_action_front' ) ) ;
			add_filter( 'login_headerurl' , array( $this , 'login_headerurl' ) );
			add_filter( 'login_headertitle' , array( $this , 'login_headertitle' ) );
			add_action( 'login_head' , array( $this , 'login_head' ) );
			add_action( 'login_footer' , array( $this , 'login_footer' ) );

			// front init
			add_action( 'wp_loaded' , array( $this , 'front_init' ) );
		}

		// admin UI
		if( is_admin() && !is_network_admin () ) {
			// admin init
			add_action( 'wp_loaded' , array( $this , 'admin_init' ) );
		}

	}
	
	// FilterStart
	function admin_init() {

		$SettingRole = $this->get_data( 'user_role' );
		$SettingRole = apply_filters( 'wauc_pre_setting_roles' , $SettingRole );

		if( !empty( $SettingRole ) ) {
			unset($SettingRole["UPFN"]);

			$UserRole = $this->current_user_role_group();

			if( !is_network_admin() && !empty( $UserRole ) ) {
				if( array_key_exists( $UserRole , $SettingRole ) ) {
					add_action( 'wp_before_admin_bar_render' , array( $this , 'admin_bar_menu') , 25 );
					add_action( 'wp_loaded' , array( $this , 'notice_dismiss' ) , 2 );
					add_action( 'admin_head' , array( $this , 'remove_tab' ) );
					add_filter( 'admin_footer_text' , array( $this , 'admin_footer_text' ) );
					add_action( 'admin_print_styles' , array( $this , 'load_css' ) );
					add_action( 'wp_dashboard_setup' , array( $this , 'wp_dashboard_setup' ) , 11 );
					add_action( 'admin_head' , array( $this , 'manage_metabox' ) , 11 );
					add_filter( 'admin_head', array( $this , 'sidemenu' ) );
					add_filter( 'get_sample_permalink_html' , array( $this , 'add_edit_post_change_permalink' ) );
					add_filter( 'edit_form_after_title' , array( $this , 'allow_comments' ) );
					add_action( 'admin_print_styles-nav-menus.php', array( $this , 'nav_menus' ) );
					add_filter( 'admin_title', array( $this, 'admin_title' ) );
					add_action( 'admin_footer' , array( $this , 'admin_bar_resizing' ) );
				}
			}
		}
	}

	// FilterStart
	function front_init() {

		$SettingRole = $this->get_flit_data( 'user_role' );
		$SettingRole = apply_filters( 'wauc_pre_setting_roles' , $SettingRole );

		if( !empty( $SettingRole ) ) {
			unset($SettingRole["UPFN"]);

			$UserRole = $this->current_user_role_group();

			if( !is_network_admin() && !empty( $UserRole ) ) {
				if( array_key_exists( $UserRole , $SettingRole ) ) {

					add_action( 'wp_footer' , array( $this , 'admin_bar_resizing' ) );

					$GetData = $this->get_flit_data( 'site' );
					
					if( !empty( $GetData["admin_bar"] ) ) {
						if( $GetData["admin_bar"] == "hide" ) {
							add_filter( 'show_admin_bar' , '__return_false' );
						} elseif( $GetData["admin_bar"] == "front" ) {
							add_action( 'init' , array( $this , 'notice_dismiss' ) , 2 );
							add_action( 'wp_before_admin_bar_render' , array( $this , 'admin_bar_menu') , 25 );
						}
					}
				}
			}
		}
	}

	// FilterStart
	function remove_action_front() {
		$GetData = get_option( $this->Record['site'] );
		
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );
			foreach($GetData as $key => $val) {
				if( $key == 'feed_links' ) {
					remove_action( 'wp_head', $key , 2 );
				} elseif( $key == 'feed_links_extra' ) {
					remove_action( 'wp_head', $key , 3 );
				} else {
					remove_action( 'wp_head', $key );
				}
			}
		}
	}

	// FilterStart
	function login_headerurl() {
		$GetData = get_option( $this->Record["loginscreen"] );

		$url = __( 'http://wordpress.org/' );
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_headerurl"] ) ) {
				$url = strip_tags( $GetData["login_headerurl"] );
				$url = $this->val_replace( $url );
			}
		}

		return $url;
	}

	// FilterStart
	function login_headertitle() {
		$GetData = get_option( $this->Record["loginscreen"] );

		$title = __( 'Powered by WordPress' );
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_headertitle"] ) ) {
				$title = strip_tags( $GetData["login_headertitle"] );
				$title = $this->val_replace( $title );
			}
		}

		return $title;
	}

	// FilterStart
	function login_head() {
		$GetData = get_option( $this->Record["loginscreen"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_headerlogo"] ) ) {
				$logo = strip_tags( $GetData["login_headerlogo"] );
				$logo = $this->val_replace( $logo );

				echo '<style type="text/css">.login h1 a { background-image: url(' . $logo . '); }</style>';
			}

			if( !empty( $GetData["login_css"] ) ) {
				$css = strip_tags( $GetData["login_css"] );
				$css = $this->val_replace( $css );

				wp_enqueue_style( $this->PageSlug , $css , array() , $this->Ver );
			}

		}

	}

	// FilterStart
	function login_footer() {
		$GetData = get_option( $this->Record["loginscreen"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_footer"] ) ) {
				$text = $this->val_replace( stripslashes( $GetData["login_footer"] ) );

				echo $text;
			}

		}
	}

	// FilterStart
	function admin_bar_menu() {
		global $wp_admin_bar;
		
		$GetData = $this->get_flit_data( 'admin_bar_menu' );
		
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );
			if( is_array( $GetData ) ) {

				// admin bar initialize nodes
				$All_Nodes = $wp_admin_bar->get_nodes();
				foreach( $All_Nodes as $node ) {
					if( $node->id != 'top-secondary' ) {
						$wp_admin_bar->remove_node( $node->id );
					}
				}

				$SettingNodes = $GetData;
				$user_id      = get_current_user_id();
				$current_user = wp_get_current_user();
				$profile_url  = get_edit_profile_url( $user_id );
				$update_data = wp_get_update_data();
				$activated_plugin = $this->ActivatedPlugin;
				$other_plugin = $this->OtherPluginMenu;

				// all nodes adjustment
				foreach($SettingNodes as $Boxtype => $allnodes) {
					foreach($allnodes as $node_type => $nodes) {
						foreach($nodes as $key => $node) {

							if( strstr( $node["id"] , 'custom_node' ) ) {
								if( !empty( $node["group"] ) ) {
									$node["meta"]["class"] = 'ab-sub-secondary';
								} else {
									$node["href"] = $this->val_replace( $node["href"] );
								}
							} elseif( $node["id"] == 'edit-post_type' ) {
								if( !empty( $All_Nodes["edit"] ) ) {
									$node["title"] = $All_Nodes["edit"]->title;
									$node["href"] = $All_Nodes["edit"]->href;
									$node["id"] = $All_Nodes["edit"]->id;
								} else {
									unset( $SettingNodes[$Boxtype][$node_type][$key] );
									continue;
								}
							} elseif( !empty( $All_Nodes[$node["id"]] ) ) {
								if( $node["id"] == 'search' ) {
									$node["href"] = $All_Nodes[$node["id"]]->href;
									$node["title"] = $All_Nodes[$node["id"]]->title;
								} else {
									$node["href"] = $All_Nodes[$node["id"]]->href;
								}
							} else {
								unset( $SettingNodes[$Boxtype][$node_type][$key] );
								continue;
							}
							if( !empty( $All_Nodes[$node["id"]]->meta["title"] ) ) {
								$node["meta"]["title"] = $All_Nodes[$node["id"]]->meta["title"];
							}
							if( $Boxtype == 'right' && $node_type == 'main' ) {
								$node["parent"] = "top-secondary";
							}
							if( strstr( $node["title"] , '[comment_count]') ) {
								if ( !current_user_can('edit_posts') ) {
									unset( $SettingNodes[$Boxtype][$node_type][$key] );
									continue;
								} else {
									$node["title"] = str_replace( '[comment_count]' , '<span class="ab-icon"></span><span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-[comment_count]">[comment_count_format]</span>' , $node["title"] );
								}
							}
							if( strstr( $node["title"] , '[update_total]') ) {
								if ( !$update_data['counts']['total'] ) {
									unset( $SettingNodes[$Boxtype][$node_type][$key] );
									continue;
								} else {
									$node["title"] = str_replace( '[update_total]' , '<span class="ab-icon"></span><span class="ab-label">[update_total_format]</span>' , $node["title"] );
								}
							}
							if( strstr( $node["title"] , '[update_plugins]') ) {
								if ( !$update_data['counts']['plugins'] ) {
									unset( $SettingNodes[$Boxtype][$node_type][$key] );
									continue;
								} else {
									$node["title"] = str_replace( '[update_plugins]' , '[update_plugins_format]' , $node["title"] );
								}
							}
							if( strstr( $node["title"] , '[update_themes]') ) {
								if ( !$update_data['counts']['themes'] ) {
									unset( $SettingNodes[$Boxtype][$node_type][$key] );
									continue;
								} else {
									$node["title"] = str_replace( '[update_themes]' , '[update_themes_format]' , $node["title"] );
								}
							}
							if( $node["id"] == 'logout' ) {
								$node["href"] = wp_logout_url();
							}
							if( $node["id"] == 'my-account' ) {
								$avatar = get_avatar( $user_id , 16 );
								$class  = empty( $avatar ) ? '' : 'with-avatar';
								$node["meta"]["class"] = $class;
							}
							if( !isset( $node["group"] ) ) {
								$node["group"] = "";
							}

							$node["title"] = $this->val_replace( $node["title"] );

							$SettingNodes[$Boxtype][$node_type][$key] = $node;

						}
					}
				}
				
				// other plugin nodes
				foreach($SettingNodes as $Boxtype => $allnodes) {
					foreach($allnodes as $node_type => $nodes) {
						foreach($nodes as $key => $node) {
							if( !empty( $activated_plugin ) ) {
								if( $node["id"] == 'bp-notifications' ) {
									foreach($All_Nodes as $default_node_id => $default_node) {
										if( $default_node->parent == $node["id"] ) {
											$subnode_type = '';
											if( $node_type == 'main' ) {
												$subnode_type = 'sub';
											} elseif( $node_type == 'sub' ) {
												 $subnode_type = 'sub2';
											} elseif( $node_type == 'sub2' ) {
												$subnode_type = 'sub3';
											} elseif( $node_type == 'sub3' ) {
												$subnode_type = 'sub4';
											}
											if( !empty( $subnode_type ) ) {
												$SettingNodes[$Boxtype][$subnode_type][] = (array) $default_node;
											}
										}
									}
								}
								foreach( $activated_plugin as $plugin_slug => $v ) {
									if( !empty( $other_plugin["admin_bar"][$plugin_slug] ) && array_key_exists( $node["id"] , $other_plugin["admin_bar"][$plugin_slug] ) ) {
										$SettingNodes[$Boxtype][$node_type][$key]["title"] = $All_Nodes[$node["id"]]->title;
										$SettingNodes[$Boxtype][$node_type][$key]["href"] = $All_Nodes[$node["id"]]->href;
									}
								}
							}
						}
					}
				}

				// add main nodes
				foreach($SettingNodes as $Boxtype => $allnodes) {
					foreach($allnodes as $node_type => $nodes) {
						if( $node_type == 'main' ) {
							foreach($nodes as $node_id => $node) {
								$args = array( "id" => $node["id"] , "title" => stripslashes( $node["title"] ) , "href" => $node["href"] , "parent" => $node["parent"] , "group" => $node["group"] , "meta" => $node["meta"] );
								$wp_admin_bar->add_menu( $args );
								unset( $SettingNodes[$Boxtype][$node_type][$node_id] );
							}
						}
					}
				}

				// add all nodes
				foreach($SettingNodes as $Boxtype => $allnodes) {
					foreach($allnodes as $node_type => $nodes) {
						if( $node_type != 'main' ) {
							foreach($nodes as $node_id => $node) {
								if( empty( $node["group"] ) ) {
									$args = array( "id" => $node["id"] , "title" => stripslashes( $node["title"] ) , "href" => $node["href"] , "parent" => $node["parent"] , "group" => false , "meta" => $node["meta"] );
									$wp_admin_bar->add_menu( $args );
									unset( $SettingNodes[$Boxtype][$node_type][$node_id] );
								}
							}
						}
					}
				}

				// add groups
				foreach($SettingNodes as $Boxtype => $allnodes) {
					foreach($allnodes as $node_type => $nodes) {
						foreach($nodes as $node_id => $node) {
							if( !empty( $node["group"] ) ) {
								$args = array( "id" => $node["id"] , "parent" => $node["parent"] , "meta" => $node["meta"] );
								$wp_admin_bar->add_group( $args );
								unset( $SettingNodes[$Boxtype][$node_type][$node_id] );
							}
						}
					}
				}

			}
		}

	}

	// FilterStart
	function notice_dismiss() {
		$GetData = $this->get_flit_data( 'admin_general' );

		if( !empty( $GetData["UPFN"] ) ) {

			if( !empty( $GetData["notice_update_core"] ) ) {
				add_filter( 'update_footer' , '__return_false' , 20) ;
				add_filter( 'site_transient_update_core' , array( $this , 'notice_update_core' ) );
			}

			if( !empty( $GetData["notice_update_plugin"] ) ) {
				add_filter( 'site_transient_update_plugins' , array( $this , 'notice_update_plugin' ) );
			}
			if( !empty( $GetData["notice_update_theme"] ) ) {
				add_filter( 'site_transient_update_themes' , array( $this , 'notice_update_theme' ) );
			}

		}

	}

	// FilterStart
	function notice_update_core( $site_transient_update_core ) {
		if( !empty( $site_transient_update_core ) && !empty( $site_transient_update_core->updates[0] ) && !empty( $site_transient_update_core->updates[0]->response ) ) {
			$site_transient_update_core->updates[0]->response = 'latest';
		}
		
		return $site_transient_update_core;
	}

	// FilterStart
	function notice_update_plugin( $site_transient_update_plugins ) {
		if( isset( $site_transient_update_plugins->response ) ) {
			unset( $site_transient_update_plugins->response );
		}
		
		return $site_transient_update_plugins;
	}

	// FilterStart
	function notice_update_theme( $site_transient_update_themes ) {
		if( isset( $site_transient_update_themes->response ) ) {
			unset( $site_transient_update_themes->response );
		}
		
		return $site_transient_update_themes;
	}

	// FilterStart
	function remove_tab() {
		$GetData = $this->get_flit_data( 'admin_general' );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["help_tab"] ) ) {
				$screen = get_current_screen();
				if( !empty( $screen ) ) {
					$screen->remove_help_tabs();
				}
			}
	
			if( !empty( $GetData["screen_option_tab"] ) ) {
				add_filter( 'screen_options_show_screen' , '__return_false' );
			}
		}
	}

	// FilterStart
	function admin_footer_text( $text ) {
		$GetData = $this->get_flit_data( 'admin_general' );

		$footer_text = $text;
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			$footer_text = $this->val_replace( stripslashes( $GetData["footer_text"] ) );
		}

		return $footer_text;
	}

	// FilterStart
	function load_css() {
		$GetData = $this->get_flit_data( 'admin_general' );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["css"] ) ) {

				$css = strip_tags( $GetData["css"] );
				$css = $this->val_replace( $css );

				wp_enqueue_style( $this->PageSlug . '-custom' , strip_tags( $css ) , array() , $this->Ver );
			}
	
		}
	}

	// FilterStart
	function wp_dashboard_setup() {
		global $wp_meta_boxes;

		$Data = $this->get_flit_data( 'dashboard' );

		if( !empty( $Data ) && is_array( $Data ) ) {
			unset( $Data["UPFN"] );

			if( !empty( $Data["metabox_move"] ) ) {
				wp_enqueue_script( 'not-move' , $this->Url . 'js/dashboard/not_move.js' , array( 'jquery' , 'jquery-ui-sortable' , 'dashboard' ) , $this->Ver , true );
				unset( $Data["metabox_move"] );
			}

			if( !empty( $Data["show_welcome_panel"] ) ) {
				$user_id = get_current_user_id();
				if( get_user_meta( $user_id , 'show_welcome_panel' , true ) == true ) {
					update_user_meta( $user_id , 'show_welcome_panel' , 0 );
				}
			}

			foreach( $wp_meta_boxes["dashboard"] as $context => $meta_box ) {
				foreach( $meta_box as $priority => $box ) {
					foreach( $box as $metabox_id => $b ) {
						if( !empty( $Data[$metabox_id]["remove"] ) ) {
							remove_meta_box( $metabox_id , 'dashboard' , $context );
						} elseif( !empty( $Data[$metabox_id]["name"] ) ) {
							$wp_meta_boxes["dashboard"][$context][$priority][$metabox_id]["title"] = stripslashes( $Data[$metabox_id]["name"] );
						}
					}
				}
			}
		}

	}

	// FilterStart
	function manage_metabox() {
		global $wp_meta_boxes, $current_screen, $post_type;

		$GetData = $this->get_flit_data( 'manage_metabox' );
		
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData ) && is_array( $GetData ) ) {

				if( $current_screen->base == 'post' ) {

					if( !empty( $GetData[$post_type] ) ) {

						$Metaboxes = $wp_meta_boxes[$post_type];
						$Data = $GetData[$post_type];
	
						$Remove_metaboxes = array();
						foreach( $Metaboxes as $context => $meta_box ) {
							foreach( $meta_box as $priority => $box ) {
								foreach( $box as $metabox_id => $b ) {
									if( !empty( $Data[$metabox_id]["remove"] ) ) {
										remove_meta_box( $metabox_id , $post_type , $context );
									} elseif( !empty( $Data[$metabox_id]["name"] ) ) {
										$wp_meta_boxes[$post_type][$context][$priority][$metabox_id]["title"] = stripslashes( $Data[$metabox_id]["name"] );
									}
								}
							}
						}

					}

				}
			}
		}

	}

	// FilterStart
	function sidemenu() {
		global $menu;
		global $submenu;

		$GetData = $this->get_flit_data( 'sidemenu' );
		$General = $this->get_flit_data( 'admin_general' );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData ) && is_array( $GetData ) && !empty( $GetData["main"] ) ) {
				$SetMain_menu = array();
				$SetMain_submenu = array();
				
				$separator_menu = array( 0 => "" , 1 => 'read' , 2 => 'separator1' , 3 => "" , 4 => 'wp-menu-separator' );
				
				foreach($GetData["main"] as $mm_pos => $mm) {
					if($mm["slug"] == 'separator') {
						$SetMain_menu[] = $separator_menu;
					} else {
						$gm_search = false;
						foreach($menu as $gm_pos => $gm) {
							if($mm["slug"] == $gm[2]) {
								if( strstr( $mm["title"] , '[comment_count]') ) {
									$mm["title"] = str_replace( '[comment_count]' , '<span class="update-plugins count-[comment_count]"><span class="theme-count">[comment_count_format]</span></span>' , $mm["title"] );
								}
								if( strstr( $mm["title"] , '[update_total]') ) {
									$mm["title"] = str_replace( '[update_total]' , '<span class="update-plugins count-[update_total]"><span class="update-count">[update_total_format]</span></span>' , $mm["title"] );
								}
								if( strstr( $mm["title"] , '[update_plugins]') ) {
									$mm["title"] = str_replace( '[update_plugins]' , '<span class="update-plugins count-[update_plugins]"><span class="plugin-count">[update_plugins_format]</span></span>' , $mm["title"] );
								}
								if( strstr( $mm["title"] , '[update_themes]') ) {
									$mm["title"] = str_replace( '[update_themes]' , '<span class="update-plugins count-[update_themes]"><span class="theme-count">[update_themes_format]</span></span>' , $mm["title"] );
								}
								$menu[$gm_pos][0] = $this->val_replace( $mm["title"] );
								$SetMain_menu[] = $menu[$gm_pos];
								$gm_search = true;
								break;
							}
						}
						if( empty( $gm_search ) ) {
							foreach($submenu as $gsm_parent_slug => $v) {
								foreach($v as $gsm_pos => $gsm) {
									if($mm["slug"] == $gsm[2]) {
										
										foreach($menu as $tmp_m) {
											if( $tmp_m[2] == $gsm_parent_slug) {
												$submenu[$gsm_parent_slug][$gsm_pos][4] = $tmp_m[4];
												break;
											}
										}
										if( strstr( $mm["title"] , '[comment_count]') ) {
											$mm["title"] = str_replace( '[comment_count]' , '<span class="update-plugins count-[comment_count]"><span class="theme-count">[comment_count_format]</span></span>' , $mm["title"] );
										}
										if( strstr( $mm["title"] , '[update_total]') ) {
											$mm["title"] = str_replace( '[update_total]' , '<span class="update-plugins count-[update_total]"><span class="update-count">[update_total_format]</span></span>' , $mm["title"] );
										}
										if( strstr( $mm["title"] , '[update_plugins]') ) {
											$mm["title"] = str_replace( '[update_plugins]' , '<span class="update-plugins count-[update_plugins]"><span class="plugin-count">[update_plugins_format]</span></span>' , $mm["title"] );
										}
										if( strstr( $mm["title"] , '[update_themes]') ) {
											$mm["title"] = str_replace( '[update_themes]' , '<span class="update-plugins count-[update_themes]"><span class="theme-count">[update_themes_format]</span></span>' , $mm["title"] );
										}
										$submenu[$gsm_parent_slug][$gsm_pos][0] = $this->val_replace( $mm["title"] );
										$SetMain_menu[] = $submenu[$gsm_parent_slug][$gsm_pos];

									}
								}
							}
						}
					}
				}

				if( !empty( $GetData["sub"] ) ) {
					foreach($GetData["sub"] as $sm_pos => $sm) {
						if($sm["slug"] == 'separator') {
							$SetMain_submenu[$sm["parent_slug"]][] = $separator_menu;
						} else {
							$gm_search = false;
							foreach($menu as $gm_pos => $gm) {
								if($sm["slug"] == $gm[2]) {
									if( strstr( $sm["title"] , '[comment_count]') ) {
										$sm["title"] = str_replace( '[comment_count]' , '<span class="update-plugins count-[comment_count]"><span class="theme-count">[comment_count_format]</span></span>' , $sm["title"] );
									}
									if( strstr( $sm["title"] , '[update_total]') ) {
										$sm["title"] = str_replace( '[update_total]' , '<span class="update-plugins count-[update_total]"><span class="update-count">[update_total_format]</span></span>' , $sm["title"] );
									}
									if( strstr( $sm["title"] , '[update_plugins]') ) {
										$sm["title"] = str_replace( '[update_plugins]' , '<span class="update-plugins count-[update_plugins]"><span class="plugin-count">[update_plugins_format]</span></span>' , $sm["title"] );
									}
									if( strstr( $sm["title"] , '[update_themes]') ) {
										$sm["title"] = str_replace( '[update_themes]' , '<span class="update-plugins count-[update_themes]"><span class="theme-count">[update_themes_format]</span></span>' , $sm["title"] );
									}
									$menu[$gm_pos][0] = $this->val_replace( $sm["title"] );
									$SetMain_submenu[$sm["parent_slug"]][] = $menu[$gm_pos];
									$gm_search = true;
									break;
								}
							}
							if( empty( $gm_search ) ) {
								foreach($submenu as $gsm_parent_slug => $v) {
									foreach($v as $gsm_pos => $gsm) {
										if($sm["slug"] == $gsm[2]) {
	
											if( strstr( $sm["title"] , '[comment_count]') ) {
												$sm["title"] = str_replace( '[comment_count]' , '<span class="update-plugins count-[comment_count]"><span class="theme-count">[comment_count_format]</span></span>' , $sm["title"] );
											}
											if( strstr( $sm["title"] , '[update_total]') ) {
												$sm["title"] = str_replace( '[update_total]' , '<span class="update-plugins count-[update_total]"><span class="update-count">[update_total_format]</span></span>' , $sm["title"] );
											}
											if( strstr( $sm["title"] , '[update_plugins]') ) {
												$sm["title"] = str_replace( '[update_plugins]' , '<span class="update-plugins count-[update_plugins]"><span class="plugin-count">[update_plugins_format]</span></span>' , $sm["title"] );
											}
											if( strstr( $sm["title"] , '[update_themes]') ) {
												$sm["title"] = str_replace( '[update_themes]' , '<span class="update-plugins count-[update_themes]"><span class="theme-count">[update_themes_format]</span></span>' , $sm["title"] );
											}
											$submenu[$gsm_parent_slug][$gsm_pos][0] = $this->val_replace( $sm["title"] );
											$SetMain_submenu[$sm["parent_slug"]][] = $submenu[$gsm_parent_slug][$gsm_pos];
										}
									}
								}
							}
						}
					}
				}

				$menu = $SetMain_menu;
				$submenu = $SetMain_submenu;
				
			} else {
				// empty menu
				$menu = array();
			}
		}
	}

	// FilterStart
	function add_edit_post_change_permalink( $permalink_html ) {
		$GetData = $this->get_flit_data( 'post_add_edit' );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData ) && is_array( $GetData ) ) {
				if( !empty( $GetData["default_permalink"] ) ) {
					if( strpos( $permalink_html , 'change-permalinks' ) ) {

						$permalink_html = preg_replace( "/<span id=\"change-permalinks\">(.*)<\/span>/" , "" , $permalink_html );

					}
				}
			}
		}
		
		return $permalink_html;
	}

	// FilterStart
	function allow_comments() {
		global $current_screen;
		
		$PostAddEdit = $this->get_flit_data( 'post_add_edit' );
		$RemoveMetaBox = $this->get_flit_data( 'manage_metabox' );
		
		if( !empty( $PostAddEdit["UPFN"] ) && !empty( $RemoveMetaBox["UPFN"] ) ) {
			if( $current_screen->action == 'add' ) {
				if( !empty( $RemoveMetaBox[$current_screen->id]["commentstatusdiv"] ) && !empty( $PostAddEdit["allow_comments"] ) ) {
					$comment_status = get_option( 'default_comment_status' );
					$comment_status = apply_filters( 'wauc_pre_get_comment_status' , $comment_status );
					if( $comment_status == 'open' ) {
						echo '<input name="comment_status" type="hidden" id="comment_status" value="open" />';
					}
				}
			}
			
		}

	}

	// FilterStart
	function admin_title( $title ) {
		$GetData = $this->get_flit_data( 'admin_general' );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["title_tag"] ) ) {
				if( strpos( $title , ' WordPress' ) ) {
					$title = str_replace( " &#8212; WordPress" , "" , $title );
				}
			}
		}
		
		return $title;
	}

	// FilterStart
	function nav_menus() {
		$GetData = $this->get_flit_data( 'appearance_menus' );
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["add_new_menu"] ) ) {
				echo '<style>.wrap > .manage-menus, .locations-row-links .locations-add-menu-link { display: none; }</style>';
			}
			if( !empty( $GetData["delete_menu"] ) ) {
				echo '<style>.major-publishing-actions .delete-action { display: none; }</style>';
			}

		}
	}

	// FilterStart
	function admin_bar_resizing() {
		global $wp_version;
		$GetData = $this->get_flit_data( 'admin_general' );

		if ( version_compare( $wp_version , '3.8' , '>=' ) && empty( $GetData["resize_admin_bar"] ) ) {
			wp_enqueue_style( $this->PageSlug . '-adminbar-resize' , $this->Url . 'css/adminbar/resize.css', array() , $this->Ver );
			if( is_admin() ) {
				wp_enqueue_script( $this->PageSlug . '-adminbar-resize' , $this->Url . 'js/adminbar/resize.js', array( 'jquery' ) , $this->Ver );
			} else {
				wp_enqueue_script( $this->PageSlug . '-adminbar-resize' , $this->Url . 'js/adminbar/resize-front.js', array( 'jquery' ) , $this->Ver );
			}
		}

	}

	// FilterStart
	function display_msg() {
		if( !empty( $_GET[$this->MsgQ] ) ) {
			$msg = strip_tags(  $_GET[$this->MsgQ] );
			if( $msg == 'update' or $msg == 'delete' ) {
				$this->Msg .= '<div class="updated"><p><strong>' . __( 'Settings saved.' ) . '</strong></p></div>';
			} elseif( $msg == 'donated' ) {
				$this->Msg .= '<div class="updated"><p><strong>' . __( 'Thank you for your donation.' , $this->ltd ) . '</strong></p></div>';
			}
		}
	}

	// FilterStart
	function layout_footer( $text ) {
		$text = '<img src="' . $this->Schema . 'www.gravatar.com/avatar/7e05137c5a859aa987a809190b979ed4?s=18" width="18" /> Plugin developer : <a href="' . $this->AuthorUrl . '?utm_source=use_plugin&utm_medium=footer&utm_content=' . $this->ltd . '&utm_campaign=' . str_replace( '.' , '_' , $this->Ver ) . '" target="_blank">gqevu6bsiz</a>';
		return $text;
	}

	// FilterStart
	function DisplayDonation() {
		$donation = get_option( $this->Record["donate"] );
		if( $this->DonateKey != $donation ) {
			$this->Msg .= '<div class="error"><p><strong>' . __( 'Thank you for considering donate.' , $this->ltd ) . '</strong> <a href="' . self_admin_url( 'admin.php?page=' . $this->PageSlug ) . '">' . __( 'Donate' , $this->ltd ) . '</a></p></div>';
		}
	}

}
$wauc = new WP_Admin_UI_Customize();

