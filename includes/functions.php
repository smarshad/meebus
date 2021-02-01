<?php
	class boxes{
		function fn_box_open($title){
			$head_cont = '<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">';
			$head_cont .= '<tr><td valign="top" width="28" align="center"><img src="./images/box_left_top.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" width="28" height="41" /></td><td valign="middle" height="41" style="background:url(./images/box_top_bg.jpg) repeat-x #FFFFFF" align="center" class="box_head">'.$title.'</td><td valign="top" width="28" align="center"><img src="./images/box_right_top.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" width="28" height="41" /></td></tr>';
			$head_cont .= '<tr><td valign="top" width="28" style="background:url(./images/box_left_bg.jpg) repeat-y #FFFFFF"></td><td valign="top">';				
			return $head_cont;
		}
		
		function fn_box_open_blue($title){
			$blue_head_cont = '<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">';
			$blue_head_cont .= '<tr><td valign="top" width="28" align="center"><img src="./images/box_left_top.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" width="28" height="41" /></td><td valign="middle" height="41" style="background:url(./images/box_top_bg.jpg) repeat-x #FFFFFF" align="left" class="box_head_blue">'.$title.'</td><td valign="top" width="28" align="center"><img src="./images/box_right_top.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" width="28" height="41" /></td></tr>';
				$blue_head_cont .= '<tr><td valign="top" width="28" style="background:url(./images/box_left_bg.jpg) repeat-y #FFFFFF"></td><td valign="top">';				
			return $blue_head_cont;
		}
		
		
		function fn_box_close(){
			$body_cont = '</td><td valign="top" width="28" style="background:url(./images/box_right_bg.jpg) repeat-y #FFFFFF"></td></tr>';
			$body_cont .= '<tr><td valign="bottom" width="28" height="7"><img src="./images/box_left_bottom.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" /></td><td valign="bottom" height="7" style="background:url(./images/box_bottom_bg.jpg) repeat-x #FFFFFF"><img src="./images/box_bottom_bg.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" /></td><td valign="bottom" width="28" height="7"><img src="./images/box_right_bottom.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" /></td></tr></table>';
			return $body_cont;
		}
		
	}
	
	function db_get_array($sel_qry)
	{
		if($sel_qry != "")
		{
			$sql_qry = mysql_query($sel_qry) or die(mysql_error());
			$count = mysql_num_rows($sql_qry);
			if($count > 0)
			{
				while($rs_qry = mysql_fetch_array($sql_qry))
				{
					$arr_res[] = $rs_qry;
				}
			}
		}
		
		return $arr_res;
	}
/********************************************************************************************************************************/

function getServiceprovider(){
$qry=mysql_query("SELECT * FROM serviceprovider_info ");
return $qry;
}


function get_cancelpolicy_qry($policy_id)
{
	$p_qry = mysql_query("select * from cancellation_policies where cancelpolicy_id = $policy_id ");
	$row = mysql_fetch_array($p_qry);	
	return $row;
}

function get_cancelpolicy()
{
	$p_qry = mysql_query("select * from cancellation_policies ");
	$row = mysql_fetch_array($p_qry);	
	return $row;
}


