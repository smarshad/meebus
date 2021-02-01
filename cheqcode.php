<?php
require("includes/functions.php");
require("includes/mysqlclass.php");
$code=$_REQUEST['code'];
$sp_id=$_REQUEST['spid'];
$bus_id=$_REQUEST['busid'];
$sp_id1=$_REQUEST['spid1'];
$bus_id1=$_REQUEST['busid1'];
$dat=$_REQUEST['dat'];
$dat1=$_REQUEST['dat1'];
//echo "select * from bus_coupons where (coup_sp='$sp_id' or coup_sp='$sp_id1') and (coup_bus='$bus_id' or coup_bus='$bus_id1') and coup_unique='$code' and coup_status=0 and (coup_date='$dat' or coup_date='$dat1')";
$sql=mysql_query("select * from bus_coupons where (coup_sp='$sp_id' or coup_sp='$sp_id1') and (coup_bus='$bus_id' or coup_bus='$bus_id1') and coup_unique='$code' and coup_status=0 and ((coup_date<='$dat' and coup_date1>='$dat') or (coup_date<='$dat1' and coup_date1>='$dat1'))");
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