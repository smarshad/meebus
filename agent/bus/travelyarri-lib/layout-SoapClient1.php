<?php
	include_once "bus_library/SSAPICaller.php";
	include_once "bus_library/BlockRequest.php";
	$inputString = getTripDetails($scheduleid);		
	$results = json_decode($inputString);
?> 
