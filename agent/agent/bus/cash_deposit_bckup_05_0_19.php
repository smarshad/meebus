<?php 
include_once'../../server/server.php';  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Cash Deposit"; 
include_once '../includes/functions.php';
//echo "<pre>"; print_r($_SESSION['agent']['log']); echo "<pre/>"; exit;
$cBalance = $_SESSION['agent']['log']['account_balance'];
$agentName =$_SESSION['agent']['log']['agent_name'];
$agency_name =$_SESSION['agent']['log']['agency_name'];
$mobile =$_SESSION['agent']['log']['mobile'];
if(isset($_SESSION['agent']['log']['email']) && $_SESSION['agent']['log']['email']!='')
{
	$email = $_SESSION['agent']['log']['email'];
}
else 
{
		$email = "busrajaagent@gmail.com";	
}

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
if(isset($_POST['submit']) && $_POST['submit']=='Submit'  && $_POST['g-recaptcha-response']!='' )
{
	$agent_id=$_SESSION['agent']['log']['id'];
	//$extra = ($_POST['credit']*2)/100;
	$extra = 0;
	$amount= $credit= $_POST['credit']+$extra;
    $date = $payment_date=$_POST['deposit_date'];

	$bankac=$_POST['bankac'];
 	$transactionno=$_POST['transactionno'];
	$deposit_date = $_POST['deposit_date'];
	$branch=$_POST['branch'];
	$type_of_pay=$bankac.'Deposit';
	$remark='Wallet Deposit';
	//$date=date('d-m-Y');
	$time=date('h:i A');
	$content = $_POST['remark'];
	$cBalance = $cBalance+$amount;
	$data=array('10001',$agent_id,$credit, $payment_date, $branch, $bankac, $transactionno, $remark,$amount,'pending',$type_of_pay,$date,$time,$cBalance,$content);
	$deposits_datas=$obj->getDepositdatas($data);
	
	
	$message='<center>
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0;padding:0;border-collapse:collapse!important;height:100%!important;width:100%!important">
<tbody>
<tr>
<td valign="top" align="center">
<br><table cellspacing="0" cellpadding="0" border="0" style="width:600px;border:1px solid #bbbbbb;border-collapse:collapse!important">
<tbody>

<tr>
<td valign="top" align="center">&nbsp;</td></tr>
<tr>
<td valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#fff;border-top:1px solid #ffffff;border-bottom:1px solid #cccccc;border-collapse:collapse!important">
<tbody>
<div style="background:#042e6f;color:#fff;padding:10px 20px 0">
<p style="margin:0;padding:0 0 15px 0">Urbus Deposit Information</p>
 </div>
<tr>
<td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">
<p style="font-size:14px"><strong><span style="color:rgb(34,34,34);font-family:Calibri,sans-serif;font-size:11pt">Dear&nbsp;<span style="font-size:11pt">Sir/Madam ,</span></span></strong></p>
<p style="font-size:14px"><span style="color:rgb(34,34,34);font-family:Calibri,sans-serif;font-size:11pt">
Mr. '.$agentName.' Urbus Agent </span>Send Deposit Request 



</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left"><strong>Deposit Agent Info :</strong></tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Agent  ID : '.$agent_id.'</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Agent Name : '.$agentName.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Agency Name : '.$agency_name.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Mobile No : '.$mobile.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Email : '.$email.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Current Balance : '.$cBalance.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Deposit Amount : '.$amount.'</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Deposit Bank : '.$bankac.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Depisit Branch : '.$branch.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Deposit Date : '.$deposit_date.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Remarks : '.$content.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Trans No : '.$transactionno.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">Type of Payment : '.$type_of_pay.'
</tr>
<tr>
  <td valign="top" style="color:rgb(80,80,80);font-family:Helvetica;padding:20px;text-align:left">
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</center>';

//echo $message; exit;
$to = 'Urbusdeposit@gmail.com';
$subject = "Urbus Deposit Record Mail";
$headers= "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers.= "From: $email";
if(mail($to, $subject, $message, $headers))
{
$_SESSION['mstatus']='';	
$_SESSION['mstatus'] = 'Mail Send Successfully';
}
else 
{
$_SESSION['mstatus']='';	
$_SESSION['mstatus'] = 'Mail Not Send Successfully';
}

header('location:cash_deposit.php');
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
                                <div class="muted pull-left">Cash Deposit <?php if(isset($_SESSION['mstatus']) && $_SESSION['mstatus']!='') { echo $_SESSION['mstatus']; $_SESSION['mstatus']=''; } ?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span6">
                                     <form name="wallet" action="" method="post" class="form-horizontal" autocomplete="off">
                                      <fieldset>
                                <input type="hidden" value="<?php echo $aname; ?>" class="input-xlarge focused">												
                                <input type="hidden" value="<?php echo $abal; ?>" class="input-xlarge focused">
                                        <div class="span12 clear-margin">
										<div class="control-group">
                                          <label for="typeahead" class="control-label">Deposit Amount (Rs.) <span style="color:#F00;">*</span> </label>
                                          <div class="controls">
                                      <input type="text" data-items="4" data-provide="typeahead" id="credit"  name="credit" class="span6" required><br>
                                          </div>
<!-- <div align="left" style="float:left; color:#F00;">Each & Every Time Cash Deposit Get 2 % Extra Added Your Account </div> -->                                          
                                        </div>
                                        <div class="control-group">
                                          <label for="typeahead" class="control-label">Deposit Date  <span style="color:#F00;">*</span></label>
                                          <div class="controls">
                                          <input class="input sname focused span6" id="deposit_date" name="deposit_date"  type="text" placeholder="Deposit Date" required value="" />                                            
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label for="typeahead" class="control-label">Deposit Bank A/C <span style="color:#F00;">*</span> </label>
                                          <div class="controls">
  									<select name="bankac" class="span6 m-wrap" onchange="return changeBankType(this.value);" required>
  										<option value="">Select...</option>
  										<option  value="kvb">KVB Bank</option>
  										<option value="lvb">LVB Bank</option>
                                        <option value="sbi">SBI Bank</option>
                                        <option value="axis">AXIS Bank</option>
                                        <option value="canara">CANARA Bank</option>
                                        <option value="tmb">TMB Bank</option>
                                        <option value="indian">INDIAN Bank</option>
                                        <option value="hdfc">HDFC Bank</option> 										
  									</select>
  								</div>
                                        </div>
                                        <div class="control-group">
                                          <label for="typeahead" class="control-label">Transaction Number  <span style="color:#F00;">*</span> </label>
                                          <div class="controls">
                                            <input type="text" data-items="4" data-provide="typeahead" id="transactionno" name="transactionno" class="span6" required>
                                            
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label for="typeahead" class="control-label">Deposit Branch  <span style="color:#F00;">*</span> </label>
                                          <div class="controls">
                                            <input type="text" data-items="4" data-provide="typeahead" id="depositbranch" name="branch" class="span6" required>
                                            
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label for="typeahead" class="control-label">More details  </label>
                                          <div class="controls">
                    <textarea id="remark" name="remark" class="input-xlarge textarea wysihtml5-editor span6" ></textarea>
                                            
                                          </div>
                                          <div class="control-group">
                                          <br>
<div class="g-recaptcha" data-sitekey="6LclqggUAAAAAFem6SSG6e4qnBtHLO-Ma5-Rllsx"></div>
                                          </div>
                                        </div>
                                        
                                        </div>   
                                      </fieldset>
                                    
<div class="form-actions">
  								<input name="submit" value="Submit" class="btn btn-primary" type="submit">
  								<button class="btn" type="button">Cancel</button>                                      
                                </form>                                
  							</div>
                                </div> 
                                <div class="span6">
<div class="kvb" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>KVB A/C BANK</strong></pre></td>
</tr>
  <tr>
    <td width="50%" height="35"><pre><strong>A/c No</strong></pre></td>
    <td width="50%"><pre><strong>1170155000218881</strong></pre></td>
  </tr>
  <tr>
    <td height="35"><pre><strong>A/c Name</strong></pre></td>
    <td><pre><strong>MOHAN RAJ</strong></pre></td>
  </tr>
  <tr>
    <td height="35"><pre><strong>Bank Name</strong></pre></td>
    <td><pre><strong>KVB BANK</strong></pre></td>
  </tr>
  <tr>
    <td height="35"><pre><strong>Branch</strong></pre></td>
    <td><pre><strong>NAMAKKAL BRANCH</strong></pre></td>
  </tr>
  <tr>
    <td height="35"><pre><strong>IFSC CODE</strong></pre></td>
    <td><pre><strong>KVBL0001170</strong></pre></td>
  </tr>
</table>
</div>    
<div class="lvb" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>LVB A/C BANK</strong></pre></td>
</tr>
<tr>
<td width="50%" height="35"><pre><strong>NAME</strong></pre></td>
<td width="50%"><pre><strong>MOHANRAJ</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>A/C NUMBER</strong></pre></td>
<td><pre><strong>0488301000067506</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BANK</strong></pre></td>
<td><pre><strong>LVB BANK</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BRANCH</strong></pre></td>
<td><pre><strong>NAMAKKAL </strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>IFSC</strong></pre></td>
<td><pre><strong>LAVB0000488</strong></pre></td>
</tr>
</table>
</div>  
<div class="canara" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>CANARA  BANK</strong></pre></td>
</tr>
<tr>
<td width="50%" height="35"><pre><strong>NAME</strong></pre></td>
<td width="50%"><pre><strong>MOHANRAJ</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>A/C NUMBER</strong></pre></td>
<td><pre><strong>1220101030491</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BANK</strong></pre></td>
<td><pre><strong>CANARA BANK</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BRANCH</strong></pre></td>
<td><pre><strong>SENDAMANGALAM BRANCH </strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>IFSC</strong></pre></td>
<td><pre><strong>CNRB0001220</strong></pre></td>
</tr>
</table>
</div>
<div class="axis" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>AXIS BANK</strong></pre></td>
</tr>
<tr>
<td width="50%" height="35"><pre><strong>NAME</strong></pre></td>
<td width="50%"><pre><strong>MOHANRAJ</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>A/C NUMBER</strong></pre></td>
<td><pre><strong>915020012922960</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BANK</strong></pre></td>
<td><pre><strong>AXIS BANK</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BRANCH</strong></pre></td>
<td><pre><strong>BODHUPATTY BRANCH</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>IFSC</strong></pre></td>
<td><pre><strong>UTIB0001715</strong></pre></td>
</tr>
</table>
</div>
<div class="sbi" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>SBI  BANK</strong></pre></td>
</tr>
<tr>
<td width="50%" height="35"><pre><strong>NAME</strong></pre></td>
<td width="50%"><pre><strong>MOHANRAJ</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>A/C NUMBER</strong></pre></td>
<td><pre><strong>20207872730</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BANK</strong></pre></td>
<td><pre><strong>SBI BANK</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BRANCH</strong></pre></td>
<td><pre><strong>VASANTHAPURAM BRANCH</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>IFSC</strong></pre></td>
<td><pre><strong>SBIN0015798</strong></pre></td>
</tr>
</table>
</div>
<div class="tmb" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>TMB  BANK</strong></pre></td>
</tr>
<tr>
<td width="50%" height="35"><pre><strong>NAME</strong></pre></td>
<td width="50%"><pre><strong>MOHANRAJ</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>A/C NUMBER</strong></pre></td>
<td><pre><strong>331100050300308</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BANK</strong></pre></td>
<td><pre><strong>TMB BANK</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BRANCH</strong></pre></td>
<td><pre><strong>KALANGANI BRANCH</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>IFSC</strong></pre></td>
<td><pre><strong>TMBI0000331</strong></pre></td>
</tr>
</table>
</div>
<div class="indian" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>INDIAN  BANK</strong></pre></td>
</tr>
<tr>
<td width="50%" height="35"><pre><strong>NAME</strong></pre></td>
<td width="50%"><pre><strong>MOHANRAJ</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>A/C NUMBER</strong></pre></td>
<td><pre><strong>6302843537</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BANK</strong></pre></td>
<td><pre><strong>INDIAN BANK</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BRANCH</strong></pre></td>
<td><pre><strong>SALEM  ROAD BRANCH-Namakkal</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>IFSC</strong></pre></td>
<td><pre><strong> </strong></pre></td>
</tr>
</table>
</div>
<div class="hdfc" style="display:none">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td height="35" colspan="2" align="center"><pre><strong>HDFC  BANK</strong></pre></td>
</tr>
<tr>
<td width="50%" height="35"><pre><strong>NAME</strong></pre></td>
<td width="50%"><pre><strong>MOHANRAJ</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>A/C NUMBER</strong></pre></td>
<td><pre><strong>50100155602208</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BANK</strong></pre></td>
<td><pre><strong>HDFC BANK</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>BRANCH</strong></pre></td>
<td><pre><strong>ERODE GANTHI NAGAR BRANCH-1589</strong></pre></td>
</tr>
<tr>
<td height="35"><pre><strong>IFSC</strong></pre></td>
<td><pre><strong>HDFC0001589</strong></pre></td>
</tr>
</table>
</div>

<script>
	 function changeBankType(type)
	 {
		 if(type=='')
		 {
			 $(".lvb").hide();
			 $(".kvb").hide();
			 $(".canara").hide();
			 $(".axis").hide();
			 $(".sbi").hide();
			 $(".tmb").hide();
			 $(".indian").hide();
			 $(".hdfc").hide();			 			 
		 }
	  if(type=='kvb')
	  {
	    	 $(".lvb").hide();
			 $(".kvb").show();
			 $(".canara").hide();
			 $(".axis").hide();
			 $(".sbi").hide();
			 $(".tmb").hide();
			 $(".indian").hide();
			 $(".hdfc").hide();	
	  }
	  if(type=='lvb')
	  {
	   		 $(".lvb").show();
			 $(".kvb").hide();
			 $(".canara").hide();
			 $(".axis").hide();
			 $(".sbi").hide();
			 $(".tmb").hide();
			 $(".indian").hide();
			 $(".hdfc").hide();	
	  }
	   if(type=='canara')
	  {
	    	 $(".lvb").hide();
			 $(".kvb").hide();
			 $(".canara").show();
			 $(".axis").hide();
			 $(".sbi").hide();
			 $(".tmb").hide();
			 $(".indian").hide();
			 $(".hdfc").hide();	
	  }
	   if(type=='axis')
	  {
	    	 $(".lvb").hide();
			 $(".kvb").hide();
			 $(".canara").hide();
			 $(".axis").show();
			 $(".sbi").hide();
			 $(".tmb").hide();
			 $(".indian").hide();
			 $(".hdfc").hide();	
	  }
	   if(type=='sbi')
	  {
	    	 $(".lvb").hide();
			 $(".kvb").hide();
			 $(".canara").hide();
			 $(".axis").hide();
			 $(".sbi").show();
			 $(".tmb").hide();
			 $(".indian").hide();
			 $(".hdfc").hide();	
	  }
	   if(type=='tmb')
	  {
	    	 $(".lvb").hide();
			 $(".kvb").hide();
			 $(".canara").hide();
			 $(".axis").hide();
			 $(".sbi").hide();
			 $(".tmb").show();
			 $(".indian").hide();
			 $(".hdfc").hide();	
	  }
	  if(type=='indian')
	  {
	    	 $(".lvb").hide();
			 $(".kvb").hide();
			 $(".canara").hide();
			 $(".axis").hide();
			 $(".sbi").hide();
			 $(".tmb").hide();
			 $(".indian").show();
			 $(".hdfc").hide();	
	  }
	  if(type=='hdfc')
	  {
	    	 $(".lvb").hide();
			 $(".kvb").hide();
			 $(".canara").hide();
			 $(".axis").hide();
			 $(".sbi").hide();
			 $(".tmb").hide();
			 $(".indian").hide();
			 $(".hdfc").show();	
	  }
	  
	 }
</script>                                
  							</div>
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
												<th>Description</th>
                                                <th>Remarks</th>
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
												<td><?php if($row['remark'])echo $row['remark']; else echo "No Description"; ?></td>
                                                <td><?php if($row['remarks'])echo $row['remarks']; else echo "No Remarks"; ?></td>
												 <td><?php echo $row['credit']; ?></td>
                                                                          <td><?php echo $row['debit']; ?></td>
                                                                          <td><?php echo $row['charges']; ?></td> 
                                                                          <td><?php echo $balanceDisp; ?></td> 
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
		 <!-- /container -->
       <?php 
	   //echo "<pre>"; print_r($_SESSION); echo '</pre>';
$error_logs.= "Page : cash_deposit.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];
	   
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
		window.open('excel_cashdeposit.php', 'Excel Report Generate', 'window settings');
}
function createPDFReport()
{
		window.open('pdf_cashdeposite.php', 'Excel Report Generate', 'window settings');
}
</script>
  </body>
</html>
