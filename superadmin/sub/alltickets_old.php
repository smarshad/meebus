<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

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

$search_SPname=mysql_real_escape_string($_REQUEST['search']);
$otherparts=explode("|",$_REQUEST['status']);
$search_ticket=mysql_real_escape_string($otherparts[0]);
$search_date=mysql_real_escape_string($otherparts[1]);
$search_from=mysql_real_escape_string($otherparts[2]);
$search_to=mysql_real_escape_string($otherparts[3]);

//$query="SELECT * FROM booker_details WHERE delete_status=1 GROUP BY Ticket_ID ORDER BY booker_id";
$fx=0;
$query="SELECT bookinginfo.Ticket_ID,bookinginfo.travelling_date,bookinginfo.SP_id,bookinginfo.Bus_id,booker_details.Booker_name FROM bookinginfo,serviceprovider_info,businfo,booker_details WHERE bookinginfo.Ticket_ID!='' AND  bookinginfo.Ticket_ID=booker_details.Ticket_ID ";
if(!empty($search_ticket)){
   $query.=" AND bookinginfo.Ticket_ID='".$search_ticket."'";
}

if(!empty($search_SPname)){
   $query.=" AND bookinginfo.SP_id=serviceprovider_info.SP_id AND serviceprovider_info.SP_name LIKE '%".$search_SPname."%'";
}

if(!empty($search_date)){
  $query.=" AND bookinginfo.travelling_date='".changedateformat($search_date)."'";
}

if(!empty($search_from)){
   $query.=" AND bookinginfo.Bus_id=businfo.Bus_id AND businfo.Bus_fromcity=".$search_from;
}

if(!empty($search_to)){
   $query.=" AND bookinginfo.Bus_id=businfo.Bus_id AND businfo.Bus_tocity=".$search_to;
}

    $qry=$query." GROUP BY bookinginfo.Ticket_ID";
	$query.=" ORDER BY bookinginfo.travelling_date DESC LIMIT $start, $per_page";


$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());

$msg = "";

