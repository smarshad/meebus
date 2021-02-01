<?php
ini_set('display_errors', 1);
ini_set('max_execution_time', 300);
include '../../server/server.php'; 
include_once '../../agent/includes/functions.php';
$obj=new agent_module($con);  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$mode='agent';

unset($_SESSION[$mode]['bus']['seat']);
$_SESSION[$mode]['bus']['netfare']=0;
$_SESSION['agent']['bus']['service_charge']=0;
$_SESSION['agent']['bus']['serviceChargeValues']=0;
$_SESSION[$mode]['bus']['agent_markup']=0;
$_SESSION[$mode]['bus']['commission']=0;
?>
<style>
    .avail img{cursor:pointer;}
    #seat_set
    {
        font-family: Arial,Helvetica,sans-serif;
        font-size: 11px;
        line-height: 18px;
        padding-left: 5px;
        text-align: center;	
    }
	.to{border-top: 1px solid #ccc !important}
	.bord{margin-top: 10px;}
	.seat-no{width: 40% !important}
	.fare{width: 90%}
	.gen{width: 85%}
	.name{width:95% !important}
	.bot{margin-bottom: 10px;}
	.lef{margin-left: 20px}
	.fon{font-size: 10px}
	.dummy{height:0px;}
	.row-fluid > [class*="span"].marker ~ [class*="span"].marker{
margin-left: 2.127659574468085%; }
</style>
<?php
function objectToArray($object) {
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    if (is_object($object)) {
        $object = get_object_vars($object);
    }
    return array_map('objectToArray', $object);
}

function convertdate($travelDate) {
    $tdate = explode('/', $travelDate);
    $tdate = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
    return $tdate;
}
$scheduleId=$_POST['id'];
$otherdatas = explode('^',str_replace("*","&",$_REQUEST['otherdata']));
$log=$_POST['id'].'^'.$_REQUEST['otherdata'];

//echo "<pre>"; print_r($_SESSION['agent']['log']); 
$error_logs.= "Page : seat-availabilty.php<br/>POST Values : ".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];

$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'bus search result pop up','Page Enter',$error_logs);
$agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
$update_agent_active = $obj->agent_active($agent_active_details);

$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
$update_error_logs=$obj->error_logs($error_logs_detail);

