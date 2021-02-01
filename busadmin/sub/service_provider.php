<?php
session_start();
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
if(isset($_POST['page']))
{
$arr=general_Settings();
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = $arr['paginate_value'];
$per_page = 10;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

$flag=0;
$query = "SELECT * FROM cancellation_policies as cp, serviceprovider_info as spi WHERE cp.SP_id=".$_SESSION['SP_id']." ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $flag=1;
  $query .="  ";
  $query .=" spi.SP_name LIKE '%".$search."%' and ";  
  }
$query .= " AND cp.SP_id = spi.SP_id  LIMIT $start, $per_page";

$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<div class="data"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th> Service Provider Name</th>
	<th>Durations</th>
	<th align="left">Time in Hours</th>
	<th align="left"> Refundable Amount in %</th>
	<th align="left"> Action </th>
  </tr>';
  if(mysql_num_rows($result_pag_data)>0){
		while ($row = mysql_fetch_array($result_pag_data)) {
		$sp_id=$row['SP_id'];
		$duration=$row['duration'];
		$time=$row['time'];
		$refund=$row['refundable_amt'];
		$status = $row['status'];
		$c_id = $row['cancelpolicy_id'];
		
		
		$msg.='<tr>
			<td align="left">'.get_SP_name($row['SP_id']).'</td>
			<td align="left">'.$duration.'</td>
			<td align="center">'.$time.'</td>
			<td align="center">'.$refund.'</td>
			<td align="left">';
			if($status==1)
			{
			 $msg.=  '<a href="javascript:void(0);" onclick="inactivepolicy('.$c_id.');" title="Click to Block"> 
				<img src="../images/Active.png" border="0" /></a>';
			}
			else
			{
			$msg.= '<a href="javascript:void(0);" onclick="activepolicy('.$c_id.');" title="Click to Unblock"> 
				<img src="../images/inactive.png" border="0" /></a>';
			}
					$msg.= '
					
			
			<a href="edit_cancelpolicy.php?c_id='.$c_id.'"><img src="../images/edit.png" border="0" title="Edit" /></a>				
				<a href="javascript:void(0);" onclick="delpolicy('.$c_id.');">
				<!--<a href="javascript:void(0);" onclick="alert(\'This is Demo version !!! \');">-->
				<img src="../images/delete.png" border="0" title="Delete" /></a> </td>
				
			<td>
		  </tr>';
		}
    }
	else {
            $msg.='<tr>
			<td align="center" colspan="6"><span class="err_msg">No Service Providers.</span></td>
			
		  </tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data


/* --------------------------------------------- */


$query_pag_num = "SELECT COUNT(*) AS count FROM cancellation_policies ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query_pag_num .=" WHERE ";
  $query_pag_num .=" `SP_name` LIKE '%".$search."%' ";  
  }
$query_pag_num=$query;
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
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
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;' onkeydown='return isNumberKey(event)'/><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=200px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />
