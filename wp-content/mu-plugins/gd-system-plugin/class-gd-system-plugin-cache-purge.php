<?php

/**
 * Copyright 2013 Go Daddy Operating Company, LLC. All Rights Reserved.
 */

// Make sure it's wordpress
if ( !defined( 'ABSPATH' ) )
    die( 'Forbidden' );

/**
 * Class GD_System_Plugin_Cache_Purge
 * Clear the cache at appropriate times.
 * @version 1.0
 * @author Kurt Payne <kpayne@godaddy.com>
 */
class GD_System_Plugin_Cache_Purge {

	/**
	 * Constructor
	 * Hook actions / filters
	 * @return GD_System_Plugin_Cache_Purge
	 */
	public function __construct() {

		// Theme change
		add_action( 'switch_theme', array( $this, 'ban_cache' ) );

		// Plugin activate/deactivate
		add_action( 'deactivated_plugin', array( $this, 'ban_cache' ) );
		add_action( 'activated_plugin',   array( $this, 'ban_cache' ) );

		// Core update
		add_action( '_core_updated_successfully', array( $this, 'ban_cache' ) );

		// Plugin / theme update
		add_action( 'upgrader_process_complete', array( $this, 'ban_cache' ) );

		// Permalink change
		add_action( 'update_option_permalink_structure', array( $this, 'ban_cache' ) );
		
		// Update posts
		add_action( 'publish_post',     array( $this, 'purge_cache' ) );
		add_action( 'edit_post',        array( $this, 'purge_cache' ) );
		add_action( 'deleted_post',     array( $this, 'purge_cache' ) );
		add_action( 'clean_post_cache', array( $this, 'purge_cache' ) );
		
		// Update comments
		add_action( 'comment_post',          array( $this, 'purge_comment' ) );
		add_action( 'wp_set_comment_status', array( $this, 'purge_comment' ) );
		add_action( 'edit_comment',          array( $this, 'purge_comment' ) );

		// Theme customizer
		add_action( 'customize_save',	array( $this, 'ban_cache' ) );

		// Changed widgets
		add_action( 'update_option_sidebars_widgets', array( $this, 'ban_cache' ) );		
	}

	/**
	 * Trigger a cache ban (purge all) before the page reloads
	 * @return void
	 */
	public function ban_cache() {
		add_action( 'shutdown', array( $this, 'do_ban_cache' ) );
	}

	/**
	 * Ban (purge all) the cache
	 * @return array Info about which requests failed
	 */
	public function do_ban_cache() {

		// Results
		$reasons = array();

		// Flush batcache, object cache
		if ( false === wp_cache_flush() ) {
			$reasons[] = 'Failed to flush object cache';
		}
		
		// @codeCoverageIgnoreStart
		// No gd-config
		if ( !defined( 'GD_VARNISH_SERVERS' ) ) {
			$reasons[] = 'No varnish servers defined';
			return $reasons;
		}
		// @codeCoverageIgnoreEnd

		// Flush varnish
		$url = get_home_url();
		foreach( explode( ',', GD_VARNISH_SERVERS ) as $varnish_server ) {
			if ( preg_match( '/http[s]?:\/\/([^\/]+)/i', $url, $matches ) ) {
				$_url = str_replace( $matches[1], $varnish_server, $url );
				$ret = wp_remote_request( $_url, array(
					'method' => 'BAN',
					'headers' => array(
						'Host'   => $matches[1]
					)
				) );
				if ( is_wp_error( $ret ) || !isset( $ret['response'] ) || !isset( $ret['response']['code'] ) || 200 != $ret['response']['code'] ) {
					$reasons[] = 'Failed to flush cache on ' . $varnish_server;
				}
			}
		}
		
		// Done
		return $reasons;
	}

	/**
	 * Purge a page from cache when there's a comment
	 * @param int $comment_id
	 * @return void
	 */
	public function purge_comment( $comment_id ) {
		$comment = get_comment( $comment_id );
		$post = get_post( $comment->comment_post_ID );
		$this->purge_cache( $post );
	}

	/**
	 * Purge a single page from the cache
	 * @param int $post_id
	 * @return void
	 */
	public function purge_cache( $post_id ) {

		// If it's not posted publicly, bail
		$post = get_post( $post_id );
		if ( true !== ( $post instanceof WP_Post ) ) {
			return;
		}
		if ( $post->post_type == 'revision' || !in_array( get_post_status( $post_id ), array( 'trash', 'publish' ) ) ) {
			return;
		}

		// Purge from batcache and varnish
		$urls = array(
			get_permalink( $post_id ),
			trailingslashit( get_option( 'home' ) ),
			get_option( 'home' ),
		);
		foreach ( $urls as $url ) {
			$this->batcache_clear_url( $url );
			foreach( explode( ',', GD_VARNISH_SERVERS ) as $varnish_server ) {
				if ( preg_match( '/http[s]?:\/\/([^\/]+)/i', $url, $matches ) ) {
					$_url = str_replace( $matches[1], $varnish_server, $url );
					wp_remote_request( $_url, array(
						'method' => 'PURGE',
						'headers' => array(
							'Host'   => $matches[1]
						)
					) );
				}
			}
		}
		
		// Trigger a flush on all php processes
		// USUALLY this is handled in the object cache completely
		// but if this is invoked from a CLI context and there
		// is no APC loaded, then this will still send
		// the signal out to all the child procs
		update_option( 'gd_system_last_cache_flush', time() );
	}
	
	/**
	 * Batcache helper function
	 * @param string $url
	 * @return bool
	 */
	public function batcache_clear_url( $url ) {
		global $batcache;
		if ( empty( $batcache ) || !( $batcache instanceof batcache ) ) {
			return;
		}
		if ( empty( $url ) ) {
			return false;
		}
		$url_key = md5( $url );
		wp_cache_add( "{$url_key}_version", 0, $batcache->group );
		return wp_cache_incr( "{$url_key}_version", 1, $batcache->group );
	}

  
  /**
   * test that a master cache flush triggers a local cache flush
   */
  public function test_master_cache_flush_triggers_local_cache_flush() {
    
    // Fresh object
    $gd_cache_purge = new GD_System_Plugin_Cache_Purge();
    
    // Request a flush
    update_option( 'gd_system_last_cache_flush', strtotime( 'now + 60 minutes' ) );
    apc_delete( 'gd_system_last_cache_flush' );
    
    // Check for flush
    $gd_cache_purge->check_for_flush();
    
    // Assert APC was updated
    $this->assertNotEmpty( apc_fetch( 'gd_system_last_cache_flush' ) );
    
    // Delete option
    delete_option( 'gd_system_last_cache_flush' );    
  }

}
