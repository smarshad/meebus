<?php
include_once'../../server/server.php';  
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Profile"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
$agent_id=$_SESSION['agent']['log']['id'];
$data1=array($agent_id);
	$profile_data=$obj->getprofiledata($data1);
	foreach($profile_data as $d)
    {
	
	$companyName = $d['agency_name'];
	$distributorName = $d['agent_name'];
	
	$agency_login = $d['agency_login'];
	$agency_pass = $d['agency_pass'];
	
	
	$address = $d['address'];
	$state = $d['state'];
	$city = $d['city'];
	$country = $d['country'];
	$pincode = $d['pincode'];
	$email = $d['email'];
	$officePhone = $d['office_phone'];
	$mobile_phone = $d['mobile_phone'];
    $pan = $d['pan'];
	$status = $d['status'];
	$logo = $d['logo'];
	$alogo = $d['alogo'];
	$cargo_ice = $d['cargo_office'];	
	$cargo_ices=$obj->getcaroffiname(array($cargo_ice));
	$cargo_ices=$cargo_ices[0];
	$cargo_office=$cargo_ices['code'].'-'.$cargo_ices['location'];
		}
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<script>
$(document).ready(function(){
    $('input.origin').typeahead({
        name : 'sear',
        remote: {
            url : 'connection.php?query=%QUERY'
        }
        
    });
});
</script>
</head>
<body>
<?php  include_once '../includes/top_menu.php'; ?>
        <div class="container-fluid">
          <div class="row-fluid">
           <?php include '../includes/leftmenu.php'; ?> 
           <div class="span9" id="content">
                    	<div class="row-fluid"> 
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Agency Profile</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     
                        <div class="span12">
                                     <form name="form"  id="form" action="edit_profile.php" method="post">
                                     <table class="table table-bordered table-striped">
											<thead>
											  <tr>
												<th width="128" align="center">Account Detail</th>
											  </tr>
											</thead>
											<tbody>
											  <tr>
												<td>
												  <span>Company Name </span>
												</td>
												<td width="316">
												   <span><?php echo $companyName; ?></span>
												</td>
											  </tr>
											  <tr>
												<td>
												  <span>User Name </span>
												</td>
												<td>
												 <span><?php echo $distributorName; ?></span>
												</td>
											  </tr>
                                              <tr>
												<td>
												  <span>Password </span>
												</td>
												<td>
												 <span><?php echo $agency_pass; ?></span>
												</td>
											  </tr>
											  <tr>
												<td>
												  <span>Account id </span>
												</td>
												<td>
												 <span><?php echo $agency_login; ?></span>
												</td>
											  </tr>
											  
											  <tr>
											<th width="128" align="center"> Personal Information</th>
                                            <th></th>
												
											  </tr>
                                              <tr>
												<td> <span>Name </span></td>
												<td> <span><?php echo $distributorName; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>E-mail</span></td>
												<td> <span><?php echo $email; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>PAN Number </span></td>
												<td> <span><?php echo $pan; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>Services Information </span></td>
												<td> <span>Status</span></td>
											  </tr>
                                              <tr>
												<td> <span>Flight </span></td>
												<td> <span><?php if($status=='yes') 
				  echo "Active";
				  else{
					  echo "Inactive";
					  }
				  ?></span></td>
											  </tr>
                                              <tr>
											<th width="128" align="center"> Contact Information</th>
                                            <th></th>
												
											  </tr>
                                              <tr>
												<td> <span>Address </span></td>
												<td> <span><?php echo $address; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>City</span></td>
												<td> <span><?php echo $city; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>State </span></td>
												<td> <span><?php echo $state; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>Pin Code </span></td>
												<td> <span><?php echo $pincode; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>Country </span></td>
												<td> <span><?php echo $country; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>Mobile </span></td>
												<td> <span><?php echo $mobile_phone; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>Office Phone</span></td>
												<td> <span><?php echo $officePhone; ?></span></td>
											  </tr>
                                              <tr>
												<td> <span>Courier Office</span></td>
												<td> <span><?php echo $cargo_office; ?></span></td>
											  </tr>
                                               <tr>
												<td> <span>Agency Logo</span></td>
												<td> 
              <span>
             <?php 
			 if($logo)
			 {
			 $filename = "images/logo/".$logo; 
			 if (file_exists($filename)) { ?>
              	<img src="images/logo/<?php echo $logo; ?>" style="width: 260px; height: 180px;"  >
			<?php } else { 
			$filename1 = "https://Urbus.com/agent/images/".$logo; 
			if (file_exists($filename1)) {  ?>	
            <img src="https://Meebus.com/agent/images/<?php echo $logo; ?>" style="width: 260px; height: 180px;"  >
            <?php }  
			else { ?>
				<img src="../images/noImage.png" style="width:auto; height:auto;"  >	
            <?php } } } else {  ?>
            	<img src="../images/noImage.png" style="width:auto; height:auto;"  >	
                <?php } ?>
              </span>
              </td>
											  </tr>
                                               <tr>
												<td> <span>Agency Photo</span></td>
												<td> 
                    
                    
                           <?php 
						    if($alogo)
			 {
			 $filenamea = "images/logo/".$alogo; 
			 if (file_exists($filenamea)) { ?>
              	<img src="images/logo/<?php echo $alogo; ?>" style="width: 260px; height: 180px;"  >
			<?php } else { 
			$filenamea1 = "https://Meebus.com/agent/images/".$alogo; 
			if (file_exists($filenamea1)) {  ?>	
            <img src="https://Meebus.com/agent/images/<?php echo $alogo; ?>" style="width: 260px; height: 180px;"  >
            <?php }  
			else { ?>
				<img src="../images/noImage.png" style="width:auto; height:auto;"  >	
            <?php } }  } else {  ?>
            	<img src="../images/noImage.png" style="width:auto; height:auto;"  >	
                <?php } ?>
              </span>
                    </td>
											  </tr>
                                             
                                              <tr>
												<td>&nbsp;</td>
												<td><button value="submit" name="submit" type="submit" class="btn btn-primary">Edit Profile</button></td>
											  </tr>
											 
                                              
                                              								</tbody>
										  </table>
                                          </form>
                                     </div>
                        <!--------------------------------Gallery---------------------->
                        <!--<div class="span4">
                        
                        <div class="block clear-margin">
                        <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Agency Logo</div>
                        </div>
                        <div class="block-content collapse in">
                         <form name="form"  id="form" action="adds_c.php" method="post" enctype="multipart/form-data">
                        <div class="row-fluid padd-bottom">
                        <div class="span">
                        <a class="thumbnail" href="#">
                        <img src="images/" style="width: 260px; height: 180px;" alt="260x180" data-src="holder.js/260x180">
                        </a>
                        </div>
                        </div>
                        </form>
                        </div></div>
                        
                        <div class="block clear-margin">
                        <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Agent Photo </div>
                        </div>
                        <div class="block-content collapse in">
                        <div class="row-fluid padd-bottom">
                        <div class="span">
                        <a class="thumbnail" href="#">
                        <img src="images/" style="width: 260px; height: 180px;" alt="260x180" data-src="holder.js/260x180">
                        </a>
                        </div>
                        </div></div></div>
                       </div>-->
                        <!--------------------------------Gallery---------------------->

                                </div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        <!-- /block -->
                      </div>
                    </div>
          </div>					
		</div>
            <!--------------------------------------Table------------------>
           <!--<div class="row-fluid">
                        <!-- block 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Bootstrap dataTables</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Sl.No</th>
												<th>Payment Date</th>
												<th>Remark</th>
												<th>Credit(Rs.)</th>
												<th>Debit(Rs.)</th>
                                                <th>Charges</th>
                                                <th>Balance</th>
                                                <th>Mode of Payment </th>
                                                <th>Request Status </th>
											</tr>
										</thead>
										<tbody> 	 	 	
											<tr class="odd gradeX">
												<td>1</td>
												<td>26-Feb-16</td>
												<td> 	BUS BOOKED</td>
												<td class="center">  0</td>
												<td class="center">409</td>
                                                <td class="center"> 0</td>
												<td class="center">106</td>
                                                <td class="center"> Bus</td>
												<td class="center">BOOKED</td>
											</tr>
											<tr class="even gradeC">
												<td>2</td>
												<td>26-Feb-16</td>
												<td> 	BUS BOOKED</td>
												<td class="center">  0</td>
												<td class="center">409</td>
                                                <td class="center"> 0</td>
												<td class="center">106</td>
                                                <td class="center"> Bus</td>
												<td class="center">Pending</td>
											</tr>
											
											
											
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <!-- /block 
                    </div>-->	
                        
                         <!--------------------------------------Table------------------>	
		</div> <!-- /container -->
       <?php 
	   //echo "<pre>"; print_r($_SESSION); echo '</pre>';
$error_logs.= "Page : profile.php,".implode('^',$_POST)."<br/>Session Value : Common URL".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> agent_name : ".$_SESSION['agent']['log']['agency_name']."<br/> email : ".$_SESSION['agent']['log']['email']."<br/> mobile : ".$_SESSION['agent']['log']['mobile']."<br/> Agent ID : ".$_SESSION['agent']['log']['id']."<br/> account_balance : ".$_SESSION['agent']['log']['account_balance'];
	   
	   
	   include '../includes/footer.php' ?>
  </body>
</html>