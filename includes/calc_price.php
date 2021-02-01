<?php
session_start();
if($_GET['mes']='mtr')
{
	$weight=$_GET['weight'];
	$length=$_GET['length'];
	$width=$_GET['width'];
	$height=$_GET['height'];
	$qnty=$_GET['Qnty'];
	$measurement_cargo=($length*$width*$height)*$qnty;
	$chargeableWeight=$measurement_cargo/.006;
}
if($_GET['mes']='cm')
{
	$weight=$_GET['weight'];
	$length=$_GET['length'];
	$width=$_GET['width'];
	$height=$_GET['height'];
	$qnty=$_GET['Qnty'];
	$measurement_cargo=($length*$width*$height)*$qnty;
	$chargeableWeight=$measurement_cargo/6000;
}
$_SESSION['cargo']['chargeableWeight']=$chargeableWeight;
$AmtToPay=$chargeableWeight*20;
if(isset($_GET['type_dli']) && $_GET['type_dli']=='DD')
{
	$_SESSION['cargo']['DoorDeliveryCharge']=$DDCharge=10;
	$AmtToPay+=$DDCharge;
}
else
$_SESSION['cargo']['DoorDeliveryCharge']=0;
$_SESSION['cargo']['totalPrice']=$AmtToPay;
$_SESSION['cargo']['VolumetricAirModeWeight']=$VolumetricAirModeWeight=$measurement_cargo/5000;
$_SESSION['cargo']['VolumetricSurfaceModeWeight']=$VolumetricSurfaceModeWeight=$measurement_cargo/4500;
$_SESSION['cargo']['PricePerKG']=20;
$html='<p><span>Volumetric Surface Mode Weight :</span> <span>'.$VolumetricSurfaceModeWeight.'</span></p>
        <p><span>Volumetric Air Mode Weight : </span> <span>'.$VolumetricAirModeWeight.'</p>
        <p><span>Chargable Weight : </span> <span>'.$chargeableWeight.'</span></p>
		<p><span>Price per KG :</span> <span>Rs.20</span></p>';
		if(isset($_GET['type_dli']) && $_GET['type_dli']=='DD')
		{
			$html.='<p><span>Door Delivery Charge:</span> <span> Rs.'.$DDCharge.'</span></p>';
		}
        $html.='<p><span>Total Price:</span> <span> Rs.'.$AmtToPay.'</span></p>';
		$html.='^^<strong>Delivery Info : </strong><p>Expected Delivere Date: '.date('d D M Y',strtotime('+1 day',strtotime(date('Y-m-d')))).'</p>';
echo $html;