<?php
error_reporting(1);
include_once '../../server/server.php'; 
$mode='agent';
unset($_SESSION['split_seat']);
if($mode=='agent')
{
	include_once '../../agent/includes/functions.php';
	$obj=new agent_module($con); 
	$agent_balance=$obj->getAgentBalance($_SESSION['agent']['log']['id']);
 	$seatName=$_POST['id']; 
	$agent_markup= $_SESSION['agent']['log']['markup'];
	$agent_commission= $_SESSION['agent']['log']['commission'];
	$admin_markup= $_SESSION['agent']['log']['bus_markup'];
}
$seatArr=$_SESSION['agent']['bus']['seat_LYT'];

// print_r($seatArr);
$i=0;
 foreach($seatArr as $seat)
 {
	 if($seatName==$seat['name'])
	 {
	 	$selectedSeat=$seatArr[$i];
	 	
	 }
	 $i++;
 }
 $seat=$selectedSeat['name'];

 if($_SESSION['agent']['bus']['seat']['seatName'][$seat]!='' && isset($_SESSION['agent']['bus']['seat']['seatName'][$seat]))
 {
	 $fare=$obj->agentMarkup($selectedSeat['fare'],$agent_markup,$admin_markup);
	 unset($_SESSION['agent']['bus']['seat']['seatName'][$seat]);
	 unset($_SESSION['agent']['bus']['seat']['fare'][$seat]);
	 unset($_SESSION['agent']['bus']['seat']['agent_fare'][$seat]);
	  unset($_SESSION['agent']['bus']['seat']['agent_markup_report'][$seat]);
	   unset($_SESSION['agent']['bus']['seat']['commission_report'][$seat]);
	 $_SESSION['agent']['bus']['netfare']=$_SESSION['agent']['bus']['netfare']-$fare;
	 $_SESSION['agent']['bus']['agent_markup']-=$agent_markup;
	 $agent_comm=(($selectedSeat['fare']+$admin_markup)*$agent_commission)/100;
	 $_SESSION['agent']['bus']['commission']-=$agent_comm;
	 $unselect=1;
 }
 else
 { 
	if(count($_SESSION['agent']['bus']['seat']['seatName'])<6)
 	{
	
	 $fare=$obj->agentMarkup($selectedSeat['fare'],$agent_markup,$admin_markup);
	 if($agent_balance>=$_SESSION['agent']['bus']['netfare']+$fare)
	 {	 $agent_comm=(($selectedSeat['fare']+$admin_markup)*$agent_commission)/100;
		 $_SESSION['agent']['bus']['agent_markup']+=$agent_markup;
		 $_SESSION['agent']['bus']['agent_markup_report'][$seat]=$agent_markup;
		 $_SESSION['agent']['bus']['commission_report'][$seat]=round(($agent_comm),2);
		 $_SESSION['agent']['bus']['commission']+=$agent_comm;
		 $_SESSION['agent']['bus']['seat']['fare'][$seat]=$selectedSeat['fare'];
		 $_SESSION['agent']['bus']['seat']['agent_fare'][$seat]=$fare;
		 $_SESSION['agent']['bus']['seat']['seatName'][$seat]=$selectedSeat['name'];
		 $_SESSION['agent']['bus']['seat']['ladies'][$seat]=$selectedSeat['ladiesSeat'];
		 $_SESSION['agent']['bus']['netfare']=$_SESSION['agent']['bus']['netfare']+$fare;
		 $unselect=1;
	 }
	 else
	 {
		 $msg='Your account balance is not sufficient to select this seat';
	 	 $unselect=2;
	 }
	}
	else
 	{
		$unselect=0;
	//exit;
	}
 }

 $seat_Name=implode('|',$_SESSION['agent']['bus']['seat']['seatName']); 

