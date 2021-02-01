<?php 
function sendsmslink($mobilenumber)  {
$message="Thanks for requesting Urbus mobile app. Click Here For Mobile App -> https://play.google.com/store/apps/details?id=com.Urbus.booking";	
$url="http://reseller.ksms.in:8080/sendsms/bulksms?username=msk-dodit&password=123456&type=0&dlr=1&destination=".$mobilenumber."&source=PURBUS&message='".$message."'";
//$url = "http://sms.wholesalesms.in/api/sendmsg.php?user=Urbus&pass=mohan!123*&sender=purbus&phone=".$mobilenumber."&text=".$message."&priority=ndnd&stype=normal";
//$url = "http://indiabulksms.org/api/sentsms.php?username=Urbus&api_password=e3907fdf7c&to=".urlencode($mobilenumber)."&priority=2&sender=PURBUS&message=".urlencode(trim($message));
?><?php /*?><iframe src="<?php echo $url; ?>" style="border:0px; height:0px; width:0px;"><?php */?><?php 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
curl_close($ch);
//$res = $output; if($res!='') { echo "SMS Send";	} else  { echo "SMS Not Send Please Try Again Later"; }
echo "SMS Send";
//$res = explode('.',$output); if($res[0]=='S') { echo "SMS Send";	} else  { echo "SMS Not Send Please Try Again Later"; }
//$res = explode(':',$output); if($res[0]=='1') { echo "SMS Send Check Your Mobiel";	} else { echo "SMS Not Send Please Try Again Later"; }
}

function voice_booking($mobile) {  
$postData="";
$retval = "";
$CallBackURL="http://smscountry.com/testdr.aspx";
$FromMobile="919994705245";
$ToMobile="91".$mobile;
$Voice_Clip="https://Urbus.com/voice/succesticket.mp3";
$postData .= "api_key=lnq1Og2yN62wIZS18n7j&access_key=1gOIGynp6FJVZIjnmn4rPw00P2eod5O8W4wlTt0c";
$postData .= "&xml=<request action='". $CallBackURL . "' method='POST'><from>" . $FromMobile ."</from><to>". $ToMobile . "</to><play>" . $Voice_Clip ."</play></request>";
$url = "http://voiceapi.smscountry.com/api";
$ch = curl_init();
if (!$ch)
{
	die("Couldn't initialize a cURL handle");
}
$ret = curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch, CURLOPT_POSTFIELDS,$postData);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$curlresponse = curl_exec($ch);
if(curl_errno($ch))
echo 'curl error : '. curl_error($ch);
if (empty($ret))
{
die(curl_error($ch));
curl_close($ch);
}
else {
$info = curl_getinfo($ch);
curl_close($ch);
} }

function voice_agentregistration($mobile) {   
$postData="";
$retval = "";
$CallBackURL="http://smscountry.com/testdr.aspx";
$FromMobile="919994705245";
$ToMobile="91".$mobile;
$Voice_Clip="https://Urbus.com/voice/AgentuserRegister.mp3";
$postData .= "api_key=lnq1Og2yN62wIZS18n7j&access_key=1gOIGynp6FJVZIjnmn4rPw00P2eod5O8W4wlTt0c";
$postData .= "&xml=<request action='". $CallBackURL . "' method='POST'><from>" . $FromMobile ."</from><to>". $ToMobile . "</to><play>" . $Voice_Clip ."</play></request>";
$url = "http://voiceapi.smscountry.com/api";
$ch = curl_init();
if (!$ch)
{
	die("Couldn't initialize a cURL handle");
}
$ret = curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch, CURLOPT_POSTFIELDS,$postData);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$curlresponse = curl_exec($ch);
if(curl_errno($ch))
echo 'curl error : '. curl_error($ch);
if (empty($ret))
{
die(curl_error($ch));
curl_close($ch);
}
else {
$info = curl_getinfo($ch);
curl_close($ch);
}  }

function voice_cancel($mobile) {   
$postData="";
$retval = "";
$CallBackURL="http://smscountry.com/testdr.aspx";
$FromMobile="919994705245";
$ToMobile="91".$mobile;
$Voice_Clip="https://Urbus.com/voice/cancelticket.mp3";
$postData .= "api_key=lnq1Og2yN62wIZS18n7j&access_key=1gOIGynp6FJVZIjnmn4rPw00P2eod5O8W4wlTt0c";
$postData .= "&xml=<request action='". $CallBackURL . "' method='POST'><from>" . $FromMobile ."</from><to>". $ToMobile . "</to><play>" . $Voice_Clip ."</play></request>";
$url = "http://voiceapi.smscountry.com/api";
$ch = curl_init();
if (!$ch)
{
	die("Couldn't initialize a cURL handle");
}
$ret = curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch, CURLOPT_POSTFIELDS,$postData);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$curlresponse = curl_exec($ch);
if(curl_errno($ch))
echo 'curl error : '. curl_error($ch);
if (empty($ret))
{
die(curl_error($ch));
curl_close($ch);
}
else {
$info = curl_getinfo($ch);
curl_close($ch);
}  }

