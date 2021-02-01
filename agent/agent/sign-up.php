<?php 
include_once'../server/server.php';  

$_SESSION['common']['pagename'] = "Home"; 
include_once 'includes/functions.php';
//include_once '../sendsms.php';
$obj=new agent_module($con);  



if(isset($_POST['Submit']) && $_POST['Submit']=='Submit')
{
	$dist_id	= '10001';
	$agent_name=$_POST['agent_name'];
	$agency_name=$_POST['agency_name'];
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$off_landline=$_POST['off_landline'];
	$state_name=$_POST['state_name'];
	$address=$_POST['address'];
	$city_name=$_POST['city_name'];
	$country=$_POST['country'];
	$mobile=$_POST['mobile'];
	$fax_no=$_POST['fax_no'];
	$pincode=$_POST['pincode'];
	$logo=$_POST['logo'];
	$data=array($dist_id,$agent_name,$agency_name,$user_name,$password,$email,$off_landline,$state_name,$address,$city_name,$country,$mobile,$fax_no,$pincode,$logo,'no');	
	
$sign_up=$obj->agentSignup($data);

	
	if($sign_up==1)
	{
	$msg="Registration Successfully. Please wait for admin approval";
	
	$to = $email;
	$adminto ="Urbuses@gmail.com";
	$adminto1 ="subbaiya@doditsolutions.in";
    $message = '<div id="mailcontainer" style="width: 700px;
		margin: 0px auto;
		color: #999;
		border: 1px solid #ffa024;
		border-radius: 5px;
		font-family:Verdana, Geneva, sans-serif;
		font-size: 14px;">
    <div id="mailheader">
    <a href="#"><img alt="Urbus" src="http://Urbus.com/agent/agent/images/logo.png" class="logo"  style="padding:10px 0px 10px 20px; float:left"></a>
    <p class="phone"  style="padding:35px 30px 0px 0px; float:right;"> <i class="icon ico_tel"></i>+91- 86953&nbsp;63636</p>
    
    </div>
    <br clear="all" />
    <div id="mailnav" style="background: #155E8D;
		color: #fff;
		padding: 10px 20px 0;">
    <p  style="margin:0;
		padding: 0 0 15px 0;">Greetings from Urbus - Complete Agency setup,</p>
	</div>
    <div id="mailcontent" style="background: #fff;
		padding: 10px 20px 0;">
    
    
    <p  style="margin:0;
		padding: 0 0 15px 0;"><b>Dear '.$agent_name.'</b></p>
    <p  style="margin:0;
		padding: 0 0 15px 0;">Many thanks for your Interest and Submitting Online Agent Registration using <a target="_blank" style="color:#000;" href="http://www.urbus.info">www.urbus.info</a>  Your application is under process and will be reviewed for Registration by our team</p>
 
<p style="margin:0;
		padding: 0 0 15px 0;">Within Next 48 Business Hours; they will get in touch with you on your mentioned email for Login Details along with the Welcome Kit will be emailed to you.</p>

<p style="margin:0;
		padding: 0 0 15px 0;">Please do not hesitate to contact us on <a target="_blank" href="mailto:info@Urbus.com">info@Urbus.com</a> for all your Urgent Queries / Reservation or Requirements. </p>
	</div>
    <div id="mailfooter" style="background: #ffa024;
		padding: 10px 10px 0;
		text-align: center;
		color: #fff;">
   		<p  style="margin:0;
		padding: 0 0 15px 0;"class="footer">&copy; 2016, Urbus.com . Mobile No :+91- 123456789 </p>
    </div>
</div>';

$newagentmsg = '<div id="mailcontainer" style="width: 700px;
		margin: 0px auto;
		color: #999;
		border: 1px solid #ffa024;
		border-radius: 5px;
		font-family:Verdana, Geneva, sans-serif;
		font-size: 14px;">
    <div id="mailheader">
    <a href="#"><img alt="Urbus" src="http://Urbus.com/agent/agent/images/logo.png" class="logo"  style="padding:10px 0px 10px 20px; float:left"></a>
    <p class="phone"  style="padding:35px 30px 0px 0px; float:right;"> <i class="icon ico_tel"></i>+91- 86953&nbsp;63636</p>
    
    </div>
    <br clear="all" />
    <div id="mailnav" style="background: #155E8D;
		color: #fff;
		padding: 10px 20px 0;">
    <p  style="margin:0;
		padding: 0 0 15px 0;">Urbus.com New Agent Register Alert</p>
	</div>
    <div id="mailcontent" style="background: #fff;
		padding: 10px 20px 0;">
    
    
    <p  style="margin:0;
		padding: 0 0 15px 0;"><b>Agent Name  : '.$agent_name.'</b></p>
    <p  style="margin:0;
		padding: 0 0 15px 0;"><b>Agency Name : '.$agency_name.'</b></p>
    <p  style="margin:0;
		padding: 0 0 15px 0;"><span style="margin:0;
		padding: 0 0 15px 0;"><b>User Name  : '.$user_name.'</b></span></p>
    <p  style="margin:0;
		padding: 0 0 15px 0;"><span style="margin:0;
		padding: 0 0 15px 0;"><b>Password :   '.$password.'</b></span></p>
    <p  style="margin:0;
		padding: 0 0 15px 0;"><span style="margin:0;
		padding: 0 0 15px 0;"><b>Email :   '.$email.'</b></span></p>
    <p  style="margin:0;
		padding: 0 0 15px 0;"><b>Mobile  '.$mobile.'</b></p>
  </div>
    <div id="mailfooter" style="background: #ffa024;
		padding: 10px 10px 0;
		text-align: center;
		color: #fff;">
   		<p  style="margin:0;
		padding: 0 0 15px 0;"class="footer">&copy; 2016, Urbus.com . Mobile No :+91- 86953&nbsp;63636 </p>
    </div>
</div>';

$smsmessage = 'Thanks For Using Urbus.com Your Agent Registration Is Processing, Please Wait For Admin Approval Thank You :) https://Urbus.com';
    $subject = "Agent Registration Acknowledgment - www.urbus.info";
	$subject1 = "New Agent Registration Alert - www.urbus.info";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= "From: Urbus.com <info@Urbus.com>" . "\r\n";
    
	mail($to, $subject, $message, $headers);
	mail($adminto, $subject1, $newagentmsg, $headers);
	
	mail($adminto1, $subject1, $newagentmsg, $headers);
	mail($adminto1, $subject1, $message, $headers);
	
//    sendsms($smsmessage, $mobile);
//	voice_agentregistration($mobile);
	header('location:login.php?msg=Register Success');
	}
	else
	{
	$msg="Registration failed";
	unset($_POST);
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
    	<?php  include_once 'includes/head.php';   ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type="text/javascript">
		$(document).ready(function() {
			
			
		$("#mobile").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) ||
        (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) { return; }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) { e.preventDefault(); } });
		
		$("#pincode").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) ||
        (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) { return; }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) { e.preventDefault(); } });
		
		$("#fax_no").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) ||
        (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) { return; }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) { e.preventDefault(); } });
});
</script>
    </head>
