<?php
session_cache_limiter("private, must-revalidate");
session_start();
ob_start();
ini_set('max_execution_time', 3000);
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors',0);
session_cache_expire(15);
$cache_expire = session_cache_expire();
require_once("../config/config.php");

$LoginID = $_REQUEST['id'];
$Password = $_REQUEST['pw'];

	$selectLogin="SELECT * FROM agents WHERE agency_login='$LoginID' AND agency_pass='$Password' AND status='yes'";
	$resultLogin=mysql_query($selectLogin) or die("Could not match the database");
	$rows=mysql_fetch_array($resultLogin);
	if($rows['status']=="yes"){
		$data = array('Success',$rows['agent_id'],$rows['account_balance'],$rows['agent_name'],$rows['mobile_phone']);
		
		$_SESSION['agent_id']=$rows['agent_id'];
		$login_date=date('Y-m-d');
		$logout_date=date('Y-m-d');
		if(!$subqry=mysql_query("UPDATE agents SET login_date='$login_date', login_time=curtime(), logout_date='$logout_date', logout_time=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE agent_id='$_SESSION[agent_id]'")) exit(mysql_error());
		{
			$stat="Success";$agent_id=$rows['agent_id'];$agent_name=$rows['agent_name'];$mobile_phone=$rows['mobile_phone'];

//echo json_encode($data,1);	
		}
	}
	else 
	{
        $stat="Failed";$agent_id='';$agent_name='';$mobile_phone='';
		//echo json_encode('Failed',1);	
	}


$json =  array();
for($a=0;$a<1;$a++){
 $json[$a]['status']=$stat;
 $json[$a]['agent_id']=$agent_id;
 $json[$a]['agent_name']=$agent_name;
 $json[$a]['mobile_phone']=$mobile_phone;
 

}
echo json_encode($json, JSON_UNESCAPED_SLASHES);
?>