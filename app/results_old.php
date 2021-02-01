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

<script type="text/javascript">
function seat_check(val,val1,val2,val3,val4)
{

var jdate=val4+"-"+val3+"-"+val2;

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	var arr=xmlhttp.responseText;
	var data=arr.split("#");
	document.getElementById("err_seat").innerHTML=data[0];
	document.getElementById("err_seat1").innerHTML=data[1];
    }
  }
xmlhttp.open("GET","../seatcheck.php?seat="+val+"&busid="+val1+"&dat="+jdate,true);
xmlhttp.send();
}
</script>
<script>
function goNext(busid,dat,trip)
{
/*alert(busid);
alert(dat);
alert(trip);*/


if (busid=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
  
  document.getElementById('show'+busid).style.display="none";
  document.getElementById('loader'+busid).style.display="block";
  
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint"+busid).innerHTML=xmlhttp.responseText;
	
	$(".slidingDiv").hide();
	
	$("#content"+busid).show();
	
	
	document.getElementById('loader'+busid).style.display="none";
	document.getElementById('show'+busid).style.display="block";
  
	
	//alert(txtHint);
    }
  }
xmlhttp.open("GET","../available_seat.php?hid_Busid="+busid+"&hid_date="+dat+"&triptype="+trip,true);
xmlhttp.send();

}
</script>
<script>
function goBacknew(busid)
{
//alert(busid);
<!--document.getElementById('loader'+busid).style.display="block";-->
	$(".slidingDiv"+busid).hide();
}

</script>
<script>
	function fn_show_srch_form(){

		$('#quick_search').show();

		$('#mod_srch').hide();
	}
	
	function fn_show_srch_hide(){
		$('#quick_search').hide();
		$('#mod_srch').show();
	}
	
	function goNextgfhf(busid,dat){
	  document.getElementById('hid_Busid').value=busid;
	  document.getElementById('hid_date').value=dat;
	  
	  document.form.action="available_seat.php";
	  document.form.submit();
	}
</script>
<style>
table {
	background: none;
	padding: 0;
}

.slidingDiv {
	height:235px;
	padding:10px;
	margin-top:7px;
	border:5px solid #ccc;
}

#show_hide {
	display:none;
}

#newseats {
	width: 512px;
	background-color: white;
	margin:0px;
	
	box-shadow: 0px 0px 6px #CCC;
	-moz-box-shadow: 0px 0px 6px #CCC;
	-widget-box-shadow: 0px 0px 6px #CCC;
	
	border-radius: 7px;
	-moz-border-radius: 7px;
	-widget-border-radius: 7px;
}

</style>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
var tot = 0;
function seat_display(val,vipval)
{   

	seat_no = "seat_"+val;
	$('input[type="checkbox"][name="'+seat_no+'"]').attr('checked', 'checked');
	var s_no = document.getElementById(seat_no).value; 

	/*alert(val,vipval);*/
	if(vipval==1) {
		alert("This is VIP seat");
		var vip_fare = parseInt(document.getElementById('vip_fare').value);
		var fare = vip_fare;
		
		
	} else {
		var bus_fare = parseInt(document.getElementById('bus_fare').value);
		var fare = bus_fare;
		
		
	}
	
	if(document.getElementById(seat_no).checked) {
	
	document.getElementById('total_seats').value += s_no+",";
	
	tot=tot+fare; 	
	}
	else
	{
		tot=tot-fare;
		var arr = document.getElementById('total_seats').value;
		
		var seatno = arr.split(",");
		
		for( var i=0; i<seatno.length; i++ )
		{
			if(seatno[i] == s_no )			
				seatno.splice(i,1);		
		}		
		document.getElementById('total_seats').value = seatno;		
		if(tot < 0){
		 tot=0; }		 
	}	
	document.getElementById('total_amt').value = tot;
}


function chg_btn(){
document.getElementById('btn_search').src="images/search-but.gif";
document.getElementById('btn_search').disabled=false;
}


</script>
<script language="javascript">
	
	function slideshow(id) {
		document.getElementById('overlay'+id).style.display='block';
		document.getElementById('gallaryimg'+id).style.display='block';
	}
	
	function slidehide(id) {
		document.getElementById('overlay'+id).style.display='none';
		document.getElementById('gallaryimg'+id).style.display='none';
	}
	
</script>
<script language="javascript">
	
	function slideshow2(id2) {
		
		document.getElementById('overlay1'+id2).style.display='block';
		document.getElementById('popuprel'+id2).style.display='block';
	}
	
	function slidehide2(id2) {
		
		document.getElementById('overlay1'+id2).style.display='none';
		document.getElementById('popuprel'+id2).style.display='none';
	}
	
