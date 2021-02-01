<?php
	try {
		$options = array('soap_version'=>SOAP_1_2,'exceptions'=>true,'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE, 'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP);
        $client = new SoapClient('http://www.redbus.in/WS2/BookingService.asmx?wsdl',$options);
		$request=array( 'authentication' =>array('LoginID' => "PWSSUBHTL2011",'Password' => "Su03bHy1z1Gj2Su0b1Tr1y" ),
						'RouteID' => $scheduleId, 
						'DateOfJourney' => $tdate);
		$results = $client->GetSeatLayout($request);
               // echo "<pre>";
               // print_r($results);
		$boardingpoint = $client->GetBoardingPoints($request);
   } catch (Exception $e) {
		//echo "<h2>Exception Error!</h2>";
		$error=$e->getMessage();
	}
