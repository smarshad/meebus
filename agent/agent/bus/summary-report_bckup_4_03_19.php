<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php'); }
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Summary Report";
$agent_id=$_SESSION['agent']['log']['id'];
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php'; ?>
</head>
<body>
<?php  include_once '../includes/top_menu.php'; ?>
  <div class="container-fluid">
            <div class="row-fluid">
             <?php include '../includes/leftmenu.php'; ?> 
               <!------------------------------Search---------------------->
                                <div id="content" class="span9">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Search</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form method="get" action="" name="wallet"> 
                                    <div class="span3">
                                            <div class="control-group">
                   <input type="text" placeholder="From Date" name="from" id="from" required class="input-large focused datepicker">
                                           </div>
                                        </div>   
                                        <div class="span3">
                                            <div class="control-group">
                  <input type="text" placeholder="To date" name="to" id="to" required class="input-large focused datepicker">
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                                     <button value="submit" name="submit" id="search" type="button" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                      
                                    </form>
                               </div>                                
                            </div>
                        </div>                        
                        <!-- /block -->
            </div>	
            
              
                <!-----Table--------------->
                  &nbsp;
                   <div class="row-fluid result">
                                        <!-- block -->
				<div class="block" id="report">
                            <div class="navbar navbar-inner block-header">
                            <a href="javascript:void(0);" onclick="return createPDFReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/pdf.png" width="40px" /></a>
                            <a href="javascript:void(0);" onclick="return createXlsReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/excel.png" /></a>
                            <img src="images/print.png" width="40px" onclick="return printDiv();" style=" float:right; cursor:pointer;">
                                <div class="muted pull-left">Agent Transaction Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div id='agentTicketPrint'>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /block -->
                    </div>
                     <!-----Table--------------->
                     </div>
            </div>
  </div>
<?php
//echo "<pre>"; print_r($_SESSION); echo '</pre>';
$error_logs.= "Page : summary-report.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];

include'../includes/footer.php'; ?>


<script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>assets/scripts.js"></script>		

<script src="<?php echo $base_url; ?>assets/DT_bootstrap.js"></script>
<script>
function printDiv() {
	$('#example2_info').hide();
	$('.dataTables_paginate').hide();
	$('#example2_length').hide();
	$('#example2_filter').hide();
	var printContents = document.getElementById('agentTicketPrint').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
	$('#example2_info').show();
	$('.dataTables_paginate').show();
	$('#example2_length').show();
	$('#example2_filter').show();
}
function createXlsReport()
{
	if($("#from").val()!='' && $("#to").val()!=''){
			from=$("#from").val(); to = $("#to").val();	
			window.open('excel_SummaryByDate.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
	}
	else 
	{
		window.open('excel_report.php', 'Excel Report Generate', 'window settings');
	}
}
function createPDFReport()
{
	window.open('pdf_report.php', 'Excel Report Generate', 'window settings');
}
</script>
<script>

$("#search").click(function() 
{
	if($("#from").val()!='' && $("#to").val()!=''){
	$("#report").html('<div align="center"><img src="../images/LoadingCircle_firstani.gif"  width="250" height="250"></div>');
	from=$("#from").val(); to = $("#to").val();	
	$.post( "getSummaryReport.php?from="+from+"&to="+to, function( data )
	{ $( "#report" ).html(data); });
	}
	else 
	{
		alert('Select From Date & To Date');
		return false;	
	}
});

</script>


  </body>
</html>