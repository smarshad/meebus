<?php
include_once'../../server/server.php'; 
include_once "../../bus/bus-library/SSAPICaller.php";
include_once "../../bus/bus-library/BlockRequest.php";
include_once '../includes/functions.php';
$agent_id=$_SESSION['agent']['log']['id'];
$tin=$_SESSION['agent']['cancel']['tin'];
$passenger_seat=$_SESSION['seatNoData'];
$status='BOOKED';

$obj=new agent_module($con);  
$cancelled_seat=implode(",",$_SESSION['seatNoData']);
$pass_data=array($tin,$agent_id,$status);
$cancel_detail=$obj->getPassenger($pass_data);
$passenger=explode('|A|',$cancel_detail[0]['passenger_name']);
$seat=explode('|A|',$cancel_detail[0]['passenger_seat']);
$passenger=explode('|A|',$cancel_detail[0]['passenger_name']);
$age=explode('|A|',$cancel_detail[0]['passenger_age']);
$gender=explode('|A|',$cancel_detail[0]['passenger_sex']);
$passenger_fare=explode('^',$cancel_detail[0]['passenger_fare']);
$markupBySeat=explode('|A|',$cancel_detail[0]['markupBySeat']);
$commBySeat=explode('|A|',$cancel_detail[0]['commBySeat']);
$canData=explode('^',$cancel_detail[0]['cancel_data']);
$cancel_cou=0;
if($cancel_detail!=0)
{
	$CancelTicket=cancelString($passenger_seat,$tin);
	unset($_SESSION['cancel']['refund']);
	unset($_SESSION['cancel']['cancel_charge']);
	unset($_SESSION['cancel']['tin']);
	$_SESSION['cancel']['refund']			=	$CancelTicket['refundAmount'];
	$_SESSION['cancel']['cancel_charge']	=	$CancelTicket['cancellationCharge'];
	$_SESSION['cancel']['tin']				=	$CancelTicket['tin'];
}

$cancel_data=$cancel_detail[0]['cancel_data'];
$cancel_cou=0;
if($cancel_detail[0]['cancel_data']!='')
$cancel_cou=count(explode('^',$cancel_detail[0]['cancel_data'])).'<br />';
$cancel_count=$cancel_cou+count($passenger_seat);
$SeatMarkup=0;
$seatComm=0;
foreach ($passenger_seat as $val)
{
	if(($key = array_search($val, $seat)) !== false) 
	{
		$SeatMarkup+=$markupBySeat[$key];
		$seatComm+=$commBySeat[$key];
		$cancel_dat[]=$seat[$key];
	}
}
$can_data1=$cancel_dat;
if(isset($canData) && $canData[0]!='')
foreach ($canData as $val)
{
	$can_data1[]=$val;
}
$cancel_data=implode('^',$cancel_dat);
if(count($passenger)==$cancel_count)
{
	$status='Fully CANCELLED';
	$status11='CANCELLED';
}
else
{
	$status='BOOKED';
	$status11='Partially Cancelled';
}
$passenger_name=implode('|A|',$passenger);
$fare=implode('|A|',$passenger_fare);
$pass_seat=implode('|A|',$seat);
$pass_gender=implode('|A|',$gender);
$pass_age=implode('|A|',$age);
$pass_gender=implode('|A|',$gender);
$refund_amount=$_SESSION['cancel']['refund']-$seatComm-$SeatMarkup;
$cancel_charge=$_SESSION['cancel']['cancel_charge'];


