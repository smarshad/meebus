<?php 		
include_once("../includes/pdo_connect.php");		
include_once("../includes/cargo_functions.php");
$obj=new cargo($con);
$officeid=$_SESSION['offid'];  
$getVechilelist=$obj->getListVehl(array($officeid));
foreach($getVechilelist as $listvec)
{ ?>
<input type="radio" name="vec_id" value="<?php echo $listvec['vehicle_id']; ?>"/>
<?php $vechid=$listvec['vehicle_id'];
$vechiledet=$obj->getVechiledets(array($vechid));
$vechiledet=$vechiledet[0];
echo $vechiledet['vehicle_number']; ?>
<?php } 
				  
?>