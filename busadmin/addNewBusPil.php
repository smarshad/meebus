<?php
include "includes/header.php";
if(!isset($_REQUEST['sp_id'])){
  //header("location: busDetails.php");
  }
else {  
$sp_id=$_SESSION['SP_id'];
?>
<a href="busDetails.php?sp_id=<?php echo $sp_id; ?>"><?php echo get_SP_name($sp_id); ?></a>&nbsp; >> &nbsp;<strong>Add New Pilgrimage Bus</strong>
<?php
if(isset($_REQUEST['addbus'])){
include("../includes/resize-class.php");
//echo "<pre>"; print_r($_REQUEST); echo "</pre>"; exit;
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
$cancel['policy']=$_REQUEST['cancelpolicy'];
$cancel['charge']=$_REQUEST['cancelpolicy_charge'];
$cancel_policy=$cancel;
$policy=json_encode($cancel);
//echo $split_name[1]; exit;
if(($split[1] == 'mp4') || ($split[1] == 'flv') || ($split[1] == '3gp') || ($split[1] == 'MP4') || ($split[1] == 'FLV') || ($split[1] == '3GP'))
{
$vimg = "vid".date("dmY")."-".rand("100","999").".".$split[1];
move_uploaded_file($_FILES['video']['tmp_name'],"../uploads/video/".$vimg);
}
$item=implode(",",$_REQUEST['lux_item']);
/*$img_size = filesize($_FILES['bus_image']['tmp_name']);
if($img_size > 1048576) //1048576 = 1MB
{
header("Location:addNewBus.php?largeimage");
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
header("Location:addNewBus.php?not-a-image");
exit;
}
}*/
$boarding_time='';
//toboardingpoint boardingpoint
$boardlist=explode(",",$_REQUEST['boardlist']);
for($u=0;$u<count($boardlist);$u++){
$a=''; $b='';
    $q=explode("-",$boardlist[$u]);
	$a=$q[0];
	$b=$q[1];
		if(isset($_REQUEST[$a]) && isset($_REQUEST[$b])){
		   $tmpexp=explode("---",$_REQUEST[$a]);
			$aval=$tmpexp[1];
		   $boarding_time.=mysql_real_escape_string($aval)."--".mysql_real_escape_string($_REQUEST[$b]).",";
		}
    }
	 $boarding_time=substr($boarding_time,0,-1); 
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
//echo $boarding_time." - ".$dropping_time;exit;
	//echo "INSERT INTO `businfo` ( `Bus_id` ,`SP_id` ,`SR_id` ,`Bus_fromcity` ,  `Bus_tocity` ,  `Bus_type` ,  `Bus_structure` ,  `Bus_name` , `Bus_boarding_time` , `Bus_departure_time`,  `Bus_fare` ,  `Bus_adddate` ,  `Bus_seats4SP` ,  `Bus_seats4SA` ,  `Bus_totalseats` ,  `Bus_status`,`luxury_item`,`bus_video`,`bus_image` ) VALUES (NULL ,  '$SP_id',  '$SR_id',  '$source',  '$destination',  '$busType',  '$seats',  '$busname',  '$boarding_time', '$drop_time',  '$total',  '$date',  '0',  '0',  '40',  '1','$item','$vimg','$bus_img_small')"; exit;
	/*$sql_businfo="INSERT INTO `businfo` ( `Bus_id` ,`SP_id` ,`SR_id` ,`Bus_fromcity` ,  `Bus_tocity` ,  `Bus_type` ,  `Bus_structure` ,  `Bus_name` , `Bus_boarding_time` , `Bus_departure_time`,  `Bus_fare` ,  `Bus_adddate` ,  `Bus_seats4SP` ,  `Bus_seats4SA` ,  `Bus_totalseats` ,  `Bus_status`,`luxury_item`,`bus_video`,`bus_image` ) VALUES (NULL ,  '$SP_id',  '$SR_id',  '$source',  '$destination',  '$busType',  '$seats',  '$busname',  '$boarding_time', '$dropping_time',  '$total',  '$date',  '0',  '0',  '40',  '1','$item','$vimg','$bus_img_small')";*/
	//echo "INSERT INTO `businfo` ( `Bus_id` ,`SP_id` ,`SR_id` ,`Bus_fromcity` ,  `Bus_tocity` ,  `Bus_type` ,  `Bus_structure` ,  `Bus_name` , `Bus_boarding_time` , `Bus_departure_time`,  `Bus_fare` ,  `Bus_adddate` ,  `Bus_seats4SP` ,  `Bus_seats4SA` ,  `Bus_totalseats` ,  `Bus_status`,`luxury_item`,`bus_video`,`conditions`) VALUES (NULL ,  '$SP_id',  '$SR_id',  '$source',  '$destination',  '$busType',  '$seats',  '$busname',  '$boarding_time', '$dropping_time',  '$total',  '$date',  '0',  '0',  '40',  '1','$item','$vimg','$terms')"; exit;
 $sql_businfo="INSERT INTO `businfo` ( `Bus_id` ,`SP_id` ,`SR_id` ,`Bus_fromcity` ,  `Bus_tocity` ,  `Bus_type` ,  `Bus_structure` ,  `Bus_name` , `boarding_info` , `dropping_info`,  `base_fare` ,  `Bus_adddate` ,  `Bus_seats4SP` ,  `Bus_seats4SA` ,  `Bus_totalseats` ,  `Bus_status`,`luxury_item`,`bus_video`,`conditions`,`active_days`,`bus_promo`,`departTime`,`arrivalTime`,`track_device`,`cancellationpolicy`,`pilgrimage`) VALUES (NULL ,  '$SP_id',  '$SR_id',  '$source',  '$destination',  '$busType',  '$seats',  '$busname',  '$boarding_time', '$dropping_time',  '$total',  '$date',  '0',  '0',  '40',  '1','$item','$vimg','$terms','$active_days','$promotion','$departTime','$arrivalTime','$track_device','$policy',1)";
mysql_query($sql_businfo);
$bus_id=mysql_insert_id();
header("location:seat_layout.php?busid=$bus_id");	
}
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
<script type="text/javascript">
function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      }
function get_fare(){
       var v1=document.getElementById('fare').value;
	   var v2=document.getElementById('tax').value;
	   if(v1 != '' && v2 !=''){
	      document.getElementById('tfare').value=parseInt(v1)+parseInt(v2);
	     }
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
	if(form.depart.value == ""){
	alert("Please Select Depart Time");
	form.depart.focus();
	return false;
	}
	if(form.arrival.value == ""){
	alert("Please Select Arrival Time");
	form.arrival.focus();
	return false;
	}
/*	if(form.fare.value == ""){
	alert("Please Enter Bus Fare");
	form.fare.focus();
	return false;
	}
	if(form.tax.value == ""){
	alert("Please Enter Tax Amount");
	form.tax.focus();
	return false;
	}*/
	var str=document.getElementById('boardlist').value;
	var bpoints=str.split(",");
	for(var i=0;i<document.getElementById('boardcount').value;i++){
	    var bbt=bpoints[i].split("-");
		/*if(document.getElementById(bbt[0]).value == '')
		  {
		   alert('Please Choose Boarding Point 1');
		   document.getElementById(bbt[0]).focus();
		   return false;
		  }*/
		  if(document.getElementById(bbt[1]).value == 'Choose Time' || document.getElementById(bbt[1]).value == '')
		  {
		   alert('Please Choose Boarding Time');
		   document.getElementById(bbt[1]).focus();
		   return false;
		  }
	}
	var str=document.getElementById('droplist').value;
	var bpoints=str.split(",");
	for(var i=0;i<document.getElementById('dropcount').value;i++){
	    var bbt=bpoints[i].split("-");
		/*if(document.getElementById(bbt[0]).value == '')
		  {
		   alert('Please Choose Boarding Point 1');
		   document.getElementById(bbt[0]).focus();
		   return false;
		  }*/
		  if(document.getElementById(bbt[1]).value == 'Choose Time' || document.getElementById(bbt[1]).value == '')
		  {
		   alert('Please Choose Droping Time');
		   document.getElementById(bbt[1]).focus();
		   return false;
		  }
	}
	if(form.tfare.value == ""){
	alert("Please Enter Total Fare");
	form.tfare.focus();
	return false;
	}
	if(form.seats.value == ""){
	alert("Please Select seat structure");
	form.seats.focus();
	return false;
	}
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
	if(document.getElementById('video').value != "")
	{
		var ss=document.getElementById('video').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew != "mp4" && ssivanew != "flv" && ssivanew != "3gp" && ssivanew != "MP4" && ssivanew != "FLV" && ssivanew != "3GP")
		{
			  alert("Upload mp4,flv,3gp images only...");
			  document.getElementById('video').value="";
			  document.getElementById('video').focus();
			  return false;
		 }
	}
	if(document.getElementById('active_days').value=="")
	{
	alert("Enter the active days count");
	document.getElementById('active_days').focus();
	return false;
	}
	if(document.getElementById('terms_conditions').value=="")
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
	return true;
}
/*function validate_busform(){
var form=document.busform;
for(i=0; i<form.elements.length; i++)
{
 if(form.elements[i].value==''){
    document.getElementById(form.elements[i].name+'_err').style.display='block';
	document.getElementById(form.elements[i].name).focus();
	return false;
   }
  else{
  document.getElementById(form.elements[i].name+'_err').style.display='none';
  } 
}
   return true;  
   }*/