$user_refund=$_SESSION['cancel']['refund'];
$cancel_date=date('Y-m-d h:i:s A',time());
$type_of_pay = "Bus";
$date = date('Y-m-d',time());
$remark = 'Ticket Cancelled';
$status1 = 'CANCELLED';
$time = date('h:i:s',time());
$transeferID=$cancel_detail[0]['id'];
$_SESSION['agent']['log']['account_balance']=$balance=$current_balance = $obj->getAgentBalance($_SESSION['agent']['log']['id'])+$refund_amount;
$ag_mark=$SeatMarkup;
$ag_comm=$seatComm;
$credit=$refund_amount;
$amount=$user_refund;
if($CancelTicket!='')
{
	$update_cancel=array($transeferID);
	$duplicate=$obj->getUpdatecancel($update_cancel);
	foreach($duplicate as $d)
	{
		$booking_id=$d['id'];
		$agent_id=$d['agent_id']; 
		$inventoryId=$d['inventoryId'];
		$travelDate=$d['travelDate'];
		$fromStationId=$d['fromStationId'];
		$toStationId=$d['toStationId'];
		$fromStationName=$d['fromStationName'];
		$toStationName=$d['toStationName'];
		$partialCancellation=$d['partialCancellation'];
		$boardingPointId=$d['boardingPointId'];
		$emailId=$d['emailId'];
		$mobileNbr=$d['mobileNbr'];
		$address=$d['address'];
		$passenger_name=$d['passenger_name'];
		$lead_pax_name=$d['lead_pax_name'];
		$passenger_age=$d['passenger_age'];
		$passenger_fare=$d['passenger_fare'];
		$dateOfIssue=$d['dateOfIssue'];
		$passenger_sex=$d['passenger_sex'];
		$passenger_seat=$d['passenger_seat'];
		$booked_on=$d['booked_on'];
		$service_charge_mode=$d['service_charge_mode'];
		$service_charges=$d['service_charges'];
		$serviceChargeValues=$d['serviceChargeValues'];
		$bus_provider=$d['bus_provider'];
		$PNR=$d['PNR'];
		$tiket_no=$d['tiket_no'];
		$commBySeat=$d['commBySeat'];
		$agent_comm=$d['agent_comm'];
	}
	$insert_cancel=array($agent_id,$inventoryId,$travelDate,$fromStationId,$toStationId,$fromStationName,$toStationName,$partialCancellation,$boardingPointId,$emailId,$mobileNbr,$address,$passenger_name,$lead_pax_name,$passenger_age,$passenger_fare,$dateOfIssue,$passenger_sex,$passenger_seat,$booked_on,$PNR,$tiket_no,$status11,$cancel_data,$cancel_date,$cancel_charge,$user_refund,$service_charge_mode,$service_charges,$serviceChargeValues,$bus_provider,$commBySeat,$agent_comm);
	$res=$obj->insertDuplicatCancel($insert_cancel);
	$updat_candata=implode('^',$can_data1);
	$data=array($status,$updat_candata,$cancel_date,$cancel_charge,$user_refund,$tin,$agent_id,'BOOKED');
	$cancel_result=$obj->updatePartialCancel($data);
	$update_detail = array($res,$agent_id,$type_of_pay,$date,$remark,$status1,$time,$balance,$ag_mark,$ag_comm,$date,$credit,$amount);
	$reason="Bus Cancellataion (".$tin.")";
	$log=array($agent_id,$reason,$credit,$balance);
	$ag_log=$obj->updateAgentTransferLog($log);
	$update_log=$obj->updateCreditAgentLog($update_detail);
	$update_balance=array($balance,$agent_id);
	$update_b=$obj->updateAgentBalance($update_balance);
	echo $cancel_charge."^".$user_refund."^".$_SESSION['cancel']['tin'];
	
}
function cancelString($passenger_seat,$tin)
{
    $cancelRequest = '{"tin":"' . $tin . '",';
    foreach ($passenger_seat as $val)
    {
        if (!empty($val))
		{
			$cancelRequest.='"seatsToCancel":["' . $val . '"],';
		}
    }
    $cancelRequest = substr("$cancelRequest", 0, -1);
    $cancelRequest.='}';
    $CancelTicket = json_decode(cancelTicket($cancelRequest));
	return $CancelTicket = objectToArray($CancelTicket);
}
function objectToArray($object)
{
    if (!is_object($object) && !is_array($object))
    {
        return $object;
    }
    if (is_object($object))
    {
        $object = get_object_vars($object);
    }
    return array_map('objectToArray', $object);
}
unset($_SESSION['price']);
unset($_SESSION['seatNoData'][$key]);
?>