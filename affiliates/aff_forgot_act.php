<?php
error_reporting(0);
include_once 'database/connect.php';
  
   
 $email_id = mysql_real_escape_string(strip_tags($_POST['email']));  
 $password = mysql_real_escape_string(strip_tags($_POST['password']));   

 $sql="SELECT * FROM aff_login WHERE email='$email_id'";

 $rows=mysql_query($sql);

 $count=mysql_num_rows($rows);	
    
    if($count===1){	    
	
	$fetch = mysql_fetch_object($rows);
     $password = $fetch->password;	
    
   
     $to=$email_id; 
  
     $subject="Your password here"; 
     $headers = "MIME-Version: 1.0"."\r\n";
	 $headers.= "Content-type: text/html; charset=iso-8859-1"."\r\n";
  	 $headers.= "From:Urbus.com \r\n";
     $messages.='<div id="mailcontainer" style="width: 700px;
		margin: 0px auto;
		color: #999;
		border: 1px solid #ffa024;
		border-radius: 5px;
		font-family:Verdana, Geneva, sans-serif;
		font-size: 14px;">
    <div id="mailheader">
    <a href="#"><img alt="urbus" src="http://Urbus.com/images/logo.png" class="logo"  style="padding:10px 0px 10px 20px; float:left"></a>
    <p class="phone"  style="padding:35px 30px 0px 0px; float:right;"> <i class="icon ico_tel"></i>+91- 86953&nbsp;63636</p>
    
    </div>
    <br clear="all" />
    <div id="mailnav" style="background: #155E8D;
		color: #fff;
		padding: 10px 20px 0;">
    <p  style="margin:0;
		padding: 0 0 15px 0;">Greetings from urbus - Forgot Your Password</p>
	</div>
    <div id="mailcontent" style="background: #fff;
		padding: 10px 20px 0;">
    
    
    <p  style="margin:0;
		padding: 0 0 15px 0;"><b>Dear Customer</b></p>
    <p  style="margin:0;
		padding: 0 0 15px 0;">Many thanks for your Interest and Submitting Online Forgot Password using <a target="_blank" style="color:#000;" href="http://www.Urbus.com">www.Urbus.com</a></p>
 
<p style="margin:0;
		padding: 0 0 15px 0;">Your Current Password Is : '.$password.'</p>

<p style="margin:0;
		padding: 0 0 15px 0;">Please do not hesitate to contact us on <a target="_blank" href="mailto:info@Urbus.com">info@Urbus.com</a> for all your Urgent Queries / Reservation or Requirements. </p>
	</div>
    <div id="mailfooter" style="background: #ffa024;
		padding: 10px 10px 0;
		text-align: center;
		color: #fff;">
   		<p  style="margin:0;
		padding: 0 0 15px 0;"class="footer">&copy; 2016, urbus.com. . Mobile No :+91- 86953&nbsp;63636 </p>
    </div>
</div>';
     $sentmail = mail($to,$subject,$messages,$headers); 	
   header("location:aff_sign_in.php?msg='Your Password is send to Your mail'");       
  }    
    else {
      header("location:aff_sign_in.php?msg='Cannot send password to your e-mail address.'");
    }       
    ?>