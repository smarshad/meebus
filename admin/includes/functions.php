<?php
class admin_module
{
	public $con= null;
	public function __construct($con)
	{
		$this->con=$con;
	}
	function getuserbookedreportdetails($data)
	{
		//print_r($data); exit;
		 $stmt = $this->con->prepare("select * from book_bus_tickets WHERE status=? AND created_datetime >=? AND created_datetime <=? ORDER BY id DESC");	
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getuserbookedreport($data)
	{
		//print_r($data); exit;
		 $stmt = $this->con->prepare("select * from book_bus_tickets WHERE status=? ORDER BY id DESC");	
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getagentbookedreportdetails($data)
	{
		 $stmt = $this->con->prepare("select * from book_bus_tickets WHERE status=? AND created_datetime >=? AND created_datetime <=? ORDER BY id DESC");	
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function login($login)
	{
		$stmt = $this->con->prepare("SELECT * FROM adminlogin WHERE admin_username=? and admin_password=? and admin_status=?");
		$stmt->execute($login);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		return 0;
	}
	function systemlogs($pdata)
	{
		$category		=  $pdata[0];	
		$id  		      =  $pdata[1];
		$modes  		   =  $pdata[2];
		$action		  =  $pdata[3];
		$current_times   =  $_SESSION['system']['current_time'];
		$current_dates   =  $_SESSION['system']['current_date'];
		$pro_mac_id      =  $_SESSION['system']['pro_mac_id'];
		$pinfo  		   =  $_SESSION['system']['log']['pinfo'];
		$other_data  	  =  $pdata[4];
		$time_format  	 =  time();
		$stmt = $this->con->prepare("INSERT INTO system_log SET category = '$category', cat_id='$id', modes='$modes', action='$action', current_times='$current_times', current_dates='$current_dates', pro_mac_id='$pro_mac_id', pinfo='$pinfo', other_data='$other_data', time_format='$time_format'");
		$stmt->execute();
		return $stmt->rowCount();
	}
	function getUsers($data)
	{
		$stmt = $this->con->prepare("select * from user_login WHERE status=? ORDER BY id DESC");	
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getUserByDate($data)
	{
		$stmt = $this->con->prepare("select * from user_login WHERE status=? AND created_datetime >=? AND created_datetime <=? ORDER BY id DESC");	
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function activateUser($data)
	{
		$stmt=$this->con->prepare("UPDATE user_login SET status=? WHERE id=?");
		return $stmt->execute($data);
	}
	function getuserTransHistory($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM user_trans_log WHERE created_datetime >=? AND created_datetime <=? ORDER BY id DESC");	
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getUserById($data)
	{
		$stmt = $this->con->prepare("SELECT first_name,mobile_number,email_id,balance FROM user_login WHERE id=?");	
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>