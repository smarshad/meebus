<?php
	include_once "SSAPICaller.php";
	include_once "BlockRequest.php";
	
	$source = "3";
	$destination = "102";
	$doj = "2012-10-08";
	$tripId = "100000006044069395";
	
	//var_dump(getAllSources());
	//testing for Bangalore(2) to Mangalore(2838) calls
	//var_dump(getAllDestinations($source)); 
	//var_dump(getAvailableTrips($source,$destination,$doj));
	//var_dump(testTripDetails());
	//var_dump(getTripDetails("100000006044069395"));//Getting trip details by giving the direct value
	//var_dump(testBoardingPoint($bpIdToConsider));
	//var_dump(testBlock());
	//var_dump(testBlockAndConfirmTogether());
	//var_dump(getTicket("SE2Z95721497"));
	//var_dump(getCancellationData("SE2Z95721497"));
	//var_dump(testCancelTicket());

	function getFirstTripId($inputString)
	{
		$json_o=json_decode($inputString);
		return $json_o->availableTrips[0]->id;
	}
	function getTripDetailsForSampleId()
	{
		global $source,$destination,$doj;
		$inputString = getAvailableTrips($source,$destination,$doj);
		getTripIdWithZeroCancellationForFutureBooking($inputString,$tripId, $bpId); 
		$tripDetailInString = getTripDetails($tripId);
		return $tripDetailInString;
	}
	
	function testTripDetails()
	{
		global $source,$destination,$doj,$tripId;
		$inputString = getAvailableTrips($source,$destination,$doj);	
		$json_o = json_decode($inputString);
		$tripToConsider = $json_o->availableTrips[0];
		$tripIdToConsider = $tripToConsider->id;
		$tripId = $tripIdToConsider;
		return getTripDetails($tripId);
	}
	function getTripIdWithZeroCancellationForFutureBooking($inputString, &$tripIdToConsider, &$bpIdToConsider)
	{
		$json_o=json_decode($inputString);
		if(!is_array($json_o->availableTrips))
		{
			if(strpos($inputString,'error') >= 0)
			{
				echo 'Some error in the input string, its value is: '.$inputString;
				return "NO_SEAT_FOUND";
			}
			else
			{
				if($json_o->availableTrips->travels=="KMR Travels")
				{
					$tripIdToConsider = $json_o->availableTrips->id;
					if(is_array($json_o->availableTrips->boardingTimes))
					{
						$bpIdToConsider = $json_o->availableTrips->boardingTimes[0]->bpId;
					}
					else 
					{
						$bpIdToConsider = $json_o->availableTrips->boardingTimes->bpId;
					}
					return;
				}
			}
		}
		foreach($json_o->availableTrips as $availableInConsideration)
		{
			if($availableInConsideration->travels == "KMR Travels")
			{
				$tripIdToConsider = $availableInConsideration->id;
				if(is_array($availableInConsideration->boardingTimes))
				{
					$bpIdToConsider = $availableInConsideration->boardingTimes[0]->bpId;
				}
				else 
				{
					$bpIdToConsider = $availableInConsideration->boardingTimes->bpId;
				}
				return;
			}
		}
		return "NO_SEAT_FOUND";
	}

	function getSampleTrip($inputString, &$tripIdToConsider, &$bpIdToConsider)
	{
		$json_o=json_decode($inputString);
		$tripToConsider = $json_o->availableTrips[0];
		$tripIdToConsider = $tripToConsider->id;
		if(is_array($tripToConsider->boardingTimes))
		{
			$bpIdToConsider = $tripToConsider->boardingTimes[0]->bpId;
		}
		else 
		{
			$bpIdToConsider = $tripToConsider->boardingTimes->bpId;
		}
		return $tripIdToConsider;	 
	}

	function testBoardingPoint($inputString,&$tripToConsider,&$bpIdToConsider)
	{
		global $source,$destination,$doj;
		$inputString = getAvailableTrips($source,$destination,$doj);	
		$json_o = json_decode($inputString);
		$tripToConsider = $json_o->availableTrips[0];
		$tripIdToConsider = $tripToConsider->id;
		if(is_array($tripToConsider->boardingTimes))
		{
			$bpIdToConsider = $tripToConsider->boardingTimes[0]->bpId;
		}
		else 
		{
			$bpIdToConsider = $tripToConsider->boardingTimes->bpId;
		}
		return getBoardingPoint($bpIdToConsider);
	}

	function testBlock()
	{
		global $source,$destination,$doj;
		$inputString = getAvailableTrips($source,$destination,$doj);
		$tripIdToConsider = "";
		$bpIdToConsider = "";
		$fareToConsider = "";
		$seatnameToConsider = "";
		$ladiesseatToConsider= "";
		$address = "";
		$tripFound = getTripIdWithZeroCancellationForFutureBooking($inputString,$tripIdToConsider, $bpIdToConsider);
		if($tripFound == "NO_SEAT_FOUND")
		{
			echo "Get the first available Trip Id... </hr> </br>";
			$tripFound = getSampleTrip($inputString,$tripIdToConsider, $bpIdToConsider); 
		}
		if($tripIdToConsider == ""){
			break;
		}
		$tripDetailInString = getTripDetails($tripIdToConsider);
		$listOfSeats=json_decode($tripDetailInString);
		$blockRequest = new BlockRequest();
		echo "Trip to consider: ".$tripIdToConsider;
		$blockRequest->availableTripId = $tripIdToConsider;
		$blockRequest-> boardingPointId= $bpIdToConsider;
		$blockRequest->destination = $destination;
		$blockRequest->source = $source;
		$count=0;
		$blockRequest->inventoryItems = array();
		foreach($listOfSeats->seats as $seatInConsideration)
		{
			if($seatInConsideration->available=="true")
			{
				$inventoryItems = new inventoryItems();
				if($count ==0)
				{
					$passenger = new passenger();
					$passenger->name = "test_uma";
					$passenger->address = "some address";
					$passenger->email = "uma.s@redbus.in";
					$passenger->age = "21";
					$passenger->gender = "male";
					$passenger->idNumber = "ID123";
					$passenger->idType = "PAN_CARD";
					$passenger->mobile = "9008496128";
					$passenger->primary = "true";
					$passenger->title = "Mr";
					$inventoryItems->passenger = $passenger;
					$inventoryItems->seatName  = $seatInConsideration->name; 
					$inventoryItems->fare = $seatInConsideration->fare; 
					$inventoryItems->ladiesSeat = $seatInConsideration->ladiesSeat; 
					$blockRequest->inventoryItems[$count] = $inventoryItems;
					$count++;
				}
				else if($count == 1)
				{
					$passenger = new passenger();
					$passenger->name = "test_uma2";
					$passenger->address = "some address";
					$passenger->email = "uma.s@redbus.in";
					$passenger->age = "21";
					$passenger->gender = "male";
					$passenger->mobile = "9008496128";
					$passenger->primary = "false";
					$passenger->title = "Mr";
					$inventoryItems->passenger = $passenger;
					$inventoryItems->seatName  = $seatInConsideration->name; 
					$inventoryItems->fare = $seatInConsideration->fare; 
					$inventoryItems->ladiesSeat = $seatInConsideration->ladiesSeat; 
					$blockRequest->inventoryItems[$count] = $inventoryItems;
				}
				else{ break; }
		}
		
		echo "</br><hr>the Formed string is:</br>".json_encode($blockRequest);
		echo "<hr></br>	<hr>";
		echo "Available trip id for selected result is ".$blockRequest->availableTripId;
		echo "<hr></br>	<hr>";
		return blockTicket(json_encode($blockRequest));
	}	

	function testBlockAndConfirmTogether()
	{
		$blockKey = testBlock();
		echo "Tentative done with the response:" . $blockKey. "<br/><hr/><br/>";
		return confirmTicket($blockKey);
	}

	function testCancelTicket()
	{
		$cancelRequest = '{"tin":"SE2Z95721497","seatsToCancel":["24"],"seatsToCancel":["47"]}';
		echo" <hr>The Request for Cancelling the Ticket:".$cancelRequest."<hr/>";
		return cancelTicket($cancelRequest);
	}
?>