function voicesms($Voice_Clip,$mob) { 
$postData="";	$retval = "";
if($Voice_Clip=='booked')
{
$Voice_Clip = "Thanks For Using urbus dot com Your Ticket Booked Successfully";
}
else 
{
$Voice_Clip = "Thanks For Using urbus dot com";
}
$CallBackURL="https://Urbus.com/homepage.php";
$FromMobile="919994705245";
$ToMobile=$mob;
$postData.= "api_key=lnq1Og2yN62wIZS18n7j&access_key=1gOIGynp6FJVZIjnmn4rPw00P2eod5O8W4wlTt0c";
$postData.= "&xml=<request action='".$CallBackURL."' method='GET'><from>" . $FromMobile ."</from><to>". $ToMobile . "</to>
<speak engine='2' language='English' voice='Veena' gender='F' description='Indian' >".$Voice_Clip."</speak></request>";
$url = "http://voiceapi.smscountry.com/api";
$ch = curl_init();
$ret = curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch, CURLOPT_POSTFIELDS,$postData);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$curlresponse = curl_exec($ch);
if(curl_errno($ch))
if (empty($ret))
	{
		curl_close($ch);
	}
else 
	{
		$info = curl_getinfo($ch);
		curl_close($ch);
	} }

function sendsms2($message, $mobilenumber)  {  
//$url = "http://reseller.ksms.in:8080/sendsms/bulksms?username=msk-dodit&password=123456&type=0&dlr=1&destination=".$mobilenumber."&source=PURBUS&message=".$message;
////$url = "http://sms.wholesalesms.in/api/sendmsg.php?user=Urbus&pass=mohan!123*&sender=purbus&phone=".$mobilenumber."&text=".$message."&priority=ndnd&stype=normal";
////$url = "http://indiabulksms.org/api/sentsms.php?username=Urbus&api_password=e3907fdf7c&to=".urlencode($mobilenumber)."&priority=2&sender=PURBUS&message=".urlencode(trim($message));

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => "8080",
  CURLOPT_URL => "http://reseller.ksms.in:8080/sendsms/bulksms",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "username=msk-dodit&password=123456&type=0&dlr=1&destination=91".$mobilenumber."&source=PURBUS&message=".$message,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

echo "SMS SEND"; 
voicesms($message,$mobilenumber);   }  

function sendsms($message, $mobilenumber) {   
//$url="http://reseller.ksms.in:8080/sendsms/bulksms?username=msk-dodit&password=123456&type=0&dlr=1&destination=".$mobilenumber."&source=PURBUS&message=".$message;
//$url = "http://sms.wholesalesms.in/api/sendmsg.php?user=Urbus&pass=mohan!123*&sender=purbus&phone=".$mobilenumber."&text=".$message."&priority=ndnd&stype=normal";
//$url = "http://indiabulksms.org/api/sentsms.php?username=Urbus&api_password=e3907fdf7c&to=".urlencode($mobilenumber)."&priority=2&sender=PURBUS&message=".urlencode(trim($message));

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => "8080",
  CURLOPT_URL => "http://reseller.ksms.in:8080/sendsms/bulksms",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "username=msk-dodit&password=123456&type=0&dlr=1&destination=91".$mobilenumber."&source=PURBUS&message=".$message,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

//voicesms($message,$mobilenumber); 
}

function sendsms1($message, $mobilenumber,$seduleTime1) {  

voicesms('booked',$mobilenumber);    
//$url = "http://reseller.ksms.in:8080/sendsms/bulksms?username=msk-dodit&password=123456&type=0&dlr=1&destination=".$mobilenumber."&source=PURBUS&message=".$message;
//$url = "http://sms.wholesalesms.in/api/sendmsg.php?user=Urbus&pass=mohan!123*&sender=purbus&phone=".$mobilenumber."&text=".$message."&priority=ndnd&stype=normal";
//$url = "http://indiabulksms.org/api/sentsms.php?username=Urbus&api_password=e3907fdf7c&to=".urlencode($mobilenumber)."&priority=2&sender=PURBUS&message=".urlencode(trim($message));

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => "8080",
  CURLOPT_URL => "http://reseller.ksms.in:8080/sendsms/bulksms",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "username=msk-dodit&password=123456&type=0&dlr=1&destination=91".$mobilenumber."&source=PURBUS&message=".$message,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
  ),
));
return $response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if($seduleTime1)
seduleTime($message, $mobilenumber,$seduleTime1);

} 

function seduleTime($message, $mobilenumber,$seduleTime1) {  
	
$message2 ="Remainder SMS From Pure Bus Only 2 Hours Left - ".$message;
//$url = "http://reseller.ksms.in:8080/sendsms/bulksms?username=msk-dodit&password=123456&type=0&dlr=1&destination=".$mobilenumber."&source=PURBUS&message=".$message2."&time=".$seduleTime1;
//$url = "http://sms.wholesalesms.in/api/schedulemsg.php?user=Urbus&pass=mohan!123*&sender=purbus&phone=".$mobilenumber."&text=".$message2."&priority=ndnd&stype=normal&time=".$seduleTime1;

/*$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => "8080",
  CURLOPT_URL => "http://reseller.ksms.in:8080/sendsms/bulksms",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "username=msk-dodit&password=123456&type=0&dlr=1&time=2015-11-14%2014%3A18&destination=91".$mobilenumber."&source=PURBUS&message=".$message2,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);*/

voicesms($message,$mobilenumber);	 }
?>