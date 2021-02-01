<?php
error_reporting(1);
if(file_exists("includes/functions.php"))
{
include_once "includes/functions.php";

}
if(file_exists("../includes/functions.php"))
{

include_once "../includes/functions.php";

}

if(file_exists("includes/mysqlclass.php"))
{
	include_once "includes/mysqlclass.php";
}
else if(file_exists("../includes/mysqlclass.php"))
{
	include_once "../includes/mysqlclass.php";
}

$gsetting = mysql_query("select * from generalsettings") or die(mysql_error());

$genfetch=mysql_fetch_array($gsetting);

	$title = $genfetch['website_name'];
	
	$webkeyword=$genfetch['website_keywords'];
	
	$webdes=$genfetch['website_desc'];
	
	$siteteam=$genfetch['website_team'];
	
	$siteadmin=$genfetch['website_admin'];	

	$mail_url=$genfetch['mail_url'];
	
	$site_url=$genfetch['website_url'];
	
	$imglogo=$genfetch['site_logo'];
	
	$server_name=$genfetch['smtp_server'];
	
	$server_username=$genfetch['smtp_username'];
	
	$server_pass=$genfetch['smtp_password'];
	
	$paginate_value=$genfetch['paginate_value'];
	
	$website_url=$genfetch['website_url'];
	
	$logourl=$website_url."/images/".$imglogo;
	
	$paypal=$genfetch['paypal_dmailid'];	
	
	$paay_rate=$genfetch['paypal_rate'];
      
	$tax=$genfetch['tax']; 	
	
	$val_days=$genfetch['days_count'];

    $val_month=$genfetch['month_count'];

date_default_timezone_set("Asia/Calcutta");



// sms function 
// $to  =  international mobile number
// $message  = Text message
// $from = From name maximum 11 Characters

function get_url_contents($url){
        $crl = curl_init();
        $timeout = 25;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
		//echo $ret;
        return $ret;
}

function sendsms($to,$message,$from) {
	
	//echo $to; echo $message; echo $from; 
	
	$smsusername="bluezeal";
	$smspassword="bluezeal";
	
	$url="http://api2.planetgroupbd.com/api/sendsms/plain?user=".$smsusername."&password=".$smspassword."&sender=".$from."&SMSText=".urlencode($message)."&GSM=".$to;
	//echo $url;
	$credit="http://api2.planetgroupbd.com/api/command?username=$smsusername&password=$smspassword&cmd=Credits";
	
	$credittxt=number_format(get_url_contents($credit),0);
	
	if(!$credittxt>0) {
		return "nocredit";exit;
	}
	
	$sendsms=get_url_contents($url);
	
	return $sendsms; 
	
	//return $credittxt;
	
	//return $returntxt;
}

function smsresponse($transid) {
	
	$smsusername="bluezeal";
	$smspassword="bluezeal";
	
	$responseurl="http://api2.planetgroupbd.com/api/dlrpull?user=$smsusername&password=$smspassword&messageid=$transid";
	
	$ressms=get_url_contents($responseurl);
	
	return $ressms;
	
}

?>