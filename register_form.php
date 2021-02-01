<?php
include_once "server/server.php";
include "includes/pdo_functions.php";
$obj=new user_module($con);
if(isset($_POST['Submit']) && $_POST['Submit']=='Register'){
	
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$txtemail=$_POST['email'];
	//$txtpwd=$_POST['password'];
	$txtpwd=sha1($_POST['password']);
	$txtmobile=$_POST['mobile'];
	$unique=time().rand(10000,99999);
	$checkMobile=$obj->checkMobile(array($txtmobile,1));
	if($email!='')
	$checkEmail=$obj->checkUserEmail(array($txtemail,1));
	else
	{
		$checkEmail=0;
		$email='NULL';
	}
	if($checkMobile==0  && $checkEmail==0)
	{
		$data=array($fname,$lname,$txtemail,$txtpwd,$txtmobile,$unique);
		$res=$obj->insregister($data); 
		if($res=1)
		{
			header("location:login.php");
			exit;
		}
		else
		{
			$_SESSION['user']['register']='Register Failed';
			header('location:register.php');
			exit;
		}
	}
	else
	{
		if($checkMobile!=0 || $checkEmail!=0)
		{
			$_SESSION['user']['register']='Mobile Number or E-mail ID Already Exist';
			header('location:signup.php');
			exit;
		}
		
	}
}