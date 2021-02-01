<?php
require("../includes/functions.php");
require("../includes/mysqlclass.php");
	
	$SP_name = mysql_real_escape_string($_REQUEST['sp_name']);
	
	if($SP_name != "")
	{	
		$qry = mysql_query("select * from serviceprovider_info where SP_name = '".$SP_name."' ");
		$num = mysql_num_rows($qry);
		
		if($num > 0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
		
	}
 else
  {
  ?>
  <font color="red"> <?php echo "Service Provider Name Cannot Have Special Characters"; ?></font>
  <?php } ?>