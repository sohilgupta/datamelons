<?php

$dss_title_array=get_option("dss_title_array");
$dss_type_array=get_option("dss_type_array");
$dss_switch_array=get_option("dss_switch_array");
global $chart_types_array;

foreach ($dss_title_array as $i=>$single_title_value) {
	
	// chart visible?
	if ($dss_switch_array[$i]=="on") {
		print '	
		var options'.$i.' = {\'title\':\''.$single_title_value.'\',
			\'is3D\':true,
			\'width\':500,
			\'height\':500';
			// only set min/max values with barcharts
			if ($chart_types_array[$dss_type_array[$i]]=="BarChart") print ',
			\'hAxis\': { maxValue: \''.$maxval[$i].'\', minValue: \''.$minval[$i].'\', format: \'0\'}
			';
			
			print '};

		var chart'.$i.' = new google.visualization.'.$chart_types_array[$dss_type_array[$i]].'(document.getElementById(\'chart_div'.$i.'\'));
		
		chart'.$i.'.draw(data'.$i.', options'.$i.');
		';
	}
}
?>



