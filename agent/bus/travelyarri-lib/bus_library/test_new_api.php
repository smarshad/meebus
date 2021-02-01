<?php
	set_time_limit(60);
	include_once('../../database/connect.php');
	include_once "SSAPICaller.php";
	include_once "BlockRequest.php";
	


	$scr = getAllSources();
	//print_r($scr);exit;
	
	
	$json_o=json_decode($scr);
	print_r($json_o);

/*	$source = "3"; // 3 is Bangalore code 
	$destination = "102"; // 102 is Chennai code 
	$doj = "2012-10-26";

		$input  = getAvailableTrips($source,$destination,$doj);
	$json_o=json_decode($input);		
	var_dump($input);*/
/*
	if(is_array($json_o->cities))
	{
		foreach($json_o->cities as $cityToConsider)
		{
			mysql_query("INSERT INTO `stations` (`station_id`, `station_name`) VALUES ('".$cityToConsider->id."', '".$cityToConsider->name."')");
			echo $cityToConsider->name;
		}
	}*/
?>
