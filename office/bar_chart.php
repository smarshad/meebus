<?php require_once('maxChart.class.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title>Max's Chart</title>
   <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <div id="container">
   
      <div id="header" style="text-align:center; font-size:14px; font-weight:bold; color:#333333; ">Ticket Count</div>
  
      <div id="main">
         <?php
          
			$qry="select * from serviceprovider_info";
			$sel_qry=mysql_query($qry);
			while($fet_row=mysql_fetch_array($sel_qry))
			{
			$tic_count=mysql_num_rows(mysql_query("SELECT * FROM bookinginfo WHERE cancelledStatus = 0 and pay_status='1' and SP_id='$fet_row[SP_id]'"));
			 $sp_name=$fet_row['SP_name']."<br>";
			 
			$data1[$sp_name]=$tic_count;
			}
			
			
            $mc1 = new maxChart($data1);
            $mc1->displayChart('',0,500,150,true);
            
           // echo "<br/><br/>";
           


         ?>
         
      </div>
      <div id="footer"></div>
   </div>
   
</body>