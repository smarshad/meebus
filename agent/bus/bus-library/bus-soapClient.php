<?php
$tdate = explode('/', $travelDate);
$tdate = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
//echo $origin_id;
//echo $destination_id;

$inputString = getAvailableTrips($origin_id, $destination_id, $tdate);
$results = json_decode($inputString, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
?>

