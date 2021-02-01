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
   $va="serviceprovider_info.SP_id=".$str;
}

$ex=explode("||",$_REQUEST['status']);
$need_id=$_SESSION['SP_id'];
$type=$ex[0];
$from=$ex[1];
$to=$ex[2];
$status=$ex[3];

$query="SELECT businfo.* , serviceprovider_info.* FROM businfo, serviceprovider_info WHERE businfo.SP_id = serviceprovider_info.SP_id";

$flag=0;

if($type!=-1){
  $query.="  AND ";
  $query.=" businfo.Bus_type=".$type;
  $flag=1;
}

if($from!=-1){
   //if($flag==1)
     $query.=" AND ";
  $query.=" businfo.Bus_fromcity=".$from;
  $flag=1;
}

if($to!=-1){
   //if($flag==1)
     $query.=" AND ";
  $query.=" businfo.Bus_tocity=".$to;
  $flag=1;
}

if($status!=-1){
   //if($flag==1)
     $query.=" AND ";
  $query.=" businfo.Bus_status=".$status;
  $flag=1;
}

$query.=" ORDER BY businfo.`Bus_adddate` DESC";
$qry=$query;

$result_pag_data = mysql_query($query) or die(mysql_error());
$msg = "";

$msg .='<div class="data" style="width:100%;"><table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';

  if(mysql_num_rows($result_pag_data)>0){
  $g=0;
		while ($row = mysql_fetch_array($result_pag_data)) {
               $SP_name=$row['SP_name'];
			   $Bus_name=$row['Bus_name'];
			    
			   $Bus_type=$row['Bus_type'];
		       $from_to=get_city_name($row['Bus_fromcity'])."-".get_city_name($row['Bus_tocity']);
			   $Bus_fare=$row['Bus_fare'];
			   $sts=$row['Bus_status'];
			   $bus_id=$row['Bus_id'];
			 
			  
			   $SP_id=$row['SP_id'];
			    $img_count=mysql_num_rows(mysql_query("select * from bus_images where bus_id='$bus_id' and sp_id='$SP_id' and img_status !='2'"));
			   $c_date = date("d-m-Y");
		if($sts==1){
		   $s=0;
		   $title="Click to Block";
		   $src="../images/Active.png";
		  }
		else{
		   $title="Click to Unblock";
		   $src="../images/inactive.png";
		   $s=1;
		}  
		if($g==0){
           $msg.='<tr><td style="width:100px;" colspan="4"><strong>Service Provider Name:</strong>&nbsp;'.ucfirst($SP_name).'</td>
		   <td style="width:140px;"></td>
		   </tr>';
		   $msg.='<tr>
	<td align="left" ><strong>Bus Name</strong></td>	
	<!--<td align="left"><strong>Image Count</strong></td>-->	
	<td align="left"><strong>Bus type</strong></td>
	<td align="left"><strong>From-to</strong></td>
	<td align="left"><strong>Fare</strong></td>	
	<!--<td align="left"><strong>Un/Block Seats</strong></td>
	
	<td align="left"><strong>Disable Date</strong></td>-->
	
	<td align="left"><strong>View Coupons</strong></td>
	
</tr>';
		   }
         $g+=1;
		$msg.='<tr>';
		$msg.='			
			<td align="left"><a href="editBus.php?busid='.$bus_id.'" style="text-decoration:underline;"><b>'.$Bus_name.'</b></a></td>
			<!--<td align="left"><a href="view_busimages.php?sp_id='.$SP_id.'&busid='.$bus_id.'" style="text-decoration:underline;">'.$img_count.'</a></td>-->
			<td align="left">'.get_bus_type($Bus_type).'</td>
			<td align="left">'.$from_to.'</td>
			<td align="left">'.$Bus_fare.'</td>
			<!--<td>
			<a onclick="submit_hidform('.$bus_id.')" href="javascript:submit_hidform('.$bus_id.')" title="Block Seats In this Bus">Block Seats</a>
			</td>
			
			<td align="center">
			
				<a href="disabledate.php?sp_id='.$SP_id.'&busid='.$bus_id.'" title="Edit Bus Details">
			<img src="images/dateIcon.gif" border="0" title="Edit" /></a>
			</td>-->
			
			<td style="width:100px;">	
			<a href="viewcoupon.php?sp_id='.$SP_id.'&busid='.$bus_id.'" title="View all the coupons">
			view coupons
			</a>		
			
			</td>';		
		$msg.='</tr>';

		}
    }
	else {
            $msg.='<tr>
			<td align="center"><span class="err_msg"></span></td>
			 <td align="right"></td>
			 <td><span class="err_msg"></span></td></tr>
			 <tr>
			<td align="center"><span class="err_msg">No Buses.</span></td>
			<td><span class="err_msg">...</span></td>			
			<td><span class="err_msg">...</span></td>
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