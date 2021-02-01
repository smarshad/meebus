<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['page']))
{
//print_r($_REQUEST);
//exit;
$arr=general_Settings();
$page = $_REQUEST['page'];
$cur_page = $page;
$page -= 1;
$per_page = $arr['paginate_value'];
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

$flag=0;

$str=mysql_real_escape_string($_REQUEST['search']);
$ex=explode("||",$_REQUEST['status']);

$date=$ex[0];
$b_id=$ex[1];

$status=$ex[3];
$sp_id=$ex[4];
//echo $date.$b_id.$sp_id;
/*$query="SELECT * FROM businfo, bookinginfo WHERE bookinginfo.travelling_date='".changedateformat($date)."' AND bookinginfo.SP_id=".$sp_id."  AND bookinginfo.Bus_id= businfo.Bus_id AND cancelledStatus=0 ";


$flag=0;

if($str!=''){
   $query.=" AND ";
   $query.=" businfo.Bus_name LIKE '%".$str."%' AND businfo.SP_id = bookinginfo.SP_id ";
}

if($from!=-1){
   $query.=" AND ";
  $query.=" businfo.Bus_fromcity=".$from;
  $flag=1;
}

if($to!=-1){
  $query.=" AND ";
  $query.=" businfo.Bus_tocity=".$to;
  $flag=1;
}*/
/*$sql6=mysql_fetch_array(mysql_query("SELECT * FROM businfo where bus_id='$b_id'"));*/

 $query="SELECT * FROM payment_transaction where bus_id='$b_id' and pay_status=1";

//$query.=" ORDER BY businfo.`Bus_name`"; 
$qry=$query;
$query.=" LIMIT $start,$per_page";
$result_pag_data = mysql_query($query) or die(mysql_error());
$msg .='<div class="data" style="width:100%;">

            <a href="javascript:history.go(-1)"> << Back </a>     
			    
            <table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';
			
		    $msg.='<tr>
			<!--<td align="left" nowrap="nowrap"><strong>Service Provider Name</strong></td>	
			<td align="left" nowrap="nowrap"><strong>Bus Name</strong></td>-->
			<td align="left" nowrap="nowrap"><strong>Transaction Id</strong></td>
						<td align="left" nowrap="nowrap"><strong>Mobile</strong></td>
						<td align="left" nowrap="nowrap"><strong>Ticket Count</strong></td>
				<td align="left" nowrap="nowrap"><strong>Amount</strong></td>
					<td align="left" nowrap="nowrap"><strong>Date</strong></td>
					<td align="left" nowrap="nowrap"><strong>Ip address</strong></td>
					
						<td align="left" nowrap="nowrap"><strong>Pay Status</strong></td>
		    </tr>';
if(mysql_num_rows($result_pag_data)){

	while($r=mysql_fetch_array($result_pag_data)){
	   	
		$msg.='<tr>';
		$msg.='
	    		<td align="left">
			<a href="pay_ticketinfo.php?b_id='.$r['bus_id'].'&sp_id='.$r['Service_provider_id'].'">'.$r['pay_trans_id'].'</a>
			</td>
			<td align="left">'.$r['pay_tele'].'</td>
			<td align="left">'.$r['ticket_count'].'</td>
			<td align="left">'.$r['pay_amount'].'</td>
			<td align="left">'.$r['pay_date_time'].'</td>
			<td align="left">'.$r['pay_ip'].'</td>
			
			<td align="left">'.$r['pay_bankRespMsg'].'</td>
			
			
			</tr>';		
		
		
				
	}
	
	/*$msg.='<tr bgcolor="#CCCCCC"><td align="left"></td><td align="left"></td><td align="left"><b>Total Amount</b></td><td align="left"><b>'.$tot.'</b></td></tr>';*/
}
	else {
            $msg.='<tr>
			<td></td>
			<td align="left"><span class="err_msg"><span class="err_msg">No Records Found.</span></span></td>			
			<td></td>
		  </tr>';	
	}	
	 $msg.= "</table></div>" ;

/* --------------------------------------------- */
$query_pag_num=$qry;
$result_pag_num = mysql_query($query_pag_num);
$r = mysql_fetch_array($result_pag_num);
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
$msg .= "<br><div style='width:100%; float:left;'><div class='pagination'><table border='0' align='center'><tr>";

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
$goto = "<input type='text' class='goto' size='1'  onkeydown='return isNumberKey(event)'/><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=300px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?>