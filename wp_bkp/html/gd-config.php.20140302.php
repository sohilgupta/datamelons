<?php

define( 'GD_MEMCACHE_SOCK',    'unix:///var/chroot/var/tmp/moxi/datamelons.com.sock' );
#define( 'GD_MEMCACHE_SOCK',    'localhost:11211' );
define( 'WP_CACHE_KEY_SALT',   'mmfd8k67z680k24wkbg5' );
define( 'GD_SITE_KEY',         '#SITEKEY#' );
define( 'GD_BATCACHE_MAX_AGE', 300 );
define( 'GD_BATCACHE_HITS',    2 );
define( 'GD_BATCACHE_SECONDS', 120 );
define( 'GD_VARNISH_SERVERS', '184.168.224.117,184.168.224.131' );
define( 'GD_RESELLER', 1 );

// Newrelic tracking
if ( function_exists( 'newrelic_set_appname' ) ) {
	newrelic_set_appname( '04c77597-9bbf-11e3-9f65-14feb5d40a06;' . ini_get( 'newrelic.appname' ) );
}

/**
 * Is this is a mobile client?  Used by batcache.
 * @see https://github.com/Automattic/batcache
 * @see http://pastie.org/3239778
 * @return array
 */
function is_mobile_user_agent() {
	$mobile = array(
		"mobile_browser"             => 0,
		"mobile_browser_tablet"      => 0,
		"mobile_browser_smartphones" => 0,
		"mobile_browser_android"     => 0
	);
	if ( preg_match( '/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipod|android|blackberry|webos|windows (ce|phone)|iemobile)/i', strtolower( $_SERVER['HTTP_USER_AGENT'] ) ) ) {
		$mobile["mobile_browser"]++;
	} elseif ( ( strpos( strtolower( $_SERVER['HTTP_ACCEPT'] ),'application/vnd.wap.xhtml+xml') > 0 ) || ( ( isset( $_SERVER['HTTP_X_WAP_PROFILE'] ) || isset( $_SERVER['HTTP_PROFILE'] ) ) ) ) {
		$mobile["mobile_browser"]++;
	}

	$mobile_ua = strtolower( substr( $_SERVER['HTTP_USER_AGENT'], 0, 4 ) );
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-'
	);

	if ( in_array( $mobile_ua, $mobile_agents ) || ( isset( $_SERVER['ALL_HTTP'] ) && preg_match( '/(OperaMini|BlackBerry9800|Windows Phone OS 7\.0|Windows Phone OS/i' ) ) ) {
		$mobile["mobile_browser"]++;
	}

	// Tablets
	if ( preg_match( '/(iPad|Xoom|PlayBook)/i', $_SERVER['HTTP_USER_AGENT'] ) ) {
		$mobile["mobile_browser_tablet"]++;
	}

	// Smartphones
	if ( preg_match( '/(ipod|iphone|android|webos)/i', $_SERVER['HTTP_USER_AGENT'] ) ) {
		$mobile["mobile_browser_smartphones"]++;
	}

	// Android
	if ( preg_match( '/(android)/i', $_SERVER['HTTP_USER_AGENT'] ) ) {
		$mobile["mobile_browser_android"]++;
	}

	return $mobile;
}