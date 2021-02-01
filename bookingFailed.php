<?php
include "bus_library/APICaller.php";
include_once "header.php";
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
<?php if(isset($_GET['uid']) && $_GET['uid']!='') { 
	  $ref=$_GET['uid'];
	  $res=$obj->getBookingErr(array($ref));
?>
    <div class="_3JslKL">
    	<p><i class="fa fa-times-circle"></i></p>
        <p>Booking Failed!</p>
        <p><?php echo $res;?></p>
    </div>
<?php } if(isset($_SESSION['user']['bus']['err']) && $_SESSION['user']['bus']['err']!='') { ?>
	<div class="_3JslKL">
    	<p><i class="fa fa-times-circle"></i></p>
        <p>Booking Failed!</p>
        <p><?php echo $_SESSION['user']['bus']['err'];?></p>
    </div>
<?php } unset($_SESSION['user']['bus']['err']);?>
</div>
<?php include 'includes/footer.php'; ?>
