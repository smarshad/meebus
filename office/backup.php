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

$query="SELECT * FROM bookinginfo,serviceprovider_info WHERE ";
if($_REQUEST['search']!='0'){
//echo "first";
   $sp=mysql_real_escape_string($_REQUEST['search']);
   $query.=" serviceprovider_info.SP_id = '".$sp."' AND bookinginfo.SP_id = serviceprovider_info.SP_id ";
   $flag=1;
}

if($_REQUEST['status']!=''){
//echo "se";
   $dat=mysql_real_escape_string($_REQUEST['status']);
   if($flag==1)
   $query.=' AND ';
   $query.="bookinginfo.travelling_date='".changedateformat($dat)."'";
   $flag=1;
}
else{
//echo "thr";
  if($flag==1)
   $query.=' AND ';
   $query.="bookinginfo.travelling_date = '".date("Y-m-d")."'";
}
$query.=" AND bookinginfo.cancelledStatus=0 AND bookinginfo.Blocked=0 GROUP BY serviceprovider_info.SP_id ORDER BY serviceprovider_info.SP_name ";
$qry=$query;
 $query.=" LIMIT $start,$per_page";
 
 //echo $query; 
 
$msg .='<div class="data" style="width:100%;"><table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';
		   $msg.='<tr>
			<td align="left"><strong>Service Provider Name</strong></td>	
			<td align="left"><strong>No.of Buses</strong></td>
			<td align="left"><strong>Total Amount</strong></td>
			<td align="left"><strong>Date</strong></td>
		    </tr>';
$sql=mysql_query($query) or die(mysql_error());
$chk_SP=0; $chk_dat=0;
if(mysql_num_rows($sql)>0){
while($r=mysql_fetch_array($sql)){
     $sp_id=$r['SP_id'];
     $dat=$r['travelling_date'];		 
	 $buscount=get_total_bus($sp_id,$dat);
	 $busfare=get_total_bus_fare($buscount,$dat);

	 if($chk_SP!=$sp_id || $chk_dat!=$dat){		 	   
	 $msg.='<tr>';
	 $msg.='<td align="left">'.get_SP_name($sp_id).'</td>
	    	<td align="left">
			<a href="paymentperSP.php?sp_id='.$sp_id.'&dat='.$dat.'&amt='.$busfare.'">'.count($buscount).'</a></td>
			<td align="left">'.$busfare.'</td>
			<td align="left">'.$dat.'</td>
			</tr>';
	 }
	 $chk_SP=$sp_id; $chk_dat=$dat;	 
    }
	}
	 else{
     $msg.='<tr><td align="left"></td>
	    	<td align="left"><span class="err_msg">No Records Found</span></td>
			<td align="left"></td>
			<td align="left"></td></tr>';	 
	 }
	 $msg.= "</table></div>" ;

/* --------------------------------------------- */
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
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;' onkeydown='return isNumberKey(event)'/><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=300px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?>