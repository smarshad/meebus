<?php
include '../../server/server.php'; 
include_once '../../agent/includes/functions.php';
$obj=new agent_module($con);  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}


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
$error_logs.= "Page : seat-availabilty.php<br/>POST Values : ".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];

$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'bus search result pop up','Page Enter',$error_logs);
$agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
$update_agent_active = $obj->agent_active($agent_active_details);

$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
$update_error_logs=$obj->error_logs($error_logs_detail);

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
		$travelDate=date('Y-m-d',strtotime(str_replace('/','-',$_SESSION['agent']['bus']['travelDate'])));
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
		$travelDate=date('Y-m-d',strtotime(str_replace('/','-',$_SESSION['agent']['bus']['travelDate'])));
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

$Bus_structuretype=$obj->Bus_structuretype(array($scheduleId));
$result=$obj->getBus_Structure(array($Bus_structuretype,1));
foreach($result as $strtypes)
{
	$struct_ID=$strtypes['structureID'];
	$struct_Name=$strtypes['structureType'];
	$upper_seat=$strtypes['upper_seat'];
	$upper_left_col=$strtypes['upper_left_col'];
	$upper_left_row=$strtypes['upper_left_row'];
	$upper_left_type=$strtypes['upper_left_type'];
	$upper_right_col=$strtypes['upper_right_col'];
	$upper_right_row=$strtypes['upper_right_row'];
	$upper_right_type=$strtypes['upper_right_type'];
	
	$lower_left_col=$strtypes['lower_left_col'];
	$lower_left_row=$strtypes['lower_left_row'];
	$lower_left_type=$strtypes['lower_left_type'];
	$lower_right_col=$strtypes['lower_right_col'];
	$lower_right_row=$strtypes['lower_right_row'];
	$lower_right_type=$strtypes['lower_right_type'];
}
$busStructure=$obj->getBusStructure(array($scheduleId));
$tmp='';
foreach($busStructure as $bs){
	$tmp = explode(',',$bs['rc']);
	$buss[$tmp[0]][$tmp[1]][$tmp[2]]=$bs['seat_no'];  
}

$_SESSION['agent']['bus']['seat_LYT']=$SeatLayoutSTR = $GetSeatLayoutResult = $buss;
//echo '<pre>'; print_r($busStructure); echo '</pre>'; exit;
?>

<?php  include_once '../../agent/includes/head1.php'; ?>

