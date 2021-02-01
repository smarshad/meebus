<?php include_once("includes/header.php"); 
error_reporting(1);
if(isset($_POST['confirm']) && $_POST['confirm']=='Confirm')
	{
		//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
		
		$refNo=$_SESSION['cargo']['office']['ReferenceNo'];
		$chargeableWeight=$_SESSION['cargo']['chargeableWeight'];
		$totalPrice=$_SESSION['cargo']['totalPrice'];
		$VolumetricAirModeWeight=$_SESSION['cargo']['VolumetricAirModeWeight'];
		$VolumetricSurfaceModeWeight=$_SESSION['cargo']['VolumetricSurfaceModeWeight'];
		$PricePerKG=$_SESSION['cargo']['PricePerKG'];
		$DoorDeliveryCharge=$_SESSION['cargo']['DoorDeliveryCharge'];
		if(isset($_POST['insurd']) && $_POST['insurd']==1)
		{
			$insurance[]=$_POST['Receivername'];
			$insurance[]=$_POST['Shipperphone'];
			$insurance[]=$_POST['Shipperdet'];
			$insurance[]=$_POST['Receiverphone'];
			$insurance[]=$_POST['Receiveraddress'];
			$insu_detail=json_encode($insurance);
		}
		else
		$insu_detail='';
		$consignor_name=$_POST['consignor_name'];
		$consignor_address=$_POST['consignor_address'];
		$consignor_pincode=$_POST['consignor_pincode'];
		$consignor_email=$_POST['consignor_email'];
		$consignor_phone=$_POST['consignor_phone'];
		$consignor_mobile=$_POST['consignor_mobile'];
		$consignee_name=$_POST['consignee_name'];
		$consignee_address=$_POST['consignee_address'];
		$consignee_pincode=$_POST['consignee_pincode'];
		$consignee_email=$_POST['consignee_email'];
		$consignee_phone=$_POST['consignee_phone'];
		$consignee_mobile=$_POST['consignee_mobile'];
		$insurd=$_POST['insurd'];
		$sender=$_POST['sender'];
		$origin=$_POST['origin'];
		$destination=$_POST['destination'];
		$serviceType=$_POST['serviceType'];
		$Shiptype=$_POST['Shiptype'];
		$measurement=$_POST['measurement'];
		$length=$_POST['length'];
		$width=$_POST['width'];
		$height=$_POST['height'];
		$weight=$_POST['weight'];
		$Qnty=$_POST['Qnty'];
		$type_dli=$_POST['type_dli'];
		
		$destinationCode=explode('-',$destination);
		$desCode=$destinationCode[0];
		$aws_no=$desCode.$serviceType.time();
	
	    $sql="insert into cargo (ref_no,office_id,aws_no,consignor_name,consignor_address,consignor_pincode,consignor_email,consignor_phone,consignor_mobile,consignee_name,consignee_address,consignee_pincode,consignee_email,consignee_phone,consignee_mobile,insurance_status,insurance_details,transferType, 	origin,destination,serviceTypeCode,typeofPackageCode,measurementMode,length,width,height,weight,quantity,volumetric_surface_weight,volumetric_air_weight,chargeable_weight,priceperKG,totalPrice,deliveryType,status) values
				('$refNo','$offid','$aws_no','$consignor_name','$consignor_address','$consignor_pincode','$consignor_email','$consignor_phone','$consignor_mobile','$consignee_name','$consignee_address','$consignee_pincode','$consignee_email','$consignee_phone','$consignee_mobile','$insurd','$insu_detail','$sender','$officeLocation','$destination','$serviceType','$Shiptype','$measurement','$length','$width','$height','$weight','$Qnty','$VolumetricSurfaceModeWeight','$VolumetricAirModeWeight','$chargeableWeight','$PricePerKG','$totalPrice','$type_dli','Pending')";
		
		echo $upd = mysql_query($sql);
		
		echo "location:cargo-receipt.php?awsNO=".$aws_no;
			if($upd)
				{
					header("location:cargo-receipt.php?awsNO=".$aws_no);
				}
			else if($upd)
				{
					header("location:sendcargo.php?ue");
				}
	}
?>