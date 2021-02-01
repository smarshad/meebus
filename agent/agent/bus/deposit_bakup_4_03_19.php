<?php 
include_once'../../server/server.php';  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Deposit"; 
include_once '../includes/functions.php';
$deposit_insert='';
$obj=new agent_module($con);  
 $agent_id=$_SESSION['agent']['log']['id'];
 $data2=array($agent_id);
	$deposit_data1=$obj->getDepositfulldata($data2);
	$data3=array($agent_id);
	$deposits_data=$obj->getDepositdata($data3);
	foreach($deposits_data as $ds)
    {
		$aname=$ds['agency_name']; 
		$abal=$ds['account_balance']; 
	}
if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') { 

if(isset($_POST['submit']) && $_POST['submit']=='submit' )
{
	$amount = $_POST['amountdeposit'];
	$charges = ($amount*1)/100;
	$balance = $abal+$amount-$charges;
	$amountdeposit = $_POST['amountdeposit'];
	//$balance=$_POST['amountdeposit'];
	$agent_id=$_SESSION['agent']['log']['id'];
	$pay_in=$_POST['paymode'];
//	$data=array($agent_id,$balance,$amountdeposit,'Wallet',$pay_in);
//	$deposit=$obj->walletDeposit($data);
	$data1=array($agent_id);
	$deposit_data=$obj->getDepositdata($data1);
	foreach($deposit_data as $d)
    {
	$new = $d['new'];
	$did = $d['dist_id'];
	$agent_name = $d['agent_name'];
	$address = $d['address'];
	$state = $d['state'];
	$city = $d['city'];
	$pincode = $d['pincode'];
	$email = $d['email'];
	$mobile = $d['mobile_phone'];

	if($mobile=='') { $mobile='9994705245'; }
	$type = 'Wallet Deposit';  
	$date = date('Y-m-d');
	
		}
	
		$rdno = rand(1,9999);
	$alphabet_DDS = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
	$pass_DDS = array(); $alphaLength_DDS = strlen($alphabet_DDS) - 1; 
	for($i_DDS = 0; $i_DDS < 8; $i_DDS++) { $n_DDS = rand(0, $alphaLength_DDS); $pass_DDS[] = $alphabet_DDS[$n_DDS]; } $dynamicValues =  implode($pass_DDS);
	$alphabet_DDS1 = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
	$pass_DDS1 = array(); $alphaLength_DDS1 = strlen($alphabet_DDS1) - 1; for ($i_DDS1 = 0; $i_DDS1 < 3; $i_DDS1++) { $n_DDS1 = rand(0, $alphaLength_DDS1); $pass_DDS1[] = $alphabet_DDS1[$n_DDS1]; }  $dynamicValues1 =  implode($pass_DDS1); 
	
	$unicid	= $dynamicValues.time();
	$amount = $_POST['amountdeposit'];
	if(isset($_POST['paymode']) && $_POST['paymode']=='ebs') 
	{ 
	$hash = "63f15f30e8112933147736b6af3b02bd|17759|".urlencode($amount)."|".urlencode($rdno)."|http://busraja.com/agent/agent/successWallet.php|TEST";
	$secure_hash = md5($hash);
	?>
	<div style="margin:auto; text-align:center; margin-top:10%; vertical-align:middle;">
	<img src="images/please_wait.gif" width="400" height="200" >
	</div>
	<form action="https://secure.ebs.in/pg/ma/payment/request" name="payment" id="payment" method="POST">
	<input type="hidden" value="<?php echo $agent_name; ?>" name="name"/>
	<input type="hidden" value="<?php echo $aname; ?>" name="fullname"/>
	<input type="hidden" value="<?php echo $mobile; ?>" name="phone"/>
	<input type="hidden" value="<?php echo 25; ?>" name="age"/>
	<input type="hidden" value="<?php echo 'Male'; ?>" name="gender"/>
	<input type="hidden" value="<?php echo $account_id = '17759'; ?>" name="account_id"/>
	<input type="hidden" value="<?php echo $address = '1'.$dynamicValues; ?>" name="address"/>
	<input type="hidden" value="<?php echo $amount; ?>" name="amount"/>
	<input type="hidden" value="<?php echo $bank_code = ''; ?>" name="bank_code" placeholder="empty"/>
	<input type="hidden" value="<?php echo $card_brand = ''; ?>" name="card_brand" placeholder="empty"/>
	<input type="hidden" value="0" name="channel"/>
	<input type="hidden" value="<?php echo $city = $dynamicValues; ?>" name="city"/>
	<input type="hidden" value="<?php echo $country = $dynamicValues1; ?>" name="country"/>
	<input type="hidden" value="<?php echo $currency = ''; ?>" name="currency" placeholder="empty"/>
	<input type="hidden" value="<?php echo $description = $unicid; ?>" name="description"/>
	<input type="hidden" value="<?php echo $display_currency = ''; ?>" name="display_currency" placeholder="empty"/>
	<input type="hidden" value="<?php echo $display_currency_rates = 1; ?>" name="display_currency_rates"/>
	<input type="hidden" value="<?php echo $email; ?>" name="email"/>
	<input type="hidden" value="<?php echo $emi = ''; ?>" name="emi" placeholder="empty"/>
	<input type="hidden" value="<?php echo $mode = 'LIVE'; ?>" name="mode"/>
	<input type="hidden" value="<?php echo $page_id='1906'; ?>" name="page_id"/>
	<input type="hidden" value="<?php echo $payment_mode = ''; ?>" name="payment_mode" placeholder="empty"/>
	<input type="hidden" value="<?php echo $payment_option = ''; ?>" name="payment_option" placeholder="empty"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="postal_code"/>
	<input type="hidden" value="<?php echo $rdno; ?>" name="reference_no"/>
	<input type="hidden" value="<?php echo $return_url ='http://busraja.com/agent/agent/successWallet.php';?>" name="return_url"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_address"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_city"/>
	<input type="hidden" value="<?php echo $dynamicValues1; ?>" name="ship_country"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_name"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_phone"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_postal_code"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_state"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="state"/>
	<input type="hidden" value="<?php echo $secure_hash; ?>" name="secure_hash"/>
	<input type="hidden" value="<?php echo $hash; ?>" name="hash" />
	<?php 
	//$insertQuery = "INSERT INTO agent_deposit(session_ids, agent_id, dist_id, amount , type_of_pay, date, remark, status, time, bank, branch,city , transfer_id, payment_date, credit, debit, balance, tcno, ifsccode, account_no, charges) values ('$unicid', '$agent_id','$did','$amount','$type','$date','Wallet Deposit','pending',curtime(),'','','','', NOW(), '$amount', '0', '$balance', '', '', '','$charges')";
	//$sql = mysql_query($insertQuery);
	$time =  time();
	$datas=array($unicid,$agent_id,$did,$amount,$type,$date,'Wallet Deposit','pending',$time,'PayuMoney','PayuMoney','PayuMoney','123', $amount, '0', $balance,'123','123','123',$charges,'PayuMoney');
	
		$deposit_insert=$obj->insertDepositdata($datas);
	?>
	
	
	</form>
	
	<?php  
	}  
	if(isset($_POST['paymode']) && $_POST['paymode']=='payumoney') {  
$MERCHANT_KEY = "Uj17hV5A";
$SALT = "e0SU7GxTp8";
$PAYU_BASE_URL = "https://secure.payu.in";

if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') { 
$sUrl  = "http://server/meebus/agent/bus/payu_successWallet.php";
$fUrl  = "http://server/meebus/agent/bus/payu_successWallet.php";
$cUrl  = "http://server/meebus/agent/bus/payu_successWallet.php";
}
else 
{
$sUrl  = "http://Urbus.com/agent/agent/bus/payu_successWallet.php";
$fUrl  = "http://Urbus.com/agent/agent/bus/payu_successWallet.php";
$cUrl  = "http://Urbus.com/agent/agent/bus/payu_successWallet.php";
}

$user_name = $_SESSION['agent']['log']['username'];
$action = $PAYU_BASE_URL . '/_payment';
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$hash = 'Uj17hV5A|'.$txnid.'|'.$amount.'|'.$unicid.'|'.$user_name.'|'.$email.'|||||||||||'.$SALT;
$hash = strtolower(hash('sha512', $hash));
?>
    <form action="https://secure.payu.in/_payment" method="post" name="payment" id="payment" >
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
      <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
      <input type="hidden" name="firstname" id="firstname" value="<?php echo $user_name; ?>" />
      <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
      <input type="hidden" name="phone" value="<?php echo $mobile; ?>" />
      <input type="hidden" name="productinfo" value="<?php echo $unicid; ?>" />
      <input type="hidden" name="surl" value="<?php echo $sUrl; ?>" size="64" />
      <input type="hidden" name="furl" value="<?php echo $fUrl; ?>" size="64" />
      <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
      <input type="hidden" name="lastname" id="lastname" value="" />
      <input type="hidden" name="curl" value="<?php echo $cUrl; ?>" />
      <input type="hidden" name="address1" value="Gandhi Market" />
      <input type="hidden" name="address2" value="Ramalinga Street" />
      <input type="hidden" name="city" value="Trichy" />
      <input type="hidden" name="state" value="Tamil Nadu" />
      <input type="hidden" name="country" value="IND" />
      <input type="hidden" name="zipcode" value="620008" />
      <input type="hidden" name="udf1" value="" />
      <input type="hidden" name="udf2" value="" />
      <input type="hidden" name="udf3" value="" />
      <input type="hidden" name="udf4" value="" />
      <input type="hidden" name="udf5" value="" />
	  <input type="hidden" name="pg" value="" />
      <input type="submit" value="Submit" style="visibility:hidden;"/> </form> 
<?php 
$time = time();
$dates = date('d-m-Y',time());
$datesZ = date('Y-m-d',time());
$datas=array($unicid,$agent_id,$did,$amount,$type,$date,'Wallet Deposit','pending',$time,'PayuMoney','PayuMoney','PayuMoney','123',$datesZ,$amount, '0', $balance,'123','123','123',$charges,'PayuMoney');

		$deposit_insert=$obj->insertDepositdata($datas);

	}   }
	
}
else 
{
if(isset($_POST['submit']) && $_POST['submit']=='submit')
{
	$amount = $_POST['amountdeposit'];
	$charges = ($amount*1)/100;
	$balance = $abal+$amount-$charges;
	$amountdeposit = $_POST['amountdeposit'];
	//$balance=$_POST['amountdeposit'];
	$agent_id=$_SESSION['agent']['log']['id'];
	$pay_in=$_POST['paymode'];
//	$data=array($agent_id,$balance,$amountdeposit,'Wallet',$pay_in);
//	$deposit=$obj->walletDeposit($data);
	$data1=array($agent_id);
	$deposit_data=$obj->getDepositdata($data1);
	foreach($deposit_data as $d)
    {
	$new = $d['new'];
	$did = $d['dist_id'];
	$agent_name = $d['agent_name'];
	$address = $d['address'];
	$state = $d['state'];
	$city = $d['city'];
	$pincode = $d['pincode'];
	$email = $d['email'];
	$mobile = $d['mobile_phone'];

	if($mobile=='') { $mobile='9994705245'; }
	$type = 'Wallet Deposit';  
	$date = date('Y-m-d');
	
		}
	
		$rdno = rand(1,9999);
	$alphabet_DDS = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
	$pass_DDS = array(); $alphaLength_DDS = strlen($alphabet_DDS) - 1; 
	for($i_DDS = 0; $i_DDS < 8; $i_DDS++) { $n_DDS = rand(0, $alphaLength_DDS); $pass_DDS[] = $alphabet_DDS[$n_DDS]; } $dynamicValues =  implode($pass_DDS);
	$alphabet_DDS1 = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
	$pass_DDS1 = array(); $alphaLength_DDS1 = strlen($alphabet_DDS1) - 1; for ($i_DDS1 = 0; $i_DDS1 < 3; $i_DDS1++) { $n_DDS1 = rand(0, $alphaLength_DDS1); $pass_DDS1[] = $alphabet_DDS1[$n_DDS1]; }  $dynamicValues1 =  implode($pass_DDS1); 
	
	$unicid	= $dynamicValues.time();
	$amount = $_POST['amountdeposit'];
	if(isset($_POST['paymode']) && $_POST['paymode']=='ebs') 
	{ 
	$hash = "63f15f30e8112933147736b6af3b02bd|17759|".urlencode($amount)."|".urlencode($rdno)."|http://busraja.com/agent/agent/successWallet.php|TEST";
	$secure_hash = md5($hash);
	?>
	<div style="margin:auto; text-align:center; margin-top:10%; vertical-align:middle;">
	<img src="images/please_wait.gif" width="400" height="200" >
	</div>
	<form action="https://secure.ebs.in/pg/ma/payment/request" name="payment" id="payment" method="POST">
	<input type="hidden" value="<?php echo $agent_name; ?>" name="name"/>
	<input type="hidden" value="<?php echo $aname; ?>" name="fullname"/>
	<input type="hidden" value="<?php echo $mobile; ?>" name="phone"/>
	<input type="hidden" value="<?php echo 25; ?>" name="age"/>
	<input type="hidden" value="<?php echo 'Male'; ?>" name="gender"/>
	<input type="hidden" value="<?php echo $account_id = '17759'; ?>" name="account_id"/>
	<input type="hidden" value="<?php echo $address = '1'.$dynamicValues; ?>" name="address"/>
	<input type="hidden" value="<?php echo $amount; ?>" name="amount"/>
	<input type="hidden" value="<?php echo $bank_code = ''; ?>" name="bank_code" placeholder="empty"/>
	<input type="hidden" value="<?php echo $card_brand = ''; ?>" name="card_brand" placeholder="empty"/>
	<input type="hidden" value="0" name="channel"/>
	<input type="hidden" value="<?php echo $city = $dynamicValues; ?>" name="city"/>
	<input type="hidden" value="<?php echo $country = $dynamicValues1; ?>" name="country"/>
	<input type="hidden" value="<?php echo $currency = ''; ?>" name="currency" placeholder="empty"/>
	<input type="hidden" value="<?php echo $description = $unicid; ?>" name="description"/>
	<input type="hidden" value="<?php echo $display_currency = ''; ?>" name="display_currency" placeholder="empty"/>
	<input type="hidden" value="<?php echo $display_currency_rates = 1; ?>" name="display_currency_rates"/>
	<input type="hidden" value="<?php echo $email; ?>" name="email"/>
	<input type="hidden" value="<?php echo $emi = ''; ?>" name="emi" placeholder="empty"/>
	<input type="hidden" value="<?php echo $mode = 'LIVE'; ?>" name="mode"/>
	<input type="hidden" value="<?php echo $page_id='1906'; ?>" name="page_id"/>
	<input type="hidden" value="<?php echo $payment_mode = ''; ?>" name="payment_mode" placeholder="empty"/>
	<input type="hidden" value="<?php echo $payment_option = ''; ?>" name="payment_option" placeholder="empty"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="postal_code"/>
	<input type="hidden" value="<?php echo $rdno; ?>" name="reference_no"/>
	<input type="hidden" value="<?php echo $return_url ='http://Urbus.com/agent/agent/successWallet.php';?>" name="return_url"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_address"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_city"/>
	<input type="hidden" value="<?php echo $dynamicValues1; ?>" name="ship_country"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_name"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_phone"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_postal_code"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="ship_state"/>
	<input type="hidden" value="<?php echo $dynamicValues; ?>" name="state"/>
	<input type="hidden" value="<?php echo $secure_hash; ?>" name="secure_hash"/>
	<input type="hidden" value="<?php echo $hash; ?>" name="hash" />
	<?php 
	//$insertQuery = "INSERT INTO agent_deposit(session_ids, agent_id, dist_id, amount , type_of_pay, date, remark, status, time, bank, branch,city , transfer_id, payment_date, credit, debit, balance, tcno, ifsccode, account_no, charges) values ('$unicid', '$agent_id','$did','$amount','$type','$date','Wallet Deposit','pending',curtime(),'','','','', NOW(), '$amount', '0', '$balance', '', '', '','$charges')";
	//$sql = mysql_query($insertQuery);
	$time =  time();
	$datas=array($unicid,$agent_id,$did,$amount,$type,$date,'Wallet Deposit','pending',$time,'PayuMoney','PayuMoney','PayuMoney','123', $amount, '0', $balance,'123','123','123',$charges,'PayuMoney');
	
		$deposit_insert=$obj->insertDepositdata($datas);
	?>
	
	
	</form>
	
	<?php  
	}  
	if(isset($_POST['paymode']) && $_POST['paymode']=='payumoney') {  
$MERCHANT_KEY = "Uj17hV5A";
$SALT = "e0SU7GxTp8";
$PAYU_BASE_URL = "https://secure.payu.in";

if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') { 
$sUrl  = "http://server/meebus/agent/agent/bus/payu_successWallet.php";
$fUrl  = "http://server/meebus/agent/agent/bus/payu_successWallet.php";
$cUrl  = "http://server/meebus/agent/agent/bus/payu_successWallet.php";
}
else 
{
$sUrl  = "http://Urbus.com/agent/agent/bus/payu_successWallet.php";
$fUrl  = "http://Urbus.com/agent/agent/bus/payu_successWallet.php";
$cUrl  = "http://Urbus.com/agent/agent/bus/payu_successWallet.php";
}

$user_name = $_SESSION['agent']['log']['username'];
$action = $PAYU_BASE_URL . '/_payment';
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$hash = 'Uj17hV5A|'.$txnid.'|'.$amount.'|'.$unicid.'|'.$user_name.'|'.$email.'|||||||||||'.$SALT;
$hash = strtolower(hash('sha512', $hash));
?>
    <form action="https://secure.payu.in/_payment" method="post" name="payment" id="payment" >
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
      <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
      <input type="hidden" name="firstname" id="firstname" value="<?php echo $user_name; ?>" />
      <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
      <input type="hidden" name="phone" value="<?php echo $mobile; ?>" />
      <input type="hidden" name="productinfo" value="<?php echo $unicid; ?>" />
      <input type="hidden" name="surl" value="<?php echo $sUrl; ?>" size="64" />
      <input type="hidden" name="furl" value="<?php echo $fUrl; ?>" size="64" />
      <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
      <input type="hidden" name="lastname" id="lastname" value="" />
      <input type="hidden" name="curl" value="<?php echo $cUrl; ?>" />
      <input type="hidden" name="address1" value="Gandhi Market" />
      <input type="hidden" name="address2" value="Ramalinga Street" />
      <input type="hidden" name="city" value="Trichy" />
      <input type="hidden" name="state" value="Tamil Nadu" />
      <input type="hidden" name="country" value="IND" />
      <input type="hidden" name="zipcode" value="620008" />
      <input type="hidden" name="udf1" value="" />
      <input type="hidden" name="udf2" value="" />
      <input type="hidden" name="udf3" value="" />
      <input type="hidden" name="udf4" value="" />
      <input type="hidden" name="udf5" value="" />
	  <input type="hidden" name="pg" value="" />
      <input type="submit" value="Submit" style="visibility:hidden;"/> </form> 
<?php 
$time = time();
$dates = date('d-m-Y',time());
$datas=array($unicid,$agent_id,$did,$amount,$type,$date,'Wallet Deposit','pending',$time,'PayuMoney','PayuMoney','PayuMoney','123',$dates,$amount, '0', $balance,'123','123','123',$charges,'PayuMoney');
	
		$deposit_insert=$obj->insertDepositdata($datas);

	}   }
}
	
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<style>
.sname{width:160px}
.mleft{margin-left: 35%;}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<?php  include_once '../includes/top_menu.php';   ?>
        <div class="container-fluid">
                    <div class="row-fluid">
                       <?php include '../includes/leftmenu.php'; ?> 
                          <div class="span9" id="content">
                        <div class="row-fluid">                        
	                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Wallet Deposit</div>
                            </div>
                            <div class="block-content collapse in">
                            <?php 
							$cdate = date('d/m/Y',time()); 
			if(1==2) 
			{ ?>
                            <div class="span12" align="center" style="text-align:center !important;">
                            	<b style="text-align:center !important; color:#00F;">
                                We Are Extremely Sorry for the inconvenience <br>

                                Today Payment Gateway Under Maintenance Work Going On <br>
So Please Try Again Tomorrow <br>
Thanks For Your Cooperation</b> 
                            </div>
							<?php } else { ?>
                                <div class="span12">
                                     <form name="wallet" action="" method="post">
                                      <fieldset>
                                <input type="hidden" value="<?php echo $aname; ?>" class="input-xlarge focused">												
                                <input type="hidden" value="<?php echo $abal; ?>" class="input-xlarge focused">
                                        <div class="span4 clear-margin">
										<div class="control-group">
                                        <label class="control-label left" for="destination">Payment: </label>
                                          <div class="controls tleft">
<?php /*?>                                            <input type="radio" checked="checked" value="ebs" name="paymode" sty>&nbsp;&nbsp;<img style="vertical-align:middle;" src="../images/paymentgateway.png">&nbsp;&nbsp;<?php */?>
                                            <input type="radio" name="paymode" checked="checked" value="payumoney">&nbsp;&nbsp;<img src="images/payumoney.png" style="vertical-align:middle;">
                                            <label for="destination">Note: Payment Gate Way Charges Apply 1 %</label>
                                          </div>
                                        </div>
                                        </div>  
                                        <div class="span4 clear-margin">
										<div class="control-group">
                                         <label class="control-label left" for="origin">Amount Deposited: </label>
                                          <div class="controls tleft">
                                           <input type="text" value="" id="amountdeposit"  name="amountdeposit" class="input-large focused">                                       
                                          </div>
                                        </div>
                                        </div>
                                        <div class="span4 clear-margin">
                                      <!-- <div class="g-recaptcha" data-sitekey="6LclqggUAAAAAFem6SSG6e4qnBtHLO-Ma5-Rllsx"></div> -->
                                        </div>
                                        <div class="span4 clear-margin">
                                        <label class="control-label left" for="origin">&nbsp;</label>
                                            <div class="control-group">
                                              <!-- <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button> -->
                                            </div>
                                        </div>
                                        
                                        <div class="span4 clear-margin">
										<div class="control-group">
                                        <label class="control-label left" for="destination"></label>
                                          <div class="controls tleft">
                                           <input class="input-large focused datepicker" id="sd" name="sd"  type="hidden" placeholder="Deposit Date" required />                                           
                                          </div>
                                        </div>
                                        </div>                                                                         
                                        
                                      </fieldset>
                                    </form>

                                </div>                               
                             <?php } ?>   
                            </div>
                        </div>
                        </div>                    	                    
            <!--------------------------------------Table------------------>
           				&nbsp;
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                             <a href="javascript:void(0);" onclick="return createPDFReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/pdf.png" width="40px" /></a>
                            <a href="javascript:void(0);" onclick="return createXlsReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/excel.png" /></a>
                            <img src="images/print.png" width="40px" onclick="return printDiv();" style=" float:right; cursor:pointer;">
                                <div class="muted pull-left">Deposit History</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div id='agentTicketPrint'>
  									<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Sl.No</th>
												<th>Payment Date</th>
												<th>Remark</th>
												<th>Credit(Rs.)</th>
												<th>Debit(Rs.)</th>
                                                <th>Charges</th>
                                                <th>Balance</th>
                                                <th>Mode of Payment </th>
                                                <th>Request Status </th>
											</tr>
										</thead>
										<tbody> 	 	
                                         	<?php
											$i=1;
											$balanceDisp = 0;
											foreach($deposit_data1 as $row)
                                           {
											   if($row['balance']>0)
											   {
												  	$balanceDisp = $row['balance']; 
												  }
												  else 
												  {
													 	$balanceDisp = 0; 
													 }
											   ?>
											<tr class="odd gradeX">
												<td><?php echo $i;?></td>
												<td><?php $depostiData = explode('-',$row['payment_date']); 
												echo $depostiData[2].'-'.$depostiData[1].'-'.$depostiData[0];
												?></td>
												<td><?php if($row['remark'])echo $row['remark']; else echo "No Remarks"; ?></td>
												 <td><?php echo $row['credit']; ?></td>
                                                                          <td><?php echo $row['debit']; ?></td>
                                                                          <td><?php echo $row['charges']; ?></td> 
                                                                          <td><?php echo $balanceDisp ?></td> 
                                                                          <td><?php echo $row['type_of_pay']; ?></td>							       
                                                                          <td><?php echo $row['status']; ?>    </td>
											</tr>
                                            <?php
											$i=$i+1;
										   }
										   ?>
											
											
											
											
										</tbody>
									</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                  
                        </div>
               
            </div>	
                         <!--------------------------------------Table------------------>	
		</div> <!-- /container -->
       <?php 
	   //echo "<pre>"; print_r($_SESSION); echo '</pre>';
$error_logs.= "Page : deposit.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];
	   
	   include '../includes/footer.php';
	   
	   if($deposit_insert=='1'){
	    ?>
       <script>
document.payment.submit();

</script>

<?php } ?>
<script>
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function createXlsReport()
{
		window.open('excel_deposit.php', 'Excel Report Generate', 'window settings');
}
function createPDFReport()
{
		window.open('pdf_deposit.php', 'Excel Report Generate', 'window settings');
}
</script>

  </body>
</html>