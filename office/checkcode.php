<?php
require("../includes/functions.php");
require("../includes/mysqlclass.php");
$code=$_REQUEST['code'];
$sp_id=$_REQUEST['spid'];
$bus_id=$_REQUEST['busid'];
$dat=$_REQUEST['dat'];
//echo "select * from bus_coupons where coup_sp='$sp_id' and coup_bus='$bus_id' and coup_unique='$code' and coup_status=0 and (coup_date<='$dat' and coup_date1>='$dat')";
$sql=mysql_query("select * from bus_coupons where coup_sp='$sp_id' and coup_bus='$bus_id' and coup_unique='$code' and coup_status=0 and coup_date<='$dat' and coup_date1>='$dat'");
$count=mysql_num_rows($sql);

if($count>0)
{
echo "";
}
else
{
echo "<span style='color:#FF0000; font-size:12px;'>Please check your Promotion Code</span>";
}
?>