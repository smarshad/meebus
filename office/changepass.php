<?php
include "includes/header.php";
$off_usrid=$_SESSION['offid'];
$msg = "";
$errmsg = "";

if (isset($_REQUEST['butchange']) && $_REQUEST['butchange']=='Change')
{
	if (!empty($_REQUEST['txtoldpwd']) || !empty($_REQUEST['txtnewpwd']) || !empty($_REQUEST['txtconpwd']))
	{
		if ($_REQUEST['txtnewpwd'] == $_REQUEST['txtconpwd'])
		{	
			 $oldpwd = md5($_REQUEST['txtoldpwd']);
			 $newpwd = md5($_REQUEST['txtnewpwd']);
			//echo "select * from tbl_courier_officers  where off_pwd = '$oldpwd'";
			$rs = $db->query("select * from tbl_courier_officers  where off_pwd = '$oldpwd'");
			
			if ($db->numrows($rs) > 0)
			{
				$db->query("update tbl_courier_officers  set off_pwd = '$newpwd' WHERE `cid`='$off_usrid'");
				$_SESSION['msg'] = "Password updated successfully!.<br/>";
				header('location:changepass.php');exit;
			}
			else
			{
				$_SESSION['errmsg'] = "Current Password does not match!.<br/>";
				header('location:changepass.php');exit;
			}

		
		}
		else
		{
			$_SESSION['errmsg'] = "New and Confirm passwords are not match!.<br/>";
			header('location:changepass.php');exit;
		}		
		
	}	
	else
	{
		$_SESSION['errmsg'] = "Password(s) should not be empty!.<br/>";
		header('location:changepass.php');exit;
	}
}
?>

<h2>Change Password</h2>
<form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmchpass" target="_self" id="frmchpass">
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
    <td colspan="2">
	<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){ echo "<font color='green'>".$_SESSION['msg']."</font>"; $_SESSION['msg']=''; } 
	elseif(isset($_SESSION['errmsg']) && $_SESSION['errmsg']!='') { echo "<font color='red'>".$_SESSION['errmsg']."</font>";  $_SESSION['errmsg']='';}
	
	?>
    <!-- <input name="butchange" type="button" id="butchange" value="Change &gt;&gt;" onclick="alert('This is Demo version !!!')">-->
	   <input name="butchange" type="submit" id="butchange" value="Change"> 
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