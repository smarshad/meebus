<?php
class crs_module
{
	public $con= null;
	public function __construct($con)
	{
		$this->con=$con;
	}

	// CRS STRAT //
	function crs_login($login)
	{
		$stmt = $this->con->prepare("SELECT sup_id,email,salutation,firstname,lastname,mobile_no FROM crs_login WHERE email=? and password=? and status=?");
		$stmt->execute($login);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll();
		}
		else
		return $stmt->rowCount();
	}
	// CRS END //
	
	function systemlogs($pdata)
	{
		$category		=  mysql_real_escape_string(addslashes($pdata[0]));	
		$agent_id  		=  mysql_real_escape_string(addslashes($pdata[1]));
		$modes  		=  mysql_real_escape_string(addslashes($pdata[2]));
		$action			=  mysql_real_escape_string(addslashes($pdata[3]));
		$current_times  =  $_SESSION['system']['current_time'];
		$current_dates  =  $_SESSION['system']['current_date'];
		$pro_mac_id     =  $_SESSION['system']['pro_mac_id'];
		$pinfo  		=  $_SESSION['system']['log']['pinfo'];
		$other_data  	=  mysql_real_escape_string(addslashes($pdata[4]));
		$time_format  	=  time();
		$stmt = $this->con->prepare("INSERT INTO system_log SET category = '$category', cat_id='$agent_id', modes='$modes', action='$action', current_times='$current_times', current_dates='$current_dates', pro_mac_id='$pro_mac_id', pinfo='$pinfo', other_data='$other_data', time_format='$time_format'");

		$stmt->execute();
		
		return $stmt->rowCount();
	}
	function addHotel($hotel)
	{		
		$stmt = $this->con->prepare("INSERT INTO system_log () values (?)");
		return $stmt->execute();
	}
	
}
?>