function get_SP_name($sp_id)
{  //Get Single Service Provider Name

	$sp_sql=mysql_query("SELECT * FROM serviceprovider_info where SP_id=".$sp_id);
	
	$sp_num_rows=mysql_num_rows($sp_sql);
	
	if($sp_num_rows==1)
	{
	   $sp=mysql_fetch_array($sp_sql);
	   return $sp['SP_name'];
	}
	else{
	header("location:home.php");
	}
}
function get_SP_name1($sp_id)
{  //Get Single Service Provider Name

	$sp_sql=mysql_query("SELECT * FROM serviceprovider_info where SP_id=".$sp_id);
	
	$sp_num_rows=mysql_num_rows($sp_sql);
	
	if($sp_num_rows==1)
	{
	   $sp=mysql_fetch_array($sp_sql);
	   return $sp['SP_name'];
	}
	
}
/********************************************************************************************************************************/	
	function get_agent_name($ag_id)
	{
		if($ag_id != "0" && $ag_id != "" )
		{
			
			$sel = "SELECT ag_company FROM tbl_agents WHERE agent_id = $ag_id";
			$arr = db_get_array($sel);
			$agent_name = ucfirst($arr[0]["ag_company"]);
			
			return $agent_name;
		}
	}
	
	function get_bus_type($type_id)
	{
		if($type_id != "0" && $type_id != "" )
		{
			
			$sel = "SELECT typeName FROM bustypes WHERE typeID='$type_id' AND typeStatus = 1";
			$arr = db_get_array($sel);
			$bus_type = ucfirst($arr[0]["typeName"]);
			
			return ucwords($bus_type);
		}
	}

	function get_bus_name($bus_id)
	{
		if($bus_id != "0" && $bus_id != "all" )
		{
			$sel = "SELECT Bus_name FROM businfo WHERE Bus_id='$bus_id'";
			$arr = db_get_array($sel);
			$bus_type = ucfirst($arr[0]["Bus_name"]);			
			return $bus_type;
		}
	}


	function get_bus_details($bus_id)
	{
		if($bus_id != "0" && $bus_id != "all" )
		{
			$sel = "SELECT * FROM businfo WHERE Bus_id='$bus_id'";
			$arr = db_get_array($sel);			
			return $arr;
		}
	}

	
	function get_city_name($city_id)
	{
		if($city_id != "0" && $city_id != "" )
		{
			 $sel = "SELECT station_name FROM stations WHERE station_id = $city_id";
			$arr = db_get_array($sel);
			$city_name = ucfirst($arr[0]["station_name"]);
			
			return $city_name;
		}
	}
	
	
		
	function get_lux_item($lux_id)
	{
		if($lux_id != "0" && $lux_id != "" )
		{
			$sel = "SELECT * FROM bus_luxitem WHERE lux_status=0";
			$arr = db_get_array($sel);
			$lux_name = ucfirst($arr[0]["lux_name"]);
			
			return $lux_name;
		}
	}
	
	function get_board($bus_id)
	{
	
		if($bus_id != '0' && $bus_id != "" )
		{			
		
			$sel1 = mysql_query("SELECT boarding_id,time FROM tbl_boarding WHERE bus_id = $bus_id AND status = 1");
			
			while($arr_board = mysql_fetch_array($sel1))
			{
			
				$sel = mysql_fetch_array(mysql_query("SELECT boarding FROM tbl_boardinginfo WHERE id = $arr_board[boarding_id] AND status = 1"));
				$val .= $sel['boarding'].'^^'.$arr_board['time'].'^^' ;
			}
			
			return $val ;
					
		}
		
	}
	
	
	function get_booked_seat($bus_id,$dat)
	{
	 $u=0;
		if($bus_id != "" && $dat != "Select Date")
		{
			$sel = mysql_query("select SeatNo,Blocked from bookinginfo where Bus_id = $bus_id and (travelling_date = '$dat') and cancelledStatus = '0' ") or die(mysql_error());
			 while($row = mysql_fetch_array($sel))
	     	{
				echo $booked_seat[$u] = $row['SeatNo'];	 $u++;
			}
			return $booked_seat;			
		}
	}

