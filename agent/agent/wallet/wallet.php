<?php 
include_once'../../server/server.php';  
$_SESSION['common']['pagename'] = "Bus"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  

if(isset($_POST['submit']) && $_POST['submit']=='submit')
{
	
	$amountdeposit = $_POST['amountdeposit'];
	$balance=$_POST['amountdeposit'];
	$agent_id=$_SESSION['agent']['log']['id'];
	$pay_in=$_POST['paymode'];
	$data=array($agent_id,$balance,$amountdeposit,'Wallet',$pay_in);
	$deposit=$obj->walletDeposit($data);
	
	}
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<script>
$(document).ready(function(){
    $('input.origin').typeahead({
        name : 'sear',
        remote: {
            url : 'connection.php?query=%QUERY'
        }
        
    });
});
</script>
</head>
<body>
<?php  include_once '../includes/top_menu.php';   ?>
        <div class="container-fluid">
            
               
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Wallet Deposit</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span3"></div>
                               
                                <div class="span12">
                                     
                                     <div class="span3"></div>
                                     <div class="span6">
                                     <form name="wallet" action="" method="post">
                                     <table class="table table-bordered table-striped">
											<thead>
											  <tr>
												<th width="133">&nbsp;</th>
												<th width="481">Wallet Deposit</th>
											  </tr>
											</thead>
											<tbody>
											  <tr>
												<td>
												  <span class="label">Agency Name : </span>
												</td>
												<td>
												   <span class="input-xlarge uneditable-input">Some value here</span>
												</td>
											  </tr>
											  <tr>
												<td>
												  <span class="label">Current Balance Amount : </span>
												</td>
												<td>
												 <span class="input-xlarge uneditable-input">Some value here</span>
												</td>
											  </tr>
											  <tr>
												<td>
												  <span class="label ">Amount Deposited : </span>
												</td>
												<td>
												 <input type="text" value="" id="amountdeposit"  name="amountdeposit" class="input-xlarge focused">
												</td>
											  </tr>
											  
											  <tr>
												<td> <span class="label ">Note : </span></td>
												<td>Payment Gate Way Charges Apply 1 %</td>
											  </tr>
											  <tr>
												<td ><span class="label ">Payment : </span></td>
												<td><input type="radio" checked="checked" value="ebs" name="paymode">&nbsp;&nbsp;<img style="vertical-align:middle;" src="../img/paymentgateway.png">&nbsp;&nbsp;</td>
											  </tr>
                                               <tr>
												<td>&nbsp;</td>
												<td><button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button></td>
											  </tr>
                                              								</tbody>
										  </table>
                                          </form>
                                     </div>
                                     
                                   <div class="span3"></div>

                                </div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        <!-- /block -->
                    
               
            </div>	
            <!--------------------------------------Table------------------>
           <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Bootstrap dataTables</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
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
											<tr class="odd gradeX">
												<td>1</td>
												<td>26-Feb-16</td>
												<td> 	BUS BOOKED</td>
												<td class="center">  0</td>
												<td class="center">409</td>
                                                <td class="center"> 0</td>
												<td class="center">106</td>
                                                <td class="center"> Bus</td>
												<td class="center">BOOKED</td>
											</tr>
											<tr class="even gradeC">
												<td>2</td>
												<td>26-Feb-16</td>
												<td> 	BUS BOOKED</td>
												<td class="center">  0</td>
												<td class="center">409</td>
                                                <td class="center"> 0</td>
												<td class="center">106</td>
                                                <td class="center"> Bus</td>
												<td class="center">Pending</td>
											</tr>
											
											
											
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>	
                        
                         <!--------------------------------------Table------------------>	
		</div> <!-- /container -->
       <?php include '../includes/footer.php' ?>
  </body>
</html>