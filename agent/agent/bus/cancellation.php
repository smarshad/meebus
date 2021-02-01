<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Cancel Report";
$agent_id=$_SESSION['agent']['log']['id'];
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php'; ?>
<style type="text/css">
.tablescrool thead th {
    padding: 8px 6px;
	font-size: 12px;
    text-align: center;
}
.tablescrool {
    width: 99.8%;
    overflow-y: auto; 
    height: auto !important;
}
.table td {
	font-size: 12px;
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
                                <div class="muted pull-left">Cancel Report</div>
                            </div>
                            <div class="block-content collapse in mob_scroll">
                                <div class="span12">
                                <?php $report=$obj->busCancelingReport($agent_id); 
									$rep1='';
									 foreach($report as $rep)
									   {
										  $rep1=$rep['cancel_data'].'^';
									   }
									   $seatC=explode('^',$rep1);
									   //echo "<pre>";print_r($report);echo "</pre>";exit;
									   $seatCount=count($seatC);
								?>
                                                                    
                                     <h5> Cancellation</h5>
                                    <div id='agentTicketPrint11'>
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered tablescrool" id="cancelReport">
                                        <thead>
                                       
                                            <tr>
                                                <th>SNo</th>
                                                <th>DOC</th>
                                                <th>Ticket No</th>
                                                <th>Source <br/> Destination</th>
                                                <th>Travels</th>
                                                <th>DOJ</th>
                                                 <th>Pax Name</th>
												<th>Seat No</th>
                                                <th>DOC</th>
                                                <th>Fare</th>
                                                <th>Commn</th>
                                                <th>Cancel Charge</th>
												<th>Refund Amt</th>
												<th>Status</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  
										$i=1;
										$net_tot_fare = 0; 
										$net_agent_comm=0;
										$net_cancel_amt=0;
										$net_Reund=0;
										
									   foreach($report as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd">
                                            <td class=" "><?php echo $i;?></td>
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" "><?php echo $rep['fromStationName'].' To '.$rep['toStationName'];?></td>

                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php echo $rep['lead_pax_name'];?></td>
                                                <td class="center "><?php 									
												echo $seat=str_replace('^',',',$rep['cancel_data']); ?></td>
                                                <td class="center "><?php echo $rep['cancel_date'];?></td>
												<td class="center ">
												<?php $tot_fare=0; $fare=explode('^',$rep['passenger_fare']);  $seatArray=explode(',',$seat); $seatArray1=explode(',',$rep['passenger_seat']); foreach($seatArray as $se) { $a=array_search($se,$seatArray1); $tot_fare+=$fare[$a]; } $net_tot_fare= $net_tot_fare+$tot_fare;  echo $tot_fare; ?></td>
                                                <td class="center "><?php $net_agent_comm = $net_agent_comm+$rep['agent_comm']; echo $rep['agent_comm'];?></td>
                                                <td class="center "><?php $net_cancel_amt =$net_cancel_amt+$rep['cancel_amount']; echo $rep['cancel_amount']; ?></td>
                                                
                                                <td class="center "><?php $net_Reund = $net_Reund+$rep['RefundAmount']; echo $rep['RefundAmount']; ?></td>
                                                <td class="center "><?php echo $rep['status'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr><?php $i++; } ?>
                                       <tr class="gradeX odd">
                                         <td colspan="9" class="" style=" text-align:right !important;"><strong>Total</strong></td>
                                         <td class="center "><?php echo $net_tot_fare; ?></td>
                                         <td class="center "><?php echo $net_agent_comm; ?></td>
                                         <td class="center "><?php echo $net_cancel_amt; ?></td>
                                         <td class="center "><?php echo $net_Reund; ?></td>
                                         <td class="center ">&nbsp;</td>
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
$error_logs.= "Page : cancellation.php ,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];
 include'../includes/footer.php'; ?>
<script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>assets/scripts.js"></script>		
<script src="<?php echo $base_url; ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/DT_bootstrap.js"></script>
<script>
function createXlsReport()
{
	if($("#from").val()!='' && $("#to").val()!=''){
		from=$("#from").val(); to = $("#to").val();	
	window.open('excel_cancelation.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
	}
	else 
	{
		window.open('excel_cancelation1.php', 'Excel Report Generate', 'window settings');
	}
}
function createPDFReport()
{	
	window.open('pdf_cacelation.php', 'Excel Report Generate', 'window settings');
}
</script>

<script type="text/javascript">
$("#search").click(function() 
{
	if($("#from").val()!='' && $("#to").val()!=''){
	$("#report").html('<div align="center"><img src="../images/LoadingCircle_firstani.gif"  width="250" height="250"  ></div>');
	from=$("#from").val(); to = $("#to").val();	
	$.post( "getcancellation.php?from="+from+"&to="+to, function( data )
	{ $("#report").html(data); });
	}
	else 
	{
		alert('Select From Date & To Date');
		return false;	
	}
});
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint11').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
</script>
  </body>
</html>