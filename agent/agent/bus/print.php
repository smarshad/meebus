<?php 
include_once'../../server/server.php';  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Print"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$agent_id=$_SESSION['agent']['log']['id'];

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
<?php  include_once '../includes/top_menu.php'; ?>
        <div class="container-fluid">
          <div class="row-fluid">
           <?php include '../includes/leftmenu.php'; ?> 
           <div class="span9" id="content">
               
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Print Ticket No</div>
                            </div>
                            <div class="block-content collapse in hei">
                                <div class="span12">
                                    <form name="wallet" action="view_ticket.php" method="get">    
                                        <div class="span3">
                                            <div class="control-group">
                                             <input type="text" value="" id="ticket" placeholder="Please Enter Ticket No" name="ticket" class="input-large focused" required>
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                                            <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                                            </div>
                                        </div>
                                      </fieldset>
                                    </form>
                               </div>                                
                            </div>
                        </div>                        
                        <!-- /block -->
                    
               
            </div>	
           </div>
          </div>					
		</div>
       <?php
	   
	   //echo "<pre>"; print_r($_SESSION); echo '</pre>';
$error_logs.= "Page : print.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];

	   
	    include '../includes/footer.php' ?>
  </body>
</html>