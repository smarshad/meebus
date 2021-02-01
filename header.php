<?php
session_start();
 include_once "server/server.php";
 GLOBAL $conn;
// include "includes/pdo_functions.php";

$_SESSION['user']['common']['url']		=	'https://meebus.com/';
$_SESSION['user']['common']['title']	=	'Meebus';

if(isset($_SESSION['user']['common']['url'])){
    $base_url=$_SESSION['user']['common']['url'];
    if(isset($_SESSION['user']['log']['id'])){
        // echo 'inside header';exit();
        $userid = $_SESSION['user']['log']['id'];
        $sel    = "SELECT * FROM `user_login` WHERE `id` = '$userid'";
        $query  = $conn->query($sel);
        if($query == true){
            while($row = $query->fetch_assoc()){
                $_SESSION['user']['log']['balance'] = $row['balance'];
                $_SESSION['user']['log']['first_name'] = $row['first_name'];
                $_SESSION['user']['log']['last_name'] = $row['last_name'];
                $_SESSION['user']['log']['email_id'] = $row['email_id'];
                $_SESSION['user']['log']['mobile_number'] = $row['mobile_number'];
                $_SESSION['user']['log']['address'] = $row['address'];
                $_SESSION['user']['log']['pin_code'] = $row['pin_code'];
                $conn->close();
            }
        }else{
            echo "failed";
            echo "Error: ".$conn->connect_error;
        }
    }
    // elseif(!isset($_SESSION['user']['log']['id'])){
    //      echo 'logout';exit();
    //     header('location:logout.php');
    // }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>meeBus</title>		
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $base_url;?>images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"> 
    <link type="text/css" href="css/style.css" rel="stylesheet" />		
    <link type="text/css" href="css/jquery.ui.theme.css" rel="stylesheet" />
    <link type="text/css" href="css/jquery.ui.core.css" rel="stylesheet" />
    <link type="text/css" href="css/jquery.ui.datepicker.css" rel="stylesheet" />
    <link type="text/css" href="css/coachget.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link type="text/css" href="css/font-awesome.css" rel="stylesheet" />
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/jquery-ui.js"></script> 
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.8.3.js"></script>
    <!-- Code Ends Here -->
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
	<body topmargin="0" leftmargin="0" rightmargin="0" bgcolor="#CCCCCC">
    <div id="header">
   
    <div class="logohead cf">
    <div class="XXXBMargin">
     <a href="javascript:void(0);" class="menu-toggle"><span class="lines"></span></a>
        <a class="loma" href="index.php"><img src="images/buslogo.png" alt="logo"></a>
        <a class="loma1" href="index.php"><img alt="logo" src="images/meebus.png"></a>
    </div>
    <div id="menutop">
        <ul id="nav">
            <li class="account hms"><a href="#"><span class="icon-location location_pin"></span> Location <i class="fa fa-angle-down"></i> </a></li>
            <li class="account hms meehm"><a href="#">MeeBus Support<i class="fa fa-angle-down"></i></a>
                <ul class="child">
                    <li><a href="#">Write to us</a></li>
                    <li><a href="#">Call us at</a></li>
                </ul>
            </li>
			
            <li class="account hms meehm"><a href="#">Manage Booking<i class="fa fa-angle-down"></i></a>
                <ul class="child">
                	<li><a href="index.php">Home</a></li>
                    <li><a href="printticket.php">Print/Download</a></li>
                      <li><a href="email_sms.php">Email/SMS</a></li>
                        <li><a href="cancel_ticket.php">Cancellation</a></li>
                       

                </ul>
             </li>
			<?php if(isset($_SESSION['user']['log']['id']) && $_SESSION['user']['log']['id']!='') { ?>
                <li class="account hms">
                    <a class="logim" href="javascript:void(0);" style="margin-top:6px">
                        <i class="fa fa-user" aria-hidden="true"></i> <span>Welcome <?php 
echo $_SESSION['user']['log']['first_name']; ?></span> 
						                    </a>
                       <a class="log1im" href="javascript:void(0);" style="margin-top:6px">
                        <img src="<?php echo $base_url;?>images/login-img1.png" style=" width: 30px; margin-left: 10px"> <span style="color:#fff;">Welcome <?php 
echo $_SESSION['user']['log']['first_name']; ?></span> <i class="fa fa-angle-down" style="color:#fff;"></i>
						                    </a>
                    
                    <ul class="child">
                   		 <li><a href="javascript:void(0);">Balance 
							<i class="fa fa-inr" aria-hidden="true"></i><span>
							<?php 
				print_r($_SESSION['user']['log']['balance']); 
							?>
							</span></a></li>
                          <li><a href="profile.php">My Profile</a></li>
                          <li><a href="addwallet.php">Add Wallet</a></li>
                          <li><a href="mytrips.php">My Trips</a></li>
                          <li><a href="usr_canceltickets.php">My Cancelled Tickets</a></li>
                          <li><a href="change_password.php">Change Password</a></li>
                          <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
			<?php } if(!isset($_SESSION['user']['log']['id'])) { ?>
                <li class="account hms">
                    <a class="logim" href="#" style="margin: 7px 0 0;">
                    <i class="fa fa-user" aria-hidden="true"></i>
                      
                    </a>
                    <a class="log1im" href="#" style="margin: 7px 0 0;">
                    <img src="<?php echo $base_url;?>images/login-img1.png" style=" width: 30px; margin-left: 10px"> 
                    <i class="fa fa-angle-down" style="color:#fff;"></i> </a>
                    
                    <ul class="child signss">
                        <li class="signin bo-lef"><button type="button" data-toggle="modal" data-target="#signinup">Sign In/Sign Up</button></li>
                        
                    </ul>
                </li>
			<?php } ?>
        </ul>
    </div>
   
    <div class="mobileHide topmenuRight">
				<ul id="tcktmenu" class="topmenu">
                	   <li><a href="<?php echo $base_url;?>index.php">Home</a></li>
                    <li><a href="<?php echo $base_url;?>printticket.php">Print/Download</a></li>
                      <li><a href="<?php echo $base_url;?>email_sms.php">Email/SMS</a></li>
                        <li><a href="<?php echo $base_url;?>cancel_ticket.php">Cancellation</a></li>
                  
                                           
			   </ul>
		</div>
</div>
    <!-- header end here -->

</div>
<div class="modal fade" id="signinup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	<div class="modal-main-body">
      <div class="modal-header">
	  <img src="images/sign-logo.png">
        <h5 class="modal-title" id="exampleModalLongTitle">SIGN IN / SIGN UP</h5>
       
      </div>
      <div class="modal-body overflow-hidden">
	  <div class="signin-signup-container row">
	  <div class="col-sm-6">
        <form name="frm_search" id="signin_form" action="" method="POST"> 
                        <input type="text" name="txt_email" id="login_email" class="textbox_login fadeIn second" placeholder="Enter email id">     
                        <input type="password" name="txt_pwd" id="txt_pwd" class="textbox_login fadeIn third" placeholder="Enter password">  
                        <input type="submit" name="signin_button" id="loginSubmit" value="Submit" style="display: block;margin: 20px auto;" /> 
                                </form>
								 <a href="forgot.php">Forgot Password?</a>
       <a href="javascript:void(0);" class="signup-button">SIGN UP</a>
</div>
<div class="col-sm-6">
 <form name="frm_search" id="frm_search" action="register_form.php" method="post">  
                        <input type="text" name="fname" id="fname" class="textbox_login fadeIn second" placeholder="Enter First name"> 
                        <input type="text" name="lname" id="lname" class="textbox_login fadeIn second" placeholder="Enter Last Name"> 
                        <input type="text" name="email" id="email" class="textbox_login fadeIn second" placeholder="Enter E-mail"> 
                        <input type="password" name="password" id="txtpwd1" class="textbox_login fadeIn third" placeholder="Enter Password"> 
                        <input type="text" name="mobile" id="txtmobile" class="textbox_login fadeIn third" placeholder="Enter Mobile Number"> 
                        <input type="submit" name="Submit" id="signup_submit" value="Register" style="display: block;margin: 20px auto;" /> 
                        </form>  
						
       <a href="javascript:void(0);" class="signin-button">SIGN IN</a>
</div>	
</div>							
								 <div class="modal-footer">
      
      </div>
	  
      </div>
	  </div>
	   <div class="login-form-img">  
			<p>Welcome To Meebus</p>
                <img src="images/users.jpg" id="icon" alt="User Icon"> 
            </div>
     
    </div>
  </div>
</div>

    <script>
        $("#loginSubmit").click(function (){
            var email=$("#login_email").val();	
            var pass=$("#txt_pwd").val();
            if(email=='')
            {		
            alert("Please Enter Email Address");
            return false;
        }	
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(email) == false && email!='') 	{
            alert("Invalid Email Address");	
            $("#email").val('');	
            return false;	
        }	
        if(pass=='')	{
            alert("Please Enter Password");
            return false;	
        }	$( "#signin_form" ).submit();
    });
    $( "#signup_submit" ).click(function() {
        var f_name=$("#fname").val();
        var l_name=$("#lname").val();
        var pass=$("#txtpwd1").val();	
        if(f_name=='')	{
            alert("Please Enter Your Name");    
            return false;	
        }	
        if(l_name=='')	{
            alert("Please Enter Your Last Name");   
            return false;	
        }	
        var email=$("#email").val();
        if(email=='')	{
            alert("Please Enter Email Address");
            return false;	
        }  	
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(email) == false && email!='') 	{	
            alert("Invalid Email Address");
            $("#email").val('');	
            return false;	
        }	
        if(pass=='')	{
            alert("Please Enter Password");	
            return false;
        }  	
        var mobile=$("#txtmobile").val();  
        if(mobile.length!=10 || mobile.length==0)  	{
            alert("please Enter Valid Mobile Number");
            return false;  
        }	if(mobile=='')	{
            alert("please Enter Mobile Number");
            return false;
        }  
        $( "#register" ).submit();
    });</script>
<script>
$(".menu-toggle").on('click',function() {
					$('.topmenuRight').toggleClass('open');
                                        
					$(this).toggleClass("menu-toggle--open");
				});	
                                
            $(function(){
$('.signup-button').click(function(){
$('.signin-signup-container').addClass('active');
});
$('.signin-button').click(function(){
$('.signin-signup-container').removeClass('active');
});
});
              
</script>
<script>
    var table = $('table');
    
    $('#bus_type_header, #depature_header, #arrival_header, #duration_header')
        .wrapInner('<span title="sort this column"/>')
        .each(function(){
            
            var th = $(this),
                thIndex = th.index(),
                inverse = false;
            
            th.click(function(){
                
                table.find('td').filter(function(){
                    
                    return $(this).index() === thIndex;
                    
                }).sortElements(function(a, b){
                    
                    return $.text([a]) > $.text([b]) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;
                    
                }, function(){
                    
                    // parentNode is the element we want to move
                    return this.parentNode; 
                    
                });
                
                inverse = !inverse;
                    
            });
                
        });

</script>
<div id="container" class="cf">
	<div class="wrap1" class="cf">