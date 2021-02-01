<?php
include_once("../config/config.php");
include_once("../includes/functions.php") or die("File not Found");

if(isset($_REQUEST['tid']) && isset($_REQUEST['opt']))
{
 if($_REQUEST['opt'] == "c") {
 $del_sql=mysql_query("SELECT * FROM bookinginfo WHERE Ticket_ID='".$_REQUEST['tid']."'");
 $mail_seatcount=0;
		while($data_arr=mysql_fetch_array($del_sql))
		 {
		  $mail_seatcount++;
			 /* SERVICE PROVIDER CANCELLANTION CHARGES	*/
			
			$sp_sql=mysql_query("SELECT * FROM bookinginfo WHERE SeatNo='".$data_arr['SeatNo']."' AND Ticket_ID = '".$_REQUEST['tid']."'");
			$mail_seatno=$data_arr['SeatNo'].",";
			
			$sp_arr=mysql_fetch_array($sp_sql);
			$sp=$sp_arr['SP_id'];
			
			
			
			$cancel_chg_sql=mysql_query("SELECT * FROM cancellation_policies WHERE SP_id=".$sp." AND status=1 ORDER BY time DESC");		
			$bus_arr=mysql_fetch_array(mysql_query("SELECT * FROM businfo WHERE SP_id = ".$sp));
			if(count($bus_arr)>0){
			   $bus_fare=$bus_arr['Bus_fare'];
			}
			else{
			   $bus_fare=0;
			}
			
			#Check the date
			$cur_date=mktime(0, 0, 0, date("m"), date("d"),date("Y"));
            
			$tra=$sp_arr['travelling_date'];
			$str=explode("-",$tra);
			
			$tra_date=mktime(0, 0, 0, date($str[1])  , date($str[2]), date($str[0]));
			
			if($cur_date<=$tra_date){			 
			    	  $date1=strtotime(date("Y-m-d"));
	                  $date2=strtotime($tra);					  
					  $dateDiff = $date1 - $date2;   
					  if($dateDiff<0){
					    $dateDiff=$dateDiff * -1;
					  }  
                      $fullDays = floor($dateDiff/(60*60*24)); 					 
                      $calculatedhours=($fullDays*60*60*24)/(60*60);
					  
					  if($calculatedhours>0){
					    while($cancel_SPdata=mysql_fetch_array($cancel_chg_sql)){
						      $db_duration=$cancel_SPdata['duration'];
							  $db_time=$cancel_SPdata['time'];
							  					  						    
							  if($calculatedhours > $db_time){							     
							     $db_refundamt=$cancel_SPdata['refundable_amt'];	
							     $amt+=ceil($bus_fare*($db_refundamt/100));
								 break;
							 }
						}
					  }	 					  
			   }
			else{
			     echo "Your Ticket already Expired";
				 exit;
			   }
			  
			
			/********************************************/
			
			   $ins=mysql_query("INSERT INTO `cancelled_tickets` (`SP_id`, `Bus_id`, `SeatNo`, `travelling_date`, `cancelled_date`, `Ticket_id`, `userid`, `usertype`) SELECT SP_id,Bus_id,SeatNo,travelling_date,booked_date,Ticket_id,userid,usertype FROM bookinginfo WHERE SeatNo='".$data_arr['SeatNo']."' AND Ticket_ID = '".$_REQUEST['tid']."'") or die(mysql_error());			
			  $lastID=mysql_insert_id();
			  
			  mysql_query("UPDATE cancelled_tickets SET cancelled_date='".date('Y-m-d')."', refund_amt='".ceil($bus_fare*($db_refundamt/100))."' WHERE auto_id=".$lastID) or die(mysql_error());
			  
				$qry=mysql_query("DELETE from bookinginfo WHERE SeatNo='".$data_arr['SeatNo']."' and Ticket_ID = '".$_REQUEST['tid']."'") or die(mysql_error());	
				
					mysql_query("UPDATE passengerinfo set cancelledStatus='1' WHERE passenger_seatNo='".$data_arr['SeatNo']."' and Ticket_ID = '".$_REQUEST['tid']."' ");								
		}
		$mail_seatno=substr($mail_seatno,0,-1);
		
		$mail_bustype=get_bus_type($bus_arr['Bus_type']) ;
		$sp_name=get_SP($sp);
		$booker_name=get_booker($_REQUEST['tid']);
		$from_city=strtoupper(get_city_name($bus_arr['Bus_fromcity']));
		$to_city=strtoupper(get_city_name($bus_arr['Bus_tocity']));
		$cancel_date=date("d-m-Y");
		
		$tik_qry=mysql_fetch_array(mysql_query("SELECT * FROM bookinginfo,booker_details WHERE bookinginfo.Ticket_ID = '".$_REQUEST['tid']."' AND booker_details.Ticket_ID='".$_REQUEST['tid']."' AND bookinginfo.Ticket_ID=booker_details.Ticket_ID GROUP BY booker_details.Ticket_ID"));
				
		$booker_email=$tik_qry['Booker_email'];
		$booking_date=$tik_qry['booked_date'];
		$journey_date=$tik_qry['travelling_date'];
		
		$image = dirname($_SERVER[PHP_SELF]).'/images/'.$imglogo; 	
		
		$img = "http://$_SERVER[HTTP_HOST]".$image; 	
		
		
		$subject = "Cancelled Ticket Details - ".$title;        
		
            //ini_set(SMTP,"mail.i-netsolution.com");
            $headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:'.$website_name.'<'.$mail_url.'>' . "\r\n";		
		
		$msg='<table width="600" cellspacing="0" cellpadding="0" border="1" style="width: 525pt; background: none repeat scroll 0% 0% rgb(244, 158, 35); border: 6pt solid rgb(165, 220, 255);">
 <tbody><tr style="min-height: 70.5pt;">
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in; min-height: 70.5pt;">
  <p ><img src="$img" border="0" width="180" height="120"></p>
  </td>
 </tr>
 <tr>
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in;"></td>
 </tr>
 <tr>
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in;">
  <table width="100%" cellspacing="10" cellpadding="0" border="1" style="width: 100%; background: none repeat scroll 0% 0% rgb(243, 251, 255); border: 1pt solid rgb(183, 227, 255);">
   <tbody><tr>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" width="175" valign="top" style="width: 131.25pt; border: medium none; padding: 7.5pt;">
    <p ><b>Ticket Number</b></p>    </td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td width="150" valign="top" style="width: 115.5pt; border: medium none; padding: 7.5pt;"  nowrap="nowrap">
    <p>'.$_REQUEST["tid"].'</p>    </td>
    <td width="50" valign="top" style="width: 37.5pt; border: medium none; padding: 7.5pt;"></td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;"></td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;" nowrap="nowrap">
    <p ><b>Service Provider &amp; Type</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$sp_name.'&'.$mail_bustype.'</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Booker Name & Email</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.ucfirst($booker_name).' & '.$booker_email.'</p>    </td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td width="175" valign="top" style="width: 131.25pt; border: medium none; padding: 7.5pt;">
    <p ><b>From</b></p>    </td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;"  nowrap="nowrap">
    <p >'.$from_city.'</p>    </td>
    <td width="50" valign="top" style="width: 37.5pt; border: medium none; padding: 7.5pt;"></td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;">
    <p ><b>To</b></p>    </td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;"  nowrap="nowrap">
    <p >'.$to_city.'</p>    </td>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">

    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Date of Cancellation </b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$cancel_date.'</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Date of Journey</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$journey_date.'</p>    </td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="nowrap" valign="top" style="border: medium none; padding: 7.5pt;"><p ><b>Fare per Ticket</b></p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >:</p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >Rs.'.$bus_fare.' </p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="nowrap" valign="top" style="border: medium none; padding: 7.5pt;"><p ><b>Date of Booking </b></p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >:</p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >'.$booking_date.'</p></td>
    <td style="border: medium none; padding: 7.5pt;"></td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Seat Number(s)</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$mail_seatno.' </p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">Percentage of Cancellation</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">'.$db_refundamt.' %</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Total Amount</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p> Rs.'.$amt.' </p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
  </tbody></table>
  </td>
 </tr>
 <tr style="min-height: 57.75pt;">
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in 0in 0in 15pt; min-height: 57.75pt;">
  <p style="line-height: 13.5pt;"><span style="font-size: 8.5pt; color: black;">Regards,<br>
  '.$siteteam.' </span></p>
  </td>
 </tr>
 <tr>
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in;"></td>
 </tr>
 <tr style="min-height: 30pt;">
  <td style="border: medium none; background: none repeat scroll 0% 0% rgb(165, 220, 255); padding: 0in; min-height: 30pt;">
  <p align="right" style="text-align: right;" ><span style="font-size: 7.5pt; color: black;">&copy;
  Copyright 2013 <b><i>'.$siteteam.'</i></b>. </span><span style="font-size: 7.5pt;"></span></p>
  </td>
 </tr>
</tbody></table>';
mail($booker_email,$subject,$msg,$headers);
		
echo "Successfully Cancelled.";
   } // cancel
   
   if($_REQUEST['opt'] == 'd'){
      $ticket=mysql_real_escape_string($_REQUEST['tid']);
	  $up_booker=mysql_query("UPDATE booker_details SET delete_status = 0 WHERE Ticket_ID='".$ticket."'") or die(mysql_error());
	  $up_psr=mysql_query("UPDATE passengerinfo SET delete_status = 0 WHERE Ticket_ID ='".$ticket."'") or die(mysql_error());
	  echo "Successfully Deleted.";
   }
}

?>