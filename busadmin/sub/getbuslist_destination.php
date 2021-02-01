<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
if(isset($_REQUEST['to_id'])){
   $to_id=mysql_real_escape_string($_REQUEST['to_id']); 
   
   $bus_qry="SELECT * FROM service_routes WHERE SR_status=1";
   
   if($to_id!='all'){
      $bus_qry.=" AND SR_source=".$to_id;
     }
    $bus_qry.=" group by SR_destination";
   ?>
	<select name="ter_to" id="ter_to">
	<option value="none">--Select To--</option>
	<?php
	$bus_query=mysql_query($bus_qry);
	while($bus=mysql_fetch_object($bus_query)){
	?>
	<option value="<?php echo $bus->SR_destination; ?>"><?php echo get_city_name($bus->SR_destination); ?></option>
	<?php } ?>
	</select>   
   <?php
}
?>