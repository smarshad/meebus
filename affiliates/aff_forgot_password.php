<?php
ob_start();
@session_start();

include_once 'database/connect.php';?>
<!doctype html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Forgot Password</title>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->	
	<style>
              @charset "utf-8";@import url(http://weloveiconfonts.com/api/?family=fontawesome);@import url(http://meyerweb.com/eric/tools/css/reset/reset.css);[class*="fontawesome-"]:before{font-family: 'FontAwesome', sans-serif}body{color: #000;font-family: "Varela Round", Arial, Helvetica, sans-serif;font-size: 16px;line-height: 1.5em}input{border: none;font-family: inherit;font-size: inherit;font-weight: inherit;line-height: inherit;-webkit-appearance: none}#login{margin: 50px auto;width: 400px; border: 1px solid #ccc; border-radius: 10px;}#login h2{color: #0694B6;font-size: 20px;padding: 20px 26px 10px; text-transform: uppercase; text-align: center; font-weight: bold;}#login h2 span[class*="fontawesome-"]{margin-right: 14px}#login fieldset{padding: 10px 26px 25px;}#login fieldset p{color: #999;margin-bottom: 14px; font-size: 14px; font-weight: bold; }#login fieldset p:last-child{margin-bottom: 0}#login fieldset input{-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px}#login fieldset input[type="email"], #login fieldset input[type="password"]{color: #777;padding: 8px 10px;width: 328px; border: 1px solid #999;}#login fieldset input[type="submit"]{background-color: #0694B6;color: #fff;display: block;margin: 0 auto;padding: 4px 0;width: 100px}#login fieldset input[type="submit"]:hover{background-color: #FFAA60}
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
                        url:'aff_ajaxSignIn.php?uname='+email+'&upass='+password,
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
	<div id="login">
		<h2>Forgot Password</h2>
		<form action="forgot_act.php"  method="POST">
			<fieldset>
				<p><label for="email">E-mail address</label></p>
				
                <p><input type="email" id="email" name="email" value="" onBlur="if(this.value=='')this.value='mail@address.com'" onFocus="if(this.value=='mail@address.com')this.value=''"></p> 
				

				<p style="float:left;"><input type="submit" name="submit" value="Submit"  /></p>
                
			</fieldset>
		</form>
	</div> <!-- end login -->
     <?php include 'footer.php'; ?>
</body>	
</html>