function get_booked_seats($bus_id,$dat)
	{
	
	 $u=0;
		if($bus_id != "" && $dat != "Select Date")
		{
			$sel = mysql_query("select SeatNo,Blocked from bookinginfo where Bus_id = $bus_id and (travelling_date = '$dat' ) and cancelledStatus = '0'") or die(mysql_error());
			 while($row = mysql_fetch_array($sel))
	     	{
				$booked_seat[$u] = $row['SeatNo'];	 $u++;
			}
			return $booked_seat;			
		}
	}
	
	
	function get_total_seat($bus_id)
	{
		$i=0;
			$sel = mysql_query("select seat_no from bus_structure where bus_id = $bus_id and seat_no != 'xx' and seat_no !='' ") or die(mysql_error());
			 while($row = mysql_fetch_array($sel))
	     	{
		 		 $seat_no[$i]= $row['seat_no']; $i++;
			}
		 return $seat_no;
	}
	
	
		
	function get_boarding_info($city_id)
	{
		if($city_id != "0" && $city_id != "" )
		{			
			$sel = "SELECT * FROM tbl_boarding WHERE city_id = $city_id AND status = 1";
			$arr_boarding = db_get_array($sel);
			return $arr_boarding;
		}
	}

	function ag_get_boarding_info($city_id,$ag_id)
	{
		if($city_id != "0" && $city_id != "" )
		{			
			$sel = "SELECT * FROM tbl_boarding WHERE city_id = $city_id AND agent_id = $ag_id AND status = 1";
			$arr_boarding = db_get_array($sel);
			return $arr_boarding;
		}
	}


	function get_drop($bus_id)
	{
	
		if($bus_id != '0' && $bus_id != "" )
		{			
		
			$sel1 = mysql_query("SELECT dropping_id,time FROM tbl_dropping WHERE bus_id = $bus_id AND status = 1");
			
			while($arr_drop = mysql_fetch_array($sel1))
			{
			
				$sel = mysql_fetch_array(mysql_query("SELECT dropping FROM tbl_droppinginfo WHERE id = $arr_drop[dropping_id] AND status = 1"));
				$val .= $sel['dropping'].'^^'.$arr_drop['time'].'^^' ;
			}
			
			return $val ;
					
		}
		
	}
	
	
	function get_dropping_info($city_id)
	{
		if($city_id != "0" && $city_id != "" )
		{			
			$sel = "SELECT * FROM tbl_dropping WHERE city_id = $city_id AND status = 1";
			$arr_dropping = db_get_array($sel);
			return $arr_dropping;
		}
	}
	
	function ag_get_dropping_info($city_id,$ag_id)
	{
		if($city_id != "0" && $city_id != "" )
		{			
			$sel = "SELECT * FROM tbl_dropping WHERE city_id = $city_id AND agent_id = $ag_id AND status = 1";
			$arr_dropping = db_get_array($sel);
			return $arr_dropping;
		}
	}
	
	function get_boarding_name($board_id)
	{
		if($board_id != "0" && $board_id != "" )
		{			
			$sel = "SELECT boarding_name FROM tbl_boarding WHERE id = $board_id AND status = 1";
			$arr_boarding = db_get_array($sel);			
			$boarding_name = ucfirst($arr_boarding[0]["boarding_name"]);
			return $boarding_name;
		}
	}
	
	function get_dropping_name($drop_id)
	{
		if($drop_id != "0" && $drop_id != "" )
		{			
			$sel = "SELECT dropping_name FROM tbl_dropping WHERE id = $drop_id AND status = 1";
			$arr_dropping = db_get_array($sel);			
			$dropping_name = ucfirst($arr_dropping[0]["dropping_name"]);
			return $dropping_name;
		}
	}

// To get the page url (1)
function curPageURL() 
{
 $pageURL = 'http';
  if (!empty($_SERVER['HTTPS'])) {if($_SERVER['HTTPS'] == 'on'){$pageURL .= "s";}}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}  

/*
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return GetFileDir($pageURL);
}
*/
// To get the page url without filename (2)
function GetFileDir($php_self){
$filename = "";
$filename2 = "";
$filename = explode("/", $php_self); // THIS WILL BREAK DOWN THE PATH INTO AN ARRAY
for( $i = 0; $i < (count($filename) - 1); ++$i ) {
$filename2 .= $filename[$i].'/';
}
return $filename2;
}

