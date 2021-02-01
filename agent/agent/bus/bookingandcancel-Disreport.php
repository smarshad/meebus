<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Booking & Cancel Dis Report";
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
				<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Booking & Cancel Discount Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <h5> Booking</h5>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered tablescrool" id="bookingReport">
                                        <thead>
                                            <tr>
                                                <th>DOI</th>
                                                <th>Tin</th>
                                                <th>Passenger Name</th>
                                                <th>DOJ</th>
                                                <th>Travels</th>
												<th>Seats</th>
                                                <th>Route</th>
												<th>Fare</th>
												<th>Discount</th>
                                                <th>BookingBy</th>
                      						</tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report=$obj->busBookingReport($agent_id);
									   foreach($report as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd">
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['lead_pax_name'];?>
                                                </td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center "><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												$seat=explode('|A|',$rep['passenger_seat']); 
												foreach($cancelSeat as $cs)
												{
													$s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												
												echo implode(',',$seat); ?></td>
                                                <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
                                                <td class="center "><?php echo $rep['total_fare'];?></td>
												<td class="center "><?php echo 0;?></td>
                                                <td class="center "><?php echo $_SESSION['agent']['log']['agency_name'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                     <h5> Cancellation</h5>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered tablescrool" id="cancelReport">
                                        <thead>
                                       
                                            <tr>
                                                <th>DOI</th>
                                                <th>Tin</th>
                                                <th>Passenger Name</th>
                                                <th>DOJ</th>
                                                <th>Travels</th>
                                                <th>Seats</th>
                                                <th>Route</th>
												<th>Fare</th>
												<th>Discount</th>
												<th>Cancel Charges</th>
                                                <th>Refund</th>
                                                <th>Booking By</th>
                                                <th>Cancelled By</th>
                                                <th>Date Of Cancel</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report=$obj->busCancelingReport($agent_id);
									   foreach($report as $rep)
									   {
										  //echo "<pre>"; print_r($rep); echo "</pre>";
									   ?>
                                       <tr class="gradeX odd">
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['lead_pax_name'];?>
                                                </td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php $travelsbUS=explode('|A|',$rep['bus_provider']); echo $travelsbUS[0];?></td>
                                                <td class="center "><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												$seat=explode('|A|',$rep['passenger_seat']); 
												foreach($cancelSeat as $cs)
												{
													$s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												
												echo implode(',',$seat); ?></td>
                                                <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
                                                <td class="center "><?php echo $rep['total_fare'];?></td>
												<td class="center "><?php echo 0;?></td>
                                                <td class="center "><?php echo $rep['cancel_amount'];?></td>
                                                <td class="center "><?php echo $rep['RefundAmount'];?></td>
                                                <td class="center "><?php echo $_SESSION['agent']['log']['agency_name'];?></td>
                                                <td class="center "><?php echo $_SESSION['agent']['log']['agency_name'];?></td>
                                                <td class="center "><?php echo $rep['cancel_date'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
$error_logs.= "Page : bookingandcancel-Disreport.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];
 include'../includes/footer.php'; ?>
<script type="text/javascript">
$("#search").click(function() 
{
	if($("#from").val()!='' && $("#to").val()!=''){
	$(".result").html('<div align="center"><img src="../images/LoadingCircle_firstani.gif"  width="250" height="250"  ></div>');
	from=$("#from").val(); to = $("#to").val();	
	$.post( "getbookingandcancel-Disreport.php?from="+from+"&to="+to, function( data )
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