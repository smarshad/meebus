<?php
include_once "header.php";
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
  padding: 5px;
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
	padding: 10px 0px;
	display: inline-block;
	font-size: 16px;
	margin: 5px;
	width: 85%;
	border-radius: 5px 5px 5px 5px;
	text-align: left;
	padding-left: 16px;
}
input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}
input[type=text]:placeholder {
  color: #cccccc;
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
<body>
<div class="inner-content incon">
<div id="formContent">
   <!-- Tabs Titles -->
   <h2 class="headings"> Register </h2>
<form name="frm_search" id="frm_search" action="register_form.php" method="post">
      <input type="text" name="fname" id="fname" class="textbox_login fadeIn second" placeholder="Enter First name"> 
      <input type="text" name="lname" id="lname" class="textbox_login fadeIn second" placeholder="Enter Last Name"> 
      <input type="text" name="email" id="email" class="textbox_login fadeIn second" placeholder="Enter E-mail"> 
      <input type="password" name="password" id="txtpwd" class="textbox_login fadeIn third" placeholder="Enter Password">
      <input type="text" name="mobile" id="txtmobile" class="textbox_login fadeIn third" placeholder="Enter Mobile Number">
      <input type="submit" name="Submit" id="Submit" value="Register" style="display: block;margin: 20px auto;" />
   </form>
 
   </div>
</div>

</body>
<script>
$( "#Submit" ).click(function() {
	var f_name=$("#fname").val();
	var l_name=$("#lname").val();
	var pass=$("#txtpwd").val();
	if(f_name=='')
	{
		 alert("Please Enter Your Name");
         return false;
	}
	if(l_name=='')
	{
		 alert("Please Enter Your Last Name");
         return false;
	}
	var email=$("#email").val();
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
  	var mobile=$("#txtmobile").val();
  	if(mobile.length!=10 || mobile.length==0)
  	{
	  	alert("please Enter Valid Mobile Number");
	  	return false;
  	}
	if(mobile=='')
	{
		alert("please Enter Mobile Number");
	  	return false;
	}
  	$( "#register" ).submit();
});
</script>
<?php  include_once("includes/footer.php"); ?>
