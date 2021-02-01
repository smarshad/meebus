<?php
include_once "server/server.php";
include "bus_library/APICaller.php";
include "includes/pdo_functions.php";
$obj=new user_module($con);
$seats=explode(',',$_GET['seats']);
$ticket=$_GET['ticket'];
$request=array("etsTicketNo"=>"$ticket","seatNbrsToCancel"=>$seats);
$requestjson=json_encode($request);
$cancel_confirm=cancelTicketConfirmation($requestjson);
if($cancel_confirm['apiStatus']['message']=='SUCCESS')
{
	$cancellable=$cancel_confirm['cancellable'];
	$partial_cancel=$cancel_confirm['partiallyCancellable'];
	$totalTicketFare=$cancel_confirm['totalTicketFare'];
	$totalRefundAmount=$cancel_confirm['totalRefundAmount'];
	$cancelChargesPercentage=$cancel_confirm['cancelChargesPercentage'];
	$cancellationCharges=$cancel_confirm['cancellationCharges'];
	$can_confirmdata=json_encode($cancel_confirm);
	$update_confdata=$obj->updateCancelconfirm(array($can_confirmdata,$ticket));
}
else
{
	$cancellable=$cancel_confirm['cancellable'];
	$partial_cancel=$cancel_confirm['partiallyCancellable'];
	$totalTicketFare=$cancel_confirm['totalTicketFare'];
	$totalRefundAmount=$cancel_confirm['totalRefundAmount'];
	$cancelChargesPercentage=$cancel_confirm['cancelChargesPercentage'];
	$cancellationCharges=$cancel_confirm['cancellationCharges'];
	$can_confirmdata=json_encode($cancel_confirm);
	$update_confdata=$obj->updateCancelconfirm(array($can_confirmdata,$ticket));
}
?>
<table border="0" align="center" class="ticket-details" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="bgss">Ticket Cancellable</td>
        <td class="bgssrig">
            <?php if($cancellable==true) { echo "Yes";} else { echo "No";}?>
        </td>
        <td class="bgss">Partial Cancel</td>
        <td class="bgssrig">
            <?php if($partial_cancel==true) { echo "Yes";} else { echo "No";}?>
        </td>
    </tr>
    <tr>
        <td class="bgss">Total Ticket Fare </td>
        <td class="bgssrig"><?php echo $totalTicketFare;?></td>
        <td class="bgss">Total Refund Amount</td>
        <td class="bgssrig"><?php echo $totalRefundAmount;?></td>
    </tr>
    <tr>
        <td class="bgss">Cancellation Charge Percentage</td>
        <td class="bgssrig"><?php echo $cancelChargesPercentage;?></td>
        <td class="bgss">Cancellation Charge </td>
        <td class="bgssrig"><?php echo $cancellationCharges;?></td>
    </tr>
    <tr>
    
    	<td colspan="4" align="center">
        <form method="post" action="cancel.php">
    <input type="hidden" name="ticket" value="<?php echo $_GET['ticket'];?>"  />
    <input type="hidden" name="seats" value="<?php echo $_GET['seats'] ?>"  /><input type="submit" class="sub-but" name="con-canl" id="con-canl" value="Confirm Cancel"> </form></td>
      
    </tr>
</table>