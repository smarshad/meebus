<?php 


include 'server/server.php';
include 'includes/pdo_functions.php';
$obj=new user_module($con);

// include_once("header.php"); 

if(isset($_SESSION['user']['log']['id']) > 0){
    
    header('location: index.php');
    
}



if(isset($_POST['login']) && $_POST['login'] == 'Login'){
    
    
    
    $stmt = "SELECT * FROM `user_login`";
    $query = mysqli_query($conn, $stmt);
    

    while($result = mysqli_fetch_assoc($query)){
        
        if($_POST['txt_email'] == $result['email_id'] && $_POST['txt_pwd'] == $result['password']){
            
         $_SESSION['user']['log']['id']=$result['id'];
		$_SESSION['user']['log']['firstName']=$result['first_name'];
		$_SESSION['user']['log']['balance']=$result['balance']; 		
		header('location:index.php');

        }

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
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  
  /*-webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);*/
  text-align: center;
}

#formFooter {
  background-color: #EFEEEE;
  border-top: 1px solid #fff;
  padding: 25px;
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
  padding: 15px 32px;
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
/* ANIMATIONS */
/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}
@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}
@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}
/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;
  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}
.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}
.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}
.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}
.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}
/* OTHERS */
*:focus {
    outline: none;
} 
#icon {
  width:60%;
}
* {
  box-sizing: border-box;
}  
@media (max-width:768px){
	input[type="text"], input[type="password"] {
    padding: 10px 0;
    width: 100%;
	border-bottom: 1px solid #12A5F4;
}
#formContent {
    width: auto;
   border-radius: 0;
	padding: 20px;
	background: #fff;
	box-shadow: 0 30px 60px 0 rgba(4,0,0,0.3);
}
#formContent h2.headings {
	padding:0;
}
#formFooter {
    background-color: #fff;
    border-top: 1px solid #000;
}

}
</style>
<script src="js/sofm.js" type="text/javascript"></script>
<div class="inner-content incon">

<?php if(isset($_SESSION['user']['pass'])) echo "<p align='center' style='font-weight:bold; color:#D74F57;'>".$_SESSION['user']['pass']."</p>"; unset($_SESSION['user']['pass']); ?>

<?php if(isset($_SESSION['user']['login']['err'])) echo "<p align='center' style='font-weight:bold; color:#D74F57;'>".$_SESSION['user']['login']['err']."</p>"; unset($_SESSION['user']['login']['err']); ?>


<div id="formContent">
   <!-- Tabs Titles -->
   <h2 class="headings"> Sign In </h2>
   <!-- Icon -->
   <div class="fadeIn first">
      <img src="images/icon.svg" id="icon" alt="User Icon">
   </div>
   <!-- Login Form -->
   <form name="frm_search" id="frm_search" action="login.php" method="POST">
      <input type="text" name="txt_email" id="login_email" class="textbox_login fadeIn second" placeholder="Enter email id"> 
      <input type="password" name="txt_pwd" id="txt_pwd" class="textbox_login fadeIn third" placeholder="Enter password">
      <input type="submit" name="login" id="submit" value="Login" style="display: block;margin: 20px auto;" />
   </form>
   <!-- Remind Passowrd -->
   <div id="formFooter">
      <a href="forgot.php">Forgot Password?</a>
   </div>
</div>
</div>
<script>
$("#submit").click(function ()
{
	var email=$("#login_email").val();
	var pass=$("#txt_pwd").val();
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
	if(pass=='')
	{
		 alert("Please Enter Password");
		 return false;
	}
	$( "#frm_search" ).submit();
});
</script>
<?php include_once("includes/footer.php"); ?> 