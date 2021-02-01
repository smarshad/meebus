<?php
ob_start();
@session_start();
//include_once("google/config.php");
include_once 'database/connect.php';
//include_once("google/includes/functions.php");

?>

<!doctype html>

<html lang="en-US">

<head>

	<meta charset="utf-8">

	<title>Login</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="css/signin.css">

	<!--[if lt IE 9]>

		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->	

	<style>

       </style>

    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>

    <script>

       $(document).ready(function(){

              $('#btnSignin').click(function(){

                  var email=$('#email').val();

                  var password=$('#password').val();

                  if(($('#email').val()=='mail@address.com') || ($('#email').val()=='')){

                     alert('Please enter the email id');

                     return false;

                  }

                  if(($('#password').val()=='password') || ($('#password').val()=='')){

                     alert('Please enter the password');

                     return false;

                  } else {

                     $.ajax({

                        url:'ajaxSignIn.php?uname='+email+'&upass='+password,

                        type:'GET',

                        success:function(retVal){

                        //alert(retVal);                         

                            if(retVal=='SUCCESS'){

                                   //window.top.location.href = "my_account.php"; 

                                   window.top.location.reload();

                            } else {

                                   alert('Please check the username and password.');

                                   return false;

                            }

                        }

                     });                  

                  }           

              });

       });

       </script>

</head>

<body>
         
<?php include "header.php"; ?>
<div id="login-col" class="cf">

	<div id="login">
   <?php /*?> <div class="fb-login-button" data-max-rows="2" style="float: left;" data-size="large" data-show-faces="false" data-auto-logout-link="true"></div>

<fb:logout-button scope="public_profile,email" onlogout="fblogout();">

</fb:logout-button>

<!--<a href="javascript:void(0);" onClick="fblogout();" >Fb Logout</a>-->

<div id="status"></div>
		
        		<p class="signd" style="float:right; margin-right: 119px; color: rgb(255, 255, 255);  padding-top: 9px;">
                <span style="margin-top:5px; padding-top:9px;"> <?php 

if(isset($_REQUEST['code'])){

        $gClient->authenticate(); 

	$_SESSION['token'] = $gClient->getAccessToken();

	header('location:'.filter_var($redirect_url, FILTER_SANITIZE_URL));
 }
if (isset($_SESSION['token'])) { $gClient->setAccessToken($_SESSION['token']); }
if ($gClient->getAccessToken()) { $userProfile = $google_oauthV2->userinfo->get(); 
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
else {

	$authUrl = $gClient->createAuthUrl();
 }
if(isset($authUrl)) {

	echo '<a href="'.$authUrl.'"><img src="img/g.png" style="margin-top:-8px; margin-right:2px;"></a>';
 } 
else { 

	echo '<a href="logout.php?logout">Logout</a>';
 }
?>
</span>
</p><?php */?>
<style>.input-group-addon{float:left;padding:8px 12px;}</style>
        
        
								<?php /*	<hr style="border: 0; border-bottom: 1px dashed #ccc; background: #999; margin-top:65px; width:263px;"> */?>
                                    <div id="social-link"><em>Affiliate Login</em></div>
									
								
		<form action="aff_checklogin.php"  method="POST">
			<fieldset>
				
                <p><span class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="email" required placeholder="Enter email" id="email_id" name="email_id" value="" onBlur="if(this.value=='')this.value='mail@address.com'" style="border-radius: 0px;" onFocus="if(this.value=='mail@address.com')this.value=''"></p> 
				
				<p><span class="input-group-addon"><i class="fa fa-lock" style="width: 14px;"></i></span><input type="password" placeholder="password" style="border-radius: 0px;" id="password" name="password" value="password" required onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''"></p>
				<p style="margin-bottom: 5px;"><input type="submit" name="submit" value="Sign In"  /></p>
                
                <?php if(isset($_GET['msg']) && $_GET['msg']!='') { ?>
                <p style="margin-bottom: 5px;"><?php echo $_GET['msg']; ?></p>
                <?php } ?>
                
                
				<p class="newu"><a href="aff_register.php" style="color:#000 !important;">Register</a></p>
                <p class="newus"><a href="aff_forgot_password.php" style="color:#000 !important;">Forgot Password?</a></p>
			</fieldset>
		</form>
	</div> <!-- end login -->
   <script>

(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=416130075106867";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>

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

<!--

  Below we include the Login Button social plugin. This button uses

  the JavaScript SDK to present a graphical Login button that triggers

  the FB.login() function when clicked.

--> 
    
</div>


     <?php include 'footer.php'; ?>

</body>	

</html>

