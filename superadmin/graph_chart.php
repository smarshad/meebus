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
          
			//$qry="select * from serviceprovider_info";
			$qryy="SELECT * FROM bookinginfo WHERE cancelledStatus = 0";
			$sel_qryy=mysql_query($qryy);
			$sel_count=mysql_num_rows($sel_qryy);
			
	
            $data['Ticket COunt'] = $sel_count;
          
         
            $mc = new maxChart($data);
            $mc->displayChart('',1,150,500);
            echo "<br/><br/>";
            
           // echo "<br/><br/>";
           


         ?>
         
      </div>
      <div id="footer"></div>
   </div>
   
</body>