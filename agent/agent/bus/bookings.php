<?php

include_once '../../server/server.php';


ini_set('display_errors',1);
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {} else { header('location:../logout.php'); }
?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript"> document.onkeydown = function (e) { return false; } </script>
<?php

include_once "../../bus/ispace/SSAPICaller.php";
include_once "../../bus/ispace/BlockRequest.php";
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$tmp_pname = ''; $tmp_page=''; $tmp_pgender = ''; $tmp_pemail = ''; $tmp_pmobile = '';
$schedule_id=$_SESSION['agent']['bus']['resultbySchedule']['Id'];


$boarding_pointID=$_POST['boarding'];
$passenger_name=$_POST['passenger_name'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];

unset($_SESSION['FILL']['PASSENGER']);
unset($_SESSION['FILL']['AGE']);
unset($_SESSION['FILL']['GENDER']);
unset($_SESSION['FILL']['EMAIL']);
unset($_SESSION['FILL']['MOBILE']);

$_SESSION['FILL']['PASSENGER']	= implode('|A|',$_POST['passenger_name']);
$_SESSION['FILL']['AGE']		= implode('|A|',$_POST['age']);
$_SESSION['FILL']['GENDER']		= implode('|A|',$_POST['gender']); 
$_SESSION['FILL']['EMAIL'] 		= $_POST['email'];
$_SESSION['FILL']['MOBILE'] 	= $_POST['mobile'];
$response_oneway = '';
if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
	{
		if($_SESSION['agent']['log']['api_select']=='redbus')
			{
				include '../../bus/bus-library/book_tentative.php';
			}
		if($_SESSION['agent']['log']['api_select']=='ispace')
			{
				include '../../bus/ispace/book_tentative.php';			
			}
	}
if($response_oneway!='')
{
  $error_logs= "Page : booking.php,<br/> Blocking Respons GET From API Successfully ";	
  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs); 
