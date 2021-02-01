<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
if(isset($_REQUEST['sp_id'])){
   $SP_id=mysql_real_escape_string($_REQUEST['sp_id']);
   
   $bus_qry="SELECT * FROM businfo ";
   
   if($SP_id!='all'){
      $bus_qry.=" WHERE SP_id=".$SP_id;
     }
   $bus_qry.=" ORDER BY Bus_name ASC";
   ?>
	<select name="bus_list" id="bus_list" onChange="searchBlockseats();">
	<option value="all">--Select Bus Name--</option>
	<?php
	$bus_query=mysql_query($bus_qry);
	while($bus=mysql_fetch_object($bus_query)){
	?>
	<option value="<?php echo $bus->Bus_id; ?>"><?php echo $bus->Bus_name; ?></option>
	<?php } ?>
	</select>   
   <?php
}
?>