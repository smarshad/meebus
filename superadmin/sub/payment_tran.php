<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['page']))
{
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

$query="SELECT * FROM payment_transaction ";
if($_REQUEST['search']!=''){
   $sp=mysql_real_escape_string($_REQUEST['search']);
   $query.=" serviceprovider_info.SP_name LIKE '%".$sp."%' AND bookinginfo.SP_id = serviceprovider_info.SP_id ";
   $flag=1;
}

/*if($_REQUEST['status']!=''){
   $dat=mysql_real_escape_string($_REQUEST['status']);
   if($flag==1)
   $query.=' AND ';
   $query.="bookinginfo.travelling_date='".changedateformat($dat)."'";
   $flag=1;
}
else{
  if($flag==1)
   $query.=' AND ';
   $query.="bookinginfo.travelling_date = '".date("Y-m-d")."'";
}
$query.=" AND bookinginfo.cancelledStatus=0 AND bookinginfo.Blocked=0 GROUP BY serviceprovider_info.SP_id ORDER BY serviceprovider_info.SP_name ";*/
$qry=$query;
 $query.=" LIMIT $start,$per_page";
$msg .='<div class="data" style="width:100%;"><table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';
		   $msg.='<tr>
			<td align="left" nowrap="nowrap"><strong>Service Provider Name</strong></td>	
			<td align="left" nowrap="nowrap"><strong>Bus Name</strong></td>
			
			<td align="left" nowrap="nowrap"><strong>Mobile</strong></td>
				<td align="left" nowrap="nowrap"><strong>Amount</strong></td>
					<td align="left" nowrap="nowrap"><strong>Date</strong></td>
					<td align="left" nowrap="nowrap"><strong>Ip address</strong></td>
					<td align="left" nowrap="nowrap"><strong>Transaction Id</strong></td>
						<td align="left" nowrap="nowrap"><strong>Pay Status</strong></td>
			<td align="left" nowrap="nowrap"><strong>Status</strong></td>
		    </tr>';
			
$sql=mysql_query($query) or die(mysql_error());
$chk_SP=0; $chk_dat=0;
if(mysql_num_rows($sql)>0){
while($r=mysql_fetch_array($sql)){
    

	 		 	   
	 $msg.='<tr>';
	 $msg.='<td align="left">'.$r['pay_custname'].'</td>
	    	<td align="left">
			<a href="pay_ticketinfo.php?b_id='.$r['bus_id'].'&sp_id='.$r['Service_provider_id'].'">'.$r['bus_name'].'</a></td>
			
			
			<td align="left">'.$r['pay_tele'].'</td>
			<td align="left">'.$r['pay_amount'].'</td>
			<td align="left">'.$r['pay_date_time'].'</td>
			<td align="left">'.$r['pay_ip'].'</td>
			<td align="left">'.$r['pay_trans_no'].'</td>
			<td align="left">'.$r['pay_bankRespMsg'].'</td>
			
			
			</tr>';
	
		 
    }
	}
	 else{
     $msg.='<tr><td align="left"></td>
	    	<td align="left" nowrap="nowrap"><span class="err_msg">No Records Found</span></td>
			<td align="left"></td>
			<td align="left"></td></tr>';	 
	 }
	 $msg.= "</table></div>" ;

/* --------------------------------------------- */

$qry=$query;

$query_pag_num=$qry;
$result_pag_num = mysql_query($query_pag_num);
$r = mysql_fetch_array($result_pag_num);
$count=mysql_num_rows($result_pag_num);
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