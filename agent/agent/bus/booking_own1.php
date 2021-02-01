<?php
include_once '../../server/server.php';
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {} else { header('location:../logout.php'); }
?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript"> document.onkeydown = function (e) { return false; } </script>
<?php
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$tmp_pname = ''; $tmp_page=''; $tmp_pgender = ''; $tmp_pemail = ''; $tmp_pmobile = '';
$schedule_id=$_SESSION['agent']['bus']['resultbySchedule']['id']; //exit;
//$busDet=$obj->getBusDet(array($schedule_id,'ownbus'));
$busDet=$obj->getBusDet(array($schedule_id));
if(count($busDet)==1)
{
	foreach($busDet as $bD)
	{
		$dt_gs1=$bD['departTime'];
		$at_gs1=$bD['arrivalTime'];
		$th_gs1='';			
		$_SESSION['bus_provider_oneway']=$bus_provider_oneway = $bD['Bus_name'];
		$_SESSION['bus_type_oneway']=$bus_type_oneway =$bD['Bus_name'];
		$_SESSION['scheduleId_oneway']=$bD['SR_id'];
		$Bus_name=$bD['Bus_name'];
	}
}
$seatName=$_SESSION['agent']['bus']['seat']['seatName'];
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
$error_logs= "Page : booking.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];
$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
$update_error_logs=$obj->error_logs($error_logs_detail);

