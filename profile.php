<?php  
session_start();
include('header.php');
include "server/server.php";


	$_SESSION['user']['common']['url']		=	'https://meebus.com/';
	$_SESSION['user']['common']['title']	=	'Meebus';
	




$user_id=$_SESSION['user']['log']['id'];




$u_id=$_SESSION['user']['log']['id'];
$first_name= $_SESSION['user']['log']['first_name'];
$last_name = $_SESSION['user']['log']['last_name'];
$email_id = $_SESSION['user']['log']['email_id'];
$mobile_number = $_SESSION['user']['log']['mobile_number'];
$address= $_SESSION['user']['log']['address'];
$pincode= $_SESSION['user']['log']['pincode'];



?>


<div class="my-profile-page">
<div class="row">
  <div class="col-2">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	<div class="profile-user-icon">
	<span><i class="fa fa-user" aria-hidden="true"></i></span>
	<p> <?php echo $first_name.' '.$last_name; ?></p>
	</div>
      <a class="nav-link " id="v-my-trips-tab" data-toggle="pill" href="#trips" role="tab" aria-controls="mytrips" aria-selected="false" data-link="mytrips"><i class="fa fa-suitcase" aria-hidden="true"></i>My Trips</a>
      <a class="nav-link" id="v-my-wallet-tab" data-toggle="pill" href="#wallet" role="tab" aria-controls="wallet" aria-selected="false"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>Wallets/Cards</a>
      <a class="nav-link active" id="v-my-profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="myprofile" aria-selected="true"><i class="fa fa-cog" aria-hidden="true"></i>My Profile</a>
      <a class="nav-link" id="v-my-wallet-histroy-tab" data-toggle="pill" href="#wallethistroy" role="tab" aria-controls="wallethistroy" aria-selected="false"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>Wallet</a>
    </div>
  </div>
  <div class="col-10">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade " id="trips" role="tabpanel" aria-labelledby="v-my-trips-tab">
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
											$data = "select * from book_bus_tickets WHERE status = 'BOOKED' AND created_datetime >= '$from' AND created_datetime <= '$to' ORDER BY id DESC";
											$query = $conn->query($data);
											
											$adminRes= $query->fetch_all(); 
											
											if($query->num_rows > 0){
											
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
											<?php $i++; } 
											
											}else{
											    $no_record = "No record found";
											}
											
											?>
    </tbody>
  </table>
  </div>
</div>
        </div>

		  
</div>
	  </div>
      <div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="v-my-wallet-tab">
	  <div class="inner-content">

<div id="formContent">
<h2 class="headings"> Add Wallet </h2>
<?php 
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	$walletamn=$_POST['wallet'];
	$data=array($walletamn);
}
?>
<form name="frm_search" id="frm_search" action="atom/payment-wallet.php" method="POST">
      <input type="text" name="wallet" id="walletamount" class="textbox_login fadeIn second" placeholder="Enter Wallet Amount" maxlength="4"> 
      <input type="submit" name="submit" id="submit" value="Submit" style="display: block;margin: 20px auto;" />
   </form>

   
</div>
</div>
	  </div>
      <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="v-my-profile-tab">
	  <div class="cf inner-body" >
<div id="profile_details">
<div class="profile-details"><div class="right-panel">
  <span class="greyText">My Profile</span>
  <?php if(isset($_SESSION['user']['profile'])) echo "<p align='center' style='font-weight:bold; color:#D74F57;'>".$_SESSION['user']['profile']."</p>"; unset($_SESSION['user']['profile']); ?>
  <form action="" method="post">
  <div class="upcoming" id="profiledetails">
    <div>
       <a href="profile_update.php?id=<?php echo $user_id; ?>"><span id="Editbtn" class="editMode" style="position:relative;float: right;">EDIT</span></a>

      <div class="edittxt"></div>
    </div>

   <div class="userdetails">

      <div class="userdet1">
        <div class="userdetleft">
          <div class="usertext" id="nametxt">FIRST NAME</div>
		<div class="uservalue" id="namevalue"><?php echo $first_name; ?></div>
        </div>

        <div class="userdetright">
          <div class="usertext" id="agetxt">LAST NAME</div>
          <div class="uservalue" id="agevalue"><?php echo $last_name; ?></div>
          </div>
      </div>
      <div class="userdet1">
        <div class="userdetleft">
          <div class="usertext" id="nametxt">ADDRESS</div>
			<div class="uservalue" id="namevalue"><?php echo $address; ?></div>
           </div>

        <div class="userdetright">
          <div class="usertext" id="agetxt">PINCODE</div>
          
          <div class="uservalue" id="agevalue"><?php echo $pincode; ?></div>
           
          
        </div>
      </div>
       <fieldset>
        <legend align="center">CONTACT DETAILS</legend>
      </fieldset>
    <div class="userdetails" style="min-height: 6.5em;">
      <div class="userdet1">
        <div class="userdetleft mar0">
          <div class="usertext" id="conemailtxt">EMAIL ID</div>
          <div class="uservalue" id="conemailvalue"><?php echo $email_id; ?></div>
        </div>
        <div class="userdetright">
          <div class="mobiledetail">
            <div class="usertext" id="mobtxt">MOBILE NUMBER</div>
           <div class="uservalue" id="mobvalue"><?php echo $mobile_number; ?></div>
          </div>
 
        </div>

        
      </div>
    </div>

  </div>
</div>
</form>
</div>
</div>
</div>


</div>
	  </div>
      <div class="tab-pane fade" id="wallethistroy" role="tabpanel" aria-labelledby="v-my-wallet-histroy-tab">
	  <div  class="ticketform">
<div class="headerwidget">
        <div>
            <div class="headers">Wallet History</div>
          </div>
	  <div class="main-body" style="margin-bottom: 25px;">
<div class="table-responsive">          
   <table class="table table-striped" border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                            	<th>S. No</th>
                                                 <th>Mode</th>
                                                  <th>Amount</th>
                                                  <th>Balance</th>
                                                 <th>Description</th>
                                                  <th>Status</th>
                                                  <th>Created Date</th>
                                                 </tr>
                                        </thead>
   									 <tbody>
                               			<?php 
											$i=1; 
											$data1 = "SELECT * FROM user_trans_log WHERE user_id= '$uer_id' LIMIT 5";
											$quer = $conn->query($data1);
											$adminRes = $quer->fetch_all();
											
											foreach($adminRes as $res)
											{	
								 			?>
								 			<tr>
								 			  <td><?php echo $i; ?></td>
								 			  <td><?php echo $res['mode']; ?></td>
								 			  <td><?php echo $res['amount']; ?> </td>
								 			  <td><?php echo $res['balance']; ?></td>
								 			  <td><?php echo $res['description'];?></td>
							 			     <td><?php echo $res['book_status']; ?></td>
								 			  <td><?php echo $res['created_datetime']; ?></td>
											 
											<?php 
											
								 			$i++; } 
											
											?>
    </tbody>
  </table>
  </div>
</div>
</div>
</div>
	  </div>
    </div>
  </div>
</div>
</div>

		

<?php  include_once("includes/footer.php"); ?>
<script>
$("#submit").click(function ()
{
	var wallet=$("#walletamount").val();
	if(wallet=='')
	{
		 alert("Please Enter Wallet Amount");
		 return false;
	}
	$( "#frm_search" ).submit();
});
$(function(){
  var hash = window.location.hash;
  hash && $('.nav a[href="' + hash + '"]').tab('show');
  $('.nav-pills a').click(function (e) {
    window.location.hash = this.hash;
  });
});
</script>
