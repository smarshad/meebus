<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
//print_r($_REQUEST); 

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

$flag=0;

$val_Dateeee=date("Y-m-d",strtotime($_REQUEST["dat"]));
$sssga=date('Y-m-d');
$journey_date	= date("d-m-Y",strtotime($_REQUEST["dat"]));
$triptype=$_REQUEST['service'];

$query = "SELECT * FROM businfo WHERE Bus_status = 1 and ('$val_Dateeee' <= DATE_ADD('$sssga',INTERVAL `active_days` DAY)) and (disable_date NOT LIKE '%$journey_date%') ";

if(isset($_REQUEST['ter_from']) && isset($_REQUEST['ter_to']) && isset($_REQUEST['dat']) && $_REQUEST['ter_from']!='none' && $_REQUEST['ter_to']!='none'){
  $ter_from=mysql_real_escape_string($_REQUEST['ter_from']);
   $ter_to=mysql_real_escape_string($_REQUEST['ter_to']);
  $flag=1;
  $query .=" AND ";
  $query .=" `Bus_fromcity` = ".$ter_from." and `Bus_tocity` = ".$ter_to;  
  }
  
 /* if($_REQUEST['status']!='-1'){
  $status=$_REQUEST['status'];
  if($flag==1){
  $query .=" AND ";
  }
  else{
  $query .=" WHERE ";
  }
  
  $query .=" SP_status = ".$status;
  }*/

 $query .= " group by Bus_id LIMIT $start, $per_page";

$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<hr><br><div class="data"><table width="90%" border="0" cellspacing="2" cellpadding="5" align="center">
  <tr>
    <th>Travels</th>
	 <th>Bus Name</th>
    <th>Bus Type</th>
    <th align="left">Departure</th>
   <!-- <th align="center">Arrival</th>-->
    <th align="center">Fare in Rs</th>
    <th align="center">No.of Seats</th>
    <th align="left">Status</th>
  </tr>';
  if(mysql_num_rows($result_pag_data)>0){
		while ($row = mysql_fetch_array($result_pag_data)) {
	
		$bus_id=$row['Bus_id'];
		$sp_id=$row['SP_id'];
		$bus_type=$row['Bus_type'];
		$bus_fare=$row['Bus_fare'];
		$departure = explode(",",$row['Bus_boarding_time']);
			
		 $dat= mysql_real_escape_string($_REQUEST['dat']);
		
		$dat=changedateformat($dat);	  
		$booked_seat = get_booked_seat($bus_id,$dat);	
		
		$total_seat = get_total_seat($bus_id);
		//echo count($booked_seat)."<br>";
		// echo count($total_seat);
		
		//$available_seat = available_seats($booked_seat,$total_seat);
		if(count($booked_seat)!=0 && count($total_seat)!=0){
		$available_seat = array_diff($total_seat,$booked_seat); 
		//print_r($available_seat);
		}
		else{
		$available_seat=$total_seat;
		}
		
		if(count($total_seat) > 0)
		{
			if(count($available_seat)>0)
			{
				
$str=explode("-",$dat);
$d=$str[0];
$m=$str[1];
$y=$str[2];
$ex=$d."+'-'+".$m."+'-'+".$y;

//$bus_status = '<a href="available_seat.php?bus_id='.$bus_id.'&dat='.$ex.'" title="Book Seats In this Bus">Book</a>';
				$bus_status = '<a href="javascript:void(0)" title="Book Seats In this Bus" onclick="avl_seats('.$bus_id.','.$ex.','.$triptype.');">Book</a>';
			}
			else
			{
				$bus_status = "Sold out";
			}
		
			
		$msg.='<tr>
			<td align="left">'.get_SP_name($sp_id).'</td>
			<td align="left">'.get_bus_name($bus_id).'</td>
			<td align="left">'.get_bus_type($bus_type).'</td>
			<td  align="left">'.$departure[0].'</td>
			<!--<td  align="center"></td>-->
			<td align="center">'.$bus_fare.'</td>
			<td align="center">'.count($available_seat).'</td>
			<td align="left">'.$bus_status.'</td> 
		  </tr>';
		  }
		}
    }
	else {
            $msg.='<tr>
			<td colspan="7" align="center"><span class="err_msg">Buses Not Available .</span></td>
			
		  </tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data


/* --------------------------------------------- */


$query_pag_num = "SELECT COUNT(*) AS count FROM businfo ";

if(isset($_REQUEST['ter_from']) && $_REQUEST['ter_from']!='none'){
  $ter_from=mysql_real_escape_string($_REQUEST['ter_from']);
   $ter_to=mysql_real_escape_string($_REQUEST['ter_to']);
  $query_pag_num .=" WHERE ";
  $query_pag_num .=" `Bus_fromcity` = ".$ter_from." and `Bus_tocity` = ".$ter_to." ";  
  }

$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
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
