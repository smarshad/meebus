<?php 
   include'../../server/server.php'; 
   if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') 
   {
   }
   else 
   { 
   	header('location:../logout.php');
   }
   include_once '../includes/functions.php';
   $obj=new agent_module($con);  
   $agent_markup= $_SESSION['agent']['log']['markup'];
   $admin_markup= $_SESSION['agent']['log']['bus_markup'];
   if(isset($_POST['search'])) 
   {
   	unset($_SESSION['agent']['bus']['origin']);
   	unset($_SESSION['agent']['bus']['destination']);
   	unset($_SESSION['agent']['bus']['travelDate']); 
   }
   $_SESSION['common']['pagename'] = "Bus"; 
   $_SESSION['common']['pagename1'] = "BusSearch"; 
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
   $_SESSION['agent']['bus']['origin_id']=$origin_id=$obj->getStationID($origin);
   $_SESSION['agent']['bus']['destination_id']=$destination_id=$obj->getStationID($destination);
   $other_data = 'Orgin : '.$origin.' <br/>Destination : '.$destination.' <br/>Travel Date : '.$travelDate.' <br/> Return Date : '.$returnDate.'<br/>Trip Type : '.$trip_type.' <br/>Booking Date : '.date("d/m/Y",time());
   $system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search Result','Page Enter',$other_data);
   $system_log = $obj->systemlogs($system_data);  $system_data='';
   include_once "../../bus/bus-library/SSAPICaller.php";
   include_once "../../bus/bus-library/BlockRequest.php";
   include('../../bus/bus-library/bus-soapClient.php');
   //$_SESSION['agent']['bus']['bus_result']=$results['availableTrips'];
   $bussql_1=$obj->getOunbusList(array($origin_id,$destination_id,1));
   /*echo "<pre>";
   print_r($bussql_1);
   echo "</pre>";*/
   $cnt=count($bussql_1);
   /* OWN BUS RESULT END */
   //if($cnt>0)
   if($cnt<0)
   {
   	foreach($bussql_1 as $row)
   	{
   		$array['APITYPE']='ownbus';
   		$array['AC']=$row[''];
   		$bus_id=$row['Bus_id'];
   		$dat=date('Y-m-d',strtotime(str_replace('/','-',$travelDate)));
   		$booked_seat = $obj->get_booked_seat(array($bus_id,$dat,1));
   		$total_seat = $obj->get_total_seat(array($bus_id,'xx',''));
   		if(count($booked_seat)!=0 && count($total_seat)!=0)
   		{
   			$available_seat = $total_seat-$booked_seat;
   		}
   		else
   		{
   			$available_seat=$total_seat;
   		}
   	$array['arrivalTime']=$row['arrivalTime'];
   	$array['availableSeats']=$available_seat;
   	$array['boardingTimes'][0]['address']=$row['Bus_boarding_time'];
   	$array['boardingTimes'][0]['bpId']=$row['Bus_boarding_time'];
   	$array['boardingTimes'][0]['contactNumber']=$row['Bus_boarding_time'];
   	$array['boardingTimes'][0]['landmark']=$row['Bus_boarding_time'];
   	$array['boardingTimes'][0]['location']=$row['Bus_boarding_time'];
   	$array['boardingTimes'][0]['prime']=$row['Bus_boarding_time'];
   	$array['boardingTimes'][0]['time']=$row['Bus_boarding_time'];
   	$busType=$obj->getOwnBusType(array($row['Bus_type'],1));
   	$array['busType']=$busType;
   	$array['busTypeId']=$row['Bus_type'];
   	$array['cancellationPolicy']=$row['cancellationpolicy'];
   	$array['departureTime']=$row['departTime'];
   	$array['destination']=$row['Bus_tocity'];
   	$array['doj']=$dat.'T00:00:00';
   	$array['droppingTimes']['address']=$row['Bus_departure_time'];
   	$array['droppingTimes']['bpId']=$row['Bus_departure_time'];
   	$array['droppingTimes']['bpName']=$row['Bus_departure_time'];
   	$array['droppingTimes']['contactNumber']=$row['Bus_departure_time'];
   	$array['droppingTimes']['landmark']=$row['Bus_departure_time'];
   	$array['droppingTimes']['location']=$row['Bus_departure_time'];
   	$array['droppingTimes']['prime']=$row['Bus_departure_time'];
   	$array['droppingTimes']['time']=$row['Bus_departure_time'];
   	$array['fareDetails']['baseFare']=$row['base_fare'];
   	$array['fareDetails']['markupFareAbsolute']=$row[''];
   	$array['fareDetails']['markupFarePercentage']=$row[''];
   	$array['fareDetails']['operatorServiceChargeAbsolute']=$row[''];
   	$array['fareDetails']['operatorServiceChargePercentage']=$row[''];
   	$array['fareDetails']['serviceTaxAbsolute']=$row[''];
   	$array['fareDetails']['serviceTaxPercentage']=$row[''];
   	$array['fareDetails']['totalFare']=$row[''];
   	$array['fares']=$row['base_fare'];
   	$array['id']=$row['Bus_id'];
   	$array['idProofRequired']=false;
   	if(isset($row['track_device']))
   	$tracking=false;
   	else
   	$tracking=true;
   	$array['liveTrackingAvailable']=$tracking;
   	$array['nonAC']=$row[''];
   	$array['operator']=$row[''];
   	$array['partialCancellationAllowed']=$row[''];	
   	$array['routeId']=$obj->getOwnBusRouteId(array($origin_id,$destination_id,1));
   	$array['seater']=$row[''];
   	$array['sleeper']=$row[''];
   	$array['source']=$row['Bus_fromcity'];
   	$array['tatkalTime']='0:00';
   	$array['travels']=$row['Bus_name'];
   	$array['vehicleType']=$row[''];
   	$array['zeroCancellationTime']=$row[''];
   	$array['mTicketEnabled']=true;
   	$results['availableTrips'][]=$array;
   }
   }
   $_SESSION['agent']['bus']['bus_result']=$results['availableTrips'];
   ?>
