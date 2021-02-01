<?php
class agent_module
{
	public $con= null;
	public function __construct($con)
	{
		$this->con=$con;
	}
	
	function api_selection($data)
	{
		$data = array($data);
		$stmt = $this->con->prepare("SELECT api_select FROM api_mode WHERE status=1 and api_choose_mode=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count>0)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;	
	}


     function commonUpdates()
	{

	$r1 = $this->con->prepare("UPDATE book_bus_tickets SET status = 'BOOKED' WHERE book_bus_tickets.agent_id !=0 AND book_bus_tickets.cancel_amount ='0' AND book_bus_tickets.PNR !='' AND book_bus_tickets.status='User Cancel Payment Process'");
	$r1->execute();	
	
	$r2 = $this->con->prepare("UPDATE book_bus_tickets SET status = 'CANCELLED' WHERE  book_bus_tickets.agent_id !='0' AND book_bus_tickets.cancel_amount!='0' AND book_bus_tickets.PNR ='' AND book_bus_tickets.status='User Cancel Payment Process'");
	$r2->execute();	
	
	$r3 = $this->con->prepare("UPDATE book_bus_tickets SET status = 'BOOKED' WHERE book_bus_tickets.agent_id !='0'  AND book_bus_tickets.cancel_amount ='0' AND book_bus_tickets.PNR !='' AND book_bus_tickets.status='Seat Select Process'");
	$r3->execute();	
	
	$r4 = $this->con->prepare("UPDATE book_bus_tickets SET status = 'CANCELLED' WHERE  book_bus_tickets.agent_id !='0'  AND book_bus_tickets.cancel_amount!='0' AND book_bus_tickets.PNR !='' AND book_bus_tickets.status='Seat Select Process'");
	$r4->execute();		

	}
	function live($id)
	{
		$stmt2 = $this->con->prepare("UPDATE agents SET live=? WHERE agent_id=?");
		$stmt2->execute($id);		
	}
	//LOGIN START
	function login($login)
	{
		$stmt = $this->con->prepare("SELECT agent_id,agent_name,agency_name,email,mobile_phone,office_phone,account_balance,a_bus,bus_markup,bus_comm,service_charges_mode,service_charges, dist_id,cargo_office FROM agents WHERE agency_login=? and agency_pass=? and status=? and dist_id=?");
		$stmt->execute($login);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;
	}
	
	function forgotpassword($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM agents WHERE email=? and status=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;
	}
	function agentMarkup($amount,$agent_markup,$admin_markup)
	{
		if(!is_array($amount))
		{
			$tmpAmt = $amount+($amount*($agent_markup+$admin_markup)/100);
			//$tmpAmt = $amount+$agent_markup+$admin_markup;
			return $tmpAmt;
		}
		
		else
		{	$i=0;
			foreach($amount as $am)
			{
				$amount[$i]= $am+($am*($agent_markup+$admin_markup)/100);
				//$amount[$i]= $am+$agent_markup+$admin_markup;
				$i++;
				
			}
			return $amount;
		}
		
	}
	
	function getAgentDeatils($id)
	{
		$agent=array($id);
		//echo "SELECT * FROM agents WHERE agent_id=".$id;
		$stmt = $this->con->prepare("SELECT * FROM agents WHERE agent_id=?");
		$stmt->execute($agent);
		$count=$stmt->rowCount();
		if($count>0)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;
		
	}
	
	function getAgentBalance($agent_id)
	{
		$agent=array($agent_id);
		$stmt = $this->con->prepare("SELECT account_balance FROM agents WHERE agent_id=?");
		$stmt->execute($agent);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchColumn();
		}
		else
		return 0;
		
	}
	function getAgentlogo($data)
	{
		$stmt = $this->con->prepare("SELECT logo,alogo FROM agents WHERE agent_id=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
		
	}
	
	function getAgentlogoDet($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM agent_booking_log WHERE transfer_id=? AND agent_id=?");
		$stmt->execute($data);
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
		$stmt = $this->con->prepare("INSERT INTO agents (dist_id,agent_name,agency_name,agency_login,agency_pass,email,office_phone,state,address,city,country,mobile_phone,fax,pincode,logo,status) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt->execute($book_detail);
		
		
	}
	
	//Error log
	function error_logs($error_logs)
	{
		$stmt = $this->con->prepare("INSERT INTO error_logs (agent_id,agent_name,agency_name,time_format,current_dates,records) values (?,?,?,?,?,?)");
		return $stmt->execute($error_logs);
	}
	
	function agent_active($agnet_active)
	{
		$stmt = $this->con->prepare("UPDATE agents SET ct=? WHERE agent_id=?");
		$stmt->execute($agnet_active);
	}
	
	//LOGIN END
	function systemlogs($pdata)
	{
		$category		=  $pdata[0];	
		$agent_id  		=  $pdata[1];
		$modes  		=  $pdata[2];
		$action			=  $pdata[3];
		$current_times  =  $_SESSION['system']['current_time'];
		$current_dates  =  $_SESSION['system']['current_date'];
		$pro_mac_id     =  $_SESSION['system']['pro_mac_id'];
		$pinfo  		=  $_SESSION['system']['log']['pinfo'];
		$other_data  	=  $pdata[4];
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
		if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
			{
				if($_SESSION['agent']['log']['api_select']=='redbus')
					{
						$stmt = $this->con->prepare("select station_name from stations");
						$stmt->execute();
						$station=$stmt->fetchAll(PDO::FETCH_COLUMN, 0);
						$json=json_encode($station);
						return $json;
					}
				if($_SESSION['agent']['log']['api_select']=='ispace')
					{
						$stmt = $this->con->prepare("select station_name from stations_space");
						$stmt->execute();
						$station=$stmt->fetchAll(PDO::FETCH_COLUMN, 0);
						$json=json_encode($station);
						return $json;

					}
			}
		
		
	}
	
	
	function getLastPassengerDetails($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE agent_id=? ORDER BY id DESC LIMIT 0,1");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;		
	}
	
	function getStationID($origin)
	{
		if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
		{
			if($_SESSION['agent']['log']['api_select']=='redbus')
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
			if($_SESSION['agent']['log']['api_select']=='ispace')
				{
					$stmt = $this->con->prepare("select station_id from stations_space where station_name=?");
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
		}
		
		
	}
	
	function busDetailReportByDate($agent_id,$from,$to)
	{
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE agent_id=?  AND booked_on >=? AND booked_on <=? ORDER BY id DESC");	
		$data=array($agent_id,$from,$to);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	function busDetailReport($agent_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE agent_id=? ORDER BY id DESC");	
		$data=array($agent_id);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	
		function busSummaryReport($agent_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM agent_transfer_log WHERE agent_id=? ORDER BY id DESC");	
		$data=array($agent_id);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	function busDetailSummaryReport1($agent_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM agent_transfer_log WHERE agent_id=? ORDER BY id DESC LIMIT 0, 100");	
		$data=array($agent_id);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	function busDetailSummaryReportByDate($agent_id,$start_date,$end_date)
	{
		$stmt = $this->con->prepare("SELECT * FROM agent_transfer_log WHERE agent_id=? AND  created_datetime BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC");	
		$data=array($agent_id);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	function busBookingReport($agent_id)
	{
		$stmt = $this->con->prepare("SELECT id,TentativeBooking_oneway,agent_id,inventoryId,mode,travelDate,fromStationId,toStationId,fromStationName,toStationName,partialCancellation,boardingPointId,emailId,mobileNbr,passenger_name,lead_pax_name,passenger_age,passenger_fare,dateOfIssue,passenger_sex,passenger_seat,booked_on,status,total_fare,service_charge_mode,service_charges,serviceChargeValues,bus_provider,bus_type,travelsPhoneNbr,cancellationDescList,cancel_amount,PNR,RBTicketNo,BPTime,DepartureTime,RefundAmount,bus_net_amt,bus_net_amt_return,adminprofit,agprofit,tiket_no,tds,created_date,ArrivalTime,TravelHours,booking_result,blockRequest,return_booked_on,return_cancel_amount,oneway_fare,round_fare,agent_comm,agent_mark,markupBySeat,commBySeat,cancel_ip,cancel_data,commBySeat,passenger_fare FROM book_bus_tickets WHERE agent_id=? AND status=? ORDER BY id DESC");	
		$data=array($agent_id,'BOOKED');
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getbusBookingReport($agent_id,$from,$to)
	{
		
		$stmt = $this->con->prepare("SELECT id,TentativeBooking_oneway,agent_id,inventoryId,mode,travelDate,fromStationId,toStationId,fromStationName,toStationName,partialCancellation,boardingPointId,emailId,mobileNbr,passenger_name,lead_pax_name,passenger_age,passenger_fare,dateOfIssue,passenger_sex,passenger_seat,booked_on,status,total_fare,service_charge_mode,service_charges,serviceChargeValues,bus_provider,bus_type,travelsPhoneNbr,cancellationDescList,cancel_amount,PNR,RBTicketNo,BPTime,DepartureTime,RefundAmount,bus_net_amt,bus_net_amt_return,adminprofit,agprofit,tiket_no,tds,created_date,ArrivalTime,TravelHours,booking_result,blockRequest,return_booked_on,return_cancel_amount,oneway_fare,round_fare,agent_comm,agent_mark,markupBySeat,commBySeat,cancel_ip,cancel_data,commBySeat,passenger_fare FROM book_bus_tickets WHERE agent_id=? AND status=? AND booked_on >=? AND booked_on <=? ORDER BY id DESC");	
		$data=array($agent_id,'BOOKED',$from,$to);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	
	function busBookingReport_basedDate($agent_id,$from,$to)
	{

		$stmt = $this->con->prepare("SELECT id,TentativeBooking_oneway,agent_id,inventoryId,mode,travelDate,fromStationId,toStationId,fromStationName,toStationName,partialCancellation,boardingPointId,emailId,mobileNbr,passenger_name,lead_pax_name,passenger_age,passenger_fare,dateOfIssue,passenger_sex,passenger_seat,booked_on,status,total_fare,service_charge_mode,service_charges,serviceChargeValues,bus_provider,bus_type,travelsPhoneNbr,cancellationDescList,cancel_amount,PNR,RBTicketNo,BPTime,DepartureTime,RefundAmount,bus_net_amt,bus_net_amt_return,adminprofit,agprofit,tiket_no,tds,created_date,ArrivalTime,TravelHours,booking_result,blockRequest,return_booked_on,return_cancel_amount,oneway_fare,round_fare,agent_comm,agent_mark,markupBySeat,commBySeat,cancel_ip,cancel_data,commBySeat,passenger_fare FROM book_bus_tickets WHERE agent_id=? AND status=?  AND booked_on >=? AND booked_on <=? ORDER BY id DESC");	
		$data=array($agent_id,'BOOKED',$from,$to);
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	
	function getStationName($stationId)
	{
		
		if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
			{
				if($_SESSION['agent']['log']['api_select']=='redbus')
					{
						$stmt = $this->con->prepare("select station_name from stations where station_id=?");
					}
				if($_SESSION['agent']['log']['api_select']=='ispace')
					{
						$stmt = $this->con->prepare("select station_name from stations_space where station_id=?");
					}
			}
		
			
		
		$data=array($stationId);
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchColumn();
		}
		else
		return;
		
	}
      
	function addBookerDetailAgent($book_detail)
	{
		if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
			{
				if($_SESSION['agent']['log']['api_select']=='redbus')
					{
						$stmt = $this->con->prepare("INSERT INTO book_bus_tickets (TentativeBooking_oneway,agent_id,mode,travelDate,fromStationId,fromStationName,toStationName,toStationId,boardingPointId,emailId,mobileNbr,lead_pax_name,passenger_name,passenger_age,passenger_sex,passenger_seat,booked_on,status,total_fare,bus_provider,blockRequest,oneway_fare,cancellationDescList,partialCancellation,DepartureTime,ArrivalTime,TravelHours,service_charge_mode,service_charges,serviceChargeValues,markupBySeat,commBySeat,agent_comm,agent_mark,travelyarri,netServicetax,netOperatorServiceCharge) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'0','0')");
					}
				if($_SESSION['agent']['log']['api_select']=='ispace')
					{
						$stmt = $this->con->prepare("INSERT INTO book_bus_tickets (TentativeBooking_oneway,agent_id,mode,travelDate,fromStationId,fromStationName,toStationName,toStationId,boardingPointId,emailId,mobileNbr,lead_pax_name,passenger_name,passenger_age,passenger_sex,passenger_seat,booked_on,status,total_fare,bus_provider,blockRequest,oneway_fare,cancellationDescList,partialCancellation,DepartureTime,ArrivalTime,TravelHours,service_charge_mode,service_charges,serviceChargeValues,markupBySeat,commBySeat,agent_comm,agent_mark,i2space,netServicetax,netOperatorServiceCharge) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
					}
			}
		
					print_r($book_detail);exit;
		return $stmt->execute($book_detail);
	}
	function updateBookerDetail($update_detail)
	{
		$stmt = $this->con->prepare("UPDATE book_bus_tickets SET PNR=?,tiket_no=?,status=?,inventoryId=?,dateOfIssue=?,passenger_fare=? where TentativeBooking_oneway=?");
	
		$insertID='';  $agentID = '';  $agentBalance='';  $type_of_pay=''; $date = ''; $remark=''; $status=''; $time=''; $balance=''; $ag_prof='';
		$ag_mark=''; $ag_comm = ''; $debit=''; $amount=''; $tds = '';
		$stmt->execute($update_detail);
		
		$stmt0 = $this->con->prepare("SELECT id FROM book_bus_tickets WHERE TentativeBooking_oneway=?");
		$data0=array($update_detail[6]);	
		$stmt0->execute($data0);
		$res0 = $stmt0->fetchAll();
		
		foreach($res0 as $insertID0 )
		{
		$insertID = $_SESSION['agent']['insertID'] = $insertID0['id'];
		}
		
		
		$agentID = $_SESSION['agent']['log']['id'];
		$agentBalance = $_SESSION['agent']['log']['account_balance'];
		$type_of_pay = "Bus";
		$date = date('Y-m-d',time());
		$remark = 'Ticket Booked';
		$status = 'BOOKED';
		$time = date('h:i:s',time());
		
		$amount = $_SESSION['agent']['bus']['netfare'];
	
		$ag_mark = $_SESSION['agent']['bus']['agent_markup'];	
		
		//$tds = ($_SESSION['agent']['bus']['commission']*1)/100;
		//$tds=round(($_SESSION['agent']['bus']['commission']*1/100),2);
		$tds=0;
				
		$ag_comm = $_SESSION['agent']['bus']['commission'];
		
		$ag_prof = $ag_comm+$_SESSION['agent']['bus']['agent_markup']+$_SESSION['agent']['bus']['serviceChargeValues'];
		
		$debit = round($_SESSION['agent']['bus']['netfare']-$ag_prof+$_SESSION['agent']['bus']['serviceChargeValues']);
		
		$balance = round($agentBalance-$debit,2);
		
		$service_charge=$_SESSION['agent']['bus']['serviceChargeValues'];
		
		
		$update_detail1 = array($insertID,$agentID,$type_of_pay,$date,$remark,$status,$time,$balance,$ag_prof,$ag_mark,$ag_comm,$date,$debit,$amount,$service_charge,$tds);
		//echo "<pre>"; print_r($update_detail1); 
$stmt1 = $this->con->prepare("INSERT INTO agent_booking_log  ( transfer_id,agent_id,type_of_pay,date,remark,status,time,balance,ag_prof,ag_mark,ag_comm,payment_date,debit,amount,service_charge,tds) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt1->execute($update_detail1);
		
		$update_detail2 = array($balance,$agentID);
		$stmt2 = $this->con->prepare("UPDATE agents SET account_balance=? WHERE agent_id=?");
		$stmt2->execute($update_detail2);
		$reason="BUS Booked (".$update_detail[1].")";
		$log=array($agentID,$reason,$debit,$balance);
		$stmt_log = $this->con->prepare("INSERT INTO agent_transfer_log(agent_id,reason,debit,balance) values(?,?,?,?)");
		return $stmt_log->execute($log);
	}
	
	function updateEmail_sms($data)
	{
		$stmt2 = $this->con->prepare("UPDATE book_bus_tickets SET email_data=?, sms_data=? WHERE tiket_no=?");
		$stmt2->execute($data);
	}
	
	
	function getTicket($data)
	{
		$stmt = $this->con->prepare("select * from book_bus_tickets where tiket_no=? and status=? and agent_id=? ORDER BY id DESC LIMIT 0,1");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll();
		}
		else
		return $count;
		
	}
	
	
	function getTicket1($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE tiket_no=? AND status=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1)
		{
			return $stmt->fetchAll();
		}
		else
		return $count;
		
	}
	//WALLET
	function walletDeposit($deposit)
	{
		$stmt = $this->con->prepare("INSERT INTO agent_log (agent_id,balance,credit,pay_for,pay_in) values (?,?,?,?,?)");
		return $stmt->execute($deposit);
		
	}
	
	
	//// WALLET END
	function getDeposit($deposits)
	{
		$stmt = $this->con->prepare("SELECT agency_name,account_balance from agents where agent_id=?");
		$stmt->execute($deposits);
		return $stmt->fetchAll();
		
	}
	function getDepositdata($deposits)
	{
		$stmt = $this->con->prepare("SELECT agency_name,account_balance,new,dist_id,agent_name,address,state,city,pincode,email,mobile_phone,a_bus,service_charges_mode,service_charges from agents where agent_id=?");
		$stmt->execute($deposits);
		return $stmt->fetchAll();
		
	}
	
	function getDepositdatas($data)
	{
		$stmt = $this->con->prepare("INSERT INTO agent_deposit(dist_id,agent_id,credit, payment_date, branch, bankac, tcno, remark,amount, status,type_of_pay,date,time,balance,remarks) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt->execute($data);
	}
	
	
	function getDepositfulldata($deposit)
	{
		$stmt = $this->con->prepare("SELECT payment_date,remark,remarks,credit,debit,charges,balance,type_of_pay,status from agent_deposit WHERE agent_id=? ORDER BY id DESC");
		$stmt->execute($deposit);
		return $stmt->fetchAll();
		
	}
	function insertDepositdata($datas)
	{
		$stmt = $this->con->prepare("INSERT INTO agent_deposit(session_ids, agent_id, dist_id, amount , type_of_pay, date, remark, status, time, bank, branch,city , transfer_id, payment_date, credit, debit, balance, tcno, ifsccode, account_no, charges,bankac) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt->execute($datas);

	}
	function getPaymentgatewaydata($data)
	{
		$stmt = $this->con->prepare("SELECT agent_id,dist_id,balance from agent_deposit where session_ids=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
		
	}
	
	function getPaymentgatewaydataup($update_detail)
	{
		$stmt = $this->con->prepare("UPDATE agent_deposit SET status='accepted' where session_ids=?");
		return $stmt->execute($update_detail);
	}
	
	function agentwalletDeptRecord($data)
	{
		$stmt1 = $this->con->prepare("INSERT INTO agent_transfer_log(agent_id,reason,credit,balance) values(?,?,?,?)");
		return $stmt1->execute($data);
		
	}
	function agentwalletDeclRecord($data)
	{
		$stmt1 = $this->con->prepare("INSERT INTO agent_transfer_log(agent_id,reason,credit,balance) values(?,?,?,?)");
		return $stmt1->execute($data);
		
	}	
	function getPaymentgatewaydataup1($update_detail)
	{
		$stmt = $this->con->prepare("UPDATE agents SET account_balance=? where agent_id=?");
		return $stmt->execute($update_detail);
	}
	function getPaymentgatewaydataup2($update_detail)
	{
		$stmt = $this->con->prepare("UPDATE agent_deposit SET status='declined' where session_ids=?");
		return $stmt->execute($update_detail);
	}
	function getprofiledata($data1)
	{
		$stmt = $this->con->prepare("SELECT agency_name,agent_name,agency_login,agency_pass,address,state,city,country,pincode,email,office_phone,mobile_phone,pan,status,logo,alogo,cargo_office from agents where agent_id=?");
		$stmt->execute($data1);
		return $stmt->fetchAll();
		
	}
	function setprofiledata($update_detail)
	{
		//print_r($update_detail); exit;
		$stmt = $this->con->prepare("UPDATE agents SET agency_name=?,agency_login=?,agency_pass=?,address=?,state=?,city=?,country=?,pincode=?,email=?,office_phone=?,mobile_phone=?,pan=?,logo=?,alogo=?,cargo_office=?  where agent_id=?");
		return $stmt->execute($update_detail);
	}
	
	function Markup_update($data)
	{
		$stmt = $this->con->prepare("UPDATE agents SET a_bus=? where agent_id=?");
		return $stmt->execute($data);
	}
	
	function ServiceCharges_update($data)
	{
		$stmt = $this->con->prepare("UPDATE agents SET service_charges_mode=?,service_charges=? where agent_id=?");
		return $stmt->execute($data);
	}
	
	function getAgentCommissionData($bid)
	{
		$stmt = $this->con->prepare("SELECT ag_comm,ag_mark,service_charge,ag_prof,service_tax,tds,credit,debit,transfer_id,remark,balance FROM agent_booking_log WHERE transfer_id=?");
		$data=array($bid);
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count==1) 
		return $stmt->fetchAll(); 
		else
		return 0;
		
	}
	
	function getPassenger($cancel)
	{
		$stmt = $this->con->prepare("SELECT id,emailId,inventoryId,passenger_name,passenger_seat,passenger_fare,passenger_age,passenger_sex,partialCancellation,cancellationDescList,travelDate,DepartureTime,cancel_data,status,markupBySeat,commBySeat,i2space FROM book_bus_tickets WHERE tiket_no=? and agent_id=? and status=?");
		$stmt->execute($cancel);
		$count=$stmt->rowCount();
		if($count==1) 
		return $stmt->fetchAll(); 
		else
		return 0;
	}
	function updatePartialCancel($cancel)
	{
		$stmt = $this->con->prepare("UPDATE book_bus_tickets SET status=?,cancel_data=?,cancel_date=?,cancel_amount=?,RefundAmount=? WHERE tiket_no=? and agent_id=? and status=?");
		return $stmt->execute($cancel);
	}
	function updateCreditAgentLog($update_detail1)
	{
		$stmt1 = $this->con->prepare("INSERT INTO agent_booking_log  ( transfer_id,agent_id,type_of_pay,date,remark,status,time,balance,ag_mark,ag_comm,payment_date,credit,amount) values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt1->execute($update_detail1);
	}
	function updateAgentBalance($update_balance)
	{
		$stmt = $this->con->prepare("UPDATE agents SET account_balance=? WHERE agent_id=?");
		return $stmt->execute($update_balance);
	}
	function getUpdatecancel($cancel)
	{
		$stmt= $this->con->prepare("SELECT id,agent_id,inventoryId,travelDate,fromStationId,toStationId,fromStationName,toStationName,partialCancellation,boardingPointId,emailId,mobileNbr,address,passenger_name,lead_pax_name,passenger_age,passenger_fare,dateOfIssue,passenger_sex,passenger_seat,booked_on,PNR,tiket_no,service_charge_mode,service_charges,serviceChargeValues,bus_provider,commBySeat,agent_comm FROM book_bus_tickets where id=?");

	$stmt->execute($cancel);	
	return $stmt->fetchAll();
	
	}
	function insertDuplicatCancel($update_detail)
	{
		$stmt1 = $this->con->prepare("INSERT INTO book_bus_tickets (agent_id,inventoryId,travelDate,fromStationId,toStationId,fromStationName,toStationName,partialCancellation,boardingPointId,emailId,mobileNbr,address,passenger_name,lead_pax_name,passenger_age,passenger_fare,dateOfIssue,passenger_sex,passenger_seat,booked_on,PNR,tiket_no,status,cancel_data,cancel_date,cancel_amount,RefundAmount,service_charge_mode,service_charges,serviceChargeValues,bus_provider,commBySeat,agent_comm) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt1->execute($update_detail);
		return $lastId = $this->con->lastInsertId();
		
	}
	function resendSMS($tin)
	{
		$stmt = $this->con->prepare("select mobileNbr,sms_data from book_bus_tickets where tiket_no=?");
		$stmt->execute($tin);
		return $stmt->fetchAll();
	}
	function getCancelData($tin)
	{
		$stmt = $this->con->prepare("select cancel_data from book_bus_tickets where tiket_no=? AND status=?");
		$stmt->execute($tin);
		return $stmt->fetchAll();
		
	}
	function updateAgentTransferLog($log)
	{
		$stmt = $this->con->prepare("INSERT INTO agent_transfer_log(agent_id,reason,credit,balance) values(?,?,?,?)");
		return $stmt->execute($log);
		
	}
	//PREETHI REPORT
	
		function busCancelingReport($agent_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM book_bus_tickets WHERE agent_id=? AND (status=? OR status=?) ORDER BY id DESC");	
		$data=array($agent_id,'CANCELLED','Partially Cancelled');	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	
	
	function getbusCancelingReport($agent_id,$from,$to)
	{
		$stmt = $this->con->prepare("SELECT id,TentativeBooking_oneway,agent_id,inventoryId,mode,travelDate,fromStationId,toStationId,fromStationName,toStationName,partialCancellation,boardingPointId,emailId,mobileNbr,passenger_name,lead_pax_name,passenger_age,passenger_fare,dateOfIssue,passenger_sex,passenger_seat,booked_on,status,total_fare,service_charge_mode,service_charges,serviceChargeValues,bus_provider,bus_type,travelsPhoneNbr,cancellationDescList,cancel_amount,PNR,RBTicketNo,BPTime,DepartureTime,RefundAmount,bus_net_amt,bus_net_amt_return,adminprofit,agprofit,tiket_no,tds,created_date,ArrivalTime,TravelHours,booking_result,blockRequest,return_booked_on,return_cancel_amount,oneway_fare,round_fare,agent_comm,agent_mark,markupBySeat,commBySeat,cancel_ip,cancel_data,commBySeat,passenger_fare,cancel_date FROM book_bus_tickets WHERE agent_id=? AND (status=? OR status=?) AND booked_on >=? AND booked_on <=? ORDER BY id DESC");	
		$data=array($agent_id,'CANCELLED','Partially Cancelled',$from,$to);	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	
	
	function getbusCancelingReport1($agent_id)
	{
		$stmt = $this->con->prepare("SELECT id,TentativeBooking_oneway,agent_id,inventoryId,mode,travelDate,fromStationId,toStationId,fromStationName,toStationName,partialCancellation,boardingPointId,emailId,mobileNbr,passenger_name,lead_pax_name,passenger_age,passenger_fare,dateOfIssue,passenger_sex,passenger_seat,booked_on,status,total_fare,service_charge_mode,service_charges,serviceChargeValues,bus_provider,bus_type,travelsPhoneNbr,cancellationDescList,cancel_amount,PNR,RBTicketNo,BPTime,DepartureTime,RefundAmount,bus_net_amt,bus_net_amt_return,adminprofit,agprofit,tiket_no,tds,created_date,ArrivalTime,TravelHours,booking_result,blockRequest,return_booked_on,return_cancel_amount,oneway_fare,round_fare,agent_comm,agent_mark,markupBySeat,commBySeat,cancel_ip,cancel_data,commBySeat,passenger_fare,cancel_date FROM book_bus_tickets WHERE agent_id=? AND (status=? OR status=?) ORDER BY id DESC");	
		$data=array($agent_id,'CANCELLED','Partially Cancelled');	
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function insertterms($data,$data1)
	{
		$stmt1 = $this->con->prepare("SELECT * FROM ticket_terms WHERE agent_id=?");
		$stmt1->execute($data1);
		$count=$stmt1->rowCount();
		if($count==1)
		{
			$stmt = $this->con->prepare("UPDATE ticket_terms SET terms=? WHERE agent_id=?");
			return $stmt->execute($data);
		}
		else
		{
		$stmt = $this->con->prepare("INSERT INTO ticket_terms(terms,agent_id) values(?,?)");
		return $stmt->execute($data);		
		}
	}
	function getterms($data)
	{
		$stmt = $this->con->prepare("SELECT terms FROM ticket_terms WHERE agent_id=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getOunbusList($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM businfo WHERE Bus_fromcity=? AND Bus_tocity=? AND Bus_status = ?");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
        function getOunbusList1($data)
	{
	$stmt = $this->con->prepare("SELECT * FROM businfo WHERE Bus_id = ? AND Bus_fromcity=? AND Bus_tocity=? AND Bus_status = ?");
               	$stmt->execute($data);
		return $stmt->fetchAll();
	}
      function getSPID($da)
	{
        $stmt = $this->con->prepare("SELECT * FROM `agent_reqbusowner` WHERE `agent_id`=? AND `status`=?");
		$stmt->execute($da);
		return $stmt->fetchAll();
		
	}
       function getbusList($report)
	{
		$stmt = $this->con->prepare("SELECT * FROM businfo WHERE del_status=?");
		$data=array($report);	
		$stmt->execute($data); 
		return $stmt->fetchAll();
	}
        function getbusList1($report)
	{
		$stmt = $this->con->prepare("SELECT * FROM  businfo WHERE Bus_id=?");
		$data=array($report);	
		$stmt->execute($data); 
		return $stmt->fetchAll();
	}
          function getOperatorName($SPId)
	{
		
		$stmt = $this->con->prepare("select SP_name from serviceprovider_info where SP_id=?");
		$data=array($SPId);
		$stmt->execute($data);
		return $stmt->fetchAll();
		
	}
         function getStationList($sname)
	{
		
		$stmt = $this->con->prepare("select * from stations where station_id=?");
		$data=array($sname);
		$stmt->execute($data);
		return $stmt->fetchAll();
		
	}
       
        function insertRequest($req)
	{
         $stmt = $this->con->prepare("INSERT INTO agent_reqbusowner(sp_id,agent_id,bus_id,from_city,to_city,status) "
                        . "values(?,?,?,?,?,?)");
		return $stmt->execute($req);		
	}
        function removeRequest($req1)
	{
         $stmt = $this->con->prepare("DELETE FROM `agent_reqbusowner` WHERE `agent_id`=? and `bus_id`=?");
		return $stmt->execute($req1);		
	}
        function getRequestStatus($dat)
	{
		$stmt = $this->con->prepare("select * from  agent_reqbusowner WHERE agent_id = ? and bus_id = ? ");
		$stmt->execute($dat);
		$count=$stmt->rowCount();
		if($count>0)
		{
		return $stmt->fetchAll();
		}
		else 
		{
		return 0;	
		}
		
	}
	
	function get_booked_seat($data)
	{
		$u=0;
		//print_r($data);
		$stmt = $this->con->prepare("select SeatNo,Blocked from bookinginfo where Bus_id = ? and travelling_date = ? and cancelledStatus = ? ");
		$stmt->execute($data);
		$row = $stmt->fetchAll();
		$count=$stmt->rowCount();
		if($count1=0)
		{
		 while($row = $stmt->fetchAll())
			{
				$booked_seat[$u] = $row['SeatNo'];	 $u++;
			}
		}
		else
		$booked_seat=$count;
		return $booked_seat;			
	}
	function get_total_seat($data)
	{
		$i=0;
		$seat_no=array();
		$stmt = $this->con->prepare("select seat_no from bus_structure where bus_id = ? AND seat_no != ? AND seat_no !=?");
		$stmt->execute($data);	
		$rows = $stmt->fetchAll();	
		foreach($rows as $row)
		{
			 $seat_no[$i]= $row['seat_no']; 
			 $i++;
		}
		 return count($seat_no);
	}
	function getOwnBusType($data)
	{
		$stmt = $this->con->prepare("SELECT typeName FROM bustypes WHERE typeID= ? AND typeStatus = ?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function getOwnBusRouteId($data)
	{
		$stmt = $this->con->prepare("SELECT SR_id FROM service_routes WHERE SR_source =? and SR_destination = ? and SR_status=?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function Bus_structuretype($data)
	{
		$stmt = $this->con->prepare("SELECT Bus_structure FROM businfo WHERE Bus_id=?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function getBus_Structure($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM busstructuretypes WHERE structureID=? AND structureStatus = ? ORDER BY structureID ");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getBusStructure($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM bus_structure WHERE bus_id=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getOwnBusFare($data)
	{
		$stmt = $this->con->prepare("SELECT base_fare,serviceCharge,serviceTax FROM businfo WHERE bus_id=?");
		$stmt->execute($data);
		return $stmt->fetchAll();		
	}
	/* Bhuvan Cargo*/
	function getcargRes($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM cargo WHERE aws_no=? AND status=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count>0)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;
	}
	function getcargtrack($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM cargotracking WHERE aws_no=? AND NextLocation=? AND status=?");
		$stmt->execute($data);
		$count=$stmt->rowCount();
		if($count>0)
		{
			return $stmt->fetchAll();
		}
		else
		return 0;
	}
	function getcargRest($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM cargo WHERE aws_no=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getCity($data)
	{
		$stations = array();
		$stmt = $this->con->prepare("select code,location from cargo_cities WHERE code LIKE ? OR location LIKE ?");
		$stmt->execute($data);
		foreach ($stmt->fetchAll() as $row) {
			$stations[] = $row['code'].'-'.$row['location'];
		}
		$json=json_encode($stations);
		return $json;
	}
	function getVechiledets($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM vehicle WHERE id=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getListVehl($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM vehicle_tracking WHERE destination=? AND status='Ready To Transit'");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	
	function getstnId($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM cargo_cities WHERE code=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	
	function insertSendship($data)
	{
		$stmt = $this->con->prepare("INSERT INTO cargotracking (aws_no,lastLocation,NextLocation,departDateTime,expectedArrivalDate,vechile_id,status) values (?,?,?,?,?,?,?)");
		return $stmt->execute($data);		
	}
	function updateCaragain($data)
	{
		$stmt = $this->con->prepare("UPDATE cargo SET status=? WHERE aws_no=?");
		return $stmt->execute($data);
	}
	function getservicetype($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM servicetype WHERE status=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getpackagetype($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM packagetype WHERE status=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function insertSendpack($data)
	{
		$stmt = $this->con->prepare("INSERT INTO cargo (ref_no,agent_id,aws_no,consignor_name,consignor_address,consignor_pincode,consignor_email,consignor_phone,consignor_mobile,consignee_name,consignee_address,consignee_pincode,consignee_email,consignee_phone,consignee_mobile,insurance_status,insurance_details, 	origin,destination,serviceTypeCode,typeofPackageCode,measurementMode,length,width,height,weight,quantity,volumetric_surface_weight,volumetric_air_weight,chargeable_weight,priceperKG,totalPrice,deliveryType,status) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		return $stmt->execute($data);		
	}
	function getCargoReceipt($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM cargo WHERE aws_no=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getLocationByCode($data)
	{
		$stmt = $this->con->prepare("select id from cargo_cities WHERE code=?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}
	function getcaroffiname($data)
	{
		$stmt = $this->con->prepare("select code,location from cargo_cities WHERE id=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
	function getcargoReport($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM cargo WHERE agent_id=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	
	function getcargoTrReport($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM cargotracking WHERE aws_no=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getVechdet($data)
	{
		$stmt = $this->con->prepare("SELECT vehicle_number FROM vehicle WHERE id=?");
		$stmt->execute($data);
		return $stmt->fetchColumn();
	}	
	function getAbhibusCities($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM stations_abhi WHERE station_name=?");
		$stmt->execute($data);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function getBusDet($data)
	{
		$stmt = $this->con->prepare("SELECT * FROM businfo WHERE Bus_id=?");
		$stmt->execute($data);
		return $stmt->fetchAll();
	}
}	
?>