<?php
session_start();
include("../../includes/mysqlclass.php");

$from=$_REQUEST['from'];

$city=mysql_fetch_array(mysql_query("select * from cities where city_name='$from'"));
$to_id=$city['id'];

$bus_qry="SELECT * FROM service_routes,cities WHERE service_routes.SR_status=1 AND cities.id=service_routes.SR_destination AND cities.del_status!=0 AND service_routes.SR_source=".$to_id." group by service_routes.SR_destination order by cities.city_name asc";

$bus_query=mysql_query($bus_qry);

$_SESSION['toarray']=array();
while($bus=mysql_fetch_array($bus_query)){
	array_push($_SESSION['toarray'],$bus['city_name']);
}

if(!empty($_SESSION['toarray'])) {
	echo "ok";
}

?>