function LTrim(str){
	var whitespace = new String(" \t\n\r");
	var s = new String(str);
	if(whitespace.indexOf(s.charAt(0)) != -1){
	// We have a string with leading blank(s)...
		var j=0, i = s.length;
	// Iterate from the far left of string until we
	// don't have any more whitespace...
	while(j < i && whitespace.indexOf(s.charAt(j)) != -1)
		j++;
	// Get the substring from the first non-whitespace
	// character to the end of the string...
		s = s.substring(j, i);
	}
	return s;
}
function RTrim(str){
	// We don't want to trip JUST spaces, but also tabs,
	// line feeds, etc.  Add anything else you want to
	// "trim" here in Whitespace
	var whitespace = new String(" \t\n\r");	
	var s = new String(str);	
	if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
	// We have a string with trailing blank(s)...	
	var i = s.length - 1;       // Get length of string	
	// Iterate from the far right of string until we
	// don't have any more whitespace...
	while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
		i--;	
	// Get the substring from the front of the string to
	// where the last non-whitespace character is...
		s = s.substring(0, i+1);
	}
	return s;
}
function Trim(id){
    var str=document.getElementById(id).value;
	document.getElementById(id).value=RTrim(LTrim(str));
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
function time_show1(idval)
{
	var var_id = '#'+idval ; 						
	$(var_id).timepicker({ampm: true, hourMin: 0, hourMax: 24 });
}
       function validimage(fval)
      {
          var re_text = /\.jpg|\.png|\.gif|\.jpeg/i;
		  var len=document.getElementById("tblAdd");
          var len1=len.rows.length;
          var img=document.getElementById("image"+len1).value;
				if(fval=="")
				{
					//alert("upload image");
					showDIV2('product_image_err','Browse and Upload Image',1,'product_image');
					return false; 
				}
				else if(fval.search(re_text) == -1)
				{
					//alert("Image does not have Image(jpg, gif, png) extension"); 
					showDIV2('product_image_err','Image does not have (jpg, gif, png) extension',1,'product_image');
					document.getElementById("image"+len1).value='';
					document.getElementById("image"+len1).focus();
					return false;
				}
				else
				{
					hideDIV('product_image_err',1);
				}
       }
function fncheck(val)
  {
        var len=document.getElementById("tblAdd");
        var len1=len.rows.length;
        var img=document.getElementById("image"+len1).value;
		var re_text = /\.jpg|\.png|\.gif|\.jpeg/i;
        for(var i=1;i<len1;i++)
             {
		         if(document.getElementById('image'+i).value==val)
                  {
                           //alert("already image has been selected");
						   showDIV2('product_image_err','Already Image has been selected',1,'product_image');
                           document.getElementById("image"+i).focus();
                           break;
					}
			}
		validimage(val);		 
    }
function AddDetails()
      {	  
          var tableAdd = document.getElementById("tblAdd");
          var lastRow = tableAdd.rows.length;
       	  var checkUrl = document.getElementById("image"+lastRow).value;
          var re_text = /\.jpg|\.png|\.gif|\.jpeg/i;
		  var fval=document.getElementById("image"+lastRow).value;
          if( document.getElementById("image"+lastRow).value == "" )
            {
             //alert("browse and upload image");
			 showDIV2('product_image_err','Browse and Upload Image',1,'product_image');
             document.getElementById("image"+lastRow).focus();
             return false;
            }
		if(fval.search(re_text) == -1)
		   {
				//alert("Image does not have Image(jpg, gif, png) extension"); 
				showDIV2('product_image_err','Image does not have (jpg, gif, png) extension',1,'product_image');
				document.getElementById("image"+lastRow).value='';
				document.getElementById("image"+lastRow).focus();
                return false;
		   }
      // if there's no header row in the table, then iteration = lastRow + 1
        var iteration = lastRow+1;
        var row = tableAdd.insertRow(lastRow);
        var cellRight = row.insertCell(0);
              <!--  cellRight.innerHTML="Image"+iteration+"<input type='file'  name='image[]'    id='image"+iteration+"' size='30' value='' onchange=\"return fncheck(this.value)\" />";-->
				cellRight.innerHTML="<input type='file'  name='image[]'    id='image"+iteration+"' size='25' value='' onchange=\"return fncheck(this.value)\" />";
            // alert(cellRight.innerHTML);
        cellRight.style.textAlign = "Center";
        tableAdd.style.display = "Block";
		hideDIV('product_image_err',1);
    }
    function DeleteDetails()
    {
        var tbl = document.getElementById('tblAdd');
        var lastRow = tbl.rows.length;
        if (lastRow > 1) tbl.deleteRow(lastRow - 1);
    }
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
<fieldset class="table-bor">
<legend><strong>Add New Pilgrimage Bus</strong></legend>
<form action="" name="busform" id="busform" method="post" onSubmit="return validate_busform()" enctype="multipart/form-data">
<table align="center">
	<tr>	
		<td></td>
		<td></td>
		<td></td>
		<td></td>	
	</tr>
	<tr><td colspan="4"><br /></td></tr>
	<tr>
		<td width="143"> Bus Name </td>
		<td width="174">
			<input type="text" name="bname" id="bname" class="textbox"/>	
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
			<option value="<?php echo $btype['typeID']; ?>"><?php echo $btype['typeName']; ?></option>								
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
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select>	
			<div id="fromCity_err" style="display:none; color:#FF3300">Please Choose From City</div>	
			<span style="display:none;" id="boardingcodefrom"></span>
	    </td>		
		<td width="188"> To City </td>
		<td> 		
		<span id="tocity">
			<select id="toCity" name="toCity" class="combobox">
				<option value="">Select Destination Place</option>
			</select>
		</span>
		<span style="display:none;" id="boardingcodeto"></span>
		<span id="loading"></span>
		<div id="txt_to_city_err" style="display:none; color:#FF3300">Please Choose To City</div>
	  </td>
	</tr>
	<tr><td colspan="4"><br /></td></tr>
    <tr>
	<td width="143">Depature Time</td>
	<td width="174">
	<input type="text"  class="textbox" name="depart" id="depart" onfocus="time_show(this.id);"  /> 
	</td>
	<td width="188">Arrival Time</td>
    <td width="183">
	<input type="text"  class="textbox" name="arrival" id="arrival"  onfocus="time_show(this.id);"  /> 
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
			<option value="<?php echo $row['promo_id']; ?>"><?php echo $row['promo_title']; ?></option>									
			<?php } ?>
		</select>
	</td>
	<td> </td>
	</tr>
	<tr><td colspan="4"><br /></td></tr>
	<tr>
		<td height="32">
			Boarding Point & Time		</td>
		<td colspan="3" align="left">
			<table width="450" id="dataTable">
		<tr>
			<td width="23"><INPUT type="checkbox" name="chk" disabled="disabled"/></td>
			<td width="14"> 1 </td>
			<td width="170">
			<!--<INPUT type="text" name="b_0" id="b_0" class="textbox" value="" onKeyDown="return chkkeycode(event,this.id)"  />-->            <div id="b_points">
			<select name="b_0" id="b_0" disabled="disabled">
			<option value="">Boarding Point</option>
			</select>	
			</div>
			<div id="b_0_err" style="display:none; color:#FF3300;">Please Enter Boarding Point</div>
			</td>
			<td width="172"> 
			<input type="text" name="bt_0" id="bt_0" class="textbox" value="Choose Time" onFocus="time_show(this.id);" style="cursor:pointer;" readonly />
			<div id="bt_0_err" style="display:none; color:#FF3300;">Please Enter Boarding Time</div>
			</td>
			<td width="20"><img src="../images/plus_icon.png" id="addrowfrom" style="display:none;" border="0" onClick="addRowAdmin('dataTable','boardingcodefrom')" /></td>
			<td width="23"><img src="../images/minus_icon.png" id="delrowfrom" style="display:none;" border="0" onClick="deleteRow('dataTable')" /></td>
		</tr>
		  </table>
		</td>
	</tr>
	<tr><td colspan="4"><br />
	<input type="hidden" name="boardlist" id="boardlist" value="b_0-bt_0" />
	<input type="hidden" id="boardcount" name="boardcount" value='1' />
	<input type="hidden" name="boardingpoint" id="boardingpoint" value="" />
	<input type="hidden" name="toboardingpoint" id="toboardingpoint" value="" />
	</td></tr>
