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

$query = "SELECT * FROM users";

if(isset($_REQUEST['search']) && $_REQUEST['search']!='')
{

  $search=mysql_real_escape_string($_REQUEST['search']);
  
  $flag=1;
  
  $query .=" WHERE ";
  $query .=" (`user_email` LIKE '%".$search."%' OR `user_firstname` LIKE '%".$search."%' OR `user_lastname` LIKE '%".$search."%' OR `user_address1_1` LIKE '%".$search."%' OR `user_address1_2` LIKE '%".$search."%' OR `user_address1_city` LIKE  '%".$search."%' OR `user_address1_state` LIKE '%".$search."%' OR `user_landno` LIKE '%".$search."%' OR `user_mobileno` LIKE '%".$search."%' OR `user_address1_pin` LIKE '%".$search."%')";  
  }
   
  $all = $_REQUEST['status'] ;
  
  $val = explode('^^',$all) ;
  
  $gen 	  =  $val[0] ;
  $utype  =  $val[1] ; 
  $status =  $val[2] ; 
  
  
  if($status!='2')
  {
  if($flag==1){
  $query .=" AND ";
  }
  else{
  $query .=" WHERE ";
  }
  
  $flag=1 ;
  
  $query .=" user_status = ".$status;
  }
  
  if($utype != '0')
  {

  if($flag==1){
  $query .=" AND ";
  }
  else{
  $query .=" WHERE ";
  }
  
  $flag=1 ;
  $query .=" user_typeID = ".$utype;
  }

//  echo $gen ; exit ;

  if($gen!= '0')
  {

  if($flag==1){
  $query .=" AND ";
  }
  else{
  $query .=" WHERE ";
  }
  
  $flag=1 ;
  $query .=" user_gender = '".$gen."'";
  }

	$query .= " LIMIT $start, $per_page";


$result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<div class="data"><table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <th>User Name</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Mobile</th>
    <th>City</th>
    <th>User Type</th>
    <th align="center">Actions</th>
  </tr>';
  
  if(mysql_num_rows($result_pag_data)>0)
  {
		while ($row = mysql_fetch_array($result_pag_data)) 
		{
		
		$sp_id=$row['user_id'];
		
		$sp_email=$row['user_email'];

		$user_gender1= $row['user_gender'];
	
		if($user_gender1 == 'f')
		{
			$user_gender = "Female" ;
		}		
		else if($user_gender1 == 'm')
		{
			$user_gender = "Male" ;
		}
		
		$sp_contname=$row['user_firstname'];
		$mobile=$row['user_mobileno'];
		$sp_name=htmlentities($row['user_firstname']).' '.htmlentities($row['user_lastname']);
		
		$city = $row['user_address1_city'];
		
		$utype = $row['user_typeID'];
		
		$sql = mysql_fetch_array(mysql_query("select * from usertypes where usertype_id='$utype' ")) ;
		
		$utype= $sql['usertype_name'] ;
				
		$sp_status=$row['user_status'];
		
		if($sp_status==1)
		{
		   $sta="<a href='inactive.php?memid=".$sp_id."'><img src='../images/Active.png' title='Deactive This User' border='0px'/></a>";  
		   $chg_status=0;
		   $styl=" class='suc_msg'";
		}
		else
		{
		   $sta="<a href='active.php?memid=".$sp_id."'><img src='../images/inactive.png' title='Active This User' border='0px' /></a>";
		   $chg_status=1;
		   $styl=" class='err_nsg'";
		}
		
		//$str='return confirm("Do want to Delete this User");';
		
		$msg.='<tr>
			<td align="left">
			<a href="view_member.php?memid='.$sp_id.'" class="link1">'.ucwords($sp_name).'</a></td>
			<td align="left">'.$sp_email.'</td>
			<td align="left">'.$user_gender.'</td>
			<td align="left">'.$mobile.'</a></td>
			<td align="left">'.$city.'</td>
			<td align="left">'.$utype.'</td>
			<td>
					'.$sta.'
					<a href="edit_member.php?memid='.$sp_id.'"><img src="../images/edit.png" border="0" title="View" /></a>	
					
				<!--	
					<a href="javascript:void(0);" onclick="delusr('.$sp_id.')">
						<img src="../images/delete.png" border="0px" style="cursor:pointer;" title="Delete This User"  />
					</a>-->
					
					<a href="delete_member.php?memid='.$sp_id.'" onclick="return confirm("Do want to Delete this User");">
					
					<!--<a href="#" onclick=return confirm("Do You want to Delete this User");>	-->
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


$query_pag_num = "SELECT COUNT(*) AS count FROM users ";

if(isset($_REQUEST['search']) && $_REQUEST['search']!=''){
  $search=mysql_real_escape_string($_REQUEST['search']);
  $query_pag_num .=" WHERE ";
  

  $query_pag_num .=" (`user_email` LIKE '%".$search."%' OR `user_firstname` LIKE '%".$search."%' OR `user_lastname` LIKE '%".$search."%' OR `user_address1_1` LIKE '%".$search."%' OR `user_address1_2` LIKE '%".$search."%' OR `user_address1_city` LIKE  '%".$search."%' OR `user_address1_state` LIKE '%".$search."%' OR `user_landno` LIKE '%".$search."%' OR `user_mobileno` LIKE '%".$search."%' OR `user_address1_pin` LIKE '%".$search."%')";  
  }



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
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=200px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />
