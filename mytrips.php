<?php  
include_once "header.php"; 

?>

<div  class="ticketform">
<div class="headerwidget">
        <div>
            <div class="headers">My Trips</div>
          </div>
          <div class="main-body">
<div class="table-responsive">          
   <table class="table table-striped" border="0" cellspacing="0" cellpadding="0">
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
											$data=array('BOOKED',$from,$to);
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

<?php  include_once "includes/footer.php"; ?>
