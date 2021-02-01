<?php 
include_once'../../server/server.php';
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Deposit"; 
include_once '../includes/functions.php';
$deposit_insert='';
$obj=new agent_module($con);  
$agent_id=$_SESSION['agent']['log']['id'];

if(isset($_POST['submit']) && $_POST['submit']=='submit')
{
	$agent_id=$_POST['agent_id'];
	$terms = $_POST['terms'];
	
	$data=array($terms,$agent_id);
	$data1=array($agent_id);
	$terms=$obj->insertterms($data,$data1);
    header('location:ticket_terms.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php'; ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<style>
.sname{width:160px}
.mleft{margin-left: 35%;}
</style>
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
                                        <div class="span12 clear-margin">
										<div class="control-group">
                                         <label class="control-label left" for="origin">Ticket Terms : </label>
                                          <div class="controls tleft">
                                           <textarea name="terms" id="terms" cols="" rows="" class="input-large focused" required style="width:98%"></textarea>               
                                          </div>
                                        </div>
                                        </div>
                                        <div class="span4 clear-margin"></div>
                                        <div class="span4 clear-margin">
                                        <label class="control-label left" for="origin">&nbsp;</label>
                                            <div class="control-group">
                                            <input type="hidden" value="<?php echo $agent_id ?>" name="agent_id" id="agent_id" />
                                              <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
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
                                <div class="muted pull-left">Deposit History</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div id='agentTicketPrint'>
  									<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Terms</th>
											</tr>
										</thead>
										<tbody> 	 	
                                         	 
											<tr class="odd gradeX">  
												<td>
												<?php 
												$data1=array($agent_id);
												$test =$obj->getterms($data1);
												$test=$test[0];
												echo $test['terms'];												
												?></td>	                                               										
											</tr>
                                           
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
       <?php  include '../includes/footer.php'; ?>
  </body>
</html>