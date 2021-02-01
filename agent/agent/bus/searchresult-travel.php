<?php 
include_once'../../server/server.php'; 
include_once '../includes/functions.php';

include_once "../../bus/travelyarri-lib/bus_library/SSAPICaller.php";
$obj=new agent_module($con);  

$agent_markup= $_SESSION['agent']['log']['markup'];
$admin_markup= $_SESSION['agent']['log']['bus_markup'];

$_SESSION['common']['pagename'] = "Bus"; 

if(isset($_POST['search']) && !isset($_SESSION['agent']['bus']['origin']) && !isset($_SESSION['agent']['bus']['destination']) && !isset($_SESSION['agent']['bus']['travelDate'])) 
{
	unset($_SESSION['agent']['bus']['travelDate']);	
	$_SESSION['agent']['bus']['origin']=$_POST['origin'];
	$_SESSION['agent']['bus']['destination']=$_POST['destination'];
	$_SESSION['agent']['bus']['travelDate'] = $_POST['depart'];
	if(isset($_POST['return']) && $_POST['return']!='')
	{
	$returnDate = $_SESSION['agent']['bus']['travelreturnDate'] = $_POST['return']; 
	}
	else 
	{
	$returnDate='';	
	}
	
	$trip_type=$_SESSION['agent']['bus']['trip_type'] = $_POST['trip'];
}

$origin =$_SESSION['agent']['bus']['origin'];
$destination =$_SESSION['agent']['bus']['destination'];
$travelDate = $_SESSION['agent']['bus']['travelDate'];
if(isset($_POST['return']) && $_POST['return']!='')
$returnDate = $_SESSION['agent']['bus']['travelreturnDate'];	
else 
$returnDate='';	
$trip_type=$_SESSION['agent']['bus']['trip_type'];

$inputString = GetFromCities();
$bus_cities = json_decode(json_encode($inputString),1);
foreach($bus_cities['GetFromCitiesResult']['Cities']['City'] as $city)
{
	if($city['CityName']==strtolower($origin))
	{	
		$_SESSION['agent']['bus']['travel']['origin_id']=$fromcity_id=$city['CityID'];
		$_SESSION['agent']['bus']['travel']['origin']=$city['CityName'];

	}
	if($city['CityName']==strtolower($destination))
	{
	$_SESSION['agent']['bus']['travel']['destination_id']=$tocity_id=$city['CityID'];
	 $_SESSION['agent']['bus']['travel']['destination']=$city['CityName'];
	}
}

$other_data = 'Orgin : '.$origin.' <br/>Destination : '.$destination.' <br/>Travel Date : '.$travelDate.' <br/> Return Date : '.$returnDate.'<br/>Trip Type : '.$trip_type.' <br/>Booking Date : '.date("d/m/Y",time());
$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search Result','Page Enter',$other_data);
$system_log = $obj->systemlogs($system_data);  $system_data='';
 $tDate =date('Y-m-d',strtotime(str_replace('/','-',$travelDate)));
if(isset($fromcity_id) && isset($tocity_id))
$inputString = GetRoutes2($fromcity_id,$tocity_id,$tDate);
$busDatas = json_decode(json_encode($inputString),1);
$_SESSION['agent']['bus']['bus_result']=$results=$busDatas['GetRoutes2Result']['Route']['clsRoute2'];
/*echo "<pre>";
print_r($results);
echo "</pre>"; */

?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<style>
		.black_overlay{
			display: none;
			position: fixed;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.6;
			opacity:.80;
			filter: alpha(opacity=80);
		}
	.white_content {
		display: none;
		position: fixed;
		top: 12%;
		left: 10%;
		width: 80%;
		height: ;
		padding: 16px;
		border-radius:5px;
		background-color: white;
		z-index:1010;
		overflow: auto;
	}
