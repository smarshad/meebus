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
$coupid=$ex[0];
$status=$ex[1];


$query="SELECT * from bus_promo where promo_status!=3";

$flag=0;

if($coupid!=-1){
  $query.="  AND ";
  $query.=" bus_promo.promo_id=".$coupid;
  $flag=1;
}
if($status!=-1){
   //if($flag==1)
     $query.=" AND ";
  $query.=" bus_promo.promo_status=".$status;
  $flag=1;
}

$query.=" ORDER BY bus_promo.`promo_id` DESC";
$qry=$query;
$result_pag_data = mysql_query($query) or die(mysql_error());
$msg = "";

$msg .='<div class="data" style="width:100%;"><table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';

  if(mysql_num_rows($result_pag_data)>0){
  $g=0;
		while ($row = mysql_fetch_array($result_pag_data)) {
               
			   
			   $promo_id=$row['promo_id'];
			   $promo_title=$row['promo_title'];
			   $ctype=$row['promo_type'];
			   if($ctype==1) { $protype="Period based"; } else { $protype="Time based"; }
			   $distype=$row['promo_atype'];
			   if($distype==1) { $value="Amount"; } else { $value="Percentage"; }
			    $promo_value=$row['promo_value'];
			   $sts=$row['promo_status'];		   
			   /*$SP_id=$row['SP_id'];*/
			   
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
		else
		{ }  
		
		if($g==0){
           $msg.='<tr><td style="width:100px;" colspan="3"><strong>Click to Add New Promotional code</strong></td>
		   <td style="width:140px;" colspan="3"><a href="addpromo.php" class="ovalbutton"><span><strong>Add New Code</strong></span></a></td>
		   </tr>';
		   $msg.='<tr>
	
	<td align="left" ><strong>Promotional Code</strong></td>
	<td align="left" ><strong>Code Type</strong></td>
	<td align="left"><strong>Discount Type</strong></td>
	<td align="left"><strong>Discount Value</strong></td>
	<td align="left"><strong></strong></td>
	<td style="padding-left:50px;"><strong>Actions</strong></td>
	<td></td>
</tr>';
		   }
         $g+=1;
		$msg.='<tr>';
		$msg.='
		    			
			<td align="left"><a href="#"><b>'.$promo_title.'</b></a></td>
			
			<td align="left">'.$protype.'</td>
			<td align="left">'.$value.'</td>
			<td align="left">'.$promo_value.'</td>
			<td></td>
			<td >	
			<a href="javascript:void(0);" onclick="changepromostatus('.$promo_id.','.$s.')" title=" '.$title.'">
			<span class="'.$style.'">'.$src.'</span>
			</a>&nbsp;&nbsp;&nbsp;		
			<a href="editpromo.php?promoid='.$promo_id.'" title="Edit Promotional Code">
			<img src="../images/edit.png" border="0" title="Edit" /></a>&nbsp;&nbsp;
			
			<a href="javascript:void(0);" onclick="delpromo('.$promo_id.')" title="Delete">
			
			<img src="../images/delete.png" border="0" />
			</a>
			</td><td></td>';		
		$msg.='</tr>';

		}
    }
	else {
            $msg.='<tr>
			<td><span class="err_msg"></span></td>
			 <td><a href="addpromo.php?sp_id='.$SP_id.'&busid='.$bus_idd.'" class="ovalbutton"><span><strong>Add Coupon</strong></span></a></td>
			 <td><span class="err_msg"></span></td></tr>
			 <tr>
			<td align="center" colspan="4"><span class="err_msg">No Promotional code.</span></td>
			
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