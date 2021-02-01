<?php
session_cache_limiter("private, must-revalidate");
session_start();
ob_start();
ini_set('max_execution_time', 3000);
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors',0);

session_cache_expire(15);
$cache_expire = session_cache_expire();

// ?hid_Busid=58&hid_date=2016-6-17&triptype=1

require_once("../config/config.php");
include_once("../includes/functions.php");

$filename = basename($_SERVER["PHP_SELF"], ".php");	

	if(isset($_SESSION["comp_id"]))
	{
		$agent_id = $_SESSION["comp_id"];
	}
	elseif( isset($_SESSION["user_id"]) ){
		$user_id = $_SESSION["user_id"];
		$usrdata=getUserData($user_id);
	}
	
	if( isset($_SESSION["comp_name"]) ){
		$ag_name = $_SESSION["comp_name"];
	}
	elseif( isset($_SESSION["user_name"]) ){
		$user_name = $_SESSION["user_name"];
	}
	
	if( isset($_SESSION["comp_email"]) ){
		$ag_email = $_SESSION["comp_email"];
	}
	elseif( isset($_SESSION["user_email"]) ){
		$user_email = $_SESSION["user_email"];
	}
	
/*	print_r($_REQUEST);
	exit;*/
	
 
   $_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);	
   $Bus_id=mysql_real_escape_string($_REQUEST['hid_Busid']);
   $dat=mysql_real_escape_string($_REQUEST['hid_date']);
   $triptype=mysql_real_escape_string($_REQUEST['triptype']);	
   
   $dat_str=explode("-",$dat);
  
   if($dat_str[2]<10){
      $dat_str[2]="0".$dat_str[2];
   }

   if($dat_str[1]<10){
      $dat_str[1]="0".$dat_str[1];
   }
	
	$dat=$dat_str[0]."-".$dat_str[1]."-".$dat_str[2];
	$sels= "SELECT * FROM businfo where Bus_id=$Bus_id";
						$query = mysql_fetch_array(mysql_query($sels));
						$from_city = $query['Bus_fromcity'];
							//$fcity = get_city_name($fcity_id);
						$to_city = $query['Bus_tocity'];
						$Bus_type = $query['Bus_type'];
						$sel2 = "SELECT * FROM bustypes WHERE typeID ='$Bus_type'";
						$qry2 = mysql_query($sel2);
						$res2 = mysql_fetch_object($qry2);
						$Bus_type = $res2->typeName;
						$typeFind = strpos(strtoupper($Bus_type),'SLEEPER');
						
						if($typeFind>0)
						{
							$Bus_type = 'Sleeper';	
						}
						else 
						{
							$Bus_type = 'normal';	
						}
						$boarding_point = explode(",",$query['Bus_boarding_time']);
						$_SESSION['action']=0;

?>
<?php
if(isset($_SESSION['ticket_id'])){
		 unset($_SESSION['book_var']);         
		 unset($_SESSION['ticket_id']);
}
?>
<script type="text/javascript" src="../js/jquery.min2.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
									<?php 
									$booked_seat = get_booked_seats($Bus_id,$dat);
 $cnt=count($booked_seat);
for($j=0;$j<1;$j++){$json2[$j]['booked_seat_count']=$cnt;} 

 
for($i=0;$i<$cnt;$i++){
$json2[$i]['booked_seat'] = $booked_seat[$i];
}
									
//echo "<br/><br/><pre>"; print_r($booked_seat); echo "</pre>";
//print_r($booked_seat);
//echo "<br/><br/>-----------------------------------------------------------------------------<br/><br/>";


									
									
									$sdate=explode("-",$dat);
									$day=$sdate[2];
									$mon=$sdate[1];
									$year=$sdate[0];
									$nor="not yet";
									$vip="not yet";
									
										 $r=0;
										 for($i=1;$i<=5;$i++){
										 for($j=1;$j<=10;$j++){
											$r=$r+1;
								
			$sel = mysql_query("select seat_no,vip from bus_structure where bus_id = '$Bus_id' and position = '$r' ");
			$row=mysql_fetch_array($sel);
			
			
			
		$seatno1[] = $seatno=$row['seat_no'];

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
                                    <?php if($nor=='set') { ?>
									
                                    <?php $nor=''; } 
									
									if($vip=='set') {
									?>
                                    
                                    <?php $vip=''; } ?>			
                                    					
					<?php 
					if($row['seat_no']!="xx") {
						
						if($row['vip']==1)
						{
						  }
						 else 
						 {
						 }
						  } 
						  else 
						  { 
						   }
									if(count($booked_seat) > 0){
									 if(!in_array($row['seat_no'],$booked_seat)) 
									 {  
									  $blockseat=mysql_fetch_array(mysql_query("select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'"));
									  echo  $block_status=$blockseat['Blocked'];
									 if($row['seat_no']!="xx")
			                          { 
									  ?>									
<?php } }
									else {
									      //$gender=getPsr_Gender($Bus_id,$dat,$row['seat_no'],$Bus_type);
									}
									 ?>
									<?php
											}
											else
											{
									  $blockseat=mysql_fetch_array(mysql_query("select * from bookinginfo where Bus_id='$Bus_id' and travelling_date='$dat' and SeatNo='$row[seat_no]' and SP_id='$query[SP_id]'"));
									  $block_status=$blockseat['Blocked'];
									  
											  if($row['seat_no']!="xx")
			                                  {
																	       
									 		  }
											}											
											}
										}	
										
//echo "<br/><br/><pre>"; print_r($seatno1); echo "</pre>";
//echo "<br/><br/>-----------------------------------------------------------------------------<br/><br/>";
echo json_encode($seatno1,1);
 

for($b=0; $b<count($boarding_point); $b++) 
 {															
	$json2[$b]['boardingpoint'] =  $boarding_point[$b]; 
} 

//echo "<br/><br/><pre>"; print_r($boardingpoint1); echo "</pre>";
//echo "<br/><br/>-----------------------------------------------------------------------------<br/><br/>";
echo json_encode($json2,1); 

?>


