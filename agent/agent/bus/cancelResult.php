<?php 
include_once'../../server/server.php';  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}

$_SESSION['common']['pagename'] = "Cancel"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$other_data = 'Cancel Refund Amount : '.$_SESSION['cancel']['refund'].' Cancel Charge : '.$_SESSION['cancel']['cancel_charge'].' Tin : '.$_SESSION['cancel']['tin'];
$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Cancel Result Page','Page Enter',$other_data);
$system_log = $obj->systemlogs($system_data);  $system_data='';
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<style>.sname{width:160px} .left{width: 42px !important}; </style>
</head>
<body>
<?php  include_once '../includes/top_menu.php'; ?>
        <div class="container-fluid">
          <div class="row-fluid">
           <?php include '../includes/leftmenu.php'; ?> 
           <div class="span9" id="content">
                    	<div class="row-fluid">                        
	                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Cancel Result Data</div>
                            </div>
                            <div class="block-content collapse in hei">
                                <div class="span12">
                                     <form class="form-horizontal" action="searchresult.php" method="post" autocomplete="off">
                                      <fieldset>
                                      
                                      <div class="span3">
										<div class="control-group">
                                        </div>
                                      </div>
                                        <div class="span6">
										
                                        <div class="control-group">
                                         <strong>Ticket Cancel Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Successfully</strong>
									   </div>
                                       
                                        <div class="control-group">
                                         <strong>Ticket No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php  echo $_SESSION['cancel']['tin']; ?></strong>
									   </div>
                                       <div class="control-group">
                                         <strong>Cancel Charge &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rs <?php  echo $_SESSION['cancel']['cancel_charge']; ?></strong></div>
                                       <div class="control-group">
											<strong>Refund Amont &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rs<?php  echo $_SESSION['cancel']['refund']; ?> </strong>
                                        </div>
                                        </div>
                                        <br/>
                                        <br/>
                                        <?php /*?><div class="span8">
                                        <?php 
										echo $_SESSION['gs_pass_urlqruy']; 
										echo '<pre>'; print_r($_SESSION['gs_get_cancel']); echo '<pre/>';
										
										?>
                                        </div><?php */?>
                                         <div class="span3">
										<div class="control-group">
                                        </div>
                                      </div>
                                      </fieldset>
                                    </form>

                                </div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        </div>
                    </div>
          </div>					
		</div>
        
<?php 

$error_logs.= "Page : cancelResult.php ,<br/>POST Value :".implode('^',$_POST)."<br/>GET Value :".implode('^',$_GET)."<br/>Session Value : Common URL : ".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."Ticket Cancel Status : Success<br/>Tin No : ".$_SESSION['cancel']['tin']."<br/>Cancel Charge".$_SESSION['cancel']['cancel_charge']."<br/>Refund Amount : ".$_SESSION['cancel']['refund'];
include '../includes/footer.php' ?>
  </body>
</html>