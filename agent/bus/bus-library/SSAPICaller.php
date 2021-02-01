<?php
	include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";
    $key 	    = "mQxMddhQknIoLctWGcbqfpfwzNmsoS"; 
	$secret 	= "xWSPPj6jNuVJcd6NoruGzwFRznMZud";


$api_base_url = "http://api.seatseller.travel/";

	
	function invokeGetRequest($requestUrl)
	{
		//echo $requestUrl; 
		global $key, $secret, $api_base_url,$source,$destination,$doj,$tripId;
		$url = $api_base_url.$requestUrl;
		$curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0, 				CURLOPT_CONNECTTIMEOUT => 0);
		$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
		OAuthStore::instance("2Leg", $options);
		$method = "GET";
		$params = null;
		try
		{
			$request = new OAuthRequester($url, $method, $params);
			$result = $request->doRequest();
			$response = $result['body'];
			return $response;
		}
		catch(OAuthException2 $e)
		{
			$error_logs= "<br/>API Error1 :  <br/> ".$e."<br/>";
	   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	         $update_error_logs=$obj->error_logs($error_logs_detail);
			echo "Sorry, We have occured some problem. Please try after some time...";
		}
		catch(Exception $e1)
		{
			$error_logs= "<br/>API Error2 :  <br/> ".$e1."<br/>";
	   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	         $update_error_logs=$obj->error_logs($error_logs_detail);
			echo "Sorry, We have occured some problem. Please try after some time...";
		}
	}

	function invokePostRequest($requestUrl, $blockRequest)
	{		
		global $key, $secret, $api_base_url;
		$url = $api_base_url.$requestUrl;
		$curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0,CURLOPT_CONNECTTIMEOUT => 0);
		
		$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
		OAuthStore::instance("2Leg", $options);
		$method = "POST";
		$params = null;
		try
		{
			$request = new OAuthRequester($url, $method, $params, $blockRequest);
			//echo "Timeout is: ".$curl_options[CURLOPT_TIMEOUT]."<hr></br>";
			//echo "Connection timeout is: ".$curl_options[CURLOPT_CONNECTTIMEOUT ]."<hr></br>";
			$result = $request->doRequest(0,$curl_options);
			$response = $result['body'];
			return $response;
		}
		catch(OAuthException2 $e)
		{
			 $error_logs= "<br/>API Error1 :  <br/> ".$e."<br/>";
	   	     //$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	         //$update_error_logs=$obj->error_logs($error_logs_detail);
		}
		catch(Exception $e1)
		{
			 $error_logs= "<br/>API Error2 :  <br/> ".$e1."<br/>";
	   $error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
	         $update_error_logs=$obj->error_logs($error_logs_detail);
		}
	}

	function getAllSources()
	{
		return invokeGetRequest("sources");
	}
	
	function getAllDestinations($sourceId)
	{
		return invokeGetRequest("destinations?source=".$sourceId);
	}

	function getAvailableTrips($sourceId,$destinationId,$date)
	{
		return invokeGetRequest("availabletrips?source=".$sourceId. "&destination=" .$destinationId. "&doj=" . $date);
	}
	 

	function getBoardingPoint($boarding)
	{
		return invokeGetRequest("boardingPoint?id=".$boarding);
	}

	function getTripDetails($tripId)
	{
		return invokeGetRequest("tripdetails?id=".$tripId); 	
	}
	
	function blockTicket($blockRequest)
	{	
		/*foreach($blockRequest->inventoryItems as $inventory)
		{
			echo "</hr></br>Seat Name:".$inventory->name;
			echo "</hr></br>Fare:".$inventory->fare;
			echo "</hr></br>Gender:".$inventory->ladiesSeat."</hr></br>";
		}*/
			return invokePostRequest("blockTicket",$blockRequest); 
	}

	function confirmTicket($blockKey)
	{
			return invokePostRequest("bookticket?blockKey=".$blockKey,"");
	} 
	function getTicket($ticketId)
	{
		
		return invokeGetRequest("ticket?tin=".$ticketId);
	}

	function getCancellationData($cancellationId)
	{
		return invokeGetRequest("cancellationdata?tin=".$cancellationId);
		echo " <hr>The ticket details are:".$cancellationId."<hr/>";
	}

	function cancelTicket($cancelRequest)
	{
		return invokePostRequest("cancelticket",$cancelRequest);
	}
?>

