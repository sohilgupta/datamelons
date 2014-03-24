<?php 
dss_set_lang_file();
if (!current_user_can('manage_options'))  {
	wp_die( __('You do not have sufficient permissions to access this page.') );
}

$dss_sql_string_array=get_option("dss_sql_string_array");
$dss_switch_array=get_option("dss_switch_array");

if (get_option("dss_debug")) {
	global $wpdb;
	foreach ($dss_sql_string_array as $key=>$single_statement) {
		if ($dss_switch_array[$key]=="on") {
			print "SQL $key:<br />".$single_statement."<br /><br />\n";
			$result = $wpdb->get_results($single_statement, ARRAY_N);
			ob_start();
			var_dump($result);
			$string = ob_get_clean();
			$string=str_replace ("{", "<br >&nbsp;&nbsp;&nbsp;{", $string);
			$string=str_replace ("}", "}<br >", $string);
			//print "Result:<br />".$string."<br /><br />\n";
		}
	}
	ob_start();
	include('display-stats-getdata.php');
	$string = ob_get_clean();
	print nl2br($string);
	print "\n<br /><p>";	
}

$i=0;
foreach ($dss_sql_string_array as $single_statement) {
	print '<div id="chart_div'.$i.'"></div>'."\n";
	$i++;
}
?>
