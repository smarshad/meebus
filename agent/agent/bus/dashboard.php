<?php 
include_once'../../server/server.php';  
//echo $_SESSION['agent']['log']['api_select'];
// echo "<pre>"; print_r($_SESSION); echo "<pre/>"; exit;
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Bus"; 
if(isset($_SESSION['agent']['bus']['origin']))
{
unset($_SESSION['agent']['bus']['origin']);
unset($_SESSION['agent']['bus']['destination']);
unset($_SESSION['agent']['bus']['travelDate']);
}
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$commonUpdates = $obj->commonUpdates();


$other_data = '';
$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search','Page Enter',$other_data);
$system_log = $obj->systemlogs($system_data);  $system_data='';
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<style>.sname{width:210px} .left{width: 42px !important}; </style>
</head>
<body>
<?php  include_once '../includes/top_menu.php'; ?>
        <div class="container-fluid">
          <div class="row-fluid">
           <?php include '../includes/leftmenu.php'; //include('print.php'); ?> 
           <div class="span9" id="content">
                    	<div class="row-fluid">                        
	                        <div class="block">
                          
                            <div class="block-content collapse in">
                                <div class="span2"></div>
                                <div class="span4">
                                            <div class="control-group">
<a href="counter_search.php" class="btn btn-primary search">
CLICK FOR BOOK COUNTER TICKET</a>
                                             
                                            </div>
                                </div>
                                 <div class="span4">
                                            <div class="control-group">
                                          
                                                 <a href="search.php" class="btn btn-primary search">CLICK FOR BOOK ONLINE TICKET</a>
                                            </div>
                               </div>
                            </div>
                        </div>
                        </div>
                    </div>
          </div>					
		</div>
<?php 
//echo "<pre>"; print_r($_SESSION); echo '</pre>';
$error_logs.= "Page : Search.php ,<br/>POST Value :".implode('^',$_POST)."<br/>Session Value : Common URL : ".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> Agent ID : ".$_SESSION['agent']['log']['id'];
include '../includes/footer.php' ?>
<script type="text/javascript">
function interchange()
{
 var val1 = $('#origin').val();
 var val2 = $('#destination').val();
 
 $('#origin').val(val2);
 $('#destination').val(val1);
 return true; 
}

</script>



</body>
</html>