if($_SESSION['agent']['log']['service_charge_mode']=='%')
{
	$_SESSION['agent']['bus']['serviceChargeValues'] = 	($_SESSION['agent']['bus']['netfare']*$_SESSION['agent']['log']['service_charges'])/100;
}
else 
{
	$_SESSION['agent']['bus']['serviceChargeValues'] = $_SESSION['agent']['log']['service_charges'];
}
 
$passenger_detail='';

if(count($_SESSION['agent']['bus']['seat']['seatName'])>0)
{
	$ing = 1;
	foreach($_SESSION['agent']['bus']['seat']['seatName'] as $seat)
		{ 
			$passenger_detail.='<div class="span12" style="margin-left:0">	               
	<div class="span4">
		<div class="control-group">
			<div class="controls">
				<input type="text" placeholder="Passanger Name" name="passenger_name[]" id="passenger_name_'.$ing.'" class="input-large focused name">
			</div>
		</div>
	</div>
	<div class="span2">
		<div class="control-group">
			<div class="controls">
				<input type="text" placeholder="Age" id="passenger_age_'.$ing.'" name="age[]" class="input-large focused seat-no">
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="control-group">
			<div class="controls">
				<select id="passenger_gender_'.$ing.'" class="gen" name="gender[]">
					<option value="">Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>                                  
				</select>
			</div>
		</div>
	</div>
	<div class="span1">
		<div class="control-group">
			<div class="controls">
				<label for="focusedInput" class="control-label seat-no text-center">'.$_SESSION['agent']['bus']['seat']['seatName'][$seat].'</label>
			</div>
		</div>
	</div>
	<div class="span2">
		<div class="control-group">
			<div class="controls">
				<label for="focusedInput" class="control-label fare">'.$_SESSION['agent']['bus']['seat']['agent_fare'][$seat].'</label>
			</div>
		</div>
	</div>
</div>';
$ing++;
}
$tmp_total_fare = $_SESSION['agent']['bus']['netfare']+$_SESSION['agent']['bus']['serviceChargeValues'];
//TDS Calculation Start
//$tds=round(($_SESSION['agent']['bus']['commission']*1/100),2);
$tds=0;

//TDS Calculation End

$commistion = round($_SESSION['agent']['bus']['commission'],2);

//<br/>Markup : '.$_SESSION['agent']['bus']['agent_markup'].'<br/>

$passenger_detail.='<div class="span12 text-center bot">                                        							
	<button class="btn btn-primary" type="submit" id="booking_sub" onclick="return BookingValidation();">Book Now</button>
</div>
<div class="span12 text-center bot">                                        							
	<span>Fare Amount + Service Charges : '.$tmp_total_fare.'</span><br/>
		<span class="showagent" style="display:none;">Tds 0% : '.$tds.'</span><br/>
		<span class="showagent" style="display:none;">Commision : '.$commistion.'<br/>
		
		Service Charge : '.$_SESSION['agent']['bus']['serviceChargeValues'].'</span><br />
	<span class="seat-error showagent" style="display:block;">'.$msg.'</span>
	<input type="checkbox" id="showagentck" name="showagentck" value="show"  style="display:none;" onclick="return showagentfun(1);" />
<input type="checkbox" id="showagentck1" name="showagentck1" value="hide" onclick="return showagentfun(0);" />
</div>'; 
}
else
{
	$passenger_detail.='<div class="span12 text-center bot"><span class="seat-error">'.$msg.'</span></div>'; 
}

$_SESSION['split_seat'] = implode('^',$_SESSION['agent']['bus']['seat']['agent_fare']); 
echo $_SESSION['agent']['bus']['netfare'].'^'.$seat_Name.'^'.$passenger_detail.'^'.count($_SESSION['agent']['bus']['seat']['seatName']).'^'.$unselect;
?>


<?php /*?><script type="text/javascript">
function showMe (it, box) {
  var vis = (box.checked) ? "block" : "none";
  document.getElementById(it).style.display = vis;
}
</script><?php */?>
