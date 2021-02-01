<?php
session_start();
session_destroy();
session_start();
ob_start();
//include_once("google/config.php");
include_once 'database/connect.php';
include_once 'sendsms.php';
//include_once("google/includes/functions.php");

$msg = (isset($_GET['msg']) && $_GET['msg'] != '') ? $_GET['msg'] : '';

if (isset($_POST['email']) && $_POST['email']!='' && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	$email  = $_POST['email']; 

    $first_name = mysql_real_escape_string(strip_tags($_POST['first_name']));    

    $email_post = mysql_real_escape_string(strip_tags($_POST['email']));    

    $password = mysql_real_escape_string(strip_tags($_POST['password']));

    $Cpassword = mysql_real_escape_string(strip_tags($_POST['Cpassword']));
	
	$website = mysql_real_escape_string(strip_tags($_POST['website']));

    $age = mysql_real_escape_string(strip_tags($_POST['age']));

    $mobile_number = mysql_real_escape_string(strip_tags($_POST['mobile_number']));
	
	$account_number = mysql_real_escape_string(strip_tags($_POST['account_number']));
	
	$pan_card = mysql_real_escape_string(strip_tags($_POST['pan_card']));
	
	$bank_name = mysql_real_escape_string(strip_tags($_POST['bank_name']));
	
	$ifsc = mysql_real_escape_string(strip_tags($_POST['ifsc']));

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

       $query.=", account_number='$account_number'";
	   
	     $query.=", pan_card='$pan_card'";
		 
		 $query.=", bank_name='$bank_name'";
		 
		 $query.=", 	ifsc='$ifsc'";

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

    <a href="#"><img alt="urbus" src="http://Urbus.com/images/logo.png" class="logo"  style="padding:10px 0px 10px 20px; float:left"></a>

    <p class="phone"  style="padding:35px 30px 0px 0px; float:right;"> <i class="icon ico_tel"></i>+91- 86953&nbsp;63636</p>

    

    </div>

    <br clear="all" />

    <div id="mailnav" style="background: #042E6F;

		color: #fff;

		padding: 10px 20px 0;">

    <p  style="margin:0;

		padding: 0 0 15px 0;">Greetings from urbus - Affiliate Registration setup,</p>

	</div>

    <div id="mailcontent" style="background: #f5f5f5;

		padding: 10px 20px 0;">

    

    

    <p  style="margin:0;

		padding: 0 0 15px 0;"><b>Dear '.$first_name.'</b></p>

    <p  style="margin:0;

		padding: 0 0 15px 0;">Many thanks for your Interest and Submitting Online Affiliate Registration using <a target="_blank" style="color:#000;" href="http://www.Urbus.com">www.Urbus.com</a>  Your application is under process and will be reviewed for Registration by our team</p>

 

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

		padding: 0 0 15px 0;">Please do not hesitate to contact us on <a target="_blank" href="mailto:info@Urbus.com">info@Urbus.com</a> for all your Urgent Queries / Reservation or Requirements. </p>

	</div>

    <div id="mailfooter" style="background: #00BAF2;

		padding: 10px 10px 0;

		text-align: center;

		color: #fff;">

   		<p  style="margin:0;

		padding: 0 0 15px 0;"class="footer">&copy; 2015, urbus.com. . Mobile No :+91- 86953&nbsp;63636 </p>

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

    <a href="#"><img alt="urbus" src="http://Urbus.com/images/logo.png" class="logo"  style="padding:10px 0px 10px 20px; float:left"></a>

    <p class="phone"  style="padding:35px 30px 0px 0px; float:right;"> <i class="icon ico_tel"></i>+91- <span class="footer" style="margin:0;

		padding: 0 0 15px 0;">86953&nbsp;63636</span></p>

    

    </div>

    <br clear="all" />

    <div id="mailnav" style="background: #042E6F;

		color: #fff;

		padding: 10px 20px 0;">

    <p  style="margin:0;

		padding: 0 0 15px 0;">Greetings from urbus - Affiliate Registration Email OTP Verification ,</p>

	</div>

    <div id="mailcontent" style="background: #f5f5f5;

		padding: 10px 20px 0;">

    

    

    <p  style="margin:0;

		padding: 0 0 15px 0;"><b>Dear '.$first_name.'</b></p>

    <p  style="margin:0;

		padding: 0 0 15px 0;">Your Email OTP : <b> '.$otpNew_email1.'</b></p>

 

<p style="margin:0;

		padding: 0 0 15px 0;">Please do not hesitate to contact us on <a target="_blank" href="mailto:info@Urbus.com">info@Urbus.com</a> for all your Urgent Queries / Reservation or Requirements. 
	</div>

    <div id="mailfooter" style="background: #00BAF2;

		padding: 10px 10px 0;

		text-align: center;

		color: #fff;">

   		<p  style="margin:0;

		padding: 0 0 15px 0;"class="footer">&copy; 2015, urbus.com. . Mobile No :+91- 86953&nbsp;63636 </p>

    </div>

</div>';
				
				$subject_OTP = "urbus Email OTP Verification";
		        $headers_OTP = "MIME-Version: 1.0" . "\r\n";
		        $headers_OTP .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		        $headers_OTP .= "From: urbus.com" . "\r\n";
				sendsms("Thanks For urbus Affiliate Registratio, Your Mobile OTP is : ".$otpNew1,$mobile_number);
                if(isset($email) && $email!='' && !filter_var($email, FILTER_VALIDATE_EMAIL) === false)
				{
					mail($email, $subject_OTP, $message_OTP, $headers_OTP);
					//header('location:registration_otp.php?motp='.$otpNew1.'&eotp='.$otpNew_email1); 
					header('location:aff_registration_otp.php'); 
				}
				else 
				{
					header('location:aff_register.php');
				}
	} }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

       <title>Busbooking</title>

       <link type="text/css" href="css/purebus.css" rel="stylesheet" media="screen" />
       
       <meta name="viewport" content="width=device-width, initial-scale=1.0">

       <script type="text/javascript" src="js/jquery-1.8.3.js"></script>

       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>            

<?php /*?><script>

(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=416130075106867";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));

</script>

<script>

  function statusChangeCallback(response) {

    console.log('statusChangeCallback');

    console.log(response);

    if (response.status === 'connected') {

      testAPI();

    } else if (response.status === 'not_authorized') {

      //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';

    } else {

      //document.getElementById('status').innerHTML = 'Please log ' +'into Facebook.';

    }

  }

  function checkLoginState() {

    FB.getLoginStatus(function(response) {

      statusChangeCallback(response);

    });

  }

  function fblogout()

  {

	  FB.logout(function(response) {

       document.getElementById('status').innerHTML ='Facebook Logout Successfully, ' + JSON.stringify(response)+ '!';

});

  }

  window.fbAsyncInit = function() {

  FB.init({

    appId      : '956901964355604',

    cookie     : true,  // enable cookies to allow the server to access 

    xfbml      : true,  // parse social plugins on this page

    version    : 'v2.2' // use version 2.2

  });

  FB.getLoginStatus(function(response) {

    statusChangeCallback(response);

  });

  };

  (function(d, s, id) {

    var js, fjs = d.getElementsByTagName(s)[0];

    if (d.getElementById(id)) return;

    js = d.createElement(s); js.id = id;

    js.src = "//connect.facebook.net/en_US/sdk.js";

    fjs.parentNode.insertBefore(js, fjs);

  }(document, 'script', 'facebook-jssdk'));

  function testAPI() {

    //console.log('Welcome!  Fetching your information.... ');

    FB.api('/me', function(response) {

   // console.log('Successful login for: ' + response.name);

	window.location='fb.php?res='+JSON.stringify(response);

    //document.getElementById('status').innerHTML ='Thanks for logging in, ' + JSON.stringify(response) + '!';



    });



  }



</script>
<?php */?>
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

                    var y = document.forms["register"]["email"].value;

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

                    var x = document.forms["register"]["mobile_number"].value;

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
       <style type="text/css"> 

           .signup_content {
    margin: 0px auto;
    max-width: 315px;
    width: 100%;
     }
                    #login_blocknew{ color:#fff;}

                    #login_blocknew div{ float:left; width:200px; margin-right:20px!important;}

                    #login_blocknew p{ float:left; width:100%;  padding:0; margin:5px 0 0 0;}

                    #login_blocknew p .inputnewsn{ width:200px!important; height:30px; float:left; margin: 0 !important; padding: 0 !important;}

                    .forgotpasswordSN{float:right;   margin:5px 10px 30px 0;   padding:0; }

                    .forgotpasswordSN a{ color:#AF1910;  font-weight:bold; font-size:14px; position:relative; }

                    .forgotpasswordSN a:hover{ color:#F09508; text-decoration:underline; cursor:pointer;}

                    .forfotpassworddivshow{ border: 3px solid #C55039; background:#fff;  border-radius: 20px 20px 20px 20px;}



                    .closeNEWSN{ float:right;  margin:20px 0; background:#AF1910; color:#fff!important; font-weight:bold; font-size:16px; padding:10px 20px; display:block;}



                    .about_us_content_boxsan p{ color:#ED9809; font-weight:bold; font-size:17px; line-height:30px;background:url(../images/right.png) no-repeat left!important; padding-left:40px;}

                    .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year{ width:39%!important;}

                    .header{ background:none!important;}

                    .newusernew {
    height: auto;
    width: 315px;
	margin-top: 10px;
}
                    .formnew{ color:#333; font-size:14px; font-weight:bold; height:40px;}

                    .formnew input{ padding:10px; border:1px solid #999!important; border-radius: 3px;}

                    .formnew select{ padding:10px; border:1px solid #999!important; margin:0!important;}

                    .bigheadingnewblack{ color:#E24648; font-size:24px; margin-bottom:20px;}

                    .formnewaddress{ width:315px; padding:5px 0;  float:left; line-height:40px;}

                    .formnewaddress select{ margin-top:0px!important; }

                    .formnewpass{width:315px; float:left; line-height:40px; margin-bottom:10px; padding: 0;}

                    .formnewpass input{ width:141px !important; float:right !important; border-radius: 3px; margin:6px 0!important; padding:10px!important; }

                    .formnewname, .formnewemail, .formnewdateofbirth, .formnewmobile, .formnewsubmitagree{ width:100%; display:inline-block!important; margin:5px 0;}

                    .formnewsubmitagree input[type=checkbox] { border:none!important; height:10px; }

                    .formnewsubmitagree a{ text-decoration:none; color:#AF1910;}

                    .formnewdateofbirth input {

                        border: 1px solid #CCCCCC;

                        border-radius: 3px;

                       /* box-shadow: 0 0 5px #DDDDDD inset;*/

                        float: right !important;

                        /*margin-right: 8px;*/

                        padding: 10px !important;

                        width: 141px !important;

                    }

                    .formnewname input{ float:right!important;  width:141px!important; padding:10px!important; border-radius: 3px;}

                    .formnewemail input{ float:right!important;  width:141px!important; padding:10px!important; border-radius: 3px;}

                    .formnewname select{ float:none!important; width:63px!important; margin:0 10px!important; padding:9px;}

                    .formnewmobile input{ float:right!important;  width:141px!important; padding:10px!important;}



                    #ui-datepicker-div{ background:#AA320D!important; color:#fff!important; margin-left: -30px !important;}

                    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{ color:#fff;}

                    .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight{color: #363636 !important;}



              </style>
      </head>
<body>  

    <?php include "header.php"; ?>

                    <div class="wrapper">  

                            <div class="signup_content"> 

                            <p align="center" style="color:#FF0000; padding:2%; font-size:large;"><?php echo $msg?></p>

                           

                            <div class="newusernew">

                            <div class="bigheadingnewblack">New User ? </div>

                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="aff_register" name="aff_register">

                                        

                                        <div class="inputtext ac_det"><?php echo $error_var1; ?></div>

                                        

                                      <?php /*?>   <div class="formnewname formnew" style="display:none !important;">

                                          <?php 

if(isset($_REQUEST['code'])){

        $gClient->authenticate(); 

	$_SESSION['token'] = $gClient->getAccessToken();

	header('Location:'.filter_var($redirect_url, FILTER_SANITIZE_URL));
}
if (isset($_SESSION['token'])) {

	$gClient->setAccessToken($_SESSION['token']);
}
if ($gClient->getAccessToken()) {

	$userProfile = $google_oauthV2->userinfo->get();

	//echo "<pre>"; print_r($userProfile);



	$gUser = new Users();

	$ret_data = $gUser->checkUser('google',$userProfile['id'],$userProfile['given_name'],$userProfile['family_name'],$userProfile['email'],$userProfile['gender'],$userProfile['locale'],$userProfile['link'],$userProfile['picture']);

	$_SESSION['google_data'] = $userProfile;

	$_SESSION['user']['user_id']=$ret_data['id'];

    $_SESSION['user']['first_name']=$ret_data['first_name'];

    $_SESSION['user']['mobile_number']=$ret_data['mobile_number'];

    $_SESSION['user']['balance']=$ret_data['balance'];

    $_SESSION['user']['email_id']=$ret_data['email_id'];

	header("location:https://Urbus.com/homepage.php");

	$_SESSION['token'] = $gClient->getAccessToken();
} 
else { $authUrl = $gClient->createAuthUrl(); }
if(isset($authUrl)) {

	echo '<a href="'.$authUrl.'"><img src="google/images/glogin.png" width="" alt=""/></a>';
} 
else { echo '<a href="logout.php?logout">Logout</a>'; }

?>
<?php */?>


<!--

  Below we include the Login Button social plugin. This button uses

  the JavaScript SDK to present a graphical Login button that triggers

  the FB.login() function when clicked.

-->

<?php /*?><div class="fb-login-button" data-max-rows="2" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true"></div>

<fb:logout-button scope="public_profile,email" onlogout="fblogout();">

</fb:logout-button>

<!--<a href="javascript:void(0);" onClick="fblogout();" >Fb Logout</a>-->

<div id="status"></div>
 </div><?php */?>

                                        <div class="formnewname formnew">

                                            Name : <span style="color:#f00;">*</span>

                                            <input name="first_name" type="text" class="required" onClick="removestyle('fname')" id="fname"  title="First Name"  value="" onkeyup="return lettersOnly();"/>

                                        </div>

                                        <div style="clear:both"></div>

                                        <div class="formnewemail formnew">

                                            Email-Id : <span style="color:#f00;">*</span>

                                            <input name="email" type="text" onClick="removestyle('email')" onBlur="email_checking(this.value);" onchange="return email_checking(this.value), validateEmail(this);" id="email"  class="email" style=" margin-left:13px!important;" title="Email-id" value=""/> <div id="mail_error" style="color: red; font-size: 13px;"> </div>
                                            <div id="mail_success" style="color: blue; font-size: 13px;"> </div>

                                        </div>
                                        
                                        <div style="clear:both"></div>

                                        <div class="formnewemail formnew">

                                            Website : <span style="color:#f00;">*</span>

                                            <input name="website" type="text"   class="email" style=" margin-left:13px!important;" title="website" value="" required="required"/> <div id="mail_error" style="color: red; font-size: 13px;"> </div>
                                            <div id="mail_success" style="color: blue; font-size: 13px;"> </div>

                                        </div>
                                        <div style="clear:both"></div>

                                        <div class="formnewpassword formnew formnewpass"> 

                                            Password : <span style="color:#f00;">*</span>

                                            <input type="password" name="password" onClick="removestyle('password')" id="password" class="required"  rule="match: Password"  title="Password"/>

                                        </div>

                                        <div class="formnewconfirm formnew formnewpass">

                                            Confirm Password : <span style="color:#f00;">*</span>

                                            <input name="Cpassword" type="password" onClick="removestyle('Cpassword')" id="Cpassword"  class="required" rule="match: Password" title="Password" />

                                        </div>

                                        <div style="clear:both"></div>

                                        <div class="formnewdateofbirth formnew">


                                            Age

                                            <input type="text" name="age" id="age" class="required" title="Age" />

                                        </div>

                                        <div style="clear:both"></div>

                                        <div class="formnewmobile formnew">

                                            Mobile Number :<span style="color:#f00;">*</span>

                                            <input name="mobile_number"   type="text" onClick="removestyle('mobile_number')" id="mobile_number"  class="required" title="Mobile Number" value="" onBlur="mobile_checking(this.value)" maxlength="10" />
                                            <div id="mobile_error" style="color: red; font-size: 13px;"> </div>
                                            <div id="mobile_success" style="color: blue; font-size: 13px;"> </div>
                                            

                                        </div>

                                        <div class="formnewsubmitagree formnew">

                                            <input type="submit" value="Register" style="width: 110px; text-align: center; float:right; margin-right:8px; margin-left: 10px; margin-top:5px; background-color: #E24648; border: 0 !important; border-radius: 4px;" id="bus_booking1" name="confirm_book_btn" class="btn2 btn_blue w120" onClick="return validateform()"/>

                                            <input type="hidden" value="" name="refer_id" />



                                        </div>

                                    </form>

                                    <div style="clear:both"></div>    

                                </div>                                

                     	</div>

                            <div style="clear:both"></div>

                    </div>

            <?php include 'footer.php'; ?>
   </body>
</html>