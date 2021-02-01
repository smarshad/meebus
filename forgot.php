<?php 
include_once("header.php"); 
if(isset($_POST['submit']) && $_POST['submit']='Send')
{
	$email=$_POST['email'];
	$checkmail=$obj->getmailuser(array($email));
	$checkmail=$checkmail[0];
	if($checkmail!=0) {
		
	$ticket_html='<div style="background:#f2f2f2;margin:0 auto;max-width:640px;padding:0 20px">

               <div style="width:100%;margin:auto;padding:5px 0 0px 0"><img src="'.$base_url.'images/buslogo.png" style="float:left;margin:20px 0 20px 0" alt=""  width="150" ></div>
               <div style="background:#fff;color:#5b5b5b;border-radius:4px;font-family:Calibri,Arial,sans-serif;font-size:16px;padding:10px 20px;width:90%;margin:30px auto;line-height:17px;border:1px #ddd solid;border-top:0;clear:both">
                  <p>Hi there!</p>
                  <p> We have received a request to reset your meebus account password.</p>
                  <a href="'.$base_url.'password.php?id='.$checkmail['unique_id'].'"><p Style="color:#E31E25">meebus.com</p></a>
                  <p>Meebus Team.</p>
               </div>
               
               <p style="font-family:Calibri,Arial,sans-serif;font-size:15px"><span style="font-weight:bold">24X7</span> Customer Care <span>+91 75200 75200</span></p>
               
               <p style="font-family:Calibri,Arial,sans-serif;font-size:14px; padding-bottom: 16px;"> We would love to hear from you. <br>Just write to us at <a href="mailto:support@meebus.com" style="color:#000;font-weight:bold;text-decoration:none" target="_blank">support@meebus.com.</a></p>
</div>';
$subject = "Request a Password";
$description="Request Password";
$fromMailid="support@meebus.com";
$user_id=$checkmail['id'];
$data=array($user_id,$fromMailid,$email,$subject,$ticket_html,$description,1);
$maildata=$obj->insertMail($data);
if($maildata==1)
{
	$_SESSION['pass']['err']=$msg="Your Password will send shortly";
}
	}
	else
	{
		$_SESSION['pass']['err']=$msg="User does not exist";
	}
}
?>
<style type="text/css">
	table {
		padding: 0;
		font-size: 13px;
	}
	

#formContent a {
  color: #000;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

#formContent h2.headings {
  text-align: center;
  font-size: 20px;
  font-weight: 600;
  text-transform: uppercase;
  display:block;
  padding: 20px 8px 10px 8px; 
  color: #000;
 
}



/* STRUCTURE */

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #EFEEEE;
  padding: 0;
  width: 90%;
  max-width: 450px;
  position: relative;
  margin:0px aoto;
  /*-webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);*/
  text-align: center;
}

#formFooter {
  background-color: #EFEEEE;
  border-top: 1px solid #fff;
  padding: 34px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}
/* FORM TYPOGRAPHY*/
input[type=button], input[type=submit], input[type=reset]  {
  background-color: #E72E33;
  border: none;
  color: white;
  padding: 10px 59px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 15px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  transition: all 0.3s ease-in-out;
}
input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #E72E33;
}
input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}
input[type=text], input[type=password] {
  background-color: #fff;
  border: none;
  color: #0d0d0d;
  padding: 9px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}
input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}
input[type=text]:placeholder {
  color: #cccccc;
}
#formFooter a.log{
	float:left;
}
#formFooter a.sign{
	float:right;
}

</style>

<div class="inner-content">
<?php if(isset($_SESSION['pass']['err'])) echo "<p align='center' style='font-weight:bold; color:#D74F57;'>".$_SESSION['pass']['err']."</p>"; unset($_SESSION['pass']['err']); ?>
<div id="formContent">
   
   <h2 class="headings">Forgot Password</h2>
  
   <form name="frm_search" id="frm_search" action="" method="POST">
      <input type="text" name="email" id="login_email" class="textbox_login fadeIn second" placeholder="Email Id"> 
     
      <input type="submit" name="submit" id="submit" value="Send" style="display: block;margin: 20px auto;" />
   </form>
   <!-- Remind Passowrd -->
   <div id="formFooter">
      <a class="log" href="login.php">Login</a>
       <a class="sign" href="register.php">Sign Up?</a>
  
</div>
</div>
<script>
$("#submit").click(function ()
{
	var email=$("#login_email").val();
	if(email=='')
	{
		alert("Please Enter Email Address");
		return false;
	}
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if (reg.test(email) == false && email!='') 
	{
			alert("Invalid Email Address");
			$("#email").val('');
			return false;
			
	}
	
	$( "#frm_search" ).submit();
});
</script>
<?php include_once("includes/footer.php"); ?> 