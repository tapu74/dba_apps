<?
//header('Content-type:text/html; charset=utf-8');
//session_start();
 
function connect() 
{
	$con = mysql_connect('localhost', 'tufazzul', 'tufazzul');
	if(!$con)
	{
		trigger_error("Unable to connect to the database server.");
		exit();
	}


	$db =  mysql_select_db('elite', $con);
	if(!$db)
	{
		trigger_error("Unable to locate database.");
		exit();
	}
	 
	return $con;
}

function disconnect($con) 
{
	$discdb = mysql_close($con);
	if(!$discdb)
	{
		trigger_error("Problem disconnecting database");
	}	
}

function return_next_id( $field_name, $table_name, $increment=0 )  			// Checked   3
{
	// This function will Return Last number of Row of table 
	// To generate next Id 
	// Return value:  number
	// Uses  single field:: return_next_id("id", "lib_buyer", "1");
	 
	$queryText="select max(".$field_name.") as ".$field_name."  from ".$table_name." "  ;
	$nameArray=sql_select( $queryText,1 );
	foreach ($nameArray as $result)
		return ($result[$field_name]+$increment);
	die;
}

function is_duplicate_field( $field_name, $table_name, $query_cond )   // checkd 3
{
	// This function will Return Last number of Row of table 
	// To generate next Id   
	//Return value:  true false
	// Uses  single field:: is_duplicate_field("buyer", "lib_buyer", "buyer_name like 'eta'");
	
	$queryText="select ".$field_name." from ".$table_name." where ".$query_cond.""  ;
	$nameArray=sql_select( $queryText );
	if ( count($nameArray)>0)
		return 1;
	else 
		return 0;
	die;
}
 
 
  
function sql_select($strQuery,$is_single_row)
{ 
    //$strQry=return_global_query($strQuery); 
	// return $strQry.'rashed';die;
	 
	$con = connect();
	
	$result_select = mysql_query($strQuery) or die(mysql_error());
	
	$rows = array();
	while($row = mysql_fetch_array($result_select))
	{
		if($is_single_row==1) 
		{
			$rows[] = $row;
			return $rows;
			disconnect($con);
			die;
		}
		else
			$rows[] = $row;
	}
	return $rows;
	disconnect($con);
	die;
}
 

function create_drop_down( $field_id, $field_width, $query, $field_list, $show_select, $select_text_msg, $selected_index, $onchange_func, $is_disabled, $array_index )
{
	
	//$drop_down_loader_data=$field_id."*".$field_width."*".$query."*".$field_list."*".$show_select."*".$select_text_msg."*".$selected_index."*".$onchange_func."*". $onchange_func_param_db."*".$onchange_func_param_sttc."*".$add_new_page_lnk."*".$div_id;
	
	if ($is_disabled==1) $is_disabled="disabled"; else $is_disabled="";
	
	if ($selected_index=="") $selected_index=0;	
	$field_list=explode(",",$field_list);
	//if ($multi_select !="" ) {  $multi_select ='multiple class="chzn-select"' ;   } else $multi_select ='class="combo_boxes"' ;
	$drop_down = '<select name="'.$field_id.'" id="'.$field_id.'" class="combo_boxes" '.$is_disabled.'  style="width:'.$field_width.'px" onchange="'.$onchange_func.'" '.$multi_select.'>\n';
	
	if( !is_array($query) )
	{
		if($show_select==1)
		{
            $drop_down .='<option value="0">'.$select_text_msg.'</option>\n';
		}
		$nameArray=sql_select( $query );
		
		foreach ($nameArray as $result)
		 {
			 $drop_down .='<option value="'.$result[$field_list[0]].'" ';
					if ($selected_index==$result[$field_list[0]]) { $drop_down .='selected'; } $drop_down .='>'.$result[$field_list[1]].'</option>\n';
		 }
	}
	else  // List from An Array
	{
		if($show_select==1)
		{
            $drop_down .='<option value="0">'.$select_text_msg.'</option>\n';
		}
		if ($array_index=="") $array_index=""; else $array_index=explode(",",$array_index);
		foreach($query as $key=>$value):
			if ($array_index=="")
			{
				$drop_down .='<option value="'.$key.'" ';
					if ($selected_index==$key) { $drop_down .='selected'; } $drop_down .='>'.$value.'</option>\n';
			}
			else
			{
				if( in_array($key,$array_index))
				{
					$drop_down .='<option value="'.$key.'" ';
						if ($selected_index==$key) { $drop_down .='selected'; } $drop_down .='>'.$value.'</option>\n';
				}
			}
		endforeach;			 
	}
	/*
	if($add_new_page_lnk!="")
	{
		$drop_down .='<option value="N">-- Add New --</option>\n';
	}*/
	$drop_down .='</select>';
	/*
	if( $_SESSION["user_level"]==2 )
	{
		if($add_new_page_lnk!="")
		{
			$add_new_page_fnc="add_new_library('".$drop_down_loader_data."','".$add_new_page_lnk."','".$div_id."')";
			 $drop_down .='&nbsp;&nbsp; <img src="../../images/add_new.gif" width="27" height="17" onclick="'.$add_new_page_fnc.'"/> ';
		}
	}*/
	return $drop_down;
	die;
}


function return_field_value_sql($field_name, $table_name, $query_cond)  // checked 3
{
	// This function will Return Single or Multiple field value 
	// concated with seperator having only one row result
	//Return value:  query result as filed value
	// Uses  single field:: return_field_value("buyer_name", "lib_buyer", "id=1");
	// Uses  multi field:: return_field_value("concate(buyer_name,'_',contact_person)", "lib_buyer", "id=1"); do not use concat
	 
 	$queryText="select ".$field_name." from ".$table_name." where ".$query_cond." "  ;
//	echo $queryText;die;
	$nameArray=sql_select( $queryText );
	foreach ($nameArray as $result) 	 
		return $result[$field_name];
	die;
}

function add_time($event_time,$event_length)
{ 
	$timestamp = strtotime("$event_time");
	$etime = strtotime("+$event_length minutes", $timestamp);
	$etime=date('H:i:s', $etime);
	return $etime;
}
?>