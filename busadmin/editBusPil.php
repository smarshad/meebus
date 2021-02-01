<?php
include "includes/header.php";

if(!isset($_REQUEST['busid'])){
  header("location: busDetails.php");
  }
else{  
$bus_id=$_REQUEST['busid'];
$qry=mysql_query("SELECT * FROM businfo WHERE Bus_id=".$bus_id);

if(mysql_num_rows($qry)>0){
   $bus=mysql_fetch_object($qry);

   
?>
<style type="text/css">
.divscroll {
	width:250px;
	height:100px;
	background-color:#FFFFFF;
	border:1px solid #CCCCCC;
	overflow:auto;
}
.clr {
	clear:both;
	}


</style>
<style type="text/css">
a.ovalbutton{
background: transparent url('oval-blue-left.gif') no-repeat top left;
display: block;
float: left;
font: normal 13px Tahoma; /* Change 13px as desired */
line-height: 16px; /* This value + 4px + 4px (top and bottom padding of SPAN) must equal height of button background (default is 24px) */
height: 24px; /* Height of button background height */
padding-left: 11px; /* Width of left menu image */
text-decoration: none;
}

a:link.ovalbutton, a:visited.ovalbutton, a:active.ovalbutton{
color: #494949; /*button text color*/
}

a.ovalbutton span{
background: transparent url('oval-blue-right.gif') no-repeat top right;
display: block;
padding: 4px 11px 4px 0; /*Set 11px below to match value of 'padding-left' value above*/
}

a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
overflow: hidden; 
width: 100%;
}

</style>
<a href="busDetails.php?sp_id=<?php echo $bus->SP_id; ?>"><?php echo get_SP_name($bus->SP_id); ?></a>&nbsp; >> &nbsp;<strong>Edit Bus Informations</strong>
<?php
if(isset($_REQUEST['updatbus']))
{
include("../includes/resize-class.php");
$promotion=$_REQUEST['promotion'];
$SP_id=$_SESSION['SP_id'];
$busname=mysql_real_escape_string($_REQUEST['bname']);
$busType=$_REQUEST['busType'];
$source=$_REQUEST['fromCity'];
$destination=$_REQUEST['toCity'];
$fare=$_REQUEST['fare'];
$tax=$_REQUEST['tax'];
$total=$_REQUEST['tfare'];
$seats=$_REQUEST['seats'];
$date=date("Y-m-d");
$image=$_FILES['bus_image']['name'];
$terms=$_REQUEST['terms_conditions'];
$video=$_FILES['video']['name'];
$active_days=$_REQUEST['active_days'];
$departTime=$_REQUEST['depart'];
$arrivalTime=$_REQUEST['arrival'];
$split = explode(".",$video);
$track_device=$_REQUEST['track_device'];
$split = explode(".",$video);
//echo $split_name[1]; exit;
$terms=$_REQUEST['terms'];
$track_device=$_REQUEST['track_device'];

if(($video == "") && ($img_vid !=""))
{
$vimg=$img_vid;
} 
else 
{

if(($split[1] == 'mp4') || ($split[1] == 'flv') || ($split[1] == '3gp') || ($split[1] == 'MP4') || ($split[1] == 'FLV') || ($split[1] == '3GP'))
{

$vimg = "vid".date("dmY")."-".rand("100","999").".".$split[1];
move_uploaded_file($_FILES['video']['tmp_name'],"../uploads/video/".$vimg);

}

}
$item=implode(",",$_REQUEST['lux_item']);
$image=$_FILES['bus_image']['name'];

if($image == "") 
	{
		if($_REQUEST['old_img'] != "") 
		{
			
			$bus_img_small = $_REQUEST['old_img'];
		}
		
		
		
	}
	 else
    {

$img_size = filesize($_FILES['bus_image']['tmp_name']);
//echo $img_size;exit;
if($img_size > 1048576) //1048576 = 1MB
{
	header("Location:editBus.php?largeimage");
	exit;
}
else
{

$split_name = explode(".",$image);
//echo $split_name[1]; exit;
if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
{
//echo "image ok "; exit;
//$cate_img_very_small = "cat_very_small".date("dmY")."-".rand("100","999").".".$split_name[1];
$bus_img_small = "bus".date("dmY")."-".rand("100","999").".".$split_name[1];
$image_path = "../uploads/bus_image/";
$image_path_thumb = "../uploads/bus_image/thumb/";
$image_path_mid = "../uploads/bus_image/thumb/mid/";
 move_uploaded_file($_FILES['bus_image']['tmp_name'],"../uploads/bus_image/".$bus_img_small);
//echo "<br>uploads/".$bus_img_small; exit;
//small image
$resizeObj = new resize("../uploads/bus_image/".$bus_img_small);
// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
//$resizeObj -> resizeImage(150, 150, 'exact');

//$resizeObj -> saveImage($image_path.$bus_img_small, 100);

//very small image
//$resizeObj = new resize($_FILES['cate_image']['tmp_name']);

// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
$resizeObj -> resizeImage(150, 150, 'exact');

$resizeObj -> saveImage($image_path_thumb.$bus_img_small, 100);

$resizeObj -> resizeImage(60, 60, 'exact');

$resizeObj -> saveImage($image_path_mid.$bus_img_small, 100);

//unlink("uploads/".$bus_img_small);


//echo $bus_img_small.", ".$cate_img_small; exit;
}
else
{
	header("Location:editBus.php?not-a-image");
	exit;
}
}
}
$date=date("Y-m-d");
$boarding_time='';

$nowboarding=explode(",",$_REQUEST['boardingpoint']);
//print_r($nowboarding );
$newboard=array();
$bi=0;
foreach($nowboarding as $bb) {
	//echo $bb."<br>";
	$tmpboard=explode("---",$bb);
	//print_r($tmpboard);
	//echo $tmpboard[0]."-".$tmpboard[1]."<br>";
	$newboard[$bi][0]=$tmpboard[0];
	$newboard[$bi][1]=$tmpboard[1];
	$bi++;
}

//print_r($newboard);exit;

$boardlist=explode(",",$_REQUEST['boardlist']);
for($u=0;$u<count($boardlist);$u++){
$a=''; $b='';
    $q=explode("-",$boardlist[$u]);

	$a=$q[0];
	$b=$q[1];
	//echo $a;
		if(isset($newboard[$u]) && isset($_REQUEST[$b])){
			//$tmpexp=explode("---",$_REQUEST[$a]);
			foreach($newboard as $nb) {
				//echo $nb[0]."---".$a;
				if($nb[0] == $a) {
					$aval=$newboard[$u][1];
		   			$boarding_time.=mysql_real_escape_string($aval)."--".mysql_real_escape_string($_REQUEST[$b]).",";
				}
			}
		}
    }
	
	 $boarding_time=substr($boarding_time,0,-1); 
	 
	 //echo $boarding_time;exit;
	 
	 //DROPPING LIST
	 
	 $dropping_time='';

$droplist=explode(",",$_REQUEST['droplist']);
for($u=0;$u<count($droplist);$u++){
$c=''; $d='';
    $r=explode("-",$droplist[$u]);

	$c=$r[0];
	$d=$r[1];
	
		if(isset($_REQUEST[$c]) && isset($_REQUEST[$d])){
			$tmpexp=explode("---",$_REQUEST[$c]);
			$cval=$tmpexp[1];
		   $dropping_time.=mysql_real_escape_string($cval)."--".mysql_real_escape_string($_REQUEST[$d]).",";
		}
    }
	
	 $dropping_time=substr($dropping_time,0,-1); 
	 
	 
	//$drop_time=$_REQUEST['dropping1']."-".$_REQUEST['to_time1'];;
	 $SR_id=getRouteID($source,$destination);
	 
	 //echo "UPDATE `businfo` SET `Bus_fromcity` = '$source' ,  `Bus_tocity` = '$destination' ,  `Bus_type` = '$busType' , `Bus_name` = '$busname' ,  `Bus_boarding_time` = '$boarding_time' ,`Bus_departure_time`='$dropping_time', `Bus_fare` = '$total' , `Bus_totalseats` = '$seats',`luxury_item`='$item',`bus_video`='$vimg',`bus_image`='$bus_img_small' WHERE `Bus_id` = '$bus_id' "; exit;
	
	 $sql_businfo="UPDATE `businfo` SET `Bus_fromcity` = '$source' ,  `Bus_tocity` = '$destination' ,  `Bus_type` = '$busType' , `Bus_name` = '$busname',  `boarding_info` = '$boarding_time' ,`dropping_info`='$dropping_time', `base_fare`  = '$total' , `Bus_totalseats` = '$seats',`luxury_item`='$item',`bus_video`='$vimg',`active_days`='$active_days',`bus_promo`='$bus_promo',`conditions` = '$terms',`departTime` = '$departTime',`arrivalTime` = '$arrivalTime',`track_device` = '$track_device' WHERE `Bus_id` = '$bus_id' ";
	//echo $sql_businfo;  exit;
mysql_query($sql_businfo);
//$bus_id=mysql_insert_id(); 
header("Location: editBus.php?busid=$bus_id&suc");
}
?>




<script type="text/javascript">

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCodel > 57)){
            return false;
            }
         return true;
      }


 function getObject(obj)
  {
	  var theObj;
	  if (document.all) {
		  if (typeof obj=='string') {
			  return document.all(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  if (document.getElementById) {
		  if (typeof obj=='string') {
			  return document.getElementById(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  return null;
  }



 function chkkeycode(evt,txt)
 {
	var textBox = getObject(txt);
	var charCode = (evt.which) ? evt.which : event.keyCode;

	 if (charCode == 189){ 
	      return false;
		 }
		 else{
		  return true;
		 }
	 
	 /*if (charCode == 8) textBox.value = "backspace"; //  backspace
	 if (charCode == 9) textBox.value = "tab"; //  tab
	 if (charCode == 13) textBox.value = "enter"; //  enter
	 if (charCode == 16) textBox.value = "shift"; //  shift
	 if (charCode == 17) textBox.value = "ctrl"; //  ctrl
	 if (charCode == 18) textBox.value = "alt"; //  alt
	 if (charCode == 19) textBox.value = "pause/break"; //  pause/break
	 if (charCode == 20) textBox.value = "caps lock"; //  caps lock
	 if (charCode == 27) textBox.value = "escape"; //  escape
	 if (charCode == 33) textBox.value = "page up"; // page up, to avoid displaying alternate character and confusing people	         
	 if (charCode == 34) textBox.value = "page down"; // page down
	 if (charCode == 35) textBox.value = "end"; // end
	 if (charCode == 36) textBox.value = "home"; // home
	 if (charCode == 37) textBox.value = "left arrow"; // left arrow
	 if (charCode == 38) textBox.value = "up arrow"; // up arrow
	 if (charCode == 39) textBox.value = "right arrow"; // right arrow
	 if (charCode == 40) textBox.value = "down arrow"; // down arrow
	 if (charCode == 45) textBox.value = "insert"; // insert
	 if (charCode == 46) textBox.value = "delete"; // delete
	 if (charCode == 91) textBox.value = "left window"; // left window
	 if (charCode == 92) textBox.value = "right window"; // right window
	 if (charCode == 93) textBox.value = "select key"; // select key
	 if (charCode == 96) textBox.value = "numpad 0"; // numpad 0
	 if (charCode == 97) textBox.value = "numpad 1"; // numpad 1
	 if (charCode == 98) textBox.value = "numpad 2"; // numpad 2
	 if (charCode == 99) textBox.value = "numpad 3"; // numpad 3
	 if (charCode == 100) textBox.value = "numpad 4"; // numpad 4
	 if (charCode == 101) textBox.value = "numpad 5"; // numpad 5
	 if (charCode == 102) textBox.value = "numpad 6"; // numpad 6
	 if (charCode == 103) textBox.value = "numpad 7"; // numpad 7
	 if (charCode == 104) textBox.value = "numpad 8"; // numpad 8
	 if (charCode == 105) textBox.value = "numpad 9"; // numpad 9
	 if (charCode == 106) textBox.value = "multiply"; // multiply
	 if (charCode == 107) textBox.value = "add"; // add
	 if (charCode == 109) textBox.value = "subtract"; // subtract
	 if (charCode == 110) textBox.value = "decimal point"; // decimal point
	 if (charCode == 111) textBox.value = "divide"; // divide
	 if (charCode == 112) textBox.value = "F1"; // F1
	 if (charCode == 113) textBox.value = "F2"; // F2
	 if (charCode == 114) textBox.value = "F3"; // F3
	 if (charCode == 115) textBox.value = "F4"; // F4
	 if (charCode == 116) textBox.value = "F5"; // F5
	 if (charCode == 117) textBox.value = "F6"; // F6
	 if (charCode == 118) textBox.value = "F7"; // F7
	 if (charCode == 119) textBox.value = "F8"; // F8
	 if (charCode == 120) textBox.value = "F9"; // F9
	 if (charCode == 121) textBox.value = "F10"; // F10
	 if (charCode == 122) textBox.value = "F11"; // F11
	 if (charCode == 123) textBox.value = "F12"; // F12
	 if (charCode == 144) textBox.value = "num lock"; // num lock
	 if (charCode == 145) textBox.value = "scroll lock"; // scroll lock
	 if (charCode == 186) textBox.value = ";"; // semi-colon
	 if (charCode == 187) textBox.value = "="; // equal-sign
	 if (charCode == 188) textBox.value = ","; // comma
	 if (charCode == 189) textBox.value = "-"; // dash
	 if (charCode == 190) textBox.value = "."; // period
	 if (charCode == 191) textBox.value = "/"; // forward slash
	 if (charCode == 192) textBox.value = "`"; // grave accent
	 if (charCode == 219) textBox.value = "["; // open bracket
	 if (charCode == 220) textBox.value = "\\"; // back slash
	 if (charCode == 221) textBox.value = "]"; // close bracket
	 if (charCode == 222) textBox.value = "'"; // single quote*/

	/* var lblCharCode = getObject('spnCode');
	lblCharCode.innerHTML = 'KeyCode:  ' + charCode;

	return false;*/


 }



function get_fare(){
       var v1=document.getElementById('fare').value;
	   var v2=document.getElementById('tax').value;
	   if(v1 != '' && v2 !=''){
	      document.getElementById('tfare').value=parseInt(v1)+parseInt(v2);
	     }
      }

function validate_busform()
{
   
	var form = document.busform;
	
	if(form.bname.value == ""){
	alert("Please Enter Bus Name");
	form.bname.focus();
	return false;
	}
	
	if(form.busType.value == ""){
	alert("Please Choose Bus Type");
	form.busType.focus();
	return false;
	}
	
	if(form.fromCity.value == ""){
	alert("Please Choose From City");
	form.fromCity.focus();
	return false;
	}
	
	if(form.toCity.value == ""){
	alert("Please Choose To City");
	form.toCity.focus();
	return false;
	}
	
	/*if(form.fare.value == ""){
	alert("Please Enter Bus Fare");
	form.fare.focus();
	return false;
	}
	
	if(form.tax.value == ""){
	alert("Please Enter Tax Amount");
	form.tax.focus();
	return false;
	}*/
	
	if(form.tfare.value == ""){
	alert("Please Enter Total Fare");
	form.tfare.focus();
	return false;
	}
	
	if(form.seats.value == ""){
	alert("Please Enter Total Seats");
	form.seats.focus();
	return false;
	}
	
	
		if(document.getElementById('active_days').value=="")
	{
	alert("Enter the active days count");
	document.getElementById('active_days').focus();
	return false;
	}
	
	if(document.getElementById('terms').value=="")
	{
	alert("Enter the Terms and conditions");
	document.getElementById('terms').focus();
	return false;
	}
	
	
	var chks = document.getElementsByName('lux_item[]');
    var hasChecked = false;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasChecked = true;
            break;
        }
    }
    if (hasChecked == false) {
        alert("Please select at least one luxury item.");
        return false;
    }
	
	

//	
//	if(document.getElementById('bus_image').value != "")
//	{
//		var ss=document.getElementById('bus_image').value;
//		var index=ss.lastIndexOf(".");				
//		var sstring=ss.substring(index+1);
//		var ssivanew=sstring.toLowerCase();
//		if(ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" && ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF")
//		{
//			  alert("Upload jpg,png,jpeg,gif images only...");
//			  document.getElementById('bus_image').value="";
//			  document.getElementById('bus_image').focus();
//			  return false;
//		 }
//	}


	

	
	return true;
}

 
</script>


<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.min.js"></script>	

<script type="text/javascript">
function time_show(idval)
{

	var var_id = '#'+idval ; 
						
	$(var_id).timepicker({ampm: true, hourMin: 0, hourMax: 24 });

}


</script>

<script>
function showboard(str)
{
//alert(str);
if (str.length==0)
  {
  document.getElementById("b_points").innerHTML="";
  return;
  }
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
	//alert(xmlhttp.responseText);
	deltable("dataTable");
    document.getElementById("b_points").innerHTML=xmlhttp.responseText;
	document.getElementById("boardingcodefrom").innerHTML=xmlhttp.responseText; 
	document.getElementById("addrowfrom").style.display='block';
	document.getElementById("delrowfrom").style.display='block';
	document.getElementById('boardingpoint').value='';
    }
  }
xmlhttp.open("GET","showboard.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function showdrop(str)
{
//alert(str);
if (str.length==0)
  {
  document.getElementById("d_points").innerHTML="";
  return;
  }
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
		deltable("dropping_tbl");
    	document.getElementById("d_points").innerHTML=xmlhttp.responseText;
		document.getElementById("boardingcodeto").innerHTML=xmlhttp.responseText; 
		document.getElementById("addrowto").style.display='block';
		document.getElementById("delrowto").style.display='block';
		document.getElementById('toboardingpoint').value='';
    }
  }
xmlhttp.open("GET","showdrop.php?q="+str,true);
xmlhttp.send();
}
</script>

<script language="javascript">
function addfromboard(val) {
	//alert(val);
	var tmpval = document.getElementById('boardingpoint').value;
	if(tmpval!='') {
		
		var ntmparr=val.split("---");
		var position=ntmparr[0];
		//alert(position);
		var values="";
		
		var tmparr=tmpval.split(",");
		var chk="";
		//alert(tmparr.length);
		//if(tmparr.length>1) {
			//alert("array");
			for(var i=0;i<tmparr.length;i++) {
				var oldtmparr=tmparr[i].split("---");
				var oldposition = oldtmparr[0];
				if(position==oldposition) {
					tmparr[i]=val;
					chk="ok";
				}
			}
			
			if(chk=='') {
				document.getElementById('boardingpoint').value=tmpval+","+val;
			} else {
				for(var i=0;i<tmparr.length;i++) {
					if(values=='') {
						values=tmparr[i];
					} else {
						values+=","+tmparr[i];
					}
				}
				document.getElementById('boardingpoint').value=values;
			}
			
		/*} else {
			var oldtmparr=tmpval.split("---");
			if(oldtmparr[0]==position) {
				document.getElementById('boardingpoint').value=val;
			} else {
				document.getElementById('boardingpoint').value=tmpval+","+val;
			}
		}*/
		
	} else {
		document.getElementById('boardingpoint').value=val;
	}
}

function addtoboard(val) {
	//alert(val);
	var tmpval = document.getElementById('toboardingpoint').value;
	if(tmpval!='') {
		
		var ntmparr=val.split("---");
		var position=ntmparr[0];
		//alert(position);
		var values="";
		
		var tmparr=tmpval.split(",");
		var chk="";
		//alert(tmparr.length);
		//if(tmparr.length>1) {
			//alert("array");
			for(var i=0;i<tmparr.length;i++) {
				var oldtmparr=tmparr[i].split("---");
				var oldposition = oldtmparr[0];
				if(position==oldposition) {
					tmparr[i]=val;
					chk="ok";
				}
			}
			
			if(chk=='') {
				document.getElementById('toboardingpoint').value=tmpval+","+val;
			} else {
				for(var i=0;i<tmparr.length;i++) {
					if(values=='') {
						values=tmparr[i];
					} else {
						values+=","+tmparr[i];
					}
				}
				document.getElementById('toboardingpoint').value=values;
			}
			
		/*} else {
			var oldtmparr=tmpval.split("---");
			if(oldtmparr[0]==position) {
				document.getElementById('boardingpoint').value=val;
			} else {
				document.getElementById('boardingpoint').value=tmpval+","+val;
			}
		}*/
		
	} else {
		document.getElementById('toboardingpoint').value=val;
	}
}

</script>
 <script type="text/javascript" src="../video-player/swfobject.js"></script>
<fieldset class="table-bor">
		<legend><strong>Edit Bus Informations</strong></legend> 	
<form action="" name="busform" id="busform" method="post" onsubmit="return validate_busform();" enctype="multipart/form-data">
<table>
	<tr>	
		<td></td>
		
		<td></td>
		
		<td></td>
		
		<td><!--<a href="javascript:void(0);" onclick="alert('<?php echo $bus_id; ?>')">Edit Bus Structure</a>--></td>	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	<?php if(isset($_REQUEST['suc'])) { ?>
	<tr><td colspan="4" style="color:#006633;" align="center"><strong>Updated Successfully</strong></td></tr>
	<tr><td colspan="4"><br /></td></tr>
		<?php } ?>
		<!--<tr>
		<td></td><td></td><td></td>
		<td>
		<strong><a href="edit_seatlayout.php?busid=<?php echo $bus_id; ?>">Edit Bus Structure</a></strong>
		</td>
		</tr>
		<tr>
		<td></td>
		</tr>-->
		<tr>
		<td></td>
		</tr>
	<tr>
	
		<td width="143"> Bus Name </td>
		
		<td width="174">
			<input type="text" name="bname" id="bname" class="textbox" value="<?php echo $bus->Bus_name; ?>"/>	
		    <div id="bname_err" style="display:none; color:#FF3300">Please Enter Bus Name.</div>
		</td>
		
		<td width="188"> Bus type </td>
		
		<td width="183">
			<select id="busType" name="busType" class="combobox">
			<option value="">Select Bus Type</option>
			<?php			
				$qry = mysql_query("select * from bustypes where typeStatus=1") ;				
				while ($btype = mysql_fetch_array($qry))
				{
			?>			
			<option value="<?php echo $btype['typeID']; ?>" <?php if($bus->Bus_type==$btype['typeID']) { echo "selected"; } ?>><?php echo $btype['typeName']; ?></option>								
			<?php }  ?>			
			</select>
			 <div id="busType_err" style="display:none; color:#FF3300">Please Enter Bus Name.</div>
	  </td>
	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	
		<td width="143"> From City </td>
		
		<td width="199"> 
			<select id="fromCity" name="fromCity" onChange="getDestination(this.value); showboard(this.value);" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($bus->Bus_fromcity == $row['SR_source']){ echo "selected"; } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>			
			</select>	
			<?php $fromcityxx=$bus->Bus_fromcity; ?>
			<div id="fromCity_err" style="display:none; color:#FF3300">Please Choose From City</div>
			<span style="display:none;" id="boardingcodefrom">
			<select name="b_<?php echo $r; ?>" id="b_<?php echo $r; ?>" onchange="addfromboard(this.value);">
			<option value="">Boarding Point</option>
			<?php		
			//echo "select * from board_points where board_city='$q'"; 	
				$qry = mysql_query("select * from board_points where board_city='$fromcityxx'") ;				
				while ($bbbord = mysql_fetch_array($qry))
				{
			?>			
			<option value="b_0---<?php echo $bbbord['board_name']; ?>"><?php echo $bbbord['board_name']; ?></option>								
			<?php }  ?>			
			</select>
			</span>	
	    </td>		
		<td width="188"> To City </td>
		
		<td>
		<span id="tocity">
		<?php
		$source=$bus->Bus_fromcity;
		$qry=mysql_query("SELECT SR_Destination FROM service_routes where SR_source=".$source);
		?>
		<select id="toCity" name="toCity" class="combobox">
		<option value="">Select Destination Place</option>
		<?php
		while($row=mysql_fetch_array($qry)){
		?>
		<option value="<?php echo $row['SR_Destination'] ?>" <?php if($row['SR_Destination'] == $bus->Bus_tocity) { echo "selected";} ?>><?php echo get_city_name($row['SR_Destination']);  ?></option>
		<?php
		}
		?>
		</select>
		<?php
		$tocityxx=$bus->Bus_tocity;
		?>
		</span>
		<span style="display:none;" id="boardingcodeto">
		<select name="d_0" id="d_0" onchange="addtoboard(this.value);">
			<option value="">Dropping Point</option>
			<?php		
			//echo "select * from board_points where board_city='$q'"; 	
				$qry = mysql_query("select * from board_points where board_city='$tocityxx'") ;				
				while ($bbord = mysql_fetch_array($qry))
				{
			?>			
			<option value="d_0---<?php echo $bbord['board_name']; ?>"><?php echo $bbord['board_name']; ?></option>								
			<?php }  ?>			
		</select>
		</span>
		<span id="loading"></span>
		<div id="txt_to_city_err" style="display:none; color:#FF3300">Please Choose To City</div>
	  </td>
	
	</tr>
	<tr><td colspan="4"><br /></td></tr>
    
    <tr>
	<td width="143">Depature Time</td>
	<td width="174">
	<input type="text" value="<?php echo $bus->departTime;?>"  class="textbox" name="depart" id="depart" onfocus="time_show(this.id);"  /> 
	</td>
	<td width="188">Arrival Time</td>
    <td width="183">
	<input type="text" value="<?php echo $bus->arrivalTime;?>"  class="textbox" name="arrival" id="arrival"  onfocus="time_show(this.id);"  /> 
	</td>
	</tr>
    
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	<td >Promotion Code </td>
	<td colspan="2">
	<select id="promotion" name="promotion" class="combobox">			
			<option value="">Select Promotion</option>
			<?php			
			     $src_qry=mysql_query("SELECT * FROM bus_promo order by promo_id");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['promo_id']; ?>" <?php if($bus->bus_promo==$row['promo_id']) { ?> selected="selected" <?php } ?>><?php echo $row['promo_title']; ?></option>									
			<?php } ?>
		</select>
	</td>
	<td> </td>
	</tr>
	
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	
		<td height="32">
			Boarding Point & Time	</td>
	
		<td colspan="3" align="left">
				
			<table width="450" id="dataTable">
			<?php
				$boardingpointhidden='';
				//echo $bus->Bus_boarding_time;
			     $boardings=explode(",",$bus->boarding_info);
				$i=0; $r=0; $board_str='';
				foreach($boardings as $val){
				$val_arr=explode("--",$val);
			?>
		<tr>
			<td width="23">
			<?php if($i==0) { ?>
			<INPUT type="checkbox" id="chk" disabled="disabled" />
			<?php } else { ?>
			<INPUT type="checkbox" id="chk_<?php echo $r; ?>" />
			<?php } ?>
			</td>
			<td width="14"> <?php echo $i+=1; ?> </td>
			<td width="170">
			<!--<INPUT type="text" name="b_<?php echo $r ?>" id="b_<?php echo $r ?>" class="textbox" value="<?php echo $val_arr[0]; ?>" onkeydown="return chkkeycode(event,this.id)" /> -->
			<div id="b_points">
			
			<select name="b_<?php echo $r; ?>" id="b_<?php echo $r; ?>" onchange="addfromboard(this.value);">
			<option value="">Boarding Point</option>
			<?php		
			//echo "select * from board_points where board_city='$q'"; 	
				$qry = mysql_query("select * from board_points where board_city='$fromcityxx'") ;				
				while ($bbbord = mysql_fetch_array($qry))
				{
			?>			
			<option value="b_<?php echo $r; ?>---<?php echo $bbbord['board_name']; ?>" <?php if($val_arr[0]==$bbbord['board_name']) { $boardingpointhidden.=(($boardingpointhidden=='')?"":",")."b_".$r."---".$bbbord['board_name']; ?>selected="selected"<?php } ?>><?php echo $bbbord['board_name']; ?></option>
			<?php }  ?>			
			</select>
			
			</div>
			<div id="b_0_err" style="display:none; color:#FF3300;">Please Enter Boarding Point</div>
			</td>
			<td width="172"> 
			<input type="text"  class="textbox" name="bt_<?php echo $r ?>" id="bt_<?php echo $r ?>" value="<?php echo $val_arr[1]; ?>" onfocus="time_show(this.id);"  /> 
			<div id="bt_0_err" style="display:none; color:#FF3300;">Please Enter Boarding Time</div>
			</td>
			<td width="20"><?php if($r==0) { ?><img src="../images/plus_icon.png" id="addrowfrom" border="0" onClick="addRowAdmin('dataTable','boardingcodefrom')" /><?php } ?></td>
			<td width="23">
			<?php if($r==0) { ?><img src="../images/minus_icon.png" id="delrowfrom" border="0" onClick="deleteRow('dataTable')" /><?php } ?>
			
			<script language="javascript">
				time_show("bt_<?php echo $r ?>");
			</script>
			
			</td>
		</tr>
           <?php 
		   
		   $board_str.="b_".$r."-bt_".$r.",";
		   $r+=1; 
		   
		   } 
		   $board_str=substr($board_str,0,-1);
		   ?>
		  </table>
				
		</td>
	</tr>

	<tr><td colspan="4">
	<input type="hidden" name="boardlist" id="boardlist" value="<?php echo $board_str; ?>" />
	<input type="hidden" id="boardcount" name="boardcount" value='<?php echo $r; ?>' />
	<input type="hidden" name="boardingpoint" id="boardingpoint" value="<?php echo $boardingpointhidden; ?>" />
	</td></tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	
		<td height="32">
			Dropping Point & Time		</td>
	
		<td colspan="3" align="left">
				
			<table width="450" id="dropping_tbl">
			<?php
				$droppingpointhidden='';
			     $dropping=explode(",",$bus->dropping_info);
				$k=0; $s=0; $drop_str='';
				foreach($dropping as $val){
				$val_arr=explode("--",$val);
			?>
		
				<tr>
					<td width="23">
					<?php if($k==0) { ?>
					<INPUT type="checkbox" id="chk1" disabled="disabled" />
					<?php } else { ?>
					<INPUT type="checkbox" id="chk1_<?php echo $s; ?>" />
					<?php } ?>
					</td>
					<td width="14"> <?php echo $k+=1; ?> </td>
					<td width="170">
						<div id="d_points">
			<select name="d_<?php echo $s ?>" id="d_<?php echo $s ?>" onchange="addtoboard(this.value);">
			<option value="">Dropping Point</option>
			<?php		
			//echo "select * from board_points where board_city='$q'"; 	
				$qry = mysql_query("select * from board_points where board_city='$tocityxx'") ;				
				while ($bbord = mysql_fetch_array($qry))
				{
			?>			
			<option value="d_<?php echo $s ?>---<?php echo $bbord['board_name']; ?>" <?php if($val_arr[0]==$bbord['board_name']) { echo 'selected="selected"'; $droppingpointhidden.=(($droppingpointhidden=='')?"":",")."d_".$s."---".$bbord['board_name']; } ?> ><?php echo $bbord['board_name']; ?></option>
			<?php }  ?>			
			</select>
			</div>
			<div id="d_0_err" style="display:none; color:#FF3300;">Please Enter Dropping Point</div>
				  </td>
					
					<td width="172"><input type="text"  class="textbox" name="dp_<?php echo $s ?>" id="dp_<?php echo $s ?>" value="<?php echo $val_arr[1]; ?>" onfocus="time_show(this.id);"  /> 
			<div id="dp_0_err" style="display:none; color:#FF3300;">Please Enter Dropping Time</div></td>
					
					<td width="20"><?php if($s==0) { ?><img src="../images/plus_icon.png" border="0" onclick="addRow1('dropping_tbl','boardingcodeto')" /><?php } ?></td>
					
					<td width="23"><?php if($s==0) { ?><img src="../images/minus_icon.png" border="0" onclick="deleteRow1('dropping_tbl')" /><?php } ?>
					
					<script language="javascript">
						time_show("dp_<?php echo $s ?>");
					</script>
					
					</td>
					
				</tr>
				 <?php 
		   
		   $drop_str.="d_".$s."-dp_".$s.",";
		   $s+=1; 
		   
		   } 
		   $drop_str=substr($drop_str,0,-1);
		   ?>
			</table>
				
		</td>
	</tr>
	<tr><td colspan="4"><br />
	<input type="hidden" name="droplist" id="droplist" value="<?php echo $drop_str; ?>" />
	<input type="hidden" id="dropcount" name="dropcount" value='<?php echo $s; ?>' />
	<input type="hidden" name="toboardingpoint" id="toboardingpoint" value="<?php echo $droppingpointhidden; ?>" />
	</td></tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	
		<td width="143"> Total Fare </td>
		
		<td width="174"> 
		
			<input type="text" name="tfare" id="tfare" class="textbox" value="<?php echo $bus->base_fare; ?>" onkeypress="return isNumberKey(event);"/>
			
	    </td>
		
		<td width="188"> Bus Structure </td>
		
		<td width="183"><a href="edit_seatlayout.php?busid=<?php echo $bus_id; ?>" class="ovalbutton"><span><strong>
		<?php
		$str=$bus->Bus_structure;
		$strsql=mysql_query("SELECT structureType FROM `busstructuretypes` WHERE structureID=".$str);
		if(mysql_num_rows($strsql)){
		$y=mysql_fetch_array($strsql);
		?>
		<?php echo $y['structureType']; ?>
		<?php		
		}
		else{
		echo "--";
		}
		?></strong></span></a>
			<input type="hidden" name="seats" id="seats" class="textbox" value="<?php echo $bus->Bus_totalseats; ?>" maxlength="8" onkeypress="return isNumberKey(event);" readonly />			
	    </td>
	
	</tr>
	<tr><td colspan="4"><br /></td></tr>
	<tr>
	<td>Existing Video</td>
	<td>
	<?php 
	if($bus->bus_video !="") {
	
$open=$bus->bus_video;
?>
<!-- video player -->
<div  style="background-color:#f7f7f7; border:solid 5px #eceded; padding:10px; padding-left:10px; margin-left:9px;">
<div id="player1">
    <script type="text/javascript">
        /* <![CDATA[ */
        var flashvars = {
            video_url: '<? echo $site_url; ?>uploads/video/<? echo $open; ?>'
        };
		
        var params = {allowfullscreen: 'true', allowscriptaccess: 'always'};
        var attributes = {id: 'player1', name: 'player1'};
        swfobject.embedSWF('<? echo $site_url; ?>video-player/kt_player.swf', 'player1', '180', '120', '9.124.0', '<? echo $site_url; ?>video-player/expressInstall.swf', flashvars, params, attributes);
        /* ]]> */
    </script>
</div>
</div>

<!-- end video player -->
	<input type="hidden" name="old_vid" id="old_vid" value="<?php echo $bus->bus_video; ?>">
	<?php } 
	else  { ?>
	<img src="images/no_video.jpg" width="180" height="120" />
	<?php } ?>
	
	</td>
	
	<td>Bus Videos</td>
	<td><input type="file" name="video" id="video" ><br><span>Upload 3gp,mp4,flv videos only</span>      						</td>
	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	
	<!--<tr>
	<td>Existing Image</td>
	<td>
		<?php
							if(file_exists("../uploads/bus_image/thumb/" .$bus->bus_image) && $bus->bus_image!='' && file_exists("../uploads/bus_image/thumb/mid/" .$bus->bus_image))
								{
									$busedit_image1="../uploads/bus_image/thumb/".$bus->bus_image;
									$busedit_image2="../uploads/bus_image/thumb/mid/".$bus->bus_image;
								}
								else
								{
									$busedit_image1="../images/user_img.jpg";
									$busedit_image2="../images/user_img.jpg";
								}
							
						?>
						<img src="<?php echo $busedit_image2; ?>"  /> 
	<input type="hidden" name="old_img" id="old_img" value="<?php echo $bus->bus_image; ?>"></td>
	<td>Bus Image</td>
	<td><input type="file" name="bus_image" id="bus_image"></td>
	</tr>-->
	
		<tr>
	<td>Luxury Items</td>
	<td>
	<div class="divscroll">
	
	<?php 
	$check=explode(',',$bus->luxury_item);
	$lux=mysql_query("select * from bus_luxitem where lux_status=0");
	$i=1;
	while($lux_row=mysql_fetch_array($lux))
	{
	?>
<!--	<option value="<?php echo $lux_row['lux_id'];?>" <?php if($lux_row['lux_id']==$bus->luxury_item) { ?> selected="selected"; <?php } ?>><?php echo $lux_row['lux_name'];?></option>-->
	<div><input type="checkbox"  name="lux_item[]" value="<?php echo $lux_row['lux_id'] ?>" <?php if(in_array($lux_row['lux_id'],$check)) { echo "checked='checked'";   } ?>/><span><?php echo $lux_row['lux_name'];?></span></div>
	
	<?php } ?>
	 </div>
	
	
	</td>
	<td>Active Days</td>
	<td>
    <select name="active_days" id="active_days">	
    <option <?php if($bus->active_days==5) { ?> selected="selected" <?php } ?> value="5">Week Days</option>
    <option <?php if($bus->active_days==2) { ?> selected="selected" <?php } ?> value="2">Week Ends</option>
    <option <?php if($bus->active_days==365) { ?> selected="selected" <?php } ?> value="365">All Days</option>
    
    </select>	
    </td>
	
	</tr>
	
	
	<tr><td colspan="4"><br /></td></tr>
	<tr>
	<td>Terms & Conditions</td>
	<td><textarea name="terms" id="terms" style="width:250px; height:80px;"><?php echo $bus->conditions; ?></textarea></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	
	</tr>
	<tr><td>Track Device No:</td><td><input type="text" name="track_device" id="track_device" value="<?php echo $bus->track_device; ?>" class="textbox" /></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td></tr>
	<tr>
	<td>Cancellation Policy (Hours)</td>
    <?php 
	
	$cancelpolicy=json_decode($bus->cancelpolicy,1);

	?>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][0] ?>"></td>
	<td>Cancellation Charge (%)</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][0] ?>"></td>
	</tr>
    <tr>
    <td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy1" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][1] ?>"></td>
	<td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge1" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][0] ?>"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy2" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][2] ?>"></td>
	<td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge2" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][0] ?>"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy3" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][3] ?>"></td>
	<td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge3" value="<?php echo $cancelpolicy["cancellationpolicy"]["policy"][0] ?>"></td>
    </tr>
	<tr>	
		<td colspan="4" align="center"> 
				<input type="submit" name="updatbus" value="Update >>" onClick="return validate_busform()" />
<!--<input type="button" name="updatbus" value="Update >>" onClick="alert('This is Demo version !!!');" />-->	    </td>
	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
		
		<td colspan="4" align="left">
		
			<div>
		    </div>
		
		</td>
	
	</tr>
	
</table>
</form>
</fieldset>
<?php 
    include "includes/footer.php";
	}
    else {
	       header("location: busDetails.php");
	}
 } ?>