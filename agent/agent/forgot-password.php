<?php 
include_once'../server/server.php'; 

include_once 'includes/functions.php';
$obj=new agent_module($con); 
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once 'includes/head.php'; ?>
<?php
if(isset($_POST) & !empty($_POST)){
	$email = mysql_real_escape_string($_POST['username']);
	
	$forgotpassword = $obj->forgotpassword(array($email,'yes'));	
	
	if($forgotpassword!=0){

		
		$to = $email;
 	    $subject = 'Your Recovery Password' ;
		
 		$body =  '<div style="	padding-right: 15px; padding-left: 15px; width: 50%; border: 1px solid black; margin: auto; height:300px;">
<img src="" alt="hearder logo" width="624" height="40" />
<h1 style="text-align:center;"> Forgot Password </h1>
<p> Username : '.$forgotpassword[0]['agent_name'].'</p>
<p> Email : '.$forgotpassword[0]['email'].'</p>
<p> password : '.$forgotpassword[0]['agency_pass'].'</p>
</div>';
    $headers = 'From: urbus.in' . "\r\n" ;
    $headers .='Reply-To: '. $to . "\r\n" ;
    $headers .='X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";   
	//echo $body;
if(mail($to, $subject, $body,$headers)) {
  echo("<script>alert('Email Sent'); </script>");
  } 
  else 
  {
  echo("<script>alert('Email Message Delivery Failed...'); </script>");
  }
	}else{
		echo "<script>alert('User name does not exist in database'); </script>";
	}
}
?>
</head>
<body id="login">
<!-- <div class="container form-signin">
<img src="images/offer.png" width="600" height="338" alt="Latest Offer Cash Deposti Get 2 % Extra Added In Your Urbus Account"> </div> -->
<br>

<div class="container">
      <form class="form-signin" id="login_form" name="login_form" action="" method="post" autocomplete="off">
        <h3 class="form-signin-heading" style="text-align:center;"><img src="<?php echo $base_url; ?>images/meebus.png" width="150" style="background: #fff;border-radius: 5px;"></h3>
        <br clear="all">
        <!--<input type="text" onkeydown="return disableCtrlKeyCombination(event);" onkeypress="return disableCtrlKeyCombination(event);" onpaste="return false" oncopy="return false" autocomplete="off" onfocus="getFocus(this.id);" maxlength="30" size="30" tabindex="12" id="username" name="userName">-->
        <input type="text" class="input-block-level" placeholder="Email" id="username" name="username" value="" required>
        
   
        <h6 style="text-align:center; color:#F00; font-weight:bold;"></h6> 
        <br clear="all">
       

        <input class="btn btn-large btn-primary" type="submit" id="Submit" name="Submit" value="Submit" style="margin-left:100px;">
      </form>
    </div> <!-- /container -->
  </body>
</html>
