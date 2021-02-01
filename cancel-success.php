<?php
include "bus_library/APICaller.php";
include_once "header.php";
$ref=$_GET['ref'];
$res=$obj->getCancelledDet(array($ref));
$res=$res[0];
$result=json_decode($res['cancel_data'],1);
?>
<style>
._3JslKL {
    border-top: 1px solid #eaeaea;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    line-height: 24px;
    font-size: 20px;
    color: #fff;
    box-shadow: 0px 2px 6px #222;
    background: #e31e25;
    margin: 15px auto;
    padding: 25px 15px;
    text-align: center;
}
._3JslKL p i {
	font-size: 50px;
}
</style>
<div  class="inner-content">
<?php if($result['apiStatus']['message']=='SUCCESS') { ?>
    <div class="_3JslKL">
    	<p><i class="fa fa-times-circle"></i></p>
        <p>Your Ticket No <strong><?php echo $ref; ?></strong> Was Cancelled Successfully!</p>
        <p>Ticket Total Fare : <strong><?php echo $result['totalTicketFare']; ?></strong></p>
        <p>Total Refund Amount : <strong><?php echo $result['totalRefundAmount']; ?></strong></p>
        <p>Cancel Charges Percentage : <strong><?php echo $result['cancelChargesPercentage']; ?></strong></p>
        <p>Cancellation Charge : <strong><?php echo $result['cancellationCharges']; ?></strong></p>
    </div>
<?php } else { ?>
	<div class="_3JslKL">
    	<p><i class="fa fa-times-circle"></i></p>
        <p>Your Ticket No <strong><?php echo $ref; ?></strong> Cancellation Failed</p>
    </div>
<?php } ?>
</div>
<?php include 'includes/footer.php'; ?>
