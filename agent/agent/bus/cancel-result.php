<?php 
include_once'../../server/server.php';  
$_SESSION['common']['pagename'] = "Cancel"; 
include_once '../includes/functions.php';
$obj=new agent_module($con); 
$tin=$_GET['tin']; 
$status="BOOKED";
$agent_id=$_SESSION['agent']['log']['id'];
$data=array($tin,$agent_id,$status);
$cancel=$obj->getPassenger($data);
//echo "<pre>"; print_r($cancel); echo "</pre>";
if($cancel==0)
{
	echo "This ticket is already cancelled";
	exit;
}
if(isset($_SEESION['agent']['cancel']['seat_fare']))
unset($_SEESION['agent']['cancel']['seat_fare']);
if(isset($_SESSION['agent']['cancel']['policy']))
unset($_SESSION['agent']['cancel']['policy']);

$_SESSION['agent']['cancel']['tin']=$tin;
$_SESSION['agent']['cancel']['policy'] = $cancel[0]['cancellationDescList'];

$canc_result='<div class="GODGOMDKMH">Select seats to cancel</div> 
            <hr> 
            <div>';
$passenger=explode('|A|',$cancel[0]['passenger_name']);


$seat=explode('|A|',$cancel[0]['passenger_seat']);
$travelDate=$cancel[0]['travelDate'];
$tdate = explode('/', $travelDate);
$tdate = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$DepartureTime=date("H:i", strtotime($cancel[0]['DepartureTime']));
$cancel_data=explode('^',$cancel[0]['cancel_data']);


$date=$tdate.' '.$DepartureTime;
$datetime=strtotime($date);
$fare=explode('^',$cancel[0]['passenger_fare']);
$i=0;
foreach($seat as $s)
{
	if($s!='')
	{
		$_SEESION['agent']['cancel']['seat_fare'][$s]=$fare[$i];
		$i++;
	}
}
$fareArray=$_SEESION['agent']['cancel']['seat_fare'];
$i=0;
foreach($passenger as $pass)
{

if($pass!='')
{
	//echo "<pre>"; print_r($seat); echo "<pre/>";
	//echo "<pre>"; print_r($cancel_data); echo "<pre/>";
	
$canc_result.='<span class="cancel-seat-checkbox">';
	if(!is_numeric(array_search($seat[$i], $cancel_data))) 
	{
		//echo 'a';
                    $canc_result.='<input id="seatCheck" name="seatCheck[]" value="'.$seat[$i].','.$fareArray[$seat[$i]].','.$datetime.'" type="checkbox">
                    <label><span>'.$seat[$i].'</span>   '.$pass.'</label>
                </span>
                <div class="clear"></div>';
	}
			   $i++;
}
else
$i++;
}
$canc_result.='</div>';
echo $canc_result;
?>
<script>
var i = 0;
$('input[type="checkbox"]').on('click', function() {
	 val = $(this).val();
	data=val.split(',');
	$.post( "cancel-seat-record.php?sno="+data[0]+"&pr="+data[1]+"&tm="+data[2], function( data ) {
		$(".cancel-proces-disp").html(data);
	});
});

</script>