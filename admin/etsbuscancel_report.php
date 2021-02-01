<?php 
include_once'../server/server.php';  
include_once 'includes/functions.php';
$_SESSION['common']['pagename'] = "report"; 
$obj=new admin_module($con);

?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once 'includes/head.php';   ?>
</head>
<style>
.scrolling{
	overflow-y:scroll;
}
</style>
<body>
<?php  include_once 'includes/top_menu.php';   ?>
         <div class="row-fluid">
            <?php include_once 'includes/leftmenu.php'; ?>
                <div id="content" class="span9">
                    <div class="row-fluid">
                    <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Search</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form name="wallet" action="" method="get">
                  					
									
                                    <div class="span3">
                                            <div class="control-group">
                  <input type="text" class="input-large focused datepicker" id="from" name="from" placeholder="From Date">
                                           </div>
                                        </div>   
                                        <div class="span3">
                                            <div class="control-group">
                  <input type="text" class="input-large focused datepicker" id="to" name="to" placeholder="To date">
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                  <input class="btn btn-large btn-primary" type="button" id="search" name="submit" value="submit">
                                            </div>
                                        </div>
                                    </form>
                               </div>                                
                            </div>
                        </div>
                        <br>
                        <div class="block" id="report">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">ETS Bus Cancel Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            	<th>S. No</th>
                                                  <th>Status</th>
                                                  <th>From</th>
                                                  <th>To</th>
                                                  <th>Seats</th>
                                                 <th>Booked On</th>
                                                  <th>Travel Date</th>
                                                  <th>Lead Pax Name</th>
                                                  <th>PNR</th>
                                                  <th>Mobile Number</th>
                                                  <th>Email Id</th>
                                                  <th>Total Fare</th>
          									</tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
											$i=1; 
											$from=date('Y-m-d', strtotime("-2 day"));
											$to=date('Y-m-d');
											$from=$from.' 00:00:00';
											$to=$to.' 23:59:59';
											$data=array('Cancelled',$from,$to);
											$adminRes=$obj->getuserbookedreportdetails($data);  
											//echo '<pre>';print_r($adminRes);echo '</pre>';
											foreach($adminRes as $res)
											{	
											?>
											<tr>
											  <td><?php echo $i; ?></td>
											  <td><?php echo $res['status']; ?></td>
											  <td><?php echo $res['fromStationId']; ?> </td>
											  <td><?php echo $res['toStationId']; ?></td>
											  <td><?php echo $res['passenger_seat'];?></td>
											  <td><?php echo $res['booked_on']; ?></td>
											  <td><?php echo $res['travelDate']; ?></td>
											  <td><?php echo $res['lead_pax_name']; ?></td>
											  <td><?php echo $res['PNR'];?></td>
											  <td><?php echo $res['mobileNbr']; ?></td>
											  <td><?php echo $res['emailId']; ?></td>
											  <td><?php echo $res['total_fare']; ?></td> 
											<?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
            </div>					
		</div> 
        </div><!-- /container -->
       <?php include 'includes/footer.php' ?>
       <script>
	 $( "#search" ).click(function() {

	var from=$("#from").val();
	if(from=='')
	{
		alert("Please Enter From Date");
		return false;
	}
	var to=$("#to").val();
	if(to=='')
	{
		alert("Please Enter To Date");
		return false;
	}
	

	$.post( "getredbuscancelReport.php?from="+from+"&to="+to, function( data ) {
		$( "#report" ).html( data );
	});
});
	   </script>
  </body>
</html>