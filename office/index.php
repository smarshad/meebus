<?php

session_start();

include "../config/config.php";

if((isset($_REQUEST['logbut_x'])))
{ 
	$name = mysql_real_escape_string($_REQUEST['txtname']);
	$pwd = mysql_real_escape_string(md5($_REQUEST['txtpwd']));
	if(!empty($name) && !empty($pwd))
	{
		 $qry="SELECT * FROM tbl_courier_officers WHERE username='$name' AND off_pwd = '$pwd' ";
		 $rs = $db->query($qry);
		if ($db->numrows($rs) == '1')
		{
			$row = mysql_fetch_assoc($rs);	          
			$_SESSION['offid']  = $row['cid'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['office_name']=$row['office_name'];
			header("location: home.php");
			exit;
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
<title><?php echo $title ; ?> :: Office Panel</title>
 <link href="css/admincss.css" rel="stylesheet" type="text/css" />
 <link href="css/login.css" rel="stylesheet" type="text/css" />
<!--<style type="text/css">

.style1 {color: #990000}

</style>-->
</head>

<body>

<br clear="all" />
<div id="header">
	<img src="../images/buslogo.png" alt="logo" style="height:90px"  />
    <h2>Office Login</h2>
	<form action="index.php" method="post" enctype="application/x-www-form-urlencoded" name="frmlogin" target="_self">
        <div id="admin_bg">
            <div class="admin_in">
                <div class="log_bg">
                    <div class="log_main">
                        <div class="log_lft">User Name</div>
                        <div class="log_rgt"> <input type="text" name="txtname" /></div>
                    </div>
                	<div class="clr"></div>
                    <div class="log_main">
                        <div class="log_lft">Password</div>
                        <div class="log_rgt"><input type="password" name="txtpwd" /></div>
                    </div>
                	<div class="clr"><?php echo "<font color='red'>".$errmsg."</font>"; ?></div>
                	<div style="clear:both;"></div>
                	<div class="log_but" style="padding-bottom:10px; padding-right:50px;"><input type="image" src="images/login_but.png" name="logbut" id="logbut" /></div>
            </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
