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
require_once("../config/config.php");
include_once("..includes/functions.php");
$_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);
$dat=date("Y-m-d",strtotime($_REQUEST["datepicker"]));
		$bus_id1 =  $_GET[bus_id];
				$mqry   = "SELECT * FROM businfo  WHERE Bus_status = 1 and Bus_id ='$bus_id1' "; 
$mem_rs = mysql_query($mqry);
$json =  array();
$a=0;

while($row = mysql_fetch_assoc($mem_rs))
	{               $bus_id=$row['Bus_id'];
                        $nor="not yet";
									$vip="not yet";
									
										 $r=0;
										 for($i1=1;$i1<=5;$i1++){
										 for($j1=1;$j1<=10;$j1++){
											$r=$r+1;
								
			$sel = mysql_query("select seat_no,vip from bus_structure where bus_id = '$bus_id' and position = '$r' ");
			$row1=mysql_fetch_array($sel);
		$seatno1[] = $seatno=$row1['seat_no'];

								if(count($booked_seat) > 0){
									 if(!in_array($row['seat_no'],$booked_seat)) 
									 {  
									  $blockseat=mysql_fetch_array(mysql_query("select * from bookinginfo where Bus_id='$bus_id' and travelling_date='$dat' and SeatNo='$row1[seat_no]' and SP_id='$row[SP_id]'"));
									  echo  $block_status=$blockseat['Blocked'];
									  }
									else {
									      //$gender=getPsr_Gender($Bus_id,$dat,$row['seat_no'],$Bus_type);
									}
									 ?>
									<?php
											}
											else
											{
									  $blockseat=mysql_fetch_array(mysql_query("select * from bookinginfo where Bus_id='$bus_id' and travelling_date='$dat' and SeatNo='$row1[seat_no]' and SP_id='$row[SP_id]'"));
									  $block_status=$blockseat['Blocked'];
									  
											 
											}	
											
																					
											}
										}	

	            
                         
                        $booked_seat = get_booked_seats($row['Bus_id'],$dat);
                        $cnt1=count($booked_seat);
                        
                        for($j=0;$j<$cnt1;$j++){
                         if($j==0){$booked_seats.= $booked_seat[$j];}else{
                         $booked_seats.= ','. $booked_seat[$j];}
                        }
                       $cnt=count($seatno1);
                        for($i=0;$i<50;$i++){
							$json[$i]['position']=$i+1;
							$json[$i]['seat']=$seatno1[$i];
							for($j=0;$j<$cnt1;$j++){
                             if($seatno1[$i]==$booked_seat[$j]){
								 $json[$i]['status']="booked";
								 }
							}
							if($json[$i]['status']!="booked"){$json[$i]['status']="available";}
							if($json[$i]['status']=="booked"){
							$ticket_sql=mysql_query("SELECT Ticket_ID FROM bookinginfo WHERE Bus_id=".$bus_id." AND SeatNo='".$seatno1[$i]."' AND travelling_date='".$dat."'");
  if(mysql_num_rows($ticket_sql)>0){
       while($r1=mysql_fetch_array($ticket_sql)){
       $gen_sql=mysql_query("SELECT passenger_Gender FROM passengerinfo WHERE Ticket_ID='".$r1['Ticket_ID']."' AND passenger_seatNo='".$seatno1[$i]."'");
	     if(mysql_num_rows($gen_sql)>0){
		    while($r2=mysql_fetch_array($gen_sql)){
			      $res=$r2['passenger_Gender'];
				  $json[$i]['gender']=$res;
				  }
		 }
	   }
  }
							}
							$json[$i]['Bus_fare'] = $row['Bus_fare']; 
				
				
				
						
                        }
                        
	}
	//echo $booked_seats;
echo "<pre>";
print_r($json);
//echo json_encode($json,1);
				



?>