include '../../bus/ownbus_lib/book_tentative_own.php';
$response_oneway=1;
if($response_oneway!='')
{
  $error_logs= "Page : booking.php,<br/> Blocking Respons GET From API Successfully";	
  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
$update_error_logs=$obj->error_logs($error_logs_detail); 
   	
  $bus_result=$_SESSION['agent']['bus']['resultbySchedule'];
  
  $Depart_time=date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60));
  if (floor($bus_result['arrivalTime'] / 60) > 24)
  {
	  $Arrive_time = date("g:i A", strtotime((floor(($bus_result['arrivalTime'] / 60) - 24) . ":" . $bus_result['arrivalTime'] % 60)));
  }
  else
  {
	  $Arrive_time = date("g:i A", strtotime(floor($bus_result['arrivalTime'] / 60) . ":" . $bus_result['arrivalTime'] % 60));
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
  $final_diff = $hours . ':' . $mins . '&nbsp; hrs';
  $passenger=implode('|A|',$passenger_name);
  $age1=implode('|A|',$age);
  $gender1=implode('|A|',$gender);
  $blockRequest_final=$_SESSION['agent']['bus']['oneway']['blockRequest'];
  $BlockingID_oneway=$_SESSION['agent']['bus']['oneway']['block_id'];
  $agent_id=$_SESSION['agent']['log']['id'];
  $tripType='ONE';
  $boardingInfo=implode('|A|',$_SESSION['agent']['bus']['boarding'][$boarding_pointID]);
  $travelDate=$_SESSION['agent']['bus']['travelDate'];
  $fromStationId=$_SESSION['agent']['bus']['origin_id'];
  $fromStationName=$_SESSION['agent']['bus']['origin'];
  $toStationId=$_SESSION['agent']['bus']['destination_id'];
  $toStationName=$_SESSION['agent']['bus']['destination'];
  $oneway_fare=$total_fare=$_SESSION['agent']['bus']['netfare']+$_SESSION['agent']['bus']['serviceChargeValues'];
  $lead_pax_name=$passenger_name[0];
  $cancellationPolicy=$_SESSION['agent']['bus']['resultbySchedule']['cancellationPolicy'];
  $partialCancellationAllowed=$_SESSION['agent']['bus']['resultbySchedule']['partialCancellationAllowed'];
  $busInfo='';
  $booked_on=date('Y-m-d', time());
  $busInfo.=$_SESSION['agent']['bus']['businfo']['bus_provider'].'|A|'.$_SESSION['agent']['bus']['businfo']['busType'].'|A|'.$_SESSION['agent']['bus']['businfo']['schedule_ID'];
  $no_of_seat=count($_SESSION['agent']['bus']['seat']['seatName']);
  $status='PENDING';
  $passenger_seat=implode('|A|',$_SESSION['agent']['bus']['seat']['seatName']);
  $commission=round($_SESSION['agent']['bus']['commission'],2);
  $markup=$_SESSION['agent']['bus']['agent_markup'];
  $agent_markup_report=implode('|A|',$_SESSION['agent']['bus']['agent_markup_report']);
  $commission_report=implode('|A|',$_SESSION['agent']['bus']['commission_report']);
  $book_detail=array($BlockingID_oneway,$agent_id,$tripType,$travelDate,$fromStationId,$fromStationName,$toStationName,$toStationId,$boardingInfo,$email,$mobile,$lead_pax_name,$passenger,$age1,$gender1,$passenger_seat,$booked_on,$status,$total_fare,$busInfo,$oneway_fare,$cancellationPolicy,$partialCancellationAllowed,$Depart_time,$Arrive_time,$final_diff,$_SESSION['agent']['log']['service_charge_mode'],$_SESSION['agent']['log']['service_charges'],$_SESSION['agent']['bus']['serviceChargeValues'],$agent_markup_report,$commission_report,$commission,$markup,0);
	//echo "<pre>";
	//print_r($book_detail);
	//exit;
  
  $book=$obj->addBookerDetailAgent($book_detail);
  $error_logs= "Page : booking.php,<br/> Collect All Data pust to our DB ";	
  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
$update_error_logs=$obj->error_logs($error_logs_detail);
  if($book==1)
  {	  
	  $bookingDetail = confirmTicket($BlockingID_oneway);
	  $error_logs= "<br/>Pagen Name : booking.php <br/>1st Time Confirm Ticket PUSH TO API : ".$BlockingID_oneway."<br/>1st Time Confirm Ticket GET TO API : ".$bookingDetail;
	   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	  $update_error_logs=$obj->error_logs($error_logs_detail);
	  if($bookingDetail!='')
	  {
	   	$error_logs= "<br/>Pagen Name : booking.php <br/>1st Time GET Record From API Block ID : ".$bookingDetail;
	   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	   $update_error_logs=$obj->error_logs($error_logs_detail);
	   $error_logs= "<br/>Pagen Name : booking.php <br/>1st Time GetTicket Method PUSH To API : ".$bookingDetail;
	   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	   $update_error_logs=$obj->error_logs($error_logs_detail);
		 
		  
		  $ticket_oneway = getTicket($bookingDetail);
		  
		  $error_logs= "<br/>Pagen Name : booking.php <br/>1st Time Process Get Value From Api ticket_oneway : ".$ticket_oneway;
	     $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	     $update_error_logs=$obj->error_logs($error_logs_detail);
		  
		   if($ticket_oneway=='') 
		  {
			  $error_logs= "<br/>Pagen Name : booking.php <br/>1st Find Prblem From API : - BookingDeatils :".$bookingDetail." - API Return Value : ".$ticket_oneway;
	     $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	     $update_error_logs=$obj->error_logs($error_logs_detail);
			  
			$ticket_oneway = getTicket($bookingDetail);
			
			$error_logs= "<br/>Pagen Name : booking.php <br/>2nd Time Re Call GET Ticket Info From API : ".$ticket_oneway;
	     $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	     $update_error_logs=$obj->error_logs($error_logs_detail);
		 
		 		if($ticket_oneway=='') 
		  			{
						 $error_logs= "<br/>Pagen Name : booking.php <br/>2nd Time Find Prblem From API : - BookingDeatils :".$bookingDetail." - API Return Value : ".$ticket_oneway;
	     $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	     $update_error_logs=$obj->error_logs($error_logs_detail);
						print_r($error_logs_detail);exit;
						$error_logs= "<br/>Pagen Name : booking.php <br/>2nd Time Process Redbus API Problem Redirect To Result.php Page";
						  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
						  $update_error_logs=$obj->error_logs($error_logs_detail);	
		  				  header('location:result.php');
					}
			
			
		  	$result = json_decode($ticket_oneway, true);
		  
		 
		  
		  $pnr=$result['pnr'];
		  $tin=$result['tin'];
		  $status=$result['status'];
		  $inventoryId=$result['inventoryId'];
		  $dateOfIssue=$result['dateOfIssue'];
		  $update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$_SESSION['split_seat'],$BlockingID_oneway);
		  //echo "<pre>"; print_r($update_detail); echo "</pre>"; 
		 
		  $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Values Pass To Function = PNR :".$pnr.'^Tin : '.$tin.'^Status : '.$status.'^Inventory ID :'.$inventoryId.'^Date of Issues : '.$dateOfIssue.'^Split Seat : '.$_SESSION['split_seat'].'^Blocking ID : '.$BlockingID_oneway;
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
		
			  header('location:ticket.php?ticket='.$tin);
		  }
		  else 
		  {
			  $error_logs= "<br/>Pagen Name : booking.php <br/>Redbus API Problem Redirect To Result.php Page";
			  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
			  $update_error_logs=$obj->error_logs($error_logs_detail);	
		  	  header('location:result.php');	
			  
		  }
		  
		    
		  }
		  
		  
		  $result = json_decode($ticket_oneway, true);
		  
		 $error_logs= "<br/>Pagen Name : booking.php <br/>1st Time GetTicket Method GET From API : ".$ticket_oneway;
	     $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	     $update_error_logs=$obj->error_logs($error_logs_detail);
		  
		 
		  
		  $pnr=$result['pnr'];
		  $tin=$result['tin'];
		  $status=$result['status'];
		  $inventoryId=$result['inventoryId'];
		  $dateOfIssue=$result['dateOfIssue'];
		  $update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$_SESSION['split_seat'],$BlockingID_oneway);
		  //echo "<pre>"; print_r($update_detail); echo "</pre>"; 
		 
		  $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Values Pass To Function = PNR :".$pnr.'^Tin : '.$tin.'^Status : '.$status.'^Inventory ID :'.$inventoryId.'^Date of Issues : '.$dateOfIssue.'^Split Seat : '.$_SESSION['split_seat'].'^Blocking ID : '.$BlockingID_oneway;
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
		
			  header('location:ticket.php?ticket='.$tin);
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
		   $bookingDetail = confirmTicket($BlockingID_oneway);  
		  
		   $error_logs= "<br/>Pagen Name : booking.php <br/>2nd Time Confirm Ticket PUSH TO API : ".$BlockingID_oneway."<br/>2nd Time Confirm Ticket GET TO API : ".$bookingDetail;   
		   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		  $update_error_logs=$obj->error_logs($error_logs_detail);
		
		  if($bookingDetail!=''){
		  $ticket_oneway = getTicket($bookingDetail);
		  $result = json_decode($ticket_oneway, true);
		  
		  $error_logs= "<br/>Pagen Name : booking.php <br/>2nd Time Get Ticket Date PUSH TO API : ".$bookingDetail."<br/>2nd Time Get Ticket GET TO API : ".$ticket_oneway;   
		  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		  $update_error_logs=$obj->error_logs($error_logs_detail);
		  
		  $pnr=$result['pnr'];
		  $tin=$result['tin'];
		  $status=$result['status'];
		  $inventoryId=$result['inventoryId'];
		  $dateOfIssue=$result['dateOfIssue'];
		  
		  $error_logs= "<br/>Pagen Name : booking.php <br/>2nd Time Booking Values Pass To Function = PNR :".$pnr.'^Tin : '.$tin.'^Status : '.$status.'^Inventory ID :'.$inventoryId.'^Date of Issues : '.$dateOfIssue.'^Split Seat : '.$_SESSION['split_seat'].'^Blocking ID : '.$BlockingID_oneway;
		  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		  $update_error_logs=$obj->error_logs($error_logs_detail);
		  
		  $update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$_SESSION['split_seat'],$BlockingID_oneway);
		  $update_bus=$obj->updateBookerDetail($update_detail);
		  
		  if($update_bus==1) {
			  
		  $other_data = '';
		  $system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search Result','Page Enter',$other_data);
		  $system_log = $obj->systemlogs($system_data);  $system_data='';
		  
		  $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
	  	  $update_agent_active = $obj->agent_active($agent_active_details);
		
		  $error_logs= "<br/>Pagen Name : booking.php <br/>2nd Time Final Data Stored Successfully Redirect To Ticket Page";
		  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		  $update_error_logs=$obj->error_logs($error_logs_detail);
		  
		  header('location:ticket.php?ticket='.$tin);
		  exit;
		  }
		  else { 
		  
		   $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
	  	   $update_agent_active = $obj->agent_active($agent_active_details);
		 $error_logs= "<br/>Pagen Name : booking.php <br/>Booking Success Ticket No :".$tin."<br/>Lat Update not working";
		$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		$update_error_logs=$obj->error_logs($error_logs_detail);
		
		  header('location:processError.php?res=');
		  exit;
		  }
		  }
		  else 
		  {
			
		   $bookingDetail = confirmTicket($BlockingID_oneway);  
		   
		   $error_logs= "<br/>Pagen Name : booking.php <br/>3nd Time Confirm Ticket PUSH TO API : ".$BlockingID_oneway."<br/>3nd Time Confirm Ticket GET TO API : ".$bookingDetail;   
		   
		   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		  $update_error_logs=$obj->error_logs($error_logs_detail);
		
		  if($bookingDetail!=''){
		  $ticket_oneway = getTicket($bookingDetail);
		  $result = json_decode($ticket_oneway, true);
		  $pnr=$result['pnr'];
		  $tin=$result['tin'];
		  $status=$result['status'];
		  $inventoryId=$result['inventoryId'];
		  $dateOfIssue=$result['dateOfIssue'];
		  $update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$_SESSION['split_seat'],$BlockingID_oneway);
		  $update_bus=$obj->updateBookerDetail($update_detail);
		  if($update_bus==1) 
		  {
			  $other_data = '';
			  $system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search Result','Page Enter',$other_data);
			  $system_log = $obj->systemlogs($system_data);  $system_data='';
			  
			  $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
			  $update_agent_active = $obj->agent_active($agent_active_details);
			
			  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
			  $update_error_logs=$obj->error_logs($error_logs_detail);
			  
			  header('location:ticket.php?ticket='.$tin);
			  exit;
		  }
		  else 
		  { 
			  $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
			  $update_agent_active = $obj->agent_active($agent_active_details);
			   $error_logs= "<br/>Pagen Name : booking.php <br/>3rd time Booking Success Ticket No :".$tin."<br/>Last Update not working";
			  $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
			  $update_error_logs=$obj->error_logs($error_logs_detail);
			  
			  header('location:processError.php?res=');
			  exit;
			  }
		  }
		  else 
		  {
			 $agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
			 $update_agent_active = $obj->agent_active($agent_active_details);
			 
			 $error_logs= "<br/>Pagen Name : booking.php <br/>3rd time PNR , TIN, Status, Inventory ID, Date of Issues Not Get From API Redirect To Error Result.php";
			 $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
			 $update_error_logs=$obj->error_logs($error_logs_detail);
			  header('location:result.php');
			  exit;
		 }
	    
		  }
	  }
  } 
 }
else 
{
		$agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
	  	$update_agent_active = $obj->agent_active($agent_active_details);
		$error_logs= "<br/>Pagen Name : booking.php <br/>Redbus API Problem Redirect To Result.php Page";
		$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
		$update_error_logs=$obj->error_logs($error_logs_detail);
  		header('location:result.php');	
}	

?>
