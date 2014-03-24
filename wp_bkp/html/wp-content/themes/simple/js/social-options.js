/*
* Theme Name: Invention
* Theme URI: http://www.jozoor.com
* Description: Invention Theme for corporate and creative sites, responsive and clean layout, more than color skins
* Author: Jozoor team
* Author URI: http://www.jozoor.com
* Version: 1.0
*/

/*
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =  
=     00   00 00 00   00 00 00   00 00 00   00 00 00   00 00    =
=     00   00    00        00    00    00   00    00   00       =
=     00   00    00      00      00    00   00    00   00       =
=     00   00    00    00        00    00   00    00   00       =
=  00 00   00 00 00   00 00 00   00 00 00   00 00 00   00       =
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
*/

jQuery(document).ready(function($) {

// ============ twitter options ============== //
// footer option
jQuery("#tweets-footer").tweet({
  join_text: false,
  username: "jozoor", // Change username here
  modpath: './js/twitter/', // Twitter files path
  avatar_size: false, // you can active avatar
  count: 2, // number of tweets
  loading_text: "loading tweets...",
  seconds_ago_text: "about %d seconds ago",
  a_minutes_ago_text: "about a minute ago",
  minutes_ago_text: "about %d minutes ago",
  a_hours_ago_text: "about an hour ago",
  hours_ago_text: "about %d hours ago",
  a_day_ago_text: "about a day ago",
  days_ago_text: "about %d days ago",
  view_text: "view tweet on twitter"
});

jQuery("#tweets-footer-col4").tweet({
  join_text: false,
  username: "jozoor", // Change username here
  modpath: './js/twitter/', // Twitter files path
  avatar_size: false, // you can active avatar
  count: 1, // number of tweets
  loading_text: "loading tweets...",
  seconds_ago_text: "about %d seconds ago",
  a_minutes_ago_text: "about a minute ago",
  minutes_ago_text: "about %d minutes ago",
  a_hours_ago_text: "about an hour ago",
  hours_ago_text: "about %d hours ago",
  a_day_ago_text: "about a day ago",
  days_ago_text: "about %d days ago",
  view_text: "view tweet on twitter"
});
 
// sidebar option
jQuery("#tweets-sidebar").tweet({
  join_text: false,
  username: "jozoor", // Change username here
  modpath: './js/twitter/', // Twitter files path
  avatar_size: false, // you can active avatar
  count: 2, // number of tweets
  loading_text: "loading tweets...",
  seconds_ago_text: "about %d seconds ago",
  a_minutes_ago_text: "about a minute ago",
  minutes_ago_text: "about %d minutes ago",
  a_hours_ago_text: "about an hour ago",
  hours_ago_text: "about %d hours ago",
  a_day_ago_text: "about a day ago",
  days_ago_text: "about %d days ago",
  view_text: "view tweet on twitter"
});

// ============ flickr options ============== //
// footer option
$('#footer').jflickrfeed({
	limit: 6,
	qstrings: {
		id: '45388974@N00' // Flickr Id form feed Rss in your photostream in flickr profile 
		//( Don't know your ID? Go to http://idgettr.com/ to find it. )
	},
	itemTemplate: '<li><a href="{{link}}" title="{{title}}" target="_blank"><img src="{{image_m}}" alt="{{title}}" /></a></li>'
});

// sidebar option
$('#sidebar').jflickrfeed({
	limit: 6,
	qstrings: {
		id: '45388974@N00' // Flickr Id form feed Rss in your photostream in flickr profile
		//( Don't know your ID? Go to http://idgettr.com/ to find it. )
	},
	itemTemplate: '<li><a href="{{link}}" title="{{title}}" target="_blank"><img src="{{image_m}}" alt="{{title}}" /></a></li>'
});


});