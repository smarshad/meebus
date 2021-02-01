<?php
session_start();
session_destroy();
session_start();
ob_start();
//include_once("google/config.php");
include_once '../database/connect.php';
include_once 'sendsms.php';
//include_once("google/includes/functions.php");

$msg = (isset($_GET['msg']) && $_GET['msg'] != '') ? $_GET['msg'] : '';


if (isset($_POST['submit1'])) {
	$email_id=mysql_real_escape_string(strip_tags($_POST["email_id"]));
$password=mysql_real_escape_string(strip_tags($_POST["password"]));
//echo $new="SELECT * FROM user_login WHERE email_id='$email_id' AND password='$password'"; die;
 $res="SELECT * FROM aff_login WHERE email='$email_id' AND password='$password' AND status='1'";

$result = mysql_query($res);
$data = mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){   
$_SESSION['aff']['affiliate_id']=$data['id'];
$first_name=$_SESSION['aff']['first_name']=$data['first_name'];
$mobile_number=$_SESSION['aff']['mobile_number']=$data['mobile_number'];
$balance=$_SESSION['aff']['balance']=$data['balance'];
$_SESSION['aff']['email_id']=$email_id;

//$_SESSION['user']['password']=$password;
header("location:aff_dashboard.php"); }
else { $error_var1="Username or Password wrong";?>
<script>alert("Username or Password wrong");</script><?php
}
}
if (isset($_POST['submit'])) {
	$email  = $_POST['email']; 

    $first_name = mysql_real_escape_string(strip_tags($_POST['first_name']));    

    $email_post = mysql_real_escape_string(strip_tags($_POST['email']));    

    $password = mysql_real_escape_string(strip_tags($_POST['password']));

    $Cpassword = mysql_real_escape_string(strip_tags($_POST['Cpassword']));
	
	$website = mysql_real_escape_string(strip_tags($_POST['website']));

    $age = mysql_real_escape_string(strip_tags($_POST['age']));

    $mobile_number = mysql_real_escape_string(strip_tags($_POST['mobile_number']));

	$curdate = date('Y-m-d');


	$sels = "SELECT * FROM aff_login WHERE email='$email' OR mobile_number='$mobile_number'";
    $qry = mysql_query($sels);
    $sel = mysql_fetch_row($qry);

    if (mysql_num_rows($qry) == 1) {
        $msg = 'Email-id OR Mobile No Already available with our database';

    } else {



       $query="INSERT INTO aff_login SET";

       $query.=" name='".addslashes($first_name)."'";

       $query.=", email='$email_post'";

       $query.=", password='$password'";
	   
	   $query.=", website='$website'";

      // $query.=", confirm_password='$confirm_password'";

       $query.=", age='$age'";

       $query.=", mobile_number='$mobile_number'";
	   
	   $query.=", balance ='0'";

       //$query.=", gender='$gender'";             

       $query.=", curdate=NOW()";
	   

       mysql_query($query);
	   $_SESSION['last_insert_id'] = $last_insert_id = mysql_insert_id();
	   
       //if (!mysql_query("INSERT INTO `user_login` (`id`, `email_id`, `password`, `city`, `mobile_number`, `title`, `first_name`, `middle_name`, `last_name`, `date`, `country`, `state`, `address`, `pincode`, `date_of_birth`) VALUES (NULL, '$email', '$password', '$city', '$mobile_number', '$title', '$first_name', '$middle_name', '$last_name', '$curdate', '$country', '$state', '$address', '$pincode', '$date_of_birth');"))

       //exit(mysql_error());

        

       $message = '<div id="mailcontainer" style="width: 700px;

		margin: 0px auto;

		color: #999;

		border:3px solid #00BAF2;

		border-radius: 5px;

		font-family:Verdana, Geneva, sans-serif;

		font-size: 14px;">

    <div id="mailheader">

    <a href="#"><img alt="Urbus" src="http://Urbus.com/images/logo.png" class="logo"  style="padding:10px 0px 10px 20px; float:left"></a>

    <p class="phone"  style="padding:35px 30px 0px 0px; float:right;"> <i class="icon ico_tel"></i>+91- 86953&nbsp;63636</p>

    

    </div>

    <br clear="all" />

    <div id="mailnav" style="background: #042E6F;

		color: #fff;

		padding: 10px 20px 0;">

    <p  style="margin:0;

		padding: 0 0 15px 0;">Greetings from - Affiliate Registration setup,</p>

	</div>

    <div id="mailcontent" style="background: #f5f5f5;

		padding: 10px 20px 0;">

    

    

    <p  style="margin:0;

		padding: 0 0 15px 0;"><b>Dear '.$first_name.'</b></p>

    <p  style="margin:0;

		padding: 0 0 15px 0;">Many thanks for your Interest and Submitting Online Affiliate Registration using <a target="_blank" style="color:#000;" href="http://scriptstore.in/own_redbus">own_redbus</a>  Your application is under process and will be reviewed for Registration by our team</p>

 

<p style="margin:0;

		padding: 0 0 15px 0;"><table width="363" border="0">

                                            <tbody><tr>

                                                <td width="173" height="25" align="center">Name</td>

                                                <td width="174" height="25" align="center">' . $first_name. '</td>

                                            </tr>

                                            <tr>


                                                <td width="173" height="25" align="center">Username</td>

                                                <td width="174" height="25" align="center">'. $email_post .'</td>

                                            </tr>

                                            <tr>

                                                <td width="173" height="25" align="center">Password</td>   

                                                <td width="174" height="25" align="center">'. $password .'</td>

                                            </tr>

                                        </tbody></table></p>



<p style="margin:0;

		padding: 0 0 15px 0;">Please do not hesitate to contact us on <a target="_blank" href="#">info@Urbus.com</a> for all your Urgent Queries / Reservation or Requirements. </p>

	</div>

    <div id="mailfooter" style="background: #00BAF2;

		padding: 10px 10px 0;

		text-align: center;

		color: #fff;">

   		<p  style="margin:0;

		padding: 0 0 15px 0;"class="footer">&copy; 2015, Purebus.com. . Mobile No :+91- 86953&nbsp;63636 </p>

    </div>

</div>';

		$adminto="subbaiya@doditsolutions.in";

//$adminto="prasath@doditsolutions.in";

        $subject1 = "New Affiliate Registration";

	    $subject = "Registration Successfully";

        $headers = "MIME-Version: 1.0" . "\r\n";

        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

        $headers .= "From: urbus.com" . "\r\n";
        //if(isset($email) && $email!='')
		if(isset($email) && $email!='' && !filter_var($email, FILTER_VALIDATE_EMAIL) === false)
				{
					mail($email, $subject, $message, $headers);
					mail($adminto, $subject1, $message, $headers);
					$msg="Your Affiliate profile has been created successfully!";
					$_SESSION['msg'] = "Your Affiliate profile has been created successfully!";
				}
					$otpNew 		= rand(0,9999999);
					$otpNew_email 	= rand(0,9999999);
					
					$_SESSION['sc']=0;
					
					unset($_SESSION['MOBILE_OTP']);
					unset($_SESSION['sc']);
		
		
		for($i=0; $i<=9999999; $i++)
		{
			$selectOTP1 = "SELECT * FROM aff_login WHERE otp = '$otpNew' && email_otp = '$otpNew_email'";
			$queryOTP1 = mysql_query($selectOTP1);
			$num_rowsOTP1 = mysql_num_rows($queryOTP1);
			
			if($num_rowsOTP1==0)
				{
					$_SESSION['MOBILE_OTP'] = $otpNew;
					$_SESSION['EMAIL_OTP'] = $otpNew_email;
					break;
				}
			else 
				{
					$otpNew 		= rand(0,9999999);
					$otpNew_email 	= rand(0,9999999);		
				}
		}
		
		//echo "-a-".$_SESSION['MOBILE_OTP'].'-'.$_SESSION['EMAIL_OTP']; exit;
			
				$otpNew1 		= $_SESSION['MOBILE_OTP'];
				$otpNew_email1 	= $_SESSION['EMAIL_OTP'];
				$last_insert_id = $_SESSION['last_insert_id'];
				
				$updateOTP1  = "UPDATE aff_login 
												SET 
													otp			=	'$otpNew1',
													email_otp	=	'$otpNew_email1'
													WHERE id 	=	'$last_insert_id'";
				$queryOTP1 = mysql_query($updateOTP1);									
				
				$message_OTP = '<div id="mailcontainer" style="width: 700px;

		margin: 0px auto;

		color: #999;

		border:3px solid #00BAF2;

		border-radius: 5px;

		font-family:Verdana, Geneva, sans-serif;

		font-size: 14px;">

    <div id="mailheader">

    <a href="#"><img alt="busbooking" src="images/redbus_logo.png.png" class="logo"  style="padding:10px 0px 10px 20px; float:left"></a>

    <p class="phone"  style="padding:35px 30px 0px 0px; float:right;"> <i class="icon ico_tel"></i>+91- <span class="footer" style="margin:0;

		padding: 0 0 15px 0;">86953&nbsp;63636</span></p>

    

    </div>

    <br clear="all" />

    <div id="mailnav" style="background: #042E6F;

		color: #fff;

		padding: 10px 20px 0;">

    <p  style="margin:0;

		padding: 0 0 15px 0;">Greetings from - Affiliate Registration Email OTP Verification ,</p>

	</div>

    <div id="mailcontent" style="background: #f5f5f5;

		padding: 10px 20px 0;">

    

    

    <p  style="margin:0;

		padding: 0 0 15px 0;"><b>Dear '.$first_name.'</b></p>

    <p  style="margin:0;

		padding: 0 0 15px 0;">Your Email OTP : <b> '.$otpNew_email1.'</b></p>

 

<p style="margin:0;

		padding: 0 0 15px 0;">Please do not hesitate to contact us on <a target="_blank" href="#">info.com</a> for all your Urgent Queries / Reservation or Requirements. 
	</div>

    <div id="mailfooter" style="background: #00BAF2;

		padding: 10px 10px 0;

		text-align: center;

		color: #fff;">

   		<p  style="margin:0;

		padding: 0 0 15px 0;"class="footer">&copy; 2015, Ownbus . Mobile No :+91- 95666&nbsp;23477</p>

    </div>

</div>';
				
				$subject_OTP = "urbus Email OTP Verification";
		        $headers_OTP = "MIME-Version: 1.0" . "\r\n";
		        $headers_OTP .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		        $headers_OTP .= "From: urbus.com" . "\r\n";
				sendsms("Thanks For Ownbus Affiliate Registration, Your Mobile OTP is : ".$otpNew1,$mobile_number);
                if(isset($email) && $email!='' && !filter_var($email, FILTER_VALIDATE_EMAIL) === false)
				{
					mail($email, $subject_OTP, $message_OTP, $headers_OTP);
					//header('location:registration_otp.php?motp='.$otpNew1.'&eotp='.$otpNew_email1); 
					
				
				}
				header('location:aff_registration_otp.php');
				
	} }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		<title>Busbooking</title>
		<meta content="" name="description" />
		<meta content="" name="keywords" />
		<meta content="" name="author" />
         <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
		<meta content="global" name="distribution" />
		<meta content="general" name="rating" />
		<meta content="follow, index, all" name="robots" />
		<meta content="index,follow" name="googlebot" />
		<meta content="1 days" name="revisit-after" />
		<meta content="Public" name="doc-type" />
		<meta content="travel" name="classification" />
		<meta content="en" http-equiv="content-language" />
		<meta content="text/html; charset=utf-8" http-equiv="content-type" />
        <link href="css/reset3860.css?v=1" type="text/css" rel="stylesheet" />
        <link href="css/jquery.qtip3860.css?v=1" type="text/css" rel="stylesheet" />
        <link href="css/opensans3860.css?v=1" type="text/css" rel="stylesheet" />
        <link href="css/common3860.css?v=1" type="text/css" rel="stylesheet" />
       
        
         <script>
		 

