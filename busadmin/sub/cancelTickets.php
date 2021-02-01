<?php
session_start();
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
if(isset($_REQUEST['successproc']))
{
	echo "succesfully approved refund";
}
if(isset($_POST['page']))
{

$arr=general_Settings();
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = $arr['paginate_value'];
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

//$query = "SELECT * FROM bookinginfo as bi, serviceprovider_info as spi , users as usr , passengerinfo as psr , businfo as bus,cities as city where bi.Ticket_ID=psr.Ticket_ID and bi.SP_id = spi.SP_id and bi.Bus_id=bus.Bus_id ";

 $query="SELECT * FROM booker_details,cancelled_tickets,serviceprovider_info WHERE cancelled_tickets.Ticket_id=booker_details.Ticket_id AND cancelled_tickets.SP_id=serviceprovider_info.SP_id AND cancelled_tickets.SP_id='$_SESSION[SP_id]'";


if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query .=" AND ";
  //$query.=" serviceprovider_info.SP_name LIKE '%".$search."%'";
}

  $all = $_REQUEST['status'] ;
  
  $val = explode('^^',$all) ;
  
  $ticket =  $val[0] ;
  $cdate  =  $val[1];
  $tdate  =  $val[2] ;
  
  if($ticket!='')
  {
 
  $query .=" AND ";
   
  $query .=" cancelled_tickets.Ticket_ID like '%".$ticket."%'";
  } 

  if($cdate!='')
   {
    $query.=" AND ";
	$query .=" cancelled_tickets.cancelled_date ='".changedateformat($cdate)."'";
   }
 
  if($tdate!='')
  { 
  $query .=" AND ";
   
  $query .=" cancelled_tickets.travelling_date = '".changedateformat($tdate)."'";
  } 

	$query .= " group by cancelled_tickets.Ticket_ID ";
    $qry=$query;
	$query.="LIMIT $start, $per_page";

$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());

$msg = "";

$msg .='<div class="data">

<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tr>
  	<th align="left" nowrap="nowrap">Ticket Number</th>
    <th nowrap="nowrap">Provider Name</th>
	<th nowrap="nowrap">Cancel Date</th>
    <th nowrap="nowrap">Travel Date</th>
	<th nowrap="nowrap">Refund Amt (RS.)</th>
	<th nowrap="nowrap">Booking Amt (RS.)</th>
    <th nowrap="nowrap">No. of Seats</th>
	<th nowrap="nowrap">Refund</th>	
	<th nowrap="nowrap">Action</th>	
  </tr>';
  
  if(mysql_num_rows($result_pag_data)>0)
  {
    $count=mysql_num_rows($result_pag_data);
		while($row = mysql_fetch_array($result_pag_data)) 
		{			
			
		$sp_id=$row['SP_id'];
		
		$usr_id=$row['user_id'];
		$bus_id=$row['Bus_id'];
		$sp_name=$row['SP_name'];		
		
		$cancelled_date=$row['cancelled_date'];
			
		$travelling_date=$row['travelling_date'];		
		$booking_amt=$row['booking_amt'];	
		$ticket=$row['Ticket_ID'];
		
		$bemail=$row['Booker_email'];
		
		$selectbus=mysql_fetch_array(mysql_query("SELECT * FROM businfo WHERE Bus_id=".$bus_id));
		$fromcity=$selectbus['Bus_fromcity'];
		$tocity=$selectbus['Bus_tocity'];
		
		$canceltickets_qry=mysql_query("SELECT * FROM cancelled_tickets WHERE Ticket_id='".$ticket."'");
		$cancelcount=mysql_num_rows($canceltickets_qry);
		$refund_amt	= $row['refund_amt'];
		
		$refund_sum=mysql_fetch_array(mysql_query("SELECT sum(refund_amt) as amtt,sum(book_amt) as bamtt FROM cancelled_tickets WHERE Ticket_id='".$ticket."'"));
		
		$info=mysql_fetch_array(mysql_query("select * from cancelled_tickets where Ticket_id='$ticket' "));
/*echo $info['userid'];*/
$bookerinfo= mysql_fetch_array(mysql_query("select * from  booker_details where Ticket_ID='$ticket' "));



			if($row['cancelled_status']=='0')
		{
		$refund="Pending";
		}
		else if($row['cancelled_status']=='2')
		{
		$refund="Transfer";
		}
		else{
		$refund="Pending";
		 }	
		$msg.='<tr>
					
			<td align="left" nowrap="nowrap"><a href="ticket_view.php?ticket='.$ticket.'&travel_date='.$travelling_date.'&Bus_id='.$row['Bus_id'].'&SP_id='.$row['SP_id'].'&email='.$bemail.'" class="link1">'.$ticket.'</a></td>	
			
			
					
			<td align="left" nowrap="nowrap">
				<a href="view_providers.php?sp_id='.$sp_id.'" class="link1">'.ucwords($sp_name).'</a>
			</td>	
						
			<td align="left" nowrap="nowrap">'.changedateformat($cancelled_date).'</td>
			<td align="left" nowrap="nowrap">'.changedateformat($travelling_date).'</a></td>
			
			<td align="center" nowrap="nowrap">'.$refund_sum['amtt'].'</td>
			<td align="center" nowrap="nowrap">'.$refund_sum['bamtt'].'</td>
			
			<td align="center">'.$cancelcount.'			
			</td>
			<td align="center">'.$refund.'</td>
			
			
			<td align="left" nowrap="nowrap">
			<a href="cancel_seats.php?ticket_no='.$ticket.'&dat='.$travelling_date.'&fromcity='.$fromcity.'&tocity='.$tocity.'&SP_id='.$row['SP_id'].'" class="link1">view</a>
			</td>
		  </tr>';		 
		}
    }
	else {
            $msg.='<tr>
			<td align="center" colspan="6"><span class="err_msg">No Records Found.</span></td>
		    </tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data

/* --------------------------------------------- */


$result_pag_num = mysql_query($qry);

//echo $result_pag_num ; exit ;$count

$row = mysql_fetch_array($result_pag_num);
$count =mysql_num_rows($result_pag_num);
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and ending values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<br><div style='width:700px; float:left;'><div class='pagination'><table border='0' align='center'><tr>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<td p='1' class='active'>First</td>";
} else if ($first_btn) {
    $msg .= "<td p='1' class='inactive'>First</td>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<td p='$pre' class='active'>Previous</td>";
} else if ($previous_btn) {
    $msg .= "<td class='inactive'>Previous</td>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<td p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</td>";
    else
        $msg .= "<td p='$i' class='active'>{$i}</td>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<td p='$nex' class='active'>Next</td>";
} else if ($next_btn) {
    $msg .= "<td class='inactive'>Next</td>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<td p='$no_of_paginations' class='active'>Last</td>";
} else if ($last_btn) {
    $msg .= "<td p='$no_of_paginations' class='inactive'>Last</td>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;' onkeydown='return isNumberKey(event)' /><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=200px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />