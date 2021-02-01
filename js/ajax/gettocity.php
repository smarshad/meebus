<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
if(isset($_REQUEST['to_id'])){
   $to_id=mysql_real_escape_string($_REQUEST['to_id']); 
   
   $bus_qry="SELECT * FROM service_routes,cities WHERE service_routes.SR_status=1 and cities.id=service_routes.SR_destination and cities.del_status!=0 ";
   
   if($to_id!='all'){
      $bus_qry.=" AND service_routes.SR_source=".$to_id;
     }
    $bus_qry.=" group by service_routes.SR_destination order by cities.city_name asc";
   ?>
	<select name="ter_to" id="ter_to" style="border:1px solid #7f9db9; background-color:#fff; font-size: 11px; width: 150px; color: black; height: 20px; padding:2px;">
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