$msg .='<div class="data">
<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tr>
  	<th nowrap="nowrap">Ticket Number</th>
    <th nowrap="nowrap">Provider Name</th>
    <th nowrap="nowrap">Booker Name</th>
    <th nowrap="nowrap">Travel Date</th>
	<th nowrap="nowrap">From - To</th>
	<th nowrap="nowrap">Fare</th>
    <th nowrap="nowrap">No.of Seats</th>
	<th nowrap="nowrap">User Type</th>
	<th nowrap="nowrap">Status</th>
	<th nowrap="nowrap">Delete</th>
  </tr>';
  
  if(mysql_num_rows($result_pag_data)>0)
  {
    $count=mysql_num_rows($result_pag_data);
  		while($row = mysql_fetch_array($result_pag_data)) 
		{			
		  $tik=$row['Ticket_ID'];	
		  
		  $sp_str="SELECT * FROM bookinginfo,cancelled_tickets WHERE bookinginfo.Ticket_ID='".$tik."' OR cancelled_tickets.Ticket_id='".$tik."'";
		  	
		$sp_sql=mysql_fetch_array(mysql_query("SELECT * FROM bookinginfo,cancelled_tickets WHERE bookinginfo.Ticket_ID='".$tik."' OR cancelled_tickets.Ticket_id='".$tik."'"));		
		$sp_id=$row['SP_id'];	
		
		$usr_id=$sp_sql['user_id'];		
		
		$sp_name=get_SP($sp_id);

		$booker= $row['Booker_name'];
			
		$travelling_date=$row['travelling_date'];
		
		$ticket=$tik;		
		
		$scount1 = mysql_fetch_array(mysql_query("select count(*) from passengerinfo where Ticket_ID = '$ticket' AND delete_status=1"));
		
		$scount = $scount1[0] ;			
		
		$businfo=mysql_fetch_array(mysql_query("SELECT * FROM businfo WHERE Bus_id=".$row['Bus_id']));		
		
		$fare = $scount * $businfo['Bus_fare'] ; 

		$frm = $businfo['Bus_fromcity'] ;
		
		$scount12 = mysql_fetch_array(mysql_query("select * from cities where id = '$frm'"));
		
		$fcity = ucwords($scount12['city_name']) ;
		
		$to = $businfo['Bus_tocity'] ;
		
		$scount13 = mysql_fetch_array(mysql_query("select * from cities where id = '$to'"));
		
		$tcity = ucwords($scount13['city_name']) ;
		
		$utype= $sp_sql['usertype'];
		
		$sql = mysql_fetch_array(mysql_query("select * from usertypes where usertype_id='$utype'")) ;
		
		$utype= $sql['usertype_name'];
				
		$booked_date="";	
			
		$msg.='<tr>			
			<td align="left" nowrap="nowrap">
			<!--<a href="view_seats.php?ticket_no='.$ticket.'&dat='.$travelling_date.'&fromcity='.$row['Bus_fromcity'].'&tocity='.$row['Bus_tocity'].'&SP_id='.$row['SP_id'].'" class="link1">-->'.$ticket.'<!--</a>-->
				<!--<a href="view_ticket.php?ticket='.$ticket.'&tdate='.$travelling_date.'" class="link1">'.$ticket.'</a>-->
			</td>
			
			<td align="left" nowrap="nowrap">
				<a href="view_providers.php?sp_id='.$sp_id.'" class="link1">'.ucwords($sp_name).'</a>
			</td>
			
			<td align="left" nowrap="nowrap">
				<a href="view_member.php?memid='.$usr_id.'" class="link1">'.ucwords($booker).'</a>
			</td>	
			
			<td align="left" nowrap="nowrap">'.$travelling_date.'</a></td>
			
			<td align="left" nowrap="nowrap">'.$fcity .'-'. $tcity.'</a></td>
			<td align="left" nowrap="nowrap">'.$fare.'</a></td>
			
			<td align="center"><!--<a href="view_seats.php?ticket_no='.$ticket.'&dat='.$travelling_date.'&fromcity='.$row['Bus_fromcity'].'&tocity='.$row['Bus_tocity'].'&SP_id='.$row['SP_id'].'">-->'.$scount.'<!--</a>--></td>
			<td align="left" nowrap="nowrap">'.$utype.'</td>
			
			<td align="center">';
			$statusbooking_sql=mysql_query("SELECT * FROM bookinginfo WHERE Ticket_ID='".$ticket."'");
			if(mysql_num_rows($statusbooking_sql)>0){
			   $status="Travel";
			}
			else{
			   $status="Cancel";
			}
		$opt="c";
		$msg.=''.$status.'</td><td><a href="javascript:delpass(\''.$ticket.'\',\''.$opt.'\');" title="Cancel This Ticket">
			Cancel
			</a></td>			
		  </tr>';
    }
	}
	else {
            $msg.='<tr>
			<td align="center" colspan="6"><span class="err_msg">No Users Found.</span></td>
		    </tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data

/* --------------------------------------------- */


/*$query_pag_num = "SELECT COUNT(*) AS count FROM users ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query_pag_num .=" WHERE ";
  
  $query_pag_num .=" (`user_email` LIKE '%".$search."%' OR `user_firstname` LIKE '%".$search."%' OR `user_lastname` LIKE '%".$search."%' OR `user_address1_1` LIKE '%".$search."%' OR `user_address1_2` LIKE '%".$search."%' OR `user_address1_city` LIKE  '%".$search."%' OR `user_address1_state` LIKE '%".$search."%' OR `user_landno` LIKE '%".$search."%' OR `user_mobileno` LIKE '%".$search."%' OR `user_address1_pin` LIKE '%".$search."%')";  
  }*/



$result_pag_num = mysql_query($qry) or die(mysql_error());

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
$msg .= "<br><div style='text-align:center'><div class='pagination'><table border='0' align='center'><tr>";

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
$goto = "<input type='text' class='goto' size='1'  onkeydown='return isNumberKey(event)' /><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div >".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />