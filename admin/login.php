<?php 
include_once'../server/server.php'; 
include_once 'includes/functions.php';
$obj=new admin_module($con);
if(isset($_POST['logbut']) && $_POST['logbut']=='Submit')
{
	$admin_login=$_POST['txtname'];
	$admin_pass=$_POST['txtpwd'];
	$data=array($admin_login,$admin_pass,1);
	$login=$obj->login($data);
	if($login!=0)
	{ 
		foreach($login as $adminLoginData)
		{
			
			$_SESSION['admin']['log']['id']			   =	$adminLoginData['admin_ID'];
			$_SESSION['admin']['log']['name']		   =	$adminLoginData['name'];
			
		}
			header('location:dashboard.php');
			exit;
	}
	else
	{
		$_SESSION['admin']['log']['error'] = "Login Failed";
		header('location:login.php');
		exit;
	}	
}
?>
<!DOCTYPE>
<html>
<head>
<?php include 'includes/head.php'; ?>
</head>

<body id="login" class="log ">
<div class="container">
		
      <form class="form-signin" id="login_form" name="frmlogin" action="" method="post" autocomplete="off">
        <h3 class="form-signin-heading" style="text-align:center;">Admin Login</h3>
        <input type="text" class="input-block-level" placeholder="Username" id="username" name="txtname" value="" required>
        <input type="password" class="input-block-level" placeholder="Password" id="password" name="txtpwd" value="" required>
		<?php if(isset($_SESSION['admin']['log']['error']) && $_SESSION['admin']['log']['error']!='') { ?>
        <h6 style="text-align:center; color:#fff; font-weight:bold;"><?php echo $_SESSION['admin']['log']['error']; unset($_SESSION['admin']['log']['error']); ?></h6> <?php } ?>
        <br clear="all">
        <br clear="all">
        <input class="btn btn-large btn-primary1" type="submit" id="Submit" name="logbut" value="Submit" style="display: block;margin: 0px auto;">
      </form>
    </div> <!-- /container -->
  </body>

</html>