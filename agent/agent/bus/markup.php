<?php 
include_once'../../server/server.php';  
$_SESSION['common']['pagename'] = "Markup"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$agent_id=$_SESSION['agent']['log']['id'];
$data3=array($agent_id);
	$deposits_data=$obj->getDepositdata($data3);
	foreach($deposits_data as $ds)
    {
	$a_bus=$ds['a_bus'];
	}
if(isset($_POST['submit']) && $_POST['submit']=='submit')
{
	
	$bus		= $_POST['bus_markup'];
	$data=array($bus,$agent_id);
	$deposit=$obj->Markup_update($data);
	$_SESSION['agent']['log']['markup'] = $bus;
	header('location:markup.php');
	
	}
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>

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
                                <div class="muted pull-left">Markup</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                     
                                   <form name="wallet" action="" method="post">
                                      <fieldset>   
                                      <div class="span4">
										<div class="control-group">
                                         <label class="control-label left" for="origin">Bus Markup in Rs .</label>
                                          <div class="controls tleft">
                                          <input type="hidden" id="trip" name="trip" value="">
                                            <input type="text" value="<?php echo $a_bus; ?>" id="bus_markup"  name="bus_markup" class="input-large focused">
                                          </div>
                                        </div>
                                        </div>                                     
                                        <div class="span4">
										<div class="control-group"> 
                                        <label class="control-label left" for="origin">&nbsp;</label>
                                          <div class="controls tleft">
                                         <button class="btn btn-primary" type="submit" name="submit" value="submit">Update</button>
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
       <?php include '../includes/footer.php' ?>
  </body>
</html>