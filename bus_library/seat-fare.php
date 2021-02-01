<?php
include_once "../server/server.php";
include "../includes/pdo_functions.php";
$obj=new user_module($con);
$SeatLayout=$_SESSION['user']['SeatLayout'];
/*echo "<pre>";
print_r($SeatLayout);
echo "</pre>";*/
$seatName=$_POST['id'];
if(isset($_SESSION['user']['selectedSeat']))
$selectedSeat=$_SESSION['user']['selectedSeat'];
$i=0;
$f=0;
if(isset($selectedSeat))
foreach($selectedSeat as $seat)
{
	if($seat==$seatName)
	{	$key=array_search($seatName,$_SESSION['user']['selectedSeat']);
		unset($_SESSION['user']['selectedSeat'][$key]);
		$f=1;
	}
	$i++;
}

	if($f!=1)
	{
		$_SESSION['user']['selectedSeat'][]=$seatName;
	}	
	if(count($_SESSION['user']['selectedSeat'])!=0)
	{
		$selectedSeat=$_SESSION['user']['selectedSeat'];
		$totalfare=0;
		$totalFareWithTaxes=0;
		foreach($SeatLayout as $s)
		{
			foreach($selectedSeat as $seat)
			{
				if($seat==$s['id'])
				{
					$_SESSION['user']['seatFare'][]=$s['fare'];
					$_SESSION['user']['totalFareWithTaxes'][]=$s['totalFareWithTaxes'];
					$_SESSION['user']['seat']['ac'][]=$s['ac'];
					$_SESSION['user']['seat']['sleeper'][]=$s['sleeper'];
					$_SESSION['user']['seat']['ladiesSeat'][]=$s['ladiesSeat'];
				$totalfare+=$s['fare'];
				$totalFareWithTaxes+=$s['totalFareWithTaxes'];
				}
			}
		}
		$_SESSION['user']['totalfare']['totalFareWithTaxes']=$totalFareWithTaxes;
echo implode(',',$_SESSION['user']['selectedSeat']).'^'.$_SESSION['user']['totalFare']=$totalfare;
	}
	else
	echo '-^'.$_SESSION['user']['totalFare']=0;
exit;
?>