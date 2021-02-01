<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
?>
<style type="text/css">
.classname {
	-moz-box-shadow:inset 0px 24px 9px -6px #0796d4;
	-webkit-box-shadow:inset 0px 24px 9px -6px #0796d4;
	box-shadow:inset 0px 24px 9px -6px #0796d4;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #2a90d4), color-stop(1, #14689c) );
	background:-moz-linear-gradient( center top, #2a90d4 5%, #14689c 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2a90d4', endColorstr='#14689c');
	background-color:#2a90d4;
	-webkit-border-top-left-radius:19px;
	-moz-border-radius-topleft:19px;
	border-top-left-radius:19px;
	-webkit-border-top-right-radius:19px;
	-moz-border-radius-topright:19px;
	border-top-right-radius:19px;
	-webkit-border-bottom-right-radius:19px;
	-moz-border-radius-bottomright:19px;
	border-bottom-right-radius:19px;
	-webkit-border-bottom-left-radius:19px;
	-moz-border-radius-bottomleft:19px;
	border-bottom-left-radius:19px;
	text-indent:0px;
	border:1px solid #0a94c2;
	display:inline-block;
	color:#f2f2f2;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	font-style:normal;
	height:18px;
	line-height:20px;
	width:40px;
	text-decoration:none;
	text-align:center;
}
.classname:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #14689c), color-stop(1, #2a90d4) );
	background:-moz-linear-gradient( center top, #14689c 5%, #2a90d4 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#14689c', endColorstr='#2a90d4');
	background-color:#14689c;
}.classname:active {
	position:relative;
	top:1px;
}</style>

<?php 
if(isset($_REQUEST['page']))
{
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

$query="SELECT * FROM bookinginfo,serviceprovider_info WHERE bookinginfo.cancelledStatus=0 AND bookinginfo.Blocked=0";
if($_REQUEST['search']!=''){
//echo "first";
   $sp=mysql_real_escape_string($_REQUEST['search']);
   
   $query.=" AND  serviceprovider_info.SP_id LIKE '%".$sp."%' AND bookinginfo.SP_id = serviceprovider_info.SP_id ";
   $flag=1;
}

$query.="  GROUP BY serviceprovider_info.SP_id ORDER BY serviceprovider_info.SP_name ";
$qry=$query;

 $query.=" LIMIT $start,$per_page";
 
 //echo $query; 
 
$msg .='<div class="data" style="width:100%;"><table border="0" width="100%" cellspacing="2" cellpadding="5" align="left">';
		   $msg.='<tr>
			<td align="left"><strong>Travels Name</strong></td>	
			<td align="left"><strong>No.of Buses</strong></td>
			<td align="left"><strong>Total Collection</strong></td>
			<td align="left"><strong>Sold Tickets</strong></td>
			
			<td align="center"><strong>T/C1</strong></td>
			
			<td align="center"><strong>T/C2</strong></td>
			
			<td align="center"><strong>C1</strong></td>
			
			<td align="center"><strong>C2</strong></td>
			
			<td align="center"><strong>BR</strong></td>
			
			<td align="center"><strong>TAX</strong></td>
			
			<td align="center"><strong>TA </strong></td>
			
			<td align="center"><strong>TF</strong></td>
			
			
			
			<td align="left"><strong>Sent Amount </strong></td>
			
			<td align="left"><strong>Balance </strong></td>
			
			<td align="left" colspan="2"><strong>Payment Option</strong></td>
		    </tr>';
$sql=mysql_query($query) or die(mysql_error());
$chk_SP=0; $chk_dat=0;

$temp_bal='0';
$temp_sent='0';
$temp_sp='0';
$temp_ai='0';
$temp_tax='0';
$temp_b='0';
$temp_c1='0';
$temp_c2='0';
$temp_tot='0';
$temp_tic='0';
if(mysql_num_rows($sql)>0){
while($r=mysql_fetch_array($sql)){
     $sp_id=$r['SP_id'];
	 
	 //$_SESSION['spp_idd']=$r['SP_id'];
	 
	 $payyyyypal=$r['paypal'];
	 
	 
	 
	 $payyyyypal_id=$r['paypal_id'];
	 
	 
     $dat=$r['travelling_date'];		 
	 $buscount=get_total_bus1($sp_id);
	 $commission="0";
	  $income="0";
	// echo "SELECT SUM(pay_amount) AS pay_amount FROM payment_transaction where Service_provider_id='$sp_id'"; 

	 
	 $resuult = mysql_query("SELECT SUM(pay_amount) AS pay_amount,SUM(ticket_count) AS ticket_count FROM payment_transaction where Service_provider_id='$sp_id' and pay_status=1"); 
	 
	 
	 
$rouw = mysql_fetch_array($resuult); 

 
	 $sp_apy = mysql_query("SELECT SUM(adtrans_amount) AS paid_amt  FROM admin_transaction where adtrans_spid ='$sp_id' and pay_status=1");
	 
	$sp_apyamt = mysql_fetch_array($sp_apy); 
 
 $gs = mysql_query("select * from generalsettings") or die(mysql_error());

$gsfetch=mysql_fetch_array($gs);
$taxval=$gsfetch['tax'];
	
	$paayb_rate=$gsfetch['bankrate_paypal'];
	
 if($sp_apyamt['paid_amt']=="")
{
$paiii='0';
}
else
{
$paiii = $sp_apyamt['paid_amt'];
}


	 

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

//echo $t;

if($rouw['ticket_count']=="")
{
$tic='0';
}
else
{
$tic = $rouw['ticket_count'];
}


//echo $taxval; exit;

	 
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
	 
	//echo $aincome; 
	 
	 $sincome=$sum-$aincome;
	 
	 $balll=$sincome-$paiii;
	 
	 
	 $temp_bal=$temp_bal+$balll;
	 $temp_sent=$temp_sent+$paiii;
	 $temp_sp=$temp_sp+$sincome;
	 $temp_ai=$temp_ai+$aincome;
	 $temp_tax=$temp_tax+$t;
	 $temp_b=$temp_b+$br;
	 $temp_c1=$temp_c1+$tcom_per1;
	 $temp_c2=$temp_c2+$tcom_per2;
	  $temp_tot=$temp_tot+$sum;
	  $temp_tic=$temp_tic+$tic;
	 //count($_SESSION['sincome'])=$sincome;
	 
if(($payyyyypal=='1') && ($balll !='0'))
			{ 
 //echo $sum;

$ppppy='<a href="process.php?sp_id='.$sp_id.'&amt='.$balll.'" class="classname">Paypal</a>';
 
}  else { 
$ppppy='';
}

if($balll !='0'){ 
 
 $pppp='<a href="bank.php?sp_id='.$sp_id.'&item='.$r['SP_name'].'" class="classname">Bank</a>';
 }
else
 {
$pppp='';
}
	 if($chk_SP!=$sp_id || $chk_dat!=$dat){		 	   
	 $msg.='<tr>';
	 $msg.='<td align="left">'.get_SP_name($sp_id).'</td>
	    	<td align="left">
			<a href="paymentperSP.php?sp_id='.$sp_id.'">'.$buscount.'</a></td>
			<td align="center">'.$sum.'</td>
			<td align="center">'.$tic.'</td>
			
			<td align="center">'.$com_per1.'</td>
			<td align="center">'.$com_per2.'</td>
			
			<td align="center">'.$tcom_per1.'</td>
			<td align="center">'.$tcom_per2.'</td>
			
			<td align="center">'.$br.'</td>
			<td align="center">'.$t.'</td>
			
			<td align="center">'.$aincome.'</td>
			
			<td align="center">'.$sincome.'</td>
			
			
			<td align="center">'.$paiii .'</td>
			
			<td align="center">'.$balll.'</a></td>
			
		    <td align="center">'.$pppp.'</a></td>
			
			<td align="center">'.$ppppy.'</a></td>
			
			</tr>';
	 }
	 $chk_SP=$sp_id; $chk_dat=$dat;	 
    }
	
	
			 
			$bus_total = mysql_num_rows(mysql_query("SELECT * FROM businfo where Bus_status=1")); 
	
	$msg.='<tr bgcolor="#CCCCCC"><td align="left"><b>Total Amount</b></td><td align="left"><b>'.$bus_total.'</b></td><td align="center"><b>'. $temp_tot.'</b></td><td align="center"><b>'.$temp_tic.'</b></td><td align="center"></td><td align="center"></td><td align="center"><b>'.$temp_c1.'</b</td><td align="center"><b>'.$temp_c2.'</b</td><td align="center"><b>'.$temp_b.'</b></td><td align="center"><b>'.$temp_tax.'</b></td><td align="center"><b>'.$temp_ai.'</b></td><td align="center"><b>'.$temp_sp.'</b></td><td align="center"><b>'.$temp_sent.'</b></td><td align="center"><b>'.$temp_bal.'</b></td><td align="center"></td></tr>';
	
	}
	 else{
     $msg.='<tr><td align="left"></td>
	    	<td align="left"><span class="err_msg">No Records Found</span></td>
			<td align="left"></td>
			<td align="left"></td></tr>';	 
	 }
	 $msg.= "</table></div>" ;

	
/* --------------------------------------------- */
$query_pag_num=$qry;
$result_pag_num = mysql_query($query_pag_num);
$r = mysql_fetch_array($result_pag_num);
$count=mysql_num_rows($result_pag_num);
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
$goto = "<input type='text' class='goto' size='1'  onkeydown='return isNumberKey(event)'/><input type='button' id='go_btn'  value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</tr> </table></div>";  // Content for pagination
echo $msg; echo "<div style='width=300px; float:right;'>".$goto."&nbsp;&nbsp;".$total_string ."</div></div>" ;
}
?>