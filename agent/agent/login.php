<?php 
include_once'../server/server.php'; 
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!=''){}else { header('location:../index.php'); }
if(isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') { header('location:bus/search.php'); }

include_once 'includes/functions.php';
$obj=new agent_module($con); 

//if(isset($_SESSION['agent']['log']))
//unset($_SESSION['agent']['log']);

$_SESSION['common']['pagename'] = "Login";
if(isset($_POST['Submit']) && $_POST['Submit']=='Submit')
{
	$agency_login = $_POST['username'];
	$agency_pass = $_POST['password'];
	$data=array($agency_login,$agency_pass,'yes','10001');
	
	$other_data = 'Username : '.$agency_login.' <br/> Psasword :'.$agency_pass;
	
	$login=$obj->login($data);
	if($login!=0)
	{ 
		$api_selection = $obj->api_selection('agent');
		
		foreach($login as $agentLoginData)
		{
			$_SESSION['agent']['log']['agent_name']		     	=	$agentLoginData['agent_name'];
			$_SESSION['agent']['log']['agency_name']		    =	$agentLoginData['agency_name'];
			$_SESSION['agent']['log']['email']			      	=	$agentLoginData['email'];
			$_SESSION['agent']['log']['username']			    =	$agentLoginData['agent_name'];
			$_SESSION['agent']['log']['mobile']		       		=	$agentLoginData['mobile_phone'];
			$_SESSION['agent']['log']['agentname']		      	=	$agentLoginData['agent_name'];
			$_SESSION['agent']['log']['id']				     	=	$agentLoginData['agent_id'];
			$_SESSION['agent']['log']['office_phone']	       	=	$agentLoginData['office_phone'];
			$_SESSION['agent']['log']['account_balance']        =	$agentLoginData['account_balance'];
			$_SESSION['agent']['log']['markup'] 			    =	$agentLoginData['a_bus'];
			$_SESSION['agent']['log']['bus_markup']             =	$agentLoginData['bus_markup'];
			$_SESSION['agent']['log']['commission']             =   $agentLoginData['bus_comm'];	
			$_SESSION['agent']['log']['service_charge_mode']    =   $agentLoginData['service_charges_mode'];	
			$_SESSION['agent']['log']['service_charges']        =   $agentLoginData['service_charges'];
			$_SESSION['agent']['log']['api_select']       		=   $api_selection[0]['api_select'];
			
		}
		//Default Agent Side Markup Modify 0 Values Start //
		$agent_id=$_SESSION['agent']['log']['id'];
		$tmpbus		= 0;
		$data=array($tmpbus,$agent_id);
		$deposit=$obj->Markup_update($data);
		//Default Agent Side Markup Modify 0 Values End //

		
		$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Login','Successfully',$other_data);
		$system_log = $obj->systemlogs($system_data);  $system_data='';
		header('location:bus/dashboard.php');
	}
	else
		{
			
			$system_data=''; $system_data=array('Agent',0,'Login','Failed',$other_data);
		    $system_log = $obj->systemlogs($system_data);  $system_data='';
			$_SESSION['agent']['log']['error'] = "Login Failed";
		}
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once 'includes/head.php'; ?>
<script type="text/javascript">

<?php if(isset($_GET['msg']) && $_GET['msg']=='Register Success') { ?> alert('Reister Successfully'); window.location = "login.php"; <?php } ?>

$(document).bind('contextmenu', function (e) {
  e.preventDefault();
   if(e.which === 123){
       return false;
    }
}); 
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body id="login">
<!-- <div class="container form-signin">
<img src="images/offer.png" width="600" height="338" alt="Latest Offer Cash Deposti Get 2 % Extra Added In Your Urbus Account"> </div> -->
<br>

<div class="container">
      <form class="form-signin" id="login_form" name="login_form" action="" method="post" autocomplete="off">
        <h3 class="form-signin-heading">
        <img src="<?php echo $base_url; ?>images/meebus.png"></h3>
        <!--<input type="text" onkeydown="return disableCtrlKeyCombination(event);" onkeypress="return disableCtrlKeyCombination(event);" onpaste="return false" oncopy="return false" autocomplete="off" onfocus="getFocus(this.id);" maxlength="30" size="30" tabindex="12" id="username" name="userName">-->
        <input type="text" class="input-block-level" placeholder="Meebus Agent Login Id" id="username" name="username" value="" required>
        <input type="password" class="input-block-level" placeholder="Password" id="password" name="password" value="" required>
        <?php /*?><div class="g-recaptcha" data-sitekey="6LclqggUAAAAAFem6SSG6e4qnBtHLO-Ma5-Rllsx"></div><?php */?>
		<?php if(isset($_SESSION['agent']['log']['error']) && $_SESSION['agent']['log']['error']!='') { ?>
        <h6 style="text-align:center; color:#F00; font-weight:bold;"><?php echo $_SESSION['agent']['log']['error']; unset($_SESSION['agent']['log']['error']); ?></h6> <?php } ?>
        <br clear="all">
        <a href="forgot-password.php">Forgot Password</a> <a href="sign-up.php" class="full-right">Sign Up</a>
        <br clear="all">
        <br clear="all">
        <input class="btn  btn-primary submit_agent" type="submit" id="Submit" name="Submit" value="Submit" style="">
      </form>
    </div> <!-- /container -->
    <style>
	input.submit_agent {
		display: block;
		width: 150px;
		float: none;
		margin: 5px auto;
		padding: 10px;
	}
	.submit_agent:hover {
		background: #e31e25;
border-color: #e31e25;
	}
	</style>
  </body>
</html>