<tr>
		<td>  Dropping Point & Time		</td>
		<td colspan="3" align="left">
			<table id="dropping_tbl">
				<tr>
					<td width="23">
					<INPUT type="checkbox" name="chk1" disabled="disabled"/>						
				  </td>
					<td width="14"> 1 </td>
					<td width="170">
						<!--<INPUT type="text" name="d_0" id="d_0" class="textbox" value="" onKeyDown="return chkkeycode(event,this.id)" /> -->
						  <div id="d_points">
			<select name="d_0" id="d_0"  onKeyDown="return chkkeycode(event,this.id)" disabled="disabled">
			<option value="">Dropping Point</option>
			</select>	
			</div>
			<div id="d_0_err" style="display:none; color:#FF3300;">Please Enter Dropping Point</div>
				  </td>
					<td width="172">
					<input type="text" name="dp_0" id="dp_0" class="textbox" value="Choose Time" onFocus="time_show(this.id);" style="cursor:pointer;" readonly />
			<div id="dp_0_err" style="display:none; color:#FF3300;">Please Enter Dropping Time</div>
					</td>
					<td width="20"><img src="../images/plus_icon.png" id="addrowto" style="display:none;" border="0" onClick="addRow1('dropping_tbl','boardingcodeto')" /></td>
					<td width="23"><img src="../images/minus_icon.png" id="delrowto" style="display:none;" border="0" onClick="deleteRow1('dropping_tbl')" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan="4"><br />
	<input type="hidden" name="droplist" id="droplist" value="d_0-dp_0" />
	<input type="hidden" id="dropcount" name="dropcount" value='1' />
	</td></tr>
	<tr><td colspan="4"><br /></td></tr>
	<!--<tr>
		<td width="143"> Fare for 1 Ticket</td>
		<td width="174"> 
			<input type="text" name="fare" id="fare" class="textbox" maxlength="8" onKeyPress="return isNumberKey(event);"/>
			<div id="fare_err" style="display:none; color:#FF3300">Please Enter fare Amount</div>
	    </td>
		<td width="188"> Tax for 1 Ticket</td>
		<td width="183"> 
			<input type="text" name="tax" id="tax" class="textbox" maxlength="8" onKeyPress="return isNumberKey(event);" onKeyUp="get_fare();"/>
		<div id="tax_err" style="display:none; color:#FF3300">Please Enter Tax Amount</div>		
	    </td>
	</tr>
	<tr><td colspan="4"><br /></td></tr>
	<tr>-->
		<td width="143"> Total Fare </td>
		<td width="174"> 		
			<input type="text" name="tfare" id="tfare" maxlength="4" class="textbox" value="" onKeyPress="return isNumberKey(event);"/>			
	    </td>
		<td width="188"> Bus Structure </td>
		<td width="183"> 		
		<!--<input type="text" name="seats" id="seats" class="textbox" maxlength="8" onKeyPress="return isNumberKey(event);"/>-->
			<select name="seats" id="seats">
			<option value="">Select Bus Structure</option>
			<?php
			$str_sql=mysql_query("SELECT * FROM busstructuretypes WHERE structureStatus = 1 ORDER BY structureID ");
			while($strtypes=mysql_fetch_array($str_sql)){
				  if($bus->Bus_structure == $strtypes['structureID']){
					 $struct_ID=$strtypes['structureID'];
					 $struct_Name=$strtypes['structureType'];
				  }
			?>
			<option value="<?php echo $strtypes['structureID']; ?>" <?php if($bus->Bus_structure == $strtypes['structureID']) { ?> selected="selected"<?php } ?>><?php echo $strtypes['structureType']; ?></option>
			<?php } ?>