$bus_result=$_SESSION[$mode]['bus']['bus_result'];
$i=0;
unset($_SESSION[$mode]['bus']['resultbySchedule']);
unset($_SESSION[$mode]['bus']['businfo']);
if(isset($bus_result[0]))
{
foreach($bus_result as $bus)
{	

	if($bus['RouteScheduleId']==$scheduleId)
	{
		$bus_res=$bus_result[$i];
		$_SESSION[$mode]['bus']['businfo']['bus_provider']=$bus_provider=$bus['CompanyName'];
		$_SESSION[$mode]['bus']['businfo']['busType']=$bus_type=$bus['BusTypeName'];
		//$boarding=$bus['boardingTimes'];
		$_SESSION[$mode]['bus']['businfo']['schedule_ID']=$scheduleId=$bus['RouteScheduleId'];
		$travelDate=$_SESSION[$mode]['bus']['travelDate'];
		$fromStationId=$_SESSION[$mode]['bus']['origin_id'];
		$toStationId=$_SESSION[$mode]['bus']['destination_id'];
		$tdate=convertdate($_SESSION[$mode]['bus']['travelDate']);
		$_SESSION[$mode]['bus']['resultbySchedule']=$bus_result[$i];
	}
	$i++;
}
}
else
{	
		$bus=$bus_result;
		if(isset($bus_result[$i]))
		$bus_res=$bus_result[$i];
		$_SESSION[$mode]['bus']['businfo']['bus_provider']=$bus_provider=$bus['travels'];
		$_SESSION[$mode]['bus']['businfo']['busType']=$bus_type=$bus['busType'];
		$boarding=$bus['boardingTimes'];
		$_SESSION[$mode]['bus']['businfo']['schedule_ID']=$scheduleId=$bus['id'];
		$travelDate=$_SESSION[$mode]['bus']['travelDate'];
		$fromStationId=$_SESSION[$mode]['bus']['origin_id'];
		$toStationId=$_SESSION[$mode]['bus']['destination_id'];
		$tdate=convertdate($_SESSION[$mode]['bus']['travelDate']);
		$_SESSION[$mode]['bus']['resultbySchedule']=$bus_result;
}
unset($_SESSION[$mode]['bus']['boarding']);
if(isset($boarding[0]))
{
	
foreach($boarding as $board)
{
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['boarding_id']=$boarding_id=$board['bpId'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['time']=date("g:i A", strtotime(floor($board['time'] / 60) . ":" . $board['time'] % 60));
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['bpname']=$board['bpName'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['address']=$board['address'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['contact']=$board['contactNumber'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['landmark']=$board['landmark'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['location']=$board['location'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['prime']=$board['prime'];
}
}
else
{
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['boarding_id']=$boarding_id=$boarding['bpId'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['time']= date("g:i A", strtotime(floor($boarding['time'] / 60) . ":" . $boarding['time'] % 60));
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['bpname']=$boarding['bpName'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['address']=$boarding['address'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['contact']=$boarding['contactNumber'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['landmark']=$boarding['landmark'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['location']=$boarding['location'];
	$_SESSION[$mode]['bus']['boarding'][$boarding_id]['prime']=$boarding['prime'];
}


include 'layout-SoapClient.php';
//exit;
$result = $results;
unset($seat_type_counter);
if(isset($result['GetRouteScheduleDetailsWithCommResult']['Layout']))
$SeatLayoutSTR = $GetSeatLayoutResult = $result['GetRouteScheduleDetailsWithCommResult']['Layout']['SeatDetails']['clsSeat'];
else
{
	echo "Sorry Try some after times.";
	exit;
}
//echo "<pre>";
//print_r($result['GetRouteScheduleDetailsWithCommResult']['Pickup']);
//echo $pickup_Id=$result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupId'];
//echo "</pre>";
if(isset($SeatLayoutSTR))
foreach ($SeatLayoutSTR as $val) {
    if ($val['Deck'] == 1) {
        // Values for lower birth and sleeper and seater both
        $i = $val['Col'];
        $j = $val['Row'];
        $RowNo[$i] = $val['Col'];
        $ColumnNo[$j] = $val['Row'];
        $SeatName[$j][$i] = $val['SeatNo'];
        $SeatStatus[$j][$i] = $val['IsAvailable'];
        $SeatFare[$j][$i] = $val['Fare'];
        $st[$j][$i] = $val['Deck'];
		$asile[$j][$i]=$val['IsAisle'];
		$IsSleeper[$j][$i]=$val['IsSleeper'];
		
		
		if($val['Gender']!='M' && isset($ladish[$j][$i]))
        $ladish[$j][$i] = $val['ladiesSeat'];
        $s_length[$j][$i] = $val['Height'];
        $s_width[$j][$i] = $val['Width'];
$li = max($RowNo);
$lj = max($ColumnNo);
    } else {
		
        // Values for upper lower birth 	
        $seat_type_counter = "sleeper";
        $i = $val['Col'];
        $j = $val['Row'];
        $RowNo1[$i] = $val['Col'];
		$asile[$j][$i]=$val['IsAisle'];
        $ColumnNo1[$j] = $val['Row'];
        $SeatName1[$j][$i] = $val['SeatNo'];
        $SeatStatus1[$j][$i] = $val['IsAvailable'];
        $SeatFare1[$j][$i] = $val['Fare'];
		if($val['Gender']!='M' && isset($val['ladiesSeat']))
        $ladish1[$j][$i] = $val['ladiesSeat'];
        $st1[$j][$i] = $val['Deck'];
		$seatNo[$j][$i]=$val['SeatNo'];
        $s_length1[$j][$i] = $val['Height'];
        $s_width1[$j][$i] = $val['Width'];
		$IsSleeper[$j][$i]=$val['IsSleeper'];
$li1 = max($RowNo1);
$lj1 = max($ColumnNo1);
    }
}

?>
<img src="../../images/close-x.png" alt="close" title="" style="z-index:100;right:0px;top:0px;width:25px;height:25px;position:absolute;cursor:pointer;" class="closeIcon" />
<div style="width:70%; padding:15px; margin:10px 0; box-shadow: 0 0 14px #CCCCCC;background:#fff; height:100%; border:1px #ddd solid; border-radius:6px;margin:auto;position:relative;">
    <img src="../../images/close-x.png" alt="close" title="" style="right:-10px;top:-10px;width:25px;height:25px;position:absolute;cursor:pointer;" class="closeIcon" />
    <table width="100%" height="199" border="0" cellspacing="2" cellpadding="0">
        <tr>
            <td width="229" align="left" valign="top">&nbsp;</td>
            <td width="71" align="left" valign="top">&nbsp;</td>
            <td width="67" align="left" valign="top">&nbsp;</td>
            <td width="57" align="left" valign="top">&nbsp;</td>
            <td align="right" valign="top"><!--<img src="images/Close.png" width="21" height="21" /> --></td>
        </tr>
        <tr>
            <td colspan="4" align="left" valign="top" id="seat_set">Hint: click on seat to select/deselect</td>
            <td width="131" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" rowspan="5" align="right" valign="top">
                <!--seat availablity table start -->
                <table border="0" width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"> 
                    <tr>
                        <td>
                            <table border="0" width="100%" height="40%" align="left" class="input">  
<?php
if (isset($seat_type_counter)) {
	
    /*     * ************************************* Sleeper Lower Seats ******************************** */
    $flag = true;
    for ($i = 0; $i <= $li; $i++) {
        echo '<tr>';
        for ($j = 0; $j <= $lj; $j++) {
            /* Seating arrangement Start here */
            if (isset($st[$j][$i]) && $st[$j][$i] == 1 && isset($asile[$j][$i]) && $asile[$j][$i]!=1) {
                if (isset($ladish[$j][$i]) && $ladish[$j][$i] == 'true') {
                    $ladis = "-ladies";
                } else {
                    $ladis = "";
                }
				//echo "length:".$s_length[$j][$i]."Width".$s_width[$j][$i];
                // finding whether seat type is sleeper or seater 
                if (($s_length[$j][$i] == 2 && $s_width[$j][$i] == 1)) {
                    $seat_type = 'Sleeper';
					//echo $seat_type;
                    $_val = '2';
                    $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
                } else if (($s_length[$j][$i] == 2 && $s_width[$j][$i] == 1)) {
                    $seat_type = 'Sleeper_V';
                    $_val = '2';
					//echo $seat_type;
                    $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
                } else {
					if($asile[$j][$i]!=1)
					{
                    $seat_type = 'Seat';
                    $_val = '';
                    $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
					}
                }

                //start displaying from here the steering part  
                if ($flag) {
                    echo '<td width="30" height="65"  rowspan=' . ($li + 1) . ' valign="top"><img src="../../images/steering.jpg"  /><br>' . $img . '</td>';
                    $flag = false;
                }

                echo '<td width="20" height="15" align="center">';

                // If seat is available then display the seat 
                if ($SeatStatus[$j][$i] == true) {
                    echo '<div class="avail"><img  src="../../images/' . $seat_type . $ladis . '.jpg"  title="Seat number: ' . $SeatName[$j][$i] . '  |  Fare: Rs. ' . $SeatFare[$j][$i] . ' | ' . $SeatFare[$j][$i] . '" rel="' . $SeatName[$j][$i] . '" alt ="' . $SeatFare[$j][$i] . '" ><img  src="../../images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                } else if ($SeatStatus[$j][$i] == 0 && count($SeatName[$j][$i]) != 0) {
                    echo '<img src="../../images/' . $seat_type . '-booked.jpg">';
                }
                echo '</td>';
            }
        }
        echo '</tr>';
    }
    ?>
                                </table>


                                <div style="height:2px; clear:both; width:100%;"></div>

        <table border="0" width="100%" height="40%" align="center" class="input" style="margin-top:20px;">  
            <?php
            /*                                     * ******************************************** Sleeper Upper Seats *********************************************** */
            $flag = true;
            for ($i = 0; $i <= $li1; $i++) {
                echo '<tr>';
                for ($j = 0; $j <= $lj1; $j++) {
                    //start displaying from here the steering part  
                    if ($flag) {
                        echo '<td width="30" height="30" rowspan=' . ($li1 + 1) . '><br><img src="../../images/upper.jpg" width="30" height="65" /></td>';
                        $flag = false;
                    }
                    echo '<td width="20" height="15" align="center">';

                    /* Seating arrangement Start here */

                    if (isset($st1[$j][$i]) && $st1[$j][$i] == 2 && isset($asile[$j][$i]) && $asile[$j][$i]!=1) {
                        if (isset($ladish1[$j][$i]) && $ladish1[$j][$i] == 'true') {
                            $ladis = "-ladies";
                        } else {
                            $ladis = "";
                        }
                        // finding whether seat type is sleeper or seater 
                        if ((isset($s_length1[$j][$i]) && $s_length1[$j][$i] == 2 && isset($s_width1[$j][$i]) && $s_width1[$j][$i] == 1)) {
                            $seat_type = 'Sleeper';
                            $_val = '2';
                            $img = '<img src="../../images/upper.jpg" width="21" height="65" />';
                        } else if (($s_length1[$j][$i] == 1 && $s_width1[$j][$i] == 2)) {
                            $seat_type = 'Sleeper_V';
                            $_val = '2';
                            $img = '<img src="../../images/upper.jpg" width="21" height="65" />';
                        } else {
                            if($IsSleeper[$j][$i]!=1)
                            {
                            $seat_type = 'Seat';
                            $_val = '';
                            $img = '<img src="../../images/upper.jpg" width="21" height="65" />';
                            }
                        }


                        // If seat is available then display the seat 
                        if(isset($asile[$j][$i]) && $asile[$j][$i]!=1)
                        if (isset($SeatStatus1[$j][$i]) && $SeatStatus1[$j][$i] == true) {
                            echo '<div class="avail"><img  src="../../images/' . $seat_type . $ladis . '.jpg"  title="Seat number: ' . $SeatName1[$j][$i] . '  |  Fare: Rs. ' . $SeatFare1[$j][$i] . ' | ' . $SeatFare1[$j][$i] . '" rel="' . $SeatName1[$j][$i] . '" alt ="' . $SeatFare1[$j][$i] . '" ><img  src="../../images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                        } else if ($SeatStatus1[$j][$i] == 0 && count($SeatName1[$j][$i]) != 0) {
                            echo '<img src="../../images/' . $seat_type . '-booked.jpg">';
                        }
                        echo '</td>';
                    }
                }
                echo '</tr>';
            }
            /*                                     * ********************************************End Sleeper Upper Seats *********************************************** */
        } else {
            $flag = true;
            for ($i = 0; $i <= $li; $i++) {
                echo '<tr>';
                for ($j = 0; $j <= $lj; $j++) {
                    /* Seating arrangement Start here */
                    if (isset($ladish[$j][$i]) && $ladish[$j][$i] == 'true') {
                        $ladis = "-ladies";
                    } else {
                        $ladis = "";
                    }
                    // finding whether seat type is sleeper or seater 
                    if ((isset($s_length[$j][$i]) && $s_length[$j][$i] == 1 && $s_width[$j][$i] == 2) || (isset($s_length[$j][$i]) && $s_length[$j][$i] == 2 && $s_width[$j][$i] == 1)) {
                        $seat_type = 'Sleeper_V';
                        $_val = '2';
                        if ($st[$j][$i] == 1) // if it is 0 then it whould be lb
                            $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
                        else if ($st[$j][$i] == 2)
                            $img = '<img src="../../images/upper.jpg" width="21" height="65" />';
                        else
                            $img = '';
                    }
                    else {
                        $seat_type = 'Seat';
                        $_val = '';
                    }

                    //start displaying from here the steering part  
                    if ($flag && isset($img)) {
                        echo '<td width="30" height="30" rowspan=' . ($li + 1) . ' valign="top"><img src="../../images/steering.jpg"  /><br>' . $img . '</td>';
                        $flag = false;
                    }

                    echo '<td width="30" height="30" align="center">';

                    // If seat is available then display the seat 
                    if(isset($asile[$j][$i]) && $asile[$j][$i]!=1)
                    if ($SeatStatus[$j][$i] == true) {
                        echo '<div class="avail"><img  src="../../images/' . $seat_type .$ladis. '.jpg"  title="Seat number: ' . $SeatName[$j][$i] . '  |  Fare: Rs. ' . $SeatFare[$j][$i] . ' | ' . $SeatFare[$j][$i] . '" rel="' . $SeatName[$j][$i] . '" alt ="' . $SeatFare[$j][$i] . '" ><img  src="../../images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                    } else if ($SeatStatus[$j][$i] == 0 && count($SeatName[$j][$i]) != 0) {
                        echo '<img src="../../images/' . $seat_type . '-booked.jpg">';
                    }
                    echo '</td>';
                }
                echo '</tr>';
            }
        }
        /* Seating arrangement Start here */
        ?>
    </table>
                        </td>
                    </tr>
                </table>
                <!--seat availablity table End --></td>
                                <?php
                                if ($seat_type == "Sleeper_v") {
                                    $seat_type = "Sleeper";
                                }
                                ?>
            <td align="right" valign="top"><img src="../../images/<?php echo $seat_type . $_val; ?>.jpg" /></td>
            <td align="left" valign="top" id="seat_set">Available seat</td>
        </tr>
        <tr>
            <td align="right" valign="top"><img  src="../../images/<?php echo $seat_type . $_val; ?>-ladies.jpg" /></td>
            <td align="left" valign="top" id="seat_set">Reserved for ladies</td>
        </tr>
        <tr>
            <td align="right" valign="top"><img src="../../images/<?php echo $seat_type . $_val; ?>-availed.jpg" /></td>
            <td align="left" valign="top" id="seat_set">Selected seat</td>
        </tr>
        <tr>
            <td align="right" valign="top">
              <?php
              if ($seat_type == "Sleeper") {
                     echo '<img src="../../images/Sleeper-booked.jpg" alt="" title="" />';
              } else {
                     echo '<img src="../../images/Seat-booked.jpg" alt="" title="" />';

              }
              ?>
             </td>
            <td align="left" valign="top" id="seat_set">Booked seat</td>
        </tr>        
        <tr>
            <td align="left" valign="top" id="seat_set"><strong>Seats:</strong> <br /> <br /><strong>Amounts:<?php  /*echo $SeatFare[1][1] */ ?></strong> </td>
            <td align="left" valign="top"><table><tr><td id="seat" style="padding:0px;font-size:12px;font-weight:bold;"></td></tr><tr><td id="price"  style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:left; font-weight:bold; padding-left:5px; color:#333; padding-top:18px;"></td></tr></table></td>
        </tr>

    </table>
</div>
                                <?php
                                $bp_id = explode(",", $bp_id);
								if(isset($bp_location))
                                $bp_location = explode(",", $bp_location);
								if(isset($bp_time))
                                $bp_time = explode(",", $bp_time);
                                $total_bp = count($bp_id);
                                ?> 
                                <?php
                                if ($_SESSION['trip_type'] == "oneway")
                                { 
                                ?>
<form name="booking" action="bus-booking_travels.php" method="POST">
    <input type="hidden" value="<?php echo $_POST['bus_provider']; ?>" name="bus_provider_oneway" />
    <input type="hidden" value="<?php echo $_POST['bus_type']; ?>" name="bus_type_oneway" />
    <input type="hidden" value="<?php echo $_POST['scheduleId']; ?>" name="scheduleId_oneway" />
    <input type="hidden" value="<?php echo $_POST['travelDate']; ?>" name="travelDate_oneway" />
    <input type="hidden" value="<?php echo $_POST['fromStationId']; ?>" name="fromStationId_oneway" />
    <input type="hidden" value="<?php echo $_POST['toStationId']; ?>" name="toStationId_oneway" />
    <input type="hidden" value="<?php echo $pickup_Id; ?>" name="pickup_id" />
    <input type="hidden" value="" id="seatName" name="seatName_oneway"/>
    <input type="hidden" value="<?php echo $_SESSION['dt_gs'][$bording_points]; echo $bording_points; ?>" id="dt_gs" name="dt_gs" />
    <input type="hidden" value="<?php echo $_SESSION['at_gs'][$bording_points]; ?>" id="at_gs" name="at_gs" />
    <input type="hidden" value="<?php echo $_SESSION['th_gs'][$bording_points]; ?>" id="th_gs" name="th_gs" />
    
    
    <input type="hidden" value="" name="sellingPrice_oneway" id="sellprice" />
    <input type="hidden" value="<?php //echo $_POST['net_fair']; ?>" name="net_price_oneway" id="netprice" />
    
    <input type="hidden" name="mode" value="<?php echo $_SESSION['mode1']; ?>"/>
    <div style="clear:both; width:100%; height:5px;"></div>
    <table width="462" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0 auto; font-size: 11px;  font-weight: bold;line-height: 30px;    text-align: left;">
        <tr><td>BoardingPoint Name</td><td colspan="2" >
                <select onchange="boardingLocation(this)" name="BoardingPointName_oneway"  style="width:200px;">
                    <option value="">--- Boarding Points ---</option>
<?php
if(isset($result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup'][1]))
{
/*for ($k = ($total_bp - 1); $k >= 0; $k--) {
    if (floor($bp_time[$k] / 60) > 24) {
        $time = date("g:i A", strtotime((floor(($bp_time[$k] / 60) - 24) . ":" . $bp_time[$k] % 60)));
    } else {
        $time = date("g:i A", strtotime(floor($bp_time[$k] / 60) . ":" . $bp_time[$k] % 60));
    }
    ?>
                        <option value="<?php echo $bp_id[$k] . '-' . $bp_location[$k] . '-' . $time; ?>"><?php echo $bp_location[$k] . "-" . $time; ?></option>
<?php }*/
foreach($result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup'] as $pickup)
{ 
$time1=explode('T',$pickup['PickupTime']);
	$time=$time1[1];
?>

	
	<option value="<?php echo $pickup['PickupId'] . '-' . $pickup['PickupName'] . '-' . $time; ?>"><?php echo $pickup['PickupName'] . "-" . $time; ?></option>
<?php 
}
}

else
{

	$time1=explode('T',$result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupTime']);
	$time=$time1[1];
?>
<option value="<?php echo $result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupId'] . '-' . $result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupName'] . '-' . $time; ?>"><?php echo $result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupName'] . "-" . $time; ?></option> 
<?php
}?>
                </select>
                <br />

            </td></tr>
        <tr><td>&nbsp;</td><td colspan="2"><input type="submit" class="btn2 btn_blue" name="submit" value="Book Request"  onclick="return validate();"><input type="hidden" name="submit" value="bookrequest" /></td></tr>        


        <tr><td colspan="3"><div id="setBoardingPoint" style=" display:none; border:1px solid #ddd; text-align:center; margin:10px 0; background:#e3e3e3; padding:3px; font-size:10px; color:#000; border-radius:7px;"></div></td></tr>
    </table>
    <div style="clear:both; width:100%; height:5px;"></div>
</form>
<?php
           } 
            else
                {  ?>
					<form name="booking" action="bus-load.php?origin=<?php echo $_SESSION['api_destination']; ?>&destination=<?php echo $_SESSION['api_origin']?>&depart=<?php echo $_SESSION['travelreturnDate']; ?>" method="POST">
    <input type="hidden" value="<?php echo $_POST['bus_provider']; ?>" name="bus_provider_roundtrip" />
    <input type="hidden" value="<?php echo $_POST['bus_type']; ?>" name="bus_type_roundtrip" />
    <input type="hidden" value="<?php echo $_POST['scheduleId']; ?>" name="scheduleId_roundtrip" />
    <input type="hidden" value="<?php echo $_POST['travelDate']; ?>" name="travelDate_roundtrip" />
    <input type="hidden" value="<?php echo $_POST['fromStationId']; ?>" name="fromStationId_roundtrip" />
    <input type="hidden" value="<?php echo $_POST['toStationId']; ?>" name="toStationId_roundtrip" />
    <input type="hidden" value="<?php echo $pickup_Id; ?>" name="pickup_id" />
    <input type="hidden" value="" id="seatName" name="seatName_roundtrip"/>
    <input type="hidden" value="<?php echo $_SESSION['dt_gs'][$bording_points]; ?>" id="dt_gs" name="dt_gs_roundtrip" />
    <input type="hidden" value="<?php echo $_SESSION['at_gs'][$bording_points]; ?>" id="at_gs" name="at_gs_roundtrip" />
    <input type="hidden" value="<?php echo $_SESSION['th_gs'][$bording_points]; ?>" id="th_gs" name="th_gs_roundtrip" />
    
    
    <input type="hidden" value="" name="sellingPrice_roundtrip" id="sellprice" />
    <input type="hidden" value="<?php echo $_POST['net_fair']; ?>" name="net_price_roundtrip" id="netprice" />
    
    <input type="hidden" name="mode_roundtrip" value="ONE"/>
    <div style="clear:both; width:100%; height:5px;"></div>
    <table width="462" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0 auto; font-size: 11px;  font-weight: bold;line-height: 30px;    text-align: left;">
        <tr><td>BoardingPoint Name</td><td colspan="2" >
                <select onchange="boardingLocation(this)" name="BoardingPointName_roundtrip"  style="width:200px;">
                    <option value="">--- Boarding Points ---</option>
<?php
if(isset($result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup'][1]))
{
/*for ($k = ($total_bp - 1); $k >= 0; $k--) {
    if (floor($bp_time[$k] / 60) > 24) {
        $time = date("g:i A", strtotime((floor(($bp_time[$k] / 60) - 24) . ":" . $bp_time[$k] % 60)));
    } else {
        $time = date("g:i A", strtotime(floor($bp_time[$k] / 60) . ":" . $bp_time[$k] % 60));
    }
    ?>
                        <option value="<?php echo $bp_id[$k] . '-' . $bp_location[$k] . '-' . $time; ?>"><?php echo $bp_location[$k] . "-" . $time; ?></option>
<?php }*/
foreach($result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup'] as $pickup)
{ 
$time1=explode('T',$pickup['PickupTime']);
	$time=$time1[1];
?>

	
	<option value="<?php echo $pickup['PickupId'] . '-' . $pickup['PickupName'] . '-' . $time; ?>"><?php echo $pickup['PickupName'] . "-" . $time; ?></option>
<?php 
}
}

else
{
	$time1=explode('T',$result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupTime']);
	$time=$time1[1];
?>
<option value="<?php echo $result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupId'] . '-' . $result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupName'] . '-' . $time; ?>"><?php echo $result['GetRouteScheduleDetailsWithCommResult']['Pickup']['clsPickup']['PickupName'] . "-" . $time; ?></option> 
<?php
} ?>
                </select>
                <br />

            </td></tr>
        <tr><td>&nbsp;</td><td colspan="2"><input type="submit" class="btn2 btn_blue" name="round_submit1" value="Book Request"  onclick="return validate();"><input type="hidden" name="submit" value="bookrequest" /></td></tr>        


        <tr><td colspan="3"><div id="setBoardingPoint" style=" display:none; border:1px solid #ddd; text-align:center; margin:10px 0; background:#e3e3e3; padding:3px; font-size:10px; color:#000; border-radius:7px;"></div></td></tr>
    </table>
    <div style="clear:both; width:100%; height:5px;"></div>
</form>	<?php
				} 
				?>
                <script>
				$(document).ready(function(){ 
		   $(".closeIcon").click(function(){
				$('#seat').hide();
				$('#seat_block').hide();
				$("#seat").html("");
			});
	    });
		</script>