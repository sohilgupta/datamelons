=== Plugin Name ===
Contributors: hmayaktigranyan
Donate link: http://hmayaktigranyan.com/
Tags: google charts, charts, visualisation, bar chart, column chart, pie chart,table chart, chart chortcode, plugin
Requires at least: 2.8
Tested up to: 3.7.1
Stable tag: 1.1

Easily integrate google charts, diagrams and tables based on your Google Spreadsheets. 

== Description ==
WP Google Charts

Easily integrate google charts, diagrams and tables based on your Google Spreadsheets. Spice up your posts with cool visualisations!

This is a plugin that lets you easily integrate charts, diagrams and tables based on Google Spreadsheets into your pages and posts. Adding charts, diagrams and tables is a simple and flexible way to make complex data accessible and spice up your posts. 
What can you do with WP Google Charts
WP Google Charts lets you determine the type and size of your charts and diagrams using simple shortcode. It simply looks good, is free to use and saves you the hassle and restrictions of using Google's embed code. 

Using Google Spreadsheets may be better than using any proprietary solutions for your Wordpress. Your data remains portable, that is, when you move away from Wordpress (or even change your theme) you can still use it. WP Google Charts provides you with an easy way of displaying charts, diagrams and tables based on your spreadsheets.
The key features are:
-	Embed charts and diagrams from a Google spreadsheet using simple short code.
-	Display interactive and powerful visualisations of complex data.
-	Have full control over type and size of the charts and diagrams.
-	No need to go into the text editor in Wordpress.
When to use WP Google Charts
-	Rule of thumb: Any post or page for which you use statistics could look better and provide more information using charts, diagrams and tables.
-	You have data stored in a spreadsheet that you want to display in an accessible and interactive way on your Wordpress site.
-	You want to have full control over how you display charts, diagrams and tables, but spend little time on fiddling around with the settings.
-	You want to display tables from your spreadsheets that are easily accessible and can be created in less than two minutes.
-	WP Google Charts has originally been developed to provide human rights NGOs with a simple tool to publish information about violations. If your work is similar, it will be surely useful. If not, it still might be great (see rule of thumb).

So how exactly does it work?
You create your Google Spreadsheet, put your data into it and embed it in your posts and pages using straightforward short code. It's that simple. 
Shortcode sounds scary. How does it work?
It's simple. No need to bite your nails. A line of short code will look like this:

[agc key="0AmPXLjY4S5drdEJBbGR4MkJQWkJLQ0NFb1JqOGVPTGc" charttype="columnchart"  ]

Plugin support additional params:
-	gid (integer,default 0)
-	transpose (0 or 1,default 0)
-	stacked (true or false,default false) 
-	width (integer,default 600)
-	height (integer,default 400)
-	charttype ("table", "columnchart", "areachart", "barchart", "linechart", "piechart", "steppedareachart" default "columnchart")
-	columns (comma separated integers of column positions start by 0)

[agc key="0AmPXLjY4S5drdEJBbGR4MkJQWkJLQ0NFb1JqOGVPTGc"  gid="2" transpose="1" stacked="true" width="600" height="400" charttype="columnchart" columns="0,1,2" ]

The agc key is the key of your Google Doc. You can find it screenshots.

Gid is the page of your spreadsheet, so if it is on the first page it is "1", if it is on the second it is "two" and so on and so forth.

Transpose is where you can determine, if you want to reverse the columns. Can be useful for some graphs or charts. Changing the number from "1" to "0" can save you a lot of time . 

Stacked yes or no let's you determine, if the data will be shown in a more fine-grained way. Say you have a bar chart, where you want to show the constituency of each bar. This is how it looks like (see screenshot). If you want or need that, choose "yes", if not "no".

The chart type is easy. Just pick the one that you want to have from this list:

-	"table"
-	"columnchart"
-	"areachart"
-	"barchart"
-	"linechart"
-	"piechart"
-	"steppedareachart"

Columns is comma separated column ids of spreadsheet,remember it start from 0,like  columns="0,2,6".

If you have suggestions for a new add-on, feel free to let me know about it on http://www.hmayaktigranyan.com . 

This plugin sponsor is http://www.huridocs.org/


== Installation ==

1. Upload the files to the `/wp-content/plugins/wp-google-charts/` directory
2. Activate the "WP google charts" plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

== Screenshots ==

1. Make sure  spreadsheet is public
2. Charts

== Changelog ==
= 1.1 =
* added support for columns param
* fix for spreadsheet url containing special chars

= 1.0 =
* Initial features


== Upgrade Notice ==

Nothing to upgrade.
