<?php ob_start(); session_start(); 
if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs') 
{ 
	$_SESSION['common']['url']		='http://server/meebus/agent/agent/'; 
	$_SESSION['common']['title']	=	"Meebus";
	$_SESSION['common']['login']	=	"Agent Login";
	$_SESSION['common']['heading']	=	"Agent Panel";
}
else 
{ 
	$_SESSION['common']['url']		=	'http://meebus.com/agent/agent/'; 
	$_SESSION['common']['title']	=	"Meebus";
	$_SESSION['common']['login']	=	"Agent Login";
	$_SESSION['common']['heading']	=	"Agent Panel";
	
}
header('location:login.php'); 
?>