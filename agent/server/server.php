<?php
session_start();
ob_start();

ini_set('display_errors',0);
/*ini_set('expose_php','Off');
ini_set('error_reporting','E_ALL');
ini_set('display_errors','Off');
ini_set('display_startup_errors','Off');
ini_set('enable_dl','On');
ini_set('disable_functions','system, exec, shell_exec, passthru, phpinfo, show_source, popen, proc_open');
ini_set('disable_functions','fopen_with_path,dbmopen,dbase_open,putenv,move_uploaded_file');
ini_set('disable_functions','chdir, mkdir, rmdir, chmod, rename');
ini_set('disable_functions','filepro, filepro_rowcount, filepro_retrieve, posix_mkfifo');*/

date_default_timezone_set("Asia/Kolkata"); 
ini_set('max_execution_time', 300); 
unset($_SESSION['common']['pagename1']);
//$error_logs = "INI-SET Display Errors : (((((".ini_set('display_errors',E_ALL).")))))<br/>";

$error_logs='';
//$error_logs.= "INI-SET Display Errors : (((((".ini_set('display_errors',0).")))))<br/>";
//$error_logs.= "INI-GET PCRE false Errors : (((((".implode('^',ini_get_all("pcre", false)).")))))<br/>"; 
//$error_logs.= "INI-GET null false Errors : (((((".implode('^',ini_get_all(null, false)).")))))<br/>"; 

$_SESSION['system']['pro-mac-id'];
$_SESSION['system']['current_time'] = time();
$_SESSION['system']['current_date'] = date('d/m/Y h:i:s A',$_SESSION['system']['current_time']);

system('ipconfig/all'); $mycom=ob_get_contents(); ob_clean(); $findme = "Physical"; $pmac = strpos($mycom, $findme); $mac=substr($mycom,($pmac+36),17); $_SESSION['system']['pro_mac_id'] = $mac;

try {
if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') { 
$con = new PDO('mysql:host=localhost;dbname=meebus','root','');
}
else 
{
$con = new PDO('mysql:host=localhost;dbname=meebus_meebus', 'meebus_meebus', 'LsywUWo5');
}
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
	header('location:server-maintenance.php');
}
$_SESSION['system']['log']['pinfo'] = 'GATEWAY_INTERFACE : '.$_SERVER['GATEWAY_INTERFACE'].'<br/>'.'HTTP_ACCEPT : '.$_SERVER['HTTP_ACCEPT'].'<br/>'.'HTTP_ACCEPT_ENCODING : '.$_SERVER['HTTP_ACCEPT_ENCODING'].'<br/>'.'HTTP_ACCEPT_LANGUAGE : '.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'<br/>'.'HTTP_CONNECTION : '.$_SERVER['HTTP_CONNECTION'].'<br/>'.'HTTP_HOST : '.$_SERVER['HTTP_HOST'].'<br/>'.'HTTP_USER_AGENT : '.$_SERVER['HTTP_USER_AGENT'].'<br/>'.'QUERY_STRING : '.$_SERVER['QUERY_STRING'].'<br/>'.'REMOTE_ADDR : '.$_SERVER['REMOTE_ADDR'].'<br/>'.'REMOTE_PORT : '.$_SERVER['REMOTE_PORT'].'<br/>'.'REQUEST_METHOD : '.$_SERVER['REQUEST_METHOD'].'<br/>'.'SCRIPT_FILENAME : '.$_SERVER['SCRIPT_FILENAME'].'<br/>'.'SERVER_NAME : '.$_SERVER['SERVER_NAME'].'<br/>'.'SERVER_ADMIN : '.$_SERVER['SERVER_ADMIN'].'<br/>'.'SERVER_PROTOCOL : '.$_SERVER['SERVER_PROTOCOL'].'<br/>'.'SERVER_SIGNATURE : '.$_SERVER['SERVER_SIGNATURE'].'<br/>'.'SERVER_SOFTWARE : '.$_SERVER['SERVER_SOFTWARE'];

if(!isset($_SESSION['common']['url']) || $_SESSION['common']['url']=='')
{
	if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') 
{ 
	$_SESSION['common']['url']		='http://server/meebus/agent/agent/'; 
	$_SESSION['common']['title']	=	"Urbus";
	$_SESSION['common']['login']	=	"Agent Login";
	$_SESSION['common']['heading']	=	"Agent Panel";
} 
else 
{ 
	$_SESSION['common']['url']		=	'http://urbus.info/agent/agent/'; 
	$_SESSION['common']['title']	=	"Urbus";
	$_SESSION['common']['login']	=	"Agent Login";
	$_SESSION['common']['heading']	=	"Agent Panel";
	
}
}
else 
{ 
	$base_url	=	$_SESSION['common']['url'];
}

?>
 