<body>
	<?php  include_once 'includes/top_menu.php';   ?>
    <?php if($msg!='') { ?>
    <p align="center"><?php echo $msg; ?></p>
    <?php } ?>
    <div class="container-fluid">
    <div class="row-fluid">
    <!-- block -->
    <div class="block">
    <div class="navbar navbar-inner block-header">
    <div class="muted pull-left">New Agent Registration</div>
    </div>
    <div class="block-content collapse in">
    <form id="form" name="form" class="" action="" method="post" >
    <div class="span12">  
    <div class="span6">
    <fieldset>
    <div class="control-group">
    <label for="focusedInput" class="control-label">Agent Name</label>
    <div class="controls">
    <input type="text" value="" id="agent_name"  name="agent_name" required class="input-xlarge focused">
    </div>
    </div>
    <div class="control-group">
    <label for="focusedInput" class="control-label">Agency Name</label>
    <div class="controls">
    <input type="text" value="" id="agency_name"  name="agency_name" required class="input-xlarge focused">
    </div>
    </div>
    <div class="control-group">
    <label for="focusedInput" class="control-label">User Name</label>
    <div class="controls">
    <input type="text" value="" id="user_name"  name="user_name" required class="input-xlarge focused">
    </div>
    </div>
    <div class="control-group">
    <label for="focusedInput" class="control-label">Password</label>
    <div class="controls">
    <input type="password" value="" id="password"  name="password" required class="input-xlarge focused">
    </div>
    </div>
    <div class="control-group">
    <label for="focusedInput" class="control-label">Email ID</label>
    <div class="controls">
    <input type="text" value="" id="email"  name="email" required class="input-xlarge focused">
    </div>
    </div>   
    <div class="control-group">
    <label for="focusedInput" class="control-label">Office Landline</label>
    <div class="controls">
    <input type="text" value="" id="off_landline"  name="off_landline" class="input-xlarge focused">
    </div>
    </div> 
    <div class="control-group">
    <label for="focusedInput" class="control-label">State Name</label>
    <div class="controls">
    <input type="text" value="" id="state_name"  name="state_name" required class="input-xlarge focused">
    </div>
    </div>      
    <div class="control-group">
    <label for="focusedInput" class="control-label">Country</label>
    <div class="controls">
    <input type="text" value="" id="country"  name="country" required class="input-xlarge focused">
    </div>
    </div>
    </fieldset>
    </div> 
    <div class="span6">
    <fieldset>
    <div class="control-group">
    <label for="focusedInput" class="control-label">Address</label>
    <div class="controls">
    <textarea id="address" name="address" class="input-xlarge focused" required></textarea>
    </div>
    </div>    
    <div class="control-group">
    <label for="focusedInput" class="control-label">Mobile No</label>
    <div class="controls">
    <input  name="mobile" type="text" required  class="input-xlarge focused" id="mobile" value="" maxlength="10">
    </div>
    </div>  
    <div class="control-group">
    <label for="focusedInput" class="control-label">Fax No</label>
    <div class="controls">
    <input type="text" value="" id="fax_no"  name="fax_no" class="input-xlarge focused">
    </div>
    </div>    
    <div class="control-group">
    <label for="focusedInput" class="control-label">City Name</label>
    <div class="controls">
    <input type="text" value="" id="city_name" required  name="city_name" class="input-xlarge focused">
    </div>
    </div>
    <div class="control-group">
    <label for="focusedInput" class="control-label">Pincode</label>
    <div class="controls">
    <input type="text" value="" id="pincode" required  name="pincode" class="input-xlarge focused">
    </div>
    </div>
    <div class="control-group">
    <label for="fileInput" class="control-label">Logo</label>
    <div class="controls">
    <div class="uploader" id="uniform-fileInput">
    <input type="file" id="fileInput" name="logo" class="input-file uniform_on">
    <!-- <div class="g-recaptcha" data-sitekey="6LclqggUAAAAAFem6SSG6e4qnBtHLO-Ma5-Rllsx"></div> -->
    </div>
    </div>
    </div>
    </fieldset>
    </div>
    </div>
    <div class="span12">
    <fieldset>
    <div class="span4"></div>
    <div class="span4">								
    <input class="btn-primary" style="padding:10px 40px 10px 40px !important;" type="submit" id="Submit" name="Submit" value="Submit"> &nbsp; &nbsp; &nbsp; &nbsp;
    <button class="btn-primary" style="padding:10px 40px 10px 40px !important;" type="reset">Cancel</button>
    </div>
   
    </fieldset>
    </div>
    </form>
    </div>
    </div>
    <!-- /block -->
    </div>					
    </div><br>
<br>
 <!-- /container -->
	<?php include 'includes/footer2.php' ?>

</body>
</html>