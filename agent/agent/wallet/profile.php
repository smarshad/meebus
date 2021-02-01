<?php
class agent_module
{
	public $con= null;
	public function __construct($con)
	{
		$this->con=$con;
	}
	//LOGIN START
	function login($login)
	{
		$stmt = $this->con->prepare("SELECT agent_id,agent_name,agency_name,email,mobile_phone,office_phone FROM agents WHERE agency_login=? and agency_pass=? and status=?");
		$stmt->execute($login);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;
	}
	function agentSignup($book_detail)
	{
		$stmt = $this->con->prepare("INSERT INTO agents (agent_name,agency_name,agency_login,agency_pass,email,office_phone,state,address,city,country,mobile_phone,fax,pincode,logo) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt->execute($book_detail);
		
		
	}
	//LOGIN END
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
	
	
	
	function array2json($arr) 
	{ 
		if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
		$parts = array(); 
		$is_list = false; 
	
		//Find out if the given array is a numerical array 
		$keys = array_keys($arr); 
		$max_length = count($arr)-1; 
		if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
			$is_list = true; 
			for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position 
				if($i != $keys[$i]) { //A key fails at position check. 
					$is_list = false; //It is an associative array. 
					break; 
				} 
			} 
		} 
	
		foreach($arr as $key=>$value) { 
			if(is_array($value)) { //Custom handling for arrays 
				if($is_list) $parts[] = array2json($value); /* :RECURSION: */ 
				else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */ 
			} else { 
				$str = ''; 
				if(!$is_list) $str = '"' . $key . '":'; 
	
				//Custom handling for multiple data types 
				if(is_numeric($value)) $str .= $value; //Numbers 
				elseif($value === false) $str .= 'false'; //The booleans 
				elseif($value === true) $str .= 'true'; 
				else $str .= '"' . addslashes($value) . '"'; //All other things 
				// :TODO: Is there any more datatype we should be in the lookout for? (Object?) 
	
				$parts[] = $str; 
			} 
		} 
			$json = implode(',',$parts); 
			 
			if($is_list) return '[' . $json . ']';//Return numerical JSON 
			return '{' . $json . '}';//Return associative JSON 
	} 
	function getStation()
	{
		$stmt = $this->con->prepare("select station_name from stations");
		$stmt->execute();
		$station=$stmt->fetchAll(PDO::FETCH_COLUMN, 0);
		$json=json_encode($station);
		return $json;
	}
	function getStationID($origin)
	{
		
		$stmt = $this->con->prepare("select station_id from stations where station_name=?");
		$data=array($origin);
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchColumn();
		}
		else
		return 0;
		
	}
	function busDetailReport($agent_id)
	{
		$stmt = $this->con->prepare("select status,fromStationId,toStationId,pnr,booked_on,travelDate,total_fare,no_of_seat,lead_pax_name from bus_tickets where agent_id=?");	
		$data=array($agent_id);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getStationName($stationId)
	{
		$stmt = $this->con->prepare("select station_name from stations where station_id=?");
		$data=array($stationId);
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchColumn();
		}
		else
		return 0;
		
	}
	function addBookerDetailAgent($book_detail)
	{
		$stmt = $this->con->prepare("INSERT INTO bus_tickets (BlockingID_oneway,agent_id,mode,travelDate,fromStationId,toStationId,boardingInfo,emailId,mobileNbr,lead_pax_name,passenger_name,passenger_age,passenger_sex,passenger_seat,no_of_seat,booked_on,status,total_fare,busInfo,blockRequest,oneway_fare,cancellationDescList,partialCancellation,DepartureTime,ArrivalTime,TravelHours) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt->execute($book_detail);
	}
	function updateBookerDetail($update_detail)
	{
		$stmt = $this->con->prepare("UPDATE bus_tickets SET pnr=?,tin=?,status=?,inventoryId=?,dateOfIssue=? where BlockingID_oneway=?");
		return $stmt->execute($update_detail);
	}
	function getTicket($data)
	{
		$stmt = $this->con->prepare("select pnr,tin,fromStationId,toStationId,DepartureTime,ArrivalTime,busInfo,travelDate,boardingInfo,passenger_name,passenger_age,passenger_seat,passenger_sex,oneway_fare,status,dateOfIssue from bus_tickets where tin=? and status=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
		
	}
	//WALLET
	function walletDeposit($deposit)
	{
		$stmt = $this->con->prepare("INSERT INTO agent_log (agent_id,balance,credit,pay_for,pay_in) values (?,?,?,?,?)");
		return $stmt->execute($deposit);
		
	}
	
	
	//// WALLET END
	
	
	//TOUR PACKAGE START
	
	function getTourOrigin()
	{
		$stmt = $this->con->prepare("select id,title from holiday_list where h_type=? && offer=?");
		$data=array('Domestic','pop');
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getTourDuration()
	{
		$stmt = $this->con->prepare("select id,title from holiday_duration where h_type=?");
		$data=array('Domestic');
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	//TOUR PACKAGE END
	
	

}
?>