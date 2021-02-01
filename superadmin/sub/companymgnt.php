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
$query = "SELECT * FROM serviceprovider_info";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $flag=1;
  $query .=" WHERE ";
  $query .=" (`SP_name` LIKE '%".$search."%' OR `SP_email` LIKE '%".$search."%' OR `SP_vat` LIKE '%".$search."%' OR `SP_address1` LIKE '%".$search."%' OR `SP_address2` LIKE '%".$search."%' OR `SP_city` LIKE  '%".$search."%' OR `SP_state` LIKE '%".$search."%' OR `SP_landNo1` LIKE '%".$search."%' OR `SP_landNo2` LIKE '%".$search."%' OR `SP_mobile1` LIKE '%".$search."%' OR `SP_mobile2` LIKE '%".$search."%' OR `SP_mobile3` LIKE  '%".$search."%' OR `SP_fax` LIKE '%".$search."%' OR `SP_emgFname` LIKE '%".$search."%' OR `SP_emgDesignation` LIKE '%".$search."%' OR `SP_emgCallno` LIKE  '%".$search."%' OR `SP_comments` LIKE '%".$search."%')";  
  }
  
  if($_REQUEST['status']!='-1'){
  $status=$_REQUEST['status'];
  if($flag==1){
  $query .=" AND ";
  }
  else{
  $query .=" WHERE ";
  }
  
  $query .=" SP_status = ".$status;
  }

$query .= " ORDER BY SP_name LIMIT $start, $per_page ";

$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<div class="data"><table width="100%" border="1" cellspacing="2" cellpadding="10">
  <tr>
    <th>Service Provider</th>
    <th>Email</th>
  <!--  <th>No. of Routes</th>-->
    <th>No. of Buses</th>
    <th>Contact Person</th>
    <th>Contact No</th>
    <th>Actions</th>
  </tr>';
  if(mysql_num_rows($result_pag_data)>0){
		while ($row = mysql_fetch_array($result_pag_data)) {
		$sp_id=$row['SP_id'];
		$sp_email=$row['SP_email'];
		$sp_contname=$row['SP_emgFname'];
		$sp_emgcalno=$row['SP_emgCallno'];
		$sp_name=htmlentities($row['SP_name']);
		$sp_status=$row['SP_status'];
		if($sp_status==1){
		   $sta="Deactive?";
		   $chg_status=0;
		   $styl=" class='suc_msg'";
		   $title="Click to Block";
		   $src="../images/Active.png";		   
		}
		else{
		   $sta="Active?";
		   $chg_status=1;
		   $styl=" class='err_nsg'";
		   $title="Click to Unblock";
		   $src="../images/inactive.png";		   
		}
		
		$buscount=getBuscount($sp_id);
		if($buscount > 0){
		   $link_bus='<a href="busDetails.php?sp_id='.$sp_id.'" class="link1">View Bus</a>';
		}
		else{
		   $link_bus='<a href="redirect.php?sp_id='.$sp_id.'" class="link1">Add Bus</a>';
		}
		
		$msg.='<tr>
			<td align="left"><a href="view_providers.php?sp_id='.$sp_id.'">'.$sp_name.'</a></td>
			<td align="left">'.$sp_email.'</td>
			<!--<td  align="center"><a href="javascript:void(0);">'.getRoutecount($sp_id).'</a></td>-->
			<td  align="center">'.getBuscount($sp_id).'&nbsp;'.$link_bus.'</td>
			<td align="left">'.$sp_contname.'</td>
			<td align="left">'.$sp_emgcalno.'</td>
			<td>
			<span id="chg_'.$sp_id.'">
				<a href="javascript:void(0);" onclick="change_SP_status('.$sp_id.','.$chg_status.');" title="'.$title.'"> 
				<img src="'.$src.'" border="0" /></a>
				</span>
			<a href="new_providers.php?sp_id='.$sp_id.'"><img src="../images/edit.png" border="0" title="Edit" /></a>				
				<a href="javascript:void(0);" onclick="del_SP('.$sp_id.');"><img src="../images/delete.png" border="0" title="Delete" /></a>
				<!--<a href="javascript:void(0);" onclick="alert(\' This is Demo version !!!\')"><img src="../images/delete.png" border="0" title="Delete" /></a>-->
					 </td>
		  </tr>';
		}
    }
	else {
            $msg.='<tr>
			<td align="left"><span class="err_msg">No Service Providers.</span></td>
			<td><span class="err_msg">...</span></td>			
			<td><span class="err_msg">...</span></td>
			<td><span class="err_msg">...</span></td>
			<td><span class="err_msg">...</span></td>
			<td><span class="err_msg">...</span></td>
			<td><span class="err_msg">...</span></td>
		  </tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data


/* --------------------------------------------- */


$query_pag_num = "SELECT COUNT(*) AS count FROM serviceprovider_info ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query_pag_num .=" WHERE ";
  $query_pag_num .=" `SP_name` LIKE '%".$search."%' OR `SP_email` LIKE '%".$search."%' OR `SP_vat` LIKE '%".$search."%' OR `SP_address1` LIKE '%".$search."%' OR `SP_address2` LIKE '%".$search."%' OR `SP_city` LIKE  '%".$search."%' OR `SP_state` LIKE '%".$search."%' OR `SP_landNo1` LIKE '%".$search."%' OR `SP_landNo2` LIKE '%".$search."%' OR `SP_mobile1` LIKE '%".$search."%' OR `SP_mobile2` LIKE '%".$search."%' OR `SP_mobile3` LIKE  '%".$search."%' OR `SP_fax` LIKE '%".$search."%' OR `SP_emgFname` LIKE '%".$search."%' OR `SP_emgDesignation` LIKE '%".$search."%' OR `SP_emgCallno` LIKE  '%".$search."%' OR `SP_comments` LIKE '%".$search."%' ORDER BY SP_name ";  
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
$msg .= "<br><div style='text-align:center;'><div class='pagination'><table border='0' align='center'><tr>";

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
echo $msg; echo "<div>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />
