<?php
session_cache_limiter("private, must-revalidate");
session_start();
ob_start();
ini_set('max_execution_time', 3000);
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors',0);

session_cache_expire(15);
$cache_expire = session_cache_expire();
require_once("../config/config.php");
include_once("..includes/functions.php");
$_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);
$city1=mysql_fetch_array(mysql_query("select * from cities where city_name='$_REQUEST[ter_from]'"));
$city2=mysql_fetch_array(mysql_query("select * from cities where city_name='$_REQUEST[tag]'"));
$from_city		= $city1["id"];
$to_city		= $city2["id"];
$journey_date	= date("d-m-Y",strtotime($_REQUEST["datepicker"]));
$dat=date("Y-m-d",strtotime($_REQUEST["datepicker"]));
$trip_type=$_REQUEST['triptype'];
$val_Dateeee=date("Y-m-d",strtotime($_REQUEST["datepicker"]));

?>

<?php
$ress=mysql_query("select * from bookinginfo where pay_status=3");
while($del=mysql_fetch_array($ress))
{
$value = strtotime($del['book_time'])."<br>";
$cur_time=time()."<br>"; 
$time_diff=($value-$cur_time)."<br>"; 
$minutes = floor($time_diff % 3600 / 60);
if($minutes>25)
{
mysql_query("delete from bookinginfo where auto_id='$del[auto_id]'");
}
}
?>


<?php
if(isset($_SESSION['ticket_id'])){
		 unset($_SESSION['book_var']);         
		 unset($_SESSION['ticket_id']);
		  unset($_SESSION['total_seats']);    
}
?>










