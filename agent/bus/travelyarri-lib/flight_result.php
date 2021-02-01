<?php
//
//$request = array("
//<Request>
//<Origin>BLR</Origin>
//<Destination>DEL</Destination>
//<DepartDate>2015-08-10</DepartDate>
//<ReturnDate>2015-08-11</ReturnDate>
//<AdultPax>01</AdultPax>
//<ChildPax>0</ChildPax>
//<InfantPax>0</InfantPax>
//<Currency>INR</Currency>
//<Clientid>77743634</Clientid>
//<Clientpassword>*375FFACF2050CABD1CE98B6591EC01D62CDBF972</Clientpassword>
//<Clienttype>ArzooFWS1.1</Clienttype>
//<Preferredclass>E</Preferredclass>
//<mode>ONE</mode>
//</Request>");
//
//$location_URL = "http://59.162.33.102/ArzooWS/services/DOMFlightAvailability";
//$action_URL = "http://avail.flight.arzoo.com";
//$client = new SoapClient('http://59.162.33.102/ArzooWS/services/DOMFlightAvailability?wsdl', array(
//    'soap_version' => SOAP_1_1,
//    'location' => $location_URL,
//    'uri' => $action_URL,
//    'style' => SOAP_RPC,
//    'use' => SOAP_ENCODED,
//    'trace' => 1,
//        ));

try {
//    $result = $client->__call('getAvailability', $request);
//    $response = htmlentities($result);



    $a = json_decode(json_encode((array) simplexml_load_file('include/flight_lib/flight_search.xml')), 1);
//   print_r ($a['Response__Depart']['OriginDestinationOptions']['OriginDestinationOption'][1]['FareDetails']['ChargeableFares']['Tax']);
} catch (Exception $e) {
    echo "<h2>Exception Error!</h2>";
    echo $e->getMessage();
}



//echo "<pre>";
//print_r($a);
//echo "</pre>";
?>
