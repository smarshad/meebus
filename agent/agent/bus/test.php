<?php
include_once '../../server/server.php';
include_once "../../bus/bus-library/SSAPICaller.php";
include_once "../../bus/bus-library/BlockRequest.php";
include_once '../includes/functions.php';
$obj=new agent_module($con);  

include '../../bus/bus-library/book_tentative.php';

$BlockingID_oneway = 'l0iOzXBdXr';

$bookingDetail = confirmTicket($BlockingID_oneway);

//$bookingDetail = 'YTR27ZD';
echo $ticket_oneway = getTicket($bookingDetail);

?>