.pad-top{padding-top:0px !important}		
.sname{width:160px} .left{width: 42px !important}; 
</style>
</head>
<body>
<?php include_once '../includes/top_menu.php'; ?>

        <div class="container-fluid">
            <div class="row-fluid">
             <?php include '../includes/leftmenu.php'; ?>

			    <div class="span9" id="content">
                    	<div class="row-fluid">                        
	                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left modifytxt" style="cursor: pointer;">Modify Search For Bus</div>
                            </div>
                            <div id="modifysearch" class="collapse in" style="padding-top:15px; padding-left:15px;display:none">
                                <div class="span12">
                                     <form class="form-horizontal" action="searchresult.php" method="post" autocomplete="off">
                                      <fieldset>
                                        <div class="span3">
										<div class="control-group">
                                         <label class="control-label left" for="origin">From: </label>
                                          <div class="controls tleft">
                                          <input type="hidden" id="trip" name="trip" value="">
                                            <input type="text" id="origin" class="input focused sname" name="origin" data-provide="typeahead" data-items="4" data-source='<?php echo $obj->getStation();  ?>' value="" required >
                                          </div>
                                        </div>
                                        </div>
                                        
										<div class="span3">
										<div class="control-group">
                                        <label class="control-label left" for="destination">To: </label>
                                          <div class="controls tleft">
                                            <input type="text" id="destination" class="input focused sname" name="destination" data-provide="typeahead" data-items="4" data-source='<?php echo $obj->getStation();  ?>'  value=""  required>
                                          </div>
                                        </div>
                                        </div>
                                         
                                        <div class="span3">
                                            <div class="control-group">
                                             <input class="input sname focused datepicker" id="depart" name="depart"  type="text" placeholder="Depart Date" required value="" />
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                                              <button type="submit" name="search" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                                
                            </div>
                        </div>
                        </div>
                    </div>
               
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <div class="block">
                            <div class="navbar navbar-inner block-header splhe">
                            <div class="span12 pad-top">
                            <div class="span2 pad-top spbus"><div class="muted"><a href="searchresult.php">8% Bus</a></div></div>
                            <div class="span2 pad-top spbus sbus"><div class="muted"><a href="searchresult-travel.php">10% Bus</a></div></div>
                            <div class="span8 pad-top">
                                <div class="muted"><?php echo ucfirst($_SESSION['agent']['bus']['origin'])." -> ".ucfirst($_SESSION['agent']['bus']['destination'])." (".$_SESSION['agent']['bus']['travelDate'].")"; ?></div> 
                            </div>    
                            </div>
                            </div>
                            <div class="block-content collapse in">
                             
                                <div class="span12">
                                     <div id="page-wrap">
                                        <table id="bus">
                                            <thead>
                                                <tr>
                                                    <th class="span3">Travels</th>
                                                    <th class="span2">Depart</th>
                                                    <th class="span2">Arrival</th>
                                                    <th class="span2">Duration</th>
                                                    <th class="span1">Seats</th>
                                                    <th class="span2" style="text-align: center">Fare</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if($results=='') { ?>
                                            <script>
											 location.reload();
											</script>
                                            <?php }else {
											if(isset($results[1])){
												
											$i=1;foreach($results as $bus_result) {  ?>
                                            
                                                <tr>
                                                    <td class="span3">
                                                    <?php if(isset($bus_result['liveTrackingAvailable']) && $bus_result['liveTrackingAvailable']=='true') { ?>
                                                    <a class="busIcon icon-bus_tracking" href="javascript:void(0)" ></a>
                                                    <?php } else { ?>
                                                    <a class="busIcon icon-bus" href="javascript:void(0)"></a> <?php } ?>
                                                    <div class="detailsBlock busDataBlock">
											        	<h4 class="BusName"><?php echo addslashes($bus_result['CompanyName']); ?></h4>
														<span class="BusType"><?php echo $bus_result['BusTypeName']; ?></span>
														<div class="busLinks clearfix">
														<div class="full-left">
					        								<a href="#cancel_policy<?php echo $i; ?>" class="icon icon-icon_lstPic inline">&nbsp;</a>
				        								</div>
				        								<!--<div class="full-left">
					        								<a href="javascript:void(0);" class="icon-icon_lstVideo icon">&nbsp;</a>				   
				        								</div>	-->
                                                          <?php if(isset($bus_result['mTicketEnabled']) && $bus_result['mTicketEnabled']) { ?>
				        								<div class="full-left">
                                                      
					        								<a href="javascript:void(0);" class="icon icon-m-ticket tooltip">
                                                            <span>
        <img class="callout" src="<?php echo $base_url; ?>images/callout.gif" />
        <strong>mTicket</strong>
    </span>
    </a>				
				        								</div>
                                                        <?php } ?>	
													</div>
													</div>
                                                    </td>
                                                    <td class="span2"><span style="display:none;"><?php echo strtotime(date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60))); ?></span>
                                                    <span class="busDataBlock icon-time">&nbsp;</span>
                                                   <a href="#" class="tooltip1"> 
                                                    <span class="sub-title">
													<?php
														$deptim = explode('T',$bus_result['DepartureTime']);
														$dtim=$deptim[1];
														echo $Depart_time=date('h:i A', strtotime($dtim));
													?>
                                                    </span>
                                                    
                                                    <span class="tip1">
                                                    <img class="callout1" src="<?php echo $base_url; ?>images/callout.png" />
                                                     <strong>Depature</strong>  
                                                    </span>
                                                    </a>
                                                    </td>
                                                    <td class="span2"><span style="display:none;"><?php 
													$arrtim = explode('T',$ARRrims);
													$arrti=$arrtim[1];
													echo $Arrive_time=date('h:i A', strtotime($arrti));  
													 ?></span>
													 <span class="busDataBlock icon-time">&nbsp;</span>
                                                     <a href="#" class="tooltip2"> 
                                                     <span class="sub-title"><?php 
													echo $Arrive_time;
													 ?></span>
                                                     <span class="tip2">
                                                    <img class="callout2" src="<?php echo $base_url; ?>images/callout.png" />
                                                     <strong>Arrival</strong>  
                                                    </span>
                                                     </a>
                                                     </td>
													
                                                    <td class="span2">
													<span class="busDataBlock icon-duration">&nbsp;</span><span class="sub-title"><?php 
														$a3 = DATE("H:i", STRTOTIME($Depart_time));
														$a4 = DATE("H:i", STRTOTIME($Arrive_time));
														$nextDay = $a3 > $a4 ? 1 : 0;
														$dep = EXPLODE(':', $a3);
														$arr = EXPLODE(':', $a4);
														$diff = ABS(MKTIME($dep[0], $dep[1], 0, DATE('n'), DATE('j'), DATE('y')) - MKTIME($arr[0], $arr[1], 0, DATE('n'), DATE('j') + $nextDay, DATE('y')));
														$hours = FLOOR($diff / (60 * 60));
														$mins = FLOOR(($diff - ($hours * 60 * 60)) / (60));
														$secs = FLOOR(($diff - (($hours * 60 * 60) + ($mins * 60))));
														IF (STRLEN($hours) < 2)
														{
															$hours = "0" . $hours;
														}
														IF (STRLEN($mins) < 2)
														{
															$mins = "0" . $mins;
														}
														IF (STRLEN($secs) < 2)
														{
															$secs = "0" . $secs;
														}
														echo $final_diff = $hours . ':' . $mins . '&nbsp; hrs';
													 ?></span>
                                                     </td>
                                                    <td class="span2">
                                                    <span class="busDataBlock icon-icon_lstSeat">&nbsp;</span>
													<span class="sub-title"><?php echo $bus_result['AvailableSeats']; ?> Seats</span>
                                                    </td>
                                                    <td class="span2">
                                                    <span class="fareSpan"> <?php 
													if(is_array($obj->agentMarkup($bus_result['Fare'],$agent_markup,$admin_markup))) {
														  unset($fare_array); 
														  $bus_fare1=$obj->agentMarkup($bus_result['Fare'],$agent_markup,$admin_markup);
														  foreach($bus_fare1 as $fare) {
														   $fare_array[]=round($fare); 
														   }     
														echo 'Rs. '.implode('/', $fare_array); } 
														else echo 'Rs. '.round($obj->agentMarkup($bus_result['Fare'],$agent_markup,$admin_markup)); ?></span>
                                                        <?php if($bus_result['AvailableSeats']!=0) { ?>
                                                     <span><a class='book' id="<?php echo $bus_result['RouteScheduleId']; ?>" title="<?php echo str_replace('&','*',$bus_result['RouteScheduleId']).'^'.str_replace('&','*',$bus_result['BusTypeName']).'^'.$Depart_time.'^'.$Arrive_time.'^'.$bus_result['AvailableSeats'].'^'.ucfirst($_SESSION['agent']['bus']['origin'])." -> ".ucfirst($_SESSION['agent']['bus']['destination'])." (".$_SESSION['agent']['bus']['travelDate'].")"; ?>" href="javascript:void(0);">Book</a></span></span>
                                                     <?php
														}
														else
														{
													?>
                                                    <span><a class='book1' id="<?php echo $bus_result['RouteScheduleId']; ?>" href="javascript:void(0);">Soldout</a></span>
                                                    
                                                    <?php } ?>
													
<div style='display:none'>
			<div id='cancel_policy<?php echo $i; ?>' style='padding:10px; background:#fff;'>
            <div class="canmain">
                        <form id="form1" action="" method="post" name="form1">
        <div style="text-align:left;" id="travelDetails">
            <div class="textPadding"><span class="blueTextBold"><?php echo $_SESSION['agent']['bus']['origin'];?></span><span class="grayText">&nbsp;to</span><span class="blueTextBold">&nbsp;<?php echo $_SESSION['agent']['bus']['destination']; ?></span><span>,&nbsp;<?php echo $bus_result['travels']; ?></span><span>,&nbsp;<?php echo $_SESSION['agent']['bus']['travelDate']; ?></span></div>
        </div>
        
        
           <?php $cnclDatas = '';
                $cnclDatas.='<div style="background: #fff none repeat scroll 0 0; font-family: Verdana,Geneva,sans-serif; height: auto; margin: 0 auto; width: 100%;"><div style="color: #000; float: left; font-size: 15px; font-weight: bold; height: 40px; line-height: 30px; padding-left: 5px; width:99%;border-bottom: 1px solid #CCC;">Cancellation Policy</div><div style="width:100%; flot:left;"><div style="border-right: 1px solid #ccc; color: #000; float: left; font-size: 13px;    font-weight: bold; height: 30px;  line-height: 30px; padding-left: 5px; width:68%; flot:left;">Cancellation time</div><div style="float: left; font-size: 13px; font-weight: bold; height: 30px; line-height: 30px; padding-left: 5px; width:30%;  flot:left;">Cancellation Charges</div><div style="width:100%; float:left; height:auto;">';
                $h = 0;				
				 $cancel_pol=explode(';',$bus_result['cancellationPolicy']);
				
                foreach ($cancel_pol as $fd) {
					if($cancel_pol[$h]!='')
					{
						if ($h <= count($cancel_pol)) {
							$new11 = explode(':', $cancel_pol[$h]);
							if ($new11[1] == -1) {
								$cnclDatas.='<div style="border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;">';
								$cnclDatas.=$new11[0];
								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height:30px; padding-left:5px; width:30%;">';
								$cnclDatas.=$new11[2];
								$cnclDatas.=' %</div>';
							} else {
								$cnclDatas.='<div style=" border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;" >Between ';
								$cnclDatas.=$new11[1];
								$cnclDatas.=' hours and ';
								$cnclDatas.=$new11[0];
								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:30%;">';
								$cnclDatas.=$new11[2];
								$cnclDatas.='% </div>';
							}
						}
                    } $h++;
                } $cnclDatas.='</div></div></div>';  echo $cnclDatas; ?>
            <div id="labels">
                
            </div>
            <?php if($bus_result['partialCancellationAllowed']=='true') { ?>
            <div id="divLabelPartialCancellation">
                <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation allowed. 
                </div>
                
                <div style="clear:both;"></div>
            </div>
            <?php }
			else {
			 ?>
             <div id="divLabelPartialCancellation">
                <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation not allowed. 
                </div>
                
                <div style="clear:both;"></div>
            </div>
             <?php } ?>
    </form>
                    </div>

			</div>
		</div>
                                                    </td>
                                                </tr>
                                               
                                            <?php $i++; }
											}
											else
											{ $i=1;	$bus_result=$results['results'];
											 
												 ?>
												<tr>
                                                    <td class="span3">
                                                    <?php if($bus_result['liveTrackingAvailable']=='true') { ?>
                                                    <a class="busIcon icon-bus_tracking" href="javascript:void(0)" ></a>
                                                    <?php } else { ?>
                                                    <a class="busIcon icon-bus" href="javascript:void(0)"></a> <?php } ?>
                                                    <div class="detailsBlock busDataBlock">
											        	<h4 class="BusName"><?php echo $bus_result['travels']; ?></h4>
														<span class="BusType"><?php echo $bus_result['busType']; ?></span>
														<div class="busLinks clearfix">
														<div class="full-left">
					        								<a href="#cancel_policy<?php echo $i; ?>" class="icon icon-icon_lstPic inline">&nbsp;</a>
				        								</div>
				        								<!--<div class="full-left">
					        								<a href="javascript:void(0);" class="icon-icon_lstVideo icon">&nbsp;</a>				   
				        								</div>	-->
                                                          <?php if($bus_result['mTicketEnabled']) { ?>
				        								<div class="full-left">
                                                      
					        								<a href="javascript:void(0);" class="icon icon-m-ticket tooltip">
                                                            <span>
        <img class="callout" src="<?php echo $base_url; ?>images/callout.gif" />
        <strong>mTicket</strong>
    </span>
    </a>				
				        								</div>
                                                        <?php } ?>	
													</div>
													</div>
                                                    </td>
                                                    <td class="span2"><span style="display:none;"><?php echo strtotime(date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60))); ?></span><span class="busDataBlock icon-time">&nbsp;</span><span class="sub-title"><?php echo $Depart_time=date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60)); ?></span></td>
                                                    <td class="span2"><span style="display:none;"><?php 
													if (floor($bus_result['arrivalTime'] / 60) > 24)
													{
														$Arrive_time = date("g:i A", strtotime((floor(($bus_result['arrivalTime'] / 60) - 24) . ":" . $bus_result['arrivalTime'] % 60)));
													} 
													else
													{
														$Arrive_time = date("g:i A", strtotime(floor($bus_result['arrivalTime'] / 60) . ":" . $bus_result['arrivalTime'] % 60));
													}
													echo strtotime($Arrive_time);
													 ?></span>
													 <span class="busDataBlock icon-time">&nbsp;</span><span class="sub-title"><?php 
													echo $Arrive_time;
													 ?></span></td>
													
                                                    <td class="span2">
													<span class="busDataBlock icon-duration">&nbsp;</span><span class="sub-title"><?php 
														$a3 = DATE("H:i", STRTOTIME($Depart_time));
														$a4 = DATE("H:i", STRTOTIME($Arrive_time));
														$nextDay = $a3 > $a4 ? 1 : 0;
														$dep = EXPLODE(':', $a3);
														$arr = EXPLODE(':', $a4);
														$diff = ABS(MKTIME($dep[0], $dep[1], 0, DATE('n'), DATE('j'), DATE('y')) - MKTIME($arr[0], $arr[1], 0, DATE('n'), DATE('j') + $nextDay, DATE('y')));
														$hours = FLOOR($diff / (60 * 60));
														$mins = FLOOR(($diff - ($hours * 60 * 60)) / (60));
														$secs = FLOOR(($diff - (($hours * 60 * 60) + ($mins * 60))));
														IF (STRLEN($hours) < 2)
														{
															$hours = "0" . $hours;
														}
														IF (STRLEN($mins) < 2)
														{
															$mins = "0" . $mins;
														}
														IF (STRLEN($secs) < 2)
														{
															$secs = "0" . $secs;
														}
														echo $final_diff = $hours . ':' . $mins . '&nbsp; hrs';
													 ?></span>
                                                     </td>
                                                    <td class="span2">
                                                    <span class="busDataBlock icon-icon_lstSeat">&nbsp;</span>
													<span class="sub-title"><?php echo $bus_result['AvailableSeats']; ?> Seats</span>
                                                    </td>
                                                    <td class="span2">
                                                    <span class="fareSpan"> <?php 
													if(is_array($obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup))) {
														  unset($fare_array); 
														  $bus_fare1=$obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup);
														  foreach($bus_fare1 as $fare) {
														   $fare_array[]=round($fare); 
														   }     
														echo 'Rs. '.implode('/', $fare_array); } 
														else echo 'Rs. '.round($obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup)); ?></span>
                                                        <?php if($bus_result['AvailableSeats']!=0) { ?>
                                                     <span><a class='book' id="<?php echo $bus_result['RouteScheduleId']; ?>" title="<?php echo str_replace('&','*',$bus_result['RouteScheduleId']).'^'.str_replace('&','*',$bus_result['BusTypeName']).'^'.$Depart_time.'^'.$Arrive_time.'^'.$bus_result['AvailableSeats'].'^'.ucfirst($_SESSION['agent']['bus']['origin'])." -> ".ucfirst($_SESSION['agent']['bus']['destination'])." (".$_SESSION['agent']['bus']['travelDate'].")"; ?>" href="javascript:void(0);">Book</a></span>
                                                     <?php
														}
														else
														{
													?>
                                                    <span><a class='book1' id="<?php echo $bus_result['RouteScheduleId']; ?>" href="javascript:void(0);">Soldout</a></span>
                                                    
                                                    <?php } ?>
											
