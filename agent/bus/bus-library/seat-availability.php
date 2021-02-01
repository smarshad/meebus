<?php
include '../../server/server.php'; 
include_once '../../agent/includes/functions.php';
$obj=new agent_module($con);  
ini_set('display_errors', 0);
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
//echo "<pre>";  print_r($_SESSION);  exit;  echo "<pre/>"; exit;
unset($_SESSION['agent']['bus']['seat']);
$_SESSION['agent']['bus']['netfare']=0;
$_SESSION['agent']['bus']['service_charge']=0;
$_SESSION['agent']['bus']['serviceChargeValues']=0;
$_SESSION['agent']['bus']['agent_markup']=0;
$_SESSION['agent']['bus']['commission']=0;
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
//$error_logs.= "Page : seat-availabilty.php<br/>POST Values : ".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];

//$system_data=''; 
//$system_data=array('Agent',$_SESSION['agent']['log']['id'],'bus search result pop up','Page Enter',$error_logs);
//$agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
//$update_agent_active = $obj->agent_active($agent_active_details);

//$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
//$update_error_logs=$obj->error_logs($error_logs_detail);

$bus_result=$_SESSION['agent']['bus']['bus_result'];
$i=0;
unset($_SESSION['agent']['bus']['resultbySchedule']);
unset($_SESSION['agent']['bus']['businfo']);
if(isset($bus_result[0]))
{
foreach($bus_result as $bus)
{	

	if($bus['id']==$scheduleId)
	{
		$bus_res=$bus_result[$i];
		$_SESSION['agent']['bus']['businfo']['bus_provider']=$bus_provider=$bus['travels'];
		$_SESSION['agent']['bus']['businfo']['busType']=$bus_type=$bus['busType'];
		$boarding=$bus['boardingTimes'];
		$_SESSION['agent']['bus']['businfo']['schedule_ID']=$scheduleId=$bus['id'];
		$travelDate=$_SESSION['agent']['bus']['travelDate'];
		$fromStationId=$_SESSION['agent']['bus']['origin_id'];
		$toStationId=$_SESSION['agent']['bus']['destination_id'];
		$tdate=convertdate($_SESSION['agent']['bus']['travelDate']);
		$_SESSION['agent']['bus']['resultbySchedule']=$bus_result[$i];
	}
	$i++;
}
}
else
{	
		$bus=$bus_result;
		if(isset($bus_result[$i]))
		$bus_res=$bus_result[$i];
		$_SESSION['agent']['bus']['businfo']['bus_provider']=$bus_provider=$bus['travels'];
		$_SESSION['agent']['bus']['businfo']['busType']=$bus_type=$bus['busType'];
		$boarding=$bus['boardingTimes'];
		$_SESSION['agent']['bus']['businfo']['schedule_ID']=$scheduleId=$bus['id'];
		$travelDate=$_SESSION['agent']['bus']['travelDate'];
		$fromStationId=$_SESSION['agent']['bus']['origin_id'];
		$toStationId=$_SESSION['agent']['bus']['destination_id'];
		$tdate=convertdate($_SESSION['agent']['bus']['travelDate']);
		$_SESSION['agent']['bus']['resultbySchedule']=$bus_result;
}
unset($_SESSION['agent']['bus']['boarding']);
if(isset($boarding[0]))
{
	
foreach($boarding as $board)
{
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['boarding_id']=$boarding_id=$board['bpId'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['time']=date("g:i A", strtotime(floor($board['time'] / 60) . ":" . $board['time'] % 60));
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['bpname']=$board['bpName'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['address']=$board['address'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['contact']=$board['contactNumber'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['landmark']=$board['landmark'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['location']=$board['location'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['prime']=$board['prime'];
}
}
else
{
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['boarding_id']=$boarding_id=$boarding['bpId'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['time']= date("g:i A", strtotime(floor($boarding['time'] / 60) . ":" . $boarding['time'] % 60));
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['bpname']=$boarding['bpName'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['address']=$boarding['address'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['contact']=$boarding['contactNumber'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['landmark']=$boarding['landmark'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['location']=$boarding['location'];
	$_SESSION['agent']['bus']['boarding'][$boarding_id]['prime']=$boarding['prime'];
}

include 'layout-SoapClient.php';

$result = objectToArray($results);
unset($seat_type_counter);
$_SESSION['agent']['bus']['seat_LYT']=$SeatLayoutSTR = $GetSeatLayoutResult = $result['seats'];
//echo '<pre>'; print_r($SeatLayoutSTR); echo '</pre>'; exit;

foreach ($SeatLayoutSTR as $val) {
    if ($val['zIndex'] == 0) {
        // Values for lower birth and sleeper and seater both
        $i = $val['row'];
        $j = $val['column'];
        $RowNo[$i] = $val['row'];
        $ColumnNo[$j] = $val['column'];
        $SeatName[$i][$j] = $val['name'];
        $SeatStatus[$i][$j] = $val['available'];
        $SeatFare[$i][$j] = $val['fare'];
        $st[$i][$j] = $val['zIndex'];
        $ladish[$i][$j] = $val['ladiesSeat'];
        $s_length[$i][$j] = $val['length'];
        $s_width[$i][$j] = $val['width'];
$li = max($RowNo);
$lj = max($ColumnNo);
    } else {
        // Values for upper lower birth 	
        $seat_type_counter = "sleeper";
        $i = $val['row'];
        $j = $val['column'];
        $RowNo1[$i] = $val['row'];
        $ColumnNo1[$j] = $val['column'];
        $SeatName1[$i][$j] = $val['name'];
        $SeatStatus1[$i][$j] = $val['available'];
        $SeatFare1[$i][$j] = $val['fare'];
        $ladish1[$i][$j] = $val['ladiesSeat'];
        $st1[$i][$j] = $val['zIndex'];
        $s_length1[$i][$j] = $val['length'];
        $s_width1[$i][$j] = $val['width'];
$li1 = max($RowNo1);
$lj1 = max($ColumnNo1);
    }
}
?>

<?php  include_once '../../agent/includes/head1.php'; ?>

<img src="../../images/close-x.png" alt="close" title="" style="z-index:100;right:0px;top:0px;width:25px;height:25px;position:absolute;cursor:pointer;" class="closeIcon" />
<div style="width:auto; padding:15px; margin:10px 0; box-shadow: 0 0 14px #CCCCCC;background:#fff; height:100%; border:1px #ddd solid; border-radius:6px;margin:auto;position:relative;">
    <div class="container-fluid">
    <div style="width:100%; height:auto !important; float:left; font-size:14px; color:#000; font-weight:bold;">
    <?php if(isset($otherdatas[5]))echo $otherdatas[5]; ?> &nbsp; &nbsp; Bus Name : <?php echo substr($otherdatas[0],0,50); ?> &nbsp; &nbsp; 
    Bus Type : <?php if(isset($otherdatas[1]))echo $otherdatas[1]; ?> &nbsp; &nbsp;<br/>Depart : <?php if(isset($otherdatas[2]))echo $otherdatas[2]; ?> &nbsp; &nbsp;  Arrival : <?php if(isset($otherdatas[3]))echo $otherdatas[3]; ?> &nbsp; &nbsp; Available Seat : <?php if(isset($otherdatas[4]))echo $otherdatas[4]; ?></div>
            <div class="row-fluid">                
            
                <div id="content">           
                    <!-- Seat Start -->
                    <form id="booking" name="booking" action="booking.php" method="post"> 	                    			
					<div class="span6">
                    <div class="span12">
                        <div class="row-fluid">	
                        <div class="block to">                           
							<table border="0" width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"> 
                            <tr>
                                <td>
                                    <table border="0" width="100%" height="40%" align="center" class="input" > 
        <?php
        if (isset($seat_type_counter)) {
            /*     * ************************************* Sleeper Lower Seats ******************************** */
            $flag = true;
            for ($i = 0; $i <= $li1; $i++) {
                                        echo '<tr>';
                                        for ($j = 0; $j <= $lj1; $j++) {
                                            //start displaying from here the steering part  
                                            if ($flag) {
                                                echo '<td width="30" height="30" rowspan=' . ($li1 + 1) . '><br><img  title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '" src="../../images/upper.jpg" width="30" height="65" /></td>';
                                                $flag = false;
                                            }

                                            echo '<td width="20" height="15" align="center">';

                                            /* Seating arrangement Start here */
                                            if (isset($st1[$i][$j]) && $st1[$i][$j] == 1) {
                                                if ($ladish1[$i][$j] == 'true') {
                                                    $ladis = "-ladies";
                                                } else {
                                                    $ladis = "";
                                                }
                                                // finding whether seat type is sleeper or seater 
                                                if (($s_length1[$i][$j] == 1 && $s_width1[$i][$j] == 2)) {
                                                    $seat_type = 'Sleeper_v';
                                                    $_val = '2';
                                                    $img = '<img src="../../images/' . $seat_type . $ladis . '.jpg" width="21" height="65" title="Seat number: ' . $SeatName1[$i][$j] . '  | ' . $SeatFare1[$i][$j] . ' " rel="' . $SeatName1[$i][$j] . '"/>';
                                                } else if (($s_length1[$i][$j] == 2 && $s_width1[$i][$j] == 1)) {
                                                    $seat_type = 'Sleeper';
                                                    $_val = '2';
                                                    $img = '<img src="../../images/' . $seat_type . $ladis . '.jpg" width="21" height="65" title="Seat number: ' . $SeatName1[$i][$j] . '  | ' . $SeatFare1[$i][$j] . ' " rel="' . $SeatName1[$i][$j] . '" />';
                                                } else {
                                                    $seat_type = 'Seat';
                                                    $_val = '';
                                                    $img = '<img src="../../images/' . $seat_type . $ladis . '.jpg" width="21" height="65" title="Seat number: ' . $SeatName1[$i][$j] . '  | ' . $SeatFare1[$i][$j] . ' " rel="' . $SeatName1[$i][$j] . '"/>';
                                                }


                                                // If seat is available then display the seat 
                                                if ($SeatStatus1[$i][$j] == "true") {
                                                    echo '<div class="avail"><img  src="../../images/' . $seat_type . $ladis . '.jpg"  title="Seat number: ' . $SeatName1[$i][$j] . ' | '.$SeatFare1[$i][$j] .'" rel="' . $SeatName1[$i][$j] . '" alt ="" ><img  src="../../images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                                                } else if ($SeatStatus1[$i][$j] == 0 && count($SeatName1[$i][$j]) != 0) {
                                                    echo '<img src="../../images/' . $seat_type . '-booked.jpg" title="Seat number: ' . $SeatName1[$i][$j] . '  | ' . $SeatFare1[$i][$j] . ' " rel="' . $SeatName1[$i][$j] . '">';
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
                                    for ($i = 0; $i <= $li; $i++) {
                echo '<tr>';
                for ($j = 0; $j <= $lj; $j++) {
                    /* Seating arrangement Start here */
                    if (isset($st[$i][$j]) && $st[$i][$j] == 0) {
                        if (isset($ladish[$i][$j]) && $ladish[$i][$j] == 'true') {
                            $ladis = "-ladies";
                        } else {
                            $ladis = "";
                        }
                        // finding whether seat type is sleeper or seater 
                        if ( isset($s_length[$i][$j]) && isset($s_width[$i][$j]) && ($s_length[$i][$j] == 1 && $s_width[$i][$j] == 2)) {
                            $seat_type = 'Sleeper_v';
                            $_val = '2';
                            $img = '<img src="../../images/lower.jpg" width="21" height="65" title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '"/>';
                        } else if (isset($s_length[$i][$j]) && isset($s_width[$i][$j]) && ($s_length[$i][$j] == 2 && $s_width[$i][$j] == 1)) {
                            $seat_type = 'Sleeper';
                            $_val = '2';
                            $img = '<img src="../../images/lower.jpg" width="21" height="65" title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '"/>';
                        } else {
                            $seat_type = 'Seat';
                            $_val = '';
                            $img = '<img src="../../images/lower.jpg" width="21" height="65" title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '"/>';
                        }
        
                        //start displaying from here the steering part  
                        if ($flag) {
                            echo '<td width="10" height="15"  rowspan=' . ($li + 1) . ' valign="top"><img src="../../images/steering.jpg"  /><br>' . $img . '</td>';
                            $flag = false;
                        }
        
                        echo '<td width="20" height="15" align="center">';
        
                        // If seat is available then display the seat 
                        if ($SeatStatus[$i][$j] == "true") {
                            echo '<div class="avail"><img  src="../../images/' . $seat_type . $ladis . '.jpg"  title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '" alt ="" ><img  src="../../images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                        } else if ($SeatStatus[$i][$j] == 0 && count($SeatName[$i][$j]) != 0) {
                            echo '<img src="../../images/' . $seat_type . '-booked.jpg" title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '">';
                        }
                        echo '</td>';
                    }
					else
					{
						 echo '<td width="20" height="15" align="center"></td>';
					}
                }
                echo '</tr>';
            }
                                    /*                                     * ********************************************End Sleeper Upper Seats *********************************************** */
                                } 
								
		else {
                                    $flag = true;
                                    for ($i = 0; $i <= $li; $i++) {
                                        echo '<tr>';
                                        for ($j = 0; $j <= $lj; $j++) {
                                            /* Seating arrangement Start here */
                                            if (isset($ladish[$i][$j]) && $ladish[$i][$j] == 'true') {
                                                $ladis = "-ladies";
                                            } else {
                                                $ladis = "";
                                            }
                                            // finding whether seat type is sleeper or seater 
                                            if (isset($s_length[$i][$j]) && isset($s_width[$i][$j]) && ($s_length[$i][$j] == 1 && $s_width[$i][$j] == 2) || ($s_length[$i][$j] == 2 && $s_width[$i][$j] == 1)) {
                                                $seat_type = 'Sleeper';
                                                $_val = '2';
                                                if ($st[$i][$j] == 0) // if it is 0 then it whould be lb
                                                    $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
                                                else if (isset($st[$i][$j]) && $st[$i][$j] == 1)
                                                    $img = '<img src="../../images/upper.jpg" width="21" height="65"/>';
                                                else
                                                    $img = '';
                                            }
                                            else {
                                                $seat_type = 'Seat';
                                                $_val = '';
                                            }
                                            //start displaying from here the steering part  
                                            if ($flag) {
												if(!isset($img))
												$img='';
                                                echo '<td width="30" height="30" rowspan=' . ($li + 1) . ' valign="top"><img src="../../images/steering.jpg"  title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '"/><br>' . $img . '</td>';
                                                $flag = false;
                                            }
                                            echo '<td width="30" height="30" align="center">';
                                            // If seat is available then display the seat 
                                            if ($SeatStatus[$i][$j] == "true") {
                                                echo '<div class="avail"><img  src="../../images/' . $seat_type .$ladis. '.jpg"  title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '" alt ="' . $SeatName[$i][$j] . '" ><img  src="../../images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  title="Seat number: ' . $SeatName[$i][$j] .' " rel="' . $SeatName[$i][$j] . '" alt="" class="selected"></div>';
											} else if ($SeatStatus[$i][$j] == 0 && count($SeatName[$i][$j]) != 0) {
                                                echo '<img src="../../images/' . $seat_type . '-booked.jpg" title="Seat number: ' . $SeatName[$i][$j]. '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '">';
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
                        </div>
						</div>
                    </div>
					<div class="span12">
                    <?php if ($seat_type == "Sleeper_v") {
                                    $seat_type = "Sleeper";
                                }
                                ?>
                    <div class="span3 fon">Available seat  <img src="../../images/<?php echo $seat_type . $_val; ?>.jpg" />
                                </div>
                    <div class="span3 fon">ladies seat <img  src="../../images/<?php echo $seat_type . $_val; ?>-ladies.jpg" /></div> 
                    <div class="span3 fon">Selected seat <img src="../../images/<?php echo $seat_type . $_val; ?>-availed.jpg" /></div> 
                    <div class="span3 fon">Booked seat
            <?php
              if ($seat_type == "Sleeper") {
                     echo '<img src="../../images/Sleeper-booked.jpg" alt="" title="Seat number: ' . $SeatName[$i][$j]. '  | ' . $SeatFare[$i][$j] . '  " rel="' . $SeatName[$i][$j] . '" />';
              } else {
                     echo '<img src="../../images/Seat-booked.jpg" alt="" title="Seat number: ' . $SeatName[$i][$j] . '  | ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '" />';

              }
              ?></div>  
                    </div>
                                   
                    <div class="span12">               
                            <div class="span6">
                           <div class="control-group bord">
                            <label for="focusedInput" class="control-label">Mobile Number</label>
                             <div class="controls">
                            <input type="text" maxlength="10"  placeholder="Mobile Number" id="mobile" name="mobile" class="input-large focused name mobile">
                               </div>                             
                              </div>
                              </div>
                               <div class="span6">
                               <div class="control-group bord">
                            <label for="focusedInput" class="control-label">E-Mail ID</label>
                             <div class="controls">
                            <input type="text" placeholder="Email ID" name="email" id="email" class="input-large focused name email">
                               </div>                            
                              </div>
                              </div>                              
                           </div>
					<div class="span12">
                     <div class="span6">
                     <div class="control-group bord">                                          
                                          <div class="controls">
                                          <?php // print_r($_SESSION['agent']['bus']['boarding']); ?>
                                            <select id="boarding" name="boarding">
                                              <option value="">-- Boarding Point --</option>
                                              
                                              <?php foreach($_SESSION['agent']['bus']['boarding'] as $b){ echo '<option value="'.$b['boarding_id'].'">'.$b['bpname'].' - '.$b['time'].'</option>'; }?>
                                            </select>                                            
                                          </div>
                                      </div>
                      </div>
                     <div class="span6">
					   <div class="control-group bord">                                          
                                          <div class="controls">
                                          <img src="<?php echo $base_url; ?>../images/location.png" alt="map"/>
                                            <span class="bpaddress"></span>
                                          </div>
                                      </div>
                      </div>
                    </div>                           
                      
                    </div>
						<!-- Seat End -->
						<!-- Details -->
                    <div class="span6">
                    <div class="block to clearfix">
                    
                    <div class="span12">	
                                  
                    <div class="span4 text-center">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="focusedInput">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="span2 text-center">
                        <div class="control-group">
                            <div class="controls">
                            <label class="control-label" for="focusedInput">Age</label>
                            </div>
                        </div>
                    </div>
                    <div class="span3 text-center">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="focusedInput">Gender</label>
                            </div>
                        </div>
                    </div>
                    <div class="span1 text-center">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label seat-no text-center" for="focusedInput">Seat</label>
                            </div>
                        </div>
                    </div>
                    <div class="span2 text-center">
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label fare" for="focusedInput">Fare</label>
                            </div>
                        </div>
                    </div>
                </div>                  
                    <div class="span12">
                       <div class="row-fluid" id="pass_detail">	
                            
                        </div>
                        <?php if(isset($_SESSION['FILL']['PASSENGER']) && $_SESSION['FILL']['PASSENGER']!='') { ?>
                         <div class="span12 text-left">&nbsp; &raquo; <a href="javascript:void(0);" onclick="return FillPassengerDetails();" style="color:#009; text-decoration:none; font-size:12px; font-weight:bold;">Fill Last Passenger Details</a></div>
                         <?php } ?>
                    </div> 
                      </div>                     
                    </div>
                    </form>
                </div>
             </div>


             </div>
        </div>       



                               
      


<script type="text/javascript">

function FillPassengerDetails()
{
	var getDat;
	var getPassNam;
	var getPassAge;
	var getPassGen;
	var i; 
	
	$.post( "FillPassengerDetails.php", function(data) {
  	getDat = data.split('^');
	var i1=0
	for(i=1; i<=getDat[0]; i++)
		{
			getPassNam = getDat[1].split(',');
			getPassAge = getDat[2].split(',');
			getPassGen = getDat[3].split(',');
			$('#passenger_name_'+i).val(getPassNam[i1]);
			$('#passenger_age_'+i).val(getPassAge[i1]);
			$("#passenger_gender_"+i).val(getPassGen[i1]).change();
			i1++;	
		} 
		$('#mobile').val(getDat[4]);
		$('#email').val(getDat[5]);
});	
return true;
}


$(function(){

  $('.mobile').keypress(function(e) {
	if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
	e.preventDefault();
  });

});

		var seatCount=0;
		var validation=0;
	   $(document).ready(function(){ 
		   $(".closeIcon").click(function(){
				$('#seat').hide();
				$('#seat_block').hide();
				$("#seat").html("");
			});
	    });
	   
	   $('.avail').click(function() { 
				 var seat = $(this).find('img').attr('rel');
				 var selected = $(this).find('img').attr('alt');
				 var img=$(this).find('img');
				  $.ajax({
					  type:"post",
					  url:"../../bus/bus-library/seat-fare.php",
					  data:"id="+seat,
					  success:function(data){
						 var seat=data.split("^");
						 if(seat[4]==0)
						 {
							 alert("Only up to 6 tickets can be booked at a time!!");
						 }
						 else
						 {
						 	if(seat[4]==1)
						 	{ 
						 		img.toggle();
						 		seatCount=seat[3];
						 		$("#pass_detail").html(seat[2]);
							}
							if(seat[4]==2)
							$("#pass_detail").html(seat[2]);
						 }
					  }
				 });
		 });
		
		$("#boarding").change(function() {
		  var bpoint=$(this).val();
		  $.post( "getBplandmark.php?id="+bpoint, function( data ) {
			  $( ".bpaddress" ).html( data );
			});
		});
		
		$("#booking").submit(function() {
			validation=0;
			if(seatCount==0)
			{
				alert("Please select atleast one seat");
			}
			else
			{
				validation++;
			}
			var passenger_name= document.getElementsByName("passenger_name[]");
			for ( var i = 0; i < passenger_name.length; i++ )
			{
				if (passenger_name[i].value=="" )
				{
				alert("Please enter the passenger name");
				return false;
				}
				else
				{
					if((passenger_name.length-1)==i)
					validation++;
				}
			}
			var age= document.getElementsByName("age[]");
			var numbers = /^[0-9]+$/; 
			for ( var i = 0; i < age.length; i++ )
			{ 
				if (age[i].value=="")
				{
					alert("Please enter the age");
					return false;
				}
				if(!age[i].value.match(numbers))
				{
					alert("Please enter the numeric values in age");
					return false;
				} 
				else
				{
					validation++;
				} 
			}
			var gender= document.getElementsByName("gender[]");

			for ( var i = 0; i < gender.length; i++ )
			{
				if (gender[i].value=="")
				{
					alert("Please select gender");
					return false;
				}
				else
				{
					validation++;
				}  
			}
			var mobile= $('#mobile').val();
			if ((!mobile) || (mobile.length !=10) || (/[^0-9]/.test(mobile)))                     
			{
				alert("Please enter mobile number");
				return false;
			}
			else
			{
				validation++;
			}
			var email= $('#email').val();
			var reg_user1 = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			if (email=="" || reg_user1.test(email)==false)
			{
				alert("Invalid email address");
				return false;
			}
			else
			{
				validation++;
			}
			var boarding = $('#boarding').val();
			if (boarding == "" || !boarding)
			{
				alert("Please select boarding point");
				return false;
			}
			else
			{
				validation++;
			}
			return true;			
			event.preventDefault();
		
		//}
		});

</script>