<?php

//$tdate = explode('/', $travelDate);
//$tdate = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];

include_once "bus_library/SSAPICaller.php";
//include_once "bus_library/BlockRequest.php";

//$source = $fromStationId; // 3 is Bangalore code
//$destination = $toStationId; // 102 is Chennai code
//$doj = $tdate;

$inputString = GetRouteScheduleDetailsWithComm();
$bus_data = json_decode(json_encode($inputString),1);
// for return date result
   /* $rdate = explode('/', $returnDate);
    $rdate = $rdate[2] . '-' . $rdate[1] . '-' . $rdate[0];

    $source1 = $toStationId; // 3 is Bangalore code
    $return1 = $fromStationId; // 102 is Chennai code
    $doj1 = $rdate;

    $inputString1 = Authenticate($source1, $return1, $doj1);
    $results_return = json_decode($inputString1);*/
	echo "<pre>";
print_r($bus_data);
echo "</pre>";
//exit;
?>
