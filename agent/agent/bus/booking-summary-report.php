<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Booking Summary Report";
$agent_id=$_SESSION['agent']['log']['id'];
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php'; ?>
<style type="text/css">
.tablescrool thead th {
    padding: 8px 12px;
	font-size: 12px;
    text-align: center;
}
.tablescrool {
    width: 99%;
    overflow-y: auto; 
    height: auto !important;
}
.table td {
	font-size: 13px;
	text-align: center;
}
</style>
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
                                <div class="muted pull-left">Booking Summary Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div id='agentTicketPrint11'>
                                     <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example2" style="font-size:11px !important;">
                                        <thead>
                                       
                                            <tr>
                                                <th>SNo</th>
                                                <th>DOB</th>
                                                <th>Ticket Number</th>
                                                <th>Source /<br/> Destination</th>
                                                <th>Travels</th>
                                                <th>DOJ</th>
                                                 <th>PAX Name</th>
												<th>Seat Name(s)</th>
                                                <th>Fare </th>
												<th>Commission </th>
												<th>Service Charge</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report=$obj->busBookingReport($agent_id);
										/*echo "<pre>";
										print_r($report);
										echo "</pre>";*/
										$fare=0;
										$commission=0;
										$serviceCharge=0;
										$i=1;
									   foreach($report as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd" style="font-size:11px !important;">
                                            <td class="  sorting_1" style="font-size:11px !important;"><?php echo $i; $i++; ?></td>
                                            <td class="  sorting_1" style="font-size:11px !important;"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" " style="font-size:11px !important;"><?php echo $rep['tiket_no'];?></td>
                                                <td class=" " style="font-size:11px !important;">
                                                <?php echo $rep['fromStationName'];?>
                                                To <?php echo $rep['toStationName'];?></td>
                                                <td class="center " style="font-size:11px !important;"><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center " style="font-size:11px !important;"><?php echo $rep['travelDate'];?></td>
                                                <td class="center " style="font-size:11px !important;"><?php echo $rep['lead_pax_name'];?></td>
                                                <td class="center " style="font-size:11px !important;"><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												$seat=explode('|A|',$rep['passenger_seat']); 
												if(isset($cancelSeat[0]) && $cancelSeat[0]!='')
												foreach($cancelSeat as $cs)
												{
													echo $s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												
												echo implode('<br/>',$seat); ?></td>
                                                <td class="center " style="font-size:11px !important;"><?php echo round($rep['total_fare']); $fare+=$rep['total_fare']; ?></td>
                                                <td class="center " style="font-size:11px !important;"><?php echo round($rep['agent_comm']); $commission+=$rep['agent_comm'];?></td>

                                                <td class="center " style="font-size:11px !important;"><?php echo round($rep['service_charges']); $serviceCharge+=$rep['service_charges']; ?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="8"  style="text-align:right !important;"><strong>Total </strong></td>
         
												<td style="border-top:2px solid #3366cc;"><?php echo round($fare); ?></td>
												<td style="border-top:2px solid #3366cc;"><?php echo round($commission); ?></td>
												<td style="border-top:2px solid #3366cc;"><?php echo round($serviceCharge);  ?></td>
                                           </tr>
                                        </tbody>
                                    </table>
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
$error_logs.= "Page : booking-summary-report.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];

include'../includes/footer.php'; ?>

<script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>assets/scripts.js"></script>		
<script src="<?php echo $base_url; ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/DT_bootstrap.js"></script>
<script>
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint11').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function createXlsReport()
{
	if($("#from").val()!='' && $("#to").val()!=''){
			from=$("#from").val(); to = $("#to").val();	
			window.open('excel_bookingSummary.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
			//window.open('excel_SummaryByDate.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
	}
	else 
	{
		window.open('excel_bookingSummary1.php', 'Excel Report Generate', 'window settings');
	}
}
function createPDFReport()
{
	if($("#from").val()!='' && $("#to").val()!=''){
			from=$("#from").val(); to = $("#to").val();	
			window.open('excel_bookingSummary.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
			//window.open('excel_SummaryByDate.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
	}
	else 
	{
		window.open('pdf_bookingSummary.php', 'Excel Report Generate', 'window settings');
	}
}
</script>
<script type="text/javascript">
$("#search").click(function() 
{
	if($("#from").val()!='' && $("#to").val()!=''){
	$(".result").html('<div align="center"><img src="../images/LoadingCircle_firstani.gif"  width="250" height="250"  ></div>');
	from=$("#from").val(); to = $("#to").val();	
	$.post( "getbooking-summary-report.php?from="+from+"&to="+to, function( data )
	{ $(".result").html(data); });
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