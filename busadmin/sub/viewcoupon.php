<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
session_start();
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

$str=mysql_real_escape_string($_REQUEST['search']);
$res = (int)$str;
if($res!=0){
   $str=(string)$str;
   $va="bus_coupons.coup_sp=".$str;
}

$ex=explode("||",$_REQUEST['status']);
$need_id=$_SESSION['SP_id'];
$coupid=$ex[0];
$status=$ex[1];
$ssp_id=$ex[2];
$bus_idd=$ex[3];


$query="SELECT businfo.* , bus_coupons.* FROM businfo, bus_coupons WHERE businfo.SP_id=".$need_id."  AND bus_coupons.coup_bus=".$bus_idd."  AND businfo.Bus_id=bus_coupons.coup_bus AND businfo.SP_id = bus_coupons.coup_sp AND (".$va.")";

$flag=0;

if($coupid!=-1){
  $query.="  AND ";
  $query.=" bus_coupons.coup_id=".$coupid;
  $flag=1;
}
if($status!=-1){
   //if($flag==1)
     $query.=" AND ";
  $query.=" bus_coupons.coup_status=".$status;
  $flag=1;
}

$query.=" ORDER BY bus_coupons.`coup_id` DESC";
$qry=$query;
$result_pag_data = mysql_query($query) or die(mysql_error());
$msg = "";

$msg .='<div class="data" style="width:100%;"><table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';

  if(mysql_num_rows($result_pag_data)>0){
  $g=0;
		while ($row = mysql_fetch_array($result_pag_data)) {
               
			   
			   $Bus_coup=$row['coup_unique'];
			   $coup_per=$row['coup_perc'];
			   $coup_date=date("d-m-Y",strtotime($row['coup_date']));
			   $coup_date1=date("d-m-Y",strtotime($row['coup_date1']));
			   $sts=$row['coup_status'];
			   $coup_id=$row['coup_id'];
			    $Bus_name=$row['Bus_name'];
			   /*$bus_id=$row['Bus_id'];		   
			   $SP_id=$row['SP_id'];*/
			   
		if($sts==1){
		
		 $title="Click to Unblock";
		 $style="memtype memtype-agent";
		   $src="Blocked";
		   $s=0;
		   		  }
		else if($sts==0){
		   $s=1;
		   $title="Click to Block";
		  $style="memtype memtype-pending";
		   $src="Available";

		}  
		else if($sts==2){
		   $s=2;
		   $title="Coupon used";
		  $style="memtype memtype-build";
		   $src="Coupon Used";

		}  
		if($g==0){
           $msg.='<tr><td style="width:100px;" colspan="2"><strong>Bus Name:</strong>&nbsp;'.ucfirst($Bus_name).'</td>
		   <td style="width:140px;" colspan="4"><a href="addnewcoupon.php?sp_id='.$SP_id.'&busid='.$bus_idd.'" class="ovalbutton"><span><strong>Add Coupon</strong></span></a></td>
		   </tr>';
		   $msg.='<tr>
	<td align="left" ><strong>Promotional Code</strong></td>
	<td width="5%"></td>	
	<td align="left"><strong>Discount Percent</strong></td>
	<td align="left"><strong>From Date</strong></td>
	<td align="left"><strong>To Date</strong></td>
	<td style="padding-left:50px;"><strong>Actions</strong></td>
	<td></td>
</tr>';
		   }
         $g+=1;
		$msg.='<tr>';
		$msg.='
		    			
			<td align="left"><a href="#"><b>'.$Bus_coup.'</b></a></td>
			<td></td>
			<td align="left">'.$coup_per.' '.'%'.'</td>
			<td align="left">'.$coup_date.'</td>
			<td align="left">'.$coup_date1.'</td>
			<td >	
			<a href="javascript:void(0);" onclick="changecoupstatus('.$coup_id.','.$s.')" title=" '.$title.'">
			<span class="'.$style.'">'.$src.'</span>
			</a>&nbsp;&nbsp;&nbsp;		
			<a href="editcoupon.php?coupid='.$coup_id.'&sp_id='.$SP_id.'&bus_id='.$bus_idd.'" title="Edit Coupon Percentage">
			<img src="../images/edit.png" border="0" title="Edit" /></a>&nbsp;&nbsp;
			
			<a href="javascript:void(0);" onclick="delcoup('.$coup_id.')" title="Delete">
			
			<img src="../images/delete.png" border="0" />
			</a>
			</td><td></td>';		
		$msg.='</tr>';

		}
    }
	else {
            $msg.='<tr>
			<td><span class="err_msg"></span></td>
			 <td><a href="addnewcoupon.php?sp_id='.$SP_id.'&busid='.$bus_idd.'" class="ovalbutton"><span><strong>Add Coupon</strong></span></a></td>
			 <td><span class="err_msg"></span></td></tr>
			 <tr>
			<td align="center" colspan="4"><span class="err_msg">No Coupons.</span></td>
			
		  </tr>';	
	}	
	$msg.= "</table></div>" ;
$msg =  $msg ; // Content for Data


/* --------------------------------------------- */
$result_pag_num = mysql_query($qry) or die(mysql_error());

//echo $result_pag_num ; exit ;$count

$row = mysql_fetch_array($result_pag_num);
$count =mysql_num_rows($result_pag_num);
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
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;' onkeydown='return isNumberKey(event)' /><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=200px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?><br />