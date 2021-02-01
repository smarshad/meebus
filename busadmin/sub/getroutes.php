<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
//print_r($_REQUEST);
if(isset($_REQUEST['fromid'])) {
   $fromid=$_REQUEST['fromid'];
   $tot_city=array(); $i=0;
   $city = mysql_query("select station_id from stations where station_id!=".$fromid." order by station_name");
   while($g=mysql_fetch_array($city)){
   $tot_city[$i]=$g['station_id']; $i++;
   }
   
  
   $route=mysql_query("select station_id from stations where station_id = ".$fromid); 
   if(mysql_num_rows($route)>0){
    $route_list=array(); $j=0;
   	   while($p=mysql_fetch_array($route)){
	   $route_list[$j]=$p['station_id'];
	   $j++;
	   }
   }
   else{
    	$route_list=array('a');
       }
   $dest_list = array_intersect($route_list, $tot_city);
   sort($route_list);
   
   ?>
     <!-- <select name="to_list[]" id="to_list" multiple="multiple" size="20">
   <?php
	   $v=mysql_query("SELECT * FROM stations where station_id!=".$fromid." order by station_name");
	   while($e=mysql_fetch_array($v)){
	   if(!in_array($e['station_id'],$dest_list)){
	   ?>
	   <option value="<?php echo $e['station_id']; ?>"><?php echo $e['station_name']; ?></option>	   
	   <?php
	   }
       }
	?>
	</select>
	|| -->
	
	<table width="80%" border="0" cellspacing="3" cellpadding="2" align="center">
  <tr>
    <td align="left" width="">
<fieldset class="table-bor">
<legend>Select Destination City</legend>
<div id="tolist">
<select name="to_list[]" id="to_list" multiple="multiple" size="20">
   <?php
	   $v=mysql_query("SELECT * FROM stations where station_id!=".$fromid." order by station_name");
	   while($e=mysql_fetch_array($v)){
	   if(!in_array($e['station_id'],$dest_list)){
	   ?>
	   <option value="<?php echo $e['station_id']; ?>"><?php echo $e['station_name']; ?></option>	   
	   <?php
	   }
       }
	?>
	</select>
</div>
</fieldset>	
	</td>
	<td valign="middle"><input type="button" name="submit" value="Add >>" onclick="return val();" /></td>
    <td valign="top">
	<div id="list_dest">
	<?php view_routes_table($fromid); ?>
    </div>
    </td>
  </tr>
</table>
	<?php
	
  }
  else {
  header("location: ../service_routes.php");
  }
?>