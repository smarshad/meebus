<?php
require("../includes/functions.php");
require("../includes/mysqlclass.php");
$bussid=$_REQUEST['busid'];
$seat=$_REQUEST['seat'];
$travel1=$_REQUEST['dat']; 

$seat_avail=mysql_num_rows(mysql_query("select * from bookinginfo where Bus_id='$bussid' and SeatNo=$seat and travelling_date='$travel1' and Blocked=1")); 

//$time=time();
if($seat_avail==0)
{

$qry = mysql_query("insert into bookinginfo (Bus_id, SeatNo, travelling_date, Blocked, pay_status, book_time) values ('".$bussid."', '".$seat."', '".$travel1."', '1', '3',NOW()) ");
echo " "."#"."<input type='submit' id='submit' name='submit' value=' Continue ' onclick='return validate_seats(this.form);' />";
}
else
{
echo "<div class='alert_error'>Seat '".$seat."' are in Booking Process....</div>"."#"." ";
 }
 ?>  