function curPageURLs() {
 $pageURL = 'http';
 if (!empty($_SERVER['HTTPS'])) {if($_SERVER['HTTPS'] == 'on'){$pageURL .= "s";}}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


//Get Random Characters
function getRandomCharString($length, $lower = true, $upper = true, $nums = true, $special = true)
{
    $pool_lower = 'abcdefghijklmopqrstuvwxyz';
    $pool_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pool_nums = '0123456789';
    $pool_special = '!$%^&*+#~/|';

    $pool = '';
    $res = '';

    if ($lower === true) {
        $pool .= $pool_lower;
    }

    if ($upper === true) {
        $pool .= $pool_upper;
    }

    if ($nums === true) {
        $pool .= $pool_nums;
    }

    if ($special === true) {
        $pool .= $pool_special;
    }

    if (($length < 0) || ($length == 0)) {

        return $res;
    }

    srand((double) microtime() * 1000000);

    for ($i = 0; $i < $length; $i++) 
	{
        $charidx = rand() % strlen($pool);
        $char = substr($pool, $charidx, 1);
        $res .= $char;
    }

    return $res;
}


function stripFilenameFromUrl($url) 
{
   // Drop any query strings
   $qmark = strpos($url, '?');
   if ($qmark) 
   {
      $url = substr($url, 0, $qmark);
   }
    $lastSlash = (strrpos($url, '/'));
    return substr($url, 0, ($lastSlash + 1));
}



/////////////////////////////////

function getcompanyname($compid){
//return "SELECT * FROM tbl_company where comp_id=".$compid." and comp_status=1";
$compsql=mysql_query("SELECT comp_name FROM tbl_company where comp_id=".$compid." and comp_status=1");
$comparr=mysql_fetch_array($compsql);
return $comparr['comp_name'];
}

function getbustype($type){
$typesql=mysql_query("SELECT type from tbl_bus_type where id=".$type." and status=1");
$typearr=mysql_fetch_array($typesql);
return $typearr['type'];
}

function getbusinfo_type($busid){
$selbusinfo=mysql_query("SELECT bus_type from tbl_businfo WHERE id=".$busid);
$bus=mysql_fetch_array($selbusinfo);
return getbustype($bus['bus_type']);
}


function getboardingid($busid){
$b_id=mysql_fetch_array(mysql_query("SELECT boarding_id FROM tbl_boarding where bus_id=".$busid." and status=1 order by id LIMIT 0,1"));
return $b_id['boarding_id'];
}

function getboardingpoints($busid,$from,$to){
$boardingid=getboardingid($busid);
$b_sql=mysql_fetch_array(mysql_query("SELECT boarding from tbl_boardinginfo where id=".$boardingid." and from_id=".$from." and to_id=".$to." and status=1 order by id limit 0,1"));
return $b_sql['boarding'];
}

function getboardingtime($busid){
$boardingid=getboardingid($busid);
$time=mysql_fetch_array(mysql_query("SELECT time FROM tbl_boarding where bus_id=".$busid." and boarding_id=".$boardingid." and status=1 LIMIT 0,1"));
return $time['time'];
}

function getdroppingid($busid){
$d_id=mysql_fetch_array(mysql_query("SELECT dropping_id FROM tbl_dropping where bus_id=".$busid." and status=1 LIMIT 0,1"));
return $d_id['dropping_id'];
}

function getdroppingpoint($busid,$from,$to){
$droppingid=getdroppingid($busid);
$d_sql=mysql_fetch_array(mysql_query("SELECT dropping from tbl_droppinginfo where id=".$droppingid." and from_id=".$from." and to_id=".$to." and status=1"));
return $d_sql['dropping'];
}

function getdroppingtime($busid){
$droppingid=getdroppingid($busid);
$time=mysql_fetch_array(mysql_query("SELECT time FROM tbl_dropping where bus_id=".$busid." and dropping_id=".$droppingid." and status=1 LIMIT 0,1"));
return $time['time'];
}


function checkseatcount($compid,$busid,$from,$to,$traveldate)
{
$traveldate=changedateformat($traveldate);
$seatcountsql=mysql_query("SELECT * FROM tbl_businfo where id=".$busid." and status=1");
$seatarr=mysql_fetch_array($seatcountsql);
$totseats=$seatarr['seats'];
$adminseats=$seatarr['admin_seats'];
$compseats=$seatarr['company_seats'];
$totseats=$totseats-($adminseats+$compseats);
if($totseats>0){
$bookinginfo_sql=mysql_query("SELECT * FROM tbl_booking_info where comp_id=".$compid." and bus_id=".$busid." and from_city=".$from." and to_city=".$to." and travel_date='".$traveldate."'");
	if(mysql_num_rows($bookinginfo_sql)!=0){	 
		 while($s=mysql_fetch_array($bookinginfo_sql)){
			$totseats=$totseats-$s['total_seats']; // subtract from total seats	
		 }
	}
	else{
		$totseats; // nothing done.
	}
}
return $totseats;
}

function changedateformat($str){
$arr=explode("-",$str);
return $arr[2]."-".$arr[1]."-".$arr[0];
}

function getfare($busid){
$selfare=mysql_query("SELECT total_fare FROM tbl_businfo where id=".$busid);
$fare=mysql_fetch_array($selfare);
return $fare['total_fare'];
}

//////////////////////////////////////////////////////// Service Routes  ///////////////////////////////////////////////////////
function add_destination($v,$from){
 $ins_qry=mysql_query("INSERT INTO service_routes (SR_source,SR_destination,SR_status) VALUES ($from,$v,1)") or die(mysql_error());
}

function view_routes_table($fromid){
$str='';

   $route=mysql_query("select SR_destination from service_routes where SR_source = ".$fromid); 
   if(mysql_num_rows($route)>0){
    $route_list=array(); $j=0;
   	   while($p=mysql_fetch_array($route)){
	   $route_list[$j]=$p['SR_destination'];
	   $j++;
	   }
   }
   else{
    	$route_list=array('a');
       }
   
 sort($route_list);
$f=0;
	$str='<fieldset class="table-bor"><legend><b>Available Destinations</b></legend>';
	$str.='From <b class="suc_msg">'.get_city_name($fromid).'</b>';
	$str.='<table width="100%" cellspacing="5" cellspacing="5" align="center">';
	foreach($route_list as $g){
	$str.='<tr>';
	if($g!="a"){
	$f=1;
	$str.='<td><!--<input type="checkbox" name="chk[]" id="chk" title="Select '.get_city_name($g).'" value="'.$g.'">--></td><td><a href="service_routes.php?cityid='.$g.'" title="Routes From '.get_city_name($g).'">'.get_city_name($g).'</a></td> 
	<td>
	<!--<a href="javascript:void(0)" onclick="alert(\' This is Demo version !!! \')"><img src="../images/minus_icon.png" align="left" title="Delete '.get_city_name($g).'" border="0"></a>-->
	<a href="javascript:void(0)" onclick="del_destinationSingle('.$fromid.','.$g.');"><img src="../images/minus_icon.png" align="left" title="Delete '.get_city_name($g).'" border="0"></a></td>';
	}
	else{
	$str.='<span class="err_msg">Not found</span>'; 
	}
	$str.='</tr>';
	} 
	
	if($f==1){
	   $str.='<!--<tr><td></td><td><input type="button" value="Delete Selected" onclick="del_destinationsMore('.$fromid.');"></td></tr>-->';
	}
	$str.='</table></fieldset>';
	echo $str;
}


//////////////////////////////////////////////////////// Service Providers  ///////////////////////////////////////////////////////
function getBuscount($sp_id){
$qry=mysql_query("SELECT * FROM businfo where SP_id=".$sp_id);
return mysql_num_rows($qry);
}

function getRoutecount($sp_id){
$qry=mysql_query("SELECT * FROM businfo where SP_id=".$sp_id." GROUP BY SR_id");
return mysql_num_rows($qry);
}

function chk_SP_area($de,$spid){
//$x=base64_decode($de);
  if($de == $spid){
       return $de;
      } 
	else{
	   return 0;
	}  
}

//////////////////////////////////////////////////////// Bus Management  //////////////////////////////////////////////////////////
function getSources(){
$qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
return mysql_fetch_array($qry);
}

function getRouteID($source,$destination){
$qry=mysql_query("SELECT SR_id FROM service_routes WHERE SR_source=".$source." AND SR_destination=".$destination);
$r=mysql_fetch_array($qry);
return $r['SR_id'];
}

function getStructureName($id){
$qry=mysql_query("SELECT structureType FROM busstructuretypes WHERE structureID=".$id);
$r=mysql_fetch_array($qry);
return $r['structureType'];
}

//////////////////////////////////////////////////////// Block / Unblock Management ///////////////////////////////////////////////

function numberofBlockedSeats($SP_id,$Bus_id,$date){
 $qry=mysql_query("SELECT * FROM bookinginfo WHERE SP_id=".$SP_id." AND Bus_id=".$Bus_id." AND travelling_date='".$date."' AND Blocked=1 ");
 return mysql_num_rows($qry);
}

function checkThisSeat($Bus_id,$dat,$seatno){
$qry=mysql_query("SELECT Blocked FROM bookinginfo WHERE Bus_id=".$Bus_id." AND travelling_date='".$dat."' AND SeatNo='".$seatno."'") or die(mysql_error());
 if(mysql_num_rows($qry)==1){
      $arr=mysql_fetch_array($qry);
	  return $arr['Blocked'];
 }
 else 
  return 0;
}

function chkallThis($Bus_id,$dat){
  $qry=mysql_query("SELECT SeatNo FROM bookinginfo WHERE Bus_id=".$Bus_id." AND travelling_date='".$dat."' AND (Blocked=1 OR Blocked=0) AND BlockedBy=".$_SESSION['accessing_LogID']." AND BlockedType=".$_SESSION['accessing_type']) or die(mysql_error());
  $a=array();
   if(mysql_num_rows($qry)>0){
      while($arr=mysql_fetch_array($qry))
            {
			  $a[]=$arr['SeatNo'];
			}
	  return $a;
   }
   else
      return $a;
}


//////////////////////////////////////////////////////// ticket cancel Management ///////////////////////////////////////////////

function passenger_info($ticket){
 $qry=mysql_query("SELECT * FROM passengerinfo WHERE cancelledStatus=0 and Ticket_ID='".$ticket."'");
 return $qry;
}

function ticket_cancel($passenger_seatNo,$ticket_id)
{ 
	for($i=0; $i<=count($passenger_seatNo); $i++)
	{
	   $passenger_seatNo[$i];
   $qry=mysql_query("UPDATE bookinginfo SET cancelledStatus = 1 WHERE SeatNo=".$passenger_seatNo[$i]." and Ticket_ID = ".$ticket_id." ");
   return $qry;
	}
}

function ticket_cancel1($passenger_seatNo,$ticket_id)
{ 
	for($i=0; $i<=count($passenger_seatNo); $i++)
	{
	   $passenger_seatNo[$i];
   $qry=mysql_query("UPDATE bookinginfo SET cancelledStatus = 0 WHERE SeatNo=".$passenger_seatNo[$i]." and Ticket_ID = ".$ticket_id." ");
   return $qry;
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function general_settings(){
$gsetting = mysql_query("select * from generalsettings") or die(mysql_error());

$genfetch=mysql_fetch_array($gsetting);

	$title = $genfetch['website_name'];
	
	$webkeyword=$genfetch['website_keywords'];
	
	$webdes=$genfetch['website_desc'];
	
	$siteteam=$genfetch['website_team'];
	
	$siteadmin=$genfetch['website_admin'];	

	$mail_url=$genfetch['mail_url'];
	
	$imglogo=$genfetch['site_logo'];
	
	$paypal=$genfetch['paypal_dmailid'];	
	
	$end=$genfetch['paginate_value'];
	
	//$taxval=$genfetch['tax'];
	
	//$paayb_rate=$genfetch['bankrate_paypal'];
	
	
	
	return $genfetch;
}

function get_SP($sp_id)
{ 
	$sp_sql=mysql_query("SELECT * FROM serviceprovider_info where SP_id=".$sp_id);
	
	$sp_num_rows=mysql_num_rows($sp_sql);
	
	if($sp_num_rows==1)
	{
	   $sp=mysql_fetch_array($sp_sql);
	   
	   return ucwords($sp['SP_name']);
	}	
}


function get_board_time($ticket)
{ 
	$sql=mysql_query("SELECT * FROM booker_details where Ticket_ID='".$ticket."'");
	
	$sp_num_rows=mysql_num_rows($sql);
	
	if($sp_num_rows==1)
	{
	   $sp=mysql_fetch_array($sql);
	   
	   return ucwords($sp['boarding_point']);
	}	
}

function get_seat_number($ticket)
{ 
	$sql=mysql_query("SELECT * FROM bookinginfo where Ticket_ID='".$ticket."' and cancelledStatus=0");
	
	$sp_num_rows=mysql_num_rows($sql);
	
	$sno = '' ;
	
	if($sp_num_rows > 0 )
	{
	   while($sp = mysql_fetch_array($sql))
	   {	   
	   		$sno .= $sp['SeatNo'].',' ;
	   }
	   
	   return substr($sno,0,-1) ;
	}	
}


function get_booker($ticket)
{ 
	$sql=mysql_query("SELECT * FROM booker_details where Ticket_ID='".$ticket."'");
	
	$sp_num_rows=mysql_num_rows($sql);
	
	if($sp_num_rows==1)
	{
	   $sp=mysql_fetch_array($sql);
	   
	   return ucwords($sp['Booker_name']);
	}	
}

function get_total_bus($sp_id,$dat)
{ 
    $sql=mysql_query("SELECT Bus_id FROM bookinginfo where SP_id = '".$sp_id."' AND travelling_date='".$dat."' AND cancelledStatus=0 AND Blocked=0 GROUP BY Bus_id");
	
	while($row = mysql_fetch_array($sql))
	{
		 $bus[]=$row['Bus_id'];
	}
	return $bus;
}


function get_total_bus_fare($bus,$dat)
{ 
 $t=0;
    if(count($bus)>0){
	   foreach($bus as $busid){
	           $p=mysql_num_rows(mysql_query("SELECT * FROM bookinginfo WHERE travelling_date='".$dat."' AND Bus_id=".$busid." AND cancelledStatus=0 AND Blocked=0"));
			   $sql=mysql_query("SELECT Bus_fare FROM businfo WHERE businfo.Bus_id=".$busid);
			   $f=mysql_fetch_array($sql);			   
			   $t+=($p*$f['Bus_fare']);   
	   }
   }
    return $t;
}

function get_total_bus1($sp_id)
{ 
    $sql=mysql_query("SELECT Bus_id FROM businfo where SP_id = '".$sp_id."' ");

    $count_bus=mysql_num_rows($sql);
	return $count_bus;
}




function get_ind_fare($Busid,$dat){
 $t=0;
 $sql=mysql_query("SELECT * FROM bookinginfo WHERE Bus_id=".$Busid." AND travelling_date='".$dat."' AND cancelledStatus=0 AND Blocked=0");
 if(mysql_num_rows($sql)>0){
    while($row=mysql_fetch_array($sql)){
	      $g=mysql_fetch_array(mysql_query("SELECT Bus_fare FROM businfo WHERE businfo.Bus_id=".$Busid));
		  $t+=$g['Bus_fare'];
	}
 }
 return $t;
}


function getPsr_Gender($Busid,$dat,$seatno,$Bus_type){
$res='';

  $ticket_sql=mysql_query("SELECT Ticket_ID FROM bookinginfo WHERE Bus_id=".$Busid." AND SeatNo='".$seatno."' AND travelling_date='".$dat."'");
  if(mysql_num_rows($ticket_sql)>0){
       while($r1=mysql_fetch_array($ticket_sql)){
       $gen_sql=mysql_query("SELECT passenger_Gender FROM passengerinfo WHERE Ticket_ID='".$r1['Ticket_ID']."' AND passenger_seatNo='".$seatno."'");
	     if(mysql_num_rows($gen_sql)>0){
		    while($r2=mysql_fetch_array($gen_sql)){
			      $res=$r2['passenger_Gender'];
				 	 if($res=='m' || $res=='M'){
					  if($Bus_type=='Sleeper') 
					  { 
						  echo "<img src='images/Sleeper-men.jpg' border='0' alt='Male' title='Male' height='20' width='45'>";
					  }
					  else 
					  {
					    echo "<img src='images/Seat-men.jpg' border='0' alt='Male' title='Male' height='25' width='25'>";
					  }
				  }
				  elseif($res=='f' || $res=='F'){
					  
					  if($Bus_type=='Sleeper') 
					  { 
						  echo "<img src='images/Sleeper2-ladies.jpg' border='0' alt='Female' title='Female' height='20' width='45'>";
					  }
					  else 
					  {
				    		echo "<img src='images/Seat-ladies.jpg' border='0' alt='Female' title='Female' height='25' width='25'>";
					  }
				  }
				  else{
					 	 if($Bus_type=='Sleeper') 
						  { 
						  echo "<img src='images/Sleeper2-booked.jpg' border='0' alt='Female' title='Female' height='25' width='25'>";
					  }
					  else 
					  {
				       echo "<img src='images/Seat-booked.jpg' border='0' alt='Block' title='Block' height='25' width='25'>";
					  }
				  }
			}
		 }
		 else{
			 if($Bus_type=='Sleeper') 
						  { 
						  //echo "<img src='images/Sleeper2-booked.jpg' border='0' alt='Female' title='Female' height='25' width='25'>";
					  }
					  else 
					  {
					     // echo "<img src='images/Seat-booked.jpg' border='0' alt='Block' title='Block' height='25' width='25'>";
					  }
		 }
	   }
     }
   else{
	   
	   if($Bus_type=='Sleeper') 
						  { 
						 // echo "<img src='images/Sleeper2-booked.jpg' border='0' alt='Female' title='Female' height='25' width='25'>";
					  }
					  else 
					  {
       // echo "<img src='images/Seat-booked.jpg' border='0' alt='Block' title='Block' height='25' width='25'>";
   }	 }
}

/*********************************************************************************************************************************/

function chkusremail($email){
 $sql=mysql_query("SELECT user_id FROM users WHERE user_email='".$email."'");
 if(mysql_num_rows($sql)>0){
    while($u=mysql_fetch_array($sql)){
	      $u_id=$u['user_id'];
	}
 }
 else{
    $u_id=0;
 }
 return $u_id;
}

function getUserData($uid){
$usr_qry=mysql_query("SELECT * FROM users WHERE user_id=".$uid." AND user_status=1");
return mysql_fetch_array($usr_qry);
}
?>