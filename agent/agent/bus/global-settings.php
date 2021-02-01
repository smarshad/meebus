<?php 
include_once'../../server/server.php';  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Global Settings"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$agent_id=$_SESSION['agent']['log']['id'];
$data3=array($agent_id);
$getDepositdata=$obj->getDepositdata($data3);
	foreach($getDepositdata as $ds)
    {
		$service_charges_mode=$ds['service_charges_mode']; 
		$service_charges=$ds['service_charges']; 
	}
if(isset($_POST['submit']) && $_POST['submit']=='submit')
{
	
	$service_charges_mode1		= $_POST['service_charges_mode'];
	$service_charges1			 = $_POST['service_charges'];
	
	$data=array($service_charges_mode1,$service_charges1,$agent_id);
	$deposit=$obj->ServiceCharges_update($data);
	$_SESSION['agent']['log']['service_charge_mode']     =    $service_charges_mode1;	
	$_SESSION['agent']['log']['service_charges']   		 =    $service_charges1;
	header('location:global-settings.php');
	
	}
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>includes/javascriptFunctions.js"  ></script>
<style>
.sname{width:160px}
</style>
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
                                <div class="muted pull-left">Global Settings</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                     
                                   <form name="service_charge_form" id="service_charge_form" action="" method="post">
                                      <fieldset>   
                                      <div class="span4">
										<div class="control-group">
                                         <label class="control-label left" for="origin">Service Charge Mode</label>
                                          <div class="controls tleft">
                                          <select id="service_charges_mode" name="service_charges_mode"  class="input-large focused" onChange="return service_mode_chage(this.value);" required>
                                            <option value="" > Select Mode </option>
                                            <option <?php if($service_charges_mode=='%') { ?> selected <?php } ?> value="%" > % </option>
                                            <option <?php if($service_charges_mode=='Rs') { ?> selected <?php } ?> value="Rs" > Rs </option>
                                            
                                          </select>
                                           
                                          </div>
                                          
                                        </div>
                                        </div>  
                                      <div class="span4">
										<div class="control-group">
                                         <label class="control-label left" for="origin">Service Charge</label>
                                          <div class="controls tleft">
                                          <input type="hidden" id="trip" name="trip" value="">
                                            <input type="text" value="<?php echo $service_charges; ?>" id="service_charges"  name="service_charges" class="input-large focused" required onkeypress="return isNumber(event)" onfocus="this.select();">
                                          </div>
                                           <label class="control-label left" for="origin">[ Max 30 % Only Allowed ]</label>
                                        </div>
                                        </div>                                     
                                        <div class="span4">
										<div class="control-group"> 
                                        <label class="control-label left" for="origin">&nbsp;</label>
                                          <div class="controls tleft">
                                         <button class="btn btn-primary" type="submit" name="submit" onClick="return global_validation();" value="submit">Update</button>
                                          </div>
                                        </div>
                                        </div>                                                                                
                                      </fieldset>
                                    </form>                                    
                                   <div class="span3"></div>
                                </div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        </div>
                    </div>
           
          </div>					
		</div>
       <?php
	   
	  // echo "<pre>"; print_r($_SESSION); echo '</pre>';
$error_logs.= "Page : globel-settings.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];
	    include '../includes/footer.php' ?>
  </body>
</html>