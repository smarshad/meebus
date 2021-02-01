<?php 

include("../includes/mysqlclass.php");

 $q=$_GET['q']; 
?>
<select name="d_0" id="d_0" onchange="addtoboard(this.value);">
			<option value="">Dropping Point</option>
			<?php		
			//echo "select * from board_points where board_city='$q'"; 	
				$qry = mysql_query("select * from board_points where board_city='$q'") ;				
				while ($bbord = mysql_fetch_array($qry))
				{
			?>			
			<option value="d_0---<?php echo $bbord['board_name']; ?>"><?php echo $bbord['board_name']; ?></option>								
			<?php }  ?>			
			</select>	

