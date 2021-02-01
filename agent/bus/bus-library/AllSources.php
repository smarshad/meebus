<?php

include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";
	include_once "SSAPICaller.php";


	$key = "wXrUqDBtPBxc10t4WYwv2qXjZ04ngP"; 
	$secret = "toDoow8ZCml1TbP0X3LogolK9zrGv7";
	$api_base_url = "http://api.seatseller.travel:9191/";
//$source = "2";

	echo "<form name='erw' action='AllDestination.php' method='post'>";
	echo "From: ";
	$sourceList = getSourcesAsDropDownList();
	echo $sourceList;

	if($_POST['sourceList'] != '')
	{
	echo "              To:";

	echo "selected city is: ".$_POST['sourceList'];

	$destinations= getDestinationAsDropDownList($_POST['sourceList']);
	echo $destinations;

	}
	echo "</form>";	
function getSourcesAsDropDownList()
	{
		global $scr,$sourceId,$sourcename;
		$scr = getAllSources();
		$json_o=json_decode($scr);
		$selectControlForSources = "<select onChange='submit()' id = 'sourceList' name='sourceList'>";
			if(is_array($json_o->cities))
			{
			foreach($json_o->cities as $cityToConsider)
				{
					$selectControlForSources = $selectControlForSources."<option value=". $cityToConsider->id.">"
									. $cityToConsider->name."</option>";
					}
				$selectControlForSources = $selectControlForSources."</select>";
			}
		return $selectControlForSources ;
	}
	
function getDestinationAsDropDownList($sourceId)
	{
		echo "getting destinations for".$sourceId;

		$scr = getDestinationForSource($sourceId);
		$json_o=json_decode($scr);
		$selectControlForSources = "<select onChange='submit()' id = 'sourceList' name='sourceList'>";
			if(is_array($json_o->cities))
			{
			foreach($json_o->cities as $cityToConsider)
				{
					$selectControlForSources = $selectControlForSources."<option value=". $cityToConsider->id.">"
									. $cityToConsider->name."</option>";
								
				}
				$selectControlForSources = $selectControlForSources."</select>";
			}
		return $selectControlForSources ;
	}

?>
