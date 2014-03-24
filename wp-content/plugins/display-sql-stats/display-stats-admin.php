<?php 
dss_set_lang_file();
if (!current_user_can('manage_options'))  {
	wp_die( __('You do not have sufficient permissions to access this page.') );
}

global $chart_types_array;

/**
 * Display the plugin settings options page
 */


	print '<div class="wrap">';
	print '<h2><a href="'.DSS_AUTHOR_URI.'" target="_blank">'.DSS_PLUGIN_NAME.' '.DSS_CURRENT_VERSION.' ('.DSS_CURRENT_BUILD.')</a></h2>'."\n";
    //settings_errors();
 
 	print '<form method="post" action="options.php" id="dss_form">';
	//wp_nonce_field('update-options', '_wpnonce');
	settings_fields( 'dss_option-group');
 
	$dss_title_array=get_option("dss_title_array");
	$dss_type_array=get_option("dss_type_array");
	$dss_switch_array=get_option("dss_switch_array");
	$dss_sql_string_array=get_option("dss_sql_string_array");
	$dss_debug=get_option("dss_debug");
	$dss_store_deleted=get_option("dss_store_deleted", '1');
	$dss_notepad=get_option("dss_notepad", DSS_NOTEPAD_DEFAULT);
	
	if (isset($_POST["dss_action"]) && isset($_POST["dss_value"]) ) {
		$dss_action=$_POST["dss_action"];
		$dss_value=$_POST["dss_value"];
	}
	//print count($dss_sql_string_array);
	//print_r($dss_sql_string_array);
	
	// add or delete statement
	if (isset($dss_action)) {
		//print "$dss_action $dss_value<br />";
		if ($dss_action=="remove") {
			// remove empty not yet stored statement, do nothing
			$dss_message=__('Empty statement removed', 'dss');
		}
		if ($dss_action=="add") {
			$dss_message=__('Added new empty statement', 'dss');
			//$dss_value++;
			// add one empty sql statement after the current
			array_splice( $dss_title_array, $dss_value, 0, "" );
			array_splice( $dss_sql_string_array, $dss_value, 0, "" );
			array_splice( $dss_switch_array, $dss_value, 0, "on" );
			array_splice( $dss_type_array, $dss_value, 0, "" );
		}
		if ($dss_action=="delete") {
			$dss_message=__('Statement deleted', 'dss');
			// save in notepad
			if (isset($dss_store_deleted) && $dss_store_deleted==true) {
				$dss_notepad.="\n\n#".$dss_title_array[$dss_value];
				$dss_notepad.="\n".$dss_sql_string_array[$dss_value];
				$dss_message.=__(' and stored to notepad', 'dss');
			}
			array_splice($dss_title_array, $dss_value, 1);
			array_splice($dss_sql_string_array, $dss_value, 1);
			array_splice($dss_switch_array, $dss_value, 1);
			array_splice($dss_type_array, $dss_value, 1);
			// write new (without deleted) statements to database
			update_option( 'dss_title_array', $dss_title_array );
			update_option( 'dss_sql_string_array', $dss_sql_string_array );
			update_option( 'dss_switch_array', $dss_switch_array );
			update_option( 'dss_type_array', $dss_type_array );
			update_option( 'dss_notepad', $dss_notepad );
		}
		print '
		<div id="message" class="updated">
			<p><strong>'.$dss_message.'</strong></p>
		</div>';
	}

	
	print'
		<input type="hidden" name="page_options" value="dss_sql_string_array, dss_type_array, dss_switch_array, dss_debug, dss_store_deleted, dss_title_array" />
		<table class="form-table">
		<tr valign="top">
		<th scope="row">'.__('Enter your SQL statement(s) and give it/them a title.', 'dss').'</th>
		</tr>
		<tr>
		<td>
	';
	
	for ($i=0;$i<count($dss_sql_string_array);$i++) {
		print __('Title: ', 'dss').'<input type="text" name="dss_title_array['.$i.']" value="'.$dss_title_array[$i].'" size="50">
			<br />
			<table border="0"><tr>
			<td><textarea type="text" name="dss_sql_string_array['.$i.']" cols="100" rows="5">'.$dss_sql_string_array[$i].'</textarea></td>
			<td width="10"></td>
			<td valign="top">
 
  <select name="dss_type_array['.$i.']">'."\n";
 
			foreach ($chart_types_array as $chart_type_key=>$chart_type_value) {
				print '<option value="'.$chart_type_key.'"';
				if ($dss_type_array[$i]==$chart_type_key) print " selected";
				print '>'.$chart_type_value.'</option>'."\n";
			}
 
      
  print '</select>
		<br /><p>';
		
		if ($dss_switch_array[$i]=="") $dss_switch_array[$i]="on";
		print '
		<input type="radio" name="dss_switch_array['.$i.']" value="on"'.dss_checked($dss_switch_array[$i], "on").'> '.__('On', 'dss').'&nbsp;&nbsp;
		<input type="radio" name="dss_switch_array['.$i.']" value="off"'.dss_checked($dss_switch_array[$i], "off").'> '.__('Off', 'dss').'
		<br /><br />';
		
		
		if ($dss_sql_string_array[$i]!="") {
			// only show add button if the current statement is not empty
			print '<a href="javascript:submitTheForm(\'add\','.$i.');"><img title="'.__('Add a new SQL statement', 'dss').'" alt="Add" src="'.DSS_URL.'/img/plus-icon.png"></a>&nbsp;&nbsp;&nbsp;';
		}

		//if (count($dss_sql_string_array)>1  && $dss_sql_string_array[$i]!="") {
		if (count($dss_sql_string_array)>1 ) {
			// only show minus button if more than one statement exists and current is not empty
			if (isset($dss_action) && $dss_action=="add") $helpaction='remove'; else $helpaction='delete';
			print '<a href="javascript:submitTheForm(\''.$helpaction.'\','.$i.');"><img title="'.__('Delete this SQL stament', 'dss').'" alt="Delete" src="'.DSS_URL.'/img/minus-icon.png"></a>';
		}
	
	print '</td>
			</tr>
			</table>
			
			<br />
			<br />
		';
	}
	
	print
		'<input type="checkbox" name="dss_debug" value="1" '.dss_checked($dss_debug, "1").'/> '.__('Show debug information in dashboard', 'dss').'
		&nbsp;&nbsp;&nbsp;
		<input type="checkbox" name="dss_store_deleted" value="1" '.dss_checked($dss_store_deleted, "1").'/> '.__('Store deleted statements in notepad', 'dss').'
		<br />
		<p></p>
		<br />
		'.__('Notepad', 'dss').'
		<br />
		<textarea type="text" name="dss_notepad" cols="100" rows="10">'.$dss_notepad.'</textarea>
		</td>
		</tr>
		</table>

	';
 
 
	print '<p class="submit"><input type="submit" value="'.__('Save Changes', 'dss').'" /></p>';

	print '</form>';
	print '</div>';

	print '<br /><br /><br />';
	require_once('whatsup.php');
	
	

?>
<script type="text/javascript">
function submitTheForm (action, value) {
	//alert(action+value);
	document.getElementById('dss_action').value=action;
	document.getElementById('dss_value').value=value;
    document.getElementById('dss_plusminus').submit();
}
</script>
<form id="dss_plusminus" method="post" action="">
 	<input type="hidden" name="dss_action" id="dss_action" value="" />
	<input type="hidden" name="dss_value" id="dss_value" value="" />
</form>