function lettersOnly() {
      if (!register.first_name.value.match(/^[a-zA-Z]+$/) && register.first_name.value !="")
{
register.first_name.value="";
register.first_name.focus();
alert("Please Enter only alphabets in text");
}
     }	   
	   
function carcheck()
{
	alert('a');
	 if (!/^[a-zA-Z]*$/g.test(document.form.first_name.value)) {
        alert("Invalid characters");
        document.myForm.name.focus();
        return false;
    }	
}

	 function onlyAlphabets() { 
				  var regex = /^[a-zA-Z]*$/;
				  if (regex.test(document.f.nm.value)) 
				  		{
						     return true;
						} 
				  else 
				  		{
						      document.getElementById("notification").innerHTML = "Alphabets Only";
						      return false;
					    }

 }
  
	 $(document).ready(function() { 
		   
	
	    $("#age").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
		   
    $("#mobile_number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }); });
	   
	 function validateEmail(emailField){ 
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(emailField.value) == false) 
        {
                document.getElementById("mail_error").innerHTML = "Invalid Email Address";
				document.getElementById("mail_success").innerHTML = "";
				//document.getElementById('bus_booking1').style.display = 'none';
                return false;
        }
	       return true;
		 }
	   
	 function removestyle() { }

     function  validateform() { 

                    if ($("#fname").val() == "")

                    {

                        $("#fname").val("");

                        $("#fname").css("border-color", "red");

                        $("#fname").attr("placeholder", "Should not be empty");

                        return false;

                    }                    

                    var y = document.forms["regForm1"]["email"].value;

                    if (y == null || y == "")

                    {

                        $("#email").val("");

                        $("#email").css("border-color", "red");

                        $("#email").attr("placeholder", "Email-Id Required");

                        return false;

                    }

                    var filter = /^((\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*?)\s*;?\s*)+/;

                    if (!filter.test(y))

                    {

                        $("#email").val("");


                        $("#email").css("border-color", "red");

                        $("#email").attr("placeholder", "Email-Id should be valid");

                        return false;

                    }

                    if ($("#password").val() == "")

                    {

                        $("#password").val("");

                        $("#password").css("border-color", "red");

                        $("#password").attr("placeholder", "Should not be empty");

                        return false;

                    }

                    if ($("#Cpassword").val() == "")

                    {

                        $("#Cpassword").val("");

                        $("#Cpassword").css("border-color", "red");

                        $("#Cpassword").attr("placeholder", "Should not be empty");

                        return false;

                    }

                    if (($("#Cpassword").val()) != ($("#password").val()))

                    {

                        $("#Cpassword").val("");

                        $("#Cpassword").css("border-color", "red");

                        $("#Cpassword").attr("placeholder", "Does not matched");

                        return false;                     

                    }

                    if ($("#mobile_number").val() == "")

                    {

                            $("#mobile_number").val("");

                            $("#mobile_number").css("border-color", "red");

                            $("#mobile_number").attr("placeholder", "Should not be empty");

                            return false;

                    }

                    var x = document.forms["regForm1"]["mobile_number"].value;

                    if (x == null || x == "")

                    {

                        $("#mobile_number").val("");

                        $("#mobile_number").css("border-color", "red");

                        $("#mobile_number").attr("placeholder", "Mobile number should be empty");

                        return false;

                    }

                    if (isNaN(x) || x.indexOf(" ") != -1)

                    {

                        $("#mobile_number").val("");

                        $("#mobile_number").css("border-color", "red");

                        $("#mobile_number").attr("placeholder", "Mobile Number should be numeric value");

                        return false;

                    }

                    if (x.length > 10)

                    {

                        $("#mobile_number").val("");

                        $("#mobile_number").css("border-color", "red");

                        $("#mobile_number").attr("placeholder", "Enter 10 Digits only");

                        return false;

                    }

                 }

     function email_checking(str) { 

                    if (window.XMLHttpRequest)

                    {// code for IE7+, Firefox, Chrome, Opera, Safari

                        xmlhttp = new XMLHttpRequest();

                    }

                    else

                    {// code for IE6, IE5

                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

                    }

                    xmlhttp.onreadystatechange = function()

                    {

                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)

                        {

							if (xmlhttp.responseText == "not valid")

                            {

                                document.getElementById("mail_error").innerHTML = "Please Enter Valid Email ID";
								document.getElementById("mail_success").innerHTML = "";
								//document.getElementById('bus_booking1').style.display = 'none';

                            }

                            if (xmlhttp.responseText == "available")

                            {

                                document.getElementById("mail_error").innerHTML = "";
								document.getElementById("mail_success").innerHTML = "This Email ID Available";
								//document.getElementById('bus_booking1').style.display = 'block';

                            }
							
							
							if(xmlhttp.responseText == 'Not Available') 
							{
								document.getElementById("mail_error").innerHTML = "Email-Id already exist";
								document.getElementById("mail_success").innerHTML = "";
								//document.getElementById('bus_booking1').style.display = 'none';
								return false;

							}
							
							if(xmlhttp.responseText == 'Email Ok') 
							{
								document.getElementById("mail_error").innerHTML = "";
								document.getElementById("mail_success").innerHTML = "This Email ID Available";
								//document.getElementById('bus_booking1').style.display = 'none';

							}

                        }

                    }

                    xmlhttp.open("GET", "checkmail.php?q=" + str, true);

                    xmlhttp.send();

                 }
				
	function mobile_checking(str)

                {

                    if (window.XMLHttpRequest)

                    {// code for IE7+, Firefox, Chrome, Opera, Safari

                        xmlhttp = new XMLHttpRequest();

                    }

                    else

                    {// code for IE6, IE5

                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

                    }

                    xmlhttp.onreadystatechange = function()

                    {

                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)

                        {
								
                            if (xmlhttp.responseText == "available")

                            {
								 document.getElementById("mobile_error").innerHTML = "";
								document.getElementById("mobile_success").innerHTML = "This Mobile is Available";
								//document.getElementById('bus_booking1').style.display = 'block';
                            }
							 if (xmlhttp.responseText == "Not available")
							{
								document.getElementById("mobile_error").innerHTML = "Mobile No already exist";
								document.getElementById("mobile_success").innerHTML = "";
								//document.getElementById('bus_booking1').style.display = 'none';
							}

                        }

                    }

                    xmlhttp.open("GET", "checkmobilel.php?q=" + str, true);

                    xmlhttp.send();

                }
				
				

              </script>
              <script type="text/javascript">
			  function checkotp()
			  	  {
				  		$.post( "aff_otp_check.php?motp="+$('#motp').val()+"&eotp="+$('#eotp').val(), function( data ) {
							if(data=="1")
							{
								window.location = 'index.php';	
							}
							else 
							{
								$('#errorData').html('Please Enter Correct Email & Mobile OPT');
								return false;	
							}
});
			      }
			  </script>
		</head>
	<body class="home affilite-bg">

		<div class = "header clearfix">
			<div class="left logo">
				<a href="#" title="Online Bus Ticket Booking"><img src="../images/redbus_logo.png" alt="" /></a>
			</div>
			<span class="seperator left"></span>
			<span class="affiliate-head left">Bus Affiliate Partner</span>
			<a href="javascript:void(0)" id="login" class="login-btn right">Login</a>
		</div>

		<div class="banner-content-wrap clearfix">
			<div class="affiliate-diagram-wrap wrap center clearfix">
				<div class="affiliate-block block-orange left">
					<span class="affiliate-sprite aff-num num-1"></span>
					<span class="affiliate-sprite aff-icon join"></span>
					<span class="aff-text">join us</span>
				</div>
				<div class="affiliate-block block-grey left">
					<span class="affiliate-sprite aff-num num-2"></span>
					<span class="affiliate-sprite aff-icon link"></span>
					<span class="aff-text1">link websites</span>
				</div>
				<div class="affiliate-block block-blue left">
					<span class="affiliate-sprite aff-num num-3"></span>
					<span class="affiliate-sprite aff-icon money"></span>
					<span class="aff-text">make money</span>
				</div>
			</div>
			<div class="affiliate-banner-btm">
				<div class="affiliate-btm-content wrap center clearfix">
					<span class="affiliate-sprite curly-braze-left left"></span>
					<div class="heading-wrap left">
						<h2>Do you own <span>Website?</span></h2>
						<h2>Make money by becoming <span>Ownbus Affiliate</span></h2>
					</div>
					<span class="affiliate-sprite curly-braze-right left"></span>
					<a href="javascript:void:0" class="join-btn right">
						<span class="join-arrow-wrap left">
							<span class="affiliate-sprite arrow-right"></span>
						</span>
						<span id="register" class="join-text-wrap left">join for free</span>
					</a>
				</div>
			</div>
			<a href="javascript:void(0)" id="affiliateScrollBtn" class="affiliate-sprite scroll-btn"></a>
		</div>

		<div class="description-wrap">
			<div class="wrap center description-content-wrap" id="affiliateScrollStop">
				<h2 class="txtCenter">Ownbus Bus Ticket Booking Affiliate Program: Help us to help you.</h2>
				<p>
					Affiliate with Own_redbus, India's most trusted bus booking service and make easy money. All you got to do is register with us and add our widgets to your website or blog. It is that simple.  The best part about affiliating with Ownbus is that it is absolutely free.
				</p>
			</div>	
		</div>

		<div class="content-btm wrap center">
			<h2>
				<span class="affiliate-sprite help-icon"></span>
				Help &amp; FAQs
			</h2>

			<div class="help-wrap">
				<h3>
					What is Ownbus affiliate program and how does it work?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans"></div>
				<h3>
					Who can I contact for more information or help?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">In case you have any queries, feel free to email us at <strong></strong>. We will get back to you within 72 hours.</div>
				<h3>
					How does one become eligible to affiliate with Ownbus and when and how do I earn referral commission?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">For you to be eligible to affiliate with , you need to run a website or a blog. In order to earn a referral commission, your website/blog visitor must click-through the search buses widget which redirects them to  website and book bus tickets in a single session. The referral fees will be paid only after the journey is completed.</div>
				<h3>
					How do I create a widget and add it to my website/blog?
					<span class="affiliate-sprite arrow-down"></span>					
				</h3>
				<div class="help-ans">
					<span>Creating a widget is quick and simple. All you got to do is register with  affiliate program.  The steps are as follows:</span>
					<ul class="clearfix">
						<li>Go to the affiliate page and click on register. Fill in your details, follow the instructions, register yourself and you're set.</li>
						<li>Log-in to your affiliate account and click the <strong>Affiliate Tools</strong> tab followed by the <strong>Create New Widget</strong> tab.</li>
						<li>Enter the required details, choose your desired widget dimension and size from the drop down box (the preview of the widget size can be seen at the bottom left of the page) and click on <strong>Create Widget</strong>.</li>
						<li>Go to the <strong>Manage Widgets</strong> tab and under the heading <strong>Action</strong>, click the <strong>Get Code</strong> option to render a Java script code.</li>
						<li>Copy the Java script code and paste it in the HTML code space of your website or blog page.</li>
						<li>The widget will appear on your blog.</li>
					</ul>
				</div>
				<h3>
					How does the widget work?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">The search buses widget is an advertisement for  on your website/ blog. The widget permits your site visitors to search for buses, select the routes and places they wish to travel along with the date of departure. Once the visitor clicks on search buses, s/he will be redirected to  and will be presented with a list of bus services as per their search requirements. The visitor can then book the bus journey of their choice, thus earning you commission through our generated revenue.</div>
				<h3>
					How do I find out which routes and journey date visitors selected?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">You can find the details in the <strong>Search Report</strong> section in the report section.</div>
				<h3>
					How many widgets can I feature on my website?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">There is no limit to number of widgets you can feature on your website. However as a practice, we do not recommend more than 3 widgets on a single page.</div>
				<h3>
					I own many websites. Can I implement widgets on all of them?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">Yes, you can implement widgets on any site that you own. However, we do ask that you comply with the policies outlined on the <strong>Terms and Conditions</strong> page.</div>
			</div>

			<h2>
				<span class="affiliate-sprite payout-icon"></span>
				Payouts
			</h2>

			<div class="help-wrap">
				<h3>
					How much can I earn via the affiliate program?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">The commission you earn depends on the number of bus tickets and the cost of the bus tickets booked on  using the widget on your website. You earn a 5% commission for every bus ticket booked through your widget.</div>
				<h3>
					What are the payment methods?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">Affiliates are paid through Electronic Fund Transfer (EFT). will accrue and withhold referral fees until the total amount due is at least Rs. 500.00. Accrued Payment is done once a month.</div>
				<h3>
					When is the payment made?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">We process payments by the last week of the following month. For instance, your June earnings would be paid by late July.</div>
				<h3>
					What are the details I have to provide to be able to receive payments?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">To receive payments, you need to fill out the details in the <strong>Payment Information</strong> section in <strong>Account Settings</strong>. We require all your necessary details (PAN, Payee Name and Mailing Address) to process the payment.</div>
				<h3>
					Are there any charges for my earnings?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">A 10% TDS is deducted on all payments made through Electronic Fund Transfer (EFT). Apart from this, there are no charges applicable.</div>
				<h3>
					What happens to my referral fees if they do not meet the minimum payment threshold?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">If the commission earned is less than Rs. 500, your fees will be rolled into the next month's total.</div>
				<h3>
					How do I keep track of my earnings and sales?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">The details of your earnings and sales are available in the Report section.</div>
				<h3>
					What if a bus booking is cancelled/partially cancelled by the customer or bus service is cancelled by the operator?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">In such a case, the user will be refunded as per refund policy of the website. However, the affiliate's account will not earn any commission on that transaction.</div>
				<h3>
					How do I view my payment history?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">Your payment history will be available on the <strong>Earning and Payments</strong> report on your account homepage.</div>				
			</div>

			<h3 class="affiliate-terms-link">Most Important - <a href="termsAndConditions.php" class="blk-link">Terms &amp; Conditions</a></h3>

		</div>
        


	<div id="wrapper">			
			<div id="qtip-dialog-content" style="display: none;">
				<div id="register-dialog">
	<div id="registration-alert" class="alert alert-error hidden"></div>
	<form id="regForm1" class="form pad10" action=""  method="POST" >
		<fieldset>
			<div class="row clearfix">

                                            <label>Name</label>
