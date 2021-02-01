<?php
include_once "server/server.php";
include "includes/pdo_functions.php";
$obj=new user_module($con);
include "bus_library/APICaller.php";
$res=getSources();
$station=$res['stationList'];
$i=0;
foreach($station as $sta)
{
	$data=array($sta['stationId'],$sta['stationName']);
	$obj->insStation($data);
	$i++;
}
echo $i. ' data inserted successfully';