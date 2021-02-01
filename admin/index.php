<?php ob_start(); session_start(); 
if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') 
	{ 
		$_SESSION['common']['superadmin']['url']	  =	'http://preethi/go4all/superadmin/'; 
		$_SESSION['common']['superadmin']['title']	  =	"Go4All";
		$_SESSION['common']['superadmin']['login']	  =	"Super Admin Login";
		$_SESSION['common']['superadmin']['heading']  =	"Super Admin Panel";
		
		$_SESSION['common']['superadmin']['url1']    =	'http://preethi/go4all/'; 
		
	} 
else 
	{ 
		$_SESSION['common']['superadmin']['url']	  =	'https://demosample.in/go4all/superadmin/'; 
		$_SESSION['common']['superadmin']['title']	  =	"Go4All";
		$_SESSION['common']['superadmin']['login']	  =	"Super Admin Login";
		$_SESSION['common']['superadmin']['heading']  =	"Super Admin Panel";
		$_SESSION['common']['superadmin']['url1']    =	'https://go4all.com/';
		
	}
//header('location:../shopping/index.php/superadmin');
header('location:login.php');
?>