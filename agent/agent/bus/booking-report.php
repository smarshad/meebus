<?php  
include_once'../../server/server.php';   
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "report";
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
				<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Agent Bus Booking Detail Report </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                                                       
                                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                    <h5> Booking</h5>
                                    
                                    <table cellspacing="0" cellpadding="0" border="0" id="example2" class="table table-striped table-bordered tablescrool dataTable" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 17px;" aria-sort="ascending" aria-label="S No: activate to sort column descending">DOI</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 62px;" aria-label="Tran.Type: activate to sort column ascending">Tin</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 85px;" aria-label=" PNR / TICKET: activate to sort column ascending"> <span style="color:#00F;"> 	Passenger Name</span>  <span style="color:#930;"></span></th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 33px;" aria-label="Re Send: activate to sort column ascending">DOJ</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 81px;" aria-label="Booked-Date: activate to sort column ascending"> Travels</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 72px;" aria-label="Travel-Date: activate to sort column ascending">Date<span style="color:#FFF;">-</span>Route</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 43px;" aria-label="PAX: activate to sort column ascending">Fare</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 62px;" aria-label="From / To: activate to sort column ascending">Discount</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 35px;" aria-label="Seats: activate to sort column ascending">BookingBy</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 55px;" aria-label="TXN-Amt: activate to sort column ascending">Seats<span style="color:#FFF;">-</span></th></tr>
                                        </thead>                                        
                                        
                                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                                     <?php $report=$obj->busReport1($agent_id);
									    foreach($report as $rep)
										{
									?>
                                    <tr class="gradeX odd">
                                            <td class="  sorting_1">1</td>
                                            <td class=" ">Ticket Cancelled</td>
                                                <td class=" ">
                                                <span style="color:#00F;">9ME4UJ3</span>
                                                <span style="color:#930;">9ME4UJ3</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												04-04-2016                                                </td>
                                                <td class="center ">20-04-2016</td>
                                                <td class="center ">Subbaiyan</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">2</td>
                                                <td class="center ">594.66</td>                                              
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                            </table>
                                            
									<h5> Cancellations</h5>
                                    <table cellspacing="0" cellpadding="0" border="0" id="example2" class="table table-striped table-bordered tablescrool dataTable" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 17px;" aria-sort="ascending" aria-label="S No: activate to sort column descending">DOI</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 62px;" aria-label="Tran.Type: activate to sort column ascending">Tin</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 85px;" aria-label=" PNR / TICKET: activate to sort column ascending"> <span style="color:#00F;"> 	Passenger Name</span>  <span style="color:#930;"></span></th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 33px;" aria-label="Re Send: activate to sort column ascending">DOJ</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 81px;" aria-label="Booked-Date: activate to sort column ascending"> Travels</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 72px;" aria-label="Travel-Date: activate to sort column ascending">Date<span style="color:#FFF;">-</span>Route</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 43px;" aria-label="PAX: activate to sort column ascending">Fare</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 62px;" aria-label="From / To: activate to sort column ascending">Discount</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 35px;" aria-label="Seats: activate to sort column ascending">BookingBy</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 55px;" aria-label="TXN-Amt: activate to sort column ascending">Seats<span style="color:#FFF;">-</span></th></tr>
     <td width="9%" align="center">CancelledBy</td
     ><td width="9%" align="center">Date of Cancelltion</td>                                           
                                        </thead>                                        
                                        
                                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php $report=$obj->busReport1($agent_id);
									    foreach($report as $rep)
										{
									?>
                                    	<tr class="gradeX odd">
                                            <td class="  sorting_1">1</td>
                                            <td class=" ">Ticket Cancelled</td>
                                            <td class=" ">
                                            <span style="color:#00F;">9ME4UJ3</span>
                                            <span style="color:#930;">9ME4UJ3</span>
                                            </td>
                                            <td style="text-align:center !important;" class="center ">
                                            </td>
                                            <td class="center ">
                                            04-04-2016                                                </td>
                                            <td class="center ">20-04-2016</td>
                                            <td class="center ">Subbaiyan</td>
                                            <td class="center ">
                                            Bhubaneswar<br>To<br>Baripada</td>
                                            <td class="center ">2</td>
                                            <td class="center ">594.66</td>                                              
                                            </tr>
                                           <?php } ?>
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
  <script>
  $(document).ready(function() {
$('#example2').dataTable( {
    "paging": false
} );
} );
</script>
<?php include'../includes/footer.php'; ?>

  </body>
</html>