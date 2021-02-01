<?php
//session_start();
	ini_set("soap.wsdl_cache_enabled", "0"); 
			include 'Authenticate.php';
	function Authenticate()
	{
		$params = array(
		 'LoginID'=>'Urbus',
		 'Password'=>'Urbus123',
		 'UserType'=>'S',
		 'LoginCode'=>9542,
		);
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->Authenticate($params);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}
	}
	
	function GetFromCities()
	{		include 'Authenticate.php';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for
		try
		{
			$result = $client->GetFromCities($search_query);
			
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}
	}
	
	function GetToCities($fromcity_id)
		{		include 'Authenticate.php';
		$search_query->FromCityID = $fromcity_id;
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetToCities($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}
	}
	
	function GetRoutes2($fromcity_id,$tocity_id,$date)
	{		include 'Authenticate.php';
		$search_query->SearchRequest = new StdClass();
$search_query->SearchRequest->FromCityId = $fromcity_id;
$search_query->SearchRequest->ToCityId = $tocity_id;
$search_query->SearchRequest->JourneyDate = $date;
$search_query->SearchRequest->NoOfSeats = '1';
$search_query->SearchRequest->SearchId = '0';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for
		try
		{
			return $result = $client->GetRoutes2($search_query);
		}
		catch(OAuthException2 $e)
		{
			echo "We have occured some problem.. Please try after some times..";
		}
		catch(Exception $e1)
		{
			echo "We have occured some problem.. Please try after some times..";
		}
	}
	function GetRouteScheduleDetailsWithComm($scheduleId,$travelDate)
	{
		include 'Authenticate.php';
		  $search_query->RouteScheduleId = $scheduleId;
$search_query->JourneyDate =$travelDate;
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetRouteScheduleDetailsWithComm($search_query);
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}

	function HoldSeatsForSchedule()
	{
		//print_r($_SESSION['gender']);
    $seatarray2 = seatArray($_SESSION['seatName_oneway']);
    $netfare = fareArray($_SESSION['net_price_oneway']);
		$schedule_id=$_SESSION['scedulr_id'];
	$dep_date=$_SESSION['originalDate'];
	//$pickup_id=$_SESSION['pickup_Id'];
	$seat_no1=explode('|A|',$_SESSION['seatName_oneway']);
	$seat_no='';
	foreach($seat_no1 as $seat)
	$seat_no.=$seat;
		//echo $schedule_id.$pickup_id.$dep_date.$seat_no;
		include 'Authenticate.php';
		$search_query->RouteScheduleId = $schedule_id;
$search_query->PickUpID =boardingPoint($_SESSION['BoardingPointName_oneway']);
$search_query->JourneyDate = $dep_date;
$search_query->ContactInformation = new StdClass();
$search_query->ContactInformation->CustomerName = $_SESSION['fullname'][0];
$search_query->ContactInformation->Email = $_SESSION['email'];
$search_query->ContactInformation->Phone = '';
$search_query->ContactInformation->Mobile = $_SESSION['mobile'];
$count = 0;
//$Passengers=new StdClass();
$search_query->Passengers = new StdClass();

for ($i = 0; $i < numberOfSeat($_SESSION['seatName_oneway']); $i++)
{
	$Passenger = new StdClass();
	//$Passenger = array();
	if ($count == 0)
	{

		
		$Passenger->Name = $_SESSION['fullname'][$i];
		$Passenger->Age = $_SESSION['age'][$i];
		$Passenger->Gender = $_SESSION['gender'][$i];
		$Passenger->SeatNo = $seatarray2[$i];
		$Passenger->Fare = $netfare[$i];
		$Passenger->SeatType = 'Seater';
		$Passenger->IsAcSeat = 'True';
		$Passengers->Passenger[$i] = $Passenger;
		$search_query->Passengers = $Passengers;
		$count++;
	}
	else if ($count == 1)
    {
		$Passenger->Name = $_SESSION['fullname'][$i];
		$Passenger->Age = $_SESSION['age'][$i];
		$Passenger->Gender = $_SESSION['gender'][$i];
		$Passenger->SeatNo = $seatarray2[$i];
		$Passenger->Fare = $netfare[$i];
		$Passenger->SeatType = 'Seater';
		$Passenger->IsAcSeat = 'True';
		$Passengers->Passenger[$i] = $Passenger;
		$search_query->Passengers = $Passengers;
	}
}
	$_SESSION['search_query']=$search_query;
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for
		try
		{
			$result = $client->HoldSeatsForSchedule($search_query);
			//echo "<pre>";
			//print_r($result);
			//echo "</pre>";
			return json_decode((json_encode($result)),true);
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function HoldSeatsForSchedule_round()
	{
    $seatarray2 = seatArray($_SESSION['BUS_ROUND']['seatName_roundtrip']);
    $netfare = fareArray($_SESSION['BUS_ROUND']['net_price_roundtrip']);
	$schedule_id=$_SESSION['BUS_ROUND']['scheduleId_roundtrip'];
	echo $_SESSION['BUS_ROUND']['travelDate_roundtrip'];
	$dep_date=$_SESSION['BUS_ROUND']['travelDate_roundtrip'];
	//$pickup_id=$_SESSION['pickup_Id'];
	$seat_no1=explode('|A|',$_SESSION['BUS_ROUND']['seatName_roundtrip']);
	$seat_no='';
	foreach($seat_no1 as $seat)
	$seat_no.=$seat;
		//echo $schedule_id.$pickup_id.$dep_date.$seat_no;
		include 'Authenticate.php';
		$search_query->RouteScheduleId = $schedule_id;
$search_query->PickUpID =boardingPoint($_SESSION['BUS_ROUND']['BoardingPointName_roundtrip']);
$search_query->JourneyDate = $dep_date;
$search_query->ContactInformation = new StdClass();
$search_query->ContactInformation->CustomerName = $_SESSION['fullname'][0];
$search_query->ContactInformation->Email = $_SESSION['email'];
$search_query->ContactInformation->Phone = '';
$search_query->ContactInformation->Mobile = $_SESSION['mobile'];
$count = 0;
//$Passengers=new StdClass();
$search_query->Passengers = new StdClass();

for ($i = 0; $i < numberOfSeat($_SESSION['BUS_ROUND']['seatName_roundtrip']); $i++)
{
	$Passenger = new StdClass();
	//$Passenger = array();
	if ($count == 0)
	{

		
		$Passenger->Name = $_SESSION['fullname'][$i];
		$Passenger->Age = $_SESSION['age'][$i];
		$Passenger->Gender = $_SESSION['gender'][$i];
		$Passenger->SeatNo = $seatarray2[$i];
		$Passenger->Fare = $netfare[$i];
		$Passenger->SeatType = 'Seater';
		$Passenger->IsAcSeat = 'True';
		$Passengers->Passenger[$i] = $Passenger;
		$search_query->Passengers = $Passengers;
		$count++;
	}
	else if ($count == 1)
    {
		$Passenger->Name = $_SESSION['fullname'][$i];
		$Passenger->Age = $_SESSION['age'][$i];
		$Passenger->Gender = $_SESSION['gender'][$i];
		$Passenger->SeatNo = $seatarray2[$i];
		$Passenger->Fare = $netfare[$i];
		$Passenger->SeatType = 'Seater';
		$Passenger->IsAcSeat = 'True';
		$Passengers->Passenger[$i] = $Passenger;
		$search_query->Passengers = $Passengers;
	}
}
	$_SESSION['search_query']=$search_query;
	/* echo "<pre>";
			print_r($search_query);
			echo "</pre>"; */
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for
		try
		{
			$result = $client->HoldSeatsForSchedule($search_query);
			/* echo "<pre>";
			print_r($search_query);
			echo "</pre>"; */
			return json_decode((json_encode($result)),true);
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
		/*
	function HoldSeatsForSchedule()
	{
		include_once 'Authenticate.php';
		$search_query->RouteScheduleId = 507730578;
$search_query->PickUpID = 8388293;
$search_query->JourneyDate = '2015-09-25';
$search_query->ContactInformation = new StdClass();
$ContactInformation1= new StdClass();
$ContactInformation1->CustomerName = 'Heera Jaiswal';
$ContactInformation1->Email = 'jaisan45@live.com';
$ContactInformation1->Phone = '';
$ContactInformation1->Mobile = '9790234772';
$search_query->ContactInformation = json_decode(json_encode($ContactInformation1), true);
$search_query->Passengers = new StdClass();
$Passenger = new StdClass();
$Passenger->Name = 'Heera Jaiswal';
$Passenger->Age = 23;
$Passenger->Gender = 'M';
$Passenger->SeatNo = '2';
$Passenger->Fare = '100';
$Passenger->SeatType = 'Seater';
$Passenger->IsAcSeat = 'False';
$search_query->Passengers = json_decode(json_encode($Passenger), true);
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->HoldSeatsForSchedule($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	*/
	function BookSeats($block_id)
	{
		include 'Authenticate.php';
		$search_query->HoldKey = $block_id;
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->BookSeats($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	
	
	function GetBookingStatus($ticket_no)
	{
		include 'Authenticate.php';
		$search_query->BookingId  = $ticket_no;
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetBookingStatus($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function GetBookingInfo($ticket_no)
	{
		include 'Authenticate.php';
		$search_query->BookingId  = $ticket_no;
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetBookingInfo($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function IsCancellable2()
	{
		include_once 'Authenticate.php';
		$search_query->PNRNo = '18398525-631953';
$search_query->TicketNo = '630131420724';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->IsCancellable2($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	
	
	
	function CancelTicket2($pnr, $tktno)
	{
		include 'Authenticate.php';
		$search_query->PNRNo = $pnr;
		$search_query->TicketNo = $tktno;
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->CancelTicket2($search_query);
			return json_decode((json_encode($result)),true);
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function IsCancellablePartial()
	{
		include_once 'Authenticate.php';
		$search_query->PNRNo  = '142060848';
$search_query->TicketNo  = '142060848';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->IsCancellablePartial($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function CancelTicket()
	{
		include_once 'Authenticate.php';
		$search_query->PNRNo  = '142060848';
$search_query->TransactionID  = '142060848';
$search_query->BackDateCode  = '142060848';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->CancelTicket($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function GetAllCompanies()
	{
		include_once 'Authenticate.php';
		
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetAllCompanies($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function GetAllCompanyRoutesByJourneyDate()
	{
		include_once 'Authenticate.php';
		$search_query->CompanyId = '4549';
$search_query->JourneyDate = '2015-01-02';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetAllCompanyRoutesByJourneyDate($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function GetPickupsForCompany()
	{
		include_once 'Authenticate.php';
		$search_query->CompanyId = '6916';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetPickupsForCompany($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	
	function GetDropoffsForCompany()
	{
		include_once 'Authenticate.php';
		$search_query->CompanyId = '6916';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetDropoffsForCompany($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}
	function GetAllRoutesByJourneyDate2()
	{
		include_once 'Authenticate.php';
		$search_query->JourneyDate = '2015-09-25';
		$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
		try
		{
			$result = $client->GetAllRoutesByJourneyDate2($search_query);
			return $result;
		}
		catch(OAuthException2 $e)
		{
			//echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			//echo "generic exception".$e1."<hr></br>";
		}

	}

?>

