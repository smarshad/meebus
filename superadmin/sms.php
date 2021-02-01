<?php
   include_once("includes/header.php");


 $page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 1;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
?>
<body>

<fieldset class="table-bor">

		<legend><strong>SMS Management</strong></legend> 

						<div style=" width:98%; height:auto;border:1px solid #B7E3FF; background:#F3FBFF;font-size:12px;">
					<table width="100%" border="0" cellpadding="3" cellspacing="5">	
					<tr><td colspan='9' align='center'><strong>SMS Details </strong></td></tr>
				    <tr>
					<th>S.No</th>
					<th> User Type </th>
					<th> Ticket No </th>
					<th> SMS From </th>
					<th> SMS To </th>
					<th> Date </th>
					<th> Status </th>
					<th> Action </th>
				    </tr>
				
		<?php 
				
					//$qry = mysql_query("SELECT * FROM smslog");
					 //$num = mysql_num_rows($qry);
					 $i=1;
					 	  $result_pag_num = mysql_query("SELECT * FROM smslog");
//$roow = mysql_fetch_array($result_pag_num);
$count = mysql_num_rows($result_pag_num);
$no_of_paginations = ceil($count / $per_page);
					 
					 
					while($row = mysql_fetch_array($result_pag_num))
					{  					
					//$qry1=mysql_fetch_array(mysql_query("select * from passengerinfo where Ticket_ID = '".$ticket."' "));					 
				?>				
				<tr>
					<td><?php echo  $i++; ?></td>	
					<td> <?php if($row['sms_usertype']=="0") {  echo "UnKnown User"; } else { echo "Registered User"; }  ?> </td>
					<td> <?php echo $row['sms_ticket']; ?> </td>
					<td> <?php echo $row['sms_from']; ?> </td>
					<td> <?php echo $row['sms_to']; ?> </td>
					<td> <?php echo $row['datetime']; ?> </td>
					<td> <?php if($row['status']=="1") {  echo "Delivered"; } else { echo "Pending"; }  ?> </td>
					<td> Delete</td>
				</tr>
				<?php } ?>
				
				</table>
				</div>
<?php
                

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
?>
		
		</fieldset>
</body>
