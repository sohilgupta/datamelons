<?php

/***************************************************************************

	WP Business Intelligence
	Author: Claudio Alberti
	Website: www.wpbusinessintelligence.com
	Contact: http://www.wpbusinessintelligence.com/contactus/

	This file is part of WP Business Intelligence.

    WP Business Intelligence is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    WP Business Intelligence is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with WP Business Intelligence; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
	You can find a copy of the GPL licence here:
	http://www.gnu.org/licenses/gpl-3.0.html
	
******************************************************************************/


//This file is used to display the created tables and charts

//import
include_once('../../../wp-load.php');
include_once('includes.php');

/***********************************************************************************/

//Show sql errors in debug mode
	if($wpbi_settings['parameter']['debug']){
		$wpdb->show_errors();
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
	} else{
		error_reporting(0);
	}


if(isset($_GET['t'])){
	echo '<html><body>';
	echo get_html_4_table($_GET['t']);
	echo '<br>';
	echo '</body></html>';	
} else if(isset($_GET['c'])){
	echo get_html_4_chart($_GET['c']);	
} else{
	echo 'No values';
}
?>