<div style='display:none'>
	
			<div id='cancel_policy<?php echo $i; ?>' style='padding:10px; background:#fff;'>
            <div class="canmain">
                        <form id="form1" action="" method="post" name="form1">
        <div style="text-align:left;" id="travelDetails">
            <div class="textPadding"><span class="blueTextBold"><?php echo $_SESSION['agent']['bus']['origin'];?></span><span class="grayText">&nbsp;to</span><span class="blueTextBold">&nbsp;<?php echo $_SESSION['agent']['bus']['destination']; ?></span><span>,&nbsp;<?php echo $bus_result['travels']; ?></span><span>,&nbsp;<?php echo $_SESSION['agent']['bus']['travelDate']; ?></span></div>
        </div>
        
        
           <?php $cnclDatas = '';
                $cnclDatas.='<div style="background: #fff none repeat scroll 0 0; font-family: Verdana,Geneva,sans-serif; height: auto; margin: 0 auto; width: 100%;"><div style="color: #000; float: left; font-size: 15px; font-weight: bold; height: 40px; line-height: 30px; padding-left: 5px; width:99%;border-bottom: 1px solid #CCC;">Cancellation Policy</div><div style="width:100%; flot:left;"><div style="border-right: 1px solid #ccc; color: #000; float: left; font-size: 13px;    font-weight: bold; height: 30px;  line-height: 30px; padding-left: 5px; width:68%; flot:left;">Cancellation time</div><div style="float: left; font-size: 13px; font-weight: bold; height: 30px; line-height: 30px; padding-left: 5px; width:30%;  flot:left;">Cancellation Charges</div><div style="width:100%; float:left; height:auto;">';
                $h = 0;	
					
				 $cancel_pol=explode(';',$bus_result['cancellationPolicy']);
				
                foreach ($cancel_pol as $fd) {
					if($cancel_pol[$h]!='')
					{
						if ($h <= count($cancel_pol)) {
							$new11 = explode(':', $cancel_pol[$h]);
							if ($new11[1] == -1) {
								$cnclDatas.='<div style="border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;">';
								$cnclDatas.=$new11[0];
								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height:30px; padding-left:5px; width:30%;">';
								$cnclDatas.=$new11[2];
								$cnclDatas.=' %</div>';
							} else {
								$cnclDatas.='<div style=" border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;" >Between ';
								$cnclDatas.=$new11[1];
								$cnclDatas.=' hours and ';
								$cnclDatas.=$new11[0];
								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:30%;">';
								$cnclDatas.=$new11[2];
								$cnclDatas.='% </div>';
							}
						}
                    } $h++;
                } $cnclDatas.='</div></div></div>';  echo $cnclDatas; ?>
            <div id="labels">
                
            </div>
            <?php if($bus_result['partialCancellationAllowed']=='true') { ?>
            <div id="divLabelPartialCancellation">
                <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation allowed. 
                </div>
                
                <div style="clear:both;"></div>
            </div>
            <?php }
			else {
			 ?>
             <div id="divLabelPartialCancellation">
                <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation not allowed. 
                </div>
                
                <div style="clear:both;"></div>
            </div>
             <?php } ?>
    </form>
                    </div>

			</div>
		</div>
                                                    </td>
                                                </tr>	
											<?php
                                            }
											 } ?>
                                            </tbody>
                                        </table>
									</div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>

            </div>
			
			<?php include '../includes/footer.php' ?>		
		</div> <!-- /container -->
        <div id="seat" class="white_content"  style="min-height:50%; height:auto;">
        	
		</div>
        <div id="seat_block" class="black_overlay"></div>
        
        </div>
  </body>
