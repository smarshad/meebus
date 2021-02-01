<?php 
include_once("header.php"); 
$unique_id=$_GET['id'];
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	$conf_pass=sha1($_POST['conf_pass']);
	$data=array($conf_pass,$unique_id);

	$res=$obj->Updateforgotpassword($data); 
	if($res==1)
	{
        $_SESSION['user']['password']="Change Password Successfully";
		header('location:login.php');
		exit;
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
  padding: 20px 8px 0px 8px; 
  color: #000;
 
}
/* STRUCTURE */

#formContent {
  margin: 0px auto;
  border-radius: 10px 10px 10px 10px;
  background: #EFEEEE;
  padding: 4px;
  width: 83%;
  max-width: 450px;
  position: relative;
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
  padding: 7px 18px;
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
  background-color: #fff;
  color:#E72E33;
  border-color:#E72E33;
}

input[type=text], input[type=password] {
  background-color: #fff;
  border: none;
  color: #0d0d0d;
  padding: 9px 14px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 78%;
  border: 2px solid #f6f6f6;
  border-radius: 5px 5px 5px 5px;
}
input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}
input[type=text]:placeholder {
  color: #cccccc;
}

</style>

<div class="inner-content">

<div id="formContent">
<h4 class="headings"> CHANGE PASSWORD</h4>
<form name="frm_search" id="frm_search" action="" method="post">
     <input type="password" id="new_pass" name="new_pass" placeholder="New Password">
       <input type="password" id="conf_pass" name="conf_pass" placeholder="Confrim Password">
      <input type="submit" name="submit" id="submit" value="Submit" style="display: block;margin: 20px auto;" />
   </form>

   
</div>
</div>
<script>
	  
$("#submit").click(function ()
{
	
	var new_pass=$("#new_pass").val();
	var conf_pass=$("#conf_pass").val();
	if(new_pass=='')
	{
		 alert("Please Enter Your New Passwword");
		 return false;
	}
	if(conf_pass=='')
	{
		 alert("Please Enter Your Confirm Passwword");
		 return false;
	}
	if(new_pass!=conf_pass)
	{
		alert("Password Mismatched!");
		return false;
	}
	$( "#frm_search" ).submit();
});
</script>
<?php include_once("includes/footer.php"); ?> 