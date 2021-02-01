<?php
include_once("includes/header.php");
include_once("../includes/pdo_connect.php");
include_once("../includes/cargo_functions.php");
$obj=new cargo($con);
$officeid=$_SESSION['offid'];
//echo "<pre>";print_r($getVechilelist);echo "</pre>";exit;
if(isset($_POST['arrived']) && $_POST['arrived']=='Arrived')
{
	$trac_id=$_POST['trac_id'];
	$data=array('Arrived','0',$trac_id);
	$obj->updateTrst($data);
	header('location:vechile-mgt.php');
}
?>
<style>
	.fk-text-center{text-align:left}
	.order-details-MP .orderDetails-tracking .item-img-div{width:250px}
	.unit h6{margin:5px 0;font-size:12px}
	.order_item_row_0 .vtop.product-info .prod {width: 25%;}				  
	.order_item_row_0 .vtop.product-info .gran {width: 8%;}
	.order_item_row_0 .vtop.product-info .del {width: 22%;}
	.order_item_row_0 .vtop.product-info .sub {width: 17%;}
	li.send_shipdet{width:25%;float:left;padding:10px 0}
	.tt-dropdown-menu {top: 38px !important;width: 173px;}
	thead{background: #f5f5f5;color: #000;height: 30px;text-align: center;}
	tbody{color: #000;height: 32px;}
</style>  
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/typeahead.min.js"></script>
<body onLoad="search_Usr();">

<fieldset class="table-bor">
<legend><strong>Vechile Management </strong></legend> 
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="table-border">
        <thead>      
          <tr>
            <td><strong>S No</strong></td>
            <td><strong>Vehicle Name</strong></td>
            <td><strong>Vehicle Number</strong></td>
            <td><strong>Fuel Level</strong></td>
            <td><strong>Destination</strong></td>
          </tr>
        </thead>
        <tbody>
<?php
$i=1;
$getVechilelist=$obj->getVechileList(array($officeid,'Arrived'));
foreach($getVechilelist as $vechilelist)
{ 
//echo "<pre>";print_r($data);echo "</pre>";exit;
?>                  
          <tr>
            <td><?php echo $i; ?></td>
            <?php 
			$getVechiledet=$obj->getVechiledet(array($vechilelist['vehicle_id']));
			$getVechiledet=$getVechiledet[0];
			//echo "<pre>";print_r($getVechiledet);echo "</pre>";exit; ?>
            <td><?php echo $getVechiledet['vehicle_name']; ?></td>
            <td><?php echo $getVechiledet['vehicle_number']; ?></td>
            <td><?php echo $getVechiledet['currentFuel_level']; ?></td>
            <td><form method="post" action="desination_assign.php"><input type="text" id="destn" name="destn" /><br/>
            <input type="hidden" value="<?php echo $vechilelist['id']; ?>" name="trcid" />
            <input type="hidden" value="<?php echo $vechilelist['vehicle_id']; ?>" name="vecle_id" />
            <input type="submit" id="submit" name="submit" class="btn" value="Submit"></form></td>
          </tr>          
 <?php $i++; } ?>          
        </tbody>
        </table>       	
		</fieldset>
<fieldset class="table-bor" style="margin-top: 20px;">
<legend><strong>Vechile Tracking </strong></legend> 
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="table-border">
        <thead>      
          <tr>
            <td><strong>S No</strong></td>
            <td><strong>Vehicle Name</strong></td>
            <td><strong>Vehicle Number</strong></td>
            <td><strong>Fuel Level</strong></td>
            <td><strong>Destination</strong></td>
          </tr>
        </thead>
        <tbody>
<?php
$i=1;
$getVechileli=$obj->getVechileList11(array($officeid,'In Transit'));
foreach($getVechileli as $vecst)
{ 
//echo "<pre>";print_r($data);echo "</pre>";exit;
?>                  
          <tr>
            <td><?php echo $i; ?></td>
            <?php 
			$getVechiledet=$obj->getVechiledets(array($vecst['vehicle_id']));
			$getVechiledet=$getVechiledet[0];
			//echo "<pre>";print_r($getVechiledet);echo "</pre>";exit; ?>
            <td><?php echo $getVechiledet['vehicle_name']; ?></td>
            <td><?php echo $getVechiledet['vehicle_number']; ?></td>
            <td><?php echo $getVechiledet['currentFuel_level']; ?></td>
            <td><form method="post" action="">
            <input type="hidden" value="<?php echo $vecst['id']; ?>" name="trac_id" />
            <input type="submit" id="submit" name="arrived" class="btn" value="Arrived"></form></td>
          </tr>          
 <?php $i++; } ?>          
        </tbody>
        </table>       	
		</fieldset>        
</body>
<?php include "includes/footer.php"; ?>
<script>
$('#destn').typeahead({
    name: 'destn',
	 remote: {
            url : '../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
</script>