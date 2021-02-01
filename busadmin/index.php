<?php
session_start();
include "../config/config.php";

if((isset($_REQUEST['butsubmit_x'])) || (isset($_REQUEST['dlogin'])))
{

 if(isset($_REQUEST['dlogin']))
   {
   
   $email=base64_decode($_REQUEST['username']);
    $pwd=base64_decode($_REQUEST['password']);
   }else
   {
	$email = mysql_real_escape_string($_REQUEST['txtname']);
	$pwd =  mysql_real_escape_string($_REQUEST['txtpwd']);
	}
	
	if(!empty($email) && !empty($pwd))
	{
	
	$qry="SELECT * FROM serviceprovider_info WHERE SP_email='".$email."' AND SP_password = '".$pwd."' and SP_status=1";

	 $rs = mysql_query($qry);
	
		if (mysql_num_rows($rs) == 1)
		{
			while($row = mysql_fetch_array($rs)){			          
			$_SESSION['SP_id']  = $row['SP_id'];
			$_SESSION['SP_name'] = $row['SP_name'];
			$_SESSION['accessing_type'] = $row['user_typeID'];
			$_SESSION['accessing_LogID']=$row['SP_id'];
			$_SESSION['verified']=$row['SP_verified'];
			$_SESSION['pwd']=$pwd;

			if($row['SP_verified']==1)			
			header("location:home.php");
			else
			header("location:changepass.php");
			}
			exit(0);
		}
		else
		{
			$errmsg = "Account does not exists!...<br/>";
		}		
	}	
	else
	{
		$errmsg = "Please enter the login details...<br/>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Meebus:: Bus  Admin Panel</title>
 <link href="css/admincss.css" rel="stylesheet" type="text/css" />
  <link href="css/login.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style1 {color: #990000}
-->
</style>
</head>

<body>

<br />
<div id="header">

    <form action="index.php" method="post" name="frmlogin" target="_self">
    
        <div id="admin_bg">
        <img src="../images/buslogo.png" alt="logo" class="logo"/>
     <h1>Bus Administration Login</h1>
            <div class="admin_in">
                <div class="log_bg">
                    <div class="log_main cf">
                        <div class="log_lft">User Name</div>
                        <div class="log_rgt"> <input type="text" name="txtname" /></div>
                    </div>
                    <div class="log_main cf">
                        <div class="log_lft">Password</div>
                        <div class="log_rgt"><input type="password" name="txtpwd" /></div>
                    </div>
                    <div class="clr"><?php echo "<font color='red'>".$errmsg."</font>"; ?></div>
                    <div style="clear:both;"></div>
                    <div class="log_but"><input type="image" src="images/login_but.png" name="butsubmit" id="butsubmit" /></div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>