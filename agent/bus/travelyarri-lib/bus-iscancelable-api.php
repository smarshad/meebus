<?php
@session_start();
include_once "bus_library/SSAPICaller.php";
include_once "bus_library/BlockRequest.php";
$Cancelation_details = json_decode(getCancellationData($RBTicketNo));
        //print_r($Cancelation_details);
        //exit;
/*
Array
(
    [cancellable] => true
    [cancellationCharges] => Array
        (
            [entry] => Array
                (
                    [key] => F1
                    [value] => 55.00
                )

        )

    [fares] => Array
        (
            [entry] => Array
                (
                    [key] => F1
                    [value] => 550.00
                )

        )

    [partiallyCancellable] => true
)
*/
?>
