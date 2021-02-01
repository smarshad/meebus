<?php
     require("../../includes/functions.php");
     require("../../includes/mysqlclass.php");
	 if(isset($_REQUEST['source'])){
	    $source=$_REQUEST['source'];
		$qry=mysql_query("SELECT SR_Destination FROM service_routes where SR_source=".$source." AND SR_status=1");
		?>
		<select id="toCity" name="toCity" class="combobox" onchange="showdrop(this.value);">
		<option value="">Select Destination Place</option>
		<?php
		while($row=mysql_fetch_array($qry)){
		?>
		<option value="<?php echo $row['SR_Destination'] ?>"><?php echo get_city_name($row['SR_Destination']);  ?></option>
		<?php
		}
		?>
		</select>
		<?php
	 }
?>