</select>				
	    </td>
	</tr>
	<tr><td colspan="4"><br /></td></tr>
	<tr>
	<td>Luxury Items</td>
	<td>
	<div class="divscroll">
		<?php 
	$lux=mysql_query("select * from bus_luxitem where lux_status=0");
	$i=1;
	while($lux_row=mysql_fetch_array($lux))
	{
	?>
<!--	<option value="<?php echo $lux_row['lux_id'];?>" <?php if($lux_row['lux_id']==$bus->luxury_item) { ?> selected="selected"; <?php } ?>><?php echo $lux_row['lux_name'];?></option>-->
	<div><input type="checkbox"  name="lux_item[]" value="<?php echo $lux_row['lux_id'] ?>" /><span><?php echo $lux_row['lux_name'];?></span></div>
	<?php } ?>
	</div>
	</td>
	<td>Bus Videos</td>
	<td><input type="file" name="video" id="video"><br><span>Upload 3pg,flv,mp4 videos only...</span>
    <img src="images/plus_icon.png" title="Add" border="0" onClick="javascript:AddDetails();" id="btnAdd"  />
     <img src="images/minus_icon.png" title="Delete" border="0" onClick="javascript:DeleteDetails();" id="delAdd" />
    </td>
	</tr>
	<tr><td><!--<a href="view_busimages.php?sp_id=<?php echo $sp_id; ?>">view bus images</a>--></td></tr>
	<!--<tr><td colspan="4"><br /></td></tr>
	<table id="tblAdd">
	<tr>
	<td>Bus Image <a href="view_busimages.php?sp_id=<?php echo $sp_id; ?>">view bus images</a></td>
	<td><input type="file" name="image[]" id="image1" onChange="return validimage(this.value);"> 
     <img src="images/plus_icon.png" title="Add" border="0" onClick="javascript:AddDetails();" id="btnAdd"  />
     <img src="images/minus_icon.png" title="Delete" border="0" onClick="javascript:DeleteDetails();" id="delAdd" /><br><span>Upload gif,png,jpg,jpeg images only...</span></td>
      <div class="register_rgt" style="font-size:11px;color:#FF3366;display:none; padding-left:20px;" id="product_image_err"></div>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	</table>-->
	<tr><td colspan="4"><br /></td></tr>
	<tr>
	<td>Terms & Conditions</td>
	<td><textarea cols="29" rows="5" name="terms_conditions" id="terms_conditions"></textarea></td>
	<td>Active Days</td>
	<td><select name="active_days" id="active_days">	
    <option value="5">Week Days</option>
    <option value="2">Week Ends</option>
    <option value="365">All Days</option>
    </select>

    </td>
	</tr>
	<tr>
	<td>Track Device No:</td>
	<td><input type="text" name="track_device" id="track_device" class="textbox" /></td>
	<td></td>
	<td>	</td>
	</tr>
    <tr>
	<td>Cancellation Policy (Hours)</td>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy"></td>
	<td>Cancellation Charge (%)</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge"></td>
	</tr>
    <tr>
    <td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy1"></td>
	<td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge1"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy2"></td>
	<td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge2"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy[]" id="cancelpolicy3"></td>
	<td>&nbsp;</td>
	<td><input type="text" name="cancelpolicy_charge[]" id="cancelcharge3"></td>
    </tr>
	<tr>
		<td colspan="4" align="center"> 
			<!--<input type="submit" name="subbus" value="Add >>" onClick="add_validbus()" />-->
				<input type="submit" name="addbus" value="Add >>"  />
	    </td>
	</tr>
	<tr><td colspan="4"><br /></td></tr>
	<tr>
		<td colspan="4" align="left">
			<div>
			<!--<?php  if($cmp_id != '' ) {  ?>
			<table width="702">  
				<tr>
					<th width="146"> Bus Name </th>
					<th width="101"> Bus Type </th>
					<th width="116"> From </th>
					<th width="101"> To </th>
					<th width="61"> Fare </th>
					<th width="69"> Seats </th>
					<th width="76"> Status </th>
				</tr>						
				<?php 
					$sql1 = mysql_query("select * from tbl_businfo where comp_id='$compid' ") ;
					$count = mysql_num_rows($sql1) ;
					//echo $count ; exit ;
					if($count != '0')
					{
					while($qry = mysql_fetch_array($sql1))
					{
				?>
				<tr>
					<td><?php echo $qry['bus_name'] ; ?></td>
					<td>
						<?php 
							$btype = $qry['bus_type'] ;
							$sql = mysql_fetch_array(mysql_query("select * from tbl_bus_type where id ='$btype' and status='1' ") ) ;
							echo $sql['type'] ;
						?>
					</td>
					<td>
						<?php 
							$fcity = $qry['from_city'] ;
							$sql = mysql_fetch_array(mysql_query("select * from tbl_city where id ='$fcity' ") ) ;
							echo $sql['city_name'] ;
						?>
					</td>
					<td>
						<?php 
							$tcity = $qry['to_city'] ;
							$sql = mysql_fetch_array(mysql_query("select * from tbl_city where id ='$tcity' ") ) ;
							echo $sql['city_name'] ;
						?>
					</td>
					<td><?php echo $qry['bus_fare'] ; ?></td>
					<td><?php echo $qry['seats'] ; ?></td>
					<td>
						<?php 
							$status = $qry['status'] ;
							if($status = 1)
							{
								echo "<font color='#237B25'><strong>Active</strong></font>" ;
							}
							else
							{
								echo "<font color='red'><strong>InActive</strong></font>" ;
							}
						?>
					</td>
				</tr>
				<?php } } else { ?>
				<tr>
					<td colspan="7" align="center">
						<font color="red"><strong>No Records Found</strong></font>
					</td>
				</tr>
				<?php } ?>
		  </table>
		  	<?php } ?>-->
		    </div>
		</td>
	</tr>
</table>
</form>
</fieldset>
<script language="javascript">
	time_show("bt_0");
	time_show("dp_0");
</script>
<?php include "includes/footer.php"; } ?>