</html>

<script type="text/javascript">
function showagentfun(val)
{
	if(val==1)
	{
		$('#showagentck').hide();
		$('#showagentck1').show();
		$('.showagent').hide();	
	}	
	else
	{
		$('#showagentck1').hide();
		$('#showagentck').show();

		$('.showagent').show();	
	}
	return true;
}

</script>
<script>
$(document).ready(function(){                             
  // modify search block start        
  $(".modifytxt").click(function() {
	   $( "#modifysearch" ).toggle( "slow", function() {
	   });
  });
});
</script>
<script type="text/javascript">
	   $(document).ready(function(){
			$(".book").click(function(){
				var otherdata = $(this).prop("title");	
				$('#seat').show();
$('#seat').html('<img src="../../images/close-x.png"alt="close"title=""style="z-index:100;right:0px;top:0px;width:25px;height:25px;position:absolute;cursor:pointer;"class="closeIcon"/><div class="cssload-preloader"><div class="cssload-preloader-box"><div>S</div><div>E</div><div>A</div><div>R</div><div>C</div><div>H</div><div>I</div><div>N</div><div>G</div><div>&nbsp;</div><div>B</div><div>U</div><div>S</div></div></div>');
				$('#seat_block').show();
				  var id=$(this).attr('id');
				  $.ajax({
					  type:"post",
					  url:"../../bus/travelyarri-lib/seat-availability.php",
					  data:"id="+id+"&otherdata="+otherdata,
					  success:function(data){
						 $("#seat").html(data);
					  }
				  });

			});
	   });
</script>