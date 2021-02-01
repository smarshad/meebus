<?php
session_start();
ob_start();
//=============================//
//include '../database/connect.php';
$selectUserData = "SELECT * FROM user_login ORDER BY id ASC LIMIT 0,1";
$queryUserData = mysql_query($selectUserData);
$resultUsertData = mysql_fetch_object($queryUserData);
$redu_markup1 = $resultUsertData->bus_user_markup;
$redu_markup = abs($resultUsertData->bus_user_markup);


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
    $net = implode(",", $net);
    $tltnetfair2 = substr($net, 1);
    return $tltnetfair2 = explode(",", $tltnetfair2);
}

//$title = $_POST['title'];
//$firstname = $_POST['firstname'];
//$lastname = $_POST['lastname'];
$fullname = $_SESSION['fullname'];
$age = $_SESSION['age'];
$gender = $_SESSION['gender1'];

//$address = $_SESSION['address'] = $_POST['address'];
//$_SESSION['city'] = $_POST['city'];
//$_SESSION['state'] = $_POST['state'];
//$_SESSION['pincode'] = $_POST['pincode'];

$mobileno = $_SESSION['mobile'] = $_SESSION['mobile'];
$mailid = $_SESSION['email'] = $_SESSION['email'];

// Oneway blocking system 
/*if ($_SESSION['mode'] != "ROUND")
{
    $blockRequest = new BlockRequest();
    $blockRequest->availableTripId = $_SESSION['scheduleId_oneway'];
    $blockRequest->boardingPointId = boardingPoint($_SESSION['BoardingPointName_oneway']);
    $blockRequest->destination = $_SESSION['toStationId_oneway'];
    $blockRequest->source = $_SESSION['fromStationId_oneway'];
    $count = 0;
    $seatarray2 = seatArray($_SESSION['seatName_oneway']);
    $netfare = fareArray($_SESSION['net_price_oneway']);
    $blockRequest->inventoryItems = array();
    for ($i = 0; $i < numberOfSeat($_SESSION['seatName_oneway']); $i++)
    {
        $inventoryItems = new inventoryItems();
        if ($count == 0)
        {
            $passenger = new passenger();
            //$passenger->name = $firstname[$i] . " " . $lastname[$i];
            $passenger->name = $fullname[$i];
            $passenger->email = $mailid;
            $passenger->age = $age[$i];
            $gender1 = 'gender' . ($i + 1);
            $passenger->gender = $_SESSION[$gender1];
            $passenger->mobile = $mobileno;
            //$passenger->title = $title[$i];
            $passenger->title = '';
            $passenger->primary = "true";

            //$passenger->address = $address;
            $passenger->address = '';
            $passenger->idNumber = "ID123";
            $passenger->idType = "PAN_CARD";

            $inventoryItems = new inventoryItems();
            $inventoryItems->passenger = $passenger;
            $inventoryItems->seatName = $seatarray2[$i];
            //$inventoryItems->fare = $netfare[$i]+($netfare[$i]*$redu_markup/100);
			
			if($redu_markup1<0) { $inventoryItems->fare = round($netfare[$i]/((100-$redu_markup)/100)); }
			if($redu_markup1>=0) { $inventoryItems->fare = round($netfare[$i]/((100+$redu_markup)/100)); }
			
            $inventoryItems->ladiesSeat = 'false';
            $blockRequest->inventoryItems[$i] = $inventoryItems;
            $count++;
            // ====== Initializing New Array Names ========= //
            //$_SESSION['title'] = $title[$i];
            //$_SESSION['firstname'] = $firstname[$i];
            //$_SESSION['lastname'] = $lastname[$i];
            $_SESSION['fullname'] = $fullname[$i];
            $_SESSION['age'] = $age[$i];
            $_SESSION['gender'] = $_SESSION[$gender1];
            // ====== Initializing New Array Names ========= //
        } else if ($count == 1)
        {
            $passenger = new passenger();
            //$passenger->name = $firstname[$i] . " " . $lastname[$i];
            $passenger->name = $fullname[$i];
            //$passenger->address = $address;
            $passenger->address = '';
            $passenger->email = $mailid;
            $passenger->age = $age[$i];
            $gender1 = 'gender' . ($i + 1);
            $passenger->gender = $_POST[$gender1];
            $passenger->mobile = $mobileno;
            $passenger->primary = "false";
            //$passenger->title = $title[$i];
            $passenger->title = '';
            $inventoryItems->passenger = $passenger;
            $inventoryItems->seatName = $seatarray2[$i];
			
			if($redu_markup1<0) { $inventoryItems->fare = $netfare[$i]/((100-$redu_markup)/100); }
			if($redu_markup1>=0) { $inventoryItems->fare = $netfare[$i]/((100+$redu_markup)/100); }
			
            //$inventoryItems->fare = $netfare[$i];
            $inventoryItems->ladiesSeat = 'false';
            $blockRequest->inventoryItems[$i] = $inventoryItems;

            // ====== Initializing New Array Names ========= //
            //$_SESSION['title'] = $_SESSION['title'] . "|A|" . $title[$i];
            //$_SESSION['firstname'] = $_SESSION['firstname'] . "|A|" . $firstname[$i];
            //$_SESSION['lastname'] = $_SESSION['lastname'] . "|A|" . $lastname[$i];
            $_SESSION['fullname'] = $_SESSION['fullname'] . "|A|";
            $_SESSION['age'] = $_SESSION['age'] . "|A|" . $age[$i];
            $_SESSION['gender'] = $_SESSION['gender'] . "|A|" . $_SESSION[$gender1];
            // ====== Initializing New Array Names ========= //                                        
        } else
        {
            break;
        }
    }
  
    //$response_oneway =  blockTicket(json_encode($blockRequest));
	$response_oneway = confirmTicket($_SESSION['TentativeBooking_oneway1']);
 	$response_oneway = getTicket($response_oneway); 
	//echo  json_encode($response_oneway); exit;
}*/
$response_oneway = BookSeats($_SESSION['TentativeBooking_oneway1']);
//echo "<pre>";

//print_r($booking);

//echo "</pre>";
//$ticket_no=$booking['BookSeatsResult']['TicketNo'];
//$ticket_no='9173634';
//$response_oneway = GetBookingStatus($ticket_no);
//echo "<pre>";
//print_r(json_decode(json_encode($response_oneway),true));
//echo "</pre>"; 
//$response_oneway = CancelTicket2($ticket_no);
//echo "<pre>";
//print_r(json_decode(json_encode($response_oneway),true));
//echo "</pre>"; 
?>
