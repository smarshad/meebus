<?php

session_start();

include "../config/config.php";

if((isset($_REQUEST['logbut_x'])) || (isset($_REQUEST['dlogin'])))
{ //print_r($_REQUEST); exit;


   if(isset($_REQUEST['dlogin']))
   {
   $name=base64_decode($_REQUEST['username']);
    $pwd=md5(base64_decode($_REQUEST['password']));
   }else
   {
	$name = mysql_real_escape_string($_REQUEST['txtname']);
	//$pwd =  md5(mysql_real_escape_string($_REQUEST['txtpwd']));
	$pwd =  mysql_real_escape_string($_REQUEST['txtpwd']);
	}
	
	if(!empty($name) && !empty($pwd))
	{
	
	 $qry="SELECT * FROM adminlogin WHERE admin_username='".$name."' AND admin_password = '".$pwd."' and admin_status=1";
	
	//echo $qry ; exit ;
	 
	 $rs = $db->query($qry);
	
		if ($db->numrows($rs) == '1')
		{
			$row = mysql_fetch_assoc($rs);	          
			$_SESSION['aduid']  = $row['admin_ID'];
			$_SESSION['aduser'] = $row['admin_username'];
			$_SESSION['accessing_type'] = $row['User_type'];
			$_SESSION['accessing_LogID']=$row['admin_ID'];
			//exit;
			header("location: home.php");
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
<title><?php echo $title ; ?> :: Admin Panel</title>
 <link href="css/admincss.css" rel="stylesheet" type="text/css" />
 <link href="css/login.css" rel="stylesheet" type="text/css" />
<!--<style type="text/css">

.style1 {color: #990000}

</style>-->
</head>

<body>

<!--<div id="logo" class="cf">
    <div id="header">
        <p><img src="../images/redbus_logo.png" alt="logo" height="60" /></p>
    </div>
</div>
<br clear="all" />-->
<div id="header">
	
	<form action="index.php" method="post" enctype="application/x-www-form-urlencoded" name="frmlogin" target="_self">
    
        <div id="admin_bg">
        <img src="../images/redbus_logo.png" alt="logo" class="logo" />
        <h1>Administration Login</h1>
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
                	
                	<div class="log_but"><input type="image" src="../busadmin/images/login_but.png" name="logbut" id="logbut" /></div>
            </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<!--<table width="30%" border="1" align="center" cellpadding="3" cellspacing="3" bordercolor="#000099">
  <tr><td>
   <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bordercolor="#000099">
  <tr>
    <td colspan="2"><strong>LOGIN </strong></td>
  </tr>
  <tr>
    <td width="50%">Name</td>
    <td width="50%"><label>
      <input type="text" name="txtname" />
    </label></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="txtpwd" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php echo "<font face='verdana' color='red' size='2px'>".$errmsg."</font>"; ?>
      <input type="submit" name="butsubmit" value="Login" />
      </td>
    </tr>
</table>
</td></tr></table>-->