<!DOCTYPE html>
<html>
   <head>
      <?php  include_once '../includes/head1.php';   ?>
      <style type="text/css">
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
         .pad-top {
         padding-top:0px !important
         }		
         .sname{
         width:160px
         }
         .left{
         width: 42px !important
         } 	
      </style>
      <script type="text/javascript">
         //document.onkeydown = function (e) {  }
      </script>
   </head>
   <body>
      <?php include_once '../includes/top_menu.php'; ?>
      <div class="container-fluid">
         <div class="row-fluid">
            <?php include '../includes/leftmenu.php'; ?>
            <div class="span9" style="margin-left:0">
               <?php 
                  // Array Filtter Part
                    if(isset($results['availableTrips'][0]) && $results['availableTrips'][0]!='')
                  {
                  $tmp_travels = array_unique($tmp_travels,SORT_REGULAR);
                  //echo "<pre>"; print_r($tmp_travels); echo "</pre>";
                  
                  $tmp_busType = array_unique($tmp_busType,SORT_REGULAR);
                  
                  $tmp_bording_bpName = array_unique($tmp_bording_bpName,SORT_REGULAR);
                  
                  $tmp_dropping_bpName = array_unique($tmp_dropping_bpName,SORT_REGULAR);
                   //exit;
                  ?>
               <div class="span12" id="content">
                  <div class="row-fluid">
                     <div class="block">
                        <ul class="navSection_tabs clearfix">
                           <li class="navSection_Hdr hidden-sm hidden-xs">
                              <span>Filter:</span>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-bus1 ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Bus Travels</span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3"  style="font-size:12px !important;">
                                 <?php for($trC=0; $trC<count($_SESSION['fl_travels']); $trC++) { if(isset($_SESSION['fl_travels1'][$trC]) && $_SESSION['fl_travels1'][$trC]!='') { ?>
                                 <li><input id="Travels_filtter_<?php echo $trC; ?>" name="Travels_filtter[]" onClick="return filtterFunction();" class="Travels_filtter" value="<?php echo str_replace(')','',str_replace('(','',str_replace('.','_',str_replace('&','_',str_replace('/','_',str_replace(' ','_',$_SESSION['fl_travels1'][$trC])))))); ?>" type="checkbox"><span><?php echo $_SESSION['fl_travels1'][$trC]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-bus-seat ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Bus Type</span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3" style="font-size:12px !important;">
                                 <?php for($trC1=0; $trC1<count($_SESSION['fl_bustype']); $trC1++) { if(isset($_SESSION['fl_bustype1'][$trC1]) && $_SESSION['fl_bustype1'][$trC1]!='') { ?>
                                 <li><input id="Travels_Type_filtter_<?php echo $trC1; ?>" name="Travels_Type_filtter[]" onClick="return filtterFunction();" class="Travels_Type_filtter" value="<?php echo str_replace('.','_',str_replace('+','_',str_replace(')','_',str_replace('(','_',str_replace('&','_',str_replace('/','_',str_replace(' ','_',$_SESSION['fl_bustype1'][$trC1]))))))); ?>" type="checkbox"><span><?php echo $_SESSION['fl_bustype1'][$trC1]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-boarding ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Boarding Point</span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3" style="font-size:12px !important;">
                                 <?php for($trC2=0; $trC2<count($tmp_bording_bpName); $trC2++) { if(isset($tmp_bording_bpName[$trC2]) && $tmp_bording_bpName[$trC2]!='') { ?>
                                 <li><input id="Travels_Boarding_filtter_<?php echo $trC2; ?>" name="Travels_Boarding_filtter[]" onClick="return filtterFunction();" class="Travels_Boarding_filtter" value="<?php echo str_replace('&','_',str_replace('/','_',str_replace(' ','_',$tmp_bording_bpName[$trC2]))); ?>" type="checkbox"><span><?php echo $tmp_bording_bpName[$trC2]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-dropping ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Dropping Point </span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3" style="font-size:12px !important;">
                                 <?php for($trC3=0; $trC3<count($tmp_dropping_bpName); $trC3++) { if(isset($tmp_dropping_bpName[$trC3]) && $tmp_dropping_bpName[$trC3]!='') { ?>
                                 <li><input id="Travels_Droping_filtter_<?php echo $trC3; ?>" name="Travels_Droping_filtter[]"  onClick="return filtterFunction();" class="Travels_Droping_filtter" value="<?php echo str_replace('&','_',str_replace('/','_',str_replace(' ','_',$tmp_dropping_bpName[$trC3]))); ?>" type="checkbox"><span><?php echo $tmp_dropping_bpName[$trC3]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <?php } ?>
               <div class="span12" id="content" <?php  if(isset($results['availableTrips'][0]) && $results['availableTrips'][0]!='')
                  { ?>  <?php } ?>>
                  <div class="row-fluid">
                     <div class="block">
                        <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left modifytxt" style="cursor: pointer;">Modify Search For Bus</div>
                           <div class="muted srvdec"><?php echo ucfirst($_SESSION['agent']['bus']['origin'])." -> ".ucfirst($_SESSION['agent']['bus']['destination'])." (".$_SESSION['agent']['bus']['travelDate'].")"; ?></div>
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
                                             <input type="text" id="origin" class="input focused sname" name="origin" data-provide="typeahead" data-items="4" data-source='<?php echo $obj->getStation();  ?>' value="<?php echo $_SESSION['agent']['bus']['origin']; ?>" required >
                                          </div>
                                       </div>
                                    </div>
                                    <div class="span3">
                                       <div class="control-group">
                                          <label class="control-label left" for="destination">To: </label>
                                          <div class="controls tleft">
                                             <input type="text" id="destination" class="input focused sname" name="destination" data-provide="typeahead" data-items="4" data-source='<?php echo $obj->getStation();  ?>'  value="<?php echo $_SESSION['agent']['bus']['destination']; ?>"  required>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="span3">
                                       <div class="control-group">
                                          <input class="input sname focused datepicker" id="depart" name="depart"  type="text" placeholder="Depart Date" required value="<?php echo $_SESSION['agent']['bus']['travelDate']; ?>" />
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
               <div class="span12" id="content" style="margin-top:-2px">
                  <div class="row-fluid">
                     <div class="block">
                        <div class="block-content collapse in busser">
                           <div class="span12">
                              <div id="page-wrap">
                                 <?php 
                                    unset($_SESSION['fl_travels']);
                                    unset($_SESSION['fl_travels1']);
                                    
                                    unset($_SESSION['fl_bustype']);
                                    unset($_SESSION['fl_bustype1']);
                                    
                                    unset($_SESSION['fl_depart']);
                                    unset($_SESSION['fl_depart1']);
                                    
                                    unset($_SESSION['fl_arrival']);
                                    unset($_SESSION['fl_arrival1']);
                                    
                                    
                                    function sortByOrder($a, $b) {
                                       return $b['availableSeats'] - $a['availableSeats'];
                                    }
                                    if(isset($results['availableTrips'][0]) && $results['availableTrips'][0]!='')
                                    usort($results['availableTrips'], 'sortByOrder');
                                    if(isset($results['availableTrips'][0]) && $results['availableTrips'][0]!='')
                                    {	
                                    	foreach($results['availableTrips'] as $bus_result1) { 
                                    	$_SESSION['fl_travels'][] = $bus_result1['travels'];
                                    	$_SESSION['fl_bustype'][] =$bus_result1['busType'];
                                    	
                                    	for($a=0; $a<count($bus_result1['droppingTimes']); $a++)
                                    	{
                                    		$_SESSION['fl_depart'][$a] = $bus_result1['boardingTimes'][$a]['address'];
                                    		
                                    	}
                                    	
                                    	for($a1=0; $a1<count($bus_result1['boardingTimes']); $a1++)
                                    	{
                                    		//echo $bus_result1['boardingTimes']['bpName'];
                                    		$_SESSION['fl_arrival'][$a1] = $bus_result1['boardingTimes']['bpName'];
                                    		
                                    	}
                                    	
                                    	
                                    	}	
                                    	$_SESSION['fl_travels1'] = array_unique($_SESSION['fl_travels']);
                                    	$_SESSION['fl_bustype1'] = array_unique($_SESSION['fl_bustype']);
                                    	$_SESSION['fl_depart1'] = array_unique($_SESSION['fl_depart']);
                                    	$_SESSION['fl_arrival1'] = array_unique($_SESSION['fl_arrival']);
                                    }
                                    ?>
                                 <div id="users">
                                    <table id="bus">
                                       <thead>
                                          <!--<tr>
                                             <th colspan="6" align="right" valign="middle" style="text-align: right;"><input class="search" placeholder="Search Filtter" /></th>
                                             </tr>-->
                                          <tr id="topfilter">
                                             <th class="span3"><button class="sort" data-sort="sm_Travels">Travels</button>&nbsp; &nbsp; <button class="sort" data-sort="sm_Bus_Type">Bus Type</button>
                                             </th>
                                             <th class="span2">
                                                <button class="sort" data-sort="sm_Depart">Depart</button>
                                             </th>
                                             <th class="span2">
                                                <button class="sort" data-sort="sm_Arrival">Arrival</button>
                                             </th>
                                             <th class="span2">
                                                <button class="sort" data-sort="sm_Duration">Duration </button>
                                             </th>
                                             <th class="span1">
                                                <button class="sort" data-sort="sm_Seats">Seats</button>
                                             </th>
                                             <th class="span2" style="text-align:center">
                                                <button class="sort" data-sort="sm_Fare">Fare</button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody class="list">
                                          <?php if($results=='') { ?>
                                          <tr class="fitter">
                                             <td height="75" colspan="6" align="center" valign="middle">
                                                <div align="center" style="font-weight:bold; font-size:20px !important;">No Bus Available In This Route</div>
                                             </td>
                                          </tr>
                                          <?php }else {
                                             if(isset($results['availableTrips'][1])){
                                                 
                                             $i=1;
                                             $tmp_dropping_bpName = $tmp_travels = $tmp_busType = $tmp_depart = $tmp_arrival = $tmp_duration = $tmp_bordingPlace = $tmp_bording_bpName = $tmp_droppingPlace = array();
                                             foreach($results['availableTrips'] as $bus_result) {
                                             
                                             if(isset($bus_result['boardingTimes'][0]) && $bus_result['boardingTimes'][0]!='')
                                             {
                                             for($tm1=0; $tm1<count($bus_result['boardingTimes']); $tm1++)
                                             {
                                             $tmp_bordingPlace[] = $bus_result['boardingTimes'][$tm1]['location'];
                                             $tmp_bording_bpName[] = $bus_result['boardingTimes'][$tm1]['bpName'];
                                             }
                                             }
                                             else 
                                             {
                                             $tmp_bordingPlace[] = $bus_result['boardingTimes']['location'];	
                                             $tmp_bording_bpName[] = $bus_result['boardingTimes']['bpName'];
                                             }
                                             
                                             if(isset($bus_result['droppingTimes'][0]) && $bus_result['droppingTimes'][0]!='')
                                             {
                                             for($tm2=0; $tm2<count($bus_result['droppingTimes']); $tm2++)
                                             {
                                             $tmp_droppingPlace[] = $bus_result['droppingTimes'][$tm2]['location'];
                                             $tmp_dropping_bpName[] = $bus_result['droppingTimes'][$tm2]['bpName'];
                                             }
                                             }
                                             else 
                                             {
                                             $tmp_droppingPlace[] = $bus_result['droppingTimes']['location'];	
                                             $tmp_dropping_bpName[] = $bus_result['droppingTimes']['bpName'];
                                             }
                                             
                                             
                                             
                                             //echo"<pre>";print_r($tmp_droppingPlace);echo"</pre>"; 
                                             $tmp_travels[] = $bus_result['travels'];
                                             $tmp_busType[] = $bus_result['busType'];   ?>
                                          <tr class="fitter bus_filt <?php echo str_replace(')','',str_replace('(','',str_replace('.','_',str_replace('&','_',str_replace('/','_',str_replace(' ','_',$bus_result['travels'])))))); ?> <?php echo str_replace('+','_',str_replace(')','_',str_replace('(','_',str_replace('&','_',str_replace('/','_',str_replace(' ','_',$bus_result['busType'])))))); ?>  <?php if(isset($bus_result['boardingTimes'][0]) && $bus_result['boardingTimes'][0]!='') { for($tm11=0; $tm11<count($bus_result['boardingTimes']); $tm11++) { echo ' '.str_replace('&','_',str_replace('/','_',str_replace(' ','_',$bus_result['boardingTimes'][$tm11]['bpName']))); } } else { echo ' '.str_replace('&','_',str_replace('/','_',str_replace(' ','_',$bus_result['boardingTimes']['bpName']))); } ?>  <?php if(isset($bus_result['droppingTimes'][0]) && $bus_result['droppingTimes'][0]!='') { for($tm21=0; $tm21<count($bus_result['droppingTimes']); $tm21++) { echo ' '.str_replace('&','_',str_replace('/','_',str_replace(' ','_',$bus_result['droppingTimes'][$tm21]['bpName']))); } } else { echo ' '.str_replace('&','_',str_replace('/','_',str_replace(' ','_',$bus_result['droppingTimes']['bpName']))); } ?>">
                                             <td class="sm_Travels sm_Bus_Type">
                                                <?php echo $bus_result['APITYPE']; if($bus_result['liveTrackingAvailable']=='true') { ?>
                                                <a class="busIcon icon-bus_tracking" href="javascript:void(0)" ></a>
                                                <?php } else { ?>
                                                <a class="busIcon icon-bus" href="javascript:void(0)"></a> <?php } ?>
                                                <div class="detailsBlock busDataBlock">
                                                   <h4 class="BusName "><?php echo $_SESSION['fl_travels'][] = $bus_result['travels']; ?></h4>
                                                   <span class="BusType"><?php echo $_SESSION['fl_bustype'][] =$bus_result['busType']; ?></span>
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
                                             <td class="sm_Depart">
                                                <span style="display:none;">
                                                <?php echo $_SESSION['fl_depart'] =date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60)); ?></span>
                                                <span class="busDataBlock icon-time">&nbsp;</span>
                                                <a href="#" class="tooltip1"> 
                                                <span class="sub-title"><?php if(strpos($bus_result['departureTime'],'AM')==false && strpos($bus_result['departureTime'],'PM')==false)
                                                   $Depart_time = date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60));
                                                   else
                                                   $Depart_time = $bus_result['departureTime'];
                                                   echo $Depart_time;
                                                   ?></span>
                                                <span class="tip1">
                                                <img class="callout1" src="<?php echo $base_url; ?>images/callout.png" />
                                                <strong>Depature</strong>  
                                                </span>
                                                </a>
                                             </td>
                                             <td class="sm_Arrival">
                                                <span style="display:none;"><?php 
                                                   if(strpos($bus_result['arrivalTime'],'AM')==false && strpos($bus_result['arrivalTime'],'PM')==false) {
                                                   if (floor($bus_result['arrivalTime'] / 60) > 24)
                                                   {
                                                       $Arrive_time = date("g:i A", strtotime((floor(($bus_result['arrivalTime'] / 60) - 24) . ":" . $bus_result['arrivalTime'] % 60)));
                                                   } 
                                                   else
                                                   {
                                                       $Arrive_time = date("g:i A", strtotime(floor($bus_result['arrivalTime'] / 60) . ":" . $bus_result['arrivalTime'] % 60));
                                                   }
                                                   }
                                                   else
                                                   $Arrive_time = $bus_result['arrivalTime'];
                                                   echo strtotime($Arrive_time);
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
                                             <td class="sm_Duration">
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
                                             <td class="sm_Seats">
                                                <span class="busDataBlock icon-icon_lstSeat">&nbsp;</span>
                                                <span class="sub-title"><?php echo $bus_result['availableSeats']; ?> Seats</span>
                                             </td>
                                             <td class="sm_Fare">
                                                <span class="fareSpan"> <?php 
                                                   //echo $agent_markup.','.$admin_markup; 
                                                   if(is_array($obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup))) {
                                                         unset($fare_array); 
                                                         $bus_fare1=$obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup);
                                                         foreach($bus_fare1 as $fare) {
                                                          $fare_array[]=round($fare); 
                                                          }     
                                                       echo 'Rs. '.implode('/', $fare_array); } 
                                                       else echo 'Rs. '.round($obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup)); ?></span>
                                                <?php if($bus_result['availableSeats']!=0) { ?>
                                                <span><a class='book' title="<?php echo str_replace('&','*',$bus_result['travels']).'^'.str_replace('&','*',$bus_result['busType']).'^'.$Depart_time.'^'.$Arrive_time.'^'.$bus_result['availableSeats'].'^'.ucfirst($_SESSION['agent']['bus']['origin'])." -> ".ucfirst($_SESSION['agent']['bus']['destination'])." (".$_SESSION['agent']['bus']['travelDate'].")"; ?>" id="<?php if(isset($bus_result['APITYPE']) && ($bus_result['APITYPE']=='ownbus' || $bus_result['APITYPE']=='abhibus')) echo $bus_result['id'].'_'.$bus_result['APITYPE']; else echo $bus_result['id']; ?>" href="javascript:void(0);">Book</a></span>
                                                <?php
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                <span><a class='book1' id="<?php echo $bus_result['id']; ?>" href="javascript:void(0);">Soldout</a></span>
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
                                                               <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation allowed. </div>
                                                               <div style="clear:both;"></div>
                                                            </div>
                                                            <?php }
                                                               else {
                                                               ?>
                                                            <div id="divLabelPartialCancellation">
                                                               <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation not allowed. </div>
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
                                             //echo "<pre>"; print_r($_SESSION['fl_travels1']); echo "</pre>";
                                             
                                             }
                                             else
                                             { $i=1;	$bus_result=$results['availableTrips'];
                                              
                                                  ?>
                                          <tr class="fitter">
                                             <td class="sm_Travels sm_Bus_Type">
                                                <?php if($bus_result['liveTrackingAvailable']=='true') { ?>
                                                <a class="busIcon icon-bus_tracking" href="javascript:void(0)" ></a>
                                                <?php } else { ?>
                                                <a class="busIcon icon-bus" href="javascript:void(0)"></a> <?php } ?>
                                                <div class="detailsBlock busDataBlock">
                                                   <h4 class="BusName"><?php echo $bus_result['travels']; ?></h4>
                                                   <span class="BusType"><?php echo $bus_result['busType']; ?></span>
                                                   <span class="BusType"><?php echo $bus_result['depart']; ?></span>
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
                                             <td class="sm_Depart"><span style="display:none;"><?php echo strtotime(date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60))); ?></span>
                                                <span class="busDataBlock icon-time">&nbsp;</span><span class="sub-title"><?php echo $Depart_time=date("g:i A", strtotime(floor($bus_result['departureTime'] / 60) . ":" . $bus_result['departureTime'] % 60)); ?></span>
                                             </td>
                                             <td class="sm_Arrival"><span style="display:none;"><?php 
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
                                                    ?></span>
                                             </td>
                                             <td class="sm_Duration">
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
                                             <td class="sm_Seats">
                                                <span class="busDataBlock icon-icon_lstSeat">&nbsp;</span>
                                                <span class="sub-title"><?php echo $bus_result['availableSeats']; ?> Seats</span>
                                             </td>
                                             <td class="sm_Fare">
                                                <span class="fareSpan"> <?php 
                                                   if(is_array($obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup))) {
                                                         unset($fare_array); 
                                                         $bus_fare1=$obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup);
                                                         foreach($bus_fare1 as $fare) {
                                                          $fare_array[]=round($fare); 
                                                          }     
                                                       echo 'Rs. '.implode('/', $fare_array); } 
                                                       else echo 'Rs. '.round($obj->agentMarkup($bus_result['fares'],$agent_markup,$admin_markup)); ?></span>
                                                <?php if($bus_result['availableSeats']!=0) { ?>
                                                <span><a class='book' title="<?php echo str_replace('&','*',$bus_result['travels']).'^'.str_replace('&','*',$bus_result['busType']).'^'.$Depart_time.'^'.$Arrive_time.'^'.$bus_result['availableSeats'].'^'.ucfirst($_SESSION['agent']['bus']['origin'])." -> ".ucfirst($_SESSION['agent']['bus']['destination'])." (".$_SESSION['agent']['bus']['travelDate'].")"; ?>" id="<?php echo $bus_result['id']; ?>"  href="javascript:void(0);">Book</a></span>
                                                <?php
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                <span><a class='book1' id="<?php echo $bus_result['id']; ?>" href="javascript:void(0);">Soldout</a></span>
                                                <?php } ?>
                                                <div style='display:none;'>
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
                                                               <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation allowed. </div>
                                                               <div style="clear:both;"></div>
                                                            </div>
                                                            <?php }
                                                               else {
                                                               ?>
                                                            <div id="divLabelPartialCancellation">
                                                               <div class="redTextBold" style="text-align:left; float:left; border-top: 1px solid #ccc;display: block; width: 99%;">* Partial cancellation not allowed. </div>
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
                                              } 
                                              
                                             // print_r($_SESSION['fl_travels1']);
                                              ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /block -->
                  </div>
               </div>
            </div>
         </div>
        
         <?php 
            $error_logs.= "Page : Searchresult.php ,<br/>POST Value :".implode('^',$_POST)."<br/>Session Value : Common URL : ".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> Agent ID : ".$_SESSION['agent']['log']['id'];
            include '../includes/footer.php' ?>		
      </div>
         <div id="seat" class="white_content"  style="min-height:50%; height:auto;"></div>
      <div id="seat_block" class="black_overlay"></div>
      <!-- /container -->
    
      <script type="text/javascript">
         function showagentfun(val)
         {
         	if(val==1)
         	{
         		$('#showagentck').hide();
         		$('#showagentck1').show();
         		$('.showagent').show();	
         	}	
         	else
         	{
         		$('#showagentck1').hide();
         		$('#showagentck').show();
         		$('.showagent').hide();	
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
         function travelsdd() { $('#Ttravels_filtter').show(200); return true; }
         function bustypedd() { $('#bustype_filtter').show(200); return true; }
         function departdd() {  $('#depart_filtter').show(200);  return true; }
         function arrivaldd() {  $('#arrival_filtter').show(200);  return true; }
         function filtter1(val)
             { 
             alert(val);
                 var checkedString = $("input[name='arrival_ck[]']:checked").map(function() { return this.value; }).get().join();
                 checkedString1  = checkedString.split(',');
                 $('.fitter').hide(); 
                     if(checkedString1!='') 
                         { 
                             for(i=0; i<checkedString1.length; i++)
                                 {
                                     $('.'+checkedString1[i]).show();  	
                                 }
                                 $('#arrival_filtter').hide(200); 
                         }
                     else 
                         {
                             $('.fitter').show(); 	
                             $('#arrivalt_filtter').hide(200); 
                         }	
         return true;
         }
         function filtter2(val)
             { 
             alert(val);
                 var checkedString = $("input[name='depart_ck[]']:checked").map(function() { return this.value; }).get().join();
                 checkedString1  = checkedString.split(',');
                 $('.fitter').hide(); 
                     if(checkedString1!='') 
                         { 
                             for(i=0; i<checkedString1.length; i++)
                                 {
                                     $('.'+checkedString1[i]).show();  	
                                 }
                                 $('#depart_filtter').hide(200); 
                         }
                     else 
                         {
                             $('.fitter').show(); 	
                             $('#depart_filtter').hide(200); 
                         }	
         return true;
         }
         function filtter3(val)
             { 
             alert(val);
                 var checkedString = $("input[name='bustype_ck[]']:checked").map(function() { return this.value; }).get().join();
                 checkedString1  = checkedString.split(',');
                 $('.fitter').hide(); 
                     if(checkedString1!='') 
                         { 
                             for(i=0; i<checkedString1.length; i++)
                                 {
                                     $('.'+checkedString1[i]).show();  	
                                 }
                                 $('#bustype_filtter').hide(200); 
                         }
                     else 
                         {
                             $('.fitter').show(); 	
                             $('#bustype_filtter').hide(200); 
                         }	
         return true;
         }
         
         function filtter(val) 
             { 
                 var checkedString = $("input[name='travels_ck[]']:checked").map(function() { return this.value; }).get().join();
                 checkedString1  = checkedString.split(',');
                 $('.fitter').hide(); 
                     if(checkedString1!='') 
                         { 
                             for(i=0; i<checkedString1.length; i++)
                                 {
                                     //alert(checkedString1[i]); 
                                     $('.'+checkedString1[i]).show();  	
                                 }
                                 $('#Ttravels_filtter').hide(200); 
                         }
                     else 
                         {
                             $('.fitter').show(); 	
                             $('#Ttravels_filtter').hide(200); 
                         }	
         return true;
         }
         
         function hideDiv(e) {
             if (!$(e.target).is('#f1') && !$(e.target).parents().is('#f1')) {
                 $('#Ttravels_filtter').hide();
                 
             }
             
             if (!$(e.target).is('#f2') && !$(e.target).parents().is('#f1')) {
                 $('#bustype_filtter').hide();
                 
             }
             
         }
         $(document).on('click', function(e) {
             hideDiv(e);
         });
         
      </script>
      <script type="text/javascript">
         $(document).ready(function(){
              $(".book").click(function(){
                  var otherdata = $(this).prop("title");	
                  $('#seat').show();
         $('#seat').html('<div class="cssload-preloader"><div class="cssload-preloader-box"><div>S</div><div>E</div><div>A</div><div>R</div><div>C</div><div>H</div><div>I</div><div>N</div><div>G</div><div>&nbsp;</div><div>B</div><div>U</div><div>S</div></div></div>');
                  $('#seat_block').show();
                    var id=$(this).attr('id');
                    var check=id.split('_');
                    if(check[1]=='ownbus')
                    {
                         $.ajax({
                            type:"post",
                            url:"../../bus/ownbus_lib/seat-availability.php",
                            data:"id="+check[0]+"&otherdata="+otherdata,
                            success:function(data){
                               $("#seat").html(data);
                            }
                        });
                    }
                    else
                    {
                        $.ajax({
                            type:"post",
                            url:"../../bus/bus-library/seat-availability.php",
                            data:"id="+id+"&otherdata="+otherdata,
                            success:function(data){
                               $("#seat").html(data);
                            }
                        });
                    }
         
              });
         });
      </script>
      <script>
         function seat_check(val,val1,val2)
         {
         var jdate=val2;
         var xmlhttp;
         if (window.XMLHttpRequest)
           {
           xmlhttp=new XMLHttpRequest();
           }
         else
           {
           xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
           }
         xmlhttp.onreadystatechange=function()
           {
           if (xmlhttp.readyState==4 && xmlhttp.status==200)
             {
                 var arr=xmlhttp.responseText;
                 var det=arr.split("^");
                 //var seat=det[1].split("|");//alert(seat[0]);
                 document.getElementById("pass_detail").innerHTML=det[2];
                 document.getElementById("err_seat").innerHTML=data[0];
                 document.getElementById("err_seat1").innerHTML=data[1];
             }
           }
         xmlhttp.open("GET","../../bus/ownbus_lib/seat-fare.php?seat="+val+"&id="+val1+"&dat="+jdate,true);
         xmlhttp.send();
         }    
         function seat_display(val,vipval)
         {   
             seat_no = "seat_"+val;
             if($('#seat_'+val).is(':checked'))
             {
                 $('#seat_'+val).attr("checked", false);
                 
                 var array = $('#total_seats').val().split(",");
                     i1 = 0;
                     var a='';
                     for(var i= array.length - 2; i >=0; i--) 
                     {
                         if(array[i]==val) 
                 {
                             if(vipval==1) {
                                 alert("This is VIP seat");
                                 var vip_fare = parseInt(document.getElementById('vip_fare').value);
                                 var fare = vip_fare;
                             } else {
                                 var bus_fare = parseInt(document.getElementById('bus_fare').value);
                                 var fare = bus_fare;
                             }
                             tot='';
                             tot = $('#total_amt').val();
                             tot=tot-fare;
                             $('#total_amt').val(tot);
                                        
                         }
                         else 
                         {
                             if(array[i]!='' &&array[i]!='undefined')
                             {
                                 a=a+''+array[i].trim()+',';	
                             }
                         }
                     }
                     $('#total_seats').val(a.trim());
                         if(tot < 0){
                          tot=0; }	
             }
             else 
             {
                     $('input[type="checkbox"][name="'+seat_no+'"]').attr('checked', 'checked');
                     var s_no = document.getElementById(seat_no).value; 
                 
                     if(vipval==1) {
                         alert("This is VIP seat");
                         var vip_fare = parseInt(document.getElementById('vip_fare').value);
                         var fare = vip_fare;
                     } else {
                         var bus_fare = parseInt(document.getElementById('bus_fare').value);
                         var fare = bus_fare;
         
                     }
                     if(document.getElementById(seat_no).checked) {
         	var array = $('#total_seats').val().split(",");
         	document.getElementById('total_seats').value += s_no+",";
         	tot=tot+fare; 	
                     }
                     else
                     {
                         tot=tot-fare;
                         var arr = document.getElementById('total_seats').value;
                         var seatno = arr.split(",");
                         for( var i=0; i<seatno.length; i++ )
                         {
                             if(seatno[i] == s_no )			
                                seatno.splice(i,1);		
                         }		
                         document.getElementById('total_seats').value = seatno;		
                         if(tot < 0){
                          tot=0; }		 
                     }			
                     document.getElementById('total_amt').value = tot;	
             	}
         	}
         	
      </script>
      <script type="text/javascript">	
         function filtterFunction()
         {
             $('.bus_filt').hide();
             var checked = [];
             var datas = [];
             $("input[name='Travels_filtter[]']:checked").each(function () { checked.push($(this).val()); });
             $("input[name='Travels_Type_filtter[]']:checked").each(function () { checked.push($(this).val()); });
             $("input[name='Travels_Boarding_filtter[]']:checked").each(function () { checked.push($(this).val()); });
             $("input[name='Travels_Droping_filtter[]']:checked").each(function () { checked.push($(this).val()); });			
             if(checked.length>0)
             {
                 for(i=0; i<checked.length; i++)
                 {
                     $('.'+checked[i]).show();	
                 }
             }
             else 
             {
                 $('.bus_filt').show();
             }	
             return true;
         }
      </script>
   </body>
</html>
