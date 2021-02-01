<?php
$mode='agent';
unset($_SESSION[$mode]['seat']);
	include_once "SSAPICaller.php";
	include_once "BlockRequest.php";
	$inputString = getTripDetails($scheduleId);		
	$results = json_decode($inputString);
?> 
