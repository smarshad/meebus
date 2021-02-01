<?php
session_start();
include_once "bus_library/SSAPICaller.php";
include_once "bus_library/BlockRequest.php";
if ($_SESSION['mode'] == "ROUND")
{
    if ($_SESSION['TentativeBooking_oneway'] == "")
    {
        echo '<h1>No blocked itineraries found for the given blockid';
    } else
    {
        $_SESSION['RB_Ticket_onway'] = $tiket_no_oneway = confirmTicket($_SESSION['TentativeBooking_oneway']);
        $_SESSION['RB_Ticket_round'] = $tiket_no_round = confirmTicket($_SESSION['TentativeBooking_round']);        
        $_SESSION['Ticket_details_oneway'] = $results_oneway = json_decode(getTicket($tiket_no_oneway));
        $_SESSION['Ticket_details_round'] = $results_round = json_decode(getTicket($tiket_no_round));        
    }
} else
{
    if ($_SESSION['TentativeBooking_oneway'] == "")
    {
        echo '<h1>No blocked itineraries found for the given blockid';
    } else
    {
        $_SESSION['RB_Ticket_onway'] = $tiket_no_oneway = confirmTicket($_SESSION['TentativeBooking_oneway']);
        $_SESSION['Ticket_details_oneway'] = $results_oneway = json_decode(getTicket($tiket_no_oneway));
    }
}
?>

