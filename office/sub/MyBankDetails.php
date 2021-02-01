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
$per_page = $arr['paginate_value'];
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

$flag=0;
$query = "SELECT * FROM bank_details";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $flag=1;
  $query .=" WHERE ";
  $query .=" (`BankName` LIKE '%".$search."%' OR `BankAC_No` LIKE '%".$search."%' OR `AC_type` LIKE '%".$search."%' OR `BankEmail` LIKE '%".$search."%' OR `BankDesc` LIKE '%".$search."%')";  
  }
  
  if($_REQUEST['status']!='-1'){
  $status=$_REQUEST['status'];
  if($flag==1){
  $query .=" AND ";
  }
  else{
  $query .=" WHERE ";
  }
  
  $query .=" status = ".$status;
  }

$qry=$query;

$query .= " ORDER BY BankName LIMIT $start, $per_page ";

$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<div class="data"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td align="left"><strong>Bank Name</strong></td>
    <td align="left"><strong>A/C No.</strong></td>
    <td align="left"><strong>A/C Type</strong></td>
    <td align="left"><strong>Email</strong></td>
    <td align="left"><strong>Description</strong></td>
    <td align="left"><strong>Added On</strong></td>
	<td align="left"><strong>Status</strong></td>
  </tr>';
  if(mysql_num_rows($result_pag_data)>0){
		while ($row = mysql_fetch_array($result_pag_data)) {
		$bank_id=$row['BankID'];
		$bankname=$row['BankName'];
		$AC_No=$row['BankAC_No'];
		$Ac_type=$row['AC_type'];
		$bank_email=$row['BankEmail'];
		$dateadd=$row['dateAdded'];
		$bank_desc=$row['BankDesc'];
		$bank_status=$row['status'];
		if($bank_status==1){
		   $sta="Deactive?";
		   $chg_status=0;		   
		   $title="Click to Block";
		   $src="../images/Active.png";		   
		}
		else{
		   $sta="Active?";
		   $chg_status=1;		  
		   $title="Click to Unblock";
		   $src="../images/inactive.png";		   
		}
		
		$msg.='<tr>
			<td align="left"><a href="editbankDetails.php?BankID='.$bank_id.'">'.$bankname.'</a></td>
			<td align="left">'.$AC_No.'</td>
			<td align="center">'.$Ac_type.'</td>
			<td align="left">'.$bank_email.'</td>
			<td align="left">'.substr($bank_desc,0,10).'...</td>
			<td align="left">'.changedateformat($dateadd).'</td>
			
			<td>
			<span id="chg_'.$bank_id.'">
				<a href="javascript:void(0);" onclick="alert('.$bank_id.','.$chg_status.');" title="'.$title.'"> 
				<img src="'.$src.'" border="0" /></a>
				</span>
			<!--<a href="new_providers.php?sp_id='.$sp_id.'">--><img src="../images/edit.png" border="0" title="Edit" /><!--</a>-->				
				<!--<a href="javascript:void(0);" onclick="del_SP('.$sp_id.');">--><img src="../images/delete.png" border="0" title="Delete" /><!--</a>-->
					 </td>
		  </tr>';
		}
    }
	else {
            $msg.='<tr>
			<td align="left"><span class="err_msg">No Details.</span></td>
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

$result_pag_num = mysql_query($qry);
//$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count =mysql_num_rows($result_pag_num);
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