$update_error_logs=$obj->error_logs($error_logs_detail); 
   	
  $bus_result=$_SESSION['agent']['bus']['resultbySchedule'];
  $Depart_time=date("g:i A", strtotime(floor($bus_result['DepartureTime'] / 60) . ":" . $bus_result['DepartureTime'] % 60));
  if (floor($bus_result['ArrivalTime'] / 60) > 24)
  {
	  $Arrive_time = date("g:i A", strtotime((floor(($bus_result['ArrivalTime'] / 60) - 24) . ":" . $bus_result['ArrivalTime'] % 60)));
  } 
  else
  {
	  $Arrive_time = date("g:i A", strtotime(floor($bus_result['ArrivalTime'] / 60) . ":" . $bus_result['ArrivalTime'] % 60));
  }
  $a3 = DATE("H:i", STRTOTIME($Depart_time));
  $a4 = DATE("H:i", STRTOTIME($Arrive_time));
  $nextDay = $a3 > $a4 ? 1 : 0;
  $dep = EXPLODE(':', $a3);
  $arr = EXPLODE(':', $a4);
  $diff = ABS(MKTIME($dep[0], $dep[1], 0, DATE('n'), DATE('j'), DATE('y')) - MKTIME($arr[0], $arr[1], 0, DATE('n'), DATE('j') + $nextDay, DATE('y')));
  $hours = FLOOR($diff / (60 * 60));
  $mins = FLOOR(($diff - ($hours * 60 * 60)) / (60));
  $secs = FLOOR(($diff - (($hours * 60 * 60) + ($mins * 60))));
  IF (STRLEN($hours) < 2)
  {
	  $hours = "0" . $hours;
  }
  IF (STRLEN($mins) < 2)
  {
	  $mins = "0" . $mins;
  }
  IF (STRLEN($secs) < 2)
  {
	  $secs = "0" . $secs;
  }
  //print_r($_SESSION['agent']['bus']['boarding']); 
  $final_diff = $hours . ':' . $mins . '&nbsp; hrs';
  $passenger=implode('|A|',$passenger_name);
  $age1=implode('|A|',$age);
  $gender1=implode('|A|',$gender2);
  $blockRequest_final=$_SESSION['agent']['bus']['oneway']['blockRequest'];
  $BlockingID_oneway=$_SESSION['agent']['bus']['oneway']['block_id'];
  $agent_id=$_SESSION['agent']['log']['id'];
  $tripType='ONE';
  $boardingInfo=$boarding_pointID;
  $travelDate=$_SESSION['agent']['bus']['travelDate'];
  $fromStationId=$_SESSION['agent']['bus']['origin_id'];
  $fromStationName=$_SESSION['agent']['bus']['origin'];
  $toStationId=$_SESSION['agent']['bus']['destination_id'];
  $toStationName=$_SESSION['agent']['bus']['destination'];
  $oneway_fare=$total_fare=$_SESSION['agent']['bus']['netfare']+$_SESSION['agent']['bus']['serviceChargeValues'];
  $lead_pax_name=$passenger_name[0];
  $cancellationPolicy=$CancellationPolicy;
  if($PartialCancellationAllowed==true)
  $partialCancellationAllowed='true';
  else 
  $partialCancellationAllowed='false';
  $busInfo='';
  $booked_on=date('Y-m-d', time());
  $busInfo.=$_SESSION['dummy']['busname'].'|A|'.$_SESSION['agent']['bus']['businfo']['busType'].'|A|'.$_SESSION['agent']['bus']['businfo']['schedule_ID'];
  $no_of_seat=count($_SESSION['agent']['bus']['seat']['seatName']);
  $status='PENDING';
  $passenger_seat=implode('|A|',$_SESSION['agent']['bus']['seat']['seatName']);
  $commission=round($_SESSION['agent']['bus']['commission'],2);
  $markup=$_SESSION['agent']['bus']['agent_markup'];
  $agent_markup_report=implode('|A|',$_SESSION['agent']['bus']['agent_markup_report']);
  $commission_report=implode('|A|',$_SESSION['agent']['bus']['commission_report']);

	if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
			{
				if($_SESSION['agent']['log']['api_select']=='redbus')
					{
						$book_detail=array($BlockingID_oneway,$agent_id,$tripType,$travelDate,$fromStationId,$fromStationName,$toStationName,$toStationId,$boardingInfo,$email,$mobile,$lead_pax_name,$passenger,$age1,$gender1,$passenger_seat,$booked_on,$status,$total_fare,$busInfo,$blockRequest_final,$oneway_fare,$cancellationPolicy,$partialCancellationAllowed,$Depart_time,$Arrive_time,$final_diff,$_SESSION['agent']['log']['service_charge_mode'],$_SESSION['agent']['log']['service_charges'],$_SESSION['agent']['bus']['serviceChargeValues'],$agent_markup_report,$commission_report,$commission,$markup,0,0,0);
					}
				if($_SESSION['agent']['log']['api_select']=='ispace')
					{
						$book_detail=array($BlockingID_oneway,$agent_id,$tripType,$travelDate,$fromStationId,$fromStationName,$toStationName,$toStationId,$boardingInfo,$email,$mobile,$lead_pax_name,$passenger,$age1,$gender1,$passenger_seat,$booked_on,$status,$total_fare,$busInfo,$blockRequest_final,$oneway_fare,$cancellationPolicy,$partialCancellationAllowed,$_SESSION['dummy']['depart'],$_SESSION['dummy']['arrival'],$final_diff,$_SESSION['agent']['log']['service_charge_mode'],$_SESSION['agent']['log']['service_charges'],$_SESSION['agent']['bus']['serviceChargeValues'],$agent_markup_report,$commission_report,$commission,$markup,1,$_SESSION['agent']['bus']['netServicetax'],$_SESSION['agent']['bus']['netOperatorServiceCharge']);
					}
			}
		
  
  
  
// echo '<pre>'; print_r($book_detail); echo '<pre/>'; 
  
  $error_logs= "Page : booking.php,<br/> Collect All Data pust to our DB ";	
  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
  $update_error_logs=$obj->error_logs($error_logs_detail);
  
  //echo "<pre>"; print_r($book_detail); echo "</pre>";
  $book=$obj->addBookerDetailAgent($book_detail);
  //echo $book; 
  //$markup_mode = 'ONE';
  //$agent_log=array($markup,$commission,$markup_mode,$markup_value,$total_fare,$debit,$agent_net_fare,$balance);
  if($book==1)
  {
	  
  //echo '<pre>'; print_r($BlockingID_oneway); echo '<pre/><br/>';
	  // echo 'ConfirmTicket : '.$BlockingID_oneway; exit; 
	  $bookingDetail = confirmTicket($BlockingID_oneway);
	  
	 //echo "<pre>"; print_r($bookingDetail); echo '<pre>';   exit;
	  
	  $error_logs= "<br/>Pagen Name : booking.php <br/>1st Time Confirm Ticket PUSH TO API : ".$BlockingID_oneway."<br/>1st Time Confirm Ticket GET TO API : ".$bookingDetail;
	   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	  $update_error_logs=$obj->error_logs($error_logs_detail);
	  
	  if($bookingDetail!='')
	  {
  
		  $result = $bookingDetail;
		  
		  
		 $error_logs= "<br/>Pagen Name : booking.php <br/>1st Time GetTicket Method GET From API : ".$result;
	     $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	     $update_error_logs=$obj->error_logs($error_logs_detail);
		  
		 
		  
		  $pnr=$result['APIReferenceNo'];
		  $tin=$result['APIReferenceNo'];
		  $status='BOOKED';
		  $inventoryId=$result['ReferenceNo'];
		  $dateOfIssue=date('Y-m-d h:i:s A',time());
		  $update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$_SESSION['split_seat'],$BlockingID_oneway);
		 // echo "<pre>"; print_r($update_detail); echo "</pre>"; 
		 
		  $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Values Pass To Function = PNR :".$pnr.'^Tin : '.$tin.'^Status : '.$status.'^Inventory ID :'.$inventoryId.'^Date of Issues : '.$dateOfIssue.'^Split Seat : '.$_SESSION['agent']['bus']['seat']['fare'].'^Blocking ID : '.$BlockingID_oneway;
		  $update_error_logs=$obj->error_logs($error_logs_detail);
		  
		  $update_bus=$obj->updateBookerDetail($update_detail);
  
		  if($update_bus==1)
		  {
			  $other_data = '';
			  $system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search Result','Page Enter',$other_data);
			  $system_log = $obj->systemlogs($system_data);  $system_data='';

			  $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
	  	      $update_agent_active = $obj->agent_active($agent_active_details);
		
		      $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Success Ticket No :".$tin;
		      $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		      $update_error_logs=$obj->error_logs($error_logs_detail);
		
		if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
			{
				if($_SESSION['agent']['log']['api_select']=='redbus')
					{
						 header('location:ticket.php?ticket='.$tin);
					}
				if($_SESSION['agent']['log']['api_select']=='ispace')
					{
						 header('location:tickets.php?ticket='.$tin);
					}
			}
		
			
			 
		  }
		  else 
		  {
			  $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Success Ticket No :".$tin."<br/>Lat Update not working";
			  $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
	  	      $update_agent_active = $obj->agent_active($agent_active_details);
			  $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Success Ticket No :".$tin."<br/>Lat Update not working";
		      $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);

			  $update_error_logs=$obj->error_logs($error_logs_detail);
		
			 header('location:processError.php?res=');	
		  }
	  
	  
	  }
	  else 
	  {
		
		      $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Success Ticket No :".$tin."<br/>Lat Update not working";
			  $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
	  	      $update_agent_active = $obj->agent_active($agent_active_details);
			  $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Success Ticket No :".$tin."<br/>Lat Update not working";
		      $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);

			  $update_error_logs=$obj->error_logs($error_logs_detail);
		
			  header('location:processError.php?res='.$bookingDetail['Message']);	  
		  
	  }
	  
  } 
 }
else 
{
		$agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
	  	$update_agent_active = $obj->agent_active($agent_active_details);
		
		$error_logs= "<br/>Pagen Name : booking.php <br/>Redbus API Problem Redirect To Result.php Page 3";
		$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		$update_error_logs=$obj->error_logs($error_logs_detail);	
		
  		header('location:result.php');	
}	

?>