<div class="left field-div">
                                            <input name="first_name" type="text" class="required" onClick="removestyle('fname')" id="fname"  title="First Name"  value="" onkeyup="return lettersOnly();"/>
                                            </div>

                                        </div>
                                        <div class="row clearfix">
                                        <label>Email-id</label>
                                            <div class="left field-div">
                                            <input name="email" type="text" onClick="removestyle('email')" onBlur="email_checking(this.value);" onchange="return email_checking(this.value), validateEmail(this);" id="email"  class="email" title="Email-id" value="" required/> <div id="mail_error" style="color: red; font-size: 13px;"> </div>
                                            <div id="mail_success" style="color: blue; font-size: 13px;"> </div>
										</div>
                                        </div>
                                        <div class="row clearfix">
                                             <label>Website</label>
                                           <div class="left field-div">
                                            <input name="website" type="text"   class="email"  title="website" value="" required="required"/> <div id="mail_error" style="color: red; font-size: 13px;"> </div>
                                         
											</div>
                                        </div>
                                        <div class="row clearfix"> 
											<label>Password</label>
                                           <div class="left field-div">
                                            <input type="password" name="password" onClick="removestyle('password')" id="password" class="required"  rule="match: Password"  title="Password" required/>
												</div>
                                        </div>

                                        <div class="row clearfix">
                                <label>Confirm Password</label>
                                <div class="left field-div">
                                            <input name="Cpassword" type="password" onClick="removestyle('Cpassword')" id="Cpassword"  class="required" rule="match: Password" title="Password" required />
												</div>
                                        </div>

                                        <div style="clear:both"></div>

                                        <div class="row clearfix">
                                            <label>Age</label>
												   <div class="left field-div">
                                            <input type="text" name="age" id="age" class="required" title="Age" />
											</div>
                                        </div>

                                        <div style="clear:both"></div>

                                        <div class="row clearfix">
											<label> Mobile Number </label>
                                          <div class="left field-div">
                                            <input name="mobile_number"   type="text" onClick="removestyle('mobile_number')" id="mobile_number"  class="required" title="Mobile Number" value="" onBlur="mobile_checking(this.value)" maxlength="10" required />
                                            <div id="mobile_error" style="color: red; font-size: 13px;"> </div>
                                            <div id="mobile_success" style="color: blue; font-size: 13px;"> </div>
                                            
													</div>
                                        </div>

                                        
			
			<div class="row clearfix">
				<label>&nbsp;</label>
				<div class="left">
					<input type="submit" name="submit" value="Register" onClick="return validateform()">
					<span id="register-dialog-loading" class="hidden loading-ico"></span>
					<p class="font11-gray padT15">By clicking on "Register" above, I agree to the <a href="termsAndConditions.php" target="_blank">Affiliate Program Terms & Conditions</a>.</p>
				</div>
			</div>

		</fieldset>
	</form>
    <div id="otp" style="display:none;">
