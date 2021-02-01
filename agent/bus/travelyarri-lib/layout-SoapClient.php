<?php
	include_once "bus_library/SSAPICaller.php";
	include_once "bus_library/BlockRequest.php";
	$_SESSION['scedulr_id']=$scheduleId;
	echo $tDate=date('Y-m-d',strtotime(str_replace('/','-',$travelDate)));
	$inputString = GetRouteScheduleDetailsWithComm($scheduleId,$tDate);		
	$results = json_decode(json_encode($inputString),1);
	?> 
