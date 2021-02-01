<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
session_start();

if(isset($_REQUEST['bus_id']) && isset($_REQUEST['dat']) && isset($_REQUEST['to_dat']) && isset($_REQUEST['sp_id']) && isset($_REQUEST['seat_no']) && isset($_REQUEST['status'])){

    $fromdate=explode("-",$_REQUEST['dat']);
	$date1=mktime(0, 0, 0, $fromdate[1], $fromdate[0],$fromdate[2]);
	$fd=$fromdate[1]."/".$fromdate[0]."/".$fromdate[2];
	if(!empty($_REQUEST['to_dat'])){
	$todate=explode("-",$_REQUEST['to_dat']);
	$date2=mktime(0, 0, 0, $todate[1], $todate[0],$todate[2]);
	$tod=$todate[1]."/".$todate[0]."/".$todate[2];
	}
	else{
	$todate=0;
	$date2=0;
	}
	 
	if($date1 > $date2 && $date2!=0){
	   echo "Operation failed.Please Check your Choosen two dates. To date should be greater than(>) From date.";
	   exit;
	}
	else{
	
	/*$dateMonthYearArr = array();
    $fromDateTS = strtotime($fromDate);
    $toDateTS = strtotime($toDate);

    for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24)) {
     // use date() and $currentDateTS to format the dates in between
     $currentDateStr = date(“Y-m-d”,$currentDateTS);
     $dateMonthYearArr[] = $currentDateStr;
     //print $currentDateStr.”<br />”;
    }*/
	
	if($date2==0){	
    $bus_id=mysql_real_escape_string($_REQUEST['bus_id']);
	$dat=changedateformat(mysql_real_escape_string($_REQUEST['dat']));
	$sp_id=mysql_real_escape_string($_REQUEST['sp_id']);
	$status=mysql_real_escape_string($_REQUEST['status']);
	
	$b_dat = date("Y-m-d");
		
	$seat_no=explode("_",mysql_real_escape_string($_REQUEST['seat_no']));
	$seat=$seat_no[1];
	
	$LogID=$_SESSION['accessing_LogID'];
	$LogType=$_SESSION['accessing_type'];
	
	$block_sel_sql=mysql_query("SELECT * FROM bookinginfo WHERE SP_id=".$sp_id." AND Bus_id=".$bus_id." AND SeatNo='".$seat_no[1]."' AND travelling_date='".$dat."'") or die(mysql_error());
	if(mysql_num_rows($block_sel_sql)==1){

	   /*$updat_Seat_sql=mysql_query("UPDATE bookinginfo SET Blocked=".$status.", BlockedBy =".$LogID.", BlockedType=".$LogType."  WHERE SP_id=".$sp_id." AND Bus_id=".$bus_id." AND SeatNo='".$seat_no[1]."' AND (travelling_date='".$dat."' OR travelling_date='0000-00-00')") or die(mysql_error());*/ 
	   
	   $del_Seat_sql=mysql_query("DELETE FROM bookinginfo WHERE SP_id=".$sp_id." AND Bus_id=".$bus_id." AND SeatNo='".$seat_no[1]."' AND (travelling_date='".$dat."' OR travelling_date='0000-00-00')") or die(mysql_error());
	}
	else{
    $insert_Seat_sql="INSERT INTO  `bookinginfo` ( `auto_id` , `SP_id` , `Bus_id` ,`SeatNo`,`travelling_date` ,`booked_date`,  `Ticket_ID`,`userid` ,`usertype` ,`cancelledStatus` ,  `Blocked` ,  `BlockedBy` ,  `BlockedType` ,  `PaymentType`,  `pay_status` ) 
VALUES (NULL ,  '$sp_id',  '$bus_id',  '$seat',  '$dat',  '$b_dat',  '',  '',  '',  '',  '$status',  '$LogID',  '$LogType',  '0','1')";		 
      mysql_query($insert_Seat_sql) or die(mysql_error());
	}
	//echo $status;
	if($status == 1) {
	   echo "This Seat is Blocked on your selected Date";
	  }
	elseif($status == 0){
	   echo "This Seat is Unblocked on your selected Date";
	}  
	}
	else{
	 
	$dateMonthYearArr = array();
    $fromDateTS = strtotime($fd);
    $toDateTS = strtotime($tod);

    for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24)) {
     // use date() and $currentDateTS to format the dates in between
     $currentDateStr = date("Y-m-d",$currentDateTS);
     //$dateMonthYearArr[] = $currentDateStr;
    
	
		
    $bus_id=mysql_real_escape_string($_REQUEST['bus_id']);
	$dat=mysql_real_escape_string($currentDateStr);
	$sp_id=mysql_real_escape_string($_REQUEST['sp_id']);
	$status=mysql_real_escape_string($_REQUEST['status']);
	
	$b_dat = date("Y-m-d");
	
	//echo $status;
	$seat_no=explode("_",mysql_real_escape_string($_REQUEST['seat_no']));
	$seat=$seat_no[1];
	
	$LogID=$_SESSION['accessing_LogID'];
	$LogType=$_SESSION['accessing_type'];
	
	$block_sel_sql=mysql_query("SELECT * FROM bookinginfo WHERE SP_id=".$sp_id." AND Bus_id=".$bus_id." AND SeatNo='".$seat_no[1]."' AND travelling_date='".$dat."'") or die(mysql_error());
	if(mysql_num_rows($block_sel_sql)==1){
	   /*$updat_Seat_sql=mysql_query("UPDATE bookinginfo SET Blocked=".$status.", BlockedBy =".$LogID.", BlockedType=".$LogType."  WHERE SP_id=".$sp_id." AND Bus_id=".$bus_id." AND SeatNo='".$seat_no[1]."' AND (travelling_date='".$dat."' OR travelling_date='0000-00-00')") or die(mysql_error());*/ 
	   
	   $del_Seat_sql=mysql_query("DELETE FROM bookinginfo WHERE SP_id=".$sp_id." AND Bus_id=".$bus_id." AND SeatNo='".$seat_no[1]."' AND (travelling_date='".$dat."' OR travelling_date='0000-00-00')") or die(mysql_error());
	}
	else{
    $insert_Seat_sql="INSERT INTO  `bookinginfo` ( `auto_id` , `SP_id` , `Bus_id` ,`SeatNo`,`travelling_date` ,`booked_date`,  `Ticket_ID`,`userid` ,`usertype` ,`cancelledStatus` ,  `Blocked` ,  `BlockedBy` ,  `BlockedType` ,  `PaymentType` ) 
VALUES (NULL ,  '$sp_id',  '$bus_id',  '$seat',  '$dat',  '$b_dat',  '',  '',  '',  '',  '$status',  '$LogID',  '$LogType',  '0')";		 
      mysql_query($insert_Seat_sql) or die(mysql_error());
	}
	
	//echo $status;

	
    }   
		if($status == 1) {
		   echo "This Seat is Blocked on your selected Date(s)";
		  }
		elseif($status == 0){
		   echo "This Seat is Unblocked on your selected Date(s)";
		}	
	}
	
	
	}
	
  }
?>