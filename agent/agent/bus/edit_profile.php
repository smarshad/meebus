<?php 
include_once'../../server/server.php';  
$_SESSION['common']['pagename'] = "Profile"; 
include_once '../includes/functions.php';
error_reporting(1);
$obj=new agent_module($con);  
$agent_id=$_SESSION['agent']['log']['id'];
$data1=array($agent_id);
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
	$cargo_ice=$d['cargo_office'];
	$cargo_ices=$obj->getcaroffiname(array($cargo_ice));
	$cargo_ices=$cargo_ices[0];
	$cargo_office=$cargo_ices['code'].'-'.$cargo_ices['location'];
	}
//if(isset($_POST['submit1']) && $_POST['submit1']=='submit' && $_POST['g-recaptcha-response']!='')
if(isset($_POST['submit1']) && $_POST['submit1']=='submit')
{
	//echo "A"; exit;
	
	$agency_name = $_POST['companyName'];
	$agent_name = $_POST['distributorName'];
	
	$agency_login = $_POST['agency_login'];
	$agency_pass = $_POST['agency_pass'];
	
	$address = $_POST['address'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$pincode = $_POST['pincode'];
	$email = $_POST['email'];
	$office_phone = $_POST['office_phone'];
	$mobile_phone = $_POST['mobile_phone'];
	$cargo_office = $_POST['cargo_office'];
	$cargo_office = explode('-',$cargo_office);
	$car_off=$cargo_office[0];
	$cargo_office=$obj->getLocationByCode(array($car_off));
        $pan = $_POST['pan'];
		//print_r($_POST); exit;
	 if($_FILES['logo']['name']!='')
	 {
		 
		if(($_FILES['logo']['type']=='image/png') || ($_FILES['logo']['type']=='image/gif') || ($_FILES['logo']['type']=='image/jpeg') ||($_FILES['logo']['type']=='image/jpeg')
 &&($_FILES['logo']['size']<1024))
 { 
	  $logo = time().'_'.$_FILES['logo']['name']; 


	  $a1 = move_uploaded_file($_FILES['logo']['tmp_name'], 'images/logo/'.$logo); 
	  }
	 }
	  if($_FILES['alogo']['name']!='')
	 {
		if(($_FILES['alogo']['type']=='image/png') ||($_FILES['alogo']['type']=='image/gif') || ($_FILES['alogo']['type']=='image/jpeg') ||($_FILES['alogo']['type']=='image/jpeg')
 &&($_FILES['alogo']['size']<1024))
 { 
		 $alogo = time().'_'.$_FILES['alogo']['name'];
		 
	  $a2 = move_uploaded_file($_FILES['alogo']['tmp_name'], 'images/alogo/'.$alogo);
	}
	 }
	 $alogo_data=array($agent_id);
	 $logores=$obj->getAgentlogo($alogo_data);
	 //if($a1)
	 //unlink("images/logo/".$logores[0]['logo']);
	 //if($a2)
	 //unlink("images/alogo/".$logores[0]['alogo']);
	$data2=array($agency_name,$agency_login,$agency_pass,$address,$state,$city,$country,$pincode,$email,$office_phone,$mobile_phone,$pan,$logo,$alogo,$cargo_office,$agent_id);
	//print_r($data2); exit;
	$profile_data_update=$obj->setprofiledata($data2);
	//print_r($profile_data_update); exit;
	header('location:profile.php');
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
<script src='https://www.google.com/recaptcha/api.js'></script>
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
                                     <form name="wallet" action="" enctype="multipart/form-data" method="post">
                                     <table class="table table-bordered table-striped">
											<thead>
											  <tr>
												<th width="128" align="center"> Account Detail</th>
											  </tr>
											</thead>
											<tbody>
											  <tr>
												<td>
												  <span>Company Name </span>
												</td>
												<td width="316">
												   <input type="text" value="<?php echo $companyName; ?>" id="companyName"  name="companyName" class="input-xlarge focused">
												</td>
											  </tr>
											  <tr>
												<td>
												  <span>User Name </span>
												</td>
												<td>
                                                <input type="text" value="<?php echo $agency_login; ?>" id="agency_login"  name="agency_login" class="input-xlarge focused">
												 
												</td>
											  </tr>
                                               <tr>
												<td>
												  <span>Password </span>
												</td>
												<td>
                                                <input type="text" value="<?php echo $agency_pass; ?>" id="agency_pass"  name="agency_pass" class="input-xlarge focused">
												 
												</td>
											  </tr>
											  <tr>
												<td>
												  <span>Account id </span>
												</td>
												<td>
                                                <input type="text" value="<?php echo $agency_login; ?>" id="agency_login"  name="agency_login" class="input-xlarge focused">
												
												</td>
											  </tr>
											  
											  <tr>
											<th width="128" align="center"> Personal Information</th>
                                            <th></th>
												
											  </tr>
                                              <tr>
												<td> <span>Name </span></td>
												<td> <input type="text" value="<?php echo $distributorName; ?>" id="distributorName"  name="distributorName" class="input-xlarge focused">
                                                </td>
											  </tr>
                                              <tr>
												<td> <span>E-mail</span></td>
												<td> <input type="text" value="<?php echo $email; ?>" id="email"  name="email" class="input-xlarge focused">
                                                </td>
											  </tr>
                                              <tr>
												<td> <span>PAN Number </span></td>
												<td> <input type="text" value="<?php echo $pan; ?>" id="pan"  name="pan" class="input-xlarge focused">
                                                
                                                </td>
											  </tr>
                                              <tr>
												<td> <span>Services Information </span></td>
												<td> <span class="input-xlarge uneditable-input">Status</span></td>
											  </tr>
                                              <tr>
												<td> <span>Flight </span></td>
												<td> <span class="input-xlarge uneditable-input"><?php if($status=='yes') 
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
												<td> <input type="text" value="<?php echo $address; ?>" id="address"  name="address" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>City</span></td>
												<td> <input type="text" value="<?php echo $city; ?>" id="city"  name="city" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>State </span></td>
												<td> <input type="text" value="<?php echo $state; ?>" id="state"  name="state" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>Pin Code </span></td>
												<td> <input type="text" value="<?php echo $pincode; ?>" id="pincode"  name="pincode" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>Country </span></td>
												<td> <input type="text" value="<?php echo $country; ?>" id="country"  name="country" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>Mobile#  </span></td>
												<td> <input type="text" value="<?php echo $mobile_phone; ?>" id="mobile_phone"  name="mobile_phone" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>Office Phone# </span></td>
												<td> <input type="text" value="<?php echo $officePhone; ?>" id="office_phone"  name="office_phone" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>Cargo Office # </span></td>
												<td> <input type="text" value="<?php echo $cargo_office; ?>" id="origin"  name="cargo_office" class="input-xlarge focused"></td>
											  </tr>
                                              <tr>
												<td> <span>Agency Logo</span></td>
												<td> <span><input type="file" name="logo" id="logo" accept='image/*' ></td>
											  </tr>
                                               <tr>
												<td> <span>Agency Photo</span></td>
												<td> <span><input type="file" name="alogo" id="alogo" accept='image/*' ></span> </td>
											  </tr>
                                              <!--<tr>
                                                 <td>&nbsp;</td>
                                                 <td><div class="g-recaptcha" data-sitekey="6LclqggUAAAAAFem6SSG6e4qnBtHLO-Ma5-Rllsx"></div></td>
                                              </tr>-->
                                              <tr>
												<td>&nbsp;</td>
												<td><button value="submit" name="submit1" id="submit1" type="submit" class="btn btn-primary">Update Profile</button></td>
											  </tr>
											 
                                              
                                              								</tbody>
										  </table>
                                          </form>
                                     </div>
                                     <!--------------------------------Gallery---------------------->
                                  
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
       <?php include '../includes/footer.php' ?>
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/typeahead.min.js"></script>
<script>
$('#origin').typeahead({
    name: 'cargo_office',
	 remote: {
            url : '../../../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
</script>       
  </body>
</html>