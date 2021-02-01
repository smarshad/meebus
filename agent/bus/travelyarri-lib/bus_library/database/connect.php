<?php
ini_set('display_errors',0);
if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs'=='D:/xampplite/htdocs') { 
$CONFIG['HOST_NAME'] = "localhost";
$CONFIG['USER_NAME'] = "root";
$CONFIG['PASSWORD'] = "";
$CONFIG['DB_NAME'] = "urbus";
}
else { 
$CONFIG['HOST_NAME'] = "localhost";
$CONFIG['USER_NAME'] = "";
$CONFIG['PASSWORD'] = "admin@123";
$CONFIG['DB_NAME'] = "";

define('WEB_SERVER','https://busraja.com/');
define('WEB_SITE_NAME','Bus Raja');

define('SYSTEM_EMAIL','');
define('ADMIN_EMAIL','');

//sms contact no
define('CLIENT_SMS_MOBNO','9994705245');
define('TICKET_EMAIL_ID','support@busraja.com');

}
//creating connection here 
$con=mysql_connect($CONFIG['HOST_NAME'], $CONFIG['USER_NAME'], $CONFIG['PASSWORD']);
if(!$con)
{
  die('Unable to connect with database :' . mysql_error());
}

// If connection is successfully connected then connecting database 
if(!mysql_select_db($CONFIG['DB_NAME'] ,$con))
{
	die("Error in connection find database :". mysql_error());
}
  
/*********** PayU done By Dipranjan Sukla *************************
/*
CardNumber: 5123456789012346
CVV: 123
Expiry: 05-17
*/
/*******************************************************************/
/*
$MERCHANT_KEY = "C0Dr8m";
$SALT = "3sf0jURk";
$PAYU_BASE_URL = "https://test.payu.in";
*/
/*$MERCHANT_KEY = "IcmtQv";
$SALT = "Jknwu7eO";
$PAYU_BASE_URL = "https://secure.payu.in/_payment";*/




/*$surl='http://www.planmytrip.travel/successTicket.php';//for bus
$hurl='http://www.planmytrip.travel/CRS_Response.php';//for hotel
$furl='http://www.planmytrip.travel';// failure url*/

if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs'=='D:/xampplite/htdocs') { 
$surl='http://localhost/Bus Raja/successTicket.php';//for bus
$hurl='http://localhost/Bus Raja/CRS_Response.php';//for hotel
$furl='http://localhost/Bus Raja/';// failure url
}
else 
{
$surl='http://www.busraja.com/successTicket.php';//for bus
$hurl='http://www.busraja.com/CRS_Response.php';//for hotel
$furl='http://www.busraja.com/';// failure url
}


/*********** pay u payment info end *******************************/  



?>
