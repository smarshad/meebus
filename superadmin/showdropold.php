<?php 

include("../includes/mysqlclass.php");

 $q=$_GET['q']; 
?>
<select name="d_0" id="d_0">
			<option value="">Boarding Point</option>
			<?php		
			//echo "select * from board_points where board_city='$q'"; 	
				$qry = mysql_query("select * from board_points where board_city='$q'") ;				
				while ($bbord = mysql_fetch_array($qry))
				{
			?>			
			<option value="<?php echo $bbord['board_name']; ?>" <?php if($bbord['board_id']==$_REQUEST['board_point']) { echo 'selected="selected"'; } ?> ><?php echo $bbord['board_name']; ?></option>								
			<?php }  ?>			
			</select>	

