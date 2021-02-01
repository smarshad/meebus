<?php
require("../includes/functions.php");
require("../includes/mysqlclass.php");
$code=$_REQUEST['code'];
$sp_id=$_REQUEST['spid'];
$bus_id=$_REQUEST['busid'];
$fare=$_REQUEST['fare'];
$dat=$_REQUEST['dat'];


//echo "select * from bus_coupons where coup_sp='$sp_id' and coup_bus='$bus_id' and coup_unique='$code' and coup_status=0 and coup_date<='$dat' and coup_date1>='$dat'";


$sql=mysql_query("select * from bus_coupons where coup_sp='$sp_id' and coup_bus='$bus_id' and coup_unique='$code' and coup_status=0 and coup_date<='$dat' and coup_date1>='$dat'");
$count=mysql_num_rows($sql);
if($count>0)
{
$promo=mysql_fetch_array($sql);
$percent=$promo['coup_perc']; 
$coup_id=$promo['coup_id']; 
$dis_per=($fare*($percent/100));
$discount=($fare-$dis_per);

echo "<div style='padding:20px 20px 20px 20px; font-size:12px;'>Your Total fare is  <span style='color:#0573C0; font-weight:bold; '>Rs.".$fare."</span><br><br>Discount Rate for your Promotional Code is <span style='color:#0573C0; font-weight:bold;'>".$percent." %</span><br><br> Discount amount from your Total fare is  <span style='color:#0573C0; font-weight:bold;'>Rs.".$dis_per."</span><br><br> Total fare to pay is <span style='color:#0573C0; font-weight:bold;'>Rs. ".$discount."</span><br><input type='hidden' name='fare' id='fare' value='$discount' /><input type='hidden' name='total_amt' id='total_amt' value='$discount' /><input type='hidden' name='coupp' id='coupp' value='$code' /><input type='hidden' name='disamount' id='disamount' value='$dis_per' /><input type='hidden' name='couppid' id='couppid' value='$coup_id' /></div>";

}
else
{
echo "";
}
?>