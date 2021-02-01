<?php
//=============================//
unset($_SESSION['title']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['age']);
unset($_SESSION['gender']);
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
    $net = implode(",", $net);
    $tltnetfair2 = substr($net, 1);
    return $tltnetfair2 = explode(",", $tltnetfair2);
}

$title = $_POST['title'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$age = $_POST['age'];
$gender = $_POST['gender1'];

$address = $_SESSION['address'] = $_POST['address'];
$_SESSION['city'] = $_POST['city'];
$_SESSION['state'] = $_POST['state'];
$_SESSION['pincode'] = $_POST['pincode'];
$mobileno = $_SESSION['mobile'] = $_POST['mobile'];
$mailid = $_SESSION['email'] = $_POST['email'];

// Oneway blocking system 
if ($_SESSION['mode'] != "ROUND")
{
    $blockRequest = new BlockRequest();
    $blockRequest->availableTripId = $_SESSION['scheduleId_oneway'];
    $blockRequest->boardingPointId = boardingPoint($_SESSION['BoardingPointName_oneway']);
    $blockRequest->destination = $_SESSION['toStationId_oneway'];
    $blockRequest->source = $_SESSION['fromStationId_oneway'];
    $count = 0;
    $seatarray2 = seatArray($_SESSION['seatName_oneway']);
    $netfare = fareArray($_SESSION['cost_price_oneway']);    
    $blockRequest->inventoryItems = array();
    for ($i = 0; $i < numberOfSeat($_SESSION['seatName_oneway']); $i++)
    {
        $inventoryItems = new inventoryItems();
        if ($count == 0)
        {
            $passenger = new passenger();
            $passenger->name = $firstname[$i] . " " . $lastname[$i];
            $passenger->email = $mailid;
            $passenger->age = $age[$i];
            $gender1 = 'gender' . ($i + 1);
            $passenger->gender = $_POST[$gender1];
            $passenger->mobile = $mobileno;
            $passenger->title = $title[$i];
            $passenger->primary = "true";

            $passenger->address = "Some Address";
            $passenger->idNumber = "ID123";
            $passenger->idType = "PAN_CARD";

            $inventoryItems = new inventoryItems();
            $inventoryItems->passenger = $passenger;
            $inventoryItems->seatName = $seatarray2[$i];
            $inventoryItems->fare = $netfare[$i];
            $inventoryItems->ladiesSeat = 'false';
            $blockRequest->inventoryItems[$i] = $inventoryItems;
            $count++;
            // ====== Initializing New Array Names ========= //
            $_SESSION['title'] = $title[$i];
            $_SESSION['firstname'] = $firstname[$i];
            $_SESSION['lastname'] = $lastname[$i];
            $_SESSION['age'] = $age[$i];
            $_SESSION['gender'] = $_POST[$gender1];
            // ====== Initializing New Array Names ========= //
        } else if ($count == 1)
        {
            $passenger = new passenger();
            $passenger->name = $firstname[$i] . " " . $lastname[$i];
            $passenger->address = "Some Address";
            $passenger->email = $mailid;
            $passenger->age = $age[$i];
            $gender1 = 'gender' . ($i + 1);
            $passenger->gender = $_POST[$gender1];
            $passenger->mobile = $mobileno;
            $passenger->primary = "false";
            $passenger->title = $title[$i];
            $inventoryItems->passenger = $passenger;
            $inventoryItems->seatName = $seatarray2[$i];
            $inventoryItems->fare = $netfare[$i];
            $inventoryItems->ladiesSeat = 'false';
            $blockRequest->inventoryItems[$i] = $inventoryItems;

            // ====== Initializing New Array Names ========= //
            $_SESSION['title'] = $_SESSION['title'] . "|A|" . $title[$i];
            $_SESSION['firstname'] = $_SESSION['firstname'] . "|A|" . $firstname[$i];
            $_SESSION['lastname'] = $_SESSION['lastname'] . "|A|" . $lastname[$i];
            $_SESSION['age'] = $_SESSION['age'] . "|A|" . $age[$i];
            $_SESSION['gender'] = $_SESSION['gender'] . "|A|" . $_POST[$gender1];
            // ====== Initializing New Array Names ========= //                                        
        } else
        {
            break;
        }
    }
   $response_oneway = blockTicket(json_encode($blockRequest)); 
   //print_r(json_encode($blockRequest));
  // print_r($response_oneway);  
   //exit;
   $response_oneway = confirmTicket($response_oneway);
   $response_oneway = getTicket($response_oneway);  

}

