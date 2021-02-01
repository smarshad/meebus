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



?>
















<?php 
		
				 
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

			if(($row['vip']==1) && ($vip!=''))
			{
				$vip_rate = $row['vip_fare'];
				$vip='set';
			}
			else if(($row['vip']==0) && ($nor!=''))
			{
				$normal_rate = $row['Bus_fare']; 
				$nor='set';
			}
			?>
                                    <?php if($nor=='set') { ?>
									
                                    <?php $nor=''; } 
									
									if($vip=='set') {
									?>
                                    
                                    <?php $vip=''; } ?>			
                                    					
					<?php 
					if($row1['seat_no']!="xx") {
						
						if($row1['vip']==1)
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
									  $blockseat=mysql_fetch_array(mysql_query("select * from bookinginfo where Bus_id='$bus_id' and travelling_date='$dat' and SeatNo='$row1[seat_no]' and SP_id='$row[SP_id]'"));
									  echo  $block_status=$blockseat['Blocked'];
									 if($row1['seat_no']!="xx")
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
									  $blockseat=mysql_fetch_array(mysql_query("select * from bookinginfo where Bus_id='$bus_id' and travelling_date='$dat' and SeatNo='$row1[seat_no]' and SP_id='$row[SP_id]'"));
									  $block_status=$blockseat['Blocked'];
									  
											  if($row1['seat_no']!="xx")
			                                  {
																	       
									 		  }
											}											
											}
										}	

	               $json[$a]['id'] = $row['Bus_id'];
			//$json[$a]['Bus_type'] = $row['Bus_type'];
			//$json[$a]['Bus_structure'] = $row['Bus_structure']; 
			//$json[$a]['Bus_name'] = $row['Bus_name'];
			$json[$a]['Bus_boarding_time'] = $row['Bus_boarding_time']; 
			//$json[$a]['Bus_departure_time'] = $row['Bus_departure_time'];
			$json[$a]['Bus_fare'] = $row['Bus_fare']; 
			//$json[$a]['vip_fare'] = $row['vip_fare'];
			//$json[$a]['Bus_totalseats'] = $row['Bus_totalseats']; 
			$json[$a]['Boarding_points'] = $row['Bus_boarding_time'];
                         
                        $booked_seat = get_booked_seats($row['Bus_id'],$dat);
                        $cnt1=count($booked_seat);
                        $json[$a]['booked_seat_count'] = $cnt1;
                        for($j=0;$j<$cnt1;$j++){
                         if($j==0){$booked_seats.= $booked_seat[$j];}else{
                         $booked_seats.= ','. $booked_seat[$j];}
                        }
                       $cnt=count($seatno1);
                        for($i=0;$i<10;$i++){
                         if($i==0){$seatnos.= $seatno1[$i];}else{
                         $seatnos.= ','. $seatno1[$i];}
                        }
                        for($i=10;$i<20;$i++){
                         if($i==10){$seatnos2.= $seatno1[$i];}else{
                         $seatnos2.= ','. $seatno1[$i];}
                        }
                        for($i=20;$i<30;$i++){
                         if($i==20){$seatnos3.= $seatno1[$i];}else{
                         $seatnos3.= ','. $seatno1[$i];}
                        }

                        for($i=30;$i<40;$i++){
                         if($i==30){$seatnos4.= $seatno1[$i];}else{
                         $seatnos4.= ','. $seatno1[$i];}
                        }

                        for($i=40;$i<50;$i++){
                         if($i==40){$seatnos5.= $seatno1[$i];}else{
                         $seatnos5.= ','. $seatno1[$i];}
                        }
                        $json[$a]['booked_seat'] = $booked_seats;
                       // $json[$a]['Bus_availableseats'] = $row['Bus_totalseats']-$cnt;
                        $json[$a]['Bus_structure10']=$seatnos;
                        $json[$a]['Bus_structure20']=$seatnos2;
                        $json[$a]['Bus_structure30']=$seatnos3;
                        $json[$a]['Bus_structure40']=$seatnos4;
                        $json[$a]['Bus_structure50']=$seatnos5;    
                      //  $booked_seats='';
			$a++;
	}
	//echo $booked_seats;
echo json_encode($json,1);
				



?>


