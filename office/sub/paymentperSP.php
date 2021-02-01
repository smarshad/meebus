<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['page']))
{
//print_r($_REQUEST);
//exit;
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

$str=mysql_real_escape_string($_REQUEST['search']);


$query="SELECT * FROM businfo WHERE SP_id=".$str." AND Bus_status='1' ";


$flag=0;

$query.=" ORDER BY businfo.`Bus_name`"; 
$qry=$query;
$query.=" LIMIT $start,$per_page";

//echo $query; 

$result_pag_data = mysql_query($query) or die(mysql_error());
$msg .='<div class="data" style="width:100%;">
            <a href="javascript:history.go(-1)"> << Back </a>             
            <table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';
		    $msg.='<tr>
			<td align="left"><strong>Bus Name</strong></td>	
			<td align="left"><strong>Bus Type</strong></td>				
			<td align="left"><strong>From-to</strong></td>
			<td align="left"><strong>Total Amount</strong></td>
			<td align="left"><strong>Sold Tickets</strong></td>
			<td align="left"><strong>T/C1</strong></td>
			<td align="left"><strong>T/C2</strong></td>
			<td align="left"><strong>C1</strong></td>
			<td align="left"><strong>C2</strong></td>
			<td align="left"><strong>BR</strong></td>
			<td align="left"><strong>TAX</strong></td>
			<td align="left"><strong>TA</strong></td>
			<td align="left"><strong>TF</strong></td>
			
			<td align="left"><strong>Transaction Details</strong></td>
		    </tr>';
			
			
			
if(mysql_num_rows($result_pag_data)){



$chk_bus=0;  $tot=0;

 
$temp_bal='0';
$temp_sent='0';
$temp_sp='0';
$temp_ai='0';
$temp_tax='0';
$temp_b='0';
$temp_c1='0';
$temp_c2='0'; 
$temp_tic='0';
$temp_tot='0';

	while($row=mysql_fetch_array($result_pag_data)){
	    if($chk_bus!=$row['Bus_id']){
		$SP_id=$row['SP_id'];
		$Bus_id=$row['Bus_id'];
		$date1=$row['travelling_date'];
		$Bus_name=$row['Bus_name'];
		$from=$row['Bus_fromcity'];
		$to=$row['Bus_tocity'];
		$type=$row['Bus_type'];
		$ind_fare=get_ind_fare($Bus_id,changedateformat($date));	
		$tot+=$ind_fare;
		$from_to=get_city_name($from)."-".get_city_name($to);
		
		$r=mysql_fetch_array(mysql_query("SELECT * FROM serviceprovider_info where SP_id='$SP_id'"));
		
	
	$resuult = mysql_query("SELECT SUM(pay_amount) AS pay_amount,SUM(ticket_count) AS ticket_count FROM payment_transaction where bus_id='$Bus_id' and pay_status=1"); 
		 
		 //echo "SELECT SUM(pay_amount) AS pay_amount,SUM(ticket_count) AS ticket_count FROM payment_transaction where bus_id='$Bus_id' and pay_status=1"; 
		 
$rouw = mysql_fetch_array($resuult); 



$gs = mysql_query("select * from generalsettings") or die(mysql_error());

$gsfetch=mysql_fetch_array($gs);
$taxval=$gsfetch['tax'];
	
	$paayb_rate=$gsfetch['bankrate_paypal'];
	
if($rouw['pay_amount']=="")
{
$sum='0';
$t='0';
}
else
{

$sum = $rouw['pay_amount'];
$t=($taxval/100)*$sum;
}
if($rouw['ticket_count']=="")
{
$tic='0';
}
else
{
$tic = $rouw['ticket_count'];
}

//echo $tic; 

	 $c1=$r['comm_user'];
	 $c2=$r['comm_sp'];
	 $b=$paayb_rate/100;

	 
	 $com1=100/($c1);
	 
	 $com2=100/($c2);
	 
	 	 $com_per1=$sum/$com1;
		 
	  $com_per2=$sum/$com2;
	  
	  
	 if($com_per1=="")
	 {
	 $com_per1='0';
	 }
	 else
	 {
	 $com_per1=$sum/$com1;
	 }
	 
	 if($com_per2=="")
	 {
	 $com_per2='0';
	 }
	 else
	 {
	 $com_per2=$sum/$com2;
	 }
	 
	 $com_per=($com_per1 + $com_per2);
	 
	// echo $com_per;
	 $tcom_per1=$tic*($sum/$com1);
	 $tcom_per2=$tic*($sum/$com2);
	 
	 $com_amt=$tic*$com_per;
	 
	// echo $tic;
	 $tot_amt=$sum-$com_amt;
	 
	 $br=($paayb_rate/100)*$tot_amt;
	 
	 $aincome=($com_amt+$br+$t);
	  $sincome=$sum-$aincome;

   $temp_bal=$temp_bal+$balll;
	 $temp_sent=$temp_sent+$paiii;
	 $temp_sp=$temp_sp+$sincome;
	 $temp_ai=$temp_ai+$aincome;
	 $temp_tax=$temp_tax+$t;
	 $temp_b=$temp_b+$br;
	 $temp_c1=$temp_c1+$tcom_per1;
	 $temp_c2=$temp_c2+$tcom_per2;
	 $temp_tic=$temp_tic+$tic;
	 $temp_tot=$temp_tot+$sum;
	 
	 
		$msg.='<tr>';
		$msg.='<td align="left">'.$Bus_name.'</td>
		       <td align="left">'.get_bus_type($type).'	</td>		   
			   <td align="left">'.$from_to.'</td>
			 
			   <td align="left">'.$sum.'</td>
			   
			     <td align="center">'.$tic.'</td>
			   
			    <td align="left">'.$com_per1.'</td>
				 <td align="left">'.$com_per2.'</td>
				  <td align="left">'.$tcom_per1.'</td>
				 <td align="left">'.$tcom_per2.'</td>
				  <td align="left">'.$br.'</td>
				 <td align="left">'.$t.'</td>
				  <td align="left">'.$aincome.'</td>
				   <td align="left">'.$sincome.'</td>
			   
			   <td align="left"><a href="paymentpertrans.php?sp_id='.$str.'&b_id='.$Bus_id.'">'.Detail.'</a>';
		$msg.='</tr>';	   		
		}
		
		$chk_bus=$row['Bus_id'];		
		
		
	}
	
		
		 
		 	 $bus_total = mysql_num_rows(mysql_query("SELECT * FROM businfo where Bus_status=1"));
			 
			 
			 
	
	$msg.='<tr bgcolor="#CCCCCC"><td align="right" colspan="3"><b>Total Amount</b></td><td align="center"><b>'.$temp_tot.'</b></td><td align="center"><b>'.$temp_tic.'</b></td><td align="center"></td><td align="center"></td><td align="center"><b>'.$temp_c1.'</b</td><td align="center"><b>'.$temp_c2.'</b</td><td align="center"><b>'.$temp_b.'</b></td><td align="center"><b>'.$temp_tax.'</b></td><td align="center"><b>'.$temp_ai.'</b></td><td align="center"><b>'.$temp_sp.'</b></td><td align="center"></td></tr>';
	
	
	}
	else {
            $msg.='<tr>
			<td></td>
			<td align="left"><span class="err_msg"><span class="err_msg">No Records Found.</span></span></td>			
			<td></td>
		  </tr>';	
	}	
	 $msg.= "</table></div>" ;


/* --------------------------------------------- */
$query_pag_num=$qry;
$result_pag_num = mysql_query($query_pag_num);
$r = mysql_fetch_array($result_pag_num);
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