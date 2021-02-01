<?php
include "includes/header.php";
$msg = "";
$errmsg = "";

if (isset($_REQUEST['butchange']))
{
	if (!empty($_REQUEST['txtoldpwd']) || !empty($_REQUEST['txtnewpwd']) || !empty($_REQUEST['txtconpwd']))
	{
		if ($_REQUEST['txtnewpwd'] == $_REQUEST['txtconpwd'])
		{	
			$oldpwd = md5($_REQUEST['txtoldpwd']);
			$newpwd = md5($_REQUEST['txtnewpwd']);
			$rs = $db->query("select * from adminlogin  where admin_password = '$oldpwd'");
			
			if ($db->numrows($rs) > 0)
			{
				$db->query("update adminlogin  set admin_password = '$newpwd'");
				$msg = "Password updated successfully!.<br/>";
			}
			else
			{
				$errmsg = "Current Password does not match!.<br/>";
			}

		
		}
		else
		{
			$errmsg = "New and Confirm passwords are not match!.<br/>";
		}		
		
	}	
	else
	{
		$errmsg = "Password(s) should not be empty!.<br/>";
	}
}
?>

<h2>Change Password</h2>
<form action="changepass.php" method="post" enctype="application/x-www-form-urlencoded" name="frmchpass" target="_self" id="frmchpass">
<table width="50%" border="0" cellpadding="5" cellspacing="1" bordercolor="#999999">
  <tr>
    <td width="37%">Old Password </td>
    <td width="63%"><input name="txtoldpwd" type="password" id="txtoldpwd" maxlength="15"></td>
  </tr>
  <tr>
    <td>New Password </td>
    <td><input name="txtnewpwd" type="password" id="txtnewpwd" maxlength="15"></td>
  </tr>
  <tr>
    <td>Confirm Password </td>
    <td><input name="txtconpwd" type="password" id="txtconpwd" maxlength="15"></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo "<font color='green'>".$msg."</font><font color='red'>".$errmsg."</font>"; ?>
    <!-- <input name="butchange" type="button" id="butchange" value="Change &gt;&gt;" onclick="alert('This is Demo version !!!')">-->
	   <input name="butchange" type="submit" id="butchange" value="Change &gt;&gt;"> 
    </td>
    </tr>
</table>
</form>
<p>&nbsp;</p>
<p>
  <?php
include "includes/footer.php";
?>
</p>