<?php 

include("../includes/mysqlclass.php");

 $q=$_GET['q']; 
?>

<select name="b_0" id="b_0" onchange="addfromboard(this.value);">
			<option value="">Boarding Point</option>
			<?php		
			//echo "select * from board_points where board_city='$q'"; 	
				$qry = mysql_query("select * from board_points where board_city='$q'") ;				
				while ($bbbord = mysql_fetch_array($qry))
				{
			?>			
			<option value="b_0---<?php echo $bbbord['board_name']; ?>"><?php echo $bbbord['board_name']; ?></option>								
			<?php }  ?>			
			</select>	