<img src="../../images/close-x.png" alt="close" title="" class="closeIcon" />
<div class="seatava1">
    <div class="container-fluid">
                <div class="seatava11">
                <?php if(isset($otherdatas[5]))?>
                    <span> <?php echo $otherdatas[5];?></span>
                <?php ?>
                    <span class="paddtb0lr5"> Bus Id : <?php echo $scheduleId;?> </span>
                    <span class="paddtb0lr5"> Bus Name : <?php echo substr($otherdatas[0],0,50); ?></span>
                <span class="paddtb0lr5">Bus Type : <?php if(isset($otherdatas[1]))echo $otherdatas[1]; ?> </span>
                <br/>
                <span class="paddtb0lr5">Depart : <?php if(isset($otherdatas[2]))echo $otherdatas[2]; ?></span>
                <span class="paddtb0lr5"> Arrival : <?php if(isset($otherdatas[3]))echo $otherdatas[3]; ?> </span> 
                <span class="paddtb0lr5">Available Seat : <?php if(isset($otherdatas[4]))echo $otherdatas[4]; ?></span></div>
            <div class="row-fluid">               
            
                <div id="content">           
                    <!-- Seat Start -->
                    <form id="booking" name="booking" action="booking_own.php" method="post"> 	                    			
					<div class="span6">
                    <div class="span12">
                        <div class="row-fluid">	
                        <div class="block to" id="quick_search1">                           
							 <table border="0" width="100%" height="100%" align="center" cellpadding="0" cellspacing="0"> 
                            <tr>
                                <td>
                                    <?php 	
								$seatCount1='';  
								$seatCount =''; 
								$r='';
								$booked_seat = '';									
								$sdate='';
								$day='';
								$mon='';
								$year='';
								$nor='';
								$seatCount1=1;  
								$seatCount =1; 
								$r=0;
								$booked_seat = $obj->get_booked_seat($scheduleId,$travelDate);									
								$sdate=explode("-",$dat);
								$day=$sdate[2];
								$mon=$sdate[1];
								$year=$sdate[0];
								$nor="not yet";
								$vip="not yet";
								/**************************UPPER SEAT LAYOUT ***********************/
							if($upper_seat=='1') { 
							?>
                            <table width="100%" cellspacing="2" cellpadding="0" border="0">
                                <tr>
                                	<td valign="top" width="35">U<br/>P<br/>P<br/>E<br/>R</td>
                                    <td valign="top">
                                        <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center"> 
                                            <tr>
                                                <td align="left">
                                                    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                    <?php 
                                                    for($up_lr=1; $up_lr<=$upper_left_row; $up_lr++) { ?>
                                                    <tr>
                                                    <?php  for($up_lc=1; $up_lc<=$upper_left_col; $up_lc++) {
                                                    $r++;
                                                    if($upper_left_type=='sleeper') { $width ='70px'; } else {  $width ='50px'; }
                                                    
                                                    
                                                    
                                                    $sel = mysql_query("select seat_no,vip from bus_structure where bus_id = '$Bus_id' and position = '$r' ");
                                                    $row=mysql_fetch_array($sel);
                                                    $seatno=$row['seat_no'];
                                                    
                                                    if(($row['vip']==1) && ($vip!=''))
                                                    {
                                                    $vip_rate = $query['vip_fare'];
                                                    $vip='set';
                                                    }
                                                    else if(($row['vip']==0) && ($nor!=''))
                                                    {
                                                    $normal_rate = $query['Bus_fare']; 
                                                    $nor='set';
                                                    }
                                                    ?>
                                                    <td>
                                                    
                                                    <?php if($nor=='set') { ?>
                                                    <input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $normal_rate; ?>">
                                                    <?php $nor=''; } 
                                                    if($vip=='set') {
                                                    ?>
                                                    <input type="hidden" name="vip_fare" id="vip_fare" value="<?php echo $vip_rate; ?>">	
                                                    <?php $vip=''; } 
                                                    if($row['seat_no']!="xx") {
                                                    if($row['vip']==1) {
                                                    echo "VIP"."<br>";
                                                    }
                                                    else 
                                                    {
                                                    $row['seat_no']."<br>";
                                                    
                                                    }
                                                    } 
                                                    else 
                                                    { 
                                                    echo "&nbsp;&nbsp;<br>";
                                                    }
                                                    if(count($booked_seat) > 0)
                                                    {
                                                    if(!in_array($row['seat_no'],$booked_seat)) 
                                                    {  
                                                    
                                                    
                                                    $tsel1 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
                                                    $blockseat=mysql_fetch_array(mysql_query($tsel1));
                                                    
                                                    $block_status=$blockseat['Blocked'];
                                                    
                                                    if($row['seat_no']!="xx")
                                                    {  ?>
                                                    <input  name="<?php echo "seat_".$buss['UL'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['UL'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['UL'][$up_lr][$up_lc]; ?>"   type="checkbox" <?php if($block_status==1) { ?> disabled="disabled" <?php } else { } ?>  />
                                                    
                                                    <label id="<?php echo ucfirst($upper_left_type); ?>" for="thing" onclick="seat_check('<?php echo $buss['UL'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['UL'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']; ?>');"></label>
                                                    
                                                    <?php 
                                                    } 
                                                    }
                                                    else 
                                                    {
                                                    $gender=getPsr_Gender($Bus_id,$dat,$row['seat_no'],$upper_left_type);
                                                    } 
                                                    ?>
                                                    <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'UL,'.$up_lr.','.$up_lc; ?>">
                                                    </td>
                                                    <?php
                                                        }
                                                                        else
                                                                        {
                                                                        
                                                                  $sel_ow10 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
                                                                  $blockseat=mysql_fetch_array(mysql_query($sel_ow10));
                                                                  $block_status=$blockseat['Blocked'];
                                                                  
                                                                          if($row['seat_no']!="xx")
                                                                          { 
                                                                 ?>
                                                    <input type="checkbox"  name="<?php echo "seat_".$buss['UL'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['UL'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['UL'][$up_lr][$up_lc]; ?>"   <?php if($block_status==1) { ?> checked="checked" disabled="disabled"<?php } else { } ?>  />
                                                    <label id="<?php echo ucfirst($upper_left_type); ?>"  for="thing" onclick="seat_check('<?php echo $buss['UL'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['UL'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']?>');"></label>
                                                                 <?php									       
                                                                          }
                                                                        }										
                                                    
                                                                ?>
                                                    <?php $seatCount1++; $seatCount++; } ?>
                                                    </tr>
                                                    <?php  } ?>
                                                    </table>
                                                    <table>
                                                    <?php  $nor="not yet"; $vip="not yet";  for($up_lr=1; $up_lr<=1; $up_lr++) { ?>
                                                    <tr>
                                                    <?php   $nor="not yet"; $vip="not yet"; for($up_lc=1; $up_lc<=$upper_right_col; $up_lc++) {
                                                    $r++;
                                                    if($upper_right_type=='sleeper') { $width ='70px'; } else {  $width ='50px'; } ?>
                                                    <td align="right">&nbsp;
                                                    </td>
                                                    <?php $seatCount++; } ?>
                                                    </tr>
                                                    <?php  } ?>
                                                    </table>
                                                    <table style="width:100%;">
														<?php 
                                                        $nor="not yet"; $vip="not yet";  
                                                        for($up_lr=1; $up_lr<=$upper_right_row; $up_lr++) { 
                                                        ?>
                                                            <tr>
                                                            	<?php   
																	$nor="not yet"; $vip="not yet"; 
																	for($up_lc=1; $up_lc<=$upper_right_col; $up_lc++) { 
                                                           			$r++;
		                                                            if($upper_right_type=='sleeper') { $width ='70px'; } else {  $width ='50px'; } 
																	$sel = mysql_query("select seat_no,vip from bus_structure where bus_id = '$Bus_id' and position = '$r' ");
																	$row=mysql_fetch_array($sel);
																	$seatno=$row['seat_no'];
																	if(($row['vip']==1) && ($vip!=''))
																	{
																		$vip_rate = $query['vip_fare'];
																		$vip='set';
																	}
																	if(($row['vip']==0) && ($nor!=''))
																	{
																		$normal_rate = $query['Bus_fare']; 
																		$nor='set';
																	}
                                                            	?>
                                                           		<td style="width:<?php echo $width; ?>">
                                                           		<?php 
																if($nor=='set') { ?>
                                                           			<input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $normal_rate; ?>">
                                                            	<?php 
																$nor=''; 
																} 
																if($vip=='set') {
																?>
																	<input type="hidden" name="vip_fare" id="vip_fare" value="<?php echo $vip_rate; ?>">	
																<?php 
																$vip=''; 
																} 
																if($row['seat_no']!="xx") 
																{
																	if($row['vip']==1)
																	{
																		echo "VIP"."<br>";
																	}
																	else 
																	{
																		$row['seat_no']."<br>";
																	}
																} 
																else 
																{ 
																	echo "&nbsp;&nbsp;<br>";
																}
																if(count($booked_seat) > 0)
																{
																	if(!in_array($row['seat_no'],$booked_seat)) 
																	{  
																		$tsel1 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
																		$blockseat=mysql_fetch_array(mysql_query($tsel1));
																		$block_status=$blockseat['Blocked'];
																		if($row['seat_no']!="xx")
																		{  
																		?>
																		<input  name="<?php echo "seat_".$buss['UR'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['UR'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['UR'][$up_lr][$up_lc]; ?>"   type="checkbox" <?php if($block_status==1) { ?> disabled="disabled" <?php } else { } ?>  />
																		
																		<label id="<?php echo ucfirst($upper_right_type); ?>" for="thing" onclick="seat_check('<?php echo $buss['UR'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['UR'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']; ?>');"></label>
																		<?php 
																		} 
																	}
																	else {
																		$gender=getPsr_Gender($Bus_id,$dat,$row['seat_no'],$upper_right_type);
																	} 
																	?>
																		<input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'UR,'.$up_lr.','.$up_lc; ?>">
																	</td>
																<?php
																}
																else
																{
																	$sel_ow10 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
																	$blockseat=mysql_fetch_array(mysql_query($sel_ow10));
																	$block_status=$blockseat['Blocked'];
																	if($row['seat_no']!="xx")
																	{ 
																	?>
                                                                        <input type="checkbox"  name="<?php echo "seat_".$buss['UR'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['UR'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['UR'][$up_lr][$up_lc]; ?>"   <?php if($block_status==1) { ?> checked="checked" disabled="disabled"<?php } else { } ?>  />
                                                                        <label id="<?php echo ucfirst($upper_right_type); ?>"  for="thing" onclick="seat_check('<?php echo $buss['UR'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['UR'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']?>');"></label>
																	<?php									       
																	}
																}										
                                                            	$seatCount1++; $seatCount++; } ?>
                                                            </tr>
                                                        <?php  
														} 
														?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <?php } ?>
                                        
                                <div style="height:2px; clear:both; width:100%;"></div>
                                 <table class="input" style="margin-top:20px;" width="100%" border="0" align="center"> 
                                    <tr>
                                    <td valign="top" width="35"><img border="0" title="bus" alt="bus" src="../../images/stearing.gif"><br/>L<br/>O<br/>W<br/>E<br/>R</td>
                                    <td>
	                                    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center">                                
                                    	<?php 
										$nor="not yet"; $vip="not yet"; 
										for($up_lc=1; $up_lc<=$lower_left_col; $up_lc++) 
										{ 
										?>
                                        <tr>
                                        <?php  
                                        $nor="not yet"; $vip="not yet"; 
										for($up_lr=1; $up_lr<=$lower_left_row; $up_lr++) 
										{ 
                                       		$r++;
                                        	if($lower_left_type=='sleeper') { $width ='70px'; } else {  $width ='50px'; } 
                                        ?>
											<td>
                                                <?php 
												if($nor=='set') { ?>
                                                    <input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $normal_rate; ?>">
                                                <?php 
													$nor=''; 
												}
												if($row['seat_no']!="xx") {
								
														$row['seat_no']."<br>";
												} 
												else 
												{ 
													echo "&nbsp;&nbsp;<br>";
												}
												if(count($booked_seat) > 0)
												{
													if(!in_array($row['seat_no'],$booked_seat)) 
													{  
														$tsel1 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
														$blockseat=mysql_fetch_array(mysql_query($tsel1));
														$block_status=$blockseat['Blocked'];
                                                        if($row['seat_no']!="xx")
														{  
														?>
			                                                <input  name="<?php echo "seat_".$buss['LL'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['LL'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['LL'][$up_lr][$up_lc]; ?>"   type="checkbox" <?php if($block_status==1) { ?> disabled="disabled" <?php } else { } ?>  />
            			                                    <label id="<?php echo ucfirst($lower_left_type); ?>" for="thing" onclick="seat_check('<?php echo $buss['LL'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['LL'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']; ?>');"></label>
                                               			<?php 
														} 
													}
													else 
													{
														$gender=getPsr_Gender($Bus_id,$dat,$row['seat_no'],$lower_left_type);
													} 
													?>
                                                	<input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'LL,'.$up_lr.','.$up_lc; ?>">
                                               		</td>
                                       				<?php
												}
												else
												{
													$sel_ow10 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
													$blockseat=mysql_fetch_array(mysql_query($sel_ow10));
													$block_status=$blockseat['Blocked'];                                                     
													if($row['seat_no']!="xx")
													{ 
                                                     ?>
                                                        <input type="checkbox"  name="<?php echo "seat_".$buss['LL'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['LL'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['LL'][$up_lr][$up_lc]; ?>"   <?php if($block_status==1) { ?> checked="checked" disabled="disabled"<?php } else { } ?>  />
                                                        <label id="<?php echo ucfirst($lower_left_type); ?>"  for="thing" onclick="seat_check('<?php echo $buss['LL'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['LL'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']?>');"></label>
                                                     <?php									       
													}
												}										
											?>
                                        <?php $seatCount1++; $seatCount++; 
                                        } ?>
                                        </tr>
                                    <?php  } ?>
                                    </table>
                                    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <?php $nor="not yet"; $vip="not yet";  for($up_lc=1; $up_lc<=$lower_right_col; $up_lc++) {   ?>
                                    <tr>
                                    <?php  
                                    $nor="not yet"; $vip="not yet";  for($up_lr=1; $up_lr<=$lower_right_row; $up_lr++) {
                                    if($lower_right_type=='sleeper') { $width ='70px'; } else {  $width ='50px'; } 
                                    $r++;
                                    $sel = mysql_query("select seat_no,vip from bus_structure where bus_id = '$Bus_id' and position = '$r' ");
                                    $row=mysql_fetch_array($sel);
                                    $seatno=$row['seat_no'];
                                    
                                    if(($row['vip']==1) && ($vip!=''))
                                    {
                                    $vip_rate = $query['vip_fare'];
                                    $vip='set';
                                    }
                                    else if(($row['vip']==0) && ($nor!=''))
                                    {
                                    $normal_rate = $query['Bus_fare']; 
                                    $nor='set';
                                    }
                                    ?>
                                    <td>
                                    
                                    <?php if($nor=='set') { ?>
                                    <input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $normal_rate; ?>">
                                    <?php $nor=''; } 
                                    
                                    if($vip=='set') {
                                    ?>
                                    <input type="hidden" name="vip_fare" id="vip_fare" value="<?php echo $vip_rate; ?>">	
                                    <?php $vip=''; } ?>
                                    
                                    <?php 
                                    
                                    if($row['seat_no']!="xx") {
                                    
                                    if($row['vip']==1)
                                    {
                                        echo "VIP"."<br>";
                                      }
                                     else 
                                     {
                                         $row['seat_no']."<br>";
                                          
                                     }
                                      } 
                                      else 
                                      { 
                                      echo "&nbsp;&nbsp;<br>";
                                       }
                                        //echo count($booked_seat);
                                                if(count($booked_seat) > 0){
                                                 if(!in_array($row['seat_no'],$booked_seat)) 
                                                 {  
                                                  
                                                
                                                $tsel1 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
                                                  $blockseat=mysql_fetch_array(mysql_query($tsel1));
                                                  
                                                   $block_status=$blockseat['Blocked'];
                                                  
                                                 if($row['seat_no']!="xx")
                                                  {  ?>
                                    <input  name="<?php echo "seat_".$buss['LR'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['LR'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['LR'][$up_lr][$up_lc]; ?>"   type="checkbox" <?php if($block_status==1) { ?> disabled="disabled" <?php } else { } ?>  />
                                    <label id="<?php echo ucfirst($lower_right_type); ?>" for="thing" onclick="seat_check('<?php echo $buss['LR'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['LR'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']; ?>');"></label>
                                    
                                    <?php } }
                                                else {
                                                      $gender=getPsr_Gender($Bus_id,$dat,$row['seat_no'],$lower_right_type);
                                                } ?>
                                    
                                    
                                    <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'LR,'.$up_lr.','.$up_lc; ?>">
                                    
                                    </td>
                                    <?php
                                                        }
                                                        else
                                                        {
                                                        
                                                  $sel_ow10 = "select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'";
                                                  $blockseat=mysql_fetch_array(mysql_query($sel_ow10));
                                                  $block_status=$blockseat['Blocked'];
                                                          if($row['seat_no']!="xx")
                                                          { 
                                                 ?>
                                    <input type="checkbox"  name="<?php echo "seat_".$buss['LR'][$up_lr][$up_lc]; ?>" id="<?php echo "seat_".$buss['LR'][$up_lr][$up_lc]; ?>"  value="<?php echo $buss['LR'][$up_lr][$up_lc]; ?>"   <?php if($block_status==1) { ?> checked="checked" disabled="disabled"<?php } else { } ?>  />
                                    <label id="<?php echo ucfirst($lower_right_type); ?>"  for="thing" onclick="seat_check('<?php echo $buss['LR'][$up_lr][$up_lc]; ?>','<?php echo $scheduleId; ?>','<?php echo $travelDate; ?>'),seat_display('<?php echo $buss['LR'][$up_lr][$up_lc]; ?>','<?php echo $row['vip']?>');"></label>
                                                 <?php									       
                                                          }
                                                        }										
                                    
                                                ?>
                                    <?php $seatCount1++; $seatCount++; } ?>
                                    </tr>
                                    <?php  } ?>
                                    </table>
                                    </td>
                                    </tr>                
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
                    <div class="span3 fon">Available seat  <img src="../../images/Seat.jpg" />
                                </div>
                    <div class="span3 fon">ladies seat <img  src="../../images/Seat-ladies.jpg" /></div> 
                    <div class="span3 fon">Selected seat <img src="../../images/Seat-availed.jpg" /></div> 
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
			//alert(seatCount);
			seatCount=1;
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
		/*	if (boarding == "" || !boarding)
			{
				alert("Please select boarding point");
				return false;
			}
			else
			{
				validation++;
			}*/
			return true;			
			event.preventDefault();
		
		//}
		});



</script>