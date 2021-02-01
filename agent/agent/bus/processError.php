<?php 
include_once'../../server/server.php';  
if(isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:http://urbus.info/agent/agent/logout.php');}
$_SESSION['common']['pagename'] = "Bus"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$other_data = '';
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
                                <div class="muted pull-left">Server Down / Bus Route Problem </div>
                            </div>
                            <div class="block-content collapse in hei">
                                <div class="span12" align="center" style="font-size:18px; font-weight:boldl; color:#F00;"><br>
                                <br>
                                Ticket Booked Successfully But PNR & Ticket No Not Get From API<br>
                                <br>
                                So Please Contact Mr Mohan
                                <br/>Error Message : <?php echo $_GET['res']; ?>
                                </div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        </div>
                    </div>
          </div>					
		</div>
<?php 

 $error_logs.= "<br/>Pagen Name : booking.php <br/>Booking Success<br/>Last Update not working";
include '../includes/footer.php' ?>
  </body>
</html>