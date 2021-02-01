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

$flag=0;

$query = "SELECT * FROM tbl_courier_officers";


	$query .= " LIMIT $start, $per_page";


$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<div class="data"><table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <th>Officer Name</th>
    <th>Password</th>
    <th>Address</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Office</th>
    <th align="center">Actions</th>
  </tr>';
  
  if(mysql_num_rows($result_pag_data)>0)
  {
		while ($row = mysql_fetch_array($result_pag_data)) 
		{
		
		$officer_name=$row['officer_name'];
		
		$off_pwd=$row['off_pwd'];

		$address= $row['address'];
	
		
		$email=$row['email'];
		$ph_no=$row['ph_no'];
		$office=$row['office'];
		
		$id=$row['cid'];
		
		
		
		
		$msg.='<tr>
			<td align="left">
			'.$officer_name.'</td>
			<td align="left">'.$off_pwd.'</td>
			<td align="left">'.$address.'</td>
			<td align="left">'.$email.'</a></td>
			<td align="left">'.$ph_no.'</td>
			<td align="left">'.$office.'</td>
			<td>
					
					<a href="edit_off_log.php?id='.$id.'"><img src="../images/edit.png" border="0" title="View" /></a>	
					
				
					
					<a href="javascript:void(0);" onclick="delmember('.$id.')">
					
						<img src="../images/delete.png" border="0px" style="cursor:pointer;" title="Delete This User"  />
					</a> </td>
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


$query_pag_num = "SELECT COUNT(*) AS count FROM tbl_courier_officers ";





$result_pag_num = mysql_query($query_pag_num) or die(mysql_error());

//echo $result_pag_num ; exit ;

$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
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
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;' onkeydown='return isNumberKey(event)'/><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=200px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?>
<script type="text/javascript">
function delmember(uid){
var r=confirm("Are you sure to Delete?");
if(r)
window.location.href="delete_off_log.php?id="+uid;
}
</script>
