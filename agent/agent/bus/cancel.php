<?php 
include_once'../../server/server.php';  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Cancel"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
unset($_SESSION['seatNoData']);
$_SESSION['tFare'] = 0;
unset($_SESSION['price']);

$other_data = '';
$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search','Page Enter',$other_data);
$system_log = $obj->systemlogs($system_data);  $system_data='';
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<style>
.sname{width:160px}
.left{width: 42px !important};
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
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
                                <div class="muted pull-left">Cancel Ticket No</div>
                            </div>
                            <div class="block-content collapse in hei">
                                <div class="span12">
                                     <form id="cancelform" name="cancelform" class="form-horizontal" action="" method="post" autocomplete="off">    
                                        <div class="span3">
                                            <div class="control-group">
                                             <input class="input sname focused" id="tin" name="tin"  type="text" placeholder="Please Enter Ticket No...." value="" required />
                                            </div>
                                        </div>
                                        <div class="span4">
                                        <?php //if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') { } else { ?>
                                        <!--<div class="g-recaptcha" data-sitekey="6LclqggUAAAAAFem6SSG6e4qnBtHLO-Ma5-Rllsx"></div>-->
                                        <?php// } ?>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                                              <button type="button" name="search" class="btn btn-primary getsearch">Submit</button>
                                            </div>
                                        </div>
                                      </fieldset>
                                    </form>
                               </div>
                                <div class="span12" style="margin-left: 0;">
                                	<div class="GODGOMDBMH">
        <div class="span3 cancel-select">
            
        </div> 
        <div class="span9 cancel-proces-disp">
        </div>
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
$error_logs.= "Page : cancel.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];


include '../includes/footer.php' ?>
<script>
$( ".getsearch" ).click(function() {
	var tin = $('#tin').val();
	if(tin!='') {
	$.post( "cancel-result.php?tin="+tin, function( data ) {
	  $( ".cancel-select" ).html( data );
	});
	} 
	else 
	{
		alert('Please Enter Ticket No');
		return false;	
	}
});
</script>
</form>
  </body>
</html>