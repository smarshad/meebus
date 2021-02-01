<?php  
include "bus_library/APICaller.php";
include_once "header.php";
$ticketno=trim($_POST['txttick']);
$email=trim($_POST['txtemail']);
$checkEmail=$obj->checkbusEmail(array($email,$ticketno));
if($checkEmail!=0)
{
       $data=array($ticketno,$email);
       $ticketdetails=$obj->getTicketdetails($data);
}
else{
        $_SESSION['user']['bus']='Email ID AND Ticket Number Is Invalid';
	header('location:cancel_ticket.php');
	exit;
}
if($ticketdetails!=0)
{
	$ticketdetails=$ticketdetails[0];
	//echo "<pre>"; print_r($ticketdetails); echo "</pre>";
	$passenger_seat=explode('^',$ticketdetails['passenger_seat']);
	$ticketno=$ticketdetails['tiket_no'];
	$passenger=explode('^',$ticketdetails['passenger_name']);
	$passenger_age=explode('^',$ticketdetails['passenger_age']);
	$passenger_sex=explode('^',$ticketdetails['passenger_sex']);
	$mobile=$ticketdetails['mobileNbr'];
	$emailid=$ticketdetails['emailId'];
}
?>
<style>
.button
{
	width:auto;
	float:left;
	margin-left:100px;
}
.left-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/a.jpg) no-repeat;
}
.mid-btn 
{
	width:auto;
	height:28px;
	float:left;
	background:#d84f57;
	font-size:12px;
	color:#FFFFFF;	
	font-weight:bold;
}
.mid-btn a
{
	font-size:12px;
	color:#FFFFFF;
	font-weight:bold;
	text-decoration:none;
	display:block;
}
.right-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/c.jpg) no-repeat;
}
.inner-content input[type="text"] {
    width: 300px;
}
table.ticket-details {
    padding: 0px;
    border-top: 1px solid #ccc;
	border-left: 1px solid #ccc;
    background: transparent;
}
table.ticket-details td{
    padding: 10px 15px;
    border-bottom: 1px solid #ccc;
	border-right: 1px solid #ccc;
}
.left-side {
	display: inline-block;
	width: 65px;
	padding-bottom: 5px;
}
.right-side {
	display: inline-block;
}
.inner-content {
	max-width: 800px;
	margin: 20px auto 15px;
	width: 100%;	
}
.bgss {
	background: #f5f5f5;	
	width: 200px;
}
.bgssrig {
	width: 200px;
}
</style>
<div  class="inner-content">
<div class="box_head_blue">Ticket Details :<span></span> <span style="font-size:20px;color:red" id="cancel_err"></span></div>
<table border="0" align="center" class="ticket-details" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="bgss"><strong><font size="2">Ticket No</font></strong>&nbsp; </td>
        <td class="bgssrig">
            <?php echo $ticketno;?>
        </td>
        <td class="bgss"><strong><font size="2">Total Seat(s)</font></strong>&nbsp;&nbsp;</td>
        <td class="bgssrig">
            <?php echo $ticketdetails['no_of_seat'];?>
        </td>
    </tr>
    <tr>
        <td class="bgss">Email Id </td>
        <td class="bgssrig"><?php echo $emailid;?></td>
        <td class="bgss">Mobile No</td>
        <td class="bgssrig"><?php echo $mobile;?></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>Select seat to cancel</strong>&nbsp;&nbsp;</td>
    </tr>
    <input type="hidden" name="ticket" id="ticket" value="<?php echo $ticketno;?>">
        <?php  $i=0;
			foreach($passenger_seat as $seat) { ?>
    	<tr>
            <td colspan="2" style="text-align: right;">
                <input type="checkbox" name="seat[]" id="pax-seat<?php echo $i;?>" class="pax-seat" value="<?php echo $seat;?>">
                <?php echo $seat;?>
            </td>
            <td colspan="2"> <?php echo '<strong class="left-side">Name</strong><span class="right-side">: '.$passenger[$i] .'</span><br /> <strong class="left-side">Age</strong><span class="right-side">: '.$passenger_age[$i].'</span><br /> <strong class="left-side">Gender</strong><span class="right-side">: '; if($passenger_sex[$i]=='M') { echo 'Male';} else { echo 'Female';} '</span>' ?>
            </td>
    </tr>
    <?php $i++; } ?>
    <tr id="con-cancel">
		<td colspan="2" align="center"><input type="button" class="sub-but" name="resetcancel" id="resetcancel" value="Reset"></td>
    	<td colspan="2" align="center"><input type="button" class="sub-but" name="scancel" id="scancel" value="Check Cancel"></td>
    </tr>
</table>
<br clear="all" />
<div class="det"></div>
</div>
<script type="text/javascript">
$("#resetcancel").click(function ()
{
	$("#scancel").attr("disabled", false);
	$(".pax-seat").attr("disabled", false);
	$('#cancel_err').html("");
	$(".det").html("");
	$("[name^=seat]:checked").prop('checked', false);


});

$("#scancel").click(function ()
{
	$(".det").html("");
	var sel=$("[name^=seat]:checked").length;
	var $selected=$('input[name="seat[]"]');
	var vals=[];
	for(var i=0;i<sel;i++)
	{
		vals.push($selected[i].value);
	}
	var str = vals.join(',');
	var ticket=document.getElementById("ticket").value;
	if(vals.length != 0){
	$('#cancel_err').html("");
	$("#scancel").attr("disabled", true);
	$(".pax-seat").attr("disabled", true);
	$.post("getCancelDet.php?seats="+vals+"&ticket="+ticket, function (data)
	{
		$(".det").html(data);
	});
	}else{
		$('#cancel_err').html("Please choose your seat !");
	}
	
});
</script>
 