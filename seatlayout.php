<?php
include_once "server/server.php";

GLOBAL $con;

include "includes/User.php";

$obj = new User($con);
include "bus_library/APICaller.php";
$trips=$_SESSION['user']['apiAvailableBuses'];

$routeScheduleId=$_POST['rid'];
$source 		=$_POST['sourceid'];
$destination	=$_POST['destination'];
$inventoryType	=$_POST['inventoryType'];
$doj			= $_POST['jdate'];
$selected_seats = $_POST['selected_seats'] ?? '';
$selected_sests_ary = explode('^',$selected_seats);


if(isset($_SESSION['user']['selectedSeat']))
unset($_SESSION['user']['selectedSeat']);
if(isset($_SESSION['user']['totalFareWithTaxes']))
unset($_SESSION['user']['totalFareWithTaxes']);
if(isset($_SESSION['user']['seatFare']))
unset($_SESSION['user']['seatFare']);
$_SESSION['user']['totalFare']=0;
 foreach($trips as $bus)
{
	if($bus['routeScheduleId']==$routeScheduleId)
	$_SESSION['user']['selectedBus']=$selectedBus=$bus;
}

$seatArray=getBusLayout($source, $destination, $doj, $inventoryType, $routeScheduleId);
$sessionId=$_SESSION['user']['sessId'];
$jsonSeat=json_encode($seatArray);
$jsonSeat = substr($jsonSeat, 0, 10000);
$obj->updateseatListBus(array($jsonSeat,$sessionId));
$_SESSION['user']['SeatLayout']=$SeatLayoutSTR=$seatArray['seats'];
				if($inventoryType==0 || $inventoryType==1)
					{
						$boarding_point=$selectedBus['boardingPoints'];
					}
					else{
						$boarding_point=$seatArray['boardingPoints'];
					}
				if($inventoryType==0 || $inventoryType==1)
					{
						$dropping_point=$selectedBus['droppingPoints'];
					}
					else{
						$dropping_point=$seatArray['droppingPoints'];
					}

