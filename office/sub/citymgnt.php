<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
//print_r($_REQUEST); exit;
if(isset($_POST['page']))
{
$arr=general_Settings();
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 20;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

$flag=0;
$query = "SELECT * FROM cities";
$query .=" WHERE ";
if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $flag=1;
  
  $query .=" `city_name` LIKE '%".$search."%'"; 
  }

if($flag==1)
   $query.=" AND ";
 
$query.=" del_status=1 ";   
    
$query .= " ORDER BY city_name LIMIT $start, $per_page";

$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<div class="data">&nbsp;<br><table border="0" width="50%" cellspacing="2" cellpadding="5" align="center">
  <tr>
    <th>City Name</th>
	 <th>Stopping </th>
	
    <th nowrap="nowrap">Action</th>
  </tr>';
  if(mysql_num_rows($result_pag_data)>0){
  $g=0;
		while ($row = mysql_fetch_array($result_pag_data)) {
		$city_id=$row['id'];
		$city_name=$row['city_name'];
		$status=$row['status'];
		
		if($status==1){
		   $s=0;
		   $title="Click to Block";
		   $src="../images/Active.png";
		  }
		else{
		   $title="Click to Unblock";
		   $src="../images/inactive.png";
		   $s=1;
		}  
		
		$stop=mysql_num_rows(mysql_query("select * from board_points where board_city='$city_id' and board_status='0'"));
		
		
		$msg.='
		<tr>
			<td align="left">'.$city_name.'<input type="hidden" id="'.$city_id.'" value="'.$city_name.'"></td>
			
			<td align="left"><a href="stop_point.php?cityid='.$city_id.'">'.$stop.' </a></td>
			
			<td align="left" nowrap="nowrap">
			<a href="javascript:void(0);" onclick="changeCity('.$city_id.','.$s.')" title="Click to '.$title.'">
			<img src="'.$src.'" border="0" />
			</a>
						
			<a href="javascript:void(0);" onclick="editcityfun('.$city_id.')" title="Edit">
			<img src="../images/edit.png" border="0" title="Edit" /></a>
			
			<!--<a href="javascript:void(0);" onclick="alert(\' This is Demo Version !!! \')" title="Delete">
			<img src="../images/delete.png" border="0" />
			</a>-->
			
			<a href="javascript:void(0);" onclick="delCity('.$city_id.')" title="Delete">
			<img src="../images/delete.png" border="0" />
			</a>
		
			</td></tr>';
		}
    }
	else {
            $msg.='<tr>
			<td colspan="2" align="center"><span class="err_msg">No City.</span></td>
		  </tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data


/* --------------------------------------------- */


$query_pag_num = "SELECT COUNT(*) AS count FROM cities where del_status=1 ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query_pag_num .=" WHERE ";
  $query_pag_num .=" `city_name` LIKE '%".$search."%' ";  
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
echo $msg; echo "<div style='width=100px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />