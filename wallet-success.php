<?php  
include_once "header.php";
if(!isset($_GET['ref']))
{
	header('location:index.php');
	exit;
}
$ref=$_GET['ref'];
$walDet=$obj->getwalletdet(array($ref));
$walDet=$walDet[0];
$user_id=$walDet['user_id'];
$amount=$walDet['amount'];
$balance=$obj->getBalance(array($user_id));
?>
<style>
._3JslKL {
    border-top: 1px solid #eaeaea;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    line-height: 24px;
    font-size: 20px;
    color: #e31e25;
    box-shadow: 0px 2px 6px #222;
    background: #fff;
    margin: 15px auto;
    padding: 25px 15px;
    text-align: center;
}
._3JslKL p i {
	font-size: 50px;
}
</style>
<div  class="inner-content">
    <div class="_3JslKL">
    	<?php /*?><p><i class="fa fa-times-circle"></i></p><?php */?>
        <p>Wallet amount added successfully!</p>
        <p>Amount : <?php echo $amount;?></p>
        <p>Updated Wallet balance : <?php echo $balance;?></p>
    </div>
</div>

 