</script>
<?php if($trip_type==1) { ?>
<script type="text/javascript">
function chg_btn(){
document.getElementById('btn_search').src="images/search-but.gif";
document.getElementById('btn_search').disabled=false;
}
</script>
<script type="text/javascript" src="../video-player/swfobject.js"></script>
<script type="text/javascript" src="../js/jquery.min2.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
<script type='text/javascript' src='../jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript">
     $(document).ready(function() {
         $("#ter_from").autocomplete("../fromcity.php", {
             width: 155,
             formatResult: function(data, value) {
                 return value.split(",")[0];
             }
         });
     });
</script>
<script>
function get_val_points()
{

 var fromval=document.getElementById('ter_from').value;
//alert(fromval);
	if (fromval!='')
	{
		 $(document).ready(function() {
         $("#tag").autocomplete("../tocity.php?from="+fromval, {
             width: 155,
             formatResult: function(data, value) {
                 return value.split(",")[0];
             }
         });
     });
	}
	else 
	{
	alert("Please enter the destination value");
	document.getElementById('tag').focus();
	return false;
	}
}
</script>
<script type="text/javascript">
function des_val()
{
if(document.getElementById('ter_from').value=="")
{
alert("please enter source value");
document.getElementById('term_from').focus();
document.getElementById('tag').value="";
return false;

}


}

</script>
<script type="text/javascript">
function dat_val()
{
//alert("hello");
if(document.getElementById('tag').value!="")
{

document.getElementById('dat').style.display='block';
document.getElementById('datepicker').focus();
return false;

}



}

</script>
<script type="text/javascript">
function validate()
{
//alert("hello");

if(document.getElementById('ter_from').value=="")
{
alert("please enter the source value");
document.getElementById('ter_from').focus();
return false;

}

if(document.getElementById('tag').value=="")
{
alert("please enter the Destination value");
document.getElementById('tag').focus();
return false;

}

if((document.getElementById('ter_from').value!="") && (document.getElementById('tag').value!="") &&(document.getElementById('datepicker').value==""))
{
alert("Please choose Date of Journey");
document.getElementById('datepicker').focus();
return false;
}

}

</script>
<script type="text/javascript">
function change_val()
{
//alert("hello");
document.getElementById('disp').style.display='block';
document.getElementById('hide').style.display='none';

}

</script>
<script type="text/javascript">

$(document).ready(function(){


    $(".slidingDiv").hide();
	$("#show_hide").show();
	
	/*$('#show_hide').click(function(){
	$("#slidingDiv").slideToggle();
	});*/

});

</script>

<div class="clear"><div class="err_msg" id="errmsg"></div></div></div>
<?php
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

/*$board_fetch=mysql_fetch_array(mysql_query("select * from cities where city_name='$board_point' and del_status=1"));
 $board_val=$board_fetch['id'];

$drop_fetch=mysql_fetch_array(mysql_query("select * from cities where city_name='$drop_point' and del_status =1"));
 $drop_val=$drop_fetch['id'];*/

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
//echo $str_val;

//echo "SELECT * FROM businfo WHERE (`Bus_fromcity` = ".$from_city1." and `Bus_tocity` = ".$to_city1.") and Bus_status = 1 $str_val group by Bus_id "; 

//$bussql_1=mysql_query("SELECT * FROM businfo WHERE  Bus_status = 1 $str_val group by Bus_id");
$select = "SELECT * FROM businfo WHERE (`Bus_fromcity` = ".$from_city1." and `Bus_tocity` = ".$to_city1.") and Bus_status = 1";
$bussql_1=mysql_query($select);
//echo $str_val;
}

else
{



//echo "SELECT * FROM businfo WHERE (`Bus_fromcity` = ".$from_city." and `Bus_tocity` = ".$to_city.") and Bus_status = 1 and ('$val_Dateeee' <= DATE_ADD('$sssga',INTERVAL `active_days` DAY)) and (disable_date NOT LIKE '%$journey_date%') group by Bus_id"; 


$select = "SELECT * FROM businfo WHERE (`Bus_fromcity` = ".$from_city." and `Bus_tocity` = ".$to_city.") and Bus_status = 1  ";
$bussql_1=mysql_query($select);
}

$flag_gan=0;
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
		//echo $board_time[1];
		$dp_t=str_replace(" ","",$board_time[1]);
		
		
		$dat=str_replace(" ","",$dat);
		
		$dep=strtotime($dat." ".$dp_t);	
			
		$cur_time=strtotime(date("Y-m-d g:ia"));
		
		
		if($dep > $cur_time){	
		$flag_gan=1;							

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

$mqry   = "SELECT * FROM businfo WHERE Bus_status = 1 and Bus_id='$bus_id'"; 
$mem_rs = mysql_query($mqry);
$data   = mysql_fetch_array($mem_rs);

//echo "<pre>"; print_r($data); echo "<pre/>"; 



$open=$data['bus_video']; 

if($open=='')
{  } else { } 

$selectimages=mysql_query("SELECT * FROM bus_images WHERE bus_id='$bus_id'");

if(mysql_num_rows($selectimages)>0) {

$i=1;
	while($rowimages=mysql_fetch_array($selectimages)) {
	if(($rowimages['img_name']!='') && (file_exists("uploads/bus_image/$rowimages[img_name]")))
{
}

}
$i++; } 
else 
{ 
} 
	}
	
				else
				{
				 
				}
//echo "<pre/>"; print_r($data); echo "<pre/>";
//echo "<br/><br/>-----------------------------------------------------------------------------<br/><br/>";
echo json_encode($data,1);} 
				 }
				 
				 
				 } 
				 else {
				 $flag_gan=1;
				 return "No Bus";
				 }
if($flag_gan==0){
return "No Bus";
}


} 
if($_REQUEST['ter_from']!='') { ?>
<script language="javascript">
get_val_points('<?php echo $_REQUEST['ter_from']; ?>');
</script>
<?php } 





?>


