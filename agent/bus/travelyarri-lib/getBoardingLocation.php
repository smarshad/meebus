<?php
	include_once "bus_library/SSAPICaller.php";
	include_once "bus_library/BlockRequest.php";
	
	function objectToArray($object) {
    	if (!is_object($object) && !is_array($object)) {
        	return $object;
    	}
    	if (is_object($object)) {
        	$object = get_object_vars($object);
    	}
    	return array_map('objectToArray', $object);
	}
	
	// Requesting for boarding id
	$bId = $_REQUEST['id'];
	$inputString = getBoardingPoint($bId);		
	$results = objectToArray(json_decode($inputString));		
	echo $results['address'];
?>