<form action="" method="post" id="register" name="register">
                                        <div class="inputtext ac_det"><?php echo $error_var1; ?></div>
                                        <div class="formnewname formnew">

                                            Mobile OTP : <span style="color:#f00;">*</span>

                                            <input name="motp" type="text" class="required" required="required" id="motp"  title="Mobile OTP" placeholder="Enter Mobile OTP"/>

                                        </div>

                                        <div style="clear:both"></div>

                                       <?php /*?> <div class="formnewemail formnew">

                                            Email OTP : <span style="color:#f00;">*</span>

                                            <input name="eotp" type="text" id="eotp"  class="email" style=" margin-left:13px!important;" title="Email-id"   placeholder="Enter Email OTP"/>

                                        </div><?php */?>
                                        <div class="formnewsubmitagree formnew">

                                            <input type="button" value="submit" style="width: 110px; text-align: center; float:right; margin-right:8px; margin-left: 10px; margin-top:5px; background-color: #E24648; border: 0 !important; border-radius: 4px;" id="submit" name="submit" class="btn2 btn_blue w120" onclick="return checkotp();"/>
                                        </div>

										<div id="errorData" class="formnewsubmitagree formnew" style="color:#F00; text-align:center; font-size:large;"></div>

                                    </form>

</div>
</div>

				<div id = "registerSuccessful-dialog">
	<div id="mail-sent"></div>
	<div class="font14">
		<p>Congratulations for signing up for Affiliate Program.</p>
		<p class="padT15">We have send a confirmation email to <strong class="display-email"></strong>.</p>
		<p class="padT15">In order to complete your registration, Please confirm your email address.</p>

		<h5 class="padT40">Didn&#39;t receive our email?</h5>
		<ol class="number-list">
			<li>Check your spam box</li>
			<li>Resend confirmation email to <span class="display-email"></span>. <a href="#"  id="resend-mail-link" class="font13-blue">Resend now</a></li>
			<span class="hidden loading-ico"></span>
		</ol>
	</div>
