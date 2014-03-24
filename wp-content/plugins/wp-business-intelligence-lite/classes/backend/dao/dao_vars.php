<?php

/***************************************************************************


	WP Business Intelligence Lite
	Author: WP Business Intelligence
	Website: www.wpbusinessintelligence.com
	Contact: http://www.wpbusinessintelligence.com/contactus/

	This file is part of WP Business Intelligence Lite.

    WP Business Intelligence Lite is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    WP Business Intelligence Lite is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with WP Business Intelligence Lite; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
	You can find a copy of the GPL licence here:
	http://www.gnu.org/licenses/gpl-3.0.html
	
******************************************************************************/


class dao_vars {

var $wpdb;
var $table_name;

function dao_vars($wpdb, $table_name){
	$this->wpdb = $wpdb;
	$this->table_name= $table_name;
}

function select($vo_vars=NULL){

	$where_clause = "";

	if(isset($vo_vars)){
		$var_id = $vo_vars->var_id;
		$where_clause = "where `var_id` = $var_id";
	}

	$query = "SELECT `VAR_ID`, `VAR_NAME`, `VAR_VALUE` FROM ".$this->table_name." $where_clause order by var_name asc";
	$rows = $this->wpdb->get_results($query);	
	$vo_vars = array();
	foreach($rows as $row){
		$item = new vo_vars($row->VAR_ID,$row->VAR_NAME,$row->VAR_VALUE);
		array_push($vo_vars, $item);
	}

	return $vo_vars;

}

function add($vo_vars){

	$var_id = $vo_vars->var_id;
	$var_name = $vo_vars->var_name;
	$var_value = $vo_vars->var_value;
 
	$query = "INSERT INTO ".$this->table_name."(`VAR_NAME`, `VAR_VALUE`) values ('$var_name','$var_value')";

return $this->wpdb->query($query);

}

function edit($vo_vars_old, $vo_vars_new){
	
	$var_id = $vo_vars_old->var_id;
	$var_name = $vo_vars_new->var_name;
	$var_value = $vo_vars_new->var_value;

	$query = "UPDATE ".$this->table_name." set `var_name` = '$var_name', `var_value` = '$var_value' where `var_id` = $var_id";

	return $this->wpdb->query($query);

}

function del($vo_vars){

	$where_clause = "";

	if(isset($vo_vars)){
		$var_id = $vo_vars->var_id;
		$where_clause = "where `var_id` = $var_id";
	}

	$query = "DELETE FROM ".$this->table_name." $where_clause";

	return $this->wpdb->query($query);

}

function rows(){

	$query = "SELECT * FROM ".$this->table_name;
	$rows = $this->wpdb->get_results($query);	
	return sizeof($rows);

}

}

?>
