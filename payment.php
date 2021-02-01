<?php
echo 'ONe';
include_once "server/server.php";
GLOBAL $conn;
echo 'Two';
include "bus_library/APICaller.php";

include_once 'includes/User.php';
echo 'Three';
$obj = new User($conn);

if(isset($_SESSION['user']['log']['id']) && $_SESSION['user']['log']['id']!=''){
	$user_id=$_SESSION['user']['log']['id'];
}
else{
	$user_id=0;
}
$gender_array = [];

for($g=0; $g<count($_POST['adultname']); $g++){
	array_push($gender_array, $_POST['gender'.$g][0]);
}

if(isset($_POST['Submit']) && $_POST['Submit'] == 'Pay Now'){ 

	if(isset($_SESSION['user']['sessId']))	{
		$unicId =$_SESSION['log']['uniqueId']=$sessionId=$_SESSION['user']['sessId'];
		$jsonPassDetail=json_encode($_POST);
		$obj->updatebuspassangeDetail(array($jsonPassDetail,$sessionId));
	}
	
	
	$_SESSION['user']['bus']['payment']['email']=$EmailID=$_POST['EmailID'];
	$_SESSION['user']['bus']['payment']['mobile']=$Mobile_No=$_POST['Mobile_No'];
	echo 'Four';
	echo '<pre>';
	print_r($_SESSION);
	echo '<pre/>';
	if(isset($_POST['alternateno']))
	$alternateno=$_POST['alternateno'];
	else
	$alternateno=$_POST['Mobile_No'];
	$adultname=implode('^',$_POST['adultname']);
	$lastname=implode('^',$_POST['lastname']);
	$adultage=implode('^',$_POST['adultage']);
	$gender=implode('^',$gender_array);
	$seatnumber=implode('^',$_POST['seatnumber']);
    $seatprice=implode('^',$_POST['seatprice']);
    $serviceTaxAmount_det=implode('^',$_POST['serviceTaxAmount_det']);
    $operatorServiceChargeAbsolute_det=implode('^',$_POST['operatorServiceChargeAbsolute_det']);
    $ac_det=implode('^',$_POST['ac_det']);
    $sleeper_det=implode('^',$_POST['sleeper_det']);
	
	
	$Mobile_No=$_POST['Mobile_No'];
	//$EmailID=$_POST['EmailID'];


	$pgate='wallet'; //$_POST['payment'];
	$SeatLayout=$_SESSION['user']['SeatLayout'];
	$selectedBus=$_SESSION['user']['selectedBus'];
	$boarding=explode('^',$_SESSION['selectedBus']['boardingPoints']);
	$new_bp_point=explode("bp_",$_POST['bp_point']);
	$new_dp_point=explode("dp_",$_POST['dp_point']);
	
	foreach($_SESSION['user']['selectedBus']['boardingPoints'] as $bp_list){
		if (in_array($new_bp_point[1], $bp_list)){
			$bp_list;
		}
	}
	//echo $new_dp_point[1];
	foreach($_SESSION['user']['selectedBus']['droppingPoints'] as $dp_list){
		if (in_array($new_dp_point[1], $dp_list)){
			$dp_list;
		}
	}

	//echo "<pre>";
	//print_r($_SESSION);
	//echo "</pre>";
	//exit;
	$adultname1 = $adultname;
	$lastname1  = $lastname;
	//$adultage1 = $adultage;
	//$gender1 = $gender;
	$adultname=explode('^',$adultname);
	$leadPaxName=$adultname[0];
	$lastname=explode('^',$lastname);
	$adultage=explode('^',$adultage);
	$gender=explode('^',$gender_array);
	$seatnumber=explode('^',$seatnumber);
	$seatprice=explode('^',$seatprice);
	$serviceTaxAmount=explode('^',$serviceTaxAmount_det);
	$operatorServiceChargeAbsolute=explode('^',$operatorServiceChargeAbsolute_det);
	$ac=explode('^',$ac_det);
	$sleeper=explode('^',$sleeper_det);
	
	
	
	$_SESSION['user']['payment']['name']=$adultname[0];
	$selectedSeat=$_SESSION['user']['selectedSeat'];
	$seatFare=$_SESSION['user']['seatFare'];
	$totalFareWithTaxes=$_SESSION['user']['totalFareWithTaxes'];
	//$ac=$_SESSION['user']['seat']['ac'];
	//$sleeper=$_SESSION['user']['seat']['sleeper'];
	$ladiesSeat=$_SESSION['user']['seat']['ladiesSeat'];
	//print_r($adultname);
	
	//print_r($seatprice);
	$total_fare = 0;
	for($i=0; $i<count($adultname); $i++){
		$passenger['age']=$adultage[$i];		 
		$passenger['name']=$adultname[$i];		 
		$passenger['seatNbr']=$seatnumber[$i];  //$selectedSeat[$i];		 
		//$passenger['sex']=$gender[$i];		 
		$passenger['fare']=$seatprice[$i].'.0';	//"serviceTaxAmount": 19.00,	 "operatorServiceChargeAbsolute": 25.00,
		$passenger['serviceTaxAmount']=$serviceTaxAmount[$i].'.00';
		$passenger['operatorServiceChargeAbsolute']='00.00'; //$operatorServiceChargeAbsolute[$i].'.00';       
		$totalFareWithTaxes = $passenger['fare'] + $passenger['serviceTaxAmount'] + $passenger['operatorServiceChargeAbsolute'];
		$passenger['totalFareWithTaxes']=$totalFareWithTaxes.'.00';           //$seatprice[$i].'.00';   //$totalFareWithTaxes[$i];		 
		$passenger['ladiesSeat']='false'; //$ladiesSeat[$i];		 
		$passenger['lastName']='test'; //$lastname[$i];		 
		$passenger['mobile']=$Mobile_No;
		$passenger['sex'] = $gender_array[$i];
		if($gender_array[$i]=='M')		 
		//if($passenger['sex']=='Male')		 
		$passenger['title']='Mr';	
		else	 
		$passenger['title']='Mrs';		 
		$passenger['idType']='PAN CARD';		 
		$passenger['idNumber']='213123';	
		$passenger['primary']='false';	
		if($i==0)
		$passenger['primary']='true';	
		$passenger['ac']='false';   //$ac[$i];    	
		$passenger['sleeper']='false';    //$sleeper[$i];  	
		$passengerDet[]=$passenger;
		//$totalFareWithTaxes = "";
		$total_fare = $total_fare + $totalFareWithTaxes;
	 }	
	   if(count($dp_list)){
		 $db_array = array(
             'id'=>$dp_list['id'],
             'location'=>trim($dp_list['location']).','.$_SESSION['user']['tostation'],
             'time'=>$dp_list['time']
         );
	  }else{
		  $db_array = array(
             'id'=>$selectedBus['routeScheduleId'],
             'location'=>$_SESSION['user']['tostation'],
             'time'=>$selectedBus['arrivalTime']
         );
	  }

		$prebook=array(            
			'sourceCity'=>$_SESSION['user']['fromstation'], 
            'destinationCity'=>$_SESSION['user']['tostation'],
            'doj'=>date('Y-m-d',strtotime($_SESSION['user']['journey_date'])),
            'routeScheduleId'=>$selectedBus['routeScheduleId'],
             'boardingPoint'=>array(
                 'id'=>$bp_list['id'],
                 'location'=>trim($bp_list['location']).','.$_SESSION['user']['fromstation'],
                 'time'=>$bp_list['time']
             ),
	     'droppingPoint'=>$db_array, 			 
             'customerName'=>$adultname[0],
             'customerLastName'=>'reerf', //$lastname[0],
             'customerEmail'=>$EmailID,       //$_SESSION['user']['bus']['payment']['email'],
             'customerPhone'=>$_SESSION['user']['bus']['payment']['mobile'],
             'emergencyPhNumber'=>$_SESSION['user']['bus']['payment']['mobile'],
             'customerAddress'=>'Trichy',
             'blockSeatPaxDetails'=>$passengerDet,
             'inventoryType'=>$selectedBus['inventoryType']             
          );  
		    
            $json=json_encode($prebook);	
			$response_oneway =  getBlockTicket($json);	

			//$response_oneway['apiStatus']='1';
			//$response_oneway['blockTicketKey']='XY7HJG77789809';
			if(isset($_SESSION['user']['sessId']))
			{
				$sessionId=$_SESSION['user']['sessId'];
				$jsonBlockResponse=json_encode($response_oneway);
				$obj->updatebusBlockResponse(array($jsonBlockResponse,$sessionId));
			}

	if($response_oneway['apiStatus']!='' && $response_oneway['blockTicketKey']!='')	{
		//exit;
		$booking_type='complete';
		$couponcode='';
		//$offerAmount=0.00;
		$cashBack=0.00;
		$routeScheduleId=$selectedBus['routeScheduleId'];
		$BlockingID=$response_oneway['blockTicketKey'];
		$tripType='one';
		$apiType='ets';
		$travelDate = $_SESSION['user']['journey_date']; 
		$fromStationId = $_SESSION['user']['fromstation']; 
		$toStationId =  $_SESSION['user']['tostation']; 
		$boardingInfo = implode('^',$bp_list); //$_SESSION['selectedBus']['boarding'];
		
		$adultage=implode('^',$adultage);

		
		$booked_on=date('Y-m-d', time());
		$status='PENDING';
		//$total_fare = $_SESSION['user']['totalfare']['totalFareWithTaxes']; 
		$oneway_fare = implode('^',$seatprice);//implode('^',$totalFareWithTaxes);
		$selectedSeat1 = implode('^',$_POST['seatnumber']);   ;//implode('^',$selectedSeat);
		$gender = implode('^',$gender_array);   ;//implode('^',$selectedSeat);
		$email = $_SESSION['user']['bus']['payment']['email'];
		$mobile = $_SESSION['user']['bus']['payment']['mobile'];
		$busInfo=$_SESSION['user']['selectedBus']['operatorName'].'^'.$_SESSION['user']['selectedBus']['busType'].'^'.$_SESSION['user']['selectedBus']['serviceId'];
		$cancellationPolicy = $_SESSION['user']['selectedBus']['cancellationPolicy'];
		$partialCancellationAllowed = 	$_SESSION['user']['selectedBus']['partialCancellationAllowed'];
		$Depart_time = $_SESSION['user']['selectedBus']['departureTime'];
		$Arrive_time = $_SESSION['user']['selectedBus']['arrivalTime'];
		$_SESSION['user']['bus']['payment']['finalAmt']=$amount = $_SESSION['user']['totalfare']['totalFareWithTaxes'];
	    $dateOfIssue=date('d-m-Y h:i:s A',time());
		$book_detail=array($BlockingID,$routeScheduleId,$apiType,$tripType,$travelDate,$fromStationId,$toStationId,$boardingInfo,$email,$mobile,$adultname[0],$adultname1,$adultage,$gender,$selectedSeat1,count($seatnumber),$booked_on,$status,$total_fare,
		$busInfo,json_encode($prebook),$oneway_fare,$cancellationPolicy,$partialCancellationAllowed,$Depart_time,$Arrive_time,'-',$unicId,$couponcode,$booking_type,$pgate,$total_fare,$mobile,$dateOfIssue);
		$book=$obj->addBookerDetail($book_detail);

		if($user_id!=0 && $pgate=='wallet'){			
			$aval_bal=$obj->getBalance($user_id);
			if($aval_bal>=$oneway_fare){
				$bal=$aval_bal-$oneway_fare;
				$obj->updateUserBalance(array($bal,$user_id));
				$detail=$obj->getTicketDetail($unicId,'PENDING');
				echo'<pre>';
				print_r($detail);
				echo'<pre/>';
				// echo 'detail '.$detail[0];
				
				//exit;
				if($detail != 0){
					$detail=$detail[0];
					$booking_type=$detail['booking_type'];
					$couponcode=$detail['promocode'];
					//exit;
					$bookingDetail = array();
					if($booking_type=='complete'){
						echo $detail['TentativeBooking_oneway'];
						$BlockingID_oneway=$detail['TentativeBooking_oneway'];
						$bookingDetail = confirmTicket($BlockingID_oneway);
						echo'<pre>';
						echo 'bookingDetail';
						print_r($bookingDetail);
						echo'<pre/>';
						exit;
					}
					if($bookingDetail['apiStatus']['message']=='SUCCESS'){
						$pnr=$bookingDetail['opPNR'];
						$tin=$bookingDetail['etstnumber'];
						$status='BOOKED';
						$inventoryId=$bookingDetail['inventoryType'];
						$dateOfIssue=date('d-m-Y h:i:s A',time());
						$update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$unicId);
						//echo '<pre>'; print_r($update_detail); echo '</pre>';
						$update_bus=$obj->updateBookerDetail($update_detail);
						$obj->insTransLog(array($user_id,'debit',$oneway_fare,$bal,'Bus Booking '.$unicId,'SUCCESS',time(),$unicId));
						if($update_bus==1){
							header('location:ticket.php?tin='.$tin);
							exit;
						}
					}else{
						$status='Failed';
						$pnr=NULL;
						$tin=NULL;
						$inventoryId=NULL;
						$dateOfIssue=date('d-m-Y h:i:s A',time());
						$bookingErrmsg=$bookingDetail['apiStatus']['message'];
						$balance=$obj->getBalance(array($user_id));
						$currentbal=$balance+$oneway_fare;
						$obj->updateUserBalance(array($currentbal,$user_id));
						$obj->insTransLog(array($user_id,'credit',$oneway_fare,$currentbal,'Refund for booking failed '.$unicId,'SUCCESS',time(),$unicId));
						$update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$bookingErrmsg,$unicId);
						$update_bus=$obj->updateBookerDetailFailed($update_detail);
						header('location:bookingFailed.php?uid='.$unicId);
						exit;
					}
				}else{
					echo 'dddddddddd';
				}
			}else{
				$_SESSION['bus']['payment']['unicId']=$unicId;
				$pgamt=$oneway_fare-$aval_bal;
				$walletamt=$aval_bal;
				$obj->updateWalletBusPay(array($walletamt, $pgamt, $unicId));
				header('location:atom/payment.php');
				exit;
			}
		}else if($pgate=='atom'){			
			$_SESSION['bus']['payment']['unicId']=$unicId;
			$pgamt=$oneway_fare;
			$walletamt=0;
			$obj->updateWalletBusPay(array($walletamt,$pgamt,$unicId));
			header('location:atom/payment.php');
			exit;
		}
	}else{
		$_SESSION['user']['bus']['err']='This seat was already blocked. Please choose any other seat';
		header('location:bookingFailed.php');
		exit;
	}
}
?>