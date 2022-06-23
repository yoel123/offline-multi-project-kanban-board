<?php

function yheader($src)
{
	echo'<script>window.location="'.$src.'";</script>';
}

function chackboxr_from_sql($arr,$name,$field,$checked_idsr=array(),$req=0)
{
	$ret = array();
	foreach($arr as $row)
	{
		if(in_array($row["id"],$checked_idsr))
		{
			
			$ret[] = array('value'=>$row["id"],'name'=>$name,'required'=>$req
			,'label'=>$row[$field],'checked'=> 1);
		}
		else{
			$ret[] = array('value'=>$row["id"],'name'=>$name,'required'=>$req
			,'label'=>$row[$field],'checked'=> 0);
		}
	}
	return $ret;
}//end chackboxr_from_sql


function ypagination($base_url,$entries,$per_page,$current_page=1)
{
	$html = "";
	$html .= "";
	return $html;
}//end ypagination

function array_remove_num_keys($arr)
{
	foreach ($arr as $key => $value) {
		if (is_int($key)) {
			unset($arr[$key]);
		}
	}
	return $arr;
}//end array_remove_num_keys

function array_remove_num_keys2d($arr)
{
	foreach ($arr as $key =>$row) {
		foreach ($row as $key2 => $value) {
			if (is_int($key2)) {
				unset($arr[$key][$key2]);
			}
		}
	}
	return $arr;
}//end array_remove_num_keys


function save_file($folderPath,$filename,$filecontent){
    if (strlen($filename)>0){
        if(!isset($folderPath)){$folderPath = 'temp';}
        if (!file_exists($folderPath)) {
            mkdir($folderPath);
        }
        $file = @fopen($folderPath . DIRECTORY_SEPARATOR . $filename,"w");
        if ($file != false){
            fwrite($file,$filecontent);
            fclose($file);
            return 1;
        }
        return -2;
    }
    return -1;
}


function yget_setting($arr,$name)
{
	foreach($arr as $row)
	{
		if($row['name'] == $name){return $row['value'];}
	}
	return false;
}//end yget_setting

function get_board_id()
{
	if(!isset($_SESSION["board_id"]))
	{
		return 1;//later it will be by session
	}
	else
	{
		return $_SESSION["board_id"];
	}
}//end get_board_id



?>