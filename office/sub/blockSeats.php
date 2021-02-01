<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

session_start();

//print_r($_REQUEST);

if(isset($_REQUEST['page']))
{

$arr=general_Settings();
$page = $_REQUEST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 10;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

if(isset($_REQUEST['search']))
{
//$spid=mysql_real_escape_string($_REQUEST['search']);

	 	 $val = $_REQUEST['search'] ; //exit ;

if(isset($_REQUEST['status']) && $_REQUEST['status'] != "" )
{
	$dat= changedateformat($_REQUEST['status']);
}
else
{
	 $dat = date("Y-m-d");
}

$query = "SELECT * FROM bookinginfo, serviceprovider_info WHERE bookinginfo.Blocked = '1' and (bookinginfo.travelling_date = '0000-00-00' or bookinginfo.travelling_date = '".$dat."') AND bookinginfo.SP_id = serviceprovider_info.SP_id " ;

	if($val != 'all' && $val !='')
	{	
		$query.= " and serviceprovider_info.SP_name like '$val%'" ;
	}
	/*else
	{
		$query = "SELECT * FROM bookinginfo, serviceprovider_info WHERE bookinginfo.Blocked = '1' and (bookinginfo.travelling_date = '0000-00-00' or bookinginfo.travelling_date = '".$dat."') and bookinginfo.SP_id=serviceprovider_info.SP_id" ;
	}*/
	
$query .=" GROUP BY auto_id LIMIT $start, $per_page";	
}

  $query;
/*
if(isset($_REQUEST['alpha']))
{

	//$val = strtolower($_REQUEST['alpha']) ;
	
	$val = $_REQUEST['alpha'] ; //exit ;
	
	$query = "SELECT * FROM bookinginfo,businfo,serviceprovider_info WHERE serviceprovider_info.SP_name like '$val%' and bookinginfo.Bus_id=businfo.Bus_id AND bookinginfo.SP_id=serviceprovider_info.SP_id" ;
	
}*/

//	echo $query ;  exit ;

$result_pag_data = mysql_query($query) or die(mysql_error());
$msg = "";

$msg .='<div class="data">&nbsp;<br>
<table width="100%" cellspacing="1" cellpadding="1" align="left">
  <tr>
    <th>Service Provider</th>
    <th>Bus Name</th>
    <th>Bus Type</th>
    <th>Blocked Seats</th>
    <th>Date(D-M-Y)</th>
    <th>Action</th>
  </tr>';
  if(mysql_num_rows($result_pag_data)>0){ // mysql_num_rows($result_pag_data);
     $chk_busid=0; $chk_date=(string).0;
		while ($row = mysql_fetch_array($result_pag_data)) { 
		$row_Busid=$row['Bus_id'];
		$row_SPid=$row['SP_id'];
		$row_date=$row['travelling_date'];
		$bustypearr=get_bus_details($row_Busid);
		$bustype=$bustypearr[0]['Bus_type'];
		
/*		if($dat==''){
		   $search_date=$row_date;
		}
		else{*/
		   $search_date=$dat;
		//}
		
		 $n=numberofBlockedSeats($row_SPid,$row_Busid,$row_date);
		
		if($n>0){
		if(($row_Busid != $chk_busid) || ($row_date !=$chk_date)){	
		$tra=explode("-",$row_date);
				$dat=$tra[2];
	            $mon=$tra[1];
				$year=$tra[0];				
				echo "<script> var traveldate =".$dat."+'-'+".$mon."+'-'+".$year."; </script>";
		$msg.='<tr>';		
		$msg.='
			<td>'.get_SP_name($row_SPid).'</td>
			<td>'.get_bus_name($row_Busid).'</td>
			<td>'.get_bus_type($bustype).'</td>
			<td align="center">
			<a onclick="blockseats('.$row_SPid.','.$row_Busid.',traveldate)" href="javascript:void(0)" title="Block Seats In this Bus">'.$n.'</a>
			<!--<a onclick="blockseats($row_SPid,$row_Busid,$row_date)" href="block_seats.php?sp_id='.$row_SPid.'&bus_id='.$row_Busid.'&dat='.changedateformat($row_date).'">'.numberofBlockedSeats($row_SPid,$row_Busid,$row_date).'</a>--></td>
			<td>'.changedateformat($row_date).'</td>			
			<td>
			<!--<a href="block_seats.php?sp_id='.$row_SPid.'&bus_id='.$row_Busid.'&dat='.changedateformat($row_date).'" title="Block Seats In this Bus">-->
			<a onclick="blockseats('.$row_SPid.','.$row_Busid.',traveldate)" href="javascript:void(0)" title="Block Seats In this Bus">
				Block Seats
			</a>
			</td>';
		
		$msg.='</tr>';
		
			$chk_busid=$row_Busid;  
			$chk_date=$row_date; 
		   }
		   }
		}
    }
	else {
            $msg.='<tr><td colspan="5"><br></td></tr>
			<tr>
				<td align="center" colspan="5"><span class="err_msg">No Bus Details Found.</span></td>			
		  	</tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data


/* --------------------------------------------- */


/*$query_pag_num = "SELECT COUNT(*) AS count FROM cities ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query_pag_num .=" WHERE ";
  $query_pag_num .=" `city_name` LIKE '%".$search."%' ";  
  }*/
$query_pag_num=$query;
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = mysql_num_rows($result_pag_num);
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
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
$msg .= "<br><br><br><br><br><br><div style='width:610px; float:left;'><div class='pagination'><table border='0' align='center'><tr>";

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
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'  onkeydown='return isNumberKey(event)'/><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg .= "</tr> </table></div>";  // Content for pagination
echo $msg; 
echo "<div style='width=100px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />