<?php
    $blockRequest = new BlockRequest();
    $blockRequest->availableTripId = $schedule_id;
    $blockRequest->boardingPointId = $boarding_pointID;
    $blockRequest->destination = $_SESSION['agent']['bus']['destination_id'];
    $blockRequest->source = $_SESSION['agent']['bus']['origin_id'];
    $count = 0;
    $seatarray2 = $_SESSION['agent']['bus']['seat']['seatName'];
    $netfare = $_SESSION['agent']['bus']['seat']['fare'];
    $blockRequest->inventoryItems = array();
	
	
	$i=0;
    foreach ($_SESSION['agent']['bus']['seat']['seatName'] as $seat)
    {
		$s=$seat;
        $inventoryItems = new inventoryItems();
        if ($count == 0)
        {
            $passenger = new passenger();
            $passenger->name = $passenger_name[$i];
            $passenger->email = $email;
            $passenger->age = $age[$i];
            $gender1 = $gender[$i];
            $passenger->gender = $gender[$i];
            $passenger->mobile = $mobile;
            $passenger->title = '';
            $passenger->primary = "true";
            $passenger->address = '';
            $passenger->idNumber = "ID123";
            $passenger->idType = "PAN_CARD";
            $inventoryItems = new inventoryItems();
            $inventoryItems->passenger = $passenger;
            $inventoryItems->seatName = $s;
			$inventoryItems->fare = $_SESSION['agent']['bus']['seat']['fare'][$s];		
			if($gender1=='Female')
			{
            	$inventoryItems->ladiesSeat = 'true';
			}
			if($gender1=='Male')
			{
				$inventoryItems->ladiesSeat = 'false';
			}
            $blockRequest->inventoryItems[$i] = $inventoryItems;
            $count++;
        } else if ($count == 1)
        {
            $passenger = new passenger();
            $passenger->name = $passenger_name[$i];
            $passenger->email = $email;
            $passenger->age = $age[$i];
            $gender1 = $gender[$i];
            $passenger->gender = $gender[$i];
            $passenger->mobile = $mobile;
            $passenger->primary = "false";
            $passenger->title = '';
            $inventoryItems->passenger = $passenger;
            $inventoryItems->seatName = $s;
			$inventoryItems->fare =$_SESSION['agent']['bus']['seat']['fare'][$s];
			if($gender[$i]=='Female')
			{
				$inventoryItems->ladiesSeat = 'true';
			}
			if($gender[$i]=='Male')
			{
            	$inventoryItems->ladiesSeat = 'false';
			}
            $blockRequest->inventoryItems[$i] = $inventoryItems;                                      
        } else
        {
            break;
        }
		$i++;
    }
	//if($_SESSION['agent']['log']['id']=='849') {  echo "<pre>"; print_r($blockRequest); echo "<pre/>"; 	}
	//print_r($blockRequest);exit;
	 $_SESSION['agent']['bus']['oneway']['blockRequest'] = json_encode($blockRequest); 
	 $_SESSION['agent']['bus']['oneway']['block_id'] = $response_oneway =  blockTicket(json_encode($blockRequest)); 
	
	 $error_logs.= "Page : booking.php ,<br/>POST Value :".implode('^',$_POST)."<br/>Session Value : Common URL : ".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> OUR Blocking Request PUSH To API : ".json_encode($blockRequest)."<br/> API Blocking Request GET To API : ".$response_oneway;

?>
