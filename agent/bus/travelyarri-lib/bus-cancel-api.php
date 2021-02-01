<?php
@session_start();
include_once "bus_library/SSAPICaller.php";
include_once "bus_library/BlockRequest.php";

  /*$cancelRequest = '{"tin":"'.$RBTicketNo.'",';
  foreach($passenger_seat as $val)
  {
	  if(!empty($val))
          $cancelRequest.='"seatsToCancel":["'.$val.'"],';
  }
  $cancelRequest = substr("$cancelRequest", 0, -1);  
  $cancelRequest.='}';
    //echo" <hr>The Request for Cancelling the Ticket:".$cancelRequest."<hr/>";
    //exit;*/
  $CancelTicket = json_decode(CancelTicket2($cancelRequest));
?>