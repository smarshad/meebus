<?php

class User
{
	public $con = null;
	public function __construct($con)
	{

		$this->con = new PDO("mysql:host=localhost;dbname=meebus;","root","");;

	}
	function getGeneralSettings()
	{
		$stmt = $this->con->prepare("select * from generalsettings");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function chkusremail($data)
	{
		$stmt = $this->con->prepare("SELECT user_id FROM user_login WHERE user_email=?");
		$stmt->execute($data);
		return $stmt->rowCount();;
	}
	function insert($data)
	{
		$stmt = $this->con->prepare("insert into users (user_email,user_password,user_firstname,user_lastname,user_gender,user_landno,user_mobileno,user_maritalstatus,user_occupation,user_address1_1,user_address1_2,user_address1_city,user_address1_state,user_address1_country ,user_address1_pin,	user_address2_1,user_address2_2,user_address2_city,	user_address2_state,user_address2_country,user_address2_pin,user_typeID,user_status) value (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt->execute($data);
	}
	function getDisableDate($data)
	{
		$stmt=$this->con->prepare("SELECT * FROM businfo WHERE Bus_status=? AND disable_date like ?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function updateDisableDate($data)
	{
		$stmt=$this->con->prepare("UPDATE businfo SET disable_date=? WHERE Bus_id=?");
		$stmt->execute($data);
	}
	function getBookingInfoByPaystatus($data)
	{
		// echo 'dsadsadasd';exit();
		$stmt=$this->con->prepare("SELECT * FROM bookinginfo WHERE pay_status=?");
		$stmt->execute($data);
		$stmt->debugDumpParams();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function delbookingInfo($data)
	{
		$stmt=$this->con->prepare("DELETE FROM bookinginfo WHERE auto_id=?");
		$stmt->execute($data);
	}
	function delbookingByPayStatus($data)
	{
		$stmt=$this->con->prepare("DELETE FROM bookinginfo WHERE pay_status=?");
		$stmt->execute($data);
	}
	function getStationId($data)
	{
		$stmt=$this->con->prepare("SELECT station_id FROM stations WHERE station_name=?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function getBusCities($data)
	{
		$stations = array();
		$stmt = $this->con->prepare("select station_name,station_id from stations WHERE station_name LIKE ?");
		$stmt->execute($data);
		foreach ($stmt->fetchAll() as $row) {
			$stations[] = $row['station_name'];
			$id[] = $row['station_id'];
		}
		$json=json_encode($stations);
		return $json;
	}


	function getBusCities1($data)
	{
		
		$stmt = $this->con->prepare("select station_name,station_id from stations WHERE station_name LIKE ?");
		$stmt->execute($data);
		
		foreach ($stmt->fetchAll() as $row) {
			echo "<option value=".$row['station_name'].">".$row['station_name']."</option>";
		}
		
		
	}

	function getBusCities2($data)
	{
		
		$stmt = $this->con->prepare("select station_name,station_id from stations WHERE station_name LIKE ?");
		$stmt->execute($data);
		
		foreach ($stmt->fetchAll() as $row) {
			echo "<option value=".$row['station_name'].">".$row['station_name']."</option>";
		}
		
		
	}




	/*function getBusCities($data)
	{
		$stmt = $this->con->prepare("select station_name,station_id from stations WHERE station_name LIKE ?");
		$stmt->execute($data);
		foreach ($stmt->fetchAll() as $row) {
			echo $stations = $row['station_name']."<br/>";
		}
	}*/

	function insStation($data)
	{
		$stmt=$this->con->prepare("INSERT INTO stations (station_id,station_name) VALUES (?,?)");
		$stmt->execute($data);
	}
	function getOwnBus($data)
	{
		$stmt=$this->con->prepare("SELECT * FROM businfo WHERE Bus_fromcity=? AND Bus_tocity=? AND Bus_status=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function insbuslog($data)
	{
		$stmt=$this->con->prepare("INSERT INTO error_logs (user_type,user_id,sessionId,ip) VALUES (?,?,?,?)");
		$stmt->execute($data);
	}
	function updatebusSearch($data)
	{
		$stmt = $this->con->prepare("UPDATE error_logs SET searchResultPage=? WHERE sessionId=?");
 		return $stmt->execute($data);	
	}
	function updatebussearchList($data)
	{
		$stmt = $this->con->prepare("UPDATE error_logs SET searchList=? WHERE sessionId=?");
 		return $stmt->execute($data);	
	}
	function updateSelectedBus($data)
	{
		$stmt = $this->con->prepare("UPDATE error_logs SET selectedBus=? WHERE sessionId=?");
 		return $stmt->execute($data);	
	}
	function updatebuspassangeDetail($data)
	{
		$stmt = $this->con->prepare("UPDATE error_logs SET passangeDetail=? WHERE sessionId=?");
 		return $stmt->execute($data);	
	}
	function updatebusBlockResponse($data)
	{
		$stmt = $this->con->prepare("UPDATE error_logs SET BlockResponse=? WHERE sessionId=?");
 		return $stmt->execute($data);	
	}
	function updatebusgeo($data)
	{
		$stmt = $this->con->prepare("UPDATE error_logs SET geoLocation=? WHERE sessionId=?");
 		return $stmt->execute($data);	
	}
	function updateseatListBus($data)
	{
		$stmt = $this->con->prepare("UPDATE error_logs SET seatList=? WHERE sessionId=?");
 		return $stmt->execute($data);	
	}

	function getBalance($data)
	{
		try {
			$stmt = $this->con->prepare("SELECT balance FROM user_login WHERE id=".$data);
			$stmt->execute();
			return $stmt->fetchColumn();
		}
		catch(PDOException $e) {
              echo $e->getMessage();
		}
	}	

	function addBookerDetail($book_detail) {
		try {

			$stmtOne = $this->con->prepare("SELECT TentativeBooking_oneway FROM book_bus_tickets WHERE TentativeBooking_oneway=".$book_detail[0]);
			$stmtOne->execute();
			$count=$stmtOne->rowCount();
			/*$stmtOne->debugDumpParams();
			exit;*/
			if($count ==0) {
				$stmt = $this->con->prepare("INSERT INTO book_bus_tickets (
				TentativeBooking_oneway, scheduleId, apitype, mode,
				travelDate,
				fromStationId,
				toStationId,
				boardingInfo,
				emailId,
				mobileNbr,
				lead_pax_name,
				passenger_name,
				passenger_age,
				passenger_sex,
				passenger_seat,
				no_of_seat,
				booked_on,
				status,
				total_fare,
				busInfo,
				blockRequest,
				oneway_fare,
				cancellationDescList,
				partialCancellation,
				DepartureTime,
				ArrivalTime,
				TravelHours,
				session_id_b,
				promocode,
				booking_type,
				payment_gateway,
				paidAmount,
				alternateno,
				dateOfIssue) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute($book_detail);
				return $stmt->execute($book_detail);	
			}
			
		}
		catch(PDOException $e) {
            echo $e->getMessage();
		}
	}

	function getTicketDetail($ref_id, $status)
	{
		$data = array($ref_id, $status);
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE session_id_b IS ? AND status=? LIMIT 1");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		// $stmt->debugDumpParams();
		if($count==1){
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else{
			return 0;
		}
	}

	function getbustypes()
	{
		$stmt=$this->con->prepare("SELECT * FROM users");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function updatPaymentStatus($data)
	{
		$stmt=$this->con->prepare("UPDATE book_bus_tickets SET payment_txnid=?,paymentStatus=?,payment_msg=? WHERE session_id_b=?");
		return $stmt->execute($data);
	}
	function updatWalletPaymentStatus($data)
	{
		$stmt=$this->con->prepare("UPDATE user_trans_log SET book_status=?,payment_txnid=?,payment_status=?,paymentMsg=? WHERE ref_id=?");
		return $stmt->execute($data);
	}
	function updateBookerDetail($update_detail)
	{
		$stmt = $this->con->prepare("UPDATE book_bus_tickets SET PNR=?,tiket_no=?,status=?,inventoryId=?,dateOfIssue=? WHERE session_id_b=?");
		return $stmt->execute($update_detail);
	}
	function updateBookerDetailFailed($update_detail)
	{
		$stmt = $this->con->prepare("UPDATE book_bus_tickets SET PNR=?,tiket_no=?,status=?,inventoryId=?,dateOfIssue=?,bookingErrmsg=? WHERE session_id_b=?");
		return $stmt->execute($update_detail);
	}
	function getTicket($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE tiket_no=? AND status=?");
		$stmt->execute($data);
		if($count==1)
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else{
				return 0;}		
	}
	function getTicketdetails($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE tiket_no=? AND emailId=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();

		if($count==1)
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		return 0;
	}
	
	function insregister($data)
	{
		$stmt=$this->con->prepare("INSERT INTO user_login (first_name,last_name,email_id,password,mobile_number,unique_id) VALUES (?,?,?,?,?,?)");
		return $stmt->execute($data);
	}


	function insregisterthroughmobile($data)
	{
		$stmt=$this->con->prepare("INSERT INTO user_login (first_name,mobile_number,unique_id) VALUES (?,?,?)");
		return $stmt->execute($data);
	}

	function insregisterthroughfacebook($data1)
	{
		$stmt=$this->con->prepare("INSERT INTO user_login (first_name,facebookid,unique_id) VALUES (?,?,?)");
		return $stmt->execute($data1);
	}

	


	function userLogin($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM user_login WHERE email_id=? AND password=? AND status=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		return 0;
	}


	function userMobileLogin($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM user_login WHERE mobile_number=? AND status=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
		return 0;
		}
	}


	function userFacebookLogin($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM user_login WHERE facebookid=? AND status=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
		return 0;
		}
	}


	


	function updateCancelconfirm($data)
	{
		$stmt=$this->con->prepare("UPDATE book_bus_tickets SET cancel_confirmdata=? WHERE tiket_no=?");
		return $stmt->execute($data);
	}
	function updateCancel($data)
	{
		$stmt=$this->con->prepare("UPDATE book_bus_tickets SET status=?,cancel_data=? WHERE tiket_no=?");
		return $stmt->execute($data);
	}
	function updateCancelFailed($data)
	{
		$stmt=$this->con->prepare("UPDATE book_bus_tickets SET cancel_data=? WHERE tiket_no=?");
		return $stmt->execute($data);
	}
	function checkUserEmail($data)
	{
		$stmt=$this->con->prepare("SELECT email_id FROM user_login WHERE email_id=? AND status=?");
		$stmt->execute($data);
		return $count=$stmt->rowCount();
	}
	function checkbusEmail($data)
	{
		$stmt=$this->con->prepare("SELECT emailId FROM book_bus_tickets WHERE emailId=? AND tiket_no=?");
		$stmt->execute($data);
		return $count=$stmt->rowCount();
	}
	function checkMobile($data)
	{
		$stmt=$this->con->prepare("SELECT mobile_number FROM user_login WHERE mobile_number=? AND status=?");
		$stmt->execute($data);
		return $count=$stmt->rowCount();
	}
	function updateUserBalance($data)
	{
		$stmt=$this->con->prepare("UPDATE user_login SET balance=? WHERE id=?");
		return $stmt->execute($data);
	}
	function insTransLog($data)
	{
		$stmt=$this->con->prepare("INSERT INTO user_trans_log (user_id,mode,amount,balance,description,book_status,time_format,ref_id) VALUES (?,?,?,?,?,?,?,?)");
		return $stmt->execute($data);
	}
	function updateWalletBusPay($data)
	{
		$stmt=$this->con->prepare("UPDATE book_bus_tickets SET wallet_pay=?,balance_pay=? WHERE session_id_b=?");
		return $stmt->execute($data);
	}
	function getPGamount($data)
	{
		$stmt=$this->con->prepare("SELECT balance_pay FROM book_bus_tickets WHERE session_id_b=?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function insertMail($data)
	{	
		$stmt = $this->con->prepare("INSERT INTO sendmail (user_id,fromMailid,mail,subject,content,description,priority) values (?,?,?,?,?,?,?)");
		return $stmt->execute($data);
	}
	//BUS LOG
	function insBusSearchReqLog($data)
	{
		$stmt = $this->con->prepare("INSERT INTO bus_api_log (unicid,searchReq) values (?,?)");
		return $stmt->execute($data);
	}
	function updateBusSearchResLog($data)
	{
		$stmt="UPDATE bus_api_log SET searchRes=? WHERE unicid=?";
		$query = $stmt->query($stmt);
		return $query;
	}
	function updateBusSeatlayoutReqLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET seatLayoutReq=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusSeatlayoutResLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET seatLayoutRes=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusBlockReqLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET blockTicketReq=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusBlockResLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET blockTicketRes=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusConfirmTicketReqLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET confirmTicketReq=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusConfirmTicketResLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET confirmTicketRes=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusgetTicketReqLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET getTicketReq=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusgetTicketResLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_api_log SET getTicketRes=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function insBusConfirmCancleReqLog($data)
	{
		$stmt=$this->con->prepare("INSERT INTO bus_apiCancel_log (cancelConfirmationReq,unicid) values (?,?)");
		return $stmt->execute($data);
	}
	function updateBusConfirmCancleResLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_apiCancel_log SET cancelConfirmationRes=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusCancleReqLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_apiCancel_log SET cancelTicketReq=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	function updateBusCancleResLog($data)
	{
		$stmt=$this->con->prepare("UPDATE bus_apiCancel_log SET cancelTicketRes=? WHERE unicid=?");
		return $stmt->execute($data);
	}
	//BUS LOG END
	function getuserbookedreportdetails($data)
	{
		 $stmt = $this->con->prepare("select * from book_bus_tickets WHERE status=? AND created_datetime >=? AND created_datetime <=? ORDER BY id DESC");	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getCancelledDet($data)
	{
		$stmt=$this->con->prepare("SELECT cancel_data FROM book_bus_tickets WHERE tiket_no=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getprofiledetails($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM user_login WHERE id=?");
	  	$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function updateprofile($data)
	{
		$stmt=$this->con->prepare("UPDATE user_login SET first_name=?,last_name=?,mobile_number=?,address=?,pincode=? WHERE id=?");
		$stmt->execute($data);
		
	}
	function getUserId($data)
	{
		$stmt = $this->con->prepare("SELECT user_id FROM book_bus_tickets WHERE tiket_no=?");
	  	$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function getBookingErr($data)
	{
		$stmt = $this->con->prepare("SELECT bookingErrmsg FROM book_bus_tickets WHERE session_id_b=?");
	  	$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function getuserPass($data)
	{
		$stmt = $this->con->prepare("SELECT password FROM user_login WHERE id=?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function Updatepassword($data)
	{
		$stmt = $this->con->prepare("UPDATE user_login SET password=? WHERE id=?");
		return $stmt->execute($data);
	}
	function getwalletdet($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM user_trans_log WHERE ref_id=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function gettransactionlist($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM user_trans_log WHERE user_id=? LIMIT 5");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getmailuser($email)
	{
		$stmt = $this->con->prepare("SELECT password,id,unique_id FROM user_login WHERE email_id=?");
		$stmt->execute($email);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		return 0;
	}	
	
	function Updateforgotpassword($data)
	{
		$stmt = $this->con->prepare("UPDATE user_login SET password=? WHERE unique_id=?");
		return $stmt->execute($data);
	}
}

?>