$seatCount=0;
foreach ($SeatLayoutSTR as $val) {
	 //echo "<pre>";
	 //print_r($val);
	 //echo "</pre>";
    if ($val['zIndex'] == 0) {
        // Values for lower birth and sleeper and seater both
		if($val['ac'] == 1){
			$ac[$i][$j]= 'true';
		}else{
			$ac[$i][$j]= 'false';

		}
		if($val['sleeper'] == 1){
			$sleeper[$i][$j] = 'true';
		}else{
			$sleeper[$i][$j] = 'false';

		}
		//$ac[$i][$j] = $val['ac'];
		//$sleeper[$i][$j] = $val['sleeper'];
        $i = $val['row'];
        $j = $val['column'];
        $RowNo[$i] = $val['row'];
        $ColumnNo[$j] = $val['column'];
        $SeatName[$i][$j] = $val['id'];
        $SeatStatus[$i][$j] = $val['available'];
        $serviceTaxAmount[$i][$j] = $val['serviceTaxAmount'];
		$operatorServiceChargeAbsolute[$i][$j] = $val['operatorServiceChargeAbsolute'];
		

		if($val['available']==1)
		{
			$seatCount++;
		}
        $SeatFare[$i][$j] = $val['fare'];
        $st[$i][$j] = $val['zIndex'];
        $ladish[$i][$j] = $val['ladiesSeat'];
        $s_length[$i][$j] = $val['length'];
        $s_width[$i][$j] = $val['width'];
$lii = min($RowNo);
$li = max($RowNo);
$ljj=min($ColumnNo);
$lj = max($ColumnNo);
    } else {
        // Values for upper lower birth 	
        $seat_type_counter = "sleeper";
        $i = $val['row'];
        $j = $val['column'];
        $RowNo1[$i] = $val['row'];
        $ColumnNo1[$j] = $val['column'];
        $SeatName1[$i][$j] = $val['id'];
        $SeatStatus1[$i][$j] = $val['available'];
		$serviceTaxAmount1[$i][$j] = $val['serviceTaxAmount'];
		$operatorServiceChargeAbsolute[$i][$j] = $val['operatorServiceChargeAbsolute'];
		$ac[$i][$j] = $val['ac'];
		$sleeper[$i][$j] = $val['sleeper'];
		if($val['available']==1)
		{
			$seatCount++;
		}
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
<div class="clearfix" id="seatSelect1">
					<div class="left">
						
					<p>Click on seat to select/deselect seat</p>
					<div class="borderdtd">
							
                              
        <?php
		 //echo ' <p class="lower-new"><span class="txt-l">Upper Deck</span></p>';
        if (isset($seat_type_counter)) {
			?>
			<div class="deck_class"> Lower Deck</div>				
						   <div class="seatWrap">
							<p class="front">
							<img src="images/staring.png" />
								<?php /*?><span class="frontView_top"></span> 
								<span class="frontView_bottom"></span><?php */?>
							</p>
								
								<div class="seats">
			<?php
            /*     * ************************************* Sleeper Lower Seats ******************************** */
			                         $flag = true;
									//echo $li;
									$bcount=1;
                                    for ($i = 0; $i <= $li; $i++) {
                echo '<ul>';
				//echo $lj;
                for ($j = 0; $j <= $lj; $j++) {
					if(isset($st[$i]))
					$scount= count($st[$i]);
					else
					$scount=0;
					if($scount==0 && $bcount!=1 && $bcount!=0)
											{
												$bcount=0;
												?>
												<li class="walkway"></li></ul>
												<?php
											}
											if($scount!=0)
											$bcount++;
					                   /* Seating arrangement Start here */
                    if (isset($st[$i][$j]) && $st[$i][$j] == 0) {
                        if (isset($ladish[$i][$j]) && $ladish[$i][$j] == 'true') {
                            $ladis = "-ladies";
                        } else {
                            $ladis = "";
                        }
						if($scount==0)
						{
							?>
                            <li class="walkway"><a class="tooltip tooltipstered"></a></li>
                            <?php
						}
                        // finding whether seat type is sleeper or seater 
                        if ( isset($s_length[$i][$j]) && isset($s_width[$i][$j]) && ($s_length[$i][$j] == 1 && $s_width[$i][$j] == 2)) {
                            $seat_type = 'sleeper-v';
                            $_val = '2';
                            $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
                        } else if (isset($s_length[$i][$j]) && isset($s_width[$i][$j]) && ($s_length[$i][$j] == 2 && $s_width[$i][$j] == 1)) {
                            $seat_type = 'Sleeper';
                            $_val = '2';
                            $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
                        } else {
                            $seat_type = 'Seat';
                            $_val = '';
                            $img = '<img src="../../images/lower.jpg" width="21" height="65" />';
                        }
        
                        //start displaying from here the steering part  
                        
        
                        // If seat is available then display the seat 
                        if ($SeatStatus[$i][$j] == "true") {
							?>
                            <li class="<?php echo $seat_type.' '.$ladis; ?> available" id="<?php echo $SeatName[$i][$j].'_'.$routeScheduleId; ?>" data-seat="<?= $SeatName[$i][$j];?>" style=" <?php if($scount==1) echo 'float:right'; ?>" data-Seatprice="<?= $SeatFare[$i][$j];?>">
							<input type="hidden" value="<?= $seat_type;?>" id="check_seat_type_<?= $SeatName[$i][$j];?>">
							<input type="hidden" value="<?= $serviceTaxAmount[$i][$j];?>" id="serviceTaxAmount<?= $SeatName[$i][$j];?>">
							<input type="hidden" value="<?= $operatorServiceChargeAbsolute[$i][$j];?>" id="operatorServiceChargeAbsolute<?= $SeatName[$i][$j];?>">
							<input type="hidden" value="<?= $ac[$i][$j];?>" id="ac<?= $SeatName[$i][$j];?>">
							<input type="hidden" value="<?= $sleeper[$i][$j];?>" id="sleeper<?= $SeatName[$i][$j];?>">

                            <a class="">
                             <?php   echo '<img  src="images/' . $seat_type . $_val . $ladis . '.jpg"  title="Seat number: ' . $SeatName[$i][$j] . '  |  Fare: INR ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '" alt ="" id="available_seat_'.$SeatName[$i][$j].'" >
							 <img  src="images/' . $seat_type . '-availed.jpg" style="display:none" rel="' . $SeatName[$i][$j] . '"  alt="" id="availed_seat_'.$SeatName[$i][$j].'">'; ?>
							 <p class="available-seat-number" id="available_seat_no_<?= $SeatName[$i][$j];?>" style="display:none;"><?= $SeatName[$i][$j];?></p>
                            </a></li>
                            <?php 
                        } else if ($SeatStatus[$i][$j] == 0 && count($SeatName[$i][$j]) != 0) {
                            ?>
                            <li class="<?php echo $seat_type.' '.$ladis; ?> unavailable" style=" <?php if($scount==1) echo 'float:right'; ?>" ><a href="javascript:void(0);" data="<?php echo $SeatStatus[$i][$j].'d1'.$SeatName[$i][$j]; ?>"> 
                             							
							<?php
							if (in_array($SeatName[$i][$j], $selected_sests_ary))
							{
								 echo '<img src="images/' . $seat_type . $_val . $ladis .  '-cusselected.jpg" title="Seat number: ' . $SeatName[$i][$j].'">'; 
							}else{
							     echo '<img src="images/' . $seat_type . $_val . $ladis .  '-booked.jpg" title="Seat number: ' . $SeatName[$i][$j].'">'; 
								 
							}?>
							</a></li>
							

							<?php
                        }
						
                       // echo '</td>';
                    }
                }
                echo '</ul>';
            }
			?>
			 </div>
            </div>
			<div class="deck_class"> Upper Deck</div>
			<div class="seatWrap">
							<p class="front">
							</p>		
								<div class="seats">
                                <p class="lower-new"><span class="txt-l"></span></p>
			<?php
									
                                    /********************************************** Sleeper Upper Seats *********************************************** */
									            $flag = true;
			$bcount=1;
            for ($i = 0; $i <= $li1; $i++) {
                                        echo '<ul>';
										//echo $lj1;
                                        for ($j = 0; $j <= $lj1; $j++) {
											if(isset($st[$i]))
											$scount= count($st[$i]);
											else
											$scount=0;
											if($scount==0 && $bcount!=1 && $bcount!=0)
											{
												$bcount=0;
												?>
												<li class="walkway"></li></ul>
												<?php
											}
											if($scount!=0)
											$bcount++;
                                            //start displaying from here the steering part  
                                            if ($flag) {
                                                $flag = false;
											}
                                            /* Seating arrangement Start here */
                                            if (isset($st1[$i][$j]) && $st1[$i][$j] == 1) {
                                                if ($ladish1[$i][$j] == 'true') {
                                                    $ladis = "-ladies";
                                                } else {
                                                    $ladis = "";
                                                }
												if ($SeatStatus1[$i][$j] == "true") {
												$seatstatus='available';
												}
												else
												$seatstatus='unavailable';
                                                // finding whether seat type is sleeper or seater 
                                                if (($s_length1[$i][$j] == 1 && $s_width1[$i][$j] == 2)) {
                                                    $seat_type = 'Sleeper-v';
                                                    $_val = '2';
                                                   	$img = '<img src="images/' . $seat_type . $ladis . '.jpg" width="21" height="65" />';
                                                } else if (($s_length1[$i][$j] == 2 && $s_width1[$i][$j] == 1)) {
                                                    $seat_type = 'Sleeper';
                                                    $_val = '2';
                                                  $img = '<img src="images/' . $seat_type . $ladis . '.jpg" width="21" height="65" />';
                                                } else {
                                                    $seat_type = 'Seat';
                                                    $_val = '';
                                                    $img = '<img src="images/' . $seat_type . $ladis . '.jpg" width="21" height="65" />';
                                                }


                                                // If seat is available then display the seat 
                                                if ($SeatStatus1[$i][$j] == "true") {
                                                   ?>
                                                   <li class="<?php echo $seat_type.' '.$ladis; ?> available"  id="<?php echo $SeatName1[$i][$j].'_'.$routeScheduleId; ?>" style=" <?php if($scount==1) echo 'float:right'; ?>" data-seat="<?= $SeatName1[$i][$j];?>" data-Seatprice="<?= $SeatFare1[$i][$j];?>">
												   <input type="hidden" value="<?= $seat_type;?>" id="check_seat_type_<?= $SeatName1[$i][$j];?>">
												   <input type="hidden" value="<?= $serviceTaxAmount[$i][$j];?>" id="serviceTaxAmount<?= $SeatName1[$i][$j];?>">
                                                   <input type="hidden" value="<?= $operatorServiceChargeAbsolute[$i][$j];?>" id="operatorServiceChargeAbsolute<?= $SeatName1[$i][$j];?>">
												   <input type="hidden" value="<?= $ac[$i][$j];?>" id="ac<?= $SeatName1[$i][$j];?>">
												   <input type="hidden" value="<?= $sleeper[$i][$j];?>" id="sleeper<?= $SeatName1[$i][$j];?>">
												   <a class="">
                                                    <?php echo '<img  src="images/' . $seat_type . $_val . $ladis . '.jpg"  title="Seat number: ' . $SeatName1[$i][$j] . '  |  Fare: INR ' . $SeatFare1[$i][$j] . '" rel="' . $SeatName1[$i][$j] . '" alt =" " id="available_seat_'.$SeatName1[$i][$j].'" >
													<img  src="images/' . $seat_type . '-availed.jpg" style="display:none" rel="' . $SeatName1[$i][$j] . '"  alt="" id="availed_seat_'.$SeatName1[$i][$j].'">'; ?>
                                                    <p class="available-seat-number" id="available_seat_no_<?= $SeatName1[$i][$j];?>" style="display:none;"><?= $SeatName1[$i][$j];?></p>
												   </a>
												  
												   </li>
                                                   <?php
                                                } else if ($SeatStatus1[$i][$j] == 0 && count($SeatName1[$i][$j]) != 0) {
                                                     ?>
                                                     <li class="<?php echo $seat_type.' '.$ladis; ?> unavailable" style=" <?php if($scount==1) echo 'float:right'; ?>"><a href="javascript:void(0);" data="<?php echo $SeatStatus[$i][$j].'d2'.$SeatName[$i][$j]; ?>">
                                                    
													<?php
							if (in_array($SeatName1[$i][$j], $selected_sests_ary))
							{
								 echo '<img src="images/' . $seat_type . $_val . $ladis .  '-availed.jpg" title="Seat number: ' . $SeatName1[$i][$j].'">'; 
							}else{
							     echo '<img src="images/' . $seat_type . $_val . $ladis .  '-booked.jpg" title="Seat number: ' . $SeatName1[$i][$j].'">'; 
								 
							}?>
                                                     </a></li>
                                                <?php
                                                }
												 
                                            }
                                        }
                                        echo '</ul>';
                                    }
				?>		
           
         
            
            <?php
                                   
                                } else { ?>			
						   <div class="seatWrap">
							<p class="front">
							<img src="images/staring.png" />
								<?php /*?><span class="frontView_top"></span> 
								<span class="frontView_bottom"></span><?php */?>
							</p>
								
								<div class="seats">
								<?php 
									$bcount=1;
                                    $flag = true;
                                    for ($i = 0; $i <= $li; $i++) {
                                        echo '<ul>';
										
                                        for ($j = 0; $j <= $lj; $j++) {
											$scount= count($st[$i]);
											if($scount==0 && $bcount!=1 && $bcount!=0)
											{
												$bcount=0;
												?>
												<li class="walkway"></li></ul>
												<?php
											}
											if($scount!=0)
											$bcount++;
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
                                                if (isset($st[$i][$j]) && $st[$i][$j] == 0) // if it is 0 then it whould be lb
                                                    $img = '<li class=" '.$seat_type.' '.$ladis.' '.$seatstatus.'">';
                                                else if (isset($st[$i][$j]) && $st[$i][$j] == 1)
                                                    $img = '<li class=" '.$seat_type.' '.$ladis.' '.$seatstatus.'">';
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
                                                $flag = false;
                                            }
                                            //echo '<td width="30" height="30" align="center">';
                                            // If seat is available then display the seat 
                                            if ($SeatStatus[$i][$j] == "true") {												
                                                ?>
                                                <li class="<?php echo $seat_type.' '.$ladis; ?> available" id="<?php echo $SeatName[$i][$j].'_'.$routeScheduleId; ?>" <?php if($scount==1) echo 'style="float:right"'; ?> data-seat="<?= $SeatName[$i][$j];?>" data-Seatprice="<?= $SeatFare[$i][$j];?>">
												<input type="hidden" value="<?= $seat_type;?>" id="check_seat_type_<?= $SeatName[$i][$j];?>">
												<input type="hidden" value="<?= $serviceTaxAmount[$i][$j];?>" id="serviceTaxAmount<?= $SeatName[$i][$j];?>">
                                                <input type="hidden" value="<?= $operatorServiceChargeAbsolute[$i][$j];?>" id="operatorServiceChargeAbsolute<?= $SeatName[$i][$j];?>">
												<input type="hidden" value="<?= $ac[$i][$j];?>" id="ac<?= $SeatName[$i][$j];?>">
												<input type="hidden" value="<?= $sleeper[$i][$j];?>" id="sleeper<?= $SeatName[$i][$j];?>">
												<a class="">
                                                 <?php echo '<img  src="images/' . $seat_type . $_val . $ladis . '.jpg"  title="Seat number: ' . $SeatName[$i][$j] . '  |  Fare: INR ' . $SeatFare[$i][$j] . ' " rel="' . $SeatName[$i][$j] . '" alt =" " id="available_seat_'.$SeatName[$i][$j].'">
												 <img  src="images/' . $seat_type . '-availed.jpg" style="display:none" rel="' . $SeatName[$i][$j] . '"  alt="" id="availed_seat_'.$SeatName[$i][$j].'">';?>
                                                <p class="available-seat-number" id="available_seat_no_<?= $SeatName[$i][$j];?>" style="display:none;"><?= $SeatName[$i][$j];?></p>
												</a>
												
												</li>
                                                <?php
											} else if ($SeatStatus[$i][$j] == 0 && count($SeatName[$i][$j]) != 0) {
                                              ?>
											  <li class="<?php echo $seat_type.' '.$ladis; ?> unavailable " style=" <?php if($scount==1) echo 'float:right'; ?>">
                                              <a href="javascript:void(0);" data="<?php echo $SeatStatus[$i][$j].'d3'.$SeatName[$i][$j].'='.$selected_seats; ?>">
                                               
											   <?php
							if (in_array($SeatName[$i][$j], $selected_sests_ary)){
								 echo '<img src="images/' . $seat_type . $_val . $ladis .  '-cusselected.jpg" title="Seat number: ' . $SeatName[$i][$j].'">'; 
							}else{
							     echo '<img src="images/' . $seat_type . $_val . $ladis .  '-booked.jpg" title="Seat number: ' . $SeatName[$i][$j].'">'; 
								 
							}?>
                                              </a></li>
											  <?php
                                            }
											/*else
											{
												echo '<li class="noseat"><a href="javascript:void(0);"></a></li>';	
											}*/
                                            //echo '</td>';
                                        }
                                        echo '</ul>';
                                    }
                                }
                                /* Seating arrangement Start here */
                                ?>
									  						  
						</div>
						</div>
					
								</div>
			
	 		  
		
		
	  </div>						
  <div class="right seatpadd rightLegend">
  <h3>SEAT LEGEND</h3>
    			<div class="legend type1">
					<?php     
					if ($seat_type == "Sleeper-v" || $seat_type == "Sleeper")  
						{                  
					$seat_type = "Sleeper";    
					}					
					else if($seat_type == "Seat")		
						{			
					$seat_type = "Seat";
					}		
					?>
					
			<ul class="clearfix">
			<li><img src="images/<?php echo $seat_type . $_val; ?>.jpg" /></li>
			<li>Available  </li>
			
			<li>
			<?php      
			if ($seat_type == "Sleeper")  
				{       
			echo '<img src="images/Sleeper-booked.jpg" alt="" title="" />';  
			}		
			else if ($seat_type == "Seat" && $seat_type == "Sleeper")	
				{					
			echo '<img src="images/Sleeper-booked.jpg" alt="" title="" />';	
			echo '<img src="images/Seat-booked.jpg" alt="" title="" />';	
			}                 
			else               
				{            
			echo '<img src="images/Seat-booked.jpg" alt="" title="" />';
			}           
			?>
			</li>
			<li>Booked</li>
			<li><img  src="images/<?php echo $seat_type . $_val; ?>-ladies.jpg" /></li>
			<li>For Ladies</li>
			</ul>
		</div>
  </div>
    <div class="right seatpadd other-container" id="boarding-dropping-points" style="display:none;">
	<div class="bp-dp-tabs-container check-active bp_dp_active" id="boarding-dropping-points-id">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">BOARDING POINT</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">DROPPING POINT</a>
  </li>
  
</ul>
<div class="tab-content bd_db_point" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <ul class="boarding-point">
  <?php 
  if(!empty($boarding_point))
  {
	  		 
	  foreach($boarding_point as $b)
	  {
		  $bp = explode(',',$b['location']);
   if(isset($bp[1]) && $bp[1]!='')
    { 
  $bp1 = $bp[0].', '.$bp[1]; 
  }
  else 
  {
$bp1 = $bp[0]; 
  }		  

  ?>
  <li class="db oh">
  <div class="select-radio">
  <input type="radio" name="bp_point" class="boarding-radio" id="bp_<?= $b['id'];?>" value="<?= $b['time'].'@@'.$bp1;?>" data-action="boarding">
  </div>
  <div class="select-time">
  <span class="time"><?= $b['time'];?></span>
  </div>
  <div class="select-address">
  <span class="address"><?= $bp1;?></span>
  </div>
  </li>
  <?php } }else{ ?>
  <li class="db oh"> 
  <div class="select-radio">
  <input type="radio" name="bp_point" class="dropping-radio" id="bp_0" value=" " data-action="boarding" checked>
  </div>
  <div class="select-time">
  <span class="time"></span>
  </div>
   <div class="select-address">
  <span class="address">NO BOARDING POINT</span>
  </div>
  </li>
  <?php } ?>
  </ul>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <ul class="boarding-point">
  <?php
  if(!empty($dropping_point))
  {
	  
	  foreach($dropping_point as $d)
	  {
		   $dp = explode(',',$d['location']);
   if(isset($dp[1]) && $dp[1]!='')
    { 
  $dp1 = $dp[0].', '.$dp[1]; 
  }
  else 
  {
$dp1 = $dp[0]; 
  }		  
  ?>
   <li class="db oh">
   <div class="select-radio">
  <input type="radio" name="dp_point" class="dropping-radio" id="dp_<?= $d['id'];?>" value="<?= $d['time'].'@@'. $dp1;?>" data-action="dropping">
  </div>
   <div class="select-time">
  <span class="time"><?= $d['time'];?></span>
  </div>
   <div class="select-address">
  <span class="address"><?= $dp1;?></span>
  </div>
  </li>
  <?php } }else{ ?>
  <li class="db oh"> 
  <div class="select-radio">
  <input type="radio" name="dp_point" class="dropping-radio" id="dp_0" value=" " data-action="dropping" checked>
  </div>
  <div class="select-time">
  <span class="time"></span>
  </div>
   <div class="select-address">
  <span class="address">NO DROPPING POINT</span>
  </div>
  </li>
  <?php } ?>
  </ul>
  </div>
</div>
<div class="bp_dp_amount">
<span class="bpdp-lb">Amount<p>( Taxes will be calculated during payment )</p></span>
<span class="fr bpdp-change seat_fairss"></span>

</div>
<div class="bp_dp_button user-bp-dp-button1"  style="display:none">
<button type="button" id="user-bp-dp-button">Continue</button>
</div>
	</div>
	<div class="check-active" id="user-trip-summery" style="display:none">
		<div class="bp-dp-container ">
	<div class="bpDpAddr Bd_Dp_Point">
	<span class="bpdp-lb">Boarding &amp; Dropping</span>
	<span class="fr bpdp-change">change</span>
	</div>
	<div class="bpDpAddr ">
	<div class="pR oh">
	<span class="bpdp-lb boarding_addresss"></span>
	<span class="fr bpdp-change boarding_timeee"></span>
	</div>
	<div class="pR oh">
	<span class="bpdp-lb dropping_addresss"></span>
	<span class="fr bpdp-change dropping_timeee"></span>
	</div>
	</div>
	<div class="seats-selected-container meebus-selected-seats">
	<span class="seat-lb">Seat No.</span>
	<span class="selected-seats fr"><span id="seat_nos">3</span></span>
	</div>
	</div>
	<div class="bp_dp_amount">
<span class="bpdp-lb">Amount<p>( Taxes will be calculated during payment )</p></span>
<span class="fr bpdp-change seat_fairss"></span>

</div>
<div class="bp_dp_button">
<button type="button" id="proceed-to-book">Proceed To Book</button>
</div>
</div>
	</div>
	
	<div class="show-more-bus" id="more-bus-<?php echo $routeScheduleId; ?>" style="display:none">
	<button type="button" Class="Show-more-bus-button">More Buses</button>
	</div>
	

<script>
 

	function closethisDiv(thisdiv){
		$(thisdiv).closest('.seatdivrtc').hide();
		$(thisdiv).closest('.seatdiv').hide();
	return false;
}
var seat_cnt<?php echo $routeScheduleId; ?>=0;
var totalseat_price=0;
var totalseat_pricetax=0;
$(document).ready(function(e) {
	var selectedSeats = [];
	var selectedSeatsPrice = [];
	var serviceTaxAmount = [];
	var operatorServiceChargeAbsolute = [];
	var ac = [];
	var sleeper = [];
	var tostr = '';
	
    $('li.available').click(function() {
		$('.bus-items').addClass('hide-bus-item');
		var det=$(this).attr("id");
		var seat_no=$(this).attr("data-seat");
		var seat_price=parseInt($(this).attr("data-Seatprice"));
		var seat_pricetax=parseInt($('#serviceTaxAmount'+seat_no).val());
		var seat_priceoperatorServiceChargeAbsolute =parseInt($('#operatorServiceChargeAbsolute'+seat_no).val());
		var ac_det =$('#ac'+seat_no).val();
		var sleeper_det =$('#sleeper'+seat_no).val();
		
		console.log(seat_price);
		var ask=det.split("_"); 
		var seat=ask[0];
		
		var rid=ask[1];
			if($(this).hasClass('available'))
			{
				$('#more-bus-<?= $routeScheduleId;?>').show();
				 $('.bus-items>li:not(.active)').hide();
				 $('.rightLegend').hide();
				 $('#boarding-dropping-points').show();
				$('.check-active').not('bp_dp_active').hide();
				
				if($('.check-active').hasClass('bp_dp_active'))
				{
					$(this).show();
				}
				
				 var seat_type=$('#check_seat_type_'+seat_no).val();
					if(seat_type==='Sleeper' || seat_type==='Sleeper-v')
					{
	
				 $('#available_seat_no_'+seat_no).addClass('p2_active');
					}
					else{

					$('#available_seat_no_'+seat_no).addClass('p_active');
						}
				if(selectedSeats.length < 6)
				{
					if(jQuery.inArray(seat_no, selectedSeats) === -1)
		{
					 selectedSeats.push(seat_no);
					 selectedSeatsPrice.push(seat_no+':'+seat_price);
					 serviceTaxAmount.push(seat_no+':'+seat_pricetax);
					 operatorServiceChargeAbsolute.push(seat_no+':'+seat_priceoperatorServiceChargeAbsolute);
					 ac.push(seat_no+':'+ac_det);
					 sleeper.push(seat_no+':'+sleeper_det);

		}
				
				
				$(this).addClass('selected').removeClass('available');
				totalseat_price= seat_price+parseInt(totalseat_price);
				totalseat_pricetax= seat_pricetax+parseInt(totalseat_pricetax);
					
					
					 $('#seat_nos').text(selectedSeats.join(", "));
					 $('.seat_fairss').text('INR '+totalseat_price);

					
				 $('#available_seat_'+seat_no).hide();
				 $('#availed_seat_'+seat_no).show();
				seat_cnt<?php echo $routeScheduleId; ?>++;
				}
				else
				{
					alert("Please select maximum of " + selectedSeats.length + " seats per a ticket");return;
				}
			}
			else
			{
				  selectedSeats = jQuery.grep(selectedSeats, function(value) {
                  return value != seat_no;
                   });
				  selectedSeatsPrice = jQuery.grep(selectedSeatsPrice, function(e) {
                  return e != seat_no+':'+seat_price;
                   });
				  serviceTaxAmount = jQuery.grep(serviceTaxAmount, function(e) {
                  return e != seat_no+':'+seat_pricetax;
                   });
				  operatorServiceChargeAbsolute = jQuery.grep(operatorServiceChargeAbsolute, function(e) {
                  return e != seat_no+':'+seat_priceoperatorServiceChargeAbsolute;
                   });	
					ac = jQuery.grep(ac, function(e) {
                  return e != seat_no+':'+ac_det;
                   });	
				   sleeper = jQuery.grep(sleeper, function(e) {
                  return e != seat_no+':'+sleeper_det;
                   });	
				   totalseat_price= parseInt(totalseat_price)-seat_price;
				   totalseat_pricetax= parseInt(totalseat_pricetax)-seat_pricetax;
				    $('#seat_nos').text(selectedSeats.join(", "));
					$('.seat_fairss').text('INR '+totalseat_price);
				    $('#available_seat_no_'+seat_no).removeClass('p2_active');
				    $('#available_seat_no_'+seat_no).removeClass('p_active');
				    $('.bus-items').removeClass('hide-bus-item');
			   $(this).addClass('available').removeClass('selected');
			        $('#available_seat_'+seat_no).show();
				    $('#availed_seat_'+seat_no).hide();
			   seat_cnt<?php echo $routeScheduleId; ?>--;
			}
			if(seat_cnt<?php echo $routeScheduleId?>>0)
			{
				
			}
			else
			{
				$('#more-bus-<?= $routeScheduleId;?>').hide();
				//$('.check-active').removeClass('bp_dp_active');
				$('.bus-items>li').show();
				$('.rightLegend').show();
				 $('#boarding-dropping-points').hide();
			}
		
		/*  $.ajax({
			  type:"post",
			  url:"bus_library/seat-fare.php",
			  data:"id="+seat,
			  success:function(data){
				  var data1=data.split("^"); 
				  $("#frmSeat"+rid+" #seatnos").html(data1[0]);
				$( "#frmSeat"+rid+" #totalfare").html(data1[1]);
			  }
		 }); */
  	});
	$('.show-more-bus').click(function(){
		$('.bus-items>li').show();
		
	});
	$('.boarding-radio, .dropping-radio').click(function(){
		var action=$(this).attr("data-action");
		if(action=='boarding')
		{
			if ($(".boarding-radio").is(":checked") && $(".dropping-radio").is(":checked"))
				{
                 $('#boarding-dropping-points-id').removeClass('bp_dp_active');
                 $('#user-trip-summery').addClass('bp_dp_active');
				}
				else{
					
		$('#pills-tab li:last-child a').tab('show');
				}
		}
		else{
			if ($(".boarding-radio").is(":checked") && $(".dropping-radio").is(":checked"))
				{
                 $('#boarding-dropping-points-id').removeClass('bp_dp_active');
                 $('#user-trip-summery').addClass('bp_dp_active');
				}
				else{
			$('#pills-tab li:first-child a').tab('show');
				}
		}
		if ($(".boarding-radio").is(":checked") && $(".dropping-radio").is(":checked"))
				{
					var board=$("input[name='bp_point']:checked").val().split("@@"); 
					var board_loc= board[1];
					var board_time= board[0];
					var drop=$("input[name='dp_point']:checked").val().split("@@"); 
					var drop_loc= drop[1];
					var drop_time= drop[0];
					$('.boarding_addresss').text(board_loc);
					$('.dropping_addresss').text(drop_loc);
					$('.boarding_timeee').text(board_time);
					$('.dropping_timeee').text(drop_time);
					
					
				}
		
	});
	$('.bpdp-change').click(function(){
		 $('#user-trip-summery').removeClass('bp_dp_active');
                 $('#boarding-dropping-points-id').addClass('bp_dp_active');
                 $('.user-bp-dp-button1').show();
	});
	$('#user-bp-dp-button').click(function(){
		
                 $('#boarding-dropping-points-id').removeClass('bp_dp_active');
				 $('#user-trip-summery').addClass('bp_dp_active');
				 
	});
	
	
	$('#proceed-to-book').click(function(){
		var bp_point = $("input[name='bp_point']:checked"). attr('id');
		var dp_point = $("input[name='dp_point']:checked"). attr('id');
       // alert(bp_point+" "+dp_point);
		//alert(selectedSeats);

		//alert(selectedSeatsPrice);

	    $.ajax({
        data:{selectedSeats:selectedSeats,selectedSeatsPrice:selectedSeatsPrice,serviceTaxAmount:serviceTaxAmount,operatorServiceChargeAbsolute:operatorServiceChargeAbsolute,ac:ac,sleeper:sleeper,bp_point:bp_point,dp_point:dp_point,action: 'Set_passengerListSession'},
        url:"ajaxfunction.php",
        type:"POST",
		dataType:"html",
        success:function(e){
          console.log(e);
		  	  $('.main_result').html(e);
        },
        error:function(e){
          alert(e);
        }
      });

   
		$('#page_overlay').removeClass('hide');
		$('body').addClass('passenger_active');
		
		$('.custinfo').show();
		 var totalPricewithTax= totalseat_price+totalseat_pricetax
		 $('.show_service_tax').text(totalseat_pricetax);
		 $('.pricewithInsurance').text(totalPricewithTax);
	});
	
});

</script>



</div>