<?php if($trip_type==1) { 
$sssga=date('Y-m-d');
if(isset($_REQUEST['search']))
{
$str_val="";
$sp=$_REQUEST['sp'];
$lux_item=$_REQUEST['lux_item'];
$board_point=$_REQUEST['board_point'];
$drop_point=$_REQUEST['drop_point'];
$bus_type=$_REQUEST['bus_type'];

$sp_fetch=mysql_fetch_array(mysql_query("select * from serviceprovider_info where SP_name='$sp' and SP_status=1"));
$sp_val=$sp;

$lux_fetch=mysql_fetch_array(mysql_query("select * from bus_luxitem where lux_name='$lux_item' and lux_status=0"));
$lux_val=$lux_item;

$type_fetch=mysql_fetch_array(mysql_query("select * from bustypes where typeName='$bus_type' and del_status =1"));
$type_val=$bus_type;


$city_val1=mysql_fetch_array(mysql_query("select * from cities where city_name='$_REQUEST[ter_from]'"));
$from_city1 = $city_val1["id"];

$city_val2=mysql_fetch_array(mysql_query("select * from cities where city_name='$_REQUEST[tag]'"));
$to_city1= $city_val2["id"]; 

if($sp_val!="")
{
if($str_val == "")
{
$str_val=" and SP_id=$sp_val";
}
else
{
$str_val.=" and (SP_id=$sp_val)";
}

}


if($lux_val!="")
{
if($str_val == "")
{
$str_val=" and luxury_item=$lux_val";
}
else
{
$str_val.=" and (luxury_item=$lux_val)";
}

}

if($type_val!="")
{
if($str_val == "")
{
$str_val=" and Bus_type=$type_val";
}
else
{
$str_val.=" and (Bus_type=$type_val)";
}

}

if($board_point !="")
{
//echo "testing"; exit;
if($str_val == "")
{
$str_val=" and Bus_boarding_time like '%$board_point%'";
}
else
{
$str_val.=" and (Bus_boarding_time like '%$board_point%')";
}
}



if($drop_point!="")
{

if($str_val == "")
{
$str_val=" and Bus_departure_time like '%$drop_point%'";
}
else
{
$str_val.=" and (Bus_departure_time like '%$drop_point%')";
}
}
$select = "SELECT * FROM businfo WHERE (`Bus_fromcity` = ".$from_city1." and `Bus_tocity` = ".$to_city1.") and Bus_status = 1";
$bussql_1=mysql_query($select);

}

else
{


$select = "SELECT * FROM businfo WHERE (`Bus_fromcity` = ".$from_city." and `Bus_tocity` = ".$to_city.") and Bus_status = 1  ";
$bussql_1=mysql_query($select);
}

$flag_gan=0;$json =  array();
?>

<?php if(mysql_num_rows($bussql_1)>0) { 
		while($row=mysql_fetch_array($bussql_1)){	
		$bus_id=$row['Bus_id'];
		$bus_name=$row['Bus_name'];
		$sp_id=$row['SP_id'];
		$bus_type=$row['Bus_type'];
		$bus_fare=$row['Bus_fare'];
		$lux_item=$row['luxury_item'];
		$src=$row['Bus_fromcity'];
		$des=$row['Bus_tocity'];
		$image=$row['bus_image'];
		
		
		$drop=$row['Bus_departure_time'];
		$departure = explode(",",$row['Bus_departure_time']);
		 $dep_time=explode("--",$departure[0]);	
		
		$board = explode(",",$row['Bus_boarding_time']);		
        $board_time=explode("--",$board[0]);	
	
		$dat=changedateformat($journey_date);	  
		$booked_seat = get_booked_seat($bus_id,$dat);
		$total_seat = get_total_seat($bus_id);
		$tot_seat=count($total_seat); 
		$bok_seat=count($booked_seat);
		if(count($booked_seat)!=0 && count($total_seat)!=0){
		$available_seat = array_diff($total_seat,$booked_seat);
		}
		else{
		$available_seat=$total_seat;
		}
		
		if(count($total_seat) > 0)
		{
		
		$dp_t=str_replace(" ","",$board_time[1]);
		
		
		$dat=str_replace(" ","",$dat);
		
		$dep=strtotime($dat." ".$dp_t);	
			
		$cur_time=strtotime(date("Y-m-d g:ia"));
		
		
		if($dep > $cur_time){	
		$flag_gan=1;			
		
		$bus_id1.= $bus_id.',';				

$busdata_travel[] = get_SP_name($sp_id); 
$busdata_name[] =  $bus_name; 
$busdata_type[] = get_bus_type($bus_type); 

$lux_fet=mysql_query("select * from bus_luxitem where lux_id IN ($lux_item) and lux_status=0"); 
while($row_luxx=mysql_fetch_array($lux_fet))
 {
$busdata_lux[] = $row_luxx['lux_name'].","; 
}
$busdata_boarding[] =$board_time[1]; 

$length=count($board);
for($i=0; $i<$length; $i++) 
{ 
$busdata_boardingdata[] = $board[$i]; 
 }
$busdata_dep_time[]  = $dep_time[1]; 

$lengt=count($departure);
for($k=0; $k<$lengt; $k++) 
	{ 
	 $busdata_departure[] = $departure[$k]; 
	}

$busdata_bus_fare[] = $bus_fare; 
$busdata_seatavailable[] = count($available_seat);
$str=explode("-",$dat);
$d=$str[0];
$m=$str[1];
$y=$str[2];
if(count($available_seat)>0)
{
if(isset($_SESSION['total_seats'])=="") {  } else {  } 
} else {  }  


} 
				 }}
				 
				$bus_id1 =  trim($bus_id1, ",");
				$mqry   = "SELECT * FROM businfo as a,bustypes as b WHERE a.Bus_status = 1 and a.Bus_id IN (".$bus_id1.") and a.Bus_type=b.typeID"; 
$mem_rs = mysql_query($mqry);
$json =  array();
$a=0;

while($row = mysql_fetch_assoc($mem_rs))
	{
	        $json[$a]['id'] = $row['Bus_id'];
			$json[$a]['Bus_type'] = $row['typeName'];
			$json[$a]['Bus_structure'] = $row['Bus_structure']; 
			$json[$a]['Bus_name'] = $row['Bus_name'];
			$json[$a]['Bus_boarding_time'] = $row['Bus_boarding_time']; 
			$json[$a]['Bus_departure_time'] = $row['Bus_departure_time'];
			$json[$a]['Bus_fare'] = $row['Bus_fare']; 
			$json[$a]['vip_fare'] = $row['vip_fare'];
                        $board_time= explode("--",$row['Bus_boarding_time']);
                        $dept_time= explode("--",$row['Bus_departure_time']);
			$json[$a]['Bus_totalseats'] = $row['Bus_totalseats']; 
			   $json[$a]['conditions'] = $row['conditions'];
                        $booked_seat = get_booked_seats($row['Bus_id'],$dat);
                        $cnt=count($booked_seat);
                        $json[$a]['booked_seat_count'] = $cnt;
                        
                        for($i=0;$i<$cnt;$i++){
                         if($i==0){$booked_seats.= $booked_seat[$i];}else{
                         $booked_seats.= ','. $booked_seat[$i];}
                        }
                        $json[$a]['booked_seat'] = $booked_seats;
                        $json[$a]['boarding_time'] = $board_time[1];
                        $json[$a]['Departure_time'] = $dept_time[1];
                        $json[$a]['Bus_availableseats'] = $row['Bus_totalseats']-$cnt;
                        $booked_seats='';
			$a++;
	}
	//echo $booked_seats;
echo json_encode($json, JSON_UNESCAPED_SLASHES);
				 
				 } 
				 else {
				 $flag_gan=1;
                                  echo json_encode($json,1);
				 //return "No Bus";
				 }
if($flag_gan==0){
echo json_encode($json,1);
//return "No Bus";
}


} 
?>