</div>
				
<div id="login-dialog">
	<div id ="login-alert" class="hidden alert alert-danger"></div>
	<form id="frm" class="form pad10" action="" method="post">
		<fieldset>
			<div class="row clearfix">
				<label>Email</label>
				<div class="left field-div hideSuccess">
					<input type="text" name="email_id" value="" id="email_id" title="Please enter your registered email address"  />					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>Password</label>
				<div class="left field-div">
					<input type="password" name="password" value="" id="loginpassword" title="Password"  />					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>&nbsp;</label>
				<div class="left">
					<input type="submit" name="submit1" value="Login">
					<span id="login_loading" class="hidden loading-ico"></span>
					<a href="#" id="forgotPassword" class="font13-blue marL15">Forgot Password?</a>
				</div>
			</div>
            <div class="inputtext ac_det"><?php echo $error_var1; ?></div>
		</fieldset>
	</form>
    <div id = "page"></div>
</div>				Login Content Ends 

				Forgot Password Content Starts 
				<div id="forgotpassword-dialog">
	<form id="forgotPasswordForm" class="form pad10">
		<fieldset>
			<div class="font14 padB25">
				To request a new password, please enter your registered email with Affiliate program
			</div>
			<div class="row clearfix">
				<label>Email</label>
				<div class="left field-div">
					<input id="forgotbtn-email" title="Email" type="text" name="email" placeholder="Please enter your registered email address" />
					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>&nbsp;</label>
				<div class="left">
					<button class="btn-orange btn-bold">Submit</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>				Forgot Password Content Ends 

				Secret QA Content Starts 
				<div id="secretqa-dialog"></div>
				Secret QA Content Ends 

				Password Reset Email Sent Content Starts 
				<div id="passreset-dialog">
	<div id="pass_reset_mail-sent"></div>
	<div class="font14">
		<span id="pass_email_resend_loading" class="hidden loading-ico"></span>
		<p>We have sent an email to <strong class="display-email"></strong> with instructions to reset your password.</p>
		<p class="padT10">Please click on the link in the email to reset your password.</p>
		<h5 class="padT40">Didn&#39;t receive our email?</h5>
		<ol class="number-list">
			<li>Check your spam box</li>
			<li>Resend email to <span class="display-email"></span>. <a href="#" id="pass_email_resend_link" class="font13-blue">Resend now</a></li>
		</ol>
	</div>
</div>				Password Reset Email Sent Content Ends 

			Forgot Security Answer Content Starts 
			<div id="forgotsecurityans-dialog">
				<div class="font14">
					<p>You are requested to get in touch with <strong></strong> to retrieve your account details. </p>
					<p class="padT10">We regret for the inconvenience caused. Thank you for your patience.</p>
				</div>
			</div>

		</div>
	</div> 
			<script type="text/javascript" src="js/jquery-1.8.3.min3860.js?v=1" ></script>
			<script type="text/javascript" src="js/jquery.qtip3860.js?v=1" ></script>
			<script type="text/javascript" src="js/jquery.placeholder3860.js?v=1" ></script>
			<script type="text/javascript" src="js/jquery.validate3860.js?v=1" ></script>
			<script type="text/javascript" src="js/common3860.js?v=1" ></script>
			<script type="text/javascript" src="js/homepage3860.js?v=1" ></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#affiliateScrollBtn').click(function(){
				$('html, body').animate({
			        scrollTop: $('#affiliateScrollStop').offset().top
			    }, 500);
			});
		});
	</script>
	
</body>


</html>