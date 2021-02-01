<?php
$selectUserData = "SELECT * FROM user_login ORDER BY id ASC LIMIT 0,1";
$queryUserData = mysql_query($selectUserData);
$resultUsertData = mysql_fetch_object($queryUserData);
$redu_markup1 = $resultUsertData->bus_user_markup;
$redu_markup = abs($resultUsertData->bus_user_markup);
//=============================//
include_once "bus_library/SSAPICaller.php";
include_once "bus_library/BlockRequest.php";

function boardingPoint($value)
{
    $Boarding_id = explode('-', $value);
    return $Boarding_id[0];
}

function numberOfSeat($value)
{
    $seatarray = explode("|A|", $value);
    $seatarray = implode(",", $seatarray);
    $seatarray2 = substr($seatarray, 1);
    $seatarray2 = explode(",", $seatarray2);
    return count($seatarray2);
}

function seatArray($value)
{
    $seatarray = explode("|A|", $value);
    $seatarray = implode(",", $seatarray);
    $seatarray2 = substr($seatarray, 1);
    return $seatarray2 = explode(",", $seatarray2);
}

function fareArray($value)
{
    $net = $value;
    $net = explode("|A|", $net);
	
	/*if($redu_markup1<0) { $net = $net/((100-$redu_markup)/100); }
	if($redu_markup1>=0) { $net = $net/((100+$redu_markup)/100); }
	echo $net;*/
	
    $net = implode(",", $net);
    $tltnetfair2 = substr($net, 1);
    return $tltnetfair2 = explode(",", $tltnetfair2);
}

//$title = $_POST['title'];
//$firstname = $_POST['firstname'];
//$lastname = $_POST['lastname'];
$_SESSION['fullname'] = $_POST['fullname'];
$_SESSION['age'] = $_POST['age'];
//print_r($age);
//for($i=0;$i==$i;$i++)
$gender = $_POST['gender1'];
//$address = $_SESSION['address'] = $_POST['address'];
//$_SESSION['city'] = $_POST['city'];
//$_SESSION['state'] = $_POST['state'];
//$_SESSION['pincode'] = $_POST['pincode'];

$mobileno = $_SESSION['mobile'] = $_POST['mobile'];
$mailid = $_SESSION['email'] = $_POST['email'];

// Oneway blocking system 
if ($_SESSION['mode'] != "ROUND")
{

   /* $blockRequest = new StdClass();
	//$Authentication = new StdClass();
	$blockRequest->Authentication = new StdClass();
$blockRequest->Authentication->UserID = '6360';
$blockRequest->Authentication->UserType = 'S';
$blockRequest->Authentication->Key = '7fd29ee0cb4b910d96d0ef86f16c8854';

    //$blockRequest->Authentication=$Authentication;
	$blockRequest->RouteScheduleId = $_SESSION['scedulr_id'];
    $blockRequest->PickUpID = boardingPoint($_SESSION['BoardingPointName_oneway']);
	$blockRequest->JourneyDate = $_SESSION['originalDate'];
   
   	$blockRequest->ContactInformation->CustomerName = 'jAISON';
   	$blockRequest->ContactInformation->Email = 'jaisan45@live.com';
   	$blockRequest->ContactInformation->Phone = '';
   	$blockRequest->ContactInformation->Mobile = '9790234772';
    
	//$blockRequest->destination = $_SESSION['toStationId_oneway'];
    //$blockRequest->source = $_SESSION['fromStationId_oneway'];
    $count = 0;
    $seatarray2 = seatArray($_SESSION['seatName_oneway']);
    $netfare = fareArray($_SESSION['net_price_oneway']);
	//echo "<pre>"; print_r($_SESSION['net_price_oneway']); exit;
    //$blockRequest->Passengers = array();
    for ($i = 0; $i < numberOfSeat($_SESSION['seatName_oneway']); $i++)
    {
        $Passengers = new Passengers();
        if ($count == 0)
        {
           $passenger = new passenger();
           
            $passenger->Name = $fullname[$i];
            $passenger->Age = $age[$i];
            $gender1 = 'gender' . ($i + 1);
            $passenger->Gender = $_POST[$gender1];
            $passenger->SeatNo = $seatarray2[$i];
           
            $passenger->Fare = $netfare[$i];
            $passenger->SeatType = 'Seater';

           
            $passenger->IsAcSeat = 'fALSE';
           
            $Passengers->passenger = $passenger;
           
            $blockRequest->Passengers[$i] = $Passengers;
            $count++;
           
            $_SESSION['fullname1'] = $_SESSION['fullname'] = $fullname[$i];
            $_SESSION['age1'] = $_SESSION['a<em></em>ge'] = $age[$i];
            $_SESSION['gender1'] = $_SESSION['gender'] = $_POST[$gender1];
           
        } else if ($count == 1)
        {
            $passenger = new passenger();
           
            $passenger->Name = $fullname[$i];
            $passenger->Age = $age[$i];
            $gender1 = 'gender' . ($i + 1);
            $passenger->Gender = $_POST[$gender1];
            $passenger->SeatNo = $seatarray2[$i];
            $passenger->Fare = $netfare[$i];
            $passenger->SeatType = 'Seater';
            $passenger->IsAcSeat = 'fALSE';
            $Passengers->passenger = $passenger;
            $blockRequest->Passengers[$i] = $Passengers;
            $_SESSION['fullname'] = $_SESSION['fullname'] . "|A|";
            $_SESSION['age'] = $_SESSION['age'] . "|A|" . $age[$i];
            $_SESSION['gender'] = $_SESSION['gender'] . "|A|" . $_POST[$gender1];
            
        } else
        {
            break;
        }
    }

	print_r(json_encode($blockRequest));*/
	$_SESSION['TentativeBooking_oneway_travelyarri'] =  $response_oneway =  HoldSeatsForSchedule();
	echo $_SESSION['TentativeBooking_oneway_1_ty']=$response_oneway['HoldSeatsForScheduleResult']['HoldKey'];
	
}
 if($_SESSION['mode']=="ROUND"){
	 	$_SESSION['TentativeBooking_oneway_travelyarri'] =  $response_oneway =  HoldSeatsForSchedule();
	 $_SESSION['TentativeBooking_oneway_1_ty']=$response_oneway['HoldSeatsForScheduleResult']['HoldKey'];
	 $_SESSION['TentativeBooking_round_travelyarri'] =  $response__round =  HoldSeatsForSchedule_round(); 	 
	$_SESSION['BUS_ROUND']['TentativeBooking_roundtrip']=$response__round['HoldSeatsForScheduleResult']['HoldKey'];
}
 
?>
