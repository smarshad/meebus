<?php
session_start();
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
/*print_r($_SESSION); 
exit;*/
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


/*$query = "SELECT * FROM bookinginfo as bi, serviceprovider_info as spi , users as usr , passengerinfo as psr , businfo as bus where bi.Ticket_ID=psr.Ticket_ID and bi.SP_id = ".$_SESSION['SP_id']." and bus.Bus_id=bi.Bus_id ";*/

$query = "SELECT * FROM bookinginfo as bi, serviceprovider_info as spi  , passengerinfo as psr , businfo as bus where bi.Ticket_ID=psr.Ticket_ID and bi.SP_id = ".$_SESSION['SP_id']." and bi.Bus_id=bus.Bus_id and psr.delete_status = 1";


  if(isset($_REQUEST['search']) && $_REQUEST['search']!='')
  {

  $search=mysql_real_escape_string($_REQUEST['search']);
  
  $query .=" AND ";

  $query .=" spi.SP_name LIKE '%".$search."%'";  

  }
   
   
  $all = $_REQUEST['status'] ;
  
  $val = explode('^^',$all) ;
  
  $ticket =  $val[0] ;
  $tdate  =  $val[1] ;
  $utype  =  $val[2] ; 
  $fcity  =  $val[3] ; 
  $tcity  =  $val[4] ; 
 
  if($ticket!='')
  {
 
  $query .=" AND ";
   
  $query .=" bi.Ticket_ID like '%".$ticket."%'";
  }
  
  if($tdate!='')
  {
 
  $query .=" AND ";
   
  $query .=" bi.travelling_date = '".$tdate."'";
  }
  
  if($utype != '0')
  {

  $query .=" AND ";
  
  $query .=" usertype = ".$utype;
  
  }
  
  if($fcity != '0')
  {

  $query .=" AND ";
  
  $query .=" bus.Bus_fromcity = ".$fcity;
  
  }
  
  if($tcity != '0')
  {

  $query .=" AND ";
  
  $query .=" bus.Bus_tocity = ".$tcity;
  
  }

$query .= " group by bi.Ticket_ID "; //LIMIT $start, $per_page";
    $qry=$query;
	 $query.="order by auto_id desc LIMIT $start, $per_page";

//echo $query ; //exit ;

$result_pag_data = mysql_query($query) or die(mysql_error());

$msg = "";

$msg .='<div class="data">
<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tr>
  	<th nowrap="nowrap">Ticket Number</th>   
    <th nowrap="nowrap">Booker Name</th>
    <th nowrap="nowrap">Booked Date</th>
    <th nowrap="nowrap">Travel Date</th>
	<th nowrap="nowrap">From - To</th>
	<th nowrap="nowrap">Fare</th>
    <th nowrap="nowrap">No. of Seats</th>
	<th nowrap="nowrap">User Type</th>	
  </tr>';
  
  if(mysql_num_rows($result_pag_data)>0)
  {

		while($row = mysql_fetch_array($result_pag_data)) 
		{			
			
		$sp_id=$row['SP_id'];
		
		$usr_id=$row['userid'];
		
		$sp_name=$row['SP_name'];

		$booker= $row['Ticket_ID'];
		
		$booked_date=date("d-m-Y",strtotime($row['booked_date']));
			
		$travelling_date=date("d-m-Y",strtotime($row['travelling_date']));
		
		$frm = $row['Bus_fromcity'] ;
		
		$scount12 = mysql_fetch_array(mysql_query("select * from cities where id = '$frm'"));
		
		$fcity = ucwords($scount12['city_name']) ;
		
		$to = $row['Bus_tocity'] ;
		
		$scount13 = mysql_fetch_array(mysql_query("select * from cities where id = '$to'"));
		
		$tcity = ucwords($scount13['city_name']) ;
		
		$ticket=$row['Ticket_ID'];
		
		$scount1 = mysql_fetch_array(mysql_query("select count(*) from bookinginfo where cancelledStatus='0' and Ticket_ID = '$ticket' "));
		
		$scount = $scount1[0];
		
		$scount1 = mysql_fetch_array(mysql_query("select count(*) from bookinginfo where cancelledStatus='0' and Ticket_ID = '$ticket' "));			
		
		/*$fare = $scount * $row['Bus_fare'] ; */	
		
		$mn=mysql_fetch_array(mysql_query("select * from booker_details where Ticket_ID='$booker'"));
		
		$bemail=$mn['Booker_email'];
		
		$fare=$mn['booking_amt'];
		
		$utype= $row['usertype'];
		
		$sql = mysql_fetch_array(mysql_query("select * from usertypes where usertype_id='$utype'")) ;
		
		$utype= $sql['usertype_name'];
		
				
		$msg.='<tr>			
			<td align="left" nowrap="nowrap">
			<a href="ticket_view.php?ticket='.$ticket.'&travel_date='.$travelling_date.'&Bus_id='.$row['Bus_id'].'&SP_id='.$row['SP_id'].'&email='.$bemail.'" class="link1">
				'.$ticket.'</a>
			</td>
		
			<td align="left" nowrap="nowrap">
				<a href="view_seats.php?ticket_no='.$ticket.'&dat='.$travelling_date.'&fromcity='.$row['Bus_fromcity'].'&tocity='.$row['Bus_tocity'].'&SP_id='.$row['SP_id'].'" class="link1">'.ucwords(get_booker($booker)).'</a>
			</td>
			
			<td align="left" nowrap="nowrap">'.$booked_date.'</td>
			<td align="left" nowrap="nowrap">'.$travelling_date.'</a></td>
			
			<td align="left" nowrap="nowrap">'.$fcity .'-'. $tcity.'</a></td>
			<td align="left" nowrap="nowrap">'.$fare.'</a></td>
			
			<td align="center"><a href="view_seats.php?ticket_no='.$ticket.'&dat='.$travelling_date.'&fromcity='.$row['Bus_fromcity'].'&tocity='.$row['Bus_tocity'].'&SP_id='.$row['SP_id'].'" class="link1">'.$scount.'</a></td>
			<td align="left">'.$utype.'</td>
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


$query_pag_num = "SELECT COUNT(*) AS count FROM users ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query_pag_num .=" WHERE ";
  

  $query_pag_num .=" (`user_email` LIKE '%".$search."%' OR `user_firstname` LIKE '%".$search."%' OR `user_lastname` LIKE '%".$search."%' OR `user_address1_1` LIKE '%".$search."%' OR `user_address1_2` LIKE '%".$search."%' OR `user_address1_city` LIKE  '%".$search."%' OR `user_address1_state` LIKE '%".$search."%' OR `user_landno` LIKE '%".$search."%' OR `user_mobileno` LIKE '%".$search."%' OR `user_address1_pin` LIKE '%".$search."%')";  
  }



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